
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kementerian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
    }
      public function GetPeriodeKementerian(){
    echo json_encode($this->db->query("SELECT * FROM `kementerian` GROUP BY TahunMulai")->result_array());
	}

  public function GetListKementerian(){
    echo json_encode($this->db->where("TahunMulai = ".$_POST['TahunMulai']." AND deleted_at IS NULL")->get("kementerian")->result_array());
	}

    public function Kementerian() {
      $Header['Halaman'] = 'Isu';
      $Data['Kementerian'] = $this->db->query("SELECT * FROM `kementerian` WHERE deleted_at IS NULL")->result_array();
      $this->load->view('Kementerian/header', $Header);
      $this->load->view('Kementerian/Kementerian', $Data);
    }

  public function InputKementerian() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    // Validate period
    if (!is_numeric($TahunMulai) || !is_numeric($TahunAkhir) || $TahunMulai > $TahunAkhir) {
        echo 'Tahun Mulai harus lebih kecil atau sama dengan Tahun Akhir!';
        return;
    }

    $data = [
        'NamaKementerian' => $this->input->post('NamaKementerian'),
        'TahunMulai' => $TahunMulai,
        'TahunAkhir' => $TahunAkhir,
        'created_at' => date('Y-m-d H:i:s')
    ];
    $this->db->insert('kementerian', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
  }

  public function UpdateKementerian() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    // Validate period
    if (!is_numeric($TahunMulai) || !is_numeric($TahunAkhir) || $TahunMulai > $TahunAkhir) {
        echo 'Tahun Mulai harus lebih kecil atau sama dengan Tahun Akhir!';
        return;
    }

      $data = [
          'NamaKementerian' => $this->input->post('NamaKementerian'),
          'TahunMulai' => $TahunMulai,
          'TahunAkhir' => $TahunAkhir,
          'edited_at' => date('Y-m-d H:i:s')
      ];
      $this->db->where('Id', $this->input->post('Id'));
      $this->db->update('kementerian', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
  }

  public function DeleteKementerian() {
      $data = [
          'deleted_at' => date('Y-m-d H:i:s')
      ];
      $this->db->where('Id', $this->input->post('Id'));
      $this->db->update('kementerian', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
  }

  
    public function Main() {
        // Get filter parameters
        $periodeFilter = $this->input->get('periode');
        $kementerianFilter = $this->input->get('kementerian');
        
        // Get all unique periods
        $Data['AllPeriode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir 
            FROM kementerian 
            WHERE deleted_at IS NULL
            ORDER BY TahunMulai DESC
        ")->result_array();
        
        // Get ministries based on period filter
        if ($periodeFilter) {
            list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
            $Data['Kementerian'] = $this->db->get_where('kementerian', [
                'TahunMulai' => $tahunMulai,
                'TahunAkhir' => $tahunAkhir,
                'deleted_at' => NULL
            ])->result_array();
        } else {
            $Data['Kementerian'] = [];
        }
        
        // Get selected ministry data if filter is applied
        $Data['SelectedKementerian'] = [];
        if ($kementerianFilter) {
            $Data['SelectedKementerian'] = $this->db->get_where('kementerian', [
                'Id' => $kementerianFilter,
                'deleted_at' => NULL
            ])->row_array();
        }
        
        // Store current filters
        $Data['CurrentPeriode'] = $periodeFilter;
        $Data['CurrentKementerian'] = $kementerianFilter;
        
        $this->load->view('Kementerian/Main', $Data);
    }

    // AJAX function to get ministries based on selected period
    public function get_kementerian() {
        $periode = $this->input->post('periode');
        
        if ($periode) {
            list($tahunMulai, $tahunAkhir) = explode('|', $periode);
            $kementerian = $this->db->get_where('kementerian', [
                'TahunMulai' => $tahunMulai,
                'TahunAkhir' => $tahunAkhir,
                'deleted_at' => NULL
            ])->result_array();
            
            echo json_encode($kementerian);
        } else {
            echo json_encode([]);
        }
    }


    public function SPM() {

        $Header['Halaman'] = 'Kementerian';

        // SESSION
        $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
        $userLevel  = $_SESSION['userLevel'] ?? ($_SESSION['Level'] ?? 2);
        $userIdKementerian = $_SESSION['IdKementerian'] ?? null;

        // FILTER URL
        $periodeFilter      = $this->input->get('periode');
        $kementerianFilter  = $this->input->get('kementerian');

        // QUERY UTAMA
        $this->db->select('s.*, k.NamaKementerian');
        $this->db->from('spm s');
        $this->db->join('kementerian k', 's.IdKementerian = k.Id', 'left');
        $this->db->where('s.deleted_at IS NULL');

        // 🔐 PEMBATASAN ROLE
        if ($isLoggedIn && $userLevel == 1) {
            // KEMENTERIAN → DATA SENDIRI
            $this->db->where('s.IdKementerian', $userIdKementerian);
        } elseif ($kementerianFilter) {
            // ADMIN / PUBLIK → FILTER
            $this->db->where('s.IdKementerian', $kementerianFilter);
        }

        // FILTER PERIODE
        if ($periodeFilter) {
            [$tahunMulai, $tahunAkhir] = explode('|', $periodeFilter);
            $this->db->where('s.TahunMulai', $tahunMulai);
            $this->db->where('s.TahunAkhir', $tahunAkhir);
        }

        $this->db->order_by('k.NamaKementerian', 'asc');
        $Data['SPM'] = $this->db->get()->result_array();

        /* =========================
         * DATA PENDUKUNG
         * ========================= */
        $Data['AllPeriode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM kementerian
            WHERE deleted_at IS NULL
            ORDER BY TahunMulai DESC
        ")->result_array();

        // Dropdown kementerian hanya admin & publik
        if (!$isLoggedIn || $userLevel == 0) {
            if ($periodeFilter) {
                [$tm, $ta] = explode('|', $periodeFilter);
                $Data['Kementerian'] = $this->db->get_where('kementerian', [
                    'TahunMulai' => $tm,
                    'TahunAkhir' => $ta,
                    'deleted_at' => NULL
                ])->result_array();
            } else {
                $Data['Kementerian'] = [];
            }
        } else {
            $Data['Kementerian'] = [];
        }

        // Info view
        $Data['isLoggedIn'] = $isLoggedIn;
        $Data['userLevel'] = $userLevel;
        $Data['userIdKementerian'] = $userIdKementerian;
        $Data['CurrentPeriode'] = $periodeFilter;
        $Data['CurrentKementerian'] = $kementerianFilter;

        // Nama kementerian login (opsional)
        if ($userLevel == 1 && $userIdKementerian) {
            $k = $this->db->get_where('kementerian', ['Id' => $userIdKementerian])->row_array();
            $Data['UserKementerianName'] = $k['NamaKementerian'] ?? 'Kementerian Anda';
        }

        $this->load->view('Kementerian/header', $Header);
        $this->load->view('Kementerian/SPM', $Data);
    }

    /* =====================================================
     *  INPUT SPM
     * ===================================================== */
    public function InputSPM() {

        $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
        $userLevel  = $_SESSION['userLevel'] ?? ($_SESSION['Level'] ?? null);

        if (!$isLoggedIn || !in_array($userLevel, [0,1])) {
            echo 'Unauthorized';
            return;
        }

        // =========================
        // USER KEMENTERIAN
        // =========================
        if ($userLevel == 1) {

            $IdKementerian = $_SESSION['IdKementerian'] ?? null;
            if (!$IdKementerian) {
                echo 'Session kementerian tidak ditemukan!';
                return;
            }

            // AMBIL PERIODE DARI DB (OTOMATIS)
            $k = $this->db->select('TahunMulai, TahunAkhir')
                          ->from('kementerian')
                          ->where('Id', $IdKementerian)
                          ->where('deleted_at', NULL)
                          ->get()->row_array();

            if (!$k) {
                echo 'Periode kementerian tidak ditemukan!';
                return;
            }

            $TahunMulai = $k['TahunMulai'];
            $TahunAkhir = $k['TahunAkhir'];
        }

        // =========================
        // ADMIN
        // =========================
        if ($userLevel == 0) {

            if (
                !$this->input->post('IdKementerian') ||
                !$this->input->post('TahunMulai') ||
                !$this->input->post('TahunAkhir')
            ) {
                echo 'Admin wajib memilih periode dan kementerian!';
                return;
            }

            $IdKementerian = $this->input->post('IdKementerian');
            $TahunMulai    = $this->input->post('TahunMulai');
            $TahunAkhir    = $this->input->post('TahunAkhir');
        }

        $data = [
            'IdKementerian' => $IdKementerian,
            'NamaSPM'       => $this->input->post('NamaSPM'),
            'TahunMulai'    => $TahunMulai,
            'TahunAkhir'    => $TahunAkhir,
            'TargetTahun1'  => $this->input->post('TargetTahun1') ?: 0,
            'TargetTahun2'  => $this->input->post('TargetTahun2') ?: 0,
            'TargetTahun3'  => $this->input->post('TargetTahun3') ?: 0,
            'TargetTahun4'  => $this->input->post('TargetTahun4') ?: 0,
            'TargetTahun5'  => $this->input->post('TargetTahun5') ?: 0,
            'created_at'    => date('Y-m-d H:i:s')
        ];

        $this->db->insert('spm', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
    }

    /* =====================================================
     *  UPDATE SPM
     * ===================================================== */
    public function UpdateSPM() {

        if (!isset($_SESSION['isLoggedIn']) || $_SESSION['userLevel'] != 1) {
            echo 'Tidak punya hak akses!';
            return;
        }

        $this->db->where('Id', $this->input->post('Id'));
        $this->db->where('IdKementerian', $_SESSION['IdKementerian']); // 🔐

        $data = [
            'NamaSPM'       => $this->input->post('NamaSPM'),
            'TargetTahun1'  => $this->input->post('TargetTahun1'),
            'TargetTahun2'  => $this->input->post('TargetTahun2'),
            'TargetTahun3'  => $this->input->post('TargetTahun3'),
            'TargetTahun4'  => $this->input->post('TargetTahun4'),
            'TargetTahun5'  => $this->input->post('TargetTahun5'),
            'edited_at'     => date('Y-m-d H:i:s')
        ];

        $this->db->update('spm', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
    }

    /* =====================================================
     *  DELETE SPM
     * ===================================================== */
    public function DeleteSPM() {

        if (!isset($_SESSION['isLoggedIn']) || $_SESSION['userLevel'] != 1) {
            echo 'Tidak punya hak akses!';
            return;
        }

        $this->db->where('Id', $this->input->post('Id'));
        $this->db->where('IdKementerian', $_SESSION['IdKementerian']); // 🔐

        $this->db->update('spm', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
    }



     public function ProyekStrategis() {
        $Header['Halaman'] = 'Kementerian';
        
        // Get filter parameters
        $periodeFilter = $this->input->get('periode');
        $kementerianFilter = $this->input->get('kementerian');
        
        // Query proyek data with filters
        $this->db->select("
            p.Id, p.IdKementerian, p.IdProgramStrategis, p.NamaProyek, 
            p.TahunMulai, p.TahunAkhir, p.TargetTahun1, p.TargetTahun2, 
            p.TargetTahun3, p.TargetTahun4, p.TargetTahun5,
            k.NamaKementerian, ps.NamaProgram,
            IFNULL(
                (SELECT GROUP_CONCAT(kw.Nama SEPARATOR ', ') 
                 FROM kodewilayah kw 
                 WHERE FIND_IN_SET(kw.Kode, p.KodeWilayah) AND LENGTH(kw.Kode) = 2),
                COALESCE(
                    (SELECT GROUP_CONCAT(kw2.Nama SEPARATOR ', ') 
                     FROM kodewilayah kw2 
                     WHERE FIND_IN_SET(kw2.Kode, ps.KodeWilayah) AND LENGTH(kw2.Kode) = 2),
                    '-'
                )
            ) AS NamaProvinsi,
            IFNULL(
                (SELECT GROUP_CONCAT(kw.Nama SEPARATOR ', ') 
                 FROM kodewilayah kw 
                 WHERE FIND_IN_SET(kw.Kode, p.KodeKota)),
                COALESCE(
                    (SELECT GROUP_CONCAT(kw2.Nama SEPARATOR ', ') 
                     FROM kodewilayah kw2 
                     WHERE FIND_IN_SET(kw2.Kode, ps.KodeKota)),
                    '-'
                )
            ) AS NamaKota,
            COALESCE(p.KodeWilayah, ps.KodeWilayah) AS KodeWilayah,
            COALESCE(p.KodeKota, ps.KodeKota) AS KodeKota
        ");
        $this->db->from('proyek_strategis p');
        $this->db->join('kementerian k', 'p.IdKementerian = k.Id', 'left');
        $this->db->join('program_strategis ps', 'p.IdProgramStrategis = ps.Id', 'left');
        $this->db->where('p.deleted_at IS NULL');
        
        if ($periodeFilter) {
            list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
            $this->db->where('p.TahunMulai', $tahunMulai);
            $this->db->where('p.TahunAkhir', $tahunAkhir);
        }
        
        if ($kementerianFilter) {
            $this->db->where('p.IdKementerian', $kementerianFilter);
        }
        
        $this->db->order_by('p.TahunMulai', 'DESC');
        $this->db->order_by('p.TahunAkhir', 'DESC');
        $Data['Proyek'] = $this->db->get()->result_array();
        
        // Debug: Log if no data is returned
        if (empty($Data['Proyek'])) {
            log_message('error', 'No data found in proyek_strategis. Query: ' . $this->db->last_query());
        }
        
        // Get kementerian for filter dropdown
        $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
        
        // Get unique periods from kementerian and proyek_strategis
        $Data['Periode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM (
                SELECT TahunMulai, TahunAkhir FROM kementerian WHERE deleted_at IS NULL
                UNION
                SELECT TahunMulai, TahunAkhir FROM proyek_strategis WHERE deleted_at IS NULL
            ) AS periods
            ORDER BY TahunMulai
        ")->result_array();
        
        // Get provinces for location dropdowns
        $this->db->where("LENGTH(Kode) = 2");
        $this->db->order_by('Nama', 'ASC');
        $Data['Provinsi'] = $this->db->get('kodewilayah')->result_array();
        
        // Pass current filter values
        $Data['CurrentPeriode'] = $periodeFilter;
        $Data['CurrentKementerian'] = $kementerianFilter;
        
        $this->load->view('Kementerian/header', $Header);
        $this->load->view('Kementerian/ProyekStrategis', $Data);
    }

  

    public function GetProgramByKementerianAndPeriode() {
        $TahunMulai = $this->input->post('TahunMulai');
        $TahunAkhir = $this->input->post('TahunAkhir');
        $IdKementerian = $this->input->post('IdKementerian');
        
        $this->db->select("
            ps.Id, ps.NamaProgram,
            ps.KodeWilayah, ps.KodeKota,
            IFNULL(
                (SELECT GROUP_CONCAT(kw.Nama SEPARATOR ', ') 
                 FROM kodewilayah kw 
                 WHERE FIND_IN_SET(kw.Kode, ps.KodeWilayah) AND LENGTH(kw.Kode) = 2),
                '-') AS NamaProvinsi,
            IFNULL(
                (SELECT GROUP_CONCAT(kw.Nama SEPARATOR ', ') 
                 FROM kodewilayah kw 
                 WHERE FIND_IN_SET(kw.Kode, ps.KodeKota)),
                '-') AS NamaKota
        ");
        $this->db->from('program_strategis ps');
        $this->db->where('ps.IdKementerian', $IdKementerian);
        $this->db->where('ps.TahunMulai', $TahunMulai);
        $this->db->where('ps.TahunAkhir', $TahunAkhir);
        $this->db->where('ps.deleted_at IS NULL');
        $data = $this->db->get()->result_array();
        
        // Split KodeWilayah and KodeKota into arrays
        foreach ($data as &$item) {
            $item['KodeWilayahArray'] = !empty($item['KodeWilayah']) ? explode(',', $item['KodeWilayah']) : [];
            $item['KodeKotaArray'] = !empty($item['KodeKota']) ? explode(',', $item['KodeKota']) : [];
        }
        
        echo json_encode($data);
    }


    public function InputProyek() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('IdKementerian', 'Kementerian', 'required');
        $this->form_validation->set_rules('IdProgramStrategis', 'Program Strategis', 'required');
        $this->form_validation->set_rules('NamaProyek', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('TahunMulai', 'Tahun Mulai', 'required');
        $this->form_validation->set_rules('TahunAkhir', 'Tahun Akhir', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            return;
        }
        
        $KodeWilayah = $this->input->post('KodeWilayah') ? array_filter($this->input->post('KodeWilayah')) : [];
        $KodeKota = $this->input->post('KodeKota') ? array_filter($this->input->post('KodeKota')) : [];
        
        $data = [
            'IdKementerian' => $this->input->post('IdKementerian'),
            'IdProgramStrategis' => $this->input->post('IdProgramStrategis'),
            'KodeWilayah' => implode(',', $KodeWilayah),
            'KodeKota' => implode(',', $KodeKota),
            'NamaProvinsi' => NULL,
            'NamaKota' => NULL,
            'NamaProyek' => $this->input->post('NamaProyek'),
            'TahunMulai' => $this->input->post('TahunMulai'),
            'TahunAkhir' => $this->input->post('TahunAkhir'),
            'TargetTahun1' => $this->input->post('TargetTahun1') ?: NULL,
            'TargetTahun2' => $this->input->post('TargetTahun2') ?: NULL,
            'TargetTahun3' => $this->input->post('TargetTahun3') ?: NULL,
            'TargetTahun4' => $this->input->post('TargetTahun4') ?: NULL,
            'TargetTahun5' => $this->input->post('TargetTahun5') ?: NULL,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('proyek_strategis', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
    }

    public function UpdateProyek() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Id', 'ID Proyek', 'required');
        $this->form_validation->set_rules('IdKementerian', 'Kementerian', 'required');
        $this->form_validation->set_rules('IdProgramStrategis', 'Program Strategis', 'required');
        $this->form_validation->set_rules('NamaProyek', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('TahunMulai', 'Tahun Mulai', 'required');
        $this->form_validation->set_rules('TahunAkhir', 'Tahun Akhir', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            return;
        }
        
        $KodeWilayah = $this->input->post('KodeWilayah') ? array_filter($this->input->post('KodeWilayah')) : [];
        $KodeKota = $this->input->post('KodeKota') ? array_filter($this->input->post('KodeKota')) : [];
        
        $data = [
            'IdKementerian' => $this->input->post('IdKementerian'),
            'IdProgramStrategis' => $this->input->post('IdProgramStrategis'),
            'KodeWilayah' => implode(',', $KodeWilayah),
            'KodeKota' => implode(',', $KodeKota),
            'NamaProvinsi' => NULL,
            'NamaKota' => NULL,
            'NamaProyek' => $this->input->post('NamaProyek'),
            'TahunMulai' => $this->input->post('TahunMulai'),
            'TahunAkhir' => $this->input->post('TahunAkhir'),
            'TargetTahun1' => $this->input->post('TargetTahun1') ?: NULL,
            'TargetTahun2' => $this->input->post('TargetTahun2') ?: NULL,
            'TargetTahun3' => $this->input->post('TargetTahun3') ?: NULL,
            'TargetTahun4' => $this->input->post('TargetTahun4') ?: NULL,
            'TargetTahun5' => $this->input->post('TargetTahun5') ?: NULL,
            'edited_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('proyek_strategis', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
    }

    public function DeleteProyek() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Id', 'ID Proyek', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            return;
        }
        
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('proyek_strategis', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
    }

    public function ProgramStrategis() {
    $Header['Halaman'] = 'Kementerian';

    $periodeFilter     = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');

    if ($this->session->userdata('userLevel') == 1) {
        $kementerianFilter = $this->session->userdata('IdKementerian');

        $k = $this->db->select('TahunMulai,TahunAkhir')
            ->where('Id', $kementerianFilter)
            ->where('deleted_at IS NULL')
            ->get('kementerian')
            ->row_array();

        if ($k) {
            $periodeFilter = $k['TahunMulai'].'|'.$k['TahunAkhir'];
        }
    }

    $this->db->select("
        ps.*, k.NamaKementerian,
        (SELECT GROUP_CONCAT(kw.Nama SEPARATOR ', ')
         FROM kodewilayah kw
         WHERE FIND_IN_SET(kw.Kode, ps.KodeWilayah)
         AND LENGTH(kw.Kode)=2) AS NamaProvinsi,
        (SELECT GROUP_CONCAT(kw.Nama SEPARATOR ', ')
         FROM kodewilayah kw
         WHERE FIND_IN_SET(kw.Kode, ps.KodeKota)) AS NamaKota
    ");
    $this->db->from('program_strategis ps');
    $this->db->join('kementerian k','ps.IdKementerian=k.Id','left');
    $this->db->where('ps.deleted_at IS NULL');

    if ($periodeFilter) {
        list($tm,$ta)=explode('|',$periodeFilter);
        $this->db->where('ps.TahunMulai',$tm);
        $this->db->where('ps.TahunAkhir',$ta);
    }

    if ($kementerianFilter) {
        $this->db->where('ps.IdKementerian',$kementerianFilter);
    }

    $Data['Program']=$this->db->get()->result_array();
    $Data['Provinsi']=$this->db->where("Kode LIKE '__'")->get('kodewilayah')->result_array();
    $Data['Periode']=$this->db->query("
        SELECT DISTINCT TahunMulai,TahunAkhir FROM kementerian WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai,TahunAkhir FROM program_strategis WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();

    $Data['CurrentPeriode']=$periodeFilter;
    $Data['CurrentKementerian']=$kementerianFilter;
    $Data['userLevel']=$this->session->userdata('userLevel');

    $this->load->view('Kementerian/header',$Header);
    $this->load->view('Kementerian/ProgramStrategis',$Data);
}



/* ============================================================
 * GET KEMENTERIAN BY PERIODE (UNTUK FILTER & ADMIN INPUT)
 * ============================================================
 */

public function GetKotaByProvinsi() {
    $kode_provinsi = $this->input->post('kode_provinsi');

    $kota = $this->db
        ->where("Kode LIKE '$kode_provinsi.__'")
        ->where("LENGTH(REPLACE(Kode,'.','')) = 4")
        ->order_by('Nama')
        ->get('kodewilayah')
        ->result_array();

    echo json_encode($kota);
}

/* ============================================================
 * GET LOKASI BY IDS
 * ============================================================
 */
public function GetLokasiByIds() {

    $ProvinsiIds = $this->input->post('ProvinsiIds');
    $KotaIds     = $this->input->post('KotaIds');

    $provinsiArr = $ProvinsiIds ? explode(',', $ProvinsiIds) : [];
    $kotaArr     = $KotaIds ? explode(',', $KotaIds) : [];

    $result = [];

    foreach ($provinsiArr as $i => $provId) {

        $provId = trim($provId);
        $kotaId = $kotaArr[$i] ?? '';

        // Ambil provinsi
        $prov = $this->db
            ->where('Kode', $provId)
            ->get('kodewilayah')
            ->row_array();

        // Ambil kota (opsional)
        $kota = null;
        if ($kotaId) {
            $kota = $this->db
                ->where('Kode', trim($kotaId))
                ->get('kodewilayah')
                ->row_array();
        }

        $result[] = [
            'Provinsi' => $prov['Nama'] ?? '-',
            'Kota'     => $kota['Nama'] ?? '-'
        ];
    }

    echo json_encode($result);
}


/* ============================================================
 * INPUT PROGRAM STRATEGIS (SESSION BASED)
 * ============================================================
 */
public function InputProgram() {

    if(!$this->session->userdata('userLevel')){
        echo 'Anda harus login terlebih dahulu!';
        return;
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('NamaProgram','Nama Program','required');

    if($this->form_validation->run()==FALSE){
        echo validation_errors();
        return;
    }

    $userLevel = $this->session->userdata('userLevel');

    if($userLevel==1){
        $IdKementerian = $this->session->userdata('IdKementerian');

        $k = $this->db->select('TahunMulai,TahunAkhir')
            ->where('Id',$IdKementerian)
            ->where('deleted_at IS NULL')
            ->get('kementerian')
            ->row_array();

        if(!$k){
            echo 'Data periode kementerian tidak ditemukan!';
            return;
        }

        $TahunMulai=$k['TahunMulai'];
        $TahunAkhir=$k['TahunAkhir'];

    } else if($userLevel==0){
        $IdKementerian=$this->input->post('IdKementerian');
        $TahunMulai=$this->input->post('TahunMulai');
        $TahunAkhir=$this->input->post('TahunAkhir');

        if(!$IdKementerian||!$TahunMulai||!$TahunAkhir){
            echo 'Admin wajib memilih periode dan kementerian!';
            return;
        }
    }

    $KodeWilayah=array_filter($this->input->post('KodeWilayah')??[]);
    $KodeKota=array_filter($this->input->post('KodeKota')??[]);

    $data=[
        'IdKementerian'=>$IdKementerian,
        'KodeWilayah'=>$KodeWilayah?implode(',',$KodeWilayah):'',
        'KodeKota'=>$KodeKota?implode(',',$KodeKota):'',
        'NamaProgram'=>$this->input->post('NamaProgram'),
        'TahunMulai'=>$TahunMulai,
        'TahunAkhir'=>$TahunAkhir,
        'TargetTahun1'=>$this->input->post('TargetTahun1'),
        'TargetTahun2'=>$this->input->post('TargetTahun2'),
        'TargetTahun3'=>$this->input->post('TargetTahun3'),
        'TargetTahun4'=>$this->input->post('TargetTahun4'),
        'TargetTahun5'=>$this->input->post('TargetTahun5'),
        'created_at'=>date('Y-m-d H:i:s')
    ];

    $this->db->insert('program_strategis',$data);
    echo $this->db->affected_rows()?'1':'Gagal input data!';
}



/* ============================================================
 * UPDATE PROGRAM STRATEGIS
 * ============================================================
 */
public function UpdateProgram(){

    if(!$this->session->userdata('userLevel')){
        echo 'Anda harus login terlebih dahulu!';
        return;
    }

    $programId=$this->input->post('Id');
    $program=$this->db->where('Id',$programId)->get('program_strategis')->row_array();

    if(!$program){
        echo 'Data program tidak ditemukan!';
        return;
    }

    $userLevel=$this->session->userdata('userLevel');

    if($userLevel==1 && $program['IdKementerian']!=$this->session->userdata('IdKementerian')){
        echo 'Tidak berhak mengedit data ini!';
        return;
    }

    $data=[
        'NamaProgram'=>$this->input->post('NamaProgram'),
        'TargetTahun1'=>$this->input->post('TargetTahun1'),
        'TargetTahun2'=>$this->input->post('TargetTahun2'),
        'TargetTahun3'=>$this->input->post('TargetTahun3'),
        'TargetTahun4'=>$this->input->post('TargetTahun4'),
        'TargetTahun5'=>$this->input->post('TargetTahun5'),
        'edited_at'=>date('Y-m-d H:i:s')
    ];

    $this->db->where('Id',$programId)->update('program_strategis',$data);
    echo $this->db->affected_rows()?'1':'Tidak ada perubahan data!';
}
/* ============================================================
 * UPDATE LOKASI PROGRAM
 * ============================================================
 */
public function UpdateLokasiForProgram() {

    if (!$this->session->userdata('userLevel')) {
        echo 'Anda harus login terlebih dahulu!';
        return;
    }

    $programId = $this->input->post('Id');
    if (!$programId) {
        echo 'ID Program tidak valid!';
        return;
    }

    // Ambil data program
    $program = $this->db
        ->where('Id', $programId)
        ->where('deleted_at IS NULL')
        ->get('program_strategis')
        ->row_array();

    if (!$program) {
        echo 'Data program tidak ditemukan!';
        return;
    }

    // ===== CEK AKSES =====
    $userLevel = $this->session->userdata('userLevel');
    if ($userLevel == 1) {
        if ($program['IdKementerian'] != $this->session->userdata('IdKementerian')) {
            echo 'Tidak dapat mengubah lokasi program kementerian lain!';
            return;
        }
    } else if ($userLevel != 0) {
        echo 'Akses ditolak!';
        return;
    }

    // ===== PROSES LOKASI =====
    $KodeWilayah = $this->input->post('KodeWilayah') ?? [];
    $KodeKota    = $this->input->post('KodeKota') ?? [];

    $provinsiFix = [];
    $kotaFix     = [];

    foreach ($KodeWilayah as $i => $prov) {
        $prov = trim($prov);
        $kota = $KodeKota[$i] ?? '';

        if ($prov !== '') {
            $provinsiFix[] = $prov;
            $kotaFix[]     = trim($kota);
        }
    }

    // Simpan
    $this->db->where('Id', $programId);
    $this->db->update('program_strategis', [
        'KodeWilayah' => $provinsiFix ? implode(',', $provinsiFix) : '',
        'KodeKota'    => $kotaFix ? implode(',', $kotaFix) : '',
        'edited_at'   => date('Y-m-d H:i:s')
    ]);

    echo '1';
}


/* ============================================================
 * DELETE PROGRAM (SOFT DELETE)
 * ============================================================
 */
public function DeleteProgram() {
    // Cek apakah user sudah login
    if (!$this->session->userdata('userLevel')) {
        echo 'Anda harus login terlebih dahulu!';
        return;
    }

    $programId = $this->input->post('Id');
    if (!$programId) {
        echo 'ID Program tidak valid!';
        return;
    }

    // ===== CEK HAK AKSES =====
    $program = $this->db->where('Id', $programId)->get('program_strategis')->row_array();
    
    if (!$program) {
        echo 'Data program tidak ditemukan!';
        return;
    }
    
    $userLevel = $this->session->userdata('userLevel');
    if ($userLevel == 1) { // KEMENTERIAN
        $userKementerian = $this->session->userdata('IdKementerian');
        if ($program['IdKementerian'] != $userKementerian) {
            echo 'Tidak dapat menghapus data kementerian lain!';
            return;
        }
    } else if ($userLevel != 0) { // Bukan Admin
        echo 'Akses ditolak!';
        return;
    }

    $this->db->where('Id', $programId);
    $this->db->update('program_strategis', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);

    echo $this->db->affected_rows() ? '1' : 'Gagal menghapus data!';
}
    
    public function IsuStrategis() {
    $Header['Halaman'] = 'Isu';

    $periodeFilter     = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');

    /* QUERY UTAMA – PASTIKAN SELECT IdIsuRegional */
    $this->db->select("
        ist.*,
        ist.IdIsuRegional,                  -- TAMBAHKAN INI agar view bisa pakai kondisi tombol detail
        IFNULL(k.NamaKementerian, '-') AS NamaKementerian,
        GROUP_CONCAT(DISTINCT ik.NamaIsuKLHS     ORDER BY ik.NamaIsuKLHS     SEPARATOR ', ') AS NamaIsuKLHS,
        GROUP_CONCAT(DISTINCT ig.NamaIsuGlobal   ORDER BY ig.NamaIsuGlobal   SEPARATOR ', ') AS NamaIsuGlobal,
        GROUP_CONCAT(DISTINCT ir.NamaIsuRegional ORDER BY ir.NamaIsuRegional SEPARATOR ', ') AS NamaIsuRegional,
        GROUP_CONCAT(DISTINCT ina.NamaIsuNasional ORDER BY ina.NamaIsuNasional SEPARATOR ', ') AS NamaIsuNasional,
        GROUP_CONCAT(DISTINCT pp.NamaPermasalahanPokok ORDER BY pp.NamaPermasalahanPokok SEPARATOR ', ') AS NamaPermasalahanPokok
    ");

    $this->db->from('isu_strategis ist');
    
    $this->db->join('kementerian k', 'ist.IdKementerian = k.Id', 'left');
    $this->db->join('isu_klhs ik',     "FIND_IN_SET(ik.Id, ist.IdIsuKLHS) AND ik.deleted_at IS NULL", 'left');
    $this->db->join('isu_global ig',   "FIND_IN_SET(ig.Id, ist.IdIsuGlobal) AND ig.deleted_at IS NULL", 'left');
    $this->db->join('isu_regional ir', "FIND_IN_SET(ir.Id, ist.IdIsuRegional) AND ir.deleted_at IS NULL", 'left');
    $this->db->join('isu_nasional ina',"FIND_IN_SET(ina.Id, ist.IdIsuNasional) AND ina.deleted_at IS NULL", 'left');
    $this->db->join('permasalahan_pokok pp', "FIND_IN_SET(pp.Id, ist.IdPermasalahanPokok) AND pp.deleted_at IS NULL", 'left');

    $this->db->where('ist.deleted_at IS NULL');

    /* =====================================================
     * RBAC: Filter berdasarkan level user
     * ===================================================== */
   if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $this->db->where('ist.IdKementerian', $_SESSION['IdKementerian']);
    } else if ($kementerianFilter) {
        $this->db->where('ist.IdKementerian', $kementerianFilter);
    }

    if ($periodeFilter) {
        [$tahunMulai, $tahunAkhir] = explode('|', $periodeFilter);
        $this->db->where('ist.TahunMulai', $tahunMulai);
        $this->db->where('ist.TahunAkhir', $tahunAkhir);
    }

    $this->db->group_by('ist.Id');
    $this->db->order_by('ist.TahunMulai DESC, ist.TahunAkhir DESC, ist.created_at DESC');

    $Data['IsuStrategis'] = $this->db->get()->result_array();

    // Optional debug (hapus/comment setelah tes)
    // log_message('debug', 'Jumlah data IsuStrategis: ' . count($Data['IsuStrategis']));
    // echo "<pre>"; print_r($Data['IsuStrategis']); exit;

    /* =====================================================
     * DAFTAR PERIODE UNTUK DROPDOWN FILTER
     * ===================================================== */
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM (
            SELECT TahunMulai, TahunAkhir FROM kementerian WHERE deleted_at IS NULL
            UNION
            SELECT TahunMulai, TahunAkhir FROM isu_strategis WHERE deleted_at IS NULL
            UNION
            SELECT TahunMulai, TahunAkhir FROM permasalahan_pokok WHERE deleted_at IS NULL
            UNION
            SELECT TahunMulai, TahunAkhir FROM isu_klhs WHERE deleted_at IS NULL
            UNION
            SELECT TahunMulai, TahunAkhir FROM isu_global WHERE deleted_at IS NULL
            UNION
            SELECT TahunMulai, TahunAkhir FROM isu_nasional WHERE deleted_at IS NULL
            UNION
            SELECT TahunMulai, TahunAkhir FROM isu_regional WHERE deleted_at IS NULL
        ) AS periode
        WHERE TahunMulai IS NOT NULL AND TahunAkhir IS NOT NULL
        ORDER BY TahunMulai DESC, TahunAkhir DESC
    ")->result_array();

    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM isu_strategis 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC, TahunAkhir DESC
    ")->result_array();

    /* =====================================================
     * DROPDOWN KEMENTERIAN (sesuai level & filter)
     * ===================================================== */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        // User kementerian hanya lihat dirinya
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'Id' => $_SESSION['IdKementerian'],
            'deleted_at' => NULL
        ])->result_array();
    } else {
        // Admin
        $this->db->where('deleted_at IS NULL');
        if ($periodeFilter) {
            [$tahunMulai, $tahunAkhir] = explode('|', $periodeFilter);
            $this->db->where('TahunMulai', $tahunMulai);
            $this->db->where('TahunAkhir', $tahunAkhir);
        }
        $Data['Kementerian'] = $this->db->get('kementerian')->result_array();
    }

    /* =====================================================
     * INFO USER KEMENTERIAN (untuk tampilan header)
     * ===================================================== */
    $Data['UserKementerianName'] = null;
    $Data['UserPeriode']         = null;
    $Data['UserTahunMulai']      = null;
    $Data['UserTahunAkhir']      = null;

    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $k = $this->db->get_where('kementerian', [
            'Id' => $_SESSION['IdKementerian'],
            'deleted_at' => NULL
        ])->row_array();

        if ($k) {
            $Data['UserKementerianName'] = $k['NamaKementerian'];
            $Data['UserTahunMulai']      = $k['TahunMulai'];
            $Data['UserTahunAkhir']      = $k['TahunAkhir'];
            $Data['UserPeriode']         = $k['TahunMulai'] . '|' . $k['TahunAkhir'];
        }
    }

    /* =====================================================
     * SIMPAN STATUS FILTER SAAT INI
     * ===================================================== */
    $Data['CurrentPeriode']     = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;

    // Load view
    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/IsuStrategis', $Data);
}

public function GetKementerianByPeriode() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at', NULL);
    $Kementerian = $this->db->get('kementerian')->result_array();
    
    echo json_encode($Kementerian);
}

public function GetIsuByPeriode()
{
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    $Jenis      = $this->input->post('Jenis');

    if (!$TahunMulai || !$TahunAkhir || !$Jenis) {
        echo json_encode([]);
        return;
    }

    switch ($Jenis) {

        case 'KLHS':
            $table = 'isu_klhs';
            $nama  = 'NamaIsuKLHS';
        break;

        case 'Global':
            $table = 'isu_global';
            $nama  = 'NamaIsuGlobal';
        break;

        case 'Nasional':
            $table = 'isu_nasional';
            $nama  = 'NamaIsuNasional';
        break;

        case 'Regional':
        $table = 'isu_regional';
        $nama  = 'NamaIsuRegional';
        break;

        default:
            echo json_encode([]);
            return;
    }

    $this->db->select("Id, $nama");
    $this->db->from($table);
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at IS NULL');

    $data = $this->db->get()->result_array();

    header('Content-Type: application/json');
    echo json_encode($data);
}



public function GetPermasalahanByPeriode()
{
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');

    if (!$TahunMulai || !$TahunAkhir) {
        echo json_encode([]);
        return;
    }

    $this->db->select('Id, NamaPermasalahanPokok');
    $this->db->from('permasalahan_pokok');
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at IS NULL');

    $data = $this->db->get()->result_array();

    header('Content-Type: application/json');
    echo json_encode($data);
}



public function GetIsuByIds() {

    // hanya boleh via AJAX
    if (!$this->input->is_ajax_request()) {
        show_404();
    }

    $Ids        = $this->input->post('Ids');
    $Jenis      = $this->input->post('Jenis');
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');

    /* =====================================
     * PILIH TABEL
     * ===================================== */
    $table = '';
    switch($Jenis) {
        case 'KLHS':     $table = 'isu_klhs'; break;
        case 'Global':   $table = 'isu_global'; break;
        case 'Nasional': $table = 'isu_nasional'; break;
        case 'Regional': $table = 'isu_regional'; break;

        default:
            echo json_encode([]);
            return;
    }

    if (!$Ids) {
        echo json_encode([]);
        return;
    }

    /* =====================================
     * FILTER DASAR
     * ===================================== */
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at', NULL);
    $this->db->where_in('Id', explode(',', $Ids));

    /* =====================================
     * 🔐 RBAC FILTER (PALING PENTING)
     * ===================================== */
    if(isset($_SESSION['Level']) && $_SESSION['Level'] == 1){
        $this->db->where('IdKementerian', $_SESSION['IdKementerian']);
    }

    $Data = $this->db->get($table)->result_array();

    echo json_encode($Data);
}

public function GetPermasalahanByIds() {

    // hanya boleh via AJAX
    if (!$this->input->is_ajax_request()) {
        show_404();
    }

    $Ids        = $this->input->post('Ids');
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');

    // jika kosong langsung return
    if (!$Ids) {
        echo json_encode([]);
        return;
    }

    /* =====================================
     * FILTER DASAR
     * ===================================== */
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at', NULL);
    $this->db->where_in('Id', explode(',', $Ids));

    /* =====================================
     * 🔐 RBAC FILTER
     * ===================================== */
    if(isset($_SESSION['Level']) && $_SESSION['Level'] == 1){
        $this->db->where('IdKementerian', $_SESSION['IdKementerian']);
    }

    $Data = $this->db->get('permasalahan_pokok')->result_array();

    echo json_encode($Data);
}

public function InputIsuStrategis() {
    if (!isset($_SESSION['Level'])) {
        echo 'Session login tidak valid';
        return;
    }

    $IdKementerian = ($_SESSION['Level'] == 1) ? $_SESSION['IdKementerian'] : $this->input->post('IdKementerian');

    $this->load->library('form_validation');
    $this->form_validation->set_rules('NamaIsuStrategis', 'Nama Isu Strategis', 'required');
    $this->form_validation->set_rules('TahunMulai', 'Tahun Mulai', 'required');
    $this->form_validation->set_rules('TahunAkhir', 'Tahun Akhir', 'required');

    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }

    $IdIsuKLHS          = $this->input->post('IdIsuKLHS') ? array_filter($this->input->post('IdIsuKLHS')) : [];
    $IdIsuGlobal        = $this->input->post('IdIsuGlobal') ? array_filter($this->input->post('IdIsuGlobal')) : [];
    $IdIsuNasional      = $this->input->post('IdIsuNasional') ? array_filter($this->input->post('IdIsuNasional')) : [];
    $IdPermasalahanPokok = $this->input->post('IdPermasalahanPokok') ? array_filter($this->input->post('IdPermasalahanPokok')) : [];
    $IdIsuRegional      = $this->input->post('IdIsuRegional') ? array_filter($this->input->post('IdIsuRegional')) : [];

    $data = [
        'IdKementerian'         => $IdKementerian,
        'IdIsuKLHS'             => implode(',', $IdIsuKLHS),
        'IdIsuGlobal'           => implode(',', $IdIsuGlobal),
        'IdIsuNasional'         => implode(',', $IdIsuNasional),
        'IdPermasalahanPokok'   => implode(',', $IdPermasalahanPokok),
        'IdIsuRegional'         => implode(',', $IdIsuRegional),
        'NamaIsuStrategis'      => $this->input->post('NamaIsuStrategis'),
        'TahunMulai'            => $this->input->post('TahunMulai'),
        'TahunAkhir'            => $this->input->post('TahunAkhir'),
        'created_at'            => date('Y-m-d H:i:s')
    ];

    $this->db->insert('isu_strategis', $data);

    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}


public function UpdateIsuStrategis() {
    if (!isset($_SESSION['Level'])) {
        echo 'Session login tidak valid';
        return;
    }

    $Id = $this->input->post('Id');

    $this->db->where('Id', $Id);
    $this->db->where('deleted_at IS NULL');
    $row = $this->db->get('isu_strategis')->row_array();

    if (!$row) {
        echo 'Data tidak ditemukan';
        return;
    }

    if ($_SESSION['Level'] == 1) {
        if ($row['IdKementerian'] != $_SESSION['IdKementerian']) {
            echo 'Akses ditolak (bukan data kementerian anda)';
            return;
        }
        $IdKementerian = $_SESSION['IdKementerian'];
    } else {
        $IdKementerian = $this->input->post('IdKementerian');
    }

    $this->load->library('form_validation');
    $this->form_validation->set_rules('NamaIsuStrategis', 'Nama Isu Strategis', 'required');
    $this->form_validation->set_rules('TahunMulai', 'Tahun Mulai', 'required');
    $this->form_validation->set_rules('TahunAkhir', 'Tahun Akhir', 'required');

    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }

    $IdIsuKLHS          = $this->input->post('IdIsuKLHS') ? array_filter($this->input->post('IdIsuKLHS')) : [];
    $IdIsuGlobal        = $this->input->post('IdIsuGlobal') ? array_filter($this->input->post('IdIsuGlobal')) : [];
    $IdIsuNasional      = $this->input->post('IdIsuNasional') ? array_filter($this->input->post('IdIsuNasional')) : [];
    $IdPermasalahanPokok = $this->input->post('IdPermasalahanPokok') ? array_filter($this->input->post('IdPermasalahanPokok')) : [];
    $IdIsuRegional      = $this->input->post('IdIsuRegional') ? array_filter($this->input->post('IdIsuRegional')) : [];

    $data = [
        'IdKementerian'         => $IdKementerian,
        'IdIsuKLHS'             => implode(',', $IdIsuKLHS),
        'IdIsuGlobal'           => implode(',', $IdIsuGlobal),
        'IdIsuNasional'         => implode(',', $IdIsuNasional),
        'IdPermasalahanPokok'   => implode(',', $IdPermasalahanPokok),
        'IdIsuRegional'         => implode(',', $IdIsuRegional),
        'NamaIsuStrategis'      => $this->input->post('NamaIsuStrategis'),
        'TahunMulai'            => $this->input->post('TahunMulai'),
        'TahunAkhir'            => $this->input->post('TahunAkhir'),
        'edited_at'             => date('Y-m-d H:i:s')
    ];

    $this->db->where('Id', $Id);
    $this->db->update('isu_strategis', $data);

    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}


public function UpdateIsuKLHSForStrategis() {

    // ================= CEK LOGIN =================
    if(!isset($_SESSION['Level'])){
        echo 'Session login tidak valid';
        return;
    }

    $Id = $this->input->post('Id');

    if(!$Id){
        echo 'ID tidak valid';
        return;
    }

    // ================= CEK DATA ADA =================
    $this->db->where('Id', $Id);
    $this->db->where('deleted_at IS NULL');
    $row = $this->db->get('isu_strategis')->row_array();

    if(!$row){
        echo 'Data tidak ditemukan';
        return;
    }

    // ================= RBAC =================
    if($_SESSION['Level'] == 1){
        if($row['IdKementerian'] != $_SESSION['IdKementerian']){
            echo 'Akses ditolak (bukan data kementerian anda)';
            return;
        }
    }

    // ================= AMBIL DATA =================
    $IdIsuKLHS = $this->input->post('IdIsuKLHS')
        ? array_filter($this->input->post('IdIsuKLHS'))
        : [];

    $data = [
        'IdIsuKLHS' => implode(',', $IdIsuKLHS),
        'edited_at' => date('Y-m-d H:i:s')
    ];

    // ================= UPDATE =================
    $this->db->where('Id', $Id);
    $this->db->update('isu_strategis', $data);

    echo $this->db->affected_rows() ? '1' : 'Gagal Update Isu KLHS!';
}


public function UpdateIsuGlobalForStrategis() {

    // ================= CEK LOGIN =================
    if(!isset($_SESSION['Level'])){
        echo 'Session login tidak valid';
        return;
    }

    $Id = $this->input->post('Id');

    if(!$Id){
        echo 'ID tidak valid';
        return;
    }

    // ================= CEK DATA ADA =================
    $this->db->where('Id', $Id);
    $this->db->where('deleted_at IS NULL');
    $row = $this->db->get('isu_strategis')->row_array();

    if(!$row){
        echo 'Data tidak ditemukan';
        return;
    }

    // ================= RBAC (BATASI OPD) =================
    if($_SESSION['Level'] == 1){
        if($row['IdKementerian'] != $_SESSION['IdKementerian']){
            echo 'Akses ditolak (bukan data kementerian anda)';
            return;
        }
    }

    // ================= AMBIL DATA =================
    $IdIsuGlobal = $this->input->post('IdIsuGlobal')
        ? array_filter($this->input->post('IdIsuGlobal'))
        : [];

    $data = [
        'IdIsuGlobal' => implode(',', $IdIsuGlobal),
        'edited_at' => date('Y-m-d H:i:s')
    ];

    // ================= UPDATE =================
    $this->db->where('Id', $Id);
    $this->db->update('isu_strategis', $data);

    echo $this->db->affected_rows() ? '1' : 'Gagal Update Isu Global!';
}


public function UpdateIsuNasionalForStrategis() {

    // ================= CEK LOGIN =================
    if(!isset($_SESSION['Level'])){
        echo 'Session login tidak valid';
        return;
    }

    $Id = $this->input->post('Id');

    if(!$Id){
        echo 'ID tidak valid';
        return;
    }

    // ================= CEK DATA ADA =================
    $this->db->where('Id', $Id);
    $this->db->where('deleted_at IS NULL');
    $row = $this->db->get('isu_strategis')->row_array();

    if(!$row){
        echo 'Data tidak ditemukan';
        return;
    }

    // ================= RBAC (BATASI OPD) =================
    if($_SESSION['Level'] == 1){
        if($row['IdKementerian'] != $_SESSION['IdKementerian']){
            echo 'Akses ditolak (bukan data kementerian anda)';
            return;
        }
    }

    // ================= AMBIL DATA =================
    $IdIsuNasional = $this->input->post('IdIsuNasional')
        ? array_filter($this->input->post('IdIsuNasional'))
        : [];

    $data = [
        'IdIsuNasional' => implode(',', $IdIsuNasional),
        'edited_at' => date('Y-m-d H:i:s')
    ];

    // ================= UPDATE =================
    $this->db->where('Id', $Id);
    $this->db->update('isu_strategis', $data);

    echo $this->db->affected_rows() ? '1' : 'Gagal Update Isu Nasional!';
}


public function UpdatePermasalahanForStrategis() {

    // ================= CEK LOGIN =================
    if(!isset($_SESSION['Level'])){
        echo 'Session login tidak valid';
        return;
    }

    $Id = $this->input->post('Id');

    if(!$Id){
        echo 'ID tidak valid';
        return;
    }

    // ================= CEK DATA ADA =================
    $this->db->where('Id', $Id);
    $this->db->where('deleted_at IS NULL');
    $row = $this->db->get('isu_strategis')->row_array();

    if(!$row){
        echo 'Data tidak ditemukan';
        return;
    }

    // ================= RBAC (BATASI OPD) =================
    if($_SESSION['Level'] == 1){
        if($row['IdKementerian'] != $_SESSION['IdKementerian']){
            echo 'Akses ditolak (bukan data kementerian anda)';
            return;
        }
    }

    // ================= AMBIL DATA =================
    $IdPermasalahanPokok = $this->input->post('IdPermasalahanPokok')
        ? array_filter($this->input->post('IdPermasalahanPokok'))
        : [];

    $data = [
        'IdPermasalahanPokok' => implode(',', $IdPermasalahanPokok),
        'edited_at' => date('Y-m-d H:i:s')
    ];

    // ================= UPDATE =================
    $this->db->where('Id', $Id);
    $this->db->update('isu_strategis', $data);

    echo $this->db->affected_rows() ? '1' : 'Gagal Update Permasalahan Pokok!';
}

public function UpdateIsuRegionalForStrategis() {
    if (!isset($_SESSION['Level'])) {
        echo 'Session login tidak valid';
        return;
    }

    $Id = $this->input->post('Id');

    if (!$Id) {
        echo 'ID tidak valid';
        return;
    }

    $this->db->where('Id', $Id);
    $this->db->where('deleted_at IS NULL');
    $row = $this->db->get('isu_strategis')->row_array();

    if (!$row) {
        echo 'Data tidak ditemukan';
        return;
    }

    if ($_SESSION['Level'] == 1) {
        if ($row['IdKementerian'] != $_SESSION['IdKementerian']) {
            echo 'Akses ditolak (bukan data kementerian anda)';
            return;
        }
    }

    $IdIsuRegional = $this->input->post('IdIsuRegional') 
        ? array_filter($this->input->post('IdIsuRegional')) 
        : [];

    $data = [
        'IdIsuRegional' => implode(',', $IdIsuRegional),
        'edited_at' => date('Y-m-d H:i:s')
    ];

    $this->db->where('Id', $Id);
    $this->db->update('isu_strategis', $data);

    echo $this->db->affected_rows() ? '1' : 'Gagal Update Isu Regional!';
}

public function DeleteIsuStrategis() {

    // ================= CEK LOGIN =================
    if(!isset($_SESSION['Level'])){
        echo 'Session login tidak valid';
        return;
    }

    $Id = $this->input->post('Id');

    if(!$Id){
        echo 'ID tidak valid';
        return;
    }

    // ================= CEK DATA ADA =================
    $this->db->where('Id', $Id);
    $this->db->where('deleted_at IS NULL');
    $row = $this->db->get('isu_strategis')->row_array();

    if(!$row){
        echo 'Data tidak ditemukan';
        return;
    }

    // ================= RBAC =================
    if($_SESSION['Level'] == 1){

        // OPD hanya boleh hapus milik sendiri
        if($row['IdKementerian'] != $_SESSION['IdKementerian']){
            echo 'Akses ditolak (bukan data kementerian anda)';
            return;
        }
    }

    // ================= SOFT DELETE =================
    $this->db->where('Id', $Id);
    $this->db->update('isu_strategis', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);

    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}


    public function PermasalahanPokok()
{
    $Header['Halaman'] = 'Isu';

    /* ================= INIT DATA ================= */
    $Data = [
        'UserPeriode'         => null,
        'UserKementerianName' => null,
        'UserKementerianId'   => null,
        'CurrentPeriode'      => null,
        'CurrentKementerian'  => null,
        'PermasalahanPokok'           => [],
        'AllPeriode'          => [],
        'Kementerian'         => []
    ];

    /* ================= SESSION LEVEL 1 ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {

        if (empty($_SESSION['IdKementerian'])) {
            redirect('Auth/Logout');
        }

        $kementerian = $this->db
            ->select('Id, NamaKementerian, TahunMulai, TahunAkhir')
            ->where('Id', $_SESSION['IdKementerian'])
            ->where('deleted_at IS NULL', null, false)
            ->get('kementerian')
            ->row_array();

        if (!$kementerian) {
            redirect('Auth/Logout');
        }

        $_SESSION['TahunMulai'] = $kementerian['TahunMulai'];
        $_SESSION['TahunAkhir'] = $kementerian['TahunAkhir'];

        $Data['UserKementerianName'] = $kementerian['NamaKementerian'];
        $Data['UserKementerianId']   = $kementerian['Id'];
        $Data['UserPeriode']         = $kementerian['TahunMulai'].' - '.$kementerian['TahunAkhir'];
    }

    /* ================= FILTER ADMIN ================= */
    $periodeFilter     = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');

    /* ================= QUERY DATA ================= */
    $this->db->select('ig.*, k.NamaKementerian');
    $this->db->from('permasalahan_pokok ig');
    $this->db->join('kementerian k', 'ig.IdKementerian = k.Id', 'left');
    $this->db->where('ig.deleted_at IS NULL', null, false);
    $this->db->where('k.deleted_at IS NULL', null, false);

    // Level 1 → hanya data sendiri
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $this->db->where('ig.IdKementerian', $_SESSION['IdKementerian']);
    }

    // Level 0 → filter opsional
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        if (!empty($periodeFilter)) {
            [$tm, $ta] = explode('|', $periodeFilter);
            $this->db->where('ig.TahunMulai', $tm);
            $this->db->where('ig.TahunAkhir', $ta);
            $Data['CurrentPeriode'] = $periodeFilter;
        }

        if (!empty($kementerianFilter)) {
            $this->db->where('ig.IdKementerian', $kementerianFilter);
            $Data['CurrentKementerian'] = $kementerianFilter;
        }
    }

    $this->db->order_by('k.NamaKementerian', 'ASC');
    $Data['PermasalahanPokok'] = $this->db->get()->result_array();

    /* ================= DROPDOWN ADMIN ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        $Data['AllPeriode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM kementerian
            WHERE deleted_at IS NULL
            ORDER BY TahunMulai DESC
        ")->result_array();

        $Data['Kementerian'] = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->order_by('NamaKementerian', 'ASC')
            ->get('kementerian')
            ->result_array();
    }

    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/PermasalahanPokok', $Data);
}



public function InputPermasalahanPokok()
{
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success'=>false,'message'=>'Akses ditolak']);
        return;
    }

    $nama = trim($this->input->post('NamaPermasalahanPokok'));

    if ($nama === '') {
        echo json_encode(['success'=>false,'message'=>'Nama Permasalahan Pokok wajib diisi']);
        return;
    }

    $this->db->insert('permasalahan_pokok', [
        'IdKementerian' => $_SESSION['IdKementerian'],
        'NamaPermasalahanPokok' => $nama,
        'TahunMulai'    => $_SESSION['TahunMulai'],
        'TahunAkhir'    => $_SESSION['TahunAkhir'],
        'created_at'    => date('Y-m-d H:i:s')
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil disimpan'
    ]);
}



public function UpdatePermasalahanPokok()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('permasalahan_pokok',[
        'NamaPermasalahanPokok'=>$this->input->post('NamaPermasalahanPokok'),
        'edited_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil diperbarui']);
}

public function DeletePermasalahanPokok()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('permasalahan_pokok',[
        'deleted_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil dihapus']);
}

public function getPermasalahanPokokById()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
    }
    
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
        return;
    }
    
    $id = $this->input->post('Id');
    
    if (empty($id)) {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
        return;
    }
    
    $data = $this->db
        ->where('Id', $id)
        ->where('IdKementerian', $_SESSION['IdKementerian'])
        ->where('deleted_at IS NULL', null, false)
        ->get('permasalahan_pokok')
        ->row_array();
    
    if ($data) {
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }
}
  /* =========================================================
 * ISU KLHS - SESSION BASED (ADOPSI PERMASALAHAN POKOK)
 * ========================================================= */

public function IsuKLHS()
{
    $Header['Halaman'] = 'Isu';

    /* ================= INIT DATA ================= */
    $Data = [
        'UserPeriode'         => null,
        'UserKementerianName' => null,
        'UserKementerianId'   => null,
        'CurrentPeriode'      => null,
        'CurrentKementerian'  => null,
        'IsuKLHS'           => [],
        'AllPeriode'          => [],
        'Kementerian'         => []
    ];

    /* ================= SESSION LEVEL 1 ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {

        if (empty($_SESSION['IdKementerian'])) {
            redirect('Auth/Logout');
        }

        $kementerian = $this->db
            ->select('Id, NamaKementerian, TahunMulai, TahunAkhir')
            ->where('Id', $_SESSION['IdKementerian'])
            ->where('deleted_at IS NULL', null, false)
            ->get('kementerian')
            ->row_array();

        if (!$kementerian) {
            redirect('Auth/Logout');
        }

        $_SESSION['TahunMulai'] = $kementerian['TahunMulai'];
        $_SESSION['TahunAkhir'] = $kementerian['TahunAkhir'];

        $Data['UserKementerianName'] = $kementerian['NamaKementerian'];
        $Data['UserKementerianId']   = $kementerian['Id'];
        $Data['UserPeriode']         = $kementerian['TahunMulai'].' - '.$kementerian['TahunAkhir'];
    }

    /* ================= FILTER ADMIN ================= */
    $periodeFilter     = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');

    /* ================= QUERY DATA ================= */
    $this->db->select('ig.*, k.NamaKementerian');
    $this->db->from('isu_KLHS ig');
    $this->db->join('kementerian k', 'ig.IdKementerian = k.Id', 'left');
    $this->db->where('ig.deleted_at IS NULL', null, false);
    $this->db->where('k.deleted_at IS NULL', null, false);

    // Level 1 → hanya data sendiri
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $this->db->where('ig.IdKementerian', $_SESSION['IdKementerian']);
    }

    // Level 0 → filter opsional
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        if (!empty($periodeFilter)) {
            [$tm, $ta] = explode('|', $periodeFilter);
            $this->db->where('ig.TahunMulai', $tm);
            $this->db->where('ig.TahunAkhir', $ta);
            $Data['CurrentPeriode'] = $periodeFilter;
        }

        if (!empty($kementerianFilter)) {
            $this->db->where('ig.IdKementerian', $kementerianFilter);
            $Data['CurrentKementerian'] = $kementerianFilter;
        }
    }

    $this->db->order_by('k.NamaKementerian', 'ASC');
    $Data['IsuKLHS'] = $this->db->get()->result_array();

    /* ================= DROPDOWN ADMIN ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        $Data['AllPeriode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM kementerian
            WHERE deleted_at IS NULL
            ORDER BY TahunMulai DESC
        ")->result_array();

        $Data['Kementerian'] = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->order_by('NamaKementerian', 'ASC')
            ->get('kementerian')
            ->result_array();
    }

    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/IsuKLHS', $Data);
}



public function InputIsuKLHS()
{
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success'=>false,'message'=>'Akses ditolak']);
        return;
    }

    $nama = trim($this->input->post('NamaIsuKLHS'));

    if ($nama === '') {
        echo json_encode(['success'=>false,'message'=>'Nama Isu KLHS wajib diisi']);
        return;
    }

    $this->db->insert('isu_KLHS', [
        'IdKementerian' => $_SESSION['IdKementerian'],
        'NamaIsuKLHS' => $nama,
        'TahunMulai'    => $_SESSION['TahunMulai'],
        'TahunAkhir'    => $_SESSION['TahunAkhir'],
        'created_at'    => date('Y-m-d H:i:s')
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil disimpan'
    ]);
}



public function UpdateIsuKLHS()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('isu_KLHS',[
        'NamaIsuKLHS'=>$this->input->post('NamaIsuKLHS'),
        'edited_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil diperbarui']);
}

public function DeleteIsuKLHS()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('isu_KLHS',[
        'deleted_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil dihapus']);
}

public function getIsuKLHSById()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
    }
    
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
        return;
    }
    
    $id = $this->input->post('Id');
    
    if (empty($id)) {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
        return;
    }
    
    $data = $this->db
        ->where('Id', $id)
        ->where('IdKementerian', $_SESSION['IdKementerian'])
        ->where('deleted_at IS NULL', null, false)
        ->get('isu_KLHS')
        ->row_array();
    
    if ($data) {
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }
}



public function IsuGlobal()
{
    $Header['Halaman'] = 'Isu';

    /* ================= INIT DATA ================= */
    $Data = [
        'UserPeriode'         => null,
        'UserKementerianName' => null,
        'UserKementerianId'   => null,
        'CurrentPeriode'      => null,
        'CurrentKementerian'  => null,
        'IsuGlobal'           => [],
        'AllPeriode'          => [],
        'Kementerian'         => []
    ];

    /* ================= SESSION LEVEL 1 ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {

        if (empty($_SESSION['IdKementerian'])) {
            redirect('Auth/Logout');
        }

        $kementerian = $this->db
            ->select('Id, NamaKementerian, TahunMulai, TahunAkhir')
            ->where('Id', $_SESSION['IdKementerian'])
            ->where('deleted_at IS NULL', null, false)
            ->get('kementerian')
            ->row_array();

        if (!$kementerian) {
            redirect('Auth/Logout');
        }

        $_SESSION['TahunMulai'] = $kementerian['TahunMulai'];
        $_SESSION['TahunAkhir'] = $kementerian['TahunAkhir'];

        $Data['UserKementerianName'] = $kementerian['NamaKementerian'];
        $Data['UserKementerianId']   = $kementerian['Id'];
        $Data['UserPeriode']         = $kementerian['TahunMulai'].' - '.$kementerian['TahunAkhir'];
    }

    /* ================= FILTER ADMIN ================= */
    $periodeFilter     = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');

    /* ================= QUERY DATA ================= */
    $this->db->select('ig.*, k.NamaKementerian');
    $this->db->from('isu_global ig');
    $this->db->join('kementerian k', 'ig.IdKementerian = k.Id', 'left');
    $this->db->where('ig.deleted_at IS NULL', null, false);
    $this->db->where('k.deleted_at IS NULL', null, false);

    // Level 1 → hanya data sendiri
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $this->db->where('ig.IdKementerian', $_SESSION['IdKementerian']);
    }

    // Level 0 → filter opsional
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        if (!empty($periodeFilter)) {
            [$tm, $ta] = explode('|', $periodeFilter);
            $this->db->where('ig.TahunMulai', $tm);
            $this->db->where('ig.TahunAkhir', $ta);
            $Data['CurrentPeriode'] = $periodeFilter;
        }

        if (!empty($kementerianFilter)) {
            $this->db->where('ig.IdKementerian', $kementerianFilter);
            $Data['CurrentKementerian'] = $kementerianFilter;
        }
    }

    $this->db->order_by('k.NamaKementerian', 'ASC');
    $Data['IsuGlobal'] = $this->db->get()->result_array();

    /* ================= DROPDOWN ADMIN ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        $Data['AllPeriode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM kementerian
            WHERE deleted_at IS NULL
            ORDER BY TahunMulai DESC
        ")->result_array();

        $Data['Kementerian'] = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->order_by('NamaKementerian', 'ASC')
            ->get('kementerian')
            ->result_array();
    }

    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/IsuGlobal', $Data);
}



public function InputIsuGlobal()
{
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success'=>false,'message'=>'Akses ditolak']);
        return;
    }

    $nama = trim($this->input->post('NamaIsuGlobal'));

    if ($nama === '') {
        echo json_encode(['success'=>false,'message'=>'Nama Isu Global wajib diisi']);
        return;
    }

    $this->db->insert('isu_global', [
        'IdKementerian' => $_SESSION['IdKementerian'],
        'NamaIsuGlobal' => $nama,
        'TahunMulai'    => $_SESSION['TahunMulai'],
        'TahunAkhir'    => $_SESSION['TahunAkhir'],
        'created_at'    => date('Y-m-d H:i:s')
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil disimpan'
    ]);
}



public function UpdateIsuGlobal()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('isu_global',[
        'NamaIsuGlobal'=>$this->input->post('NamaIsuGlobal'),
        'edited_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil diperbarui']);
}

public function DeleteIsuGlobal()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('isu_global',[
        'deleted_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil dihapus']);
}

public function getIsuGlobalById()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
    }
    
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
        return;
    }
    
    $id = $this->input->post('Id');
    
    if (empty($id)) {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
        return;
    }
    
    $data = $this->db
        ->where('Id', $id)
        ->where('IdKementerian', $_SESSION['IdKementerian'])
        ->where('deleted_at IS NULL', null, false)
        ->get('isu_global')
        ->row_array();
    
    if ($data) {
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }
}

// Dalam controller Kementerian
public function IsuNasional()
{
    $Header['Halaman'] = 'Isu';

    /* ================= INIT DATA ================= */
    $Data = [
        'UserPeriode'         => null,
        'UserKementerianName' => null,
        'UserKementerianId'   => null,
        'CurrentPeriode'      => null,
        'CurrentKementerian'  => null,
        'IsuNasional'           => [],
        'AllPeriode'          => [],
        'Kementerian'         => []
    ];

    /* ================= SESSION LEVEL 1 ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {

        if (empty($_SESSION['IdKementerian'])) {
            redirect('Auth/Logout');
        }

        $kementerian = $this->db
            ->select('Id, NamaKementerian, TahunMulai, TahunAkhir')
            ->where('Id', $_SESSION['IdKementerian'])
            ->where('deleted_at IS NULL', null, false)
            ->get('kementerian')
            ->row_array();

        if (!$kementerian) {
            redirect('Auth/Logout');
        }

        $_SESSION['TahunMulai'] = $kementerian['TahunMulai'];
        $_SESSION['TahunAkhir'] = $kementerian['TahunAkhir'];

        $Data['UserKementerianName'] = $kementerian['NamaKementerian'];
        $Data['UserKementerianId']   = $kementerian['Id'];
        $Data['UserPeriode']         = $kementerian['TahunMulai'].' - '.$kementerian['TahunAkhir'];
    }

    /* ================= FILTER ADMIN ================= */
    $periodeFilter     = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');

    /* ================= QUERY DATA ================= */
    $this->db->select('ig.*, k.NamaKementerian');
    $this->db->from('isu_Nasional ig');
    $this->db->join('kementerian k', 'ig.IdKementerian = k.Id', 'left');
    $this->db->where('ig.deleted_at IS NULL', null, false);
    $this->db->where('k.deleted_at IS NULL', null, false);

    // Level 1 → hanya data sendiri
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $this->db->where('ig.IdKementerian', $_SESSION['IdKementerian']);
    }

    // Level 0 → filter opsional
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        if (!empty($periodeFilter)) {
            [$tm, $ta] = explode('|', $periodeFilter);
            $this->db->where('ig.TahunMulai', $tm);
            $this->db->where('ig.TahunAkhir', $ta);
            $Data['CurrentPeriode'] = $periodeFilter;
        }

        if (!empty($kementerianFilter)) {
            $this->db->where('ig.IdKementerian', $kementerianFilter);
            $Data['CurrentKementerian'] = $kementerianFilter;
        }
    }

    $this->db->order_by('k.NamaKementerian', 'ASC');
    $Data['IsuNasional'] = $this->db->get()->result_array();

    /* ================= DROPDOWN ADMIN ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        $Data['AllPeriode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM kementerian
            WHERE deleted_at IS NULL
            ORDER BY TahunMulai DESC
        ")->result_array();

        $Data['Kementerian'] = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->order_by('NamaKementerian', 'ASC')
            ->get('kementerian')
            ->result_array();
    }

    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/IsuNasional', $Data);
}



public function InputIsuNasional()
{
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success'=>false,'message'=>'Akses ditolak']);
        return;
    }

    $nama = trim($this->input->post('NamaIsuNasional'));

    if ($nama === '') {
        echo json_encode(['success'=>false,'message'=>'Nama Isu Nasional wajib diisi']);
        return;
    }

    $this->db->insert('isu_Nasional', [
        'IdKementerian' => $_SESSION['IdKementerian'],
        'NamaIsuNasional' => $nama,
        'TahunMulai'    => $_SESSION['TahunMulai'],
        'TahunAkhir'    => $_SESSION['TahunAkhir'],
        'created_at'    => date('Y-m-d H:i:s')
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil disimpan'
    ]);
}



public function UpdateIsuNasional()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('isu_Nasional',[
        'NamaIsuNasional'=>$this->input->post('NamaIsuNasional'),
        'edited_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil diperbarui']);
}

public function DeleteIsuNasional()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('isu_Nasional',[
        'deleted_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil dihapus']);
}



public function getIsuNasionalById()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
    }
    
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
        return;
    }
    
    $id = $this->input->post('Id');
    
    if (empty($id)) {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
        return;
    }
    
    $data = $this->db
        ->where('Id', $id)
        ->where('IdKementerian', $_SESSION['IdKementerian'])
        ->where('deleted_at IS NULL', null, false)
        ->get('isu_Nasional')
        ->row_array();
    
    if ($data) {
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }
}



public function IsuRegional()
{
    $Header['Halaman'] = 'Isu';

    /* ================= INIT DATA ================= */
    $Data = [
        'UserPeriode'         => null,
        'UserKementerianName' => null,
        'UserKementerianId'   => null,
        'CurrentPeriode'      => null,
        'CurrentKementerian'  => null,
        'IsuRegional'           => [],
        'AllPeriode'          => [],
        'Kementerian'         => []
    ];

    /* ================= SESSION LEVEL 1 ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {

        if (empty($_SESSION['IdKementerian'])) {
            redirect('Auth/Logout');
        }

        $kementerian = $this->db
            ->select('Id, NamaKementerian, TahunMulai, TahunAkhir')
            ->where('Id', $_SESSION['IdKementerian'])
            ->where('deleted_at IS NULL', null, false)
            ->get('kementerian')
            ->row_array();

        if (!$kementerian) {
            redirect('Auth/Logout');
        }

        $_SESSION['TahunMulai'] = $kementerian['TahunMulai'];
        $_SESSION['TahunAkhir'] = $kementerian['TahunAkhir'];

        $Data['UserKementerianName'] = $kementerian['NamaKementerian'];
        $Data['UserKementerianId']   = $kementerian['Id'];
        $Data['UserPeriode']         = $kementerian['TahunMulai'].' - '.$kementerian['TahunAkhir'];
    }

    /* ================= FILTER ADMIN ================= */
    $periodeFilter     = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');

    /* ================= QUERY DATA ================= */
    $this->db->select('ig.*, k.NamaKementerian');
    $this->db->from('isu_regional ig');
    $this->db->join('kementerian k', 'ig.IdKementerian = k.Id', 'left');
    $this->db->where('ig.deleted_at IS NULL', null, false);
    $this->db->where('k.deleted_at IS NULL', null, false);

    // Level 1 → hanya data sendiri
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $this->db->where('ig.IdKementerian', $_SESSION['IdKementerian']);
    }

    // Level 0 → filter opsional
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        if (!empty($periodeFilter)) {
            [$tm, $ta] = explode('|', $periodeFilter);
            $this->db->where('ig.TahunMulai', $tm);
            $this->db->where('ig.TahunAkhir', $ta);
            $Data['CurrentPeriode'] = $periodeFilter;
        }

        if (!empty($kementerianFilter)) {
            $this->db->where('ig.IdKementerian', $kementerianFilter);
            $Data['CurrentKementerian'] = $kementerianFilter;
        }
    }

    $this->db->order_by('k.NamaKementerian', 'ASC');
    $Data['IsuRegional'] = $this->db->get()->result_array();

    /* ================= DROPDOWN ADMIN ================= */
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 0) {

        $Data['AllPeriode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM kementerian
            WHERE deleted_at IS NULL
            ORDER BY TahunMulai DESC
        ")->result_array();

        $Data['Kementerian'] = $this->db
            ->where('deleted_at IS NULL', null, false)
            ->order_by('NamaKementerian', 'ASC')
            ->get('kementerian')
            ->result_array();
    }

    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/IsuRegional', $Data);
}



