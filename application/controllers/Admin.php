<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
    date_default_timezone_set("Asia/Jakarta");
  }

  public function GetSasaran(){
    $Id = $this->input->post('id');
    echo json_encode($this->db->get_where('sasaran', array('IdTujuan' => $Id))->result_array());
	}

	public function Visi(){
		$Header['Halaman'] = 'RPJPN2025';
		$Data['Visi'] = $this->db->where("deleted_at IS NULL")->get("visi")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/Visi',$Data);
	}

  public function EditVisi(){  
		$this->db->where('Id',$_POST['Id'])->update('visi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
	}

  public function HapusVisi(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('visi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

	public function Misi(){
		$Header['Halaman'] = 'RPJPN2025';
    $Data['Misi'] = $this->db->where("deleted_at IS NULL")->get("misi")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/Misi',$Data);
	}

  public function InputMisi(){  
    $this->db->insert('misi',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditMisi(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('misi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusMisi(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('misi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

	public function Tujuan(){
		$Header['Halaman'] = 'RPJPN2025';
    $Data['Misi'] = $this->db->where("deleted_at IS NULL")->get("misi")->result_array();
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->get("tujuan")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/Tujuan',$Data);
	}

  public function InputTujuan(){  
    $this->db->insert('tujuan',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTujuan(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tujuan', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTujuan(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tujuan', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

	public function Sasaran(){
		$Header['Halaman'] = 'RPJPN2025';
    $Data['Tujuan'] = $this->db->where("deleted_at IS NULL")->get("tujuan")->result_array();
    $Data['Sasaran'] = $this->db->where("deleted_at IS NULL")->get("sasaran")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/Sasaran',$Data);
	}

  public function InputSasaran(){  
    $this->db->insert('sasaran',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditSasaran(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('sasaran', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusSasaran(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('sasaran', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
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
  
  public function Iku() {
    $Header['Halaman'] = 'Cascading';
    $Data['Iku'] = $this->db->where('deleted_at IS NULL')->get('iku')->result_array();
    $Data['Tujuan'] = $this->db->where('deleted_at IS NULL')->get('tujuan')->result_array();
    $this->load->view('Admin/header', $Header);
    $this->load->view('Admin/Iku', $Data);
}

public function TambahIku() {
    $data = [
        'IdTujuan' => $this->input->post('Tujuan'),
        'indikator_tujuan' => $this->input->post('indikator_tujuan'),
        // 'created_at' and 'updated_at' are handled by MySQL
    ];
    $this->db->insert('iku', $data);
    echo $this->db->affected_rows() ? '1' : '0';
}

public function EditIku() {
    $id = $this->input->post('id');
    $data = [
        'IdTujuan' => $this->input->post('EditTujuan'),
        'indikator_tujuan' => $this->input->post('indikator_tujuan'),
        // 'updated_at' is handled by MySQL
    ];
    $this->db->where('id', $id)->update('iku', $data);
    echo $this->db->affected_rows() ? '1' : '0';
}

public function HapusIku() {
    $id = $this->input->post('id');
    $this->db->where('id', $id)->update('iku', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo $this->db->affected_rows() ? '1' : '0';
}

public function Ikd() {
  $Header['Halaman'] = 'Cascading'; // Set to Cascading to keep tab active
  $Data['Ikd'] = $this->db->where('deleted_at IS NULL')->get('ikd')->result_array();
  $Data['Sasaran'] = $this->db->where('deleted_at IS NULL')->get('sasaran')->result_array();
  $Data['Instansi'] = $this->db->where('deleted_at IS NULL')->get('akun_instansi')->result_array();
  $this->load->view('Admin/header', $Header);
  $this->load->view('Admin/Ikd', $Data);
}

public function TambahIkd() {
  $data = [
      'IdSasaran' => $this->input->post('Sasaran'),
      'indikator_sasaran' => $this->input->post('indikator_sasaran'),
      // pd_penanggung_jawab and pd_penunjang will be added later via TambahPd
  ];
  $this->db->insert('ikd', $data);
  echo $this->db->affected_rows() ? '1' : '0';
}

public function EditIkd() {
  $id = $this->input->post('id');
  $data = [
      'IdSasaran' => $this->input->post('EditSasaran'),
      'indikator_sasaran' => $this->input->post('indikator_sasaran'),
  ];
  $this->db->where('id', $id)->update('ikd', $data);
  echo $this->db->affected_rows() ? '1' : '0';
}

public function HapusIkd() {
  $id = $this->input->post('id');
  $this->db->where('id', $id)->update('ikd', ['deleted_at' => date('Y-m-d H:i:s')]);
  echo $this->db->affected_rows() ? '1' : '0';
}

public function TambahPd() {
  $id = $this->input->post('id');
  
  // Fetch the existing record
  $existing = $this->db->where('id', $id)->get('ikd')->row_array();
  
  // Get existing PD values (if any) and split into arrays
  $existingPenanggungJawab = !empty($existing['pd_penanggung_jawab']) ? explode(', ', $existing['pd_penanggung_jawab']) : [];
  $existingPenunjang = !empty($existing['pd_penunjang']) ? explode(', ', $existing['pd_penunjang']) : [];
  
  // Get new selections from the form (single value)
  $newPenanggungJawabInput = $this->input->post('pd_penanggung_jawab');
  $newPenunjangInput = $this->input->post('pd_penunjang');
  
  // Handle PD Penanggung Jawab
  if ($newPenanggungJawabInput && $newPenanggungJawabInput !== '') {
      $newPenanggungJawab = [$newPenanggungJawabInput]; // Treat "Semua Instansi Terkait" as a single value
  } else {
      $newPenanggungJawab = [];
  }
  
  // Handle PD Penunjang
  if ($newPenunjangInput && $newPenunjangInput !== '') {
      $newPenunjang = [$newPenunjangInput]; // Treat "Semua Instansi Terkait" as a single value
  } else {
      $newPenunjang = [];
  }
  
  // Merge existing and new values, avoiding duplicates
  $updatedPenanggungJawab = array_unique(array_merge($existingPenanggungJawab, $newPenanggungJawab));
  $updatedPenunjang = array_unique(array_merge($existingPenunjang, $newPenunjang));
  
  // Prepare data for update
  $data = [
      'pd_penanggung_jawab' => implode(', ', array_filter($updatedPenanggungJawab)), // Remove empty values and join
      'pd_penunjang' => implode(', ', array_filter($updatedPenunjang)), // Remove empty values and join
  ];
  
  // Update the database
  $this->db->where('id', $id)->update('ikd', $data);
  echo $this->db->affected_rows() ? '1' : '0';
}

}
