<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class IkuSyncService
 * Layanan terpusat untuk Sinkronisasi API, Webhook Realtime,
 * dan Log Aktivitas Indikator Kinerja Utama (IKU).
 */
class IkuSyncService {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->database();
        $this->auto_migrate();
    }

    /**
     * Memastikan tabel pendukung (api_keys, iku_webhooks, iku_activity_logs) telah tersedia
     */
    public function auto_migrate() {
        $db = $this->CI->db;

        if (!$db->table_exists('api_keys')) {
            $db->query("CREATE TABLE IF NOT EXISTS `api_keys` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `key_name` varchar(150) NOT NULL,
              `api_key` varchar(64) NOT NULL UNIQUE,
              `kodewilayah` varchar(13) DEFAULT NULL,
              `permissions` varchar(50) DEFAULT 'read,write',
              `status` enum('active','inactive') DEFAULT 'active',
              `last_used_at` datetime DEFAULT NULL,
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
              `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              KEY `idx_api_key` (`api_key`),
              KEY `idx_wilayah` (`kodewilayah`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");

            // Buat default key jika belum ada
            $defaultKey = 'ippd_' . bin2hex(random_bytes(16));
            $db->insert('api_keys', [
                'key_name' => 'Master API Key (Sistem IPPD)',
                'api_key' => $defaultKey,
                'kodewilayah' => NULL,
                'permissions' => 'read,write',
                'status' => 'active'
            ]);
        }

        if (!$db->table_exists('iku_webhooks')) {
            $db->query("CREATE TABLE IF NOT EXISTS `iku_webhooks` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `kodewilayah` varchar(13) NOT NULL,
              `name` varchar(150) NOT NULL,
              `target_url` text NOT NULL,
              `secret_token` varchar(100) DEFAULT NULL,
              `events` varchar(255) DEFAULT 'all',
              `is_active` tinyint(1) DEFAULT 1,
              `last_status` int(11) DEFAULT NULL,
              `last_response` text DEFAULT NULL,
              `last_triggered_at` datetime DEFAULT NULL,
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
              `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              KEY `idx_webhook_wilayah` (`kodewilayah`),
              KEY `idx_webhook_active` (`is_active`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }

        if (!$db->table_exists('iku_activity_logs')) {
            $db->query("CREATE TABLE IF NOT EXISTS `iku_activity_logs` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `kodewilayah` varchar(13) NOT NULL,
              `iku_id` int(11) DEFAULT NULL,
              `event_type` varchar(50) NOT NULL,
              `indikator` text DEFAULT NULL,
              `details` longtext DEFAULT NULL,
              `source` varchar(50) DEFAULT 'WEB_UI',
              `ip_address` varchar(45) DEFAULT NULL,
              `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`),
              KEY `idx_log_wilayah` (`kodewilayah`),
              KEY `idx_log_created` (`created_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8");
        }
    }

    /**
     * Mencatat riwayat log perubahan data IKU
     */
    public function log_activity($kodeWilayah, $ikuId, $eventType, $indikator = null, $details = null, $source = 'WEB_UI') {
        $ip = $this->CI->input->ip_address();
        $detailStr = is_array($details) || is_object($details) ? json_encode($details, JSON_UNESCAPED_UNICODE) : (string)$details;

        $insertData = [
            'kodewilayah' => $kodeWilayah,
            'iku_id' => $ikuId ? (int)$ikuId : null,
            'event_type' => strtoupper($eventType),
            'indikator' => $indikator,
            'details' => $detailStr,
            'source' => $source,
            'ip_address' => $ip,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->CI->db->insert('iku_activity_logs', $insertData);
        $logId = $this->CI->db->insert_id();

        // Otomatis dispatch webhook ke website eksternal yang terdaftar
        $this->dispatch_webhooks($kodeWilayah, $eventType, [
            'event' => 'iku.' . strtolower($eventType),
            'timestamp' => date('c'),
            'log_id' => $logId,
            'kodewilayah' => $kodeWilayah,
            'iku_id' => $ikuId,
            'indikator' => $indikator,
            'details' => is_array($details) ? $details : json_decode($detailStr, true),
            'source' => $source
        ]);

        return $logId;
    }

    /**
     * Mengirimkan notifikasi payload realtime ke seluruh Webhook yang aktif
     */
    public function dispatch_webhooks($kodeWilayah, $eventType, $payload) {
        $webhooks = $this->CI->db->where('kodewilayah', $kodeWilayah)
                                  ->where('is_active', 1)
                                  ->get('iku_webhooks')
                                  ->result_array();

        if (empty($webhooks)) {
            return [];
        }

        $results = [];
        $jsonPayload = json_encode($payload, JSON_UNESCAPED_UNICODE);

        foreach ($webhooks as $wh) {
            // Periksa apakah webhook mendengarkan event ini
            if ($wh['events'] !== 'all' && !empty($wh['events'])) {
                $evList = array_map('trim', explode(',', strtolower($wh['events'])));
                $checkEv = 'iku.' . strtolower($eventType);
                if (!in_array($checkEv, $evList) && !in_array(strtolower($eventType), $evList)) {
                    continue;
                }
            }

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $wh['target_url']);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonPayload);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4); // Fast timeout agar tidak memperlambat user
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

            $headers = [
                'Content-Type: application/json',
                'User-Agent: IPPD-IKU-Realtime-Webhook/1.0',
                'X-IPPD-Event: iku.' . strtolower($eventType),
                'X-IPPD-Delivery: ' . uniqid('dlv_', true),
                'X-IPPD-Timestamp: ' . time()
            ];

            if (!empty($wh['secret_token'])) {
                $signature = hash_hmac('sha256', $jsonPayload, $wh['secret_token']);
                $headers[] = 'X-IPPD-Signature: sha256=' . $signature;
            }

            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);

            $statusText = $httpCode ?: 0;
            $respSummary = $curlError ? ('cURL Error: ' . $curlError) : substr((string)$response, 0, 500);

            // Update status webhook
            $this->CI->db->where('id', $wh['id'])->update('iku_webhooks', [
                'last_status' => $statusText,
                'last_response' => $respSummary,
                'last_triggered_at' => date('Y-m-d H:i:s')
            ]);

            $results[] = [
                'webhook_id' => $wh['id'],
                'url' => $wh['target_url'],
                'status' => $statusText,
                'response' => $respSummary
            ];
        }

        return $results;
    }

    /**
     * Melakukan HTTP request ke API Eksternal untuk mengimpor data
     */
    public function fetch_external_api($url, $method = 'GET', $authType = 'none', $token = '', $customHeaders = [], $body = null) {
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return [
                'success' => false,
                'message' => 'URL API tidak valid! Masukkan URL lengkap (misal: http:// atau https://)'
            ];
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_MAXREDIRS, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 8);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);

        $headers = [
            'Accept: application/json, text/plain, */*',
            'User-Agent: IPPD-IKU-Importer/1.0'
        ];

        if ($authType === 'bearer' && !empty($token)) {
            $headers[] = 'Authorization: Bearer ' . trim($token);
        } elseif ($authType === 'api_key' && !empty($token)) {
            $headers[] = 'X-API-KEY: ' . trim($token);
        } elseif ($authType === 'basic' && !empty($token)) {
            $headers[] = 'Authorization: Basic ' . base64_encode(trim($token));
        }

        if (!empty($customHeaders) && is_array($customHeaders)) {
            foreach ($customHeaders as $k => $v) {
                if (is_numeric($k)) {
                    $headers[] = $v;
                } else {
                    $headers[] = $k . ': ' . $v;
                }
            }
        }

        if (strtoupper($method) === 'POST') {
            curl_setopt($ch, CURLOPT_POST, TRUE);
            if (!empty($body)) {
                $headers[] = 'Content-Type: application/json';
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($body) ? json_encode($body) : $body);
            }
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($curlError) {
            return [
                'success' => false,
                'http_code' => $httpCode,
                'message' => 'Gagal terkoneksi ke API: ' . $curlError
            ];
        }

        if ($httpCode >= 400) {
            return [
                'success' => false,
                'http_code' => $httpCode,
                'message' => "Server eksternal mengembalikan HTTP Error: {$httpCode}",
                'raw_response' => substr((string)$response, 0, 500)
            ];
        }

        $decoded = json_decode($response, true);
        if ($decoded === null && json_last_error() !== JSON_ERROR_NONE) {
            return [
                'success' => false,
                'http_code' => $httpCode,
                'message' => 'Format respons dari API bukan JSON yang valid!',
                'raw_response' => substr((string)$response, 0, 300)
            ];
        }

        // Ekstraksi dan normalisasi struktur data IKU
        $normalized = $this->normalize_external_iku_data($decoded);

        return [
            'success' => true,
            'http_code' => $httpCode,
            'raw_decoded' => $decoded,
            'items' => $normalized['items'],
            'total_items' => count($normalized['items']),
            'detected_fields' => $normalized['detected_fields']
        ];
    }

    /**
     * Menormalkan struktur data IKU dari berbagai format respons API eksternal
     */
    public function normalize_external_iku_data($decoded) {
        $rawList = [];

        // 1. Cari array utama indikator
        if (is_array($decoded)) {
            if (isset($decoded['data']) && is_array($decoded['data'])) {
                $rawList = $decoded['data'];
            } elseif (isset($decoded['items']) && is_array($decoded['items'])) {
                $rawList = $decoded['items'];
            } elseif (isset($decoded['results']) && is_array($decoded['results'])) {
                $rawList = $decoded['results'];
            } elseif (isset($decoded['iku']) && is_array($decoded['iku'])) {
                $rawList = $decoded['iku'];
            } elseif (isset($decoded[0]) && is_array($decoded[0])) {
                $rawList = $decoded;
            } else {
                // Mungkin objek tunggal
                $rawList = [$decoded];
            }
        }

        $normalized = [];
        $allFields = [];

        foreach ($rawList as $item) {
            if (!is_array($item)) continue;

            $indikator = '';
            // Deteksi nama indikator
            foreach (['indikator_tujuan', 'indikator', 'nama_indikator', 'indicator', 'nama', 'title', 'uraian'] as $k) {
                if (!empty($item[$k])) {
                    $indikator = trim((string)$item[$k]);
                    break;
                }
            }

            if (empty($indikator)) continue;

            // Deteksi rumus
            $rumus = null;
            foreach (['rumus', 'formula', 'rumus_rpjmd', 'cara_perhitungan', 'metode_hitung'] as $k) {
                if (isset($item[$k]) && $item[$k] !== null && $item[$k] !== '') {
                    $rumus = trim((string)$item[$k]);
                    break;
                }
            }

            // Deteksi definisi operasional
            $definisi = null;
            foreach (['definisi_operasional', 'definisi', 'definition', 'penjelasan', 'deskripsi'] as $k) {
                if (isset($item[$k]) && $item[$k] !== null && $item[$k] !== '') {
                    $definisi = trim((string)$item[$k]);
                    break;
                }
            }

            // Deteksi tahun mulai / akhir
            $tahunMulai = null;
            foreach (['tahun_mulai', 'tahunMulai', 'start_year', 'tahun_awal', 'tahun_1'] as $k) {
                if (!empty($item[$k]) && is_numeric($item[$k])) {
                    $tahunMulai = (int)$item[$k];
                    break;
                }
            }

            $tahunAkhir = null;
            foreach (['tahun_akhir', 'tahunAkhir', 'end_year', 'tahun_selesai', 'tahun_5'] as $k) {
                if (!empty($item[$k]) && is_numeric($item[$k])) {
                    $tahunAkhir = (int)$item[$k];
                    break;
                }
            }

            // Deteksi target tahun 1 s.d. 5
            $cleanNum = function($v) {
                if ($v === null || $v === '' || $v === '-') return null;
                $str = str_replace(',', '.', trim((string)$v));
                return is_numeric($str) ? (float)$str : null;
            };

            $t1 = $cleanNum($item['target_1'] ?? $item['target_2025'] ?? $item['t1'] ?? ($item['targets'][0] ?? null));
            $t2 = $cleanNum($item['target_2'] ?? $item['target_2026'] ?? $item['t2'] ?? ($item['targets'][1] ?? null));
            $t3 = $cleanNum($item['target_3'] ?? $item['target_2027'] ?? $item['t3'] ?? ($item['targets'][2] ?? null));
            $t4 = $cleanNum($item['target_4'] ?? $item['target_2028'] ?? $item['t4'] ?? ($item['targets'][3] ?? null));
            $t5 = $cleanNum($item['target_5'] ?? $item['target_2029'] ?? $item['t5'] ?? ($item['targets'][4] ?? null));

            $normalized[] = [
                'indikator_tujuan' => $indikator,
                'rumus' => $rumus,
                'definisi_operasional' => $definisi,
                'tahun_mulai' => $tahunMulai,
                'tahun_akhir' => $tahunAkhir,
                'target_1' => $t1,
                'target_2' => $t2,
                'target_3' => $t3,
                'target_4' => $t4,
                'target_5' => $t5,
                'original_id' => $item['id'] ?? null
            ];

            foreach (array_keys($item) as $f) {
                if (!in_array($f, $allFields)) $allFields[] = $f;
            }
        }

        return [
            'items' => $normalized,
            'detected_fields' => $allFields
        ];
    }
}