public function InputIsuRegional()
{
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success'=>false,'message'=>'Akses ditolak']);
        return;
    }

    $nama = trim($this->input->post('NamaIsuRegional'));

    if ($nama === '') {
        echo json_encode(['success'=>false,'message'=>'Nama Isu Regional wajib diisi']);
        return;
    }

    $this->db->insert('isu_regional', [
        'IdKementerian' => $_SESSION['IdKementerian'],
        'NamaIsuRegional' => $nama,
        'TahunMulai'    => $_SESSION['TahunMulai'],
        'TahunAkhir'    => $_SESSION['TahunAkhir'],
        'created_at'    => date('Y-m-d H:i:s')
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Data berhasil disimpan'
    ]);
}



public function UpdateIsuRegional()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('isu_regional',[
        'NamaIsuRegional'=>$this->input->post('NamaIsuRegional'),
        'edited_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil diperbarui']);
}

public function DeleteIsuRegional()
{
    $this->db->where('Id',$this->input->post('Id'));
    $this->db->where('IdKementerian',$_SESSION['IdKementerian']);
    $this->db->update('isu_regional',[
        'deleted_at'=>date('Y-m-d H:i:s')
    ]);

    echo json_encode(['success'=>true,'message'=>'Data berhasil dihapus']);
}

