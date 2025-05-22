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

  public function VisiRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Visi'] = $this->db->query("SELECT v.*,k.* FROM visirpjpdp as v, kodewilayah as k WHERE v.KodeWilayah = k.Kode AND v.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/VisiRPJPD',$Data);
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

  public function MisiRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Misi'] = $this->db->query("SELECT v.*,m.*,k.* FROM visirpjpdp as v,misirpjpdp as m, kodewilayah as k WHERE m._Id = v.Id AND m.KodeWilayah = k.Kode AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/MisiRPJPD',$Data);
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
  
  public function TujuanRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Tujuan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,m.Id as IdMisi,m.Misi,t.*,k.* FROM visirpjpdp as v,misirpjpdp as m,tujuanrpjpdp as t, kodewilayah as k WHERE t._Id = m.Id AND m._Id = v.Id AND v.KodeWilayah = k.Kode AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TujuanRPJPD',$Data);
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

  public function SasaranRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Sasaran'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.Id as IdTujuan,t.Tujuan,s.*,k.* FROM visirpjpdp as v,misirpjpdp as m,tujuanrpjpdp as t,sasaranrpjpdp as s, kodewilayah as k WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND v.KodeWilayah = k.Kode AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/SasaranRPJPD',$Data);
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
		$Data['Tahapan'] = $this->db->where("deleted_at IS NULL")->get("tahapanrpjpdp")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TahapanRPJPD',$Data);
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
    $Data['Visi'] = $this->db->query("SELECT v.*,k.* FROM visirpjmdp as v, kodewilayah as k WHERE v.KodeWilayah = k.Kode AND v.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/VisiRPJMD',$Data);
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

  public function MisiRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Misi'] = $this->db->query("SELECT v.*,m.*,k.* FROM visirpjmdp as v,misirpjmdp as m, kodewilayah as k WHERE m._Id = v.Id AND m.KodeWilayah = k.Kode AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/MisiRPJMD',$Data);
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
  
  public function TujuanRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Tujuan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,m.Id as IdMisi,m.Misi,t.*,k.* FROM visirpjmdp as v,misirpjmdp as m,tujuanrpjmdp as t, kodewilayah as k WHERE t._Id = m.Id AND m._Id = v.Id AND v.KodeWilayah = k.Kode AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TujuanRPJMD',$Data);
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

  public function SasaranRPJMD(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Sasaran'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.Id as IdTujuan,t.Tujuan,s.*,k.* FROM visirpjmdp as v,misirpjmdp as m,tujuanrpjmdp as t,sasaranrpjmdp as s, kodewilayah as k WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND v.KodeWilayah = k.Kode AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/SasaranRPJMD',$Data);
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
		$Data['Tahapan'] = $this->db->where("deleted_at IS NULL")->get("tahapanrpjmdp")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/TahapanRPJMD',$Data);
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

  public function Kementerian() {
    $Header['Halaman'] = 'Kementerian';
    $Data['Kementerian'] = $this->db->query("SELECT * FROM `kementerian` WHERE deleted_at IS NULL")->result_array();
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/Kementerian', $Data);
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

 public function IsuStrategis() {
    $Header['Halaman'] = 'Isu';
    
    $Data['IsuStrategis'] = $this->db->query("
        SELECT 
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
        FROM isu_strategis ist
        LEFT JOIN kementerian k ON ist.IdKementerian = k.Id
        WHERE ist.deleted_at IS NULL
        GROUP BY ist.Id
        ORDER BY ist.TahunMulai DESC, ist.TahunAkhir DESC
    ")->result_array();
    
    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir
        FROM kementerian
        WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir
        FROM isu_strategis
        WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir
        FROM permasalahan_pokok
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC, TahunAkhir DESC
    ")->result_array();
    
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/IsuStrategis', $Data);
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

public function GetPermasalahanPokokByPeriode() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at', NULL);
    $Data = $this->db->get('permasalahan_pokok')->result_array();
    
    header('Content-Type: application/json');
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

public function GetPermasalahanPokokByIds() {
    $Ids = $this->input->post('Ids');
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    
    $this->db->where('TahunMulai', $TahunMulai);
    $this->db->where('TahunAkhir', $TahunAkhir);
    $this->db->where('deleted_at', NULL);
    $this->db->where_in('Id', explode(',', $Ids));
    $Data = $this->db->get('permasalahan_pokok')->result_array();
    
    header('Content-Type: application/json');
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
public function SPM() {
  $Header['Halaman'] = 'Kementerian';
  
  // Query dengan JOIN ke tabel kementerian
  $Data['SPM'] = $this->db->query("
      SELECT s.*, k.NamaKementerian 
      FROM spm s
      LEFT JOIN kementerian k ON s.IdKementerian = k.Id
      WHERE s.deleted_at IS NULL
  ")->result_array();
  
  // Ambil data kementerian untuk dropdown
  $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
  
  // Ambil data periode unik dari kementerian
  $Data['Periode'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir
      FROM kementerian
      WHERE deleted_at IS NULL
      ORDER BY TahunMulai
  ")->result_array();
  
  $this->load->view('Super/header', $Header);
  $this->load->view('Super/SPM', $Data);
}



public function InputSPM() {
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
    
    // Get proyek data with kementerian, program, and location information
    $Data['Proyek'] = $this->db->query("
        SELECT p.*, 
               k.NamaKementerian, 
               ps.NamaProgram,
               COALESCE(p.NamaProvinsi, ps_prov.Nama, '-') AS NamaProvinsi,
               COALESCE(p.NamaKota, ps_kota.Nama, '-') AS NamaKota,
               COALESCE(p.KodeWilayah, ps.KodeWilayah) AS KodeWilayah,
               COALESCE(p.KodeKota, ps.KodeKota) AS KodeKota
        FROM proyek_strategis p
        LEFT JOIN kementerian k ON p.IdKementerian = k.Id
        LEFT JOIN program_strategis ps ON p.IdProgramStrategis = ps.Id
        LEFT JOIN kodewilayah ps_prov ON ps.KodeWilayah = ps_prov.Kode AND LENGTH(ps_prov.Kode) = 2
        LEFT JOIN kodewilayah ps_kota ON ps.KodeKota = ps_kota.Kode
        WHERE p.deleted_at IS NULL
        ORDER BY p.TahunMulai DESC, p.TahunAkhir DESC
    ")->result_array();
    
    // Get provinces for dropdown
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    // Get kementerian for dropdown
    $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get unique periods from kementerian
    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir
        FROM kementerian
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai
    ")->result_array();
    
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/ProyekStrategis', $Data);
}

public function GetProgramByKementerianAndPeriode() {
    $TahunMulai = $this->input->post('TahunMulai');
    $TahunAkhir = $this->input->post('TahunAkhir');
    $IdKementerian = $this->input->post('IdKementerian');
    
    $data = $this->db->query("
        SELECT ps.Id, ps.NamaProgram, 
               COALESCE(kw_prov.Nama, '-') AS NamaProvinsi,
               COALESCE(kw_kota.Nama, '-') AS NamaKota,
               ps.KodeWilayah, ps.KodeKota
        FROM program_strategis ps
        LEFT JOIN kodewilayah kw_prov ON ps.KodeWilayah = kw_prov.Kode AND LENGTH(kw_prov.Kode) = 2
        LEFT JOIN kodewilayah kw_kota ON ps.KodeKota = kw_kota.Kode
        WHERE ps.IdKementerian = ? 
        AND ps.TahunMulai = ? 
        AND ps.TahunAkhir = ? 
        AND ps.deleted_at IS NULL
    ", [$IdKementerian, $TahunMulai, $TahunAkhir])->result_array();
    
    echo json_encode($data);
}



public function InputProyek() {
    // Get program data to include location if not overridden
    $program = $this->db->get_where('program_strategis', ['Id' => $this->input->post('IdProgramStrategis')])->row();
    
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'IdProgramStrategis' => $this->input->post('IdProgramStrategis'),
        'KodeWilayah' => $this->input->post('KodeWilayah') ?: $program->KodeWilayah,
        'KodeKota' => $this->input->post('KodeKota') ?: $program->KodeKota,
        'NamaProvinsi' => $this->input->post('NamaProvinsi') ?: null,
        'NamaKota' => $this->input->post('NamaKota') ?: null,
        'NamaProyek' => $this->input->post('NamaProyek'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'TargetTahun1' => $this->input->post('TargetTahun1'),
        'TargetTahun2' => $this->input->post('TargetTahun2'),
        'TargetTahun3' => $this->input->post('TargetTahun3'),
        'TargetTahun4' => $this->input->post('TargetTahun4'),
        'TargetTahun5' => $this->input->post('TargetTahun5'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('proyek_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateProyek() {
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'IdProgramStrategis' => $this->input->post('IdProgramStrategis'),
        'KodeWilayah' => $this->input->post('KodeWilayah'),
        'KodeKota' => $this->input->post('KodeKota'),
        'NamaProvinsi' => $this->input->post('NamaProvinsi'),
        'NamaKota' => $this->input->post('NamaKota'),
        'NamaProyek' => $this->input->post('NamaProyek'),
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
    $this->db->update('proyek_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteProyek() {
    $data = ['deleted_at' => date('Y-m-d H:i:s')];
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('proyek_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}


public function ProgramStrategis() {
    $Header['Halaman'] = 'Kementerian';
    
    // Get program data with province and kementerian information
    $Data['Program'] = $this->db->query("
    SELECT ps.Id, ps.IdKementerian, ps.NamaProgram, ps.KodeWilayah, ps.KodeKota, 
           ps.TahunMulai, ps.TahunAkhir, ps.TargetTahun1, ps.TargetTahun2, 
           ps.TargetTahun3, ps.TargetTahun4, ps.TargetTahun5,
           k.NamaKementerian, 
           COALESCE(kw_prov.Nama, '-') AS NamaProvinsi,
           COALESCE(kw_kota.Nama, '-') AS NamaKota
    FROM program_strategis ps
    LEFT JOIN kementerian k ON ps.IdKementerian = k.Id
    LEFT JOIN kodewilayah kw_prov ON ps.KodeWilayah = kw_prov.Kode AND LENGTH(kw_prov.Kode) = 2
    LEFT JOIN kodewilayah kw_kota ON ps.KodeKota = kw_kota.Kode
    WHERE ps.deleted_at IS NULL
    ORDER BY ps.TahunMulai DESC, ps.TahunAkhir DESC
")->result_array();
  
    
    // Get provinces for dropdown
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    // Get kementerian for dropdown
    $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get unique periods from kementerian
    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir
        FROM kementerian
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai
    ")->result_array();
    
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/ProgramStrategis', $Data);
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

public function InputProgram() {
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'KodeWilayah' => $this->input->post('KodeWilayah'),
        'KodeKota' => $this->input->post('KodeKota'),
        'NamaProgram' => $this->input->post('NamaProgram'),
        'TahunMulai' => $this->input->post('TahunMulai'),
        'TahunAkhir' => $this->input->post('TahunAkhir'),
        'TargetTahun1' => $this->input->post('TargetTahun1'),
        'TargetTahun2' => $this->input->post('TargetTahun2'),
        'TargetTahun3' => $this->input->post('TargetTahun3'),
        'TargetTahun4' => $this->input->post('TargetTahun4'),
        'TargetTahun5' => $this->input->post('TargetTahun5'),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('program_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Input Data!';
}

public function UpdateProgram() {
    $data = [
        'IdKementerian' => $this->input->post('IdKementerian'),
        'KodeWilayah' => $this->input->post('KodeWilayah'),
        'KodeKota' => $this->input->post('KodeKota'),
        'NamaProgram' => $this->input->post('NamaProgram'),
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
    $this->db->update('program_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}



public function DeleteProgram() {
    $data = ['deleted_at' => date('Y-m-d H:i:s')];
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('program_strategis', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}
    public function PermasalahanPokok() {
      $Header['Halaman'] = 'Isu';
      
      // Query dengan JOIN ke tabel kementerian
      $Data['PermasalahanPokok'] = $this->db->query("
          SELECT p.*, k.NamaKementerian 
          FROM permasalahan_pokok p
          LEFT JOIN kementerian k ON p.IdKementerian = k.Id
          WHERE p.deleted_at IS NULL
      ")->result_array();
      
      // Ambil data kementerian untuk dropdown
      $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
      
      // Ambil data periode unik dari kementerian
      $Data['Periode'] = $this->db->query("
          SELECT DISTINCT TahunMulai, TahunAkhir 
          FROM kementerian 
          WHERE deleted_at IS NULL
          ORDER BY TahunMulai DESC
      ")->result_array();
      
      $this->load->view('Super/header', $Header);
      $this->load->view('Super/PermasalahanPokok', $Data);
  }

  public function InputPermasalahanPokok() {
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
    
    // Query dengan JOIN ke tabel kementerian
    $Data['IsuKLHS'] = $this->db->query("
        SELECT ik.*, k.NamaKementerian 
        FROM isu_klhs ik
        LEFT JOIN kementerian k ON ik.IdKementerian = k.Id
        WHERE ik.deleted_at IS NULL
    ")->result_array();
    
    // Ambil data kementerian untuk dropdown
    $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Ambil data periode unik dari kementerian
    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/IsuKLHS', $Data);
}

public function InputIsuKLHS() {
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
  
  // Query dengan JOIN ke tabel kementerian
  $Data['IsuGlobal'] = $this->db->query("
      SELECT ig.*, k.NamaKementerian 
      FROM isu_global ig
      LEFT JOIN kementerian k ON ig.IdKementerian = k.Id
      WHERE ig.deleted_at IS NULL
  ")->result_array();
  
  // Ambil data kementerian untuk dropdown
  $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
  
  // Ambil data periode unik dari kementerian
  $Data['Periode'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir 
      FROM kementerian 
      WHERE deleted_at IS NULL
      ORDER BY TahunMulai DESC
  ")->result_array();
  
  $this->load->view('Super/header', $Header);
  $this->load->view('Super/IsuGlobal', $Data);
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

public function IsuNasional(): void {
  $Header['Halaman'] = 'Isu';
  
  // Query dengan JOIN ke tabel kementerian
  $Data['IsuNasional'] = $this->db->query("
      SELECT ina.*, k.NamaKementerian 
      FROM isu_nasional ina
      LEFT JOIN kementerian k ON ina.IdKementerian = k.Id
      WHERE ina.deleted_at IS NULL
  ")->result_array();
  
  // Ambil data kementerian untuk dropdown
  $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
  
  // Ambil data periode unik dari kementerian
  $Data['Periode'] = $this->db->query("
      SELECT DISTINCT TahunMulai, TahunAkhir 
      FROM kementerian 
      WHERE deleted_at IS NULL
      ORDER BY TahunMulai DESC
  ")->result_array();
  
  $this->load->view('Super/header', $Header);
  $this->load->view('Super/IsuNasional', $Data);
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

}



