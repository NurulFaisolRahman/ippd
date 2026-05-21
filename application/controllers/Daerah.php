
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

  public function GetVisiRPJPD()
{
    if (!$this->input->is_ajax_request()) show_404();

    $id = (int) $this->input->post('Id', true);

    // Ambil kode wilayah aktif
    $kodeWilayah = $this->session->userdata('KodeWilayah') 
                ?? $this->session->userdata('TempKodeWilayah');

    if (!$kodeWilayah) {
        echo json_encode([]);
        return;
    }

    // Cari visi berdasarkan wilayah dan periode Id
    $data = $this->db
        ->where('KodeWilayah', $kodeWilayah)
        ->where('Id', $id)
        ->where('deleted_at IS NULL', null, false)
        ->get('visirpjpd')
        ->result_array();

    echo json_encode($data);
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

  public function ArahKebijakanRPJMD()
  {
    $Header['Halaman'] = 'Daerah';

    // Provinsi (filter)
    $data['Provinsi'] = $this->db
      ->where("Kode LIKE '__'")
      ->get("kodewilayah")
      ->result_array();

    // Kode wilayah aktif (session tetap)
    $KodeWilayah = $_SESSION['KodeWilayah'] ?? ($_SESSION['TempKodeWilayah'] ?? '');

    $data['KodeWilayah'] = $KodeWilayah;

    // dropdown sasaran rpjmd
    $data['ListSasaranRPJMD'] = $this->db
      ->order_by("Id", "ASC")
      ->get("sasaranrpjmd")
      ->result_array();

    if (!empty($KodeWilayah)) {
      $data['ArahKebijakanRPJMD'] = $this->db
        ->select("a.*, s.Sasaran")
        ->from("arah_kebijakan_rpjmd a")
        ->join("sasaranrpjmd s", "s.id = a.sasaran_rpjmd_id", "left")
        ->where("a.kode_wilayah", $KodeWilayah)
        ->where("a.deleted_at", NULL)
        ->order_by("a.id", "ASC")
        ->get()
        ->result_array();
    } else {
      $data['ArahKebijakanRPJMD'] = [];
    }

    $this->load->view('Daerah/header', $Header);
    $this->load->view("Daerah/ArahKebijakanRPJMD", $data);
  }

  public function InputArahKebijakanRPJMD()
  {
    $KodeWilayah = $this->session->userdata("KodeWilayah");
    if (!$KodeWilayah) {
      $KodeWilayah = $_SESSION['KodeWilayah'] ?? ($_SESSION['TempKodeWilayah'] ?? '');
    }
    if (!$KodeWilayah) { echo "Wilayah belum dipilih!"; return; }

    $sasaran_id = (int)$this->input->post("sasaran_rpjmd_id");
    $strategi   = trim((string)$this->input->post("strategi"));
    $arah       = trim((string)$this->input->post("arah_kebijakan"));

    if($sasaran_id <= 0){ echo "Sasaran RPJMD wajib dipilih!"; return; }
    if($strategi === ""){ echo "Strategi wajib diisi!"; return; }
    if($arah === ""){ echo "Arah Kebijakan wajib diisi!"; return; }

    $data = [
      "kode_wilayah"      => $KodeWilayah,
      "sasaran_rpjmd_id"  => $sasaran_id,
      "strategi"          => $strategi,
      "arah_kebijakan"    => $arah,
      "created_at"        => date("Y-m-d H:i:s"),
      "deleted_at"        => NULL
    ];

    $insert = $this->db->insert("arah_kebijakan_rpjmd", $data);
    echo $insert ? "1" : "0";
  }

  public function EditArahKebijakanRPJMD()
  {
    $id = (int)$this->input->post("id");
    if ($id <= 0) { echo "ID tidak valid!"; return; }

    $sasaran_id = (int)$this->input->post("sasaran_rpjmd_id");
    $strategi   = trim((string)$this->input->post("strategi"));
    $arah       = trim((string)$this->input->post("arah_kebijakan"));

    if($sasaran_id <= 0){ echo "Sasaran RPJMD wajib dipilih!"; return; }
    if($strategi === ""){ echo "Strategi wajib diisi!"; return; }
    if($arah === ""){ echo "Arah Kebijakan wajib diisi!"; return; }

    $data = [
      "sasaran_rpjmd_id" => $sasaran_id,
      "strategi"         => $strategi,
      "arah_kebijakan"   => $arah,
      "updated_at"       => date("Y-m-d H:i:s")
    ];

    $update = $this->db->where("id", $id)->update("arah_kebijakan_rpjmd", $data);
    echo $update ? "1" : "0";
  }

  public function HapusArahKebijakanRPJMD()
  {
    $id = (int)$this->input->post("id");
    if ($id <= 0) { echo "ID tidak valid!"; return; }

    $data = ["deleted_at" => date("Y-m-d H:i:s")];

    $delete = $this->db->where("id", $id)->update("arah_kebijakan_rpjmd", $data);
    echo $delete ? "1" : "0";
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


public function Instansi()
{
    $Header['Halaman'] = 'Cascading';

    $KodeWilayah = '';
    if (isset($_SESSION['KodeWilayah']) && !empty($_SESSION['KodeWilayah'])) {
        $KodeWilayah = $_SESSION['KodeWilayah'];
    } elseif (isset($_SESSION['TempKodeWilayah']) && !empty($_SESSION['TempKodeWilayah'])) {
        $KodeWilayah = $_SESSION['TempKodeWilayah'];
    }

    // KIRIM KE VIEW
    $Data['KodeWilayah'] = $KodeWilayah;

    // PROVINSI
    $Data['Provinsi'] = $this->db
        ->select('Kode, Nama')
        ->where('LENGTH(Kode)=2', null, false)
        ->order_by('Nama', 'ASC')
        ->get('kodewilayah')
        ->result_array();

    // ====== NEW: LIST KEMENTERIAN (Level = 1) ======
    // DB kamu kolomnya "Username" (huruf besar), maka kita alias biar view pakai 'username'
    $Data['Kementerian'] = $this->db
        ->select('Username as username', false)
        ->where('Level', 1)
        ->where('deleted_at IS NULL', null, false)
        ->order_by('Username', 'ASC')
        ->get('akun')
        ->result_array();

    // map id => username (untuk tampilan nama_kementerian di tabel)
    $mapKem = [];
    foreach ($Data['Kementerian'] as $k) {
        $mapKem[$k['username']] = $k['username'];
    }
    // ==============================================

    if (empty($KodeWilayah)) {
        $Data['Urusan'] = [];
        $Data['Akun']   = [];
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/kelola_instansi', $Data);
        return;
    }

    // URUSAN
    $Data['Urusan'] = $this->db
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL', null, false)
        ->order_by('nama_urusan', 'ASC')
        ->get('urusan_pd')
        ->result_array();

    // AKUN INSTANSI
    $Data['Akun'] = $this->db
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL', null, false)
        ->order_by('id', 'ASC')
        ->get('akun_instansi')
        ->result_array();

    // map urusan id => nama
    $mapUrusan = [];
    foreach ($Data['Urusan'] as $u) {
        $mapUrusan[$u['id']] = $u['nama_urusan'];
    }

    // tambahkan urusan_nama + nama_kementerian untuk view
    foreach ($Data['Akun'] as &$a) {

        // urusan_nama
        $ids = [];
        if (!empty($a['urusan_id'])) {
            $ids = array_filter(array_map('trim', explode(',', $a['urusan_id'])));
        }

        $names = [];
        foreach ($ids as $id) {
            if (isset($mapUrusan[$id])) $names[] = $mapUrusan[$id];
        }
        $a['urusan_nama'] = !empty($names) ? implode(', ', $names) : '-';

        // nama_kementerian
        $kemIds = [];
if (!empty($a['idkementerian'])) {
    $kemIds = array_filter(array_map('trim', explode(',', $a['idkementerian'])));
}

$kemNames = [];
foreach ($kemIds as $kid) {
    if (isset($mapKem[$kid])) {
        $kemNames[] = $mapKem[$kid];
    }
}

$a['nama_kementerian'] = !empty($kemNames)
    ? implode(', ', $kemNames)
    : '-';

    }
    unset($a);

    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/kelola_instansi', $Data);
}

public function InputInstansi()
{
    $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
    if (!$KodeWilayah) { echo 'KodeWilayah tidak ditemukan di session!'; return; }

    $tahunMulai = (int)$this->input->post('tahun_mulai', TRUE);
    $tahunAkhir = (int)$this->input->post('tahun_akhir', TRUE);

    if (!$tahunMulai || strlen((string)$tahunMulai) != 4) { echo 'Tahun Mulai tidak valid!'; return; }
    if (!$tahunAkhir || strlen((string)$tahunAkhir) != 4) { echo 'Tahun Akhir tidak valid!'; return; }
    if ($tahunMulai >= $tahunAkhir) { echo 'Tahun Mulai harus lebih kecil dari Tahun Akhir!'; return; }

    $nama = trim((string)$this->input->post('nama', TRUE));
    $pwd  = trim((string)$this->input->post('password', TRUE));

    if ($nama === '') { echo 'Nama instansi wajib diisi!'; return; }
    if ($pwd === '')  { echo 'Password wajib diisi!'; return; }

    // ===== FIX: idkementerian pakai Username (STRING) =====
    $idKementerianArr = $this->input->post('idkementerian');

$idKementerianArr = is_array($idKementerianArr)
    ? array_values(array_unique(array_filter(array_map('trim', $idKementerianArr))))
    : [];

foreach ($idKementerianArr as $kem) {
    $validKem = $this->db->where('Username', $kem)
        ->where('Level', 1)
        ->where('deleted_at IS NULL', null, false)
        ->count_all_results('akun');

    if ($validKem < 1) {
        echo 'Induk kementerian tidak valid!';
        return;
    }
}

$idKementerian = !empty($idKementerianArr)
    ? implode(',', $idKementerianArr)
    : null;
    // =====================================================

    $urusanArr = $this->input->post('urusan_id');
    if (!is_array($urusanArr) || count(array_filter($urusanArr)) < 1) {
        echo 'Urusan wajib dipilih minimal 1!';
        return;
    }

    $urusanArr = array_values(array_unique(array_filter(array_map('intval', $urusanArr))));
    sort($urusanArr);

    $validCount = $this->db->where_in('id', $urusanArr)
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL', null, false)
        ->count_all_results('urusan_pd');

    if ($validCount !== count($urusanArr)) {
        echo 'Urusan tidak valid (beda wilayah / tidak ada)!';
        return;
    }

    $data = [
        'kodewilayah'   => $KodeWilayah,
        'nama'          => $nama,
        'password'      => password_hash($pwd, PASSWORD_DEFAULT),
        'tahun_mulai'   => $tahunMulai,
        'tahun_akhir'   => $tahunAkhir,
        'Level'         => 2,
        'urusan_id'     => implode(',', $urusanArr),
        'idkementerian' => $idKementerian, // simpan Username
        'created_at'    => date('Y-m-d H:i:s'),
        'updated_at'    => date('Y-m-d H:i:s')
    ];

    $this->db->insert('akun_instansi', $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
}

public function EditInstansi()
{
    $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
    if (!$KodeWilayah) { echo 'KodeWilayah tidak ditemukan di session!'; return; }

    $id = (int)$this->input->post('id', TRUE);
    if ($id <= 0) { echo 'ID tidak valid!'; return; }

    $tahunMulai = (int)$this->input->post('tahun_mulai', TRUE);
    $tahunAkhir = (int)$this->input->post('tahun_akhir', TRUE);

    if (!$tahunMulai || strlen((string)$tahunMulai) != 4) { echo 'Tahun Mulai tidak valid!'; return; }
    if (!$tahunAkhir || strlen((string)$tahunAkhir) != 4) { echo 'Tahun Akhir tidak valid!'; return; }
    if ($tahunMulai >= $tahunAkhir) { echo 'Tahun Mulai harus lebih kecil dari Tahun Akhir!'; return; }

    $nama = trim((string)$this->input->post('nama', TRUE));
    if ($nama === '') { echo 'Nama instansi wajib diisi!'; return; }

    $exist = $this->db->where('id', $id)
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL', null, false)
        ->get('akun_instansi')
        ->row_array();

    if (!$exist) { echo 'Data instansi tidak ditemukan / beda wilayah!'; return; }

    // ===== FIX: idkementerian pakai Username (STRING) =====
    $idKementerianArr = $this->input->post('idkementerian');

$idKementerianArr = is_array($idKementerianArr)
    ? array_values(array_unique(array_filter(array_map('trim', $idKementerianArr))))
    : [];

foreach ($idKementerianArr as $kem) {
    $validKem = $this->db->where('Username', $kem)
        ->where('Level', 1)
        ->where('deleted_at IS NULL', null, false)
        ->count_all_results('akun');

    if ($validKem < 1) {
        echo 'Induk kementerian tidak valid!';
        return;
    }
}

$idKementerian = !empty($idKementerianArr)
    ? implode(',', $idKementerianArr)
    : null;
    // =====================================================

    $urusanArr = $this->input->post('urusan_id');
    if (!is_array($urusanArr) || count(array_filter($urusanArr)) < 1) {
        echo 'Urusan wajib dipilih minimal 1!';
        return;
    }

    $urusanArr = array_values(array_unique(array_filter(array_map('intval', $urusanArr))));
    sort($urusanArr);

    $validCount = $this->db->where_in('id', $urusanArr)
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL', null, false)
        ->count_all_results('urusan_pd');

    if ($validCount !== count($urusanArr)) {
        echo 'Urusan tidak valid (beda wilayah / tidak ada)!';
        return;
    }

    $data = [
        'nama'          => $nama,
        'tahun_mulai'   => $tahunMulai,
        'tahun_akhir'   => $tahunAkhir,
        'urusan_id'     => implode(',', $urusanArr),
        'idkementerian' => $idKementerian, // simpan Username
        'updated_at'    => date('Y-m-d H:i:s')
    ];

    $pwd = trim((string)$this->input->post('password', TRUE));
    if ($pwd !== '') {
        $data['password'] = password_hash($pwd, PASSWORD_DEFAULT);
    }

    $this->db->where('id', $id);
    $this->db->where('kodewilayah', $KodeWilayah);
    $this->db->update('akun_instansi', $data);

    echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
}


public function HapusInstansi()
{
    $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
    if (!$KodeWilayah) { echo 'KodeWilayah tidak ditemukan di session!'; return; }

    $id = (int)$this->input->post('id', TRUE);
    if ($id <= 0) { echo 'ID tidak valid!'; return; }

    $this->db->where('id', $id);
    $this->db->where('kodewilayah', $KodeWilayah);
    $this->db->update('akun_instansi', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);

    echo $this->db->affected_rows() ? '1' : 'Gagal hapus / beda wilayah';
}

public function Akun_Karyawan()
    {
        $Header['Halaman'] = 'Kelola Karyawan';

        $KodeWilayah = '';
        if (isset($_SESSION['KodeWilayah']) && !empty($_SESSION['KodeWilayah'])) {
            $KodeWilayah = $_SESSION['KodeWilayah'];
        } elseif (isset($_SESSION['TempKodeWilayah']) && !empty($_SESSION['TempKodeWilayah'])) {
            $KodeWilayah = $_SESSION['TempKodeWilayah'];
        }

        // KIRIM KE VIEW
        $Data['KodeWilayah'] = $KodeWilayah;

        // PROVINSI
        $Data['Provinsi'] = $this->db
            ->select('Kode, Nama')
            ->where('LENGTH(Kode)=2', null, false)
            ->order_by('Nama', 'ASC')
            ->get('kodewilayah')
            ->result_array();

        if (empty($KodeWilayah)) {
            $Data['DaftarDinas'] = [];
            $Data['Karyawan'] = [];
            $this->load->view('Daerah/header', $Header);
            $this->load->view('Daerah/Akun_Karyawan', $Data);
            return;
        }

        // AMBIL DATA DINAS DARI akun_instansi
        $Data['DaftarDinas'] = $this->db
            ->select('id, nama, tahun_mulai, tahun_akhir')
            ->where('kodewilayah', $KodeWilayah)
            ->where('Level', 2)
            ->where('deleted_at IS NULL', null, false)
            ->order_by('nama', 'ASC')
            ->get('akun_instansi')
            ->result_array();

        // AKUN KARYAWAN
        $Data['Karyawan'] = $this->db
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->order_by('id', 'ASC')
            ->get('akun_karyawan')
            ->result_array();

        // MAP DINAS ID => NAMA
        $mapDinas = [];
        foreach ($Data['DaftarDinas'] as $d) {
            $mapDinas[$d['id']] = $d['nama'];
        }

        // TAMBAHKAN dinas_nama UNTUK VIEW
        foreach ($Data['Karyawan'] as &$k) {
            $ids = [];
            if (!empty($k['dinas_id'])) {
                $ids = array_filter(array_map('trim', explode(',', $k['dinas_id'])));
            }

            $names = [];
            foreach ($ids as $id) {
                if (isset($mapDinas[$id])) {
                    $names[] = $mapDinas[$id];
                }
            }
            $k['dinas_nama'] = !empty($names) ? implode(', ', $names) : '-';
        }
        unset($k);

        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/Akun_Karyawan', $Data);
    }

    public function InputKaryawan()
    {
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
        if (!$KodeWilayah) {
            echo 'KodeWilayah tidak ditemukan di session!';
            return;
        }

        $tahunMulai = (int)$this->input->post('tahun_mulai', TRUE);
        $tahunAkhir = (int)$this->input->post('tahun_akhir', TRUE);

        if (!$tahunMulai || strlen((string)$tahunMulai) != 4) {
            echo 'Tahun Mulai tidak valid!';
            return;
        }
        if (!$tahunAkhir || strlen((string)$tahunAkhir) != 4) {
            echo 'Tahun Akhir tidak valid!';
            return;
        }
        if ($tahunMulai >= $tahunAkhir) {
            echo 'Tahun Mulai harus lebih kecil dari Tahun Akhir!';
            return;
        }

        $nama = trim((string)$this->input->post('nama', TRUE));
        $nip  = trim((string)$this->input->post('nip', TRUE));
        $jabatan = trim((string)$this->input->post('jabatan', TRUE));
        $pwd  = trim((string)$this->input->post('password', TRUE));

        if ($nama === '') {
            echo 'Nama karyawan wajib diisi!';
            return;
        }
        if ($nip === '') {
            echo 'NIP wajib diisi!';
            return;
        }
        if ($jabatan === '') {
            echo 'Jabatan wajib diisi!';
            return;
        }
        if ($pwd === '') {
            echo 'Password wajib diisi!';
            return;
        }

        // CEK NIP UNIK
        $cekNip = $this->db
            ->where('nip', $nip)
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->get('akun_karyawan')
            ->num_rows();

        if ($cekNip > 0) {
            echo 'NIP sudah terdaftar!';
            return;
        }

        // DINAS TERKAIT
        $dinasArr = $this->input->post('dinas_id');
        if (!is_array($dinasArr) || count(array_filter($dinasArr)) < 1) {
            echo 'Dinas terkait wajib dipilih minimal 1!';
            return;
        }

        $dinasArr = array_values(array_unique(array_filter(array_map('intval', $dinasArr))));
        sort($dinasArr);

        $validCount = $this->db->where_in('id', $dinasArr)
            ->where('kodewilayah', $KodeWilayah)
            ->where('Level', 2)
            ->where('deleted_at IS NULL', null, false)
            ->count_all_results('akun_instansi');

        if ($validCount !== count($dinasArr)) {
            echo 'Dinas tidak valid (beda wilayah / tidak aktif)!';
            return;
        }

        $data = [
            'kodewilayah'   => $KodeWilayah,
            'nama'          => $nama,
            'nip'           => $nip,
            'jabatan'       => $jabatan,
            'password'      => password_hash($pwd, PASSWORD_DEFAULT),
            'tahun_mulai'   => $tahunMulai,
            'tahun_akhir'   => $tahunAkhir,
            'Level'         => 4,
            'dinas_id'      => implode(',', $dinasArr),
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        $this->db->insert('akun_karyawan', $data);
        echo $this->db->affected_rows() ? '1' : 'Gagal Menyimpan Data!';
    }

    public function EditKaryawan()
    {
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
        if (!$KodeWilayah) {
            echo 'KodeWilayah tidak ditemukan di session!';
            return;
        }

        $id = (int)$this->input->post('id', TRUE);
        if ($id <= 0) {
            echo 'ID tidak valid!';
            return;
        }

        $tahunMulai = (int)$this->input->post('tahun_mulai', TRUE);
        $tahunAkhir = (int)$this->input->post('tahun_akhir', TRUE);

        if (!$tahunMulai || strlen((string)$tahunMulai) != 4) {
            echo 'Tahun Mulai tidak valid!';
            return;
        }
        if (!$tahunAkhir || strlen((string)$tahunAkhir) != 4) {
            echo 'Tahun Akhir tidak valid!';
            return;
        }
        if ($tahunMulai >= $tahunAkhir) {
            echo 'Tahun Mulai harus lebih kecil dari Tahun Akhir!';
            return;
        }

        $nama = trim((string)$this->input->post('nama', TRUE));
        $nip = trim((string)$this->input->post('nip', TRUE));
        $jabatan = trim((string)$this->input->post('jabatan', TRUE));

        if ($nama === '') {
            echo 'Nama karyawan wajib diisi!';
            return;
        }
        if ($nip === '') {
            echo 'NIP wajib diisi!';
            return;
        }
        if ($jabatan === '') {
            echo 'Jabatan wajib diisi!';
            return;
        }

        $exist = $this->db->where('id', $id)
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->get('akun_karyawan')
            ->row_array();

        if (!$exist) {
            echo 'Data karyawan tidak ditemukan / beda wilayah!';
            return;
        }

        // CEK DUPLIKAT NIP
        $cekNip = $this->db
            ->where('nip', $nip)
            ->where('id !=', $id)
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->get('akun_karyawan')
            ->num_rows();

        if ($cekNip > 0) {
            echo 'NIP sudah digunakan karyawan lain!';
            return;
        }

        // DINAS TERKAIT
        $dinasArr = $this->input->post('dinas_id');
        if (!is_array($dinasArr) || count(array_filter($dinasArr)) < 1) {
            echo 'Dinas terkait wajib dipilih minimal 1!';
            return;
        }

        $dinasArr = array_values(array_unique(array_filter(array_map('intval', $dinasArr))));
        sort($dinasArr);

        $validCount = $this->db->where_in('id', $dinasArr)
            ->where('kodewilayah', $KodeWilayah)
            ->where('Level', 2)
            ->where('deleted_at IS NULL', null, false)
            ->count_all_results('akun_instansi');

        if ($validCount !== count($dinasArr)) {
            echo 'Dinas tidak valid (beda wilayah / tidak aktif)!';
            return;
        }

        $data = [
            'nama'          => $nama,
            'nip'           => $nip,
            'jabatan'       => $jabatan,
            'tahun_mulai'   => $tahunMulai,
            'tahun_akhir'   => $tahunAkhir,
            'dinas_id'      => implode(',', $dinasArr),
            'updated_at'    => date('Y-m-d H:i:s')
        ];

        $pwd = trim((string)$this->input->post('password', TRUE));
        if ($pwd !== '') {
            $data['password'] = password_hash($pwd, PASSWORD_DEFAULT);
        }

        $this->db->where('id', $id);
        $this->db->where('kodewilayah', $KodeWilayah);
        $this->db->update('akun_karyawan', $data);

        echo $this->db->affected_rows() ? '1' : 'Tidak ada perubahan';
    }

    public function HapusKaryawan()
    {
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
        if (!$KodeWilayah) {
            echo 'KodeWilayah tidak ditemukan di session!';
            return;
        }

        $id = (int)$this->input->post('id', TRUE);
        if ($id <= 0) {
            echo 'ID tidak valid!';
            return;
        }

        $this->db->where('id', $id);
        $this->db->where('kodewilayah', $KodeWilayah);
        $this->db->update('akun_karyawan', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);

        echo $this->db->affected_rows() ? '1' : 'Gagal hapus / beda wilayah';
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

public function Cascade() {
    $Header['Halaman'] = 'Cascading';
    $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : 
                   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

    $Data = [];
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->order_by('Nama')->get('kodewilayah')->result_array();
    
    // PERBAIKAN: Selalu inisialisasi variabel default
    $Data['KodeWilayah'] = $KodeWilayah;  // Bisa kosong jika belum filter
    $Data['CascadeData'] = [];  // Array kosong jika belum ada data
    $Data['Periods'] = [];
    $Data['Instansi'] = [];

    if ($KodeWilayah) {
        $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        if ($wilayah) {
            $Data['NamaWilayah'] = $wilayah['Nama'];
            $Data['Periods'] = $this->db->query(
                "SELECT DISTINCT TahunMulai, TahunAkhir 
                 FROM visirpjmd 
                 WHERE KodeWilayah = ? 
                 AND deleted_at IS NULL 
                 ORDER BY TahunMulai",
                [$KodeWilayah]
            )->result_array();
            
            // Load data cascade jika wilayah valid
            $Data['CascadeData'] = $this->db->query(
                "SELECT c.*, 
                        m.Id as IdMisi, 
                        m.Misi,
                        v.Id as IdVisi
                 FROM cascade_indikator c
                 LEFT JOIN misirpjmd m ON c.IdMisi = m.Id
                 LEFT JOIN visirpjmd v ON m._Id = v.Id
                 WHERE c.deleted_at IS NULL 
                 AND c.kodewilayah = ?
                 ORDER BY c.id ASC",
                [$KodeWilayah]
            )->result_array();
            
            $Data['Instansi'] = $this->db->where('deleted_at IS NULL')
                                         ->where('kodewilayah', $KodeWilayah)
                                         ->get('akun_instansi')
                                         ->result_array();
        } else {
            $Data['NamaWilayah'] = 'Wilayah Tidak Ditemukan';
        }
    } else {
        $Data['NamaWilayah'] = '';  // Atau pesan seperti 'Pilih Wilayah Terlebih Dahulu'
    }

    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/cascade', $Data);
}

    // AJAX: Load visi berdasarkan periode
    public function GetVisiByPeriod() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        $tahunMulai = $this->input->post('tahun_mulai', TRUE);
        $tahunAkhir = $this->input->post('tahun_akhir', TRUE);
        if (!is_numeric($tahunMulai) || !is_numeric($tahunAkhir)) {
            echo json_encode([]);
            return;
        }
        
        $query = $this->db->query("
            SELECT Id, Visi 
            FROM visirpjmd 
            WHERE TahunMulai = ? 
            AND TahunAkhir = ?
            AND KodeWilayah = ?
            AND deleted_at IS NULL
            ORDER BY Id
        ", array($tahunMulai, $tahunAkhir, $_SESSION['KodeWilayah']));
        
        echo json_encode($query->result_array());
    }

    // AJAX: Load misi berdasarkan visi
    public function GetMisiByVisi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        $visiId = $this->input->post('visi_id', TRUE);
        if (!is_numeric($visiId)) {
            echo json_encode([]);
            return;
        }
        
        $query = $this->db->query("
            SELECT m.Id, m.Misi 
            FROM misirpjmd m
            WHERE m._Id = ?
            AND m.KodeWilayah = ?
            AND m.deleted_at IS NULL
            ORDER BY m.Id
        ", array($visiId, $_SESSION['KodeWilayah']));
        
        echo json_encode($query->result_array());
    }

    // AJAX: Load tujuan berdasarkan misi (tidak berubah)
    public function GetTujuanByMisi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        $misiId = $this->input->post('misi_id', TRUE);
        if (!is_numeric($misiId)) {
            echo json_encode([]);
            return;
        }
        
        $query = $this->db->query("
            SELECT t.Id, t.Tujuan 
            FROM tujuanrpjmd t
            WHERE t._Id = ?
            AND t.KodeWilayah = ?
            AND t.deleted_at IS NULL
            ORDER BY t.Id
        ", array($misiId, $_SESSION['KodeWilayah']));
        
        echo json_encode($query->result_array());
    }

    // AJAX: Load sasaran berdasarkan tujuan (tidak berubah)
    public function GetSasaranByTujuan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        $tujuanId = $this->input->post('tujuan_id', TRUE);
        if (!is_numeric($tujuanId)) {
            echo json_encode([]);
            return;
        }
        
        $query = $this->db->query("
            SELECT s.Id, s.Sasaran 
            FROM sasaranrpjmd s
            WHERE s._Id = ?
            AND s.KodeWilayah = ?
            AND s.deleted_at IS NULL
            ORDER BY s.Id
        ", array($tujuanId, $_SESSION['KodeWilayah']));
        
        echo json_encode($query->result_array());
    }

    // Tambah data cascade
    public function TambahCascade() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Debug data yang diterima
    log_message('debug', 'Data POST: ' . print_r($_POST, true));
    
    try {
        $period = explode('-', $this->input->post('TahunFilter', TRUE));
        
        // Validasi data
        if (count($period) != 2) {
            echo 'Periode tidak valid';
            return;
        }
        
        $data = [
            'kodewilayah' => $_SESSION['KodeWilayah'],
            'IdMisi' => (int)$this->input->post('Misi', TRUE),
            'tahun_mulai' => (int)$period[0],
            'tahun_akhir' => (int)$period[1],
            'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
            'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
            'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
            'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
            'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
            'created_at' => date('Y-m-d H:i:s')
        ];
        
        log_message('debug', 'Data untuk insert: ' . print_r($data, true));
        
        $this->db->insert('cascade_indikator', $data);
        
        if ($this->db->affected_rows()) {
            echo '1';
        } else {
            $error = $this->db->error();
            log_message('error', 'Database error: ' . $error['message']);
            echo 'Gagal menyimpan data ke database';
        }
        
    } catch (Exception $e) {
        log_message('error', 'Error TambahCascade: ' . $e->getMessage());
        echo 'Terjadi kesalahan sistem';
    }
}

    // Edit data cascade
    // Edit data cascade - Modifikasi untuk menghapus indikator jika misi berubah
public function EditCascade() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    $id = $this->input->post('id', TRUE);
    $period = explode('-', $this->input->post('periode', TRUE));
    $newMisiId = (int)$this->input->post('EditMisi', TRUE);

    // Validasi
    if (!is_numeric($id)) {
        echo 'ID tidak valid';
        return;
    }
    if (count($period) != 2 || !is_numeric($period[0]) || !is_numeric($period[1])) {
        echo 'Periode tidak valid';
        return;
    }

    // Ambil data lama
    $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
    if (!$existing) {
        echo 'Data tidak ditemukan';
        return;
    }

    $oldMisiId = (int)$existing['IdMisi'];

    // Jika misi berubah
    if ($newMisiId != $oldMisiId) {
        // Filter tujuan yang sesuai dengan misi baru
        $validTujuanIds = $this->db->query("
            SELECT t.Id 
            FROM tujuanrpjmd t
            WHERE t._Id = ? 
            AND t.KodeWilayah = ?
            AND t.deleted_at IS NULL
        ", array($newMisiId, $_SESSION['KodeWilayah']))->result_array();
        
        $validTujuanList = array_column($validTujuanIds, 'Id');
        
        // Filter tujuan_ids yang masih valid
        if (!empty($existing['tujuan_ids'])) {
            $currentTujuanIds = explode(',', $existing['tujuan_ids']);
            $filteredTujuanIds = array_intersect($currentTujuanIds, $validTujuanList);
            $newTujuanIds = implode(',', $filteredTujuanIds);
        } else {
            $newTujuanIds = '';
        }

        // Filter sasaran berdasarkan tujuan yang masih valid
        if (!empty($newTujuanIds)) {
            $validSasaranIds = $this->db->query("
                SELECT s.Id 
                FROM sasaranrpjmd s
                WHERE s._Id IN (" . $newTujuanIds . ") 
                AND s.KodeWilayah = ?
                AND s.deleted_at IS NULL
            ", array($_SESSION['KodeWilayah']))->result_array();
            
            $validSasaranList = array_column($validSasaranIds, 'Id');
            
            // Filter sasaran_ids yang masih valid
            if (!empty($existing['sasaran_ids'])) {
                $currentSasaranIds = explode(',', $existing['sasaran_ids']);
                $filteredSasaranIds = array_intersect($currentSasaranIds, $validSasaranList);
                $newSasaranIds = implode(',', $filteredSasaranIds);
            } else {
                $newSasaranIds = '';
            }
        } else {
            $newSasaranIds = '';
        }

        // Update dengan data yang difilter, dan kosongkan indikator (IKD)
        $data = [
            'IdMisi' => $newMisiId,
            'tujuan_ids' => $newTujuanIds,
            'sasaran_ids' => $newSasaranIds,
            'indikator' => null,  // Hapus data IKD jika misi berubah
            'tahun_mulai' => (int)$period[0],
            'tahun_akhir' => (int)$period[1],
            'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
            'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
            'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
            'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
            'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
            'updated_at' => date('Y-m-d H:i:s')
        ];
    } else {
        // Jika misi tidak berubah, update normal tanpa memaksa indikator
        $data = [
            'IdMisi' => $newMisiId,
            'tahun_mulai' => (int)$period[0],
            'tahun_akhir' => (int)$period[1],
            'target_1' => $this->input->post('target_1') ? (int)$this->input->post('target_1') : null,
            'target_2' => $this->input->post('target_2') ? (int)$this->input->post('target_2') : null,
            'target_3' => $this->input->post('target_3') ? (int)$this->input->post('target_3') : null,
            'target_4' => $this->input->post('target_4') ? (int)$this->input->post('target_4') : null,
            'target_5' => $this->input->post('target_5') ? (int)$this->input->post('target_5') : null,
            'updated_at' => date('Y-m-d H:i:s')
        ];
    }
    
    $this->db->where('id', $id);
    $this->db->update('cascade_indikator', $data);
    if ($this->db->affected_rows()) {
        echo '1';
    } else {
        echo 'Gagal Update Data!';
    }
}

    // Hapus data cascade (soft delete)
    public function HapusCascade() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        $id = $this->input->post('id', TRUE);
        if (!is_numeric($id)) {
            echo '0';
            return;
        }
        $this->db->where('id', $id)->update('cascade_indikator', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        echo $this->db->affected_rows() ? '1' : '0';
    }

 // Di Controller Daerah.php - Tambahkan method baru untuk PD Cascade

public function TambahPdCascade() {
    try {
        $id = $this->input->post('id', true);
        $type = $this->input->post('type', true); // 'pj' atau 'pn'
        $pd_values = $this->input->post('pd_values', true);

        if (empty($id) || !is_numeric($id)) {
            throw new Exception('Invalid ID');
        }
        if (empty($type) || !in_array($type, ['pj', 'pn'])) {
            throw new Exception('Invalid PD type');
        }
        if (empty($pd_values)) {
            throw new Exception('PD values harus diisi');
        }

        // Get existing data dari cascade_indikator
        $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
        if (!$existing) {
            throw new Exception('Data Cascade tidak ditemukan');
        }

        // Prepare update data berdasarkan type
        $updateData = ['updated_at' => date('Y-m-d H:i:s')];
        
        if ($type === 'pj') {
            $existingPJ = !empty($existing['pd_penanggung_jawab']) ? explode(',', $existing['pd_penanggung_jawab']) : [];
            $newPJ = explode(',', $pd_values);
            $combinedPJ = array_unique(array_merge($existingPJ, $newPJ));
            $updateData['pd_penanggung_jawab'] = implode(',', array_filter($combinedPJ));
        } else {
            $existingPN = !empty($existing['pd_penunjang']) ? explode(',', $existing['pd_penunjang']) : [];
            $newPN = explode(',', $pd_values);
            $combinedPN = array_unique(array_merge($existingPN, $newPN));
            $updateData['pd_penunjang'] = implode(',', array_filter($combinedPN));
        }

        // Update cascade_indikator (bukan ikd)
        $this->db->where('id', $id)->update('cascade_indikator', $updateData);

        if ($this->db->affected_rows() > 0) {
            echo '1';
        } else {
            throw new Exception('No changes made');
        }
    } catch (Exception $e) {
        log_message('error', 'Error adding PD Cascade: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

public function EditPDCascade() {  
    try {
        $id = $this->input->post('id', true);
        $pd_penanggung_jawab = $this->input->post('pd_penanggung_jawab', true);
        $pd_penunjang = $this->input->post('pd_penunjang', true);

        if (empty($id) || !is_numeric($id)) {
            throw new Exception('ID tidak valid');
        }

        $updateData = ['updated_at' => date('Y-m-d H:i:s')];
        
        // Ubah kondisi: Gunakan isset() agar bisa update ke string kosong
        if (isset($pd_penanggung_jawab)) {
            $updateData['pd_penanggung_jawab'] = $pd_penanggung_jawab;  // Bisa kosong untuk hapus semua
        }
        
        if (isset($pd_penunjang)) {
            $updateData['pd_penunjang'] = $pd_penunjang;  // Bisa kosong untuk hapus semua
        }

        // Update cascade_indikator
        $this->db->where('id', $id)->update('cascade_indikator', $updateData);
        
        if ($this->db->affected_rows() > 0) {
            echo '1';
        } else {
            echo 'Tidak ada perubahan data';
        }
    } catch (Exception $e) {
        log_message('error', 'Error editing PD Cascade: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

public function TambahTujuanCascade() {
    try {
        $id = $this->input->post('id', true);
        $tujuan_ids = $this->input->post('tujuan_ids', true);

        if (empty($id) || !is_numeric($id)) {
            throw new Exception('ID tidak valid');
        }
        if (empty($tujuan_ids)) {
            throw new Exception('Tujuan harus dipilih');
        }

        // Get existing data
        $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
        if (!$existing) {
            throw new Exception('Data Cascade tidak ditemukan');
        }

        // Combine with existing tujuan_ids
        $existingTujuan = !empty($existing['tujuan_ids']) ? explode(',', $existing['tujuan_ids']) : [];
        $newTujuan = explode(',', $tujuan_ids);
        $combinedTujuan = array_unique(array_merge($existingTujuan, $newTujuan));
        
        // Sort untuk konsistensi
        sort($combinedTujuan);
        
        $newTujuanIds = implode(',', array_filter($combinedTujuan));
        
        // Debug logging
        log_message('debug', 'Existing tujuan: ' . $existing['tujuan_ids']);
        log_message('debug', 'New tujuan: ' . $tujuan_ids);
        log_message('debug', 'Combined tujuan: ' . $newTujuanIds);

        // Cek apakah ada perubahan
        if ($existing['tujuan_ids'] === $newTujuanIds) {
            echo '1'; // Data sama, tetap return success
            return;
        }

        $updateData = [
            'tujuan_ids' => $newTujuanIds,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id);
        $result = $this->db->update('cascade_indikator', $updateData);

        if ($result) {
            echo '1';
        } else {
            $error = $this->db->error();
            throw new Exception('Database error: ' . $error['message']);
        }
        
    } catch (Exception $e) {
        log_message('error', 'Error adding Tujuan Cascade: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

  // Update EditTujuanCascade di Controller (Daerah.php)
public function EditTujuanCascade(){  
    try {
        $cascadeId = $this->input->post('id', TRUE);
        $tujuanIds = $this->input->post('tujuan_ids', TRUE);
        $deletedTujuanIds = $this->input->post('deleted_tujuan_ids', TRUE);  // ID tujuan yang dihapus
        
        // Ambil data lama untuk cek
        $existing = $this->db->where('id', $cascadeId)->get('cascade_indikator')->row_array();
        if (!$existing) {
            throw new Exception('Data Cascade tidak ditemukan');
        }

        $previousTujuanIds = !empty($existing['tujuan_ids']) ? explode(',', $existing['tujuan_ids']) : [];
        
        // Update tujuan_ids
        $this->db->where('id', $cascadeId); 
        $this->db->update('cascade_indikator', [
            'tujuan_ids' => $tujuanIds,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // Jika ada tujuan dihapus, hapus sasaran terkait dan indikator
        if (!empty($deletedTujuanIds)) {
            $deletedIdsArray = explode(',', $deletedTujuanIds);
            
            // 1. Hapus sasaran terkait dengan tujuan yang dihapus
            $currentSasaranIds = !empty($existing['sasaran_ids']) ? explode(',', $existing['sasaran_ids']) : [];
            $sasaranToKeep = [];
            $sasaranToDelete = [];
            
            foreach ($currentSasaranIds as $sasaranId) {
                $sasaranData = $this->db->where('Id', $sasaranId)->get('sasaranrpjmd')->row_array();
                if ($sasaranData) {
                    // Jika sasaran terkait dengan tujuan yang dihapus
                    if (in_array($sasaranData['_Id'], $deletedIdsArray)) {
                        $sasaranToDelete[] = $sasaranId;
                    } else {
                        $sasaranToKeep[] = $sasaranId;
                    }
                }
            }
            
            // Update sasaran_ids dengan yang tersisa
            if (!empty($sasaranToDelete)) {
                $this->db->where('id', $cascadeId); 
                $this->db->update('cascade_indikator', [
                    'sasaran_ids' => implode(',', $sasaranToKeep),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
            
            // 2. Hapus indikator (IKU/IKD) jika ada sasaran yang dihapus
            if (!empty($sasaranToDelete)) {
                $this->db->where('id', $cascadeId); 
                $this->db->update('cascade_indikator', [
                    'indikator' => null,  // Hapus IKU/IKD terkait
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                
                log_message('debug', 'Indikator dihapus otomatis karena tujuan/sasaran dihapus: ' . $deletedTujuanIds);
            }
        }
        
        if ($this->db->affected_rows() > 0) {
            echo '1';
        } else {
            echo 'Tidak ada perubahan data';
        }
    } catch (Exception $e) {
        log_message('error', 'Error EditTujuanCascade: ' . $e->getMessage());
        echo 'Terjadi kesalahan sistem';
    }
}

  // New methods for Sasaran Cascade (similar to Tujuan)

  // Di Controller Daerah.php - GANTI method TambahSasaranCascade
public function TambahSasaranCascade() {
    try {
        $id = $this->input->post('id', true);
        $sasaran_ids = $this->input->post('sasaran_ids', true);

        if (empty($id) || !is_numeric($id)) {
            throw new Exception('ID tidak valid');
        }
        if (empty($sasaran_ids)) {
            throw new Exception('Sasaran harus dipilih');
        }

        // Get existing data
        $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
        if (!$existing) {
            throw new Exception('Data Cascade tidak ditemukan');
        }

        // Combine with existing sasaran_ids
        $existingSasaran = !empty($existing['sasaran_ids']) ? explode(',', $existing['sasaran_ids']) : [];
        $newSasaran = explode(',', $sasaran_ids);
        $combinedSasaran = array_unique(array_merge($existingSasaran, $newSasaran));
        
        // Sort untuk konsistensi
        sort($combinedSasaran);
        
        $newSasaranIds = implode(',', array_filter($combinedSasaran));
        
        // Debug logging
        log_message('debug', 'Existing sasaran: ' . $existing['sasaran_ids']);
        log_message('debug', 'New sasaran: ' . $sasaran_ids);
        log_message('debug', 'Combined sasaran: ' . $newSasaranIds);

        // Cek apakah ada perubahan
        if ($existing['sasaran_ids'] === $newSasaranIds) {
            echo '1'; // Data sama, tetap return success
            return;
        }

        $updateData = [
            'sasaran_ids' => $newSasaranIds,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->db->where('id', $id);
        $result = $this->db->update('cascade_indikator', $updateData);

        if ($result) {
            echo '1';
        } else {
            $error = $this->db->error();
            throw new Exception('Database error: ' . $error['message']);
        }
        
    } catch (Exception $e) {
        log_message('error', 'Error adding Sasaran Cascade: ' . $e->getMessage());
        echo $e->getMessage();
    }
}

 public function EditSasaranCascade() {
    try {
        $cascadeId = $this->input->post('id', TRUE);
        $sasaranIds = $this->input->post('sasaran_ids', TRUE);
        $deletedSasaranIds = $this->input->post('deleted_sasaran_ids', TRUE);  // Baru: ID sasaran yang dihapus
        
        // Ambil data lama untuk cek
        $existing = $this->db->where('id', $cascadeId)->get('cascade_indikator')->row_array();
        if (!$existing) {
            throw new Exception('Data Cascade tidak ditemukan');
        }

        $previousSasaranIds = !empty($existing['sasaran_ids']) ? explode(',', $existing['sasaran_ids']) : [];
        
        // Update sasaran_ids
        $this->db->where('id', $cascadeId); 
        $this->db->update('cascade_indikator', [
            'sasaran_ids' => $sasaranIds,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // Baru: Jika ada sasaran dihapus, kosongkan indikator (IKU/IKD)
        if (!empty($deletedSasaranIds)) {
            $this->db->where('id', $cascadeId); 
            $this->db->update('cascade_indikator', [
                'indikator' => null,  // Hapus IKU/IKD terkait
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            
            log_message('debug', 'Indikator dihapus otomatis karena sasaran dihapus: ' . $deletedSasaranIds);
        }
        
        if ($this->db->affected_rows() > 0) {
            echo '1';
        } else {
            echo 'Tidak ada perubahan data';
        }
    } catch (Exception $e) {
        log_message('error', 'Error EditSasaranCascade: ' . $e->getMessage());
        echo 'Terjadi kesalahan sistem';
    }
}

public function TambahIndikatorCascade() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = $this->input->post('id', TRUE);
    $indikator = $this->input->post('indikator', TRUE);
    
    if (empty($id) || !is_numeric($id)) {
        echo 'ID tidak valid';
        return;
    }
    if (empty($indikator)) {
        echo 'Indikator harus diisi';
        return;
    }
    
    // Ambil data existing
    $existing = $this->db->where('id', $id)->get('cascade_indikator')->row_array();
    if (!$existing) {
        echo 'Data Cascade tidak ditemukan';
        return;
    }
    
    // Jika sudah ada, append dengan newline atau replace jika kosong
    $currentIndikator = !empty($existing['indikator']) ? $existing['indikator'] . "\n" . $indikator : $indikator;
    
    $this->db->where('id', $id)->update('cascade_indikator', [
        'indikator' => trim($currentIndikator),
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() ? '1' : 'Gagal menambahkan indikator!';
}

// Edit Indikator Cascade
public function EditIndikatorCascade() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = $this->input->post('id', TRUE);
    $indikator = $this->input->post('indikator', TRUE);
    
    if (empty($id) || !is_numeric($id)) {
        echo 'ID tidak valid';
        return;
    }
    if (empty($indikator)) {
        echo 'Indikator harus diisi';
        return;
    }
    
    $this->db->where('id', $id)->update('cascade_indikator', [
        'indikator' => $indikator,
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() ? '1' : 'Gagal update indikator!';
}

// Hapus Indikator Cascade
public function HapusIndikatorCascade() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = $this->input->post('id', TRUE);
    
    if (empty($id) || !is_numeric($id)) {
        echo 'ID tidak valid';
        return;
    }
    
    $this->db->where('id', $id)->update('cascade_indikator', [
        'indikator' => null,
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() ? '1' : 'Gagal menghapus indikator!';
}

public function UrusanPD() {
    $Header['Halaman'] = 'Daerah';
    $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

    $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] :
                   (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

    $Data['KodeWilayah'] = $KodeWilayah;

    if (!empty($KodeWilayah)) {
        $Data['Urusan'] = $this->db
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL', null, false)
            ->order_by('nama_urusan', 'ASC')
            ->get('urusan_pd')
            ->result_array();
    } else {
        $Data['Urusan'] = []; // kalau belum pilih wilayah
    }

    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/Urusanpd', $Data);
}


public function InputUrusanPD() {

    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }

    $KodeWilayah = $_SESSION['KodeWilayah'];
    $nama = trim($this->input->post("nama_urusan", true));

    if ($nama == "") {
        echo "Nama urusan wajib diisi!";
        return;
    }

    $this->db->insert("urusan_pd", [
        "kodewilayah" => $KodeWilayah,
        "nama_urusan" => $nama,
        "created_at"  => date("Y-m-d H:i:s")
    ]);

    echo $this->db->affected_rows() ? "1" : "Gagal simpan data!";
}


public function EditUrusanPD() {

    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }

    $KodeWilayah = $_SESSION['KodeWilayah'];

    $id   = (int)$this->input->post("id", true);
    $nama = trim($this->input->post("nama_urusan", true));

    if ($id <= 0) { echo "ID tidak valid"; return; }
    if ($nama == "") { echo "Nama wajib diisi"; return; }

    $this->db->where("id", $id);
    $this->db->where("kodewilayah", $KodeWilayah);

    $this->db->update("urusan_pd", [
        "nama_urusan" => $nama,
        "updated_at"  => date("Y-m-d H:i:s")
    ]);

    echo $this->db->affected_rows() ? "1" : "Gagal update!";
}


public function HapusUrusanPD() {

    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }

    $KodeWilayah = $_SESSION['KodeWilayah'];

    $id = (int)$this->input->post("id", true);

    if ($id <= 0) {
        echo "ID tidak valid!";
        return;
    }

    $this->db->where("id", $id);
    $this->db->where("kodewilayah", $KodeWilayah);

    $this->db->update("urusan_pd", [
        "deleted_at" => date("Y-m-d H:i:s")
    ]);

    echo $this->db->affected_rows() ? "1" : "Gagal hapus!";
}

 public function ProgramPD()
    {
        $Header['Halaman'] = 'Daerah';

        // dropdown provinsi
        $Data['Provinsi'] = $this->db->where("Kode LIKE '__'")->get("kodewilayah")->result_array();

        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] :
                       (isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : '');

        $Data['KodeWilayah'] = '';
        $Data['NamaWilayah'] = '';
        $Data['Urusan'] = [];
        $Data['Sasaran'] = [];
        $Data['ProgramPD'] = [];

        if ($KodeWilayah) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            if ($wilayah) {
                $Data['KodeWilayah'] = $KodeWilayah;
                $Data['NamaWilayah'] = $wilayah['Nama'];

                // dropdown urusan
                $Data['Urusan'] = $this->db
                    ->where('deleted_at IS NULL', null, false)
                    ->order_by('nama_urusan', 'ASC')
                    ->get('urusan_pd')
                    ->result_array();

                // dropdown sasaran
                $Data['Sasaran'] = $this->db
                    ->where('KodeWilayah', $KodeWilayah)
                    ->where('deleted_at IS NULL', null, false)
                    ->order_by('Id', 'ASC')
                    ->get('sasaranrpjmd')
                    ->result_array();

              $Data['ProgramPD'] = $this->db->query("
                    SELECT 
                        p.*,
                        s.Sasaran,
                        (
                        SELECT GROUP_CONCAT(u.nama_urusan ORDER BY u.nama_urusan SEPARATOR '<br>')
                        FROM urusan_pd u
                        WHERE FIND_IN_SET(u.id, p.urusan_id)
                        ) AS nama_urusan
                    FROM program_pd p
                    LEFT JOIN sasaranrpjmd s ON s.Id = p.sasaran_id
                    WHERE p.deleted_at IS NULL
                    AND p.kodewilayah = ?
                    ORDER BY p.id ASC
                ", [$KodeWilayah])->result_array();

            }
        }

        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/program_pd', $Data);
    }

 public function InputProgramPD()
{
    if (!$this->input->is_ajax_request()) show_404();

    try {

        $kodeWilayah = $_SESSION['KodeWilayah'] ?? '';
        if (!$kodeWilayah) throw new Exception("Kode wilayah tidak ditemukan!");

        $sasaran_id = (int)$this->input->post("sasaran_id", TRUE);
        if ($sasaran_id <= 0) throw new Exception("Sasaran wajib dipilih!");

        $urusanArr = $this->input->post("urusan_id");
        if (!is_array($urusanArr) || count($urusanArr) < 1)
            throw new Exception("Minimal pilih 1 urusan!");

        $programArr = $this->input->post("program_pd");
        if (!is_array($programArr) || count($programArr) < 1)
            throw new Exception("Minimal isi 1 program!");

        $urusanCSV = implode(",", array_unique(array_map("intval", $urusanArr)));

        foreach ($programArr as $p) {
            $p = trim($p);
            if ($p === '') continue;

            $this->db->insert("program_pd", [
                "kodewilayah" => $kodeWilayah,
                "sasaran_id"  => $sasaran_id,
                "urusan_id"   => $urusanCSV,
                "program_pd"  => $p,
                "created_at"  => date("Y-m-d H:i:s"),
                "updated_at"  => date("Y-m-d H:i:s"),
            ]);
        }

        echo "1";

    } catch(Exception $e){
        echo $e->getMessage();
    }
}



public function EditProgramPD()
{
    if (!$this->input->is_ajax_request()) show_404();

    $id = (int)$this->input->post("id");
    $sasaran_id = (int)$this->input->post("sasaran_id");

    $urusanArr = $this->input->post("urusan_id");
    $programArr = $this->input->post("program_pd");

    if (!$id) exit("ID tidak valid!");
    if (!$sasaran_id) exit("Sasaran wajib!");

    $urusanCSV = implode(",", $urusanArr);

    // karena edit hanya 1 program
    $programText = trim($programArr[0]);

    $this->db->where("id", $id)->update("program_pd", [
        "sasaran_id" => $sasaran_id,
        "urusan_id"  => $urusanCSV,
        "program_pd" => $programText,
        "updated_at" => date("Y-m-d H:i:s")
    ]);

    echo "1";
}



    public function HapusProgramPD()
    {
        if (!$this->input->is_ajax_request()) show_404();

        try {
            $kodeWilayah = $_SESSION['KodeWilayah'] ?? '';
            if (!$kodeWilayah) throw new Exception("Kode wilayah tidak ditemukan!");

            $id = trim((string)$this->input->post("id", TRUE));
            if ($id === '') throw new Exception("id tidak valid!");

            $this->db->where("id", $id)
                     ->where("kodewilayah", $kodeWilayah)
                     ->where("deleted_at IS NULL", null, false)
                     ->update("program_pd", [
                         "deleted_at" => date("Y-m-d H:i:s"),
                         "updated_at" => date("Y-m-d H:i:s"),
                     ]);

            echo $this->db->affected_rows() ? "1" : "0";

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


        // =====================================================================
        // ULTIMATE OUTCOME (Level 1)
        // =====================================================================

        public function Ultimate_outcome()
        {
            $header['Halaman'] = 'Ultimate Outcome';

            $kodewilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah') ?? '';

            $data['KodeWilayah'] = $kodewilayah;
            $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                        ->order_by('Nama')
                                        ->get('kodewilayah')
                                        ->result_array();

            $data['items'] = [];

            if ($kodewilayah) {
                $data['items'] = $this->db
                    ->where('kode_wilayah', $kodewilayah)
                    ->where('deleted_at IS NULL')
                    ->order_by('id', 'ASC')
                    ->get('pk_ultimate_outcome')
                    ->result_array();
            }

            // Ambil Nama Wilayah
            if ($kodewilayah) {
                $wil = $this->db
                    ->where('Kode', $kodewilayah)
                    ->get('kodewilayah')
                    ->row_array();

                $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
            } else {
                $data['NamaWilayah'] = '';
            }

            $this->load->view('Daerah/header', $header);
            $this->load->view('Daerah/Ultimate_outcome', $data);
        }

        public function Ultimate_outcome_simpan()
        {
            if (!$this->input->is_ajax_request()) {
                show_404();
                return;
            }

            $kodewilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');

            if (!$kodewilayah) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Wilayah belum dipilih'
                ]);
                return;
            }

            $id       = $this->input->post('id', TRUE);
            $kinerja  = trim($this->input->post('kinerja', TRUE));
            $ind_list = $this->input->post('indikator') ?: [];

            if (empty($kinerja)) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Kinerja wajib diisi'
                ]);
                return;
            }

            $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

            $save = [
                'kode_wilayah' => $kodewilayah,
                'kinerja'      => $kinerja,
                'indikator'    => $indikator,
                'updated_at'   => date('Y-m-d H:i:s')
            ];

            if ($id) {
                $this->db->where('id', $id)
                        ->where('kode_wilayah', $kodewilayah)
                        ->update('pk_ultimate_outcome', $save);
                $msg = 'Data berhasil diperbarui';
            } else {
                $save['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('pk_ultimate_outcome', $save);
                $msg = 'Data berhasil ditambahkan';
            }

            echo json_encode([
                'status' => 'success',
                'message' => $msg
            ]);
            exit;
        }

        public function Ultimate_outcome_hapus()
        {
            if (!$this->input->is_ajax_request()) show_404();

            $id = $this->input->post('id', TRUE);
            $kodewilayah = $this->session->userdata('KodeWilayah') 
                        ?? $this->session->userdata('TempKodeWilayah');

            if (!$id || !$kodewilayah) {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Parameter tidak lengkap'
                ]);
                exit;
            }

            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->update('pk_ultimate_outcome', ['deleted_at' => date('Y-m-d H:i:s')]);

            $status = $this->db->affected_rows() > 0 ? 'success' : 'error';

            echo json_encode([
                'status' => $status,
                'message' => 'Data berhasil dihapus'
            ]);
            exit;
        }

       /**
     * =====================================================================
     * INTERMEDIATE OUTCOME SEKTOR (Level 2)
     * =====================================================================
     */
    public function Intermediate_sektor()
    {
        $header['Halaman'] = 'Intermediate Outcome Sektor';

        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';

        $data['KodeWilayah'] = $kodewilayah;
        $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                    ->order_by('Nama')
                                    ->get('kodewilayah')
                                    ->result_array();

        $data['items'] = [];
        $data['ultimate_options'] = [];

        if ($kodewilayah) {
            // Ambil data intermediate sektor dengan join ke ultimate outcome
            $this->db->select('s.*, u.kinerja as ultimate_kinerja');
            $this->db->from('pk_intermediate_sektor s');
            $this->db->join('pk_ultimate_outcome u', 'u.id = s.ultimate_outcome_id', 'left');
            $this->db->where('s.kode_wilayah', $kodewilayah);
            $this->db->where('s.deleted_at IS NULL');
            $this->db->order_by('s.id', 'ASC');
            $data['items'] = $this->db->get()->result_array();

            // Ambil options untuk ultimate outcome
            $data['ultimate_options'] = $this->db
                ->select('id, kinerja')
                ->where('kode_wilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('pk_ultimate_outcome')
                ->result_array();
        }

        // Ambil Nama Wilayah
        if ($kodewilayah) {
            $wil = $this->db
                ->where('Kode', $kodewilayah)
                ->get('kodewilayah')
                ->row_array();

            $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
        } else {
            $data['NamaWilayah'] = '';
        }

        $this->load->view('Daerah/header', $header);
        $this->load->view('Daerah/Intermediate_sektor', $data);
    }

    /**
     * =====================================================================
     * GET DAFTAR DINAS (akun_instansi Level 2)
     * =====================================================================
     */
    public function get_daftar_dinas()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        // Ambil data dinas dari akun_instansi dengan Level 2
        $dinas = $this->db
            ->select('id, nama')
            ->from('akun_instansi')
            ->where('Level', 2)
            ->where('kodewilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($dinas);
        exit;
    }

    /**
     * =====================================================================
     * GET PELAKSANA BY DINAS (FILTER) - MEMAKAI FIND_IN_SET
     * =====================================================================
     */
    public function get_pelaksana_by_dinas()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        $dinas_id = $this->input->post('dinas_id', TRUE);
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        $this->db->select('
            akun_karyawan.id,
            akun_karyawan.nama,
            akun_karyawan.nip,
            akun_karyawan.jabatan,
            akun_karyawan.dinas_id,
            GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
        ')
        ->from('akun_karyawan')
        ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
        ->where('akun_karyawan.Level', 4)
        ->where('akun_karyawan.kodewilayah', $kodewilayah)
        ->where('akun_karyawan.deleted_at IS NULL');
        
        // Filter berdasarkan dinas jika dipilih (menggunakan FIND_IN_SET)
        if (!empty($dinas_id) && $dinas_id != '') {
            $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
        }
        
        $pelaksana = $this->db
            ->group_by('akun_karyawan.id')
            ->order_by('akun_karyawan.nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($pelaksana);
        exit;
    }

    /**
     * =====================================================================
     * GET DETAIL PELAKSANA (untuk edit)
     * =====================================================================
     */
    public function get_pelaksana_detail()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$id || !$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        $detail = $this->db
            ->select('id, nama, nip, jabatan, dinas_id')
            ->from('akun_karyawan')
            ->where('id', $id)
            ->where('kodewilayah', $kodewilayah)
            ->where('Level', 4)
            ->where('deleted_at IS NULL')
            ->get()
            ->row_array();

        echo json_encode($detail);
        exit;
    }

    /**
     * =====================================================================
     * SIMPAN INTERMEDIATE SEKTOR
     * =====================================================================
     */
    public function Intermediate_sektor_simpan()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$kodewilayah) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Wilayah belum dipilih'
            ]);
            return;
        }

        $id               = $this->input->post('id', TRUE);
        $ultimate_id      = $this->input->post('ultimate_id', TRUE);
        $kinerja          = trim($this->input->post('kinerja', TRUE));
        $ind_list         = $this->input->post('indikator') ?: [];
        $pelaksana_id     = $this->input->post('pelaksana', TRUE);
        $inovasi          = $this->input->post('inovasi_daerah', TRUE);
        $outcome_inovasi  = $this->input->post('outcome_inovasi', TRUE);
        $output_inovasi   = $this->input->post('output_inovasi', TRUE);
        $crosscutting     = $this->input->post('crosscutting');

        if (empty($kinerja)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kinerja wajib diisi'
            ]);
            return;
        }

        // Validasi pelaksana exists di tabel akun_karyawan berdasarkan ID
        if ($pelaksana_id) {
            $exists = $this->db
                ->where('id', $pelaksana_id)
                ->where('Level', 4)
                ->where('kodewilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->count_all_results('akun_karyawan');
                
            if (!$exists) {
                echo json_encode([
                    'status'=>'error',
                    'message'=>'Pelaksana tidak valid atau tidak ditemukan'
                ]);
                return;
            }
        }

        $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

        // Handle crosscutting - jika array, encode ke JSON
        $crosscutting_json = null;
        if (!empty($crosscutting) && is_array($crosscutting)) {
            $crosscutting_json = json_encode($crosscutting);
        }

        $save = [
            'kode_wilayah'            => $kodewilayah,
            'ultimate_outcome_id'     => $ultimate_id ?: NULL,
            'kinerja'                 => $kinerja,
            'indikator'               => $indikator,
            'pelaksana'               => $pelaksana_id ?: NULL,
            'inovasi_daerah'          => $inovasi ?: NULL,
            'outcome_inovasi'         => $outcome_inovasi ?: NULL,
            'output_inovasi'          => $output_inovasi ?: NULL,
            'crosscutting'            => $crosscutting_json,
            'updated_at'              => date('Y-m-d H:i:s')
        ];

        if ($id) {
            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->update('pk_intermediate_sektor', $save);
            $msg = 'Data berhasil diperbarui';
        } else {
            $save['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('pk_intermediate_sektor', $save);
            $msg = 'Data berhasil ditambahkan';
        }

        echo json_encode([
            'status' => 'success',
            'message' => $msg
        ]);
        exit;
    }

    /**
     * =====================================================================
     * HAPUS INTERMEDIATE SEKTOR
     * =====================================================================
     */
    public function Intermediate_sektor_hapus()
    {
        if (!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$id || !$kodewilayah) {
            echo json_encode([
                'status'=>'error',
                'message'=>'Parameter tidak lengkap'
            ]);
            exit;
        }

        // Cek dulu apakah data ada
        $exists = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->get('pk_intermediate_sektor')
            ->row();

        if (!$exists) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
            exit;
        }

        $this->db->where('id', $id)
                ->where('kode_wilayah', $kodewilayah)
                ->update('pk_intermediate_sektor', ['deleted_at' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal menghapus data'
            ]);
        }
        exit;
    }

       /**
     * =====================================================================
     * INTERMEDIATE OUTCOME TAKTIKAL (Level 3)
     * =====================================================================
     */
    public function Intermediate_taktikal()
    {
        $header['Halaman'] = 'Intermediate Outcome Taktikal';

        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';

        $data['KodeWilayah'] = $kodewilayah;
        $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                    ->order_by('Nama')
                                    ->get('kodewilayah')
                                    ->result_array();

        $data['items'] = [];
        $data['sektor_options'] = [];

        if ($kodewilayah) {
            // Ambil data dengan join ke sektor
            $this->db->select('t.*, s.kinerja as sektor_kinerja');
            $this->db->from('pk_intermediate_taktikal t');
            $this->db->join('pk_intermediate_sektor s', 's.id = t.intermediate_sektor_id', 'left');
            $this->db->where('t.kode_wilayah', $kodewilayah);
            $this->db->where('t.deleted_at IS NULL');
            $this->db->order_by('t.id', 'ASC');
            $data['items'] = $this->db->get()->result_array();

            // Ambil options untuk intermediate sektor (Level 2)
            $data['sektor_options'] = $this->db
                ->select('id, kinerja')
                ->where('kode_wilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('pk_intermediate_sektor')
                ->result_array();
        }

        // Ambil Nama Wilayah
        if ($kodewilayah) {
            $wil = $this->db
                ->where('Kode', $kodewilayah)
                ->get('kodewilayah')
                ->row_array();

            $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
        } else {
            $data['NamaWilayah'] = '';
        }

        $this->load->view('Daerah/header', $header);
        $this->load->view('Daerah/Intermediate_taktikal', $data);
    }

    /**
     * =====================================================================
     * GET DAFTAR DINAS UNTUK TAKTIKAL
     * =====================================================================
     */
    public function get_daftar_dinas_taktikal()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        // Ambil data dinas dari akun_instansi dengan Level 2
        $dinas = $this->db
            ->select('id, nama')
            ->from('akun_instansi')
            ->where('Level', 2)
            ->where('kodewilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($dinas);
        exit;
    }

    /**
     * =====================================================================
     * GET PELAKSANA BY DINAS UNTUK TAKTIKAL
     * =====================================================================
     */
    public function get_pelaksana_taktikal_by_dinas()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        $dinas_id = $this->input->post('dinas_id', TRUE);
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        $this->db->select('
            akun_karyawan.id,
            akun_karyawan.nama,
            akun_karyawan.nip,
            akun_karyawan.jabatan,
            akun_karyawan.dinas_id,
            GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
        ')
        ->from('akun_karyawan')
        ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
        ->where('akun_karyawan.Level', 4)
        ->where('akun_karyawan.kodewilayah', $kodewilayah)
        ->where('akun_karyawan.deleted_at IS NULL');
        
        // Filter berdasarkan dinas jika dipilih
        if (!empty($dinas_id) && $dinas_id != '') {
            $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
        }
        
        $pelaksana = $this->db
            ->group_by('akun_karyawan.id')
            ->order_by('akun_karyawan.nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($pelaksana);
        exit;
    }

    /**
     * =====================================================================
     * GET DETAIL PELAKSANA UNTUK TAKTIKAL (untuk edit)
     * =====================================================================
     */
    public function get_pelaksana_taktikal_detail()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$id || !$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        $detail = $this->db
            ->select('id, nama, nip, jabatan, dinas_id')
            ->from('akun_karyawan')
            ->where('id', $id)
            ->where('kodewilayah', $kodewilayah)
            ->where('Level', 4)
            ->where('deleted_at IS NULL')
            ->get()
            ->row_array();

        echo json_encode($detail);
        exit;
    }

    /**
     * =====================================================================
     * GET PELAKSANA LEVEL 4 (SEMUA) - untuk fallback
     * =====================================================================
     */
    public function get_pelaksana_taktikal()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        // Ambil data pelaksana dari tabel akun_karyawan dengan Level 4
        $pelaksana = $this->db
            ->select('
                akun_karyawan.id,
                akun_karyawan.nama,
                akun_karyawan.nip,
                akun_karyawan.jabatan,
                akun_karyawan.dinas_id,
                GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
            ')
            ->from('akun_karyawan')
            ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
            ->where('akun_karyawan.Level', 4)
            ->where('akun_karyawan.kodewilayah', $kodewilayah)
            ->where('akun_karyawan.deleted_at IS NULL')
            ->group_by('akun_karyawan.id')
            ->order_by('akun_karyawan.nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($pelaksana);
        exit;
    }

    /**
     * =====================================================================
     * SIMPAN INTERMEDIATE TAKTIKAL
     * =====================================================================
     */
    public function Intermediate_taktikal_simpan()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$kodewilayah) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Wilayah belum dipilih'
            ]);
            return;
        }

        $id               = $this->input->post('id', TRUE);
        $sektor_id        = $this->input->post('sektor_id', TRUE);
        $kinerja          = trim($this->input->post('kinerja', TRUE));
        $ind_list         = $this->input->post('indikator') ?: [];
        $pelaksana_id     = $this->input->post('pelaksana', TRUE); // BERISI ID
        $inovasi          = $this->input->post('inovasi_daerah', TRUE);
        $outcome_inovasi  = $this->input->post('outcome_inovasi', TRUE);
        $output_inovasi   = $this->input->post('output_inovasi', TRUE);
        $crosscutting     = $this->input->post('crosscutting');

        if (empty($kinerja)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kinerja wajib diisi'
            ]);
            return;
        }

        // Validasi pelaksana exists di tabel akun_karyawan berdasarkan ID
        if ($pelaksana_id) {
            $exists = $this->db
                ->where('id', $pelaksana_id)
                ->where('Level', 4)
                ->where('kodewilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->count_all_results('akun_karyawan');
                
            if (!$exists) {
                echo json_encode([
                    'status'=>'error',
                    'message'=>'Pelaksana tidak valid atau tidak ditemukan'
                ]);
                return;
            }
        }

        $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

        // Handle crosscutting - jika array, encode ke JSON
        $crosscutting_json = null;
        if (!empty($crosscutting) && is_array($crosscutting)) {
            $crosscutting_json = json_encode($crosscutting);
        }

        $save = [
            'kode_wilayah'             => $kodewilayah,
            'intermediate_sektor_id'   => $sektor_id ?: NULL,
            'kinerja'                  => $kinerja,
            'indikator'                => $indikator,
            'pelaksana'                => $pelaksana_id ?: NULL,
            'inovasi_daerah'           => $inovasi ?: NULL,
            'outcome_inovasi'          => $outcome_inovasi ?: NULL,
            'output_inovasi'           => $output_inovasi ?: NULL,
            'crosscutting'             => $crosscutting_json,
            'updated_at'               => date('Y-m-d H:i:s')
        ];

        if ($id) {
            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->update('pk_intermediate_taktikal', $save);
            $msg = 'Data berhasil diperbarui';
        } else {
            $save['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('pk_intermediate_taktikal', $save);
            $msg = 'Data berhasil ditambahkan';
        }

        echo json_encode([
            'status' => 'success',
            'message' => $msg
        ]);
        exit;
    }

    /**
     * =====================================================================
     * HAPUS INTERMEDIATE TAKTIKAL
     * =====================================================================
     */
    public function Intermediate_taktikal_hapus()
    {
        if (!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$id || !$kodewilayah) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter tidak lengkap'
            ]);
            exit;
        }

        // Cek dulu apakah data ada
        $exists = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->get('pk_intermediate_taktikal')
            ->row();

        if (!$exists) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
            exit;
        }

        $this->db->where('id', $id)
                ->where('kode_wilayah', $kodewilayah)
                ->update('pk_intermediate_taktikal', ['deleted_at' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal menghapus data'
            ]);
        }
        exit;
    }

           /**
     * =====================================================================
     * IMMEDIATE OUTCOME (Level 4)
     * =====================================================================
     */
    public function Immediate_outcome()
    {
        $header['Halaman'] = 'Immediate Outcome';

        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';

        $data['KodeWilayah'] = $kodewilayah;
        $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                    ->order_by('Nama')
                                    ->get('kodewilayah')
                                    ->result_array();

        $data['items'] = [];
        $data['taktikal_options'] = [];

        if ($kodewilayah) {
            // Ambil data dengan join ke taktikal
            $this->db->select('i.*, t.kinerja as taktikal_kinerja');
            $this->db->from('pk_immediate_outcome i');
            $this->db->join('pk_intermediate_taktikal t', 't.id = i.intermediate_taktikal_id', 'left');
            $this->db->where('i.kode_wilayah', $kodewilayah);
            $this->db->where('i.deleted_at IS NULL');
            $this->db->order_by('i.id', 'ASC');
            $data['items'] = $this->db->get()->result_array();

            // Ambil options untuk intermediate taktikal (Level 3)
            $data['taktikal_options'] = $this->db
                ->select('id, kinerja')
                ->where('kode_wilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('pk_intermediate_taktikal')
                ->result_array();
        }

        // Ambil Nama Wilayah
        if ($kodewilayah) {
            $wil = $this->db
                ->where('Kode', $kodewilayah)
                ->get('kodewilayah')
                ->row_array();

            $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
        } else {
            $data['NamaWilayah'] = '';
        }

        $this->load->view('Daerah/header', $header);
        $this->load->view('Daerah/Immediate_outcome', $data);
    }

    /**
     * =====================================================================
     * GET DAFTAR DINAS UNTUK IMMEDIATE OUTCOME
     * =====================================================================
     */
    public function get_daftar_dinas_immediate()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        // Ambil data dinas dari akun_instansi dengan Level 2
        $dinas = $this->db
            ->select('id, nama')
            ->from('akun_instansi')
            ->where('Level', 2)
            ->where('kodewilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($dinas);
        exit;
    }

    /**
     * =====================================================================
     * GET PELAKSANA BY DINAS UNTUK IMMEDIATE OUTCOME
     * =====================================================================
     */
    public function get_pelaksana_immediate_by_dinas()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        $dinas_id = $this->input->post('dinas_id', TRUE);
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        $this->db->select('
            akun_karyawan.id,
            akun_karyawan.nama,
            akun_karyawan.nip,
            akun_karyawan.jabatan,
            akun_karyawan.dinas_id,
            GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
        ')
        ->from('akun_karyawan')
        ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
        ->where('akun_karyawan.Level', 4)
        ->where('akun_karyawan.kodewilayah', $kodewilayah)
        ->where('akun_karyawan.deleted_at IS NULL');
        
        // Filter berdasarkan dinas jika dipilih
        if (!empty($dinas_id) && $dinas_id != '') {
            $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
        }
        
        $pelaksana = $this->db
            ->group_by('akun_karyawan.id')
            ->order_by('akun_karyawan.nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($pelaksana);
        exit;
    }

    /**
     * =====================================================================
     * GET DETAIL PELAKSANA UNTUK IMMEDIATE OUTCOME (untuk edit)
     * =====================================================================
     */
    public function get_pelaksana_immediate_detail()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$id || !$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        $detail = $this->db
            ->select('id, nama, nip, jabatan, dinas_id')
            ->from('akun_karyawan')
            ->where('id', $id)
            ->where('kodewilayah', $kodewilayah)
            ->where('Level', 4)
            ->where('deleted_at IS NULL')
            ->get()
            ->row_array();

        echo json_encode($detail);
        exit;
    }

    /**
     * =====================================================================
     * GET PELAKSANA LEVEL 4 (SEMUA) - untuk fallback
     * =====================================================================
     */
    public function get_pelaksana_immediate()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        // Ambil data pelaksana dari tabel akun_karyawan dengan Level 4
        $pelaksana = $this->db
            ->select('
                akun_karyawan.id,
                akun_karyawan.nama,
                akun_karyawan.nip,
                akun_karyawan.jabatan,
                akun_karyawan.dinas_id,
                GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
            ')
            ->from('akun_karyawan')
            ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
            ->where('akun_karyawan.Level', 4)
            ->where('akun_karyawan.kodewilayah', $kodewilayah)
            ->where('akun_karyawan.deleted_at IS NULL')
            ->group_by('akun_karyawan.id')
            ->order_by('akun_karyawan.nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($pelaksana);
        exit;
    }

    /**
     * =====================================================================
     * SIMPAN IMMEDIATE OUTCOME
     * =====================================================================
     */
    public function Immediate_outcome_simpan()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }

        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$kodewilayah) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Wilayah belum dipilih'
            ]);
            return;
        }

        $id               = $this->input->post('id', TRUE);
        $taktikal_id      = $this->input->post('taktikal_id', TRUE);
        $kinerja          = trim($this->input->post('kinerja', TRUE));
        $ind_list         = $this->input->post('indikator') ?: [];
        $pelaksana_id     = $this->input->post('pelaksana', TRUE);
        $inovasi          = $this->input->post('inovasi_daerah', TRUE);
        $outcome_inovasi  = $this->input->post('outcome_inovasi', TRUE);
        $output_inovasi   = $this->input->post('output_inovasi', TRUE);
        $crosscutting     = $this->input->post('crosscutting');

        if (empty($kinerja)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kinerja wajib diisi'
            ]);
            return;
        }

        // Validasi pelaksana exists di tabel akun_karyawan berdasarkan ID
        if ($pelaksana_id) {
            $exists = $this->db
                ->where('id', $pelaksana_id)
                ->where('Level', 4)
                ->where('kodewilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->count_all_results('akun_karyawan');
                
            if (!$exists) {
                echo json_encode([
                    'status'=>'error',
                    'message'=>'Pelaksana tidak valid atau tidak ditemukan'
                ]);
                return;
            }
        }

        $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

        // Handle crosscutting - jika array, encode ke JSON
        $crosscutting_json = null;
        if (!empty($crosscutting) && is_array($crosscutting)) {
            $crosscutting_json = json_encode($crosscutting);
        }

        $save = [
            'kode_wilayah'              => $kodewilayah,
            'intermediate_taktikal_id'  => $taktikal_id ?: NULL,
            'kinerja'                   => $kinerja,
            'indikator'                 => $indikator,
            'pelaksana'                 => $pelaksana_id ?: NULL,
            'inovasi_daerah'            => $inovasi ?: NULL,
            'outcome_inovasi'           => $outcome_inovasi ?: NULL,
            'output_inovasi'            => $output_inovasi ?: NULL,
            'crosscutting'              => $crosscutting_json,
            'updated_at'                => date('Y-m-d H:i:s')
        ];

        if ($id) {
            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->update('pk_immediate_outcome', $save);
            $msg = 'Data berhasil diperbarui';
        } else {
            $save['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('pk_immediate_outcome', $save);
            $msg = 'Data berhasil ditambahkan';
        }

        echo json_encode([
            'status' => 'success',
            'message' => $msg
        ]);
        exit;
    }

    /**
     * =====================================================================
     * HAPUS IMMEDIATE OUTCOME
     * =====================================================================
     */
    public function Immediate_outcome_hapus()
    {
        if (!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$id || !$kodewilayah) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter tidak lengkap'
            ]);
            exit;
        }

        // Cek dulu apakah data ada
        $exists = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->get('pk_immediate_outcome')
            ->row();

        if (!$exists) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
            exit;
        }

        $this->db->where('id', $id)
                ->where('kode_wilayah', $kodewilayah)
                ->update('pk_immediate_outcome', ['deleted_at' => date('Y-m-d H:i:s')]);

        if ($this->db->affected_rows() > 0) {
            echo json_encode([
                'status'  => 'success',
                'message' => 'Data berhasil dihapus'
            ]);
        } else {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Gagal menghapus data'
            ]);
        }
        exit;
    }


         /**
     * ======================================================
     * TAMPIL POHON KINERJA (5 Level)
     * ======================================================
     */
    public function TampilPohonKinerja()
    {
        // ==============================
        // 1. CEK SESSION WILAYAH
        // ==============================
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';

        $data['KodeWilayah'] = $kodewilayah;
        $data['Provinsi'] = $this->GetListProvinsiData();
        $data['NamaWilayah'] = '';
        $data['TotalData'] = [
            'level1' => 0,
            'level2' => 0,
            'level3' => 0,
            'level4' => 0,
            'level5' => 0
        ];
        $data['ChartData'] = json_encode(['nama' => 'ROOT', 'children' => []]);

        // ==============================
        // 2. JIKA WILAYAH SUDAH DIPILIH, AMBIL DATA
        // ==============================
        if (!empty($kodewilayah)) {
            
            // Ambil Nama Wilayah
            $wil = $this->db
                ->where('Kode', $kodewilayah)
                ->get('kodewilayah')
                ->row_array();

            $data['NamaWilayah'] = $wil ? $wil['Nama'] : 'Wilayah Tidak Dikenal';

            // Ambil semua data pelaksana untuk mapping ID ke nama
            $pelaksana_map = $this->getPelaksanaMap($kodewilayah);

            // ==================================================
            // Ambil Ultimate Outcome (Level 1)
            // ==================================================
            $ultimate = $this->db
                ->select('
                    id, 
                    kinerja as nama,
                    indikator
                ')
                ->where('kode_wilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('pk_ultimate_outcome')
                ->result_array();

            // ==================================================
            // Ambil Intermediate Sektor (Level 2)
            // ==================================================
            $sektor = $this->db
                ->select('
                    s.id, 
                    s.kinerja as nama,
                    s.indikator,
                    s.pelaksana,
                    s.inovasi_daerah as inovasi,
                    s.outcome_inovasi,
                    s.output_inovasi,
                    s.crosscutting,
                    s.ultimate_outcome_id as parent_id
                ')
                ->from('pk_intermediate_sektor s')
                ->where('s.kode_wilayah', $kodewilayah)
                ->where('s.deleted_at IS NULL')
                ->order_by('s.id', 'ASC')
                ->get()
                ->result_array();

            // ==================================================
            // Ambil Intermediate Taktikal (Level 3)
            // ==================================================
            $taktikal = $this->db
                ->select('
                    t.id, 
                    t.kinerja as nama,
                    t.indikator,
                    t.pelaksana,
                    t.inovasi_daerah as inovasi,
                    t.outcome_inovasi,
                    t.output_inovasi,
                    t.crosscutting,
                    t.intermediate_sektor_id as parent_id
                ')
                ->from('pk_intermediate_taktikal t')
                ->where('t.kode_wilayah', $kodewilayah)
                ->where('t.deleted_at IS NULL')
                ->order_by('t.id', 'ASC')
                ->get()
                ->result_array();

            // ==================================================
            // Ambil Immediate Outcome (Level 4)
            // ==================================================
            $immediate = $this->db
                ->select('
                    i.id, 
                    i.kinerja as nama,
                    i.indikator,
                    i.pelaksana,
                    i.inovasi_daerah as inovasi,
                    i.outcome_inovasi,
                    i.output_inovasi,
                    i.crosscutting,
                    i.intermediate_taktikal_id as parent_id
                ')
                ->from('pk_immediate_outcome i')
                ->where('i.kode_wilayah', $kodewilayah)
                ->where('i.deleted_at IS NULL')
                ->order_by('i.id', 'ASC')
                ->get()
                ->result_array();

            // ==================================================
            // Ambil Output (Level 5)
            // ==================================================
            $output = $this->db
                ->select('
                    o.id, 
                    o.kinerja as nama,
                    o.indikator,
                    o.pelaksana,
                    o.inovasi_daerah as inovasi,
                    o.outcome_inovasi,
                    o.output_inovasi,
                    o.crosscutting,
                    o.immediate_outcome_id as parent_id
                ')
                ->from('pk_output o')
                ->where('o.kode_wilayah', $kodewilayah)
                ->where('o.deleted_at IS NULL')
                ->order_by('o.id', 'ASC')
                ->get()
                ->result_array();

            // Update total data
            $data['TotalData'] = [
                'level1' => count($ultimate),
                'level2' => count($sektor),
                'level3' => count($taktikal),
                'level4' => count($immediate),
                'level5' => count($output)
            ];

            // Konversi ID pelaksana ke nama dan tambahkan detail
            $sektor = $this->enrichWithPelaksanaDetail($sektor, $pelaksana_map);
            $taktikal = $this->enrichWithPelaksanaDetail($taktikal, $pelaksana_map);
            $immediate = $this->enrichWithPelaksanaDetail($immediate, $pelaksana_map);
            $output = $this->enrichWithPelaksanaDetail($output, $pelaksana_map);

            // ==============================
            // 3. STRUKTURKAN DATA UNTUK TREE
            // ==============================
            $tree_data = $this->buildTreeData($ultimate, $sektor, $taktikal, $immediate, $output);

            // ==============================
            // 4. FORMAT UNTUK VIEW
            // ==============================
            $chart_data = [
                'nama' => 'ROOT',
                'children' => $tree_data
            ];

            $data['ChartData'] = json_encode($chart_data);
        }

        // ==============================
        // 5. LOAD VIEW
        // ==============================
        $header['Halaman'] = 'Visualisasi Pohon Kinerja - 5 Level';
        $this->load->view('Daerah/header', $header);
        $this->load->view('Daerah/TampilPohonKinerja', $data);
    }

    /**
     * Mendapatkan mapping pelaksana ID ke detail lengkap
     */
    private function getPelaksanaMap($kodewilayah)
    {
        $pelaksana = $this->db
            ->select('
                akun_karyawan.id,
                akun_karyawan.nama,
                akun_karyawan.nip,
                akun_karyawan.jabatan,
                akun_karyawan.dinas_id,
                GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
            ')
            ->from('akun_karyawan')
            ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
            ->where('akun_karyawan.Level', 4)
            ->where('akun_karyawan.kodewilayah', $kodewilayah)
            ->where('akun_karyawan.deleted_at IS NULL')
            ->group_by('akun_karyawan.id')
            ->get()
            ->result_array();

        $map = [];
        foreach ($pelaksana as $p) {
            $map[$p['id']] = [
                'nama' => $p['nama'],
                'nip' => $p['nip'],
                'jabatan' => $p['jabatan'],
                'dinas' => $p['nama_dinas'] ?? '-',
                'display' => $p['nama'] . ($p['jabatan'] ? ' - ' . $p['jabatan'] : '') . ($p['nama_dinas'] ? ' (' . $p['nama_dinas'] . ')' : '')
            ];
        }
        
        return $map;
    }

    /**
     * Memperkaya data dengan detail pelaksana
     */
    private function enrichWithPelaksanaDetail($items, $pelaksana_map)
    {
        foreach ($items as &$item) {
            if (!empty($item['pelaksana']) && isset($pelaksana_map[$item['pelaksana']])) {
                $item['pelaksana_detail'] = $pelaksana_map[$item['pelaksana']];
                $item['pelaksana_nama'] = $pelaksana_map[$item['pelaksana']]['display'];
            } else {
                $item['pelaksana_detail'] = null;
                $item['pelaksana_nama'] = $item['pelaksana'] ?? '';
            }
            
            // Parse crosscutting JSON
            if (!empty($item['crosscutting'])) {
                $item['crosscutting_array'] = json_decode($item['crosscutting'], true);
            } else {
                $item['crosscutting_array'] = [];
            }
        }
        return $items;
    }

    /**
     * Membangun struktur tree data
     */
    private function buildTreeData($ultimate, $sektor, $taktikal, $immediate, $output)
    {
        $tree_data = [];

        // Buat mapping untuk memudahkan pencarian
        $sektor_by_parent = [];
        foreach ($sektor as $sek) {
            $sektor_by_parent[$sek['parent_id']][] = $sek;
        }

        $taktikal_by_parent = [];
        foreach ($taktikal as $tak) {
            $taktikal_by_parent[$tak['parent_id']][] = $tak;
        }

        $immediate_by_parent = [];
        foreach ($immediate as $imm) {
            $immediate_by_parent[$imm['parent_id']][] = $imm;
        }

        $output_by_parent = [];
        foreach ($output as $out) {
            $output_by_parent[$out['parent_id']][] = $out;
        }

        // Bangun tree dari Level 1 (Ultimate)
        foreach ($ultimate as $ult) {
            $ult_node = [
                'id' => 'l1_' . $ult['id'],
                'original_id' => $ult['id'],
                'nama' => $ult['nama'],
                'indikator' => $ult['indikator'] ?? '',
                'pelaksana' => '',
                'pelaksana_detail' => null,
                'inovasi' => '',
                'outcome_inovasi' => '',
                'output_inovasi' => '',
                'crosscutting' => '',
                'crosscutting_array' => [],
                'level' => 1,
                'children' => []
            ];
            
            // Cari Level 2 (Sektor) yang memiliki parent_id = $ult['id']
            if (isset($sektor_by_parent[$ult['id']])) {
                foreach ($sektor_by_parent[$ult['id']] as $sek) {
                    $sek_node = [
                        'id' => 'l2_' . $sek['id'],
                        'original_id' => $sek['id'],
                        'nama' => $sek['nama'],
                        'indikator' => $sek['indikator'] ?? '',
                        'pelaksana' => $sek['pelaksana'] ?? '',
                        'pelaksana_detail' => $sek['pelaksana_detail'] ?? null,
                        'inovasi' => $sek['inovasi'] ?? '',
                        'outcome_inovasi' => $sek['outcome_inovasi'] ?? '',
                        'output_inovasi' => $sek['output_inovasi'] ?? '',
                        'crosscutting' => $sek['crosscutting'] ?? '',
                        'crosscutting_array' => $sek['crosscutting_array'] ?? [],
                        'level' => 2,
                        'children' => []
                    ];
                    
                    // Cari Level 3 (Taktikal) yang memiliki parent_id = $sek['id']
                    if (isset($taktikal_by_parent[$sek['id']])) {
                        foreach ($taktikal_by_parent[$sek['id']] as $tak) {
                            $tak_node = [
                                'id' => 'l3_' . $tak['id'],
                                'original_id' => $tak['id'],
                                'nama' => $tak['nama'],
                                'indikator' => $tak['indikator'] ?? '',
                                'pelaksana' => $tak['pelaksana'] ?? '',
                                'pelaksana_detail' => $tak['pelaksana_detail'] ?? null,
                                'inovasi' => $tak['inovasi'] ?? '',
                                'outcome_inovasi' => $tak['outcome_inovasi'] ?? '',
                                'output_inovasi' => $tak['output_inovasi'] ?? '',
                                'crosscutting' => $tak['crosscutting'] ?? '',
                                'crosscutting_array' => $tak['crosscutting_array'] ?? [],
                                'level' => 3,
                                'children' => []
                            ];
                            
                            // Cari Level 4 (Immediate) yang memiliki parent_id = $tak['id']
                            if (isset($immediate_by_parent[$tak['id']])) {
                                foreach ($immediate_by_parent[$tak['id']] as $imm) {
                                    $imm_node = [
                                        'id' => 'l4_' . $imm['id'],
                                        'original_id' => $imm['id'],
                                        'nama' => $imm['nama'],
                                        'indikator' => $imm['indikator'] ?? '',
                                        'pelaksana' => $imm['pelaksana'] ?? '',
                                        'pelaksana_detail' => $imm['pelaksana_detail'] ?? null,
                                        'inovasi' => $imm['inovasi'] ?? '',
                                        'outcome_inovasi' => $imm['outcome_inovasi'] ?? '',
                                        'output_inovasi' => $imm['output_inovasi'] ?? '',
                                        'crosscutting' => $imm['crosscutting'] ?? '',
                                        'crosscutting_array' => $imm['crosscutting_array'] ?? [],
                                        'level' => 4,
                                        'children' => []
                                    ];
                                    
                                    // Cari Level 5 (Output) yang memiliki parent_id = $imm['id']
                                    if (isset($output_by_parent[$imm['id']])) {
                                        foreach ($output_by_parent[$imm['id']] as $out) {
                                            $imm_node['children'][] = [
                                                'id' => 'l5_' . $out['id'],
                                                'original_id' => $out['id'],
                                                'nama' => $out['nama'],
                                                'indikator' => $out['indikator'] ?? '',
                                                'pelaksana' => $out['pelaksana'] ?? '',
                                                'pelaksana_detail' => $out['pelaksana_detail'] ?? null,
                                                'inovasi' => $out['inovasi'] ?? '',
                                                'outcome_inovasi' => $out['outcome_inovasi'] ?? '',
                                                'output_inovasi' => $out['output_inovasi'] ?? '',
                                                'crosscutting' => $out['crosscutting'] ?? '',
                                                'crosscutting_array' => $out['crosscutting_array'] ?? [],
                                                'level' => 5,
                                                'children' => []
                                            ];
                                        }
                                    }
                                    
                                    $tak_node['children'][] = $imm_node;
                                }
                            }
                            
                            $sek_node['children'][] = $tak_node;
                        }
                    }
                    
                    $ult_node['children'][] = $sek_node;
                }
            }
            
            $tree_data[] = $ult_node;
        }

        return $tree_data;
    }

 


 

        /**
     * =====================================================
     * OUTPUT PD (Level 4)
     * =====================================================
     */
    public function Output_pd()
    {
        $header['Halaman'] = 'Output Perangkat Daerah';

        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';

        $data['KodeWilayah'] = $kodewilayah;
        $data['Provinsi'] = $this->GetListProvinsiData();

        $data['items'] = [];
        $data['immediate_options'] = [];

        if ($kodewilayah) {
            // Ambil data output dengan join ke immediate outcome
            $this->db->select('o.*, imm.kinerja as immediate_kinerja');
            $this->db->from('output_pd o');
            $this->db->join('immediate_outcome_pd imm', 'imm.id = o.immediate_outcome_id', 'left');
            $this->db->where('o.kode_wilayah', $kodewilayah);
            $this->db->where('o.deleted_at IS NULL');
            $this->db->order_by('o.urutan', 'ASC');
            $this->db->order_by('o.id', 'ASC');
            $data['items'] = $this->db->get()->result_array();

            // Ambil options untuk immediate outcome (level 3)
            $data['immediate_options'] = $this->db
                ->select('id, kinerja')
                ->from('immediate_outcome_pd')
                ->where('kode_wilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->order_by('id', 'ASC')
                ->get()
                ->result_array();
        }

        // Ambil Nama Wilayah
        if ($kodewilayah) {
            $wil = $this->db
                ->where('Kode', $kodewilayah)
                ->get('kodewilayah')
                ->row_array();

            $data['NamaWilayah'] = $wil ? $wil['Nama'] : '';
        } else {
            $data['NamaWilayah'] = '';
        }

        $this->load->view('Daerah/header', $header);
        $this->load->view('Daerah/Output_pd', $data);
    }

    /**
     * =====================================================
     * GET DAFTAR DINAS UNTUK OUTPUT PD
     * =====================================================
     */
    public function Output_pd_get_daftar_dinas()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        // Ambil data dinas dari akun_instansi dengan Level 2
        $dinas = $this->db
            ->select('id, nama')
            ->from('akun_instansi')
            ->where('Level', 2)
            ->where('kodewilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($dinas);
        exit;
    }

    /**
     * =====================================================
     * GET PELAKSANA BY DINAS UNTUK OUTPUT PD
     * =====================================================
     */
    public function Output_pd_get_pelaksana_by_dinas()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        $dinas_id = $this->input->post('dinas_id', TRUE);
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        $this->db->select('
            akun_karyawan.id,
            akun_karyawan.nama,
            akun_karyawan.nip,
            akun_karyawan.jabatan,
            akun_karyawan.dinas_id,
            GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
        ')
        ->from('akun_karyawan')
        ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
        ->where('akun_karyawan.Level', 4)
        ->where('akun_karyawan.kodewilayah', $kodewilayah)
        ->where('akun_karyawan.deleted_at IS NULL');
        
        // Filter berdasarkan dinas jika dipilih
        if (!empty($dinas_id) && $dinas_id != '') {
            $this->db->where("FIND_IN_SET('$dinas_id', akun_karyawan.dinas_id) > 0");
        }
        
        $pelaksana = $this->db
            ->group_by('akun_karyawan.id')
            ->order_by('akun_karyawan.nama', 'ASC')
            ->get()
            ->result_array();

        echo json_encode($pelaksana);
        exit;
    }

    /**
     * =====================================================
     * GET DETAIL PELAKSANA UNTUK OUTPUT PD (untuk edit)
     * =====================================================
     */
    public function Output_pd_get_pelaksana_detail()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$id || !$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        $detail = $this->db
            ->select('id, nama, nip, jabatan, dinas_id')
            ->from('akun_karyawan')
            ->where('id', $id)
            ->where('kodewilayah', $kodewilayah)
            ->where('Level', 4)
            ->where('deleted_at IS NULL')
            ->get()
            ->row_array();

        echo json_encode($detail);
        exit;
    }

    /**
     * =====================================================
     * GET PELAKSANA LEVEL 4 (SEMUA) - untuk fallback
     * =====================================================
     */
    public function Output_pd_get_pelaksana_level4()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah') ?? '';
        
        if (!$kodewilayah) {
            echo json_encode([]);
            return;
        }
        
        // Ambil data pelaksana dari tabel akun_karyawan dengan Level 4
        $pelaksana = $this->db
            ->select('
                akun_karyawan.id,
                akun_karyawan.nama,
                akun_karyawan.nip,
                akun_karyawan.jabatan,
                akun_karyawan.dinas_id,
                GROUP_CONCAT(akun_instansi.nama SEPARATOR ", ") as nama_dinas
            ')
            ->from('akun_karyawan')
            ->join('akun_instansi', 'FIND_IN_SET(akun_instansi.id, akun_karyawan.dinas_id)', 'left')
            ->where('akun_karyawan.Level', 4)
            ->where('akun_karyawan.kodewilayah', $kodewilayah)
            ->where('akun_karyawan.deleted_at IS NULL')
            ->group_by('akun_karyawan.id')
            ->order_by('akun_karyawan.nama', 'ASC')
            ->get()
            ->result_array();
        
        echo json_encode($pelaksana);
        exit;
    }

    /**
     * =====================================================
     * GET PERANGKAT DAERAH
     * =====================================================
     */
    public function Output_pd_get_perangkat_daerah()
    {
        if (!$this->input->is_ajax_request()) show_404();
        
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');
        
        if (!$kodewilayah) {
            echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih', 'data' => []]);
            return;
        }
        
        // Ambil data perangkat daerah dari akun_instansi dengan Level 2
        $this->db->select('id, nama');
        $this->db->where('Level', 2);
        $this->db->where('kodewilayah', $kodewilayah);
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('akun_instansi');
        
        $data = $query->result_array();
        
        echo json_encode([
            'status' => 'success',
            'data' => $data
        ]);
    }

    /**
     * =====================================================
     * SIMPAN OUTPUT PD
     * =====================================================
     */
    public function Output_pd_simpan()
    {
        if (!$this->input->is_ajax_request()) show_404();

        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$kodewilayah) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Wilayah belum dipilih'
            ]);
            return;
        }

        $id                  = $this->input->post('id', TRUE);
        $immediate_id        = $this->input->post('immediate_id', TRUE);
        $kinerja             = trim($this->input->post('kinerja', TRUE));
        $ind_list            = $this->input->post('indikator') ?: [];
        $pelaksana_id        = $this->input->post('pelaksana', TRUE);
        $inovasi             = $this->input->post('inovasi_daerah', TRUE);
        $outcome_inovasi     = $this->input->post('outcome_inovasi', TRUE);
        $output_inovasi      = $this->input->post('output_inovasi', TRUE);
        $crosscutting_pd     = $this->input->post('crosscutting_pd');
        $crosscutting_ket    = $this->input->post('crosscutting_ket');

        if (empty($kinerja)) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Kinerja wajib diisi'
            ]);
            return;
        }

        // Validasi pelaksana exists di tabel akun_karyawan berdasarkan ID
        if ($pelaksana_id) {
            $exists = $this->db
                ->where('id', $pelaksana_id)
                ->where('Level', 4)
                ->where('kodewilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->count_all_results('akun_karyawan');
                
            if (!$exists) {
                echo json_encode([
                    'status'=>'error',
                    'message'=>'Pelaksana tidak valid atau tidak ditemukan'
                ]);
                return;
            }
        }

        $indikator = !empty($ind_list) ? implode('|||', array_filter($ind_list, 'trim')) : NULL;

        // Handle crosscutting
        $crosscutting_pd_json = null;
        $crosscutting_ket_json = null;
        
        if (!empty($crosscutting_pd) && is_array($crosscutting_pd)) {
            $crosscutting_pd_json = json_encode($crosscutting_pd);
        }
        if (!empty($crosscutting_ket) && is_array($crosscutting_ket)) {
            $crosscutting_ket_json = json_encode($crosscutting_ket);
        }

        $save = [
            'kode_wilayah'          => $kodewilayah,
            'immediate_outcome_id'  => $immediate_id ?: NULL,
            'kinerja'               => $kinerja,
            'indikator'             => $indikator,
            'pelaksana'             => $pelaksana_id ?: NULL,
            'inovasi_daerah'        => $inovasi ?: NULL,
            'outcome_inovasi'       => $outcome_inovasi ?: NULL,
            'output_inovasi'        => $output_inovasi ?: NULL,
            'crosscutting_pd'       => $crosscutting_pd_json,
            'crosscutting_keterangan' => $crosscutting_ket_json,
            'updated_at'            => date('Y-m-d H:i:s')
        ];

        if ($id) {
            // Update data
            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kodewilayah)
                    ->update('output_pd', $save);
            $msg = 'Data berhasil diperbarui';
        } else {
            // Insert data baru - dapatkan urutan terakhir
            $last_urutan = $this->db
                ->select_max('urutan')
                ->where('kode_wilayah', $kodewilayah)
                ->where('deleted_at IS NULL')
                ->get('output_pd')
                ->row()
                ->urutan;
            
            $save['urutan'] = ($last_urutan ? $last_urutan + 1 : 1);
            $save['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('output_pd', $save);
            $msg = 'Data berhasil ditambahkan';
        }

        echo json_encode([
            'status' => 'success',
            'message' => $msg
        ]);
        exit;
    }

    /**
     * =====================================================
     * HAPUS OUTPUT PD
     * =====================================================
     */
    public function Output_pd_hapus()
    {
        if (!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$id || !$kodewilayah) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Parameter tidak lengkap'
            ]);
            exit;
        }

        // Cek dulu apakah data ada
        $exists = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->get('output_pd')
            ->row();

        if (!$exists) {
            echo json_encode([
                'status'  => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
            exit;
        }

        // Soft delete
        $this->db->where('id', $id)
                ->where('kode_wilayah', $kodewilayah)
                ->update('output_pd', ['deleted_at' => date('Y-m-d H:i:s')]);

        $status = $this->db->affected_rows() > 0 ? 'success' : 'error';

        echo json_encode([
            'status' => $status,
            'message' => $status == 'success' ? 'Data berhasil dihapus' : 'Data tidak ditemukan'
        ]);
        exit;
    }

    /**
     * =====================================================
     * GET SINGLE DATA OUTPUT PD
     * =====================================================
     */
    public function Output_pd_get()
    {
        if (!$this->input->is_ajax_request()) show_404();

        $id = $this->input->post('id', TRUE);
        $kodewilayah = $this->session->userdata('KodeWilayah') 
                    ?? $this->session->userdata('TempKodeWilayah');

        if (!$id || !$kodewilayah) {
            echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
            return;
        }

        $data = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $kodewilayah)
            ->where('deleted_at IS NULL')
            ->get('output_pd')
            ->row_array();

        if ($data) {
            // Decode JSON crosscutting
            if (!empty($data['crosscutting_pd'])) {
                $data['crosscutting_pd'] = json_decode($data['crosscutting_pd'], true);
            }
            if (!empty($data['crosscutting_keterangan'])) {
                $data['crosscutting_keterangan'] = json_decode($data['crosscutting_keterangan'], true);
            }
            
            echo json_encode([
                'status' => 'success',
                'data' => $data
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ]);
        }
        exit;
    }

        /**
         * =====================================================
         * FUNGSI BANTUAN
         * =====================================================
         */
        private function GetListProvinsiData()
        {
            return $this->db->where("Kode LIKE '__'")
                            ->order_by('Nama')
                            ->get('kodewilayah')
                            ->result_array();
        }

           
}