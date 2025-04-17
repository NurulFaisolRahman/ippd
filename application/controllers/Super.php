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

  public function GetVisiRPJPN(){
    echo json_encode($this->db->where("Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjpn")->result_array());
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

  public function GetMisiRPJPN(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpn")->result_array());
	}

  public function TujuanRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,m.Id as IdMisi,m.Misi,t.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array();
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

  public function GetTujuanRPJPN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function SasaranRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.Id as IdTujuan,t.Tujuan,s.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t, sasaranrpjpn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
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

  public function TahapanRPJPN(){
		$Header['Halaman'] = 'RPJPN';
		$Data['Tahapan'] = $this->db->where("deleted_at IS NULL")->get("tahapanrpjpn")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TahapanRPJPN',$Data);
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
		$Data['Tahapan'] = $this->db->where("deleted_at IS NULL")->get("tahapanrpjmn")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TahapanRPJMN',$Data);
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

  public function GetVisiRPJMN(){
    echo json_encode($this->db->where("Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjmn")->result_array());
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

  public function GetMisiRPJMN(){
    echo json_encode($this->db->where("_Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmn")->result_array());
	}

  public function TujuanRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,m.Id as IdMisi,m.Misi,t.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array();
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

  public function GetTujuanRPJMN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function SasaranRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.Id as IdTujuan,t.Tujuan,s.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t, sasaranrpjmn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
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

  public function SPM() {
    $Header['Halaman'] = 'Kementerian';
    $Data['SPM'] = $this->db->query("SELECT * FROM `SPM` WHERE deleted_at IS NULL")->result_array();
    $this->load->view('Super/header',$Header);
    $this->load->view('Super/SPM', $Data);
  }

  public function InputSPM(): void {
    $this->db->insert('SPM', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data!';
    }
  }

  public function UpdateSPM() {
      $this->db->where('Id', $_POST['Id']);
      $this->db->update('SPM', $_POST);
      if ($this->db->affected_rows()){
        echo '1';
      } else {
        echo 'Gagal Update Data!';
      }
  }

  public function DeleteSPM(){  
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id',$_POST['Id']); 
    $this->db->update('SPM', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }
  
  public function proyek_strategis() {
    $Header['Halaman'] = 'Kementerian';
    $Data['proyek_strategis'] = $this->db->query("SELECT * FROM `Proyek_strategis` WHERE deleted_at IS NULL")->result_array();
    $this->load->view('Super/header',$Header);
    $this->load->view('Super/proyek_strategis', $Data);
  }

  public function Inputproyek_strategis() {
    $this->db->insert('proyek_strategis', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data!';
    }
  }

  public function Updateproyek_strategis() {
    $this->db->where('Id', $_POST['Id']);
    $this->db->update('proyek_strategis', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function Deleteproyek_strategis() {  
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id']); 
    $this->db->update('proyek_strategis', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function program_strategis() {
    $Header['Halaman'] = 'Kementerian';
    $Data['program_strategis'] = $this->db->query("SELECT * FROM `program_strategis` WHERE deleted_at IS NULL")->result_array();
    $this->load->view('Super/header',$Header);
    $this->load->view('Super/program_strategis', $Data);
  }
  public function Inputprogram_strategis() {
    $this->db->insert('program_strategis', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Input Data!';
    }
  }

  public function Updateprogram_strategis() {
    $this->db->where('Id', $_POST['Id']);
    $this->db->update('program_strategis', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function Deleteprogram_strategis() {  
    $_POST['deleted_at'] = date('Y-m-d H:i:s');
    $this->db->where('Id', $_POST['Id']); 
    $this->db->update('program_strategis', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }
}



