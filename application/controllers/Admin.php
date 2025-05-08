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

  public function GetVisiRPJPDP(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjpdp as v, misirpjpdp as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetVisiRPJPN(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjpn as v, misirpjpn as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetVisiRPJPD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjpd")->result_array());
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

  public function GetMisiRPJPDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpdp")->result_array());
	}

  public function GetMisiRPJPN(){
    echo json_encode($this->db->query("SELECT v.*,m.* FROM visirpjpn as v, misirpjpn as m WHERE m._Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeMisiRPJPD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpd")->result_array());
	}

  public function GetMisiRPJPD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpd")->result_array());
	}

  public function MisiRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['VisiRPJPDP'] = $this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND deleted_at IS NULL")->get("visirpjpdp")->result_array();
    $Data['VisiRPJPN'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjpd")->result_array();
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

  public function TujuanRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['VisiRPJPDP'] = $this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND deleted_at IS NULL")->get("visirpjpdp")->result_array();
    $Data['VisiRPJPN'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjpd")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,m.Id as IdMisi,m.Misi,t.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
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

  public function SasaranRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['VisiRPJPDP'] = $this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND deleted_at IS NULL")->get("visirpjpdp")->result_array();
    $Data['VisiRPJMN'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjpd")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.Id as IdTujuan,t.Tujuan,s.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t, sasaranrpjpd as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL AND s.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
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

  public function TahapanRPJPD(){
		$Header['Halaman'] = 'RPJPD';
		$Data['Tahapan'] = $this->db->where("deleted_at IS NULL")->get("tahapanrpjpd")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/TahapanRPJPD',$Data);
	}

  public function InputTahapanRPJPD(){  
    $this->db->insert('tahapanrpjpd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjpd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTahapanRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjpd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetVisiRPJMDP(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjmdp as v, misirpjmdp as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetVisiRPJMN(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjmn as v, misirpjmn as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetVisiRPJMD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjmd")->result_array());
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

  public function GetMisiRPJMDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmdp")->result_array());
	}

  public function GetMisiRPJMN(){
    echo json_encode($this->db->query("SELECT v.*,m.* FROM visirpjmn as v, misirpjmn as m WHERE m._Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeMisiRPJMD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmd")->result_array());
	}

  public function GetMisiRPJMD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmd")->result_array());
	}

  public function MisiRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['VisiRPJMDP'] = $this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND deleted_at IS NULL")->get("visirpjmdp")->result_array();
    $Data['VisiRPJMN'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjmd")->result_array();
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

  public function GetTujuanRPJMDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("tujuanrpjmdp")->result_array());
	}

  public function GetTujuanRPJMN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeTujuanRPJMD(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function GetTujuanRPJMD(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function TujuanRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['VisiRPJMDP'] = $this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND deleted_at IS NULL")->get("visirpjmdp")->result_array();
    $Data['VisiRPJMN'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjmd")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,m.Id as IdMisi,m.Misi,t.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
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

  public function GetSasaranRPJMDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("sasaranrpjmdp")->result_array());
	}

  public function GetSasaranRPJMN(){
    echo json_encode($this->db->query("SELECT s.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t, sasaranrpjmn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeSasaranRPJMD(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function GetSasaranRPJMD(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function SasaranRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['VisiRPJMDP'] = $this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND deleted_at IS NULL")->get("visirpjmdp")->result_array();
    $Data['VisiRPJMN'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjmd")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.Id as IdTujuan,t.Tujuan,s.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t, sasaranrpjmd as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL AND s.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
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

  public function TahapanRPJMD(){
		$Header['Halaman'] = 'RPJMD';
		$Data['Tahapan'] = $this->db->where("deleted_at IS NULL")->get("tahapanrpjmd")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/TahapanRPJMD',$Data);
	}

  public function InputTahapanRPJMD(){  
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
    
    // Get all periods from RPJMD
    $Data['Periods'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM visirpjmd 
        WHERE KodeWilayah = ".$_SESSION['KodeWilayah']." 
        AND deleted_at IS NULL
        ORDER BY TahunMulai
    ")->result_array();
    
    // Get IKU data with period information
    $Data['Iku'] = $this->db->query("
        SELECT i.*, v.TahunMulai, v.TahunAkhir
        FROM iku i
        JOIN tujuanrpjmd t ON i.IdTujuan = t.Id
        JOIN misirpjmd m ON t._Id = m.Id
        JOIN visirpjmd v ON m._Id = v.Id
        WHERE i.deleted_at IS NULL 
        AND i.kodewilayah = ".$_SESSION['KodeWilayah']."
    ")->result_array();
    
    $Data['Tujuan'] = $this->db->where('deleted_at IS NULL AND kodewilayah = '.$_SESSION['KodeWilayah'])
                            ->get('tujuanrpjmd')->result_array();
    
    $this->load->view('Admin/header', $Header);
    $this->load->view('Admin/Iku', $Data);
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
  
  // Get all periods from RPJMD
  $Data['Periods'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir 
      FROM visirpjmd 
      WHERE KodeWilayah = ".$_SESSION['KodeWilayah']." 
      AND deleted_at IS NULL
      ORDER BY TahunMulai
  ")->result_array();
  
  // Get IKD data with period information
  $Data['Ikd'] = $this->db->query("
      SELECT i.*, v.TahunMulai, v.TahunAkhir
      FROM ikd i
      JOIN sasaranrpjmd s ON i.IdSasaran = s.Id
      JOIN tujuanrpjmd t ON s._Id = t.Id
      JOIN misirpjmd m ON t._Id = m.Id
      JOIN visirpjmd v ON m._Id = v.Id
      WHERE i.deleted_at IS NULL 
      AND i.kodewilayah = ".$_SESSION['KodeWilayah']."
  ")->result_array();
  
  $Data['Sasaran'] = $this->db->where('deleted_at IS NULL AND kodewilayah = '.$_SESSION['KodeWilayah'])
                          ->get('sasaranrpjmd')->result_array();
  $Data['Instansi'] = $this->db->where('deleted_at IS NULL AND kodewilayah = '.$_SESSION['KodeWilayah'])
                          ->get('akun_instansi')->result_array();
  
  $this->load->view('Admin/header', $Header);
  $this->load->view('Admin/Ikd', $Data);
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

    // Halaman Permasalahan Pokok
    public function PermasalahanPokok() {
      $Header['Halaman'] = 'Isudaerah';
      
      // Ambil periode dari RPJMD
      $query = $this->db->query("
          SELECT DISTINCT TahunMulai, TahunAkhir 
          FROM visirpjmd 
          WHERE KodeWilayah = ? AND deleted_at IS NULL
          ORDER BY TahunMulai
      ", array($_SESSION['KodeWilayah']));
      $Data['Periods'] = $query->result_array();
      
      // Ambil data Permasalahan Pokok
      $query = $this->db->query("
          SELECT * FROM Permasalahanpokokdaerah 
          WHERE KodeWilayah = ? AND deleted_at IS NULL
      ", array($_SESSION['KodeWilayah']));
      $Data['PermasalahanPokok'] = $query->result_array();
      
      $this->load->view('Admin/header', $Header);
      $this->load->view('Admin/PermasalahanPokok', $Data);
  }

  // Input Permasalahan Pokok
  public function InputPermasalahanPokok() {
      $periode = explode('-', $this->input->post('PeriodeRPJMD'));
      
      $data = array(
          'NamaPermasalahanPokok' => $this->input->post('NamaPermasalahanPokok'),
          'TahunMulai' => $periode[0],
          'TahunAkhir' => $periode[1],
          'KodeWilayah' => $_SESSION['KodeWilayah'],
          'created_at' => date('Y-m-d H:i:s')
      );
      
      $this->db->insert('Permasalahanpokokdaerah', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
  }

  // Update Permasalahan Pokok
  public function UpdatePermasalahanPokok() {
      $periode = explode('-', $this->input->post('EditPeriodeRPJMD'));
      
      $data = array(
          'NamaPermasalahanPokok' => $this->input->post('NamaPermasalahanPokok'),
          'TahunMulai' => $periode[0],
          'TahunAkhir' => $periode[1],
          'updated_at' => date('Y-m-d H:i:s')
      );
      
      $this->db->where('Id', $this->input->post('Id'));
      $this->db->update('Permasalahanpokokdaerah', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
  }

  // Hapus Permasalahan Pokok (Soft Delete)
  public function DeletePermasalahanPokok() {
      $data = array(
          'deleted_at' => date('Y-m-d H:i:s')
      );
      
      $this->db->where('Id', $this->input->post('Id'));
      $this->db->update('Permasalahanpokokdaerah', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
  }

  public function IsuKLHS() {
    $Header['Halaman'] = 'Isudaerah';
    
    // Get RPJMD periods
    $query = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM visirpjmd 
        WHERE KodeWilayah = ? AND deleted_at IS NULL
        ORDER BY TahunMulai
    ", array($_SESSION['KodeWilayah']));
    
    $Data['Periods'] = $query->result_array();
    
    // Get Isu KLHS data
    $query = $this->db->query("
        SELECT * FROM IsuKLHS 
        WHERE KodeWilayah = ? AND deleted_at IS NULL
    ", array($_SESSION['KodeWilayah']));
    
    $Data['IsuKLHS'] = $query->result_array();
    $this->load->view('Admin/header', $Header);
    $this->load->view('Admin/IsuKLHS', $Data);
}

public function InputIsuKLHS() {
    $periode = explode('-', $this->input->post('PeriodeRPJMD'));
    
    $data = array(
        'NamaIsuKLHS' => $this->input->post('NamaIsuKLHS'),
        'TahunMulai' => $periode[0],
        'TahunAkhir' => $periode[1],
        'KodeWilayah' => $_SESSION['KodeWilayah'],
        'created_at' => date('Y-m-d H:i:s')
    );
    
    $this->db->insert('IsuKLHS', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
}

public function UpdateIsuKLHS() {
    $periode = explode('-', $this->input->post('EditPeriodeRPJMD'));
    
    $data = array(
        'NamaIsuKLHS' => $this->input->post('NamaIsuKLHS'),
        'TahunMulai' => $periode[0],
        'TahunAkhir' => $periode[1],
        'updated_at' => date('Y-m-d H:i:s')
    );
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('IsuKLHS', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuKLHS() {
    $data = array(
        'deleted_at' => date('Y-m-d H:i:s')
    );
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('IsuKLHS', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

public function IsuStrategisDaerah() {
  $Header['Halaman'] = 'Isudaerah';
  
  // Get RPJMD periods
  $query = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir 
      FROM visirpjmd 
      WHERE KodeWilayah = ? AND deleted_at IS NULL
      ORDER BY TahunMulai
  ", array($_SESSION['KodeWilayah']));
  
  $Data['Periods'] = $query->result_array();
  
  // Get data Isu Strategis
  $query = $this->db->query("
      SELECT * FROM IsuStrategisDaerah 
      WHERE KodeWilayah = ? AND deleted_at IS NULL
  ", array($_SESSION['KodeWilayah']));
  
  $Data['IsuStrategis'] = $query->result_array();
  $this->load->view('Admin/header', $Header);
  $this->load->view('Admin/IsuStrategisDaerah', $Data);
}

public function InputIsuStrategis() {
  $periode = explode('-', $this->input->post('PeriodeRPJMD'));
  
  $data = array(
      'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
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

}


