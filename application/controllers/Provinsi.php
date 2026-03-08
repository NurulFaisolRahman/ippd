<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi extends CI_Controller {

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

  public function VisiRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    // 1. Ambil semua data Visi
    $visi_data = $this->db->query("SELECT v.*,k.* FROM visirpjpdp as v, kodewilayah as k WHERE v.KodeWilayah = k.Kode AND v.deleted_at IS NULL")->result_array();
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
        $misi_data = $this->db->where("deleted_at IS NULL")->get('misirpjpdp')->result_array();

        foreach ($misi_data as $m) {
            $misi_item = [
                'Id'      => $m['Id'],
                'Misi'    => $m['Misi'],
                'Periode' => $periode, // Misi mengikuti periode Visi
                'Tujuan'  => []
            ];

            // 3. Ambil data Tujuan berdasarkan _Id (Id Misi)
            $this->db->where('_Id', $m['Id']);
            $tujuan_data = $this->db->where("deleted_at IS NULL")->get('tujuanrpjpdp')->result_array();

            foreach ($tujuan_data as $t) {
                $tujuan_item = [
                    'Id'      => $t['Id'],
                    'Tujuan'  => $t['Tujuan'],
                    'Periode' => $periode,
                    'Sasaran' => []
                ];

                // 4. Ambil data Sasaran berdasarkan _Id (Id Tujuan)
                $this->db->where('_Id', $t['Id']);
                $sasaran_data = $this->db->where("deleted_at IS NULL")->get('sasaranrpjpdp')->result_array();

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
    $this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/VisiRPJPD',$Data);
	}

  public function InputVisiRPJPD(){  
    $this->db->insert('visirpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visirpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetVisiRPJPD(){
    echo json_encode($this->db->where("Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjpdp")->result_array());
	}

  public function GetProvinsiRPJPD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjpdp")->result_array());
	}

  public function InputMisiRPJPD(){  
    $this->db->insert('misirpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('misirpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetMisiRPJPD(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpdp")->result_array());
	}

  public function InputTujuanRPJPD(){  
    $this->db->insert('tujuanrpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tujuanrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetTujuanRPJPD(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjpdp as v, misirpjpdp as m, tujuanrpjpdp as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function InputSasaranRPJPD(){  
    $this->db->insert('sasaranrpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TahapanRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Tahapan'] = $this->db->query("SELECT v.*,t.*,k.* FROM visirpjpdp as v,tahapanrpjpdp as t, kodewilayah as k WHERE t._Id = v.Id AND t.KodeWilayah = k.Kode AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/TahapanRPJPD',$Data);
	}

  public function InputTahapanRPJPD(){  
    $this->db->insert('tahapanrpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTahapanRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function VisiRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		// 1. Ambil semua data Visi
    $visi_data = $this->db->query("SELECT v.*,k.* FROM visirpjmdp as v, kodewilayah as k WHERE v.KodeWilayah = k.Kode AND v.deleted_at IS NULL")->result_array();
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
        $misi_data = $this->db->where("deleted_at IS NULL")->get('misirpjmdp')->result_array();

        foreach ($misi_data as $m) {
            $misi_item = [
                'Id'      => $m['Id'],
                'Misi'    => $m['Misi'],
                'Periode' => $periode, // Misi mengikuti periode Visi
                'Tujuan'  => []
            ];

            // 3. Ambil data Tujuan berdasarkan _Id (Id Misi)
            $this->db->where('_Id', $m['Id']);
            $tujuan_data = $this->db->where("deleted_at IS NULL")->get('tujuanrpjmdp')->result_array();

            foreach ($tujuan_data as $t) {
                $tujuan_item = [
                    'Id'      => $t['Id'],
                    'Tujuan'  => $t['Tujuan'],
                    'Periode' => $periode,
                    'Sasaran' => []
                ];

                // 4. Ambil data Sasaran berdasarkan _Id (Id Tujuan)
                $this->db->where('_Id', $t['Id']);
                $sasaran_data = $this->db->where("deleted_at IS NULL")->get('sasaranrpjmdp')->result_array();

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
    $this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/VisiRPJMD',$Data);
	}

  public function InputVisiRPJMD(){  
    $this->db->insert('visirpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visirpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetProvinsiRPJMD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjmdp")->result_array());
	}

  public function GetVisiRPJMD(){
    echo json_encode($this->db->where("Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjmdp")->result_array());
	}

  public function InputMisiRPJMD(){  
    $this->db->insert('misirpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('misirpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetMisiRPJMD(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmdp")->result_array());
	}

  public function InputTujuanRPJMD(){  
    $this->db->insert('tujuanrpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tujuanrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetTujuanRPJMD(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmdp as v, misirpjmdp as m, tujuanrpjmdp as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function InputSasaranRPJMD(){  
    $this->db->insert('sasaranrpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TahapanRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Tahapan'] = $this->db->query("SELECT v.*,t.*,k.* FROM visirpjmdp as v,tahapanrpjmdp as t, kodewilayah as k WHERE t._Id = v.Id AND t.KodeWilayah = k.Kode AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/TahapanRPJMD',$Data);
	}

  public function InputTahapanRPJMD(){  
    $this->db->insert('tahapanrpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTahapanRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function IUPRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['IUP'] = $this->db->query("SELECT v.*,i.*,k.* FROM visirpjpdp as v,iuprpjpdp as i, kodewilayah as k WHERE i._Id = v.Id AND i.KodeWilayah = k.Kode AND i.deleted_at IS NULL")->result_array();
		$this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/IUPRPJPD',$Data);
	}

  public function InputIUPRPJPD(){  
    $this->db->insert('iuprpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIUPRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('iuprpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIUPRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('iuprpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function IUPRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['IUP'] = $this->db->query("SELECT v.*,i.*,k.* FROM visirpjmdp as v,iuprpjmdp as i, kodewilayah as k WHERE i._Id = v.Id AND i.KodeWilayah = k.Kode AND i.deleted_at IS NULL")->result_array();
		$this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/IUPRPJMD',$Data);
	} 

  public function InputIUPRPJMD(){  
    $this->db->insert('iuprpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIUPRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('iuprpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIUPRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('iuprpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }
}