public function getIsuRegionalById()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
    }
    
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo json_encode(['success' => false, 'message' => 'Akses ditolak']);
        return;
    }
    
    $id = $this->input->post('Id');
    
    if (empty($id)) {
        echo json_encode(['success' => false, 'message' => 'ID tidak valid']);
        return;
    }
    
    $data = $this->db
        ->where('Id', $id)
        ->where('IdKementerian', $_SESSION['IdKementerian'])
        ->where('deleted_at IS NULL', null, false)
        ->get('isu_regional')
        ->row_array();
    
    if ($data) {
        echo json_encode([
            'success' => true,
            'data' => $data
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Data tidak ditemukan'
        ]);
    }
}


public function SasaranStrategis() {
    $Header['Halaman'] = 'Kementerian';

    // ===============================
    // SESSION LOGIN
    // ===============================
    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    $userLevel = $_SESSION['userLevel'] ?? null;
    $userIdKementerian = $_SESSION['IdKementerian'] ?? null;

    // ===============================
    // FILTER DARI URL
    // ===============================
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');

    // ===============================
    // QUERY UTAMA
    // ===============================
    $this->db->select('ss.*, k.NamaKementerian');
    $this->db->from('sasaran_strategis ss');
    $this->db->join('kementerian k', 'ss.IdKementerian = k.Id', 'left');
    $this->db->where('ss.deleted_at IS NULL');

    // 🔐 PEMBATASAN BERDASARKAN ROLE
    if ($isLoggedIn && $userLevel == 1) {
        // LOGIN KEMENTERIAN ➜ WAJIB DATA MILIKNYA
        $this->db->where('ss.IdKementerian', $userIdKementerian);
    } elseif ($kementerianFilter) {
        // ADMIN / PUBLIK ➜ DARI FILTER
        $this->db->where('ss.IdKementerian', $kementerianFilter);
    }

    // FILTER PERIODE
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('ss.TahunMulai', $tahunMulai);
        $this->db->where('ss.TahunAkhir', $tahunAkhir);
    }

    $this->db->order_by('k.NamaKementerian', 'asc');
    $Data['SasaranStrategis'] = $this->db->get()->result_array();

    // ===============================
    // DATA PENDUKUNG VIEW
    // ===============================
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();

    // Dropdown kementerian hanya untuk admin / publik
    if (!$isLoggedIn || $userLevel == 0) {
        if ($periodeFilter) {
            list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
            $Data['Kementerian'] = $this->db->get_where('kementerian', [
                'TahunMulai' => $tahunMulai,
                'TahunAkhir' => $tahunAkhir,
                'deleted_at' => NULL
            ])->result_array();
        } else {
            $Data['Kementerian'] = [];
        }
    } else {
        $Data['Kementerian'] = [];
    }

    // SIMPAN FILTER AKTIF
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;

    // INFO SESSION (kalau dibutuhkan di view)
    $Data['isLoggedIn'] = $isLoggedIn;
    $Data['userLevel'] = $userLevel;
    $Data['userIdKementerian'] = $userIdKementerian;

    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/SasaranStrategis', $Data);
}


