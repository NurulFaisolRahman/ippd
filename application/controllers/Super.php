<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

  public function __construct() {
		parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
  }

  public function VisiRPJPN(){
		$Header['Halaman'] = 'RPJPN';
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/VisiRPJPN',$Data);
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

  public function MisiRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjpn as v, misirpjpn as m WHERE m._Id = v.Id AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/MisiRPJPN',$Data);
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

  public function TujuanRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjpn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.*,m.Misi,t.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TujuanRPJPN',$Data);
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

  public function SasaranRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->get("Tujuanrpjpn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.*,t.Tujuan,s.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t, sasaranrpjpn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/SasaranRPJPN',$Data);
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

  public function VisiRPJMN(){
		$Header['Halaman'] = 'RPJMN';
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/VisiRPJMN',$Data);
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

  public function MisiRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjmn as v, misirpjmn as m WHERE m._Id = v.Id AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/MisiRPJMN',$Data);
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

  public function TujuanRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjmn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.*,m.Misi,t.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TujuanRPJMN',$Data);
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

  public function SasaranRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->get("Tujuanrpjmn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.*,t.Tujuan,s.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t, sasaranrpjmn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/SasaranRPJMN',$Data);
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

	public function VMTS(){
    $Header['Halaman'] = 'VMTS';
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
    $this->load->view('Super/header',$Header);
		$this->load->view('Super/VMTS',$Data);
	}

	public function GetVMTS($Id){
    echo json_encode($this->db->get_where('vmts', array('Id' => $Id))->row_array());
	}

	public function InputVMTS(){  
    $this->db->insert('vmts',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVMTS(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('vmts', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }
  public function Kementerian() {
    $Header['Halaman'] = 'Kementerian';
    $Data['Kementerian'] = $this->db->query("SELECT * FROM `kementerian` WHERE deleted_at IS NULL")->result_array();
    $this->load->view('Super/header',$Header);
    $this->load->view('Super/Kementerian', $Data);
  }

  public function InputKementerian() {
      $this->db->insert('kementerian', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Input Data!';
      }
  }

  public function UpdateKementerian() {
      $this->db->where('Id', $_POST['Id']);
      $this->db->update('kementerian', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Update Data!';
      }
  }

  public function DeleteKementerian(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('kementerian', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function Isu() {
    $Header['Halaman'] = 'Kementerian';
    $Data['Isu'] = $this->db->select('isu_strategis.*, kementerian.NamaKementerian')
                            ->from('isu_strategis')
                            ->join('kementerian', 'kementerian.Id = isu_strategis.KementerianId')
                            ->where('isu_strategis.deleted_at IS NULL')
                            ->get()->result_array();
    $Data['Kementerian'] = $this->db->get('kementerian')->result_array();
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/isu', $Data);
  }

  public function GetIsu($Id) {
    echo json_encode($this->db->get_where('isu_strategis', array('Id' => $Id))->row_array());
  }

  
  public function InputIsu() {
    $ListIsuStrategis = array();
    foreach ($_POST['NamaIsu'] as $key => $value) {
      $Temp['KementerianId'] = $_POST['KementerianId'];
      $Temp['Tahun'] = $_POST['Tahun'];
      $Temp['NamaIsu'] = $value;
      array_push($ListIsuStrategis,$Temp);
    }
    $this->db->insert_batch('isu_strategis', $ListIsuStrategis);
    if ($this->db->affected_rows()) {
        echo '1';
    } else {
        echo 'Gagal Menyimpan Data!';
    }
  }

  public function EditIsu() {
    $this->db->where('Id', $_POST['Id']);
    $this->db->update('isu_strategis', $_POST);
    if ($this->db->affected_rows()) {
        echo '1'; 
    } else {
        echo 'Gagal Update Data!';
    }
  }

  public function DeleteIsu($Id) {
    $this->db->where('Id', $Id);
    $this->db->update('isu_strategis', array('deleted_at' => date('Y-m-d H:i:s')));
    if ($this->db->affected_rows() > 0) {
        echo '1';
    } else {
        echo "Gagal Menghapus Data !";
    }
  }
  
}



