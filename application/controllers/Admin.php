<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
  }

  public function VisiRPJPD(){
		$Header['Halaman'] = 'RPJPD';
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpd")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/VisiRPJPD',$Data);
	}

  public function InputVisiRPJPD(){  
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
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjpd")->result_array();
    $Data['_Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjpn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjpd as v, misirpjpd as m WHERE m._Id = v.Id AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/MisiRPJPD',$Data);
	}

  public function InputMisiRPJPD(){  
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
    $Data['Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjpd")->result_array();
    $Data['_Tujuan'] = $this->db->where("deleted_at IS NULL")->get("Tujuanrpjpn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.*,m.Misi,t.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/TujuanRPJPD',$Data);
	}

  public function InputTujuanRPJPD(){  
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
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->get("Tujuanrpjpd")->result_array();
    $Data['_Sasaran'] = $this->db->where("deleted_at IS NULL")->get("Sasaranrpjpn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.*,t.Tujuan,s.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t, sasaranrpjpd as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/SasaranRPJPD',$Data);
	}

  public function InputSasaranRPJPD(){  
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
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmd")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/VisiRPJMD',$Data);
	}

  public function InputVisiRPJMD(){  
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
    $Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visirpjmd")->result_array();
    $Data['_Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjmn")->result_array();
		$Data['Misi'] = $this->db->query("SELECT v.*,m.* FROM visirpjmd as v, misirpjmd as m WHERE m._Id = v.Id AND m.deleted_at IS NULL")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/MisiRPJMD',$Data);
	}

  public function InputMisiRPJMD(){  
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
    $Data['Misi'] = $this->db->where("deleted_at IS NULL")->get("misirpjmd")->result_array();
    $Data['_Tujuan'] = $this->db->where("deleted_at IS NULL")->get("tujuanrpjmn")->result_array();
		$Data['Tujuan'] = $this->db->query("SELECT v.*,m.Misi,t.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/TujuanRPJMD',$Data);
	}

  public function InputTujuanRPJMD(){  
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
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->get("Tujuanrpjmd")->result_array();
    $Data['_Sasaran'] = $this->db->where("deleted_at IS NULL")->get("sasaranrpjmn")->result_array();
		$Data['Sasaran'] = $this->db->query("SELECT v.*,t.Tujuan,s.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t, sasaranrpjmd as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/SasaranRPJMD',$Data);
	}

  public function InputSasaranRPJMD(){  
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
    $Header['Halaman'] = 'AkunInstansi';
		$Data['Akun'] = $this->db->query("SELECT * FROM `akun_instansi` WHERE deleted_at IS NULL")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/kelola_instansi',$Data);
  }

	public function AkunInstansi() {
		$Header['Halaman'] = 'AkunInstansi';
		$Data['Akun'] = $this->db->query("SELECT * FROM `akun_instansi` WHERE deleted_at IS NULL")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/kelola_instansi',$Data);
	}
	
	public function InputAkunInstansi(){  
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $this->db->insert('akun_instansi',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditAkunInstansi(){  
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

	public function HapusAkunInstansi(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('id',$_POST['id']); 
		$this->db->update('akun_instansi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }
  
  public function Cascading() {
    $Header['Halaman'] = 'Cascading';
    $Data['Cascading'] = $this->db->where('deleted_at IS NULL')->get('cascading')->result_array();
    $Data['Tujuan'] = $this->db->query('SELECT * FROM `tujuan` WHERE tujuan.deleted_at IS NULL AND tujuan.Id IN (SELECT sasaran.IdTujuan FROM `sasaran`)')->result_array();
    $IdTujuan = $this->db->limit(1)->get('sasaran')->row_array()['IdTujuan'];
    $Data['Sasaran'] = $this->db->where('IdTujuan = ' . $IdTujuan . ' AND deleted_at IS NULL')->get('sasaran')->result_array();
    $Data['Instansi'] = $this->db->get('akun_instansi')->result_array();
    $this->load->view('Admin/header', $Header);
    $this->load->view('Admin/Cascading', $Data);
  }

public function TambahCascading() {
  $data = [
      'IdTujuan' => $this->input->post('Tujuan'), // Simpan ID tujuan
      'IdSasaran' => $this->input->post('Sasaran'), // Simpan ID Sasaran
      'indikator_tujuan' => $this->input->post('indikator_tujuan'),
      'indikator_sasaran' => $this->input->post('indikator_sasaran'),
      'pd_penanggung_jawab' => implode(', ', $this->input->post('pd_penanggung_jawab')),
      'pd_penunjang' => implode(', ', $this->input->post('pd_penunjang')),
  ];
  $this->db->insert('cascading', $data);
  echo $this->db->affected_rows() ? '1' : '0';
}

public function EditCascading() {
  $id = $this->input->post('id');
  $data = [
      'IdTujuan' => $this->input->post('EditTujuan'), // Simpan ID tujuan
      'IdSasaran' => $this->input->post('EditSasaran'), // Simpan ID Sasaran
      'indikator_tujuan' => $this->input->post('indikator_tujuan'),
      'indikator_sasaran' => $this->input->post('indikator_sasaran'),
      'pd_penanggung_jawab' => implode(', ', $this->input->post('pd_penanggung_jawab')),
      'pd_penunjang' => implode(', ', $this->input->post('pd_penunjang')),
  ];
  $this->db->where('id', $id)->update('cascading', $data);
  echo $this->db->affected_rows() ? '1' : '0';
}

public function HapusCascading() {
	$id = $this->input->post('id');
	
	// Soft delete dengan mengupdate kolom deleted_at
	$this->db->where('id', $id)->update('cascading', ['deleted_at' => date('Y-m-d H:i:s')]);
	echo $this->db->affected_rows() ? '1' : '0';
}
}
