<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	

	// public function __construct() {
  //       parent::__construct();
  //       $this->load->database(); // Memuat database
  //   }

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	
	public function Visi(){
		$Data['Visi'] = $this->db->get("visi")->result_array();
		$this->load->view('Admin/Visi',$Data);
	}

	public function Misi(){
		$Data['Misi'] = $this->db->get("misi")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/Misi',$Data);
	}

	public function Tujuan(){
		$Data['Tujuan'] = $this->db->get("tujuan")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/Tujuan',$Data);
	}

	public function Sasaran(){
		$Data['Sasaran'] = $this->db->get("sasaran")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/Sasaran',$Data);
	}

	public function GetVMTS($Id){
    echo json_encode($this->db->get_where('vmts', array('Id' => $Id))->row_array());
	}

	public function InputVisi(){  
    $this->db->insert('visi',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditVisi(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('visi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
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

	public function AkunInstansi() {
		$Data['Akun'] = $this->db->query("SELECT * FROM `akun_instansi` WHERE deleted_at IS NULL")->result_array();
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

public function hapus_akun() {
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->update('akun_instansi', ['deleted_at' => date('Y-m-d H:i:s')]);
		echo json_encode(["status" => "success", "message" => "Akun dihapus (soft delete)!"]);
}

public function hapus_permanen() {
		$id = $this->input->post('id');

		// Hapus data secara permanen
		$this->db->where('id', $id);
		$this->db->delete('akun_instansi');
		echo json_encode(["status" => "success", "message" => "Akun dihapus permanen!"]);
}

// Halaman utama restore data
public function restore_page() {
		$this->load->view('templates/header_akun');
		$this->load->view('Akun_Instansi/restoreakun_instansi'); // Halaman khusus restore
}

// Ambil data yang sudah di-soft delete
public function get_deleted_akun() {
		// Hanya ambil data yang sudah dihapus (deleted_at IS NOT NULL)
		$this->db->where('deleted_at IS NOT NULL', NULL, FALSE);
		$query = $this->db->get('akun_instansi');
		echo json_encode($query->result());
}

// Restore data: Set deleted_at kembali ke NULL
public function restore_akun() {
		$id = $this->input->post('id');
		$this->db->where('id', $id);
		$this->db->update('akun_instansi', ['deleted_at' => NULL]);
		echo json_encode(["status" => "success", "message" => "Akun berhasil dipulihkan!"]);
}
}
