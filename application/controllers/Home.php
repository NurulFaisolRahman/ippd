<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index(){
		$this->load->view('index');
	}

	public function Login(){  
		$username = trim(htmlentities($this->input->post('Username', TRUE)));
		$password = $this->input->post('Password');

		if (empty($username) || empty($password)) {
			echo "Username dan Password wajib diisi!";
			return;
		}

		// 1. Cek di tabel 'akun' (Level 0, 1, 2, 3)
		$userAkun = $this->db
			->where('Username', $username)
			->where('deleted_at IS NULL', null, false)
			->get('akun');
		
		if ($userAkun->num_rows() > 0) {
			$akun = $userAkun->row_array();
			$pass_db = $akun['Password'] ?? $akun['password'] ?? '';
			
			if (password_verify($password, $pass_db)) {
				$level = isset($akun['Level']) ? $akun['Level'] : 0;
				
				if ($level == '0') {
					$Session = array(
						'isLoggedIn' => true,
						'Admin' => true, 
						'Level' => $level,
						'KodeWilayah' => ''
					);
					$this->session->set_userdata($Session);
					echo $level;
					return;
					
				} else if ($level == '1') {
					$Session = array(
						'isLoggedIn' => true,
						'userLevel' => 1,
						'Level' => 1,
						'IdKementerian' => $akun['IdKementerian'] ?? '',
						'Username' => $akun['Username'],
						'KodeWilayah' => ''
					);
					$this->session->set_userdata($Session);
					echo $level;
					return;
					
				} else if ($level == '2') {
					$Session = array(
						'isLoggedIn' => true,
						'Admin' => true, 
						'Provinsi' => '', 
						'Level' => $level, 
						'KodeWilayah' => isset($akun['KodeWilayah']) ? $akun['KodeWilayah'] : ''
					);
					$this->session->set_userdata($Session);
					echo $level;
					return;
					
				} else if ($level == '3') {
					$Session = array(
						'isLoggedIn' => true,
						'Admin' => true, 
						'Level' => $level, 
						'KodeWilayah' => isset($akun['KodeWilayah']) ? $akun['KodeWilayah'] : ''
					);
					$this->session->set_userdata($Session);
					echo $level;
					return;
				}
			}
		}

		// 2. Cek di tabel 'akun_instansi' (Level 4)
		// Bisa berdasarkan 'nama' (nama instansi) atau 'kode_instansi'
		$userInstansi = $this->db
			->group_start()
				->where('nama', $username)
				->or_where('kode_instansi', $username)
			->group_end()
			->where('deleted_at IS NULL', null, false)
			->get('akun_instansi');

		if ($userInstansi->num_rows() > 0) {
			$matchedInstansi = null;
			
			// Karena nama instansi (misal 'Dinas Pendidikan') bisa sama di berbagai daerah/kodewilayah yang berbeda,
			// kita periksa kecocokan password untuk menemukan instansi di daerah yang tepat
			foreach ($userInstansi->result_array() as $instansiRow) {
				$pass_db = $instansiRow['password'] ?? $instansiRow['Password'] ?? '';
				if (!empty($pass_db) && password_verify($password, $pass_db)) {
					$matchedInstansi = $instansiRow;
					break;
				}
			}

			if ($matchedInstansi !== null) {
				$kodeWilayah = isset($matchedInstansi['kodewilayah']) ? $matchedInstansi['kodewilayah'] : 
							  (isset($matchedInstansi['KodeWilayah']) ? $matchedInstansi['KodeWilayah'] : '');
				
				$urusanId = isset($matchedInstansi['urusan_id']) ? $matchedInstansi['urusan_id'] : '';
				
				$Session = array(
					'isLoggedIn'   => true,
					'Admin'        => true, 
					'Instansi'     => true, 
					'Level'        => 4, 
					'KodeWilayah'  => $kodeWilayah,
					'NamaInstansi' => isset($matchedInstansi['nama']) ? $matchedInstansi['nama'] : '',
					'IdInstansi'   => isset($matchedInstansi['id']) ? $matchedInstansi['id'] : '',
					'KodeInstansi' => isset($matchedInstansi['kode_instansi']) ? $matchedInstansi['kode_instansi'] : '',
					'IdKementerian'=> isset($matchedInstansi['idkementerian']) ? $matchedInstansi['idkementerian'] : '',
					'UrusanId'     => $urusanId,
					'Username'     => $username
				);
				$this->session->set_userdata($Session);
				echo '4';
				return;
			} else {
				echo "Password Salah!";
				return;
			}
		}

		if ($userAkun->num_rows() > 0) {
			echo "Password Salah!";
			return;
		}

		echo "Username Salah!";
	}
}