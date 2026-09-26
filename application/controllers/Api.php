<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller REST API IPPD
 * Menyediakan layanan endpoint data IKU, Sinkronisasi Eksternal,
 * Server-Sent Events (SSE) Realtime Stream, dan Webhook Management.
 */
class Api extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('IkuSyncService');

        // CORS & JSON Headers
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Authorization, X-API-KEY, Content-Type, Accept, Origin, X-Requested-With');

        // Handle preflight OPTIONS request
        if ($this->input->method(TRUE) === 'OPTIONS') {
            http_response_code(200);
            exit();
        }
    }

    /**
     * Helper response JSON
     */
    protected function json_response($data, $statusCode = 200) {
        $this->output
             ->set_status_header($statusCode)
             ->set_content_type('application/json', 'utf-8')
             ->set_output(json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT))
             ->_display();
        exit();
    }

    /**
     * Autentikasi API Key
     * Memeriksa Header X-API-KEY, Authorization: Bearer, atau Query Param api_key
     */
    protected function authenticate($requiredPermission = 'read', $requiredWilayah = null) {
        $apiKey = $this->input->get_request_header('X-API-KEY', TRUE);

        if (empty($apiKey)) {
            $authHeader = $this->input->get_request_header('Authorization', TRUE);
            if (!empty($authHeader) && preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
                $apiKey = trim($matches[1]);
            }
        }

        if (empty($apiKey)) {
            $apiKey = $this->input->get_post('api_key', TRUE);
        }

        // Jika user memiliki sesi login aktif di IPPD, izinkan
        if (isset($_SESSION['Level'])) {
            return [
                'type' => 'session',
                'user' => $_SESSION['Nama'] ?? 'User Session',
                'permissions' => 'read,write',
                'kodewilayah' => $_SESSION['KodeWilayah'] ?? null
            ];
        }

        // Jika permission hanya 'read' dan belum ada key, izinkan pembacaan publik jika wilayah ditentukan
        if ($requiredPermission === 'read' && empty($apiKey)) {
            return [
                'type' => 'public_read',
                'permissions' => 'read',
                'kodewilayah' => null
            ];
        }

        if (empty($apiKey)) {
            $this->json_response([
                'status' => 'error',
                'message' => 'Akses ditolak! API Key diperlukan. Sertakan header "X-API-KEY" atau "Authorization: Bearer <token>"'
            ], 401);
        }

        $keyRow = $this->db->where('api_key', $apiKey)
                           ->where('status', 'active')
                           ->get('api_keys')
                           ->row_array();

        if (!$keyRow) {
            $this->json_response([
                'status' => 'error',
                'message' => 'API Key tidak valid atau sudah dinonaktifkan!'
            ], 401);
        }

        // Cek izin (read / write)
        if ($requiredPermission === 'write') {
            $perms = explode(',', strtolower($keyRow['permissions']));
            if (!in_array('write', $perms) && !in_array('all', $perms)) {
                $this->json_response([
                    'status' => 'error',
                    'message' => 'API Key ini tidak memiliki izin menulis (write permission)!'
                ], 403);
            }
        }

        // Cek batasan wilayah
        if (!empty($keyRow['kodewilayah']) && !empty($requiredWilayah)) {
            if ($keyRow['kodewilayah'] !== $requiredWilayah) {
                $this->json_response([
                    'status' => 'error',
                    'message' => "API Key ini hanya dibatasi untuk wilayah: {$keyRow['kodewilayah']}!"
                ], 403);
            }
        }

        // Update waktu terakhir digunakan
        $this->db->where('id', $keyRow['id'])->update('api_keys', [
            'last_used_at' => date('Y-m-d H:i:s')
        ]);

        return [
            'type' => 'api_key',
            'key_name' => $keyRow['key_name'],
            'permissions' => $keyRow['permissions'],
            'kodewilayah' => $keyRow['kodewilayah']
        ];
    }

    /**
     * Endpoint Utama IKU: GET /api/iku atau POST /api/iku
     */
    public function iku($id = null) {
        $method = $this->input->method(TRUE);

        if ($method === 'GET') {
            if ($id !== null && is_numeric($id)) {
                return $this->detail_iku((int)$id);
            }
            return $this->get_list_iku();
        } elseif ($method === 'POST') {
            return $this->create_iku();
        } elseif ($method === 'PUT') {
            return $this->update_iku($id);
        } elseif ($method === 'DELETE') {
            return $this->delete_iku($id);
        }

        $this->json_response(['status' => 'error', 'message' => "Method {$method} tidak didukung!"], 405);
    }

    /**
     * GET Daftar IKU
     */
    public function get_list_iku() {
        $kodeWilayah = $this->input->get('kode_wilayah', TRUE) ?: 
                       ($this->input->get('kodewilayah', TRUE) ?: 
                       ($this->session->userdata('KodeWilayah') ?: ''));

        $this->authenticate('read', $kodeWilayah);

        $tahunMulai = $this->input->get('tahun_mulai', TRUE);
        $tahunAkhir = $this->input->get('tahun_akhir', TRUE);
        $search = $this->input->get('q', TRUE) ?: $this->input->get('search', TRUE);
        $since = $this->input->get('since', TRUE);
        $limit = (int)($this->input->get('limit', TRUE) ?: 100);
        $offset = (int)($this->input->get('offset', TRUE) ?: 0);

        if ($limit > 500) $limit = 500;
        if ($limit < 1) $limit = 100;

        $this->db->from('iku')->where('deleted_at IS NULL');

        if (!empty($kodeWilayah)) {
            $this->db->where('kodewilayah', $kodeWilayah);
        }

        if (!empty($tahunMulai)) {
            $this->db->where('tahun_mulai', (int)$tahunMulai);
        }

        if (!empty($tahunAkhir)) {
            $this->db->where('tahun_akhir', (int)$tahunAkhir);
        }

        if (!empty($search)) {
            $this->db->group_start()
                     ->like('indikator_tujuan', $search)
                     ->or_like('rumus', $search)
                     ->or_like('definisi_operasional', $search)
                     ->group_end();
        }

        if (!empty($since)) {
            if (is_numeric($since)) {
                $sinceDate = date('Y-m-d H:i:s', (int)$since);
            } else {
                $sinceDate = date('Y-m-d H:i:s', strtotime($since));
            }
            $this->db->where('updated_at >=', $sinceDate);
        }

        $countQuery = clone $this->db;
        $total = $countQuery->count_all_results();

        $rows = $this->db->order_by('id', 'ASC')
                         ->limit($limit, $offset)
                         ->get()
                         ->result_array();

        // Ambil nama wilayah jika kode wilayah terdefinisi
        $wilayahInfo = null;
        if (!empty($kodeWilayah)) {
            $w = $this->db->where('Kode', $kodeWilayah)->get('kodewilayah')->row_array();
            if ($w) {
                $wilayahInfo = [
                    'kode' => $w['Kode'],
                    'nama' => $w['Nama']
                ];
            }
        }

        $formatted = [];
        foreach ($rows as $r) {
            $formatted[] = [
                'id' => (int)$r['id'],
                'kodewilayah' => $r['kodewilayah'],
                'id_tujuan' => $r['IdTujuan'] ? (int)$r['IdTujuan'] : null,
                'indikator_tujuan' => $r['indikator_tujuan'],
                'rumus' => $r['rumus'] ?: null,
                'definisi_operasional' => $r['definisi_operasional'] ?: null,
                'tahun_mulai' => $r['tahun_mulai'] ? (int)$r['tahun_mulai'] : null,
                'tahun_akhir' => $r['tahun_akhir'] ? (int)$r['tahun_akhir'] : null,
                'target_1' => $r['target_1'] !== null ? (float)$r['target_1'] : null,
                'target_2' => $r['target_2'] !== null ? (float)$r['target_2'] : null,
                'target_3' => $r['target_3'] !== null ? (float)$r['target_3'] : null,
                'target_4' => $r['target_4'] !== null ? (float)$r['target_4'] : null,
                'target_5' => $r['target_5'] !== null ? (float)$r['target_5'] : null,
                'created_at' => $r['created_at'],
                'updated_at' => $r['updated_at']
            ];
        }

        $baseUrl = base_url();
        $this->json_response([
            'status' => 'success',
            'message' => 'Data IKU berhasil diambil',
            'count' => count($formatted),
            'total' => $total,
            'limit' => $limit,
            'offset' => $offset,
            'wilayah' => $wilayahInfo,
            'data' => $formatted,
            'realtime' => [
                'stream_url' => $baseUrl . 'api/iku/stream' . (!empty($kodeWilayah) ? '?kode_wilayah=' . $kodeWilayah : ''),
                'changes_url' => $baseUrl . 'api/iku/changes' . (!empty($kodeWilayah) ? '?kode_wilayah=' . $kodeWilayah : '')
            ],
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * GET Detail IKU by ID
     */
    public function detail_iku($id) {
        $this->authenticate('read');

        $row = $this->db->where('id', $id)
                        ->where('deleted_at IS NULL')
                        ->get('iku')
                        ->row_array();

        if (!$row) {
            $this->json_response(['status' => 'error', 'message' => 'Data IKU tidak ditemukan!'], 404);
        }

        $this->json_response([
            'status' => 'success',
            'data' => [
                'id' => (int)$row['id'],
                'kodewilayah' => $row['kodewilayah'],
                'indikator_tujuan' => $row['indikator_tujuan'],
                'rumus' => $row['rumus'],
                'definisi_operasional' => $row['definisi_operasional'],
                'tahun_mulai' => $row['tahun_mulai'] ? (int)$row['tahun_mulai'] : null,
                'tahun_akhir' => $row['tahun_akhir'] ? (int)$row['tahun_akhir'] : null,
                'target_1' => $row['target_1'] !== null ? (float)$row['target_1'] : null,
                'target_2' => $row['target_2'] !== null ? (float)$row['target_2'] : null,
                'target_3' => $row['target_3'] !== null ? (float)$row['target_3'] : null,
                'target_4' => $row['target_4'] !== null ? (float)$row['target_4'] : null,
                'target_5' => $row['target_5'] !== null ? (float)$row['target_5'] : null,
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at']
            ]
        ]);
    }

    /**
     * POST Tambah IKU dari Web Lain / API
     */
    public function create_iku() {
        $raw = file_get_contents('php://input');
        $body = json_decode($raw, true);
        if (!is_array($body)) {
            $body = $this->input->post(NULL, TRUE) ?: [];
        }

        $kodeWilayah = $body['kodewilayah'] ?? ($body['kode_wilayah'] ?? '');
        $this->authenticate('write', $kodeWilayah);

        if (empty($kodeWilayah)) {
            $this->json_response(['status' => 'error', 'message' => 'Parameter kodewilayah wajib diisi!'], 400);
        }

        $indikator = trim((string)($body['indikator_tujuan'] ?? ($body['indikator'] ?? '')));
        if (empty($indikator)) {
            $this->json_response(['status' => 'error', 'message' => 'Parameter indikator_tujuan wajib diisi!'], 400);
        }

        $cleanTarget = function($v) {
            if ($v === null || $v === '') return null;
            $val = str_replace(',', '.', trim((string)$v));
            return is_numeric($val) ? $val : null;
        };

        $insertData = [
            'kodewilayah' => $kodeWilayah,
            'IdTujuan' => !empty($body['id_tujuan']) ? (int)$body['id_tujuan'] : 0,
            'indikator_tujuan' => $indikator,
            'rumus' => !empty($body['rumus']) ? trim((string)$body['rumus']) : null,
            'definisi_operasional' => !empty($body['definisi_operasional']) ? trim((string)$body['definisi_operasional']) : null,
            'tahun_mulai' => !empty($body['tahun_mulai']) ? (int)$body['tahun_mulai'] : null,
            'tahun_akhir' => !empty($body['tahun_akhir']) ? (int)$body['tahun_akhir'] : null,
            'target_1' => $cleanTarget($body['target_1'] ?? null),
            'target_2' => $cleanTarget($body['target_2'] ?? null),
            'target_3' => $cleanTarget($body['target_3'] ?? null),
            'target_4' => $cleanTarget($body['target_4'] ?? null),
            'target_5' => $cleanTarget($body['target_5'] ?? null),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('iku', $insertData);
        $newId = $this->db->insert_id();

        // Log Aktivitas & Dispatch Webhook Realtime
        $insertData['id'] = $newId;
        $this->ikusyncservice->log_activity($kodeWilayah, $newId, 'CREATE', $indikator, $insertData, 'REST_API');

        $this->json_response([
            'status' => 'success',
            'message' => 'Data IKU berhasil ditambahkan melalui API',
            'data' => $insertData
        ], 201);
    }

    /**
     * PUT/POST Perbarui Data IKU dari Web Lain / API
     */
    public function update_iku($id = null) {
        $id = $id ? (int)$id : (int)$this->input->get_post('id', TRUE);
        if ($id <= 0) {
            $this->json_response(['status' => 'error', 'message' => 'ID IKU tidak valid!'], 400);
        }

        $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('iku')->row_array();
        if (!$existing) {
            $this->json_response(['status' => 'error', 'message' => 'Data IKU tidak ditemukan!'], 404);
        }

        $this->authenticate('write', $existing['kodewilayah']);

        $raw = file_get_contents('php://input');
        $body = json_decode($raw, true);
        if (!is_array($body)) {
            $body = $this->input->post(NULL, TRUE) ?: [];
        }

        $cleanTarget = function($v, $default) {
            if ($v === null || $v === '') return $default;
            $val = str_replace(',', '.', trim((string)$v));
            return is_numeric($val) ? $val : null;
        };

        $updateData = ['updated_at' => date('Y-m-d H:i:s')];

        if (isset($body['indikator_tujuan']) || isset($body['indikator'])) {
            $updateData['indikator_tujuan'] = trim((string)($body['indikator_tujuan'] ?? $body['indikator']));
        }
        if (array_key_exists('rumus', $body)) {
            $updateData['rumus'] = !empty($body['rumus']) ? trim((string)$body['rumus']) : null;
        }
        if (array_key_exists('definisi_operasional', $body)) {
            $updateData['definisi_operasional'] = !empty($body['definisi_operasional']) ? trim((string)$body['definisi_operasional']) : null;
        }
        if (isset($body['tahun_mulai'])) $updateData['tahun_mulai'] = (int)$body['tahun_mulai'];
        if (isset($body['tahun_akhir'])) $updateData['tahun_akhir'] = (int)$body['tahun_akhir'];
        if (array_key_exists('target_1', $body)) $updateData['target_1'] = $cleanTarget($body['target_1'], $existing['target_1']);
        if (array_key_exists('target_2', $body)) $updateData['target_2'] = $cleanTarget($body['target_2'], $existing['target_2']);
        if (array_key_exists('target_3', $body)) $updateData['target_3'] = $cleanTarget($body['target_3'], $existing['target_3']);
        if (array_key_exists('target_4', $body)) $updateData['target_4'] = $cleanTarget($body['target_4'], $existing['target_4']);
        if (array_key_exists('target_5', $body)) $updateData['target_5'] = $cleanTarget($body['target_5'], $existing['target_5']);

        $this->db->where('id', $id)->update('iku', $updateData);

        // Ambil data terbaru
        $fresh = $this->db->where('id', $id)->get('iku')->row_array();

        // Log Aktivitas & Dispatch Webhook Realtime
        $this->ikusyncservice->log_activity(
            $existing['kodewilayah'],
            $id,
            'UPDATE',
            $fresh['indikator_tujuan'],
            ['before' => $existing, 'after' => $fresh],
            'REST_API'
        );

        $this->json_response([
            'status' => 'success',
            'message' => 'Data IKU berhasil diperbarui melalui API',
            'data' => $fresh
        ]);
    }

    /**
     * DELETE Hapus Data IKU dari Web Lain / API
     */
    public function delete_iku($id = null) {
        $id = $id ? (int)$id : (int)$this->input->get_post('id', TRUE);
        if ($id <= 0) {
            $this->json_response(['status' => 'error', 'message' => 'ID IKU tidak valid!'], 400);
        }

        $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('iku')->row_array();
        if (!$existing) {
            $this->json_response(['status' => 'error', 'message' => 'Data IKU tidak ditemukan!'], 404);
        }

        $this->authenticate('write', $existing['kodewilayah']);

        $this->db->where('id', $id)->delete('iku');

        // Log Aktivitas & Dispatch Webhook Realtime
        $this->ikusyncservice->log_activity(
            $existing['kodewilayah'],
            $id,
            'DELETE',
            $existing['indikator_tujuan'],
            $existing,
            'REST_API'
        );

        $this->json_response([
            'status' => 'success',
            'message' => "Data IKU ID {$id} berhasil dihapus"
        ]);
    }

    /**
     * Realtime Stream menggunakan Server-Sent Events (SSE)
     * GET /api/iku/stream atau GET /api/iku/realtime
     * Menyediakan koneksi live realtime langsung ke browser / web lain.
     */
    public function stream_iku() {
        // Disable output buffering & set SSE headers
        if (function_exists('apache_setenv')) {
            @apache_setenv('no-gzip', 1);
        }
        @ini_set('zlib.output_compression', 0);
        @ini_set('implicit_flush', 1);
        while (ob_get_level() > 0) {
            ob_end_clean();
        }

        header('Content-Type: text/event-stream; charset=utf-8');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('X-Accel-Buffering: no');
        header('Connection: keep-alive');

        $kodeWilayah = $this->input->get('kode_wilayah', TRUE) ?: 
                       ($this->input->get('kodewilayah', TRUE) ?: '');

        $lastEventId = (int)$this->input->get('last_event_id', TRUE);
        if (isset($_SERVER['HTTP_LAST_EVENT_ID'])) {
            $lastEventId = (int)$_SERVER['HTTP_LAST_EVENT_ID'];
        }

        // Jika belum ada lastEventId, ambil ID log terakhir saat ini
        if ($lastEventId <= 0) {
            $lastLog = $this->db->select_max('id')->get('iku_activity_logs')->row_array();
            $lastEventId = $lastLog['id'] ? (int)$lastLog['id'] : 0;
        }

        // Kirim event sambungan awal
        echo "event: connected\n";
        echo "data: " . json_encode([
            'status' => 'connected',
            'message' => 'Realtime SSE Stream IPPD IKU aktif',
            'kodewilayah' => $kodeWilayah ?: 'ALL',
            'last_event_id' => $lastEventId,
            'timestamp' => date('Y-m-d H:i:s')
        ]) . "\n\n";
        @flush();

        // Loop streaming selama maksimal 25 detik per request (browser akan reconnect otomatis)
        $startTime = time();
        $heartbeat = 0;

        while (time() - $startTime < 25) {
            if (connection_aborted()) {
                break;
            }

            // Cek apakah ada aktivitas baru di log
            $this->db->from('iku_activity_logs')->where('id >', $lastEventId);
            if (!empty($kodeWilayah)) {
                $this->db->where('kodewilayah', $kodeWilayah);
            }
            $newLogs = $this->db->order_by('id', 'ASC')->limit(20)->get()->result_array();

            if (!empty($newLogs)) {
                foreach ($newLogs as $log) {
                    $lastEventId = (int)$log['id'];
                    $payload = [
                        'id' => $lastEventId,
                        'event_type' => $log['event_type'],
                        'kodewilayah' => $log['kodewilayah'],
                        'iku_id' => $log['iku_id'],
                        'indikator' => $log['indikator'],
                        'details' => json_decode($log['details'], true),
                        'source' => $log['source'],
                        'created_at' => $log['created_at']
                    ];

                    echo "id: {$lastEventId}\n";
                    echo "event: iku_change\n";
                    echo "data: " . json_encode($payload, JSON_UNESCAPED_UNICODE) . "\n\n";
                    @flush();
                }
            } else {
                // Heartbeat ping setiap 10 detik agar koneksi tetap hidup
                $heartbeat++;
                if ($heartbeat % 10 === 0) {
                    echo ": ping " . time() . "\n\n";
                    @flush();
                }
            }

            sleep(1);
        }

        // Kirim penutup agar reconnect
        echo "event: retry\n";
        echo "data: 1000\n\n";
        @flush();
        exit();
    }

    /**
     * GET /api/iku/changes
     * Endpoint polling perubahan data IKU untuk sistem yang tidak mendukung Webhook / SSE
     */
    public function changes_iku() {
        $kodeWilayah = $this->input->get('kode_wilayah', TRUE) ?: 
                       ($this->input->get('kodewilayah', TRUE) ?: '');

        $this->authenticate('read', $kodeWilayah);

        $since = $this->input->get('since', TRUE);
        $lastId = (int)$this->input->get('last_id', TRUE);

        $this->db->from('iku_activity_logs');
        if (!empty($kodeWilayah)) {
            $this->db->where('kodewilayah', $kodeWilayah);
        }

        if ($lastId > 0) {
            $this->db->where('id >', $lastId);
        } elseif (!empty($since)) {
            if (is_numeric($since)) {
                $sinceDate = date('Y-m-d H:i:s', (int)$since);
            } else {
                $sinceDate = date('Y-m-d H:i:s', strtotime($since));
            }
            $this->db->where('created_at >', $sinceDate);
        }

        $logs = $this->db->order_by('id', 'DESC')->limit(50)->get()->result_array();

        $formatted = [];
        foreach ($logs as $l) {
            $formatted[] = [
                'log_id' => (int)$l['id'],
                'event_type' => $l['event_type'],
                'kodewilayah' => $l['kodewilayah'],
                'iku_id' => $l['iku_id'] ? (int)$l['iku_id'] : null,
                'indikator' => $l['indikator'],
                'details' => json_decode($l['details'], true),
                'source' => $l['source'],
                'created_at' => $l['created_at']
            ];
        }

        $this->json_response([
            'status' => 'success',
            'count' => count($formatted),
            'latest_id' => !empty($formatted) ? (int)$formatted[0]['log_id'] : $lastId,
            'changes' => $formatted,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Endpoint IKU Perangkat Daerah: GET /api/iku_pd
     */
    public function iku_pd() {
        $this->authenticate('read');

        $kodeWilayah = $this->input->get('kode_wilayah', TRUE) ?: $this->input->get('kodewilayah', TRUE);
        $instansiId = $this->input->get('instansi_id', TRUE);

        $this->db->from('iku_pd')->where('deleted_at IS NULL');
        if (!empty($kodeWilayah)) $this->db->where('kode_wilayah', $kodeWilayah);
        if (!empty($instansiId)) $this->db->where('id_instansi', (int)$instansiId);

        $rows = $this->db->order_by('id', 'ASC')->limit(200)->get()->result_array();

        $this->json_response([
            'status' => 'success',
            'count' => count($rows),
            'data' => $rows
        ]);
    }
}
