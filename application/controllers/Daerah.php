
        <?php
        defined('BASEPATH') OR exit('No direct script access allowed');

        class Daerah extends CI_Controller {
            
            public function __construct() {
                parent::__construct();
            // if (!isset($_SESSION['KodeWilayah'])) {
            //   redirect(base_url());
            // }
            date_default_timezone_set("Asia/Jakarta");
        }

        public function SetTempKodeWilayah() {
            // Ambil KodeWilayah dari POST
            $kodeWilayah = $this->input->post('KodeWilayah', TRUE);
            
            if ($kodeWilayah && $this->db->where('Kode', $kodeWilayah)->get('kodewilayah')->num_rows() > 0) {
                // Simpan ke session
                $this->session->set_userdata('TempKodeWilayah', $kodeWilayah);
                // Kembalikan response sukses
                echo 'success';
            } else {
                echo 'error';
            }
        }

        public function GetVisiRPJPDP(){
            echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjpdp as v, misirpjpdp as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
            }

        public function GetVisiRPJPN(){
            echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjpn as v, misirpjpn as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
            }

        public function GetVisiRPJPD()
        {
            if (!$this->input->is_ajax_request()) show_404();

            $id = (int) $this->input->post('Id', true);

            // Ambil kode wilayah aktif
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');

            if (!$kodeWilayah) {
                echo json_encode([]);
                return;
            }

            // Cari visi berdasarkan wilayah dan periode Id
            $data = $this->db
                ->where('KodeWilayah', $kodeWilayah)
                ->where('Id', $id)
                ->where('deleted_at IS NULL', null, false)
                ->get('visirpjpd')
                ->result_array();

            echo json_encode($data);
        }


        public function GetListProvinsi() {
                echo json_encode($this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array());
            }

            // Fungsi untuk mendapatkan daftar kabupaten/kota berdasarkan kode provinsi
            public function GetListKabKota() {
                $kode_provinsi = $this->input->post('Kode', TRUE);
                echo json_encode($this->db->where("Kode LIKE '$kode_provinsi.__'")
                                        ->where('LENGTH(REPLACE(Kode, ".", "")) = 4')
                                        ->order_by('Nama')
                                        ->get('kodewilayah')
                                        ->result_array());
            }

                // ============================================================
            // METHOD UNTUK MENDAPATKAN DATA VISI VIA AJAX
            // ============================================================

            // Tambahkan method ini di dalam class Daerah, setelah __construct()
        private function _checkSessionWilayah() {
        $kodeWilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');
        
        if (empty($kodeWilayah)) {
            // KIRIM RESPONSE JSON UNTUK AJAX
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return false;
            }
            return false;
        }
        return $kodeWilayah;
    }

            /**
             * Get Visi RPJPDP (Provinsi) berdasarkan periode
             * Menampilkan SEMUA visi yang memiliki periode yang sama
             */
            public function GetVisiRPJPDPByPeriode() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $periodeId = (int)$this->input->post('Id', TRUE);
                if ($periodeId <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                // STEP 1: Ambil informasi periode dari ID yang dipilih
                $periodeInfo = $this->db->query("
                    SELECT TahunMulai, TahunAkhir
                    FROM visirpjpdp
                    WHERE Id = ?
                    AND deleted_at IS NULL
                ", array($periodeId))->row_array();
                
                if (!$periodeInfo) {
                    echo json_encode([]);
                    return;
                }
                
                // STEP 2: Ambil SEMUA visi dengan periode yang sama
                $query = $this->db->query("
                    SELECT Id, Visi, TahunMulai, TahunAkhir
                    FROM visirpjpdp
                    WHERE TahunMulai = ? 
                    AND TahunAkhir = ?
                    AND deleted_at IS NULL
                    ORDER BY Id ASC
                ", array($periodeInfo['TahunMulai'], $periodeInfo['TahunAkhir']));
                
                $result = $query->result_array();
                
                // Jika tidak ada hasil, coba ambil berdasarkan ID (fallback)
                if (empty($result)) {
                    $query2 = $this->db->query("
                        SELECT Id, Visi, TahunMulai, TahunAkhir
                        FROM visirpjpdp
                        WHERE Id = ?
                        AND deleted_at IS NULL
                    ", array($periodeId));
                    $result = $query2->result_array();
                }
                
                echo json_encode($result);
            }

            /**
             * Get Visi RPJPN (Nasional) berdasarkan periode
             * Menampilkan SEMUA visi yang memiliki periode yang sama
             */
            public function GetVisiRPJPNByPeriode() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $periodeId = (int)$this->input->post('Id', TRUE);
                if ($periodeId <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                // STEP 1: Ambil informasi periode dari ID yang dipilih
                $periodeInfo = $this->db->query("
                    SELECT TahunMulai, TahunAkhir
                    FROM visirpjpn
                    WHERE Id = ?
                    AND deleted_at IS NULL
                ", array($periodeId))->row_array();
                
                if (!$periodeInfo) {
                    echo json_encode([]);
                    return;
                }
                
                // STEP 2: Ambil SEMUA visi dengan periode yang sama
                $query = $this->db->query("
                    SELECT Id, Visi, TahunMulai, TahunAkhir
                    FROM visirpjpn
                    WHERE TahunMulai = ? 
                    AND TahunAkhir = ?
                    AND deleted_at IS NULL
                    ORDER BY Id ASC
                ", array($periodeInfo['TahunMulai'], $periodeInfo['TahunAkhir']));
                
                $result = $query->result_array();
                
                if (empty($result)) {
                    $query2 = $this->db->query("
                        SELECT Id, Visi, TahunMulai, TahunAkhir
                        FROM visirpjpn
                        WHERE Id = ?
                        AND deleted_at IS NULL
                    ", array($periodeId));
                    $result = $query2->result_array();
                }
                
                echo json_encode($result);
            }

            /**
             * Get Visi RPJPDP berdasarkan ID (untuk edit)
             */
            public function GetVisiRPJPDPById() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $visiId = (int)$this->input->post('visi_id', TRUE);
                if ($visiId <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                $query = $this->db->query("
                    SELECT Id, Visi, TahunMulai, TahunAkhir
                    FROM visirpjpdp
                    WHERE Id = ?
                    AND deleted_at IS NULL
                ", array($visiId));
                
                echo json_encode($query->result_array());
            }

            /**
             * Get Visi RPJPN berdasarkan ID (untuk edit)
             */
            public function GetVisiRPJPNById() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $visiId = (int)$this->input->post('visi_id', TRUE);
                if ($visiId <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                $query = $this->db->query("
                    SELECT Id, Visi, TahunMulai, TahunAkhir
                    FROM visirpjpn
                    WHERE Id = ?
                    AND deleted_at IS NULL
                ", array($visiId));
                
                echo json_encode($query->result_array());
            }

            /**
             * Get periode RPJPDP berdasarkan visi ID (untuk edit)
             */
            public function GetPeriodeRPJPDPByVisiId() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $visiId = (int)$this->input->post('visi_id', TRUE);
                if ($visiId <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                // Cari periode dari visirpjpdp berdasarkan ID
                $query = $this->db->query("
                    SELECT Id, TahunMulai, TahunAkhir
                    FROM visirpjpdp
                    WHERE Id = ?
                    AND deleted_at IS NULL
                ", array($visiId));
                
                $result = $query->result_array();
                
                // Jika tidak ditemukan, coba cari di visirpjpd sebagai referensi
                if (empty($result)) {
                    $check = $this->db->query("
                        SELECT visi_rpjpdp 
                        FROM visirpjpd 
                        WHERE visi_rpjpdp = ? 
                        AND deleted_at IS NULL
                        LIMIT 1
                    ", array($visiId))->row_array();
                    
                    if (!empty($check)) {
                        $query2 = $this->db->query("
                            SELECT Id, TahunMulai, TahunAkhir
                            FROM visirpjpdp
                            WHERE Id = ?
                            AND deleted_at IS NULL
                        ", array($visiId));
                        $result = $query2->result_array();
                    }
                }
                
                echo json_encode($result);
            }

            /**
             * Get periode RPJPN berdasarkan visi ID (untuk edit)
             */
            public function GetPeriodeRPJPNByVisiId() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $visiId = (int)$this->input->post('visi_id', TRUE);
                if ($visiId <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                $query = $this->db->query("
                    SELECT Id, TahunMulai, TahunAkhir
                    FROM visirpjpn
                    WHERE Id = ?
                    AND deleted_at IS NULL
                ", array($visiId));
                
                $result = $query->result_array();
                
                if (empty($result)) {
                    $check = $this->db->query("
                        SELECT visi_rpjpn 
                        FROM visirpjpd 
                        WHERE visi_rpjpn = ? 
                        AND deleted_at IS NULL
                        LIMIT 1
                    ", array($visiId))->row_array();
                    
                    if (!empty($check)) {
                        $query2 = $this->db->query("
                            SELECT Id, TahunMulai, TahunAkhir
                            FROM visirpjpn
                            WHERE Id = ?
                            AND deleted_at IS NULL
                        ", array($visiId));
                        $result = $query2->result_array();
                    }
                }
                
                echo json_encode($result);
            }

            // ============================================================
            // VISI RPJPD
            // ============================================================
            public function VisiRPJPD() {
                $Header['Halaman'] = 'RPJPD';
                
                // Data Provinsi untuk filter
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

                // Tentukan KodeWilayah
                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : $this->input->get('KodeWilayah', TRUE));

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                // Simpan KodeWilayah ke sesi sementara jika belum login
                if (!isset($_SESSION['KodeWilayah']) && $KodeWilayah) {
                    $this->session->set_userdata('TempKodeWilayah', $KodeWilayah);
                }

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        
                        // Data Visi RPJPD (lokal)
                        $Data['Visi'] = $this->db->select('v.*, k.Nama')
                            ->from('visirpjpd v')
                            ->join('kodewilayah k', 'v.KodeWilayah = k.Kode', 'left')
                            ->where('v.KodeWilayah', $KodeWilayah)
                            ->where('v.deleted_at IS NULL')
                            ->get()->result_array();
                        
                        // Data periode untuk dropdown referensi
                        $kodeProvinsi = substr($KodeWilayah, 0, 2);
                        
                        // Periode RPJPDP (Provinsi)
                        $Data['PeriodeRPJPDP'] = $this->db->query("
                            SELECT Id, TahunMulai, TahunAkhir
                            FROM visirpjpdp
                            WHERE KodeWilayah = ?
                            AND deleted_at IS NULL
                            ORDER BY TahunMulai DESC
                        ", array($kodeProvinsi))->result_array();
                        
                        // Periode RPJPN (Nasional)
                        $Data['PeriodeRPJPN'] = $this->db->query("
                            SELECT Id, TahunMulai, TahunAkhir
                            FROM visirpjpn
                            WHERE deleted_at IS NULL
                            ORDER BY TahunMulai DESC
                        ")->result_array();
                            
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['Visi'] = [];
                        $Data['PeriodeRPJPDP'] = [];
                        $Data['PeriodeRPJPN'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['Visi'] = [];
                    $Data['PeriodeRPJPDP'] = [];
                    $Data['PeriodeRPJPN'] = [];
                }

                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/VisiRPJPD', $Data);
            }

            // ============================================================
            // CRUD VISI RPJPD
            // ============================================================
            // ============================================================
        // CRUD VISI RPJPD - DENGAN DUKUNGAN MULTI-PILIH
        // ============================================================
        public function InputVisiRPJPD() {
            if (!isset($_SESSION['KodeWilayah']) || empty($_SESSION['KodeWilayah'])) {
                echo 'Session KodeWilayah tidak ditemukan!';
                return;
            }
            
            $visi = trim($this->input->post('Visi', TRUE));
            $tahunMulai = $this->input->post('TahunMulai', TRUE);
            $tahunAkhir = $this->input->post('TahunAkhir', TRUE);
            $visiRPJPDP = $this->input->post('visi_rpjpdp', TRUE); // Bisa berupa array
            $visiRPJPN = $this->input->post('visi_rpjpn', TRUE); // Bisa berupa array
            
            // Validasi
            if (empty($visi)) {
                echo 'Visi harus diisi!';
                return;
            }
            if (!is_numeric($tahunMulai) || strlen($tahunMulai) != 4) {
                echo 'Tahun Mulai tidak valid!';
                return;
            }
            if (!is_numeric($tahunAkhir) || strlen($tahunAkhir) != 4) {
                echo 'Tahun Akhir tidak valid!';
                return;
            }
            if ($tahunMulai >= $tahunAkhir) {
                echo 'Tahun Mulai harus lebih kecil dari Tahun Akhir!';
                return;
            }
            
            // KONVERSI KE FORMAT && UNTUK MULTI-PILIH
            $visiRPJPDPValue = $this->convertToMultipleFormat($visiRPJPDP);
            $visiRPJPNValue = $this->convertToMultipleFormat($visiRPJPN);
            
            $data = [
                'KodeWilayah' => $_SESSION['KodeWilayah'],
                'Visi' => $visi,
                'TahunMulai' => $tahunMulai,
                'TahunAkhir' => $tahunAkhir,
                'visi_rpjpdp' => $visiRPJPDPValue,
                'visi_rpjpn' => $visiRPJPNValue,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('visirpjpd', $data);
            echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
        }

        public function EditVisiRPJPD() {
            try {
                if (!isset($_SESSION['KodeWilayah']) || empty($_SESSION['KodeWilayah'])) {
                    throw new Exception('Session KodeWilayah tidak ditemukan!');
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $visi = trim($this->input->post('Visi', TRUE));
                $tahunMulai = $this->input->post('TahunMulai', TRUE);
                $tahunAkhir = $this->input->post('TahunAkhir', TRUE);
                $visiRPJPDP = $this->input->post('visi_rpjpdp', TRUE);
                $visiRPJPN = $this->input->post('visi_rpjpn', TRUE);
                
                if ($id <= 0) throw new Exception('ID tidak valid');
                if (empty($visi)) throw new Exception('Visi harus diisi');
                if (!is_numeric($tahunMulai) || strlen($tahunMulai) != 4) throw new Exception('Tahun Mulai tidak valid');
                if (!is_numeric($tahunAkhir) || strlen($tahunAkhir) != 4) throw new Exception('Tahun Akhir tidak valid');
                if ($tahunMulai >= $tahunAkhir) throw new Exception('Tahun Mulai harus lebih kecil dari Tahun Akhir');

                $existing = $this->db->where('Id', $id)
                    ->where('KodeWilayah', $_SESSION['KodeWilayah'])
                    ->where('deleted_at IS NULL')
                    ->get('visirpjpd')->row_array();
                    
                if (!$existing) throw new Exception('Data Visi tidak ditemukan');

                // KONVERSI KE FORMAT && UNTUK MULTI-PILIH
                $visiRPJPDPValue = $this->convertToMultipleFormat($visiRPJPDP);
                $visiRPJPNValue = $this->convertToMultipleFormat($visiRPJPN);

                $data = [
                    'Visi' => $visi,
                    'TahunMulai' => $tahunMulai,
                    'TahunAkhir' => $tahunAkhir,
                    'visi_rpjpdp' => $visiRPJPDPValue,
                    'visi_rpjpn' => $visiRPJPNValue,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->db->where('Id', $id);
                $this->db->update('visirpjpd', $data);

                echo '1';
                
            } catch (Exception $e) {
                log_message('error', 'Error editing Visi RPJPD: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        /**
         * Helper function untuk konversi ke format multiple dengan separator &&
         * @param mixed $data Array atau string
         * @return string Format: "id1&&id2&&id3"
         */
        private function convertToMultipleFormat($data) {
            if (empty($data)) {
                return '';
            }
            
            if (is_array($data)) {
                // Filter nilai kosong dan valid
                $filtered = array_filter($data, function($val) {
                    return !empty($val) && $val !== '0' && $val !== 'null' && $val !== 'undefined';
                });
                return implode('&&', $filtered);
            }
            
            // Jika sudah string, cek apakah sudah dalam format multiple
            if (strpos($data, '&&') !== false) {
                return $data;
            }
            
            // Single value
            return $data;
        }

        /**
         * Helper function untuk mengubah format && menjadi array
         */
        private function parseMultipleFormat($data) {
            if (empty($data)) {
                return [];
            }
            return explode('&&', $data);
        }

        /**
         * Get detail visi untuk ditampilkan di tabel (nama visi)
         */
        public function GetVisiNamesByIds() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $visiIds = $this->input->post('visi_ids', TRUE);
            $type = $this->input->post('type', TRUE); // 'rpjpdp' atau 'rpjpn'
            
            if (empty($visiIds)) {
                echo json_encode([]);
                return;
            }
            
            // Parse format && menjadi array
            $ids = explode('&&', $visiIds);
            $ids = array_filter($ids, function($id) {
                return !empty($id) && is_numeric($id);
            });
            
            if (empty($ids)) {
                echo json_encode([]);
                return;
            }
            
            // Tentukan tabel berdasarkan type
            $table = ($type === 'rpjpdp') ? 'visirpjpdp' : 'visirpjpn';
            
            $this->db->select('Id, Visi');
            $this->db->where_in('Id', $ids);
            $this->db->where('deleted_at IS NULL');
            $query = $this->db->get($table);
            
            echo json_encode($query->result_array());
        }

            public function HapusVisiRPJPD() {
                if (!isset($_SESSION['KodeWilayah']) || empty($_SESSION['KodeWilayah'])) {
                    echo 'Session KodeWilayah tidak ditemukan!';
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                if ($id <= 0) {
                    echo 'ID tidak valid!';
                    return;
                }
                
                $this->db->where('Id', $id);
                $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
                $this->db->update('visirpjpd', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                
                echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
            }

        public function GetMisiRPJPDP(){
            echo json_encode($this->db->query("
                SELECT DISTINCT * 
                FROM misirpjpdp 
                WHERE KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." 
                AND _Id = ".$_POST['Id']." 
                AND deleted_at IS NULL
                GROUP BY Misi
            ")->result_array());
        }

        public function GetMisiRPJPN(){
            echo json_encode($this->db->query("
                SELECT DISTINCT v.*, m.* 
                FROM visirpjpn as v, misirpjpn as m 
                WHERE m._Id = ".$_POST['Id']." 
                AND m.deleted_at IS NULL
                GROUP BY m.Misi
            ")->result_array());
        }

        public function GetPeriodeMisiRPJPD(){
            echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpd")->result_array());
            }

        public function GetMisiRPJPD(){
            echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpd")->result_array());
            }

        public function MisiRPJPD() {
            $Header['Halaman'] = 'RPJPD';
            // Ambil data provinsi
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

            // Tentukan KodeWilayah
            $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

            log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

            if ($KodeWilayah) {
                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                if ($wilayah) {
                    $Data['KodeWilayah'] = $KodeWilayah;
                    $Data['NamaWilayah'] = $wilayah['Nama'];
                    $Data['VisiRPJPDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                        ->where('deleted_at IS NULL')
                        ->get('visirpjpdp')->result_array();
                    $Data['VisiRPJPN'] = $this->db->where('deleted_at IS NULL')
                        ->get('visirpjpn')->result_array();
                    $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('visirpjpd')->result_array();
                    $Data['Misi'] = $this->db->select('v.*, m.*')
                        ->from('visirpjpd v')
                        ->join('misirpjpd m', 'm._Id = v.Id')
                        ->where('m.KodeWilayah', $KodeWilayah)
                        ->where('m.deleted_at IS NULL')
                        ->get()->result_array();
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['VisiRPJPDP'] = [];
                    $Data['VisiRPJPN'] = [];
                    $Data['Visi'] = [];
                    $Data['Misi'] = [];
                    log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                }
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['VisiRPJPDP'] = [];
                $Data['VisiRPJPN'] = [];
                $Data['Visi'] = [];
                $Data['Misi'] = [];
            }

            // Debugging: Log jumlah provinsi
            log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));

            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/MisiRPJPD', $Data);
        }

        public function InputMisiRPJPD(){  
            try {
                $visiId = (int)$this->input->post('_Id', TRUE);
                $misi = trim($this->input->post('Misi', TRUE));
                
                // Ambil data dengan nama field yang berbeda
                $rpjpn = $this->input->post('rpjpn', TRUE);
                $rpjpdp = $this->input->post('rpjpdp', TRUE);
                
                if ($visiId <= 0) throw new Exception('Visi harus dipilih');
                if (empty($misi)) throw new Exception('Misi harus diisi');
                
                $rpjpnValue = is_array($rpjpn) ? implode('$', $rpjpn) : $rpjpn;
                $rpjpdpValue = is_array($rpjpdp) ? implode('$', $rpjpdp) : $rpjpdp;
                
                $data = [
                    'KodeWilayah' => $_SESSION['KodeWilayah'],
                    '_Id' => $visiId,
                    'Misi' => $misi,
                    'rpjpn' => $rpjpnValue,
                    'rpjpdp' => $rpjpdpValue,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('misirpjpd', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo '1';
                } else {
                    echo 'Gagal Menyimpan Data!';
                }
                
            } catch (Exception $e) {
                log_message('error', 'Error InputMisiRPJPD: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }
            
            public function EditMisiRPJPD(){  
            try {
                $id = (int)$this->input->post('Id', TRUE);
                $visiId = (int)$this->input->post('_Id', TRUE);
                $misi = trim($this->input->post('Misi', TRUE));
                
                // Ambil data RPJPN dan RPJPDP dengan nama field berbeda
                $rpjpn = $this->input->post('rpjpn', TRUE);
                $rpjpdp = $this->input->post('rpjpdp', TRUE);
                
                // Validasi
                if ($id <= 0) throw new Exception('ID tidak valid');
                if ($visiId <= 0) throw new Exception('Visi harus dipilih');
                if (empty($misi)) throw new Exception('Misi harus diisi');
                
                // Pastikan data ada dan sesuai wilayah
                $existing = $this->db
                    ->where('Id', $id)
                    ->where('KodeWilayah', $_SESSION['KodeWilayah'])
                    ->where('deleted_at IS NULL')
                    ->get('misirpjpd')
                    ->row_array();
                    
                if (!$existing) {
                    throw new Exception('Data tidak ditemukan');
                }
                
                // Konversi array ke string dengan separator
                $rpjpnValue = is_array($rpjpn) ? implode('$', $rpjpn) : $rpjpn;
                $rpjpdpValue = is_array($rpjpdp) ? implode('$', $rpjpdp) : $rpjpdp;
                
                $data = [
                    '_Id' => $visiId,
                    'Misi' => $misi,
                    'rpjpn' => $rpjpnValue,    // Field terpisah untuk RPJPN
                    'rpjpdp' => $rpjpdpValue,  // Field terpisah untuk RPJPDP
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('Id', $id);
                $this->db->update('misirpjpd', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo '1';
                } else {
                    echo 'Tidak ada perubahan data';
                }
                
            } catch (Exception $e) {
                log_message('error', 'Error EditMisiRPJPD: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        public function HapusMisiRPJPD(){  
                $_POST['deleted_at'] = date('Y-m-d H:i:s');
                $this->db->where('Id',$_POST['Id'])->update('misirpjpd', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Hapus Data!';
            }
        }

        public function GetTujuanRPJPDP(){
            echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("tujuanrpjpdp")->result_array());
            }

        public function GetTujuanRPJPN(){
            echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, misirpjpn as m, tujuanrpjpn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
            }

        public function GetPeriodeTujuanRPJPD(){
            echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
            }

        public function GetTujuanRPJPD(){
            echo json_encode($this->db->query("SELECT t.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
            }

        public function TujuanRPJPD() {
                $Header['Halaman'] = 'RPJPD';

            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        $Data['VisiRPJPDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                            ->where('deleted_at IS NULL')
                            ->get('visirpjpdp')->result_array();
                        $Data['VisiRPJPN'] = $this->db->where('deleted_at IS NULL')
                            ->get('visirpjpn')->result_array();
                        $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->get('visirpjpd')->result_array();
                        $Data['Tujuan'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, m.Id as IdMisi, m.Misi, t.*')
                            ->from('visirpjpd v')
                            ->join('misirpjpd m', 'm._Id = v.Id')
                            ->join('tujuanrpjpd t', 't._Id = m.Id')
                            ->where('t.KodeWilayah', $KodeWilayah)
                            ->where('t.deleted_at IS NULL')
                            ->get()->result_array();
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['VisiRPJPDP'] = [];
                        $Data['VisiRPJPN'] = [];
                        $Data['Visi'] = [];
                        $Data['Tujuan'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['VisiRPJPDP'] = [];
                    $Data['VisiRPJPN'] = [];
                    $Data['Visi'] = [];
                    $Data['Tujuan'] = [];
                }

            log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));

                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/TujuanRPJPD', $Data);
            }

        public function InputTujuanRPJPD(){  
            $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
            $this->db->insert('tujuanrpjpd',$_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Menyimpan Data!';
            }
            }
            
            public function EditTujuanRPJPD(){  
                $this->db->where('Id',$_POST['Id']); 
                $this->db->update('tujuanrpjpd', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Update Data!';
            }
        }

        public function HapusTujuanRPJPD(){  
                $_POST['deleted_at'] = date('Y-m-d H:i:s');
                $this->db->where('Id',$_POST['Id'])->update('tujuanrpjpd', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Hapus Data!';
            }
        }

        public function GetSasaranRPJPDP(){
            echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("sasaranrpjpdp")->result_array());
            }

        public function GetSasaranRPJPN(){
            echo json_encode($this->db->query("SELECT s.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t, sasaranrpjpn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array());
            }

        public function GetPeriodeSasaranRPJPD(){
            echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
            }

        public function GetSasaranRPJPD(){
            echo json_encode($this->db->query("SELECT t.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
            }

        public function SasaranRPJPD() {
                $Header['Halaman'] = 'RPJPD';

            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array(); 

                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        $Data['VisiRPJPDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                            ->where('deleted_at IS NULL')
                            ->get('visirpjpdp')->result_array();
                        $Data['VisiRPJPN'] = $this->db->where('deleted_at IS NULL')
                            ->get('visirpjpn')->result_array();
                        $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->get('visirpjpd')->result_array();
                        $Data['Sasaran'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, t.Id as IdTujuan, t.Tujuan, s.*')
                            ->from('visirpjpd v')
                            ->join('misirpjpd m', 'm._Id = v.Id')
                            ->join('tujuanrpjpd t', 't._Id = m.Id')
                            ->join('sasaranrpjpd s', 's._Id = t.Id')
                            ->where('s.KodeWilayah', $KodeWilayah)
                            ->where('s.deleted_at IS NULL')
                            ->get()->result_array();
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['VisiRPJPDP'] = [];
                        $Data['VisiRPJPN'] = [];
                        $Data['Visi'] = [];
                        $Data['Sasaran'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['VisiRPJPDP'] = [];
                    $Data['VisiRPJPN'] = [];
                    $Data['Visi'] = [];
                    $Data['Sasaran'] = [];
                }

            log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));

                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/SasaranRPJPD', $Data);
            }

        public function InputSasaranRPJPD(){  
            $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
            $this->db->insert('sasaranrpjpd',$_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Menyimpan Data!';
            }
            }
            
            public function EditSasaranRPJPD(){  
                $this->db->where('Id',$_POST['Id']); 
                $this->db->update('sasaranrpjpd', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Update Data!';
            }
        }

        public function HapusSasaranRPJPD(){  
                $_POST['deleted_at'] = date('Y-m-d H:i:s');
                $this->db->where('Id',$_POST['Id'])->update('sasaranrpjpd', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Hapus Data!';
            }
        }

        // ============================================================
            // TAHAPAN ARAH KEBIJAKAN - MAIN PAGE
            // ============================================================
            public function TahapanArahKebijakan() {
                $Header['Halaman'] = 'Tahapan Arah Kebijakan';
                
                // Ambil daftar provinsi untuk filter
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                // Tentukan KodeWilayah
                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima untuk Tahapan Arah Kebijakan: ' . $KodeWilayah);

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        
                        // =============================================
                        // PERBAIKAN: Ambil periode yang memiliki misi
                        // =============================================
                        // METHOD 1: Menggunakan distinct() (REKOMENDASI)
                        $Data['PeriodeList'] = $this->db
                            ->distinct()
                            ->select('v.Id, v.TahunMulai, v.TahunAkhir, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode')
                            ->from('visirpjpd v')
                            ->join('misirpjpd m', 'm._Id = v.Id AND m.KodeWilayah = v.KodeWilayah', 'inner')
                            ->where('v.KodeWilayah', $KodeWilayah)
                            ->where('v.deleted_at IS NULL')
                            ->where('m.deleted_at IS NULL')
                            ->order_by('v.TahunMulai', 'ASC')
                            ->get()
                            ->result_array();
                        
                        // =============================================
                        // Ambil data Misi
                        // =============================================
                        $Data['Misi'] = $this->db
                            ->select('m.*, v.TahunMulai as VisiTahunMulai, v.TahunAkhir as VisiTahunAkhir, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode')
                            ->from('misirpjpd m')
                            ->join('visirpjpd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                            ->where('m.KodeWilayah', $KodeWilayah)
                            ->where('m.deleted_at IS NULL')
                            ->where('v.deleted_at IS NULL')
                            ->order_by('v.TahunMulai', 'ASC')
                            ->order_by('m.Id', 'ASC')
                            ->get()
                            ->result_array();
                        
                        // =============================================
                        // Ambil data Tahapan Arah Kebijakan
                        // =============================================
                        $Data['TahapanArahKebijakan'] = $this->db
                            ->select('t.*, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode')
                            ->from('tahapan_arah_kebijakan t')
                            ->join('misirpjpd m', 'm.Id = t.IdMisi AND m.KodeWilayah = t.KodeWilayah', 'inner')
                            ->join('visirpjpd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                            ->where('t.KodeWilayah', $KodeWilayah)
                            ->where('t.deleted_at IS NULL')
                            ->where('m.deleted_at IS NULL')
                            ->where('v.deleted_at IS NULL')
                            ->order_by('t.IdMisi', 'ASC')
                            ->get()
                            ->result_array();
                            
                        // Group by IdMisi untuk memudahkan di view
                        $Data['TahapanGrouped'] = [];
                        foreach ($Data['TahapanArahKebijakan'] as $row) {
                            $Data['TahapanGrouped'][$row['IdMisi']][] = $row;
                        }
                        
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['Misi'] = [];
                        $Data['TahapanArahKebijakan'] = [];
                        $Data['TahapanGrouped'] = [];
                        $Data['PeriodeList'] = [];
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['Misi'] = [];
                    $Data['TahapanArahKebijakan'] = [];
                    $Data['TahapanGrouped'] = [];
                    $Data['PeriodeList'] = [];
                }

                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/TahapanArahKebijakan', $Data);
            }

            // ============================================================
            // GET MISI BY PERIODE (AJAX)
            // ============================================================
            public function GetMisiByPeriodeArahKebijakan() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $periodeId = (int)$this->input->post('Id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if ($periodeId <= 0 || empty($kodeWilayah)) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil misi berdasarkan visi
                $misi = $this->db
                    ->select('m.Id, m.Misi, v.Id as VisiId, v.TahunMulai, v.TahunAkhir, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode')
                    ->from('misirpjpd m')
                    ->join('visirpjpd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                    ->where('m.KodeWilayah', $kodeWilayah)
                    ->where('m._Id', $periodeId)
                    ->where('m.deleted_at IS NULL')
                    ->where('v.deleted_at IS NULL')
                    ->order_by('m.Id', 'ASC')
                    ->get()
                    ->result_array();
                
                // Cek apakah sudah ada data untuk setiap misi
                foreach ($misi as &$row) {
                    $exists = $this->db
                        ->where('IdMisi', $row['Id'])
                        ->where('KodeWilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('tahapan_arah_kebijakan')
                        ->num_rows();
                    $row['hasData'] = $exists > 0;
                }
                
                echo json_encode($misi);
            }

            // ============================================================
            // GET TAHAPAN BY ID (AJAX)
            // ============================================================
            public function GetTahapanArahKebijakanById() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah) || $id <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                $data = $this->db
                    ->select('t.*, m._Id as visi_id')
                    ->from('tahapan_arah_kebijakan t')
                    ->join('misirpjpd m', 'm.Id = t.IdMisi', 'left')
                    ->where('t.Id', $id)
                    ->where('t.KodeWilayah', $kodeWilayah)
                    ->where('t.deleted_at IS NULL')
                    ->get()
                    ->row_array();
                
                echo json_encode($data);
            }

            // ============================================================
        // CRUD: INPUT TAHAPAN
        // ============================================================
        public function InputTahapanArahKebijakan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $idMisi = (int)$this->input->post('IdMisi', TRUE);
            $tahapan = $this->input->post('tahapan', TRUE);
            
            if ($idMisi <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Misi harus dipilih!']);
                return;
            }
            
            // Validasi misi exists
            $misiExists = $this->db->where('Id', $idMisi)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('misirpjpd')
                ->num_rows();
            
            if (!$misiExists) {
                echo json_encode(['status' => 'error', 'message' => 'Misi tidak ditemukan!']);
                return;
            }
            
            // Ambil misi untuk mendapatkan nama misi
            $misi = $this->db->select('m.*, v.TahunMulai, v.TahunAkhir')
                ->from('misirpjpd m')
                ->join('visirpjpd v', 'v.Id = m._Id')
                ->where('m.Id', $idMisi)
                ->where('m.KodeWilayah', $kodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if (!$misi) {
                echo json_encode(['status' => 'error', 'message' => 'Data Misi tidak ditemukan!']);
                return;
            }
            
            // Cek apakah sudah ada data untuk misi ini
            $existing = $this->db->where('IdMisi', $idMisi)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('tahapan_arah_kebijakan')
                ->num_rows();
            
            if ($existing > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Data untuk Misi ini sudah ada! Gunakan Edit untuk mengubah.']);
                return;
            }
            
            // TAHAPAN OPSIONAL: Boleh kosong
            $data = [
                'KodeWilayah' => $kodeWilayah,
                'IdMisi' => $idMisi,
                'Misi' => $misi['Misi'],
                'tahap_1' => isset($tahapan[0]) && !empty(trim($tahapan[0])) ? trim($tahapan[0]) : null,
                'tahap_2' => isset($tahapan[1]) && !empty(trim($tahapan[1])) ? trim($tahapan[1]) : null,
                'tahap_3' => isset($tahapan[2]) && !empty(trim($tahapan[2])) ? trim($tahapan[2]) : null,
                'tahap_4' => isset($tahapan[3]) && !empty(trim($tahapan[3])) ? trim($tahapan[3]) : null,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('tahapan_arah_kebijakan', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

        // ============================================================
        // CRUD: EDIT TAHAPAN
        // ============================================================
        public function EditTahapanArahKebijakan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $idMisi = (int)$this->input->post('IdMisi', TRUE);
            $tahapan = $this->input->post('tahapan', TRUE);
            
            if ($idMisi <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Misi harus dipilih!']);
                return;
            }
            
            // Ambil misi untuk mendapatkan nama misi
            $misi = $this->db->select('Misi')
                ->from('misirpjpd')
                ->where('Id', $idMisi)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if (!$misi) {
                echo json_encode(['status' => 'error', 'message' => 'Misi tidak ditemukan!']);
                return;
            }
            
            // TAHAPAN OPSIONAL: Boleh kosong
            $data = [
                'IdMisi' => $idMisi,
                'Misi' => $misi['Misi'],
                'tahap_1' => isset($tahapan[0]) && !empty(trim($tahapan[0])) ? trim($tahapan[0]) : null,
                'tahap_2' => isset($tahapan[1]) && !empty(trim($tahapan[1])) ? trim($tahapan[1]) : null,
                'tahap_3' => isset($tahapan[2]) && !empty(trim($tahapan[2])) ? trim($tahapan[2]) : null,
                'tahap_4' => isset($tahapan[3]) && !empty(trim($tahapan[3])) ? trim($tahapan[3]) : null,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('Id', $id)
                ->where('KodeWilayah', $kodeWilayah)
                ->update('tahapan_arah_kebijakan', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal update data!']);
            }
        }

        // ============================================================
        // CRUD: HAPUS TAHAPAN
        // ============================================================
        public function HapusTahapanArahKebijakan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            if (empty($kodeWilayah) || $id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                return;
            }
            
            $this->db->where('Id', $id)
                ->where('KodeWilayah', $kodeWilayah)
                ->update('tahapan_arah_kebijakan', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
            }
        }

        // ============================================================
            // SASARAN POKOK - MAIN PAGE
            // ============================================================
            public function SasaranPokok() {
                $Header['Halaman'] = 'Sasaran Pokok dan IUP';
                
                // Ambil daftar provinsi untuk filter
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                // Tentukan KodeWilayah
                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        
                        // Ambil periode yang memiliki misi
                        $Data['PeriodeList'] = $this->db
                            ->distinct()
                            ->select('v.Id, v.TahunMulai, v.TahunAkhir, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode')
                            ->from('visirpjpd v')
                            ->join('misirpjpd m', 'm._Id = v.Id AND m.KodeWilayah = v.KodeWilayah', 'inner')
                            ->where('v.KodeWilayah', $KodeWilayah)
                            ->where('v.deleted_at IS NULL')
                            ->where('m.deleted_at IS NULL')
                            ->order_by('v.TahunMulai', 'ASC')
                            ->get()
                            ->result_array();
                        
                        // Ambil data Misi
                        $Data['Misi'] = $this->db
                            ->select('m.*, v.TahunMulai as VisiTahunMulai, v.TahunAkhir as VisiTahunAkhir, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode')
                            ->from('misirpjpd m')
                            ->join('visirpjpd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                            ->where('m.KodeWilayah', $KodeWilayah)
                            ->where('m.deleted_at IS NULL')
                            ->where('v.deleted_at IS NULL')
                            ->order_by('v.TahunMulai', 'ASC')
                            ->order_by('m.Id', 'ASC')
                            ->get()
                            ->result_array();
                        
                        // Ambil data Sasaran Pokok dengan informasi misi dan periode
                        $Data['SasaranPokok'] = $this->db
                            ->select('sp.*, m.Misi, m._Id as VisiId, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode')
                            ->from('sasaran_pokok sp')
                            ->join('misirpjpd m', 'm.Id = sp.IdMisi AND m.KodeWilayah = sp.KodeWilayah', 'inner')
                            ->join('visirpjpd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                            ->where('sp.KodeWilayah', $KodeWilayah)
                            ->where('sp.deleted_at IS NULL')
                            ->where('m.deleted_at IS NULL')
                            ->where('v.deleted_at IS NULL')
                            ->order_by('sp.IdMisi', 'ASC')
                            ->order_by('sp.Id', 'ASC')
                            ->get()
                            ->result_array();
                        
                        // Ambil data IUP
                        $Data['IUP'] = $this->db
                            ->select('i.*, sp.SasaranPokok')
                            ->from('iup i')
                            ->join('sasaran_pokok sp', 'sp.Id = i.IdSasaranPokok AND sp.KodeWilayah = i.KodeWilayah', 'inner')
                            ->where('i.KodeWilayah', $KodeWilayah)
                            ->where('i.deleted_at IS NULL')
                            ->where('sp.deleted_at IS NULL')
                            ->order_by('i.IdSasaranPokok', 'ASC')
                            ->order_by('i.Id', 'ASC')
                            ->get()
                            ->result_array();
                        
                        // Group IUP by IdSasaranPokok
                        $Data['IUPGrouped'] = [];
                        foreach ($Data['IUP'] as $row) {
                            $Data['IUPGrouped'][$row['IdSasaranPokok']][] = $row;
                        }
                        
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['Misi'] = [];
                        $Data['SasaranPokok'] = [];
                        $Data['IUP'] = [];
                        $Data['IUPGrouped'] = [];
                        $Data['PeriodeList'] = [];
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['Misi'] = [];
                    $Data['SasaranPokok'] = [];
                    $Data['IUP'] = [];
                    $Data['IUPGrouped'] = [];
                    $Data['PeriodeList'] = [];
                }

                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/SasaranPokok', $Data);
            }

            // ============================================================
            // GET MISI BY PERIODE (AJAX)
            // ============================================================
            public function GetMisiByPeriodeSasaranPokok() {
            log_message('debug', '=== GetMisiByPeriodeSasaranPokok dipanggil ===');
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $periodeId = (int)$this->input->post('Id', TRUE);
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            log_message('debug', "periodeId: $periodeId, kodeWilayah: $kodeWilayah");
            
            if ($periodeId <= 0 || empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            // Ambil misi berdasarkan periode (visi)
            $misi = $this->db
                ->select('m.Id, m.Misi')
                ->from('misirpjpd m')
                ->where('m._Id', $periodeId)
                ->where('m.KodeWilayah', $kodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->order_by('m.Id', 'ASC')
                ->get()
                ->result_array();
            
            log_message('debug', 'Misi ditemukan: ' . count($misi));
            
            echo json_encode($misi);
        }

            // ============================================================
            // GET SASARAN POKOK BY MISI (AJAX)
            // ============================================================
            public function GetSasaranPokokByMisi() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $idMisi = (int)$this->input->post('IdMisi', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if ($idMisi <= 0 || empty($kodeWilayah)) {
                    echo json_encode([]);
                    return;
                }
                
                $sasaran = $this->db
                    ->select('Id, SasaranPokok')
                    ->from('sasaran_pokok')
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('IdMisi', $idMisi)
                    ->where('deleted_at IS NULL')
                    ->order_by('Id', 'ASC')
                    ->get()
                    ->result_array();
                
                echo json_encode($sasaran);
            }

            // ============================================================
            // GET IUP BY SASARAN POKOK (AJAX)
            // ============================================================
            public function GetIUPBySasaranPokok() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $idSasaran = (int)$this->input->post('IdSasaranPokok', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if ($idSasaran <= 0 || empty($kodeWilayah)) {
                    echo json_encode([]);
                    return;
                }
                
                $iup = $this->db
                    ->select('*')
                    ->from('iup')
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('IdSasaranPokok', $idSasaran)
                    ->where('deleted_at IS NULL')
                    ->order_by('Id', 'ASC')
                    ->get()
                    ->result_array();
                
                echo json_encode($iup);
            }

            // ============================================================
        // CRUD: TAMBAH SASARAN POKOK (DARI MISI)
        // ============================================================
        public function InputSasaranPokok() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $idMisi = (int)$this->input->post('IdMisi', TRUE);
            $sasaranPokok = trim($this->input->post('SasaranPokok', TRUE));
            
            if ($idMisi <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Misi harus dipilih!']);
                return;
            }
            
            if (empty($sasaranPokok)) {
                echo json_encode(['status' => 'error', 'message' => 'Sasaran Pokok harus diisi!']);
                return;
            }
            
            // Validasi misi exists
            $misiExists = $this->db->where('Id', $idMisi)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('misirpjpd')
                ->num_rows();
            
            if (!$misiExists) {
                echo json_encode(['status' => 'error', 'message' => 'Misi tidak ditemukan!']);
                return;
            }
            
            $data = [
                'KodeWilayah' => $kodeWilayah,
                'IdMisi' => $idMisi,
                'SasaranPokok' => $sasaranPokok,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('sasaran_pokok', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Sasaran Pokok berhasil disimpan!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

        // ============================================================
        // CRUD: TAMBAH IUP (LANGSUNG DARI BARIS)
        // ============================================================
        public function InputIUP() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $idSasaranPokok = (int)$this->input->post('IdSasaranPokok', TRUE);
            $indikator = trim($this->input->post('Indikator', TRUE));
            $satuan = trim($this->input->post('Satuan', TRUE));
            $target1 = $this->input->post('Target1', TRUE);
            $target2 = $this->input->post('Target2', TRUE);
            $target3 = $this->input->post('Target3', TRUE);
            $target4 = $this->input->post('Target4', TRUE);
            
            if ($idSasaranPokok <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Sasaran Pokok tidak valid!']);
                return;
            }
            
            if (empty($indikator)) {
                echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi!']);
                return;
            }
            
            // Validasi sasaran pokok exists
            $sasaranExists = $this->db->where('Id', $idSasaranPokok)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('sasaran_pokok')
                ->num_rows();
            
            if (!$sasaranExists) {
                echo json_encode(['status' => 'error', 'message' => 'Sasaran Pokok tidak ditemukan!']);
                return;
            }
            
            $data = [
                'KodeWilayah' => $kodeWilayah,
                'IdSasaranPokok' => $idSasaranPokok,
                'Indikator' => $indikator,
                'Satuan' => !empty($satuan) ? $satuan : null,
                'Target_Tahap_I' => !empty($target1) ? $target1 : null,
                'Target_Tahap_II' => !empty($target2) ? $target2 : null,
                'Target_Tahap_III' => !empty($target3) ? $target3 : null,
                'Target_Tahap_IV' => !empty($target4) ? $target4 : null,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('iup', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'IUP berhasil disimpan!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

            // ============================================================
            // CRUD: EDIT SASARAN POKOK
            // ============================================================
            public function EditSasaranPokok() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah) || $id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                    return;
                }
                
                $sasaranPokok = trim($this->input->post('SasaranPokok', TRUE));
                
                if (empty($sasaranPokok)) {
                    echo json_encode(['status' => 'error', 'message' => 'Sasaran Pokok harus diisi!']);
                    return;
                }
                
                $data = [
                    'SasaranPokok' => $sasaranPokok,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->update('sasaran_pokok', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(['status' => 'success', 'message' => 'Sasaran Pokok berhasil diupdate!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal update data!']);
                }
            }

            // ============================================================
            // CRUD: EDIT IUP
            // ============================================================
            public function EditIUP() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah) || $id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                    return;
                }
                
                $indikator = trim($this->input->post('Indikator', TRUE));
                $satuan = trim($this->input->post('Satuan', TRUE));
                $target1 = $this->input->post('Target1', TRUE);
                $target2 = $this->input->post('Target2', TRUE);
                $target3 = $this->input->post('Target3', TRUE);
                $target4 = $this->input->post('Target4', TRUE);
                
                if (empty($indikator)) {
                    echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi!']);
                    return;
                }
                
                $data = [
                    'Indikator' => $indikator,
                    'Satuan' => !empty($satuan) ? $satuan : null,
                    'Target_Tahap_I' => !empty($target1) ? $target1 : null,
                    'Target_Tahap_II' => !empty($target2) ? $target2 : null,
                    'Target_Tahap_III' => !empty($target3) ? $target3 : null,
                    'Target_Tahap_IV' => !empty($target4) ? $target4 : null,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->update('iup', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(['status' => 'success', 'message' => 'IUP berhasil diupdate!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal update data!']);
                }
            }

            // ============================================================
            // CRUD: HAPUS SASARAN POKOK
            // ============================================================
            public function HapusSasaranPokok() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah) || $id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                    return;
                }
                
                // Hapus juga semua IUP yang terkait
                $this->db->where('IdSasaranPokok', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->update('iup', ['deleted_at' => date('Y-m-d H:i:s')]);
                
                $this->db->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->update('sasaran_pokok', ['deleted_at' => date('Y-m-d H:i:s')]);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
                }
            }

            // ============================================================
            // CRUD: HAPUS IUP
            // ============================================================
            public function HapusIUP() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah) || $id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                    return;
                }
                
                $this->db->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->update('iup', ['deleted_at' => date('Y-m-d H:i:s')]);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode(['status' => 'success', 'message' => 'IUP berhasil dihapus!']);
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
                }
            }

            public function GetDataPeriodeMisi() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $idMisi = (int)$this->input->post('IdMisi', TRUE);
            $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            if ($idMisi <= 0 || empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            // Ambil data misi dari misirpjpd dengan join ke visirpjpd
            $data = $this->db
                ->select('m.Id as MisiId, m.Misi, m._Id as VisiId, v.TahunMulai, v.TahunAkhir, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode')
                ->from('misirpjpd m')
                ->join('visirpjpd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                ->where('m.Id', $idMisi)
                ->where('m.KodeWilayah', $kodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->where('v.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if ($data) {
                // Ambil daftar periode yang tersedia untuk dropdown
                $periodes = $this->db
                    ->select('Id, TahunMulai, TahunAkhir, CONCAT(TahunMulai, " - ", TahunAkhir) as Periode')
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('TahunMulai', 'ASC')
                    ->get('visirpjpd')
                    ->result_array();
                
                // Ambil daftar misi untuk periode yang dipilih
                $misiList = $this->db
                    ->select('Id, Misi')
                    ->where('_Id', $data['VisiId'])
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('Id', 'ASC')
                    ->get('misirpjpd')
                    ->result_array();
                
                echo json_encode([
                    'status' => 'success',
                    'data' => $data,
                    'periodes' => $periodes,
                    'misi_list' => $misiList
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }

        // ============================================================
        // HAPUS PERIODE DAN MISI BESERTA SELURUH DATA TURUNAN
        // ============================================================
        public function HapusPeriodeMisi() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $idMisi = (int)$this->input->post('IdMisi', TRUE);
            $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            if ($idMisi <= 0 || empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            // Cek apakah ada sasaran pokok dengan misi ini
            $sasaranList = $this->db
                ->select('Id')
                ->where('IdMisi', $idMisi)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('sasaran_pokok')
                ->result_array();
            
            if (empty($sasaranList)) {
                echo json_encode(['status' => 'error', 'message' => 'Tidak ada sasaran pokok dengan misi ini']);
                return;
            }
            
            $sasaranIds = array_column($sasaranList, 'Id');
            
            // Mulai transaksi
            $this->db->trans_start();
            
            try {
                // 1. Hapus (soft delete) semua IUP yang terkait dengan sasaran pokok ini
                if (!empty($sasaranIds)) {
                    $this->db
                        ->where_in('IdSasaranPokok', $sasaranIds)
                        ->where('KodeWilayah', $kodeWilayah)
                        ->update('iup', [
                            'deleted_at' => date('Y-m-d H:i:s')
                        ]);
                    log_message('debug', 'IUP dihapus: ' . $this->db->affected_rows() . ' baris');
                }
                
                // 2. Hapus (soft delete) semua Sasaran Pokok dengan misi ini
                $this->db
                    ->where('IdMisi', $idMisi)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->update('sasaran_pokok', [
                        'deleted_at' => date('Y-m-d H:i:s')
                    ]);
                
                $affectedSasaran = $this->db->affected_rows();
                log_message('debug', 'Sasaran pokok dihapus: ' . $affectedSasaran . ' baris');
                
                // 3. TIDAK menghapus dari tabel misirpjpd
                //    Hanya menghapus relasi data di sasaran_pokok dan iup
                
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE) {
                    throw new Exception('Gagal melakukan transaksi');
                }
                
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Berhasil menghapus ' . $affectedSasaran . ' sasaran pokok dan IUP terkait'
                ]);
                
            } catch (Exception $e) {
                $this->db->trans_rollback();
                log_message('error', 'Error HapusPeriodeMisi: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        public function EditPeriodeMisi() {
            // Aktifkan error reporting
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Log untuk debugging
            log_message('debug', '=== EditPeriodeMisi dipanggil ===');
            log_message('debug', 'POST: ' . print_r($_POST, true));
            
            // Cek AJAX
            if (!$this->input->is_ajax_request()) {
                log_message('error', 'Bukan AJAX request');
                show_404();
                return;
            }
            
            // Ambil session
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
                return;
            }
            
            // Ambil parameter
            $idMisiLama = $this->input->post('IdMisi', TRUE);
            $visiIdBaru = $this->input->post('VisiId', TRUE);
            $idMisiBaru = $this->input->post('MisiId', TRUE);
            
            // Konversi ke integer
            $idMisiLama = (int)$idMisiLama;
            $visiIdBaru = (int)$visiIdBaru;
            $idMisiBaru = (int)$idMisiBaru;
            
            log_message('debug', "idMisiLama: $idMisiLama, visiIdBaru: $visiIdBaru, idMisiBaru: $idMisiBaru");
            
            // Validasi sederhana
            if ($idMisiLama <= 0 || $visiIdBaru <= 0 || $idMisiBaru <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            // CEK: Apakah misi baru ada?
            $misiBaru = $this->db
                ->where('Id', $idMisiBaru)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('misirpjpd')
                ->row_array();
            
            if (!$misiBaru) {
                echo json_encode(['status' => 'error', 'message' => 'Misi baru tidak ditemukan']);
                return;
            }
            
            // CEK: Apakah ada sasaran dengan misi lama?
            $sasaranCount = $this->db
                ->where('IdMisi', $idMisiLama)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->count_all_results('sasaran_pokok');
            
            if ($sasaranCount == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Tidak ada sasaran dengan misi ini']);
                return;
            }
            
            // ============================================
            // UPDATE SEDERHANA - hanya update sasaran_pokok
            // ============================================
            $this->db
                ->where('IdMisi', $idMisiLama)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->update('sasaran_pokok', [
                    'IdMisi' => $idMisiBaru,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            
            $affected = $this->db->affected_rows();
            log_message('debug', 'Sasaran diupdate: ' . $affected);
            
            if ($affected > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Berhasil mengupdate ' . $affected . ' sasaran pokok'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal mengupdate data'
                ]);
            }
        }

        public function GetDataPeriodeMisiEdit() {
            log_message('debug', '=== GetDataPeriodeMisiEdit dipanggil ===');
            log_message('debug', 'POST: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $idMisi = (int)$this->input->post('IdMisi', TRUE);
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            log_message('debug', "idMisi: $idMisi, kodeWilayah: $kodeWilayah");
            
            if ($idMisi <= 0 || empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            // Ambil data misi
            $dataMisi = $this->db
                ->select('m.Id as MisiId, m.Misi, m._Id as VisiId')
                ->from('misirpjpd m')
                ->where('m.Id', $idMisi)
                ->where('m.KodeWilayah', $kodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if (!$dataMisi) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data misi tidak ditemukan'
                ]);
                return;
            }
            
            // Ambil daftar periode
            $periodes = $this->db
                ->select('Id, TahunMulai, TahunAkhir, CONCAT(TahunMulai, " - ", TahunAkhir) as Periode')
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('TahunMulai', 'ASC')
                ->get('visirpjpd')
                ->result_array();
            
            // Ambil daftar misi untuk periode yang dipilih
            $misiList = $this->db
                ->select('Id, Misi')
                ->where('_Id', $dataMisi['VisiId'])
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('Id', 'ASC')
                ->get('misirpjpd')
                ->result_array();
            
            echo json_encode([
                'status' => 'success',
                'data' => $dataMisi,
                'periodes' => $periodes,
                'misi_list' => $misiList
            ]);
        }

            // ============================================================
            // GET DATA BY ID (AJAX)
            // ============================================================
            public function GetSasaranPokokById() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah) || $id <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                $data = $this->db
                    ->select('*')
                    ->from('sasaran_pokok')
                    ->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get()
                    ->row_array();
                
                echo json_encode($data);
            }

            public function GetIUPById() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah) || $id <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                $data = $this->db
                    ->select('*')
                    ->from('iup')
                    ->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get()
                    ->row_array();
                
                echo json_encode($data);
            }

            // ============================================================
        // GET PERIODE DAN MISI BY ID MISI (AJAX)
        // ============================================================
        public function GetPeriodeMisiByIdMisi() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $idMisi = (int)$this->input->post('IdMisi', TRUE);
            $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            if ($idMisi <= 0 || empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('m.Id as MisiId, m.Misi, v.Id as VisiId, CONCAT(v.TahunMulai, " - ", v.TahunAkhir) as Periode, v.TahunMulai, v.TahunAkhir')
                ->from('misirpjpd m')
                ->join('visirpjpd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                ->where('m.Id', $idMisi)
                ->where('m.KodeWilayah', $kodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->where('v.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            echo json_encode($data);
        }



        public function GetVisiRPJMDP(){
            echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjmdp as v, misirpjmdp as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
            }

        public function GetVisiRPJMN(){
            echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjmn as v, misirpjmn as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
            }

        public function GetVisiRPJMD() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $kodeWilayah = $this->_checkSessionWilayah();
                if (!$kodeWilayah) return;
                
                $periodeId = (int)$this->input->post('Id', TRUE);
                if ($periodeId <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                $data = $this->db->where('Id', $periodeId)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmd')
                    ->result_array();
                
                echo json_encode($data);
            }

                /**
             * Helper untuk mendapatkan periode dari Visi berdasarkan ID
             */
            private function _getPeriodeFromVisi($visiId) {
                $visi = $this->db
                    ->select('TahunMulai, TahunAkhir')
                    ->where('Id', $visiId)
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmd')
                    ->row_array();
                return $visi;
            }

            private function _getPeriodeFromMisi($misiId) {
                $misi = $this->db
                    ->select('m.TahunMulai, m.TahunAkhir')
                    ->from('misirpjmd m')
                    ->where('m.Id', $misiId)
                    ->where('m.deleted_at IS NULL')
                    ->get()
                    ->row_array();
                return $misi;
            }

            private function _getPeriodeFromTujuan($tujuanId) {
                $tujuan = $this->db
                    ->select('t.TahunMulai, t.TahunAkhir')
                    ->from('tujuanrpjmd t')
                    ->where('t.Id', $tujuanId)
                    ->where('t.deleted_at IS NULL')
                    ->get()
                    ->row_array();
                return $tujuan;
            }

            // ============================================================
            // CRUD VISI RPJMD - FIXED
            // ============================================================
            
            public function VisiRPJMD() {
            $Header['Halaman'] = 'RPJMD';
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? $this->input->get('KodeWilayah', TRUE);

            if ($KodeWilayah) {
                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                if ($wilayah) {
                    $Data['KodeWilayah'] = $KodeWilayah;
                    $Data['NamaWilayah'] = $wilayah['Nama'];
                    
                    // Ambil Visi
                    $Data['Visi'] = $this->db
                        ->select('v.*, k.Nama')
                        ->from('visirpjmd v')
                        ->join('kodewilayah k', 'v.KodeWilayah = k.Kode', 'left')
                        ->where('v.KodeWilayah', $KodeWilayah)
                        ->where('v.deleted_at IS NULL')
                        ->order_by('v.TahunMulai', 'DESC')
                        ->get()
                        ->result_array();
                    
                    // Load Misi, Tujuan, Sasaran untuk setiap Visi
                    foreach ($Data['Visi'] as &$visi) {
                        $visi['Misi'] = $this->db
                            ->select('m.*')
                            ->from('misirpjmd m')
                            ->where('m._Id', $visi['Id'])
                            ->where('m.KodeWilayah', $KodeWilayah)
                            ->where('m.deleted_at IS NULL')
                            ->order_by('m.Id', 'ASC')
                            ->get()
                            ->result_array();
                        
                        foreach ($visi['Misi'] as &$misi) {
                            // Jika misi tidak punya periode, ambil dari visi
                            if (empty($misi['TahunMulai']) || empty($misi['TahunAkhir'])) {
                                $misi['TahunMulai'] = $visi['TahunMulai'];
                                $misi['TahunAkhir'] = $visi['TahunAkhir'];
                            }
                            
                            $misi['Tujuan'] = $this->db
                                ->select('t.*')
                                ->from('tujuanrpjmd t')
                                ->where('t._Id', $misi['Id'])
                                ->where('t.KodeWilayah', $KodeWilayah)
                                ->where('t.deleted_at IS NULL')
                                ->order_by('t.Id', 'ASC')
                                ->get()
                                ->result_array();
                            
                            foreach ($misi['Tujuan'] as &$tujuan) {
                                // Jika tujuan tidak punya periode, ambil dari misi
                                if (empty($tujuan['TahunMulai']) || empty($tujuan['TahunAkhir'])) {
                                    $tujuan['TahunMulai'] = $misi['TahunMulai'];
                                    $tujuan['TahunAkhir'] = $misi['TahunAkhir'];
                                }
                                
                                $tujuan['Sasaran'] = $this->db
                                    ->select('s.*')
                                    ->from('sasaranrpjmd s')
                                    ->where('s._Id', $tujuan['Id'])
                                    ->where('s.KodeWilayah', $KodeWilayah)
                                    ->where('s.deleted_at IS NULL')
                                    ->order_by('s.Id', 'ASC')
                                    ->get()
                                    ->result_array();
                                
                                foreach ($tujuan['Sasaran'] as &$sasaran) {
                                    // Jika sasaran tidak punya periode, ambil dari tujuan
                                    if (empty($sasaran['TahunMulai']) || empty($sasaran['TahunAkhir'])) {
                                        $sasaran['TahunMulai'] = $tujuan['TahunMulai'];
                                        $sasaran['TahunAkhir'] = $tujuan['TahunAkhir'];
                                    }
                                }
                            }
                        }
                    }
                    
                    // Data periode untuk dropdown referensi
                    $kodeProvinsi = substr($KodeWilayah, 0, 2);
                    
                    $Data['PeriodeRPJPDP'] = $this->db
                        ->select('Id, TahunMulai, TahunAkhir')
                        ->from('visirpjpdp')
                        ->where('KodeWilayah', $kodeProvinsi)
                        ->where('deleted_at IS NULL')
                        ->order_by('TahunMulai', 'DESC')
                        ->get()
                        ->result_array();
                    
                    $Data['PeriodeRPJPN'] = $this->db
                        ->select('Id, TahunMulai, TahunAkhir')
                        ->from('visirpjpn')
                        ->where('deleted_at IS NULL')
                        ->order_by('TahunMulai', 'DESC')
                        ->get()
                        ->result_array();
                        
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['Visi'] = [];
                    $Data['PeriodeRPJPDP'] = [];
                    $Data['PeriodeRPJPN'] = [];
                }
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['Visi'] = [];
                $Data['PeriodeRPJPDP'] = [];
                $Data['PeriodeRPJPN'] = [];
            }

            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/VisiRPJMD', $Data);
        }

            // ============================================================
        // CRUD VISI RPJMD - PERBAIKAN
        // ============================================================
        public function InputVisiRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $visi = trim($this->input->post('Visi', TRUE));
            $tahunMulai = $this->input->post('TahunMulai', TRUE);
            $tahunAkhir = $this->input->post('TahunAkhir', TRUE);
            
            // Validasi
            if (empty($visi)) {
                echo json_encode(['status' => 'error', 'message' => 'Visi harus diisi!']);
                return;
            }
            if (!is_numeric($tahunMulai) || strlen($tahunMulai) != 4) {
                echo json_encode(['status' => 'error', 'message' => 'Tahun Mulai tidak valid!']);
                return;
            }
            if (!is_numeric($tahunAkhir) || strlen($tahunAkhir) != 4) {
                echo json_encode(['status' => 'error', 'message' => 'Tahun Akhir tidak valid!']);
                return;
            }
            if ($tahunMulai >= $tahunAkhir) {
                echo json_encode(['status' => 'error', 'message' => 'Tahun Mulai harus lebih kecil dari Tahun Akhir!']);
                return;
            }
            
            $data = [
                'KodeWilayah' => $kodeWilayah,
                'Visi' => $visi,
                'TahunMulai' => $tahunMulai,
                'TahunAkhir' => $tahunAkhir,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('visirpjmd', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

        public function EditVisiRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            $visi = trim($this->input->post('Visi', TRUE));
            $tahunMulai = $this->input->post('TahunMulai', TRUE);
            $tahunAkhir = $this->input->post('TahunAkhir', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            if (empty($visi)) {
                echo json_encode(['status' => 'error', 'message' => 'Visi harus diisi!']);
                return;
            }
            if (!is_numeric($tahunMulai) || strlen($tahunMulai) != 4) {
                echo json_encode(['status' => 'error', 'message' => 'Tahun Mulai tidak valid!']);
                return;
            }
            if (!is_numeric($tahunAkhir) || strlen($tahunAkhir) != 4) {
                echo json_encode(['status' => 'error', 'message' => 'Tahun Akhir tidak valid!']);
                return;
            }
            if ($tahunMulai >= $tahunAkhir) {
                echo json_encode(['status' => 'error', 'message' => 'Tahun Mulai harus lebih kecil dari Tahun Akhir!']);
                return;
            }
            
            $data = [
                'Visi' => $visi,
                'TahunMulai' => $tahunMulai,
                'TahunAkhir' => $tahunAkhir,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('Id', $id);
            $this->db->where('KodeWilayah', $kodeWilayah);
            $this->db->update('visirpjmd', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal update data atau tidak ada perubahan!']);
            }
        }

        public function HapusVisiRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->where('Id', $id);
            $this->db->where('KodeWilayah', $kodeWilayah);
            $this->db->update('visirpjmd', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
            }
        }


        public function GetMisiRPJMDP(){
            echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmdp")->result_array());
            }

        public function GetMisiRPJMN(){
            echo json_encode($this->db->query("SELECT v.*,m.* FROM visirpjmn as v, misirpjmn as m WHERE m._Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
            }

        public function GetPeriodeMisiRPJMD(){
            echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmd")->result_array());
            }

        public function GetMisiRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode([]);
                return;
            }
            
            $visiId = (int)$this->input->post('Id', TRUE);
            if ($visiId <= 0) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('m.*, v.TahunMulai as VisiTahunMulai, v.TahunAkhir as VisiTahunAkhir')
                ->from('misirpjmd m')
                ->join('visirpjmd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                ->where('m._Id', $visiId)
                ->where('m.KodeWilayah', $kodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->get()
                ->result_array();
            
            // Pastikan setiap misi memiliki periode
            foreach ($data as &$misi) {
                if (empty($misi['TahunMulai']) || empty($misi['TahunAkhir'])) {
                    $misi['TahunMulai'] = $misi['VisiTahunMulai'];
                    $misi['TahunAkhir'] = $misi['VisiTahunAkhir'];
                }
                unset($misi['VisiTahunMulai']);
                unset($misi['VisiTahunAkhir']);
            }
            
            echo json_encode($data);
        }

        public function MisiRPJMD() {
                $Header['Halaman'] = 'RPJMD';
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        $Data['VisiRPJMDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                            ->where('deleted_at IS NULL')
                            ->get('visirpjmdp')->result_array();
                        $Data['VisiRPJMN'] = $this->db->where('deleted_at IS NULL')
                            ->get('visirpjmn')->result_array();
                        $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->get('visirpjmd')->result_array();
                        $Data['Misi'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, m.*')
                            ->from('visirpjmd v')
                            ->join('misirpjmd m', 'm._Id = v.Id')
                            ->where('m.KodeWilayah', $KodeWilayah)
                            ->where('m.deleted_at IS NULL')
                            ->get()->result_array();
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['VisiRPJMDP'] = [];
                        $Data['VisiRPJMN'] = [];
                        $Data['Visi'] = [];
                        $Data['Misi'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['VisiRPJMDP'] = [];
                    $Data['VisiRPJMN'] = [];
                    $Data['Visi'] = [];
                    $Data['Misi'] = [];
                }

                log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/MisiRPJMD', $Data);
            }

        // ============================================================
        // CRUD MISI RPJMD - PERBAIKAN
        // ============================================================
        public function InputMisiRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $visiId = (int)$this->input->post('_Id', TRUE);
            $misi = trim($this->input->post('Misi', TRUE));
            
            if ($visiId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Visi harus dipilih!']);
                return;
            }
            if (empty($misi)) {
                echo json_encode(['status' => 'error', 'message' => 'Misi harus diisi!']);
                return;
            }
            
            $periode = $this->_getPeriodeFromVisi($visiId);
            if (!$periode) {
                echo json_encode(['status' => 'error', 'message' => 'Visi tidak ditemukan!']);
                return;
            }
            
            $data = [
                'KodeWilayah' => $kodeWilayah,
                '_Id' => $visiId,
                'Misi' => $misi,
                'TahunMulai' => $periode['TahunMulai'],
                'TahunAkhir' => $periode['TahunAkhir'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('misirpjmd', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

        public function EditMisiRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            $visiId = (int)$this->input->post('_Id', TRUE);
            $misi = trim($this->input->post('Misi', TRUE));
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            if ($visiId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Visi harus dipilih!']);
                return;
            }
            if (empty($misi)) {
                echo json_encode(['status' => 'error', 'message' => 'Misi harus diisi!']);
                return;
            }
            
            $periode = $this->_getPeriodeFromVisi($visiId);
            if (!$periode) {
                echo json_encode(['status' => 'error', 'message' => 'Visi tidak ditemukan!']);
                return;
            }
            
            $data = [
                '_Id' => $visiId,
                'Misi' => $misi,
                'TahunMulai' => $periode['TahunMulai'],
                'TahunAkhir' => $periode['TahunAkhir'],
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('Id', $id);
            $this->db->where('KodeWilayah', $kodeWilayah);
            $this->db->update('misirpjmd', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal update data atau tidak ada perubahan!']);
            }
        }

        public function HapusMisiRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->where('Id', $id);
            $this->db->where('KodeWilayah', $kodeWilayah);
            $this->db->update('misirpjmd', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
            }
        }

        public function GetTujuanRPJMDP(){
            echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("tujuanrpjmdp")->result_array());
            }

        public function GetTujuanRPJMN(){
            echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
            }

        public function GetPeriodeTujuanRPJMD(){
            echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
            }

        public function GetTujuanRPJMD() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $kodeWilayah = $this->_checkSessionWilayah();
                if (!$kodeWilayah) return;
                
                $misiId = (int)$this->input->post('Id', TRUE);
                if ($misiId <= 0) {
                    echo json_encode([]);
                    return;
                }
                
                $data = $this->db->where('_Id', $misiId)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('Id', 'ASC')
                    ->get('tujuanrpjmd')
                    ->result_array();
                
                echo json_encode($data);
            }

        public function TujuanRPJMD() {
                $Header['Halaman'] = 'RPJMD';
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        $Data['VisiRPJMDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                            ->where('deleted_at IS NULL')
                            ->get('visirpjmdp')->result_array();
                        $Data['VisiRPJMN'] = $this->db->where('deleted_at IS NULL')
                            ->get('visirpjmn')->result_array();
                        $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->get('visirpjmd')->result_array();
                        $Data['Tujuan'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, m.Id as IdMisi, m.Misi, t.*')
                            ->from('visirpjmd v')
                            ->join('misirpjmd m', 'm._Id = v.Id')
                            ->join('tujuanrpjmd t', 't._Id = m.Id')
                            ->where('t.KodeWilayah', $KodeWilayah)
                            ->where('t.deleted_at IS NULL')
                            ->get()->result_array();
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['VisiRPJMDP'] = [];
                        $Data['VisiRPJMN'] = [];
                        $Data['Visi'] = [];
                        $Data['Tujuan'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['VisiRPJMDP'] = [];
                    $Data['VisiRPJMN'] = [];
                    $Data['Visi'] = [];
                    $Data['Tujuan'] = [];
                }

                log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/TujuanRPJMD', $Data);
            }

        // ============================================================
            // INPUT TUJUAN - FIXED
            // ============================================================
            public function InputTujuanRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $misiId = (int)$this->input->post('_Id', TRUE);
            $tujuan = trim($this->input->post('Tujuan', TRUE));
            
            if ($misiId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Misi harus dipilih!']);
                return;
            }
            if (empty($tujuan)) {
                echo json_encode(['status' => 'error', 'message' => 'Tujuan harus diisi!']);
                return;
            }
            
            // Ambil periode dari misi
            $misi = $this->db
                ->select('m.TahunMulai, m.TahunAkhir')
                ->from('misirpjmd m')
                ->where('m.Id', $misiId)
                ->where('m.KodeWilayah', $kodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if (!$misi) {
                echo json_encode(['status' => 'error', 'message' => 'Misi tidak ditemukan!']);
                return;
            }
            
            $data = [
                'KodeWilayah' => $kodeWilayah,
                '_Id' => $misiId,
                'Tujuan' => $tujuan,
                'TahunMulai' => $misi['TahunMulai'],
                'TahunAkhir' => $misi['TahunAkhir'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('tujuanrpjmd', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

        public function EditTujuanRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            $misiId = (int)$this->input->post('_Id', TRUE);
            $tujuan = trim($this->input->post('Tujuan', TRUE));
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            if ($misiId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Misi harus dipilih!']);
                return;
            }
            if (empty($tujuan)) {
                echo json_encode(['status' => 'error', 'message' => 'Tujuan harus diisi!']);
                return;
            }
            
            // Ambil periode dari misi
            $misi = $this->db
                ->select('m.TahunMulai, m.TahunAkhir')
                ->from('misirpjmd m')
                ->where('m.Id', $misiId)
                ->where('m.KodeWilayah', $kodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if (!$misi) {
                echo json_encode(['status' => 'error', 'message' => 'Misi tidak ditemukan!']);
                return;
            }
            
            $data = [
                '_Id' => $misiId,
                'Tujuan' => $tujuan,
                'TahunMulai' => $misi['TahunMulai'],
                'TahunAkhir' => $misi['TahunAkhir'],
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('Id', $id);
            $this->db->where('KodeWilayah', $kodeWilayah);
            $this->db->update('tujuanrpjmd', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal update data atau tidak ada perubahan!']);
            }
        }

        public function HapusTujuanRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // Cek apakah ada sasaran yang terkait
            $sasaranCount = $this->db
                ->where('_Id', $id)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->count_all_results('sasaranrpjmd');
            
            if ($sasaranCount > 0) {
                // Hapus sasaran terkait terlebih dahulu
                $this->db
                    ->where('_Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->update('sasaranrpjmd', [
                        'deleted_at' => date('Y-m-d H:i:s')
                    ]);
            }
            
            // Hapus tujuan
            $this->db->where('Id', $id);
            $this->db->where('KodeWilayah', $kodeWilayah);
            $this->db->update('tujuanrpjmd', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
            }
        }


        public function GetSasaranRPJMDP(){
            echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("sasaranrpjmdp")->result_array());
            }

        public function GetSasaranRPJMN(){
            echo json_encode($this->db->query("SELECT s.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t, sasaranrpjmn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array());
            }

        public function GetPeriodeSasaranRPJMD(){
            echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
            }

        public function GetSasaranRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode([]);
                return;
            }
            
            $tujuanId = (int)$this->input->post('Id', TRUE);
            if ($tujuanId <= 0) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('s.*, t.TahunMulai as TujuanTahunMulai, t.TahunAkhir as TujuanTahunAkhir')
                ->from('sasaranrpjmd s')
                ->join('tujuanrpjmd t', 't.Id = s._Id AND t.KodeWilayah = s.KodeWilayah', 'inner')
                ->where('s._Id', $tujuanId)
                ->where('s.KodeWilayah', $kodeWilayah)
                ->where('s.deleted_at IS NULL')
                ->order_by('s.Id', 'ASC')
                ->get()
                ->result_array();
            
            // Pastikan setiap sasaran memiliki periode
            foreach ($data as &$sasaran) {
                if (empty($sasaran['TahunMulai']) || empty($sasaran['TahunAkhir'])) {
                    $sasaran['TahunMulai'] = $sasaran['TujuanTahunMulai'];
                    $sasaran['TahunAkhir'] = $sasaran['TujuanTahunAkhir'];
                }
                unset($sasaran['TujuanTahunMulai']);
                unset($sasaran['TujuanTahunAkhir']);
            }
            
            echo json_encode($data);
        }

        public function SasaranRPJMD() {
                $Header['Halaman'] = 'RPJMD';
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        $Data['VisiRPJMDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                            ->where('deleted_at IS NULL')
                            ->get('visirpjmdp')->result_array();
                        $Data['VisiRPJMN'] = $this->db->where('deleted_at IS NULL')
                            ->get('visirpjmn')->result_array();
                        $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->get('visirpjmd')->result_array();
                        $Data['Sasaran'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, t.Id as IdTujuan, t.Tujuan, s.*')
                            ->from('visirpjmd v')
                            ->join('misirpjmd m', 'm._Id = v.Id')
                            ->join('tujuanrpjmd t', 't._Id = m.Id')
                            ->join('sasaranrpjmd s', 's._Id = t.Id')
                            ->where('s.KodeWilayah', $KodeWilayah)
                            ->where('s.deleted_at IS NULL')
                            ->get()->result_array();
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['VisiRPJMDP'] = [];
                        $Data['VisiRPJMN'] = [];
                        $Data['Visi'] = [];
                        $Data['Sasaran'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['VisiRPJMDP'] = [];
                    $Data['VisiRPJMN'] = [];
                    $Data['Visi'] = [];
                    $Data['Sasaran'] = [];
                }

                log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/SasaranRPJMD', $Data);
            }

            // ============================================================
            // INPUT SASARAN - FIXED
            // ============================================================
        public function InputSasaranRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $tujuanId = (int)$this->input->post('_Id', TRUE);
            $sasaran = trim($this->input->post('Sasaran', TRUE));
            
            if ($tujuanId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Tujuan harus dipilih!']);
                return;
            }
            if (empty($sasaran)) {
                echo json_encode(['status' => 'error', 'message' => 'Sasaran harus diisi!']);
                return;
            }
            
            // Ambil periode dari tujuan
            $tujuan = $this->db
                ->select('t.TahunMulai, t.TahunAkhir')
                ->from('tujuanrpjmd t')
                ->where('t.Id', $tujuanId)
                ->where('t.KodeWilayah', $kodeWilayah)
                ->where('t.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if (!$tujuan) {
                echo json_encode(['status' => 'error', 'message' => 'Tujuan tidak ditemukan!']);
                return;
            }
            
            $data = [
                'KodeWilayah' => $kodeWilayah,
                '_Id' => $tujuanId,
                'Sasaran' => $sasaran,
                'TahunMulai' => $tujuan['TahunMulai'],
                'TahunAkhir' => $tujuan['TahunAkhir'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('sasaranrpjmd', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

        public function EditSasaranRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            $tujuanId = (int)$this->input->post('_Id', TRUE);
            $sasaran = trim($this->input->post('Sasaran', TRUE));
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            if ($tujuanId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Tujuan harus dipilih!']);
                return;
            }
            if (empty($sasaran)) {
                echo json_encode(['status' => 'error', 'message' => 'Sasaran harus diisi!']);
                return;
            }
            
            // Ambil periode dari tujuan
            $tujuan = $this->db
                ->select('t.TahunMulai, t.TahunAkhir')
                ->from('tujuanrpjmd t')
                ->where('t.Id', $tujuanId)
                ->where('t.KodeWilayah', $kodeWilayah)
                ->where('t.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if (!$tujuan) {
                echo json_encode(['status' => 'error', 'message' => 'Tujuan tidak ditemukan!']);
                return;
            }
            
            $data = [
                '_Id' => $tujuanId,
                'Sasaran' => $sasaran,
                'TahunMulai' => $tujuan['TahunMulai'],
                'TahunAkhir' => $tujuan['TahunAkhir'],
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('Id', $id);
            $this->db->where('KodeWilayah', $kodeWilayah);
            $this->db->update('sasaranrpjmd', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal update data atau tidak ada perubahan!']);
            }
        }

        public function HapusSasaranRPJMD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->where('Id', $id);
            $this->db->where('KodeWilayah', $kodeWilayah);
            $this->db->update('sasaranrpjmd', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
            }
        }


        public function GetSasaran(){
            $Id = $this->input->post('id');
            echo json_encode($this->db->get_where('sasaran', array('IdTujuan' => $Id))->result_array());
            }

            public function GetIndikatorTujuan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $tujuanId = (int)$this->input->post('tujuan_id', TRUE);
            if ($tujuanId <= 0) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->where('tujuan_id', $tujuanId)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('indikator_tujuan')
                ->result_array();
            
            // Tambahkan nama PD untuk setiap indikator
            foreach ($data as &$item) {
                if (!empty($item['pd_pengampuh'])) {
                    $pdIds = explode(',', $item['pd_pengampuh']);
                    $pdNames = $this->db
                        ->select('nama')
                        ->where_in('id', $pdIds)
                        ->where('deleted_at IS NULL')
                        ->get('akun_instansi')
                        ->result_array();
                    $item['pd_pengampuh_names'] = array_column($pdNames, 'nama');
                } else {
                    $item['pd_pengampuh_names'] = [];
                }
            }
            
            echo json_encode($data);
        }

        /**
         * Input Indikator Tujuan - dengan PD Multi-Select
         */
        public function InputIndikatorTujuan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $tujuanId = (int)$this->input->post('tujuan_id', TRUE);
            $indikator = trim($this->input->post('indikator', TRUE));
            $satuan = trim($this->input->post('satuan', TRUE));
            $pdPengampuh = $this->input->post('pd_pengampuh', TRUE);
            
            if ($tujuanId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Tujuan tidak valid!']);
                return;
            }
            if (empty($indikator)) {
                echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi!']);
                return;
            }
            
            // Validasi PD yang dipilih
            $pdPengampuhValue = '';
            if (!empty($pdPengampuh) && is_array($pdPengampuh)) {
                $pdPengampuh = array_filter($pdPengampuh, function($val) {
                    return !empty($val) && is_numeric($val);
                });
                
                if (!empty($pdPengampuh)) {
                    $validCount = $this->db
                        ->where_in('id', $pdPengampuh)
                        ->where('kodewilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->count_all_results('akun_instansi');
                    
                    if ($validCount !== count($pdPengampuh)) {
                        echo json_encode(['status' => 'error', 'message' => 'Beberapa PD tidak valid!']);
                        return;
                    }
                    
                    $pdPengampuhValue = implode(',', $pdPengampuh);
                }
            }
            
            // Tentukan apakah perlu insert kodewilayah
            // Jika tabel memiliki kolom kodewilayah, tambahkan
            $data = [
                'tujuan_id' => $tujuanId,
                'indikator' => $indikator,
                'satuan' => $satuan,
                'baseline_2024' => $this->input->post('baseline_2024') ?: null,
                'target_2025' => $this->input->post('target_2025') ?: null,
                'target_2026' => $this->input->post('target_2026') ?: null,
                'target_2027' => $this->input->post('target_2027') ?: null,
                'target_2028' => $this->input->post('target_2028') ?: null,
                'target_2029' => $this->input->post('target_2029') ?: null,
                'target_2030' => $this->input->post('target_2030') ?: null,
                'pd_pengampuh' => $pdPengampuhValue,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            // Jika tabel memiliki kolom kodewilayah, tambahkan
            // Cek apakah kolom kodewilayah ada
            $columns = $this->db->query("SHOW COLUMNS FROM indikator_tujuan LIKE 'kodewilayah'")->num_rows();
            if ($columns > 0) {
                $data['kodewilayah'] = $kodeWilayah;
            }
            
            $this->db->insert('indikator_tujuan', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil ditambahkan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan indikator!']);
            }
        }

        /**
         * Edit Indikator Tujuan - dengan PD Multi-Select (tanpa filter level)
         */
        public function EditIndikatorTujuan() {
            // Aktifkan error reporting untuk debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $id = (int)$this->input->post('id', TRUE);
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                $indikator = trim($this->input->post('indikator', TRUE));
                if (empty($indikator)) {
                    echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi!']);
                    return;
                }
                
                // Ambil data existing - TANPA kodewilayah
                $existing = $this->db
                    ->where('id', $id)
                    ->where('deleted_at IS NULL')
                    ->get('indikator_tujuan')
                    ->row_array();
                
                if (!$existing) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                    return;
                }
                
                // Gunakan session KodeWilayah
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') 
                            ?? '';
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah tidak ditemukan!']);
                    return;
                }
                
                // Ambil PD Pengampuh dari POST
                $pdPengampuh = $this->input->post('pd_pengampuh', TRUE);
                
                // Validasi dan proses PD Pengampuh
                $pdPengampuhValue = '';
                if (!empty($pdPengampuh) && is_array($pdPengampuh)) {
                    // Filter nilai kosong dan validasi numeric
                    $pdPengampuh = array_filter($pdPengampuh, function($val) {
                        return !empty($val) && is_numeric($val);
                    });
                    
                    // Validasi setiap PD exists (tanpa filter Level)
                    if (!empty($pdPengampuh)) {
                        $validCount = $this->db
                            ->where_in('id', $pdPengampuh)
                            ->where('kodewilayah', $kodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->count_all_results('akun_instansi');
                        
                        if ($validCount !== count($pdPengampuh)) {
                            echo json_encode(['status' => 'error', 'message' => 'Beberapa PD tidak valid!']);
                            return;
                        }
                        
                        $pdPengampuhValue = implode(',', $pdPengampuh);
                    }
                }
                
                // Siapkan data untuk update
                $data = [
                    'indikator' => $indikator,
                    'satuan' => trim($this->input->post('satuan', TRUE)),
                    'baseline_2024' => $this->input->post('baseline_2024') ?: null,
                    'target_2025' => $this->input->post('target_2025') ?: null,
                    'target_2026' => $this->input->post('target_2026') ?: null,
                    'target_2027' => $this->input->post('target_2027') ?: null,
                    'target_2028' => $this->input->post('target_2028') ?: null,
                    'target_2029' => $this->input->post('target_2029') ?: null,
                    'target_2030' => $this->input->post('target_2030') ?: null,
                    'pd_pengampuh' => $pdPengampuhValue,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                // Debug: Log data yang akan diupdate
                log_message('debug', 'EditIndikatorTujuan Data: ' . print_r($data, true));
                
                // Update database
                $this->db->where('id', $id);
                $result = $this->db->update('indikator_tujuan', $data);
                
                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil diupdate']);
                } else {
                    // Cek error database
                    $error = $this->db->error();
                    log_message('error', 'DB Error: ' . $error['message']);
                    echo json_encode(['status' => 'error', 'message' => 'Gagal update data: ' . $error['message']]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'EditIndikatorTujuan Exception: ' . $e->getMessage());
                echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
        }

        public function HapusIndikatorTujuan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->update('indikator_tujuan', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus indikator!']);
            }
        }

        // ============================================================
        // INDIKATOR SASARAN - CRUD
        // ============================================================

        public function GetIndikatorSasaran() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $sasaranId = (int)$this->input->post('sasaran_id', TRUE);
            if ($sasaranId <= 0) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->where('sasaran_id', $sasaranId)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('indikator_sasaran')
                ->result_array();
            
            // Tambahkan nama PD untuk setiap indikator
            foreach ($data as &$item) {
                if (!empty($item['pd_pengampuh'])) {
                    $pdIds = explode(',', $item['pd_pengampuh']);
                    $pdNames = $this->db
                        ->select('nama')
                        ->where_in('id', $pdIds)
                        ->where('deleted_at IS NULL')
                        ->get('akun_instansi')
                        ->result_array();
                    $item['pd_pengampuh_names'] = array_column($pdNames, 'nama');
                } else {
                    $item['pd_pengampuh_names'] = [];
                }
            }
            
            echo json_encode($data);
        }

        /**
         * Input Indikator Sasaran - dengan PD Multi-Select
         */
        public function InputIndikatorSasaran() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $sasaranId = (int)$this->input->post('sasaran_id', TRUE);
            $indikator = trim($this->input->post('indikator', TRUE));
            $satuan = trim($this->input->post('satuan', TRUE));
            $pdPengampuh = $this->input->post('pd_pengampuh', TRUE);
            
            if ($sasaranId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Sasaran tidak valid!']);
                return;
            }
            if (empty($indikator)) {
                echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi!']);
                return;
            }
            
            // Validasi PD yang dipilih
            $pdPengampuhValue = '';
            if (!empty($pdPengampuh) && is_array($pdPengampuh)) {
                $pdPengampuh = array_filter($pdPengampuh, function($val) {
                    return !empty($val) && is_numeric($val);
                });
                
                if (!empty($pdPengampuh)) {
                    $validCount = $this->db
                        ->where_in('id', $pdPengampuh)
                        ->where('kodewilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->count_all_results('akun_instansi');
                    
                    if ($validCount !== count($pdPengampuh)) {
                        echo json_encode(['status' => 'error', 'message' => 'Beberapa PD tidak valid!']);
                        return;
                    }
                    
                    $pdPengampuhValue = implode(',', $pdPengampuh);
                }
            }
            
            // Siapkan data untuk insert
            $data = [
                'sasaran_id' => $sasaranId,
                'indikator' => $indikator,
                'satuan' => $satuan,
                'baseline_2024' => $this->input->post('baseline_2024') ?: null,
                'target_2025' => $this->input->post('target_2025') ?: null,
                'target_2026' => $this->input->post('target_2026') ?: null,
                'target_2027' => $this->input->post('target_2027') ?: null,
                'target_2028' => $this->input->post('target_2028') ?: null,
                'target_2029' => $this->input->post('target_2029') ?: null,
                'target_2030' => $this->input->post('target_2030') ?: null,
                'pd_pengampuh' => $pdPengampuhValue,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            // Jika tabel memiliki kolom kodewilayah, tambahkan
            $columns = $this->db->query("SHOW COLUMNS FROM indikator_sasaran LIKE 'kodewilayah'")->num_rows();
            if ($columns > 0) {
                $data['kodewilayah'] = $kodeWilayah;
            }
            
            $this->db->insert('indikator_sasaran', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil ditambahkan']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan indikator!']);
            }
        }

        /**
         * Edit Indikator Sasaran - dengan PD Multi-Select
         */
        public function EditIndikatorSasaran() {
            // Aktifkan error reporting untuk debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $id = (int)$this->input->post('id', TRUE);
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                $indikator = trim($this->input->post('indikator', TRUE));
                if (empty($indikator)) {
                    echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi!']);
                    return;
                }
                
                // Ambil data existing - TANPA kodewilayah
                $existing = $this->db
                    ->where('id', $id)
                    ->where('deleted_at IS NULL')
                    ->get('indikator_sasaran')
                    ->row_array();
                
                if (!$existing) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                    return;
                }
                
                // Gunakan session KodeWilayah
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') 
                            ?? '';
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah tidak ditemukan!']);
                    return;
                }
                
                // Ambil PD Pengampuh dari POST
                $pdPengampuh = $this->input->post('pd_pengampuh', TRUE);
                
                // Validasi dan proses PD Pengampuh
                $pdPengampuhValue = '';
                if (!empty($pdPengampuh) && is_array($pdPengampuh)) {
                    // Filter nilai kosong dan validasi numeric
                    $pdPengampuh = array_filter($pdPengampuh, function($val) {
                        return !empty($val) && is_numeric($val);
                    });
                    
                    // Validasi setiap PD exists (tanpa filter Level)
                    if (!empty($pdPengampuh)) {
                        $validCount = $this->db
                            ->where_in('id', $pdPengampuh)
                            ->where('kodewilayah', $kodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->count_all_results('akun_instansi');
                        
                        if ($validCount !== count($pdPengampuh)) {
                            echo json_encode(['status' => 'error', 'message' => 'Beberapa PD tidak valid!']);
                            return;
                        }
                        
                        $pdPengampuhValue = implode(',', $pdPengampuh);
                    }
                }
                
                // Siapkan data untuk update
                $data = [
                    'indikator' => $indikator,
                    'satuan' => trim($this->input->post('satuan', TRUE)),
                    'baseline_2024' => $this->input->post('baseline_2024') ?: null,
                    'target_2025' => $this->input->post('target_2025') ?: null,
                    'target_2026' => $this->input->post('target_2026') ?: null,
                    'target_2027' => $this->input->post('target_2027') ?: null,
                    'target_2028' => $this->input->post('target_2028') ?: null,
                    'target_2029' => $this->input->post('target_2029') ?: null,
                    'target_2030' => $this->input->post('target_2030') ?: null,
                    'pd_pengampuh' => $pdPengampuhValue,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                // Debug: Log data yang akan diupdate
                log_message('debug', 'EditIndikatorSasaran Data: ' . print_r($data, true));
                
                // Update database
                $this->db->where('id', $id);
                $result = $this->db->update('indikator_sasaran', $data);
                
                if ($result) {
                    echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil diupdate']);
                } else {
                    // Cek error database
                    $error = $this->db->error();
                    log_message('error', 'DB Error: ' . $error['message']);
                    echo json_encode(['status' => 'error', 'message' => 'Gagal update data: ' . $error['message']]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'EditIndikatorSasaran Exception: ' . $e->getMessage());
                echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
            }
        }

        public function HapusIndikatorSasaran() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->update('indikator_sasaran', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil dihapus']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus indikator!']);
            }
        }

        /**
         * Get daftar semua Perangkat Daerah (akun_instansi) untuk dropdown
         * Tanpa filter level - ambil semua data aktif
         */
        public function GetListPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            // Ambil SEMUA data PD dari akun_instansi (tanpa filter Level)
            $pd = $this->db
                ->select('id, nama, Level, tahun_mulai, tahun_akhir')
                ->where('kodewilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get('akun_instansi')
                ->result_array();
            
            echo json_encode([
                'status' => 'success',
                'data' => $pd
            ]);
        }

        /**
         * Get detail PD yang sudah dipilih untuk edit
         */
        public function GetSelectedPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $indikatorId = (int)$this->input->post('indikator_id', TRUE);
            $type = $this->input->post('type', TRUE); // 'tujuan' atau 'sasaran'
            
            if ($indikatorId <= 0) {
                echo json_encode([]);
                return;
            }
            
            // Tentukan tabel berdasarkan type
            $table = ($type === 'tujuan') ? 'indikator_tujuan' : 'indikator_sasaran';
            
            // Hanya ambil pd_pengampuh, tanpa kodewilayah
            $data = $this->db
                ->select('pd_pengampuh')
                ->where('id', $indikatorId)
                ->where('deleted_at IS NULL')
                ->get($table)
                ->row_array();
            
            if ($data && !empty($data['pd_pengampuh'])) {
                // Konversi string CSV ke array of integers
                $selectedIds = array_filter(array_map('intval', explode(',', $data['pd_pengampuh'])));
                echo json_encode(array_values($selectedIds));
            } else {
                echo json_encode([]);
            }
        }

        // ============================================================
        // GET DAFTAR PERANGKAT DAERAH UNTUK PD PENGGAMPUH
        // ============================================================
        public function GetListPDForIndikator() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih', 'data' => []]);
                return;
            }
            
            // Ambil data perangkat daerah dari akun_instansi - SEMUA LEVEL
            $this->db->select('id, nama');
            $this->db->where('kodewilayah', $kodeWilayah);
            $this->db->where('deleted_at IS NULL', null, false);
            $this->db->order_by('nama', 'ASC');
            $query = $this->db->get('akun_instansi');
            
            $data = $query->result_array();
            
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        }

        // ============================================================
        // GET DETAIL PD PENGGAMPUH YANG SUDAH DIPILIH
        // ============================================================
        public function GetSelectedPDForIndikator() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $indikatorId = (int)$this->input->post('indikator_id', TRUE);
            $type = $this->input->post('type', TRUE); // 'tujuan' atau 'sasaran'
            
            if ($indikatorId <= 0) {
                echo json_encode([]);
                return;
            }
            
            // Tentukan tabel berdasarkan type
            $table = ($type === 'tujuan') ? 'indikator_tujuan' : 'indikator_sasaran';
            
            $data = $this->db
                ->select('pd_pengampuh')
                ->where('id', $indikatorId)
                ->where('deleted_at IS NULL', null, false)
                ->get($table)
                ->row_array();
            
            if ($data && !empty($data['pd_pengampuh'])) {
                $selectedIds = array_filter(array_map('intval', explode(',', $data['pd_pengampuh'])));
                echo json_encode(array_values($selectedIds));
            } else {
                echo json_encode([]);
            }
        }

        public function TahapanRPJMD() {
                $Header['Halaman'] = 'RPJMD';
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->get('visirpjmd')->result_array();
                        $Data['Tahapan'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, t.*')
                            ->from('visirpjmd v')
                            ->join('tahapanrpjmd t', 't._Id = v.Id')
                            ->where('t.KodeWilayah', $KodeWilayah)
                            ->where('t.deleted_at IS NULL')
                            ->get()->result_array();
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['Visi'] = [];
                        $Data['Tahapan'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['Visi'] = [];
                    $Data['Tahapan'] = [];
                }

                log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/TahapanRPJMD', $Data);
            }

        public function InputTahapanRPJMD(){  
            $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
            $this->db->insert('tahapanrpjmd',$_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Menyimpan Data!';
            }
            }
            
            public function EditTahapanRPJMD(){  
                $this->db->where('Id',$_POST['Id']); 
                $this->db->update('tahapanrpjmd', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Update Data!';
            }
        }

        public function HapusTahapanRPJMD(){  
                $_POST['deleted_at'] = date('Y-m-d H:i:s');
                $this->db->where('Id',$_POST['Id'])->update('tahapanrpjmd', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Hapus Data!';
            }
        }

        public function ArahKebijakanRPJMD()
        {
            $Header['Halaman'] = 'Daerah';

            // Provinsi (filter)
            $data['Provinsi'] = $this->db
            ->where("Kode LIKE '__'")
            ->get("kodewilayah")
            ->result_array();

            // Kode wilayah aktif (session tetap)
            $KodeWilayah = $_SESSION['KodeWilayah'] ?? ($_SESSION['TempKodeWilayah'] ?? '');

            $data['KodeWilayah'] = $KodeWilayah;

            // dropdown sasaran rpjmd
            $data['ListSasaranRPJMD'] = $this->db
            ->order_by("Id", "ASC")
            ->get("sasaranrpjmd")
            ->result_array();

            if (!empty($KodeWilayah)) {
            $data['ArahKebijakanRPJMD'] = $this->db
                ->select("a.*, s.Sasaran")
                ->from("arah_kebijakan_rpjmd a")
                ->join("sasaranrpjmd s", "s.id = a.sasaran_rpjmd_id", "left")
                ->where("a.kode_wilayah", $KodeWilayah)
                ->where("a.deleted_at", NULL)
                ->order_by("a.id", "ASC")
                ->get()
                ->result_array();
            } else {
            $data['ArahKebijakanRPJMD'] = [];
            }

            $this->load->view('Daerah/header', $Header);
            $this->load->view("Daerah/ArahKebijakanRPJMD", $data);
        }

        public function InputArahKebijakanRPJMD()
        {
            $KodeWilayah = $this->session->userdata("KodeWilayah");
            if (!$KodeWilayah) {
            $KodeWilayah = $_SESSION['KodeWilayah'] ?? ($_SESSION['TempKodeWilayah'] ?? '');
            }
            if (!$KodeWilayah) { echo "Wilayah belum dipilih!"; return; }

            $sasaran_id = (int)$this->input->post("sasaran_rpjmd_id");
            $strategi   = trim((string)$this->input->post("strategi"));
            $arah       = trim((string)$this->input->post("arah_kebijakan"));

            if($sasaran_id <= 0){ echo "Sasaran RPJMD wajib dipilih!"; return; }
            if($strategi === ""){ echo "Strategi wajib diisi!"; return; }
            if($arah === ""){ echo "Arah Kebijakan wajib diisi!"; return; }

            $data = [
            "kode_wilayah"      => $KodeWilayah,
            "sasaran_rpjmd_id"  => $sasaran_id,
            "strategi"          => $strategi,
            "arah_kebijakan"    => $arah,
            "created_at"        => date("Y-m-d H:i:s"),
            "deleted_at"        => NULL
            ];

            $insert = $this->db->insert("arah_kebijakan_rpjmd", $data);
            echo $insert ? "1" : "0";
        }

        public function EditArahKebijakanRPJMD()
        {
            $id = (int)$this->input->post("id");
            if ($id <= 0) { echo "ID tidak valid!"; return; }

            $sasaran_id = (int)$this->input->post("sasaran_rpjmd_id");
            $strategi   = trim((string)$this->input->post("strategi"));
            $arah       = trim((string)$this->input->post("arah_kebijakan"));

            if($sasaran_id <= 0){ echo "Sasaran RPJMD wajib dipilih!"; return; }
            if($strategi === ""){ echo "Strategi wajib diisi!"; return; }
            if($arah === ""){ echo "Arah Kebijakan wajib diisi!"; return; }

            $data = [
            "sasaran_rpjmd_id" => $sasaran_id,
            "strategi"         => $strategi,
            "arah_kebijakan"   => $arah,
            "updated_at"       => date("Y-m-d H:i:s")
            ];

            $update = $this->db->where("id", $id)->update("arah_kebijakan_rpjmd", $data);
            echo $update ? "1" : "0";
        }

        public function HapusArahKebijakanRPJMD()
        {
            $id = (int)$this->input->post("id");
            if ($id <= 0) { echo "ID tidak valid!"; return; }

            $data = ["deleted_at" => date("Y-m-d H:i:s")];

            $delete = $this->db->where("id", $id)->update("arah_kebijakan_rpjmd", $data);
            echo $delete ? "1" : "0";
        }

        public function JanjiPolitik(){
                $Header['Halaman'] = 'RPJMD';
            $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjmd")->result_array();
                $Data['JanjiPolitik'] = $this->db->query("SELECT v.*,j.* FROM visirpjmd as v, janjik as j WHERE j._Id = v.Id AND j.deleted_at IS NULL AND j.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
                $this->load->view('Daerah/header',$Header);
                $this->load->view('Daerah/JanjiPolitik',$Data);
            }

        public function InputJanjiPolitik(){  
            $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
            $this->db->insert('janjik',$_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Menyimpan Data!';
            }
            }
            
            public function EditJanjiPolitik(){  
                $this->db->where('Id',$_POST['Id']); 
                $this->db->update('janjik', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Update Data!';
            }
        }

        public function HapusJanjiPolitik(){  
                $_POST['deleted_at'] = date('Y-m-d H:i:s');
                $this->db->where('Id',$_POST['Id'])->update('janjik', $_POST);
            if ($this->db->affected_rows()){
            echo '1';
            } else {
            echo 'Gagal Hapus Data!';
            }
        }


            // ================================================================
        // GET NOMENKLATUR - UNTUK DROPDOWN HIERARKI
        // ================================================================

        /**
         * GET URUSAN (Level 1) - Untuk dropdown pertama
         */
        public function getUrusanNomenklatur()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $data = $this->db
                ->select('Kode, Nomenklatur')
                ->from('nomenklaturkabupaten')
                ->where('Kode NOT LIKE', '%.%')
                ->where('LENGTH(Kode) = 1')
                ->order_by('Kode', 'ASC')
                ->get()
                ->result_array();
            
            echo json_encode($data);
        }

        /**
         * GET BIDANG URUSAN (Level 2) - Berdasarkan Urusan yang dipilih
         */
        public function getBidangUrusanNomenklatur()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeUrusan = $this->input->post('kode_urusan', TRUE);
            
            if (empty($kodeUrusan)) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('Kode, Nomenklatur')
                ->from('nomenklaturkabupaten')
                ->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1)
                ->where('Kode LIKE', $kodeUrusan . '.%')
                ->order_by('Kode', 'ASC')
                ->get()
                ->result_array();
            
            echo json_encode($data);
        }

        /**
         * GET NOMENKLATUR BY KODE
         */
        public function getNomenklaturByKode()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kode = $this->input->post('kode', TRUE);
            
            if (empty($kode)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode tidak valid']);
                return;
            }
            
            $data = $this->db
                ->select('Kode, Nomenklatur')
                ->from('nomenklaturkabupaten')
                ->where('Kode', $kode)
                ->get()
                ->row_array();
            
            if ($data) {
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }

        // ================================================================
        // HALAMAN UTAMA INSTANSI
        // ================================================================

        public function Instansi()
        {
            $Header['Halaman'] = 'Kelola Instansi';

            $KodeWilayah = $this->_getKodeWilayah();

            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['Provinsi'] = $this->db
                ->select('Kode, Nama')
                ->where('LENGTH(Kode)=2', null, false)
                ->order_by('Nama', 'ASC')
                ->get('kodewilayah')
                ->result_array();

            // Kementerian (Level 1)
            $Data['Kementerian'] = $this->db
                ->select('Username as username', false)
                ->where('Level', 1)
                ->where('deleted_at IS NULL', null, false)
                ->order_by('Username', 'ASC')
                ->get('akun')
                ->result_array();

            $mapKem = [];
            foreach ($Data['Kementerian'] as $k) {
                $mapKem[$k['username']] = $k['username'];
            }

            if (empty($KodeWilayah)) {
                $Data['Akun'] = [];
                $Data['SubUnit'] = [];
                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/kelola_instansi', $Data);
                return;
            }

            // AKUN INSTANSI
            $Data['Akun'] = $this->db
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->order_by('kode_instansi', 'ASC')
                ->order_by('id', 'ASC')
                ->get('akun_instansi')
                ->result_array();

            // SUB UNIT
            $Data['SubUnit'] = $this->db
                ->select('su.*')
                ->from('sub_unit su')
                ->where('su.kode_wilayah', $KodeWilayah)
                ->where('su.deleted_at IS NULL', null, false)
                ->order_by('su.instansi_id', 'ASC')
                ->order_by('su.urutan', 'ASC')
                ->get()
                ->result_array();

            // Group sub unit by instansi_id
            $subUnitGrouped = [];
            foreach ($Data['SubUnit'] as $su) {
                // Parse bidang urusan dari CSV
                $su['bidang_urusan_list'] = [];
                if (!empty($su['bidang_urusan_id'])) {
                    $kodes = array_filter(array_map('trim', explode(',', $su['bidang_urusan_id'])));
                    foreach ($kodes as $kode) {
                        $nama = $this->db
                            ->select('Nomenklatur')
                            ->from('nomenklaturkabupaten')
                            ->where('Kode', $kode)
                            ->get()
                            ->row_array();
                        $su['bidang_urusan_list'][] = [
                            'kode' => $kode,
                            'nama' => $nama ? $nama['Nomenklatur'] : $kode
                        ];
                    }
                }
                $subUnitGrouped[$su['instansi_id']][] = $su;
            }

            // tambahkan nama_kementerian + sub_unit + bidang_urusan untuk view
            foreach ($Data['Akun'] as &$a) {
                // nama_kementerian
                $kemIds = [];
                if (!empty($a['idkementerian'])) {
                    $kemIds = array_filter(array_map('trim', explode(',', $a['idkementerian'])));
                }
                $kemNames = [];
                foreach ($kemIds as $kid) {
                    if (isset($mapKem[$kid])) {
                        $kemNames[] = $mapKem[$kid];
                    }
                }
                $a['nama_kementerian'] = !empty($kemNames) ? implode(', ', $kemNames) : '-';

                // SUB UNIT
                $a['sub_unit'] = isset($subUnitGrouped[$a['id']]) ? $subUnitGrouped[$a['id']] : [];
            }
            unset($a);

            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/kelola_instansi', $Data);
        }

        // ================================================================
        // CRUD INSTANSI - DENGAN KODE INSTANSI MANUAL
        // ================================================================

        /**
         * INPUT INSTANSI - Dengan Kode Instansi Manual
         */
        public function InputInstansi()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $this->_checkSessionWilayah();
            if (!$KodeWilayah) {
                return;
            }

            $kodeInstansi = trim((string)$this->input->post('kode_instansi', TRUE));
            $tahunMulai = (int)$this->input->post('tahun_mulai', TRUE);
            $tahunAkhir = (int)$this->input->post('tahun_akhir', TRUE);
            $nama = trim((string)$this->input->post('nama', TRUE));
            $pwd  = trim((string)$this->input->post('password', TRUE));

            // Validasi Kode Instansi
            if ($kodeInstansi === '') { 
                echo json_encode(['status' => 'error', 'message' => 'Kode Instansi wajib diisi!']);
                return; 
            }

            // Cek duplikat kode instansi
            $cekKode = $this->db
                ->where('kode_instansi', $kodeInstansi)
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->get('akun_instansi')
                ->num_rows();

            if ($cekKode > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Instansi "' . $kodeInstansi . '" sudah digunakan!']);
                return;
            }

            if (!$tahunMulai || strlen((string)$tahunMulai) != 4) { 
                echo json_encode(['status' => 'error', 'message' => 'Tahun Mulai tidak valid!']);
                return; 
            }
            if (!$tahunAkhir || strlen((string)$tahunAkhir) != 4) { 
                echo json_encode(['status' => 'error', 'message' => 'Tahun Akhir tidak valid!']);
                return; 
            }
            if ($tahunMulai >= $tahunAkhir) { 
                echo json_encode(['status' => 'error', 'message' => 'Tahun Mulai harus lebih kecil dari Tahun Akhir!']);
                return; 
            }

            if ($nama === '') { 
                echo json_encode(['status' => 'error', 'message' => 'Nama instansi wajib diisi!']);
                return; 
            }
            if ($pwd === '') {  
                echo json_encode(['status' => 'error', 'message' => 'Password wajib diisi!']);
                return; 
            }

            // ===== KEMENTERIAN =====
            $idKementerianArr = $this->input->post('idkementerian');
            $idKementerianArr = is_array($idKementerianArr)
                ? array_values(array_unique(array_filter(array_map('trim', $idKementerianArr))))
                : [];

            foreach ($idKementerianArr as $kem) {
                $validKem = $this->db->where('Username', $kem)
                    ->where('Level', 1)
                    ->where('deleted_at IS NULL', null, false)
                    ->count_all_results('akun');

                if ($validKem < 1) {
                    echo json_encode(['status' => 'error', 'message' => 'Induk kementerian tidak valid!']);
                    return;
                }
            }
            $idKementerian = !empty($idKementerianArr) ? implode(',', $idKementerianArr) : null;

            $data = [
                'kode_instansi'     => $kodeInstansi,
                'kodewilayah'       => $KodeWilayah,
                'nama'              => $nama,
                'password'          => password_hash($pwd, PASSWORD_DEFAULT),
                'tahun_mulai'       => $tahunMulai,
                'tahun_akhir'       => $tahunAkhir,
                'Level'             => 2,
                'idkementerian'     => $idKementerian,
                'created_at'        => date('Y-m-d H:i:s'),
                'updated_at'        => date('Y-m-d H:i:s')
            ];

            $this->db->insert('akun_instansi', $data);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

        /**
         * EDIT INSTANSI - Dengan Kode Instansi Manual
         */
        public function EditInstansi()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $this->_checkSessionWilayah();
            if (!$KodeWilayah) {
                return;
            }

            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) { 
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return; 
            }

            $kodeInstansi = trim((string)$this->input->post('kode_instansi', TRUE));
            $tahunMulai = (int)$this->input->post('tahun_mulai', TRUE);
            $tahunAkhir = (int)$this->input->post('tahun_akhir', TRUE);
            $nama = trim((string)$this->input->post('nama', TRUE));

            // Validasi Kode Instansi
            if ($kodeInstansi === '') { 
                echo json_encode(['status' => 'error', 'message' => 'Kode Instansi wajib diisi!']);
                return; 
            }

            // Cek duplikat kode instansi (kecuali dirinya sendiri)
            $cekKode = $this->db
                ->where('kode_instansi', $kodeInstansi)
                ->where('kodewilayah', $KodeWilayah)
                ->where('id !=', $id)
                ->where('deleted_at IS NULL', null, false)
                ->get('akun_instansi')
                ->num_rows();

            if ($cekKode > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Instansi "' . $kodeInstansi . '" sudah digunakan!']);
                return;
            }

            if (!$tahunMulai || strlen((string)$tahunMulai) != 4) { 
                echo json_encode(['status' => 'error', 'message' => 'Tahun Mulai tidak valid!']);
                return; 
            }
            if (!$tahunAkhir || strlen((string)$tahunAkhir) != 4) { 
                echo json_encode(['status' => 'error', 'message' => 'Tahun Akhir tidak valid!']);
                return; 
            }
            if ($tahunMulai >= $tahunAkhir) { 
                echo json_encode(['status' => 'error', 'message' => 'Tahun Mulai harus lebih kecil dari Tahun Akhir!']);
                return; 
            }

            if ($nama === '') { 
                echo json_encode(['status' => 'error', 'message' => 'Nama instansi wajib diisi!']);
                return; 
            }

            $exist = $this->db->where('id', $id)
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->get('akun_instansi')
                ->row_array();

            if (!$exist) { 
                echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
                return; 
            }

            // ===== KEMENTERIAN =====
            $idKementerianArr = $this->input->post('idkementerian');
            $idKementerianArr = is_array($idKementerianArr)
                ? array_values(array_unique(array_filter(array_map('trim', $idKementerianArr))))
                : [];

            foreach ($idKementerianArr as $kem) {
                $validKem = $this->db->where('Username', $kem)
                    ->where('Level', 1)
                    ->where('deleted_at IS NULL', null, false)
                    ->count_all_results('akun');

                if ($validKem < 1) {
                    echo json_encode(['status' => 'error', 'message' => 'Induk kementerian tidak valid!']);
                    return;
                }
            }
            $idKementerian = !empty($idKementerianArr) ? implode(',', $idKementerianArr) : null;

            $data = [
                'kode_instansi'     => $kodeInstansi,
                'nama'              => $nama,
                'tahun_mulai'       => $tahunMulai,
                'tahun_akhir'       => $tahunAkhir,
                'idkementerian'     => $idKementerian,
                'updated_at'        => date('Y-m-d H:i:s')
            ];

            $pwd = trim((string)$this->input->post('password', TRUE));
            if ($pwd !== '') {
                $data['password'] = password_hash($pwd, PASSWORD_DEFAULT);
            }

            $this->db->where('id', $id);
            $this->db->where('kodewilayah', $KodeWilayah);
            $this->db->update('akun_instansi', $data);

            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil diupdate!']);
            } else {
                echo json_encode(['status' => 'success', 'message' => 'Tidak ada perubahan data!']);
            }
        }

        /**
         * HAPUS INSTANSI (Soft Delete)
         */
        public function HapusInstansi()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $this->_checkSessionWilayah();
            if (!$KodeWilayah) {
                return;
            }

            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }

            // Cek apakah ada sub unit yang terkait
            $subUnitCount = $this->db
                ->where('instansi_id', $id)
                ->where('deleted_at IS NULL', null, false)
                ->count_all_results('sub_unit');

            if ($subUnitCount > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Instansi ini memiliki ' . $subUnitCount . ' sub unit. Hapus sub unit terlebih dahulu!']);
                return;
            }

            $this->db->where('id', $id);
            $this->db->where('kodewilayah', $KodeWilayah);
            $this->db->update('akun_instansi', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
            }
        }

        /**
         * GET INSTANSI BY ID (UNTUK EDIT)
         */
        public function GetInstansiById()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->_getKodeWilayah();

            if ($id <= 0 || empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }

            $data = $this->db
                ->where('id', $id)
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->get('akun_instansi')
                ->row_array();

            if ($data) {
                // Parse idkementerian
                $data['idkementerian_ids'] = !empty($data['idkementerian']) 
                    ? array_filter(array_map('trim', explode(',', $data['idkementerian'])))
                    : [];
                
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }

        // ================================================================
        // CRUD SUB UNIT
        // ================================================================

        /**
         * GET SUB UNIT FOR PARENT DROPDOWN
         */
        public function GetSubUnitForParent()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $instansiId = (int)$this->input->post('instansi_id', TRUE);
            $currentSubUnitId = (int)$this->input->post('current_id', TRUE);
            $KodeWilayah = $this->_getKodeWilayah();

            if ($instansiId <= 0 || empty($KodeWilayah)) {
                echo json_encode([]);
                return;
            }

            $data = $this->db
                ->select('id, kode_sub_unit, nama_sub_unit, level, parent_id')
                ->where('instansi_id', $instansiId)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->order_by('urutan', 'ASC')
                ->order_by('id', 'ASC')
                ->get('sub_unit')
                ->result_array();

            // Filter: exclude current id untuk menghindari self-reference
            if ($currentSubUnitId > 0) {
                $data = array_filter($data, function($item) use ($currentSubUnitId) {
                    return $item['id'] != $currentSubUnitId;
                });
            }

            echo json_encode(array_values($data));
        }

        /**
         * GET SUB UNIT BY INSTANSI ID
         */
        public function GetSubUnitByInstansi()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $instansiId = (int)$this->input->post('instansi_id', TRUE);
            $KodeWilayah = $this->_getKodeWilayah();

            if ($instansiId <= 0 || empty($KodeWilayah)) {
                echo json_encode([]);
                return;
            }

            $data = $this->db
                ->select('su.*')
                ->from('sub_unit su')
                ->where('su.instansi_id', $instansiId)
                ->where('su.kode_wilayah', $KodeWilayah)
                ->where('su.deleted_at IS NULL', null, false)
                ->order_by('su.urutan', 'ASC')
                ->get()
                ->result_array();

            // Parse bidang urusan
            foreach ($data as &$row) {
                $row['bidang_urusan_ids'] = !empty($row['bidang_urusan_id']) 
                    ? array_filter(array_map('trim', explode(',', $row['bidang_urusan_id'])))
                    : [];
            }

            echo json_encode($data);
        }

        /**
         * GET SUB UNIT BY ID
         */
        public function GetSubUnitById()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->_getKodeWilayah();

            if ($id <= 0 || empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }

            $data = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->get('sub_unit')
                ->row_array();

            if ($data) {
                // Parse bidang urusan
                $data['bidang_urusan_ids'] = !empty($data['bidang_urusan_id']) 
                    ? array_filter(array_map('trim', explode(',', $data['bidang_urusan_id'])))
                    : [];
                
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }

        /**
         * INPUT SUB UNIT - Level otomatis 4
         */
        public function InputSubUnit()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $this->_checkSessionWilayah();
            if (!$KodeWilayah) {
                return;
            }

            $instansiId = (int)$this->input->post('instansi_id', TRUE);
            $kodeSubUnit = trim($this->input->post('kode_sub_unit', TRUE));
            $namaSubUnit = trim($this->input->post('nama_sub_unit', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $parentId = (int)$this->input->post('parent_id', TRUE);
            $bidangUrusanArr = $this->input->post('bidang_urusan_id', TRUE);
            
            // LEVEL OTOMATIS 4
            $level = 4;

            // Validasi
            if ($instansiId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Instansi tidak valid!']);
                return;
            }

            if (empty($kodeSubUnit)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Sub Unit harus diisi!']);
                return;
            }

            if (empty($namaSubUnit)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Sub Unit harus diisi!']);
                return;
            }

            if (empty($password)) {
                echo json_encode(['status' => 'error', 'message' => 'Password harus diisi!']);
                return;
            }

            // Cek instansi exists
            $instansi = $this->db
                ->where('id', $instansiId)
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->get('akun_instansi')
                ->row_array();

            if (!$instansi) {
                echo json_encode(['status' => 'error', 'message' => 'Instansi tidak ditemukan!']);
                return;
            }

            // Cek duplikat kode sub unit
            $exists = $this->db
                ->where('instansi_id', $instansiId)
                ->where('kode_sub_unit', $kodeSubUnit)
                ->where('deleted_at IS NULL', null, false)
                ->get('sub_unit')
                ->num_rows();

            if ($exists > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Sub Unit sudah digunakan!']);
                return;
            }

            // Validasi parent_id
            if ($parentId > 0) {
                $parentExists = $this->db
                    ->where('id', $parentId)
                    ->where('instansi_id', $instansiId)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL', null, false)
                    ->get('sub_unit')
                    ->num_rows();
                
                if ($parentExists == 0) {
                    echo json_encode(['status' => 'error', 'message' => 'Parent Sub Unit tidak valid!']);
                    return;
                }
            }

            // Proses bidang urusan
            $bidangUrusanCSV = null;
            if (!empty($bidangUrusanArr) && is_array($bidangUrusanArr)) {
                $bidangUrusanArr = array_values(array_unique(array_filter(array_map('trim', $bidangUrusanArr))));
                if (!empty($bidangUrusanArr)) {
                    $validBidang = $this->db->where_in('Kode', $bidangUrusanArr)
                        ->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1)
                        ->count_all_results('nomenklaturkabupaten');
                    
                    if ($validBidang !== count($bidangUrusanArr)) {
                        echo json_encode(['status' => 'error', 'message' => 'Bidang Urusan tidak valid!']);
                        return;
                    }
                    $bidangUrusanCSV = implode(',', $bidangUrusanArr);
                }
            }

            // Dapatkan urutan terakhir
            $lastUrutan = $this->db
                ->select_max('urutan')
                ->where('instansi_id', $instansiId)
                ->where('deleted_at IS NULL', null, false)
                ->get('sub_unit')
                ->row()
                ->urutan;

            $urutan = ($lastUrutan ? $lastUrutan + 10 : 10);

            $data = [
                'instansi_id'       => $instansiId,
                'kode_sub_unit'     => $kodeSubUnit,
                'nama_sub_unit'     => $namaSubUnit,
                'level'             => $level,
                'password'          => password_hash($password, PASSWORD_DEFAULT),
                'parent_id'         => $parentId > 0 ? $parentId : null,
                'bidang_urusan_id'  => $bidangUrusanCSV,
                'kode_wilayah'      => $KodeWilayah,
                'urutan'            => $urutan,
                'created_at'        => date('Y-m-d H:i:s')
            ];

            $this->db->insert('sub_unit', $data);
            $subUnitId = $this->db->insert_id();

            if ($subUnitId) {
                $newData = $this->db->where('id', $subUnitId)->get('sub_unit')->row_array();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Sub Unit berhasil ditambahkan!',
                    'data' => $newData
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
            }
        }

        /**
         * EDIT SUB UNIT - Level otomatis 4
         */
        public function EditSubUnit()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $this->_checkSessionWilayah();
            if (!$KodeWilayah) {
                return;
            }

            $id = (int)$this->input->post('id', TRUE);
            $instansiId = (int)$this->input->post('instansi_id', TRUE);
            $kodeSubUnit = trim($this->input->post('kode_sub_unit', TRUE));
            $namaSubUnit = trim($this->input->post('nama_sub_unit', TRUE));
            $password = trim($this->input->post('password', TRUE));
            $parentId = (int)$this->input->post('parent_id', TRUE);
            $bidangUrusanArr = $this->input->post('bidang_urusan_id', TRUE);
            
            // LEVEL OTOMATIS 4
            $level = 4;

            // Validasi
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }

            if ($instansiId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Instansi tidak valid!']);
                return;
            }

            if (empty($kodeSubUnit)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Sub Unit harus diisi!']);
                return;
            }

            if (empty($namaSubUnit)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Sub Unit harus diisi!']);
                return;
            }

            // Cek data ada
            $existing = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->get('sub_unit')
                ->row_array();

            if (!$existing) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                return;
            }

            // Cek duplikat kode sub unit
            $exists = $this->db
                ->where('instansi_id', $instansiId)
                ->where('kode_sub_unit', $kodeSubUnit)
                ->where('id !=', $id)
                ->where('deleted_at IS NULL', null, false)
                ->get('sub_unit')
                ->num_rows();

            if ($exists > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Sub Unit sudah digunakan!']);
                return;
            }

            // Validasi parent_id
            if ($parentId > 0) {
                $parentExists = $this->db
                    ->where('id', $parentId)
                    ->where('instansi_id', $instansiId)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL', null, false)
                    ->get('sub_unit')
                    ->num_rows();
                
                if ($parentExists == 0) {
                    echo json_encode(['status' => 'error', 'message' => 'Parent Sub Unit tidak valid!']);
                    return;
                }
            }

            // Proses bidang urusan
            $bidangUrusanCSV = null;
            if (!empty($bidangUrusanArr) && is_array($bidangUrusanArr)) {
                $bidangUrusanArr = array_values(array_unique(array_filter(array_map('trim', $bidangUrusanArr))));
                if (!empty($bidangUrusanArr)) {
                    $validBidang = $this->db->where_in('Kode', $bidangUrusanArr)
                        ->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1)
                        ->count_all_results('nomenklaturkabupaten');
                    
                    if ($validBidang !== count($bidangUrusanArr)) {
                        echo json_encode(['status' => 'error', 'message' => 'Bidang Urusan tidak valid!']);
                        return;
                    }
                    $bidangUrusanCSV = implode(',', $bidangUrusanArr);
                }
            }

            $data = [
                'instansi_id'       => $instansiId,
                'kode_sub_unit'     => $kodeSubUnit,
                'nama_sub_unit'     => $namaSubUnit,
                'level'             => $level,
                'parent_id'         => $parentId > 0 ? $parentId : null,
                'bidang_urusan_id'  => $bidangUrusanCSV,
                'updated_at'        => date('Y-m-d H:i:s')
            ];

            // Update password jika diisi
            if (!empty($password)) {
                $data['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            $this->db->where('id', $id);
            $this->db->update('sub_unit', $data);

            if ($this->db->affected_rows() > 0) {
                $updatedData = $this->db->where('id', $id)->get('sub_unit')->row_array();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Sub Unit berhasil diupdate!',
                    'data' => $updatedData
                ]);
            } else {
                echo json_encode(['status' => 'success', 'message' => 'Tidak ada perubahan data!']);
            }
        }

        /**
         * HAPUS SUB UNIT (Soft Delete)
         */
        public function HapusSubUnit()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $this->_checkSessionWilayah();
            if (!$KodeWilayah) {
                return;
            }

            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }

            // Cek apakah ada sub unit lain yang menggunakan ini sebagai parent
            $childExists = $this->db
                ->where('parent_id', $id)
                ->where('deleted_at IS NULL', null, false)
                ->get('sub_unit')
                ->num_rows();

            if ($childExists > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Sub Unit ini memiliki anak, hapus anak terlebih dahulu!']);
                return;
            }

            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $KodeWilayah);
            $this->db->update('sub_unit', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            if ($this->db->affected_rows() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Sub Unit berhasil dihapus!']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
            }
        }

        /**
         * REORDER SUB UNIT
         */
        public function ReorderSubUnit()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $this->_checkSessionWilayah();
            if (!$KodeWilayah) {
                return;
            }

            $orderData = $this->input->post('order_data', TRUE);

            if (empty($orderData) || !is_array($orderData)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                return;
            }

            $success = 0;
            $failed = 0;

            foreach ($orderData as $item) {
                $id = (int)$item['id'];
                $urutan = (int)$item['urutan'];

                if ($id > 0) {
                    $this->db->where('id', $id);
                    $this->db->where('kode_wilayah', $KodeWilayah);
                    $result = $this->db->update('sub_unit', ['urutan' => $urutan]);

                    if ($result) {
                        $success++;
                    } else {
                        $failed++;
                    }
                }
            }

            echo json_encode([
                'status' => 'success',
                'message' => "Berhasil mengupdate $success data, gagal $failed data!"
            ]);
        }

    public function Akun_Karyawan()
    {
        $Header['Halaman'] = 'Kelola Karyawan';

        $KodeWilayah = '';
        if (isset($_SESSION['KodeWilayah']) && !empty($_SESSION['KodeWilayah'])) {
            $KodeWilayah = $_SESSION['KodeWilayah'];
        } elseif (isset($_SESSION['TempKodeWilayah']) && !empty($_SESSION['TempKodeWilayah'])) {
            $KodeWilayah = $_SESSION['TempKodeWilayah'];
        }

        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['Provinsi'] = $this->db
            ->select('Kode, Nama')
            ->where('LENGTH(Kode)=2', null, false)
            ->order_by('Nama', 'ASC')
            ->get('kodewilayah')
            ->result_array();

        if (empty($KodeWilayah)) {
            $Data['DaftarDinas'] = [];
            $Data['Karyawan'] = [];
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/Akun_Karyawan', $Data);
            return;
        }

        $Data['DaftarDinas'] = $this->db
            ->select('id, nama, tahun_mulai, tahun_akhir')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->order_by('nama', 'ASC')
            ->get('akun_instansi')
            ->result_array();

        $Data['Karyawan'] = $this->db
            ->select('id, kodewilayah, nama, nip, eselon, jabatan, satuan_unit_kerja, bidang_sub_koordinator, password, tahun_mulai, tahun_akhir, Level, dinas_id, created_at, updated_at, deleted_at')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->order_by('id', 'ASC')
            ->get('akun_karyawan')
            ->result_array();

        $mapDinas = [];
        foreach ($Data['DaftarDinas'] as $d) {
            $mapDinas[$d['id']] = $d['nama'];
        }

        foreach ($Data['Karyawan'] as &$k) {
            $ids = [];
            if (!empty($k['dinas_id'])) {
                $ids = array_filter(array_map('trim', explode(',', $k['dinas_id'])));
            }

            $names = [];
            foreach ($ids as $id) {
                if (isset($mapDinas[$id])) {
                    $names[] = $mapDinas[$id];
                }
            }
            $k['dinas_nama'] = !empty($names) ? implode(', ', $names) : '-';
        }
        unset($k);

        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/Akun_Karyawan', $Data);
    }

    public function InputKaryawan()
    {
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
        if (!$KodeWilayah) {
            echo 'KodeWilayah tidak ditemukan di session!';
            return;
        }

        $tahunMulai = (int)$this->input->post('tahun_mulai', TRUE);
        $tahunAkhir = (int)$this->input->post('tahun_akhir', TRUE);

        if (!$tahunMulai || strlen((string)$tahunMulai) != 4) {
            echo 'Tahun Mulai tidak valid!';
            return;
        }
        if (!$tahunAkhir || strlen((string)$tahunAkhir) != 4) {
            echo 'Tahun Akhir tidak valid!';
            return;
        }
        if ($tahunMulai >= $tahunAkhir) {
            echo 'Tahun Mulai harus lebih kecil dari Tahun Akhir!';
            return;
        }

        $nama = trim((string)$this->input->post('nama', TRUE));
        $nip  = trim((string)$this->input->post('nip', TRUE));
        $eselon = trim((string)$this->input->post('eselon', TRUE));
        $jabatan = trim((string)$this->input->post('jabatan', TRUE));
        $satuan_unit_kerja = trim((string)$this->input->post('satuan_unit_kerja', TRUE));
        $bidang_sub_koordinator = trim((string)$this->input->post('bidang_sub_koordinator', TRUE));
        $pwd  = trim((string)$this->input->post('password', TRUE));

        if ($nama === '') {
            echo 'Nama karyawan wajib diisi!';
            return;
        }
        if ($nip === '') {
            echo 'NIP wajib diisi!';
            return;
        }
        if ($jabatan === '') {
            echo 'Jabatan wajib diisi!';
            return;
        }
        if ($pwd === '') {
            echo 'Password wajib diisi!';
            return;
        }

        $cekNip = $this->db
            ->where('nip', $nip)
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->get('akun_karyawan')
            ->num_rows();

        if ($cekNip > 0) {
            echo 'NIP sudah terdaftar!';
            return;
        }

        $dinasArr = $this->input->post('dinas_id');
        if (!is_array($dinasArr) || count(array_filter($dinasArr)) < 1) {
            echo 'Dinas terkait wajib dipilih minimal 1!';
            return;
        }

        $dinasArr = array_values(array_unique(array_filter(array_map('intval', $dinasArr))));
        sort($dinasArr);

        $validCount = $this->db->where_in('id', $dinasArr)
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->count_all_results('akun_instansi');

        if ($validCount !== count($dinasArr)) {
            echo 'Dinas tidak valid (beda wilayah / tidak aktif)!';
            return;
        }

        $data = [
            'kodewilayah'   => $KodeWilayah,
            'nama'          => $nama,
            'nip'           => $nip,
            'eselon'        => $eselon ?: null,
            'jabatan'       => $jabatan,
            'satuan_unit_kerja' => $satuan_unit_kerja,
            'bidang_sub_koordinator' => $bidang_sub_koordinator ?: null,
            'password'      => password_hash($pwd, PASSWORD_DEFAULT),
            'tahun_mulai'   => $tahunMulai,
            'tahun_akhir'   => $tahunAkhir,
            'Level'         => 4,
            'dinas_id'      => implode(',', $dinasArr),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        $this->db->insert('akun_karyawan', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
    }

    public function EditKaryawan()
    {
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
        if (!$KodeWilayah) {
            echo 'KodeWilayah tidak ditemukan di session!';
            return;
        }

        $id = (int)$this->input->post('id', TRUE);
        if ($id <= 0) {
            echo 'ID tidak valid!';
            return;
        }

        $tahunMulai = (int)$this->input->post('tahun_mulai', TRUE);
        $tahunAkhir = (int)$this->input->post('tahun_akhir', TRUE);

        if (!$tahunMulai || strlen((string)$tahunMulai) != 4) {
            echo 'Tahun Mulai tidak valid!';
            return;
        }
        if (!$tahunAkhir || strlen((string)$tahunAkhir) != 4) {
            echo 'Tahun Akhir tidak valid!';
            return;
        }
        if ($tahunMulai >= $tahunAkhir) {
            echo 'Tahun Mulai harus lebih kecil dari Tahun Akhir!';
            return;
        }

        $nama = trim((string)$this->input->post('nama', TRUE));
        $nip = trim((string)$this->input->post('nip', TRUE));
        $eselon = trim((string)$this->input->post('eselon', TRUE));
        $jabatan = trim((string)$this->input->post('jabatan', TRUE));
        $satuan_unit_kerja = trim((string)$this->input->post('satuan_unit_kerja', TRUE));
        $bidang_sub_koordinator = trim((string)$this->input->post('bidang_sub_koordinator', TRUE));

        if ($nama === '') {
            echo 'Nama karyawan wajib diisi!';
            return;
        }
        if ($nip === '') {
            echo 'NIP wajib diisi!';
            return;
        }
        if ($jabatan === '') {
            echo 'Jabatan wajib diisi!';
            return;
        }

        $exist = $this->db->where('id', $id)
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->get('akun_karyawan')
            ->row_array();

        if (!$exist) {
            echo 'Data karyawan tidak ditemukan / beda wilayah!';
            return;
        }

        $cekNip = $this->db
            ->where('nip', $nip)
            ->where('id !=', $id)
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->get('akun_karyawan')
            ->num_rows();

        if ($cekNip > 0) {
            echo 'NIP sudah digunakan karyawan lain!';
            return;
        }

        $dinasArr = $this->input->post('dinas_id');
        if (!is_array($dinasArr) || count(array_filter($dinasArr)) < 1) {
            echo 'Dinas terkait wajib dipilih minimal 1!';
            return;
        }

        $dinasArr = array_values(array_unique(array_filter(array_map('intval', $dinasArr))));
        sort($dinasArr);

        $validCount = $this->db->where_in('id', $dinasArr)
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->count_all_results('akun_instansi');

        if ($validCount !== count($dinasArr)) {
            echo 'Dinas tidak valid (beda wilayah / tidak aktif)!';
            return;
        }

        $data = [
            'nama'          => $nama,
            'nip'           => $nip,
            'eselon'        => $eselon ?: null,
            'jabatan'       => $jabatan,
            'satuan_unit_kerja' => $satuan_unit_kerja,
            'bidang_sub_koordinator' => $bidang_sub_koordinator ?: null,
            'tahun_mulai'   => $tahunMulai,
            'tahun_akhir'   => $tahunAkhir,
            'dinas_id'      => implode(',', $dinasArr),
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        $pwd = trim((string)$this->input->post('password', TRUE));
        if ($pwd !== '') {
            $data['password'] = password_hash($pwd, PASSWORD_DEFAULT);
        }

        $this->db->where('id', $id);
        $this->db->where('kodewilayah', $KodeWilayah);
        $this->db->update('akun_karyawan', $data);

        echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
    }

            public function HapusKaryawan()
    {
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
        if (!$KodeWilayah) {
            echo 'KodeWilayah tidak ditemukan di session!';
            return;
        }

        $id = (int)$this->input->post('id', TRUE);
        if ($id <= 0) {
            echo 'ID tidak valid!';
            return;
        }

        $this->db->where('id', $id);
        $this->db->where('kodewilayah', $KodeWilayah);
        $this->db->update('akun_karyawan', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        echo $this->db->affected_rows() ? '1' : 'Gagal hapus / beda wilayah';
    }
        
        public function IKU() {
                $Header['Halaman'] = 'Cascading';
                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima untuk IKU: ' . $KodeWilayah);

                $Data = [];
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        $Data['Periods'] = $this->db->query(
                            "SELECT DISTINCT TahunMulai, TahunAkhir 
                            FROM visirpjmd 
                            WHERE KodeWilayah = ? 
                            AND deleted_at IS NULL 
                            ORDER BY TahunMulai",
                            [$KodeWilayah]
                        )->result_array();
                        $Data['Iku'] = $this->db->query(
                            "SELECT i.*, v.TahunMulai, v.TahunAkhir
                            FROM iku i
                            JOIN tujuanrpjmd t ON i.IdTujuan = t.Id
                            JOIN misirpjmd m ON t._Id = m.Id
                            JOIN visirpjmd v ON m._Id = v.Id
                            WHERE i.deleted_at IS NULL 
                            AND i.kodewilayah = ?",
                            [$KodeWilayah]
                        )->result_array();
                        $Data['Tujuan'] = $this->db->where('deleted_at IS NULL')
                                                ->where('kodewilayah', $KodeWilayah)
                                                ->get('tujuanrpjmd')
                                                ->result_array();
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['Periods'] = [];
                        $Data['Iku'] = [];
                        $Data['Tujuan'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['Periods'] = [];
                    $Data['Iku'] = [];
                    $Data['Tujuan'] = [];
                }

                log_message('debug', 'Jumlah periode: ' . count($Data['Periods']) . ', Jumlah IKU: ' . count($Data['Iku']));
                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/Iku', $Data);
            }

        public function GetTujuanByPeriod() {
            $tahunMulai = $this->input->post('tahun_mulai');
            $tahunAkhir = $this->input->post('tahun_akhir');
            
            $query = $this->db->query("
                SELECT t.Id, t.Tujuan 
                FROM tujuanrpjmd t
                JOIN misirpjmd m ON t._Id = m.Id
                JOIN visirpjmd v ON m._Id = v.Id
                WHERE v.TahunMulai = ? 
                AND v.TahunAkhir = ?
                AND t.KodeWilayah = ?
                AND t.deleted_at IS NULL
            ", array($tahunMulai, $tahunAkhir, $_SESSION['KodeWilayah']));
            
            echo json_encode($query->result_array());
        }

        public function TambahIku() {
        $period = explode('-', $this->input->post('TahunFilter'));
        
        $data = [
            'kodewilayah' => $_SESSION['KodeWilayah'],
            'IdTujuan' => $this->input->post('Tujuan'),
            'tahun_mulai' => $period[0],
            'tahun_akhir' => $period[1],
            'indikator_tujuan' => $this->input->post('indikator_tujuan'),
            'target_1' => $this->input->post('target_1') ?: null,
            'target_2' => $this->input->post('target_2') ?: null,
            'target_3' => $this->input->post('target_3') ?: null,
            'target_4' => $this->input->post('target_4') ?: null,
            'target_5' => $this->input->post('target_5') ?: null
        ];
        
        $this->db->insert('iku', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
        }

        public function EditIku() {
        $period = explode('-', $this->input->post('periode'));
        
        $data = [
            'IdTujuan' => $this->input->post('EditTujuan'),
            'tahun_mulai' => $period[0],
            'tahun_akhir' => $period[1],
            'indikator_tujuan' => $this->input->post('indikator_tujuan'),
            'target_1' => $this->input->post('target_1') ?: null,
            'target_2' => $this->input->post('target_2') ?: null,
            'target_3' => $this->input->post('target_3') ?: null,
            'target_4' => $this->input->post('target_4') ?: null,
            'target_5' => $this->input->post('target_5') ?: null,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('iku', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
        }

        public function HapusIku() {
            $id = $this->input->post('id');
            $this->db->where('id', $id)->update('iku', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            echo $this->db->affected_rows() ? '1' : '0';
        }

        public function IKD() {
                $Header['Halaman'] = 'Cascading';
                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima untuk IKD: ' . $KodeWilayah);

                $Data = [];
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        $Data['Periods'] = $this->db->query(
                            "SELECT DISTINCT TahunMulai, TahunAkhir 
                            FROM visirpjmd 
                            WHERE KodeWilayah = ? 
                            AND deleted_at IS NULL 
                            ORDER BY TahunMulai",
                            [$KodeWilayah]
                        )->result_array();
                        $Data['Ikd'] = $this->db->query(
                            "SELECT i.*, v.TahunMulai, v.TahunAkhir
                            FROM ikd i
                            JOIN sasaranrpjmd s ON i.IdSasaran = s.Id
                            JOIN tujuanrpjmd t ON s._Id = t.Id
                            JOIN misirpjmd m ON t._Id = m.Id
                            JOIN visirpjmd v ON m._Id = v.Id
                            WHERE i.deleted_at IS NULL 
                            AND i.kodewilayah = ?",
                            [$KodeWilayah]
                        )->result_array();
                        $Data['Sasaran'] = $this->db->where('deleted_at IS NULL')
                                                    ->where('kodewilayah', $KodeWilayah)
                                                    ->get('sasaranrpjmd')
                                                    ->result_array();
                        $Data['Instansi'] = $this->db->where('deleted_at IS NULL')
                                                    ->where('kodewilayah', $KodeWilayah)
                                                    ->get('akun_instansi')
                                                    ->result_array();
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['Periods'] = [];
                        $Data['Ikd'] = [];
                        $Data['Sasaran'] = [];
                        $Data['Instansi'] = [];
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['Periods'] = [];
                    $Data['Ikd'] = [];
                    $Data['Sasaran'] = [];
                    $Data['Instansi'] = [];
                }

                log_message('debug', 'Jumlah periode: ' . count($Data['Periods']) . ', Jumlah IKD: ' . count($Data['Ikd']));
                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/Ikd', $Data);
            }

        public function GetSasaranByPeriod() {
        $tahunMulai = $this->input->post('tahun_mulai');
        $tahunAkhir = $this->input->post('tahun_akhir');
        
        $query = $this->db->query("
            SELECT s.Id, s.Sasaran 
            FROM sasaranrpjmd s
            JOIN tujuanrpjmd t ON s._Id = t.Id
            JOIN misirpjmd m ON t._Id = m.Id
            JOIN visirpjmd v ON m._Id = v.Id
            WHERE v.TahunMulai = ? 
            AND v.TahunAkhir = ?
            AND s.KodeWilayah = ?
            AND s.deleted_at IS NULL
        ", array($tahunMulai, $tahunAkhir, $_SESSION['KodeWilayah']));
        
        echo json_encode($query->result_array());
        }

        public function TambahIsuStrategis() {
            try {
                $id = $this->input->post('id', TRUE);
                $isuStrategis = $this->input->post('isu_strategis', TRUE);

                if (empty($id) || !is_numeric($id)) {
                    throw new Exception('ID tidak valid');
                }
                if (empty($isuStrategis)) {
                    throw new Exception('Isu Strategis harus diisi');
                }

                // Get existing data
                $existing = $this->db->where('id', $id)->get('ikd')->row_array();
                if (!$existing) {
                    throw new Exception('Data IKD tidak ditemukan');
                }

                // Combine with existing Isu Strategis
                $existingIsu = !empty($existing['isu_strategis']) ? explode(',', $existing['isu_strategis']) : [];
                $newIsu = explode(',', $isuStrategis);
                $combinedIsu = array_unique(array_merge($existingIsu, $newIsu));
                $updateData = [
                    'isu_strategis' => implode(',', $combinedIsu),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->db->where('id', $id)->update('ikd', $updateData);
                echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
            } catch (Exception $e) {
                log_message('error', 'Error adding Isu Strategis: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        public function EditIsuStrategis() {
            try {
                $id = $this->input->post('id', TRUE);
                $isuStrategis = $this->input->post('isu_strategis', TRUE);

                if (empty($id) || !is_numeric($id)) {
                    throw new Exception('ID tidak valid');
                }

                $updateData = [
                    'isu_strategis' => $isuStrategis,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->db->where('id', $id)->update('ikd', $updateData);
                echo $this->db->affected_rows() ? '1' : 'Gagal Update Data';
            } catch (Exception $e) {
                log_message('error', 'Error editing Isu Strategis: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        public function TambahIkd() {
        $period = explode('-', $this->input->post('TahunFilter'));
        
        $data = [
            'kodewilayah' => $_SESSION['KodeWilayah'],
            'IdSasaran' => $this->input->post('Sasaran'),
            'tahun_mulai' => $period[0],
            'tahun_akhir' => $period[1],
            'indikator_sasaran' => $this->input->post('indikator_sasaran'),
            'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
            'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
            'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
            'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
            'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null
        ];
        
        $this->db->insert('ikd', $data);
        echo $this->db->affected_rows() ? '1' : '0';
        }

        public function EditIkd() {
        $period = explode('-', $this->input->post('periode'));
        
        $data = [
            'IdSasaran' => $this->input->post('EditSasaran'),
            'tahun_mulai' => $period[0],
            'tahun_akhir' => $period[1],
            'indikator_sasaran' => $this->input->post('indikator_sasaran'),
            'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
            'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
            'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
            'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
            'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $this->input->post('id'))->update('ikd', $data);
        echo $this->db->affected_rows() ? '1' : '0';
        }

        public function HapusIkd() {
        $id = $this->input->post('id');
        $this->db->where('id', $id)->update('ikd', ['deleted_at' => date('Y-m-d H:i:s')]);
        echo $this->db->affected_rows() ? '1' : '0';
        }

        // In SuperDaerah.php controller

        public function TambahPd() {
        try {
            // Validate input
            $id = $this->input->post('id', true);
            if (empty($id) || !is_numeric($id)) {
                throw new Exception('Invalid ID');
            }

            // Get existing data
            $existing = $this->db->where('id', $id)->get('ikd')->row_array();
            if (!$existing) {
                throw new Exception('Data not found');
            }

            // Prepare update data
            $updateData = ['updated_at' => date('Y-m-d H:i:s')];
            
            // Check which PD type we're adding
            if ($this->input->post('pd_penanggung_jawab')) {
                $penanggungJawab = $this->input->post('pd_penanggung_jawab', true);
                $existingPJ = !empty($existing['pd_penanggung_jawab']) ? explode(',', $existing['pd_penanggung_jawab']) : [];
                
                if (!in_array($penanggungJawab, $existingPJ)) {
                    $existingPJ[] = $penanggungJawab;
                    $updateData['pd_penanggung_jawab'] = implode(',', array_filter($existingPJ));
                }
            } elseif ($this->input->post('pd_penunjang')) {
                $penunjang = $this->input->post('pd_penunjang', true);
                $existingPN = !empty($existing['pd_penunjang']) ? explode(',', $existing['pd_penunjang']) : [];
                
                if (!in_array($penunjang, $existingPN)) {
                    $existingPN[] = $penunjang;
                    $updateData['pd_penunjang'] = implode(',', array_filter($existingPN));
                }
            } else {
                throw new Exception('No PD type specified');
            }

            // Update the database
            $this->db->where('id', $id)->update('ikd', $updateData);

            if ($this->db->affected_rows() > 0) {
                echo '1';
            } else {
                throw new Exception('No changes made');
            }
        } catch (Exception $e) {
            log_message('error', 'Error adding PD: ' . $e->getMessage());
            echo $e->getMessage();
        }
        }

        // Keep the existing EditPDIKD method as is
        public function EditPDIKD() {  
        $this->db->where('id', $_POST['id']); 
        $this->db->update('ikd', $_POST);
        if ($this->db->affected_rows()) {
            echo '1';
        } else {
            echo 'Gagal Update Data!';
        }
        }

        /**
     * Halaman Utama Potensi Daerah
     * URL: Daerah/PotensiDaerah
     */
    public function PotensiDaerah() {
        $Header['Halaman'] = 'Potensi Daerah';
        
        // Ambil KodeWilayah dari session
        $KodeWilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') 
                    ?? '';
        
        // Data untuk filter provinsi
        $Data['Provinsi'] = $this->db
            ->where("Kode LIKE '__'")
            ->order_by('Nama')
            ->get('kodewilayah')
            ->result_array();
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        
        // Ambil periode RPJMD untuk dropdown
        $Data['Periods'] = [];
        if (!empty($KodeWilayah)) {
            // Ambil nama wilayah
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
            
            // Ambil periode RPJMD
            $Data['Periods'] = $this->db
                ->distinct()
                ->select('TahunMulai, TahunAkhir')
                ->where('KodeWilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('TahunMulai', 'DESC')
                ->get('visirpjmd')
                ->result_array();
            
            // Ambil data Potensi Daerah
            $Data['PotensiDaerah'] = $this->db
                ->where('KodeWilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('Id', 'ASC')
                ->get('potensidaerah')
                ->result_array();
        } else {
            $Data['PotensiDaerah'] = [];
        }
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/PotensiDaerah', $Data);
    }

        // ============================================================
        // POTENSI DAERAH - CRUD
        // ============================================================

        /**
         * INPUT POTENSI DAERAH
         */
        public function InputPotensiDaerah() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo 'Wilayah belum dipilih!';
                    return;
                }
                
                $periode = explode('-', $this->input->post('PeriodeRPJMD', TRUE));
                $namaPotensi = trim($this->input->post('NamaPotensiDaerah', TRUE));
                
                if (empty($namaPotensi)) {
                    echo 'Nama Potensi Daerah harus diisi!';
                    return;
                }
                
                $data = [
                    'KodeWilayah' => $kodeWilayah,
                    'NamaPotensiDaerah' => $namaPotensi,
                    'TahunMulai' => $periode[0],
                    'TahunAkhir' => $periode[1],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('potensidaerah', $data);
                
                echo $this->db->affected_rows() > 0 ? '1' : 'Gagal Menyimpan Data!';
                
            } catch (Exception $e) {
                log_message('error', 'Error InputPotensiDaerah: ' . $e->getMessage());
                echo 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

        /**
         * UPDATE POTENSI DAERAH
         */
        public function UpdatePotensiDaerah() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo 'Wilayah belum dipilih!';
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $periode = explode('-', $this->input->post('PeriodeRPJMD', TRUE));
                $namaPotensi = trim($this->input->post('NamaPotensiDaerah', TRUE));
                
                if ($id <= 0) {
                    echo 'ID tidak valid!';
                    return;
                }
                
                if (empty($namaPotensi)) {
                    echo 'Nama Potensi Daerah harus diisi!';
                    return;
                }
                
                // Cek apakah data ada
                $exists = $this->db->where('Id', $id)
                                ->where('KodeWilayah', $kodeWilayah)
                                ->where('deleted_at IS NULL')
                                ->get('potensidaerah')
                                ->num_rows();
                
                if ($exists == 0) {
                    echo 'Data tidak ditemukan!';
                    return;
                }
                
                $data = [
                    'NamaPotensiDaerah' => $namaPotensi,
                    'TahunMulai' => $periode[0],
                    'TahunAkhir' => $periode[1],
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('Id', $id)
                        ->where('KodeWilayah', $kodeWilayah)
                        ->update('potensidaerah', $data);
                
                echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data';
                
            } catch (Exception $e) {
                log_message('error', 'Error UpdatePotensiDaerah: ' . $e->getMessage());
                echo 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

        /**
         * DELETE POTENSI DAERAH (Soft Delete)
         */
        public function DeletePotensiDaerah() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo 'Wilayah belum dipilih!';
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                
                if ($id <= 0) {
                    echo 'ID tidak valid!';
                    return;
                }
                
                // Cek apakah data ada
                $exists = $this->db->where('Id', $id)
                                ->where('KodeWilayah', $kodeWilayah)
                                ->where('deleted_at IS NULL')
                                ->get('potensidaerah')
                                ->num_rows();
                
                if ($exists == 0) {
                    echo 'Data tidak ditemukan!';
                    return;
                }
                
                $this->db->where('Id', $id)
                        ->where('KodeWilayah', $kodeWilayah)
                        ->update('potensidaerah', [
                            'deleted_at' => date('Y-m-d H:i:s')
                        ]);
                
                echo $this->db->affected_rows() > 0 ? '1' : 'Gagal Hapus Data!';
                
            } catch (Exception $e) {
                log_message('error', 'Error DeletePotensiDaerah: ' . $e->getMessage());
                echo 'Terjadi kesalahan: ' . $e->getMessage();
            }
        }

        public function GetKementerian() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $tahunMulai = (int)$this->input->post('TahunMulai', TRUE);
            
            if ($tahunMulai <= 0) {
                echo json_encode([]);
                return;
            }
            
            $query = $this->db->query(
                "SELECT * FROM kementerian WHERE TahunMulai = ? AND deleted_at IS NULL ORDER BY NamaKementerian ASC",
                array($tahunMulai)
            );
            
            echo json_encode($query->result_array());
        }

        public function GetPermasalahanPokokNasional() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $idKementerian = (int)$this->input->post('Id', TRUE);
            
            if ($idKementerian <= 0) {
                echo json_encode([]);
                return;
            }
            
            $query = $this->db->query(
                "SELECT * FROM permasalahan_pokok WHERE IdKementerian = ? AND deleted_at IS NULL ORDER BY NamaPermasalahanPokok ASC",
                array($idKementerian)
            );
            
            echo json_encode($query->result_array());
        }

        public function GetPeriodePermasalahanPokokNasional() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            
            if ($id <= 0) {
                echo json_encode([]);
                return;
            }
            
            // PERBAIKAN: Ambil data kementerian langsung berdasarkan ID
            $query = $this->db->query("
                SELECT Id, NamaKementerian, TahunMulai, TahunAkhir 
                FROM kementerian 
                WHERE Id = ? 
                AND deleted_at IS NULL
            ", array($id));
            
            $result = $query->result_array();
            
            // Jika tidak ditemukan, coba cari melalui permasalahan_pokok
            if (empty($result)) {
                $query2 = $this->db->query("
                    SELECT k.Id, k.NamaKementerian, k.TahunMulai, k.TahunAkhir 
                    FROM kementerian k
                    JOIN permasalahan_pokok pp ON pp.IdKementerian = k.Id
                    WHERE pp.Id = ? 
                    AND pp.deleted_at IS NULL
                    AND k.deleted_at IS NULL
                ", array($id));
                $result = $query2->result_array();
            }
            
            // Jika masih kosong, coba ambil semua data kementerian
            if (empty($result)) {
                $query3 = $this->db->query("
                    SELECT Id, NamaKementerian, TahunMulai, TahunAkhir 
                    FROM kementerian 
                    WHERE deleted_at IS NULL
                    LIMIT 1
                ");
                $result = $query3->result_array();
            }
            
            echo json_encode($result);
        }

        public function GetKementerianById() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            
            if ($id <= 0) {
                echo json_encode([]);
                return;
            }
            
            $query = $this->db->query("
                SELECT Id, NamaKementerian, TahunMulai, TahunAkhir 
                FROM kementerian 
                WHERE Id = ? 
                AND deleted_at IS NULL
            ", array($id));
            
            echo json_encode($query->result_array());
        }

        // ============================================================
            // PERMASALAHAN POKOK - MAIN PAGE
            // ============================================================
            // Halaman Permasalahan Pokok
        public function PermasalahanPokok() {
            $Header['Halaman'] = 'Isudaerah';
            
            $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

            log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

            $query = $this->db->query("
                SELECT DISTINCT TahunMulai, TahunAkhir 
                FROM visirpjmd 
                WHERE KodeWilayah = ? AND deleted_at IS NULL
                ORDER BY TahunMulai
            ", array($KodeWilayah));
            $Data['Periods'] = $query->result_array();
            
            // ==========================================================
            // AMBIL DATA PERMASALAHAN POKOK
            // ==========================================================
            $query = $this->db->query("
                SELECT p.* 
                FROM permasalahanpokokdaerah p
                WHERE p.KodeWilayah = ? 
                AND p.deleted_at IS NULL
                ORDER BY p.Id DESC
            ", array($KodeWilayah));
            $Data['PermasalahanPokokRaw'] = $query->result_array();
            
            // ==========================================================
            // PROSES DATA UNTUK MENAMBAHKAN NamaKementerian DAN NamaPermasalahanNasional
            // ==========================================================
            $Data['PermasalahanPokok'] = array();
            
            foreach ($Data['PermasalahanPokokRaw'] as $row) {
                $permIds = !empty($row['_Id']) ? explode('$', $row['_Id']) : array();
                $kementerianNames = array();
                $kementerianIds = array();
                
                foreach ($permIds as $id) {
                    if (!empty($id) && is_numeric($id)) {
                        // Ambil data permasalahan pokok nasional
                        $permData = $this->db->query("
                            SELECT pp.IdKementerian, pp.NamaPermasalahanPokok, k.NamaKementerian
                            FROM permasalahan_pokok pp
                            LEFT JOIN kementerian k ON k.Id = pp.IdKementerian AND k.deleted_at IS NULL
                            WHERE pp.Id = ? AND pp.deleted_at IS NULL
                        ", array($id))->row_array();
                        
                        if ($permData) {
                            // Simpan nama permasalahan untuk display
                            if (!empty($permData['NamaPermasalahanPokok'])) {
                                // Akan diproses nanti di view
                            }
                            
                            // Kumpulkan ID Kementerian
                            if (!empty($permData['IdKementerian'])) {
                                $kementerianIds[] = $permData['IdKementerian'];
                            }
                        }
                    }
                }
                
                // Ambil nama kementerian dari ID yang unik
                $kementerianIds = array_unique($kementerianIds);
                $kementerianNames = array();
                
                if (!empty($kementerianIds)) {
                    $kemQuery = $this->db->query("
                        SELECT NamaKementerian 
                        FROM kementerian 
                        WHERE Id IN (" . implode(',', $kementerianIds) . ")
                        AND deleted_at IS NULL
                    ");
                    $kementerianNames = array_column($kemQuery->result_array(), 'NamaKementerian');
                }
                
                // Tambahkan data ke array
                $row['NamaKementerian'] = !empty($kementerianNames) ? implode('; ', $kementerianNames) : '';
                $row['NamaPermasalahanNasional'] = ''; // Akan diisi di view menggunakan $Permasalahan
                $row['IdKementerian'] = !empty($kementerianIds) ? implode(',', $kementerianIds) : '';
                
                $Data['PermasalahanPokok'][] = $row;
            }

            // ==========================================================
            // AMBIL DATA UNTUK DROPDOWN
            // ==========================================================
            $Data['PeriodePermasalahanPokokNasional'] = $this->db->query("
                SELECT DISTINCT TahunMulai, TahunAkhir 
                FROM kementerian 
                WHERE deleted_at IS NULL
                ORDER BY TahunMulai DESC
            ")->result_array();
            
            $ListKementerian = $this->db->query("
                SELECT k.*, 
                    GROUP_CONCAT(pp.Id) as PermasalahanIds,
                    GROUP_CONCAT(pp.NamaPermasalahanPokok SEPARATOR '||') as PermasalahanNames
                FROM kementerian k
                LEFT JOIN permasalahan_pokok pp ON pp.IdKementerian = k.Id AND pp.deleted_at IS NULL
                WHERE k.deleted_at IS NULL
                GROUP BY k.Id
                ORDER BY k.TahunMulai DESC, k.NamaKementerian ASC
            ")->result_array();
            
            $Data['Kementerian'] = array();
            $Data['Permasalahan'] = array();
            
            foreach ($ListKementerian as $key) {
                $Data['Kementerian'][$key['Id']] = $key['NamaKementerian'];
                if (!empty($key['PermasalahanIds'])) {
                    $permIds = explode(',', $key['PermasalahanIds']);
                    $permNames = explode('||', $key['PermasalahanNames']);
                    for ($i = 0; $i < count($permIds); $i++) {
                        if (isset($permIds[$i]) && isset($permNames[$i])) {
                            $Data['Permasalahan'][$permIds[$i]] = $permNames[$i];
                        }
                    }
                }
            }

            // Data untuk filter wilayah
            if ($KodeWilayah) {
                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                if ($wilayah) {
                    $Data['KodeWilayah'] = $KodeWilayah;
                    $Data['NamaWilayah'] = $wilayah['Nama'];
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                }
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
            }

            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/PermasalahanPokok', $Data);
        }

            // ============================================================
            // INPUT PERMASALAHAN POKOK
            // ============================================================
            // Input Permasalahan Pokok
        public function InputPermasalahanPokok() {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                $periode = explode('-', $this->input->post('PeriodeRPJMD', TRUE));
                $namaPermasalahan = trim($this->input->post('NamaPermasalahanPokok', TRUE));
                $permasalahanIds = $this->input->post('_Id', TRUE);
                
                if (empty($periode) || count($periode) != 2) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Periode tidak valid!'
                    ]);
                    return;
                }
                
                if (empty($namaPermasalahan)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nama Permasalahan Pokok harus diisi!'
                    ]);
                    return;
                }
                
                if (empty($permasalahanIds)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Pilih minimal satu Permasalahan Nasional!'
                    ]);
                    return;
                }
                
                // ==========================================================
                // PERBAIKAN: Ambil ID Kementerian dari Permasalahan yang dipilih
                // ==========================================================
                $kementerianIds = [];
                if (!empty($permasalahanIds)) {
                    $permIds = explode('$', $permasalahanIds);
                    $permIds = array_filter($permIds, function($id) {
                        return is_numeric($id) && $id > 0;
                    });
                    
                    if (!empty($permIds)) {
                        $query = $this->db->query("
                            SELECT DISTINCT IdKementerian 
                            FROM permasalahan_pokok 
                            WHERE Id IN (" . implode(',', $permIds) . ")
                            AND deleted_at IS NULL
                        ");
                        $kementerianIds = array_column($query->result_array(), 'IdKementerian');
                    }
                }
                
                $kementerianIdsValue = !empty($kementerianIds) ? implode(',', $kementerianIds) : null;
                
                $data = array(
                    'NamaPermasalahanPokok' => $namaPermasalahan,
                    '_Id' => $permasalahanIds,
                    'IdKementerian' => $kementerianIdsValue, // SIMPAN ID KEMENTERIAN
                    'TahunMulai' => trim($periode[0]),
                    'TahunAkhir' => trim($periode[1]),
                    'KodeWilayah' => $kodeWilayah,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                log_message('debug', 'Data InputPermasalahanPokok: ' . print_r($data, true));
                
                $this->db->insert('permasalahanpokokdaerah', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!'
                    ]);
                } else {
                    $error = $this->db->error();
                    log_message('error', 'DB Error InputPermasalahanPokok: ' . $error['message']);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data: ' . $error['message']
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'Exception InputPermasalahanPokok: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

            // ============================================================
            // UPDATE PERMASALAHAN POKOK
            // ============================================================
            // Update Permasalahan Pokok
        public function UpdatePermasalahanPokok() {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $periode = explode('-', $this->input->post('EditPeriodeRPJMD', TRUE));
                $namaPermasalahan = trim($this->input->post('NamaPermasalahanPokok', TRUE));
                $permasalahanIds = $this->input->post('_Id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                if (empty($periode) || count($periode) != 2) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Periode tidak valid!'
                    ]);
                    return;
                }
                
                if (empty($namaPermasalahan)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nama Permasalahan Pokok harus diisi!'
                    ]);
                    return;
                }
                
                if (empty($permasalahanIds)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Pilih minimal satu Permasalahan Nasional!'
                    ]);
                    return;
                }
                
                // Cek apakah data ada
                $exists = $this->db
                    ->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('permasalahanpokokdaerah')
                    ->num_rows();
                
                if ($exists == 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan!'
                    ]);
                    return;
                }
                
                // Ambil ID Kementerian dari Permasalahan yang dipilih
                $kementerianIds = [];
                if (!empty($permasalahanIds)) {
                    $permIds = explode('$', $permasalahanIds);
                    $permIds = array_filter($permIds, function($id) {
                        return is_numeric($id) && $id > 0;
                    });
                    
                    if (!empty($permIds)) {
                        $query = $this->db->query("
                            SELECT DISTINCT IdKementerian 
                            FROM permasalahan_pokok 
                            WHERE Id IN (" . implode(',', $permIds) . ")
                            AND deleted_at IS NULL
                        ");
                        $kementerianIds = array_column($query->result_array(), 'IdKementerian');
                    }
                }
                
                $kementerianIdsValue = !empty($kementerianIds) ? implode(',', $kementerianIds) : null;
                
                $data = array(
                    'NamaPermasalahanPokok' => $namaPermasalahan,
                    '_Id' => $permasalahanIds,
                    'IdKementerian' => $kementerianIdsValue,
                    'TahunMulai' => trim($periode[0]),
                    'TahunAkhir' => trim($periode[1]),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                
                log_message('debug', 'Data UpdatePermasalahanPokok: ' . print_r($data, true));
                
                $this->db->where('Id', $id);
                $this->db->where('KodeWilayah', $kodeWilayah);
                $this->db->update('permasalahanpokokdaerah', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil diupdate!'
                    ]);
                } else {
                    $error = $this->db->error();
                    if ($error['code'] == 0) {
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Tidak ada perubahan data'
                        ]);
                    } else {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal update data: ' . $error['message']
                        ]);
                    }
                }
                
            } catch (Exception $e) {
                log_message('error', 'Exception UpdatePermasalahanPokok: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

            // ============================================================
            // HAPUS PERMASALAHAN POKOK (Soft Delete)
            // ============================================================
            public function DeletePermasalahanPokok() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                try {
                    $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                                (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                    
                    if (empty($kodeWilayah)) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Wilayah belum dipilih!'
                        ]);
                        return;
                    }
                    
                    $id = (int)$this->input->post('Id', TRUE);
                    
                    if ($id <= 0) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'ID tidak valid!'
                        ]);
                        return;
                    }
                    
                    // Cek apakah data ada
                    $exists = $this->db
                        ->where('Id', $id)
                        ->where('KodeWilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('permasalahanpokokdaerah')
                        ->num_rows();
                    
                    if ($exists == 0) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Data tidak ditemukan!'
                        ]);
                        return;
                    }
                    
                    $this->db->where('Id', $id);
                    $this->db->where('KodeWilayah', $kodeWilayah);
                    $this->db->update('permasalahanpokokdaerah', array(
                        'deleted_at' => date('Y-m-d H:i:s')
                    ));
                    
                    if ($this->db->affected_rows() > 0) {
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Data berhasil dihapus!'
                        ]);
                    } else {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal menghapus data!'
                        ]);
                    }
                    
                } catch (Exception $e) {
                    log_message('error', 'Exception DeletePermasalahanPokok: ' . $e->getMessage());
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                    ]);
                }
            }

            // ============================================================
            // GET DATA PERMASALAHAN POKOK BY ID (UNTUK EDIT)
            // ============================================================
            public function GetPermasalahanPokokById() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                $kodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
                
                if ($id <= 0 || empty($kodeWilayah)) {
                    echo json_encode([]);
                    return;
                }
                
                $data = $this->db
                    ->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('permasalahanpokokdaerah')
                    ->row_array();
                
                if ($data) {
                    // Parse _Id menjadi array
                    $data['_Id_array'] = !empty($data['_Id']) ? explode('$', $data['_Id']) : [];
                    
                    // Parse IdKementerian menjadi array
                    $data['IdKementerian_array'] = !empty($data['IdKementerian']) ? explode(',', $data['IdKementerian']) : [];
                    
                    // Ambil detail kementerian
                    if (!empty($data['IdKementerian_array'])) {
                        $kementerianDetail = $this->db
                            ->select('Id, NamaKementerian, TahunMulai, TahunAkhir')
                            ->where_in('Id', $data['IdKementerian_array'])
                            ->where('deleted_at IS NULL')
                            ->get('kementerian')
                            ->result_array();
                        $data['kementerian_detail'] = $kementerianDetail;
                    }
                }
                
                echo json_encode($data);
            }

        public function IsuKLHS() {
                $Header['Halaman'] = 'Isudaerah';
                
                // Ambil KodeWilayah
                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                // Ambil daftar provinsi untuk filter
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                // Ambil periode dari RPJMD
                $query = $this->db->query("
                    SELECT DISTINCT TahunMulai, TahunAkhir 
                    FROM visirpjmd 
                    WHERE KodeWilayah = ? AND deleted_at IS NULL
                    ORDER BY TahunMulai
                ", array($KodeWilayah));
                $Data['Periods'] = $query->result_array();
                
                // Ambil data Isu KLHS
                $query = $this->db->query("
                    SELECT * FROM isuklhs 
                    WHERE KodeWilayah = ? AND deleted_at IS NULL
                ", array($KodeWilayah));
                $Data['IsuKLHS'] = $query->result_array();

                // Ambil periode dan data kementerian untuk Isu KLHS Nasional
                $Data['PeriodeIsuKLHSNasional'] = $this->db->query("SELECT DISTINCT TahunMulai,TahunAkhir,deleted_at FROM kementerian WHERE deleted_at IS NULL")->result_array();
                $ListKementerian = $this->db->query("SELECT kementerian.NamaKementerian,isu_klhs.* FROM isu_klhs,kementerian WHERE kementerian.Id=isu_klhs.IdKementerian AND isu_klhs.deleted_at IS NULL")->result_array();
                $Data['Kementerian'] = $Data['Isu'] = array();
                foreach ($ListKementerian as $key) {
                    $Data['Kementerian'][$key['Id']] = $key['NamaKementerian'];
                    $Data['Isu'][$key['Id']] = $key['NamaIsuKLHS'];
                }

                // Data untuk filter wilayah
                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                }

                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/IsuKLHS', $Data);
            }

        /**
         * INPUT ISU KLHS
         */
        public function InputIsuKLHS() {
            // Aktifkan error reporting untuk debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Cek AJAX request
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                // Ambil KodeWilayah dari session
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                // Ambil data dari POST
                $periodeRPJMD = $this->input->post('PeriodeRPJMD', TRUE);
                $namaIsuKLHS = trim($this->input->post('NamaIsuKLHS', TRUE));
                $isuIds = $this->input->post('_Id', TRUE);
                
                // Validasi
                if (empty($periodeRPJMD)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Periode RPJMD harus dipilih!'
                    ]);
                    return;
                }
                
                if (empty($namaIsuKLHS)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nama Isu KLHS harus diisi!'
                    ]);
                    return;
                }
                
                if (empty($isuIds)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Pilih minimal satu Isu KLHS Nasional!'
                    ]);
                    return;
                }
                
                // Parse periode
                $periode = explode('-', $periodeRPJMD);
                $tahunMulai = isset($periode[0]) ? trim($periode[0]) : '';
                $tahunAkhir = isset($periode[1]) ? trim($periode[1]) : '';
                
                if (!is_numeric($tahunMulai) || !is_numeric($tahunAkhir)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Periode tidak valid!'
                    ]);
                    return;
                }
                
                // Siapkan data untuk insert
                $data = array(
                    'NamaIsuKLHS' => $namaIsuKLHS,
                    '_Id' => $isuIds,
                    'TahunMulai' => $tahunMulai,
                    'TahunAkhir' => $tahunAkhir,
                    'KodeWilayah' => $kodeWilayah,
                    'created_at' => date('Y-m-d H:i:s')
                );
                
                // Log untuk debugging
                log_message('debug', 'Data InputIsuKLHS: ' . print_r($data, true));
                
                // Insert ke database - gunakan nama tabel 'isuklhs'
                $this->db->insert('isuklhs', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!'
                    ]);
                } else {
                    $error = $this->db->error();
                    log_message('error', 'DB Error InputIsuKLHS: ' . $error['message']);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data: ' . $error['message']
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'Exception InputIsuKLHS: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * UPDATE ISU KLHS
         */
        public function UpdateIsuKLHS() {
            // Aktifkan error reporting untuk debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Cek AJAX request
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                // Ambil KodeWilayah dari session
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                // Ambil data dari POST
                $id = (int)$this->input->post('Id', TRUE);
                $periodeRPJMD = $this->input->post('EditPeriodeRPJMD', TRUE);
                $namaIsuKLHS = trim($this->input->post('NamaIsuKLHS', TRUE));
                $isuIds = $this->input->post('_Id', TRUE);
                
                // Validasi
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                if (empty($periodeRPJMD)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Periode RPJMD harus dipilih!'
                    ]);
                    return;
                }
                
                if (empty($namaIsuKLHS)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nama Isu KLHS harus diisi!'
                    ]);
                    return;
                }
                
                if (empty($isuIds)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Pilih minimal satu Isu KLHS Nasional!'
                    ]);
                    return;
                }
                
                // Cek apakah data ada - gunakan nama tabel 'isuklhs'
                $existing = $this->db
                    ->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('isuklhs')
                    ->row_array();
                
                if (!$existing) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan!'
                    ]);
                    return;
                }
                
                // Parse periode
                $periode = explode('-', $periodeRPJMD);
                $tahunMulai = isset($periode[0]) ? trim($periode[0]) : '';
                $tahunAkhir = isset($periode[1]) ? trim($periode[1]) : '';
                
                if (!is_numeric($tahunMulai) || !is_numeric($tahunAkhir)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Periode tidak valid!'
                    ]);
                    return;
                }
                
                // Siapkan data untuk update
                $data = array(
                    'NamaIsuKLHS' => $namaIsuKLHS,
                    '_Id' => $isuIds,
                    'TahunMulai' => $tahunMulai,
                    'TahunAkhir' => $tahunAkhir,
                    'updated_at' => date('Y-m-d H:i:s')
                );
                
                // Log untuk debugging
                log_message('debug', 'Data UpdateIsuKLHS: ' . print_r($data, true));
                
                // Update database - gunakan nama tabel 'isuklhs'
                $this->db->where('Id', $id);
                $this->db->where('KodeWilayah', $kodeWilayah);
                $this->db->update('isuklhs', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil diupdate!'
                    ]);
                } else {
                    // Cek apakah ada perubahan atau error
                    $error = $this->db->error();
                    if ($error['code'] == 0) {
                        echo json_encode([
                            'status' => 'success',
                            'message' => 'Tidak ada perubahan data'
                        ]);
                    } else {
                        log_message('error', 'DB Error UpdateIsuKLHS: ' . $error['message']);
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Gagal update data: ' . $error['message']
                        ]);
                    }
                }
                
            } catch (Exception $e) {
                log_message('error', 'Exception UpdateIsuKLHS: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * DELETE ISU KLHS (Soft Delete)
         */
        public function DeleteIsuKLHS() {
            // Aktifkan error reporting untuk debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Cek AJAX request
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                // Ambil KodeWilayah dari session
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                // Ambil ID dari POST
                $id = (int)$this->input->post('Id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                // Cek apakah data ada - gunakan nama tabel 'isuklhs'
                $existing = $this->db
                    ->where('Id', $id)
                    ->where('KodeWilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('isuklhs')
                    ->row_array();
                
                if (!$existing) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan!'
                    ]);
                    return;
                }
                
                // Soft delete - gunakan nama tabel 'isuklhs'
                $data = array(
                    'deleted_at' => date('Y-m-d H:i:s')
                );
                
                $this->db->where('Id', $id);
                $this->db->where('KodeWilayah', $kodeWilayah);
                $this->db->update('isuklhs', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil dihapus!'
                    ]);
                } else {
                    $error = $this->db->error();
                    log_message('error', 'DB Error DeleteIsuKLHS: ' . $error['message']);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal hapus data: ' . $error['message']
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'Exception DeleteIsuKLHS: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * GET PERIODE ISU KLHS NASIONAL
         */
        public function GetPeriodeIsuKLHSNasional() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('Id', TRUE);
            
            if ($id <= 0) {
                echo json_encode([]);
                return;
            }
            
            // Ambil data periode dari isu_klhs berdasarkan ID
            $query = $this->db->query("
                SELECT k.* 
                FROM isu_klhs ik
                JOIN kementerian k ON k.Id = ik.IdKementerian
                WHERE ik.Id = ?
                AND ik.deleted_at IS NULL
                AND k.deleted_at IS NULL
            ", array($id));
            
            $result = $query->result_array();
            
            // Jika tidak ditemukan, coba ambil dari kementerian berdasarkan IdKementerian
            if (empty($result)) {
                $query2 = $this->db->query("
                    SELECT k.* 
                    FROM kementerian k
                    JOIN isu_klhs ik ON ik.IdKementerian = k.Id
                    WHERE ik.Id = ?
                    AND ik.deleted_at IS NULL
                    AND k.deleted_at IS NULL
                ", array($id));
                $result = $query2->result_array();
            }
            
            echo json_encode($result);
        }

        /**
         * GET KEMENTERIAN ISU
         */
        public function GetKementerianIsu() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $tahunMulai = $this->input->post('TahunMulai', TRUE);
            
            if (empty($tahunMulai) || !is_numeric($tahunMulai)) {
                echo json_encode([]);
                return;
            }
            
            $query = $this->db->query("
                SELECT * 
                FROM kementerian 
                WHERE TahunMulai = ? 
                AND deleted_at IS NULL
                ORDER BY NamaKementerian ASC
            ", array($tahunMulai));
            
            echo json_encode($query->result_array());
        }

        /**
         * GET ISU KLHS NASIONAL
         */
        public function GetIsuKLHSNasional() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $idKementerian = (int)$this->input->post('Id', TRUE);
            
            if ($idKementerian <= 0) {
                echo json_encode([]);
                return;
            }
            
            $query = $this->db->query("
                SELECT * 
                FROM isu_klhs 
                WHERE IdKementerian = ? 
                AND deleted_at IS NULL
                ORDER BY NamaIsuKLHS ASC
            ", array($idKementerian));
            
            echo json_encode($query->result_array());
        }

        /**
         * GET DATA ISU KLHS BY ID (untuk edit)
         */
        public function GetIsuKLHSById() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if ($id <= 0 || empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->where('Id', $id)
                ->where('KodeWilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('isuklhs')
                ->row_array();
            
            if ($data) {
                // Parse _Id menjadi array
                $data['_Id_array'] = !empty($data['_Id']) ? explode('$', $data['_Id']) : [];
                
                // Ambil informasi periode dan kementerian dari isu pertama
                if (!empty($data['_Id_array'])) {
                    $firstIsuId = $data['_Id_array'][0];
                    
                    // Cari periode dan kementerian
                    $isuInfo = $this->db->query("
                        SELECT ik.IdKementerian, k.TahunMulai, k.TahunAkhir
                        FROM isu_klhs ik
                        JOIN kementerian k ON k.Id = ik.IdKementerian
                        WHERE ik.Id = ?
                        AND ik.deleted_at IS NULL
                        AND k.deleted_at IS NULL
                    ", array($firstIsuId))->row_array();
                    
                    if ($isuInfo) {
                        $data['periode_nasional'] = $isuInfo['TahunMulai'];
                        $data['kementerian_id'] = $isuInfo['IdKementerian'];
                    }
                }
            }
            
            echo json_encode($data);
        }

        public function GetKementerianStrategis(){
        echo json_encode($this->db->query("SELECT * FROM kementerian WHERE TahunMulai = ".$_POST['TahunMulai']." AND deleted_at IS NULL")->result_array());
        }

        public function GetIsuStrategisNasional(){
        echo json_encode($this->db->query("SELECT * FROM isu_strategis WHERE IdKementerian = ".$_POST['Id']." AND deleted_at IS NULL")->result_array());
        }

        public function GetPeriodeIsuStrategisNasional(){
        echo json_encode($this->db->query("SELECT kementerian.* FROM isu_strategis,kementerian WHERE kementerian.Id=isu_strategis.IdKementerian AND kementerian.deleted_at IS NULL AND isu_strategis.Id = ".$_POST['Id'])->result_array());
        }

        public function IsuStrategisDaerah() {
                $Header['Halaman'] = 'Isudaerah';
                
                // Ambil KodeWilayah
                $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                            (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

                log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

                // Ambil daftar provinsi untuk filter
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                // Ambil periode dari RPJMD
                $query = $this->db->query("
                    SELECT DISTINCT TahunMulai, TahunAkhir 
                    FROM visirpjmd 
                    WHERE KodeWilayah = ? AND deleted_at IS NULL
                    ORDER BY TahunMulai
                ", array($KodeWilayah));
                $Data['Periods'] = $query->result_array();

            $Data['PotensiDaerah'] = $this->db->query("
                SELECT * FROM potensidaerah 
                WHERE KodeWilayah = ? AND deleted_at IS NULL
            ", array($KodeWilayah))->result_array();
                
                // Ambil data Isu Strategis
                $query = $this->db->query("
                    SELECT * FROM IsuStrategisDaerah 
                    WHERE KodeWilayah = ? AND deleted_at IS NULL
                ", array($KodeWilayah));
                $Data['IsuStrategis'] = $query->result_array();

                // Ambil periode dan data kementerian untuk Isu Strategis Nasional
                $Data['PeriodeIsuStrategisNasional'] = $this->db->query("SELECT DISTINCT TahunMulai,TahunAkhir,deleted_at FROM kementerian WHERE deleted_at IS NULL")->result_array();
                $ListKementerian = $this->db->query("SELECT kementerian.NamaKementerian,isu_strategis.* FROM isu_strategis,kementerian WHERE kementerian.Id=isu_strategis.IdKementerian AND isu_strategis.deleted_at IS NULL")->result_array();
                $Data['Kementerian'] = $Data['Isu'] = array();
                foreach ($ListKementerian as $key) {
                    $Data['Kementerian'][$key['Id']] = $key['NamaKementerian'];
                    $Data['Isu'][$key['Id']] = $key['NamaIsuStrategis'];
                }

                // Ambil Permasalahan Pokok
                $query = $this->db->query(
                    "SELECT * FROM Permasalahanpokokdaerah 
                    WHERE KodeWilayah = ? AND deleted_at IS NULL",
                    array($KodeWilayah)
                );
                $Data['PermasalahanPokok'] = $query->result_array();

                // Ambil Isu KLHS
                $query = $this->db->query(
                    "SELECT * FROM IsuKLHS 
                    WHERE KodeWilayah = ? AND deleted_at IS NULL",
                    array($KodeWilayah)
                );
                $Data['IsuKLHS'] = $query->result_array();

                // Data untuk filter wilayah
                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                }

                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/IsuStrategisDaerah', $Data);
            }

        public function TambahPermasalahanPokokIsuStrategis() {
        try {
            $id = $this->input->post('id', TRUE);
            $permasalahanPokok = $this->input->post('permasalahan_pokok', TRUE);

            if (empty($id) || !is_numeric($id)) {
                throw new Exception('ID tidak valid');
            }
            if (empty($permasalahanPokok)) {
                throw new Exception('Permasalahan Pokok harus diisi');
            }

            // Get existing data
            $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
            if (!$existing) {
                throw new Exception('Data Isu Strategis tidak ditemukan');
            }

            // Combine with existing Permasalahan Pokok
            $existingPP = !empty($existing['permasalahan_pokok']) ? explode(',', $existing['permasalahan_pokok']) : [];
            $newPP = explode(',', $permasalahanPokok);
            $combinedPP = array_unique(array_merge($existingPP, $newPP));
            $updateData = [
                'permasalahan_pokok' => implode(',', $combinedPP),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
            echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
        } catch (Exception $e) {
            log_message('error', 'Error adding Permasalahan Pokok: ' . $e->getMessage());
            echo $e->getMessage();
        }
        }

        public function EditPermasalahanPokokIsuStrategis() {
        try {
            $id = $this->input->post('id', TRUE);
            $permasalahanPokok = $this->input->post('permasalahan_pokok', TRUE);

            if (empty($id) || !is_numeric($id)) {
                throw new Exception('ID tidak valid');
            }

            $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
            if (!$existing) {
                throw new Exception('Data Isu Strategis tidak ditemukan');
            }

            $updateData = [
                'permasalahan_pokok' => $permasalahanPokok,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
            echo $this->db->affected_rows() ? '1' : 'Gagal Update Data';
        } catch (Exception $e) {
            log_message('error', 'Error editing Permasalahan Pokok: ' . $e->getMessage());
            echo $e->getMessage();
        }
        }

        public function TambahIsuKLHSIsuStrategis() {
        try {
            $id = $this->input->post('id', TRUE);
            $isuKLHS = $this->input->post('isu_klhs', TRUE);

            if (empty($id) || !is_numeric($id)) {
                throw new Exception('ID tidak valid');
            }
            if (empty($isuKLHS)) {
                throw new Exception('Isu KLHS harus diisi');
            }

            $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
            if (!$existing) {
                throw new Exception('Data Isu Strategis tidak ditemukan');
            }

            $existingKLHS = !empty($existing['isu_klhs']) ? explode(',', $existing['isu_klhs']) : [];
            $newKLHS = explode(',', $isuKLHS);
            $combinedKLHS = array_unique(array_merge($existingKLHS, $newKLHS));
            $updateData = [
                'isu_klhs' => implode(',', $combinedKLHS),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
            echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
        } catch (Exception $e) {
            log_message('error', 'Error adding Isu KLHS: ' . $e->getMessage());
            echo $e->getMessage();
        }
        }

        public function EditIsuKLHSIsuStrategis() {
        try {
            $id = $this->input->post('id', TRUE);
            $isuKLHS = $this->input->post('isu_klhs', TRUE);

            if (empty($id) || !is_numeric($id)) {
                throw new Exception('ID tidak valid');
            }

            $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
            if (!$existing) {
                throw new Exception('Data Isu Strategis tidak ditemukan');
            }

            $updateData = [
                'isu_klhs' => $isuKLHS,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
            echo $this->db->affected_rows() ? '1' : 'Gagal Update Data';
        } catch (Exception $e) {
            log_message('error', 'Error editing Isu KLHS: ' . $e->getMessage());
            echo $e->getMessage();
        }
        }

        public function TambahPotensiDaerahIsuStrategis() {
            try {
                $id = $this->input->post('id', TRUE);
                $potensiDaerah = $this->input->post('potensi_daerah', TRUE);

                if (empty($id) || !is_numeric($id)) {
                    throw new Exception('ID tidak valid');
                }
                if (empty($potensiDaerah)) {
                    throw new Exception('Potensi Daerah harus diisi');
                }

                // Get existing data
                $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
                if (!$existing) {
                    throw new Exception('Data Isu Strategis tidak ditemukan');
                }

                // Combine with existing Potensi Daerah
                $existingPotensi = !empty($existing['potensi_daerah']) ? explode(',', $existing['potensi_daerah']) : [];
                $newPotensi = explode(',', $potensiDaerah);
                $combinedPotensi = array_unique(array_merge($existingPotensi, $newPotensi));
                $updateData = [
                    'potensi_daerah' => implode(',', $combinedPotensi),
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
                echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
            } catch (Exception $e) {
                log_message('error', 'Error adding Potensi Daerah: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        public function EditPotensiDaerahIsuStrategis() {
            try {
                $id = $this->input->post('id', TRUE);
                $potensiDaerah = $this->input->post('potensi_daerah', TRUE);

                if (empty($id) || !is_numeric($id)) {
                    throw new Exception('ID tidak valid');
                }

                $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
                if (!$existing) {
                    throw new Exception('Data Isu Strategis tidak ditemukan');
                }

                $updateData = [
                    'potensi_daerah' => $potensiDaerah,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
                echo $this->db->affected_rows() ? '1' : 'Gagal Update Data';
            } catch (Exception $e) {
                log_message('error', 'Error editing Potensi Daerah: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        public function InputIsuStrategis() {
        $periode = explode('-', $this->input->post('PeriodeRPJMD'));
        
        $data = array(
            'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
            '_Id' => $this->input->post('_Id'),
            'TahunMulai' => $periode[0],
            'TahunAkhir' => $periode[1],
            'KodeWilayah' => $_SESSION['KodeWilayah'],
            'created_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->insert('IsuStrategisDaerah', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
        }

        public function UpdateIsuStrategis() {
        $periode = explode('-', $this->input->post('EditPeriodeRPJMD'));
        
        $data = array(
            'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
            '_Id' => $this->input->post('_Id'),
            'TahunMulai' => $periode[0],
            'TahunAkhir' => $periode[1],
            'updated_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('IsuStrategisDaerah', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
        }

        public function DeleteIsuStrategis() {
        $data = array(
            'deleted_at' => date('Y-m-d H:i:s')
        );
        
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('IsuStrategisDaerah', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
        }

        public function Cascade() {
            $Header['Halaman'] = 'Cascading';
            $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

            $Data = [];
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();
            
            // PERBAIKAN: Selalu inisialisasi variabel default
            $Data['KodeWilayah'] = $KodeWilayah;  // Bisa kosong jika belum filter
            $Data['CascadeData'] = [];  // Array kosong jika belum ada data
            $Data['Periods'] = [];
            $Data['Instansi'] = [];

            if ($KodeWilayah) {
                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                if ($wilayah) {
                    $Data['NamaWilayah'] = $wilayah['Nama'];
                    $Data['Periods'] = $this->db->query(
                        "SELECT DISTINCT TahunMulai, TahunAkhir 
                        FROM visirpjmd 
                        WHERE KodeWilayah = ? 
                        AND deleted_at IS NULL 
                        ORDER BY TahunMulai",
                        [$KodeWilayah]
                    )->result_array();
                    
                    // Load data cascade jika wilayah valid
                    $Data['CascadeData'] = $this->db->query(
                        "SELECT c.*, 
                                m.Id as IdMisi, 
                                m.Misi,
                                v.Id as IdVisi
                        FROM cascade_indikator c
                        LEFT JOIN misirpjmd m ON c.IdMisi = m.Id
                        LEFT JOIN visirpjmd v ON m._Id = v.Id
                        WHERE c.deleted_at IS NULL 
                        AND c.kodewilayah = ?
                        ORDER BY c.id ASC",
                        [$KodeWilayah]
                    )->result_array();
                    
                    $Data['Instansi'] = $this->db->where('deleted_at IS NULL')
                                                ->where('kodewilayah', $KodeWilayah)
                                                ->get('akun_instansi')
                                                ->result_array();
                } else {
                    $Data['NamaWilayah'] = 'Wilayah Tidak Ditemukan';
                }
            } else {
                $Data['NamaWilayah'] = '';  // Atau pesan seperti 'Pilih Wilayah Terlebih Dahulu'
            }

            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/cascade', $Data);
        }

            // AJAX: Load visi berdasarkan periode
            public function GetVisiByPeriod() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                $tahunMulai = $this->input->post('tahun_mulai', TRUE);
                $tahunAkhir = $this->input->post('tahun_akhir', TRUE);
                if (!is_numeric($tahunMulai) || !is_numeric($tahunAkhir)) {
                    echo json_encode([]);
                    return;
                }
                
                $query = $this->db->query("
                    SELECT Id, Visi 
                    FROM visirpjmd 
                    WHERE TahunMulai = ? 
                    AND TahunAkhir = ?
                    AND KodeWilayah = ?
                    AND deleted_at IS NULL
                    ORDER BY Id
                ", array($tahunMulai, $tahunAkhir, $_SESSION['KodeWilayah']));
                
                echo json_encode($query->result_array());
            }

            // AJAX: Load misi berdasarkan visi
            public function GetMisiByVisi() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                $visiId = $this->input->post('visi_id', TRUE);
                if (!is_numeric($visiId)) {
                    echo json_encode([]);
                    return;
                }
                
                $query = $this->db->query("
                    SELECT m.Id, m.Misi 
                    FROM misirpjmd m
                    WHERE m._Id = ?
                    AND m.KodeWilayah = ?
                    AND m.deleted_at IS NULL
                    ORDER BY m.Id
                ", array($visiId, $_SESSION['KodeWilayah']));
                
                echo json_encode($query->result_array());
            }

            // AJAX: Load tujuan berdasarkan misi (tidak berubah)
            public function GetTujuanByMisi() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                $misiId = $this->input->post('misi_id', TRUE);
                if (!is_numeric($misiId)) {
                    echo json_encode([]);
                    return;
                }
                
                $query = $this->db->query("
                    SELECT t.Id, t.Tujuan 
                    FROM tujuanrpjmd t
                    WHERE t._Id = ?
                    AND t.KodeWilayah = ?
                    AND t.deleted_at IS NULL
                    ORDER BY t.Id
                ", array($misiId, $_SESSION['KodeWilayah']));
                
                echo json_encode($query->result_array());
            }

            // AJAX: Load sasaran berdasarkan tujuan (tidak berubah)
            public function GetSasaranByTujuan() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                $tujuanId = $this->input->post('tujuan_id', TRUE);
                if (!is_numeric($tujuanId)) {
                    echo json_encode([]);
                    return;
                }
                
                $query = $this->db->query("
                    SELECT s.Id, s.Sasaran 
                    FROM sasaranrpjmd s
                    WHERE s._Id = ?
                    AND s.KodeWilayah = ?
                    AND s.deleted_at IS NULL
                    ORDER BY s.Id
                ", array($tujuanId, $_SESSION['KodeWilayah']));
                
                echo json_encode($query->result_array());
            }

            // Tambah data cascade
            public function TambahCascade() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Debug data yang diterima
            log_message('debug', 'Data POST: ' . print_r($_POST, true));
            
            try {
                $period = explode('-', $this->input->post('TahunFilter', TRUE));
                
                // Validasi data
                if (count($period) != 2) {
                    echo 'Periode tidak valid';
                    return;
                }
                
                $data = [
                    'kodewilayah' => $_SESSION['KodeWilayah'],
                    'IdMisi' => (int)$this->input->post('Misi', TRUE),
                    'tahun_mulai' => (int)$period[0],
                    'tahun_akhir' => (int)$period[1],
                    'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
                    'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
                    'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
                    'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
                    'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                log_message('debug', 'Data untuk insert: ' . print_r($data, true));
                
                $this->db->insert('cascade_indikator', $data);
                
                if ($this->db->affected_rows()) {
                    echo '1';
                } else {
                    $error = $this->db->error();
                    log_message('error', 'Database error: ' . $error['message']);
                    echo 'Gagal menyimpan data ke database';
                }
                
            } catch (Exception $e) {
                log_message('error', 'Error TambahCascade: ' . $e->getMessage());
                echo 'Terjadi kesalahan sistem';
            }
        }

            // Edit data cascade
            // Edit data cascade - Modifikasi untuk menghapus indikator jika misi berubah
        public function EditCascade() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            $id = $this->input->post('id', TRUE);
            $period = explode('-', $this->input->post('periode', TRUE));
            $newMisiId = (int)$this->input->post('EditMisi', TRUE);

            // Validasi
            if (!is_numeric($id)) {
                echo 'ID tidak valid';
                return;
            }
            if (count($period) != 2 || !is_numeric($period[0]) || !is_numeric($period[1])) {
                echo 'Periode tidak valid';
                return;
            }

            // Ambil data lama
            $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
            if (!$existing) {
                echo 'Data tidak ditemukan';
                return;
            }

            $oldMisiId = (int)$existing['IdMisi'];

            // Jika misi berubah
            if ($newMisiId != $oldMisiId) {
                // Filter tujuan yang sesuai dengan misi baru
                $validTujuanIds = $this->db->query("
                    SELECT t.Id 
                    FROM tujuanrpjmd t
                    WHERE t._Id = ? 
                    AND t.KodeWilayah = ?
                    AND t.deleted_at IS NULL
                ", array($newMisiId, $_SESSION['KodeWilayah']))->result_array();
                
                $validTujuanList = array_column($validTujuanIds, 'Id');
                
                // Filter tujuan_ids yang masih valid
                if (!empty($existing['tujuan_ids'])) {
                    $currentTujuanIds = explode(',', $existing['tujuan_ids']);
                    $filteredTujuanIds = array_intersect($currentTujuanIds, $validTujuanList);
                    $newTujuanIds = implode(',', $filteredTujuanIds);
                } else {
                    $newTujuanIds = '';
                }

                // Filter sasaran berdasarkan tujuan yang masih valid
                if (!empty($newTujuanIds)) {
                    $validSasaranIds = $this->db->query("
                        SELECT s.Id 
                        FROM sasaranrpjmd s
                        WHERE s._Id IN (" . $newTujuanIds . ") 
                        AND s.KodeWilayah = ?
                        AND s.deleted_at IS NULL
                    ", array($_SESSION['KodeWilayah']))->result_array();
                    
                    $validSasaranList = array_column($validSasaranIds, 'Id');
                    
                    // Filter sasaran_ids yang masih valid
                    if (!empty($existing['sasaran_ids'])) {
                        $currentSasaranIds = explode(',', $existing['sasaran_ids']);
                        $filteredSasaranIds = array_intersect($currentSasaranIds, $validSasaranList);
                        $newSasaranIds = implode(',', $filteredSasaranIds);
                    } else {
                        $newSasaranIds = '';
                    }
                } else {
                    $newSasaranIds = '';
                }

                // Update dengan data yang difilter, dan kosongkan indikator (IKD)
                $data = [
                    'IdMisi' => $newMisiId,
                    'tujuan_ids' => $newTujuanIds,
                    'sasaran_ids' => $newSasaranIds,
                    'indikator' => null,  // Hapus data IKD jika misi berubah
                    'tahun_mulai' => (int)$period[0],
                    'tahun_akhir' => (int)$period[1],
                    'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
                    'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
                    'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
                    'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
                    'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            } else {
                // Jika misi tidak berubah, update normal tanpa memaksa indikator
                $data = [
                    'IdMisi' => $newMisiId,
                    'tahun_mulai' => (int)$period[0],
                    'tahun_akhir' => (int)$period[1],
                    'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
                    'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
                    'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
                    'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
                    'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
            }
            
            $this->db->where('id', $id);
            $this->db->update('cascade_indikator', $data);
            if ($this->db->affected_rows()) {
                echo '1';
            } else {
                echo 'Gagal Update Data!';
            }
        }

            // Hapus data cascade (soft delete)
            public function HapusCascade() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                $id = $this->input->post('id', TRUE);
                if (!is_numeric($id)) {
                    echo '0';
                    return;
                }
                $this->db->where('id', $id)->update('cascade_indikator', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                echo $this->db->affected_rows() ? '1' : '0';
            }

        // Di Controller Daerah.php - Tambahkan method baru untuk PD Cascade

        public function TambahPdCascade() {
            try {
                $id = $this->input->post('id', true);
                $type = $this->input->post('type', true); // 'pj' atau 'pn'
                $pd_values = $this->input->post('pd_values', true);

                if (empty($id) || !is_numeric($id)) {
                    throw new Exception('Invalid ID');
                }
                if (empty($type) || !in_array($type, ['pj', 'pn'])) {
                    throw new Exception('Invalid PD type');
                }
                if (empty($pd_values)) {
                    throw new Exception('PD values harus diisi');
                }

                // Get existing data dari cascade_indikator
                $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
                if (!$existing) {
                    throw new Exception('Data Cascade tidak ditemukan');
                }

                // Prepare update data berdasarkan type
                $updateData = ['updated_at' => date('Y-m-d H:i:s')];
                
                if ($type === 'pj') {
                    $existingPJ = !empty($existing['pd_penanggung_jawab']) ? explode(',', $existing['pd_penanggung_jawab']) : [];
                    $newPJ = explode(',', $pd_values);
                    $combinedPJ = array_unique(array_merge($existingPJ, $newPJ));
                    $updateData['pd_penanggung_jawab'] = implode(',', array_filter($combinedPJ));
                } else {
                    $existingPN = !empty($existing['pd_penunjang']) ? explode(',', $existing['pd_penunjang']) : [];
                    $newPN = explode(',', $pd_values);
                    $combinedPN = array_unique(array_merge($existingPN, $newPN));
                    $updateData['pd_penunjang'] = implode(',', array_filter($combinedPN));
                }

                // Update cascade_indikator (bukan ikd)
                $this->db->where('id', $id)->update('cascade_indikator', $updateData);

                if ($this->db->affected_rows() > 0) {
                    echo '1';
                } else {
                    throw new Exception('No changes made');
                }
            } catch (Exception $e) {
                log_message('error', 'Error adding PD Cascade: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        public function EditPDCascade() {  
            try {
                $id = $this->input->post('id', true);
                $pd_penanggung_jawab = $this->input->post('pd_penanggung_jawab', true);
                $pd_penunjang = $this->input->post('pd_penunjang', true);

                if (empty($id) || !is_numeric($id)) {
                    throw new Exception('ID tidak valid');
                }

                $updateData = ['updated_at' => date('Y-m-d H:i:s')];
                
                // Ubah kondisi: Gunakan isset() agar bisa update ke string kosong
                if (isset($pd_penanggung_jawab)) {
                    $updateData['pd_penanggung_jawab'] = $pd_penanggung_jawab;  // Bisa kosong untuk hapus semua
                }
                
                if (isset($pd_penunjang)) {
                    $updateData['pd_penunjang'] = $pd_penunjang;  // Bisa kosong untuk hapus semua
                }

                // Update cascade_indikator
                $this->db->where('id', $id)->update('cascade_indikator', $updateData);
                
                if ($this->db->affected_rows() > 0) {
                    echo '1';
                } else {
                    echo 'Tidak ada perubahan data';
                }
            } catch (Exception $e) {
                log_message('error', 'Error editing PD Cascade: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        public function TambahTujuanCascade() {
            try {
                $id = $this->input->post('id', true);
                $tujuan_ids = $this->input->post('tujuan_ids', true);

                if (empty($id) || !is_numeric($id)) {
                    throw new Exception('ID tidak valid');
                }
                if (empty($tujuan_ids)) {
                    throw new Exception('Tujuan harus dipilih');
                }

                // Get existing data
                $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
                if (!$existing) {
                    throw new Exception('Data Cascade tidak ditemukan');
                }

                // Combine with existing tujuan_ids
                $existingTujuan = !empty($existing['tujuan_ids']) ? explode(',', $existing['tujuan_ids']) : [];
                $newTujuan = explode(',', $tujuan_ids);
                $combinedTujuan = array_unique(array_merge($existingTujuan, $newTujuan));
                
                // Sort untuk konsistensi
                sort($combinedTujuan);
                
                $newTujuanIds = implode(',', array_filter($combinedTujuan));
                
                // Debug logging
                log_message('debug', 'Existing tujuan: ' . $existing['tujuan_ids']);
                log_message('debug', 'New tujuan: ' . $tujuan_ids);
                log_message('debug', 'Combined tujuan: ' . $newTujuanIds);

                // Cek apakah ada perubahan
                if ($existing['tujuan_ids'] === $newTujuanIds) {
                    echo '1'; // Data sama, tetap return success
                    return;
                }

                $updateData = [
                    'tujuan_ids' => $newTujuanIds,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->db->where('id', $id);
                $result = $this->db->update('cascade_indikator', $updateData);

                if ($result) {
                    echo '1';
                } else {
                    $error = $this->db->error();
                    throw new Exception('Database error: ' . $error['message']);
                }
                
            } catch (Exception $e) {
                log_message('error', 'Error adding Tujuan Cascade: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        // Update EditTujuanCascade di Controller (Daerah.php)
        public function EditTujuanCascade(){  
            try {
                $cascadeId = $this->input->post('id', TRUE);
                $tujuanIds = $this->input->post('tujuan_ids', TRUE);
                $deletedTujuanIds = $this->input->post('deleted_tujuan_ids', TRUE);  // ID tujuan yang dihapus
                
                // Ambil data lama untuk cek
                $existing = $this->db->where('id', $cascadeId)->get('cascade_indikator')->row_array();
                if (!$existing) {
                    throw new Exception('Data Cascade tidak ditemukan');
                }

                $previousTujuanIds = !empty($existing['tujuan_ids']) ? explode(',', $existing['tujuan_ids']) : [];
                
                // Update tujuan_ids
                $this->db->where('id', $cascadeId); 
                $this->db->update('cascade_indikator', [
                    'tujuan_ids' => $tujuanIds,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                // Jika ada tujuan dihapus, hapus sasaran terkait dan indikator
                if (!empty($deletedTujuanIds)) {
                    $deletedIdsArray = explode(',', $deletedTujuanIds);
                    
                    // 1. Hapus sasaran terkait dengan tujuan yang dihapus
                    $currentSasaranIds = !empty($existing['sasaran_ids']) ? explode(',', $existing['sasaran_ids']) : [];
                    $sasaranToKeep = [];
                    $sasaranToDelete = [];
                    
                    foreach ($currentSasaranIds as $sasaranId) {
                        $sasaranData = $this->db->where('Id', $sasaranId)->get('sasaranrpjmd')->row_array();
                        if ($sasaranData) {
                            // Jika sasaran terkait dengan tujuan yang dihapus
                            if (in_array($sasaranData['_Id'], $deletedIdsArray)) {
                                $sasaranToDelete[] = $sasaranId;
                            } else {
                                $sasaranToKeep[] = $sasaranId;
                            }
                        }
                    }
                    
                    // Update sasaran_ids dengan yang tersisa
                    if (!empty($sasaranToDelete)) {
                        $this->db->where('id', $cascadeId); 
                        $this->db->update('cascade_indikator', [
                            'sasaran_ids' => implode(',', $sasaranToKeep),
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                    
                    // 2. Hapus indikator (IKU/IKD) jika ada sasaran yang dihapus
                    if (!empty($sasaranToDelete)) {
                        $this->db->where('id', $cascadeId); 
                        $this->db->update('cascade_indikator', [
                            'indikator' => null,  // Hapus IKU/IKD terkait
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                        
                        log_message('debug', 'Indikator dihapus otomatis karena tujuan/sasaran dihapus: ' . $deletedTujuanIds);
                    }
                }
                
                if ($this->db->affected_rows() > 0) {
                    echo '1';
                } else {
                    echo 'Tidak ada perubahan data';
                }
            } catch (Exception $e) {
                log_message('error', 'Error EditTujuanCascade: ' . $e->getMessage());
                echo 'Terjadi kesalahan sistem';
            }
        }

        // New methods for Sasaran Cascade (similar to Tujuan)

        // Di Controller Daerah.php - GANTI method TambahSasaranCascade
        public function TambahSasaranCascade() {
            try {
                $id = $this->input->post('id', true);
                $sasaran_ids = $this->input->post('sasaran_ids', true);

                if (empty($id) || !is_numeric($id)) {
                    throw new Exception('ID tidak valid');
                }
                if (empty($sasaran_ids)) {
                    throw new Exception('Sasaran harus dipilih');
                }

                // Get existing data
                $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
                if (!$existing) {
                    throw new Exception('Data Cascade tidak ditemukan');
                }

                // Combine with existing sasaran_ids
                $existingSasaran = !empty($existing['sasaran_ids']) ? explode(',', $existing['sasaran_ids']) : [];
                $newSasaran = explode(',', $sasaran_ids);
                $combinedSasaran = array_unique(array_merge($existingSasaran, $newSasaran));
                
                // Sort untuk konsistensi
                sort($combinedSasaran);
                
                $newSasaranIds = implode(',', array_filter($combinedSasaran));
                
                // Debug logging
                log_message('debug', 'Existing sasaran: ' . $existing['sasaran_ids']);
                log_message('debug', 'New sasaran: ' . $sasaran_ids);
                log_message('debug', 'Combined sasaran: ' . $newSasaranIds);

                // Cek apakah ada perubahan
                if ($existing['sasaran_ids'] === $newSasaranIds) {
                    echo '1'; // Data sama, tetap return success
                    return;
                }

                $updateData = [
                    'sasaran_ids' => $newSasaranIds,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                $this->db->where('id', $id);
                $result = $this->db->update('cascade_indikator', $updateData);

                if ($result) {
                    echo '1';
                } else {
                    $error = $this->db->error();
                    throw new Exception('Database error: ' . $error['message']);
                }
                
            } catch (Exception $e) {
                log_message('error', 'Error adding Sasaran Cascade: ' . $e->getMessage());
                echo $e->getMessage();
            }
        }

        public function EditSasaranCascade() {
            try {
                $cascadeId = $this->input->post('id', TRUE);
                $sasaranIds = $this->input->post('sasaran_ids', TRUE);
                $deletedSasaranIds = $this->input->post('deleted_sasaran_ids', TRUE);  // Baru: ID sasaran yang dihapus
                
                // Ambil data lama untuk cek
                $existing = $this->db->where('id', $cascadeId)->get('cascade_indikator')->row_array();
                if (!$existing) {
                    throw new Exception('Data Cascade tidak ditemukan');
                }

                $previousSasaranIds = !empty($existing['sasaran_ids']) ? explode(',', $existing['sasaran_ids']) : [];
                
                // Update sasaran_ids
                $this->db->where('id', $cascadeId); 
                $this->db->update('cascade_indikator', [
                    'sasaran_ids' => $sasaranIds,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                // Baru: Jika ada sasaran dihapus, kosongkan indikator (IKU/IKD)
                if (!empty($deletedSasaranIds)) {
                    $this->db->where('id', $cascadeId); 
                    $this->db->update('cascade_indikator', [
                        'indikator' => null,  // Hapus IKU/IKD terkait
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    
                    log_message('debug', 'Indikator dihapus otomatis karena sasaran dihapus: ' . $deletedSasaranIds);
                }
                
                if ($this->db->affected_rows() > 0) {
                    echo '1';
                } else {
                    echo 'Tidak ada perubahan data';
                }
            } catch (Exception $e) {
                log_message('error', 'Error EditSasaranCascade: ' . $e->getMessage());
                echo 'Terjadi kesalahan sistem';
            }
        }

        public function TambahIndikatorCascade() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = $this->input->post('id', TRUE);
            $indikator = $this->input->post('indikator', TRUE);
            
            if (empty($id) || !is_numeric($id)) {
                echo 'ID tidak valid';
                return;
            }
            if (empty($indikator)) {
                echo 'Indikator harus diisi';
                return;
            }
            
            // Ambil data existing
            $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
            if (!$existing) {
                echo 'Data Cascade tidak ditemukan';
                return;
            }
            
            // Jika sudah ada, append dengan newline atau replace jika kosong
            $currentIndikator = !empty($existing['indikator']) ? $existing['indikator'] . "\n" . $indikator : $indikator;
            
            $this->db->where('id', $id)->update('cascade_indikator', [
                'indikator' => trim($currentIndikator),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            echo $this->db->affected_rows() ? '1' : 'Gagal menambahkan indikator!';
        }

        // Edit Indikator Cascade
        public function EditIndikatorCascade() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = $this->input->post('id', TRUE);
            $indikator = $this->input->post('indikator', TRUE);
            
            if (empty($id) || !is_numeric($id)) {
                echo 'ID tidak valid';
                return;
            }
            if (empty($indikator)) {
                echo 'Indikator harus diisi';
                return;
            }
            
            $this->db->where('id', $id)->update('cascade_indikator', [
                'indikator' => $indikator,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            echo $this->db->affected_rows() ? '1' : 'Gagal update indikator!';
        }

        // Hapus Indikator Cascade
        public function HapusIndikatorCascade() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = $this->input->post('id', TRUE);
            
            if (empty($id) || !is_numeric($id)) {
                echo 'ID tidak valid';
                return;
            }
            
            $this->db->where('id', $id)->update('cascade_indikator', [
                'indikator' => null,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            echo $this->db->affected_rows() ? '1' : 'Gagal menghapus indikator!';
        }

        public function UrusanPD() {
            $Header['Halaman'] = 'Daerah';
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

            $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] :
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

            $Data['KodeWilayah'] = $KodeWilayah;

            if (!empty($KodeWilayah)) {
                $Data['Urusan'] = $this->db
                    ->where('kodewilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL', null, false)
                    ->order_by('nama_urusan', 'ASC')
                    ->get('urusan_pd')
                    ->result_array();
            } else {
                $Data['Urusan'] = []; // kalau belum pilih wilayah
            }

            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/Urusanpd', $Data);
        }


        public function InputUrusanPD() {

            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $_SESSION['KodeWilayah'];
            $nama = trim($this->input->post("nama_urusan", true));

            if ($nama == "") {
                echo "Nama urusan wajib diisi!";
                return;
            }

            $this->db->insert("urusan_pd", [
                "kodewilayah" => $KodeWilayah,
                "nama_urusan" => $nama,
                "created_at"  => date("Y-m-d H:i:s")
            ]);

            echo $this->db->affected_rows() ? "1" : "Gagal simpan data!";
        }


        public function EditUrusanPD() {

            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $_SESSION['KodeWilayah'];

            $id   = (int)$this->input->post("id", true);
            $nama = trim($this->input->post("nama_urusan", true));

            if ($id <= 0) { echo "ID tidak valid"; return; }
            if ($nama == "") { echo "Nama wajib diisi"; return; }

            $this->db->where("id", $id);
            $this->db->where("kodewilayah", $KodeWilayah);

            $this->db->update("urusan_pd", [
                "nama_urusan" => $nama,
                "updated_at"  => date("Y-m-d H:i:s")
            ]);

            echo $this->db->affected_rows() ? "1" : "Gagal update!";
        }


        public function HapusUrusanPD() {

            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $KodeWilayah = $_SESSION['KodeWilayah'];

            $id = (int)$this->input->post("id", true);

            if ($id <= 0) {
                echo "ID tidak valid!";
                return;
            }

            $this->db->where("id", $id);
            $this->db->where("kodewilayah", $KodeWilayah);

            $this->db->update("urusan_pd", [
                "deleted_at" => date("Y-m-d H:i:s")
            ]);

            echo $this->db->affected_rows() ? "1" : "Gagal hapus!";
        }
        // ============================================================
        // HALAMAN UTAMA
        // ============================================================
        
        public function ProgramPD() {
        $Header['Halaman'] = 'Program PD';
        
        $KodeWilayah = $this->_getKodeWilayah();
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();
        
        // Perangkat Daerah untuk dropdown
        $Data['PerangkatDaerah'] = [];
        if ($KodeWilayah) {
            $Data['PerangkatDaerah'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
            
            $Data['NamaWilayah'] = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array()['Nama'] ?? '';
        }
        
        // ============================================================
        // AMBIL DATA LENGKAP DENGAN STRUKTUR OUTCOME → INDIKATOR
        // ============================================================
        $Data['ListData'] = [];
        
        if ($KodeWilayah) {
            // Ambil semua Urusan
            $urusan = $this->db
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('program_urusan')
                ->result_array();
            
            foreach ($urusan as &$u) {
                // Ambil Bidang Urusan
                $u['bidang'] = $this->db
                    ->where('urusan_id', $u['id'])
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('id', 'ASC')
                    ->get('program_bidang_urusan')
                    ->result_array();
                
                foreach ($u['bidang'] as &$b) {
                    // Ambil Program
                    $b['program'] = $this->db
                        ->where('bidang_urusan_id', $b['id'])
                        ->where('kode_wilayah', $KodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->order_by('id', 'ASC')
                        ->get('program_data')
                        ->result_array();
                    
                    foreach ($b['program'] as &$p) {
                        // ============================================================
                        // PERBAIKAN: Ambil OUTCOME terlebih dahulu
                        // ============================================================
                        $p['outcomes'] = $this->db
                            ->select('*')
                            ->from('program_outcome')
                            ->where('program_id', $p['id'])
                            ->where('deleted_at IS NULL')
                            ->order_by('urutan', 'ASC')
                            ->get()
                            ->result_array();
                        
                        // Untuk setiap outcome, ambil indikator
                        foreach ($p['outcomes'] as &$outcome) {
                            $outcome['indikators'] = $this->db
                                ->select('pi.*, ai.nama as perangkat_daerah_nama')
                                ->from('program_indikator pi')
                                ->join('akun_instansi ai', 'ai.id = pi.perangkat_daerah_id', 'left')
                                ->where('pi.outcome_id', $outcome['id'])
                                ->where('pi.deleted_at IS NULL')
                                ->order_by('pi.urutan', 'ASC')
                                ->get()
                                ->result_array();
                        }
                        unset($outcome);
                    }
                    unset($p);
                }
                unset($b);
            }
            unset($u);
            
            $Data['ListData'] = $urusan;
        }
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/Program_pd', $Data);
    }

        // ============================================================
        // 1. CRUD URUSAN (Level 1)
        // ============================================================
        
        public function program_input_urusan() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) return;
            
            $kode = trim($this->input->post('kode_urusan', TRUE));
            $nama = trim($this->input->post('nama_urusan', TRUE));
            
            if (empty($kode)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Urusan harus diisi!']);
                return;
            }
            if (empty($nama)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Urusan harus diisi!']);
                return;
            }
            
            // Cek duplikat
            $exists = $this->db
                ->where('kode_wilayah', $kodeWilayah)
                ->where('kode_urusan', $kode)
                ->where('deleted_at IS NULL')
                ->get('program_urusan')
                ->num_rows();
            
            if ($exists > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Urusan sudah ada!']);
                return;
            }
            
            $data = [
                'kode_wilayah' => $kodeWilayah,
                'kode_urusan' => $kode,
                'nama_urusan' => $nama,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('program_urusan', $data);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Urusan berhasil ditambahkan!',
                'id' => $this->db->insert_id()
            ]);
        }

        public function program_edit_urusan() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) return;
            
            $id = (int)$this->input->post('id', TRUE);
            $kode = trim($this->input->post('kode_urusan', TRUE));
            $nama = trim($this->input->post('nama_urusan', TRUE));
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            if (empty($kode)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Urusan harus diisi!']);
                return;
            }
            if (empty($nama)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Urusan harus diisi!']);
                return;
            }
            
            // Cek duplikat
            $exists = $this->db
                ->where('kode_wilayah', $kodeWilayah)
                ->where('kode_urusan', $kode)
                ->where('id !=', $id)
                ->where('deleted_at IS NULL')
                ->get('program_urusan')
                ->num_rows();
            
            if ($exists > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Urusan sudah digunakan!']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('program_urusan', [
                'kode_urusan' => $kode,
                'nama_urusan' => $nama,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            echo json_encode(['status' => 'success', 'message' => 'Urusan berhasil diupdate!']);
        }

        public function program_hapus_urusan() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) return;
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // Cek apakah ada bidang urusan terkait
            $bidangCount = $this->db
                ->where('urusan_id', $id)
                ->where('deleted_at IS NULL')
                ->count_all_results('program_bidang_urusan');
            
            if ($bidangCount > 0) {
                echo json_encode([
                    'status' => 'error', 
                    'message' => 'Urusan ini memiliki ' . $bidangCount . ' Bidang Urusan. Hapus Bidang Urusan terlebih dahulu!'
                ]);
                return;
            }
            
            $now = date('Y-m-d H:i:s');
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('program_urusan', ['deleted_at' => $now]);
            
            echo json_encode(['status' => 'success', 'message' => 'Urusan berhasil dihapus!']);
        }

        // ============================================================
        // 2. CRUD BIDANG URUSAN (Level 2)
        // ============================================================
        
        public function program_input_bidang_urusan() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) return;
            
            $urusanId = (int)$this->input->post('urusan_id', TRUE);
            $kode = trim($this->input->post('kode_bidang', TRUE));
            $nama = trim($this->input->post('nama_bidang', TRUE));
            
            if ($urusanId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Urusan tidak valid!']);
                return;
            }
            if (empty($kode)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Bidang harus diisi!']);
                return;
            }
            if (empty($nama)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Bidang harus diisi!']);
                return;
            }
            
            // Cek duplikat
            $exists = $this->db
                ->where('kode_wilayah', $kodeWilayah)
                ->where('urusan_id', $urusanId)
                ->where('kode_bidang', $kode)
                ->where('deleted_at IS NULL')
                ->get('program_bidang_urusan')
                ->num_rows();
            
            if ($exists > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Bidang sudah ada di Urusan ini!']);
                return;
            }
            
            $data = [
                'kode_wilayah' => $kodeWilayah,
                'urusan_id' => $urusanId,
                'kode_bidang' => $kode,
                'nama_bidang' => $nama,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('program_bidang_urusan', $data);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Bidang Urusan berhasil ditambahkan!',
                'id' => $this->db->insert_id()
            ]);
        }

        public function program_edit_bidang_urusan() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) return;
            
            $id = (int)$this->input->post('id', TRUE);
            $urusanId = (int)$this->input->post('urusan_id', TRUE);
            $kode = trim($this->input->post('kode_bidang', TRUE));
            $nama = trim($this->input->post('nama_bidang', TRUE));
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            if ($urusanId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Urusan tidak valid!']);
                return;
            }
            if (empty($kode)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Bidang harus diisi!']);
                return;
            }
            if (empty($nama)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Bidang harus diisi!']);
                return;
            }
            
            // Cek duplikat
            $exists = $this->db
                ->where('kode_wilayah', $kodeWilayah)
                ->where('urusan_id', $urusanId)
                ->where('kode_bidang', $kode)
                ->where('id !=', $id)
                ->where('deleted_at IS NULL')
                ->get('program_bidang_urusan')
                ->num_rows();
            
            if ($exists > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Bidang sudah digunakan!']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('program_bidang_urusan', [
                'urusan_id' => $urusanId,
                'kode_bidang' => $kode,
                'nama_bidang' => $nama,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            echo json_encode(['status' => 'success', 'message' => 'Bidang Urusan berhasil diupdate!']);
        }

        public function program_hapus_bidang_urusan() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_checkSessionWilayah();
            if (!$kodeWilayah) return;
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // Cek apakah ada program terkait
            $programCount = $this->db
                ->where('bidang_urusan_id', $id)
                ->where('deleted_at IS NULL')
                ->count_all_results('program_data');
            
            if ($programCount > 0) {
                echo json_encode([
                    'status' => 'error', 
                    'message' => 'Bidang ini memiliki ' . $programCount . ' Program. Hapus Program terlebih dahulu!'
                ]);
                return;
            }
            
            $now = date('Y-m-d H:i:s');
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('program_bidang_urusan', ['deleted_at' => $now]);
            
            echo json_encode(['status' => 'success', 'message' => 'Bidang Urusan berhasil dihapus!']);
        }

        // ============================================================
        // 3. CRUD PROGRAM + INDIKATOR (Level 3)
        // ============================================================
    // ============================================================
    // PROGRAM PD - DENGAN MULTIPLE OUTCOME & INDIKATOR
    // ============================================================

    /**
     * INPUT PROGRAM + OUTCOME + INDIKATOR
     * POST: bidang_urusan_id, kode_program, nama_program,
     *       outcomes[][outcome_text], outcomes[][indikators][][indikator, satuan, kondisi_awal, target_2026, pagu_2026, ...]
     */
    public function program_input_program() {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodeWilayah = $this->_checkSessionWilayah();
        if (!$kodeWilayah) return;
        
        $bidangId = (int)$this->input->post('bidang_urusan_id', TRUE);
        $kode = trim($this->input->post('kode_program', TRUE));
        $nama = trim($this->input->post('nama_program', TRUE));
        $outcomes = $this->input->post('outcomes', TRUE); // array multidimensi
        
        if ($bidangId <= 0 || empty($nama)) {
            echo json_encode(['status' => 'error', 'message' => 'Data program tidak lengkap!']);
            return;
        }
        
        $this->db->trans_start();
        
        // Insert program
        $dataProgram = [
            'kode_wilayah' => $kodeWilayah,
            'bidang_urusan_id' => $bidangId,
            'kode_program' => $kode ?: null,
            'nama_program' => $nama,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('program_data', $dataProgram);
        $programId = $this->db->insert_id();
        
        if (!$programId) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan program!']);
            return;
        }
        
        // Proses outcomes
        if (!empty($outcomes) && is_array($outcomes)) {
            $urutanOutcome = 10;
            foreach ($outcomes as $outcome) {
                $outcomeText = trim($outcome['outcome_text'] ?? '');
                if (empty($outcomeText)) continue;
                
                // Insert outcome
                $dataOutcome = [
                    'program_id' => $programId,
                    'outcome_text' => $outcomeText,
                    'urutan' => $urutanOutcome,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('program_outcome', $dataOutcome);
                $outcomeId = $this->db->insert_id();
                $urutanOutcome += 10;
                
                // Proses indikator per outcome
                $indikators = $outcome['indikators'] ?? [];
                if (!empty($indikators) && is_array($indikators)) {
                    $urutanInd = 10;
                    foreach ($indikators as $ind) {
                        if (empty(trim($ind['indikator'] ?? ''))) continue;
                        
                        $dataInd = [
                            'outcome_id' => $outcomeId,
                            'indikator' => trim($ind['indikator']),
                            'satuan' => trim($ind['satuan'] ?? ''),
                            'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                            'target_2026' => trim($ind['target_2026'] ?? ''),
                            'pagu_2026' => $this->_program_format_pagu($ind['pagu_2026'] ?? null),
                            'target_2027' => trim($ind['target_2027'] ?? ''),
                            'pagu_2027' => $this->_program_format_pagu($ind['pagu_2027'] ?? null),
                            'target_2028' => trim($ind['target_2028'] ?? ''),
                            'pagu_2028' => $this->_program_format_pagu($ind['pagu_2028'] ?? null),
                            'target_2029' => trim($ind['target_2029'] ?? ''),
                            'pagu_2029' => $this->_program_format_pagu($ind['pagu_2029'] ?? null),
                            'target_2030' => trim($ind['target_2030'] ?? ''),
                            'pagu_2030' => $this->_program_format_pagu($ind['pagu_2030'] ?? null),
                            'perangkat_daerah_id' => isset($ind['perangkat_daerah_id']) ? (int)$ind['perangkat_daerah_id'] : null,
                            'urutan' => $urutanInd,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        $this->db->insert('program_indikator', $dataInd);
                        $urutanInd += 10;
                    }
                }
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Program berhasil ditambahkan!', 'id' => $programId]);
        }
    }

    /**
     * EDIT PROGRAM + OUTCOME + INDIKATOR
     * POST: id, bidang_urusan_id, kode_program, nama_program,
     *       outcomes[][id, outcome_text, deleted, indikators[][id, indikator, ...]]
     */
    public function program_edit_program() {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodeWilayah = $this->_checkSessionWilayah();
        if (!$kodeWilayah) return;
        
        $id = (int)$this->input->post('id', TRUE);
        $bidangId = (int)$this->input->post('bidang_urusan_id', TRUE);
        $kode = trim($this->input->post('kode_program', TRUE));
        $nama = trim($this->input->post('nama_program', TRUE));
        $outcomes = $this->input->post('outcomes', TRUE);
        
        if ($id <= 0 || $bidangId <= 0 || empty($nama)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap!']);
            return;
        }
        
        // Cek program ada
        $program = $this->db->where('id', $id)->where('kode_wilayah', $kodeWilayah)->where('deleted_at IS NULL')->get('program_data')->row_array();
        if (!$program) {
            echo json_encode(['status' => 'error', 'message' => 'Program tidak ditemukan!']);
            return;
        }
        
        $this->db->trans_start();
        
        // Update program
        $this->db->where('id', $id)->update('program_data', [
            'bidang_urusan_id' => $bidangId,
            'kode_program' => $kode ?: null,
            'nama_program' => $nama,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // Ambil semua outcome yang ada untuk program ini
        $existingOutcomes = $this->db->select('id')->where('program_id', $id)->where('deleted_at IS NULL')->get('program_outcome')->result_array();
        $existingOutcomeIds = array_column($existingOutcomes, 'id');
        
        $newOutcomeIds = [];
        $urutanOutcome = 10;
        
        // Proses outcomes yang dikirim
        if (!empty($outcomes) && is_array($outcomes)) {
            foreach ($outcomes as $outcome) {
                $outcomeId = isset($outcome['id']) ? (int)$outcome['id'] : 0;
                $outcomeText = trim($outcome['outcome_text'] ?? '');
                if (empty($outcomeText)) continue;
                
                $isDeleted = isset($outcome['deleted']) && $outcome['deleted'] == 1;
                
                if ($outcomeId > 0 && !$isDeleted) {
                    // Update existing outcome
                    $this->db->where('id', $outcomeId)->where('program_id', $id)->update('program_outcome', [
                        'outcome_text' => $outcomeText,
                        'urutan' => $urutanOutcome,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    $newOutcomeIds[] = $outcomeId;
                    $urutanOutcome += 10;
                } elseif ($outcomeId > 0 && $isDeleted) {
                    // Hapus outcome (soft delete)
                    $this->db->where('id', $outcomeId)->where('program_id', $id)->update('program_outcome', ['deleted_at' => date('Y-m-d H:i:s')]);
                    // Hapus indikator terkait
                    $this->db->where('outcome_id', $outcomeId)->update('program_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
                    continue;
                } else {
                    // Insert new outcome
                    $dataOutcome = [
                        'program_id' => $id,
                        'outcome_text' => $outcomeText,
                        'urutan' => $urutanOutcome,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    $this->db->insert('program_outcome', $dataOutcome);
                    $outcomeId = $this->db->insert_id();
                    $newOutcomeIds[] = $outcomeId;
                    $urutanOutcome += 10;
                }
                
                // Sekarang proses indikator untuk outcome ini
                $indikators = $outcome['indikators'] ?? [];
                if (!empty($indikators) && is_array($indikators)) {
                    // Ambil indikator yang sudah ada untuk outcome ini
                    $existingInds = $this->db->select('id')->where('outcome_id', $outcomeId)->where('deleted_at IS NULL')->get('program_indikator')->result_array();
                    $existingIndIds = array_column($existingInds, 'id');
                    $newIndIds = [];
                    $urutanInd = 10;
                    
                    foreach ($indikators as $ind) {
                        $indId = isset($ind['id']) ? (int)$ind['id'] : 0;
                        $indText = trim($ind['indikator'] ?? '');
                        if (empty($indText)) continue;
                        
                        $isDeletedInd = isset($ind['deleted']) && $ind['deleted'] == 1;
                        
                        if ($indId > 0 && !$isDeletedInd) {
                            // Update existing
                            $this->db->where('id', $indId)->where('outcome_id', $outcomeId)->update('program_indikator', [
                                'indikator' => $indText,
                                'satuan' => trim($ind['satuan'] ?? ''),
                                'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                                'target_2026' => trim($ind['target_2026'] ?? ''),
                                'pagu_2026' => $this->_program_format_pagu($ind['pagu_2026'] ?? null),
                                'target_2027' => trim($ind['target_2027'] ?? ''),
                                'pagu_2027' => $this->_program_format_pagu($ind['pagu_2027'] ?? null),
                                'target_2028' => trim($ind['target_2028'] ?? ''),
                                'pagu_2028' => $this->_program_format_pagu($ind['pagu_2028'] ?? null),
                                'target_2029' => trim($ind['target_2029'] ?? ''),
                                'pagu_2029' => $this->_program_format_pagu($ind['pagu_2029'] ?? null),
                                'target_2030' => trim($ind['target_2030'] ?? ''),
                                'pagu_2030' => $this->_program_format_pagu($ind['pagu_2030'] ?? null),
                                'perangkat_daerah_id' => isset($ind['perangkat_daerah_id']) ? (int)$ind['perangkat_daerah_id'] : null,
                                'urutan' => $urutanInd,
                                'updated_at' => date('Y-m-d H:i:s')
                            ]);
                            $newIndIds[] = $indId;
                        } elseif ($indId > 0 && $isDeletedInd) {
                            // Hapus indikator
                            $this->db->where('id', $indId)->where('outcome_id', $outcomeId)->update('program_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
                            continue;
                        } else {
                            // Insert new indikator
                            $dataInd = [
                                'outcome_id' => $outcomeId,
                                'indikator' => $indText,
                                'satuan' => trim($ind['satuan'] ?? ''),
                                'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                                'target_2026' => trim($ind['target_2026'] ?? ''),
                                'pagu_2026' => $this->_program_format_pagu($ind['pagu_2026'] ?? null),
                                'target_2027' => trim($ind['target_2027'] ?? ''),
                                'pagu_2027' => $this->_program_format_pagu($ind['pagu_2027'] ?? null),
                                'target_2028' => trim($ind['target_2028'] ?? ''),
                                'pagu_2028' => $this->_program_format_pagu($ind['pagu_2028'] ?? null),
                                'target_2029' => trim($ind['target_2029'] ?? ''),
                                'pagu_2029' => $this->_program_format_pagu($ind['pagu_2029'] ?? null),
                                'target_2030' => trim($ind['target_2030'] ?? ''),
                                'pagu_2030' => $this->_program_format_pagu($ind['pagu_2030'] ?? null),
                                'perangkat_daerah_id' => isset($ind['perangkat_daerah_id']) ? (int)$ind['perangkat_daerah_id'] : null,
                                'urutan' => $urutanInd,
                                'created_at' => date('Y-m-d H:i:s')
                            ];
                            $this->db->insert('program_indikator', $dataInd);
                            $newIndIds[] = $this->db->insert_id();
                        }
                        $urutanInd += 10;
                    }
                    
                    // Hapus indikator yang tidak ada di daftar baru (soft delete)
                    $deletedInds = array_diff($existingIndIds, $newIndIds);
                    if (!empty($deletedInds)) {
                        $this->db->where_in('id', $deletedInds)->where('outcome_id', $outcomeId)->update('program_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
                    }
                } else {
                    // Tidak ada indikator, hapus semua indikator yang ada untuk outcome ini
                    $this->db->where('outcome_id', $outcomeId)->update('program_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
                }
            }
        }
        
        // Hapus outcome yang tidak ada di daftar baru
        $deletedOutcomes = array_diff($existingOutcomeIds, $newOutcomeIds);
        if (!empty($deletedOutcomes)) {
            $this->db->where_in('id', $deletedOutcomes)->where('program_id', $id)->update('program_outcome', ['deleted_at' => date('Y-m-d H:i:s')]);
            // Hapus indikator yang terkait
            $this->db->where_in('outcome_id', $deletedOutcomes)->update('program_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate data!']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Program berhasil diupdate!']);
        }
    }

    /**
     * GET PROGRAM BY ID (dengan outcomes dan indikators)
     */
    public function program_get_by_id() {
        if (!$this->input->is_ajax_request()) show_404();
        
        $id = (int)$this->input->post('id', TRUE);
        $kodeWilayah = $this->_getKodeWilayah();
        
        if ($id <= 0 || empty($kodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $program = $this->db
            ->select('p.*, b.nama_bidang, b.kode_bidang, u.nama_urusan, u.kode_urusan')
            ->from('program_data p')
            ->join('program_bidang_urusan b', 'b.id = p.bidang_urusan_id', 'left')
            ->join('program_urusan u', 'u.id = b.urusan_id', 'left')
            ->where('p.id', $id)
            ->where('p.kode_wilayah', $kodeWilayah)
            ->where('p.deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if (!$program) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            return;
        }
        
        // Ambil outcomes
        $outcomes = $this->db
            ->select('*')
            ->where('program_id', $id)
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get('program_outcome')
            ->result_array();
        
        foreach ($outcomes as &$out) {
            $out['indikators'] = $this->db
                ->select('*, id as indikator_id')
                ->where('outcome_id', $out['id'])
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->get('program_indikator')
                ->result_array();
        }
        $program['outcomes'] = $outcomes;
        
        echo json_encode(['status' => 'success', 'data' => $program]);
    }

    /**
     * HAPUS PROGRAM (soft delete) + semua outcome & indikator
     */
    public function program_hapus_program() {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodeWilayah = $this->_checkSessionWilayah();
        if (!$kodeWilayah) return;
        
        $id = (int)$this->input->post('id', TRUE);
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
            return;
        }
        
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();
        
        // Soft delete program
        $this->db->where('id', $id)->where('kode_wilayah', $kodeWilayah)->update('program_data', ['deleted_at' => $now]);
        
        // Ambil outcome IDs
        $outcomeIds = $this->db->select('id')->where('program_id', $id)->where('deleted_at IS NULL')->get('program_outcome')->result_array();
        if ($outcomeIds) {
            $ids = array_column($outcomeIds, 'id');
            // Soft delete outcomes
            $this->db->where_in('id', $ids)->update('program_outcome', ['deleted_at' => $now]);
            // Soft delete indikators
            $this->db->where_in('outcome_id', $ids)->update('program_indikator', ['deleted_at' => $now]);
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        }
    }

    /**
     * HAPUS OUTCOME (soft delete) + indikator terkait
     */
    public function program_hapus_outcome() {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodeWilayah = $this->_checkSessionWilayah();
        if (!$kodeWilayah) return;
        
        $id = (int)$this->input->post('id', TRUE);
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
            return;
        }
        
        // Cek outcome milik wilayah ini
        $outcome = $this->db
            ->select('po.*')
            ->from('program_outcome po')
            ->join('program_data p', 'p.id = po.program_id')
            ->where('po.id', $id)
            ->where('p.kode_wilayah', $kodeWilayah)
            ->where('po.deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if (!$outcome) {
            echo json_encode(['status' => 'error', 'message' => 'Outcome tidak ditemukan!']);
            return;
        }
        
        $now = date('Y-m-d H:i:s');
        $this->db->trans_start();
        
        // Soft delete outcome
        $this->db->where('id', $id)->update('program_outcome', ['deleted_at' => $now]);
        // Soft delete indikator
        $this->db->where('outcome_id', $id)->update('program_indikator', ['deleted_at' => $now]);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus outcome!']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Outcome berhasil dihapus!']);
        }
    }

    /**
     * HAPUS INDIKATOR (soft delete)
     */
    public function program_hapus_indikator() {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodeWilayah = $this->_checkSessionWilayah();
        if (!$kodeWilayah) return;
        
        $id = (int)$this->input->post('id', TRUE);
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
            return;
        }
        
        // Cek indikator milik wilayah ini
        $ind = $this->db
            ->select('pi.*')
            ->from('program_indikator pi')
            ->join('program_outcome po', 'po.id = pi.outcome_id')
            ->join('program_data p', 'p.id = po.program_id')
            ->where('pi.id', $id)
            ->where('p.kode_wilayah', $kodeWilayah)
            ->where('pi.deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if (!$ind) {
            echo json_encode(['status' => 'error', 'message' => 'Indikator tidak ditemukan!']);
            return;
        }
        
        $this->db->where('id', $id)->update('program_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
        
        echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil dihapus!']);
    }

    /**
     * TAMBAH OUTCOME KE PROGRAM YANG SUDAH ADA
     */
    public function program_tambah_outcome() {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodeWilayah = $this->_checkSessionWilayah();
        if (!$kodeWilayah) return;
        
        $programId = (int)$this->input->post('program_id', TRUE);
        $outcomeText = trim($this->input->post('outcome_text', TRUE));
        
        if ($programId <= 0 || empty($outcomeText)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap!']);
            return;
        }
        
        // Cek program
        $program = $this->db->where('id', $programId)->where('kode_wilayah', $kodeWilayah)->where('deleted_at IS NULL')->get('program_data')->row_array();
        if (!$program) {
            echo json_encode(['status' => 'error', 'message' => 'Program tidak ditemukan!']);
            return;
        }
        
        // Urutan terakhir
        $lastUrutan = $this->db->select_max('urutan')->where('program_id', $programId)->where('deleted_at IS NULL')->get('program_outcome')->row()->urutan;
        $urutan = ($lastUrutan ? $lastUrutan + 10 : 10);
        
        $data = [
            'program_id' => $programId,
            'outcome_text' => $outcomeText,
            'urutan' => $urutan,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('program_outcome', $data);
        $outcomeId = $this->db->insert_id();
        
        if ($outcomeId) {
            echo json_encode(['status' => 'success', 'message' => 'Outcome berhasil ditambahkan!', 'id' => $outcomeId]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan outcome!']);
        }
    }

    /**
     * TAMBAH INDIKATOR KE OUTCOME YANG SUDAH ADA
     */
    public function program_tambah_indikator() {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodeWilayah = $this->_checkSessionWilayah();
        if (!$kodeWilayah) return;
        
        $outcomeId = (int)$this->input->post('outcome_id', TRUE);
        $indikator = trim($this->input->post('indikator', TRUE));
        $satuan = trim($this->input->post('satuan', TRUE));
        $kondisiAwal = trim($this->input->post('kondisi_awal', TRUE));
        $target2026 = trim($this->input->post('target_2026', TRUE));
        $pagu2026 = $this->_program_format_pagu($this->input->post('pagu_2026', TRUE));
        $target2027 = trim($this->input->post('target_2027', TRUE));
        $pagu2027 = $this->_program_format_pagu($this->input->post('pagu_2027', TRUE));
        $target2028 = trim($this->input->post('target_2028', TRUE));
        $pagu2028 = $this->_program_format_pagu($this->input->post('pagu_2028', TRUE));
        $target2029 = trim($this->input->post('target_2029', TRUE));
        $pagu2029 = $this->_program_format_pagu($this->input->post('pagu_2029', TRUE));
        $target2030 = trim($this->input->post('target_2030', TRUE));
        $pagu2030 = $this->_program_format_pagu($this->input->post('pagu_2030', TRUE));
        $perangkatDaerahId = $this->input->post('perangkat_daerah_id', TRUE) ?: null;
        
        if ($outcomeId <= 0 || empty($indikator)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap!']);
            return;
        }
        
        // Cek outcome
        $outcome = $this->db
            ->select('po.*')
            ->from('program_outcome po')
            ->join('program_data p', 'p.id = po.program_id')
            ->where('po.id', $outcomeId)
            ->where('p.kode_wilayah', $kodeWilayah)
            ->where('po.deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if (!$outcome) {
            echo json_encode(['status' => 'error', 'message' => 'Outcome tidak ditemukan!']);
            return;
        }
        
        $lastUrutan = $this->db->select_max('urutan')->where('outcome_id', $outcomeId)->where('deleted_at IS NULL')->get('program_indikator')->row()->urutan;
        $urutan = ($lastUrutan ? $lastUrutan + 10 : 10);
        
        $data = [
            'outcome_id' => $outcomeId,
            'indikator' => $indikator,
            'satuan' => $satuan,
            'kondisi_awal' => $kondisiAwal,
            'target_2026' => $target2026,
            'pagu_2026' => $pagu2026,
            'target_2027' => $target2027,
            'pagu_2027' => $pagu2027,
            'target_2028' => $target2028,
            'pagu_2028' => $pagu2028,
            'target_2029' => $target2029,
            'pagu_2029' => $pagu2029,
            'target_2030' => $target2030,
            'pagu_2030' => $pagu2030,
            'perangkat_daerah_id' => $perangkatDaerahId,
            'urutan' => $urutan,
            'created_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('program_indikator', $data);
        $indId = $this->db->insert_id();
        
        if ($indId) {
            echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil ditambahkan!', 'id' => $indId]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menambahkan indikator!']);
        }
    }


        /**
     * Format angka ke format Rupiah untuk display
     */
    private function formatRupiah($angka) {
        if (empty($angka) && $angka !== 0 && $angka !== '0') {
            return '-';
        }
        return number_format((float)$angka, 0, ',', '.');
    }

    /**
     * Parse angka dari format Rupiah ke float
     */
    private function parseRupiah($rupiah) {
        if (empty($rupiah)) return null;
        $clean = str_replace(['Rp', ' ', '.', ','], '', $rupiah);
        if (!is_numeric($clean)) return null;
        return (float)$clean;
    }

        // ============================================================
        // FUNGSI BANTUAN PROSES INDIKATOR
        // ============================================================
    private function _program_proses_indikator($programId, $kodeWilayah) {
        // Ambil data indikator dari POST (TANPA OUTCOME)
        $indikatorIds = $this->input->post('indikator_id', TRUE);
        $indikator = $this->input->post('indikator', TRUE);
        $satuan = $this->input->post('satuan', TRUE);
        $kondisiAwal = $this->input->post('kondisi_awal', TRUE);
        
        // Target dan Pagu per tahun
        $target2026 = $this->input->post('target_2026', TRUE);
        $pagu2026 = $this->input->post('pagu_2026', TRUE);
        $target2027 = $this->input->post('target_2027', TRUE);
        $pagu2027 = $this->input->post('pagu_2027', TRUE);
        $target2028 = $this->input->post('target_2028', TRUE);
        $pagu2028 = $this->input->post('pagu_2028', TRUE);
        $target2029 = $this->input->post('target_2029', TRUE);
        $pagu2029 = $this->input->post('pagu_2029', TRUE);
        $target2030 = $this->input->post('target_2030', TRUE);
        $pagu2030 = $this->input->post('pagu_2030', TRUE);
        
        $perangkatDaerahId = $this->input->post('perangkat_daerah_id', TRUE);
        
        // Jika tidak ada indikator yang dikirim, hapus semua
        if (empty($indikator) || !is_array($indikator)) {
            $this->db->where('program_id', $programId);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('program_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
            return;
        }
        
        $now = date('Y-m-d H:i:s');
        
        // KUMPULKAN ID INDIKATOR YANG DIKIRIM DARI FORM
        $submittedIds = [];
        foreach ($indikator as $key => $text) {
            if (empty(trim($text))) continue;
            $id = isset($indikatorIds[$key]) ? (int)$indikatorIds[$key] : 0;
            if ($id > 0) {
                $submittedIds[] = $id;
            }
        }
        
        // SOFT DELETE INDIKATOR YANG TIDAK ADA DI FORM
        if (!empty($submittedIds)) {
            $this->db->where('program_id', $programId);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->where_not_in('id', $submittedIds);
            $this->db->update('program_indikator', ['deleted_at' => $now]);
        } else {
            $this->db->where('program_id', $programId);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('program_indikator', ['deleted_at' => $now]);
        }
        
        // INSERT ATAU UPDATE INDIKATOR (TANPA OUTCOME)
        $urutan = 10;
        foreach ($indikator as $key => $text) {
            if (empty(trim($text))) continue;
            
            $id = isset($indikatorIds[$key]) ? (int)$indikatorIds[$key] : 0;
            
            $data = [
                'kode_wilayah' => $kodeWilayah,
                'program_id' => $programId,
                'indikator' => trim($text),
                'satuan' => isset($satuan[$key]) ? trim($satuan[$key]) : null,
                'kondisi_awal' => isset($kondisiAwal[$key]) ? trim($kondisiAwal[$key]) : null,
                'target_2026' => isset($target2026[$key]) ? trim($target2026[$key]) : null,
                'pagu_2026' => $this->_program_format_pagu(isset($pagu2026[$key]) ? $pagu2026[$key] : null),
                'target_2027' => isset($target2027[$key]) ? trim($target2027[$key]) : null,
                'pagu_2027' => $this->_program_format_pagu(isset($pagu2027[$key]) ? $pagu2027[$key] : null),
                'target_2028' => isset($target2028[$key]) ? trim($target2028[$key]) : null,
                'pagu_2028' => $this->_program_format_pagu(isset($pagu2028[$key]) ? $pagu2028[$key] : null),
                'target_2029' => isset($target2029[$key]) ? trim($target2029[$key]) : null,
                'pagu_2029' => $this->_program_format_pagu(isset($pagu2029[$key]) ? $pagu2029[$key] : null),
                'target_2030' => isset($target2030[$key]) ? trim($target2030[$key]) : null,
                'pagu_2030' => $this->_program_format_pagu(isset($pagu2030[$key]) ? $pagu2030[$key] : null),
                'perangkat_daerah_id' => isset($perangkatDaerahId[$key]) ? (int)$perangkatDaerahId[$key] : null,
                'urutan' => $urutan,
            ];
            
            if ($id > 0) {
                $data['updated_at'] = $now;
                $this->db->where('id', $id);
                $this->db->where('program_id', $programId);
                $this->db->update('program_indikator', $data);
            } else {
                $data['created_at'] = $now;
                $this->db->insert('program_indikator', $data);
            }
            
            $urutan += 10;
        }
    }

    private function _program_format_pagu($value) {
        if (empty($value)) return null;
        // Hapus titik (pemisah ribuan) dan koma
        $clean = str_replace(['.', ','], '', $value);
        // Hapus "Rp" jika ada
        $clean = str_replace('Rp', '', $clean);
        $clean = trim($clean);
        if (!is_numeric($clean)) return null;
        return (float)$clean;
    }

    

        // ============================================================
        // GET DROPDOWN DATA
        // ============================================================
        
        public function program_get_urusan_list() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_getKodeWilayah();
            if (empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('id, kode_urusan, nama_urusan')
                ->from('program_urusan')
                ->where('kode_wilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('kode_urusan', 'ASC')
                ->get()
                ->result_array();
            
            echo json_encode($data);
        }

        public function program_get_bidang_list() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_getKodeWilayah();
            $urusanId = (int)$this->input->post('urusan_id', TRUE);
            
            if (empty($kodeWilayah) || $urusanId <= 0) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('id, kode_bidang, nama_bidang')
                ->from('program_bidang_urusan')
                ->where('kode_wilayah', $kodeWilayah)
                ->where('urusan_id', $urusanId)
                ->where('deleted_at IS NULL')
                ->order_by('kode_bidang', 'ASC')
                ->get()
                ->result_array();
            
            echo json_encode($data);
        }

        public function program_get_perangkat_daerah() {
            if (!$this->input->is_ajax_request()) show_404();
            
            $kodeWilayah = $this->_getKodeWilayah();
            if (empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('kodewilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
            
            echo json_encode($data);
        }

        

            /**
         * Helper function untuk mendapatkan nama dari kode nomenklatur
         */
        private function getNomenklaturName($kode) {
            if (empty($kode)) return '';
            $data = $this->db->select('Nomenklatur')
                ->where('Kode', $kode)
                ->get('nomenklaturkabupaten')
                ->row_array();
            return $data ? $data['Nomenklatur'] : $kode;
        }


        /**
         * Helper function untuk mendapatkan semua urusan dari CSV
         */
        private function getUrusanNames($urusanCsv) {
            if (empty($urusanCsv)) return [];
            $ids = array_filter(array_map('trim', explode(',', $urusanCsv)));
            $names = [];
            foreach ($ids as $kode) {
                $dotCount = substr_count($kode, '.');
                if ($dotCount === 0) { // Level 1 - Urusan
                    $name = $this->getNomenklaturName($kode);
                    if ($name) $names[] = $name;
                }
            }
            return $names;
        }

        /**
         * Helper function untuk mendapatkan semua bidang urusan dari CSV
         */
        private function getBidangUrusanNames($urusanCsv) {
            if (empty($urusanCsv)) return [];
            $ids = array_filter(array_map('trim', explode(',', $urusanCsv)));
            $names = [];
            foreach ($ids as $kode) {
                $dotCount = substr_count($kode, '.');
                if ($dotCount === 1) { // Level 2 - Bidang Urusan
                    $name = $this->getNomenklaturName($kode);
                    if ($name) $names[] = $name;
                }
            }
            return $names;
        }

        // ============================================================
    // GET URUSAN BY ID (UNTUK EDIT BIDANG)
    // ============================================================
    public function program_get_urusan_by_id() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        $kodeWilayah = $this->_getKodeWilayah();
        
        if ($id <= 0 || empty($kodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $data = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $kodeWilayah)
            ->where('deleted_at IS NULL')
            ->get('program_urusan')
            ->row_array();
        
        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    // ============================================================
    // GET BIDANG BY ID (UNTUK EDIT PROGRAM)
    // ============================================================
    public function program_get_bidang_by_id() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        $kodeWilayah = $this->_getKodeWilayah();
        
        if ($id <= 0 || empty($kodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $data = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $kodeWilayah)
            ->where('deleted_at IS NULL')
            ->get('program_bidang_urusan')
            ->row_array();
        
        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

            

        // ============================================================
        // NOMENKLATUR UNTUK PROGRAM PD - PERBAIKAN TOTAL
        // ============================================================

        public function getNomenklaturProgramPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $level = (int)$this->input->post('level');
            $parent_kode = $this->input->post('parent_kode');
            
            if ($level < 1 || $level > 3) {
                echo json_encode([]);
                return;
            }
            
            $this->db->select('Kode, Nomenklatur');
            $this->db->from('nomenklaturkabupaten');
            
            if ($level == 1) {
                // Urusan: 0 titik (contoh: 1, 2, 3, ...)
                $this->db->where('Kode NOT LIKE', '%.%');
                $this->db->where('LENGTH(Kode) = 1');
                $this->db->order_by('Kode', 'ASC');
            } elseif ($level == 2) {
                // Bidang Urusan: 1 titik (contoh: 1.01, 1.02, 1.03, ...)
                $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1);
                if ($parent_kode) {
                    $this->db->where('Kode LIKE', $parent_kode . '.%');
                }
                $this->db->order_by('Kode', 'ASC');
            } elseif ($level == 3) {
                // Program: 2 titik (contoh: 1.01.02, 1.01.03, ...)
                $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 2);
                if ($parent_kode) {
                    $this->db->where('Kode LIKE', $parent_kode . '.%');
                }
                $this->db->order_by('Kode', 'ASC');
            }
            
            $data = $this->db->get()->result_array();
            
            echo json_encode($data);
        }

        /**
         * Get Nomenklatur Detail by Kode (AJAX)
         * Untuk mendapatkan detail saat edit
         */
        public function getNomenklaturDetailProgramPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kode = $this->input->post('kode', TRUE);
            
            if (empty($kode)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode tidak ditemukan']);
                return;
            }
            
            $data = $this->db
                ->select('Kode, Nomenklatur')
                ->from('nomenklaturkabupaten')
                ->where('Kode', $kode)
                ->get()
                ->row_array();
            
            if ($data) {
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }


                // =====================================================================
                // ULTIMATE OUTCOME (Level 1)
                // =====================================================================

                public function Ultimate_outcome()
                {
                    $header['Halaman'] = 'Ultimate Outcome';

                    $kodewilayah = $this->session->userdata('KodeWilayah') 
                                ?? $this->session->userdata('TempKodeWilayah') ?? '';

                    $data['KodeWilayah'] = $kodewilayah;
                    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                                ->order_by('Nama')
                                                ->get('kodewilayah')
                                                ->result_array();

                    $data['items'] = [];

                    if ($kodewilayah) {
                        $data['items'] = $this->db
                            ->where('kode_wilayah', $kodewilayah)
                            ->where('deleted_at IS NULL')
                            ->order_by('id', 'ASC')
                            ->get('pk_ultimate_outcome')
                            ->result_array();
                    }

                    // Ambil Nama Wilayah
                    if ($kodewilayah) {
                        $wil = $this->db
                            ->where('Kode', $kodewilayah)
                            ->get('kodewilayah')
                            ->row_array();

                        $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
                    } else {
                        $data['NamaWilayah'] = '';
                    }

                    $this->load->view('Daerah/header', $header);
                    $this->load->view('Daerah/Ultimate_outcome', $data);
                }

                public function Ultimate_outcome_simpan()
                {
                    if (!$this->input->is_ajax_request()) {
                        show_404();
                        return;
                    }

                    $kodewilayah = $this->session->userdata('KodeWilayah') 
                                ?? $this->session->userdata('TempKodeWilayah');

                    if (!$kodewilayah) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Wilayah belum dipilih'
                        ]);
                        return;
                    }

                    $id       = $this->input->post('id', TRUE);
                    $kinerja  = trim($this->input->post('kinerja', TRUE));
                    $ind_list = $this->input->post('indikator') ?: [];

                    if (empty($kinerja)) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Kinerja wajib diisi'
                        ]);
                        return;
                    }

                    $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

                    $save = [
                        'kode_wilayah' => $kodewilayah,
                        'kinerja'      => $kinerja,
                        'indikator'    => $indikator,
                        'updated_at'   => date('Y-m-d H:i:s')
                    ];

                    if ($id) {
                        $this->db->where('id', $id)
                                ->where('kode_wilayah', $kodewilayah)
                                ->update('pk_ultimate_outcome', $save);
                        $msg = 'Data berhasil diperbarui';
                    } else {
                        $save['created_at'] = date('Y-m-d H:i:s');
                        $this->db->insert('pk_ultimate_outcome', $save);
                        $msg = 'Data berhasil ditambahkan';
                    }

                    echo json_encode([
                        'status' => 'success',
                        'message' => $msg
                    ]);
                    exit;
                }

                public function Ultimate_outcome_hapus()
                {
                    if (!$this->input->is_ajax_request()) show_404();

                    $id = $this->input->post('id', TRUE);
                    $kodewilayah = $this->session->userdata('KodeWilayah') 
                                ?? $this->session->userdata('TempKodeWilayah');

                    if (!$id || !$kodewilayah) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Parameter tidak lengkap'
                        ]);
                        exit;
                    }

                    $this->db->where('id', $id)
                            ->where('kode_wilayah', $kodewilayah)
                            ->update('pk_ultimate_outcome', ['deleted_at' => date('Y-m-d H:i:s')]);

                    $status = $this->db->affected_rows() > 0 ? 'success' : 'error';

                    echo json_encode([
                        'status' => $status,
                        'message' => 'Data berhasil dihapus'
                    ]);
                    exit;
                }

            /**
             * =====================================================================
             * INTERMEDIATE OUTCOME SEKTOR (Level 2)
             * =====================================================================
             */
            public function Intermediate_sektor()
            {
                $header['Halaman'] = 'Intermediate Outcome Sektor';

                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';

                $data['KodeWilayah'] = $kodewilayah;
                $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                            ->order_by('Nama')
                                            ->get('kodewilayah')
                                            ->result_array();

                $data['items'] = [];
                $data['ultimate_options'] = [];

                if ($kodewilayah) {
                    // Ambil data intermediate sektor dengan join ke ultimate outcome
                    $this->db->select('s.*, u.kinerja as ultimate_kinerja');
                    $this->db->from('pk_intermediate_sektor s');
                    $this->db->join('pk_ultimate_outcome u', 'u.id = s.ultimate_outcome_id', 'left');
                    $this->db->where('s.kode_wilayah', $kodewilayah);
                    $this->db->where('s.deleted_at IS NULL');
                    $this->db->order_by('s.id', 'ASC');
                    $data['items'] = $this->db->get()->result_array();

                    // Ambil options untuk ultimate outcome
                    $data['ultimate_options'] = $this->db
                        ->select('id, kinerja')
                        ->where('kode_wilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->order_by('id', 'ASC')
                        ->get('pk_ultimate_outcome')
                        ->result_array();
                }

                // Ambil Nama Wilayah
                if ($kodewilayah) {
                    $wil = $this->db
                        ->where('Kode', $kodewilayah)
                        ->get('kodewilayah')
                        ->row_array();

                    $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
                } else {
                    $data['NamaWilayah'] = '';
                }

                $this->load->view('Daerah/header', $header);
                $this->load->view('Daerah/Intermediate_sektor', $data);
            }

            /**
             * =====================================================================
             * GET DAFTAR DINAS (akun_instansi Level 2)
             * =====================================================================
             */
            public function get_daftar_dinas()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil data dinas dari akun_instansi dengan Level 2
                $dinas = $this->db
                    ->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($dinas);
                exit;
            }

            /**
             * =====================================================================
             * GET PELAKSANA BY DINAS (FILTER) - MEMAKAI FIND_IN_SET
             * =====================================================================
             */
            public function get_pelaksana_by_dinas()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                $dinas_id = $this->input->post('dinas_id', TRUE);
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                $this->db->select('
                    akun_karyawan.id,
                    akun_karyawan.nama,
                    akun_karyawan.nip,
                    akun_karyawan.jabatan,
                    akun_karyawan.dinas_id,
                    GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
                ')
                ->from('akun_karyawan')
                ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
                ->where('akun_karyawan.Level', 4)
                ->where('akun_karyawan.kodewilayah', $kodewilayah)
                ->where('akun_karyawan.deleted_at IS NULL');
                
                // Filter berdasarkan dinas jika dipilih (menggunakan FIND_IN_SET)
                if (!empty($dinas_id) && $dinas_id != '') {
                    $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
                }
                
                $pelaksana = $this->db
                    ->group_by('akun_karyawan.id')
                    ->order_by('akun_karyawan.nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($pelaksana);
                exit;
            }

            /**
             * =====================================================================
             * GET DETAIL PELAKSANA (untuk edit)
             * =====================================================================
             */
            public function get_pelaksana_detail()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$id || !$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                $detail = $this->db
                    ->select('id, nama, nip, jabatan, dinas_id')
                    ->from('akun_karyawan')
                    ->where('id', $id)
                    ->where('kodewilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get()
                    ->row_array();

                echo json_encode($detail);
                exit;
            }

            /**
             * =====================================================================
             * SIMPAN INTERMEDIATE SEKTOR
             * =====================================================================
             */
            public function Intermediate_sektor_simpan()
            {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }

                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$kodewilayah) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih'
                    ]);
                    return;
                }

                $id               = $this->input->post('id', TRUE);
                $ultimate_id      = $this->input->post('ultimate_id', TRUE);
                $kinerja          = trim($this->input->post('kinerja', TRUE));
                $ind_list         = $this->input->post('indikator') ?: [];
                $pelaksana_id     = $this->input->post('pelaksana', TRUE);
                $inovasi          = $this->input->post('inovasi_daerah', TRUE);
                $outcome_inovasi  = $this->input->post('outcome_inovasi', TRUE);
                $output_inovasi   = $this->input->post('output_inovasi', TRUE);
                $crosscutting     = $this->input->post('crosscutting');

                if (empty($kinerja)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Kinerja wajib diisi'
                    ]);
                    return;
                }

                // Validasi pelaksana exists di tabel akun_karyawan berdasarkan ID
                if ($pelaksana_id) {
                    $exists = $this->db
                        ->where('id', $pelaksana_id)
                        ->where('kodewilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->count_all_results('akun_karyawan');
                        
                    if (!$exists) {
                        echo json_encode([
                            'status'=>'error',
                            'message'=>'Pelaksana tidak valid atau tidak ditemukan'
                        ]);
                        return;
                    }
                }

                $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

                // Handle crosscutting - jika array, encode ke JSON
                $crosscutting_json = null;
                if (!empty($crosscutting) && is_array($crosscutting)) {
                    $crosscutting_json = json_encode($crosscutting);
                }

                $save = [
                    'kode_wilayah'            => $kodewilayah,
                    'ultimate_outcome_id'     => $ultimate_id ?: NULL,
                    'kinerja'                 => $kinerja,
                    'indikator'               => $indikator,
                    'pelaksana'               => $pelaksana_id ?: NULL,
                    'inovasi_daerah'          => $inovasi ?: NULL,
                    'outcome_inovasi'         => $outcome_inovasi ?: NULL,
                    'output_inovasi'          => $output_inovasi ?: NULL,
                    'crosscutting'            => $crosscutting_json,
                    'updated_at'              => date('Y-m-d H:i:s')
                ];

                if ($id) {
                    $this->db->where('id', $id)
                            ->where('kode_wilayah', $kodewilayah)
                            ->update('pk_intermediate_sektor', $save);
                    $msg = 'Data berhasil diperbarui';
                } else {
                    $save['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('pk_intermediate_sektor', $save);
                    $msg = 'Data berhasil ditambahkan';
                }

                echo json_encode([
                    'status' => 'success',
                    'message' => $msg
                ]);
                exit;
            }

            /**
             * =====================================================================
             * HAPUS INTERMEDIATE SEKTOR
             * =====================================================================
             */
            public function Intermediate_sektor_hapus()
            {
                if (!$this->input->is_ajax_request()) show_404();

                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$id || !$kodewilayah) {
                    echo json_encode([
                        'status'=>'error',
                        'message'=>'Parameter tidak lengkap'
                    ]);
                    exit;
                }

                // Cek dulu apakah data ada
                $exists = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get('pk_intermediate_sektor')
                    ->row();

                if (!$exists) {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Data tidak ditemukan'
                    ]);
                    exit;
                }

                $this->db->where('id', $id)
                        ->where('kode_wilayah', $kodewilayah)
                        ->update('pk_intermediate_sektor', ['deleted_at' => date('Y-m-d H:i:s')]);

                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status'  => 'success',
                        'message' => 'Data berhasil dihapus'
                    ]);
                } else {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Gagal menghapus data'
                    ]);
                }
                exit;
            }

            /**
             * =====================================================================
             * INTERMEDIATE OUTCOME TAKTIKAL (Level 3)
             * =====================================================================
             */
            public function Intermediate_taktikal()
            {
                $header['Halaman'] = 'Intermediate Outcome Taktikal';

                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';

                $data['KodeWilayah'] = $kodewilayah;
                $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                            ->order_by('Nama')
                                            ->get('kodewilayah')
                                            ->result_array();

                $data['items'] = [];
                $data['sektor_options'] = [];

                if ($kodewilayah) {
                    // Ambil data dengan join ke sektor
                    $this->db->select('t.*, s.kinerja as sektor_kinerja');
                    $this->db->from('pk_intermediate_taktikal t');
                    $this->db->join('pk_intermediate_sektor s', 's.id = t.intermediate_sektor_id', 'left');
                    $this->db->where('t.kode_wilayah', $kodewilayah);
                    $this->db->where('t.deleted_at IS NULL');
                    $this->db->order_by('t.id', 'ASC');
                    $data['items'] = $this->db->get()->result_array();

                    // Ambil options untuk intermediate sektor (Level 2)
                    $data['sektor_options'] = $this->db
                        ->select('id, kinerja')
                        ->where('kode_wilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->order_by('id', 'ASC')
                        ->get('pk_intermediate_sektor')
                        ->result_array();
                }

                // Ambil Nama Wilayah
                if ($kodewilayah) {
                    $wil = $this->db
                        ->where('Kode', $kodewilayah)
                        ->get('kodewilayah')
                        ->row_array();

                    $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
                } else {
                    $data['NamaWilayah'] = '';
                }

                $this->load->view('Daerah/header', $header);
                $this->load->view('Daerah/Intermediate_taktikal', $data);
            }

            /**
             * =====================================================================
             * GET DAFTAR DINAS UNTUK TAKTIKAL
             * =====================================================================
             */
            public function get_daftar_dinas_taktikal()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil data dinas dari akun_instansi dengan Level 2
                $dinas = $this->db
                    ->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($dinas);
                exit;
            }

            /**
             * =====================================================================
             * GET PELAKSANA BY DINAS UNTUK TAKTIKAL
             * =====================================================================
             */
            public function get_pelaksana_taktikal_by_dinas()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                $dinas_id = $this->input->post('dinas_id', TRUE);
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                $this->db->select('
                    akun_karyawan.id,
                    akun_karyawan.nama,
                    akun_karyawan.nip,
                    akun_karyawan.jabatan,
                    akun_karyawan.dinas_id,
                    GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
                ')
                ->from('akun_karyawan')
                ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
                ->where('akun_karyawan.Level', 4)
                ->where('akun_karyawan.kodewilayah', $kodewilayah)
                ->where('akun_karyawan.deleted_at IS NULL');
                
                // Filter berdasarkan dinas jika dipilih
                if (!empty($dinas_id) && $dinas_id != '') {
                    $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
                }
                
                $pelaksana = $this->db
                    ->group_by('akun_karyawan.id')
                    ->order_by('akun_karyawan.nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($pelaksana);
                exit;
            }

            /**
             * =====================================================================
             * GET DETAIL PELAKSANA UNTUK TAKTIKAL (untuk edit)
             * =====================================================================
             */
            public function get_pelaksana_taktikal_detail()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$id || !$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                $detail = $this->db
                    ->select('id, nama, nip, jabatan, dinas_id')
                    ->from('akun_karyawan')
                    ->where('id', $id)
                    ->where('kodewilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get()
                    ->row_array();

                echo json_encode($detail);
                exit;
            }

            /**
             * =====================================================================
             * GET PELAKSANA LEVEL 4 (SEMUA) - untuk fallback
             * =====================================================================
             */
            public function get_pelaksana_taktikal()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil data pelaksana dari tabel akun_karyawan dengan Level 4
                $pelaksana = $this->db
                    ->select('
                        akun_karyawan.id,
                        akun_karyawan.nama,
                        akun_karyawan.nip,
                        akun_karyawan.jabatan,
                        akun_karyawan.dinas_id,
                        GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
                    ')
                    ->from('akun_karyawan')
                    ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
                    ->where('akun_karyawan.Level', 4)
                    ->where('akun_karyawan.kodewilayah', $kodewilayah)
                    ->where('akun_karyawan.deleted_at IS NULL')
                    ->group_by('akun_karyawan.id')
                    ->order_by('akun_karyawan.nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($pelaksana);
                exit;
            }

            /**
             * =====================================================================
             * SIMPAN INTERMEDIATE TAKTIKAL
             * =====================================================================
             */
            public function Intermediate_taktikal_simpan()
            {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }

                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$kodewilayah) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih'
                    ]);
                    return;
                }

                $id               = $this->input->post('id', TRUE);
                $sektor_id        = $this->input->post('sektor_id', TRUE);
                $kinerja          = trim($this->input->post('kinerja', TRUE));
                $ind_list         = $this->input->post('indikator') ?: [];
                $pelaksana_id     = $this->input->post('pelaksana', TRUE); // BERISI ID
                $inovasi          = $this->input->post('inovasi_daerah', TRUE);
                $outcome_inovasi  = $this->input->post('outcome_inovasi', TRUE);
                $output_inovasi   = $this->input->post('output_inovasi', TRUE);
                $crosscutting     = $this->input->post('crosscutting');

                if (empty($kinerja)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Kinerja wajib diisi'
                    ]);
                    return;
                }

                // Validasi pelaksana exists di tabel akun_karyawan berdasarkan ID
                if ($pelaksana_id) {
                    $exists = $this->db
                        ->where('id', $pelaksana_id)
                        ->where('kodewilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->count_all_results('akun_karyawan');
                        
                    if (!$exists) {
                        echo json_encode([
                            'status'=>'error',
                            'message'=>'Pelaksana tidak valid atau tidak ditemukan'
                        ]);
                        return;
                    }
                }

                $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

                // Handle crosscutting - jika array, encode ke JSON
                $crosscutting_json = null;
                if (!empty($crosscutting) && is_array($crosscutting)) {
                    $crosscutting_json = json_encode($crosscutting);
                }

                $save = [
                    'kode_wilayah'             => $kodewilayah,
                    'intermediate_sektor_id'   => $sektor_id ?: NULL,
                    'kinerja'                  => $kinerja,
                    'indikator'                => $indikator,
                    'pelaksana'                => $pelaksana_id ?: NULL,
                    'inovasi_daerah'           => $inovasi ?: NULL,
                    'outcome_inovasi'          => $outcome_inovasi ?: NULL,
                    'output_inovasi'           => $output_inovasi ?: NULL,
                    'crosscutting'             => $crosscutting_json,
                    'updated_at'               => date('Y-m-d H:i:s')
                ];

                if ($id) {
                    $this->db->where('id', $id)
                            ->where('kode_wilayah', $kodewilayah)
                            ->update('pk_intermediate_taktikal', $save);
                    $msg = 'Data berhasil diperbarui';
                } else {
                    $save['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('pk_intermediate_taktikal', $save);
                    $msg = 'Data berhasil ditambahkan';
                }

                echo json_encode([
                    'status' => 'success',
                    'message' => $msg
                ]);
                exit;
            }

            /**
             * =====================================================================
             * HAPUS INTERMEDIATE TAKTIKAL
             * =====================================================================
             */
            public function Intermediate_taktikal_hapus()
            {
                if (!$this->input->is_ajax_request()) show_404();

                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$id || !$kodewilayah) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Parameter tidak lengkap'
                    ]);
                    exit;
                }

                // Cek dulu apakah data ada
                $exists = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get('pk_intermediate_taktikal')
                    ->row();

                if (!$exists) {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Data tidak ditemukan'
                    ]);
                    exit;
                }

                $this->db->where('id', $id)
                        ->where('kode_wilayah', $kodewilayah)
                        ->update('pk_intermediate_taktikal', ['deleted_at' => date('Y-m-d H:i:s')]);

                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status'  => 'success',
                        'message' => 'Data berhasil dihapus'
                    ]);
                } else {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Gagal menghapus data'
                    ]);
                }
                exit;
            }

                /**
             * =====================================================================
             * IMMEDIATE OUTCOME (Level 4)
             * =====================================================================
             */
            public function Immediate_outcome()
            {
                $header['Halaman'] = 'Immediate Outcome';

                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';

                $data['KodeWilayah'] = $kodewilayah;
                $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                            ->order_by('Nama')
                                            ->get('kodewilayah')
                                            ->result_array();

                $data['items'] = [];
                $data['taktikal_options'] = [];

                if ($kodewilayah) {
                    // Ambil data dengan join ke taktikal
                    $this->db->select('i.*, t.kinerja as taktikal_kinerja');
                    $this->db->from('pk_immediate_outcome i');
                    $this->db->join('pk_intermediate_taktikal t', 't.id = i.intermediate_taktikal_id', 'left');
                    $this->db->where('i.kode_wilayah', $kodewilayah);
                    $this->db->where('i.deleted_at IS NULL');
                    $this->db->order_by('i.id', 'ASC');
                    $data['items'] = $this->db->get()->result_array();

                    // Ambil options untuk intermediate taktikal (Level 3)
                    $data['taktikal_options'] = $this->db
                        ->select('id, kinerja')
                        ->where('kode_wilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->order_by('id', 'ASC')
                        ->get('pk_intermediate_taktikal')
                        ->result_array();
                }

                // Ambil Nama Wilayah
                if ($kodewilayah) {
                    $wil = $this->db
                        ->where('Kode', $kodewilayah)
                        ->get('kodewilayah')
                        ->row_array();

                    $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
                } else {
                    $data['NamaWilayah'] = '';
                }

                $this->load->view('Daerah/header', $header);
                $this->load->view('Daerah/Immediate_outcome', $data);
            }

            /**
             * =====================================================================
             * GET DAFTAR DINAS UNTUK IMMEDIATE OUTCOME
             * =====================================================================
             */
            public function get_daftar_dinas_immediate()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil data dinas dari akun_instansi dengan Level 2
                $dinas = $this->db
                    ->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($dinas);
                exit;
            }

            /**
             * =====================================================================
             * GET PELAKSANA BY DINAS UNTUK IMMEDIATE OUTCOME
             * =====================================================================
             */
            public function get_pelaksana_immediate_by_dinas()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                $dinas_id = $this->input->post('dinas_id', TRUE);
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                $this->db->select('
                    akun_karyawan.id,
                    akun_karyawan.nama,
                    akun_karyawan.nip,
                    akun_karyawan.jabatan,
                    akun_karyawan.dinas_id,
                    GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
                ')
                ->from('akun_karyawan')
                ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
                ->where('akun_karyawan.Level', 4)
                ->where('akun_karyawan.kodewilayah', $kodewilayah)
                ->where('akun_karyawan.deleted_at IS NULL');
                
                // Filter berdasarkan dinas jika dipilih
                if (!empty($dinas_id) && $dinas_id != '') {
                    $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
                }
                
                $pelaksana = $this->db
                    ->group_by('akun_karyawan.id')
                    ->order_by('akun_karyawan.nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($pelaksana);
                exit;
            }

            /**
             * =====================================================================
             * GET DETAIL PELAKSANA UNTUK IMMEDIATE OUTCOME (untuk edit)
             * =====================================================================
             */
            public function get_pelaksana_immediate_detail()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$id || !$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                $detail = $this->db
                    ->select('id, nama, nip, jabatan, dinas_id')
                    ->from('akun_karyawan')
                    ->where('id', $id)
                    ->where('kodewilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get()
                    ->row_array();

                echo json_encode($detail);
                exit;
            }

            /**
             * =====================================================================
             * GET PELAKSANA LEVEL 4 (SEMUA) - untuk fallback
             * =====================================================================
             */
            public function get_pelaksana_immediate()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil data pelaksana dari tabel akun_karyawan dengan Level 4
                $pelaksana = $this->db
                    ->select('
                        akun_karyawan.id,
                        akun_karyawan.nama,
                        akun_karyawan.nip,
                        akun_karyawan.jabatan,
                        akun_karyawan.dinas_id,
                        GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
                    ')
                    ->from('akun_karyawan')
                    ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
                    ->where('akun_karyawan.Level', 4)
                    ->where('akun_karyawan.kodewilayah', $kodewilayah)
                    ->where('akun_karyawan.deleted_at IS NULL')
                    ->group_by('akun_karyawan.id')
                    ->order_by('akun_karyawan.nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($pelaksana);
                exit;
            }

            /**
             * =====================================================================
             * SIMPAN IMMEDIATE OUTCOME
             * =====================================================================
             */
            public function Immediate_outcome_simpan()
            {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }

                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$kodewilayah) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih'
                    ]);
                    return;
                }

                $id               = $this->input->post('id', TRUE);
                $taktikal_id      = $this->input->post('taktikal_id', TRUE);
                $kinerja          = trim($this->input->post('kinerja', TRUE));
                $ind_list         = $this->input->post('indikator') ?: [];
                $pelaksana_id     = $this->input->post('pelaksana', TRUE);
                $inovasi          = $this->input->post('inovasi_daerah', TRUE);
                $outcome_inovasi  = $this->input->post('outcome_inovasi', TRUE);
                $output_inovasi   = $this->input->post('output_inovasi', TRUE);
                $crosscutting     = $this->input->post('crosscutting');

                if (empty($kinerja)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Kinerja wajib diisi'
                    ]);
                    return;
                }

                // Validasi pelaksana exists di tabel akun_karyawan berdasarkan ID
                if ($pelaksana_id) {
                    $exists = $this->db
                        ->where('id', $pelaksana_id)
                        ->where('kodewilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->count_all_results('akun_karyawan');
                        
                    if (!$exists) {
                        echo json_encode([
                            'status'=>'error',
                            'message'=>'Pelaksana tidak valid atau tidak ditemukan'
                        ]);
                        return;
                    }
                }

                $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

                // Handle crosscutting - jika array, encode ke JSON
                $crosscutting_json = null;
                if (!empty($crosscutting) && is_array($crosscutting)) {
                    $crosscutting_json = json_encode($crosscutting);
                }

                $save = [
                    'kode_wilayah'              => $kodewilayah,
                    'intermediate_taktikal_id'  => $taktikal_id ?: NULL,
                    'kinerja'                   => $kinerja,
                    'indikator'                 => $indikator,
                    'pelaksana'                 => $pelaksana_id ?: NULL,
                    'inovasi_daerah'            => $inovasi ?: NULL,
                    'outcome_inovasi'           => $outcome_inovasi ?: NULL,
                    'output_inovasi'            => $output_inovasi ?: NULL,
                    'crosscutting'              => $crosscutting_json,
                    'updated_at'                => date('Y-m-d H:i:s')
                ];

                if ($id) {
                    $this->db->where('id', $id)
                            ->where('kode_wilayah', $kodewilayah)
                            ->update('pk_immediate_outcome', $save);
                    $msg = 'Data berhasil diperbarui';
                } else {
                    $save['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('pk_immediate_outcome', $save);
                    $msg = 'Data berhasil ditambahkan';
                }

                echo json_encode([
                    'status' => 'success',
                    'message' => $msg
                ]);
                exit;
            }

            /**
             * =====================================================================
             * HAPUS IMMEDIATE OUTCOME
             * =====================================================================
             */
            public function Immediate_outcome_hapus()
            {
                if (!$this->input->is_ajax_request()) show_404();

                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$id || !$kodewilayah) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Parameter tidak lengkap'
                    ]);
                    exit;
                }

                // Cek dulu apakah data ada
                $exists = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get('pk_immediate_outcome')
                    ->row();

                if (!$exists) {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Data tidak ditemukan'
                    ]);
                    exit;
                }

                $this->db->where('id', $id)
                        ->where('kode_wilayah', $kodewilayah)
                        ->update('pk_immediate_outcome', ['deleted_at' => date('Y-m-d H:i:s')]);

                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status'  => 'success',
                        'message' => 'Data berhasil dihapus'
                    ]);
                } else {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Gagal menghapus data'
                    ]);
                }
                exit;
            }


                /**
             * ======================================================
             * TAMPIL POHON KINERJA (5 Level)
             * ======================================================
             */
            public function TampilPohonKinerja()
            {
                // ==============================
                // 1. CEK SESSION WILAYAH
                // ==============================
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';

                $data['KodeWilayah'] = $kodewilayah;
                $data['Provinsi'] = $this->GetListProvinsiData();
                $data['NamaWilayah'] = '';
                $data['TotalData'] = [
                    'level1' => 0,
                    'level2' => 0,
                    'level3' => 0,
                    'level4' => 0,
                    'level5' => 0
                ];
                $data['ChartData'] = json_encode(['nama' => 'ROOT', 'children' => []]);

                // ==============================
                // 2. JIKA WILAYAH SUDAH DIPILIH, AMBIL DATA
                // ==============================
                if (!empty($kodewilayah)) {
                    
                    // Ambil Nama Wilayah
                    $wil = $this->db
                        ->where('Kode', $kodewilayah)
                        ->get('kodewilayah')
                        ->row_array();

                    $data['NamaWilayah'] = $wil ? $wil['Nama'] : 'Wilayah Tidak Dikenal';

                    // Ambil semua data pelaksana untuk mapping ID ke nama
                    $pelaksana_map = $this->getPelaksanaMap($kodewilayah);

                    // ==================================================
                    // Ambil Ultimate Outcome (Level 1)
                    // ==================================================
                    $ultimate = $this->db
                        ->select('
                            id, 
                            kinerja as nama,
                            indikator
                        ')
                        ->where('kode_wilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->order_by('id', 'ASC')
                        ->get('pk_ultimate_outcome')
                        ->result_array();

                    // ==================================================
                    // Ambil Intermediate Sektor (Level 2)
                    // ==================================================
                    $sektor = $this->db
                        ->select('
                            s.id, 
                            s.kinerja as nama,
                            s.indikator,
                            s.pelaksana,
                            s.inovasi_daerah as inovasi,
                            s.outcome_inovasi,
                            s.output_inovasi,
                            s.crosscutting,
                            s.ultimate_outcome_id as parent_id
                        ')
                        ->from('pk_intermediate_sektor s')
                        ->where('s.kode_wilayah', $kodewilayah)
                        ->where('s.deleted_at IS NULL')
                        ->order_by('s.id', 'ASC')
                        ->get()
                        ->result_array();

                    // ==================================================
                    // Ambil Intermediate Taktikal (Level 3)
                    // ==================================================
                    $taktikal = $this->db
                        ->select('
                            t.id, 
                            t.kinerja as nama,
                            t.indikator,
                            t.pelaksana,
                            t.inovasi_daerah as inovasi,
                            t.outcome_inovasi,
                            t.output_inovasi,
                            t.crosscutting,
                            t.intermediate_sektor_id as parent_id
                        ')
                        ->from('pk_intermediate_taktikal t')
                        ->where('t.kode_wilayah', $kodewilayah)
                        ->where('t.deleted_at IS NULL')
                        ->order_by('t.id', 'ASC')
                        ->get()
                        ->result_array();

                    // ==================================================
                    // Ambil Immediate Outcome (Level 4)
                    // ==================================================
                    $immediate = $this->db
                        ->select('
                            i.id, 
                            i.kinerja as nama,
                            i.indikator,
                            i.pelaksana,
                            i.inovasi_daerah as inovasi,
                            i.outcome_inovasi,
                            i.output_inovasi,
                            i.crosscutting,
                            i.intermediate_taktikal_id as parent_id
                        ')
                        ->from('pk_immediate_outcome i')
                        ->where('i.kode_wilayah', $kodewilayah)
                        ->where('i.deleted_at IS NULL')
                        ->order_by('i.id', 'ASC')
                        ->get()
                        ->result_array();

                    // ==================================================
                    // Ambil Output (Level 5)
                    // ==================================================
                    $output = $this->db
                        ->select('
                            o.id, 
                            o.kinerja as nama,
                            o.indikator,
                            o.pelaksana,
                            o.inovasi_daerah as inovasi,
                            o.outcome_inovasi,
                            o.output_inovasi,
                            o.crosscutting,
                            o.immediate_outcome_id as parent_id
                        ')
                        ->from('pk_output o')
                        ->where('o.kode_wilayah', $kodewilayah)
                        ->where('o.deleted_at IS NULL')
                        ->order_by('o.id', 'ASC')
                        ->get()
                        ->result_array();

                    // Update total data
                    $data['TotalData'] = [
                        'level1' => count($ultimate),
                        'level2' => count($sektor),
                        'level3' => count($taktikal),
                        'level4' => count($immediate),
                        'level5' => count($output)
                    ];

                    // Konversi ID pelaksana ke nama dan tambahkan detail
                    $sektor = $this->enrichWithPelaksanaDetail($sektor, $pelaksana_map);
                    $taktikal = $this->enrichWithPelaksanaDetail($taktikal, $pelaksana_map);
                    $immediate = $this->enrichWithPelaksanaDetail($immediate, $pelaksana_map);
                    $output = $this->enrichWithPelaksanaDetail($output, $pelaksana_map);

                    // ==============================
                    // 3. STRUKTURKAN DATA UNTUK TREE
                    // ==============================
                    $tree_data = $this->buildTreeData($ultimate, $sektor, $taktikal, $immediate, $output);

                    // ==============================
                    // 4. FORMAT UNTUK VIEW
                    // ==============================
                    $chart_data = [
                        'nama' => 'ROOT',
                        'children' => $tree_data
                    ];

                    $data['ChartData'] = json_encode($chart_data);
                }

                // ==============================
                // 5. LOAD VIEW
                // ==============================
                $header['Halaman'] = 'Visualisasi Pohon Kinerja - 5 Level';
                $this->load->view('Daerah/header', $header);
                $this->load->view('Daerah/TampilPohonKinerja', $data);
            }

            /**
             * Mendapatkan mapping pelaksana ID ke detail lengkap
             */
            private function getPelaksanaMap($kodewilayah)
            {
                $pelaksana = $this->db
                    ->select('
                        akun_karyawan.id,
                        akun_karyawan.nama,
                        akun_karyawan.nip,
                        akun_karyawan.jabatan,
                        akun_karyawan.dinas_id,
                        GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
                    ')
                    ->from('akun_karyawan')
                    ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
                    ->where('akun_karyawan.Level', 4)
                    ->where('akun_karyawan.kodewilayah', $kodewilayah)
                    ->where('akun_karyawan.deleted_at IS NULL')
                    ->group_by('akun_karyawan.id')
                    ->get()
                    ->result_array();

                $map = [];
                foreach ($pelaksana as $p) {
                    $map[$p['id']] = [
                        'nama' => $p['nama'],
                        'nip' => $p['nip'],
                        'jabatan' => $p['jabatan'],
                        'dinas' => $p['nama_dinas'] ?? '-',
                        'display' => $p['nama'] . ($p['jabatan'] ? ' - ' . $p['jabatan'] : '') . ($p['nama_dinas'] ? ' (' . $p['nama_dinas'] . ')' : '')
                    ];
                }
                
                return $map;
            }

            /**
             * Memperkaya data dengan detail pelaksana
             */
            private function enrichWithPelaksanaDetail($items, $pelaksana_map)
            {
                foreach ($items as &$item) {
                    if (!empty($item['pelaksana']) && isset($pelaksana_map[$item['pelaksana']])) {
                        $item['pelaksana_detail'] = $pelaksana_map[$item['pelaksana']];
                        $item['pelaksana_nama'] = $pelaksana_map[$item['pelaksana']]['display'];
                    } else {
                        $item['pelaksana_detail'] = null;
                        $item['pelaksana_nama'] = $item['pelaksana'] ?? '';
                    }
                    
                    // Parse crosscutting JSON
                    if (!empty($item['crosscutting'])) {
                        $item['crosscutting_array'] = json_decode($item['crosscutting'], true);
                    } else {
                        $item['crosscutting_array'] = [];
                    }
                }
                return $items;
            }

            /**
             * Membangun struktur tree data
             */
            private function buildTreeData($ultimate, $sektor, $taktikal, $immediate, $output)
            {
                $tree_data = [];

                // Buat mapping untuk memudahkan pencarian
                $sektor_by_parent = [];
                foreach ($sektor as $sek) {
                    $sektor_by_parent[$sek['parent_id']][] = $sek;
                }

                $taktikal_by_parent = [];
                foreach ($taktikal as $tak) {
                    $taktikal_by_parent[$tak['parent_id']][] = $tak;
                }

                $immediate_by_parent = [];
                foreach ($immediate as $imm) {
                    $immediate_by_parent[$imm['parent_id']][] = $imm;
                }

                $output_by_parent = [];
                foreach ($output as $out) {
                    $output_by_parent[$out['parent_id']][] = $out;
                }

                // Bangun tree dari Level 1 (Ultimate)
                foreach ($ultimate as $ult) {
                    $ult_node = [
                        'id' => 'l1_' . $ult['id'],
                        'original_id' => $ult['id'],
                        'nama' => $ult['nama'],
                        'indikator' => $ult['indikator'] ?? '',
                        'pelaksana' => '',
                        'pelaksana_detail' => null,
                        'inovasi' => '',
                        'outcome_inovasi' => '',
                        'output_inovasi' => '',
                        'crosscutting' => '',
                        'crosscutting_array' => [],
                        'level' => 1,
                        'children' => []
                    ];
                    
                    // Cari Level 2 (Sektor) yang memiliki parent_id = $ult['id']
                    if (isset($sektor_by_parent[$ult['id']])) {
                        foreach ($sektor_by_parent[$ult['id']] as $sek) {
                            $sek_node = [
                                'id' => 'l2_' . $sek['id'],
                                'original_id' => $sek['id'],
                                'nama' => $sek['nama'],
                                'indikator' => $sek['indikator'] ?? '',
                                'pelaksana' => $sek['pelaksana'] ?? '',
                                'pelaksana_detail' => $sek['pelaksana_detail'] ?? null,
                                'inovasi' => $sek['inovasi'] ?? '',
                                'outcome_inovasi' => $sek['outcome_inovasi'] ?? '',
                                'output_inovasi' => $sek['output_inovasi'] ?? '',
                                'crosscutting' => $sek['crosscutting'] ?? '',
                                'crosscutting_array' => $sek['crosscutting_array'] ?? [],
                                'level' => 2,
                                'children' => []
                            ];
                            
                            // Cari Level 3 (Taktikal) yang memiliki parent_id = $sek['id']
                            if (isset($taktikal_by_parent[$sek['id']])) {
                                foreach ($taktikal_by_parent[$sek['id']] as $tak) {
                                    $tak_node = [
                                        'id' => 'l3_' . $tak['id'],
                                        'original_id' => $tak['id'],
                                        'nama' => $tak['nama'],
                                        'indikator' => $tak['indikator'] ?? '',
                                        'pelaksana' => $tak['pelaksana'] ?? '',
                                        'pelaksana_detail' => $tak['pelaksana_detail'] ?? null,
                                        'inovasi' => $tak['inovasi'] ?? '',
                                        'outcome_inovasi' => $tak['outcome_inovasi'] ?? '',
                                        'output_inovasi' => $tak['output_inovasi'] ?? '',
                                        'crosscutting' => $tak['crosscutting'] ?? '',
                                        'crosscutting_array' => $tak['crosscutting_array'] ?? [],
                                        'level' => 3,
                                        'children' => []
                                    ];
                                    
                                    // Cari Level 4 (Immediate) yang memiliki parent_id = $tak['id']
                                    if (isset($immediate_by_parent[$tak['id']])) {
                                        foreach ($immediate_by_parent[$tak['id']] as $imm) {
                                            $imm_node = [
                                                'id' => 'l4_' . $imm['id'],
                                                'original_id' => $imm['id'],
                                                'nama' => $imm['nama'],
                                                'indikator' => $imm['indikator'] ?? '',
                                                'pelaksana' => $imm['pelaksana'] ?? '',
                                                'pelaksana_detail' => $imm['pelaksana_detail'] ?? null,
                                                'inovasi' => $imm['inovasi'] ?? '',
                                                'outcome_inovasi' => $imm['outcome_inovasi'] ?? '',
                                                'output_inovasi' => $imm['output_inovasi'] ?? '',
                                                'crosscutting' => $imm['crosscutting'] ?? '',
                                                'crosscutting_array' => $imm['crosscutting_array'] ?? [],
                                                'level' => 4,
                                                'children' => []
                                            ];
                                            
                                            // Cari Level 5 (Output) yang memiliki parent_id = $imm['id']
                                            if (isset($output_by_parent[$imm['id']])) {
                                                foreach ($output_by_parent[$imm['id']] as $out) {
                                                    $imm_node['children'][] = [
                                                        'id' => 'l5_' . $out['id'],
                                                        'original_id' => $out['id'],
                                                        'nama' => $out['nama'],
                                                        'indikator' => $out['indikator'] ?? '',
                                                        'pelaksana' => $out['pelaksana'] ?? '',
                                                        'pelaksana_detail' => $out['pelaksana_detail'] ?? null,
                                                        'inovasi' => $out['inovasi'] ?? '',
                                                        'outcome_inovasi' => $out['outcome_inovasi'] ?? '',
                                                        'output_inovasi' => $out['output_inovasi'] ?? '',
                                                        'crosscutting' => $out['crosscutting'] ?? '',
                                                        'crosscutting_array' => $out['crosscutting_array'] ?? [],
                                                        'level' => 5,
                                                        'children' => []
                                                    ];
                                                }
                                            }
                                            
                                            $tak_node['children'][] = $imm_node;
                                        }
                                    }
                                    
                                    $sek_node['children'][] = $tak_node;
                                }
                            }
                            
                            $ult_node['children'][] = $sek_node;
                        }
                    }
                    
                    $tree_data[] = $ult_node;
                }

                return $tree_data;
            }

        


        

                /**
             * =====================================================
             * OUTPUT PD (Level 4)
             * =====================================================
             */
            public function Output_pd()
            {
                $header['Halaman'] = 'Output Perangkat Daerah';

                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';

                $data['KodeWilayah'] = $kodewilayah;
                $data['Provinsi'] = $this->GetListProvinsiData();

                $data['items'] = [];
                $data['immediate_options'] = [];

                if ($kodewilayah) {
                    // Ambil data output dengan join ke immediate outcome
                    $this->db->select('o.*, imm.kinerja as immediate_kinerja');
                    $this->db->from('output_pd o');
                    $this->db->join('immediate_outcome_pd imm', 'imm.id = o.immediate_outcome_id', 'left');
                    $this->db->where('o.kode_wilayah', $kodewilayah);
                    $this->db->where('o.deleted_at IS NULL');
                    $this->db->order_by('o.urutan', 'ASC');
                    $this->db->order_by('o.id', 'ASC');
                    $data['items'] = $this->db->get()->result_array();

                    // Ambil options untuk immediate outcome (level 3)
                    $data['immediate_options'] = $this->db
                        ->select('id, kinerja')
                        ->from('immediate_outcome_pd')
                        ->where('kode_wilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->order_by('id', 'ASC')
                        ->get()
                        ->result_array();
                }

                // Ambil Nama Wilayah
                if ($kodewilayah) {
                    $wil = $this->db
                        ->where('Kode', $kodewilayah)
                        ->get('kodewilayah')
                        ->row_array();

                    $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
                } else {
                    $data['NamaWilayah'] = '';
                }

                $this->load->view('Daerah/header', $header);
                $this->load->view('Daerah/Output_pd', $data);
            }

            /**
             * =====================================================
             * GET DAFTAR DINAS UNTUK OUTPUT PD
             * =====================================================
             */
            public function Output_pd_get_daftar_dinas()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil data dinas dari akun_instansi dengan Level 2
                $dinas = $this->db
                    ->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($dinas);
                exit;
            }

            /**
             * =====================================================
             * GET PELAKSANA BY DINAS UNTUK OUTPUT PD
             * =====================================================
             */
            public function Output_pd_get_pelaksana_by_dinas()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                $dinas_id = $this->input->post('dinas_id', TRUE);
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                $this->db->select('
                    akun_karyawan.id,
                    akun_karyawan.nama,
                    akun_karyawan.nip,
                    akun_karyawan.jabatan,
                    akun_karyawan.dinas_id,
                    GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
                ')
                ->from('akun_karyawan')
                ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
                ->where('akun_karyawan.Level', 4)
                ->where('akun_karyawan.kodewilayah', $kodewilayah)
                ->where('akun_karyawan.deleted_at IS NULL');
                
                // Filter berdasarkan dinas jika dipilih
                if (!empty($dinas_id) && $dinas_id != '') {
                    $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
                }
                
                $pelaksana = $this->db
                    ->group_by('akun_karyawan.id')
                    ->order_by('akun_karyawan.nama', 'ASC')
                    ->get()
                    ->result_array();

                echo json_encode($pelaksana);
                exit;
            }

            /**
             * =====================================================
             * GET DETAIL PELAKSANA UNTUK OUTPUT PD (untuk edit)
             * =====================================================
             */
            public function Output_pd_get_pelaksana_detail()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$id || !$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                $detail = $this->db
                    ->select('id, nama, nip, jabatan, dinas_id')
                    ->from('akun_karyawan')
                    ->where('id', $id)
                    ->where('kodewilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get()
                    ->row_array();

                echo json_encode($detail);
                exit;
            }

            /**
             * =====================================================
             * GET PELAKSANA LEVEL 4 (SEMUA) - untuk fallback
             * =====================================================
             */
            public function Output_pd_get_pelaksana_level4()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah') ?? '';
                
                if (!$kodewilayah) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil data pelaksana dari tabel akun_karyawan dengan Level 4
                $pelaksana = $this->db
                    ->select('
                        akun_karyawan.id,
                        akun_karyawan.nama,
                        akun_karyawan.nip,
                        akun_karyawan.jabatan,
                        akun_karyawan.dinas_id,
                        GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
                    ')
                    ->from('akun_karyawan')
                    ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
                    ->where('akun_karyawan.Level', 4)
                    ->where('akun_karyawan.kodewilayah', $kodewilayah)
                    ->where('akun_karyawan.deleted_at IS NULL')
                    ->group_by('akun_karyawan.id')
                    ->order_by('akun_karyawan.nama', 'ASC')
                    ->get()
                    ->result_array();
                
                echo json_encode($pelaksana);
                exit;
            }

            /**
             * =====================================================
             * GET PERANGKAT DAERAH
             * =====================================================
             */
            public function Output_pd_get_perangkat_daerah()
            {
                if (!$this->input->is_ajax_request()) show_404();
                
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (!$kodewilayah) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih', 'data' => []]);
                    return;
                }
                
                // Ambil data perangkat daerah dari akun_instansi dengan Level 2
                $this->db->select('id, nama');
                $this->db->where('kodewilayah', $kodewilayah);
                $this->db->order_by('nama', 'ASC');
                $query = $this->db->get('akun_instansi');
                
                $data = $query->result_array();
                
                echo json_encode([
                    'status' => 'success',
                    'data' => $data
                ]);
            }

            /**
             * =====================================================
             * SIMPAN OUTPUT PD
             * =====================================================
             */
            public function Output_pd_simpan()
            {
                if (!$this->input->is_ajax_request()) show_404();

                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$kodewilayah) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih'
                    ]);
                    return;
                }

                $id                  = $this->input->post('id', TRUE);
                $immediate_id        = $this->input->post('immediate_id', TRUE);
                $kinerja             = trim($this->input->post('kinerja', TRUE));
                $ind_list            = $this->input->post('indikator') ?: [];
                $pelaksana_id        = $this->input->post('pelaksana', TRUE);
                $inovasi             = $this->input->post('inovasi_daerah', TRUE);
                $outcome_inovasi     = $this->input->post('outcome_inovasi', TRUE);
                $output_inovasi      = $this->input->post('output_inovasi', TRUE);
                $crosscutting_pd     = $this->input->post('crosscutting_pd');
                $crosscutting_ket    = $this->input->post('crosscutting_ket');

                if (empty($kinerja)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Kinerja wajib diisi'
                    ]);
                    return;
                }

                // Validasi pelaksana exists di tabel akun_karyawan berdasarkan ID
                if ($pelaksana_id) {
                    $exists = $this->db
                        ->where('id', $pelaksana_id)
                        ->where('kodewilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->count_all_results('akun_karyawan');
                        
                    if (!$exists) {
                        echo json_encode([
                            'status'=>'error',
                            'message'=>'Pelaksana tidak valid atau tidak ditemukan'
                        ]);
                        return;
                    }
                }

                $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

                // Handle crosscutting
                $crosscutting_pd_json = null;
                $crosscutting_ket_json = null;
                
                if (!empty($crosscutting_pd) && is_array($crosscutting_pd)) {
                    $crosscutting_pd_json = json_encode($crosscutting_pd);
                }
                if (!empty($crosscutting_ket) && is_array($crosscutting_ket)) {
                    $crosscutting_ket_json = json_encode($crosscutting_ket);
                }

                $save = [
                    'kode_wilayah'          => $kodewilayah,
                    'immediate_outcome_id'  => $immediate_id ?: NULL,
                    'kinerja'               => $kinerja,
                    'indikator'             => $indikator,
                    'pelaksana'             => $pelaksana_id ?: NULL,
                    'inovasi_daerah'        => $inovasi ?: NULL,
                    'outcome_inovasi'       => $outcome_inovasi ?: NULL,
                    'output_inovasi'        => $output_inovasi ?: NULL,
                    'crosscutting_pd'       => $crosscutting_pd_json,
                    'crosscutting_keterangan' => $crosscutting_ket_json,
                    'updated_at'            => date('Y-m-d H:i:s')
                ];

                if ($id) {
                    // Update data
                    $this->db->where('id', $id)
                            ->where('kode_wilayah', $kodewilayah)
                            ->update('output_pd', $save);
                    $msg = 'Data berhasil diperbarui';
                } else {
                    // Insert data baru - dapatkan urutan terakhir
                    $last_urutan = $this->db
                        ->select_max('urutan')
                        ->where('kode_wilayah', $kodewilayah)
                        ->where('deleted_at IS NULL')
                        ->get('output_pd')
                        ->row()
                        ->urutan;
                    
                    $save['urutan'] = ($last_urutan ? $last_urutan + 1 : 1);
                    $save['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('output_pd', $save);
                    $msg = 'Data berhasil ditambahkan';
                }

                echo json_encode([
                    'status' => 'success',
                    'message' => $msg
                ]);
                exit;
            }

            /**
             * =====================================================
             * HAPUS OUTPUT PD
             * =====================================================
             */
            public function Output_pd_hapus()
            {
                if (!$this->input->is_ajax_request()) show_404();

                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$id || !$kodewilayah) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Parameter tidak lengkap'
                    ]);
                    exit;
                }

                // Cek dulu apakah data ada
                $exists = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get('output_pd')
                    ->row();

                if (!$exists) {
                    echo json_encode([
                        'status'  => 'error',
                        'message' => 'Data tidak ditemukan'
                    ]);
                    exit;
                }

                // Soft delete
                $this->db->where('id', $id)
                        ->where('kode_wilayah', $kodewilayah)
                        ->update('output_pd', ['deleted_at' => date('Y-m-d H:i:s')]);

                $status = $this->db->affected_rows() > 0 ? 'success' : 'error';

                echo json_encode([
                    'status' => $status,
                    'message' => $status == 'success' ? 'Data berhasil dihapus' : 'Data tidak ditemukan'
                ]);
                exit;
            }

            /**
             * =====================================================
             * GET SINGLE DATA OUTPUT PD
             * =====================================================
             */
            public function Output_pd_get()
            {
                if (!$this->input->is_ajax_request()) show_404();

                $id = $this->input->post('id', TRUE);
                $kodewilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');

                if (!$id || !$kodewilayah) {
                    echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
                    return;
                }

                $data = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->get('output_pd')
                    ->row_array();

                if ($data) {
                    // Decode JSON crosscutting
                    if (!empty($data['crosscutting_pd'])) {
                        $data['crosscutting_pd'] = json_decode($data['crosscutting_pd'], true);
                    }
                    if (!empty($data['crosscutting_keterangan'])) {
                        $data['crosscutting_keterangan'] = json_decode($data['crosscutting_keterangan'], true);
                    }
                    
                    echo json_encode([
                        'status' => 'success',
                        'data' => $data
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan'
                    ]);
                }
                exit;
            }

                /**
                 * =====================================================
                 * FUNGSI BANTUAN
                 * =====================================================
                 */
                private function GetListProvinsiData()
                {
                    return $this->db->where("Kode LIKE '__'")
                                    ->order_by('Nama')
                                    ->get('kodewilayah')
                                    ->result_array();
                }

                private function _getKodeWilayah() {
                return $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') 
                    ?? '';
            }

            // ============================================================
            // TEMA PEMBANGUNAN - MAIN PAGE
            // ============================================================
            
            public function TemaPembangunan() {
                $Header['Halaman'] = 'Tema Pembangunan';
                
                // Ambil daftar provinsi untuk filter
                $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

                // Tentukan KodeWilayah
                $KodeWilayah = $this->_getKodeWilayah();

                if ($KodeWilayah) {
                    $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                    if ($wilayah) {
                        $Data['KodeWilayah'] = $KodeWilayah;
                        $Data['NamaWilayah'] = $wilayah['Nama'];
                        
                        // Ambil data Tema dengan prioritasnya
                        $temas = $this->db
                            ->where('kode_wilayah', $KodeWilayah)
                            ->where('deleted_at IS NULL')
                            ->order_by('tahun', 'DESC')
                            ->order_by('id', 'ASC')
                            ->get('tema_pembangunan')
                            ->result_array();
                        
                        // Ambil prioritas untuk setiap tema
                        foreach ($temas as &$tema) {
                            // Prioritas Nasional
                            $tema['prioritas_nasional'] = $this->db
                                ->where('tema_id', $tema['id'])
                                ->where('kode_wilayah', $KodeWilayah)
                                ->where('jenis', 'nasional')
                                ->where('deleted_at IS NULL')
                                ->order_by('id', 'ASC')
                                ->get('prioritas_pembangunan')
                                ->result_array();
                            
                            // Prioritas Provinsi
                            $tema['prioritas_provinsi'] = $this->db
                                ->where('tema_id', $tema['id'])
                                ->where('kode_wilayah', $KodeWilayah)
                                ->where('jenis', 'provinsi')
                                ->where('deleted_at IS NULL')
                                ->order_by('id', 'ASC')
                                ->get('prioritas_pembangunan')
                                ->result_array();
                            
                            // Prioritas Daerah
                            $tema['prioritas_daerah'] = $this->db
                                ->where('tema_id', $tema['id'])
                                ->where('kode_wilayah', $KodeWilayah)
                                ->where('jenis', 'daerah')
                                ->where('deleted_at IS NULL')
                                ->order_by('id', 'ASC')
                                ->get('prioritas_pembangunan')
                                ->result_array();
                        }
                        
                        $Data['TemaPembangunan'] = $temas;
                    } else {
                        $Data['KodeWilayah'] = '';
                        $Data['NamaWilayah'] = '';
                        $Data['TemaPembangunan'] = [];
                    }
                } else {
                    $Data['KodeWilayah'] = '';
                    $Data['NamaWilayah'] = '';
                    $Data['TemaPembangunan'] = [];
                }

                // Data untuk dropdown Tema RKP (dari tabel temarkp)
                $Data['TahunTemaRKP'] = $this->db
                    ->distinct()
                    ->select('Tahun')
                    ->where('deleted_at IS NULL')
                    ->order_by('Tahun', 'DESC')
                    ->get('temarkp')
                    ->result_array();
                
                // Data prioritas nasional RPJMN untuk dropdown
                $Data['PrioritasNasionalRPJMN'] = $this->db
                    ->select('Id, PrioritasNasional')
                    ->where('deleted_at IS NULL')
                    ->order_by('PrioritasNasional', 'ASC')
                    ->get('prioritas_nasional_rpjmn')
                    ->result_array();

                $this->load->view('Daerah/header', $Header);
                $this->load->view('Daerah/TemaPembangunan', $Data);
            }

            // ============================================================
            // INPUT TEMA PEMBANGUNAN
            // ============================================================
            
            public function InputTemaPembangunan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->_checkSessionWilayah();
                if (!$kodeWilayah) {
                    return;
                }
                
                $tahun = trim($this->input->post('Tahun', TRUE));
                $temaRKPId = $this->input->post('TemaRKPId', TRUE);
                $temaNasionalText = trim($this->input->post('TemaNasionalText', TRUE));
                $temaProvinsi = trim($this->input->post('TemaProvinsi', TRUE));
                $temaDaerah = trim($this->input->post('TemaDaerah', TRUE));
                
                if (empty($tahun) || !is_numeric($tahun) || strlen($tahun) != 4) {
                    echo json_encode(['status' => 'error', 'message' => 'Tahun tidak valid!']);
                    return;
                }
                
                if (!empty($temaRKPId)) {
                    $temaRKP = $this->db
                        ->select('TemaRKP')
                        ->where('Id', $temaRKPId)
                        ->where('deleted_at IS NULL')
                        ->get('temarkp')
                        ->row_array();
                    
                    if ($temaRKP) {
                        $temaNasionalText = $temaRKP['TemaRKP'];
                    }
                }
                
                if (empty($temaNasionalText)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Tema Nasional harus diisi!'
                    ]);
                    return;
                }
                
                // Cek duplikat
                $exists = $this->db
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('tahun', $tahun)
                    ->where('deleted_at IS NULL')
                    ->get('tema_pembangunan')
                    ->num_rows();
                
                if ($exists > 0) {
                    echo json_encode([
                        'status' => 'warning',
                        'message' => 'Tema untuk tahun ' . $tahun . ' sudah ada!'
                    ]);
                    return;
                }
                
                // === PERBAIKAN: Simpan tema_rkp_id ===
                $data = [
                    'kode_wilayah' => $kodeWilayah,
                    'tahun' => $tahun,
                    'tema_nasional' => $temaNasionalText,
                    'tema_rkp_id' => !empty($temaRKPId) ? $temaRKPId : null, // <-- SIMPAN ID
                    'tema_provinsi' => $temaProvinsi,
                    'tema_daerah' => $temaDaerah,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('tema_pembangunan', $data);
                $temaId = $this->db->insert_id();
                
                if ($temaId > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Tema berhasil disimpan!',
                        'tema_id' => $temaId
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan tema!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'InputTemaPembangunan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

            // ============================================================
            // UPDATE TEMA PEMBANGUNAN
            // ============================================================
            
            public function UpdateTemaPembangunan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->_checkSessionWilayah();
                if (!$kodeWilayah) {
                    return;
                }
                
                $id = (int)$this->input->post('Id', TRUE);
                $tahun = trim($this->input->post('Tahun', TRUE));
                $temaRKPId = $this->input->post('TemaRKPId', TRUE); // Ambil dari dropdown
                $temaNasionalText = trim($this->input->post('TemaNasionalText', TRUE));
                $temaProvinsi = trim($this->input->post('TemaProvinsi', TRUE));
                $temaDaerah = trim($this->input->post('TemaDaerah', TRUE));
                
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                if (empty($tahun) || !is_numeric($tahun) || strlen($tahun) != 4) {
                    echo json_encode(['status' => 'error', 'message' => 'Tahun tidak valid!']);
                    return;
                }
                
                // Jika TemaRKPId ada, ambil teksnya untuk disimpan
                if (!empty($temaRKPId)) {
                    $temaRKP = $this->db
                        ->select('TemaRKP')
                        ->where('Id', $temaRKPId)
                        ->where('deleted_at IS NULL')
                        ->get('temarkp')
                        ->row_array();
                    
                    if ($temaRKP) {
                        $temaNasionalText = $temaRKP['TemaRKP'];
                    }
                }
                
                if (empty($temaNasionalText)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Tema Nasional harus diisi!'
                    ]);
                    return;
                }
                
                // Cek apakah data ada
                $exists = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('tema_pembangunan')
                    ->num_rows();
                
                if ($exists == 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan!'
                    ]);
                    return;
                }
                
                // === PERBAIKAN: Simpan tema_rkp_id ===
                $data = [
                    'tahun' => $tahun,
                    'tema_nasional' => $temaNasionalText,
                    'tema_rkp_id' => !empty($temaRKPId) ? $temaRKPId : null, // <-- SIMPAN ID
                    'tema_provinsi' => $temaProvinsi,
                    'tema_daerah' => $temaDaerah,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->update('tema_pembangunan', $data);
                
                $affected = $this->db->affected_rows();
                echo json_encode([
                    'status' => 'success',
                    'message' => $affected > 0 ? 'Tema berhasil diupdate!' : 'Tidak ada perubahan data'
                ]);
                
            } catch (Exception $e) {
                log_message('error', 'UpdateTemaPembangunan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

            // ============================================================
            // DELETE TEMA PEMBANGUNAN (SOFT DELETE)
            // ============================================================
            
            public function DeleteTemaPembangunan() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                try {
                    $kodeWilayah = $this->_checkSessionWilayah();
                    if (!$kodeWilayah) {
                        return;
                    }
                    
                    $id = (int)$this->input->post('Id', TRUE);
                    
                    if ($id <= 0) {
                        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                        return;
                    }
                    
                    // Cek apakah data ada
                    $exists = $this->db
                        ->where('id', $id)
                        ->where('kode_wilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('tema_pembangunan')
                        ->num_rows();
                    
                    if ($exists == 0) {
                        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                        return;
                    }
                    
                    // Mulai transaksi
                    $this->db->trans_start();
                    
                    // Soft delete tema
                    $this->db->where('id', $id);
                    $this->db->where('kode_wilayah', $kodeWilayah);
                    $this->db->update('tema_pembangunan', [
                        'deleted_at' => date('Y-m-d H:i:s')
                    ]);
                    
                    // Soft delete semua prioritas terkait
                    $this->db->where('tema_id', $id);
                    $this->db->where('kode_wilayah', $kodeWilayah);
                    $this->db->update('prioritas_pembangunan', [
                        'deleted_at' => date('Y-m-d H:i:s')
                    ]);
                    
                    $this->db->trans_complete();
                    
                    if ($this->db->trans_status() === FALSE) {
                        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
                    } else {
                        echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
                    }
                    
                } catch (Exception $e) {
                    $this->db->trans_rollback();
                    log_message('error', 'DeleteTemaPembangunan: ' . $e->getMessage());
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                    ]);
                }
            }

            // ============================================================
            // INPUT PRIORITAS PEMBANGUNAN
            // ============================================================
            
            public function InputPrioritasPembangunan() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                try {
                    $kodeWilayah = $this->_checkSessionWilayah();
                    if (!$kodeWilayah) {
                        return;
                    }
                    
                    $temaId = (int)$this->input->post('TemaId', TRUE);
                    $jenis = $this->input->post('Jenis', TRUE);
                    $prioritas = trim($this->input->post('Prioritas', TRUE));
                    
                    if ($temaId <= 0) {
                        echo json_encode(['status' => 'error', 'message' => 'Tema tidak valid!']);
                        return;
                    }
                    
                    if (!in_array($jenis, ['nasional', 'provinsi', 'daerah'])) {
                        echo json_encode(['status' => 'error', 'message' => 'Jenis prioritas tidak valid!']);
                        return;
                    }
                    
                    if (empty($prioritas)) {
                        echo json_encode(['status' => 'error', 'message' => 'Prioritas harus diisi!']);
                        return;
                    }
                    
                    // Cek apakah tema ada
                    $temaExists = $this->db
                        ->where('id', $temaId)
                        ->where('kode_wilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('tema_pembangunan')
                        ->num_rows();
                    
                    if ($temaExists == 0) {
                        echo json_encode(['status' => 'error', 'message' => 'Tema tidak ditemukan!']);
                        return;
                    }
                    
                    $data = [
                        'tema_id' => $temaId,
                        'kode_wilayah' => $kodeWilayah,
                        'jenis' => $jenis,
                        'prioritas' => $prioritas,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                    $this->db->insert('prioritas_pembangunan', $data);
                    
                    if ($this->db->affected_rows() > 0) {
                        echo json_encode(['status' => 'success', 'message' => 'Prioritas berhasil ditambahkan!']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan prioritas!']);
                    }
                    
                } catch (Exception $e) {
                    log_message('error', 'InputPrioritasPembangunan: ' . $e->getMessage());
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                    ]);
                }
            }

            // ============================================================
            // UPDATE PRIORITAS PEMBANGUNAN
            // ============================================================
            
            public function UpdatePrioritasPembangunan() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                try {
                    $kodeWilayah = $this->_checkSessionWilayah();
                    if (!$kodeWilayah) {
                        return;
                    }
                    
                    $id = (int)$this->input->post('Id', TRUE);
                    $prioritas = trim($this->input->post('Prioritas', TRUE));
                    
                    if ($id <= 0) {
                        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                        return;
                    }
                    
                    if (empty($prioritas)) {
                        echo json_encode(['status' => 'error', 'message' => 'Prioritas harus diisi!']);
                        return;
                    }
                    
                    // Cek apakah data ada
                    $exists = $this->db
                        ->where('id', $id)
                        ->where('kode_wilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('prioritas_pembangunan')
                        ->num_rows();
                    
                    if ($exists == 0) {
                        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                        return;
                    }
                    
                    $data = [
                        'prioritas' => $prioritas,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    
                    $this->db->where('id', $id);
                    $this->db->where('kode_wilayah', $kodeWilayah);
                    $this->db->update('prioritas_pembangunan', $data);
                    
                    $affected = $this->db->affected_rows();
                    echo json_encode([
                        'status' => 'success',
                        'message' => $affected > 0 ? 'Prioritas berhasil diupdate!' : 'Tidak ada perubahan data'
                    ]);
                    
                } catch (Exception $e) {
                    log_message('error', 'UpdatePrioritasPembangunan: ' . $e->getMessage());
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                    ]);
                }
            }

            // ============================================================
            // DELETE PRIORITAS PEMBANGUNAN (SOFT DELETE)
            // ============================================================
            
            public function DeletePrioritasPembangunan() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                try {
                    $kodeWilayah = $this->_checkSessionWilayah();
                    if (!$kodeWilayah) {
                        return;
                    }
                    
                    $id = (int)$this->input->post('Id', TRUE);
                    
                    if ($id <= 0) {
                        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                        return;
                    }
                    
                    // Cek apakah data ada
                    $exists = $this->db
                        ->where('id', $id)
                        ->where('kode_wilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('prioritas_pembangunan')
                        ->num_rows();
                    
                    if ($exists == 0) {
                        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                        return;
                    }
                    
                    $this->db->where('id', $id);
                    $this->db->where('kode_wilayah', $kodeWilayah);
                    $this->db->update('prioritas_pembangunan', [
                        'deleted_at' => date('Y-m-d H:i:s')
                    ]);
                    
                    if ($this->db->affected_rows() > 0) {
                        echo json_encode(['status' => 'success', 'message' => 'Prioritas berhasil dihapus!']);
                    } else {
                        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus prioritas!']);
                    }
                    
                } catch (Exception $e) {
                    log_message('error', 'DeletePrioritasPembangunan: ' . $e->getMessage());
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                    ]);
                }
            }

        /**
         * GET TEMA RKP BY ID
         * Untuk mengisi data di modal edit
         */
        public function GetTemaRKPById() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('Id, TemaRKP, Tahun')
                ->where('Id', $id)
                ->where('deleted_at IS NULL')
                ->get('temarkp')
                ->row_array();
            
            echo json_encode($data);
        }

        /**
         * GET PRIORITAS BY TEMA AND JENIS
         */
        public function GetPrioritasByTemaJenis() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $temaId = (int)$this->input->post('tema_id', TRUE);
            $jenis = $this->input->post('jenis', TRUE);
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if ($temaId <= 0 || empty($kodeWilayah) || !in_array($jenis, ['nasional', 'provinsi', 'daerah'])) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->where('tema_id', $temaId)
                ->where('kode_wilayah', $kodeWilayah)
                ->where('jenis', $jenis)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('prioritas_pembangunan')
                ->result_array();
            
            echo json_encode($data);
        }

        /**
         * GET TEMA RKP BERDASARKAN TAHUN
         * Untuk dropdown di form Tema Pembangunan
         */
        public function GetTemaRKPByTahun() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $tahun = (int)$this->input->post('tahun', TRUE);
            
            if ($tahun <= 0) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('Id, TemaRKP')
                ->where('Tahun', $tahun)
                ->where('deleted_at IS NULL')
                ->order_by('TemaRKP', 'ASC')
                ->get('temarkp')
                ->result_array();
            
            echo json_encode($data);
        }

        /**
         * GET PRIORITAS NASIONAL RPJMN
         * Untuk dropdown di form Tema Pembangunan
         */
        public function GetPrioritasNasionalRPJMN() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $data = $this->db
                ->select('Id, PrioritasNasional')
                ->where('deleted_at IS NULL')
                ->order_by('PrioritasNasional', 'ASC')
                ->get('prioritas_nasional_rpjmn')
                ->result_array();
            
            echo json_encode($data);
        }

        // ============================================================
        // PAGU URUSAN - CRUD
        // ============================================================

        /**
         * Halaman Pagu Urusan
         */
        public function PaguUrusan() {
            $Header['Halaman'] = 'Pagu Urusan';
            
            // Ambil KodeWilayah
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            // Data untuk filter provinsi
            $Data['Provinsi'] = $this->db
                ->where("Kode LIKE '__'")
                ->order_by('Nama')
                ->get('kodewilayah')
                ->result_array();
            
            $Data['KodeWilayah'] = $kodeWilayah;
            $Data['NamaWilayah'] = '';
            
            if (!empty($kodeWilayah)) {
                $wilayah = $this->db->where('Kode', $kodeWilayah)->get('kodewilayah')->row_array();
                if ($wilayah) {
                    $Data['NamaWilayah'] = $wilayah['Nama'];
                }
                
                // Ambil data Pagu Urusan
                $Data['PaguUrusan'] = $this->db
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('id', 'ASC')
                    ->get('pagu_urusan')
                    ->result_array();
            } else {
                $Data['PaguUrusan'] = [];
            }
            
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/PaguUrusan', $Data);
        }

        /**
         * INPUT PAGU URUSAN
         */
        public function InputPaguUrusan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                // Ambil data dari POST
                $kodeUrusan = trim($this->input->post('kode_urusan', TRUE));
                $urusan = trim($this->input->post('urusan', TRUE));
                $pagu = trim($this->input->post('pagu', TRUE));
                
                // ✅ URUSAN WAJIB
                if (empty($urusan)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Urusan harus diisi!'
                    ]);
                    return;
                }
                
                // ✅ KODE URUSAN TIDAK WAJIB - Bisa kosong
                // Jika kode_urusan kosong, set NULL
                $kodeUrusanValue = !empty($kodeUrusan) ? $kodeUrusan : null;
                
                // ✅ PAGU TIDAK WAJIB
                $paguClean = null;
                if (!empty($pagu)) {
                    $paguClean = str_replace(['.', ','], '', $pagu);
                    if (!is_numeric($paguClean)) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Pagu Anggaran harus berupa angka!'
                        ]);
                        return;
                    }
                }
                
                $data = [
                    'kode_wilayah' => $kodeWilayah,
                    'kode_urusan' => $kodeUrusanValue,
                    'urusan' => $urusan,
                    'pagu' => $paguClean,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('pagu_urusan', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'InputPaguUrusan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * EDIT PAGU URUSAN
         */
        public function EditPaguUrusan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                $kodeUrusan = trim($this->input->post('kode_urusan', TRUE));
                $urusan = trim($this->input->post('urusan', TRUE));
                $pagu = trim($this->input->post('pagu', TRUE));
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                // ✅ URUSAN WAJIB
                if (empty($urusan)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Urusan harus diisi!'
                    ]);
                    return;
                }
                
                // ✅ KODE URUSAN TIDAK WAJIB
                $kodeUrusanValue = !empty($kodeUrusan) ? $kodeUrusan : null;
                
                $paguClean = null;
                if (!empty($pagu)) {
                    $paguClean = str_replace(['.', ','], '', $pagu);
                    if (!is_numeric($paguClean)) {
                        echo json_encode([
                            'status' => 'error',
                            'message' => 'Pagu Anggaran harus berupa angka!'
                        ]);
                        return;
                    }
                }
                
                $data = [
                    'kode_urusan' => $kodeUrusanValue,
                    'urusan' => $urusan,
                    'pagu' => $paguClean,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->update('pagu_urusan', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil diupdate!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Tidak ada perubahan data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'EditPaguUrusan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * HAPUS PAGU URUSAN (Soft Delete)
         */
        public function HapusPaguUrusan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->update('pagu_urusan', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil dihapus!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menghapus data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'HapusPaguUrusan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        // ============================================================
        // NOMENKLATUR UNTUK PAGU URUSAN - MENGGUNAKAN nomenklaturkabupaten
        // ============================================================

        /**
         * GET URUSAN (LEVEL 1) - DARI nomenklaturkabupaten
         * Level 1 = Urusan (0 titik, panjang 1)
         */
        public function getUrusanPagu() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['error' => 'Wilayah belum dipilih']);
                    return;
                }
                
                // Ambil dari nomenklaturkabupaten - Level 1 = Urusan
                $data = $this->db
                    ->select('Kode, Nomenklatur')
                    ->from('nomenklaturkabupaten')
                    ->where('Kode NOT LIKE', '%.%')  // 0 titik
                    ->where('LENGTH(Kode) = 1')      // Panjang 1 digit
                    ->order_by('Kode', 'ASC')
                    ->get()
                    ->result_array();
                
                log_message('debug', 'getUrusanPagu - Data: ' . print_r($data, true));
                
                echo json_encode($data);
                
            } catch (Exception $e) {
                log_message('error', 'getUrusanPagu Error: ' . $e->getMessage());
                echo json_encode(['error' => $e->getMessage()]);
            }
        }

        /**
         * GET BIDANG URUSAN (LEVEL 2) - DARI nomenklaturkabupaten
         * Level 2 = Bidang Urusan (1 titik)
         */
        public function getBidangUrusanPagu() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeUrusan = $this->input->post('kode_urusan', TRUE);
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah) || empty($kodeUrusan)) {
                    echo json_encode([]);
                    return;
                }
                
                // Ambil dari nomenklaturkabupaten - Level 2 = Bidang Urusan (1 titik)
                $data = $this->db
                    ->select('Kode, Nomenklatur')
                    ->from('nomenklaturkabupaten')
                    ->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1)  // 1 titik
                    ->where('Kode LIKE', $kodeUrusan . '.%')
                    ->order_by('Kode', 'ASC')
                    ->get()
                    ->result_array();
                
                log_message('debug', 'getBidangUrusanPagu - kodeUrusan: ' . $kodeUrusan . ', Data: ' . print_r($data, true));
                
                echo json_encode($data);
                
            } catch (Exception $e) {
                log_message('error', 'getBidangUrusanPagu Error: ' . $e->getMessage());
                echo json_encode([]);
            }
        }

        /**
         * GET NOMENKLATUR BY KODE (UNTUK EDIT PAGU URUSAN)
         */
        public function getNomenklaturPaguByKode() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kode = $this->input->post('kode', TRUE);
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah) || empty($kode)) {
                    echo json_encode(['error' => 'Data tidak valid']);
                    return;
                }
                
                $result = [];
                $parts = explode('.', $kode);
                $dotCount = count($parts) - 1;
                
                if ($dotCount === 0) {
                    // Level 1: Urusan
                    $urusan = $this->db
                        ->select('Kode, Nomenklatur')
                        ->from('nomenklaturkabupaten')
                        ->where('Kode', $kode)
                        ->where('Kode NOT LIKE', '%.%')
                        ->get()
                        ->row_array();
                    
                    if ($urusan) {
                        $result['level'] = 1;
                        $result['kode'] = $urusan['Kode'];
                        $result['nomenklatur'] = $urusan['Nomenklatur'];
                    }
                } else if ($dotCount === 1) {
                    // Level 2: Bidang Urusan
                    $bidang = $this->db
                        ->select('Kode, Nomenklatur')
                        ->from('nomenklaturkabupaten')
                        ->where('Kode', $kode)
                        ->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1)
                        ->get()
                        ->row_array();
                    
                    if ($bidang) {
                        $result['level'] = 2;
                        $result['kode'] = $bidang['Kode'];
                        $result['nomenklatur'] = $bidang['Nomenklatur'];
                        
                        // Ambil urusan parent (level 1)
                        $urusan = $this->db
                            ->select('Kode, Nomenklatur')
                            ->from('nomenklaturkabupaten')
                            ->where('Kode', $parts[0])
                            ->where('Kode NOT LIKE', '%.%')
                            ->get()
                            ->row_array();
                        
                        if ($urusan) {
                            $result['urusan'] = $urusan;
                        }
                    }
                }
                
                echo json_encode($result);
                
            } catch (Exception $e) {
                log_message('error', 'getNomenklaturPaguByKode Error: ' . $e->getMessage());
                echo json_encode(['error' => $e->getMessage()]);
            }
        }

        // ================================================================
        // IKD TAHUN BERJALAN - MENGGUNAKAN TABEL IKD
        // ================================================================

        /**
         * Halaman IKD Tahun Berjalan
         */
        public function IKDTahunBerjalan() {
            $Header['Halaman'] = 'IKD Tahun Berjalan';
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            $Data['Provinsi'] = $this->db
                ->where("Kode LIKE '__'")
                ->order_by('Nama')
                ->get('kodewilayah')
                ->result_array();
            
            $Data['KodeWilayah'] = $kodeWilayah;
            $Data['NamaWilayah'] = '';
            
            if (!empty($kodeWilayah)) {
                $wilayah = $this->db->where('Kode', $kodeWilayah)->get('kodewilayah')->row_array();
                if ($wilayah) {
                    $Data['NamaWilayah'] = $wilayah['Nama'];
                }
                
                // ================================================================
                // PERBAIKAN: Ganti 'kode_wilayah' menjadi 'kodewilayah'
                // AMBIL DAFTAR PERIODE UNIK DARI TABEL IKD
                // ================================================================
                $Data['PeriodeList'] = $this->db
                    ->distinct()
                    ->select('tahun_mulai, tahun_akhir, CONCAT(tahun_mulai, " - ", tahun_akhir) as periode')
                    ->where('kodewilayah', $kodeWilayah)  // PERBAIKAN: kodewilayah
                    ->where('deleted_at IS NULL')
                    ->order_by('tahun_mulai', 'DESC')
                    ->get('ikd')
                    ->result_array();
                
                // ================================================================
                // AMBIL SEMUA DATA IKD TAHUN BERJALAN (TABEL TERPISAH)
                // ================================================================
                $Data['IKDData'] = $this->db
                    ->select('id, indikator_kinerja_daerah, target, tahun, ikd_id')
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('tahun', 'DESC')
                    ->order_by('id', 'ASC')
                    ->get('ikd_tahun_berjalan')
                    ->result_array();
            } else {
                $Data['PeriodeList'] = [];
                $Data['IKDData'] = [];
            }
            
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/IKDTahunBerjalan', $Data);
        }

        /**
         * GET IKD BY PERIODE (AJAX) - UNTUK FILTER
         */
        public function GetIKDByPeriode() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                $tahunMulai = $this->input->post('tahun_mulai', TRUE);
                $tahunAkhir = $this->input->post('tahun_akhir', TRUE);
                
                if (empty($tahunMulai) || empty($tahunAkhir)) {
                    echo json_encode(['status' => 'error', 'message' => 'Periode tidak valid!']);
                    return;
                }
                
                // ================================================================
                // PERBAIKAN: Ganti 'kode_wilayah' menjadi 'kodewilayah'
                // AMBIL DATA IKD BERDASARKAN PERIODE
                // ================================================================
                $data = $this->db
                    ->select('id, indikator_sasaran')
                    ->where('kodewilayah', $kodeWilayah)  // PERBAIKAN: kodewilayah
                    ->where('tahun_mulai', $tahunMulai)
                    ->where('tahun_akhir', $tahunAkhir)
                    ->where('deleted_at IS NULL')
                    ->order_by('id', 'ASC')
                    ->get('ikd')
                    ->result_array();
                
                echo json_encode([
                    'status' => 'success',
                    'data' => $data
                ]);
                
            } catch (Exception $e) {
                log_message('error', 'GetIKDByPeriode: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * GET DATA IKD TAHUN BERJALAN BY IKD ID (AJAX)
         * Untuk menampilkan data yang sudah tersimpan
         */
        public function GetIKDTahunBerjalanByIKD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                $ikdId = (int)$this->input->post('ikd_id', TRUE);
                $tahun = (int)$this->input->post('tahun', TRUE);
                
                if ($ikdId <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'IKD tidak valid!']);
                    return;
                }
                
                // Cek apakah sudah ada data untuk IKD dan tahun ini
                $existing = $this->db
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('ikd_id', $ikdId)
                    ->where('tahun', $tahun)
                    ->where('deleted_at IS NULL')
                    ->get('ikd_tahun_berjalan')
                    ->row_array();
                
                echo json_encode([
                    'status' => 'success',
                    'data' => $existing
                ]);
                
            } catch (Exception $e) {
                log_message('error', 'GetIKDTahunBerjalanByIKD: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        // ================================================================
        // CRUD IKD TAHUN BERJALAN
        // ================================================================

        /**
         * INPUT IKD TAHUN BERJALAN
         */
        public function InputIKDTahunBerjalan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                // Validasi hak akses (Level 3)
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Anda tidak memiliki akses!'
                    ]);
                    return;
                }
                
                $ikdId = (int)$this->input->post('ikd_id', TRUE);
                $indikator = trim($this->input->post('indikator', TRUE));
                $target = trim($this->input->post('target', TRUE));
                $tahun = (int)$this->input->post('tahun', TRUE);
                
                if ($ikdId <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'IKD harus dipilih!'
                    ]);
                    return;
                }
                
                if (empty($indikator)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Indikator Kinerja Daerah harus diisi!'
                    ]);
                    return;
                }
                
                if (empty($target)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Target harus diisi!'
                    ]);
                    return;
                }
                
                if ($tahun <= 0 || strlen($tahun) != 4) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Tahun harus 4 digit angka!'
                    ]);
                    return;
                }
                
                // Cek duplikat
                $exists = $this->db
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('ikd_id', $ikdId)
                    ->where('tahun', $tahun)
                    ->where('deleted_at IS NULL')
                    ->get('ikd_tahun_berjalan')
                    ->num_rows();
                
                if ($exists > 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data untuk IKD dan tahun ini sudah ada! Gunakan Edit.'
                    ]);
                    return;
                }
                
                $data = [
                    'kode_wilayah' => $kodeWilayah,
                    'ikd_id' => $ikdId,
                    'indikator_kinerja_daerah' => $indikator,
                    'target' => $target,
                    'tahun' => $tahun,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('ikd_tahun_berjalan', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'InputIKDTahunBerjalan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * EDIT IKD TAHUN BERJALAN
         */
        public function EditIKDTahunBerjalan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Anda tidak memiliki akses!'
                    ]);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                $target = trim($this->input->post('target', TRUE));
                $tahun = (int)$this->input->post('tahun', TRUE);
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                if (empty($target)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Target harus diisi!'
                    ]);
                    return;
                }
                
                if ($tahun <= 0 || strlen($tahun) != 4) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Tahun harus 4 digit angka!'
                    ]);
                    return;
                }
                
                $data = [
                    'target' => $target,
                    'tahun' => $tahun,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->update('ikd_tahun_berjalan', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil diupdate!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Tidak ada perubahan data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'EditIKDTahunBerjalan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * HAPUS IKD TAHUN BERJALAN (Soft Delete)
         */
        public function HapusIKDTahunBerjalan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Anda tidak memiliki akses!'
                    ]);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->update('ikd_tahun_berjalan', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil dihapus!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menghapus data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'HapusIKDTahunBerjalan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * GET PERIODE BY IKD ID (AJAX)
         */
        public function GetPeriodeByIKDId() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                $ikdId = (int)$this->input->post('ikd_id', TRUE);
                
                if ($ikdId <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'IKD ID tidak valid!']);
                    return;
                }
                
                $data = $this->db
                    ->select('tahun_mulai, tahun_akhir')
                    ->where('id', $ikdId)
                    ->where('kodewilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('ikd')
                    ->row_array();
                
                if ($data) {
                    echo json_encode([
                        'status' => 'success',
                        'data' => $data
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'GetPeriodeByIKDId: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * GET ALL IKD (AJAX) - FALLBACK
         */
        public function GetAllIKD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                $data = $this->db
                    ->select('id, indikator_sasaran')
                    ->where('kodewilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('indikator_sasaran', 'ASC')
                    ->get('ikd')
                    ->result_array();
                
                echo json_encode([
                    'status' => 'success',
                    'data' => $data
                ]);
                
            } catch (Exception $e) {
                log_message('error', 'GetAllIKD: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        // ============================================================
        // RANWAL RKPD PERANGKAT DAERAH
        // ============================================================

        public function RanwalRKPD() {
            $Header['Halaman'] = 'Ranwal RKPD';
            
            // ==============================
            // 1. AMBIL DATA DARI SESSION
            // ==============================
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            $Data['KodeWilayah'] = $KodeWilayah;
            
            // ==============================
            // 2. AMBIL NAMA WILAYAH
            // ==============================
            $Data['NamaWilayah'] = '';
            if ($KodeWilayah) {
                $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
            }
            
            // ==============================
            // 3. DATA PROVINSI UNTUK FILTER
            // ==============================
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                        ->order_by('Nama')
                                        ->get('kodewilayah')
                                        ->result_array();
            
            // ==============================
            // 4. DAFTAR INSTANSI UNTUK FILTER (hanya untuk non-role 4)
            // ==============================
            $Data['ListInstansi'] = [];
            $is_role_4 = isset($_SESSION['Level']) && $_SESSION['Level'] == 4;
            
            if (!$is_role_4 && $KodeWilayah) {
                $Data['ListInstansi'] = $this->db->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            // ==============================
            // 5. AMBIL DATA RENJA (HANYA YANG SUDAH DIINPUT)
            // ==============================
            $Data['RenjaData'] = [];
            $filter_instansi_id = $this->input->get('instansi_id', TRUE);
            
            if ($KodeWilayah) {
                // Ambil Header
                $query_header = $this->db->select('h.*, a.nama as instansi_nama')
                    ->from('renja_pd_header h')
                    ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
                    ->where('h.kode_wilayah', $KodeWilayah)
                    ->where('h.deleted_at IS NULL');
                
                // Filter berdasarkan instansi
                if ($is_role_4 && isset($_SESSION['IdInstansi'])) {
                    $query_header->where('h.id_instansi', $_SESSION['IdInstansi']);
                } elseif (!empty($filter_instansi_id)) {
                    $query_header->where('h.id_instansi', (int)$filter_instansi_id);
                }
                
                $headers = $query_header->order_by('h.id', 'ASC')->get()->result_array();
                
                // Ambil Detail untuk setiap header
                foreach ($headers as &$header) {
                    $details = $this->db->select('
                            d.*,
                            a.nama as bidang_pengampu_nama,
                            ak.nama as pengampu_nama,
                            ak.jabatan as pengampu_jabatan
                        ')
                        ->from('renja_pd_detail d')
                        ->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left')
                        ->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left')
                        ->where('d.header_id', $header['id'])
                        ->where('d.deleted_at IS NULL')
                        ->order_by('d.urutan', 'ASC')
                        ->order_by('d.id', 'ASC')
                        ->get()
                        ->result_array();
                    
                    $header['details'] = $details;
                    $header['detail_count'] = count($details);
                }
                
                $Data['RenjaData'] = $headers;
            }
            
            // ==============================
            // 6. LOAD VIEW
            // ==============================
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/RanwalRKPD', $Data);
        }

        /**
         * GET DETAIL RANWAL RKPD BY ID (AJAX)
         * Untuk mengambil data detail saat tombol Edit diklik
         */
        public function GetRanwalRKPDDetail() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            if (!$id || empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            // Ambil data detail dengan join
            $this->db->select('
                d.*,
                h.kode_rekening,
                h.tujuan,
                h.sasaran,
                h.program,
                h.kegiatan,
                h.sub_kegiatan,
                h.tahun,
                a.nama as bidang_pengampu_nama,
                ak.nama as pengampu_nama
            ');
            $this->db->from('renja_pd_detail d');
            $this->db->join('renja_pd_header h', 'h.id = d.header_id', 'left');
            $this->db->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left');
            $this->db->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left');
            $this->db->where('d.id', $id);
            $this->db->where('d.kode_wilayah', $kodeWilayah);
            $this->db->where('d.deleted_at IS NULL');
            
            $data = $this->db->get()->row_array();
            
            if ($data) {
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
            exit;
        }

        public function UpdateRanwalRKPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            // Ambil data lama untuk perbandingan
            $oldData = $this->db->where('id', $id)->where('kode_wilayah', $kodeWilayah)->get('renja_pd_detail')->row_array();
            
            if (!$oldData) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
                return;
            }
            
            // Format Rupiah helper
            $formatRp = function($val) {
                if (empty($val)) return null;
                $val = str_replace(['Rp', ' ', '.', ','], '', $val);
                return $val !== '' ? (float)$val : null;
            };
            
            // Data baru
            $newData = [
                'indikator_kinerja' => trim($this->input->post('indikator_kinerja', TRUE)),
                'satuan' => trim($this->input->post('satuan', TRUE)),
                'lokasi' => trim($this->input->post('lokasi', TRUE)),
                'prioritas_daerah' => trim($this->input->post('prioritas_daerah', TRUE)),
                'prioritas_nasional' => trim($this->input->post('prioritas_nasional', TRUE)),
                'ranwal_kinerja' => trim($this->input->post('ranwal_kinerja', TRUE)),
                'ranwal_rp' => $formatRp($this->input->post('ranwal_rp', TRUE)),
                'rancangan_kinerja' => trim($this->input->post('rancangan_kinerja', TRUE)),
                'rancangan_rp' => $formatRp($this->input->post('rancangan_rp', TRUE)),
                'ranhir_kinerja' => trim($this->input->post('ranhir_kinerja', TRUE)),
                'ranhir_rp' => $formatRp($this->input->post('ranhir_rp', TRUE)),
                'renja_kinerja' => trim($this->input->post('renja_kinerja', TRUE)),
                'renja_rp' => $formatRp($this->input->post('renja_rp', TRUE)),
                'dpa_murni_kinerja' => trim($this->input->post('dpa_murni_kinerja', TRUE)),
                'dpa_murni_rp' => $formatRp($this->input->post('dpa_murni_rp', TRUE)),
                'sumber_dana' => trim($this->input->post('sumber_dana', TRUE)),
                'dpa_perubahan_kinerja' => trim($this->input->post('dpa_perubahan_kinerja', TRUE)),
                'dpa_perubahan_rp' => $formatRp($this->input->post('dpa_perubahan_rp', TRUE)),
                'bidang_pengampu' => trim($this->input->post('bidang_pengampu', TRUE)),
                'pengampu' => trim($this->input->post('pengampu', TRUE)),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // Bandingkan data dan catat perubahan
            $changedFields = [];
            $fieldLabels = [
                'indikator_kinerja' => 'Indikator Kinerja',
                'satuan' => 'Satuan',
                'lokasi' => 'Lokasi',
                'prioritas_daerah' => 'Prioritas Daerah',
                'prioritas_nasional' => 'Prioritas Nasional',
                'ranwal_kinerja' => 'Ranwal Kinerja',
                'ranwal_rp' => 'Ranwal Rp',
                'rancangan_kinerja' => 'Rancangan Kinerja',
                'rancangan_rp' => 'Rancangan Rp',
                'ranhir_kinerja' => 'Ranhir Kinerja',
                'ranhir_rp' => 'Ranhir Rp',
                'renja_kinerja' => 'Renja Kinerja',
                'renja_rp' => 'Renja Rp',
                'dpa_murni_kinerja' => 'DPA Murni Kinerja',
                'dpa_murni_rp' => 'DPA Murni Rp',
                'sumber_dana' => 'Sumber Dana',
                'dpa_perubahan_kinerja' => 'DPA Perubahan Kinerja',
                'dpa_perubahan_rp' => 'DPA Perubahan Rp',
                'bidang_pengampu' => 'Bidang Pengampu',
                'pengampu' => 'Pengampu'
            ];
            
            foreach ($fieldLabels as $field => $label) {
                $oldVal = $oldData[$field] ?? '';
                $newVal = $newData[$field] ?? '';
                
                // Untuk angka, bandingkan nilai numerik
                if (strpos($field, '_rp') !== false) {
                    $oldVal = (float)$oldVal;
                    $newVal = (float)$newVal;
                }
                
                if ($oldVal != $newVal) {
                    $changedFields[] = $label;
                }
            }
            
            // Jika ada perubahan, tandai sebagai diedit oleh daerah
            if (!empty($changedFields)) {
                $newData['edited_by_daerah'] = 1;
                $newData['daerah_edit_fields'] = implode(', ', $changedFields);
                $newData['daerah_edit_time'] = date('Y-m-d H:i:s');
            }
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('renja_pd_detail', $newData);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Data berhasil diperbarui',
                    'changed_fields' => $changedFields
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Tidak ada perubahan data']);
            }
            exit;
        }

        public function HapusRanwalRKPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Hanya role 3 (Daerah) yang boleh menghapus
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Akses ditolak! Hanya pengguna Daerah yang dapat menghapus.'
                ]);
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($kodeWilayah)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Wilayah belum dipilih'
                ]);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'ID tidak valid'
                ]);
                return;
            }
            
            // Cek apakah data ada dan belum dihapus
            $existing = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('renja_pd_detail')
                ->row_array();
            
            if (!$existing) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau sudah dihapus!'
                ]);
                return;
            }
            
            // Soft delete
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('renja_pd_detail', [
                'deleted_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal menghapus data!'
                ]);
            }
            exit;
        }

        /**
         * RESET NOTIFIKASI PERUBAHAN (untuk Instansi setelah melihat notif)
         */
        public function ResetNotifikasiRanwal() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if ($id <= 0 || empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('renja_pd_detail', [
                'edited_by_daerah' => 0,
                'daerah_edit_fields' => null,
                'daerah_edit_time' => null
            ]);
            
            echo json_encode(['status' => 'success', 'message' => 'Notifikasi direset']);
            exit;
        }

        /**
         * GET LOKASI DETAIL (AJAX)
         */
        public function getLokasiDetailRanwal() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kode = $this->input->post('kode', TRUE);
            
            if (empty($kode)) {
                echo json_encode(null);
                return;
            }
            
            $data = $this->db
                ->select('Kode, Nama')
                ->from('kodewilayah')
                ->where('Kode', $kode)
                ->get()
                ->row_array();
            
            echo json_encode($data);
            exit;
        }

        // =====================================================
        // RANCANGAN RKPD (DAERAH) - ROLE 3
        // =====================================================

        public function RancanganRKPD() {
            $Header['Halaman'] = 'Rancangan RKPD';
            
            // ============================================
            // AMBIL DATA SESSION
            // ============================================
            $KodeWilayah = $this->get_kode_wilayah();
            $instansi_id = $this->get_instansi_id();
            $is_logged_in = $this->is_logged_in();
            $is_role_4 = $this->is_role_4();
            
            // Filter instansi dari URL (untuk role selain 4)
            $filter_instansi_id = $this->input->get('instansi_id', TRUE);
            
            // ============================================
            // SET DATA VIEW
            // ============================================
            $data['KodeWilayah'] = $KodeWilayah;
            $data['InstansiId'] = $instansi_id;
            $data['IsLoggedIn'] = $is_logged_in;
            $data['IsRole4'] = $is_role_4;
            $data['FilterInstansiId'] = $filter_instansi_id;
            $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
            
            // Ambil nama wilayah
            $data['NamaWilayah'] = '';
            if ($KodeWilayah) {
                $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
            }
            
            // ============================================
            // DATA PROVINSI UNTUK FILTER
            // ============================================
            $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                        ->order_by('Nama')
                                        ->get('kodewilayah')
                                        ->result_array();
            
            // ============================================
            // DAFTAR INSTANSI UNTUK FILTER
            // ============================================
            $data['ListInstansi'] = [];
            if ($KodeWilayah) {
                $data['ListInstansi'] = $this->db->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            // ============================================
            // AMBIL DATA RANCANGAN RENJA
            // ============================================
            $data['RancanganData'] = [];
            
            if ($KodeWilayah) {
                // Query Header dari rancangan_renja_header
                $query_header = $this->db->select('r.*, a.nama as instansi_nama')
                    ->from('rancangan_renja_header r')
                    ->join('akun_instansi a', 'a.id = r.id_instansi', 'left')
                    ->where('r.kode_wilayah', $KodeWilayah)
                    ->where('r.deleted_at IS NULL');
                
                // Filter berdasarkan role
                if ($is_role_4 && $instansi_id) {
                    $query_header->where('r.id_instansi', $instansi_id);
                } elseif (!empty($filter_instansi_id)) {
                    $query_header->where('r.id_instansi', (int)$filter_instansi_id);
                }
                
                $headers = $query_header->order_by('r.id', 'ASC')->get()->result_array();
                
                // Ambil Detail untuk setiap header
                foreach ($headers as &$header) {
                    $details = $this->db->select('
                            d.*,
                            a.nama as bidang_pengampu_nama,
                            ak.nama as pengampu_nama,
                            ak.jabatan as pengampu_jabatan ,
                            (SELECT Nama FROM kodewilayah WHERE Kode = d.lokasi LIMIT 1) as lokasi_nama
                        ')
                        ->from('rancangan_renja_detail d')
                        ->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left')
                        ->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left')
                        ->where('d.header_id', $header['id'])
                        ->where('d.deleted_at IS NULL')
                        ->order_by('d.urutan', 'ASC')
                        ->order_by('d.id', 'ASC')
                        ->get()
                        ->result_array();
                    
                    // Tambahkan flag apakah ada yang diedit oleh daerah
                    $has_edit = false;
                    foreach ($details as $detail) {
                        if (!empty($detail['edited_by_daerah']) && $detail['edited_by_daerah'] == 1) {
                            $has_edit = true;
                            break;
                        }
                    }
                    $header['has_edit'] = $has_edit;
                    $header['details'] = $details;
                    $header['detail_count'] = count($details);
                }
                
                $data['RancanganData'] = $headers;
            }
            
            // ============================================
            // LOAD VIEW
            // ============================================
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/RancanganRKPD', $data);
        }

        public function EditRancanganRKPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Hanya untuk user yang login
            if (!$this->is_logged_in()) {
                echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kode_wilayah = $this->get_kode_wilayah();
            
            if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            // Ambil data detail dari rancangan_renja_detail
            $detail = $this->db->where('id', $id)
                ->where('kode_wilayah', $kode_wilayah)
                ->where('deleted_at IS NULL')
                ->get('rancangan_renja_detail')
                ->row_array();
            
            if (!$detail) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
                return;
            }
            
            // Simpan data lama untuk notifikasi (JSON)
            $old_data = [
                'indikator_kinerja' => $detail['indikator_kinerja'],
                'satuan' => $detail['satuan'],
                'lokasi' => $detail['lokasi'],
                'prioritas_daerah' => $detail['prioritas_daerah'],
                'prioritas_nasional' => $detail['prioritas_nasional'],
                'ranwal_kinerja' => $detail['ranwal_kinerja'],
                'ranwal_rp' => $detail['ranwal_rp'],
                'rancangan_kinerja' => $detail['rancangan_kinerja'],
                'rancangan_rp' => $detail['rancangan_rp'],
                'ranhir_kinerja' => $detail['ranhir_kinerja'],
                'ranhir_rp' => $detail['ranhir_rp'],
                'renja_kinerja' => $detail['renja_kinerja'],
                'renja_rp' => $detail['renja_rp'],
                'dpa_murni_kinerja' => $detail['dpa_murni_kinerja'],
                'dpa_murni_rp' => $detail['dpa_murni_rp'],
                'sumber_dana' => $detail['sumber_dana'],
                'dpa_perubahan_kinerja' => $detail['dpa_perubahan_kinerja'],
                'dpa_perubahan_rp' => $detail['dpa_perubahan_rp'],
                'bidang_pengampu' => $detail['bidang_pengampu'],
                'pengampu' => $detail['pengampu']
            ];
            
            // Format rupiah helper
            $formatRp = function($val) {
                if (empty($val)) return null;
                $val = str_replace(['Rp', ' ', '.', ','], '', $val);
                return $val !== '' ? (float)$val : null;
            };
            
            // Data yang akan diupdate
            $data = [
                'indikator_kinerja' => trim($this->input->post('indikator_kinerja', TRUE)),
                'satuan' => trim($this->input->post('satuan', TRUE)),
                'lokasi' => trim($this->input->post('lokasi', TRUE)),
                'prioritas_daerah' => trim($this->input->post('prioritas_daerah', TRUE)),
                'prioritas_nasional' => trim($this->input->post('prioritas_nasional', TRUE)),
                'ranwal_kinerja' => trim($this->input->post('ranwal_kinerja', TRUE)),
                'ranwal_rp' => $formatRp($this->input->post('ranwal_rp', TRUE)),
                'rancangan_kinerja' => trim($this->input->post('rancangan_kinerja', TRUE)),
                'rancangan_rp' => $formatRp($this->input->post('rancangan_rp', TRUE)),
                'ranhir_kinerja' => trim($this->input->post('ranhir_kinerja', TRUE)),
                'ranhir_rp' => $formatRp($this->input->post('ranhir_rp', TRUE)),
                'renja_kinerja' => trim($this->input->post('renja_kinerja', TRUE)),
                'renja_rp' => $formatRp($this->input->post('renja_rp', TRUE)),
                'dpa_murni_kinerja' => trim($this->input->post('dpa_murni_kinerja', TRUE)),
                'dpa_murni_rp' => $formatRp($this->input->post('dpa_murni_rp', TRUE)),
                'sumber_dana' => trim($this->input->post('sumber_dana', TRUE)),
                'dpa_perubahan_kinerja' => trim($this->input->post('dpa_perubahan_kinerja', TRUE)),
                'dpa_perubahan_rp' => $formatRp($this->input->post('dpa_perubahan_rp', TRUE)),
                'bidang_pengampu' => $this->input->post('bidang_pengampu', TRUE) ?: null,
                'pengampu' => $this->input->post('pengampu', TRUE) ?: null,
                
                // TANDAI bahwa data ini diedit oleh Daerah
                'edited_by_daerah' => 1,
                'daerah_edit_fields' => $this->input->post('daerah_edit_fields', TRUE) ?: 'all',
                'daerah_edit_time' => date('Y-m-d H:i:s'),
                'daerah_edit_old_data' => json_encode($old_data),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id', $id);
            $this->db->update('rancangan_renja_detail', $data);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data Rancangan RKPD berhasil diperbarui',
                'edited_by_daerah' => 1
            ]);
            exit;
        }

        public function HapusRancanganRKPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Hanya role 3 (Daerah) yang boleh menghapus
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Akses ditolak! Hanya pengguna Daerah yang dapat menghapus.'
                ]);
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($kodeWilayah)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Wilayah belum dipilih'
                ]);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'ID tidak valid'
                ]);
                return;
            }
            
            // Cek apakah data ada dan belum dihapus
            $existing = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('rancangan_renja_detail')
                ->row_array();
            
            if (!$existing) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau sudah dihapus!'
                ]);
                return;
            }
            
            // Soft delete
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('rancangan_renja_detail', [
                'deleted_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil dihapus!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal menghapus data!'
                ]);
            }
            exit;
        }

        public function getLokasiDetail() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kode = $this->input->post('kode', TRUE);
            
            if (empty($kode)) {
                echo json_encode(null);
                return;
            }
            
            // Cek apakah manual atau kode wilayah
            if (strpos($kode, 'manual_') === 0) {
                // Untuk manual, kembalikan data dengan nama yang sama
                echo json_encode([
                    'Kode' => $kode,
                    'Nama' => $kode // atau bisa ambil dari hidden field
                ]);
                return;
            }
            
            // Ambil dari tabel kodewilayah
            $data = $this->db
                ->select('Kode, Nama')
                ->from('kodewilayah')
                ->where('Kode', $kode)
                ->get()
                ->row_array();
            
            if ($data) {
                echo json_encode($data);
            } else {
                echo json_encode(null);
            }
        }

        /**
         * Get list provinsi untuk dropdown
         * URL: Daerah/getProvinsiList
         */
        public function getProvinsiList() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $data = $this->db
                ->select('Kode, Nama')
                ->where("Kode LIKE '__'")
                ->order_by('Nama', 'ASC')
                ->get('kodewilayah')
                ->result_array();
            
            echo json_encode($data);
        }

        /**
         * Get list kab/kota berdasarkan provinsi
         * URL: Daerah/getKabKotaByProvinsi
         */
        public function getKabKotaByProvinsi() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeProvinsi = $this->input->post('kode_provinsi', TRUE);
            
            if (empty($kodeProvinsi)) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->select('Kode, Nama')
                ->from('kodewilayah')
                ->where('Kode LIKE', $kodeProvinsi . '.%')
                ->where("LENGTH(REPLACE(Kode, '.', '')) = 4") // Kab/Kota (2 digit provinsi + 2 digit kab)
                ->order_by('Nama', 'ASC')
                ->get()
                ->result_array();
            
            echo json_encode($data);
        }



        // ================================================================
        // GET DAFTAR DINAS (UNTUK RENJA)
        // ================================================================
        public function getDaftarDinasRenja() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            if (empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            // Ambil data dinas dari akun_instansi dengan Level 2
            $dinas = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('kodewilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();

            echo json_encode($dinas);
            exit;
        }

        // ================================================================
        // GET PELAKSANA BY DINAS (UNTUK RENJA)
        // ================================================================
        public function getPelaksanaByDinasRenja() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            $dinas_id = $this->input->post('dinas_id', TRUE);
            
            if (empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            $this->db->select('
                akun_karyawan.id,
                akun_karyawan.nama,
                akun_karyawan.nip,
                akun_karyawan.jabatan,
                akun_karyawan.dinas_id,
                GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
            ')
            ->from('akun_karyawan')
            ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
            ->where('akun_karyawan.Level', 4)
            ->where('akun_karyawan.kodewilayah', $kodeWilayah)
            ->where('akun_karyawan.deleted_at IS NULL');
            
            // Filter berdasarkan dinas jika dipilih
            if (!empty($dinas_id) && $dinas_id != '') {
                $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
            }
            
            $pelaksana = $this->db
                ->group_by('akun_karyawan.id')
                ->order_by('akun_karyawan.nama', 'ASC')
                ->get()
                ->result_array();

            echo json_encode($pelaksana);
            exit;
        }

        /**
         * Get Detail Rancangan RKPD untuk Edit
         * URL: Daerah/GetRancanganRKPDDetail
         */
        public function GetRancanganRKPDDetail() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            if (!$this->is_logged_in()) {
                echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kode_wilayah = $this->get_kode_wilayah();
            
            if (!$id) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            $this->db->select('
                d.*,
                h.kode_rekening,
                h.tujuan,
                h.sasaran,
                h.program,
                h.kegiatan,
                h.sub_kegiatan,
                h.tahun,
                a.nama as bidang_pengampu_nama,
                ak.nama as pengampu_nama,
                (SELECT Nama FROM kodewilayah WHERE Kode = d.lokasi LIMIT 1) as lokasi_nama
            ');
            $this->db->from('rancangan_renja_detail d');
            $this->db->join('rancangan_renja_header h', 'h.id = d.header_id', 'left');
            $this->db->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left');
            $this->db->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left');
            $this->db->where('d.id', $id);
            $this->db->where('d.kode_wilayah', $kode_wilayah);
            $this->db->where('d.deleted_at IS NULL');
            
            $data = $this->db->get()->row_array();
            
            if ($data) {
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
            exit;
        }

        private function get_kode_wilayah() {
            if (isset($_SESSION['KodeWilayah']) && !empty($_SESSION['KodeWilayah'])) {
                return $_SESSION['KodeWilayah'];
            }
            if (isset($_SESSION['TempKodeWilayah']) && !empty($_SESSION['TempKodeWilayah'])) {
                return $_SESSION['TempKodeWilayah'];
            }
            return null;
        }

        /**
         * Mendapatkan ID instansi dari session (hanya untuk role 4)
         */
        private function get_instansi_id() {
            if ($this->is_role_4()) {
                return isset($_SESSION['IdInstansi']) ? $_SESSION['IdInstansi'] : null;
            }
            // Untuk role lain, cek dari TempInstansiId
            if (isset($_SESSION['TempInstansiId']) && !empty($_SESSION['TempInstansiId'])) {
                return $_SESSION['TempInstansiId'];
            }
            return null;
        }

        /**
         * Cek apakah user sudah login
         */
        private function is_logged_in() {
            return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;
        }

        /**
         * Cek apakah user memiliki role 4 (Instansi)
         */
        private function is_role_4() {
            return $this->is_logged_in() && isset($_SESSION['Level']) && $_SESSION['Level'] == 4;
        }

        /**
         * Cek apakah user bisa melakukan CRUD (hanya role 4)
         */
        private function can_crud() {
            return $this->is_role_4();
        }

        /**
         * Cek apakah user memiliki role 3 (Daerah)
         */
        private function is_role_3() {
            return $this->is_logged_in() && isset($_SESSION['Level']) && $_SESSION['Level'] == 3;
        }

        /**
         * Cek apakah user bisa mengedit (role 3 atau role 4)
         */
        private function can_edit() {
            return $this->is_logged_in() && (isset($_SESSION['Level']) && ($_SESSION['Level'] == 3 || $_SESSION['Level'] == 4));
        }

        // ================================================================
        // RANKHIR RKPD (ROLE 3 - DAERAH)
        // ================================================================

        public function RankhirRKPD() {
            $Header['Halaman'] = 'Rankhir RKPD';
            
            // ==============================
            // 1. AMBIL DATA DARI SESSION
            // ==============================
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            $Data['KodeWilayah'] = $KodeWilayah;
            
            // ==============================
            // 2. AMBIL NAMA WILAYAH
            // ==============================
            $Data['NamaWilayah'] = '';
            if ($KodeWilayah) {
                $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
            }
            
            // ==============================
            // 3. DATA PROVINSI UNTUK FILTER
            // ==============================
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                        ->order_by('Nama')
                                        ->get('kodewilayah')
                                        ->result_array();
            
            // ==============================
            // 4. DAFTAR INSTANSI UNTUK FILTER (hanya untuk non-role 4)
            // ==============================
            $Data['ListInstansi'] = [];
            $is_role_4 = isset($_SESSION['Level']) && $_SESSION['Level'] == 4;
            
            if (!$is_role_4 && $KodeWilayah) {
                $Data['ListInstansi'] = $this->db->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            // ==============================
            // 5. AMBIL DATA RANKHIR (RANCANGAN AKHIR RENJA)
            // ==============================
            $Data['RankhirData'] = [];
            $filter_instansi_id = $this->input->get('instansi_id', TRUE);
            $tahun = $this->input->get('tahun', TRUE) ?: date('Y');
            $Data['TahunAktif'] = $tahun;
            
            if ($KodeWilayah) {
                // Ambil Header dari rancangan_akhir_renja_header
                $query_header = $this->db->select('h.*, a.nama as instansi_nama')
                    ->from('rancangan_akhir_renja_header h')
                    ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
                    ->where('h.kode_wilayah', $KodeWilayah)
                    ->where('h.tahun', $tahun)
                    ->where('h.deleted_at IS NULL');
                
                // Filter berdasarkan instansi
                if (!empty($filter_instansi_id)) {
                    $query_header->where('h.id_instansi', (int)$filter_instansi_id);
                }
                
                $headers = $query_header->order_by('h.id', 'ASC')->get()->result_array();
                
                // Ambil Detail untuk setiap header
                foreach ($headers as &$header) {
                    $details = $this->db->select('
                            d.*,
                            a.nama as bidang_pengampu_nama,
                            ak.nama as pengampu_nama,
                            ak.jabatan as pengampu_jabatan 
                        ')
                        ->from('rancangan_akhir_renja_detail d')
                        ->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left')
                        ->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left')
                        ->where('d.header_id', $header['id'])
                        ->where('d.deleted_at IS NULL')
                        ->order_by('d.urutan', 'ASC')
                        ->order_by('d.id', 'ASC')
                        ->get()
                        ->result_array();
                    
                    $header['details'] = $details;
                    $header['detail_count'] = count($details);
                }
                
                $Data['RankhirData'] = $headers;
            }
            
            // ==============================
            // 6. LOAD VIEW
            // ==============================
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/RankhirRKPD', $Data);
        }

        /**
         * GET DETAIL RANKHIR RKPD BY ID (AJAX)
         * Untuk mengambil data detail saat tombol Edit diklik
         */
        public function GetRankhirRKPDDetail() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            if (!$id || empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            // Ambil data detail dengan join
            $this->db->select('
                d.*,
                h.kode_rekening,
                h.tujuan,
                h.sasaran,
                h.program,
                h.kegiatan,
                h.sub_kegiatan,
                h.tahun,
                a.nama as bidang_pengampu_nama,
                ak.nama as pengampu_nama
            ');
            $this->db->from('rancangan_akhir_renja_detail d');
            $this->db->join('rancangan_akhir_renja_header h', 'h.id = d.header_id', 'left');
            $this->db->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left');
            $this->db->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left');
            $this->db->where('d.id', $id);
            $this->db->where('d.kode_wilayah', $kodeWilayah);
            $this->db->where('d.deleted_at IS NULL');
            
            $data = $this->db->get()->row_array();
            
            if ($data) {
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
            exit;
        }

        /**
         * UPDATE RANKHIR RKPD (AJAX) - HANYA UNTUK ROLE 3
         */
        public function UpdateRankhirRKPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Hanya role 3 (Daerah) yang boleh mengedit
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya pengguna Daerah yang dapat mengedit.']);
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            // Ambil data lama untuk perbandingan
            $oldData = $this->db->where('id', $id)->where('kode_wilayah', $kodeWilayah)->get('rancangan_akhir_renja_detail')->row_array();
            
            if (!$oldData) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
                return;
            }
            
            // Format Rupiah helper
            $formatRp = function($val) {
                if (empty($val)) return null;
                $val = str_replace(['Rp', ' ', '.', ','], '', $val);
                return $val !== '' ? (float)$val : null;
            };
            
            // Data baru
            $newData = [
                'indikator_kinerja' => trim($this->input->post('indikator_kinerja', TRUE)),
                'satuan' => trim($this->input->post('satuan', TRUE)),
                'lokasi' => trim($this->input->post('lokasi', TRUE)),
                'prioritas_daerah' => trim($this->input->post('prioritas_daerah', TRUE)),
                'prioritas_nasional' => trim($this->input->post('prioritas_nasional', TRUE)),
                'ranwal_kinerja' => trim($this->input->post('ranwal_kinerja', TRUE)),
                'ranwal_rp' => $formatRp($this->input->post('ranwal_rp', TRUE)),
                'rancangan_kinerja' => trim($this->input->post('rancangan_kinerja', TRUE)),
                'rancangan_rp' => $formatRp($this->input->post('rancangan_rp', TRUE)),
                'ranhir_kinerja' => trim($this->input->post('ranhir_kinerja', TRUE)),
                'ranhir_rp' => $formatRp($this->input->post('ranhir_rp', TRUE)),
                'renja_kinerja' => trim($this->input->post('renja_kinerja', TRUE)),
                'renja_rp' => $formatRp($this->input->post('renja_rp', TRUE)),
                'dpa_murni_kinerja' => trim($this->input->post('dpa_murni_kinerja', TRUE)),
                'dpa_murni_rp' => $formatRp($this->input->post('dpa_murni_rp', TRUE)),
                'sumber_dana' => trim($this->input->post('sumber_dana', TRUE)),
                'dpa_perubahan_kinerja' => trim($this->input->post('dpa_perubahan_kinerja', TRUE)),
                'dpa_perubahan_rp' => $formatRp($this->input->post('dpa_perubahan_rp', TRUE)),
                'bidang_pengampu' => trim($this->input->post('bidang_pengampu', TRUE)),
                'pengampu' => trim($this->input->post('pengampu', TRUE)),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // Tandai bahwa data diedit oleh daerah
            $newData['edited_by_daerah'] = 1;
            $newData['daerah_edit_time'] = date('Y-m-d H:i:s');
            
            // Simpan data lama sebagai JSON untuk notifikasi
            $newData['daerah_edit_old_data'] = json_encode($oldData);
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('rancangan_akhir_renja_detail', $newData);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'status' => 'success', 
                    'message' => 'Data berhasil diperbarui',
                    'edited_by_daerah' => 1
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Tidak ada perubahan data']);
            }
            exit;
        }

        public function HapusRankhirRKPD() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Hanya role 3 (Daerah) yang boleh menghapus
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Akses ditolak! Hanya pengguna Daerah yang dapat menghapus.'
                ]);
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($kodeWilayah)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Wilayah belum dipilih'
                ]);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'ID tidak valid'
                ]);
                return;
            }
            
            // Cek apakah data ada dan belum dihapus
            $existing = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('rancangan_akhir_renja_detail')
                ->row_array();
            
            if (!$existing) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Data tidak ditemukan atau sudah dihapus!'
                ]);
                return;
            }
            
            // Mulai transaksi untuk konsistensi data
            $this->db->trans_start();
            
            try {
                // Soft delete
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->update('rancangan_akhir_renja_detail', [
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                // Cek jika masih ada detail lain untuk header ini
                $remainingCount = $this->db
                    ->where('header_id', $existing['header_id'])
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->count_all_results('rancangan_akhir_renja_detail');
                
                // Jika tidak ada detail tersisa, soft delete header juga
                if ($remainingCount == 0) {
                    $this->db->where('id', $existing['header_id']);
                    $this->db->where('kode_wilayah', $kodeWilayah);
                    $this->db->update('rancangan_akhir_renja_header', [
                        'deleted_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                }
                
                $this->db->trans_complete();
                
                if ($this->db->trans_status() === FALSE) {
                    throw new Exception('Gagal menghapus data!');
                }
                
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data Rankhir RKPD berhasil dihapus!'
                ]);
                
            } catch (Exception $e) {
                $this->db->trans_rollback();
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
            exit;
        }

        /**
         * RESET NOTIFIKASI PERUBAHAN (untuk Instansi setelah melihat notif)
         */
        public function ResetNotifikasiRankhir() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if ($id <= 0 || empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->update('rancangan_akhir_renja_detail', [
                'edited_by_daerah' => 0,
                'daerah_edit_old_data' => null,
                'daerah_edit_time' => null
            ]);
            
            echo json_encode(['status' => 'success', 'message' => 'Notifikasi direset']);
            exit;
        }


        // ================================================================
            // PAGU URUSAN RANKHIR - MAIN PAGE
            // ================================================================

            public function PaguUrusanRankhir() {
            $Header['Halaman'] = 'Pagu Urusan Rankhir';
            
            // Ambil KodeWilayah dari session atau temp
            $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                        (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');
            
            // Data untuk filter provinsi
            $Data['Provinsi'] = $this->db
                ->where("Kode LIKE '__'")
                ->order_by('Nama')
                ->get('kodewilayah')
                ->result_array();
            
            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['NamaWilayah'] = '';
            $Data['ListInstansi'] = [];
            $Data['PaguUrusan'] = [];
            
            // Ambil filter instansi dari URL
            $filterInstansiId = $this->input->get('instansi_id', TRUE);
            
            if (!empty($KodeWilayah)) {
                // Ambil nama wilayah
                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                if ($wilayah) {
                    $Data['NamaWilayah'] = $wilayah['Nama'];
                }
                
                // List Instansi untuk filter (dari akun_instansi)
                $Data['ListInstansi'] = $this->db->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();
                
                // ==============================================================
                // AMBIL DATA DARI TABEL pagu_urusan_rankhir
                // ==============================================================
                $this->db->select('r.*')
                    ->from('pagu_urusan_rankhir r')
                    ->where('r.kode_wilayah', $KodeWilayah)
                    ->where('r.deleted_at IS NULL', null, false);
                
                // Filter instansi jika ada
                if (!empty($filterInstansiId)) {
                    // Cek apakah ada kolom instansi_id di pagu_urusan
                    $columns = $this->db->query("SHOW COLUMNS FROM pagu_urusan LIKE 'instansi_id'")->num_rows();
                    
                    if ($columns > 0) {
                        // Join ke pagu_urusan untuk filter
                        $this->db->join('pagu_urusan pu', 'pu.id = r.source_id', 'left')
                            ->where('pu.instansi_id', $filterInstansiId);
                    }
                }
                
                $Data['PaguUrusan'] = $this->db
                    ->order_by('r.id', 'ASC')
                    ->get()
                    ->result_array();
                
                // ==============================================================
                // TAMBAHKAN NAMA INSTANSI KE SETIAP DATA
                // ==============================================================
                foreach ($Data['PaguUrusan'] as &$row) {
                    $instansiNama = '-';
                    if (!empty($row['source_id'])) {
                        // Cari data di pagu_urusan
                        $sourceData = $this->db
                            ->where('id', $row['source_id'])
                            ->get('pagu_urusan')
                            ->row_array();
                        
                        if ($sourceData && isset($sourceData['instansi_id']) && !empty($sourceData['instansi_id'])) {
                            $instansi = $this->db
                                ->select('nama')
                                ->where('id', $sourceData['instansi_id'])
                                ->get('akun_instansi')
                                ->row_array();
                            $instansiNama = $instansi ? $instansi['nama'] : '-';
                        }
                    }
                    $row['instansi_nama'] = $instansiNama;
                }
            }
            
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/PaguUrusanRankhir', $Data);
        }

            // ================================================================
            // GET DATA BY ID (UNTUK EDIT)
            // ================================================================

            /**
             * Get data Pagu Urusan Rankhir by ID (AJAX)
             * Untuk mengisi form edit
             */
            public function GetPaguUrusanRankhirById() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                // Cek role - hanya role 3
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak!']);
                    return;
                }
                
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                // Ambil data dari pagu_urusan_rankhir
                $data = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL', null, false)
                    ->get('pagu_urusan_rankhir')
                    ->row_array();
                
                if ($data) {
                    // Tambahkan nama instansi
                    $instansiNama = '-';
                    if (!empty($data['source_id'])) {
                        $sourceData = $this->db
                            ->where('id', $data['source_id'])
                            ->get('pagu_urusan')
                            ->row_array();
                        if ($sourceData && isset($sourceData['instansi_id']) && !empty($sourceData['instansi_id'])) {
                            $instansi = $this->db
                                ->select('nama')
                                ->where('id', $sourceData['instansi_id'])
                                ->get('akun_instansi')
                                ->row_array();
                            $instansiNama = $instansi ? $instansi['nama'] : '-';
                        }
                    }
                    $data['instansi_nama'] = $instansiNama;
                    
                    echo json_encode([
                        'status' => 'success',
                        'data' => $data
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan!'
                    ]);
                }
                exit;
            }

            // ================================================================
            // UPDATE PAGU URUSAN RANKHIR
            // ================================================================

            public function UpdatePaguUrusanRankhir() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Cek role - hanya role 3
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya pengguna Daerah yang dapat mengedit.']);
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kodeUrusan = trim($this->input->post('kode_urusan', TRUE));
            $urusan = trim($this->input->post('urusan', TRUE));
            $pagu = trim($this->input->post('pagu', TRUE));
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // ✅ URUSAN WAJIB
            if (empty($urusan)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Urusan harus diisi!'
                ]);
                return;
            }
            
            // ✅ KODE URUSAN TIDAK WAJIB
            $kodeUrusanValue = !empty($kodeUrusan) ? $kodeUrusan : null;
            
            // ✅ PAGU TIDAK WAJIB
            $paguClean = null;
            if (!empty($pagu)) {
                $paguClean = str_replace(['.', ','], '', $pagu);
                if (!is_numeric($paguClean)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Pagu Anggaran harus berupa angka!'
                    ]);
                    return;
                }
            }
            
            // ✅ AMBIL DATA LAMA
            $oldData = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->get('pagu_urusan_rankhir')
                ->row_array();
            
            if (!$oldData) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                return;
            }
            
            // ✅ TRACKING PERUBAHAN
            $changedFields = [];
            $oldValues = [];
            
            if ($oldData['kode_urusan'] != $kodeUrusanValue) {
                $changedFields[] = 'kode_urusan';
                $oldValues['kode_urusan'] = $oldData['kode_urusan'];
            }
            if ($oldData['urusan'] != $urusan) {
                $changedFields[] = 'urusan';
                $oldValues['urusan'] = $oldData['urusan'];
            }
            if ((float)$oldData['pagu'] != (float)$paguClean) {
                $changedFields[] = 'pagu';
                $oldValues['pagu'] = $oldData['pagu'];
            }
            
            // Siapkan data update
            $data = [
                'kode_urusan' => $kodeUrusanValue,
                'urusan' => $urusan,
                'pagu' => $paguClean,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            // Tandai bahwa data diedit oleh Daerah (role 3)
            $data['edited_by_daerah'] = 1;
            $data['daerah_edit_time'] = date('Y-m-d H:i:s');
            $data['daerah_edit_fields'] = !empty($changedFields) ? json_encode($changedFields) : null;
            $data['daerah_edit_old_data'] = !empty($oldValues) ? json_encode($oldValues) : null;
            
            // ✅ UPDATE TABEL
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $kodeWilayah);
            $this->db->where('deleted_at IS NULL', null, false);
            $this->db->update('pagu_urusan_rankhir', $data);
            
            $affected = $this->db->affected_rows();
            
            // ✅ AMBIL DATA TERBARU SETELAH UPDATE
            $updatedData = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kodeWilayah)
                ->where('deleted_at IS NULL', null, false)
                ->get('pagu_urusan_rankhir')
                ->row_array();
            
            if ($affected > 0 || $updatedData) {
                // ✅ KIRIM DATA TERBARU KE CLIENT
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil diperbarui!',
                    'changed_fields' => $changedFields,
                    'data' => $updatedData // KIRIM DATA TERBARU
                ]);
            } else {
                $error = $this->db->error();
                if ($error['code'] == 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Tidak ada perubahan data!',
                        'no_changes' => true,
                        'data' => $oldData // KIRIM DATA LAMA
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal update data: ' . $error['message']
                    ]);
                }
            }
            exit;
        }

        /**
         * GET DATA PAGU URUSAN RANKHIR TERBARU (AJAX)
         * Untuk refresh DataTable tanpa reload halaman
         */
        public function GetPaguUrusanRankhirData() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $filterInstansiId = $this->input->get('instansi_id', TRUE);
            
            $this->db->select('r.*')
                ->from('pagu_urusan_rankhir r')
                ->where('r.kode_wilayah', $kodeWilayah)
                ->where('r.deleted_at IS NULL', null, false);
            
            if (!empty($filterInstansiId)) {
                $this->db->join('pagu_urusan pu', 'pu.id = r.source_id', 'left')
                    ->where('pu.instansi_id', $filterInstansiId);
            }
            
            $data = $this->db
                ->order_by('r.id', 'ASC')
                ->get()
                ->result_array();
            
            // Tambahkan nama instansi
            foreach ($data as &$row) {
                $instansiNama = '-';
                if (!empty($row['source_id'])) {
                    $sourceData = $this->db
                        ->where('id', $row['source_id'])
                        ->get('pagu_urusan')
                        ->row_array();
                    
                    if ($sourceData && isset($sourceData['instansi_id']) && !empty($sourceData['instansi_id'])) {
                        $instansi = $this->db
                            ->select('nama')
                            ->where('id', $sourceData['instansi_id'])
                            ->get('akun_instansi')
                            ->row_array();
                        $instansiNama = $instansi ? $instansi['nama'] : '-';
                    }
                }
                $row['instansi_nama'] = $instansiNama;
            }
            
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
            exit;
        }

            // ================================================================
            // HAPUS PAGU URUSAN RANKHIR (SOFT DELETE)
            // ================================================================

            /**
             * Hapus Pagu Urusan Rankhir (Soft Delete)
             * Hanya untuk role 3 (Daerah)
             */
            public function HapusPaguUrusanRankhir() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                // Cek role - hanya role 3
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak!']);
                    return;
                }
                
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                // Cek apakah data ada dan belum dihapus
                $existing = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL', null, false)
                    ->get('pagu_urusan_rankhir')
                    ->row_array();
                
                if (!$existing) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan atau sudah dihapus!']);
                    return;
                }
                
                // Soft delete
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->where('deleted_at IS NULL', null, false);
                $this->db->update('pagu_urusan_rankhir', [
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success', 
                        'message' => 'Data berhasil dihapus!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Gagal menghapus data!'
                    ]);
                }
                exit;
            }

            // ================================================================
            // RESTORE PAGU URUSAN RANKHIR
            // ================================================================

            /**
             * Restore Pagu Urusan Rankhir (Pulihkan data yang dihapus)
             * Hanya untuk role 3 (Daerah)
             */
            public function RestorePaguUrusanRankhir() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                // Cek role - hanya role 3
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak!']);
                    return;
                }
                
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                // Cek apakah data ada dan sudah dihapus
                $existing = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NOT NULL', null, false)
                    ->get('pagu_urusan_rankhir')
                    ->row_array();
                
                if (!$existing) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan atau belum dihapus!']);
                    return;
                }
                
                // Restore data
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->update('pagu_urusan_rankhir', [
                    'deleted_at' => null,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success', 
                        'message' => 'Data berhasil dipulihkan!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Gagal memulihkan data!'
                    ]);
                }
                exit;
            }

            // ================================================================
            // RESET PAGU URUSAN RANKHIR KE DATA ASLI
            // ================================================================

            /**
             * Reset data Rankhir ke data asli dari Pagu Urusan
             * Hanya untuk role 3 (Daerah)
             */
            public function ResetPaguUrusanRankhir() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                // Cek role - hanya role 3
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak!']);
                    return;
                }
                
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                // Ambil data Rankhir
                $rankhirData = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL', null, false)
                    ->get('pagu_urusan_rankhir')
                    ->row_array();
                
                if (!$rankhirData) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                    return;
                }
                
                // Ambil data asli dari pagu_urusan berdasarkan source_id
                if (empty($rankhirData['source_id'])) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak memiliki sumber asli!']);
                    return;
                }
                
                $sourceData = $this->db
                    ->where('id', $rankhirData['source_id'])
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL', null, false)
                    ->get('pagu_urusan')
                    ->row_array();
                
                if (!$sourceData) {
                    echo json_encode(['status' => 'error', 'message' => 'Data asli tidak ditemukan di Pagu Urusan!']);
                    return;
                }
                
                // Reset data Rankhir ke data asli
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $kodeWilayah);
                $this->db->where('deleted_at IS NULL', null, false);
                $this->db->update('pagu_urusan_rankhir', [
                    'kode_urusan' => $sourceData['kode_urusan'],
                    'urusan' => $sourceData['urusan'],
                    'pagu' => $sourceData['pagu'],
                    'edited_by_daerah' => 0,
                    'daerah_edit_time' => null,
                    'daerah_edit_fields' => null,
                    'daerah_edit_old_data' => null,
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success', 
                        'message' => 'Data berhasil direset ke data asli!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Gagal mereset data!'
                    ]);
                }
                exit;
            }

            // ================================================================
            // SINKRONISASI DATA DARI PAGU URUSAN KE RANKHIR
            // ================================================================

            /**
             * Sinkronisasi data dari pagu_urusan ke pagu_urusan_rankhir
             * Hanya untuk role 3 (Daerah)
             */
            public function SyncPaguUrusanRankhir() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                // Cek role - hanya role 3
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak!']);
                    return;
                }
                
                $kodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($kodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                // Mulai transaksi
                $this->db->trans_start();
                
                try {
                    // Ambil semua data dari pagu_urusan yang aktif
                    $sourceData = $this->db
                        ->where('kode_wilayah', $kodeWilayah)
                        ->where('deleted_at IS NULL', null, false)
                        ->order_by('id', 'ASC')
                        ->get('pagu_urusan')
                        ->result_array();
                    
                    $totalInsert = 0;
                    $totalUpdate = 0;
                    $totalSkip = 0;
                    
                    foreach ($sourceData as $row) {
                        // Cek apakah sudah ada di rankhir berdasarkan source_id
                        $exists = $this->db
                            ->where('source_id', $row['id'])
                            ->where('kode_wilayah', $kodeWilayah)
                            ->where('deleted_at IS NULL', null, false)
                            ->get('pagu_urusan_rankhir')
                            ->num_rows();
                        
                        if ($exists > 0) {
                            // Update jika belum diedit oleh daerah
                            $rankhirRow = $this->db
                                ->where('source_id', $row['id'])
                                ->where('kode_wilayah', $kodeWilayah)
                                ->where('deleted_at IS NULL', null, false)
                                ->get('pagu_urusan_rankhir')
                                ->row_array();
                            
                            // Cek apakah data di rankhir sudah diedit oleh daerah
                            if (isset($rankhirRow['edited_by_daerah']) && $rankhirRow['edited_by_daerah'] == 1) {
                                // Data sudah diedit, skip update
                                $totalSkip++;
                                continue;
                            }
                            
                            // Update data rankhir dengan data asli terbaru
                            $this->db
                                ->where('id', $rankhirRow['id'])
                                ->where('kode_wilayah', $kodeWilayah)
                                ->update('pagu_urusan_rankhir', [
                                    'kode_urusan' => $row['kode_urusan'],
                                    'urusan' => $row['urusan'],
                                    'pagu' => $row['pagu'],
                                    'source_kode_urusan' => $row['kode_urusan'],
                                    'source_urusan' => $row['urusan'],
                                    'source_pagu' => $row['pagu'],
                                    'updated_at' => date('Y-m-d H:i:s')
                                ]);
                            $totalUpdate += $this->db->affected_rows();
                        } else {
                            // Insert baru
                            $this->db->insert('pagu_urusan_rankhir', [
                                'kode_wilayah' => $kodeWilayah,
                                'kode_urusan' => $row['kode_urusan'],
                                'urusan' => $row['urusan'],
                                'pagu' => $row['pagu'],
                                'source_id' => $row['id'],
                                'source_kode_urusan' => $row['kode_urusan'],
                                'source_urusan' => $row['urusan'],
                                'source_pagu' => $row['pagu'],
                                'created_at' => date('Y-m-d H:i:s'),
                                'edited_by_daerah' => 0
                            ]);
                            $totalInsert += $this->db->affected_rows();
                        }
                    }
                    
                    $this->db->trans_complete();
                    
                    if ($this->db->trans_status() === FALSE) {
                        throw new Exception('Gagal melakukan sinkronisasi!');
                    }
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => "Sinkronisasi selesai! Insert: $totalInsert, Update: $totalUpdate, Skip (sudah diedit): $totalSkip"
                    ]);
                    
                } catch (Exception $e) {
                    $this->db->trans_rollback();
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                    ]);
                }
                exit;
            }

            // ================================================================
            // GET LIST INSTANSI LEVEL 4 (UNTUK FILTER)
            // ================================================================

            /**
         * Get List Instansi Level 4 (AJAX)
         * Untuk dropdown filter instansi
         */
        public function GetListInstansiLevel4() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->input->post('kode_wilayah', TRUE);
            
            if (empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            $instansi = $this->db->select('id, nama')
                ->from('akun_instansi')
                ->where('kodewilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
            
            echo json_encode($instansi);
            exit;
        }

            // ============================================================
            // HALAMAN UTAMA KONSISTENSI PROGRAM
            // ============================================================
            
            public function KonsistensiProgram() {
            $Header['Halaman'] = 'Konsistensi Program RPJMD dan RKPD';
            
            $KodeWilayah = $this->_getKodeWilayah();
            
            $Data['Provinsi'] = $this->db
                ->where("Kode LIKE '__'")
                ->order_by('Nama')
                ->get('kodewilayah')
                ->result_array();
            
            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['NamaWilayah'] = '';
            $Data['TahunAktif'] = date('Y');
            
            $Data['ListInstansi'] = [];
            if (!empty($KodeWilayah)) {
                $Data['ListInstansi'] = $this->db->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            $Data['KonsistensiData'] = [];
            $filter_instansi = $this->input->get('instansi_id', TRUE);
            $tahun = $this->input->get('tahun', TRUE) ?: date('Y');
            $Data['TahunAktif'] = $tahun;
            
            if (!empty($KodeWilayah)) {
                $this->db->select('h.*, a.nama as instansi_nama')
                    ->from('konsistensi_program_header h')
                    ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
                    ->where('h.kode_wilayah', $KodeWilayah)
                    ->where('h.tahun', $tahun)
                    ->where('h.deleted_at IS NULL');
                
                if (!empty($filter_instansi)) {
                    $this->db->where('h.id_instansi', (int)$filter_instansi);
                }
                
                $headers = $this->db->order_by('h.id', 'ASC')->get()->result_array();
                
                // Kelompokkan data berdasarkan Urusan untuk mendapatkan urutan yang benar
                $groupedData = [];
                $urusanCounter = 0;
                
                foreach ($headers as &$header) {
                    // Ambil nama dari nomenklatur
                    $header['urusan_rpjmd_nama'] = $this->getNomenklaturName($header['urusan_rpjmd_kode'] ?? '');
                    $header['bidang_rpjmd_nama'] = $this->getNomenklaturName($header['bidang_urusan_rpjmd_kode'] ?? '');
                    $header['program_rpjmd_nama'] = $header['program_rpjmd_text'] ?? $this->getNomenklaturName($header['program_rpjmd_kode'] ?? '');
                    
                    $header['urusan_rkpd_nama'] = $this->getNomenklaturName($header['urusan_rkpd_kode'] ?? '');
                    $header['bidang_rkpd_nama'] = $this->getNomenklaturName($header['bidang_urusan_rkpd_kode'] ?? '');
                    $header['program_rkpd_nama'] = $header['program_rkpd_text'] ?? $this->getNomenklaturName($header['program_rkpd_kode'] ?? '');
                    
                    // Tentukan level
                    $hasProgram = !empty($header['program_rpjmd_kode']) || !empty($header['program_rpjmd_text']);
                    $hasBidang = !empty($header['bidang_urusan_rpjmd_kode']);
                    $hasUrusan = !empty($header['urusan_rpjmd_kode']);
                    
                    $level = 1;
                    if ($hasProgram) $level = 3;
                    elseif ($hasBidang) $level = 2;
                    
                    $header['level'] = $level;
                    
                    // Tentukan kode yang akan ditampilkan sebagai No
                    if ($level == 1) {
                        $header['no_display'] = $header['urusan_rpjmd_kode'] ?? '';
                    } elseif ($level == 2) {
                        $header['no_display'] = $header['bidang_urusan_rpjmd_kode'] ?? '';
                    } else {
                        $header['no_display'] = $header['program_rpjmd_kode'] ?? '';
                    }
                    
                    // Detail RPJMD
                    $header['rpjmd_details'] = $this->db
                        ->select('*')
                        ->from('konsistensi_program_detail')
                        ->where('header_id', $header['id'])
                        ->where('jenis', 'rpjmd')
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->get()
                        ->result_array();
                    
                    // Detail RKPD
                    $header['rkpd_details'] = $this->db
                        ->select('*')
                        ->from('konsistensi_program_detail')
                        ->where('header_id', $header['id'])
                        ->where('jenis', 'rkpd')
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->get()
                        ->result_array();
                }
                
                $Data['KonsistensiData'] = $headers;
            }
            
            if (!empty($KodeWilayah)) {
                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
            }
            
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/KonsistensiProgram', $Data);
        }

                // ============================================================
            // INPUT KONSISTENSI PROGRAM - DENGAN DEBUG LENGKAP
            // ============================================================
            
            public function InputKonsistensiProgram() {
                // Aktifkan error reporting
                error_reporting(E_ALL);
                ini_set('display_errors', 1);
                ini_set('log_errors', 1);
                ini_set('error_log', 'application/logs/php_errors.log');
                
                // Log untuk debugging
                log_message('debug', '=== InputKonsistensiProgram dipanggil ===');
                log_message('debug', 'POST data: ' . print_r($_POST, true));
                
                // Cek AJAX
                if (!$this->input->is_ajax_request()) {
                    log_message('error', 'Bukan AJAX request');
                    show_404();
                    return;
                }
                
                // Set header JSON
                header('Content-Type: application/json');
                
                try {
                    $KodeWilayah = $this->_checkSessionWilayah();
                    if (!$KodeWilayah) {
                        log_message('error', 'Wilayah belum dipilih');
                        return;
                    }
                    
                    log_message('debug', 'KodeWilayah: ' . $KodeWilayah);
                    
                    // ============================================================
                    // AMBIL DATA DARI POST
                    // ============================================================
                    $urusan_rpjmd_kode = trim($this->input->post('urusan_rpjmd_kode', TRUE) ?: '');
                    $bidang_rpjmd_kode = trim($this->input->post('bidang_rpjmd_kode', TRUE) ?: '');
                    $program_rpjmd_kode = trim($this->input->post('program_rpjmd_kode', TRUE) ?: '');
                    $program_rpjmd_text = trim($this->input->post('program_rpjmd_text', TRUE) ?: '');
                    
                    $pagu_program_rpjmd = $this->formatRupiahToNumber($this->input->post('pagu_program_rpjmd', TRUE));
                    
                    $urusan_rkpd_kode = trim($this->input->post('urusan_rkpd_kode', TRUE) ?: '');
                    $bidang_rkpd_kode = trim($this->input->post('bidang_rkpd_kode', TRUE) ?: '');
                    $program_rkpd_kode = trim($this->input->post('program_rkpd_kode', TRUE) ?: '');
                    $program_rkpd_text = trim($this->input->post('program_rkpd_text', TRUE) ?: '');
                    
                    $pagu_program_rkpd = $this->formatRupiahToNumber($this->input->post('pagu_program_rkpd', TRUE));
                    
                    $keterangan = trim($this->input->post('keterangan', TRUE) ?: '');
                    $id_instansi = $this->input->post('id_instansi', TRUE) ?: null;
                    $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
                    
                    log_message('debug', 'urusan_rpjmd_kode: ' . $urusan_rpjmd_kode);
                    log_message('debug', 'bidang_rpjmd_kode: ' . $bidang_rpjmd_kode);
                    log_message('debug', 'program_rpjmd_text: ' . $program_rpjmd_text);
                    log_message('debug', 'pagu_program_rpjmd: ' . $pagu_program_rpjmd);
                    log_message('debug', 'pagu_program_rkpd: ' . $pagu_program_rkpd);
                    
                    // Validasi: minimal salah satu diisi
                    $hasRpjmd = !empty($urusan_rpjmd_kode) || !empty($bidang_rpjmd_kode) || !empty($program_rpjmd_text);
                    $hasRkpd = !empty($urusan_rkpd_kode) || !empty($bidang_rkpd_kode) || !empty($program_rkpd_text);
                    
                    if (!$hasRpjmd && !$hasRkpd) {
                        echo json_encode(['status' => 'error', 'message' => 'Urusan/Program RPJMD atau RKPD harus diisi!']);
                        return;
                    }
                    
                    // Hitung selisih
                    $totalPaguRpjmd = $pagu_program_rpjmd ?? 0;
                    $totalPaguRkpd = $pagu_program_rkpd ?? 0;
                    $selisih = $totalPaguRkpd - $totalPaguRpjmd;
                    
                    // ============================================================
                    // DATA INDIKATOR
                    // ============================================================
                    $indikator_rpjmd = $this->input->post('indikator_rpjmd', TRUE);
                    $target_rpjmd = $this->input->post('target_rpjmd', TRUE);
                    $satuan_rpjmd = $this->input->post('satuan_rpjmd', TRUE);
                    
                    $indikator_rkpd = $this->input->post('indikator_rkpd', TRUE);
                    $target_rkpd = $this->input->post('target_rkpd', TRUE);
                    $satuan_rkpd = $this->input->post('satuan_rkpd', TRUE);
                    
                    log_message('debug', 'indikator_rpjmd: ' . print_r($indikator_rpjmd, true));
                    log_message('debug', 'indikator_rkpd: ' . print_r($indikator_rkpd, true));
                    
                    // ============================================================
                    // CEK STRUKTUR TABEL
                    // ============================================================
                    // Cek apakah tabel konsistensi_program_header ada
                    $tableExists = $this->db->query("SHOW TABLES LIKE 'konsistensi_program_header'")->num_rows();
                    if ($tableExists == 0) {
                        throw new Exception('Tabel konsistensi_program_header tidak ditemukan! Silahkan buat tabel terlebih dahulu.');
                    }
                    
                    // Cek kolom yang ada di tabel
                    $columns = $this->db->query("SHOW COLUMNS FROM konsistensi_program_header")->result_array();
                    $columnNames = array_column($columns, 'Field');
                    log_message('debug', 'Kolom yang ada: ' . print_r($columnNames, true));
                    
                    // ============================================================
                    // MULAI TRANSAKSI
                    // ============================================================
                    $this->db->trans_start();
                    
                    // Insert Header
                    $header_data = [
                        'kode_wilayah' => $KodeWilayah,
                        'id_instansi' => $id_instansi,
                        'urusan_rpjmd_kode' => $urusan_rpjmd_kode ?: null,
                        'bidang_urusan_rpjmd_kode' => $bidang_rpjmd_kode ?: null,
                        'program_rpjmd_kode' => $program_rpjmd_kode ?: null,
                        'program_rpjmd_text' => $program_rpjmd_text ?: null,
                        'pagu_program_rpjmd' => $pagu_program_rpjmd,
                        'urusan_rkpd_kode' => $urusan_rkpd_kode ?: null,
                        'bidang_urusan_rkpd_kode' => $bidang_rkpd_kode ?: null,
                        'program_rkpd_kode' => $program_rkpd_kode ?: null,
                        'program_rkpd_text' => $program_rkpd_text ?: null,
                        'pagu_program_rkpd' => $pagu_program_rkpd,
                        'selisih' => $selisih,
                        'keterangan' => $keterangan,
                        'tahun' => $tahun,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                    // Hanya kirim kolom yang ada di tabel
                    $filtered_data = array_intersect_key($header_data, array_flip($columnNames));
                    
                    log_message('debug', 'Data yang akan diinsert: ' . print_r($filtered_data, true));
                    
                    $insert = $this->db->insert('konsistensi_program_header', $filtered_data);
                    
                    if (!$insert) {
                        $error = $this->db->error();
                        log_message('error', 'DB Insert Error: ' . $error['message']);
                        throw new Exception('Gagal menyimpan header: ' . $error['message']);
                    }
                    
                    $header_id = $this->db->insert_id();
                    
                    log_message('debug', 'Header ID: ' . $header_id);
                    
                    if (!$header_id) {
                        throw new Exception('Gagal mendapatkan ID header!');
                    }
                    
                    // ============================================================
                    // CEK TABEL DETAIL
                    // ============================================================
                    $detailTableExists = $this->db->query("SHOW TABLES LIKE 'konsistensi_program_detail'")->num_rows();
                    if ($detailTableExists == 0) {
                        throw new Exception('Tabel konsistensi_program_detail tidak ditemukan!');
                    }
                    
                    // Cek kolom detail
                    $detailColumns = $this->db->query("SHOW COLUMNS FROM konsistensi_program_detail")->result_array();
                    $detailColumnNames = array_column($detailColumns, 'Field');
                    log_message('debug', 'Kolom detail yang ada: ' . print_r($detailColumnNames, true));
                    
                    // ============================================================
                    // INSERT DETAIL RPJMD
                    // ============================================================
                    if (!empty($indikator_rpjmd) && is_array($indikator_rpjmd)) {
                        $urutan = 0;
                        foreach ($indikator_rpjmd as $key => $indikator) {
                            if (empty(trim($indikator))) continue;
                            
                            $detail_data = [
                                'header_id' => $header_id,
                                'jenis' => 'rpjmd',
                                'indikator' => trim($indikator),
                                'target' => isset($target_rpjmd[$key]) ? trim($target_rpjmd[$key]) : null,
                                'satuan' => isset($satuan_rpjmd[$key]) ? trim($satuan_rpjmd[$key]) : null,
                                'urutan' => $urutan++,
                                'created_at' => date('Y-m-d H:i:s')
                            ];
                            
                            $filtered_detail = array_intersect_key($detail_data, array_flip($detailColumnNames));
                            $this->db->insert('konsistensi_program_detail', $filtered_detail);
                            log_message('debug', 'Insert detail RPJMD - affected: ' . $this->db->affected_rows());
                        }
                    }
                    
                    // ============================================================
                    // INSERT DETAIL RKPD
                    // ============================================================
                    if (!empty($indikator_rkpd) && is_array($indikator_rkpd)) {
                        $urutan = 0;
                        foreach ($indikator_rkpd as $key => $indikator) {
                            if (empty(trim($indikator))) continue;
                            
                            $detail_data = [
                                'header_id' => $header_id,
                                'jenis' => 'rkpd',
                                'indikator' => trim($indikator),
                                'target' => isset($target_rkpd[$key]) ? trim($target_rkpd[$key]) : null,
                                'satuan' => isset($satuan_rkpd[$key]) ? trim($satuan_rkpd[$key]) : null,
                                'urutan' => $urutan++,
                                'created_at' => date('Y-m-d H:i:s')
                            ];
                            
                            $filtered_detail = array_intersect_key($detail_data, array_flip($detailColumnNames));
                            $this->db->insert('konsistensi_program_detail', $filtered_detail);
                            log_message('debug', 'Insert detail RKPD - affected: ' . $this->db->affected_rows());
                        }
                    }
                    
                    $this->db->trans_complete();
                    
                    if ($this->db->trans_status() === FALSE) {
                        $error = $this->db->error();
                        log_message('error', 'Transaksi gagal: ' . $error['message']);
                        throw new Exception('Gagal menyimpan data! Error: ' . $error['message']);
                    }
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!',
                        'id' => $header_id
                    ]);
                    
                } catch (Exception $e) {
                    $this->db->trans_rollback();
                    log_message('error', 'InputKonsistensiProgram Exception: ' . $e->getMessage());
                    log_message('error', 'Trace: ' . $e->getTraceAsString());
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                    ]);
                }
            }

            // ============================================================
            // EDIT KONSISTENSI PROGRAM
            // ============================================================
            public function EditKonsistensiProgram() {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            log_message('debug', '=== EditKonsistensiProgram dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                $KodeWilayah = $this->_checkSessionWilayah();
                if (!$KodeWilayah) {
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                // Cek data ada
                $existing = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('konsistensi_program_header')
                    ->row_array();
                
                if (!$existing) {
                    throw new Exception('Data tidak ditemukan!');
                }
                
                // ============================================================
                // AMBIL DATA DARI POST
                // ============================================================
                $urusan_rpjmd_kode = trim($this->input->post('urusan_rpjmd_kode', TRUE) ?: '');
                $bidang_rpjmd_kode = trim($this->input->post('bidang_rpjmd_kode', TRUE) ?: '');
                $program_rpjmd_kode = trim($this->input->post('program_rpjmd_kode', TRUE) ?: '');
                $program_rpjmd_text = trim($this->input->post('program_rpjmd_text', TRUE) ?: '');
                
                $urusan_rkpd_kode = trim($this->input->post('urusan_rkpd_kode', TRUE) ?: '');
                $bidang_rkpd_kode = trim($this->input->post('bidang_rkpd_kode', TRUE) ?: '');
                $program_rkpd_kode = trim($this->input->post('program_rkpd_kode', TRUE) ?: '');
                $program_rkpd_text = trim($this->input->post('program_rkpd_text', TRUE) ?: '');
                
                $pagu_program_rpjmd = $this->formatRupiahToNumber($this->input->post('pagu_program_rpjmd', TRUE));
                $pagu_program_rkpd = $this->formatRupiahToNumber($this->input->post('pagu_program_rkpd', TRUE));
                $selisih = ($pagu_program_rkpd ?? 0) - ($pagu_program_rpjmd ?? 0);
                
                $id_instansi = $this->input->post('id_instansi', TRUE) ?: null;
                $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
                $keterangan = trim($this->input->post('keterangan', TRUE) ?: '');
                
                // ============================================================
                // UPDATE HEADER - FLEKSIBEL
                // ============================================================
                $header_data = [
                    'id_instansi' => $id_instansi,
                    'tahun' => $tahun,
                    'keterangan' => $keterangan,
                    'pagu_program_rpjmd' => $pagu_program_rpjmd,
                    'pagu_program_rkpd' => $pagu_program_rkpd,
                    'selisih' => $selisih,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                // RPJMD - FLEKSIBEL
                if (!empty($program_rpjmd_kode)) {
                    $header_data['program_rpjmd_kode'] = $program_rpjmd_kode;
                    $header_data['program_rpjmd_text'] = null;
                    $header_data['bidang_urusan_rpjmd_kode'] = $bidang_rpjmd_kode ?: null;
                    $header_data['urusan_rpjmd_kode'] = $urusan_rpjmd_kode ?: null;
                } 
                else if (!empty($program_rpjmd_text)) {
                    $header_data['program_rpjmd_text'] = $program_rpjmd_text;
                    $header_data['program_rpjmd_kode'] = null;
                    $header_data['bidang_urusan_rpjmd_kode'] = null;
                    $header_data['urusan_rpjmd_kode'] = null;
                }
                else if (!empty($bidang_rpjmd_kode)) {
                    $header_data['bidang_urusan_rpjmd_kode'] = $bidang_rpjmd_kode;
                    $header_data['program_rpjmd_kode'] = null;
                    $header_data['program_rpjmd_text'] = null;
                    $header_data['urusan_rpjmd_kode'] = $urusan_rpjmd_kode ?: null;
                }
                else if (!empty($urusan_rpjmd_kode)) {
                    $header_data['urusan_rpjmd_kode'] = $urusan_rpjmd_kode;
                    $header_data['bidang_urusan_rpjmd_kode'] = null;
                    $header_data['program_rpjmd_kode'] = null;
                    $header_data['program_rpjmd_text'] = null;
                }
                else {
                    $header_data['urusan_rpjmd_kode'] = null;
                    $header_data['bidang_urusan_rpjmd_kode'] = null;
                    $header_data['program_rpjmd_kode'] = null;
                    $header_data['program_rpjmd_text'] = null;
                }
                
                // RKPD - SAMA
                if (!empty($program_rkpd_kode)) {
                    $header_data['program_rkpd_kode'] = $program_rkpd_kode;
                    $header_data['program_rkpd_text'] = null;
                    $header_data['bidang_urusan_rkpd_kode'] = $bidang_rkpd_kode ?: null;
                    $header_data['urusan_rkpd_kode'] = $urusan_rkpd_kode ?: null;
                } 
                else if (!empty($program_rkpd_text)) {
                    $header_data['program_rkpd_text'] = $program_rkpd_text;
                    $header_data['program_rkpd_kode'] = null;
                    $header_data['bidang_urusan_rkpd_kode'] = null;
                    $header_data['urusan_rkpd_kode'] = null;
                }
                else if (!empty($bidang_rkpd_kode)) {
                    $header_data['bidang_urusan_rkpd_kode'] = $bidang_rkpd_kode;
                    $header_data['program_rkpd_kode'] = null;
                    $header_data['program_rkpd_text'] = null;
                    $header_data['urusan_rkpd_kode'] = $urusan_rkpd_kode ?: null;
                }
                else if (!empty($urusan_rkpd_kode)) {
                    $header_data['urusan_rkpd_kode'] = $urusan_rkpd_kode;
                    $header_data['bidang_urusan_rkpd_kode'] = null;
                    $header_data['program_rkpd_kode'] = null;
                    $header_data['program_rkpd_text'] = null;
                }
                else {
                    $header_data['urusan_rkpd_kode'] = null;
                    $header_data['bidang_urusan_rkpd_kode'] = null;
                    $header_data['program_rkpd_kode'] = null;
                    $header_data['program_rkpd_text'] = null;
                }
                
                // ============================================================
                // UPDATE HEADER
                // ============================================================
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $KodeWilayah);
                $this->db->update('konsistensi_program_header', $header_data);
                
                // ============================================================
                // UPDATE DETAIL
                // ============================================================
                $this->db->where('header_id', $id)->update('konsistensi_program_detail', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                
                // Insert detail RPJMD
                $indikator_rpjmd = $this->input->post('indikator_rpjmd', TRUE);
                $target_rpjmd = $this->input->post('target_rpjmd', TRUE);
                $satuan_rpjmd = $this->input->post('satuan_rpjmd', TRUE);
                
                if (!empty($indikator_rpjmd) && is_array($indikator_rpjmd)) {
                    $urutan = 0;
                    foreach ($indikator_rpjmd as $key => $indikator) {
                        if (empty(trim($indikator))) continue;
                        
                        $this->db->insert('konsistensi_program_detail', [
                            'header_id' => $id,
                            'jenis' => 'rpjmd',
                            'indikator' => trim($indikator),
                            'target' => isset($target_rpjmd[$key]) ? trim($target_rpjmd[$key]) : null,
                            'satuan' => isset($satuan_rpjmd[$key]) ? trim($satuan_rpjmd[$key]) : null,
                            'urutan' => $urutan++,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
                
                // Insert detail RKPD
                $indikator_rkpd = $this->input->post('indikator_rkpd', TRUE);
                $target_rkpd = $this->input->post('target_rkpd', TRUE);
                $satuan_rkpd = $this->input->post('satuan_rkpd', TRUE);
                
                if (!empty($indikator_rkpd) && is_array($indikator_rkpd)) {
                    $urutan = 0;
                    foreach ($indikator_rkpd as $key => $indikator) {
                        if (empty(trim($indikator))) continue;
                        
                        $this->db->insert('konsistensi_program_detail', [
                            'header_id' => $id,
                            'jenis' => 'rkpd',
                            'indikator' => trim($indikator),
                            'target' => isset($target_rkpd[$key]) ? trim($target_rkpd[$key]) : null,
                            'satuan' => isset($satuan_rkpd[$key]) ? trim($satuan_rkpd[$key]) : null,
                            'urutan' => $urutan++,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
                
                // ============================================================
                // ✅ AMBIL DATA TERBARU LENGKAP DENGAN DETAIL
                // ============================================================
                $updatedData = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('konsistensi_program_header')
                    ->row_array();
                
                // Ambil detail RPJMD
                $updatedData['rpjmd_details'] = $this->db
                    ->where('header_id', $id)
                    ->where('jenis', 'rpjmd')
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get('konsistensi_program_detail')
                    ->result_array();
                
                // Ambil detail RKPD
                $updatedData['rkpd_details'] = $this->db
                    ->where('header_id', $id)
                    ->where('jenis', 'rkpd')
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get('konsistensi_program_detail')
                    ->result_array();
                
                // Ambil nama instansi
                if ($updatedData['id_instansi']) {
                    $instansi = $this->db
                        ->select('nama')
                        ->where('id', $updatedData['id_instansi'])
                        ->get('akun_instansi')
                        ->row_array();
                    $updatedData['instansi_nama'] = $instansi ? $instansi['nama'] : '';
                } else {
                    $updatedData['instansi_nama'] = '';
                }
                
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil diupdate!',
                    'data' => $updatedData
                ]);
                
            } catch (Exception $e) {
                $this->db->trans_rollback();
                log_message('error', 'EditKonsistensiProgram Exception: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

            // ============================================================
            // HAPUS KONSISTENSI PROGRAM
            // ============================================================
            
            public function HapusKonsistensiProgram() {
                if (!$this->input->is_ajax_request()) {
                    show_404();
                    return;
                }
                
                header('Content-Type: application/json');
                
                try {
                    $KodeWilayah = $this->_checkSessionWilayah();
                    if (!$KodeWilayah) {
                        return;
                    }
                    
                    $id = (int)$this->input->post('id', TRUE);
                    
                    if ($id <= 0) {
                        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                        return;
                    }
                    
                    // Cek data ada
                    $existing = $this->db
                        ->where('id', $id)
                        ->where('kode_wilayah', $KodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('konsistensi_program_header')
                        ->row_array();
                    
                    if (!$existing) {
                        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                        return;
                    }
                    
                    // Soft delete header
                    $this->db->where('id', $id);
                    $this->db->where('kode_wilayah', $KodeWilayah);
                    $this->db->update('konsistensi_program_header', [
                        'deleted_at' => date('Y-m-d H:i:s')
                    ]);
                    
                    // Soft delete detail
                    $this->db->where('header_id', $id);
                    $this->db->update('konsistensi_program_detail', [
                        'deleted_at' => date('Y-m-d H:i:s')
                    ]);
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil dihapus!'
                    ]);
                    
                } catch (Exception $e) {
                    log_message('error', 'HapusKonsistensiProgram Exception: ' . $e->getMessage());
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                    ]);
                }
            }

    public function getIndikatorProgramPD() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        try {
            $kodeWilayah = $this->_getKodeWilayah();
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $kodeProgram = trim($this->input->post('kode_program', TRUE));
            $tahun = (int)$this->input->post('tahun', TRUE);
            
            if (empty($kodeProgram)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Program tidak valid!']);
                return;
            }
            
            // Validasi tahun (2026-2030)
            $validYears = [2026, 2027, 2028, 2029, 2030];
            if (!in_array($tahun, $validYears)) {
                $tahun = 2026; // Default ke 2026
            }
            
            // Cari program berdasarkan kode_program
            $program = $this->db
                ->select('p.*, b.nama_bidang, b.kode_bidang, u.nama_urusan, u.kode_urusan')
                ->from('program_data p')
                ->join('program_bidang_urusan b', 'b.id = p.bidang_urusan_id', 'left')
                ->join('program_urusan u', 'u.id = b.urusan_id', 'left')
                ->where('p.kode_wilayah', $kodeWilayah)
                ->where('p.kode_program', $kodeProgram)
                ->where('p.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if (!$program) {
                // Coba cari berdasarkan kode_program dengan format yang berbeda
                $program = $this->db
                    ->select('p.*, b.nama_bidang, b.kode_bidang, u.nama_urusan, u.kode_urusan')
                    ->from('program_data p')
                    ->join('program_bidang_urusan b', 'b.id = p.bidang_urusan_id', 'left')
                    ->join('program_urusan u', 'u.id = b.urusan_id', 'left')
                    ->where('p.kode_wilayah', $kodeWilayah)
                    ->where('p.nama_program LIKE', '%' . $kodeProgram . '%')
                    ->where('p.deleted_at IS NULL')
                    ->get()
                    ->row_array();
            }
            
            if (!$program) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Program tidak ditemukan!'
                ]);
                return;
            }
            
            // Ambil indikator dari program_indikator
            $targetField = 'target_' . $tahun;
            $paguField = 'pagu_' . $tahun;
            
            // Cek apakah kolom target tahun ada
            $columns = $this->db->query("SHOW COLUMNS FROM program_indikator LIKE 'target_" . $tahun . "'")->num_rows();
            
            $indikator = $this->db
                ->select('id, indikator, satuan, kondisi_awal, ' . $targetField . ' as target, ' . $paguField . ' as pagu')
                ->where('program_id', $program['id'])
                ->where('kode_wilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->order_by('id', 'ASC')
                ->get('program_indikator')
                ->result_array();
            
            // Jika kolom tidak ada, coba dengan cara lain
            if ($columns == 0) {
                // Fallback: ambil semua data dan filter di PHP
                $allIndikator = $this->db
                    ->select('*')
                    ->where('program_id', $program['id'])
                    ->where('kode_wilayah', $kodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get('program_indikator')
                    ->result_array();
                
                $indikator = [];
                foreach ($allIndikator as $row) {
                    $indikator[] = [
                        'id' => $row['id'],
                        'indikator' => $row['indikator'],
                        'satuan' => $row['satuan'],
                        'kondisi_awal' => $row['kondisi_awal'],
                        'target' => $row['target_' . $tahun] ?? '',
                        'pagu' => $row['pagu_' . $tahun] ?? null
                    ];
                }
            }
            
            // Format pagu
            foreach ($indikator as &$item) {
                if (!empty($item['pagu']) && is_numeric($item['pagu'])) {
                    $item['pagu_formatted'] = 'Rp ' . number_format((float)$item['pagu'], 0, ',', '.');
                } else {
                    $item['pagu_formatted'] = '';
                }
            }
            
            echo json_encode([
                'status' => 'success',
                'data' => [
                    'program' => $program,
                    'indikator' => $indikator,
                    'tahun' => $tahun
                ]
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'getIndikatorProgramPD: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get data program PD berdasarkan kode untuk dropdown
     */
    public function getProgramPDByKode() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        try {
            $kodeWilayah = $this->_getKodeWilayah();
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $kodeProgram = trim($this->input->post('kode_program', TRUE));
            
            if (empty($kodeProgram)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Program tidak valid!']);
                return;
            }
            
            // Cari program
            $program = $this->db
                ->select('p.*, b.nama_bidang, b.kode_bidang, u.nama_urusan, u.kode_urusan')
                ->from('program_data p')
                ->join('program_bidang_urusan b', 'b.id = p.bidang_urusan_id', 'left')
                ->join('program_urusan u', 'u.id = b.urusan_id', 'left')
                ->where('p.kode_wilayah', $kodeWilayah)
                ->where('p.kode_program', $kodeProgram)
                ->where('p.deleted_at IS NULL')
                ->get()
                ->row_array();
            
            if ($program) {
                echo json_encode([
                    'status' => 'success',
                    'data' => $program
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Program tidak ditemukan!'
                ]);
            }
            
        } catch (Exception $e) {
            log_message('error', 'getProgramPDByKode: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    public function GetKonsistensiProgramById() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->_checkSessionWilayah();
            if (!$KodeWilayah) {
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // ============================================================
            // AMBIL HEADER
            // ============================================================
            $header = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('konsistensi_program_header')
                ->row_array();
            
            if (!$header) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                return;
            }
            
            // ============================================================
            // AMBIL NAMA DARI NOMENKLATUR
            // ============================================================
            $header['urusan_rpjmd_nama'] = $this->getNomenklaturName($header['urusan_rpjmd_kode'] ?? '');
            $header['bidang_rpjmd_nama'] = $this->getNomenklaturName($header['bidang_urusan_rpjmd_kode'] ?? '');
            $header['program_rpjmd_nama'] = $header['program_rpjmd_text'] ?? $this->getNomenklaturName($header['program_rpjmd_kode'] ?? '');
            
            $header['urusan_rkpd_nama'] = $this->getNomenklaturName($header['urusan_rkpd_kode'] ?? '');
            $header['bidang_rkpd_nama'] = $this->getNomenklaturName($header['bidang_urusan_rkpd_kode'] ?? '');
            $header['program_rkpd_nama'] = $header['program_rkpd_text'] ?? $this->getNomenklaturName($header['program_rkpd_kode'] ?? '');
            
            // ============================================================
            // PASTIKAN KODE DAN TEXT TERKIRIM
            // ============================================================
            $header['urusan_rpjmd_kode'] = $header['urusan_rpjmd_kode'] ?? '';
            $header['bidang_urusan_rpjmd_kode'] = $header['bidang_urusan_rpjmd_kode'] ?? '';
            $header['program_rpjmd_kode'] = $header['program_rpjmd_kode'] ?? '';
            $header['program_rpjmd_text'] = $header['program_rpjmd_text'] ?? '';
            
            $header['urusan_rkpd_kode'] = $header['urusan_rkpd_kode'] ?? '';
            $header['bidang_urusan_rkpd_kode'] = $header['bidang_urusan_rkpd_kode'] ?? '';
            $header['program_rkpd_kode'] = $header['program_rkpd_kode'] ?? '';
            $header['program_rkpd_text'] = $header['program_rkpd_text'] ?? '';
            
            // ============================================================
            // AMBIL DETAIL INDIKATOR
            // ============================================================
            $header['rpjmd_details'] = $this->db
                ->where('header_id', $id)
                ->where('jenis', 'rpjmd')
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->order_by('id', 'ASC')
                ->get('konsistensi_program_detail')
                ->result_array();
            
            $header['rkpd_details'] = $this->db
                ->where('header_id', $id)
                ->where('jenis', 'rkpd')
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->order_by('id', 'ASC')
                ->get('konsistensi_program_detail')
                ->result_array();
            
            // ============================================================
            // ✅ HAPUS BAGIAN YANG MEMERIKSA PROGRAM PD (menyebabkan error)
            // ============================================================
            // Karena kolom 'target' tidak ada di program_indikator,
            // kita hapus bagian pengecekan is_from_program_pd
            
            // ============================================================
            // KIRIM RESPONSE
            // ============================================================
            echo json_encode([
                'status' => 'success',
                'data' => $header
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'GetKonsistensiProgramById Exception: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }


        // ============================================================
        // KONSISTENSI TUJUAN DAN SASARAN
        // ============================================================
        public function KonsistensiTujuan() {
            $Header['Halaman'] = 'Konsistensi Tujuan dan Sasaran';
            
            $KodeWilayah = $this->_getKodeWilayah();
            $tahun = $this->input->get('tahun', TRUE) ?: date('Y');
            
            // Data untuk filter
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();
            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['TahunAktif'] = $tahun;
            
            // Ambil Nama Wilayah
            $Data['NamaWilayah'] = '';
            if ($KodeWilayah) {
                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
            }
            
            // ============================================================
            // AMBIL DATA TUJUAN RPJMD UNTUK DROPDOWN
            // ============================================================
            $Data['ListTujuan'] = [];
            $Data['ListSasaran'] = [];
            
            if ($KodeWilayah) {
                // Tujuan RPJMD
                $Data['ListTujuan'] = $this->db
                    ->select('t.Id, t.Tujuan, t.TahunMulai, t.TahunAkhir')
                    ->from('tujuanrpjmd t')
                    ->join('misirpjmd m', 'm.Id = t._Id AND m.KodeWilayah = t.KodeWilayah', 'inner')
                    ->join('visirpjmd v', 'v.Id = m._Id AND v.KodeWilayah = m.KodeWilayah', 'inner')
                    ->where('t.KodeWilayah', $KodeWilayah)
                    ->where('t.deleted_at IS NULL')
                    ->where('m.deleted_at IS NULL')
                    ->where('v.deleted_at IS NULL')
                    ->order_by('t.Id', 'ASC')
                    ->get()
                    ->result_array();
                
                // Sasaran RPJMD
                $Data['ListSasaran'] = $this->db
                    ->select('s.Id, s.Sasaran, s._Id as TujuanId, t.Tujuan as TujuanParent')
                    ->from('sasaranrpjmd s')
                    ->join('tujuanrpjmd t', 't.Id = s._Id AND t.KodeWilayah = s.KodeWilayah', 'inner')
                    ->where('s.KodeWilayah', $KodeWilayah)
                    ->where('s.deleted_at IS NULL')
                    ->where('t.deleted_at IS NULL')
                    ->order_by('t.Id', 'ASC')
                    ->order_by('s.Id', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            // ============================================================
            // AMBIL DATA KONSISTENSI - DENGAN INFORMASI PARENT
            // ============================================================
            $Data['KonsistensiData'] = [];
            
            if ($KodeWilayah) {
                // Ambil SEMUA data header (Tujuan dan Sasaran)
                $headers = $this->db
                    ->select('h.*, a.nama as instansi_nama')
                    ->from('konsistensi_tujuan_header h')
                    ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
                    ->where('h.kode_wilayah', $KodeWilayah)
                    ->where('h.tahun', $tahun)
                    ->where('h.deleted_at IS NULL')
                    ->order_by('h.id', 'ASC')
                    ->get()
                    ->result_array();
                
                // Ambil detail indikator untuk setiap header
                foreach ($headers as &$header) {
                    $header['rpjmd_details'] = $this->db
                        ->where('header_id', $header['id'])
                        ->where('jenis', 'rpjmd')
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->get('konsistensi_tujuan_detail')
                        ->result_array();
                    
                    $header['rkpd_details'] = $this->db
                        ->where('header_id', $header['id'])
                        ->where('jenis', 'rkpd')
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->get('konsistensi_tujuan_detail')
                        ->result_array();
                }
                
                $Data['KonsistensiData'] = $headers;
            }
            
            // Instansi untuk dropdown
            $Data['ListInstansi'] = [];
            if ($KodeWilayah) {
                $Data['ListInstansi'] = $this->db
                    ->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/KonsistensiTujuan', $Data);
        }

        // ============================================================
        // INPUT TUJUAN (Level 1) - DENGAN ID RPJMD YANG BENAR
        // ============================================================
        public function InputTujuanKonsistensi() {
            // Aktifkan error reporting
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Log untuk debugging
            log_message('debug', '=== InputTujuanKonsistensi dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                $KodeWilayah = $this->_checkSessionWilayah();
                if (!$KodeWilayah) {
                    return;
                }
                
                // ============================================================
                // AMBIL DATA DARI POST
                // ============================================================
                $idRpjmd = (int)$this->input->post('id_rpjmd', TRUE);
                $rpjmdText = trim($this->input->post('rpjmd_text', TRUE));
                $rkpdText = trim($this->input->post('rkpd_text', TRUE));
                $idInstansi = $this->input->post('id_instansi', TRUE) ?: null;
                $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
                $keterangan = trim($this->input->post('keterangan', TRUE));
                
                // Ambil indikator dari POST
                $indikatorRpjmd = $this->input->post('indikator_rpjmd', TRUE);
                $satuanRpjmd = $this->input->post('satuan_rpjmd', TRUE);
                $targetRpjmd = $this->input->post('target_rpjmd', TRUE);
                
                $indikatorRkpd = $this->input->post('indikator_rkpd', TRUE);
                $satuanRkpd = $this->input->post('satuan_rkpd', TRUE);
                $targetRkpd = $this->input->post('target_rkpd', TRUE);
                
                log_message('debug', 'id_rpjmd: ' . $idRpjmd);
                log_message('debug', 'rpjmd_text: ' . $rpjmdText);
                log_message('debug', 'rkpd_text: ' . $rkpdText);
                
                // ============================================================
                // PROSES RPJMD
                // ============================================================
                if ($idRpjmd > 0) {
                    $rpjmdData = $this->db->where('Id', $idRpjmd)->get('tujuanrpjmd')->row_array();
                    if (!$rpjmdData) {
                        throw new Exception('Tujuan RPJMD tidak ditemukan!');
                    }
                    $rpjmdText = $rpjmdData['Tujuan'];
                    $tujuanRpjmdId = $idRpjmd;
                } elseif (empty($rpjmdText)) {
                    throw new Exception('Tujuan RPJMD harus diisi!');
                } else {
                    // Jika manual, cek apakah ada di database
                    $existingRpjmd = $this->db
                        ->where('Tujuan', $rpjmdText)
                        ->where('KodeWilayah', $KodeWilayah)
                        ->where('deleted_at IS NULL')
                        ->get('tujuanrpjmd')
                        ->row_array();
                    
                    if ($existingRpjmd) {
                        $tujuanRpjmdId = $existingRpjmd['Id'];
                    } else {
                        $tujuanRpjmdId = null;
                    }
                }
                
                if (empty($rkpdText)) {
                    throw new Exception('Tujuan RKPD harus diisi!');
                }
                
                // ============================================================
                // INSERT HEADER - TUJUAN (Level 1)
                // ============================================================
                $headerData = [
                    'kode_wilayah' => $KodeWilayah,
                    'id_instansi' => $idInstansi,
                    'tahun' => $tahun,
                    'level' => 1, // TUJUAN
                    'tujuan_rpjmd_id' => $tujuanRpjmdId ?? null,
                    'tujuan_rpjmd_text' => $rpjmdText,
                    'tujuan_rkpd_text' => $rkpdText,
                    'keterangan' => $keterangan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                log_message('debug', 'Header data: ' . print_r($headerData, true));
                
                $this->db->insert('konsistensi_tujuan_header', $headerData);
                $headerId = $this->db->insert_id();
                
                if (!$headerId) {
                    throw new Exception('Gagal menyimpan header!');
                }
                
                // ============================================================
                // INSERT INDIKATOR RPJMD
                // ============================================================
                if (!empty($indikatorRpjmd) && is_array($indikatorRpjmd)) {
                    $urutan = 0;
                    foreach ($indikatorRpjmd as $key => $indikator) {
                        if (empty(trim($indikator))) continue;
                        
                        $detailData = [
                            'header_id' => $headerId,
                            'jenis' => 'rpjmd',
                            'indikator' => trim($indikator),
                            'satuan' => isset($satuanRpjmd[$key]) ? trim($satuanRpjmd[$key]) : null,
                            'target' => isset($targetRpjmd[$key]) ? trim($targetRpjmd[$key]) : null,
                            'urutan' => $urutan++,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        
                        $this->db->insert('konsistensi_tujuan_detail', $detailData);
                    }
                }
                
                // ============================================================
                // INSERT INDIKATOR RKPD
                // ============================================================
                if (!empty($indikatorRkpd) && is_array($indikatorRkpd)) {
                    $urutan = 0;
                    foreach ($indikatorRkpd as $key => $indikator) {
                        if (empty(trim($indikator))) continue;
                        
                        $detailData = [
                            'header_id' => $headerId,
                            'jenis' => 'rkpd',
                            'indikator' => trim($indikator),
                            'satuan' => isset($satuanRkpd[$key]) ? trim($satuanRkpd[$key]) : null,
                            'target' => isset($targetRkpd[$key]) ? trim($targetRkpd[$key]) : null,
                            'urutan' => $urutan++,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        
                        $this->db->insert('konsistensi_tujuan_detail', $detailData);
                    }
                }
                
                // ============================================================
                // RESPONSE SUKSES
                // ============================================================
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Tujuan berhasil ditambahkan!',
                    'id' => $headerId,
                    'tujuan_rpjmd_id' => $tujuanRpjmdId
                ]);
                
            } catch (Exception $e) {
                log_message('error', 'InputTujuanKonsistensi Exception: ' . $e->getMessage());
                log_message('error', 'Trace: ' . $e->getTraceAsString());
                
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        // ============================================================
        // INPUT SASARAN (Level 2) - DENGAN PARENT TUJUAN YANG BENAR
        // ============================================================
        public function InputSasaranKonsistensi() {
            // Aktifkan error reporting
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Log untuk debugging
            log_message('debug', '=== InputSasaranKonsistensi dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                $KodeWilayah = $this->_checkSessionWilayah();
                if (!$KodeWilayah) {
                    return;
                }
                
                // ============================================================
                // AMBIL DATA DARI POST
                // ============================================================
                $parentTujuanId = (int)$this->input->post('parent_tujuan_id', TRUE);
                $idRpjmd = (int)$this->input->post('id_rpjmd', TRUE);
                $rpjmdText = trim($this->input->post('rpjmd_text', TRUE));
                $rkpdText = trim($this->input->post('rkpd_text', TRUE));
                $idInstansi = $this->input->post('id_instansi', TRUE) ?: null;
                $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
                $keterangan = trim($this->input->post('keterangan', TRUE));
                
                // Ambil indikator dari POST
                $indikatorRpjmd = $this->input->post('indikator_rpjmd', TRUE);
                $satuanRpjmd = $this->input->post('satuan_rpjmd', TRUE);
                $targetRpjmd = $this->input->post('target_rpjmd', TRUE);
                
                $indikatorRkpd = $this->input->post('indikator_rkpd', TRUE);
                $satuanRkpd = $this->input->post('satuan_rkpd', TRUE);
                $targetRkpd = $this->input->post('target_rkpd', TRUE);
                
                log_message('debug', 'parent_tujuan_id: ' . $parentTujuanId);
                log_message('debug', 'id_rpjmd: ' . $idRpjmd);
                log_message('debug', 'rpjmd_text: ' . $rpjmdText);
                log_message('debug', 'rkpd_text: ' . $rkpdText);
                
                // ============================================================
                // VALIDASI
                // ============================================================
                if ($parentTujuanId <= 0) {
                    throw new Exception('Tujuan induk tidak valid!');
                }
                
                // ============================================================
                // CEK APAKAH TUJUAN INDUK ADA DI TABEL konsistensi_tujuan_header
                // ============================================================
                $parentExists = $this->db
                    ->where('id', $parentTujuanId)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('level', 1)  // Hanya Tujuan (level 1)
                    ->where('deleted_at IS NULL')
                    ->get('konsistensi_tujuan_header')
                    ->row_array();
                
                if (!$parentExists) {
                    throw new Exception('Tujuan induk tidak ditemukan! Pastikan Tujuan dengan ID ' . $parentTujuanId . ' sudah ada.');
                }
                
                // ============================================================
                // AMBIL ID TUJUAN RPJMD DARI PARENT
                // ============================================================
                $tujuanRpjmdId = $parentExists['tujuan_rpjmd_id'];
                
                if (empty($tujuanRpjmdId)) {
                    throw new Exception('Tujuan RPJMD induk tidak memiliki ID yang valid!');
                }
                
                log_message('debug', 'tujuanRpjmdId dari parent: ' . $tujuanRpjmdId);
                
                // ============================================================
                // PROSES RPJMD
                // ============================================================
                if ($idRpjmd > 0) {
                    $rpjmdData = $this->db->where('Id', $idRpjmd)->get('sasaranrpjmd')->row_array();
                    if (!$rpjmdData) {
                        throw new Exception('Sasaran RPJMD tidak ditemukan!');
                    }
                    $rpjmdText = $rpjmdData['Sasaran'];
                } elseif (empty($rpjmdText)) {
                    throw new Exception('Sasaran RPJMD harus diisi!');
                }
                
                if (empty($rkpdText)) {
                    throw new Exception('Sasaran RKPD harus diisi!');
                }
                
                // ============================================================
                // CEK DUPLIKAT - Apakah sasaran dengan teks yang sama sudah ada?
                // ============================================================
                $duplicateCheck = $this->db
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('tahun', $tahun)
                    ->where('sasaran_rpjmd_text', $rpjmdText)
                    ->where('deleted_at IS NULL')
                    ->get('konsistensi_tujuan_header')
                    ->num_rows();
                
                if ($duplicateCheck > 0) {
                    // Tidak di-throw, hanya peringatan - bisa di-comment jika tidak diinginkan
                    log_message('debug', 'Sasaran dengan teks yang sama sudah ada: ' . $rpjmdText);
                }
                
                // ============================================================
                // INSERT HEADER - SASARAN DENGAN PARENT TUJUAN
                // ============================================================
                $headerData = [
                    'kode_wilayah' => $KodeWilayah,
                    'id_instansi' => $idInstansi,
                    'tahun' => $tahun,
                    'level' => 2,  // SASARAN
                    'parent_tujuan_id' => $parentTujuanId, // SIMPAN ID PARENT DI TABEL
                    'tujuan_rpjmd_id' => $tujuanRpjmdId, // ID Tujuan RPJMD dari parent
                    'sasaran_rpjmd_id' => $idRpjmd > 0 ? $idRpjmd : null,
                    'sasaran_rpjmd_text' => $rpjmdText,
                    'sasaran_rkpd_text' => $rkpdText,
                    'keterangan' => $keterangan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                log_message('debug', 'Header data yang akan diinsert: ' . print_r($headerData, true));
                
                // Cek apakah kolom parent_tujuan_id ada di tabel
                $columns = $this->db->query("SHOW COLUMNS FROM konsistensi_tujuan_header LIKE 'parent_tujuan_id'")->num_rows();
                if ($columns == 0) {
                    // Jika kolom tidak ada, hapus dari array
                    unset($headerData['parent_tujuan_id']);
                    log_message('debug', 'Kolom parent_tujuan_id tidak ada, dihapus dari data insert');
                }
                
                $this->db->insert('konsistensi_tujuan_header', $headerData);
                $headerId = $this->db->insert_id();
                
                if (!$headerId) {
                    $error = $this->db->error();
                    log_message('error', 'Gagal insert header: ' . $error['message']);
                    throw new Exception('Gagal menyimpan header: ' . $error['message']);
                }
                
                log_message('debug', 'Header berhasil diinsert dengan ID: ' . $headerId);
                
                // ============================================================
                // INSERT INDIKATOR RPJMD
                // ============================================================
                if (!empty($indikatorRpjmd) && is_array($indikatorRpjmd)) {
                    $urutan = 0;
                    foreach ($indikatorRpjmd as $key => $indikator) {
                        if (empty(trim($indikator))) continue;
                        
                        $detailData = [
                            'header_id' => $headerId,
                            'jenis' => 'rpjmd',
                            'indikator' => trim($indikator),
                            'satuan' => isset($satuanRpjmd[$key]) ? trim($satuanRpjmd[$key]) : null,
                            'target' => isset($targetRpjmd[$key]) ? trim($targetRpjmd[$key]) : null,
                            'urutan' => $urutan++,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        
                        $this->db->insert('konsistensi_tujuan_detail', $detailData);
                        log_message('debug', 'Insert detail RPJMD - affected: ' . $this->db->affected_rows());
                    }
                }
                
                // ============================================================
                // INSERT INDIKATOR RKPD
                // ============================================================
                if (!empty($indikatorRkpd) && is_array($indikatorRkpd)) {
                    $urutan = 0;
                    foreach ($indikatorRkpd as $key => $indikator) {
                        if (empty(trim($indikator))) continue;
                        
                        $detailData = [
                            'header_id' => $headerId,
                            'jenis' => 'rkpd',
                            'indikator' => trim($indikator),
                            'satuan' => isset($satuanRkpd[$key]) ? trim($satuanRkpd[$key]) : null,
                            'target' => isset($targetRkpd[$key]) ? trim($targetRkpd[$key]) : null,
                            'urutan' => $urutan++,
                            'created_at' => date('Y-m-d H:i:s')
                        ];
                        
                        $this->db->insert('konsistensi_tujuan_detail', $detailData);
                        log_message('debug', 'Insert detail RKPD - affected: ' . $this->db->affected_rows());
                    }
                }
                
                // ============================================================
                // RESPONSE SUKSES
                // ============================================================
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Sasaran berhasil ditambahkan!',
                    'id' => $headerId,
                    'parent_tujuan_id' => $parentTujuanId
                ]);
                
            } catch (Exception $e) {
                log_message('error', 'InputSasaranKonsistensi Exception: ' . $e->getMessage());
                log_message('error', 'Trace: ' . $e->getTraceAsString());
                
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        // ============================================================
        // GET DATA BY ID (UNTUK EDIT) - DENGAN RPJMD_ID
        // ============================================================
        public function GetKonsistensiTujuanById() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->_getKodeWilayah();
            
            if ($id <= 0 || empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            $header = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('konsistensi_tujuan_header')
                ->row_array();
            
            if (!$header) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
                return;
            }
            
            // Ambil detail indikator
            $header['rpjmd_details'] = $this->db
                ->where('header_id', $id)
                ->where('jenis', 'rpjmd')
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->get('konsistensi_tujuan_detail')
                ->result_array();
            
            $header['rkpd_details'] = $this->db
                ->where('header_id', $id)
                ->where('jenis', 'rkpd')
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->get('konsistensi_tujuan_detail')
                ->result_array();
            
            // Ambil nama RPJMD
            if ($header['level'] == 1 && $header['tujuan_rpjmd_id']) {
                $tujuan = $this->db->where('Id', $header['tujuan_rpjmd_id'])->get('tujuanrpjmd')->row_array();
                $header['rpjmd_text'] = $tujuan ? $tujuan['Tujuan'] : $header['tujuan_rpjmd_text'];
                $header['rpjmd_id'] = $header['tujuan_rpjmd_id']; // TAMBAHKAN INI
            } elseif ($header['level'] == 2 && $header['sasaran_rpjmd_id']) {
                $sasaran = $this->db->where('Id', $header['sasaran_rpjmd_id'])->get('sasaranrpjmd')->row_array();
                $header['rpjmd_text'] = $sasaran ? $sasaran['Sasaran'] : $header['sasaran_rpjmd_text'];
                $header['rpjmd_id'] = $header['sasaran_rpjmd_id']; // TAMBAHKAN INI
            } else {
                $header['rpjmd_text'] = $header['level'] == 1 ? $header['tujuan_rpjmd_text'] : $header['sasaran_rpjmd_text'];
                $header['rpjmd_id'] = null;
            }
            
            $header['rkpd_text'] = $header['level'] == 1 ? $header['tujuan_rkpd_text'] : $header['sasaran_rkpd_text'];
            
            echo json_encode(['status' => 'success', 'data' => $header]);
        }


        // ============================================================
        // UPDATE KONSISTENSI - DENGAN INDIKATOR DINAMIS
        // ============================================================
        public function UpdateKonsistensiTujuan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                $KodeWilayah = $this->_checkSessionWilayah();
                if (!$KodeWilayah) return;
                
                $id = (int)$this->input->post('id', TRUE);
                if ($id <= 0) {
                    throw new Exception('ID tidak valid!');
                }
                
                $existing = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('konsistensi_tujuan_header')
                    ->row_array();
                
                if (!$existing) {
                    throw new Exception('Data tidak ditemukan!');
                }
                
                $level = $existing['level'];
                $rpjmdText = trim($this->input->post('rpjmd_text', TRUE));
                $rkpdText = trim($this->input->post('rkpd_text', TRUE));
                $idRpjmd = (int)$this->input->post('id_rpjmd', TRUE);
                $idInstansi = $this->input->post('id_instansi', TRUE) ?: null;
                $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
                $keterangan = trim($this->input->post('keterangan', TRUE));
                
                // Jika ada ID RPJMD, ambil dari database
                if ($idRpjmd > 0) {
                    if ($level == 1) {
                        $rpjmdData = $this->db->where('Id', $idRpjmd)->get('tujuanrpjmd')->row_array();
                        if ($rpjmdData) {
                            $rpjmdText = $rpjmdData['Tujuan'];
                        }
                    } else {
                        $rpjmdData = $this->db->where('Id', $idRpjmd)->get('sasaranrpjmd')->row_array();
                        if ($rpjmdData) {
                            $rpjmdText = $rpjmdData['Sasaran'];
                        }
                    }
                }
                
                if (empty($rpjmdText)) {
                    throw new Exception('Tujuan/Sasaran RPJMD harus diisi!');
                }
                if (empty($rkpdText)) {
                    throw new Exception('Tujuan/Sasaran RKPD harus diisi!');
                }
                
                $updateData = [
                    'id_instansi' => $idInstansi,
                    'tahun' => $tahun,
                    'keterangan' => $keterangan,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                // Update berdasarkan level
                if ($level == 1) {
                    $updateData['tujuan_rpjmd_text'] = $rpjmdText;
                    $updateData['tujuan_rkpd_text'] = $rkpdText;
                    $updateData['tujuan_rpjmd_id'] = $idRpjmd > 0 ? $idRpjmd : null;
                    $updateData['sasaran_rpjmd_id'] = null;
                } else {
                    $updateData['sasaran_rpjmd_text'] = $rpjmdText;
                    $updateData['sasaran_rkpd_text'] = $rkpdText;
                    $updateData['sasaran_rpjmd_id'] = $idRpjmd > 0 ? $idRpjmd : null;
                    $updateData['tujuan_rpjmd_id'] = $existing['tujuan_rpjmd_id'];
                }
                
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $KodeWilayah);
                $this->db->update('konsistensi_tujuan_header', $updateData);
                
                // ============================================================
                // SOFT DELETE DETAIL LAMA
                // ============================================================
                $this->db->where('header_id', $id)->update('konsistensi_tujuan_detail', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                
                // ============================================================
                // INSERT DETAIL RPJMD - SEMUA INDIKATOR
                // ============================================================
                $indikatorRpjmd = $this->input->post('indikator_rpjmd', TRUE);
                $satuanRpjmd = $this->input->post('satuan_rpjmd', TRUE);
                $targetRpjmd = $this->input->post('target_rpjmd', TRUE);
                
                if (!empty($indikatorRpjmd) && is_array($indikatorRpjmd)) {
                    $urutan = 0;
                    foreach ($indikatorRpjmd as $key => $indikator) {
                        if (empty(trim($indikator))) continue;
                        
                        $this->db->insert('konsistensi_tujuan_detail', [
                            'header_id' => $id,
                            'jenis' => 'rpjmd',
                            'indikator' => trim($indikator),
                            'satuan' => isset($satuanRpjmd[$key]) ? trim($satuanRpjmd[$key]) : null,
                            'target' => isset($targetRpjmd[$key]) ? trim($targetRpjmd[$key]) : null,
                            'urutan' => $urutan++,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
                
                // ============================================================
                // INSERT DETAIL RKPD - SEMUA INDIKATOR
                // ============================================================
                $indikatorRkpd = $this->input->post('indikator_rkpd', TRUE);
                $satuanRkpd = $this->input->post('satuan_rkpd', TRUE);
                $targetRkpd = $this->input->post('target_rkpd', TRUE);
                
                if (!empty($indikatorRkpd) && is_array($indikatorRkpd)) {
                    $urutan = 0;
                    foreach ($indikatorRkpd as $key => $indikator) {
                        if (empty(trim($indikator))) continue;
                        
                        $this->db->insert('konsistensi_tujuan_detail', [
                            'header_id' => $id,
                            'jenis' => 'rkpd',
                            'indikator' => trim($indikator),
                            'satuan' => isset($satuanRkpd[$key]) ? trim($satuanRkpd[$key]) : null,
                            'target' => isset($targetRkpd[$key]) ? trim($targetRkpd[$key]) : null,
                            'urutan' => $urutan++,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
                
                // ============================================================
                // AMBIL DATA TERBARU UNTUK RESPONSE
                // ============================================================
                $updatedData = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('konsistensi_tujuan_header')
                    ->row_array();
                
                $updatedData['rpjmd_details'] = $this->db
                    ->where('header_id', $id)
                    ->where('jenis', 'rpjmd')
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get('konsistensi_tujuan_detail')
                    ->result_array();
                
                $updatedData['rkpd_details'] = $this->db
                    ->where('header_id', $id)
                    ->where('jenis', 'rkpd')
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get('konsistensi_tujuan_detail')
                    ->result_array();
                
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil diupdate!',
                    'data' => $updatedData
                ]);
                
            } catch (Exception $e) {
                log_message('error', 'UpdateKonsistensiTujuan: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => $e->getMessage()
                ]);
            }
        }

        // ============================================================
        // HAPUS KONSISTENSI
        // ============================================================
        public function HapusKonsistensiTujuan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->_getKodeWilayah();
            
            if ($id <= 0 || empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            $this->db->where('id', $id)->where('kode_wilayah', $KodeWilayah)->update('konsistensi_tujuan_header', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            $this->db->where('header_id', $id)->update('konsistensi_tujuan_detail', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        }

        // ============================================================
        // AJAX: GET SASARAN BY TUJUAN (UNTUK DROPDOWN SASARAN)
        // ============================================================
        public function GetSasaranByTujuanKonsistensi() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $tujuanId = (int)$this->input->post('tujuan_id', TRUE);
            $kodeWilayah = $this->_getKodeWilayah();
            
            if ($tujuanId <= 0 || empty($kodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            // Ambil data sasaran berdasarkan tujuan_id dari tabel sasaranrpjmd
            $data = $this->db
                ->select('s.Id, s.Sasaran')
                ->from('sasaranrpjmd s')
                ->where('s._Id', $tujuanId)
                ->where('s.KodeWilayah', $kodeWilayah)
                ->where('s.deleted_at IS NULL')
                ->order_by('s.Id', 'ASC')
                ->get()
                ->result_array();
            
            echo json_encode($data);
        }

        // ================================================================
        // KESELARASAN KESEPAKATAN RAKORTEKBANG
        // ================================================================
        public function KeselarasanRAKORTEKBANG() {
            $Header['Halaman'] = 'Keselarasan Kesepakatan RAKORTEKBANG';
            
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            $Data['KodeWilayah'] = $KodeWilayah;
            
            $Data['NamaWilayah'] = '';
            if ($KodeWilayah) {
                $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
            }
            
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                        ->order_by('Nama')
                                        ->get('kodewilayah')
                                        ->result_array();
            
            $user_level = isset($_SESSION['Level']) ? $_SESSION['Level'] : 0;
            $is_role_3 = ($user_level == 3);
            $is_role_4 = ($user_level == 4);
            
            $Data['KeselarasanData'] = [];
            $tahun = $this->input->get('tahun', TRUE) ?: date('Y');
            $Data['TahunAktif'] = $tahun;
            
            if ($KodeWilayah) {
                // Ambil Header
                $query_header = $this->db->select('h.*')
                    ->from('keselarasan_header h')
                    ->where('h.kode_wilayah', $KodeWilayah)
                    ->where('h.tahun', $tahun)
                    ->where('h.deleted_at IS NULL');
                
                $headers = $query_header->order_by('h.id', 'ASC')
                                    ->get()
                                    ->result_array();
                
                // Ambil Detail dari keselarasan_detail
                foreach ($headers as &$header) {
                    // ============================================================
                    // PERBAIKAN: Pastikan mengambil dari keselarasan_detail
                    // ============================================================
                    $details = $this->db->select('*')
                        ->from('keselarasan_detail')
                        ->where('header_id', $header['id'])
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->order_by('id', 'ASC')
                        ->get()
                        ->result_array();
                    
                    $header['sub_kegiatan'] = $details; // Gunakan nama 'sub_kegiatan' untuk view
                    $header['sub_kegiatan_count'] = count($details);
                }
                
                $Data['KeselarasanData'] = $headers;
            }
            
            $Data['IsRole3'] = $is_role_3;
            $Data['IsRole4'] = $is_role_4;
            $Data['IsLoggedIn'] = $this->is_logged_in();
            $Data['Level'] = $user_level;
            
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/KeselarasanRAKORTEKBANG', $Data);
        }

        // ================================================================
        // GET HEADER HISTORY UNTUK DROPDOWN
        // ================================================================

        /**
         * Get daftar header yang pernah diinput untuk dropdown
         */
        public function GetHeaderHistory() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $kodeWilayah = $this->get_kode_wilayah();
            if (empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih', 'data' => []]);
                return;
            }
            
            $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
            
            // Ambil header yang pernah diinput untuk wilayah dan tahun ini
            $headers = $this->db
                ->select('id, kode_bidang, bidang_urusan, kode_program, program, tahun')
                ->from('keselarasan_header')
                ->where('kode_wilayah', $kodeWilayah)
                ->where('tahun', $tahun)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'DESC')
                ->limit(100)
                ->get()
                ->result_array();
            
            echo json_encode([
                'status' => 'success',
                'data' => $headers
            ]);
        }

        /**
         * Get header detail by ID
         */
        public function GetHeaderDetail() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $kodeWilayah = $this->get_kode_wilayah();
            
            if ($id <= 0 || empty($kodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            $header = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_header')
                ->row_array();
            
            if ($header) {
                // Tambahkan data sub kegiatan jika ada
                $header['sub_kegiatan'] = $this->db
                    ->select('id, kode_sub_kegiatan, sub_kegiatan, indikator_sub_kegiatan, satuan, target_rakortekbang, target_rkpd, keterangan')
                    ->where('header_id', $id)
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->order_by('id', 'ASC')
                    ->get('keselarasan_detail')
                    ->result_array();
                
                echo json_encode([
                    'status' => 'success',
                    'data' => $header
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }

        // ================================================================
        // INPUT HEADER KESELARASAN - HANYA ROLE 3 (DAERAH)
        // ================================================================
        public function InputKeselarasanHeader() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // HANYA ROLE 3 (DAERAH) YANG BISA CRUD
            if (!$this->is_role_3()) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menambah data.']);
                return;
            }
            
            $KodeWilayah = $this->get_kode_wilayah();
            
            if (!$KodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            // Ambil data dari POST - TANPA id_instansi
            $kode_bidang = trim($this->input->post('kode_bidang', TRUE));
            $bidang_urusan = trim($this->input->post('bidang_urusan', TRUE));
            $asta_cita = trim($this->input->post('asta_cita', TRUE));
            $outcome_prioritas = trim($this->input->post('outcome_prioritas', TRUE));
            $kode_program = trim($this->input->post('kode_program', TRUE));
            $program = trim($this->input->post('program', TRUE));
            $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
            
            // Validasi
            if (empty($bidang_urusan)) {
                echo json_encode(['status' => 'error', 'message' => 'Bidang Urusan harus diisi!']);
                return;
            }
            
            if (empty($program)) {
                echo json_encode(['status' => 'error', 'message' => 'Program harus diisi!']);
                return;
            }
            
            $data = [
                'kode_wilayah' => $KodeWilayah,
                'kode_bidang' => $kode_bidang,
                'bidang_urusan' => $bidang_urusan,
                'asta_cita' => $asta_cita,
                'outcome_prioritas' => $outcome_prioritas,
                'kode_program' => $kode_program,
                'program' => $program,
                'tahun' => $tahun,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('keselarasan_header', $data);
            $header_id = $this->db->insert_id();
            
            if ($header_id) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Header berhasil ditambahkan!',
                    'id' => $header_id
                ]);
            } else {
                $error = $this->db->error();
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data: ' . $error['message']
                ]);
            }
        }

        // ================================================================
        // EDIT HEADER KESELARASAN - HANYA ROLE 3 (DAERAH)
        // ================================================================
        public function EditKeselarasanHeader() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // HANYA ROLE 3 (DAERAH) YANG BISA CRUD
            if (!$this->is_role_3()) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat mengedit data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->get_kode_wilayah();
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // Cek data ada
            $existing = $this->db->where('id', $id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_header')
                ->row_array();
            
            if (!$existing) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                return;
            }
            
            // Ambil data dari POST - TANPA id_instansi
            $kode_bidang = trim($this->input->post('kode_bidang', TRUE));
            $bidang_urusan = trim($this->input->post('bidang_urusan', TRUE));
            $asta_cita = trim($this->input->post('asta_cita', TRUE));
            $outcome_prioritas = trim($this->input->post('outcome_prioritas', TRUE));
            $kode_program = trim($this->input->post('kode_program', TRUE));
            $program = trim($this->input->post('program', TRUE));
            $tahun = (int)$this->input->post('tahun', TRUE);
            
            // Validasi
            if (empty($bidang_urusan)) {
                echo json_encode(['status' => 'error', 'message' => 'Bidang Urusan harus diisi!']);
                return;
            }
            
            if (empty($program)) {
                echo json_encode(['status' => 'error', 'message' => 'Program harus diisi!']);
                return;
            }
            
            $data = [
                'kode_bidang' => $kode_bidang,
                'bidang_urusan' => $bidang_urusan,
                'asta_cita' => $asta_cita,
                'outcome_prioritas' => $outcome_prioritas,
                'kode_program' => $kode_program,
                'program' => $program,
                'tahun' => $tahun,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id', $id);
            $this->db->update('keselarasan_header', $data);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Header berhasil diperbarui!'
            ]);
        }

        // ================================================================
        // HAPUS HEADER KESELARASAN - HANYA ROLE 3 (DAERAH)
        // ================================================================
        public function HapusKeselarasanHeader() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // HANYA ROLE 3 (DAERAH) YANG BISA CRUD
            if (!$this->is_role_3()) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menghapus data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->get_kode_wilayah();
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // Cek data ada
            $existing = $this->db->where('id', $id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_header')
                ->row_array();
            
            if (!$existing) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                return;
            }
            
            $now = date('Y-m-d H:i:s');
            
            // Soft delete header
            $this->db->where('id', $id)->update('keselarasan_header', ['deleted_at' => $now]);
            
            // Soft delete semua detail
            $this->db->where('header_id', $id)->update('keselarasan_detail', ['deleted_at' => $now]);
            
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
        }

        // ================================================================
        // GET HEADER KESELARASAN BY ID
        // ================================================================
        public function GetKeselarasanHeader() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->get_kode_wilayah();
            
            if ($id <= 0 || !$KodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            $data = $this->db->where('id', $id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_header')
                ->row_array();
            
            if ($data) {
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }
        // ================================================================
        // PERBAIKAN: INPUT KESELARASAN DETAIL (SUB KEGIATAN)
        // ================================================================
        public function InputKeselarasanDetail() {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            log_message('debug', '=== InputKeselarasanDetail dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                // HANYA ROLE 3 (DAERAH) YANG BISA CRUD
                if (!$this->is_role_3()) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menambah data.'
                    ]);
                    return;
                }
                
                $header_id = (int)$this->input->post('header_id', TRUE);
                $KodeWilayah = $this->get_kode_wilayah();
                
                if ($header_id <= 0) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Header tidak valid!'
                    ]);
                    return;
                }
                
                // Cek header ada
                $header = $this->db
                    ->where('id', $header_id)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_header')
                    ->row_array();
                
                if (!$header) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Header tidak ditemukan!'
                    ]);
                    return;
                }
                
                // AMBIL DATA DARI POST
                $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
                $sub_kegiatan = trim($this->input->post('sub_kegiatan', TRUE));
                $indikator_sub_kegiatan = trim($this->input->post('indikator_sub_kegiatan', TRUE));
                $satuan = trim($this->input->post('satuan', TRUE));
                
                // ============================================================
                // PROSES TARGET DENGAN FORMAT KOMA - PERBAIKAN UTAMA
                // ============================================================
                $target_rakortekbang_raw = $this->input->post('target_rakortekbang', TRUE);
                $target_rkpd_raw = $this->input->post('target_rkpd', TRUE);
                
                log_message('debug', 'Raw target_rakortekbang: ' . $target_rakortekbang_raw);
                log_message('debug', 'Raw target_rkpd: ' . $target_rkpd_raw);
                
                // PARSE TARGET MENGGUNAKAN parseAngkaTarget
                $target_rakortekbang = $this->parseAngkaTarget($target_rakortekbang_raw);
                $target_rkpd = $this->parseAngkaTarget($target_rkpd_raw);
                
                log_message('debug', 'Parsed target_rakortekbang: ' . $target_rakortekbang);
                log_message('debug', 'Parsed target_rkpd: ' . $target_rkpd);
                
                $keterangan = trim($this->input->post('keterangan', TRUE));
                
                // VALIDASI
                if (empty($sub_kegiatan)) {
                    if (!empty($kode_sub_kegiatan) && $kode_sub_kegiatan !== 'manual') {
                        $nomenklatur = $this->db
                            ->select('Nomenklatur')
                            ->where('Kode', $kode_sub_kegiatan)
                            ->get('nomenklaturkabupaten')
                            ->row_array();
                        if ($nomenklatur) {
                            $sub_kegiatan = $nomenklatur['Nomenklatur'];
                        }
                    }
                    
                    if (empty($sub_kegiatan)) {
                        echo json_encode([
                            'status' => 'error', 
                            'message' => 'Sub Kegiatan harus diisi!'
                        ]);
                        return;
                    }
                }
                
                if (empty($indikator_sub_kegiatan)) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Indikator Sub Kegiatan harus diisi!'
                    ]);
                    return;
                }
                
                // Dapatkan urutan terakhir
                $last_urutan = $this->db
                    ->select_max('urutan')
                    ->where('header_id', $header_id)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_detail')
                    ->row()
                    ->urutan;
                
                $urutan = ($last_urutan ? $last_urutan + 10 : 10);
                
                // PREPARE DATA INSERT
                $data = [
                    'header_id' => $header_id,
                    'kode_sub_kegiatan' => $kode_sub_kegiatan ?: null,
                    'sub_kegiatan' => $sub_kegiatan,
                    'indikator_sub_kegiatan' => $indikator_sub_kegiatan,
                    'satuan' => $satuan ?: null,
                    'target_rakortekbang' => $target_rakortekbang,
                    'target_rkpd' => $target_rkpd,
                    'keterangan' => $keterangan ?: null,
                    'urutan' => $urutan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                log_message('debug', 'Data yang akan diinsert: ' . print_r($data, true));
                
                // EKSEKUSI INSERT
                $this->db->insert('keselarasan_detail', $data);
                $detail_id = $this->db->insert_id();
                
                if ($detail_id) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Sub Kegiatan berhasil ditambahkan!',
                        'id' => $detail_id,
                        'target_rakortekbang_display' => $this->displayAngkaTarget($target_rakortekbang),
                        'target_rkpd_display' => $this->displayAngkaTarget($target_rkpd)
                    ]);
                } else {
                    $error = $this->db->error();
                    log_message('error', 'Gagal insert: ' . $error['message']);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data: ' . $error['message']
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'InputKeselarasanDetail Exception: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        // ================================================================
        // EDIT KESELARASAN DETAIL - DENGAN ERROR HANDLING LENGKAP
        // ================================================================
        public function EditKeselarasanDetail() {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            log_message('debug', '=== EditKeselarasanDetail dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                // HANYA ROLE 3 (DAERAH) YANG BISA CRUD
                if (!$this->is_role_3()) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat mengedit data.'
                    ]);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                $KodeWilayah = $this->get_kode_wilayah();
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                if (empty($KodeWilayah)) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                // CEK DATA ADA
                $detail = $this->db
                    ->where('id', $id)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_detail')
                    ->row_array();
                
                if (!$detail) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Data tidak ditemukan!'
                    ]);
                    return;
                }
                
                // CEK HEADER
                $header = $this->db
                    ->where('id', $detail['header_id'])
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_header')
                    ->row_array();
                
                if (!$header) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Header tidak ditemukan!'
                    ]);
                    return;
                }
                
                // AMBIL DATA DARI POST
                $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
                $sub_kegiatan = trim($this->input->post('sub_kegiatan', TRUE));
                $indikator_sub_kegiatan = trim($this->input->post('indikator_sub_kegiatan', TRUE));
                $satuan = trim($this->input->post('satuan', TRUE));
                
                // ============================================================
                // PROSES TARGET DENGAN FORMAT KOMA - PERBAIKAN UTAMA
                // ============================================================
                $target_rakortekbang_raw = $this->input->post('target_rakortekbang', TRUE);
                $target_rkpd_raw = $this->input->post('target_rkpd', TRUE);
                
                log_message('debug', 'Raw target_rakortekbang: ' . $target_rakortekbang_raw);
                log_message('debug', 'Raw target_rkpd: ' . $target_rkpd_raw);
                
                // PARSE TARGET MENGGUNAKAN parseAngkaTarget
                $target_rakortekbang = $this->parseAngkaTarget($target_rakortekbang_raw);
                $target_rkpd = $this->parseAngkaTarget($target_rkpd_raw);
                
                log_message('debug', 'Parsed target_rakortekbang: ' . $target_rakortekbang);
                log_message('debug', 'Parsed target_rkpd: ' . $target_rkpd);
                
                $keterangan = trim($this->input->post('keterangan', TRUE));
                
                // VALIDASI
                if (empty($sub_kegiatan)) {
                    if (!empty($kode_sub_kegiatan) && $kode_sub_kegiatan !== 'manual') {
                        $nomenklatur = $this->db
                            ->select('Nomenklatur')
                            ->where('Kode', $kode_sub_kegiatan)
                            ->get('nomenklaturkabupaten')
                            ->row_array();
                        if ($nomenklatur) {
                            $sub_kegiatan = $nomenklatur['Nomenklatur'];
                        }
                    }
                    
                    if (empty($sub_kegiatan)) {
                        echo json_encode([
                            'status' => 'error', 
                            'message' => 'Sub Kegiatan harus diisi!'
                        ]);
                        return;
                    }
                }
                
                if (empty($indikator_sub_kegiatan)) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Indikator Sub Kegiatan harus diisi!'
                    ]);
                    return;
                }
                
                // PREPARE DATA UPDATE
                $data = [
                    'kode_sub_kegiatan' => $kode_sub_kegiatan ?: null,
                    'sub_kegiatan' => $sub_kegiatan,
                    'indikator_sub_kegiatan' => $indikator_sub_kegiatan,
                    'satuan' => $satuan ?: null,
                    'target_rakortekbang' => $target_rakortekbang,
                    'target_rkpd' => $target_rkpd,
                    'keterangan' => $keterangan ?: null,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                log_message('debug', 'Data yang akan diupdate: ' . print_r($data, true));
                
                // EKSEKUSI UPDATE
                $this->db->where('id', $id);
                $update = $this->db->update('keselarasan_detail', $data);
                
                if ($update) {
                    // Ambil data terbaru
                    $updatedData = $this->db
                        ->where('id', $id)
                        ->get('keselarasan_detail')
                        ->row_array();
                    
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Sub Kegiatan berhasil diperbarui!',
                        'data' => $updatedData,
                        'target_rakortekbang_display' => $this->displayAngkaTarget($target_rakortekbang),
                        'target_rkpd_display' => $this->displayAngkaTarget($target_rkpd)
                    ]);
                } else {
                    $error = $this->db->error();
                    log_message('error', 'Gagal update: ' . $error['message']);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal update data: ' . $error['message']
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'EditKeselarasanDetail Exception: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        // ================================================================
        // FUNGSI BANTUAN: FORMAT ANGKA TARGET
        // ================================================================
        private function formatAngkaTarget($value) {
            if (empty($value) && $value !== 0 && $value !== '0') {
                return null;
            }
            
            // Bersihkan dari spasi dan karakter aneh
            $clean = trim($value);
            // Hapus titik pemisah ribuan (contoh: 1.000.000 -> 1000000)
            $clean = str_replace('.', '', $clean);
            // Ganti koma dengan titik untuk desimal (contoh: 1,5 -> 1.5)
            $clean = str_replace(',', '.', $clean);
            
            // Konversi ke float
            $number = (float) $clean;
            
            // Kembalikan sebagai float
            return $number;
        }

        // ================================================================
        // HAPUS DETAIL (INDIKATOR) KESELARASAN - HANYA ROLE 3 (DAERAH)
        // ================================================================
        public function HapusKeselarasanDetail() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // HANYA ROLE 3 (DAERAH) YANG BISA CRUD
            if (!$this->is_role_3()) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menghapus data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->get_kode_wilayah();
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // Cek data ada
            $detail = $this->db->where('id', $id)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_detail')
                ->row_array();
            
            if (!$detail) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                return;
            }
            
            // Cek header
            $header = $this->db->where('id', $detail['header_id'])
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_header')
                ->row_array();
            
            if (!$header) {
                echo json_encode(['status' => 'error', 'message' => 'Header tidak ditemukan!']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->update('keselarasan_detail', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil dihapus!']);
        }

        // ================================================================
        // GET DETAIL KESELARASAN BY ID - DENGAN ERROR HANDLING
        // ================================================================
        public function GetKeselarasanDetail() {
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            log_message('debug', '=== GetKeselarasanDetail dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                $id = (int)$this->input->post('id', TRUE);
                $KodeWilayah = $this->get_kode_wilayah();
                
                if ($id <= 0 || empty($KodeWilayah)) {
                    echo json_encode([
                        'status' => 'error', 
                        'message' => 'Data tidak valid'
                    ]);
                    return;
                }
                
                // AMBIL DATA DETAIL
                $this->db->select('d.*, h.kode_bidang, h.bidang_urusan, h.kode_program, h.program');
                $this->db->from('keselarasan_detail d');
                $this->db->join('keselarasan_header h', 'h.id = d.header_id', 'left');
                $this->db->where('d.id', $id);
                $this->db->where('d.deleted_at IS NULL');
                
                $data = $this->db->get()->row_array();
                
                if ($data) {
                    // ============================================================
                    // FORMAT TARGET UNTUK DISPLAY (DENGAN KOMA)
                    // ============================================================
                    $data['target_rakortekbang_display'] = $this->displayAngkaTarget($data['target_rakortekbang'] ?? null);
                    $data['target_rkpd_display'] = $this->displayAngkaTarget($data['target_rkpd'] ?? null);
                    
                    // Juga kirim nilai mentah untuk diisi ke input
                    $data['target_rakortekbang_raw'] = $data['target_rakortekbang'] ?? null;
                    $data['target_rkpd_raw'] = $data['target_rkpd'] ?? null;
                    
                    echo json_encode([
                        'status' => 'success',
                        'data' => $data
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'GetKeselarasanDetail Exception: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        // ================================================================
        // FUNGSI BANTUAN: PARSE ANGKA TARGET - PERBAIKAN TOTAL
        // ================================================================
        private function parseAngkaTarget($value) {
            if (empty($value) && $value !== 0 && $value !== '0') {
                return null;
            }
            
            // Bersihkan dari spasi
            $clean = trim($value);
            $clean = preg_replace('/[^0-9,.]/', '', $clean);
            
            // Cek apakah ada koma (format Indonesia)
            if (strpos($clean, ',') !== false) {
                // Ganti koma dengan titik untuk desimal
                $clean = str_replace(',', '.', $clean);
                // Hapus titik yang menjadi pemisah ribuan
                $parts = explode('.', $clean);
                if (count($parts) > 2) {
                    $last = array_pop($parts);
                    $clean = implode('', $parts) . '.' . $last;
                }
                // ✅ PERBAIKAN: Jika hanya 1 titik, biarkan saja (itu adalah desimal)
                // Tidak perlu melakukan apa-apa
            } else {
                // ✅ PERBAIKAN: Jika tidak ada koma, cek apakah ada titik
                if (strpos($clean, '.') !== false) {
                    // Ada titik, ini bisa desimal atau ribuan
                    // Jika formatnya "1.5" (desimal) atau "1.500" (ribuan)
                    // Kita perlu bedakan berdasarkan panjang setelah titik
                    $parts = explode('.', $clean);
                    if (count($parts) == 2) {
                        // Jika 2 bagian, cek panjang bagian kedua
                        if (strlen($parts[1]) == 1 || strlen($parts[1]) == 2) {
                            // Ini desimal (1.5 atau 1.50), biarkan
                            $clean = $clean;
                        } else if (strlen($parts[1]) >= 3) {
                            // Ini ribuan (1.500), hapus titik
                            $clean = str_replace('.', '', $clean);
                        }
                    } else {
                        // Lebih dari 2 bagian, hapus semua titik
                        $clean = str_replace('.', '', $clean);
                    }
                }
                // Jika tidak ada titik, biarkan saja
            }
            
            $number = (float) $clean;
            return $number;
        }

        // ================================================================
        // FUNGSI BANTUAN: DISPLAY ANGKA TARGET
        // ================================================================
        private function displayAngkaTarget($value) {
            if ($value === null || $value === '' || $value === '-') {
                return '-';
            }
            
            $number = (float) $value;
            
            // ✅ PERBAIKAN: Gunakan number_format dengan benar
            // number_format($number, decimals, decimal_separator, thousands_separator)
            if (floor($number) == $number) {
                return number_format($number, 0, ',', '.');
            } else {
                return number_format($number, 2, ',', '.');
            }
        }

        // ================================================================
        // GET DATA KESELARASAN UNTUK EXPORT/VIEW
        // ================================================================
        public function GetKeselarasanData() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $KodeWilayah = $this->get_kode_wilayah();
            $is_role_3 = $this->is_role_3();
            $filter_instansi_id = $this->input->get('instansi_id', TRUE);
            $tahun = $this->input->get('tahun', TRUE) ?: date('Y');
            
            if (!$KodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
                return;
            }
            
            $query_header = $this->db->select('h.*, a.nama as instansi_nama')
                ->from('keselarasan_header h')
                ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
                ->where('h.kode_wilayah', $KodeWilayah)
                ->where('h.tahun', $tahun)
                ->where('h.deleted_at IS NULL');
            
            // Filter berdasarkan instansi untuk role 3
            if ($is_role_3 && !empty($filter_instansi_id)) {
                $query_header->where('h.id_instansi', (int)$filter_instansi_id);
            }
            
            $headers = $query_header->order_by('h.id', 'ASC')->get()->result_array();
            
            foreach ($headers as &$header) {
                $header['details'] = $this->db->select('*')
                    ->from('keselarasan_detail')
                    ->where('header_id', $header['id'])
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->order_by('id', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            echo json_encode([
                'status' => 'success',
                'data' => $headers
            ]);
        }

        // ================================================================
        // GET NOMENKLATUR SUB KEGIATAN (LEVEL 5)
        // ================================================================
        public function getNomenklaturSubKegiatan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $level = (int)$this->input->post('level', TRUE);
            $parent_kode = $this->input->post('parent_kode', TRUE);
            
            // Hanya untuk Level 5 (Sub Kegiatan)
            if ($level != 5) {
                echo json_encode([]);
                return;
            }
            
            // Ambil data sub kegiatan (Level 5) dari nomenklaturkabupaten
            $this->db->select('Kode, Nomenklatur, Kinerja, Indikator, Satuan, Kewenangan');
            $this->db->from('nomenklaturkabupaten');
            
            // Filter: hanya yang memiliki 5 titik (Sub Kegiatan)
            $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 5);
            
            // Jika ada parent_kode, filter prefix
            if (!empty($parent_kode)) {
                $dotCount = substr_count($parent_kode, '.');
                
                if ($dotCount == 1 || $dotCount == 2) {
                    // Parent adalah Bidang Urusan (1.01) atau Program (1.01.02)
                    // Sub kegiatan harus dimulai dengan parent_kode
                    $this->db->where('Kode LIKE', $parent_kode . '.%');
                    // Pastikan sub kegiatan memiliki 5 titik
                    $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 5);
                } else {
                    // Fallback
                    $this->db->where('Kode LIKE', $parent_kode . '.%');
                    $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 5);
                }
            }
            
            $this->db->order_by('Kode', 'ASC');
            $data = $this->db->get()->result_array();
            
            echo json_encode($data);
        }

        // ================================================================
        // GET SUB KEGIATAN BY KODE - DENGAN INDIKATOR DARI NOMENKLATUR
        // ================================================================
        public function GetSubKegiatanByKode() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $kodeSubKegiatan = $this->input->post('kode_sub_kegiatan', TRUE);
        
        if (empty($kodeSubKegiatan)) {
            echo json_encode(['status' => 'error', 'message' => 'Kode Sub Kegiatan tidak valid']);
            return;
        }
        
        // Ambil data sub kegiatan
        $subKegiatan = $this->db
            ->select('Kode, Nomenklatur')
            ->from('nomenklaturkabupaten')
            ->where('Kode', $kodeSubKegiatan)
            ->where('deleted_at IS NULL', null, false)
            ->get()
            ->row_array();
        
        if (!$subKegiatan) {
            echo json_encode(['status' => 'error', 'message' => 'Sub Kegiatan tidak ditemukan']);
            return;
        }
        
        // Ambil parent Kegiatan (Level 4) - 4 bagian pertama
        $parts = explode('.', $kodeSubKegiatan);
        $kodeKegiatan = '';
        $kegiatan = '';
        $kodeProgram = '';
        $program = '';
        
        // Ambil Kegiatan: 4 bagian pertama (contoh: 1.01.02.1)
        if (count($parts) >= 4) {
            $kodeKegiatan = implode('.', array_slice($parts, 0, 4));
            $kegData = $this->db
                ->select('Nomenklatur')
                ->from('nomenklaturkabupaten')
                ->where('Kode', $kodeKegiatan)
                ->where('deleted_at IS NULL', null, false)
                ->get()
                ->row_array();
            if ($kegData) {
                $kegiatan = $kegData['Nomenklatur'];
            }
        }
        
        // Ambil Program: 3 bagian pertama (contoh: 1.01.02)
        if (count($parts) >= 3) {
            $kodeProgram = implode('.', array_slice($parts, 0, 3));
            $progData = $this->db
                ->select('Nomenklatur')
                ->from('nomenklaturkabupaten')
                ->where('Kode', $kodeProgram)
                ->where('deleted_at IS NULL', null, false)
                ->get()
                ->row_array();
            if ($progData) {
                $program = $progData['Nomenklatur'];
            }
        }
        
        echo json_encode([
            'status' => 'success',
            'data' => [
                'sub_kegiatan' => $subKegiatan['Nomenklatur'],
                'kode_kegiatan' => $kodeKegiatan,
                'kegiatan' => $kegiatan,
                'kode_program' => $kodeProgram,
                'program' => $program
            ]
        ]);
    }

        /// ================================================================
        // INPUT SUB KEGIATAN - HANYA ROLE 3 (DAERAH)
        // ================================================================
        public function InputKeselarasanSubKegiatan() {
            // Aktifkan error reporting untuk debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Log untuk debugging
            log_message('debug', '=== InputKeselarasanSubKegiatan dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Set header JSON
            header('Content-Type: application/json');
            
            // HANYA ROLE 3 (DAERAH) YANG BISA CRUD
            if (!$this->is_role_3()) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menambah data.']);
                return;
            }
            
            $KodeWilayah = $this->get_kode_wilayah();
            
            if (!$KodeWilayah) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $header_id = (int)$this->input->post('header_id', TRUE);
            
            if ($header_id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Header tidak valid!']);
                return;
            }
            
            // Cek header ada
            $header = $this->db->where('id', $header_id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_header')
                ->row_array();
            
            if (!$header) {
                echo json_encode(['status' => 'error', 'message' => 'Header tidak ditemukan!']);
                return;
            }
            
            // Ambil data dari POST
            $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
            $sub_kegiatan = trim($this->input->post('sub_kegiatan', TRUE));
            $indikator_sub_kegiatan = trim($this->input->post('indikator_sub_kegiatan', TRUE));
            $satuan = trim($this->input->post('satuan', TRUE));
            
            // Format Rupiah helper
            $formatRp = function($val) {
                if (empty($val)) return null;
                $val = str_replace(['Rp', ' ', '.', ','], '', $val);
                return $val !== '' ? (float)$val : null;
            };
            
            $target_rakortekbang = $formatRp($this->input->post('target_rakortekbang', TRUE));
            $target_rkpd = $formatRp($this->input->post('target_rkpd', TRUE));
            $keterangan = trim($this->input->post('keterangan', TRUE));
            
            // Validasi
            if (empty($kode_sub_kegiatan) && empty($sub_kegiatan)) {
                echo json_encode(['status' => 'error', 'message' => 'Kode Sub Kegiatan atau Sub Kegiatan harus diisi!']);
                return;
            }
            
            if (empty($sub_kegiatan)) {
                // Jika sub_kegiatan kosong tapi kode_sub_kegiatan ada, ambil dari nomenklatur
                if (!empty($kode_sub_kegiatan)) {
                    $nomenklatur = $this->db
                        ->select('Nomenklatur')
                        ->where('Kode', $kode_sub_kegiatan)
                        ->get('nomenklaturkabupaten')
                        ->row_array();
                    if ($nomenklatur) {
                        $sub_kegiatan = $nomenklatur['Nomenklatur'];
                    }
                }
                
                if (empty($sub_kegiatan)) {
                    echo json_encode(['status' => 'error', 'message' => 'Sub Kegiatan harus diisi!']);
                    return;
                }
            }
            
            // Cek apakah tabel keselarasan_detail ada
            $tableExists = $this->db->query("SHOW TABLES LIKE 'keselarasan_detail'")->num_rows();
            if ($tableExists == 0) {
                // Jika tabel tidak ada, buat tabel terlebih dahulu
                $this->createKeselarasanDetailTable();
            }
            
            // Dapatkan urutan terakhir
            $last_urutan = $this->db
                ->select_max('urutan')
                ->where('header_id', $header_id)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_detail')
                ->row()
                ->urutan;
            
            $urutan = ($last_urutan ? $last_urutan + 10 : 10);
            
            // Siapkan data
            $data = [
                'header_id' => $header_id,
                'kode_sub_kegiatan' => $kode_sub_kegiatan ?: null,
                'sub_kegiatan' => $sub_kegiatan,
                'indikator_sub_kegiatan' => $indikator_sub_kegiatan ?: null,
                'satuan' => $satuan ?: null,
                'target_rakortekbang' => $target_rakortekbang,
                'target_rkpd' => $target_rkpd,
                'keterangan' => $keterangan ?: null,
                'urutan' => $urutan,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            log_message('debug', 'Data yang akan diinsert: ' . print_r($data, true));
            
            // Insert ke database
            $insert = $this->db->insert('keselarasan_detail', $data);
            
            if ($insert) {
                $detail_id = $this->db->insert_id();
                log_message('debug', 'Insert berhasil, ID: ' . $detail_id);
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Sub Kegiatan berhasil ditambahkan!',
                    'id' => $detail_id
                ]);
            } else {
                $error = $this->db->error();
                log_message('error', 'Gagal insert: ' . $error['message']);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal menyimpan data: ' . $error['message']
                ]);
            }
        }
        // ================================================================
        // EDIT SUB KEGIATAN - HANYA ROLE 3 (DAERAH)
        // ================================================================
        public function EditKeselarasanSubKegiatan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            // Aktifkan error reporting
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            log_message('debug', '=== EditKeselarasanSubKegiatan dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->is_role_3()) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat mengedit data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->get_kode_wilayah();
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // ============================================================
            // PERBAIKAN: Gunakan keselarasan_detail (bukan keselarasan_sub_kegiatan)
            // ============================================================
            $detail = $this->db->where('id', $id)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_detail')
                ->row_array();
            
            if (!$detail) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                return;
            }
            
            // Cek header
            $header = $this->db->where('id', $detail['header_id'])
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_header')
                ->row_array();
            
            if (!$header) {
                echo json_encode(['status' => 'error', 'message' => 'Header tidak ditemukan!']);
                return;
            }
            
            // Ambil data dari POST
            $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
            $sub_kegiatan = trim($this->input->post('sub_kegiatan', TRUE));
            $indikator_sub_kegiatan = trim($this->input->post('indikator_sub_kegiatan', TRUE));
            $satuan = trim($this->input->post('satuan', TRUE));
            
            $formatRp = function($val) {
                if (empty($val)) return null;
                $val = str_replace(['Rp', ' ', '.', ','], '', $val);
                return $val !== '' ? (float)$val : null;
            };
            
            $target_rakortekbang = $formatRp($this->input->post('target_rakortekbang', TRUE));
            $target_rkpd = $formatRp($this->input->post('target_rkpd', TRUE));
            $keterangan = trim($this->input->post('keterangan', TRUE));
            
            // Validasi
            if (empty($sub_kegiatan)) {
                if (!empty($kode_sub_kegiatan)) {
                    $nomenklatur = $this->db
                        ->select('Nomenklatur')
                        ->where('Kode', $kode_sub_kegiatan)
                        ->get('nomenklaturkabupaten')
                        ->row_array();
                    if ($nomenklatur) {
                        $sub_kegiatan = $nomenklatur['Nomenklatur'];
                    }
                }
                if (empty($sub_kegiatan)) {
                    echo json_encode(['status' => 'error', 'message' => 'Sub Kegiatan harus diisi!']);
                    return;
                }
            }
            
            $data = [
                'kode_sub_kegiatan' => $kode_sub_kegiatan ?: null,
                'sub_kegiatan' => $sub_kegiatan,
                'indikator_sub_kegiatan' => $indikator_sub_kegiatan ?: null,
                'satuan' => $satuan ?: null,
                'target_rakortekbang' => $target_rakortekbang,
                'target_rkpd' => $target_rkpd,
                'keterangan' => $keterangan ?: null,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            log_message('debug', 'Data yang akan diupdate: ' . print_r($data, true));
            
            $this->db->where('id', $id);
            $update = $this->db->update('keselarasan_detail', $data);
            
            if ($update) {
                // Ambil data terbaru
                $updatedData = $this->db->where('id', $id)->get('keselarasan_detail')->row_array();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Sub Kegiatan berhasil diperbarui!',
                    'data' => $updatedData
                ]);
            } else {
                $error = $this->db->error();
                log_message('error', 'Gagal update: ' . $error['message']);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal update data: ' . $error['message']
                ]);
            }
        }

        // ================================================================
        // HAPUS SUB KEGIATAN - HANYA ROLE 3 (DAERAH)
        // ================================================================
        public function HapusKeselarasanSubKegiatan() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            if (!$this->is_role_3()) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menghapus data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->get_kode_wilayah();
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // ============================================================
            // PERBAIKAN: Gunakan keselarasan_detail (bukan keselarasan_sub_kegiatan)
            // ============================================================
            $detail = $this->db->where('id', $id)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_detail')
                ->row_array();
            
            if (!$detail) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                return;
            }
            
            // Cek header
            $header = $this->db->where('id', $detail['header_id'])
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_header')
                ->row_array();
            
            if (!$header) {
                echo json_encode(['status' => 'error', 'message' => 'Header tidak ditemukan!']);
                return;
            }
            
            $this->db->where('id', $id);
            $update = $this->db->update('keselarasan_detail', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($update) {
                echo json_encode(['status' => 'success', 'message' => 'Sub Kegiatan berhasil dihapus!']);
            } else {
                $error = $this->db->error();
                log_message('error', 'Gagal hapus: ' . $error['message']);
                echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data: ' . $error['message']]);
            }
        }

        // ================================================================
        // GET SUB KEGIATAN BY ID - UNTUK EDIT
        // ================================================================
        public function GetKeselarasanSubKegiatanById() {
            // Aktifkan error reporting untuk debugging
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
            
            // Log untuk debugging
            log_message('debug', '=== GetKeselarasanSubKegiatanById dipanggil ===');
            log_message('debug', 'POST data: ' . print_r($_POST, true));
            
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->get_kode_wilayah();
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            // ============================================================
            // PERBAIKAN: Gunakan tabel keselarasan_detail
            // ============================================================
            $this->db->select('d.*, h.kode_bidang, h.bidang_urusan, h.kode_program, h.program');
            $this->db->from('keselarasan_detail d');
            $this->db->join('keselarasan_header h', 'h.id = d.header_id', 'left');
            $this->db->where('d.id', $id);
            $this->db->where('d.deleted_at IS NULL');
            
            $data = $this->db->get()->row_array();
            
            log_message('debug', 'Data ditemukan: ' . print_r($data, true));
            
            if ($data) {
                echo json_encode([
                    'status' => 'success',
                    'data' => $data
                ]);
            } else {
                // Cek apakah data ada di tabel keselarasan_sub_kegiatan (fallback)
                $fallback = $this->db->where('id', $id)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_sub_kegiatan')
                    ->row_array();
                
                if ($fallback) {
                    echo json_encode([
                        'status' => 'success',
                        'data' => $fallback,
                        'from_fallback' => true
                    ]);
                } else {
                    log_message('error', 'Data tidak ditemukan untuk ID: ' . $id);
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan'
                    ]);
                }
            }
        }


        // ================================================================
        // KESELARASAN TARGET MAKRO EKONOMI
        // ================================================================

        /**
         * Halaman Keselarasan Target Makro Ekonomi
         */
        public function KeselarasanMakro() {
            $Header['Halaman'] = 'Keselarasan Target Makro Ekonomi';
            
            // Ambil KodeWilayah dari session
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            // Data untuk filter provinsi
            $Data['Provinsi'] = $this->db
                ->where("Kode LIKE '__'")
                ->order_by('Nama')
                ->get('kodewilayah')
                ->result_array();
            
            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['NamaWilayah'] = '';
            $Data['TahunAktif'] = date('Y');
            
            // Ambil data target makro
            $Data['TargetMakro'] = [];
            
            if (!empty($KodeWilayah)) {
                $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
                
                // Ambil data dari tabel target_makro_ekonomi
                $Data['TargetMakro'] = $this->db
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get('target_makro_ekonomi')
                    ->result_array();
            }
            
            // Data tahun untuk dropdown (5 tahun terakhir)
            $Data['ListTahun'] = [];
            $currentYear = date('Y');
            for ($i = 5; $i >= 0; $i--) {
                $Data['ListTahun'][] = $currentYear - $i;
            }
            
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/KeselarasanMakro', $Data);
        }

        /**
         * Input Target Makro Ekonomi
         */
        public function InputTargetMakro() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $KodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($KodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                // Ambil data dari POST
                $indikator = trim($this->input->post('indikator', TRUE));
                $target_rkpd_provinsi = trim($this->input->post('target_rkpd_provinsi', TRUE));
                $target_rkpd_kabkota = trim($this->input->post('target_rkpd_kabkota', TRUE));
                $keterangan = trim($this->input->post('keterangan', TRUE));
                $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
                
                // Validasi
                if (empty($indikator)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Indikator Pembangunan harus diisi!'
                    ]);
                    return;
                }
                
                // Dapatkan urutan terakhir
                $lastUrutan = $this->db
                    ->select_max('urutan')
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('tahun', $tahun)
                    ->where('deleted_at IS NULL')
                    ->get('target_makro_ekonomi')
                    ->row()
                    ->urutan;
                
                $urutan = ($lastUrutan ? $lastUrutan + 10 : 10);
                
                $data = [
                    'kode_wilayah' => $KodeWilayah,
                    'tahun' => $tahun,
                    'indikator' => $indikator,
                    'target_rkpd_provinsi' => $target_rkpd_provinsi ?: null,
                    'target_rkpd_kabkota' => $target_rkpd_kabkota ?: null,
                    'keterangan' => $keterangan ?: null,
                    'urutan' => $urutan,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('target_makro_ekonomi', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil disimpan!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menyimpan data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'InputTargetMakro: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * Edit Target Makro Ekonomi
         */
        public function EditTargetMakro() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $KodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($KodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                // Cek data ada
                $existing = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('target_makro_ekonomi')
                    ->row_array();
                
                if (!$existing) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Data tidak ditemukan!'
                    ]);
                    return;
                }
                
                // Ambil data dari POST
                $indikator = trim($this->input->post('indikator', TRUE));
                $target_rkpd_provinsi = trim($this->input->post('target_rkpd_provinsi', TRUE));
                $target_rkpd_kabkota = trim($this->input->post('target_rkpd_kabkota', TRUE));
                $keterangan = trim($this->input->post('keterangan', TRUE));
                $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
                
                // Validasi
                if (empty($indikator)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Indikator Pembangunan harus diisi!'
                    ]);
                    return;
                }
                
                $data = [
                    'tahun' => $tahun,
                    'indikator' => $indikator,
                    'target_rkpd_provinsi' => $target_rkpd_provinsi ?: null,
                    'target_rkpd_kabkota' => $target_rkpd_kabkota ?: null,
                    'keterangan' => $keterangan ?: null,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $KodeWilayah);
                $this->db->update('target_makro_ekonomi', $data);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil diupdate!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Tidak ada perubahan data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'EditTargetMakro: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * Hapus Target Makro Ekonomi
         */
        public function HapusTargetMakro() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            try {
                $KodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($KodeWilayah)) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Wilayah belum dipilih!'
                    ]);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'ID tidak valid!'
                    ]);
                    return;
                }
                
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $KodeWilayah);
                $this->db->update('target_makro_ekonomi', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                
                if ($this->db->affected_rows() > 0) {
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Data berhasil dihapus!'
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Gagal menghapus data!'
                    ]);
                }
                
            } catch (Exception $e) {
                log_message('error', 'HapusTargetMakro: ' . $e->getMessage());
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ]);
            }
        }

        /**
         * Get Target Makro by ID (untuk edit)
         */
        public function GetTargetMakroById() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if ($id <= 0 || empty($KodeWilayah)) {
                echo json_encode([]);
                return;
            }
            
            $data = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('target_makro_ekonomi')
                ->row_array();
            
            echo json_encode($data);
        }

        
    // ============================================================
    // KESELARASAN INDIKATOR UTAMA PEMBANGUNAN
    // ============================================================

    /**
     * Halaman Keselarasan Indikator Utama Pembangunan
     */
    public function KeselarasanIndikatorUtama() {
        $Header['Halaman'] = 'Keselarasan Indikator Utama Pembangunan';
        
        $KodeWilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') 
                    ?? '';
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        
        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }
        
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();
        
        // Ambil data indikator utama dengan perihal terpisah
        $Data['IndikatorUtama'] = [];
        
        if (!empty($KodeWilayah)) {
            $data = $this->db
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nomor_rkp', 'ASC')
                ->order_by('nomor_kabkota', 'ASC')
                ->order_by('id', 'ASC')
                ->get('keselarasan_indikator_utama')
                ->result_array();
            
            foreach ($data as &$item) {
                // Ambil perihal RKP (tabel terpisah)
                $item['perihal_rkp'] = $this->db
                    ->where('indikator_utama_id', $item['id'])
                    ->where('deleted_at IS NULL')
                    ->order_by('nomor_perihal', 'ASC')
                    ->order_by('urutan', 'ASC')
                    ->get('keselarasan_perihal_rkp')
                    ->result_array();
                
                // Ambil perihal Kab/Kota (tabel terpisah)
                $item['perihal_kabkota'] = $this->db
                    ->where('indikator_utama_id', $item['id'])
                    ->where('deleted_at IS NULL')
                    ->order_by('nomor_perihal', 'ASC')
                    ->order_by('urutan', 'ASC')
                    ->get('keselarasan_perihal_kabkota')
                    ->result_array();
            }
            $Data['IndikatorUtama'] = $data;
        }
        
        $Data['TahunAktif'] = $this->input->get('tahun', TRUE) ?: date('Y');
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/KeselarasanIndikatorUtama', $Data);
    }

    /**
     * GET INDIKATOR UTAMA BY ID
     */
    public function GetIndikatorUtamaById() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        $KodeWilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');
        
        if ($id <= 0 || empty($KodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $data = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->get('keselarasan_indikator_utama')
            ->row_array();
        
        if ($data) {
            $data['perihal_rkp'] = $this->db
                ->where('indikator_utama_id', $id)
                ->where('deleted_at IS NULL')
                ->order_by('nomor_perihal', 'ASC')
                ->order_by('urutan', 'ASC')
                ->get('keselarasan_perihal_rkp')
                ->result_array();
            
            $data['perihal_kabkota'] = $this->db
                ->where('indikator_utama_id', $id)
                ->where('deleted_at IS NULL')
                ->order_by('nomor_perihal', 'ASC')
                ->order_by('urutan', 'ASC')
                ->get('keselarasan_perihal_kabkota')
                ->result_array();
            
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    /**
     * GET PERIHAL RKP BY ID
     */
    public function GetPerihalRKPById() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $data = $this->db
            ->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('keselarasan_perihal_rkp')
            ->row_array();
        
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    /**
     * GET PERIHAL KAB/KOTA BY ID
     */
    public function GetPerihalKabKotaById() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $data = $this->db
            ->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('keselarasan_perihal_kabkota')
            ->row_array();
        
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    /**
     * INPUT INDIKATOR UTAMA
     */
    public function InputIndikatorUtama() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            // Ambil data RKP
            $nomorRKP = trim($this->input->post('nomor_rkp', TRUE));
            $namaRKP = trim($this->input->post('nama_indikator_rkp', TRUE));
            $targetRKP = trim($this->input->post('target_rkp', TRUE));
            $keteranganRKP = trim($this->input->post('keterangan_rkp', TRUE));
            
            // Ambil data Kab/Kota
            $nomorKabKota = trim($this->input->post('nomor_kabkota', TRUE));
            $namaKabKota = trim($this->input->post('nama_indikator_kabkota', TRUE));
            $targetKabKota = trim($this->input->post('target_kabkota', TRUE));
            $keteranganKabKota = trim($this->input->post('keterangan_kabkota', TRUE));
            
            // Perihal RKP
            $perihalNomorRKP = $this->input->post('perihal_nomor_rkp', TRUE);
            $perihalNamaRKP = $this->input->post('perihal_nama_rkp', TRUE);
            $perihalTargetRKP = $this->input->post('perihal_target_rkp', TRUE);
            $perihalKeteranganRKP = $this->input->post('perihal_keterangan_rkp', TRUE);
            
            // Perihal Kab/Kota
            $perihalNomorKabKota = $this->input->post('perihal_nomor_kabkota', TRUE);
            $perihalNamaKabKota = $this->input->post('perihal_nama_kabkota', TRUE);
            $perihalTargetKabKota = $this->input->post('perihal_target_kabkota', TRUE);
            $perihalKeteranganKabKota = $this->input->post('perihal_keterangan_kabkota', TRUE);
            
            // Validasi: minimal salah satu diisi
            $hasRKP = !empty($nomorRKP) || !empty($namaRKP);
            $hasKabKota = !empty($nomorKabKota) || !empty($namaKabKota);
            
            if (!$hasRKP && !$hasKabKota) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Minimal isi salah satu: RKP 2026 atau Kab/Kota!'
                ]);
                return;
            }
            
            if ($hasRKP && empty($nomorRKP)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Nomor RKP 2026 wajib diisi jika mengisi indikator RKP!'
                ]);
                return;
            }
            
            if ($hasKabKota && empty($nomorKabKota)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Nomor Kab/Kota wajib diisi jika mengisi indikator Kab/Kota!'
                ]);
                return;
            }
            
            // Cek duplikat nomor RKP
            if (!empty($nomorRKP)) {
                $existsRKP = $this->db
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('nomor_rkp', $nomorRKP)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_indikator_utama')
                    ->num_rows();
                
                if ($existsRKP > 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nomor RKP ' . $nomorRKP . ' sudah digunakan!'
                    ]);
                    return;
                }
            }
            
            // Cek duplikat nomor Kab/Kota
            if (!empty($nomorKabKota)) {
                $existsKabKota = $this->db
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('nomor_kabkota', $nomorKabKota)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_indikator_utama')
                    ->num_rows();
                
                if ($existsKabKota > 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nomor Kab/Kota ' . $nomorKabKota . ' sudah digunakan!'
                    ]);
                    return;
                }
            }
            
            $this->db->trans_start();
            
            // Insert indikator utama
            $data = [
                'kode_wilayah' => $KodeWilayah,
                'nomor_rkp' => !empty($nomorRKP) ? $nomorRKP : null,
                'nama_indikator_rkp' => !empty($namaRKP) ? $namaRKP : null,
                'target_rkp' => !empty($targetRKP) ? $targetRKP : null,
                'keterangan_rkp' => !empty($keteranganRKP) ? $keteranganRKP : null,
                'nomor_kabkota' => !empty($nomorKabKota) ? $nomorKabKota : null,
                'nama_indikator_kabkota' => !empty($namaKabKota) ? $namaKabKota : null,
                'target_kabkota' => !empty($targetKabKota) ? $targetKabKota : null,
                'keterangan_kabkota' => !empty($keteranganKabKota) ? $keteranganKabKota : null,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('keselarasan_indikator_utama', $data);
            $indukId = $this->db->insert_id();
            
            if (!$indukId) {
                throw new Exception('Gagal menyimpan data!');
            }
            
            // Insert perihal RKP
            if (!empty($perihalNamaRKP) && is_array($perihalNamaRKP)) {
                $urutan = 10;
                foreach ($perihalNamaRKP as $key => $namaPerihal) {
                    if (empty(trim($namaPerihal))) continue;
                    
                    $nomorPerihal = isset($perihalNomorRKP[$key]) ? trim($perihalNomorRKP[$key]) : null;
                    $targetPerihal = isset($perihalTargetRKP[$key]) ? trim($perihalTargetRKP[$key]) : null;
                    $keteranganPerihal = isset($perihalKeteranganRKP[$key]) ? trim($perihalKeteranganRKP[$key]) : null;
                    
                    $this->db->insert('keselarasan_perihal_rkp', [
                        'indikator_utama_id' => $indukId,
                        'nomor_perihal' => $nomorPerihal,
                        'nama_perihal' => trim($namaPerihal),
                        'target' => $targetPerihal,
                        'keterangan' => $keteranganPerihal,
                        'urutan' => $urutan,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    $urutan += 10;
                }
            }
            
            // Insert perihal Kab/Kota
            if (!empty($perihalNamaKabKota) && is_array($perihalNamaKabKota)) {
                $urutan = 10;
                foreach ($perihalNamaKabKota as $key => $namaPerihal) {
                    if (empty(trim($namaPerihal))) continue;
                    
                    $nomorPerihal = isset($perihalNomorKabKota[$key]) ? trim($perihalNomorKabKota[$key]) : null;
                    $targetPerihal = isset($perihalTargetKabKota[$key]) ? trim($perihalTargetKabKota[$key]) : null;
                    $keteranganPerihal = isset($perihalKeteranganKabKota[$key]) ? trim($perihalKeteranganKabKota[$key]) : null;
                    
                    $this->db->insert('keselarasan_perihal_kabkota', [
                        'indikator_utama_id' => $indukId,
                        'nomor_perihal' => $nomorPerihal,
                        'nama_perihal' => trim($namaPerihal),
                        'target' => $targetPerihal,
                        'keterangan' => $keteranganPerihal,
                        'urutan' => $urutan,
                        'created_at' => date('Y-m-d H:i:s')
                    ]);
                    $urutan += 10;
                }
            }
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menyimpan data!');
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan!'
            ]);
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'InputIndikatorUtama: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * UPDATE INDIKATOR UTAMA
     */
    public function UpdateIndikatorUtama() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            // Ambil data
            $nomorRKP = trim($this->input->post('nomor_rkp', TRUE));
            $namaRKP = trim($this->input->post('nama_indikator_rkp', TRUE));
            $targetRKP = trim($this->input->post('target_rkp', TRUE));
            $keteranganRKP = trim($this->input->post('keterangan_rkp', TRUE));
            
            $nomorKabKota = trim($this->input->post('nomor_kabkota', TRUE));
            $namaKabKota = trim($this->input->post('nama_indikator_kabkota', TRUE));
            $targetKabKota = trim($this->input->post('target_kabkota', TRUE));
            $keteranganKabKota = trim($this->input->post('keterangan_kabkota', TRUE));
            
            // Perihal RKP
            $perihalIdRKP = $this->input->post('perihal_id_rkp', TRUE);
            $perihalNomorRKP = $this->input->post('perihal_nomor_rkp', TRUE);
            $perihalNamaRKP = $this->input->post('perihal_nama_rkp', TRUE);
            $perihalTargetRKP = $this->input->post('perihal_target_rkp', TRUE);
            $perihalKeteranganRKP = $this->input->post('perihal_keterangan_rkp', TRUE);
            $perihalDeletedRKP = $this->input->post('perihal_deleted_rkp', TRUE);
            
            // Perihal Kab/Kota
            $perihalIdKabKota = $this->input->post('perihal_id_kabkota', TRUE);
            $perihalNomorKabKota = $this->input->post('perihal_nomor_kabkota', TRUE);
            $perihalNamaKabKota = $this->input->post('perihal_nama_kabkota', TRUE);
            $perihalTargetKabKota = $this->input->post('perihal_target_kabkota', TRUE);
            $perihalKeteranganKabKota = $this->input->post('perihal_keterangan_kabkota', TRUE);
            $perihalDeletedKabKota = $this->input->post('perihal_deleted_kabkota', TRUE);
            
            // Validasi
            $hasRKP = !empty($nomorRKP) || !empty($namaRKP);
            $hasKabKota = !empty($nomorKabKota) || !empty($namaKabKota);
            
            if (!$hasRKP && !$hasKabKota) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Minimal isi salah satu: RKP 2026 atau Kab/Kota!'
                ]);
                return;
            }
            
            if ($hasRKP && empty($nomorRKP)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Nomor RKP 2026 wajib diisi jika mengisi indikator RKP!'
                ]);
                return;
            }
            
            if ($hasKabKota && empty($nomorKabKota)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Nomor Kab/Kota wajib diisi jika mengisi indikator Kab/Kota!'
                ]);
                return;
            }
            
            // Cek duplikat RKP
            if (!empty($nomorRKP)) {
                $existsRKP = $this->db
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('nomor_rkp', $nomorRKP)
                    ->where('id !=', $id)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_indikator_utama')
                    ->num_rows();
                
                if ($existsRKP > 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nomor RKP ' . $nomorRKP . ' sudah digunakan!'
                    ]);
                    return;
                }
            }
            
            // Cek duplikat Kab/Kota
            if (!empty($nomorKabKota)) {
                $existsKabKota = $this->db
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('nomor_kabkota', $nomorKabKota)
                    ->where('id !=', $id)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_indikator_utama')
                    ->num_rows();
                
                if ($existsKabKota > 0) {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Nomor Kab/Kota ' . $nomorKabKota . ' sudah digunakan!'
                    ]);
                    return;
                }
            }
            
            $this->db->trans_start();
            
            // Update indikator utama
            $data = [
                'nomor_rkp' => !empty($nomorRKP) ? $nomorRKP : null,
                'nama_indikator_rkp' => !empty($namaRKP) ? $namaRKP : null,
                'target_rkp' => !empty($targetRKP) ? $targetRKP : null,
                'keterangan_rkp' => !empty($keteranganRKP) ? $keteranganRKP : null,
                'nomor_kabkota' => !empty($nomorKabKota) ? $nomorKabKota : null,
                'nama_indikator_kabkota' => !empty($namaKabKota) ? $namaKabKota : null,
                'target_kabkota' => !empty($targetKabKota) ? $targetKabKota : null,
                'keterangan_kabkota' => !empty($keteranganKabKota) ? $keteranganKabKota : null,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id', $id);
            $this->db->update('keselarasan_indikator_utama', $data);
            
            // ============================================================
            // PROSES PERIHAL RKP
            // ============================================================
            // Hapus perihal RKP yang ditandai
            if (!empty($perihalDeletedRKP) && is_array($perihalDeletedRKP)) {
                foreach ($perihalDeletedRKP as $delId) {
                    if (!empty($delId) && is_numeric($delId)) {
                        $this->db->where('id', $delId);
                        $this->db->update('keselarasan_perihal_rkp', [
                            'deleted_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
            
            // Update/Insert perihal RKP
            if (!empty($perihalNamaRKP) && is_array($perihalNamaRKP)) {
                $urutan = 10;
                foreach ($perihalNamaRKP as $key => $namaPerihal) {
                    if (empty(trim($namaPerihal))) continue;
                    
                    $nomorPerihal = isset($perihalNomorRKP[$key]) ? trim($perihalNomorRKP[$key]) : null;
                    $targetPerihal = isset($perihalTargetRKP[$key]) ? trim($perihalTargetRKP[$key]) : null;
                    $keteranganPerihal = isset($perihalKeteranganRKP[$key]) ? trim($perihalKeteranganRKP[$key]) : null;
                    $pId = isset($perihalIdRKP[$key]) ? trim($perihalIdRKP[$key]) : null;
                    
                    if (!empty($pId) && is_numeric($pId)) {
                        $this->db->where('id', $pId);
                        $this->db->where('indikator_utama_id', $id);
                        $this->db->update('keselarasan_perihal_rkp', [
                            'nomor_perihal' => $nomorPerihal,
                            'nama_perihal' => trim($namaPerihal),
                            'target' => $targetPerihal,
                            'keterangan' => $keteranganPerihal,
                            'urutan' => $urutan,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    } else {
                        $this->db->insert('keselarasan_perihal_rkp', [
                            'indikator_utama_id' => $id,
                            'nomor_perihal' => $nomorPerihal,
                            'nama_perihal' => trim($namaPerihal),
                            'target' => $targetPerihal,
                            'keterangan' => $keteranganPerihal,
                            'urutan' => $urutan,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                    $urutan += 10;
                }
            }
            
            // ============================================================
            // PROSES PERIHAL KAB/KOTA
            // ============================================================
            // Hapus perihal Kab/Kota yang ditandai
            if (!empty($perihalDeletedKabKota) && is_array($perihalDeletedKabKota)) {
                foreach ($perihalDeletedKabKota as $delId) {
                    if (!empty($delId) && is_numeric($delId)) {
                        $this->db->where('id', $delId);
                        $this->db->update('keselarasan_perihal_kabkota', [
                            'deleted_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                }
            }
            
            // Update/Insert perihal Kab/Kota
            if (!empty($perihalNamaKabKota) && is_array($perihalNamaKabKota)) {
                $urutan = 10;
                foreach ($perihalNamaKabKota as $key => $namaPerihal) {
                    if (empty(trim($namaPerihal))) continue;
                    
                    $nomorPerihal = isset($perihalNomorKabKota[$key]) ? trim($perihalNomorKabKota[$key]) : null;
                    $targetPerihal = isset($perihalTargetKabKota[$key]) ? trim($perihalTargetKabKota[$key]) : null;
                    $keteranganPerihal = isset($perihalKeteranganKabKota[$key]) ? trim($perihalKeteranganKabKota[$key]) : null;
                    $pId = isset($perihalIdKabKota[$key]) ? trim($perihalIdKabKota[$key]) : null;
                    
                    if (!empty($pId) && is_numeric($pId)) {
                        $this->db->where('id', $pId);
                        $this->db->where('indikator_utama_id', $id);
                        $this->db->update('keselarasan_perihal_kabkota', [
                            'nomor_perihal' => $nomorPerihal,
                            'nama_perihal' => trim($namaPerihal),
                            'target' => $targetPerihal,
                            'keterangan' => $keteranganPerihal,
                            'urutan' => $urutan,
                            'updated_at' => date('Y-m-d H:i:s')
                        ]);
                    } else {
                        $this->db->insert('keselarasan_perihal_kabkota', [
                            'indikator_utama_id' => $id,
                            'nomor_perihal' => $nomorPerihal,
                            'nama_perihal' => trim($namaPerihal),
                            'target' => $targetPerihal,
                            'keterangan' => $keteranganPerihal,
                            'urutan' => $urutan,
                            'created_at' => date('Y-m-d H:i:s')
                        ]);
                    }
                    $urutan += 10;
                }
            }
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal mengupdate data!');
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil diupdate!'
            ]);
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'UpdateIndikatorUtama: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * HAPUS INDIKATOR UTAMA (Soft Delete)
     */
    public function HapusIndikatorUtama() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->trans_start();
            
            // Soft delete indikator utama
            $this->db->where('id', $id);
            $this->db->update('keselarasan_indikator_utama', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            // Soft delete semua perihal RKP
            $this->db->where('indikator_utama_id', $id);
            $this->db->update('keselarasan_perihal_rkp', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            // Soft delete semua perihal Kab/Kota
            $this->db->where('indikator_utama_id', $id);
            $this->db->update('keselarasan_perihal_kabkota', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menghapus data!');
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil dihapus!'
            ]);
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'HapusIndikatorUtama: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * HAPUS PERIHAL RKP (Soft Delete)
     */
    public function HapusPerihalRKP() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->update('keselarasan_perihal_rkp', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Perihal RKP berhasil dihapus!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal menghapus perihal RKP!'
                ]);
            }
            
        } catch (Exception $e) {
            log_message('error', 'HapusPerihalRKP: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * HAPUS PERIHAL KAB/KOTA (Soft Delete)
     */
    public function HapusPerihalKabKota() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->update('keselarasan_perihal_kabkota', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            if ($this->db->affected_rows() > 0) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Perihal Kab/Kota berhasil dihapus!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal menghapus perihal Kab/Kota!'
                ]);
            }
            
        } catch (Exception $e) {
            log_message('error', 'HapusPerihalKabKota: ' . $e->getMessage());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

        // ============================================================
        // KESELARASAN KEGIATAN PRIORITAS UTAMA - CRUD LENGKAP
        // ============================================================

        /**
         * Halaman Utama Keselarasan Kegiatan Prioritas Utama
         * URL: Daerah/KeselarasanPrioritas
         */
        public function KeselarasanPrioritas() {
            $Header['Halaman'] = 'Keselarasan Kegiatan Prioritas Utama';
            
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') 
                        ?? '';
            
            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['NamaWilayah'] = '';
            
            if (!empty($KodeWilayah)) {
                $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
                $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
            }
            
            // Data Provinsi untuk filter
            $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();
            
            // Data Prioritas Nasional untuk dropdown
            $Data['PrioritasNasional'] = $this->db
                ->select('Id, PrioritasNasional')
                ->where('deleted_at IS NULL')
                ->order_by('PrioritasNasional', 'ASC')
                ->get('prioritas_nasional_rpjmn')
                ->result_array();
            
            // Data Perangkat Daerah untuk dropdown
            $Data['PerangkatDaerah'] = [];
            if (!empty($KodeWilayah)) {
                $Data['PerangkatDaerah'] = $this->db
                    ->select('id, nama')
                    ->from('akun_instansi')
                    ->where('kodewilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('nama', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            // Ambil SEMUA data dengan JOIN langsung
            $Data['ListData'] = [];
            if (!empty($KodeWilayah)) {
                $Data['ListData'] = $this->db
                    ->select('
                        m.id as master_id,
                        m.id_prioritas_nasional,
                        m.kegiatan_prioritas,
                        pn.PrioritasNasional as prioritas_nasional_nama,
                        d.id as detail_id,
                        d.kode_sub_kegiatan,
                        d.sub_kegiatan,
                        d.kode_kegiatan,
                        d.kegiatan,
                        d.kode_program,
                        d.program,
                        d.id_perangkat_daerah,
                        d.keterangan,
                        a.nama as perangkat_daerah_nama
                    ')
                    ->from('keselarasan_prioritas_master m')
                    ->join('prioritas_nasional_rpjmn pn', 'pn.Id = m.id_prioritas_nasional', 'left')
                    ->join('keselarasan_prioritas_detail d', 'd.id_master = m.id AND d.deleted_at IS NULL', 'left')
                    ->join('akun_instansi a', 'a.id = d.id_perangkat_daerah', 'left')
                    ->where('m.kode_wilayah', $KodeWilayah)
                    ->where('m.deleted_at IS NULL')
                    ->order_by('m.id', 'DESC')
                    ->order_by('d.id', 'ASC')
                    ->get()
                    ->result_array();
            }
            
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/KeselarasanPrioritas', $Data);
        }

        // ============================================================
        // GET NOMENKLATUR HIERARKI
        // ============================================================
        
        public function getNomenklaturHierarki() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $level = (int)$this->input->post('level', TRUE);
        $parentKode = trim($this->input->post('parent_kode', TRUE));
        
        log_message('debug', 'getNomenklaturHierarki - level: ' . $level . ', parent: ' . $parentKode);
        
        $this->db->select('Kode, Nomenklatur');
        $this->db->from('nomenklaturkabupaten');
        
        // Filter deleted_at jika ada
        if ($this->db->field_exists('deleted_at', 'nomenklaturkabupaten')) {
            $this->db->where('deleted_at IS NULL', null, false);
        }
        
        if ($level == 3) {
            // PROGRAM: 2 titik (contoh: 1.01.02)
            $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 2);
            if (!empty($parentKode)) {
                $this->db->where('Kode LIKE', $parentKode . '.%');
            }
        } elseif ($level == 4) {
            // KEGIATAN: 3 titik (contoh: 1.01.02.1)
            // PERBAIKAN: Gunakan exactly 3, bukan range
            $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 3);
            if (!empty($parentKode)) {
                $this->db->where('Kode LIKE', $parentKode . '.%');
            }
        } elseif ($level == 5) {
            // SUB KEGIATAN: 4 atau 5 titik (contoh: 1.01.02.1.01 atau 1.01.02.1.01.0001)
            $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) >=', 4);
            $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) <=', 5);
            if (!empty($parentKode)) {
                $this->db->where('Kode LIKE', $parentKode . '.%');
            }
        } else {
            echo json_encode([]);
            return;
        }
        
        $this->db->order_by('Kode', 'ASC');
        $query = $this->db->get();
        $data = $query->result_array();
        
        log_message('debug', 'getNomenklaturHierarki - result count: ' . count($data));
        
        echo json_encode($data);
    }

    /**
     * Get Program List (Level 3) - 2 titik
     */
    public function getProgramList() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $this->db->select('Kode, Nomenklatur');
        $this->db->from('nomenklaturkabupaten');
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 2);
        if ($this->db->field_exists('deleted_at', 'nomenklaturkabupaten')) {
            $this->db->where('deleted_at IS NULL', null, false);
        }
        $this->db->order_by('Kode', 'ASC');
        
        $data = $this->db->get()->result_array();
        echo json_encode($data);
    }

    /**
     * Get Kegiatan by Program - 3 atau 4 titik
     * POST: kode_program
     */
    public function getKegiatanByProgram() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $kodeProgram = trim($this->input->post('kode_program', TRUE));
        
        if (empty($kodeProgram)) {
            echo json_encode([]);
            return;
        }
        
        $this->db->select('Kode, Nomenklatur');
        $this->db->from('nomenklaturkabupaten');
        $this->db->where('Kode LIKE', $kodeProgram . '.%');
        // Kegiatan: 3 atau 4 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) >=', 3);
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) <=', 4);
        if ($this->db->field_exists('deleted_at', 'nomenklaturkabupaten')) {
            $this->db->where('deleted_at IS NULL', null, false);
        }
        $this->db->order_by('Kode', 'ASC');
        
        $data = $this->db->get()->result_array();
        
        log_message('debug', 'getKegiatanByProgram - kodeProgram: ' . $kodeProgram . ', result count: ' . count($data));
        
        echo json_encode($data);
    }

    /**
     * Get Sub Kegiatan by Kegiatan - 5 titik
     * POST: kode_kegiatan
     */
    public function getSubKegiatanByKegiatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $kodeKegiatan = trim($this->input->post('kode_kegiatan', TRUE));
        
        if (empty($kodeKegiatan)) {
            echo json_encode([]);
            return;
        }
        
        $this->db->select('Kode, Nomenklatur');
        $this->db->from('nomenklaturkabupaten');
        $this->db->where('Kode LIKE', $kodeKegiatan . '.%');
        // Sub Kegiatan: 5 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 5);
        if ($this->db->field_exists('deleted_at', 'nomenklaturkabupaten')) {
            $this->db->where('deleted_at IS NULL', null, false);
        }
        $this->db->order_by('Kode', 'ASC');
        
        $data = $this->db->get()->result_array();
        
        log_message('debug', 'getSubKegiatanByKegiatan - kodeKegiatan: ' . $kodeKegiatan . ', result count: ' . count($data));
        
        echo json_encode($data);
    }

    
        // ============================================================
        // CRUD MASTER + DETAIL
        // ============================================================

        /**
         * INPUT MASTER + DETAIL SEKALIGUS
         * URL: Daerah/InputKeselarasanPrioritasFull
         * POST: id_prioritas_nasional, kegiatan_prioritas, kode_sub_kegiatan[], id_perangkat_daerah[], keterangan[]
         */
        public function InputKeselarasanPrioritasFull() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menambah data.']);
                return;
            }
            
            // ============================================================
            // DATA MASTER (WAJIB)
            // ============================================================
            $idPrioritasNasional = (int)$this->input->post('id_prioritas_nasional', TRUE);
            $kegiatanPrioritas = trim($this->input->post('kegiatan_prioritas', TRUE));
            
            // ============================================================
            // DATA DETAIL (ARRAY) - SEMUA OPSIONAL
            // ============================================================
            $kodeSubKegiatan = $this->input->post('kode_sub_kegiatan', TRUE);
            $kodeKegiatan = $this->input->post('kode_kegiatan', TRUE);
            $kodeProgram = $this->input->post('kode_program', TRUE);
            $idPerangkatDaerah = $this->input->post('id_perangkat_daerah', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);
            
            // ============================================================
            // VALIDASI MASTER (WAJIB)
            // ============================================================
            if ($idPrioritasNasional <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Prioritas Nasional harus dipilih!']);
                return;
            }
            
            if (empty($kegiatanPrioritas)) {
                echo json_encode(['status' => 'error', 'message' => 'Kegiatan Prioritas Utama harus diisi!']);
                return;
            }
            
            // Cek duplikat master
            $exists = $this->db
                ->where('kode_wilayah', $KodeWilayah)
                ->where('id_prioritas_nasional', $idPrioritasNasional)
                ->where('kegiatan_prioritas', $kegiatanPrioritas)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_prioritas_master')
                ->num_rows();
            
            if ($exists > 0) {
                echo json_encode(['status' => 'error', 'message' => 'Data sudah ada! Gunakan Edit.']);
                return;
            }
            
            // ============================================================
            // VALIDASI DETAIL - MINIMAL 1 DETAIL DENGAN DATA
            // ============================================================
            $validDetails = 0;
            if (!empty($kodeSubKegiatan) && is_array($kodeSubKegiatan)) {
                foreach ($kodeSubKegiatan as $key => $value) {
                    // Cek apakah ada data yang terisi (Sub Kegiatan, Kegiatan, Program, PD, atau Keterangan)
                    $hasSub = !empty($value);
                    $hasKeg = isset($kodeKegiatan[$key]) && !empty($kodeKegiatan[$key]);
                    $hasProg = isset($kodeProgram[$key]) && !empty($kodeProgram[$key]);
                    $hasPd = isset($idPerangkatDaerah[$key]) && !empty($idPerangkatDaerah[$key]);
                    $hasKet = isset($keterangan[$key]) && !empty(trim($keterangan[$key]));
                    
                    if ($hasSub || $hasKeg || $hasProg || $hasPd || $hasKet) {
                        $validDetails++;
                    }
                }
            }
            
            if ($validDetails == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 dukungan RKPD 2026 dengan data yang diisi!']);
                return;
            }
            
            // ============================================================
            // MULAI TRANSAKSI
            // ============================================================
            $this->db->trans_start();
            
            // ============================================================
            // INSERT MASTER
            // ============================================================
            $masterData = [
                'kode_wilayah' => $KodeWilayah,
                'id_prioritas_nasional' => $idPrioritasNasional,
                'kegiatan_prioritas' => $kegiatanPrioritas,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('keselarasan_prioritas_master', $masterData);
            $masterId = $this->db->insert_id();
            
            if (!$masterId) {
                throw new Exception('Gagal menyimpan master!');
            }
            
            // ============================================================
            // INSERT DETAILS - SEMUA FIELD OPSIONAL
            // ============================================================
            $detailCount = 0;
            if (!empty($kodeSubKegiatan) && is_array($kodeSubKegiatan)) {
                foreach ($kodeSubKegiatan as $key => $kode) {
                    // Cek apakah ada data yang terisi
                    $hasSub = !empty($kode);
                    $hasKeg = isset($kodeKegiatan[$key]) && !empty($kodeKegiatan[$key]);
                    $hasProg = isset($kodeProgram[$key]) && !empty($kodeProgram[$key]);
                    $hasPd = isset($idPerangkatDaerah[$key]) && !empty($idPerangkatDaerah[$key]);
                    $hasKet = isset($keterangan[$key]) && !empty(trim($keterangan[$key]));
                    
                    // Jika tidak ada data sama sekali, skip
                    if (!$hasSub && !$hasKeg && !$hasProg && !$hasPd && !$hasKet) {
                        continue;
                    }
                    
                    // Ambil data dari array
                    $pdId = isset($idPerangkatDaerah[$key]) ? $idPerangkatDaerah[$key] : null;
                    $ket = isset($keterangan[$key]) ? trim($keterangan[$key]) : null;
                    $kegKode = isset($kodeKegiatan[$key]) ? $kodeKegiatan[$key] : '';
                    $progKode = isset($kodeProgram[$key]) ? $kodeProgram[$key] : '';
                    
                    // ============================================================
                    // SUB KEGIATAN - OPSIONAL
                    // ============================================================
                    $subNama = '';
                    if (!empty($kode)) {
                        $subData = $this->db
                            ->select('Kode, Nomenklatur')
                            ->from('nomenklaturkabupaten')
                            ->where('Kode', $kode)
                            ->get()
                            ->row_array();
                        if ($subData) {
                            $subNama = $subData['Nomenklatur'];
                        }
                    }
                    
                    // ============================================================
                    // KEGIATAN - OPSIONAL
                    // ============================================================
                    $kegiatan = '';
                    if (!empty($kegKode)) {
                        $kegData = $this->db
                            ->select('Nomenklatur')
                            ->from('nomenklaturkabupaten')
                            ->where('Kode', $kegKode)
                            ->get()
                            ->row_array();
                        if ($kegData) {
                            $kegiatan = $kegData['Nomenklatur'];
                        }
                    }
                    
                    // ============================================================
                    // PROGRAM - OPSIONAL
                    // ============================================================
                    $program = '';
                    if (!empty($progKode)) {
                        $progData = $this->db
                            ->select('Nomenklatur')
                            ->from('nomenklaturkabupaten')
                            ->where('Kode', $progKode)
                            ->get()
                            ->row_array();
                        if ($progData) {
                            $program = $progData['Nomenklatur'];
                        }
                    }
                    
                    $detailData = [
                        'id_master' => $masterId,
                        'kode_sub_kegiatan' => $kode ?: null,
                        'sub_kegiatan' => $subNama ?: null,
                        'kode_kegiatan' => $kegKode ?: null,
                        'kegiatan' => $kegiatan ?: null,
                        'kode_program' => $progKode ?: null,
                        'program' => $program ?: null,
                        'id_perangkat_daerah' => $pdId ?: null,
                        'keterangan' => $ket ?: null,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                    $this->db->insert('keselarasan_prioritas_detail', $detailData);
                    $detailCount++;
                }
            }
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menyimpan data!');
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil disimpan! (' . $detailCount . ' dukungan RKPD)',
                'master_id' => $masterId
            ]);
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'InputKeselarasanPrioritasFull: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

        public function EditKeselarasanPrioritasFull() {
        // Aktifkan error reporting untuk debugging
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        
        // Log untuk debugging
        log_message('debug', '=== EditKeselarasanPrioritasFull dipanggil ===');
        log_message('debug', 'POST data: ' . print_r($_POST, true));
        
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat mengedit data.']);
                return;
            }
            
            // ============================================================
            // DATA MASTER (WAJIB)
            // ============================================================
            $masterId = (int)$this->input->post('master_id', TRUE);
            $idPrioritasNasional = (int)$this->input->post('id_prioritas_nasional', TRUE);
            $kegiatanPrioritas = trim($this->input->post('kegiatan_prioritas', TRUE));
            
            // ============================================================
            // DATA DETAIL (ARRAY) - SEMUA OPSIONAL
            // ============================================================
            $detailIds = $this->input->post('detail_id', TRUE);
            $kodeSubKegiatan = $this->input->post('kode_sub_kegiatan', TRUE);
            $kodeKegiatan = $this->input->post('kode_kegiatan', TRUE);
            $kodeProgram = $this->input->post('kode_program', TRUE);
            $idPerangkatDaerah = $this->input->post('id_perangkat_daerah', TRUE);
            $keterangan = $this->input->post('keterangan', TRUE);
            
            // ✅ AMBIL DELETED DETAILS
            $deletedDetails = $this->input->post('deleted_details', TRUE);
            $deletedIds = [];
            
            if (!empty($deletedDetails)) {
                $deletedIds = array_filter(array_map('intval', explode(',', $deletedDetails)));
            }
            
            // ============================================================
            // VALIDASI MASTER (WAJIB)
            // ============================================================
            if ($masterId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID Master tidak valid!']);
                return;
            }
            
            if ($idPrioritasNasional <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Prioritas Nasional harus dipilih!']);
                return;
            }
            
            if (empty($kegiatanPrioritas)) {
                echo json_encode(['status' => 'error', 'message' => 'Kegiatan Prioritas Utama harus diisi!']);
                return;
            }
            
            // Cek master ada
            $master = $this->db
                ->where('id', $masterId)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_prioritas_master')
                ->row_array();
            
            if (!$master) {
                echo json_encode(['status' => 'error', 'message' => 'Master tidak ditemukan!']);
                return;
            }
            
            // ============================================================
            // VALIDASI DETAIL - MINIMAL 1 DETAIL DENGAN DATA
            // ============================================================
            $validDetails = 0;
            if (!empty($kodeSubKegiatan) && is_array($kodeSubKegiatan)) {
                foreach ($kodeSubKegiatan as $key => $value) {
                    if (!empty($value)) {
                        $validDetails++;
                    }
                }
            }
            
            if ($validDetails == 0) {
                echo json_encode(['status' => 'error', 'message' => 'Minimal ada 1 dukungan RKPD 2026 dengan Sub Kegiatan yang valid!']);
                return;
            }
            
            // ============================================================
            // MULAI TRANSAKSI
            // ============================================================
            $this->db->trans_start();
            
            // ============================================================
            // 1. UPDATE MASTER
            // ============================================================
            $this->db->where('id', $masterId);
            $this->db->update('keselarasan_prioritas_master', [
                'id_prioritas_nasional' => $idPrioritasNasional,
                'kegiatan_prioritas' => $kegiatanPrioritas,
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            // ============================================================
            // 2. HAPUS DETAIL YANG DITANDAI
            // ============================================================
            if (!empty($deletedIds)) {
                $this->db->where_in('id', $deletedIds);
                $this->db->where('id_master', $masterId);
                $this->db->update('keselarasan_prioritas_detail', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                
                log_message('debug', 'Deleted details: ' . implode(',', $deletedIds));
            }
            
            // ============================================================
            // 3. UPDATE/INSERT DETAIL
            // ============================================================
            if (!empty($kodeSubKegiatan) && is_array($kodeSubKegiatan)) {
                foreach ($kodeSubKegiatan as $key => $kode) {
                    if (empty($kode)) continue;
                    
                    $detailId = isset($detailIds[$key]) ? (int)$detailIds[$key] : 0;
                    $pdId = isset($idPerangkatDaerah[$key]) ? $idPerangkatDaerah[$key] : null;
                    $ket = isset($keterangan[$key]) ? trim($keterangan[$key]) : null;
                    $kegKode = isset($kodeKegiatan[$key]) ? $kodeKegiatan[$key] : '';
                    $progKode = isset($kodeProgram[$key]) ? $kodeProgram[$key] : '';
                    
                    // ============================================================
                    // SUB KEGIATAN - OPSIONAL
                    // ============================================================
                    $subNama = '';
                    if (!empty($kode)) {
                        $subData = $this->db
                            ->select('Kode, Nomenklatur')
                            ->from('nomenklaturkabupaten')
                            ->where('Kode', $kode)
                            ->get()
                            ->row_array();
                        if ($subData) {
                            $subNama = $subData['Nomenklatur'];
                        }
                    }
                    
                    // ============================================================
                    // KEGIATAN - OPSIONAL
                    // ============================================================
                    $kegiatan = '';
                    if (!empty($kegKode)) {
                        $kegData = $this->db
                            ->select('Nomenklatur')
                            ->from('nomenklaturkabupaten')
                            ->where('Kode', $kegKode)
                            ->get()
                            ->row_array();
                        if ($kegData) {
                            $kegiatan = $kegData['Nomenklatur'];
                        }
                    }
                    
                    // ============================================================
                    // PROGRAM - OPSIONAL
                    // ============================================================
                    $program = '';
                    if (!empty($progKode)) {
                        $progData = $this->db
                            ->select('Nomenklatur')
                            ->from('nomenklaturkabupaten')
                            ->where('Kode', $progKode)
                            ->get()
                            ->row_array();
                        if ($progData) {
                            $program = $progData['Nomenklatur'];
                        }
                    }
                    
                    $detailData = [
                        'id_master' => $masterId,
                        'kode_sub_kegiatan' => $kode ?: null,
                        'sub_kegiatan' => $subNama ?: null,
                        'kode_kegiatan' => $kegKode ?: null,
                        'kegiatan' => $kegiatan ?: null,
                        'kode_program' => $progKode ?: null,
                        'program' => $program ?: null,
                        'id_perangkat_daerah' => $pdId ?: null,
                        'keterangan' => $ket ?: null,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];
                    
                    if ($detailId > 0) {
                        // ✅ UPDATE EXISTING
                        $this->db->where('id', $detailId);
                        $this->db->where('id_master', $masterId);
                        $this->db->update('keselarasan_prioritas_detail', $detailData);
                        log_message('debug', 'Update detail ID: ' . $detailId);
                    } else {
                        // ✅ INSERT NEW
                        $detailData['created_at'] = date('Y-m-d H:i:s');
                        unset($detailData['updated_at']);
                        $this->db->insert('keselarasan_prioritas_detail', $detailData);
                        log_message('debug', 'Insert new detail');
                    }
                }
            }
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                $error = $this->db->error();
                log_message('error', 'Transaksi gagal: ' . $error['message']);
                throw new Exception('Gagal menyimpan data: ' . $error['message']);
            }
            
            // ============================================================
            // AMBIL DATA TERBARU UNTUK RESPONSE
            // ============================================================
            $updatedMaster = $this->db
                ->where('id', $masterId)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_prioritas_master')
                ->row_array();
            
            $updatedDetails = $this->db
                ->where('id_master', $masterId)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('keselarasan_prioritas_detail')
                ->result_array();
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil diupdate!',
                'data' => [
                    'master' => $updatedMaster,
                    'details' => $updatedDetails
                ]
            ]);
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'EditKeselarasanPrioritasFull Exception: ' . $e->getMessage());
            log_message('error', 'Trace: ' . $e->getTraceAsString());
            echo json_encode([
                'status' => 'error',
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ]);
        }
    }

        /**
         * HAPUS MASTER (Soft Delete - juga hapus semua detail)
         * URL: Daerah/HapusKeselarasanPrioritasMaster
         * POST: id
         */
        public function HapusKeselarasanPrioritasMaster() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                $KodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($KodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menghapus data.']);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                // Cek master ada
                $master = $this->db
                    ->where('id', $id)
                    ->where('kode_wilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_prioritas_master')
                    ->row_array();
                
                if (!$master) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                    return;
                }
                
                $now = date('Y-m-d H:i:s');
                
                // Soft delete master
                $this->db->where('id', $id);
                $this->db->where('kode_wilayah', $KodeWilayah);
                $this->db->update('keselarasan_prioritas_master', ['deleted_at' => $now]);
                
                // Soft delete semua detail
                $this->db->where('id_master', $id);
                $this->db->update('keselarasan_prioritas_detail', ['deleted_at' => $now]);
                
                echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus!']);
                
            } catch (Exception $e) {
                log_message('error', 'HapusKeselarasanPrioritasMaster: ' . $e->getMessage());
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }

        /**
         * GET DATA BY MASTER ID (UNTUK EDIT)
         * URL: Daerah/GetKeselarasanPrioritasByMasterId
         * POST: master_id
         */
        public function GetKeselarasanPrioritasByMasterId() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $masterId = (int)$this->input->post('master_id', TRUE);
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if ($masterId <= 0 || empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
                return;
            }
            
            // Ambil Master
            $master = $this->db
                ->where('id', $masterId)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_prioritas_master')
                ->row_array();
            
            if (!$master) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
                return;
            }
            
            // Ambil Details
            $details = $this->db
                ->where('id_master', $masterId)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('keselarasan_prioritas_detail')
                ->result_array();
            
            $master['details'] = $details;
            
            echo json_encode(['status' => 'success', 'data' => $master]);
        }

        /**
         * GET SINGLE DETAIL BY ID (untuk hapus individual)
         * URL: Daerah/GetKeselarasanPrioritasDetailById
         * POST: id
         */
        public function GetKeselarasanPrioritasDetailById() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
                return;
            }
            
            $data = $this->db
                ->where('id', $id)
                ->where('deleted_at IS NULL')
                ->get('keselarasan_prioritas_detail')
                ->row_array();
            
            if ($data) {
                echo json_encode(['status' => 'success', 'data' => $data]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            }
        }

        /**
         * HAPUS SINGLE DETAIL (Soft Delete)
         * URL: Daerah/HapusKeselarasanPrioritasDetail
         * POST: id
         */
        public function HapusKeselarasanPrioritasDetail() {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }
            
            header('Content-Type: application/json');
            
            try {
                $KodeWilayah = $this->session->userdata('KodeWilayah') 
                            ?? $this->session->userdata('TempKodeWilayah');
                
                if (empty($KodeWilayah)) {
                    echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                    return;
                }
                
                if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menghapus data.']);
                    return;
                }
                
                $id = (int)$this->input->post('id', TRUE);
                
                if ($id <= 0) {
                    echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                    return;
                }
                
                // Cek detail ada
                $detail = $this->db
                    ->where('id', $id)
                    ->where('deleted_at IS NULL')
                    ->get('keselarasan_prioritas_detail')
                    ->row_array();
                
                if (!$detail) {
                    echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
                    return;
                }
                
                $this->db->where('id', $id);
                $this->db->update('keselarasan_prioritas_detail', [
                    'deleted_at' => date('Y-m-d H:i:s')
                ]);
                
                echo json_encode(['status' => 'success', 'message' => 'Dukungan RKPD berhasil dihapus!']);
                
            } catch (Exception $e) {
                log_message('error', 'HapusKeselarasanPrioritasDetail: ' . $e->getMessage());
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }

    // ============================================================
    // KESELARASAN INTERVENSI PEMBANGUNAN KEWILAYAHAN - 3 LEVEL
    // ============================================================

    /**
     * Halaman Utama Keselarasan Intervensi
     * URL: Daerah/KeselarasanIntervensi
     */
    public function KeselarasanIntervensi() {
        $Header['Halaman'] = 'Keselarasan Intervensi Pembangunan Kewilayahan';
        
        $KodeWilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') 
                    ?? '';
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        
        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }
        
        // Data Provinsi untuk filter
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();
        
        // Data Perangkat Daerah untuk dropdown
        $Data['PerangkatDaerah'] = [];
        if (!empty($KodeWilayah)) {
            $Data['PerangkatDaerah'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        }
        
        // ============================================================
        // AMBIL DATA LENGKAP - 3 LEVEL
        // ============================================================
        $Data['ListData'] = [];
        
        if (!empty($KodeWilayah)) {
            // Ambil semua Lokasi Prioritas (Level 1)
            $lokasi = $this->db
                ->select('*')
                ->from('intervensi_lokasi_prioritas')
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get()
                ->result_array();
            
            foreach ($lokasi as &$lokasiRow) {
                // Ambil Highlight Intervensi (Level 2) untuk setiap Lokasi
                $highlight = $this->db
                    ->select('*')
                    ->from('intervensi_highlight')
                    ->where('lokasi_prioritas_id', $lokasiRow['id'])
                    ->where('deleted_at IS NULL')
                    ->order_by('id', 'ASC')
                    ->get()
                    ->result_array();
                
                foreach ($highlight as &$highlightRow) {
                    // Ambil Detail Intervensi (Level 3 - Gabungan) untuk setiap Highlight
                    $detail = $this->db
                        ->select('d.*, a.nama as perangkat_daerah_nama')
                        ->from('intervensi_detail d')
                        ->join('akun_instansi a', 'a.id = d.id_perangkat_daerah', 'left')
                        ->where('d.highlight_id', $highlightRow['id'])
                        ->where('d.deleted_at IS NULL')
                        ->order_by('d.urutan', 'ASC')
                        ->order_by('d.id', 'ASC')
                        ->get()
                        ->result_array();
                    
                    $highlightRow['detail'] = $detail;
                }
                
                $lokasiRow['highlight'] = $highlight;
            }
            
            $Data['ListData'] = $lokasi;
        }
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/KeselarasanIntervensi', $Data);
    }

    // ============================================================
    // CRUD LOKASI PRIORITAS (Level 1)
    // ============================================================

    public function InputLokasiPrioritas() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menambah data.']);
                return;
            }
            
            $namaLokasi = trim($this->input->post('nama_lokasi', TRUE));
            $wilayahIds = $this->input->post('wilayah_ids', TRUE);
            
            if (empty($namaLokasi)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Lokasi Prioritas harus diisi!']);
                return;
            }
            
            // Proses wilayah_ids menjadi string dengan separator '•'
            $wilayahText = '';
            $wilayahIdsString = '';
            if (!empty($wilayahIds) && is_array($wilayahIds)) {
                $wilayahIds = array_filter($wilayahIds);
                if (!empty($wilayahIds)) {
                    $wilayahData = $this->db
                        ->select('Nama')
                        ->where_in('Kode', $wilayahIds)
                        ->get('kodewilayah')
                        ->result_array();
                    $wilayahNames = array_column($wilayahData, 'Nama');
                    $wilayahText = implode(' • ', $wilayahNames);
                    $wilayahIdsString = implode(',', $wilayahIds);
                }
            }
            
            $data = [
                'kode_wilayah' => $KodeWilayah,
                'nama_lokasi' => $namaLokasi,
                'wilayah_text' => $wilayahText,
                'wilayah_ids' => $wilayahIdsString,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('intervensi_lokasi_prioritas', $data);
            $lokasiId = $this->db->insert_id();
            
            if ($lokasiId) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Lokasi Prioritas berhasil ditambahkan!',
                    'id' => $lokasiId
                ]);
            } else {
                throw new Exception('Gagal menyimpan data!');
            }
            
        } catch (Exception $e) {
            log_message('error', 'InputLokasiPrioritas: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function UpdateLokasiPrioritas() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat mengedit data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $namaLokasi = trim($this->input->post('nama_lokasi', TRUE));
            $wilayahIds = $this->input->post('wilayah_ids', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            if (empty($namaLokasi)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Lokasi Prioritas harus diisi!']);
                return;
            }
            
            $wilayahText = '';
            $wilayahIdsString = '';
            if (!empty($wilayahIds) && is_array($wilayahIds)) {
                $wilayahIds = array_filter($wilayahIds);
                if (!empty($wilayahIds)) {
                    $wilayahData = $this->db
                        ->select('Nama')
                        ->where_in('Kode', $wilayahIds)
                        ->get('kodewilayah')
                        ->result_array();
                    $wilayahNames = array_column($wilayahData, 'Nama');
                    $wilayahText = implode(' • ', $wilayahNames);
                    $wilayahIdsString = implode(',', $wilayahIds);
                }
            }
            
            $data = [
                'nama_lokasi' => $namaLokasi,
                'wilayah_text' => $wilayahText,
                'wilayah_ids' => $wilayahIdsString,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $KodeWilayah);
            $this->db->update('intervensi_lokasi_prioritas', $data);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Lokasi Prioritas berhasil diupdate!'
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'UpdateLokasiPrioritas: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function HapusLokasiPrioritas() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menghapus data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $now = date('Y-m-d H:i:s');
            
            // Soft delete Lokasi Prioritas
            $this->db->where('id', $id);
            $this->db->where('kode_wilayah', $KodeWilayah);
            $this->db->update('intervensi_lokasi_prioritas', ['deleted_at' => $now]);
            
            // Soft delete semua Highlight terkait
            $highlightIds = $this->db
                ->select('id')
                ->where('lokasi_prioritas_id', $id)
                ->where('deleted_at IS NULL')
                ->get('intervensi_highlight')
                ->result_array();
            
            if (!empty($highlightIds)) {
                $highlightIdList = array_column($highlightIds, 'id');
                
                $this->db->where_in('id', $highlightIdList);
                $this->db->update('intervensi_highlight', ['deleted_at' => $now]);
                
                // Soft delete semua Detail terkait
                $detailIds = $this->db
                    ->select('id')
                    ->where_in('highlight_id', $highlightIdList)
                    ->where('deleted_at IS NULL')
                    ->get('intervensi_detail')
                    ->result_array();
                
                if (!empty($detailIds)) {
                    $detailIdList = array_column($detailIds, 'id');
                    $this->db->where_in('id', $detailIdList);
                    $this->db->update('intervensi_detail', ['deleted_at' => $now]);
                }
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil dihapus!'
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'HapusLokasiPrioritas: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function GetLokasiPrioritasById() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        $KodeWilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');
        
        if ($id <= 0 || empty($KodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $data = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->get('intervensi_lokasi_prioritas')
            ->row_array();
        
        if ($data) {
            $data['wilayah_ids_array'] = !empty($data['wilayah_ids']) ? explode(',', $data['wilayah_ids']) : [];
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    // ============================================================
    // CRUD HIGHLIGHT INTERVENSI (Level 2) - DENGAN WILAYAH
    // ============================================================

    public function InputHighlightIntervensi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menambah data.']);
                return;
            }
            
            $lokasiId = (int)$this->input->post('lokasi_id', TRUE);
            $namaHighlight = trim($this->input->post('nama_highlight', TRUE));
            $wilayahIds = $this->input->post('wilayah_ids', TRUE);
            
            // DEBUG: Log data yang diterima
            log_message('debug', 'InputHighlightIntervensi - wilayah_ids: ' . print_r($wilayahIds, true));
            
            if ($lokasiId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Lokasi Prioritas tidak valid!']);
                return;
            }
            
            if (empty($namaHighlight)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Highlight Intervensi harus diisi!']);
                return;
            }
            
            // Proses wilayah_ids
            $wilayahText = '';
            $wilayahIdsString = '';
            if (!empty($wilayahIds) && is_array($wilayahIds)) {
                // Filter nilai kosong
                $wilayahIds = array_filter($wilayahIds, function($val) {
                    return !empty($val) && $val !== 'null' && $val !== 'undefined';
                });
                
                if (!empty($wilayahIds)) {
                    // Ambil nama wilayah dari tabel kodewilayah
                    $wilayahData = $this->db
                        ->select('Nama')
                        ->where_in('Kode', $wilayahIds)
                        ->get('kodewilayah')
                        ->result_array();
                    $wilayahNames = array_column($wilayahData, 'Nama');
                    $wilayahText = implode(' • ', $wilayahNames);
                    $wilayahIdsString = implode(',', $wilayahIds);
                }
            }
            
            // DEBUG: Log data yang akan disimpan
            log_message('debug', 'InputHighlightIntervensi - wilText: ' . $wilayahText . ', wilIds: ' . $wilayahIdsString);
            
            $data = [
                'lokasi_prioritas_id' => $lokasiId,
                'nama_highlight' => $namaHighlight,
                'wilayah_text' => $wilayahText,
                'wilayah_ids' => $wilayahIdsString,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            // DEBUG: Log full data
            log_message('debug', 'InputHighlightIntervensi - Data: ' . print_r($data, true));
            
            $this->db->insert('intervensi_highlight', $data);
            $highlightId = $this->db->insert_id();
            
            if ($highlightId) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Highlight Intervensi berhasil ditambahkan!',
                    'id' => $highlightId,
                    'data' => $data // Kembalikan data untuk debug
                ]);
            } else {
                $error = $this->db->error();
                log_message('error', 'InputHighlightIntervensi DB Error: ' . $error['message']);
                throw new Exception('Gagal menyimpan data: ' . $error['message']);
            }
            
        } catch (Exception $e) {
            log_message('error', 'InputHighlightIntervensi Exception: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function UpdateHighlightIntervensi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat mengedit data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $lokasiId = (int)$this->input->post('lokasi_id', TRUE);
            $namaHighlight = trim($this->input->post('nama_highlight', TRUE));
            $wilayahIds = $this->input->post('wilayah_ids', TRUE);
            
            if ($id <= 0 || $lokasiId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                return;
            }
            
            if (empty($namaHighlight)) {
                echo json_encode(['status' => 'error', 'message' => 'Nama Highlight Intervensi harus diisi!']);
                return;
            }
            
            $wilayahText = '';
            $wilayahIdsString = '';
            if (!empty($wilayahIds) && is_array($wilayahIds)) {
                $wilayahIds = array_filter($wilayahIds);
                if (!empty($wilayahIds)) {
                    $wilayahData = $this->db
                        ->select('Nama')
                        ->where_in('Kode', $wilayahIds)
                        ->get('kodewilayah')
                        ->result_array();
                    $wilayahNames = array_column($wilayahData, 'Nama');
                    $wilayahText = implode(' • ', $wilayahNames);
                    $wilayahIdsString = implode(',', $wilayahIds);
                }
            }
            
            $data = [
                'lokasi_prioritas_id' => $lokasiId,
                'nama_highlight' => $namaHighlight,
                'wilayah_text' => $wilayahText,
                'wilayah_ids' => $wilayahIdsString,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id', $id);
            $this->db->update('intervensi_highlight', $data);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Highlight Intervensi berhasil diupdate!'
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'UpdateHighlightIntervensi: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function HapusHighlightIntervensi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menghapus data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $now = date('Y-m-d H:i:s');
            
            // Soft delete Highlight
            $this->db->where('id', $id);
            $this->db->update('intervensi_highlight', ['deleted_at' => $now]);
            
            // Soft delete semua Detail terkait
            $detailIds = $this->db
                ->select('id')
                ->where('highlight_id', $id)
                ->where('deleted_at IS NULL')
                ->get('intervensi_detail')
                ->result_array();
            
            if (!empty($detailIds)) {
                $detailIdList = array_column($detailIds, 'id');
                $this->db->where_in('id', $detailIdList);
                $this->db->update('intervensi_detail', ['deleted_at' => $now]);
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Highlight Intervensi berhasil dihapus!'
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'HapusHighlightIntervensi: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function GetHighlightIntervensiById() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $data = $this->db
            ->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('intervensi_highlight')
            ->row_array();
        
        if ($data) {
            $data['wilayah_ids_array'] = !empty($data['wilayah_ids']) ? explode(',', $data['wilayah_ids']) : [];
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    // ============================================================
    // CRUD DETAIL INTERVENSI (Level 3 - Gabungan Lokasi + Dukungan)
    // ============================================================

    public function InputDetailIntervensi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menambah data.']);
                return;
            }
            
            $highlightId = (int)$this->input->post('highlight_id', TRUE);
            
            // === LOKASI (Hanya wilayah, tidak ada nama lokasi) ===
            $wilayahIds = $this->input->post('lokasi_wilayah_ids', TRUE);
            
            // === DUKUNGAN RKPD ===
            $kodeProgram = trim($this->input->post('kode_program', TRUE));
            $kodeKegiatan = trim($this->input->post('kode_kegiatan', TRUE));
            $kodeSubKegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
            $idPerangkatDaerah = $this->input->post('id_perangkat_daerah', TRUE);
            $keterangan = trim($this->input->post('keterangan', TRUE));
            
            if ($highlightId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Highlight Intervensi tidak valid!']);
                return;
            }
            
            // Proses wilayah_ids - HANYA WILAYAH, TIDAK ADA NAMA LOKASI
            $wilayahText = '';
            $wilayahIdsString = '';
            if (!empty($wilayahIds) && is_array($wilayahIds)) {
                $wilayahIds = array_filter($wilayahIds);
                if (!empty($wilayahIds)) {
                    $wilayahData = $this->db
                        ->select('Nama')
                        ->where_in('Kode', $wilayahIds)
                        ->get('kodewilayah')
                        ->result_array();
                    $wilayahNames = array_column($wilayahData, 'Nama');
                    $wilayahText = implode(' • ', $wilayahNames);
                    $wilayahIdsString = implode(',', $wilayahIds);
                }
            }
            
            // Ambil nama dari nomenklatur
            $program = '';
            if (!empty($kodeProgram)) {
                $progData = $this->db->select('Nomenklatur')
                    ->from('nomenklaturkabupaten')
                    ->where('Kode', $kodeProgram)
                    ->get()
                    ->row_array();
                if ($progData) {
                    $program = $progData['Nomenklatur'];
                }
            }
            
            $kegiatan = '';
            if (!empty($kodeKegiatan)) {
                $kegData = $this->db->select('Nomenklatur')
                    ->from('nomenklaturkabupaten')
                    ->where('Kode', $kodeKegiatan)
                    ->get()
                    ->row_array();
                if ($kegData) {
                    $kegiatan = $kegData['Nomenklatur'];
                }
            }
            
            $subKegiatan = '';
            if (!empty($kodeSubKegiatan)) {
                $subData = $this->db->select('Nomenklatur')
                    ->from('nomenklaturkabupaten')
                    ->where('Kode', $kodeSubKegiatan)
                    ->get()
                    ->row_array();
                if ($subData) {
                    $subKegiatan = $subData['Nomenklatur'];
                }
            }
            
            // Dapatkan urutan terakhir
            $lastUrutan = $this->db
                ->select_max('urutan')
                ->where('highlight_id', $highlightId)
                ->where('deleted_at IS NULL')
                ->get('intervensi_detail')
                ->row()
                ->urutan;
            
            $urutan = ($lastUrutan ? $lastUrutan + 10 : 10);
            
            $data = [
                'highlight_id' => $highlightId,
                'lokasi_wilayah_text' => $wilayahText,
                'lokasi_wilayah_ids' => $wilayahIdsString,
                'kode_program' => $kodeProgram ?: null,
                'program' => $program ?: null,
                'kode_kegiatan' => $kodeKegiatan ?: null,
                'kegiatan' => $kegiatan ?: null,
                'kode_sub_kegiatan' => $kodeSubKegiatan ?: null,
                'sub_kegiatan' => $subKegiatan ?: null,
                'id_perangkat_daerah' => $idPerangkatDaerah ?: null,
                'keterangan' => $keterangan ?: null,
                'urutan' => $urutan,
                'created_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('intervensi_detail', $data);
            $detailId = $this->db->insert_id();
            
            if ($detailId) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Data berhasil ditambahkan!',
                    'id' => $detailId
                ]);
            } else {
                throw new Exception('Gagal menyimpan data!');
            }
            
        } catch (Exception $e) {
            log_message('error', 'InputDetailIntervensi: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function UpdateDetailIntervensi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat mengedit data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $highlightId = (int)$this->input->post('highlight_id', TRUE);
            
            // === LOKASI (Hanya wilayah) ===
            $wilayahIds = $this->input->post('lokasi_wilayah_ids', TRUE);
            
            // === DUKUNGAN RKPD ===
            $kodeProgram = trim($this->input->post('kode_program', TRUE));
            $kodeKegiatan = trim($this->input->post('kode_kegiatan', TRUE));
            $kodeSubKegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
            $idPerangkatDaerah = $this->input->post('id_perangkat_daerah', TRUE);
            $keterangan = trim($this->input->post('keterangan', TRUE));
            
            if ($id <= 0 || $highlightId <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                return;
            }
            
            // Proses wilayah_ids
            $wilayahText = '';
            $wilayahIdsString = '';
            if (!empty($wilayahIds) && is_array($wilayahIds)) {
                $wilayahIds = array_filter($wilayahIds);
                if (!empty($wilayahIds)) {
                    $wilayahData = $this->db
                        ->select('Nama')
                        ->where_in('Kode', $wilayahIds)
                        ->get('kodewilayah')
                        ->result_array();
                    $wilayahNames = array_column($wilayahData, 'Nama');
                    $wilayahText = implode(' • ', $wilayahNames);
                    $wilayahIdsString = implode(',', $wilayahIds);
                }
            }
            
            // Ambil nama dari nomenklatur
            $program = '';
            if (!empty($kodeProgram)) {
                $progData = $this->db->select('Nomenklatur')
                    ->from('nomenklaturkabupaten')
                    ->where('Kode', $kodeProgram)
                    ->get()
                    ->row_array();
                if ($progData) {
                    $program = $progData['Nomenklatur'];
                }
            }
            
            $kegiatan = '';
            if (!empty($kodeKegiatan)) {
                $kegData = $this->db->select('Nomenklatur')
                    ->from('nomenklaturkabupaten')
                    ->where('Kode', $kodeKegiatan)
                    ->get()
                    ->row_array();
                if ($kegData) {
                    $kegiatan = $kegData['Nomenklatur'];
                }
            }
            
            $subKegiatan = '';
            if (!empty($kodeSubKegiatan)) {
                $subData = $this->db->select('Nomenklatur')
                    ->from('nomenklaturkabupaten')
                    ->where('Kode', $kodeSubKegiatan)
                    ->get()
                    ->row_array();
                if ($subData) {
                    $subKegiatan = $subData['Nomenklatur'];
                }
            }
            
            $data = [
                'highlight_id' => $highlightId,
                'lokasi_wilayah_text' => $wilayahText,
                'lokasi_wilayah_ids' => $wilayahIdsString,
                'kode_program' => $kodeProgram ?: null,
                'program' => $program ?: null,
                'kode_kegiatan' => $kodeKegiatan ?: null,
                'kegiatan' => $kegiatan ?: null,
                'kode_sub_kegiatan' => $kodeSubKegiatan ?: null,
                'sub_kegiatan' => $subKegiatan ?: null,
                'id_perangkat_daerah' => $idPerangkatDaerah ?: null,
                'keterangan' => $keterangan ?: null,
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id', $id);
            $this->db->update('intervensi_detail', $data);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil diupdate!'
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'UpdateDetailIntervensi: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function HapusDetailIntervensi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');
            
            if (empty($KodeWilayah)) {
                echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
                return;
            }
            
            if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 3) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Daerah (Level 3) yang dapat menghapus data.']);
                return;
            }
            
            $id = (int)$this->input->post('id', TRUE);
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
                return;
            }
            
            $this->db->where('id', $id);
            $this->db->update('intervensi_detail', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
            
            echo json_encode([
                'status' => 'success',
                'message' => 'Data berhasil dihapus!'
            ]);
            
        } catch (Exception $e) {
            log_message('error', 'HapusDetailIntervensi: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function GetDetailIntervensiById() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        $KodeWilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');
        
        if ($id <= 0 || empty($KodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $data = $this->db
            ->select('d.*, a.nama as perangkat_daerah_nama')
            ->from('intervensi_detail d')
            ->join('akun_instansi a', 'a.id = d.id_perangkat_daerah', 'left')
            ->where('d.id', $id)
            ->where('d.deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if ($data) {
            $data['lokasi_wilayah_ids_array'] = !empty($data['lokasi_wilayah_ids']) ? explode(',', $data['lokasi_wilayah_ids']) : [];
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    // ============================================================
    // GET WILAYAH HIERARKI
    // ============================================================

    public function getProvinsiWilayah() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $data = $this->db
            ->select('Kode, Nama')
            ->where("Kode LIKE '__'")
            ->where('LENGTH(Kode) = 2')
            ->order_by('Nama', 'ASC')
            ->get('kodewilayah')
            ->result_array();
        
        echo json_encode($data);
    }

    public function getKabKotaWilayah() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $kodeProvinsi = $this->input->post('kode', TRUE);
        
        if (empty($kodeProvinsi)) {
            echo json_encode([]);
            return;
        }
        
        $data = $this->db
            ->select('Kode, Nama')
            ->where('Kode LIKE', $kodeProvinsi . '.%')
            ->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1)
            ->order_by('Nama', 'ASC')
            ->get('kodewilayah')
            ->result_array();
        
        echo json_encode($data);
    }

    public function getKecamatanWilayah() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $kodeKabKota = $this->input->post('kode', TRUE);
        
        if (empty($kodeKabKota)) {
            echo json_encode([]);
            return;
        }
        
        $data = $this->db
            ->select('Kode, Nama')
            ->where('Kode LIKE', $kodeKabKota . '.%')
            ->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 2)
            ->order_by('Nama', 'ASC')
            ->get('kodewilayah')
            ->result_array();
        
        echo json_encode($data);
    }

    public function getDesaWilayah() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $kodeKecamatan = $this->input->post('kode', TRUE);
        
        if (empty($kodeKecamatan)) {
            echo json_encode([]);
            return;
        }
        
        $data = $this->db
            ->select('Kode, Nama')
            ->where('Kode LIKE', $kodeKecamatan . '.%')
            ->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 3)
            ->order_by('Nama', 'ASC')
            ->get('kodewilayah')
            ->result_array();
        
        echo json_encode($data);
    }

    public function getNamaWilayahByKode() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $kode = $this->input->post('kode', TRUE);
        
        if (empty($kode)) {
            echo json_encode(['status' => 'error', 'message' => 'Kode tidak valid']);
            return;
        }
        
        $data = $this->db
            ->select('Nama')
            ->where('Kode', $kode)
            ->get('kodewilayah')
            ->row_array();
        
        if ($data) {
            echo json_encode(['status' => 'success', 'nama' => $data['Nama']]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }



        }
        