public function InputSasaranStrategis() {

    // Samakan sumber level (support dua kemungkinan session: userLevel atau Level)
    $isLoggedIn = $_SESSION['isLoggedIn'] ?? false;
    $userLevel  = $_SESSION['userLevel'] ?? ($_SESSION['Level'] ?? null);

    if (!$isLoggedIn || (int)$userLevel !== 1) {
        echo 'Unauthorized';
        return;
    }

    $IdKementerian = $_SESSION['IdKementerian'] ?? null;
    if (!$IdKementerian) {
        echo 'Session kementerian tidak ditemukan!';
        return;
    }

    // ✅ Ambil periode langsung dari tabel kementerian berdasarkan akun login
    $k = $this->db->select('TahunMulai, TahunAkhir')
                  ->from('kementerian')
                  ->where('Id', $IdKementerian)
                  ->where('deleted_at', NULL)
                  ->get()->row_array();

    if (!$k) {
        echo 'Data periode kementerian tidak ditemukan!';
        return;
    }

    // Validasi minimal field
    $sasaran = trim((string)$this->input->post('SasaranStrategis'));
    $namaInd = trim((string)$this->input->post('NamaIndikatorStrategis'));
    $indik   = trim((string)$this->input->post('IndikatorSasaranStrategis'));

    if ($sasaran === '' || $namaInd === '' || $indik === '') {
        echo 'Sasaran Strategis, Nama Indikator Strategis, dan Indikator Sasaran Strategis wajib diisi!';
        return;
    }

    $data = [
        'IdKementerian'              => $IdKementerian,
        'TahunMulai'                 => $k['TahunMulai'], // ✅ dari DB
        'TahunAkhir'                 => $k['TahunAkhir'], // ✅ dari DB
        'SasaranStrategis'           => $sasaran,
        'NamaIndikatorStrategis'     => $namaInd,
        'IndikatorSasaranStrategis'  => $indik,
        'NilaiTahun1'                => $this->input->post('NilaiTahun1') ?: 0,
        'NilaiTahun2'                => $this->input->post('NilaiTahun2') ?: 0,
        'NilaiTahun3'                => $this->input->post('NilaiTahun3') ?: 0,
        'NilaiTahun4'                => $this->input->post('NilaiTahun4') ?: 0,
        'NilaiTahun5'                => $this->input->post('NilaiTahun5') ?: 0,
        'created_at'                 => date('Y-m-d H:i:s')
    ];

    $this->db->insert('sasaran_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}




public function UpdateSasaranStrategis() {

    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['userLevel'] != 1) {
        echo 'Tidak punya hak akses!';
        return;
    }

    $this->db->where('Id', $this->input->post('Id'));
    $this->db->where('IdKementerian', $_SESSION['IdKementerian']); // 🔐 pengaman

    $data = [
        'SasaranStrategis' => $this->input->post('SasaranStrategis'),
        'NamaIndikatorStrategis' => $this->input->post('NamaIndikatorStrategis'),
        'IndikatorSasaranStrategis' => $this->input->post('IndikatorSasaranStrategis'),
        'NilaiTahun1' => $this->input->post('NilaiTahun1'),
        'NilaiTahun2' => $this->input->post('NilaiTahun2'),
        'NilaiTahun3' => $this->input->post('NilaiTahun3'),
        'NilaiTahun4' => $this->input->post('NilaiTahun4'),
        'NilaiTahun5' => $this->input->post('NilaiTahun5'),
        'edited_at' => date('Y-m-d H:i:s')
    ];

    $this->db->update('sasaran_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}


public function DeleteSasaranStrategis() {

    if (!isset($_SESSION['isLoggedIn']) || $_SESSION['userLevel'] != 1) {
        echo 'Tidak punya hak akses!';
        return;
    }

    $this->db->where('Id', $this->input->post('Id'));
    $this->db->where('IdKementerian', $_SESSION['IdKementerian']); // 🔐 pengaman
    $this->db->update('sasaran_strategis', ['deleted_at' => date('Y-m-d H:i:s')]);

    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}
// ==================== VIEW HALAMAN ====================
public function NSPK() {
    $Header['Halaman'] = 'NSPK';

    // Filter berdasarkan level user
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $this->db->where('IdKementerian', $_SESSION['IdKementerian']);
    }
    $this->db->where('deleted_at IS NULL');
    $this->db->order_by('tahun_penetapan', 'ASC');
    $this->db->order_by('id', 'ASC');
    $Data['NSPK'] = $this->db->get('nspk')->result_array();

    // Info kementerian & periode
    $Data['UserKementerianName'] = '-';
    $Data['UserPeriode']         = '-';
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        if (isset($_SESSION['IdKementerian'])) {
            $this->db->where('Id', $_SESSION['IdKementerian']);
            $this->db->where('deleted_at IS NULL');
            $kementerian = $this->db->get('kementerian')->row_array();
            if ($kementerian) {
                $Data['UserKementerianName'] = $kementerian['NamaKementerian'] ?? '-';
                $Data['UserPeriode'] = ($kementerian['TahunMulai'] ?? '-') . ' - ' . ($kementerian['TahunAkhir'] ?? '-');
            }
        }
    }

    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/NSPK', $Data);
}

// ==================== DETAIL CRUD ====================
public function GetNSPKDetails() {
    $nspk_id = (int)$this->input->post('nspk_id');
    if (!$nspk_id) { echo json_encode([]); exit; }

    $this->db->where('nspk_id', $nspk_id);
    $this->db->order_by('urutan', 'ASC');
    $this->db->order_by('id', 'ASC');
    $data = $this->db->get('nspk_detail')->result_array();
    echo json_encode($data);
}

public function InputNSPKDetail() {
    $nspk_id = (int)$this->input->post('nspk_id');
    $jenis   = $this->input->post('jenis');
    $isi     = trim($this->input->post('isi'));
    $urutan  = (int)($this->input->post('urutan') ?? 1);

    if (!$nspk_id || empty($jenis) || empty($isi)) {
        echo 'Data tidak lengkap';
        return;
    }

    $data = [
        'nspk_id'    => $nspk_id,
        'jenis'      => $jenis,
        'isi'        => $isi,
        'urutan'     => $urutan,
        'created_at' => date('Y-m-d H:i:s')
    ];
    $this->db->insert('nspk_detail', $data);
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal simpan detail';
}

public function UpdateNSPKDetail() {
    $id = (int)$this->input->post('id');
    if (!$id) { echo 'ID tidak valid'; return; }

    $data = [
        'jenis'      => $this->input->post('jenis'),
        'isi'        => $this->input->post('isi'),
        'urutan'     => (int)($this->input->post('urutan') ?? 1),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    $this->db->where('id', $id);
    $this->db->update('nspk_detail', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal update detail';
}

public function DeleteNSPKDetail() {
    $id = (int)$this->input->post('id');
    if (!$id) { echo 'ID tidak valid'; return; }
    $this->db->where('id', $id);
    $this->db->delete('nspk_detail');
    echo $this->db->affected_rows() ? '1' : 'Gagal hapus detail';
}

// ==================== HEADER NSPK ====================
public function InputNSPK() {
    if (!isset($_SESSION['Level'])) { echo 'Session tidak valid'; return; }

    $data = [
        'kode_nspk'       => trim($this->input->post('kode_nspk')),
        'judul_nspk'      => trim($this->input->post('judul_nspk')),
        'bidang'          => trim($this->input->post('bidang')),
        'tahun_penetapan' => (int)$this->input->post('tahun_penetapan'),
        'status'          => $this->input->post('status') ?? 'Berlaku',
        'keterangan'      => trim($this->input->post('keterangan')),
        'created_at'      => date('Y-m-d H:i:s')
    ];

    if (empty($data['kode_nspk']) || empty($data['judul_nspk']) || empty($data['bidang'])) {
        echo 'Kode NSPK, Judul, dan Bidang wajib diisi';
        return;
    }

    if ($_SESSION['Level'] == 1 && isset($_SESSION['IdKementerian'])) {
        $data['IdKementerian'] = (int)$_SESSION['IdKementerian'];
    }

    $this->db->insert('nspk', $data);
    if ($this->db->affected_rows() <= 0) {
        echo 'Gagal input NSPK!';
        return;
    }

    $nspk_id = $this->db->insert_id();

    // Simpan detail dinamis
    $details = $this->input->post('details');
    if (is_array($details)) {
        foreach ($details as $det) {
            if (!empty($det['jenis']) && !empty($det['isi'])) {
                $this->db->insert('nspk_detail', [
                    'nspk_id'    => $nspk_id,
                    'jenis'      => $det['jenis'],
                    'isi'        => trim($det['isi']),
                    'urutan'     => (int)($det['urutan'] ?? 1),
                    'created_at' => date('Y-m-d H:i:s')
                ]);
            }
        }
    }
    echo '1';
}

public function UpdateNSPK() {
    $id = $this->input->post('id');
    if (!$id) { echo 'ID tidak valid'; return; }

    $data = [
        'kode_nspk'       => $this->input->post('kode_nspk'),
        'judul_nspk'      => $this->input->post('judul_nspk'),
        'bidang'          => $this->input->post('bidang'),
        'tahun_penetapan' => $this->input->post('tahun_penetapan'),
        'status'          => $this->input->post('status'),
        'keterangan'      => $this->input->post('keterangan'),
        'updated_at'      => date('Y-m-d H:i:s')
    ];

    $this->db->where('id', $id);
    $this->db->update('nspk', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal update NSPK';
}

public function DeleteNSPK() {
    $id = $this->input->post('id');
    if (!$id) { echo 'ID tidak valid'; return; }

    $this->db->where('id', $id);
    $this->db->update('nspk', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo $this->db->affected_rows() ? '1' : 'Gagal hapus NSPK';
}

// ====================== RENSTRA ======================

public function Renstra() {
    $Header['Halaman'] = 'Renstra';

    // Filter hanya data milik kementerian login (level 1)
    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        $this->db->where('id_kementerian', $_SESSION['IdKementerian']);
    }

    $this->db->where('deleted_at IS NULL');
    $this->db->order_by('kode_pn', 'ASC');
    $Data['PN'] = $this->db->get('renstra_pn')->result_array();

    // === INFO KEMENTERIAN & PERIODE (INI YANG ANDA KURANG) ===
    $Data['UserKementerianName'] = '-';
    $Data['UserPeriode']         = '-';

    if (isset($_SESSION['Level']) && $_SESSION['Level'] == 1) {
        // Cek apakah IdKementerian ada di session
        if (isset($_SESSION['IdKementerian']) && is_numeric($_SESSION['IdKementerian'])) {
            $this->db->where('Id', $_SESSION['IdKementerian']);
            $this->db->where('deleted_at IS NULL');
            $kementerian = $this->db->get('kementerian')->row_array();

            if ($kementerian) {
                $Data['UserKementerianName'] = $kementerian['NamaKementerian'] ?? '-';
                $Data['UserPeriode']         = ($kementerian['TahunMulai'] ?? '-') . ' - ' . ($kementerian['TahunAkhir'] ?? '-');
            } else {
                $Data['UserKementerianName'] = 'Data kementerian tidak ditemukan (ID: ' . $_SESSION['IdKementerian'] . ')';
            }
        } else {
            $Data['UserKementerianName'] = 'Session IdKementerian tidak ditemukan';
        }
    } else {
        $Data['UserKementerianName'] = 'Login sebagai user kementerian (level 1) untuk melihat info';
    }

    // Load nested data (PP, KP, Pro-P)
    foreach ($Data['PN'] as &$pn) {
        $this->db->where('id_pn', $pn['id']);
        $this->db->where('deleted_at IS NULL');
        $pn['PP'] = $this->db->get('renstra_pp')->result_array();

        foreach ($pn['PP'] as &$pp) {
            $this->db->where('id_pp', $pp['id']);
            $this->db->where('deleted_at IS NULL');
            $pp['KP'] = $this->db->get('renstra_kp')->result_array();

            foreach ($pp['KP'] as &$kp) {
                $this->db->where('id_kp', $kp['id']);
                $this->db->where('deleted_at IS NULL');
                $kp['ProP'] = $this->db->get('renstra_prop')->result_array();
            }
        }
    }

    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/Renstra', $Data);
}

// ===================== CRUD PN =====================
public function InputPN() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $data = [
        'id_kementerian' => $_SESSION['IdKementerian'],
        'kode_pn'        => trim($this->input->post('kode_pn')),
        'nama_pn'        => trim($this->input->post('nama_pn')),
        'tahun_mulai'    => $this->input->post('tahun_mulai'),
        'tahun_akhir'    => $this->input->post('tahun_akhir'),
        'keterangan'     => trim($this->input->post('keterangan')),
        'created_at'     => date('Y-m-d H:i:s')
    ];

    $this->db->insert('renstra_pn', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input PN!';
}

public function UpdatePN() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id = $this->input->post('id');
    $this->db->where('id', $id);
    $this->db->where('id_kementerian', $_SESSION['IdKementerian']);
    $row = $this->db->get('renstra_pn')->row_array();

    if (!$row) {
        echo 'Data tidak ditemukan atau bukan milik Anda';
        return;
    }

    $data = [
        'kode_pn'        => trim($this->input->post('kode_pn')),
        'nama_pn'        => trim($this->input->post('nama_pn')),
        'tahun_mulai'    => $this->input->post('tahun_mulai'),
        'tahun_akhir'    => $this->input->post('tahun_akhir'),
        'keterangan'     => trim($this->input->post('keterangan')),
        'updated_at'     => date('Y-m-d H:i:s')
    ];

    $this->db->where('id', $id);
    $this->db->update('renstra_pn', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update PN!';
}

public function DeletePN() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id = $this->input->post('id');
    $this->db->where('id', $id);
    $this->db->where('id_kementerian', $_SESSION['IdKementerian']);
    $row = $this->db->get('renstra_pn')->row_array();

    if (!$row) {
        echo 'Data tidak ditemukan atau bukan milik Anda';
        return;
    }

    $this->db->where('id', $id);
    $this->db->update('renstra_pn', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus PN!';
}

// ===================== CRUD PP =====================
public function InputPP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id_pn = $this->input->post('id_pn');
    $this->db->where('id', $id_pn);
    $this->db->where('id_kementerian', $_SESSION['IdKementerian']);
    $pn = $this->db->get('renstra_pn')->row_array();

    if (!$pn) {
        echo 'PN tidak ditemukan atau bukan milik Anda';
        return;
    }

    $data = [
        'id_pn'       => $id_pn,
        'kode_pp'     => trim($this->input->post('kode_pp')),
        'nama_pp'     => trim($this->input->post('nama_pp')),
        'keterangan'  => trim($this->input->post('keterangan')),
        'created_at'  => date('Y-m-d H:i:s')
    ];

    $this->db->insert('renstra_pp', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input PP!';
}

public function UpdatePP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id = $this->input->post('id');
    $this->db->select('pp.*, pn.id_kementerian');
    $this->db->from('renstra_pp pp');
    $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id');
    $this->db->where('pp.id', $id);
    $this->db->where('pp.deleted_at IS NULL');
    $pp = $this->db->get()->row_array();

    if (!$pp || $pp['id_kementerian'] != $_SESSION['IdKementerian']) {
        echo 'Data tidak ditemukan atau bukan milik Anda';
        return;
    }

    $data = [
        'kode_pp'     => trim($this->input->post('kode_pp')),
        'nama_pp'     => trim($this->input->post('nama_pp')),
        'keterangan'  => trim($this->input->post('keterangan')),
        'updated_at'  => date('Y-m-d H:i:s')
    ];

    $this->db->where('id', $id);
    $this->db->update('renstra_pp', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update PP!';
}

public function DeletePP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id = $this->input->post('id');
    $this->db->select('pp.*, pn.id_kementerian');
    $this->db->from('renstra_pp pp');
    $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id');
    $this->db->where('pp.id', $id);
    $this->db->where('pp.deleted_at IS NULL');
    $pp = $this->db->get()->row_array();

    if (!$pp || $pp['id_kementerian'] != $_SESSION['IdKementerian']) {
        echo 'Data tidak ditemukan atau bukan milik Anda';
        return;
    }

    $this->db->where('id', $id);
    $this->db->update('renstra_pp', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus PP!';
}

// ===================== CRUD KP =====================
public function InputKP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id_pp = $this->input->post('id_pp');
    $this->db->select('pp.*, pn.id_kementerian');
    $this->db->from('renstra_pp pp');
    $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id');
    $this->db->where('pp.id', $id_pp);
    $this->db->where('pp.deleted_at IS NULL');
    $pp = $this->db->get()->row_array();

    if (!$pp || $pp['id_kementerian'] != $_SESSION['IdKementerian']) {
        echo 'PP tidak ditemukan atau bukan milik Anda';
        return;
    }

    $data = [
        'id_pp'       => $id_pp,
        'kode_kp'     => trim($this->input->post('kode_kp')),
        'nama_kp'     => trim($this->input->post('nama_kp')),
        'keterangan'  => trim($this->input->post('keterangan')),
        'created_at'  => date('Y-m-d H:i:s')
    ];

    $this->db->insert('renstra_kp', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input KP!';
}

public function UpdateKP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id = $this->input->post('id');
    $this->db->select('kp.*, pp.id_pn, pn.id_kementerian');
    $this->db->from('renstra_kp kp');
    $this->db->join('renstra_pp pp', 'kp.id_pp = pp.id');
    $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id');
    $this->db->where('kp.id', $id);
    $this->db->where('kp.deleted_at IS NULL');
    $kp = $this->db->get()->row_array();

    if (!$kp || $kp['id_kementerian'] != $_SESSION['IdKementerian']) {
        echo 'Data tidak ditemukan atau bukan milik Anda';
        return;
    }

    $data = [
        'kode_kp'     => trim($this->input->post('kode_kp')),
        'nama_kp'     => trim($this->input->post('nama_kp')),
        'keterangan'  => trim($this->input->post('keterangan')),
        'updated_at'  => date('Y-m-d H:i:s')
    ];

    $this->db->where('id', $id);
    $this->db->update('renstra_kp', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update KP!';
}

public function DeleteKP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id = $this->input->post('id');
    $this->db->select('kp.*, pp.id_pn, pn.id_kementerian');
    $this->db->from('renstra_kp kp');
    $this->db->join('renstra_pp pp', 'kp.id_pp = pp.id');
    $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id');
    $this->db->where('kp.id', $id);
    $this->db->where('kp.deleted_at IS NULL');
    $kp = $this->db->get()->row_array();

    if (!$kp || $kp['id_kementerian'] != $_SESSION['IdKementerian']) {
        echo 'Data tidak ditemukan atau bukan milik Anda';
        return;
    }

    $this->db->where('id', $id);
    $this->db->update('renstra_kp', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus KP!';
}

// ===================== CRUD Pro-P =====================
public function InputProP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id_kp = $this->input->post('id_kp');
    $this->db->select('kp.*, pp.id_pn, pn.id_kementerian');
    $this->db->from('renstra_kp kp');
    $this->db->join('renstra_pp pp', 'kp.id_pp = pp.id');
    $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id');
    $this->db->where('kp.id', $id_kp);
    $this->db->where('kp.deleted_at IS NULL');
    $kp = $this->db->get()->row_array();

    if (!$kp || $kp['id_kementerian'] != $_SESSION['IdKementerian']) {
        echo 'KP tidak ditemukan atau bukan milik Anda';
        return;
    }

    $data = [
        'id_kp'       => $id_kp,
        'kode_prop'   => trim($this->input->post('kode_prop')),
        'nama_prop'   => trim($this->input->post('nama_prop')),
        'target'      => trim($this->input->post('target')),
        'indikator'   => trim($this->input->post('indikator')),
        'keterangan'  => trim($this->input->post('keterangan')),
        'created_at'  => date('Y-m-d H:i:s')
    ];

    $this->db->insert('renstra_prop', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Proyek Prioritas';
}

public function UpdateProP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id = $this->input->post('id');
    $this->db->select('prop.*, kp.id_pp, pp.id_pn, pn.id_kementerian');
    $this->db->from('renstra_prop prop');
    $this->db->join('renstra_kp kp', 'prop.id_kp = kp.id');
    $this->db->join('renstra_pp pp', 'kp.id_pp = pp.id');
    $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id');
    $this->db->where('prop.id', $id);
    $this->db->where('prop.deleted_at IS NULL');
    $prop = $this->db->get()->row_array();

    if (!$prop || $prop['id_kementerian'] != $_SESSION['IdKementerian']) {
        echo 'Data tidak ditemukan atau bukan milik Anda';
        return;
    }

    $data = [
        'kode_prop'   => trim($this->input->post('kode_prop')),
        'nama_prop'   => trim($this->input->post('nama_prop')),
        'target'      => trim($this->input->post('target')),
        'indikator'   => trim($this->input->post('indikator')),
        'keterangan'  => trim($this->input->post('keterangan')),
        'updated_at'  => date('Y-m-d H:i:s')
    ];

    $this->db->where('id', $id);
    $this->db->update('renstra_prop', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Proyek Prioritas';
}

public function DeleteProP() {
    if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1) {
        echo 'Akses ditolak';
        return;
    }

    $id = $this->input->post('id');
    $this->db->select('prop.*, kp.id_pp, pp.id_pn, pn.id_kementerian');
    $this->db->from('renstra_prop prop');
    $this->db->join('renstra_kp kp', 'prop.id_kp = kp.id');
    $this->db->join('renstra_pp pp', 'kp.id_pp = pp.id');
    $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id');
    $this->db->where('prop.id', $id);
    $this->db->where('prop.deleted_at IS NULL');
    $prop = $this->db->get()->row_array();

    if (!$prop || $prop['id_kementerian'] != $_SESSION['IdKementerian']) {
        echo 'Data tidak ditemukan atau bukan milik Anda';
        return;
    }

    $this->db->where('id', $id);
    $this->db->update('renstra_prop', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Proyek Prioritas';
}



    public function MatriksKinerja() {
        $Header['Halaman'] = 'Matriks Kinerja dan Pendanaan';

        // Inisialisasi default info kementerian & periode
        $Data['UserKementerianName'] = '-';
        $Data['UserPeriode']         = '-';

        // Cek session
        if (!isset($_SESSION['Level']) || $_SESSION['Level'] != 1 ||
            !isset($_SESSION['IdKementerian']) || !is_numeric($_SESSION['IdKementerian'])) {
            $Data['UserKementerianName'] = 'Silakan login sebagai user kementerian';
        } else {
            $this->db->where('Id', $_SESSION['IdKementerian']);
            $this->db->where('deleted_at IS NULL');
            $kementerian = $this->db->get('kementerian')->row_array();

            if ($kementerian) {
                $Data['UserKementerianName'] = $kementerian['NamaKementerian'] ?? '-';
                $Data['UserPeriode']         = ($kementerian['TahunMulai'] ?? '-') . ' - ' . ($kementerian['TahunAkhir'] ?? '-');
            } else {
                $Data['UserKementerianName'] = 'Data kementerian tidak ditemukan';
            }
        }

        // Query Matriks dengan filter id_kementerian
        $this->db->select([
            'prog.id AS program_id',
            'prog.kode_program',
            'prog.nama_program',
            'keg.id AS kegiatan_id',
            'keg.kode_kegiatan',
            'keg.nama_kegiatan',
            'rin.id AS rincian_id',
            'rin.kode_rincian',
            'rin.nama_rincian',
            'rin.lokasi',
            'rin.satuan',
            'rin.unit_organisasi',
            'pend.id AS pend_id',
            'pend.indikator',
            'pend.target_2025', 'pend.target_2026', 'pend.target_2027', 'pend.target_2028', 'pend.target_2029',
            'pend.apbn_2025', 'pend.apbn_2026', 'pend.apbn_2027', 'pend.apbn_2028', 'pend.apbn_2029',
            'pend.non_apbn_2025', 'pend.non_apbn_2026', 'pend.non_apbn_2027', 'pend.non_apbn_2028', 'pend.non_apbn_2029',
            'pend.total_2025', 'pend.total_2026', 'pend.total_2027', 'pend.total_2028', 'pend.total_2029'
        ]);
        $this->db->from('renstra_program prog');
        $this->db->join('renstra_kegiatan keg', 'keg.id_program = prog.id', 'left');
        $this->db->join('renstra_rincian rin', 'rin.id_kegiatan = keg.id', 'left');
        $this->db->join('renstra_kinerja_pendanaan pend', 'pend.id_rincian = rin.id AND pend.deleted_at IS NULL', 'left');
        $this->db->where('prog.id_kementerian', $_SESSION['IdKementerian']);
        $this->db->where('prog.deleted_at IS NULL');
        $this->db->order_by('prog.kode_program ASC, keg.kode_kegiatan ASC, rin.kode_rincian ASC');
        $Data['DataMatriks'] = $this->db->get()->result_array();

        // Tambahkan CSRF ke view
        $Data['csrf_name'] = $this->security->get_csrf_token_name();
        $Data['csrf_hash'] = $this->security->get_csrf_hash();

        $this->load->view('Kementerian/header', $Header);
        $this->load->view('Kementerian/MatriksKinerja', $Data);
    }

    // Ambil data untuk edit (AJAX)
    public function GetMatriksById()
    {
        $response = ['status' => 'error', 'message' => 'Data tidak ditemukan'];

        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            if ($id && is_numeric($id)) {
                $this->db->select('pend.*, rin.nama_rincian');
                $this->db->from('renstra_kinerja_pendanaan pend');
                $this->db->join('renstra_rincian rin', 'rin.id = pend.id_rincian', 'left');
                $this->db->where('pend.id', $id);
                $this->db->where('pend.deleted_at IS NULL');
                $data = $this->db->get()->row_array();

                if ($data) {
                    $response = [
                        'status' => 'success',
                        'data'   => $data
                    ];
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    // Simpan (tambah / edit)
    public function SaveMatriks()
    {
        $response = ['status' => 'error', 'message' => 'Gagal menyimpan data'];

        if ($this->input->is_ajax_request()) {
            try {
                $id = $this->input->post('id');
                
                // Validasi input
                $id_rincian = $this->input->post('id_rincian');
                if (empty($id_rincian)) {
                    throw new Exception('ID Rincian tidak boleh kosong');
                }

                $data = [
                    'id_rincian' => $id_rincian,
                    'indikator'  => $this->input->post('indikator'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'updated_by' => $_SESSION['IdKementerian'] ?? 0
                ];

                // Proses data per tahun
                for ($th = 2025; $th <= 2029; $th++) {
                    $target = $this->input->post("target_$th");
                    $apbn = $this->input->post("apbn_$th");
                    $non_apbn = $this->input->post("non_apbn_$th");
                    
                    $data["target_$th"]   = !empty($target) ? (float)$target : 0;
                    $data["apbn_$th"]     = !empty($apbn) ? (float)$apbn : 0;
                    $data["non_apbn_$th"] = !empty($non_apbn) ? (float)$non_apbn : 0;
                    $data["total_$th"]    = $data["apbn_$th"] + $data["non_apbn_$th"];
                }

                if (!empty($id) && is_numeric($id)) {
                    // Update
                    $this->db->where('id', $id);
                    $this->db->where('deleted_at IS NULL');
                    
                    if ($this->db->update('renstra_kinerja_pendanaan', $data)) {
                        $response = ['status' => 'success', 'message' => 'Data berhasil diperbarui'];
                    } else {
                        $db_error = $this->db->error();
                        $response['message'] = 'Database error: ' . $db_error['message'];
                    }
                } else {
                    // Tambah baru
                    $data['created_at'] = date('Y-m-d H:i:s');
                    $data['created_by'] = $_SESSION['IdKementerian'] ?? 0;
                    
                    if ($this->db->insert('renstra_kinerja_pendanaan', $data)) {
                        $response = ['status' => 'success', 'message' => 'Data berhasil ditambahkan'];
                    } else {
                        $db_error = $this->db->error();
                        $response['message'] = 'Database error: ' . $db_error['message'];
                    }
                }
            } catch (Exception $e) {
                $response['message'] = 'Exception: ' . $e->getMessage();
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }

    // Hapus (soft delete)
    public function DeleteMatriks()
    {
        $response = ['status' => 'error', 'message' => 'Gagal menghapus data'];

        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            if ($id && is_numeric($id)) {
                $data = [
                    'deleted_at' => date('Y-m-d H:i:s'),
                    'deleted_by' => $_SESSION['IdKementerian'] ?? 0
                ];
                
                $this->db->where('id', $id);
                $this->db->where('deleted_at IS NULL');
                $this->db->update('renstra_kinerja_pendanaan', $data);

                if ($this->db->affected_rows() > 0) {
                    $response = ['status' => 'success', 'message' => 'Data berhasil dihapus'];
                }
            }
        }

        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($response));
    }


public function pendanaan() {
        $Header['Halaman'] = 'Matriks Pendanaan Renstra';

        // Default info kementerian & periode
        $Data['UserKementerianName'] = '-';
        $Data['UserPeriode']         = '-';

        // Ambil data kementerian dari session
        if (isset($_SESSION['IdKementerian']) && is_numeric($_SESSION['IdKementerian'])) {
            $this->db->where('Id', $_SESSION['IdKementerian']);
            $this->db->where('deleted_at IS NULL');
            $kementerian = $this->db->get('kementerian')->row_array();

            if ($kementerian) {
                $Data['UserKementerianName'] = $kementerian['NamaKementerian'] ?? '-';
                $Data['UserPeriode']         = ($kementerian['TahunMulai'] ?? '-') . ' - ' . ($kementerian['TahunAkhir'] ?? '-');
            } else {
                $Data['UserKementerianName'] = 'Data kementerian tidak ditemukan';
            }
        }

        // Kegiatan Prioritas (KP)
        $this->db->select('kp.id AS kp_id, kp.kode_kp, kp.nama_kp,
                           pend.id AS pend_id, pend.penugasan_indikator,
                           pend.target_2025, pend.target_2026, pend.target_2027, pend.target_2028, pend.target_2029,
                           pend.apbn_2025, pend.apbn_2026, pend.apbn_2027, pend.apbn_2028, pend.apbn_2029,
                           pend.non_apbn_2025, pend.non_apbn_2026, pend.non_apbn_2027, pend.non_apbn_2028, pend.non_apbn_2029,
                           pend.total_2025, pend.total_2026, pend.total_2027, pend.total_2028, pend.total_2029');
        $this->db->from('renstra_kp kp');
        $this->db->join('renstra_pp pp', 'kp.id_pp = pp.id', 'inner');
        $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id', 'inner');
        $this->db->join('renstra_pendanaan pend', 'pend.id_kp = kp.id AND pend.jenis = "KP" AND pend.deleted_at IS NULL', 'left');
        $this->db->where('pn.id_kementerian', $_SESSION['IdKementerian']);
        $this->db->where('kp.deleted_at IS NULL');
        $this->db->order_by('kp.kode_kp', 'ASC');
        $Data['Kegiatan'] = $this->db->get()->result_array();

        // Proyek Prioritas (ProP)
        $this->db->select('prop.id AS prop_id, prop.kode_prop, prop.nama_prop,
                           pend.id AS pend_id, pend.penugasan_indikator,
                           pend.target_2025, pend.target_2026, pend.target_2027, pend.target_2028, pend.target_2029,
                           pend.apbn_2025, pend.apbn_2026, pend.apbn_2027, pend.apbn_2028, pend.apbn_2029,
                           pend.non_apbn_2025, pend.non_apbn_2026, pend.non_apbn_2027, pend.non_apbn_2028, pend.non_apbn_2029,
                           pend.total_2025, pend.total_2026, pend.total_2027, pend.total_2028, pend.total_2029');
        $this->db->from('renstra_prop prop');
        $this->db->join('renstra_kp kp', 'prop.id_kp = kp.id', 'inner');
        $this->db->join('renstra_pp pp', 'kp.id_pp = pp.id', 'inner');
        $this->db->join('renstra_pn pn', 'pp.id_pn = pn.id', 'inner');
        $this->db->join('renstra_pendanaan pend', 'pend.id_prop = prop.id AND pend.jenis = "ProP" AND pend.deleted_at IS NULL', 'left');
        $this->db->where('pn.id_kementerian', $_SESSION['IdKementerian']);
        $this->db->where('prop.deleted_at IS NULL');
        $this->db->order_by('prop.kode_prop', 'ASC');
        $Data['Proyek'] = $this->db->get()->result_array();

        // Load view
        $this->load->view('Kementerian/header', $Header);
        $this->load->view('Kementerian/Pendanaan', $Data);
    }

    // AJAX: Ambil data pendanaan berdasarkan ID (untuk modal detail & edit)
    public function GetPendanaanById() {
        $id = $this->input->post('id');
        if (!$id || !is_numeric($id)) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
            return;
        }

        $this->db->where('id', $id);
        $this->db->where('deleted_at IS NULL');
        $data = $this->db->get('renstra_pendanaan')->row_array();

        if ($data) {
            // Ambil nama entitas berdasarkan jenis
            if ($data['jenis'] === 'KP') {
                $this->db->select('nama_kp AS nama_entitas');
                $this->db->where('id', $data['id_kp']);
                $entitas = $this->db->get('renstra_kp')->row_array();
            } else {
                $this->db->select('nama_prop AS nama_entitas');
                $this->db->where('id', $data['id_prop']);
                $entitas = $this->db->get('renstra_prop')->row_array();
            }

            $data['nama_entitas'] = $entitas['nama_entitas'] ?? 'Tidak diketahui';

            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    // AJAX: Simpan / Update pendanaan
   public function SavePendanaan() {
    $post = $this->input->post();

    // Log input untuk debug (cek di application/logs/log-*.php)
    log_message('debug', 'SavePendanaan POST data: ' . json_encode($post));

    // Validasi wajib
    if (empty($post['jenis']) || !in_array($post['jenis'], ['KP', 'ProP'])) {
        echo json_encode(['status' => 'error', 'message' => 'Jenis entitas tidak valid']);
        return;
    }

    if (empty($post['id_ref']) || !is_numeric($post['id_ref'])) {
        echo json_encode(['status' => 'error', 'message' => 'ID referensi tidak valid']);
        return;
    }

    // Pastikan semua kolom numerik ada & default ke 0
    $years = range(2025, 2029);
    $columns = ['target_', 'apbn_', 'non_apbn_', 'total_'];
    foreach ($years as $year) {
        foreach ($columns as $col) {
            $key = $col . $year;
            $post[$key] = isset($post[$key]) && is_numeric($post[$key]) ? (float)$post[$key] : 0;
        }
    }

    // Hitung ulang total sebagai backup
    foreach ($years as $year) {
        $post['total_' . $year] = $post['apbn_' . $year] + $post['non_apbn_' . $year];
    }

    // Siapkan data untuk insert/update
    $data = [
        'jenis'                  => $post['jenis'],
        'id_kp'                  => ($post['jenis'] === 'KP') ? $post['id_ref'] : null,
        'id_prop'                => ($post['jenis'] === 'ProP') ? $post['id_ref'] : null,
        'penugasan_indikator'    => $post['penugasan_indikator'] ?? null,
    ];

    // Masukkan semua kolom tahun
    foreach ($years as $year) {
        $data['target_' . $year]     = $post['target_' . $year];
        $data['apbn_' . $year]       = $post['apbn_' . $year];
        $data['non_apbn_' . $year]   = $post['non_apbn_' . $year];
        $data['total_' . $year]      = $post['total_' . $year];
    }

    if (!empty($post['id']) && is_numeric($post['id'])) {
        // Update
        $id = $post['id'];
        $this->db->where('id', $id);
        $updated = $this->db->update('renstra_pendanaan', $data);

        if ($updated) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
        } else {
            $error = $this->db->error();
            echo json_encode(['status' => 'error', 'message' => 'Gagal update: ' . ($error['message'] ?? 'Unknown error')]);
        }
    } else {
        // Insert baru
        $inserted = $this->db->insert('renstra_pendanaan', $data);

        if ($inserted) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil disimpan']);
        } else {
            $error = $this->db->error();
            echo json_encode(['status' => 'error', 'message' => 'Gagal insert: ' . ($error['message'] ?? 'Unknown error')]);
        }
    }
}
    // AJAX: Hapus pendanaan (soft delete)
    public function DeletePendanaan() {
        $id = $this->input->post('id');
        if (!$id || !is_numeric($id)) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
            return;
        }

        $this->db->where('id', $id);
        $this->db->update('renstra_pendanaan', ['deleted_at' => date('Y-m-d H:i:s')]);
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
    }

}
