<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
    if (!isset($_SESSION['KodeWilayah'])) {
      redirect(base_url());
    }
    date_default_timezone_set("Asia/Jakarta");
  }

  public function VisiRPJPD(){
		$Header['Halaman'] = 'RPJPD';
		$Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjpd")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/VisiRPJPD',$Data);
	}

  public function InputVisiRPJPD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('visirpjpd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjpd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visirpjpd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function MisiRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjpd")->result_array();
    $Data['_Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjpn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjpd as v, misirpjpd as m WHERE m._Id = v.Id AND m.deleted_at IS NULL AND m.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/MisiRPJPD',$Data);
	}

  public function InputMisiRPJPD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('misirpjpd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjpd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
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

  public function TujuanRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Misi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("misirpjpd")->result_array();
    $Data['_Tujuan'] = $this->db->where("deleted_at IS NULL")->get("Tujuanrpjpn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.*,m.Misi,t.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/TujuanRPJPD',$Data);
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

  public function SasaranRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Tujuan'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("Tujuanrpjpd")->result_array();
    $Data['_Sasaran'] = $this->db->where("deleted_at IS NULL")->get("Sasaranrpjpn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.*,t.Tujuan,s.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t, sasaranrpjpd as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL AND s.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/SasaranRPJPD',$Data);
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

  public function VisiRPJMD(){
		$Header['Halaman'] = 'RPJMD';
		$Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjmd")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/VisiRPJMD',$Data);
	}

  public function InputVisiRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('visirpjmd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisiRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visirpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusVisiRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visirpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function MisiRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjmd")->result_array();
    $Data['_Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjmn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjmd as v, misirpjmd as m WHERE m._Id = v.Id AND m.deleted_at IS NULL AND m.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/MisiRPJMD',$Data);
	}

  public function InputMisiRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('misirpjmd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisiRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misirpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisiRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('misirpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function TujuanRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Misi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("misirpjmd")->result_array();
    $Data['_Tujuan'] = $this->db->where("deleted_at IS NULL")->get("tujuanrpjmn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.*,m.Misi,t.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/TujuanRPJMD',$Data);
	}

  public function InputTujuanRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('tujuanrpjmd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuanRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuanrpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuanRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tujuanrpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function SasaranRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Tujuan'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("Tujuanrpjmd")->result_array();
    $Data['_Sasaran'] = $this->db->where("deleted_at IS NULL")->get("sasaranrpjmn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.*,t.Tujuan,s.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t, sasaranrpjmd as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL AND s.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/SasaranRPJMD',$Data);
	}

  public function InputSasaranRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('sasaranrpjmd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaranrpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaranrpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetSasaran(){
    $Id = $this->input->post('id');
    echo json_encode($this->db->get_where('sasaran', array('IdTujuan' => $Id))->result_array());
	}

	public function Instansi() {
		$Header['Halaman'] = 'Cascading';
		$Data['Akun'] = $this->db->query("SELECT * FROM `akun_instansi` WHERE deleted_at IS NULL AND kodewilayah = ".$_SESSION['KodeWilayah'])->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/kelola_instansi',$Data);
	}
	
	public function InputInstansi(){  
    $_POST['kodewilayah'] = $_SESSION['KodeWilayah'];
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $this->db->insert('akun_instansi',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditInstansi(){  
		$this->db->where('id',$_POST['id']); 
		if (isset($_POST['password'])) {
			$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		}
		$this->db->update('akun_instansi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

	public function HapusInstansi(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('id',$_POST['id']); 
		$this->db->update('akun_instansi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }
  
   public function IKU() {
        $Header['Halaman'] = 'Cascading';
        $Data['Iku'] = $this->db->where('deleted_at IS NULL AND kodewilayah = '.$_SESSION['KodeWilayah'])->get('iku')->result_array();
        $Data['Tujuan'] = $this->db->where('deleted_at IS NULL AND kodewilayah = '.$_SESSION['KodeWilayah'])->get('tujuanrpjmd')->result_array();
        $this->load->view('Admin/header', $Header);
        $this->load->view('Admin/Iku', $Data);
    }

    public function TambahIku() {
        $data = [
            'kodewilayah' => $_SESSION['KodeWilayah'],
            'IdTujuan' => $this->input->post('Tujuan'),
            'indikator_tujuan' => $this->input->post('indikator_tujuan'),
            'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
            'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
            'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
            'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
            'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null
        ];
        
        $this->db->insert('iku', $data);
        echo $this->db->affected_rows() ? '1' : '0';
    }

    public function EditIku() {
        $id = $this->input->post('id');
        $data = [
            'IdTujuan' => $this->input->post('EditTujuan'),
            'indikator_tujuan' => $this->input->post('indikator_tujuan'),
            'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
            'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
            'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
            'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
            'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id)->update('iku', $data);
        echo $this->db->affected_rows() ? '1' : '0';
    }

    public function HapusIku() {
        $id = $this->input->post('id');
        $this->db->where('id', $id)->update('iku', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        echo $this->db->affected_rows() ? '1' : '0';
    }

public function IKD() {
  $Header['Halaman'] = 'Cascading'; // Set to Cascading to keep tab active
  $Data['Ikd'] = $this->db->where('deleted_at IS NULL AND kodewilayah = '.$_SESSION['KodeWilayah'])->get('ikd')->result_array();
  $Data['Sasaran'] = $this->db->where('deleted_at IS NULL AND kodewilayah = '.$_SESSION['KodeWilayah'])->get('sasaranrpjmd')->result_array();
  $Data['Instansi'] = $this->db->where('deleted_at IS NULL AND kodewilayah = '.$_SESSION['KodeWilayah'])->get('akun_instansi')->result_array();
  $this->load->view('Admin/header', $Header);
  $this->load->view('Admin/Ikd', $Data);
}

public function TambahIkd() {
  $data = [
      'kodewilayah' => $_SESSION['KodeWilayah'],
      'IdSasaran' => $this->input->post('Sasaran'),
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
  $id = $this->input->post('id');
  $data = [
      'IdSasaran' => $this->input->post('EditSasaran'),
      'indikator_sasaran' => $this->input->post('indikator_sasaran'),
      'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
      'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
      'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
      'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
      'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
      'updated_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('id', $id)->update('ikd', $data);
  echo $this->db->affected_rows() ? '1' : '0';
}

public function HapusIkd() {
  $id = $this->input->post('id');
  $this->db->where('id', $id)->update('ikd', ['deleted_at' => date('Y-m-d H:i:s')]);
  echo $this->db->affected_rows() ? '1' : '0';
}

// In Admin.php controller

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

}
