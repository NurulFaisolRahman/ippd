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

  
    public function IsuStrategis() {
    $Header['Halaman'] = 'Isu';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Query IsuStrategis with filters
    $this->db->select("
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
    ");
    $this->db->from('isu_strategis ist');
    $this->db->join('kementerian k', 'ist.IdKementerian = k.Id', 'left');
    $this->db->where('ist.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('ist.TahunMulai', $tahunMulai);
        $this->db->where('ist.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('ist.IdKementerian', $kementerianFilter);
    }
    
    $this->db->group_by('ist.Id');
    $this->db->order_by('ist.TahunMulai DESC, ist.TahunAkhir DESC');
    
    $Data['IsuStrategis'] = $this->db->get()->result_array();
    
    // Get all unique periods from all related tables
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir FROM kementerian WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM isu_strategis WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM permasalahan_pokok WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM isu_klhs WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM isu_global WHERE deleted_at IS NULL
        UNION
        SELECT DISTINCT TahunMulai, TahunAkhir FROM isu_nasional WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC, TahunAkhir DESC
    ")->result_array();
    
    // Get periods for input form (distinct from isu_strategis only)
    $Data['Periode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM isu_strategis 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC, TahunAkhir DESC
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
        // Fetch all ministries if no period is selected
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'deleted_at' => NULL
        ])->result_array();
    }
    
    // Store current filters
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
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


   
   
   public function PermasalahanPokok() {
    $Header['Halaman'] = 'Isu';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Main query with filters
    $this->db->select('pp.*, k.NamaKementerian');
    $this->db->from('permasalahan_pokok pp');
    $this->db->join('kementerian k', 'pp.IdKementerian = k.Id', 'left');
    $this->db->where('pp.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('pp.TahunMulai', $tahunMulai);
        $this->db->where('pp.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('pp.IdKementerian', $kementerianFilter);
    }
    
    $Data['PermasalahanPokok'] = $this->db->get()->result_array();
    
    // Get all unique periods for dropdowns
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    // Get all kementerian for input modal
    $Data['AllKementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get kementerian based on selected periode for filter
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'TahunMulai' => $tahunMulai,
            'TahunAkhir' => $tahunAkhir,
            'deleted_at' => NULL
        ])->result_array();
    } else {
        $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    }
    
    // Save current filter state
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/PermasalahanPokok', $Data);
}

public function InputPermasalahanPokok() {
    if (!$this->input->post('IdKementerian') || !$this->input->post('TahunMulai') || !$this->input->post('TahunAkhir')) {
        echo 'Periode dan Kementerian harus dipilih di filter!';
        return;
    }

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
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Main query with filters
    $this->db->select('ik.*, k.NamaKementerian');
    $this->db->from('isu_klhs ik');
    $this->db->join('kementerian k', 'ik.IdKementerian = k.Id', 'left');
    $this->db->where('ik.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('ik.TahunMulai', $tahunMulai);
        $this->db->where('ik.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('ik.IdKementerian', $kementerianFilter);
    }
    
    $Data['IsuKLHS'] = $this->db->get()->result_array();
    
    // Get all unique periods for dropdowns
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    // Get all kementerian for input modal
    $Data['AllKementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get kementerian based on selected periode for filter
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
    
    // Save current filter state
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
    $this->load->view('Super/header', $Header);
    $this->load->view('Super/IsuKLHS', $Data);
}

public function InputIsuKLHS() {
    if (!$this->input->post('IdKementerian') || !$this->input->post('TahunMulai') || !$this->input->post('TahunAkhir')) {
        echo 'Periode dan Kementerian harus dipilih di filter!';
        return;
    }

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
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Main query with filters
    $this->db->select('ig.*, k.NamaKementerian');
    $this->db->from('isu_global ig');
    $this->db->join('kementerian k', 'ig.IdKementerian = k.Id', 'left');
    $this->db->where('ig.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('ig.TahunMulai', $tahunMulai);
        $this->db->where('ig.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('ig.IdKementerian', $kementerianFilter);
    }
    
    $Data['IsuGlobal'] = $this->db->get()->result_array();
    
    // Get all unique periods for dropdowns
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    // Get all kementerian for input modal
    $Data['AllKementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get kementerian based on selected periode for filter
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'TahunMulai' => $tahunMulai,
            'TahunAkhir' => $tahunAkhir,
            'deleted_at' => NULL
        ])->result_array();
    } else {
        $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    }
    
    // Save current filter state
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
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

public function IsuNasional() {
    $Header['Halaman'] = 'Isu';
    
    // Get filter parameters
    $periodeFilter = $this->input->get('periode');
    $kementerianFilter = $this->input->get('kementerian');
    
    // Main query with filters
    $this->db->select('in.*, k.NamaKementerian');
    $this->db->from('isu_nasional in');
    $this->db->join('kementerian k', 'in.IdKementerian = k.Id', 'left');
    $this->db->where('in.deleted_at IS NULL');
    
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $this->db->where('in.TahunMulai', $tahunMulai);
        $this->db->where('in.TahunAkhir', $tahunAkhir);
    }
    
    if ($kementerianFilter) {
        $this->db->where('in.IdKementerian', $kementerianFilter);
    }
    
    $Data['IsuNasional'] = $this->db->get()->result_array();
    
    // Get all unique periods for dropdowns
    $Data['AllPeriode'] = $this->db->query("
        SELECT DISTINCT TahunMulai, TahunAkhir 
        FROM kementerian 
        WHERE deleted_at IS NULL
        ORDER BY TahunMulai DESC
    ")->result_array();
    
    // Get all kementerian for input modal
    $Data['AllKementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    
    // Get kementerian based on selected periode for filter
    if ($periodeFilter) {
        list($tahunMulai, $tahunAkhir) = explode('|', $periodeFilter);
        $Data['Kementerian'] = $this->db->get_where('kementerian', [
            'TahunMulai' => $tahunMulai,
            'TahunAkhir' => $tahunAkhir,
            'deleted_at' => NULL
        ])->result_array();
    } else {
        $Data['Kementerian'] = $this->db->get_where('kementerian', ['deleted_at' => NULL])->result_array();
    }
    
    // Save current filter state
    $Data['CurrentPeriode'] = $periodeFilter;
    $Data['CurrentKementerian'] = $kementerianFilter;
    
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



