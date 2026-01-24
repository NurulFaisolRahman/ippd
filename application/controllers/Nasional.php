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
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
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

  public function MisiRPJPN(){
		$Header['Halaman'] = 'RPJPN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjpn as v, misirpjpn as m WHERE m._Id = v.Id AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/MisiRPJPN',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TujuanRPJPN',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranRPJPN',$Data);
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
		$Data['Tahapan'] = $this->db->query("SELECT v.*,t.* FROM visirpjmn as v, tahapanrpjmn as t WHERE t._Id = v.Id AND t.deleted_at IS NULL")->result_array();
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

  public function SubTahapanRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['SubTahapan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.*,s.* FROM visirpjmn as v, tahapanrpjmn as t, subtahapanrpjmn as s WHERE s._Id = t.Id AND t._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SubTahapanRPJMN',$Data);
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

  public function SasaranPrioritasRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['SasaranPrioritasRPJMN'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.*,s.* FROM visirpjmn as v, prioritas_nasional_rpjmn as t, sasaran_prioritas_rpjmn as s WHERE s._Id = t.Id AND t._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranPrioritasRPJMN',$Data);
	}

  public function InputSasaranPrioritasRPJMN(){  
    $this->db->insert('sasaran_prioritas_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaranPrioritasRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaran_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaranPrioritasRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaran_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function PembangunanTahapanRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['Pembangunan'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.SubTahapan,t.Id as IdSubTahapan,s.* FROM visirpjmn as v, Tahapanrpjmn as m, subtahapanrpjmn as t, pembangunantahapanrpjmn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/PembangunanTahapanRPJMN',$Data);
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

  public function IndikatorSasaranPrioritasRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['IndikatorSasaranPrioritasRPJMN'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,t.SasaranPrioritasRPJMN,t.Id as IdSasaranPrioritasRPJMN,s.* FROM visirpjmn as v, prioritas_nasional_rpjmn as m, sasaran_prioritas_rpjmn as t, indikator_sasaran_prioritas_rpjmn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/IndikatorSasaranPrioritasRPJMN',$Data);
	}

  public function InputIndikatorSasaranPrioritasRPJMN(){  
    $this->db->insert('indikator_sasaran_prioritas_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIndikatorSasaranPrioritasRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('indikator_sasaran_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIndikatorSasaranPrioritasRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('indikator_sasaran_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function IndikatorSasaranProgramRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['IndikatorSasaranProgramRPJMN'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,m.Sasaran,s.* FROM visirpjmn as v, program_prioritas_rpjmn as m, indikator_sasaran_program_rpjmn as s WHERE s._Id = m.Id AND m.Id_ = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/IndikatorSasaranProgramRPJMN',$Data);
	}

  public function InputIndikatorSasaranProgramRPJMN(){  
    $this->db->insert('indikator_sasaran_program_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIndikatorSasaranProgramRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('indikator_sasaran_program_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIndikatorSasaranProgramRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('indikator_sasaran_program_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function IndikatorSasaranKegiatanRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['IndikatorSasaranKegiatanRPJMN'] = $this->db->query("SELECT v.Id as IdVisi,v.TahunMulai,v.TahunAkhir,m.Sasaran,s.* FROM visirpjmn as v, kegiatan_prioritas_rpjmn as m, indikator_sasaran_kegiatan_rpjmn as s WHERE s._Id = m.Id AND m.Id_ = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/IndikatorSasaranKegiatanRPJMN',$Data);
	}

  public function InputIndikatorSasaranKegiatanRPJMN(){  
    $this->db->insert('indikator_sasaran_kegiatan_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditIndikatorSasaranKegiatanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('indikator_sasaran_kegiatan_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusIndikatorSasaranKegiatanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('indikator_sasaran_kegiatan_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function VisiRPJMN(){
		$Header['Halaman'] = 'RPJMN';
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
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

  public function MisiRPJMN(){
		$Header['Halaman'] = 'RPJMN';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjmn as v, misirpjmn as m WHERE m._Id = v.Id AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/MisiRPJMN',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TujuanRPJMN',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranRPJMN',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/VisiRPJPD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/MisiRPJPD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TujuanRPJPD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranRPJPD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TahapanRPJPD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/VisiRPJMD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/MisiRPJMD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TujuanRPJMD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/SasaranRPJMD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/TahapanRPJMD',$Data);
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

  public function IUPRPJPD(){
		$Header['Halaman'] = 'RPJPD';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
    $Data['IUP'] = $this->db->query("SELECT v.*,i.*,k.* FROM visirpjpdp as v,iuprpjpdp as i, kodewilayah as k WHERE i._Id = v.Id AND i.KodeWilayah = k.Kode AND i.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/IUPRPJPD',$Data);
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
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/IUPRPJMD',$Data);
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
    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/NomenklaturProvinsi', $Data);
  }

  public function NomenklaturKabupaten() {
    $Header['Halaman'] = 'Nomenklatur';
    $Data['Nomenklatur'] = $this->db->query("SELECT * FROM `nomenklaturkabupaten`")->result_array();
    $this->load->view('Nasional/header', $Header);
    $this->load->view('Nasional/NomenklaturKabupaten', $Data);
  }

  public function PrioritasNasionalRPJMN(){
		$Header['Halaman'] = 'RKP';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['PrioritasNasional'] = $this->db->query("SELECT v.*,p.* FROM visirpjmn as v, prioritas_nasional_rpjmn as p WHERE p._Id = v.Id AND p.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/PrioritasNasionalRPJMN',$Data);
	}

  public function InputPrioritasNasionalRPJMN(){  
    $this->db->insert('prioritas_nasional_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditPrioritasNasionalRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('prioritas_nasional_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusPrioritasNasionalRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('prioritas_nasional_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function ProgramPrioritasRPJMN(){
		$Header['Halaman'] = 'RKP';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['ProgramPrioritas'] = $this->db->query("SELECT v.*,p.* FROM visirpjmn as v, prioritas_nasional_rpjmn as n, program_prioritas_rpjmn as p WHERE p._Id = n.Id AND n._Id = v.Id AND p.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/ProgramPrioritasRPJMN',$Data);
	}

  public function InputProgramPrioritasRPJMN(){  
    $this->db->insert('program_prioritas_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditProgramPrioritasRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('program_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusProgramPrioritasRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('program_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function KegiatanPrioritasRPJMN(){
		$Header['Halaman'] = 'RKP';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['KegiatanPrioritas'] = $this->db->query("SELECT v.*,p.* FROM visirpjmn as v, kegiatan_prioritas_rpjmn as p WHERE p.Id_ = v.Id AND p.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/KegiatanPrioritasRPJMN',$Data);
	}

  public function InputKegiatanPrioritasRPJMN(){  
    $this->db->insert('kegiatan_prioritas_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditKegiatanPrioritasRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('kegiatan_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusKegiatanPrioritasRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('kegiatan_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function ProyekPrioritasRPJMN(){
		$Header['Halaman'] = 'RKP';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['ProyekPrioritas'] = $this->db->query("SELECT v.*,m.KegiatanPrioritas,p.* FROM visirpjmn as v, kegiatan_prioritas_rpjmn as m, proyek_prioritas_rpjmn as p WHERE p._Id = m.Id AND p.Id_ = v.Id AND p.deleted_at IS NULL")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/ProyekPrioritasRPJMN',$Data);
	}

  public function InputProyekPrioritasRPJMN(){  
    $this->db->insert('proyek_prioritas_rpjmn',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditProyekPrioritasRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('proyek_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusProyekPrioritasRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('proyek_prioritas_rpjmn', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function SasaranPembangunanRPJMN(){
		$Header['Halaman'] = 'RKP';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
		$Data['SasaranPembangunan'] = $this->db->query("SELECT v.*,p.* FROM visirpjmn as v, sasaran_pembangunan_rpjmn as p WHERE p._Id = v.Id AND p.deleted_at IS NULL ORDER BY p.Id DESC")->result_array();
    $Data['IndikatorPembangunan'] = $this->db->query("SELECT t.*,s.* FROM sasaran_pembangunan_rpjmn as t, indikator_pembangunan_rpjmn as s WHERE s._Id = t.Id AND s.deleted_at IS NULL ORDER BY s.Id ASC")->result_array();
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

  public function PembangunanKawasanRPJMN(){
		$Header['Halaman'] = 'RKP';
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmn")->result_array();
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();
		$Data['WilayahKawasan'] = $this->db->query("SELECT v.*,p.*,k.* FROM visirpjmn as v, wilayah_kawasan as p, kodewilayah as k WHERE p._Id = v.Id AND p.Provinsi=k.Kode AND p.deleted_at IS NULL ORDER BY p.Id DESC")->result_array();
    $Data['NamaKawasan'] = $this->db->query("SELECT t.*,s.*,k.* FROM wilayah_kawasan as t, pembangunan_kawasan as s, kodewilayah as k WHERE s._Id = t.Id AND t.Provinsi=k.Kode AND s.deleted_at IS NULL ORDER BY s.Id ASC")->result_array();
		$this->load->view('Nasional/header',$Header);
		$this->load->view('Nasional/PembangunanKawasanRPJMN',$Data);
	}

  public function InputKawasanProvinsiRPJMN(){  
    $this->db->insert('wilayah_kawasan',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditKawasanProvinsiRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('wilayah_kawasan', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusKawasanProvinsiRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('wilayah_kawasan', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function InputNamaKawasanRPJMN(){  
    $this->db->insert('pembangunan_kawasan',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditNamaKawasanRPJMN(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('pembangunan_kawasan', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusNamaKawasanRPJMN(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('pembangunan_kawasan', $_POST);
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
}



