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

	public function Login(){  
    $User = $this->db->get_where('akun', array('Username' => htmlentities($_POST['Username'])));
		if ($User->num_rows() == 0) {
			echo "Username Salah!";
		}
		else {
			$Akun = $User->result_array();
			if (password_verify($_POST['Password'], $Akun[0]['Password'])) {
        // if ($Akun[0]['Level'] == 1) {
          $Session = array('Admin' => true);
          $this->session->set_userdata($Session);
          echo '1';
        // } 
			} else {
				echo "Password Salah!";
			}
		}	
  }
}
