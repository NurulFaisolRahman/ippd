<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Super extends CI_Controller {

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
	public function VMTS(){
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
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
    $this->db->where('is_deleted', FALSE);
    $data['Kementerian'] = $this->db->get('kementerian')->result_array();
    $this->load->view('kementerian', $data);
  }

  public function InputKementerian() {
      $Data = $this->input->post();
      $this->db->insert('kementerian', $Data);
      echo "1";
  }

  public function GetKementerian($Id) {
      $Data = $this->db->get_where('kementerian', ['Id' => $Id])->row_array();
      echo json_encode($Data);
  }

  public function UpdateKementerian() {
      $Data = $this->input->post();
      $this->db->where('Id', $Data['Id']);
      $this->db->update('kementerian', $Data);
      echo "1";
  }
  public function DeleteKementerian($Id) {
    // Pastikan ID diterima
    if (!isset($Id) || empty($Id)) {
        echo "ID tidak valid";
        return;
    }

    // Cek apakah data dengan ID tersebut ada
    $cekData = $this->db->get_where('kementerian', ['Id' => $Id])->row_array();
    if (!$cekData) {
        echo "Data tidak ditemukan";
        return;
    }

    // Lakukan soft delete: Update is_deleted dan deleted_at
    $this->db->set('is_deleted', TRUE); // Tandai data sebagai terhapus
    $this->db->set('deleted_at', date('Y-m-d H:i:s')); // Timestamp saat ini
    $this->db->where('Id', $Id);
    $hapus = $this->db->update('kementerian'); // Update data, bukan delete

    // Berikan respon
    if ($hapus) {
        echo "1"; // Sukses
    } else {
        echo "Gagal menghapus data";
    }
  }

  public function RestoreKementerian() {
    // Ambil data yang di-soft delete (is_deleted = TRUE)
    $this->db->where('is_deleted', TRUE);
    $data['DeletedKementerian'] = $this->db->get('kementerian')->result_array();
    $this->load->view('admin/restore_kementerian', $data);
  }

  public function RestoreKementerianData($Id) {
    // Restore data: Update is_deleted dan deleted_at
    $this->db->set('is_deleted', FALSE); // Kembalikan ke FALSE
    $this->db->set('deleted_at', NULL); // Kembalikan ke NULL
    $this->db->where('Id', $Id);
    $restore = $this->db->update('kementerian');

    // Berikan respon
    if ($restore) {
        echo "1"; // Sukses
    } else {
        echo "Gagal merestore data";
    }
  }

}
