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
            'Misi'       => []
        ];

        // 2. Ambil data Misi berdasarkan _Id (Id Visi)
        $this->db->where('_Id', $v['Id']);
        $misi_data = $this->db->where("deleted_at IS NULL")->get('misirpjpn')->result_array();

        foreach ($misi_data as $m) {
            $misi_item = [
                'Id'      => $m['Id'],
                'Misi'    => $m['Misi'],
                'Periode' => $periode, // Misi mengikuti periode Visi
                'Tujuan'  => []
            ];

            // 3. Ambil data Tujuan berdasarkan _Id (Id Misi)
            $this->db->where('_Id', $m['Id']);
            $tujuan_data = $this->db->where("deleted_at IS NULL")->get('tujuanrpjpn')->result_array();

            foreach ($tujuan_data as $t) {
                $tujuan_item = [
                    'Id'      => $t['Id'],
                    'Tujuan'  => $t['Tujuan'],
                    'Periode' => $periode,
                    'Sasaran' => []
                ];

                // 4. Ambil data Sasaran berdasarkan _Id (Id Tujuan)
                $this->db->where('_Id', $t['Id']);
                $sasaran_data = $this->db->where("deleted_at IS NULL")->get('sasaranrpjpn')->result_array();

                foreach ($sasaran_data as $s) {
                    $sasaran_item = [
                        'Id'      => $s['Id'],
                        'Sasaran' => $s['Sasaran'],
                        'Periode' => $periode
                    ];
                    // Masukkan sasaran ke dalam array Tujuan
                    $tujuan_item['Sasaran'][] = $sasaran_item;
                }
                // Masukkan tujuan ke dalam array Misi
                $misi_item['Tujuan'][] = $tujuan_item;
            }
            // Masukkan misi ke dalam array Visi
            $visi_item['Misi'][] = $misi_item;
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

  public function InputMisiRPJPN(){  
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
    $this->db->insert('tujuanrpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tujuanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetTujuanRPJPN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
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

  public function TahapanRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['Tahapan'] = $this->db->query("SELECT v.*,t.* FROM visirpjpn as v, tahapanrpjpn as t WHERE t._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TahapanRPJPN',$Data);
	}

  public function InputTahapanRPJPN(){  
    $this->db->insert('tahapanrpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
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
    $tahapan_data = $this->db->query("SELECT v.*,t.* FROM visirpjmn as v, tahapanrpjmn as t WHERE t._Id = v.Id AND t.deleted_at IS NULL ORDER BY t.Id Desc")->result_array();

    $result = [];
    foreach ($tahapan_data as $t) {
        // Susun format periode
        $tahunMulai = isset($t['TahunMulai']) ? $t['TahunMulai'] : '';
        $tahunAkhir = isset($t['TahunAkhir']) ? $t['TahunAkhir'] : '';
        $periode = ($tahunMulai && $tahunAkhir) ? $tahunMulai . '-' . $tahunAkhir : '';
        
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
                'Periode' => $periode, // Misi mengikuti periode Visi
                'Tujuan'  => []
            ];

            // 3. Ambil data Tujuan berdasarkan _Id (Id Misi)
            $this->db->where('_Id', $m['Id']);
            $tujuan_data = $this->db->where("deleted_at IS NULL")->get('tujuanrpjmn')->result_array();

            foreach ($tujuan_data as $t) {
                $tujuan_item = [
                    'Id'      => $t['Id'],
                    'Tujuan'  => $t['Tujuan'],
                    'Periode' => $periode,
                    'Sasaran' => []
                ];

                // 4. Ambil data Sasaran berdasarkan _Id (Id Tujuan)
                $this->db->where('_Id', $t['Id']);
                $sasaran_data = $this->db->where("deleted_at IS NULL")->get('sasaranrpjmn')->result_array();

                foreach ($sasaran_data as $s) {
                    $sasaran_item = [
                        'Id'      => $s['Id'],
                        'Sasaran' => $s['Sasaran'],
                        'Periode' => $periode
                    ];
                    // Masukkan sasaran ke dalam array Tujuan
                    $tujuan_item['Sasaran'][] = $sasaran_item;
                }
                // Masukkan tujuan ke dalam array Misi
                $misi_item['Tujuan'][] = $tujuan_item;
            }
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
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['IUP'] = $this->db->query("SELECT v.*,t.* FROM visirpjpn as v, iuprpjpn as t WHERE t._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/IUPRPJPN',$Data);
	}

  public function InputIUPRPJPN(){  
    $this->db->insert('iuprpjpn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIUPRPJPN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('iuprpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIUPRPJPN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('iuprpjpn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function IUPRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['IUP'] = $this->db->query("SELECT v.*,t.* FROM visirpjmn as v, iuprpjmn as t WHERE t._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/IUPRPJMN',$Data);
	}

  public function InputIUPRPJMN(){  
    $this->db->insert('iuprpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIUPRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('iuprpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIUPRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('iuprpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
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
		$Data['SasaranPembangunan'] = $this->db->query("SELECT v.*,p.* FROM visirpjmn as v, sasaran_pembangunan_rpjmn as p WHERE p._Id = v.Id AND p.deleted_at IS NULL ORDER BY p.Id DESC")->result_array();
    $Data['IndikatorPembangunan'] = $this->db->query("SELECT t.*,s.*,k.NamaKementerian FROM sasaran_pembangunan_rpjmn as t, indikator_pembangunan_rpjmn as s, kementerian as k WHERE s._Id = t.Id AND s.Id_ = k.Id AND s.deleted_at IS NULL ORDER BY s.Id ASC")->result_array();
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

  public function PembangunanKewilayahanRPJMN(){
    $Header['Halaman'] = 'RKP';
    
    // 1. Mengambil data untuk Box
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    
    // Asumsi struktur tabel kodewilayah: Provinsi (2 digit), Kab/Kota (>2 digit)
    $Data['Provinsi'] = $this->db->where("LENGTH(Kode) = 2")->get("kodewilayah")->result_array();
    
    $KabKota = $this->db->where("LENGTH(Kode) > 2 AND LENGTH(Kode) < 6")->get("kodewilayah")->result_array();
    $Data['KabKota'] = $KabKota;

    // Tambahan: Membuat array mapping [Kode => Nama] untuk efisiensi di View
    // Sehingga View bisa langsung memanggil $MapKabKota['11.01'] dan mendapatkan nama Kabupatennya.
    $MapKabKota = [];
    foreach($KabKota as $kk) {
        $MapKabKota[$kk['Kode']] = $kk['Nama'];
    }
    $Data['MapKabKota'] = $MapKabKota;

    // 2. Ambil Data Provinsi (Level 1) beserta Nama Provinsi & Periode Visi dari tabel relasi
    $Provinsi = $this->db->query("
        SELECT p.*, k.Nama as NamaProvinsi, v.TahunMulai, v.TahunAkhir, v.Id as IdVisi 
        FROM pembangunan_kewilayahan_provinsi p 
        LEFT JOIN kodewilayah k ON p.KodeProvinsi = k.Kode 
        LEFT JOIN visirpjmn v ON p._IdVisi = v.Id 
        WHERE p.deleted_at IS NULL 
        ORDER BY p.Id ASC
    ")->result_array();

    // 3. Ambil Data Kawasan (Level 2)
    $Kawasan = $this->db->where("deleted_at IS NULL")
                        ->order_by("Id", "ASC")
                        ->get("pembangunan_kewilayahan_kawasan")
                        ->result_array();

    // 4. Ambil Data Sub Kawasan (Level 3)
    $SubKawasan = $this->db->where("deleted_at IS NULL")
                            ->order_by("Id", "ASC")
                            ->get("pembangunan_kewilayahan_subkawasan")
                            ->result_array();

    // 5. Merakit Array Bersarang (Hierarki: Provinsi -> Kawasan -> Sub Kawasan)
    foreach ($Provinsi as $keyProv => $prov) {
        $Provinsi[$keyProv]['Kawasan'] = [];
        foreach ($Kawasan as $kaw) {
            if ($kaw['_IdProvinsi'] == $prov['Id']) {
                $kaw['SubKawasan'] = [];
                foreach ($SubKawasan as $sub) {
                    if ($sub['_IdKawasan'] == $kaw['Id']) {
                        $kaw['SubKawasan'][] = $sub;
                    }
                }
                $Provinsi[$keyProv]['Kawasan'][] = $kaw;
            }
        }
    }

    // Lempar data yang sudah dirakit ke View
    $Data['PembangunanKewilayahan'] = $Provinsi;

    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/PembangunanKewilayahanRPJMN', $Data);
}

// ==============================================
// CRUD LEVEL 1: PROVINSI
// ==============================================
public function InputPembangunanKewilayahanProvinsiRPJMN(){  
    $this->db->insert('pembangunan_kewilayahan_provinsi', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Menyimpan Data!';
    }
}

public function EditPembangunanKewilayahanProvinsiRPJMN(){  
    $this->db->where('Id', $_POST['Id']); 
    $this->db->update('pembangunan_kewilayahan_provinsi', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Update Data! (Atau tidak ada perubahan)';
    }
}

public function HapusPembangunanKewilayahanProvinsiRPJMN(){  
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id'])->update('pembangunan_kewilayahan_provinsi', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Hapus Data!';
    }
}

// ==============================================
// CRUD LEVEL 2: KAWASAN
// ==============================================
public function InputPembangunanKewilayahanKawasanRPJMN(){  
    $this->db->insert('pembangunan_kewilayahan_kawasan', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Menyimpan Data!';
    }
}

public function EditPembangunanKewilayahanKawasanRPJMN(){  
    $this->db->where('Id', $_POST['Id']); 
    $this->db->update('pembangunan_kewilayahan_kawasan', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Update Data! (Atau tidak ada perubahan)';
    }
}

public function HapusPembangunanKewilayahanKawasanRPJMN(){  
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id'])->update('pembangunan_kewilayahan_kawasan', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Hapus Data!';
    }
}

// ==============================================
// CRUD LEVEL 3: SUB KAWASAN
// ==============================================
public function InputPembangunanKewilayahanSubKawasanRPJMN(){  
    $this->db->insert('pembangunan_kewilayahan_subkawasan', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Menyimpan Data!';
    }
}

public function EditPembangunanKewilayahanSubKawasanRPJMN(){  
    $this->db->where('Id', $_POST['Id']); 
    $this->db->update('pembangunan_kewilayahan_subkawasan', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Update Data! (Atau tidak ada perubahan)';
    }
}

public function HapusPembangunanKewilayahanSubKawasanRPJMN(){  
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id'])->update('pembangunan_kewilayahan_subkawasan', $_POST);
    if ($this->db->affected_rows()){
        echo '1';
    } else {
        echo 'Gagal Hapus Data!';
    }
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
  
  public function SasaranPrioritasNasional(){
		$Header['Halaman'] = 'RKP';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['SasaranPembangunan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,p.Id as IdPrioritasNasional,p.PrioritasNasional,s.* FROM visirpjmn as v, prioritas_nasional_rpjmn as p, sasaran_prioritas_nasional as s WHERE s._Id = p.Id AND p._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranPrioritasNasional',$Data);
	}

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

  public function IndikasiIntervensi(){
		$Header['Halaman'] = 'RKP';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['IndikasiIntervensi'] = $this->db->query("SELECT i.*,p._Id as _IdPN,p.PrioritasNasional,k.* FROM indikasi_intervensi as i, prioritas_nasional_rpjmn as p, kodewilayah as k WHERE i._Id=p.Id AND i.Provinsi=k.Kode AND i.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/IndikasiIntervensi',$Data);
	}

  public function InputIndikasiIntervensi(){  
    $this->db->insert('indikasi_intervensi',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIndikasiIntervensi(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('indikasi_intervensi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIndikasiIntervensi(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('indikasi_intervensi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  // (Ini adalah fungsi tambahan untuk ditempelkan di dalam class Nasional Controller Anda)

  // =========================================================================
  // FUNGSI UTAMA: LOAD DATA & RAKIT HIERARKI 4 LEVEL
  // =========================================================================
  public function ProyekStrategisRPJMN() {
    $Header['Halaman'] = 'RPJMN';
    
    // Load data untuk form select Periode (Visi RPJMN)
    $Data['ComboVisi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();

    $Data['Kementerian'] = $this->db->where("deleted_at IS NULL")->get("kementerian")->result_array(); // Sesuaikan nama tabel kementerian
    $MapKementerian = [];
    foreach($Data['Kementerian'] as $k) {
        $MapKementerian[$k['Id']] = $k['NamaKementerian'];
    }
    $Data['MapKementerian'] = $MapKementerian;

    // 1. Fetching Semua Tabel dengan 1x Call per tabel (Mencegah N+1 Queries)
    // LEVEL 1: PN
    $DataPN = $this->db->query("SELECT a.*, b.TahunMulai, b.TahunAkhir FROM ps_prioritas_nasional a LEFT JOIN visirpjmn b ON a._IdVisi = b.Id WHERE a.deleted_at IS NULL ORDER BY a.Id ASC")->result_array();
    $SasaranPN   = $this->db->where('deleted_at IS NULL')->get('ps_pn_sasaran')->result_array();
    $IndikatorPN = $this->db->where('deleted_at IS NULL')->get('ps_pn_indikator')->result_array();

    // LEVEL 2: PP
    $DataPP = $this->db->where('deleted_at IS NULL')->get('ps_program_prioritas')->result_array();
    $SasaranPP   = $this->db->where('deleted_at IS NULL')->get('ps_pp_sasaran')->result_array();
    $IndikatorPP = $this->db->where('deleted_at IS NULL')->get('ps_pp_indikator')->result_array();

    // LEVEL 3: KP
    $DataKP = $this->db->where('deleted_at IS NULL')->get('ps_kegiatan_prioritas')->result_array();
    $SasaranKP   = $this->db->where('deleted_at IS NULL')->get('ps_kp_sasaran')->result_array();
    $IndikatorKP = $this->db->where('deleted_at IS NULL')->get('ps_kp_indikator')->result_array();

    // LEVEL 4: PROYEK
    $DataProyek = $this->db->where('deleted_at IS NULL')->get('ps_proyek_prioritas')->result_array();

    // 2. Merakit Array Bersarang Menggunakan Algoritma Mapping (Cepat & Hemat Resource)
    
    // A. Map Indikator ke masing-masing Sasaran
    $mapIndPN = []; foreach($IndikatorPN as $i) { $mapIndPN[$i['_IdSasaranPN']][] = $i; }
    $mapIndPP = []; foreach($IndikatorPP as $i) { $mapIndPP[$i['_IdSasaranPP']][] = $i; }
    $mapIndKP = []; foreach($IndikatorKP as $i) { $mapIndKP[$i['_IdSasaranKP']][] = $i; }

    // B. Map Sasaran (yang sudah berisi Indikator) ke Parent Levelnya
    $mapSasPN = []; foreach($SasaranPN as $s) { $s['Indikator'] = $mapIndPN[$s['Id']] ?? []; $mapSasPN[$s['_IdPN']][] = $s; }
    $mapSasPP = []; foreach($SasaranPP as $s) { $s['Indikator'] = $mapIndPP[$s['Id']] ?? []; $mapSasPP[$s['_IdPP']][] = $s; }
    $mapSasKP = []; foreach($SasaranKP as $s) { $s['Indikator'] = $mapIndKP[$s['Id']] ?? []; $mapSasKP[$s['_IdKP']][] = $s; }

    // C. Map Level 4 (Proyek) ke Level 3 (Kegiatan Prioritas)
    $mapProyek = []; foreach($DataProyek as $p) { $mapProyek[$p['_IdKP']][] = $p; }

    // D. Map Level 3 (KP) ke Level 2 (PP)
    $mapKP = []; 
    foreach($DataKP as $kp) { 
        $kp['Sasaran'] = $mapSasKP[$kp['Id']] ?? []; 
        $kp['Proyek']  = $mapProyek[$kp['Id']] ?? [];
        $mapKP[$kp['_IdPP']][] = $kp; 
    }

    // E. Map Level 2 (PP) ke Level 1 (PN)
    $mapPP = []; 
    foreach($DataPP as $pp) { 
        $pp['Sasaran'] = $mapSasPP[$pp['Id']] ?? []; 
        $pp['KegiatanPrioritas'] = $mapKP[$pp['Id']] ?? [];
        $mapPP[$pp['_IdPN']][] = $pp; 
    }

    // F. Finalisasi: Masukkan semua cabang ke Induk Utama (PN - Level 1)
    foreach($DataPN as &$pn) {
        $pn['Sasaran'] = $mapSasPN[$pn['Id']] ?? [];
        $pn['ProgramPrioritas'] = $mapPP[$pn['Id']] ?? [];
    }

    // Array final siap dikirim ke View
    $Data['ProyekStrategis'] = $DataPN; 

    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/ProyekStrategisRPJMN', $Data);
  }

  // =========================================================================
  // CRUD LEVEL 1 : PRIORITAS NASIONAL (PN)
  // =========================================================================
  public function InputPS_PN(){ $this->db->insert('ps_prioritas_nasional', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!'; }
  public function EditPS_PN(){ $this->db->where('Id', $_POST['Id'])->update('ps_prioritas_nasional', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!'; }
  public function HapusPS_PN(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); // Set timestamp Soft Delete
      $this->db->where('Id', $_POST['Id'])->update('ps_prioritas_nasional', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!'; 
  }

  public function InputPS_SasaranPN(){ $this->db->insert('ps_pn_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Sasaran PN!'; }
  public function EditPS_SasaranPN(){ $this->db->where('Id', $_POST['Id'])->update('ps_pn_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Sasaran PN!'; }
  public function HapusPS_SasaranPN(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_pn_sasaran', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Sasaran PN!'; 
  }

  public function InputPS_IndikatorPN(){ $this->db->insert('ps_pn_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Indikator PN!'; }
  public function EditPS_IndikatorPN(){ $this->db->where('Id', $_POST['Id'])->update('ps_pn_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Indikator PN!'; }
  public function HapusPS_IndikatorPN(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_pn_indikator', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Indikator PN!'; 
  }

  // =========================================================================
  // CRUD LEVEL 2 : PROGRAM PRIORITAS (PP)
  // =========================================================================
  public function InputPS_PP(){ $this->db->insert('ps_program_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!'; }
  public function EditPS_PP(){ $this->db->where('Id', $_POST['Id'])->update('ps_program_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!'; }
  public function HapusPS_PP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_program_prioritas', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!'; 
  }

  public function InputPS_SasaranPP(){ $this->db->insert('ps_pp_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Sasaran PP!'; }
  public function EditPS_SasaranPP(){ $this->db->where('Id', $_POST['Id'])->update('ps_pp_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Sasaran PP!'; }
  public function HapusPS_SasaranPP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_pp_sasaran', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Sasaran PP!'; 
  }

  public function InputPS_IndikatorPP(){ $this->db->insert('ps_pp_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Indikator PP!'; }
  public function EditPS_IndikatorPP(){ $this->db->where('Id', $_POST['Id'])->update('ps_pp_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Indikator PP!'; }
  public function HapusPS_IndikatorPP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_pp_indikator', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Indikator PP!'; 
  }

  // =========================================================================
  // CRUD LEVEL 3 : KEGIATAN PRIORITAS (KP)
  // =========================================================================
  public function InputPS_KP(){ $this->db->insert('ps_kegiatan_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!'; }
  public function EditPS_KP(){ $this->db->where('Id', $_POST['Id'])->update('ps_kegiatan_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!'; }
  public function HapusPS_KP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_kegiatan_prioritas', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!'; 
  }

  public function InputPS_SasaranKP(){ $this->db->insert('ps_kp_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Sasaran KP!'; }
  public function EditPS_SasaranKP(){ $this->db->where('Id', $_POST['Id'])->update('ps_kp_sasaran', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Sasaran KP!'; }
  public function HapusPS_SasaranKP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_kp_sasaran', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Sasaran KP!'; 
  }

  public function InputPS_IndikatorKP(){ $this->db->insert('ps_kp_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Indikator KP!'; }
  public function EditPS_IndikatorKP(){ $this->db->where('Id', $_POST['Id'])->update('ps_kp_indikator', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Indikator KP!'; }
  public function HapusPS_IndikatorKP(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_kp_indikator', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Indikator KP!'; 
  }

  // =========================================================================
  // CRUD LEVEL 4 : PROYEK PRIORITAS (Hanya Nama Proyek)
  // =========================================================================
  public function InputPS_Proyek(){ $this->db->insert('ps_proyek_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Proyek Prioritas!'; }
  public function EditPS_Proyek(){ $this->db->where('Id', $_POST['Id'])->update('ps_proyek_prioritas', $_POST); echo $this->db->affected_rows() ? '1' : 'Gagal Update Proyek Prioritas!'; }
  public function HapusPS_Proyek(){ 
      $_POST['deleted_at'] = date('Y-m-d H:i:s'); 
      $this->db->where('Id', $_POST['Id'])->update('ps_proyek_prioritas', $_POST); 
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Proyek Prioritas!'; 
  }
}




