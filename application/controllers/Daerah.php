<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daerah extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
    // if (!isset($_SESSION['KodeWilayah'])) {
    //   redirect(base_url());
    // }
    date_default_timezone_set("Asia/Jakarta");
  }

public function SetTempKodeWilayah() {
		if (!$this->input->is_ajax_request()) {
			show_404();
			return;
		}
		$kodeWilayah = $this->input->post('KodeWilayah', TRUE);
		if ($kodeWilayah && $this->db->where('Kode', $kodeWilayah)->get('kodewilayah')->num_rows() > 0) {
			$this->session->set_userdata('TempKodeWilayah', $kodeWilayah);
			echo '1';
		} else {
			echo 'Kode Wilayah tidak valid';
		}
	}

  public function GetVisiRPJPDP(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjpdp as v, misirpjpdp as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetVisiRPJPN(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjpn as v, misirpjpn as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetVisiRPJPD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjpd")->result_array());
	}

  public function GetListProvinsi() {
        echo json_encode($this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array());
    }

    // Fungsi untuk mendapatkan daftar kabupaten/kota berdasarkan kode provinsi
    public function GetListKabKota() {
        $kode_provinsi = $this->input->post('Kode', TRUE);
        echo json_encode($this->db->where("Kode LIKE '$kode_provinsi.__'")
                                ->where('LENGTH(REPLACE(Kode, ".", "")) = 4')
                                ->order_by('Nama')
                                ->get('kodewilayah')
                                ->result_array());
    }

    public function VisiRPJPD() {
		$Header['Halaman'] = 'RPJPD';
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

		// Tentukan KodeWilayah
		$KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
					   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : $this->input->get('KodeWilayah', TRUE));

		log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

		// Simpan KodeWilayah ke sesi sementara jika belum login
		if (!isset($_SESSION['KodeWilayah']) && $KodeWilayah) {
			$this->session->set_userdata('TempKodeWilayah', $KodeWilayah);
		}

		if ($KodeWilayah) {
			$wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
			if ($wilayah) {
				$Data['KodeWilayah'] = $KodeWilayah;
				$Data['Visi'] = $this->db->select('v.*, k.Nama')
					->from('visirpjpd v')
					->join('kodewilayah k', 'v.KodeWilayah = k.Kode', 'left')
					->where('v.KodeWilayah', $KodeWilayah)
					->where('v.deleted_at IS NULL')
					->get()->result_array();
			} else {
				$Data['KodeWilayah'] = '';
				$Data['Visi'] = [];
				log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
			}
		} else {
			$Data['KodeWilayah'] = '';
			$Data['Visi'] = [];
		}

		$this->load->view('Daerah/header', $Header);
		$this->load->view('Daerah/VisiRPJPD', $Data);
	}

  public function InputVisiRPJPD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('visirpjpd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
		public function EditVisiRPJPD() {
		try {
			// Validate input
			if (empty($_POST['Id']) || !is_numeric($_POST['Id'])) {
				throw new Exception('ID tidak valid');
			}
			if (empty($_POST['Visi'])) {
				throw new Exception('Visi harus diisi');
			}
			if (empty($_POST['TahunMulai']) || !is_numeric($_POST['TahunMulai']) || strlen($_POST['TahunMulai']) != 4) {
				throw new Exception('Tahun Mulai tidak valid');
			}
			if (empty($_POST['TahunAkhir']) || !is_numeric($_POST['TahunAkhir']) || strlen($_POST['TahunAkhir']) != 4) {
				throw new Exception('Tahun Akhir tidak valid');
			}

			// Check if record exists
			$existing = $this->db->where('Id', $_POST['Id'])
								 ->where('KodeWilayah', $_SESSION['KodeWilayah'])
								 ->where('deleted_at IS NULL')
								 ->get('visirpjpd')
								 ->row_array();
			if (!$existing) {
				throw new Exception('Data Visi tidak ditemukan');
			}

			// Prepare update data
			$data = [
				'Visi' => $this->input->post('Visi', TRUE),
				'TahunMulai' => $this->input->post('TahunMulai', TRUE),
				'TahunAkhir' => $this->input->post('TahunAkhir', TRUE),
				'KodeWilayah' => $_SESSION['KodeWilayah'],
				'updated_at' => date('Y-m-d H:i:s')
			];

			$this->db->where('Id', $_POST['Id']);
			$this->db->update('visirpjpd', $data);

			echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
		} catch (Exception $e) {
			log_message('error', 'Error editing Visi RPJPD: ' . $e->getMessage());
			echo $e->getMessage();
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

  public function GetMisiRPJPDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpdp")->result_array());
	}

  public function GetMisiRPJPN(){
    echo json_encode($this->db->query("SELECT v.*,m.* FROM visirpjpn as v, misirpjpn as m WHERE m._Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeMisiRPJPD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpd")->result_array());
	}

  public function GetMisiRPJPD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjpd")->result_array());
	}

  public function MisiRPJPD() {
    $Header['Halaman'] = 'RPJPD';
    // Ambil data provinsi
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

    // Tentukan KodeWilayah
    $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

    log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

    if ($KodeWilayah) {
        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        if ($wilayah) {
            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['NamaWilayah'] = $wilayah['Nama'];
            $Data['VisiRPJPDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                ->where('deleted_at IS NULL')
                ->get('visirpjpdp')->result_array();
            $Data['VisiRPJPN'] = $this->db->where('deleted_at IS NULL')
                ->get('visirpjpn')->result_array();
            $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('visirpjpd')->result_array();
            $Data['Misi'] = $this->db->select('v.*, m.*')
                ->from('visirpjpd v')
                ->join('misirpjpd m', 'm._Id = v.Id')
                ->where('m.KodeWilayah', $KodeWilayah)
                ->where('m.deleted_at IS NULL')
                ->get()->result_array();
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['VisiRPJPDP'] = [];
            $Data['VisiRPJPN'] = [];
            $Data['Visi'] = [];
            $Data['Misi'] = [];
            log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
        }
    } else {
        $Data['KodeWilayah'] = '';
        $Data['NamaWilayah'] = '';
        $Data['VisiRPJPDP'] = [];
        $Data['VisiRPJPN'] = [];
        $Data['Visi'] = [];
        $Data['Misi'] = [];
    }

    // Debugging: Log jumlah provinsi
    log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));

    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/MisiRPJPD', $Data);
}

  public function InputMisiRPJPD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
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

  public function GetTujuanRPJPDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("tujuanrpjpdp")->result_array());
	}

  public function GetTujuanRPJPN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, misirpjpn as m, tujuanrpjpn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeTujuanRPJPD(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function GetTujuanRPJPD(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function TujuanRPJPD() {
		$Header['Halaman'] = 'RPJPD';

    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

		$KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
					   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

		log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

		if ($KodeWilayah) {
			$wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
			if ($wilayah) {
				$Data['KodeWilayah'] = $KodeWilayah;
				$Data['NamaWilayah'] = $wilayah['Nama'];
				$Data['VisiRPJPDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
					->where('deleted_at IS NULL')
					->get('visirpjpdp')->result_array();
				$Data['VisiRPJPN'] = $this->db->where('deleted_at IS NULL')
					->get('visirpjpn')->result_array();
				$Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
					->where('deleted_at IS NULL')
					->get('visirpjpd')->result_array();
				$Data['Tujuan'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, m.Id as IdMisi, m.Misi, t.*')
					->from('visirpjpd v')
					->join('misirpjpd m', 'm._Id = v.Id')
					->join('tujuanrpjpd t', 't._Id = m.Id')
					->where('t.KodeWilayah', $KodeWilayah)
					->where('t.deleted_at IS NULL')
					->get()->result_array();
			} else {
				$Data['KodeWilayah'] = '';
				$Data['NamaWilayah'] = '';
				$Data['VisiRPJPDP'] = [];
				$Data['VisiRPJPN'] = [];
				$Data['Visi'] = [];
				$Data['Tujuan'] = [];
				log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
			}
		} else {
			$Data['KodeWilayah'] = '';
			$Data['NamaWilayah'] = '';
			$Data['VisiRPJPDP'] = [];
			$Data['VisiRPJPN'] = [];
			$Data['Visi'] = [];
			$Data['Tujuan'] = [];
		}

    log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));

		$this->load->view('Daerah/header', $Header);
		$this->load->view('Daerah/TujuanRPJPD', $Data);
	}

  public function InputTujuanRPJPD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
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

  public function GetSasaranRPJPDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("sasaranrpjpdp")->result_array());
	}

  public function GetSasaranRPJPN(){
    echo json_encode($this->db->query("SELECT s.* FROM visirpjpn as v, misirpjpn as m, tujuanrpjpn as t, sasaranrpjpn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeSasaranRPJPD(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function GetSasaranRPJPD(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjpd as v, misirpjpd as m, tujuanrpjpd as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function SasaranRPJPD() {
		$Header['Halaman'] = 'RPJPD';

    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array(); 

		$KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
					   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

		log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

		if ($KodeWilayah) {
			$wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
			if ($wilayah) {
				$Data['KodeWilayah'] = $KodeWilayah;
				$Data['NamaWilayah'] = $wilayah['Nama'];
				$Data['VisiRPJPDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
					->where('deleted_at IS NULL')
					->get('visirpjpdp')->result_array();
				$Data['VisiRPJPN'] = $this->db->where('deleted_at IS NULL')
					->get('visirpjpn')->result_array();
				$Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
					->where('deleted_at IS NULL')
					->get('visirpjpd')->result_array();
				$Data['Sasaran'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, t.Id as IdTujuan, t.Tujuan, s.*')
					->from('visirpjpd v')
					->join('misirpjpd m', 'm._Id = v.Id')
					->join('tujuanrpjpd t', 't._Id = m.Id')
					->join('sasaranrpjpd s', 's._Id = t.Id')
					->where('s.KodeWilayah', $KodeWilayah)
					->where('s.deleted_at IS NULL')
					->get()->result_array();
			} else {
				$Data['KodeWilayah'] = '';
				$Data['NamaWilayah'] = '';
				$Data['VisiRPJPDP'] = [];
				$Data['VisiRPJPN'] = [];
				$Data['Visi'] = [];
				$Data['Sasaran'] = [];
				log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
			}
		} else {
			$Data['KodeWilayah'] = '';
			$Data['NamaWilayah'] = '';
			$Data['VisiRPJPDP'] = [];
			$Data['VisiRPJPN'] = [];
			$Data['Visi'] = [];
			$Data['Sasaran'] = [];
		}

    log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));

		$this->load->view('Daerah/header', $Header);
		$this->load->view('Daerah/SasaranRPJPD', $Data);
	}

  public function InputSasaranRPJPD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
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

  public function TahapanRPJPD() {
		$Header['Halaman'] = 'RPJPD';

    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array(); 

		$KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
					   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

		log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

		if ($KodeWilayah) {
			$wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
			if ($wilayah) {
				$Data['KodeWilayah'] = $KodeWilayah;
				$Data['NamaWilayah'] = $wilayah['Nama'];
				$Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
					->where('deleted_at IS NULL')
					->get('visirpjpd')->result_array();
				$Data['Tahapan'] = $this->db->select('v.*, t.*')
					->from('visirpjpd v')
					->join('tahapanrpjpd t', 't._Id = v.Id')
					->where('t.KodeWilayah', $KodeWilayah)
					->where('t.deleted_at IS NULL')
					->get()->result_array();
			} else {
				$Data['KodeWilayah'] = '';
				$Data['NamaWilayah'] = '';
				$Data['Visi'] = [];
				$Data['Tahapan'] = [];
				log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
			}
		} else {
			$Data['KodeWilayah'] = '';
			$Data['NamaWilayah'] = '';
			$Data['Visi'] = [];
			$Data['Tahapan'] = [];
		}

     log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));

		$this->load->view('Daerah/header', $Header);
		$this->load->view('Daerah/TahapanRPJPD', $Data);
	}

  public function InputTahapanRPJPD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('tahapanrpjpd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJPD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjpd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTahapanRPJPD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjpd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function GetVisiRPJMDP(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjmdp as v, misirpjmdp as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetVisiRPJMN(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi,m.* FROM visirpjmn as v, misirpjmn as m WHERE m.Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetVisiRPJMD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("visirpjmd")->result_array());
	}

  public function VisiRPJMD() {
        $Header['Halaman'] = 'RPJMD';
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                       (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

        log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

        if ($KodeWilayah) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            if ($wilayah) {
                $Data['KodeWilayah'] = $KodeWilayah;
                $Data['NamaWilayah'] = $wilayah['Nama'];
                $Data['Visi'] = $this->db->select('v.*, k.Nama')
                    ->from('visirpjmd v')
                    ->join('kodewilayah k', 'v.KodeWilayah = k.Kode', 'left')
                    ->where('v.KodeWilayah', $KodeWilayah)
                    ->where('v.deleted_at IS NULL')
                    ->get()->result_array();
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['Visi'] = [];
                log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
            }
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['Visi'] = [];
        }

        log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/VisiRPJMD', $Data);
    }

  public function InputVisiRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
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

  public function GetMisiRPJMDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmdp")->result_array());
	}

  public function GetMisiRPJMN(){
    echo json_encode($this->db->query("SELECT v.*,m.* FROM visirpjmn as v, misirpjmn as m WHERE m._Id = ".$_POST['Id']." AND m.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeMisiRPJMD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmd")->result_array());
	}

  public function GetMisiRPJMD(){
    echo json_encode($this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("misirpjmd")->result_array());
	}

 public function MisiRPJMD() {
        $Header['Halaman'] = 'RPJMD';
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                       (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

        log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

        if ($KodeWilayah) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            if ($wilayah) {
                $Data['KodeWilayah'] = $KodeWilayah;
                $Data['NamaWilayah'] = $wilayah['Nama'];
                $Data['VisiRPJMDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmdp')->result_array();
                $Data['VisiRPJMN'] = $this->db->where('deleted_at IS NULL')
                    ->get('visirpjmn')->result_array();
                $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmd')->result_array();
                $Data['Misi'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, m.*')
                    ->from('visirpjmd v')
                    ->join('misirpjmd m', 'm._Id = v.Id')
                    ->where('m.KodeWilayah', $KodeWilayah)
                    ->where('m.deleted_at IS NULL')
                    ->get()->result_array();
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['VisiRPJMDP'] = [];
                $Data['VisiRPJMN'] = [];
                $Data['Visi'] = [];
                $Data['Misi'] = [];
                log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
            }
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['VisiRPJMDP'] = [];
            $Data['VisiRPJMN'] = [];
            $Data['Visi'] = [];
            $Data['Misi'] = [];
        }

        log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/MisiRPJMD', $Data);
    }

  public function InputMisiRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
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

  public function GetTujuanRPJMDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("tujuanrpjmdp")->result_array());
	}

  public function GetTujuanRPJMN(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeTujuanRPJMD(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function GetTujuanRPJMD(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

public function TujuanRPJMD() {
        $Header['Halaman'] = 'RPJMD';
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                       (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

        log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

        if ($KodeWilayah) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            if ($wilayah) {
                $Data['KodeWilayah'] = $KodeWilayah;
                $Data['NamaWilayah'] = $wilayah['Nama'];
                $Data['VisiRPJMDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmdp')->result_array();
                $Data['VisiRPJMN'] = $this->db->where('deleted_at IS NULL')
                    ->get('visirpjmn')->result_array();
                $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmd')->result_array();
                $Data['Tujuan'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, m.Id as IdMisi, m.Misi, t.*')
                    ->from('visirpjmd v')
                    ->join('misirpjmd m', 'm._Id = v.Id')
                    ->join('tujuanrpjmd t', 't._Id = m.Id')
                    ->where('t.KodeWilayah', $KodeWilayah)
                    ->where('t.deleted_at IS NULL')
                    ->get()->result_array();
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['VisiRPJMDP'] = [];
                $Data['VisiRPJMN'] = [];
                $Data['Visi'] = [];
                $Data['Tujuan'] = [];
                log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
            }
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['VisiRPJMDP'] = [];
            $Data['VisiRPJMN'] = [];
            $Data['Visi'] = [];
            $Data['Tujuan'] = [];
        }

        log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/TujuanRPJMD', $Data);
    }

  public function InputTujuanRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
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

  public function GetSasaranRPJMDP(){
    echo json_encode($this->db->where("KodeWilayah = ".substr($_SESSION['KodeWilayah'],0,2)." AND _Id = ".$_POST['Id']." AND deleted_at IS NULL")->get("sasaranrpjmdp")->result_array());
	}

  public function GetSasaranRPJMN(){
    echo json_encode($this->db->query("SELECT s.* FROM visirpjmn as v, misirpjmn as m, tujuanrpjmn as t, sasaranrpjmn as s WHERE s._Id = t.Id AND t._Id = m.Id AND m._Id = v.Id AND s.deleted_at IS NULL")->result_array());
	}

  public function GetPeriodeSasaranRPJMD(){
    echo json_encode($this->db->query("SELECT v.Id as IdVisi FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE t._Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

  public function GetSasaranRPJMD(){
    echo json_encode($this->db->query("SELECT t.* FROM visirpjmd as v, misirpjmd as m, tujuanrpjmd as t WHERE v.Id = ".$_POST['Id']." AND t._Id = m.Id AND m._Id = v.Id AND t.deleted_at IS NULL AND t.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array());
	}

public function SasaranRPJMD() {
        $Header['Halaman'] = 'RPJMD';
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                       (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

        log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

        if ($KodeWilayah) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            if ($wilayah) {
                $Data['KodeWilayah'] = $KodeWilayah;
                $Data['NamaWilayah'] = $wilayah['Nama'];
                $Data['VisiRPJMDP'] = $this->db->where('KodeWilayah', substr($KodeWilayah, 0, 2))
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmdp')->result_array();
                $Data['VisiRPJMN'] = $this->db->where('deleted_at IS NULL')
                    ->get('visirpjmn')->result_array();
                $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmd')->result_array();
                $Data['Sasaran'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, t.Id as IdTujuan, t.Tujuan, s.*')
                    ->from('visirpjmd v')
                    ->join('misirpjmd m', 'm._Id = v.Id')
                    ->join('tujuanrpjmd t', 't._Id = m.Id')
                    ->join('sasaranrpjmd s', 's._Id = t.Id')
                    ->where('s.KodeWilayah', $KodeWilayah)
                    ->where('s.deleted_at IS NULL')
                    ->get()->result_array();
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['VisiRPJMDP'] = [];
                $Data['VisiRPJMN'] = [];
                $Data['Visi'] = [];
                $Data['Sasaran'] = [];
                log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
            }
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['VisiRPJMDP'] = [];
            $Data['VisiRPJMN'] = [];
            $Data['Visi'] = [];
            $Data['Sasaran'] = [];
        }

        log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/SasaranRPJMD', $Data);
    }

  public function InputSasaranRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
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

 public function TahapanRPJMD() {
        $Header['Halaman'] = 'RPJMD';
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                       (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

        log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

        if ($KodeWilayah) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            if ($wilayah) {
                $Data['KodeWilayah'] = $KodeWilayah;
                $Data['NamaWilayah'] = $wilayah['Nama'];
                $Data['Visi'] = $this->db->where('KodeWilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL')
                    ->get('visirpjmd')->result_array();
                $Data['Tahapan'] = $this->db->select('v.Id as IdVisi, v.TahunMulai, v.TahunAkhir, t.*')
                    ->from('visirpjmd v')
                    ->join('tahapanrpjmd t', 't._Id = v.Id')
                    ->where('t.KodeWilayah', $KodeWilayah)
                    ->where('t.deleted_at IS NULL')
                    ->get()->result_array();
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['Visi'] = [];
                $Data['Tahapan'] = [];
                log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
            }
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['Visi'] = [];
            $Data['Tahapan'] = [];
        }

        log_message('debug', 'Jumlah provinsi: ' . count($Data['Provinsi']));
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/TahapanRPJMD', $Data);
    }

  public function InputTahapanRPJMD(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('tahapanrpjmd',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditTahapanRPJMD(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('tahapanrpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusTahapanRPJMD(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('tahapanrpjmd', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

  public function JanjiPolitik(){
		$Header['Halaman'] = 'RPJMD';
    $Data['Visi'] = $this->db->where("KodeWilayah = ".$_SESSION['KodeWilayah']." AND deleted_at IS NULL")->get("visirpjmd")->result_array();
		$Data['JanjiPolitik'] = $this->db->query("SELECT v.*,j.* FROM visirpjmd as v, janjik as j WHERE j._Id = v.Id AND j.deleted_at IS NULL AND j.KodeWilayah = ".$_SESSION['KodeWilayah'])->result_array();
		$this->load->view('Daerah/header',$Header);
		$this->load->view('Daerah/JanjiPolitik',$Data);
	}

  public function InputJanjiPolitik(){  
    $_POST['KodeWilayah'] = $_SESSION['KodeWilayah'];
    $this->db->insert('janjik',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditJanjiPolitik(){  
		$this->db->where('Id',$_POST['Id']); 
		$this->db->update('janjik', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Update Data!';
    }
  }

  public function HapusJanjiPolitik(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('Id',$_POST['Id'])->update('janjik', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }

public function Instansi() {
    $Header['Halaman'] = 'Cascading';
    $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

    log_message('debug', 'KodeWilayah diterima untuk Instansi: ' . $KodeWilayah);

    $Data = [];
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

    if ($KodeWilayah) {
        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        if ($wilayah) {
            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['NamaWilayah'] = $wilayah['Nama'];
            $Data['Akun'] = $this->db->query("SELECT * FROM `akun_instansi` WHERE deleted_at IS NULL AND kodewilayah = '$KodeWilayah'")->result_array();
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['Akun'] = $this->db->query("SELECT * FROM `akun_instansi` WHERE deleted_at IS NULL")->result_array();
            log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah, menampilkan semua instansi');
        }
    } else {
        $Data['KodeWilayah'] = '';
        $Data['NamaWilayah'] = '';
        $Data['Akun'] = $this->db->query("SELECT * FROM `akun_instansi` WHERE deleted_at IS NULL")->result_array();
        log_message('debug', 'Tidak ada KodeWilayah, menampilkan semua instansi');
    }

    log_message('debug', 'Jumlah instansi: ' . count($Data['Akun']));
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/kelola_instansi', $Data);
}
	
	public function InputInstansi(){  
    $_POST['kodewilayah'] = $_SESSION['KodeWilayah'];
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $this->db->insert('akun_instansi',$_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Menyimpan Data!';
    }
	}
	
	public function EditInstansi(){  
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

	public function HapusInstansi(){  
		$_POST['deleted_at'] = date('Y-m-d H:i:s');
		$this->db->where('id',$_POST['id']); 
		$this->db->update('akun_instansi', $_POST);
    if ($this->db->affected_rows()){
      echo '1';
    } else {
      echo 'Gagal Hapus Data!';
    }
  }
  
public function IKU() {
        $Header['Halaman'] = 'Cascading';
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                       (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

        log_message('debug', 'KodeWilayah diterima untuk IKU: ' . $KodeWilayah);

        $Data = [];
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

        if ($KodeWilayah) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            if ($wilayah) {
                $Data['KodeWilayah'] = $KodeWilayah;
                $Data['NamaWilayah'] = $wilayah['Nama'];
                $Data['Periods'] = $this->db->query(
                    "SELECT DISTINCT TahunMulai, TahunAkhir 
                     FROM visirpjmd 
                     WHERE KodeWilayah = ? 
                     AND deleted_at IS NULL 
                     ORDER BY TahunMulai",
                    [$KodeWilayah]
                )->result_array();
                $Data['Iku'] = $this->db->query(
                    "SELECT i.*, v.TahunMulai, v.TahunAkhir
                     FROM iku i
                     JOIN tujuanrpjmd t ON i.IdTujuan = t.Id
                     JOIN misirpjmd m ON t._Id = m.Id
                     JOIN visirpjmd v ON m._Id = v.Id
                     WHERE i.deleted_at IS NULL 
                     AND i.kodewilayah = ?",
                    [$KodeWilayah]
                )->result_array();
                $Data['Tujuan'] = $this->db->where('deleted_at IS NULL')
                                           ->where('kodewilayah', $KodeWilayah)
                                           ->get('tujuanrpjmd')
                                           ->result_array();
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['Periods'] = [];
                $Data['Iku'] = [];
                $Data['Tujuan'] = [];
                log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
            }
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['Periods'] = [];
            $Data['Iku'] = [];
            $Data['Tujuan'] = [];
        }

        log_message('debug', 'Jumlah periode: ' . count($Data['Periods']) . ', Jumlah IKU: ' . count($Data['Iku']));
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/Iku', $Data);
    }

public function GetTujuanByPeriod() {
    $tahunMulai = $this->input->post('tahun_mulai');
    $tahunAkhir = $this->input->post('tahun_akhir');
    
    $query = $this->db->query("
        SELECT t.Id, t.Tujuan 
        FROM tujuanrpjmd t
        JOIN misirpjmd m ON t._Id = m.Id
        JOIN visirpjmd v ON m._Id = v.Id
        WHERE v.TahunMulai = ? 
        AND v.TahunAkhir = ?
        AND t.KodeWilayah = ?
        AND t.deleted_at IS NULL
    ", array($tahunMulai, $tahunAkhir, $_SESSION['KodeWilayah']));
    
    echo json_encode($query->result_array());
}

public function TambahIku() {
  $period = explode('-', $this->input->post('TahunFilter'));
  
  $data = [
      'kodewilayah' => $_SESSION['KodeWilayah'],
      'IdTujuan' => $this->input->post('Tujuan'),
      'tahun_mulai' => $period[0],
      'tahun_akhir' => $period[1],
      'indikator_tujuan' => $this->input->post('indikator_tujuan'),
      'target_1' => $this->input->post('target_1') ?: null,
      'target_2' => $this->input->post('target_2') ?: null,
      'target_3' => $this->input->post('target_3') ?: null,
      'target_4' => $this->input->post('target_4') ?: null,
      'target_5' => $this->input->post('target_5') ?: null
  ];
  
  $this->db->insert('iku', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
}

public function EditIku() {
  $period = explode('-', $this->input->post('periode'));
  
  $data = [
      'IdTujuan' => $this->input->post('EditTujuan'),
      'tahun_mulai' => $period[0],
      'tahun_akhir' => $period[1],
      'indikator_tujuan' => $this->input->post('indikator_tujuan'),
      'target_1' => $this->input->post('target_1') ?: null,
      'target_2' => $this->input->post('target_2') ?: null,
      'target_3' => $this->input->post('target_3') ?: null,
      'target_4' => $this->input->post('target_4') ?: null,
      'target_5' => $this->input->post('target_5') ?: null,
      'updated_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('id', $this->input->post('id'));
  $this->db->update('iku', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function HapusIku() {
    $id = $this->input->post('id');
    $this->db->where('id', $id)->update('iku', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    echo $this->db->affected_rows() ? '1' : '0';
}

public function IKD() {
        $Header['Halaman'] = 'Cascading';
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                       (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

        log_message('debug', 'KodeWilayah diterima untuk IKD: ' . $KodeWilayah);

        $Data = [];
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

        if ($KodeWilayah) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            if ($wilayah) {
                $Data['KodeWilayah'] = $KodeWilayah;
                $Data['NamaWilayah'] = $wilayah['Nama'];
                $Data['Periods'] = $this->db->query(
                    "SELECT DISTINCT TahunMulai, TahunAkhir 
                     FROM visirpjmd 
                     WHERE KodeWilayah = ? 
                     AND deleted_at IS NULL 
                     ORDER BY TahunMulai",
                    [$KodeWilayah]
                )->result_array();
                $Data['Ikd'] = $this->db->query(
                    "SELECT i.*, v.TahunMulai, v.TahunAkhir
                     FROM ikd i
                     JOIN sasaranrpjmd s ON i.IdSasaran = s.Id
                     JOIN tujuanrpjmd t ON s._Id = t.Id
                     JOIN misirpjmd m ON t._Id = m.Id
                     JOIN visirpjmd v ON m._Id = v.Id
                     WHERE i.deleted_at IS NULL 
                     AND i.kodewilayah = ?",
                    [$KodeWilayah]
                )->result_array();
                $Data['Sasaran'] = $this->db->where('deleted_at IS NULL')
                                            ->where('kodewilayah', $KodeWilayah)
                                            ->get('sasaranrpjmd')
                                            ->result_array();
                $Data['Instansi'] = $this->db->where('deleted_at IS NULL')
                                             ->where('kodewilayah', $KodeWilayah)
                                             ->get('akun_instansi')
                                             ->result_array();
            } else {
                $Data['KodeWilayah'] = '';
                $Data['NamaWilayah'] = '';
                $Data['Periods'] = [];
                $Data['Ikd'] = [];
                $Data['Sasaran'] = [];
                $Data['Instansi'] = [];
                log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
            }
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['Periods'] = [];
            $Data['Ikd'] = [];
            $Data['Sasaran'] = [];
            $Data['Instansi'] = [];
        }

        log_message('debug', 'Jumlah periode: ' . count($Data['Periods']) . ', Jumlah IKD: ' . count($Data['Ikd']));
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/Ikd', $Data);
    }

public function GetSasaranByPeriod() {
  $tahunMulai = $this->input->post('tahun_mulai');
  $tahunAkhir = $this->input->post('tahun_akhir');
  
  $query = $this->db->query("
      SELECT s.Id, s.Sasaran 
      FROM sasaranrpjmd s
      JOIN tujuanrpjmd t ON s._Id = t.Id
      JOIN misirpjmd m ON t._Id = m.Id
      JOIN visirpjmd v ON m._Id = v.Id
      WHERE v.TahunMulai = ? 
      AND v.TahunAkhir = ?
      AND s.KodeWilayah = ?
      AND s.deleted_at IS NULL
  ", array($tahunMulai, $tahunAkhir, $_SESSION['KodeWilayah']));
  
  echo json_encode($query->result_array());
}

public function TambahIsuStrategis() {
    try {
        $id = $this->input->post('id', TRUE);
        $isuStrategis = $this->input->post('isu_strategis', TRUE);

        if (empty($id) || !is_numeric($id)) {
            throw new Exception('ID tidak valid');
        }
        if (empty($isuStrategis)) {
            throw new Exception('Isu Strategis harus diisi');
        }

        // Get existing data
        $existing = $this->db->where('id', $id)->get('ikd')->row_array();
        if (!$existing) {
            throw new Exception('Data IKD tidak ditemukan');
        }

        // Combine with existing Isu Strategis
        $existingIsu = !empty($existing['isu_strategis']) ? explode(',', $existing['isu_strategis']) : [];
        $newIsu = explode(',', $isuStrategis);
        $combinedIsu = array_unique(array_merge($existingIsu, $newIsu));
        $updateData = [
            'isu_strategis' => implode(',', $combinedIsu),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id)->update('ikd', $updateData);
        echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
    } catch (Exception $e) {
        log_message('error', 'Error adding Isu Strategis: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

public function EditIsuStrategis() {
    try {
        $id = $this->input->post('id', TRUE);
        $isuStrategis = $this->input->post('isu_strategis', TRUE);

        if (empty($id) || !is_numeric($id)) {
            throw new Exception('ID tidak valid');
        }

        $updateData = [
            'isu_strategis' => $isuStrategis,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id)->update('ikd', $updateData);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Data';
    } catch (Exception $e) {
        log_message('error', 'Error editing Isu Strategis: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

public function TambahIkd() {
  $period = explode('-', $this->input->post('TahunFilter'));
  
  $data = [
      'kodewilayah' => $_SESSION['KodeWilayah'],
      'IdSasaran' => $this->input->post('Sasaran'),
      'tahun_mulai' => $period[0],
      'tahun_akhir' => $period[1],
      'indikator_sasaran' => $this->input->post('indikator_sasaran'),
      'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
      'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
      'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
      'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
      'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null
  ];
  
  $this->db->insert('ikd', $data);
  echo $this->db->affected_rows() ? '1' : '0';
}

public function EditIkd() {
  $period = explode('-', $this->input->post('periode'));
  
  $data = [
      'IdSasaran' => $this->input->post('EditSasaran'),
      'tahun_mulai' => $period[0],
      'tahun_akhir' => $period[1],
      'indikator_sasaran' => $this->input->post('indikator_sasaran'),
      'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
      'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
      'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
      'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
      'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
      'updated_at' => date('Y-m-d H:i:s')
  ];
  
  $this->db->where('id', $this->input->post('id'))->update('ikd', $data);
  echo $this->db->affected_rows() ? '1' : '0';
}

public function HapusIkd() {
  $id = $this->input->post('id');
  $this->db->where('id', $id)->update('ikd', ['deleted_at' => date('Y-m-d H:i:s')]);
  echo $this->db->affected_rows() ? '1' : '0';
}

// In SuperDaerah.php controller

public function TambahPd() {
  try {
      // Validate input
      $id = $this->input->post('id', true);
      if (empty($id) || !is_numeric($id)) {
          throw new Exception('Invalid ID');
      }

      // Get existing data
      $existing = $this->db->where('id', $id)->get('ikd')->row_array();
      if (!$existing) {
          throw new Exception('Data not found');
      }

      // Prepare update data
      $updateData = ['updated_at' => date('Y-m-d H:i:s')];
      
      // Check which PD type we're adding
      if ($this->input->post('pd_penanggung_jawab')) {
          $penanggungJawab = $this->input->post('pd_penanggung_jawab', true);
          $existingPJ = !empty($existing['pd_penanggung_jawab']) ? explode(',', $existing['pd_penanggung_jawab']) : [];
          
          if (!in_array($penanggungJawab, $existingPJ)) {
              $existingPJ[] = $penanggungJawab;
              $updateData['pd_penanggung_jawab'] = implode(',', array_filter($existingPJ));
          }
      } elseif ($this->input->post('pd_penunjang')) {
          $penunjang = $this->input->post('pd_penunjang', true);
          $existingPN = !empty($existing['pd_penunjang']) ? explode(',', $existing['pd_penunjang']) : [];
          
          if (!in_array($penunjang, $existingPN)) {
              $existingPN[] = $penunjang;
              $updateData['pd_penunjang'] = implode(',', array_filter($existingPN));
          }
      } else {
          throw new Exception('No PD type specified');
      }

      // Update the database
      $this->db->where('id', $id)->update('ikd', $updateData);

      if ($this->db->affected_rows() > 0) {
          echo '1';
      } else {
          throw new Exception('No changes made');
      }
  } catch (Exception $e) {
      log_message('error', 'Error adding PD: ' . $e->getMessage());
      echo $e->getMessage();
  }
}

// Keep the existing EditPDIKD method as is
public function EditPDIKD() {  
  $this->db->where('id', $_POST['id']); 
  $this->db->update('ikd', $_POST);
  if ($this->db->affected_rows()) {
      echo '1';
  } else {
      echo 'Gagal Update Data!';
  }
}

public function PotensiDaerah() {
    $Header['Halaman'] = 'PotensiDaerah';
    
    // Ambil daftar provinsi untuk filter
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

    // Tentukan KodeWilayah
    $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

    log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

    if ($KodeWilayah) {
        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        if ($wilayah) {
            $Data['KodeWilayah'] = $KodeWilayah;
            $Data['NamaWilayah'] = $wilayah['Nama'];
            
            // Ambil data Potensi Daerah berdasarkan KodeWilayah
            $Data['PotensiDaerah'] = $this->db->select('p.*, k.Nama')
                ->from('potensidaerah p')
                ->join('kodewilayah k', 'p.KodeWilayah = k.Kode', 'left')
                ->where('p.KodeWilayah', $KodeWilayah)
                ->where('p.deleted_at IS NULL')
                ->get()->result_array();
                
            // Ambil periode dari RPJMD
            $Data['Periods'] = $this->db->select('TahunMulai, TahunAkhir')
                ->where('KodeWilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('visirpjmd')
                ->result_array();
        } else {
            $Data['KodeWilayah'] = '';
            $Data['NamaWilayah'] = '';
            $Data['PotensiDaerah'] = [];
            $Data['Periods'] = [];
            log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
        }
    } else {
        $Data['KodeWilayah'] = '';
        $Data['NamaWilayah'] = '';
        $Data['PotensiDaerah'] = [];
        $Data['Periods'] = [];
    }

    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/PotensiDaerah', $Data);
}

public function GetKementerian(){
  echo json_encode($this->db->query("SELECT * FROM kementerian WHERE TahunMulai = ".$_POST['TahunMulai']." AND deleted_at IS NULL")->result_array());
}

public function GetPermasalahanPokokNasional(){
  echo json_encode($this->db->query("SELECT * FROM permasalahan_pokok WHERE IdKementerian = ".$_POST['Id']." AND deleted_at IS NULL")->result_array());
}

public function GetPeriodePermasalahanPokokNasional(){
  echo json_encode($this->db->query("SELECT kementerian.* FROM permasalahan_pokok,kementerian WHERE kementerian.Id=permasalahan_pokok.IdKementerian AND kementerian.deleted_at IS NULL AND permasalahan_pokok.Id = ".$_POST['Id'])->result_array());
}

    // Halaman Permasalahan Pokok
public function PermasalahanPokok() {
		$Header['Halaman'] = 'Isudaerah';
		
		// Ambil KodeWilayah
		$KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
					   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

		log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

		// Ambil daftar provinsi untuk filter
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

		// Ambil periode dari RPJMD
		$query = $this->db->query("
			SELECT DISTINCT TahunMulai, TahunAkhir 
			FROM visirpjmd 
			WHERE KodeWilayah = ? AND deleted_at IS NULL
			ORDER BY TahunMulai
		", array($KodeWilayah));
		$Data['Periods'] = $query->result_array();
		
		// Ambil data Permasalahan Pokok
		$query = $this->db->query("
			SELECT * FROM Permasalahanpokokdaerah 
			WHERE KodeWilayah = ? AND deleted_at IS NULL
		", array($KodeWilayah));
		$Data['PermasalahanPokok'] = $query->result_array();

		// Ambil periode dan data kementerian untuk Permasalahan Pokok Nasional
		$Data['PeriodePermasalahanPokokNasional'] = $this->db->query("SELECT DISTINCT TahunMulai,TahunAkhir,deleted_at FROM kementerian WHERE deleted_at IS NULL")->result_array();
		$ListKementerian = $this->db->query("SELECT kementerian.NamaKementerian,permasalahan_pokok.* FROM permasalahan_pokok,kementerian WHERE kementerian.Id=permasalahan_pokok.IdKementerian AND permasalahan_pokok.deleted_at IS NULL")->result_array();
		$Data['Kementerian'] = $Data['Permasalahan'] = array();
		foreach ($ListKementerian as $key) {
			$Data['Kementerian'][$key['Id']] = $key['NamaKementerian'];
			$Data['Permasalahan'][$key['Id']] = $key['NamaPermasalahanPokok'];
		}

		// Data untuk filter wilayah
		if ($KodeWilayah) {
			$wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
			if ($wilayah) {
				$Data['KodeWilayah'] = $KodeWilayah;
				$Data['NamaWilayah'] = $wilayah['Nama'];
			} else {
				$Data['KodeWilayah'] = '';
				$Data['NamaWilayah'] = '';
				log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
			}
		} else {
			$Data['KodeWilayah'] = '';
			$Data['NamaWilayah'] = '';
		}

		$this->load->view('Daerah/header', $Header);
		$this->load->view('Daerah/PermasalahanPokok', $Data);
	}

  // Input Permasalahan Pokok
  public function InputPermasalahanPokok() {
      $periode = explode('-', $this->input->post('PeriodeRPJMD'));
      
      $data = array(
          'NamaPermasalahanPokok' => $this->input->post('NamaPermasalahanPokok'),
          '_Id' => $this->input->post('_Id'),
          'TahunMulai' => $periode[0],
          'TahunAkhir' => $periode[1],
          'KodeWilayah' => $_SESSION['KodeWilayah'],
          'created_at' => date('Y-m-d H:i:s')
      );
      
      $this->db->insert('Permasalahanpokokdaerah', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
  }

  // Update Permasalahan Pokok
  public function UpdatePermasalahanPokok() {
      $periode = explode('-', $this->input->post('EditPeriodeRPJMD'));
      
      $data = array(
          'NamaPermasalahanPokok' => $this->input->post('NamaPermasalahanPokok'),
          '_Id' => $this->input->post('_Id'),
          'TahunMulai' => $periode[0],
          'TahunAkhir' => $periode[1],
          'updated_at' => date('Y-m-d H:i:s')
      );
      
      $this->db->where('Id', $this->input->post('Id'));
      $this->db->update('Permasalahanpokokdaerah', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
  }

  // Hapus Permasalahan Pokok (Soft Delete)
  public function DeletePermasalahanPokok() {
      $data = array(
          'deleted_at' => date('Y-m-d H:i:s')
      );
      
      $this->db->where('Id', $this->input->post('Id'));
      $this->db->update('Permasalahanpokokdaerah', $data);
      echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
  }

  public function GetKementerianIsu(){
    echo json_encode($this->db->query("SELECT * FROM kementerian WHERE TahunMulai = ".$_POST['TahunMulai']." AND deleted_at IS NULL")->result_array());
  }
  
  public function GetIsuKLHSNasional(){
    echo json_encode($this->db->query("SELECT * FROM isu_klhs WHERE IdKementerian = ".$_POST['Id']." AND deleted_at IS NULL")->result_array());
  }
  
  public function GetPeriodeIsuKLHSNasional(){
    echo json_encode($this->db->query("SELECT kementerian.* FROM isu_klhs,kementerian WHERE kementerian.Id=isu_klhs.IdKementerian AND kementerian.deleted_at IS NULL AND isu_klhs.Id = ".$_POST['Id'])->result_array());
  }

 public function IsuKLHS() {
		$Header['Halaman'] = 'Isudaerah';
		
		// Ambil KodeWilayah
		$KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
					   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

		log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

		// Ambil daftar provinsi untuk filter
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

		// Ambil periode dari RPJMD
		$query = $this->db->query("
			SELECT DISTINCT TahunMulai, TahunAkhir 
			FROM visirpjmd 
			WHERE KodeWilayah = ? AND deleted_at IS NULL
			ORDER BY TahunMulai
		", array($KodeWilayah));
		$Data['Periods'] = $query->result_array();
		
		// Ambil data Isu KLHS
		$query = $this->db->query("
			SELECT * FROM IsuKLHS 
			WHERE KodeWilayah = ? AND deleted_at IS NULL
		", array($KodeWilayah));
		$Data['IsuKLHS'] = $query->result_array();

		// Ambil periode dan data kementerian untuk Isu KLHS Nasional
		$Data['PeriodeIsuKLHSNasional'] = $this->db->query("SELECT DISTINCT TahunMulai,TahunAkhir,deleted_at FROM kementerian WHERE deleted_at IS NULL")->result_array();
		$ListKementerian = $this->db->query("SELECT kementerian.NamaKementerian,isu_klhs.* FROM isu_klhs,kementerian WHERE kementerian.Id=isu_klhs.IdKementerian AND isu_klhs.deleted_at IS NULL")->result_array();
		$Data['Kementerian'] = $Data['Isu'] = array();
		foreach ($ListKementerian as $key) {
			$Data['Kementerian'][$key['Id']] = $key['NamaKementerian'];
			$Data['Isu'][$key['Id']] = $key['NamaIsuKLHS'];
		}

		// Data untuk filter wilayah
		if ($KodeWilayah) {
			$wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
			if ($wilayah) {
				$Data['KodeWilayah'] = $KodeWilayah;
				$Data['NamaWilayah'] = $wilayah['Nama'];
			} else {
				$Data['KodeWilayah'] = '';
				$Data['NamaWilayah'] = '';
				log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
			}
		} else {
			$Data['KodeWilayah'] = '';
			$Data['NamaWilayah'] = '';
		}

		$this->load->view('Daerah/header', $Header);
		$this->load->view('Daerah/IsuKLHS', $Data);
	}

public function InputIsuKLHS() {
    $periode = explode('-', $this->input->post('PeriodeRPJMD'));
    
    $data = array(
        'NamaIsuKLHS' => $this->input->post('NamaIsuKLHS'),
        '_Id' => $this->input->post('_Id'),
        'TahunMulai' => $periode[0],
        'TahunAkhir' => $periode[1],
        'KodeWilayah' => $_SESSION['KodeWilayah'],
        'created_at' => date('Y-m-d H:i:s')
    );
    
    $this->db->insert('IsuKLHS', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
}

public function UpdateIsuKLHS() {
    $periode = explode('-', $this->input->post('EditPeriodeRPJMD'));
    
    $data = array(
        'NamaIsuKLHS' => $this->input->post('NamaIsuKLHS'),
        '_Id' => $this->input->post('_Id'),
        'TahunMulai' => $periode[0],
        'TahunAkhir' => $periode[1],
        'updated_at' => date('Y-m-d H:i:s')
    );
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('IsuKLHS', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuKLHS() {
    $data = array(
        'deleted_at' => date('Y-m-d H:i:s')
    );
    
    $this->db->where('Id', $this->input->post('Id'));
    $this->db->update('IsuKLHS', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

public function GetKementerianStrategis(){
  echo json_encode($this->db->query("SELECT * FROM kementerian WHERE TahunMulai = ".$_POST['TahunMulai']." AND deleted_at IS NULL")->result_array());
}

public function GetIsuStrategisNasional(){
  echo json_encode($this->db->query("SELECT * FROM isu_strategis WHERE IdKementerian = ".$_POST['Id']." AND deleted_at IS NULL")->result_array());
}

public function GetPeriodeIsuStrategisNasional(){
  echo json_encode($this->db->query("SELECT kementerian.* FROM isu_strategis,kementerian WHERE kementerian.Id=isu_strategis.IdKementerian AND kementerian.deleted_at IS NULL AND isu_strategis.Id = ".$_POST['Id'])->result_array());
}

public function IsuStrategisDaerah() {
		$Header['Halaman'] = 'Isudaerah';
		
		// Ambil KodeWilayah
		$KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
					   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

		log_message('debug', 'KodeWilayah diterima: ' . $KodeWilayah);

		// Ambil daftar provinsi untuk filter
		$Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();

		// Ambil periode dari RPJMD
		$query = $this->db->query("
			SELECT DISTINCT TahunMulai, TahunAkhir 
			FROM visirpjmd 
			WHERE KodeWilayah = ? AND deleted_at IS NULL
			ORDER BY TahunMulai
		", array($KodeWilayah));
		$Data['Periods'] = $query->result_array();

    $Data['PotensiDaerah'] = $this->db->query("
        SELECT * FROM potensidaerah 
        WHERE KodeWilayah = ? AND deleted_at IS NULL
    ", array($KodeWilayah))->result_array();
		
		// Ambil data Isu Strategis
		$query = $this->db->query("
			SELECT * FROM IsuStrategisDaerah 
			WHERE KodeWilayah = ? AND deleted_at IS NULL
		", array($KodeWilayah));
		$Data['IsuStrategis'] = $query->result_array();

		// Ambil periode dan data kementerian untuk Isu Strategis Nasional
		$Data['PeriodeIsuStrategisNasional'] = $this->db->query("SELECT DISTINCT TahunMulai,TahunAkhir,deleted_at FROM kementerian WHERE deleted_at IS NULL")->result_array();
		$ListKementerian = $this->db->query("SELECT kementerian.NamaKementerian,isu_strategis.* FROM isu_strategis,kementerian WHERE kementerian.Id=isu_strategis.IdKementerian AND isu_strategis.deleted_at IS NULL")->result_array();
		$Data['Kementerian'] = $Data['Isu'] = array();
		foreach ($ListKementerian as $key) {
			$Data['Kementerian'][$key['Id']] = $key['NamaKementerian'];
			$Data['Isu'][$key['Id']] = $key['NamaIsuStrategis'];
		}

		// Ambil Permasalahan Pokok
		$query = $this->db->query(
			"SELECT * FROM Permasalahanpokokdaerah 
			WHERE KodeWilayah = ? AND deleted_at IS NULL",
			array($KodeWilayah)
		);
		$Data['PermasalahanPokok'] = $query->result_array();

		// Ambil Isu KLHS
		$query = $this->db->query(
			"SELECT * FROM IsuKLHS 
			WHERE KodeWilayah = ? AND deleted_at IS NULL",
			array($KodeWilayah)
		);
		$Data['IsuKLHS'] = $query->result_array();

		// Data untuk filter wilayah
		if ($KodeWilayah) {
			$wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
			if ($wilayah) {
				$Data['KodeWilayah'] = $KodeWilayah;
				$Data['NamaWilayah'] = $wilayah['Nama'];
			} else {
				$Data['KodeWilayah'] = '';
				$Data['NamaWilayah'] = '';
				log_message('error', 'KodeWilayah ' . $KodeWilayah . ' tidak ditemukan di tabel kodewilayah');
			}
		} else {
			$Data['KodeWilayah'] = '';
			$Data['NamaWilayah'] = '';
		}

		$this->load->view('Daerah/header', $Header);
		$this->load->view('Daerah/IsuStrategisDaerah', $Data);
	}

public function TambahPermasalahanPokokIsuStrategis() {
  try {
      $id = $this->input->post('id', TRUE);
      $permasalahanPokok = $this->input->post('permasalahan_pokok', TRUE);

      if (empty($id) || !is_numeric($id)) {
          throw new Exception('ID tidak valid');
      }
      if (empty($permasalahanPokok)) {
          throw new Exception('Permasalahan Pokok harus diisi');
      }

      // Get existing data
      $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
      if (!$existing) {
          throw new Exception('Data Isu Strategis tidak ditemukan');
      }

      // Combine with existing Permasalahan Pokok
      $existingPP = !empty($existing['permasalahan_pokok']) ? explode(',', $existing['permasalahan_pokok']) : [];
      $newPP = explode(',', $permasalahanPokok);
      $combinedPP = array_unique(array_merge($existingPP, $newPP));
      $updateData = [
          'permasalahan_pokok' => implode(',', $combinedPP),
          'updated_at' => date('Y-m-d H:i:s')
      ];

      $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
      echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
  } catch (Exception $e) {
      log_message('error', 'Error adding Permasalahan Pokok: ' . $e->getMessage());
      echo $e->getMessage();
  }
}

public function EditPermasalahanPokokIsuStrategis() {
  try {
      $id = $this->input->post('id', TRUE);
      $permasalahanPokok = $this->input->post('permasalahan_pokok', TRUE);

      if (empty($id) || !is_numeric($id)) {
          throw new Exception('ID tidak valid');
      }

      $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
      if (!$existing) {
          throw new Exception('Data Isu Strategis tidak ditemukan');
      }

      $updateData = [
          'permasalahan_pokok' => $permasalahanPokok,
          'updated_at' => date('Y-m-d H:i:s')
      ];

      $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
      echo $this->db->affected_rows() ? '1' : 'Gagal Update Data';
  } catch (Exception $e) {
      log_message('error', 'Error editing Permasalahan Pokok: ' . $e->getMessage());
      echo $e->getMessage();
  }
}

public function TambahIsuKLHSIsuStrategis() {
  try {
      $id = $this->input->post('id', TRUE);
      $isuKLHS = $this->input->post('isu_klhs', TRUE);

      if (empty($id) || !is_numeric($id)) {
          throw new Exception('ID tidak valid');
      }
      if (empty($isuKLHS)) {
          throw new Exception('Isu KLHS harus diisi');
      }

      $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
      if (!$existing) {
          throw new Exception('Data Isu Strategis tidak ditemukan');
      }

      $existingKLHS = !empty($existing['isu_klhs']) ? explode(',', $existing['isu_klhs']) : [];
      $newKLHS = explode(',', $isuKLHS);
      $combinedKLHS = array_unique(array_merge($existingKLHS, $newKLHS));
      $updateData = [
          'isu_klhs' => implode(',', $combinedKLHS),
          'updated_at' => date('Y-m-d H:i:s')
      ];

      $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
      echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
  } catch (Exception $e) {
      log_message('error', 'Error adding Isu KLHS: ' . $e->getMessage());
      echo $e->getMessage();
  }
}

public function EditIsuKLHSIsuStrategis() {
  try {
      $id = $this->input->post('id', TRUE);
      $isuKLHS = $this->input->post('isu_klhs', TRUE);

      if (empty($id) || !is_numeric($id)) {
          throw new Exception('ID tidak valid');
      }

      $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
      if (!$existing) {
          throw new Exception('Data Isu Strategis tidak ditemukan');
      }

      $updateData = [
          'isu_klhs' => $isuKLHS,
          'updated_at' => date('Y-m-d H:i:s')
      ];

      $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
      echo $this->db->affected_rows() ? '1' : 'Gagal Update Data';
  } catch (Exception $e) {
      log_message('error', 'Error editing Isu KLHS: ' . $e->getMessage());
      echo $e->getMessage();
  }
}

public function TambahPotensiDaerahIsuStrategis() {
    try {
        $id = $this->input->post('id', TRUE);
        $potensiDaerah = $this->input->post('potensi_daerah', TRUE);

        if (empty($id) || !is_numeric($id)) {
            throw new Exception('ID tidak valid');
        }
        if (empty($potensiDaerah)) {
            throw new Exception('Potensi Daerah harus diisi');
        }

        // Get existing data
        $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
        if (!$existing) {
            throw new Exception('Data Isu Strategis tidak ditemukan');
        }

        // Combine with existing Potensi Daerah
        $existingPotensi = !empty($existing['potensi_daerah']) ? explode(',', $existing['potensi_daerah']) : [];
        $newPotensi = explode(',', $potensiDaerah);
        $combinedPotensi = array_unique(array_merge($existingPotensi, $newPotensi));
        $updateData = [
            'potensi_daerah' => implode(',', $combinedPotensi),
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
        echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
    } catch (Exception $e) {
        log_message('error', 'Error adding Potensi Daerah: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

public function EditPotensiDaerahIsuStrategis() {
    try {
        $id = $this->input->post('id', TRUE);
        $potensiDaerah = $this->input->post('potensi_daerah', TRUE);

        if (empty($id) || !is_numeric($id)) {
            throw new Exception('ID tidak valid');
        }

        $existing = $this->db->where('Id', $id)->get('IsuStrategisDaerah')->row_array();
        if (!$existing) {
            throw new Exception('Data Isu Strategis tidak ditemukan');
        }

        $updateData = [
            'potensi_daerah' => $potensiDaerah,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('Id', $id)->update('IsuStrategisDaerah', $updateData);
        echo $this->db->affected_rows() ? '1' : 'Gagal Update Data';
    } catch (Exception $e) {
        log_message('error', 'Error editing Potensi Daerah: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

public function InputIsuStrategis() {
  $periode = explode('-', $this->input->post('PeriodeRPJMD'));
  
  $data = array(
      'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
      '_Id' => $this->input->post('_Id'),
      'TahunMulai' => $periode[0],
      'TahunAkhir' => $periode[1],
      'KodeWilayah' => $_SESSION['KodeWilayah'],
      'created_at' => date('Y-m-d H:i:s')
  );
  
  $this->db->insert('IsuStrategisDaerah', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
}

public function UpdateIsuStrategis() {
  $periode = explode('-', $this->input->post('EditPeriodeRPJMD'));
  
  $data = array(
      'NamaIsuStrategis' => $this->input->post('NamaIsuStrategis'),
      '_Id' => $this->input->post('_Id'),
      'TahunMulai' => $periode[0],
      'TahunAkhir' => $periode[1],
      'updated_at' => date('Y-m-d H:i:s')
  );
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('IsuStrategisDaerah', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Update Data!';
}

public function DeleteIsuStrategis() {
  $data = array(
      'deleted_at' => date('Y-m-d H:i:s')
  );
  
  $this->db->where('Id', $this->input->post('Id'));
  $this->db->update('IsuStrategisDaerah', $data);
  echo $this->db->affected_rows() ? '1' : 'Gagal Hapus Data!';
}

}


