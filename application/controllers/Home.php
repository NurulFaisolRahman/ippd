<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		$this->load->view('index');
	}

	public function Login(){  
		$username = htmlentities($_POST['Username']);
		$password = $_POST['Password'];

		// 1. Cek di tabel 'akun' (Level 0, 1, 2, 3)
		$User = $this->db->get_where('akun', array('Username' => $username));
		
		// 2. Jika tidak ada, cek di tabel 'akun_instansi' (Level 4)
		if ($User->num_rows() == 0) {
			$User = $this->db->get_where('akun_instansi', array('nama' => $username));
		}

		if ($User->num_rows() == 0) {
			echo "Username Salah!";
		}
		else {
			$Akun = $User->result_array();
			
			// Cek password (menyesuaikan dengan tabel yang berbeda)
			$pass_db = '';
			if (isset($Akun[0]['Password'])) {
				$pass_db = $Akun[0]['Password'];
			} elseif (isset($Akun[0]['password'])) {
				$pass_db = $Akun[0]['password'];
			}

			if (empty($pass_db)) {
				echo "Konfigurasi database error!";
				return;
			}

			if (password_verify($password, $pass_db)) {
				$level = isset($Akun[0]['Level']) ? $Akun[0]['Level'] : 4; // Default 4 untuk akun_instansi

				// Logika Session berdasarkan Level
				if ($level == '0') {
					$Session = array(
						'isLoggedIn' => true,
						'Admin' => true, 
						'Level' => $level,
						'KodeWilayah' => ''
					);
					$this->session->set_userdata($Session);
					echo $level;
					
				} else if ($level == '1') {
					$Session = array(
						'isLoggedIn' => true,
						'userLevel' => 1,
						'Level' => 1,
						'IdKementerian' => $Akun[0]['IdKementerian'],
						'Username' => $Akun[0]['Username'],
						'KodeWilayah' => ''
					);
					$this->session->set_userdata($Session);
					echo $level;
					
				} else if ($level == '2') {
					$Session = array(
						'isLoggedIn' => true,
						'Admin' => true, 
						'Provinsi' => '', 
						'Level' => $level, 
						'KodeWilayah' => isset($Akun[0]['KodeWilayah']) ? $Akun[0]['KodeWilayah'] : ''
					);
					$this->session->set_userdata($Session);
					echo $level;
					
				} else if ($level == '3') {
					$Session = array(
						'isLoggedIn' => true,
						'Admin' => true, 
						'Level' => $level, 
						'KodeWilayah' => isset($Akun[0]['KodeWilayah']) ? $Akun[0]['KodeWilayah'] : ''
					);
					$this->session->set_userdata($Session);
					echo $level;
					
				} else if ($level == '4' || empty($level)) {
					// Sesi Khusus untuk Instansi (Tabel akun_instansi)
					// Ambil kodewilayah dari tabel akun_instansi
					$kodeWilayah = isset($Akun[0]['kodewilayah']) ? $Akun[0]['kodewilayah'] : 
								  (isset($Akun[0]['KodeWilayah']) ? $Akun[0]['KodeWilayah'] : '');
					
					// Ambil urusan_id jika ada (bisa multiple, dipisah koma)
					$urusanId = isset($Akun[0]['urusan_id']) ? $Akun[0]['urusan_id'] : '';
					
					$Session = array(
						'isLoggedIn' => true,
						'Admin' => true, 
						'Instansi' => true, 
						'Level' => 4, 
						'KodeWilayah' => $kodeWilayah,
						'NamaInstansi' => isset($Akun[0]['nama']) ? $Akun[0]['nama'] : '',
						'IdInstansi' => isset($Akun[0]['id']) ? $Akun[0]['id'] : '',
						'IdKementerian' => isset($Akun[0]['idkementerian']) ? $Akun[0]['idkementerian'] : '',
						'UrusanId' => $urusanId,
						'Username' => $username
					);
					$this->session->set_userdata($Session);
					
					echo '4';
				}
			} else {
				echo "Password Salah!";
			}
		}  
	}
}