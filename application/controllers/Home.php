<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function index(){
		$this->load->view('index');
	}

	// public function GetListKementerian(){
  //   echo json_encode($this->db->where("deleted_at IS NULL")->get("kementerian")->result_array());
	// }

	public function Login(){  
    $username = htmlentities($_POST['Username']);
    $password = $_POST['Password'];

    // 1. Cek di tabel 'akun' (Biasanya Level 0, 1, 2, 3)
    $User = $this->db->get_where('akun', array('Username' => $username));
    
    // 2. Jika tidak ada, cek di tabel 'akun_instansi' (Level 4)
    if ($User->num_rows() == 0) {
        // Pada akun_instansi, kita gunakan kolom 'nama' sebagai username
        $User = $this->db->get_where('akun_instansi', array('nama' => $username));
    }

    if ($User->num_rows() == 0) {
        echo "Username Salah!";
    }
    else {
        $Akun = $User->result_array();
        
        // Cek password (mengantisipasi perbedaan nama kolom P kapital atau kecil)
        $pass_db = isset($Akun[0]['Password']) ? $Akun[0]['Password'] : $Akun[0]['password'];

        if (password_verify($password, $pass_db)) {
            $level = $Akun[0]['Level'];

            // Logika Session berdasarkan Level
            if ($level == '0') {
                $Session = array('Admin' => true, 'Level' => $level);
                $this->session->set_userdata($Session);
                echo $level;
            } else if ($level == '1') {
                $Session = array('Admin' => true, 'Kementerian' => '', 'Level' => $level);
                $this->session->set_userdata($Session);
                echo $level;
            } else if ($level == '2') {
                $Session = array('Admin' => true, 'Provinsi' => '', 'Level' => $level, 'KodeWilayah' => $Akun[0]['KodeWilayah']);
                $this->session->set_userdata($Session);
                echo $level;
            } else if ($level == '3') {
                $Session = array('Admin' => true, 'Level' => $level, 'KodeWilayah' => $Akun[0]['KodeWilayah']);
                $this->session->set_userdata($Session);
                echo $level;
            } else if ($level == '4') {
                // Sesi Khusus untuk Instansi (Tabel akun_instansi)
                $Session = array(
                    'Admin' => true, 
                    'Instansi' => true, 
                    'Level' => $level, 
                    'KodeWilayah' => $Akun[0]['kodewilayah'], // Sesuai gambar: huruf kecil
                    'NamaInstansi' => $Akun[0]['nama']
                );
                $this->session->set_userdata($Session);
                echo $level;
            } 
        } else {
            echo "Password Salah!";
        }
    }   
}
}
