<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Nasional extends CI_Controller {

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

  function GetListProvinsi(){
    echo json_encode($this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array());
  }

  function GetListKabKota(){
    echo json_encode($this->db->where("Kode LIKE "."'".$_POST['Kode'].".%"."' AND length(Kode) = 5")->get("kodewilayah")->result_array());
  }

  public function Akun() {
		$Header['Halaman'] = 'Akun';
		$Data['Akun'] = $this->db->query("SELECT * FROM `akun` WHERE Level != 0 AND deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/Akun',$Data);
	}

  public function InputAkun(){  
		$_POST['Password'] = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $this->db->insert('akun',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditAkun(){  
		$this->db->where('Username',$_POST['Username']); 
		if (isset($_POST['Password'])) {
			$_POST['Password'] = password_hash($_POST['Password'], PASSWORD_DEFAULT);
		}
		$this->db->update('akun', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

	public function HapusAkun(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Username',$_POST['Username']); 
		$this->db->update('akun', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function VisiRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    // 1. Ambil semua data Visi
    $visi_data = $this->db->where("deleted_at IS NULL")
                      ->order_by("Id", "DESC")
                      ->get("visirpjpn")
                      ->result_array();
    $result = [];
    foreach ($visi_data as $v) {
        $periode = $v['TahunMulai'] . '-' . $v['TahunAkhir'];
        
        $visi_item = [
            'Id'         => $v['Id'],
            'Visi'       => $v['Visi'],
            'Periode'    => $periode,
            'TahunMulai' => $v['TahunMulai'],
            'TahunAkhir' => $v['TahunAkhir'],
            'Sasaran'    => []
        ];

        // 2. Ambil data Sasaran langsung berdasarkan _Id (Id Visi)
        $this->db->where('_Id', $v['Id']);
        $sasaran_data = $this->db->where("deleted_at IS NULL")->get('sasaranrpjpn')->result_array();

        foreach ($sasaran_data as $s) {
            $sasaran_item = [
                'Id'        => $s['Id'],
                'Sasaran'   => $s['Sasaran'],
                'Periode'   => $periode,
                'Indikator' => []
            ];

            // 3. Ambil data Indikator berdasarkan _Id (Id Sasaran)
            $this->db->where('_Id', $s['Id']);
            $indikator_data = $this->db->where("deleted_at IS NULL")->get('indikator_sasaran_rpjpn')->result_array();

            foreach ($indikator_data as $ind) {
                $indikator_item = [
                    'Id'        => $ind['Id'],
                    'Indikator' => $ind['Indikator'],
                    'Baseline'  => $ind['Baseline'],
                    'Target'    => $ind['Target'],
                    'Periode'   => $periode
                ];
                $sasaran_item['Indikator'][] = $indikator_item;
            }

            $visi_item['Sasaran'][] = $sasaran_item;
        }

        // Masukkan visi ke hasil akhir
        $result[] = $visi_item;
    }

    $Data['DataVisi'] = $result;
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/VisiRPJPN',$Data);
	}

  public function InputVisiRPJPN(){  
    $this->db->insert('visirpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visirpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetVisiRPJPN(){
    echo json_encode($this->db->where("Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjpn")->result_array());
	}

  public function MisiRPJPN(){
		$Header['Halaman'] = 'RPJPN';

    // Ambil data Visi aktif (untuk pilihan periode jika input / modal)
    $Data['DataVisi'] = $this->db->where("deleted_at IS NULL")->order_by("Id", "DESC")->get("visirpjpn")->result_array();

    // 3 Kategori Misi RPJPN
    $kategori_list = [
        'Transformasi Indonesia',
        'Landasan Transformasi',
        'Kerangka Implementasi Transformasi'
    ];

    $grouped_misi = [
        'Transformasi Indonesia' => [],
        'Landasan Transformasi' => [],
        'Kerangka Implementasi Transformasi' => []
    ];

    $all_misi = $this->db->query("
        SELECT m.*, v.TahunMulai, v.TahunAkhir 
        FROM misirpjpn as m 
        LEFT JOIN visirpjpn as v ON m._Id = v.Id 
        WHERE m.deleted_at IS NULL 
        ORDER BY m.Id ASC
    ")->result_array();

    foreach ($all_misi as $m) {
        $periode = !empty($m['Periode']) ? $m['Periode'] : (!empty($m['TahunMulai']) ? ($m['TahunMulai'] . '-' . $m['TahunAkhir']) : '-');
        $kat = isset($m['Kategori']) ? $m['Kategori'] : '';
        $misi_item = [
            'Id'         => $m['Id'],
            '_Id'        => $m['_Id'],
            'Misi'       => $m['Misi'],
            'Kategori'   => $kat,
            'Periode'    => $periode
        ];

        // Kelompokkan berdasarkan kategori
        if (!empty($kat) && isset($grouped_misi[$kat])) {
            $grouped_misi[$kat][] = $misi_item;
        } else {
            $grouped_misi['Transformasi Indonesia'][] = $misi_item;
        }
    }

    $Data['MisiGrouped'] = $grouped_misi;
    $Data['KategoriList'] = $kategori_list;

		$this->load->view('Nasional/header', $Header);
		$this->load->view('Nasional/MisiRPJPN', $Data);
	}

  public function InputMisiRPJPN(){
    if (empty($_POST['_Id'])) {
      $visi = null;
      if (!empty($_POST['Periode'])) {
        $cleanPeriode = str_replace(' ', '', $_POST['Periode']);
        $parts = explode('-', $cleanPeriode);
        if (count($parts) == 2) {
          $visi = $this->db->where('TahunMulai', trim($parts[0]))
                           ->where('TahunAkhir', trim($parts[1]))
                           ->where('deleted_at IS NULL')
                           ->get('visirpjpn')->row_array();
        }
      }
      if (!$visi) {
        $visi = $this->db->where('deleted_at IS NULL')->order_by('Id', 'ASC')->get('visirpjpn')->row_array();
      }
      if ($visi) {
        $_POST['_Id'] = $visi['Id'];
      }
    }
    $this->db->insert('misirpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('misirpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetMisiRPJPN(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpn")->result_array());
	}

  public function InputTujuanRPJPN(){  
    if (empty($_POST['_Id'])) {
      $_POST['_Id'] = 1;
    }
    $this->db->insert('arahtujuanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('arahtujuanrpjpn', $_POST);
    echo '1';
  }

  public function HapusTujuanRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('arahtujuanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetTujuanRPJPN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjpn as v, misirpjpn as m, arahtujuanrpjpn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function InputSasaranRPJPN(){  
    $this->db->insert('sasaranrpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function InputIndikatorRPJPN(){  
    $this->db->insert('indikator_sasaran_rpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
  }
	
  public function EditIndikatorRPJPN(){  
    $this->db->where('Id', $_POST['Id']); 
    $this->db->update('indikator_sasaran_rpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIndikatorRPJPN(){  
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id'])->update('indikator_sasaran_rpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TahapanRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
    $Data['Tahapan'] = $this->db->where("deleted_at IS NULL")->order_by("Id", "ASC")->get("tahapanrpjpn")->result_array();

		$this->load->view('Nasional/header', $Header);
		$this->load->view('Nasional/TahapanRPJPN', $Data);
	}

  public function InputTahapanRPJPN(){  
    if (empty($_POST['_Id'])) {
      $visi = $this->db->where('deleted_at IS NULL')->order_by('Id', 'ASC')->get('visirpjpn')->row_array();
      if ($visi) {
        $_POST['_Id'] = $visi['Id'];
      }
    }
    if (isset($_POST['Tahapan']) && !isset($_POST['Tahap'])) {
      $_POST['Tahap'] = mb_substr($_POST['Tahapan'], 0, 150);
    }
    $this->db->insert('tahapanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJPN(){  
    if (isset($_POST['Tahapan']) && !isset($_POST['Tahap'])) {
      $_POST['Tahap'] = mb_substr($_POST['Tahapan'], 0, 150);
    }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjpn', $_POST);
    echo '1';
  }

  public function HapusTahapanRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TahapanRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array(); 
    // Jika ingin berdasarkan _Id Visi tertentu, tambahkan: $this->db->where('_Id', $id_visi);
    $tahapan_data = $this->db->query("SELECT t.*, COALESCE(t.Periode, CONCAT(v.TahunMulai, '-', v.TahunAkhir)) as PeriodeTampil, v.TahunMulai, v.TahunAkhir FROM tahapanrpjmn as t LEFT JOIN visirpjmn as v ON t._Id = v.Id WHERE t.deleted_at IS NULL ORDER BY t.Id Desc")->result_array();

    $result = [];
    foreach ($tahapan_data as $t) {
        // Susun format periode
        $periode = !empty($t['Periode']) ? $t['Periode'] : (!empty($t['PeriodeTampil']) ? $t['PeriodeTampil'] : '');
        $tahunMulai = isset($t['TahunMulai']) ? $t['TahunMulai'] : '';
        $tahunAkhir = isset($t['TahunAkhir']) ? $t['TahunAkhir'] : '';
        
        $tahapan_item = [
            'Id'         => $t['Id'],
            '_Id'        => $t['_Id'], 
            'Tahapan'    => $t['Tahapan'],
            'Periode'    => $periode,
            'TahunMulai' => $tahunMulai,
            'TahunAkhir' => $tahunAkhir,
            'SubTahapan' => []
        ];

        // 2. Ambil data Sub Tahapan RPJMN (Level 2)
        $this->db->where('_Id', $t['Id']);
        $sub_data = $this->db->get('subtahapanrpjmn')->result_array();

        foreach ($sub_data as $s) {
            $sub_item = [
                'Id'         => $s['Id'],
                '_Id'        => $s['_Id'],
                'SubTahapan' => $s['SubTahapan'],
                'Periode'    => $periode,
                'Pembangunan'=> []
            ];

            // 3. Ambil data Pembangunan Tahapan (Level 3)
            $this->db->where('_Id', $s['Id']);
            $pem_data = $this->db->get('pembangunantahapanrpjmn')->result_array();

            foreach ($pem_data as $p) {
                // Field disesuaikan untuk menangkap baik 'TahapanPembangunan' atau 'PembangunanTahapan'
                $sub_item['Pembangunan'][] = [
                    'Id'                 => $p['Id'],
                    '_Id'                => $p['_Id'],
                    'TahapanPembangunan' => $p['Pembangunan'], 
                    'Periode'            => $periode
                ];
            }
            
            $tahapan_item['SubTahapan'][] = $sub_item;
        }
        
        $result[] = $tahapan_item;
    }
    $Data['Tahapan'] = $result;
    $this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TahapanRPJMN',$Data);
	}

  public function InputTahapanRPJMN(){  
    $this->db->insert('tahapanrpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTahapanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function InputSubTahapanRPJMN(){  
    $this->db->insert('subtahapanrpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSubTahapanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('subtahapanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSubTahapanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('subtahapanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function InputPembangunanTahapanRPJMN(){  
    $this->db->insert('pembangunantahapanrpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditPembangunanTahapanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('pembangunantahapanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusPembangunanTahapanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('pembangunantahapanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function VisiRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    // 1. Ambil semua data Visi
    $visi_data = $this->db->where("deleted_at IS NULL")
                      ->order_by("Id", "DESC")
                      ->get("visirpjmn")
                      ->result_array();
    $result = [];
    foreach ($visi_data as $v) {
        $periode = $v['TahunMulai'] . '-' . $v['TahunAkhir'];
        
        $visi_item = [
            'Id'         => $v['Id'],
            'Visi'       => $v['Visi'],
            'Periode'    => $periode,
            'TahunMulai' => $v['TahunMulai'],
            'TahunAkhir' => $v['TahunAkhir'],
            'Misi'       => []
        ];

        // 2. Ambil data Misi berdasarkan _Id (Id Visi)
        $this->db->where('_Id', $v['Id']);
        $misi_data = $this->db->where("deleted_at IS NULL")->get('misirpjmn')->result_array();

        foreach ($misi_data as $m) {
            $misi_item = [
                'Id'      => $m['Id'],
                'Misi'    => $m['Misi'],
                'Periode' => $periode
            ];
            // Masukkan misi ke dalam array Visi
            $visi_item['Misi'][] = $misi_item;
        }
        // Masukkan visi ke hasil akhir
        $result[] = $visi_item;
    }

    $Data['DataVisi'] = $result;
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/VisiRPJMN',$Data);
	}

  public function InputVisiRPJMN(){  
    $this->db->insert('visirpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visirpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetVisiRPJMN(){
    echo json_encode($this->db->where("Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjmn")->result_array());
	}

  public function GetTahapanRPJMN(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("tahapanrpjmn")->result_array());
	}

  public function GetSubTahapanRPJMN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, tahapanrpjmn as m, subtahapanrpjmn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function GetSasaranPrioritasRPJMN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, prioritas_nasional_rpjmn as m, sasaran_prioritas_rpjmn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function GetSasaranProgramRPJMN(){
    echo json_encode($this->db->query("SELECT t.* FROM program_prioritas_rpjmn as t WHERE t.Id_ = ".$_POST['Id']." AND t.deleted_at IS NULL")->result_array());
	}

  public function GetSasaranKegiatanRPJMN(){
    echo json_encode($this->db->query("SELECT t.* FROM kegiatan_prioritas_rpjmn as t WHERE t.Id_ = ".$_POST['Id']." AND t.deleted_at IS NULL")->result_array());
	}

  public function GetSasaranPembangunanRPJMN(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("sasaran_pembangunan_rpjmn")->result_array());
	}

  public function GetPrioritasNasionalRPJMN(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("prioritas_nasional_rpjmn")->result_array());
	}

  public function GetProgramPrioritasRPJMN(){
    echo json_encode($this->db->where("Id_ = ".$_POST['Id']." AND deleted_at IS NULL")->get("program_prioritas_rpjmn")->result_array());
	}

  public function GetKegiatanPrioritasRPJMN(){
    echo json_encode($this->db->where("Id_ = ".$_POST['Id']." AND deleted_at IS NULL")->get("kegiatan_prioritas_rpjmn")->result_array());
	}

  public function InputMisiRPJMN(){  
    $this->db->insert('misirpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('misirpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetMisiRPJMN(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmn")->result_array());
	}

  public function InputTujuanRPJMN(){  
    $this->db->insert('tujuanrpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tujuanrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetTujuanRPJMN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function InputSasaranRPJMN(){  
    $this->db->insert('sasaranrpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function IUPRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Agenda'] = $this->db->where("deleted_at IS NULL")->order_by("Urutan ASC, Id ASC")->get("agenda_transformasi_rpjpn")->result_array();
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->order_by("Id", "ASC")->get("arahtujuanrpjpn")->result_array();
    $Data['IUP'] = $this->db->where("deleted_at IS NULL")->order_by("Urutan ASC, Id ASC")->get("iuprpjpn")->result_array();
		$this->load->view('Nasional/header', $Header);
		$this->load->view('Nasional/IUPRPJPN', $Data);
	}

  public function InputAgendaRPJPN(){  
    $this->db->insert('agenda_transformasi_rpjpn', $_POST);
    echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Agenda Transformasi!';
	}
	
	public function EditAgendaRPJPN(){  
		$this->db->where('Id', $_POST['Id'])->update('agenda_transformasi_rpjpn', $_POST);
    if (!empty($_POST['NamaAgenda'])) {
      $this->db->where('IdAgenda', $_POST['Id'])->update('arahtujuanrpjpn', ['AgendaTransformasi' => $_POST['NamaAgenda']]);
    }
    echo '1';
  }

  public function HapusAgendaRPJPN(){  
		$deleted_at = date('Y-m-d H:i:s');
		$this->db->where('Id', $_POST['Id'])->update('agenda_transformasi_rpjpn', ['deleted_at' => $deleted_at]);
    echo '1';
  }

  public function InputIUPRPJPN(){  
    if (isset($_POST['Sasaran'])) {
      $_POST['TargetAkhir'] = $_POST['Sasaran'];
    }
    $this->db->insert('iuprpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIUPRPJPN(){  
    if (isset($_POST['Sasaran'])) {
      $_POST['TargetAkhir'] = $_POST['Sasaran'];
    }
		$this->db->where('Id', $_POST['Id']); 
		$this->db->update('iuprpjpn', $_POST);
    echo '1';
  }

  public function HapusIUPRPJPN(){  
		$deleted_at = date('Y-m-d H:i:s');
		$this->db->where('Id', $_POST['Id'])->or_where('ParentId', $_POST['Id'])->update('iuprpjpn', ['deleted_at' => $deleted_at]);
    echo '1';
  }

  // ============================================================
  //  AGENDA PEMBANGUNAN (PN/PP/KP) — Hierarki 5 Level
  //  PN → PP → KP → Sasaran → Indikator
  //  PP._Id = parent PN.Id | KP._Id = parent PP.Id
  // ============================================================
  public function IUPRPJMN(){
    $Header['Halaman'] = 'RPJMN';

    // Ambil semua PN — Periode disimpan langsung sebagai teks
    $pn_list = $this->db->query(
      "SELECT * FROM agendapn_rpjmn
       WHERE Tipe = 'PN' AND deleted_at IS NULL
       ORDER BY Id ASC"
    )->result_array();

    $result = [];
    foreach ($pn_list as $pn) {
      $pn['Sasaran'] = $this->_getSasaran($pn['Id']);
      $pn['PP'] = [];

      // Ambil PP di bawah PN ini (_Id → PN.Id)
      $pp_list = $this->db
        ->where('_Id', $pn['Id'])->where('Tipe', 'PP')
        ->where('deleted_at IS NULL')->get('agendapn_rpjmn')->result_array();

      foreach ($pp_list as $pp) {
        $pp['Sasaran'] = $this->_getSasaran($pp['Id']);
        $pp['KP'] = [];

        // Ambil KP di bawah PP ini (_Id → PP.Id)
        $kp_list = $this->db
          ->where('_Id', $pp['Id'])->where('Tipe', 'KP')
          ->where('deleted_at IS NULL')->get('agendapn_rpjmn')->result_array();

        foreach ($kp_list as $kp) {
          $kp['Sasaran'] = $this->_getSasaran($kp['Id']);
          $pp['KP'][] = $kp;
        }
        $pn['PP'][] = $pp;
      }
      $result[] = $pn;
    }

    $Data['DataAgenda'] = $result;
    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/IUPRPJMN', $Data);
  }

  // Helper: ambil Sasaran + Indikator berdasarkan Id agenda
  private function _getSasaran($agendaId) {
    $list = $this->db->where('_Id', $agendaId)
                     ->where('deleted_at IS NULL')
                     ->get('sasaran_agendapn')->result_array();
    foreach ($list as &$s) {
      $s['Indikator'] = $this->db->where('_Id', $s['Id'])
                                  ->where('deleted_at IS NULL')
                                  ->get('indikator_agendapn')->result_array();
    }
    return $list;
  }

  // --- PN/PP/KP CRUD (shared endpoint) ---
  public function InputIUPRPJMN(){
    $this->db->insert('agendapn_rpjmn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Menyimpan Data!';
  }
  public function EditIUPRPJMN(){
    $this->db->where('Id', $_POST['Id'])->update('agendapn_rpjmn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Update Data!';
  }
  public function HapusIUPRPJMN(){
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id'])->update('agendapn_rpjmn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Hapus Data!';
  }

  // --- SASARAN ---
  public function InputSasaranAgenda(){
    $this->db->insert('sasaran_agendapn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Menyimpan Data!';
  }
  public function EditSasaranAgenda(){
    $this->db->where('Id', $_POST['Id'])->update('sasaran_agendapn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Update Data!';
  }
  public function HapusSasaranAgenda(){
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id'])->update('sasaran_agendapn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Hapus Data!';
  }

  // --- INDIKATOR ---
  public function InputIndikatorAgenda(){
    $this->db->insert('indikator_agendapn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Menyimpan Data!';
  }
  public function EditIndikatorAgenda(){
    $this->db->where('Id', $_POST['Id'])->update('indikator_agendapn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Update Data!';
  }
  public function HapusIndikatorAgenda(){
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id'])->update('indikator_agendapn', $_POST);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Hapus Data!';
  }

  public function NomenklaturProvinsi() {
    $Header['Halaman'] = 'Nomenklatur';
    $Data['Nomenklatur'] = $this->db->query("SELECT * FROM `nomenklaturprovinsi`")->result_array();
    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/NomenklaturProvinsi', $Data);
  }

  public function NomenklaturKabupaten() {
    $Header['Halaman'] = 'Nomenklatur';
    $Data['Nomenklatur'] = $this->db->query("SELECT * FROM `nomenklaturkabupaten`")->result_array();
    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/NomenklaturKabupaten', $Data);
  }

  public function SasaranPembangunanRPJMN(){
		$Header['Halaman'] = 'RKP';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['Kementerian'] = $this->db->where("deleted_at IS NULL")->get("kementerian")->result_array();
		$Data['SasaranPembangunan'] = $this->db->query("SELECT p.*, COALESCE(p.Periode, CONCAT(v.TahunMulai, '-', v.TahunAkhir)) as PeriodeTampil, v.TahunMulai, v.TahunAkhir FROM sasaran_pembangunan_rpjmn as p LEFT JOIN visirpjmn as v ON p._Id = v.Id WHERE p.deleted_at IS NULL ORDER BY p.Id DESC")->result_array();

    // Pastikan kolom relasi kementerian diperiksa agar tidak terjadi Unknown column 's.Id_'
    $hasId_ = $this->db->field_exists('Id_', 'indikator_pembangunan_rpjmn');
    $hasIdKem = $this->db->field_exists('IdKementerian', 'indikator_pembangunan_rpjmn');
    $kemJoin = "";
    if ($hasId_) {
      $kemJoin = "LEFT JOIN kementerian as k ON s.Id_ = k.Id";
    } elseif ($hasIdKem) {
      $kemJoin = "LEFT JOIN kementerian as k ON s.IdKementerian = k.Id";
    } else {
      $kemJoin = "LEFT JOIN kementerian as k ON 1=0";
    }

    $Data['IndikatorPembangunan'] = $this->db->query("SELECT s.*, k.NamaKementerian FROM indikator_pembangunan_rpjmn as s {$kemJoin} WHERE s.deleted_at IS NULL ORDER BY s.Id ASC")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranPembangunanRPJMN',$Data);
	}

  public function InputSasaranPembangunanRPJMN(){  
    $this->db->insert('sasaran_pembangunan_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranPembangunanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaran_pembangunan_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranPembangunanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaran_pembangunan_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function InputIndikatorSasaranPembangunanRPJMN(){  
    $this->db->insert('indikator_pembangunan_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIndikatorSasaranPembangunanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('indikator_pembangunan_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIndikatorSasaranPembangunanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('indikator_pembangunan_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  // =========================================================================
  // ARAH PEMBANGUNAN KEWILAYAHAN NASIONAL (RPJMN)
  // Kolom: Provinsi, Lokasi Prioritas, Highlight Indikasi Intervensi, Tagging Lokasi
  // =========================================================================
  public function ArahPembangunanKewilayahanRPJMN(){
    $Header['Halaman'] = 'RPJMN';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama', 'ASC')->get("kodewilayah")->result_array();
    
    // Ambil data Arah Pembangunan Kewilayahan Nasional (RPJMN)
    $Data['DataArah'] = $this->db->query("
      SELECT a.*, k.Nama as NamaProvinsi 
      FROM arah_pembangunan_kewilayahan_rpjmn a 
      LEFT JOIN kodewilayah k ON a.Provinsi = k.Kode 
      WHERE a.deleted_at IS NULL 
      ORDER BY k.Nama ASC, a.LokasiPrioritas ASC, a.Id ASC
    ")->result_array();

    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/ArahPembangunanKewilayahanRPJMN', $Data);
  }

  // Alias untuk kompatibilitas tautan lama
  public function PembangunanKewilayahanRPJMN(){
    $this->ArahPembangunanKewilayahanRPJMN();
  }

  public function InputArahKewilayahanRPJMN(){
    $data = [
      'Provinsi'            => $this->input->post('Provinsi'),
      'LokasiPrioritas'     => $this->input->post('LokasiPrioritas'),
      'HighlightIntervensi' => $this->input->post('HighlightIntervensi'),
      'TaggingLokasiKode'   => $this->input->post('TaggingLokasiKode'),
      'TaggingLokasi'       => $this->input->post('TaggingLokasi'),
      'Tahun'               => $this->input->post('Tahun') ?: '2025-2029'
    ];
    $this->db->insert('arah_pembangunan_kewilayahan_rpjmn', $data);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Menyimpan Data!';
  }

  public function EditArahKewilayahanRPJMN(){
    $id = $this->input->post('Id');
    $data = [
      'Provinsi'            => $this->input->post('Provinsi'),
      'LokasiPrioritas'     => $this->input->post('LokasiPrioritas'),
      'HighlightIntervensi' => $this->input->post('HighlightIntervensi'),
      'TaggingLokasiKode'   => $this->input->post('TaggingLokasiKode'),
      'TaggingLokasi'       => $this->input->post('TaggingLokasi'),
      'Tahun'               => $this->input->post('Tahun') ?: '2025-2029'
    ];
    $this->db->where('Id', $id)->update('arah_pembangunan_kewilayahan_rpjmn', $data);
    echo '1';
  }

  public function HapusArahKewilayahanRPJMN(){
    $id = $this->input->post('Id');
    $this->db->where('Id', $id)->update('arah_pembangunan_kewilayahan_rpjmn', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo '1';
  }


  public function TemaRKP(){
		$Header['Halaman'] = 'RKP';
		$Data['TemaRKP'] = $this->db->where("deleted_at IS NULL")->get("temarkp")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TemaRKP',$Data);
	}

  public function InputTemaRKP(){  
    $this->db->insert('temarkp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTemaRKP(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('temarkp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTemaRKP(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('temarkp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function SasaranPembangunanRKP(){
		$Header['Halaman'] = 'RKP';
		$Data['SasaranPembangunanRKP'] = $this->db->where("deleted_at IS NULL")->get("sasaran_pembangunan_rkp")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranPembangunanRKP',$Data);
	}

  public function InputSasaranPembangunanRKP(){  
    $this->db->insert('sasaran_pembangunan_rkp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranPembangunanRKP(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaran_pembangunan_rkp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranPembangunanRKP(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaran_pembangunan_rkp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }
  
  // =========================================================================
  // FUNGSI UTAMA RKP: MATRIKS PEMBANGUNAN
  // Data ditarik dari Agenda Pembangunan RPJMN (PN/PP/KP -> Sasaran -> Indikator)
  // =========================================================================
  public function MatriksPembangunan(){
    $Header['Halaman'] = 'RKP';

    // Ambil semua PN dari agendapn_rpjmn
    $pn_list = $this->db->query(
      "SELECT * FROM agendapn_rpjmn
       WHERE Tipe = 'PN' AND deleted_at IS NULL
       ORDER BY Id ASC"
    )->result_array();

    $result = [];
    foreach ($pn_list as $pn) {
      $pn['Sasaran'] = $this->_getSasaran($pn['Id']);
      $pn['PP'] = [];

      // Ambil PP di bawah PN ini (_Id → PN.Id)
      $pp_list = $this->db
        ->where('_Id', $pn['Id'])->where('Tipe', 'PP')
        ->where('deleted_at IS NULL')->get('agendapn_rpjmn')->result_array();

      foreach ($pp_list as $pp) {
        $pp['Sasaran'] = $this->_getSasaran($pp['Id']);
        $pp['KP'] = [];

        // Ambil KP di bawah PP ini (_Id → PP.Id)
        $kp_list = $this->db
          ->where('_Id', $pp['Id'])->where('Tipe', 'KP')
          ->where('deleted_at IS NULL')->get('agendapn_rpjmn')->result_array();

        foreach ($kp_list as $kp) {
          $kp['Sasaran'] = $this->_getSasaran($kp['Id']);
          $pp['KP'][] = $kp;
        }
        $pn['PP'][] = $pp;
      }
      $result[] = $pn;
    }

    $Data['DataAgenda'] = $result;

    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/MatriksPembangunan', $Data);
  }

  // Alias untuk kompatibilitas tautan lama
  public function SasaranPrioritasNasional(){
    $this->MatriksPembangunan();
  }

  // =========================================================================
  // CRUD RKP LEVEL 1 : PRIORITAS NASIONAL (PN)
  // =========================================================================
  public function InputRKP_PN(){ $this->db->insert('rkp_ps_prioritas_nasional', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!'; }
  public function EditRKP_PN(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_prioritas_nasional', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!'; }
  public function HapusRKP_PN(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s');
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_prioritas_nasional', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!'; 
  }

  public function InputRKP_SasaranPN(){ $this->db->insert('rkp_ps_pn_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Sasaran PN!'; }
  public function EditRKP_SasaranPN(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_pn_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Sasaran PN!'; }
  public function HapusRKP_SasaranPN(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_pn_sasaran', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Sasaran PN!'; 
  }

  public function InputRKP_IndikatorPN(){ $this->db->insert('rkp_ps_pn_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Indikator PN!'; }
  public function EditRKP_IndikatorPN(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_pn_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Indikator PN!'; }
  public function HapusRKP_IndikatorPN(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_pn_indikator', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Indikator PN!'; 
  }

  // =========================================================================
  // CRUD RKP LEVEL 2 : PROGRAM PRIORITAS (PP)
  // =========================================================================
  public function InputRKP_PP(){ $this->db->insert('rkp_ps_program_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!'; }
  public function EditRKP_PP(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_program_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!'; }
  public function HapusRKP_PP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_program_prioritas', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!'; 
  }

  public function InputRKP_SasaranPP(){ $this->db->insert('rkp_ps_pp_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Sasaran PP!'; }
  public function EditRKP_SasaranPP(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_pp_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Sasaran PP!'; }
  public function HapusRKP_SasaranPP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_pp_sasaran', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Sasaran PP!'; 
  }

  public function InputRKP_IndikatorPP(){ $this->db->insert('rkp_ps_pp_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Indikator PP!'; }
  public function EditRKP_IndikatorPP(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_pp_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Indikator PP!'; }
  public function HapusRKP_IndikatorPP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_pp_indikator', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Indikator PP!'; 
  }

  // =========================================================================
  // CRUD RKP LEVEL 3 : KEGIATAN PRIORITAS (KP)
  // =========================================================================
  public function InputRKP_KP(){ $this->db->insert('rkp_ps_kegiatan_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!'; }
  public function EditRKP_KP(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_kegiatan_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!'; }
  public function HapusRKP_KP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_kegiatan_prioritas', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!'; 
  }

  public function InputRKP_SasaranKP(){ $this->db->insert('rkp_ps_kp_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Sasaran KP!'; }
  public function EditRKP_SasaranKP(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_kp_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Sasaran KP!'; }
  public function HapusRKP_SasaranKP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_kp_sasaran', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Sasaran KP!'; 
  }

  public function InputRKP_IndikatorKP(){ $this->db->insert('rkp_ps_kp_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Indikator KP!'; }
  public function EditRKP_IndikatorKP(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_kp_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Indikator KP!'; }
  public function HapusRKP_IndikatorKP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_kp_indikator', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Indikator KP!'; 
  }

  // =========================================================================
  // CRUD RKP LEVEL 4 : PROYEK PRIORITAS
  // =========================================================================
  public function InputRKP_Proyek(){ $this->db->insert('rkp_ps_proyek_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Proyek Prioritas!'; }
  public function EditRKP_Proyek(){ $this->db->where('Id', $_POST['Id'])->update('rkp_ps_proyek_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Proyek Prioritas!'; }
  public function HapusRKP_Proyek(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('rkp_ps_proyek_prioritas', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Proyek Prioritas!'; 
  }

  // Legacy fallback
  public function InputSasaranPrioritasNasional(){  
    $this->db->insert('sasaran_prioritas_nasional',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranPrioritasNasional(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaran_prioritas_nasional', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranPrioritasNasional(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaran_prioritas_nasional', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetPrioritasNasional(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("prioritas_nasional_rpjmn")->result_array());
	}

  public function SasaranPembangunanDaerah(){
		$Header['Halaman'] = 'RKP';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['SasaranPembangunanDaerah'] = $this->db->query("SELECT s.*,k.* FROM sasaran_pembangunan_daerah as s,kodewilayah as k WHERE s.Provinsi=k.Kode AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranPembangunanDaerah',$Data);
	}

  public function InputSasaranPembangunanDaerah(){  
    $this->db->insert('sasaran_pembangunan_daerah',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranPembangunanDaerah(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaran_pembangunan_daerah', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranPembangunanDaerah(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaran_pembangunan_daerah', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  // =========================================================================
  // ARAH PEMBANGUNAN KEWILAYAHAN (RKP)
  // Kolom: Provinsi, Lokasi Prioritas, Highlight Indikasi Intervensi, Tagging Lokasi
  // =========================================================================
  public function ArahPembangunanKewilayahan(){
    $Header['Halaman'] = 'RKP';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama', 'ASC')->get("kodewilayah")->result_array();
    
    // Ambil data Arah Pembangunan Kewilayahan
    $Data['DataArah'] = $this->db->query("
      SELECT a.*, k.Nama as NamaProvinsi 
      FROM arah_pembangunan_kewilayahan a 
      LEFT JOIN kodewilayah k ON a.Provinsi = k.Kode 
      WHERE a.deleted_at IS NULL 
      ORDER BY k.Nama ASC, a.LokasiPrioritas ASC, a.Id ASC
    ")->result_array();

    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/ArahPembangunanKewilayahan', $Data);
  }

  // Alias untuk kompatibilitas tautan lama
  public function IndikasiIntervensi(){
    $this->ArahPembangunanKewilayahan();
  }

  // AJAX: Ambil Kabupaten/Kota berdasarkan Provinsi untuk Tagging Lokasi
  public function GetKabupatenByProvinsi(){
    $provinsi = $this->input->post('Provinsi');
    if(!$provinsi){
      echo json_encode([]);
      return;
    }
    $kab = $this->db->where("Kode LIKE '{$provinsi}.__'")
                    ->order_by('Nama', 'ASC')
                    ->get('kodewilayah')
                    ->result_array();
    echo json_encode($kab);
  }

  public function InputArahKewilayahan(){
    $data = [
      'Provinsi'            => $this->input->post('Provinsi'),
      'LokasiPrioritas'     => $this->input->post('LokasiPrioritas'),
      'HighlightIntervensi' => $this->input->post('HighlightIntervensi'),
      'TaggingLokasiKode'   => $this->input->post('TaggingLokasiKode'),
      'TaggingLokasi'       => $this->input->post('TaggingLokasi'),
      'Tahun'               => $this->input->post('Tahun') ?: '2025'
    ];
    $this->db->insert('arah_pembangunan_kewilayahan', $data);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Menyimpan Data!';
  }

  public function EditArahKewilayahan(){
    $id = $this->input->post('Id');
    $data = [
      'Provinsi'            => $this->input->post('Provinsi'),
      'LokasiPrioritas'     => $this->input->post('LokasiPrioritas'),
      'HighlightIntervensi' => $this->input->post('HighlightIntervensi'),
      'TaggingLokasiKode'   => $this->input->post('TaggingLokasiKode'),
      'TaggingLokasi'       => $this->input->post('TaggingLokasi'),
      'Tahun'               => $this->input->post('Tahun') ?: '2025'
    ];
    $this->db->where('Id', $id)->update('arah_pembangunan_kewilayahan', $data);
    echo '1';
  }

  public function HapusArahKewilayahan(){
    $id = $this->input->post('Id');
    $this->db->where('Id', $id)->update('arah_pembangunan_kewilayahan', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo '1';
  }

  // (Ini adalah fungsi tambahan untuk ditempelkan di dalam class Nasional Controller Anda)

  // =========================================================================
  // PROYEK STRATEGIS NASIONAL (RPJMN)
  // Kolom: No, Proyek, Lokasi, Pelaksana, Aksi (Semua Input Manual)
  // =========================================================================
  public function ProyekStrategisRPJMN() {
    $Header['Halaman'] = 'RPJMN';
    $Data['ProyekStrategis'] = $this->db
      ->where('deleted_at IS NULL')
      ->order_by('Id', 'ASC')
      ->get('proyek_strategis_nasional')
      ->result_array();

    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/ProyekStrategisRPJMN', $Data);
  }

  public function InputProyekStrategis(){
    $data = [
      'Proyek'    => $this->input->post('Proyek'),
      'Lokasi'    => $this->input->post('Lokasi'),
      'Pelaksana' => $this->input->post('Pelaksana')
    ];
    $this->db->insert('proyek_strategis_nasional', $data);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Menyimpan Data!';
  }

  public function EditProyekStrategis(){
    $id = $this->input->post('Id');
    $data = [
      'Proyek'    => $this->input->post('Proyek'),
      'Lokasi'    => $this->input->post('Lokasi'),
      'Pelaksana' => $this->input->post('Pelaksana')
    ];
    $this->db->where('Id', $id)->update('proyek_strategis_nasional', $data);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Update Data!';
  }

  public function HapusProyekStrategis(){
    $id = $this->input->post('Id');
    $data = ['deleted_at' => date('Y-m-d H:i:s')];
    $this->db->where('Id', $id)->update('proyek_strategis_nasional', $data);
    echo ($this->db->affected_rows()) ? '1' : 'Gagal Hapus Data!';
  }
}




