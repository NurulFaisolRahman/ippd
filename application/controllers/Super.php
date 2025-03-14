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
    $Header['Halaman'] = 'VMTS';
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
    $this->load->view('Super/header',$Header);
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
        $Header['Halaman'] = 'Isu';
        $Data['Isu'] = $this->db->select('isu_strategis.*, kementerian.NamaKementerian')
                                ->from('isu_strategis')
                                ->join('kementerian', 'kementerian.Id = isu_strategis.KementerianId')
                                ->get()->result_array();
        $Data['Kementerian'] = $this->db->get('kementerian')->result_array();
        $this->load->view('Super/header', $Header);
        $this->load->view('Super/isu', $Data);
    }

    public function GetIsu($Id) {
        echo json_encode($this->db->get_where('isu_strategis', array('Id' => $Id))->row_array());
    }

    public function InputIsu() {
        $this->db->insert('isu_strategis', $_POST);
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
      $this->db->delete('isu_strategis');
      if ($this->db->affected_rows()) {
          echo '1'; 
      } else {
          echo 'Gagal Menghapus Data!';
      }
  }
}



