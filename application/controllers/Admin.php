<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	

	public function __construct() {
		parent::__construct();
		date_default_timezone_set("Asia/Jakarta");
  //       $this->load->database(); // Memuat database
    }

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
		$Header['Halaman'] = 'RPJPN2025';
		$Data['Visi'] = $this->db->get("visi")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/Visi',$Data);
	}

	public function Misi(){
		$Header['Halaman'] = 'RPJPN2025';
		$Data['Misi'] = $this->db->get("misi")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/Misi',$Data);
	}

	public function Tujuan(){
		$Header['Halaman'] = 'RPJPN2025';
		$Data['Tujuan'] = $this->db->get("tujuan")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/header',$Header);
		$this->load->view('Admin/Tujuan',$Data);
	}

	public function Sasaran(){
		$Header['Halaman'] = 'RPJPN2025';
		$Data['Sasaran'] = $this->db->get("sasaran")->result_array();
		$Data['VMTS'] = $this->db->get("vmts")->result_array();
		$this->load->view('Admin/header',$Header);
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
    
    // Ambil data cascading dengan join ke tabel misi
    $Data['Cascading'] = $this->db->select('cascading.*, misi.Misi, misi.tahun') // Tambahkan kolom tahun
                                  ->from('cascading')
                                  ->join('misi', 'misi.Misi = cascading.misi') // Sesuaikan dengan kolom yang baru
                                  ->get()->result_array();
    
    // Ambil data instansi dan misi
    $Data['Instansi'] = $this->db->get('akun_instansi')->result_array();
    $Data['Misi'] = $this->db->get('misi')->result_array(); // Ambil data misi dari database
    
    // Load view
    $this->load->view('Admin/header', $Header);
    $this->load->view('Admin/Cascading', $Data);
}

public function TambahCascading() {
    // Ambil tahun dari tabel misi berdasarkan misi yang dipilih
    $misi = $this->input->post('misi');
    $tahun = $this->db->select('tahun')
                       ->from('misi')
                       ->where('Misi', $misi)
                       ->get()
                       ->row_array()['tahun'];

    // Simpan data cascading dengan nama misi dan tahun
    $data = [
        'misi' => $misi, // Simpan nama misi
        'tahun' => $tahun, // Simpan tahun
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

    // Ambil tahun dari tabel misi berdasarkan misi yang dipilih
    $misi = $this->input->post('misi');
    $tahun = $this->db->select('tahun')
                       ->from('misi')
                       ->where('Misi', $misi)
                       ->get()
                       ->row_array()['tahun'];

    // Update data cascading dengan nama misi dan tahun
    $data = [
        'misi' => $misi, // Simpan nama misi
        'tahun' => $tahun, // Simpan tahun
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
