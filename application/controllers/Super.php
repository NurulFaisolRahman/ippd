<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

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
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/Akun',$Data);
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
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['Tahapan'] = $this->db->query("SELECT v.*,t.* FROM visirpjpn as v, tahapanrpjpn as t WHERE t._Id = v.Id AND t.deleted_at IS NULL")->result_array();
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
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['Tahapan'] = $this->db->query("SELECT v.*,t.* FROM visirpjmn as v, tahapanrpjmn as t WHERE t._Id = v.Id AND t.deleted_at IS NULL")->result_array();
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
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Tahapan'] = $this->db->query("SELECT v.*,t.*,k.* FROM visirpjpdp as v,tahapanrpjpdp as t, kodewilayah as k WHERE t._Id = v.Id AND t.KodeWilayah = k.Kode AND t.deleted_at IS NULL")->result_array();
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
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['Tahapan'] = $this->db->query("SELECT v.*,t.*,k.* FROM visirpjmdp as v,tahapanrpjmdp as t, kodewilayah as k WHERE t._Id = v.Id AND t.KodeWilayah = k.Kode AND t.deleted_at IS NULL")->result_array();
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

  public function IUPRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['IUP'] = $this->db->query("SELECT v.*,t.* FROM visirpjpn as v, iuprpjpn as t WHERE t._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/IUPRPJPN',$Data);
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
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/IUPRPJMN',$Data);
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

  public function IUPRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['IUP'] = $this->db->query("SELECT v.*,i.*,k.* FROM visirpjpdp as v,iuprpjpdp as i, kodewilayah as k WHERE i._Id = v.Id AND i.KodeWilayah = k.Kode AND i.deleted_at IS NULL")->result_array();
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/IUPRPJPD',$Data);
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
		$this->load->view('Super/header',$Header);
		$this->load->view('Super/IUPRPJMD',$Data);
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

  public function NomenklaturProvinsi() {
    $Header['Halaman'] = 'Nomenklatur';
    $Data['Nomenklatur'] = $this->db->query("SELECT * FROM `nomenklaturprovinsi`")->result_array();
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/NomenklaturProvinsi', $Data);
  }

  public function NomenklaturKabupaten() {
    $Header['Halaman'] = 'Nomenklatur';
    $Data['Nomenklatur'] = $this->db->query("SELECT * FROM `nomenklaturkabupaten`")->result_array();
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/NomenklaturKabupaten', $Data);
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
        
        $this->load->view('Super/header', $Header);
        $this->load->view('Super/SPM', $Data);
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
        
        $this->load->view('Super/header', $Header);
        $this->load->view('Super/ProyekStrategis', $Data);
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



