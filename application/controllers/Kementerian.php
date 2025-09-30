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
        
        // Get filter parameters
        $periodeFilter = $this->input->get('periode');
        $kementerianFilter = $this->input->get('kementerian');
        
        // Query SPM with filters
        $this->db->select('s.*, k.NamaKementerian');
        $this->db->from('spm s');
        $this->db->join('kementerian k', 's.IdKementerian = k.Id', 'left');
        $this->db->where('s.deleted_at IS NULL');
        
        if ($periodeFilter) {
            list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
            $this->db->where('s.TahunMulai', $tahunMulai);
            $this->db->where('s.TahunAkhir', $tahunAkhir);
        }
        
        if ($kementerianFilter) {
            $this->db->where('s.IdKementerian', $kementerianFilter);
        }
        
        $Data['SPM'] = $this->db->get()->result_array();
        
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
        
        // Store current filters
        $Data['CurrentPeriode'] = $periodeFilter;
        $Data['CurrentKementerian'] = $kementerianFilter;
        
        $this->load->view('Kementerian/header', $Header);
        $this->load->view('Kementerian/SPM', $Data);
    }

    public function InputSPM() {
        if (!$this->input->post('IdKementerian') || !$this->input->post('TahunMulai') || !$this->input->post('TahunAkhir')) {
            echo 'Periode dan Kementerian harus dipilih di filter!';
            return;
        }

        $data = [
            'IdKementerian' => $this->input->post('IdKementerian'),
            'NamaSPM' => $this->input->post('NamaSPM'),
            'TahunMulai' => $this->input->post('TahunMulai'),
            'TahunAkhir' => $this->input->post('TahunAkhir'),
            'TargetTahun1' => $this->input->post('TargetTahun1'),
            'TargetTahun2' => $this->input->post('TargetTahun2'),
            'TargetTahun3' => $this->input->post('TargetTahun3'),
            'TargetTahun4' => $this->input->post('TargetTahun4'),
            'TargetTahun5' => $this->input->post('TargetTahun5'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('spm', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
    }

    public function UpdateSPM() {
        $data = [
            'IdKementerian' => $this->input->post('IdKementerian'),
            'NamaSPM' => $this->input->post('NamaSPM'),
            'TahunMulai' => $this->input->post('TahunMulai'),
            'TahunAkhir' => $this->input->post('TahunAkhir'),
            'TargetTahun1' => $this->input->post('TargetTahun1'),
            'TargetTahun2' => $this->input->post('TargetTahun2'),
            'TargetTahun3' => $this->input->post('TargetTahun3'),
            'TargetTahun4' => $this->input->post('TargetTahun4'),
            'TargetTahun5' => $this->input->post('TargetTahun5'),
            'edited_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('spm', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
    }

    public function DeleteSPM() {
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('spm', $data);
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
        
        // Get filter parameters
        $periodeFilter = $this->input->get('periode');
        $kementerianFilter = $this->input->get('kementerian');
        
        // Query program data with filters
        $this->db->select("
            ps.Id, ps.IdKementerian, ps.NamaProgram, ps.KodeWilayah, ps.KodeKota, 
            ps.TahunMulai, ps.TahunAkhir, ps.TargetTahun1, ps.TargetTahun2, 
            ps.TargetTahun3, ps.TargetTahun4, ps.TargetTahun5,
            k.NamaKementerian,
            (SELECT GROUP_CONCAT(kw.Nama SEPARATOR ', ') 
             FROM kodewilayah kw 
             WHERE FIND_IN_SET(kw.Kode, ps.KodeWilayah) AND LENGTH(kw.Kode) = 2) AS NamaProvinsi,
            (SELECT GROUP_CONCAT(kw.Nama SEPARATOR ', ') 
             FROM kodewilayah kw 
             WHERE FIND_IN_SET(kw.Kode, ps.KodeKota)) AS NamaKota
        ");
        $this->db->from('program_strategis ps');
        $this->db->join('kementerian k', 'ps.IdKementerian = k.Id', 'left');
        $this->db->where('ps.deleted_at IS NULL');
        
        if ($periodeFilter) {
            list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
            $this->db->where('ps.TahunMulai', $tahunMulai);
            $this->db->where('ps.TahunAkhir', $tahunAkhir);
        }
        
        if ($kementerianFilter) {
            $this->db->where('ps.IdKementerian', $kementerianFilter);
        }
        
        $this->db->order_by('ps.TahunMulai', 'DESC');
        $this->db->order_by('ps.TahunAkhir', 'DESC');
        $Data['Program'] = $this->db->get()->result_array();
        
        // Get provinces for dropdown
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
        
        // Get kementerian for dropdown
        $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
        
        // Get unique periods
        $Data['Periode'] = $this->db->query("
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM kementerian
            WHERE deleted_at IS NULL
            UNION
            SELECT DISTINCT TahunMulai, TahunAkhir
            FROM program_strategis
            WHERE deleted_at IS NULL
            ORDER BY TahunMulai DESC, TahunAkhir DESC
        ")->result_array();
        
        // Pass current filter values
        $Data['CurrentPeriode'] = $periodeFilter;
        $Data['CurrentKementerian'] = $kementerianFilter;
        
        $this->load->view('Kementerian/header', $Header);
        $this->load->view('Kementerian/ProgramStrategis', $Data);
    }


    public function GetKotaByProvinsi() {
        $kode_provinsi = $this->input->post('kode_provinsi');
        $kota = $this->db->where("Kode LIKE '$kode_provinsi.__'")
                        ->where('LENGTH(REPLACE(Kode, \'.\', \'\')) = 4')
                        ->order_by('Nama')
                        ->get('kodewilayah')
                        ->result_array();
        echo json_encode($kota);
    }

    public function GetLokasiByIds() {
        $ProvinsiIds = $this->input->post('ProvinsiIds');
        $KotaIds = $this->input->post('KotaIds');
        
        $result = [];
        $provinsiArray = $ProvinsiIds ? explode(',', $ProvinsiIds) : [];
        $kotaArray = $KotaIds ? explode(',', $KotaIds) : [];
        
        foreach ($provinsiArray as $index => $provId) {
            $kotaId = isset($kotaArray[$index]) ? $kotaArray[$index] : '';
            
            $this->db->select('Nama');
            $this->db->where('Kode', $provId);
            $provinsi = $this->db->get('kodewilayah')->row_array();
            
            $kota = ['Nama' => '-'];
            if ($kotaId) {
                $this->db->select('Nama');
                $this->db->where('Kode', $kotaId);
                $kota = $this->db->get('kodewilayah')->row_array() ?: ['Nama' => '-'];
            }
            
            $result[] = [
                'Provinsi' => $provinsi ? $provinsi['Nama'] : '-',
                'Kota' => $kota['Nama']
            ];
        }
        
        echo json_encode($result);
    }

    public function InputProgram() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('IdKementerian', 'Kementerian', 'required');
        $this->form_validation->set_rules('NamaProgram', 'Nama Program', 'required');
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
            'KodeWilayah' => implode(',', $KodeWilayah),
            'KodeKota' => implode(',', $KodeKota),
            'NamaProgram' => $this->input->post('NamaProgram'),
            'TahunMulai' => $this->input->post('TahunMulai'),
            'TahunAkhir' => $this->input->post('TahunAkhir'),
            'TargetTahun1' => $this->input->post('TargetTahun1') ?: null,
            'TargetTahun2' => $this->input->post('TargetTahun2') ?: null,
            'TargetTahun3' => $this->input->post('TargetTahun3') ?: null,
            'TargetTahun4' => $this->input->post('TargetTahun4') ?: null,
            'TargetTahun5' => $this->input->post('TargetTahun5') ?: null,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('program_strategis', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
    }

    public function UpdateProgram() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Id', 'ID Program', 'required');
        $this->form_validation->set_rules('IdKementerian', 'Kementerian', 'required');
        $this->form_validation->set_rules('NamaProgram', 'Nama Program', 'required');
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
            'KodeWilayah' => implode(',', $KodeWilayah),
            'KodeKota' => implode(',', $KodeKota),
            'NamaProgram' => $this->input->post('NamaProgram'),
            'TahunMulai' => $this->input->post('TahunMulai'),
            'TahunAkhir' => $this->input->post('TahunAkhir'),
            'TargetTahun1' => $this->input->post('TargetTahun1') ?: null,
            'TargetTahun2' => $this->input->post('TargetTahun2') ?: null,
            'TargetTahun3' => $this->input->post('TargetTahun3') ?: null,
            'TargetTahun4' => $this->input->post('TargetTahun4') ?: null,
            'TargetTahun5' => $this->input->post('TargetTahun5') ?: null,
            'edited_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('program_strategis', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
    }

    public function UpdateLokasiForProgram() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Id', 'ID Program', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            return;
        }
        
        $KodeWilayah = $this->input->post('KodeWilayah') ? array_filter($this->input->post('KodeWilayah')) : [];
        $KodeKota = $this->input->post('KodeKota') ? array_filter($this->input->post('KodeKota')) : [];
        
        $data = [
            'KodeWilayah' => implode(',', $KodeWilayah),
            'KodeKota' => implode(',', $KodeKota),
            'edited_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('program_strategis', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Lokasi!';
    }

    public function DeleteProgram() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('Id', 'ID Program', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            echo validation_errors();
            return;
        }
        
        $data = ['deleted_at' => date('Y-m-d H:i:s')];
        $this->db->where('Id', $this->input->post('Id'));
        $this->db->update('program_strategis', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
    }
    
 public function IsuStrategis() {
    $Header['Halaman'] = 'Isu';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Query IsuStrategis with filters
    $this->db->select("
        ist.*, 
        IFNULL(k.NamaKementerian, '-') AS NamaKementerian,
        (SELECT GROUP_CONCAT(NamaIsuKLHS SEPARATOR ', ') 
         FROM isu_klhs 
         WHERE FIND_IN_SET(Id, ist.IdIsuKLHS)) AS NamaIsuKLHS,
        (SELECT GROUP_CONCAT(NamaIsuGlobal SEPARATOR ', ') 
         FROM isu_global 
         WHERE FIND_IN_SET(Id, ist.IdIsuGlobal)) AS NamaIsuGlobal,
        (SELECT GROUP_CONCAT(NamaIsuNasional SEPARATOR ', ') 
         FROM isu_nasional 
         WHERE FIND_IN_SET(Id, ist.IdIsuNasional)) AS NamaIsuNasional,
        (SELECT GROUP_CONCAT(NamaPermasalahanPokok SEPARATOR ', ') 
         FROM permasalahan_pokok 
         WHERE FIND_IN_SET(Id, ist.IdPermasalahanPokok)) AS NamaPermasalahanPokok
    ");
    $this->db->from('isu_strategis ist');
    $this->db->join('kementerian k', 'ist.IdKementerian = k.Id', 'left');
    $this->db->where('ist.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('ist.TahunMulai', $tahunMulai);
        $this->db->where('ist.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('ist.IdKementerian', $kementerianFilter);
    }
    
    $this->db->group_by('ist.Id');
    $this->db->order_by('ist.TahunMulai DESC, ist.TahunAkhir DESC');
    
    $Data['IsuStrategis'] = $this->db->get()->result_array();
    
    // Get all unique periods from all related tables
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir FROM kementerian WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM isu_strategis WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM permasalahan_pokok WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM isu_klhs WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM isu_global WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM isu_nasional WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC, TahunAkhir DESC
    ")->result_array();
    
    // Get periods for input form (distinct from isu_strategis only)
    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM isu_strategis 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC, TahunAkhir DESC
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
        // Fetch all ministries if no period is selected
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'deleted_at' => NULL
        ])->result_array();
    }
    
    // Store current filters
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
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

public function GetIsuByPeriode() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    $Jenis = $this->input->post('Jenis');
    
    $table = '';
    switch($Jenis) {
        case 'KLHS': $table = 'isu_klhs'; break;
        case 'Global': $table = 'isu_global'; break;
        case 'Nasional': $table = 'isu_nasional'; break;
        default: echo json_encode([]); return;
    }
    
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at', NULL);
    $Data = $this->db->get($table)->result_array();
    
    echo json_encode($Data);
}

public function GetPermasalahanByPeriode() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at', NULL);
    $Data = $this->db->get('permasalahan_pokok')->result_array();
    
    echo json_encode($Data);
}

public function GetIsuByIds() {
    $Ids = $this->input->post('Ids');
    $Jenis = $this->input->post('Jenis');
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    $table = '';
    switch($Jenis) {
        case 'KLHS': $table = 'isu_klhs'; break;
        case 'Global': $table = 'isu_global'; break;
        case 'Nasional': $table = 'isu_nasional'; break;
        default: echo json_encode([]); return;
    }
    
    if ($Ids) {
        $this->db->where('TahunMulai', $TahunMulai);
        $this->db->where('TahunAkhir', $TahunAkhir);
        $this->db->where('deleted_at', NULL);
        $this->db->where_in('Id', explode(',', $Ids));
        $Data = $this->db->get($table)->result_array();
        
        echo json_encode($Data);
    } else {
        echo json_encode([]);
    }
}

public function GetPermasalahanByIds() {
    $Ids = $this->input->post('Ids');
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at', NULL);
    $this->db->where_in('Id', explode(',', $Ids));
    $Data = $this->db->get('permasalahan_pokok')->result_array();
    
    echo json_encode($Data);
}

public function InputIsuStrategis() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('IdKementerian', 'Kementerian', 'required');
    $this->form_validation->set_rules('NamaIsuStrategis', 'Nama Isu Strategis', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }
    
    $IdIsuKLHS = $this->input->post('IdIsuKLHS') ? array_filter($this->input->post('IdIsuKLHS')) : [];
    $IdIsuGlobal = $this->input->post('IdIsuGlobal') ? array_filter($this->input->post('IdIsuGlobal')) : [];
    $IdIsuNasional = $this->input->post('IdIsuNasional') ? array_filter($this->input->post('IdIsuNasional')) : [];
    $IdPermasalahanPokok = $this->input->post('IdPermasalahanPokok') ? array_filter($this->input->post('IdPermasalahanPokok')) : [];
    
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'IdIsuKLHS' => implode(',', $IdIsuKLHS),
        'IdIsuGlobal' => implode(',', $IdIsuGlobal),
        'IdIsuNasional' => implode(',', $IdIsuNasional),
        'IdPermasalahanPokok' => implode(',', $IdPermasalahanPokok),
        'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('isu_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateIsuStrategis() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('Id', 'ID Isu', 'required');
    $this->form_validation->set_rules('IdKementerian', 'Kementerian', 'required');
    $this->form_validation->set_rules('NamaIsuStrategis', 'Nama Isu Strategis', 'required');
    $this->form_validation->set_rules('TahunMulai', 'Tahun Mulai', 'required');
    $this->form_validation->set_rules('TahunAkhir', 'Tahun Akhir', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }
    
    $IdIsuKLHS = $this->input->post('IdIsuKLHS') ? array_filter($this->input->post('IdIsuKLHS')) : [];
    $IdIsuGlobal = $this->input->post('IdIsuGlobal') ? array_filter($this->input->post('IdIsuGlobal')) : [];
    $IdIsuNasional = $this->input->post('IdIsuNasional') ? array_filter($this->input->post('IdIsuNasional')) : [];
    $IdPermasalahanPokok = $this->input->post('IdPermasalahanPokok') ? array_filter($this->input->post('IdPermasalahanPokok')) : [];
    
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'IdIsuKLHS' => implode(',', $IdIsuKLHS),
        'IdIsuGlobal' => implode(',', $IdIsuGlobal),
        'IdIsuNasional' => implode(',', $IdIsuNasional),
        'IdPermasalahanPokok' => implode(',', $IdPermasalahanPokok),
        'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function UpdateIsuKLHSForStrategis() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('Id', 'ID Isu', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }
    
    $IdIsuKLHS = $this->input->post('IdIsuKLHS') ? array_filter($this->input->post('IdIsuKLHS')) : [];
    
    $data = [
        'IdIsuKLHS' => implode(',', $IdIsuKLHS),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Isu KLHS!';
}

public function UpdateIsuGlobalForStrategis() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('Id', 'ID Isu', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }
    
    $IdIsuGlobal = $this->input->post('IdIsuGlobal') ? array_filter($this->input->post('IdIsuGlobal')) : [];
    
    $data = [
        'IdIsuGlobal' => implode(',', $IdIsuGlobal),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Isu Global!';
}

public function UpdateIsuNasionalForStrategis() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('Id', 'ID Isu', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }
    
    $IdIsuNasional = $this->input->post('IdIsuNasional') ? array_filter($this->input->post('IdIsuNasional')) : [];
    
    $data = [
        'IdIsuNasional' => implode(',', $IdIsuNasional),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Isu Nasional!';
}

public function UpdatePermasalahanForStrategis() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('Id', 'ID Isu', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }
    
    $IdPermasalahanPokok = $this->input->post('IdPermasalahanPokok') ? array_filter($this->input->post('IdPermasalahanPokok')) : [];
    
    $data = [
        'IdPermasalahanPokok' => implode(',', $IdPermasalahanPokok),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Permasalahan Pokok!';
}

public function DeleteIsuStrategis() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('Id', 'ID Isu', 'required');
    
    if ($this->form_validation->run() == FALSE) {
        echo validation_errors();
        return;
    }
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_strategis', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}


   
   
   public function PermasalahanPokok() {
    $Header['Halaman'] = 'Isu';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Main query with filters
    $this->db->select('pp.*, k.NamaKementerian');
    $this->db->from('permasalahan_pokok pp');
    $this->db->join('kementerian k', 'pp.IdKementerian = k.Id', 'left');
    $this->db->where('pp.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('pp.TahunMulai', $tahunMulai);
        $this->db->where('pp.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('pp.IdKementerian', $kementerianFilter);
    }
    
    $Data['PermasalahanPokok'] = $this->db->get()->result_array();
    
    // Get all unique periods for dropdowns
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    // Get all kementerian for input modal
    $Data['AllKementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get kementerian based on selected periode for filter
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'TahunMulai' => $tahunMulai,
            'TahunAkhir' => $tahunAkhir,
            'deleted_at' => NULL
        ])->result_array();
    } else {
        $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    }
    
    // Save current filter state
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/PermasalahanPokok', $Data);
}

public function InputPermasalahanPokok() {
    if (!$this->input->post('IdKementerian') || !$this->input->post('TahunMulai') || !$this->input->post('TahunAkhir')) {
        echo 'Periode dan Kementerian harus dipilih di filter!';
        return;
    }

    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'NamaPermasalahanPokok' => $this->input->post('NamaPermasalahanPokok'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('permasalahan_pokok', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdatePermasalahanPokok() {
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'NamaPermasalahanPokok' => $this->input->post('NamaPermasalahanPokok'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('permasalahan_pokok', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeletePermasalahanPokok() {
    $data = ['deleted_at' => date('Y-m-d H:i:s')];
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('permasalahan_pokok', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

  public function IsuKLHS() {
    $Header['Halaman'] = 'Isu';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Main query with filters
    $this->db->select('ik.*, k.NamaKementerian');
    $this->db->from('isu_klhs ik');
    $this->db->join('kementerian k', 'ik.IdKementerian = k.Id', 'left');
    $this->db->where('ik.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('ik.TahunMulai', $tahunMulai);
        $this->db->where('ik.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('ik.IdKementerian', $kementerianFilter);
    }
    
    $Data['IsuKLHS'] = $this->db->get()->result_array();
    
    // Get all unique periods for dropdowns
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    // Get all kementerian for input modal
    $Data['AllKementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get kementerian based on selected periode for filter
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
    
    // Save current filter state
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/IsuKLHS', $Data);
}

public function InputIsuKLHS() {
    if (!$this->input->post('IdKementerian') || !$this->input->post('TahunMulai') || !$this->input->post('TahunAkhir')) {
        echo 'Periode dan Kementerian harus dipilih di filter!';
        return;
    }

    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'NamaIsuKLHS' => $this->input->post('NamaIsuKLHS'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('isu_klhs', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateIsuKLHS() {
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'NamaIsuKLHS' => $this->input->post('NamaIsuKLHS'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_klhs', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuKLHS() {
    $data = ['deleted_at' => date('Y-m-d H:i:s')];
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('isu_klhs', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

public function IsuGlobal() {
    $Header['Halaman'] = 'Isu';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Main query with filters
    $this->db->select('ig.*, k.NamaKementerian');
    $this->db->from('isu_global ig');
    $this->db->join('kementerian k', 'ig.IdKementerian = k.Id', 'left');
    $this->db->where('ig.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('ig.TahunMulai', $tahunMulai);
        $this->db->where('ig.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('ig.IdKementerian', $kementerianFilter);
    }
    
    $Data['IsuGlobal'] = $this->db->get()->result_array();
    
    // Get all unique periods for dropdowns
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    // Get all kementerian for input modal
    $Data['AllKementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get kementerian based on selected periode for filter
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'TahunMulai' => $tahunMulai,
            'TahunAkhir' => $tahunAkhir,
            'deleted_at' => NULL
        ])->result_array();
    } else {
        $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    }
    
    // Save current filter state
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/IsuGlobal', $Data);
}

public function InputIsuGlobal() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaIsuGlobal' => $this->input->post('NamaIsuGlobal'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'created_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->insert('isu_global', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateIsuGlobal() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaIsuGlobal' => $this->input->post('NamaIsuGlobal'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'edited_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('isu_global', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuGlobal() {
  $data = ['deleted_at' => date('Y-m-d H:i:s')];
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('isu_global', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

public function IsuNasional() {
    $Header['Halaman'] = 'Isu';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Main query with filters
    $this->db->select('in.*, k.NamaKementerian');
    $this->db->from('isu_nasional in');
    $this->db->join('kementerian k', 'in.IdKementerian = k.Id', 'left');
    $this->db->where('in.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('in.TahunMulai', $tahunMulai);
        $this->db->where('in.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('in.IdKementerian', $kementerianFilter);
    }
    
    $Data['IsuNasional'] = $this->db->get()->result_array();
    
    // Get all unique periods for dropdowns
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    // Get all kementerian for input modal
    $Data['AllKementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get kementerian based on selected periode for filter
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'TahunMulai' => $tahunMulai,
            'TahunAkhir' => $tahunAkhir,
            'deleted_at' => NULL
        ])->result_array();
    } else {
        $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    }
    
    // Save current filter state
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/IsuNasional', $Data);
}

public function InputIsuNasional() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaIsuNasional' => $this->input->post('NamaIsuNasional'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'created_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->insert('isu_nasional', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateIsuNasional() {
  $data = [
      'IdKementerian' => $this->input->post('IdKementerian'),
      'NamaIsuNasional' => $this->input->post('NamaIsuNasional'),
      'TahunMulai' => $this->input->post('TahunMulai'),
      'TahunAkhir' => $this->input->post('TahunAkhir'),
      'edited_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('isu_nasional', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuNasional() {
  $data = ['deleted_at' => date('Y-m-d H:i:s')];
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('isu_nasional', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

public function SasaranStrategis() {
    $Header['Halaman'] = 'Kementerian';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Query SasaranStrategis with filters
    $this->db->select('ss.*, k.NamaKementerian');
    $this->db->from('sasaran_strategis ss');
    $this->db->join('kementerian k', 'ss.IdKementerian = k.Id', 'left');
    $this->db->where('ss.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('ss.TahunMulai', $tahunMulai);
        $this->db->where('ss.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('ss.IdKementerian', $kementerianFilter);
    }
    
    $Data['SasaranStrategis'] = $this->db->get()->result_array();
    
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
    
    // Store current filters
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
    $this->load->view('Kementerian/header', $Header);
    $this->load->view('Kementerian/SasaranStrategis', $Data);
}

public function InputSasaranStrategis() {
    if (!$this->input->post('IdKementerian') || !$this->input->post('TahunMulai') || !$this->input->post('TahunAkhir')) {
        echo 'Periode dan Kementerian harus dipilih di filter!';
        return;
    }

    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'SasaranStrategis' => $this->input->post('SasaranStrategis'),
        'IndikatorSasaranStrategis' => $this->input->post('IndikatorSasaranStrategis'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('sasaran_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateSasaranStrategis() {
    $data = [
        'SasaranStrategis' => $this->input->post('SasaranStrategis'),
        'IndikatorSasaranStrategis' => $this->input->post('IndikatorSasaranStrategis'),
        'edited_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('sasaran_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteSasaranStrategis() {
    $data = ['deleted_at' => date('Y-m-d H:i:s')];
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('sasaran_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

}

