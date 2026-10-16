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
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "v.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND v.KodeWilayah = '$KodeWilayah'";
		}
		
		$visi_data = $this->db->query("SELECT v.*,k.* FROM visirpjpdp as v, kodewilayah as k WHERE v.KodeWilayah = k.Kode AND $where_clause")->result_array();
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
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('visirpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
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
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('misirpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
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
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('tujuanrpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
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
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('sasaranrpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TahapanRPJPD(){
		$Header['Halaman'] = 'RPJPD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "t.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND t.KodeWilayah = '$KodeWilayah'";
		}
		
		$Data['Tahapan'] = $this->db->query("SELECT v.*,t.*,k.* FROM visirpjpdp as v,tahapanrpjpdp as t, kodewilayah as k WHERE t._Id = v.Id AND t.KodeWilayah = k.Kode AND $where_clause")->result_array();
		$this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/TahapanRPJPD',$Data);
	}

  public function InputTahapanRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('tahapanrpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTahapanRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function VisiRPJMD(){
		$Header['Halaman'] = 'RPJMD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "v.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND v.KodeWilayah = '$KodeWilayah'";
		}
		
		$visi_data = $this->db->query("SELECT v.*,k.* FROM visirpjmdp as v, kodewilayah as k WHERE v.KodeWilayah = k.Kode AND $where_clause")->result_array();
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
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('visirpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
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
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('misirpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
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
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('tujuanrpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
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
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('sasaranrpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TahapanRPJMD(){
		$Header['Halaman'] = 'RPJMD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "t.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND t.KodeWilayah = '$KodeWilayah'";
		}
		
		$Data['Tahapan'] = $this->db->query("SELECT v.*,t.*,k.* FROM visirpjmdp as v,tahapanrpjmdp as t, kodewilayah as k WHERE t._Id = v.Id AND t.KodeWilayah = k.Kode AND $where_clause")->result_array();
		$this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/TahapanRPJMD',$Data);
	}

  public function InputTahapanRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('tahapanrpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTahapanRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function IUPRPJPD(){
		$Header['Halaman'] = 'RPJPD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "i.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND i.KodeWilayah = '$KodeWilayah'";
		}
		
		$Data['IUP'] = $this->db->query("SELECT v.*,i.*,k.* FROM visirpjpdp as v,iuprpjpdp as i, kodewilayah as k WHERE i._Id = v.Id AND i.KodeWilayah = k.Kode AND $where_clause")->result_array();
		$this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/IUPRPJPD',$Data);
	}

  public function InputIUPRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('iuprpjpdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIUPRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('iuprpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIUPRPJPD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id'])->update('iuprpjpdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function IUPRPJMD(){
		$Header['Halaman'] = 'RPJMD';
		$KodeWilayah = isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != '' ? $_SESSION['KodeWilayah'] : $this->input->get('KodeWilayah', TRUE);
		
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['KodeWilayah'] = $KodeWilayah;
		
		$where_clause = "i.deleted_at IS NULL";
		if ($KodeWilayah) {
			$where_clause .= " AND i.KodeWilayah = '$KodeWilayah'";
		}
		
		$Data['IUP'] = $this->db->query("SELECT v.*,i.*,k.* FROM visirpjmdp as v,iuprpjmdp as i, kodewilayah as k WHERE i._Id = v.Id AND i.KodeWilayah = k.Kode AND $where_clause")->result_array();
		$this->load->view('Provinsi/header',$Header);
		$this->load->view('Provinsi/IUPRPJMD',$Data);
	} 

  public function InputIUPRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
    if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
        $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    }
    $this->db->insert('iuprpjmdp',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIUPRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('iuprpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIUPRPJMD(){
      if (!isset($_SESSION['Level']) || !in_array($_SESSION['Level'], [1, 2])) {
          echo "Unauthorized access";
          exit;
      }  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
        if(isset($_SESSION['KodeWilayah']) && $_SESSION['KodeWilayah'] != ''){
            $this->db->where('KodeWilayah', $_SESSION['KodeWilayah']);
        }
		$this->db->where('Id',$_POST['Id'])->update('iuprpjmdp', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  // ============================================================
  // TEMA PEMBANGUNAN PROVINSI - HELPER & CRUD
  // ============================================================

  private function _getKodeWilayah() {
    $kode = '';
    if (isset($_SESSION['KodeWilayah']) && !empty($_SESSION['KodeWilayah'])) {
      $kode = $_SESSION['KodeWilayah'];
    } elseif ($this->session->userdata('KodeWilayah')) {
      $kode = $this->session->userdata('KodeWilayah');
    } elseif ($this->session->userdata('TempKodeWilayah')) {
      $kode = $this->session->userdata('TempKodeWilayah');
    } elseif ($this->input->get('KodeWilayah', TRUE)) {
      $kode = $this->input->get('KodeWilayah', TRUE);
    }
    if (!empty($kode) && strlen($kode) > 2 && strpos($kode, '.') !== false) {
      $kode = substr($kode, 0, 2);
    }
    return $kode;
  }

  private function _checkSessionWilayah() {
    if (!isset($_SESSION['Level']) || !in_array((int)$_SESSION['Level'], [0, 1, 2])) {
      echo json_encode(['status' => 'error', 'message' => 'Unauthorized access']);
      return false;
    }
    $kodeWilayah = $this->_getKodeWilayah();
    if (empty($kodeWilayah)) {
      $kodeWilayah = $this->input->post('KodeWilayah', TRUE);
    }
    if (empty($kodeWilayah)) {
      echo json_encode(['status' => 'error', 'message' => 'Kode Wilayah tidak ditemukan!']);
      return false;
    }
    if (strlen($kodeWilayah) > 2 && strpos($kodeWilayah, '.') !== false) {
      $kodeWilayah = substr($kodeWilayah, 0, 2);
    }
    return $kodeWilayah;
  }

  public function TemaPembangunan() {
    $Header['Halaman'] = 'Tema Pembangunan';
    
    // Ambil daftar provinsi untuk filter (jika belum login atau superadmin)
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

    $KodeWilayah = $this->_getKodeWilayah();

    if ($KodeWilayah) {
      $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
      if ($wilayah) {
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = $wilayah['Nama'];
        
        // Ambil data Tema Provinsi
        $temas = $this->db
          ->where('kode_wilayah', $KodeWilayah)
          ->where('deleted_at IS NULL')
          ->order_by('tahun', 'DESC')
          ->order_by('id', 'ASC')
          ->get('tema_pembangunan_provinsi')
          ->result_array();
        
        // Ambil prioritas (nasional & provinsi) untuk setiap tema
        foreach ($temas as &$tema) {
          $tema['prioritas_nasional'] = $this->db
            ->where('tema_id', $tema['id'])
            ->where('kode_wilayah', $KodeWilayah)
            ->where('jenis', 'nasional')
            ->where('deleted_at IS NULL')
            ->order_by('id', 'ASC')
            ->get('prioritas_pembangunan_provinsi')
            ->result_array();
          
          $tema['prioritas_provinsi'] = $this->db
            ->where('tema_id', $tema['id'])
            ->where('kode_wilayah', $KodeWilayah)
            ->where('jenis', 'provinsi')
            ->where('deleted_at IS NULL')
            ->order_by('id', 'ASC')
            ->get('prioritas_pembangunan_provinsi')
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

    // Data untuk dropdown Tema RKP
    $Data['TahunTemaRKP'] = $this->db
      ->distinct()
      ->select('Tahun')
      ->where('deleted_at IS NULL')
      ->order_by('Tahun', 'DESC')
      ->get('temarkp')
      ->result_array();
    
    // Data prioritas nasional RPJMN
    $Data['PrioritasNasionalRPJMN'] = $this->db
      ->select('Id, PrioritasNasional')
      ->where('deleted_at IS NULL')
      ->order_by('PrioritasNasional', 'ASC')
      ->get('prioritas_nasional_rpjmn')
      ->result_array();

    $this->load->view('Provinsi/header', $Header);
    $this->load->view('Provinsi/TemaPembangunan', $Data);
  }

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
      
      // Cek duplikat tahun pada provinsi yang sama
      $exists = $this->db
        ->where('kode_wilayah', $kodeWilayah)
        ->where('tahun', $tahun)
        ->where('deleted_at IS NULL')
        ->get('tema_pembangunan_provinsi')
        ->num_rows();
      
      if ($exists > 0) {
        echo json_encode([
          'status' => 'warning',
          'message' => 'Tema Provinsi untuk tahun ' . $tahun . ' sudah ada!'
        ]);
        return;
      }
      
      $data = [
        'kode_wilayah'  => $kodeWilayah,
        'tahun'         => $tahun,
        'tema_nasional' => $temaNasionalText,
        'tema_rkp_id'   => !empty($temaRKPId) ? $temaRKPId : null,
        'tema_provinsi' => $temaProvinsi,
        'created_at'    => date('Y-m-d H:i:s')
      ];
      
      $this->db->insert('tema_pembangunan_provinsi', $data);
      $temaId = $this->db->insert_id();
      
      if ($temaId > 0) {
        echo json_encode([
          'status' => 'success',
          'message' => 'Tema Pembangunan Provinsi berhasil disimpan!',
          'tema_id' => $temaId
        ]);
      } else {
        echo json_encode([
          'status' => 'error',
          'message' => 'Gagal menyimpan tema pembangunan provinsi!'
        ]);
      }
      
    } catch (Exception $e) {
      log_message('error', 'Provinsi InputTemaPembangunan: ' . $e->getMessage());
      echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ]);
    }
  }

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
      $temaRKPId = $this->input->post('TemaRKPId', TRUE);
      $temaNasionalText = trim($this->input->post('TemaNasionalText', TRUE));
      $temaProvinsi = trim($this->input->post('TemaProvinsi', TRUE));
      
      if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
      }
      
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
      
      $exists = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kodeWilayah)
        ->where('deleted_at IS NULL')
        ->get('tema_pembangunan_provinsi')
        ->num_rows();
      
      if ($exists == 0) {
        echo json_encode([
          'status' => 'error',
          'message' => 'Data tidak ditemukan!'
        ]);
        return;
      }
      
      $data = [
        'tahun'         => $tahun,
        'tema_nasional' => $temaNasionalText,
        'tema_rkp_id'   => !empty($temaRKPId) ? $temaRKPId : null,
        'tema_provinsi' => $temaProvinsi,
        'updated_at'    => date('Y-m-d H:i:s')
      ];
      
      $this->db->where('id', $id);
      $this->db->where('kode_wilayah', $kodeWilayah);
      $this->db->update('tema_pembangunan_provinsi', $data);
      
      $affected = $this->db->affected_rows();
      echo json_encode([
        'status' => 'success',
        'message' => $affected > 0 ? 'Tema berhasil diupdate!' : 'Tidak ada perubahan data'
      ]);
      
    } catch (Exception $e) {
      log_message('error', 'Provinsi UpdateTemaPembangunan: ' . $e->getMessage());
      echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ]);
    }
  }

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
      
      $exists = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kodeWilayah)
        ->where('deleted_at IS NULL')
        ->get('tema_pembangunan_provinsi')
        ->num_rows();
      
      if ($exists == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
      }
      
      $this->db->trans_start();
      
      $this->db->where('id', $id);
      $this->db->where('kode_wilayah', $kodeWilayah);
      $this->db->update('tema_pembangunan_provinsi', [
        'deleted_at' => date('Y-m-d H:i:s')
      ]);
      
      $this->db->where('tema_id', $id);
      $this->db->where('kode_wilayah', $kodeWilayah);
      $this->db->update('prioritas_pembangunan_provinsi', [
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
      log_message('error', 'Provinsi DeleteTemaPembangunan: ' . $e->getMessage());
      echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ]);
    }
  }

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
      
      if (!in_array($jenis, ['nasional', 'provinsi'])) {
        echo json_encode(['status' => 'error', 'message' => 'Jenis prioritas tidak valid!']);
        return;
      }
      
      if (empty($prioritas)) {
        echo json_encode(['status' => 'error', 'message' => 'Prioritas harus diisi!']);
        return;
      }
      
      $temaExists = $this->db
        ->where('id', $temaId)
        ->where('kode_wilayah', $kodeWilayah)
        ->where('deleted_at IS NULL')
        ->get('tema_pembangunan_provinsi')
        ->num_rows();
      
      if ($temaExists == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Tema tidak ditemukan!']);
        return;
      }
      
      $data = [
        'tema_id'      => $temaId,
        'kode_wilayah' => $kodeWilayah,
        'jenis'        => $jenis,
        'prioritas'    => $prioritas,
        'created_at'   => date('Y-m-d H:i:s')
      ];
      
      $this->db->insert('prioritas_pembangunan_provinsi', $data);
      
      if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Prioritas berhasil ditambahkan!']);
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan prioritas!']);
      }
      
    } catch (Exception $e) {
      log_message('error', 'Provinsi InputPrioritasPembangunan: ' . $e->getMessage());
      echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ]);
    }
  }

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
      
      $exists = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kodeWilayah)
        ->where('deleted_at IS NULL')
        ->get('prioritas_pembangunan_provinsi')
        ->num_rows();
      
      if ($exists == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
      }
      
      $data = [
        'prioritas'  => $prioritas,
        'updated_at' => date('Y-m-d H:i:s')
      ];
      
      $this->db->where('id', $id);
      $this->db->where('kode_wilayah', $kodeWilayah);
      $this->db->update('prioritas_pembangunan_provinsi', $data);
      
      $affected = $this->db->affected_rows();
      echo json_encode([
        'status' => 'success',
        'message' => $affected > 0 ? 'Prioritas berhasil diupdate!' : 'Tidak ada perubahan data'
      ]);
      
    } catch (Exception $e) {
      log_message('error', 'Provinsi UpdatePrioritasPembangunan: ' . $e->getMessage());
      echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ]);
    }
  }

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
      
      $exists = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kodeWilayah)
        ->where('deleted_at IS NULL')
        ->get('prioritas_pembangunan_provinsi')
        ->num_rows();
      
      if ($exists == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
      }
      
      $this->db->where('id', $id);
      $this->db->where('kode_wilayah', $kodeWilayah);
      $this->db->update('prioritas_pembangunan_provinsi', [
        'deleted_at' => date('Y-m-d H:i:s')
      ]);
      
      if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Prioritas berhasil dihapus!']);
      } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus prioritas!']);
      }
      
    } catch (Exception $e) {
      log_message('error', 'Provinsi DeletePrioritasPembangunan: ' . $e->getMessage());
      echo json_encode([
        'status' => 'error',
        'message' => 'Terjadi kesalahan: ' . $e->getMessage()
      ]);
    }
  }

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

  public function GetPrioritasByTemaJenis() {
    if (!$this->input->is_ajax_request()) {
      show_404();
      return;
    }
    
    $temaId = (int)$this->input->post('tema_id', TRUE);
    $jenis = $this->input->post('jenis', TRUE);
    $kodeWilayah = $this->_getKodeWilayah();
    
    if ($temaId <= 0 || empty($kodeWilayah) || !in_array($jenis, ['nasional', 'provinsi'])) {
      echo json_encode([]);
      return;
    }
    
    $data = $this->db
      ->where('tema_id', $temaId)
      ->where('kode_wilayah', $kodeWilayah)
      ->where('jenis', $jenis)
      ->where('deleted_at IS NULL')
      ->order_by('id', 'ASC')
      ->get('prioritas_pembangunan_provinsi')
      ->result_array();
    
    echo json_encode($data);
  }

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
}




