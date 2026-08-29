<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Instansi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        date_default_timezone_set("Asia/Jakarta");
        
        // Load database jika belum
        if (!isset($this->db)) {
            $this->load->database();
        }
    }

    /**
     * Cek apakah user sudah login
     */
    private function is_logged_in() {
        return isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'] === true;
    }

    /**
     * Cek apakah user memiliki role 4 (Instansi)
     */
    private function is_role_4() {
        return $this->is_logged_in() && isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 4;
    }

    /**
     * Cek apakah user memiliki role 3 (Akun Daerah / Verifikator)
     */
    private function is_role_3() {
        return $this->is_logged_in() && isset($_SESSION['Level']) && (int)$_SESSION['Level'] === 3;
    }

    /**
     * Cek apakah user bisa melakukan CRUD (hanya role 4)
     */
    private function can_crud() {
        return $this->is_role_4();
    }

    /**
     * Mendapatkan ID instansi dari session (hanya untuk role 4)
     */
    private function get_instansi_id() {
        if ($this->is_role_4()) {
            return isset($_SESSION['IdInstansi']) ? $_SESSION['IdInstansi'] : null;
        }
        return null;
    }

    /**
     * Mendapatkan kode wilayah dari session
     */
    private function get_kode_wilayah() {
        if (isset($_SESSION['KodeWilayah']) && !empty($_SESSION['KodeWilayah'])) {
            return $_SESSION['KodeWilayah'];
        }
        if (isset($_SESSION['TempKodeWilayah']) && !empty($_SESSION['TempKodeWilayah'])) {
            return $_SESSION['TempKodeWilayah'];
        }
        return null;
    }

    /**
     * Set TempKodeWilayah (untuk filter wilayah)
     */
    // Di controller Instansi.php
public function SetTempKodeWilayah() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodeWilayah = $this->input->post('KodeWilayah', TRUE);
    $instansiId = $this->input->post('InstansiId', TRUE);
    
    if ($kodeWilayah && $this->db->where('Kode', $kodeWilayah)->get('kodewilayah')->num_rows() > 0) {
        $this->session->set_userdata('TempKodeWilayah', $kodeWilayah);
        
        // ✅ SIMPAN JUGA INSTANSI ID
        if (!empty($instansiId) && is_numeric($instansiId)) {
            $this->session->set_userdata('TempInstansiId', $instansiId);
        } else {
            $this->session->unset_userdata('TempInstansiId');
        }
        
        echo '1';
    } else {
        echo 'Kode Wilayah tidak valid';
    }
}

// Tambah method untuk reset filter
public function ResetTempFilter() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    $this->session->unset_userdata('TempKodeWilayah');
    $this->session->unset_userdata('TempInstansiId');
    echo '1';
}

    /**
     * Halaman Permasalahan PD
     */
    public function PermasalahanPD() {
        $Header['Halaman'] = 'Permasalahan PD';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_logged_in = $this->is_logged_in();
        $is_role_4 = $this->is_role_4();
        $level = isset($_SESSION['Level']) ? $_SESSION['Level'] : null;
        
        $data['KodeWilayah'] = $KodeWilayah;
        $data['InstansiId'] = $instansi_id;
        $data['IsLoggedIn'] = $is_logged_in;
        $data['IsRole4'] = $is_role_4;
        $data['Level'] = $level;
        $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
        
        // Ambil nama wilayah
        $data['NamaWilayah'] = '';
        if ($KodeWilayah) {
            $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }
        
        // Filter Instansi yang dipilih (untuk NON role 4)
        $filter_instansi_id = $this->input->get('instansi_id', TRUE);
        $data['FilterInstansiId'] = $filter_instansi_id;
        
        // Data provinsi untuk dropdown filter
        $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                     ->order_by('Nama')
                                     ->get('kodewilayah')
                                     ->result_array();
        
        // ========== AMBIL DAFTAR INSTANSI UNTUK FILTER ==========
        $data['ListInstansi'] = [];
        if (!$is_role_4 && $KodeWilayah) {
            $data['ListInstansi'] = $this->db->select('id, nama')
                ->from('akun_instansi')
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        }
        
        // Ambil data Masalah Pokok (untuk dropdown)
        $data['MasalahPokok'] = [];
        if ($KodeWilayah) {
            $data['MasalahPokok'] = $this->db->select('Id, NamaPermasalahanPokok')
                ->from('permasalahanpokokdaerah')
                ->where('KodeWilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('Id', 'ASC')
                ->get()
                ->result_array();
        }
        
        // ========== AMBIL DATA PERMASALAHAN PD ==========
        $data['PermasalahanPD'] = [];
        
        if ($KodeWilayah || $instansi_id) {
            $this->db->select('p.*, mp.NamaPermasalahanPokok, a.nama as nama_instansi')
                ->from('permasalahan_pd p')
                ->join('permasalahanpokokdaerah mp', 'mp.Id = p.masalah_pokok', 'left')
                ->join('akun_instansi a', 'a.id = p.instansi_id', 'left');
            
            // Filter berdasarkan role
            if ($is_role_4 && $instansi_id) {
                $this->db->where('p.instansi_id', $instansi_id);
                $this->db->where('p.kodewilayah', $KodeWilayah);
            } elseif ($KodeWilayah) {
                $this->db->where('p.kodewilayah', $KodeWilayah);
                
                if (!empty($filter_instansi_id) && $filter_instansi_id != '') {
                    $this->db->where('p.instansi_id', (int)$filter_instansi_id);
                }
            }
            
            $this->db->where('p.deleted_at IS NULL')
                     ->order_by('p.id', 'ASC');
            
            $data['PermasalahanPD'] = $this->db->get()->result_array();
        }
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/PermasalahanPD', $data);
    }

    /**
     * Input Permasalahan PD (AJAX) - HANYA UNTUK ROLE 4
     */
    public function InputPermasalahanPD() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        if (!$this->can_crud()) {
            echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
            return;
        }
        
        $kode_wilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        
        if (!$kode_wilayah) {
            echo "Wilayah belum dipilih!";
            return;
        }
        
        if (!$instansi_id) {
            echo "Data instansi tidak ditemukan!";
            return;
        }
        
        $masalah = trim($this->input->post('masalah', true));
        if (!$masalah) {
            echo "Masalah harus diisi!";
            return;
        }
        
        $masalah_pokok_id = (int)$this->input->post('masalah_pokok', true);
        
        if ($masalah_pokok_id > 0 && $kode_wilayah) {
            $cek = $this->db->where('Id', $masalah_pokok_id)
                ->where('KodeWilayah', $kode_wilayah)
                ->where('deleted_at IS NULL')
                ->get('permasalahanpokokdaerah')
                ->row_array();
            
            if (!$cek) {
                $masalah_pokok_id = null;
            }
        } else {
            $masalah_pokok_id = null;
        }
        
        $data = [
            'kodewilayah'      => $kode_wilayah,
            'instansi_id'      => $instansi_id,
            'masalah_pokok'    => $masalah_pokok_id,
            'masalah'          => $masalah,
            'penyebab_masalah' => trim($this->input->post('penyebab_masalah', true)),
            'faktor_internal'  => trim($this->input->post('faktor_internal', true)),
            'faktor_external'  => trim($this->input->post('faktor_external', true)),
            'akar_masalah'     => trim($this->input->post('akar_masalah', true)),
            'created_at'       => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('permasalahan_pd', $data);
        echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan data!';
    }

    /**
     * Edit Permasalahan PD (AJAX) - HANYA UNTUK ROLE 4
     */
    public function EditPermasalahanPD() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        if (!$this->can_crud()) {
            echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
            return;
        }
        
        $id = (int)$this->input->post('id', true);
        $instansi_id = $this->get_instansi_id();
        
        if (!$id) {
            echo "ID tidak valid!";
            return;
        }
        
        if (!$instansi_id) {
            echo "Data instansi tidak ditemukan!";
            return;
        }
        
        $existing = $this->db->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('permasalahan_pd')
            ->row_array();
        
        if (!$existing) {
            echo "Data tidak ditemukan!";
            return;
        }
        
        if ($existing['instansi_id'] != $instansi_id) {
            echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
            return;
        }
        
        $masalah = trim($this->input->post('masalah', true));
        if (!$masalah) {
            echo "Masalah harus diisi!";
            return;
        }
        
        $masalah_pokok_id = (int)$this->input->post('masalah_pokok', true);
        
        if ($masalah_pokok_id > 0 && $existing['kodewilayah']) {
            $cek = $this->db->where('Id', $masalah_pokok_id)
                ->where('KodeWilayah', $existing['kodewilayah'])
                ->where('deleted_at IS NULL')
                ->get('permasalahanpokokdaerah')
                ->row_array();
            
            if (!$cek) {
                $masalah_pokok_id = null;
            }
        } else {
            $masalah_pokok_id = null;
        }
        
        $data = [
            'masalah_pokok'    => $masalah_pokok_id,
            'masalah'          => $masalah,
            'penyebab_masalah' => trim($this->input->post('penyebab_masalah', true)),
            'faktor_internal'  => trim($this->input->post('faktor_internal', true)),
            'faktor_external'  => trim($this->input->post('faktor_external', true)),
            'akar_masalah'     => trim($this->input->post('akar_masalah', true)),
            'updated_at'       => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        $this->db->update('permasalahan_pd', $data);
        
        echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
    }

    /**
     * Hapus Permasalahan PD (AJAX) - HANYA UNTUK ROLE 4
     */
    public function HapusPermasalahanPD() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        if (!$this->can_crud()) {
            echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
            return;
        }
        
        $id = (int)$this->input->post('id', true);
        $instansi_id = $this->get_instansi_id();
        
        if (!$id) {
            echo "ID tidak valid!";
            return;
        }
        
        if (!$instansi_id) {
            echo "Data instansi tidak ditemukan!";
            return;
        }
        
        $existing = $this->db->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('permasalahan_pd')
            ->row_array();
        
        if (!$existing) {
            echo "Data tidak ditemukan!";
            return;
        }
        
        if ($existing['instansi_id'] != $instansi_id) {
            echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
            return;
        }
        
        $this->db->where('id', $id);
        $this->db->update('permasalahan_pd', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        
        echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus data!';
    }

    /**
     * Get list Kab/Kota (untuk filter) - DIPERBAIKI
     */
   /**
 * Get list Kab/Kota (untuk filter) - DIPERBAIKI
 */
public function GetListKabKota() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kode_provinsi = $this->input->post('Kode', TRUE);
    
    if (empty($kode_provinsi)) {
        $this->output->set_content_type('application/json')->set_output(json_encode([]));
        return;
    }
    
    // PERBAIKAN: Gunakan concatenation yang benar
    $kode_pattern = $kode_provinsi . '.%';
    
    // Query dengan binding yang benar - parameter harus string, bukan array
    $kabkota = $this->db
        ->select('Kode, Nama')
        ->from('kodewilayah')
        ->where('Kode LIKE', $kode_pattern)  // Cara yang benar untuk LIKE
        ->where('LENGTH(REPLACE(Kode, ".", "")) = 4', null, false)
        ->order_by('Nama', 'ASC')
        ->get()
        ->result_array();
    
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($kabkota));
}

    /**
     * Get list Provinsi
     */
    public function GetListProvinsi() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $provinsi = $this->db->where("Kode LIKE '__'")
                             ->order_by('Nama')
                             ->get('kodewilayah')
                             ->result_array();
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($provinsi));
    }

    /**
     * Get list Instansi Level 4 berdasarkan kode wilayah (AJAX)
     */
    public function GetListInstansiLevel4() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $kode_wilayah = $this->input->post('kode_wilayah', TRUE);
        if (!$kode_wilayah) {
            $this->output->set_content_type('application/json')->set_output(json_encode([]));
            return;
        }
        
        $instansi = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $kode_wilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
        
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode($instansi));
    }

    // =====================================================
// ISU STRATEGIS PD
// =====================================================

/**
 * Halaman Isu Strategis PD
 */
public function IsuStrategisPD() {
    $Header['Halaman'] = 'Isu Strategis PD';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $level = isset($_SESSION['Level']) ? $_SESSION['Level'] : null;
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['Level'] = $level;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Filter Instansi yang dipilih (untuk NON role 4)
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    $data['FilterInstansiId'] = $filter_instansi_id;
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // ========== AMBIL DAFTAR INSTANSI UNTUK FILTER ==========
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA MASTER UNTUK DROPDOWN ==========
    // List Permasalahan PD (untuk dropdown multi select)
    $data['ListPermasalahanPD'] = [];
    if ($KodeWilayah) {
        // Untuk Role 4, hanya tampilkan data permasalahan_pd milik instansi tersebut
if ($is_role_4 && $instansi_id) {
    $data['ListPermasalahanPD'] = $this->db->select('id, masalah')
        ->from('permasalahan_pd')
        ->where('kodewilayah', $KodeWilayah)
        ->where('instansi_id', $instansi_id)
        ->where('deleted_at IS NULL')
        ->order_by('id', 'ASC')
        ->get()
        ->result_array();
    
    $data['ListIsuKLHS'] = $this->db->select('id, NamaIsuKLHS')
        ->from('isuklhs')
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL')
        ->order_by('id', 'ASC')
        ->get()
        ->result_array();
} else {
    $data['ListPermasalahanPD'] = $this->db->select('id, masalah')
        ->from('permasalahan_pd')
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL')
        ->order_by('id', 'ASC')
        ->get()
        ->result_array();
    
    $data['ListIsuKLHS'] = $this->db->select('id, NamaIsuKLHS')
        ->from('isuklhs')
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL')
        ->order_by('id', 'ASC')
        ->get()
        ->result_array();
}
    }
    
    // ========== AMBIL DATA ISU STRATEGIS PD ==========
    $data['IsuStrategis'] = [];
    
    if ($KodeWilayah || $instansi_id) {
        $this->db->select('i.*, a.nama as nama_instansi')
            ->from('isu_strategis_pd i')
            ->join('akun_instansi a', 'a.id = i.instansi_id', 'left');
        
        // Filter berdasarkan role
        if ($is_role_4 && $instansi_id) {
            $this->db->where('i.instansi_id', $instansi_id);
            $this->db->where('i.kodewilayah', $KodeWilayah);
        } elseif ($KodeWilayah) {
            $this->db->where('i.kodewilayah', $KodeWilayah);
            
            if (!empty($filter_instansi_id) && $filter_instansi_id != '') {
                $this->db->where('i.instansi_id', (int)$filter_instansi_id);
            }
        }
        
        $this->db->where('i.deleted_at IS NULL')
                 ->order_by('i.id', 'ASC');
        
        $rows = $this->db->get()->result_array();
        
        // Proses data untuk view (parse CSV ids ke array)
        foreach ($rows as &$r) {
            // Parse permasalahan_pd (CSV ids)
            $perms = [];
            if (!empty($r['permasalahan_pd'])) {
                $perms = array_filter(array_map('trim', explode(',', $r['permasalahan_pd'])));
            }
            $r['permasalahan_ids'] = $perms;
            
            // Parse isu_klhs (CSV ids)
            $klhs = [];
            if (!empty($r['isu_klhs'])) {
                $klhs = array_filter(array_map('trim', explode(',', $r['isu_klhs'])));
            }
            $r['klhs_ids'] = $klhs;
            
            // Buat teks untuk tampil di tabel
            $permText = [];
            foreach ($perms as $pid) {
                foreach ($data['ListPermasalahanPD'] as $mp) {
                    if ($mp['id'] == $pid) {
                        $permText[] = $mp['masalah'];
                        break;
                    }
                }
            }
            $r['permasalahan_pd_text'] = implode("\n", $permText);
            
            $klhsText = [];
            foreach ($klhs as $kid) {
                foreach ($data['ListIsuKLHS'] as $k) {
                    if ($k['id'] == $kid) {
                        $klhsText[] = $k['NamaIsuKLHS'];
                        break;
                    }
                }
            }
            $r['isu_klhs_text'] = implode("\n", $klhsText);
        }
        
        $data['IsuStrategis'] = $rows;
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/IsuStrategisPD', $data);
}

/**
 * Input Isu Strategis PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputIsuStrategisPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $potensi = trim($this->input->post('potensi_daerah', true));
    if (!$potensi) {
        echo "Potensi Daerah harus diisi!";
        return;
    }
    
    // Ambil array ids dari POST
    $permasalahan_ids = $this->input->post('permasalahan_ids');
    $klhs_ids = $this->input->post('klhs_ids');
    
    // Konversi ke string CSV
    $permasalahan_csv = '';
    if (is_array($permasalahan_ids) && !empty($permasalahan_ids)) {
        $permasalahan_csv = implode(',', array_filter($permasalahan_ids));
    }
    
    $klhs_csv = '';
    if (is_array($klhs_ids) && !empty($klhs_ids)) {
        $klhs_csv = implode(',', array_filter($klhs_ids));
    }
    
    $data = [
        'kodewilayah'     => $kode_wilayah,
        'instansi_id'     => $instansi_id,
        'potensi_daerah'  => $potensi,
        'permasalahan_pd' => $permasalahan_csv,
        'isu_klhs'        => $klhs_csv,
        'isu_global'      => trim($this->input->post('isu_global', true)),
        'isu_nasional'    => trim($this->input->post('isu_nasional', true)),
        'isu_regional'    => trim($this->input->post('isu_regional', true)),
        'isu_strategis'   => trim($this->input->post('isu_strategis', true)),
        'created_at'      => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('isu_strategis_pd', $data);
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan data!';
}

/**
 * Edit Isu Strategis PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditIsuStrategisPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    // Cek kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('isu_strategis_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['instansi_id'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $potensi = trim($this->input->post('potensi_daerah', true));
    if (!$potensi) {
        echo "Potensi Daerah harus diisi!";
        return;
    }
    
    // Ambil array ids dari POST
    $permasalahan_ids = $this->input->post('permasalahan_ids');
    $klhs_ids = $this->input->post('klhs_ids');
    
    // Konversi ke string CSV
    $permasalahan_csv = '';
    if (is_array($permasalahan_ids) && !empty($permasalahan_ids)) {
        $permasalahan_csv = implode(',', array_filter($permasalahan_ids));
    }
    
    $klhs_csv = '';
    if (is_array($klhs_ids) && !empty($klhs_ids)) {
        $klhs_csv = implode(',', array_filter($klhs_ids));
    }
    
    $data = [
        'potensi_daerah'  => $potensi,
        'permasalahan_pd' => $permasalahan_csv,
        'isu_klhs'        => $klhs_csv,
        'isu_global'      => trim($this->input->post('isu_global', true)),
        'isu_nasional'    => trim($this->input->post('isu_nasional', true)),
        'isu_regional'    => trim($this->input->post('isu_regional', true)),
        'isu_strategis'   => trim($this->input->post('isu_strategis', true)),
        'updated_at'      => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id);
    $this->db->update('isu_strategis_pd', $data);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
}

/**
 * Hapus Isu Strategis PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusIsuStrategisPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    // Cek kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('isu_strategis_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['instansi_id'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
        return;
    }
    
    $this->db->where('id', $id);
    $this->db->update('isu_strategis_pd', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus data!';
}

// =====================================================
// TUJUAN PD
// =====================================================

/**
 * Halaman Tujuan PD
 */
public function TujuanPD() {
    $Header['Halaman'] = 'Tujuan Perangkat Daerah';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $level = isset($_SESSION['Level']) ? $_SESSION['Level'] : null;
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['Level'] = $level;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter (hanya untuk non-role 4)
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // Ambil data Sasaran RPJMD untuk dropdown
    $data['SasaranRPJMD'] = $this->db->select('Id, Sasaran')
        ->order_by('Id', 'ASC')
        ->get('sasaranrpjmd')
        ->result_array();
    
    // ========== AMBIL DATA TUJUAN PD ==========
    $data['TujuanPD'] = [];
    
    if ($KodeWilayah) {
        $this->db->select('t.*, a.nama as nama_instansi')
            ->from('tujuan_pd t')
            ->join('akun_instansi a', 'a.id = t.id_instansi', 'left')
            ->where('t.kode_wilayah', $KodeWilayah)
            ->where('t.deleted_at IS NULL');
        
        // Filter berdasarkan role
        if ($is_role_4 && $instansi_id) {
            $this->db->where('t.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $this->db->where('t.id_instansi', (int)$filter_instansi_id);
        }
        
        $data['TujuanPD'] = $this->db->order_by('t.id', 'ASC')->get()->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/TujuanPD', $data);
}

/**
 * Input Tujuan PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputTujuanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $sasaran_id = (int)$this->input->post('sasaran_id', true);
    $tujuan = trim($this->input->post('tujuan_pd', true));
    $tahun_mulai = (int)$this->input->post('tahun_mulai', true);
    $tahun_akhir = (int)$this->input->post('tahun_akhir', true);
    
    if (!$sasaran_id) {
        echo "Sasaran RPJMD harus dipilih!";
        return;
    }
    
    if (!$tujuan) {
        echo "Tujuan PD harus diisi!";
        return;
    }
    
    if (!$tahun_mulai || !$tahun_akhir) {
        echo "Tahun mulai dan tahun akhir harus diisi!";
        return;
    }
    
    if ($tahun_akhir < $tahun_mulai) {
        echo "Tahun akhir tidak boleh lebih kecil dari tahun mulai!";
        return;
    }
    
    $data = [
        'kode_wilayah'  => $KodeWilayah,
        'id_instansi'   => $instansi_id,
        'sasaran_id'    => $sasaran_id,
        'tujuan_pd'     => $tujuan,
        'tahun_mulai'   => $tahun_mulai,
        'tahun_akhir'   => $tahun_akhir,
        'created_at'    => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('tujuan_pd', $data);
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan data!';
}

/**
 * Edit Tujuan PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditTujuanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('tujuan_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $sasaran_id = (int)$this->input->post('sasaran_id', true);
    $tujuan = trim($this->input->post('tujuan_pd', true));
    $tahun_mulai = (int)$this->input->post('tahun_mulai', true);
    $tahun_akhir = (int)$this->input->post('tahun_akhir', true);
    
    if (!$sasaran_id) {
        echo "Sasaran RPJMD harus dipilih!";
        return;
    }
    
    if (!$tujuan) {
        echo "Tujuan PD harus diisi!";
        return;
    }
    
    if (!$tahun_mulai || !$tahun_akhir) {
        echo "Tahun mulai dan tahun akhir harus diisi!";
        return;
    }
    
    if ($tahun_akhir < $tahun_mulai) {
        echo "Tahun akhir tidak boleh lebih kecil dari tahun mulai!";
        return;
    }
    
    $data = [
        'sasaran_id'    => $sasaran_id,
        'tujuan_pd'     => $tujuan,
        'tahun_mulai'   => $tahun_mulai,
        'tahun_akhir'   => $tahun_akhir,
        'updated_at'    => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id);
    $this->db->update('tujuan_pd', $data);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
}

/**
 * Hapus Tujuan PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusTujuanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('tujuan_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
        return;
    }
    
    $this->db->where('id', $id);
    $this->db->update('tujuan_pd', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus data!';
}

// =====================================================
// SASARAN PD
// =====================================================

/**
 * Halaman Sasaran PD
 */
public function SasaranPD() {
    $Header['Halaman'] = 'Sasaran Perangkat Daerah';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // Ambil data Tujuan PD untuk dropdown (hanya milik instansi sendiri untuk Role 4)
    $data['ListTujuanPD'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, tujuan_pd')
            ->from('tujuan_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        }
        
        $data['ListTujuanPD'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    // ========== AMBIL DATA SASARAN PD ==========
    $data['SasaranPD'] = [];
    
    if ($KodeWilayah) {
        $this->db->select('s.*')
            ->from('sasaran_pd s')
            ->where('s.kode_wilayah', $KodeWilayah)
            ->where('s.deleted_at IS NULL');
        
        // Filter berdasarkan role
        if ($is_role_4 && $instansi_id) {
            $this->db->where('s.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $this->db->where('s.id_instansi', (int)$filter_instansi_id);
        }
        
        $data['SasaranPD'] = $this->db->order_by('s.id', 'ASC')->get()->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/SasaranPD', $data);
}

/**
 * Input Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputSasaranPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $tujuan_pd_id = (int)$this->input->post('tujuan_pd_id', true);
    $sasaran = trim($this->input->post('sasaran_pd', true));
    $tahun_mulai = (int)$this->input->post('tahun_mulai', true);
    $tahun_akhir = (int)$this->input->post('tahun_akhir', true);
    
    if (!$tujuan_pd_id) {
        echo "Tujuan PD harus dipilih!";
        return;
    }
    
    if (!$sasaran) {
        echo "Sasaran PD harus diisi!";
        return;
    }
    
    if (!$tahun_mulai || !$tahun_akhir) {
        echo "Tahun mulai dan tahun akhir harus diisi!";
        return;
    }
    
    if ($tahun_akhir < $tahun_mulai) {
        echo "Tahun akhir tidak boleh lebih kecil dari tahun mulai!";
        return;
    }
    
    $data = [
        'kode_wilayah'  => $KodeWilayah,
        'id_instansi'   => $instansi_id,
        'tujuan_pd_id'  => $tujuan_pd_id,
        'sasaran_pd'    => $sasaran,
        'tahun_mulai'   => $tahun_mulai,
        'tahun_akhir'   => $tahun_akhir,
        'created_at'    => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('sasaran_pd', $data);
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan data!';
}

/**
 * Edit Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditSasaranPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('sasaran_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $tujuan_pd_id = (int)$this->input->post('tujuan_pd_id', true);
    $sasaran = trim($this->input->post('sasaran_pd', true));
    $tahun_mulai = (int)$this->input->post('tahun_mulai', true);
    $tahun_akhir = (int)$this->input->post('tahun_akhir', true);
    
    if (!$tujuan_pd_id) {
        echo "Tujuan PD harus dipilih!";
        return;
    }
    
    if (!$sasaran) {
        echo "Sasaran PD harus diisi!";
        return;
    }
    
    if ($tahun_akhir < $tahun_mulai) {
        echo "Tahun akhir tidak boleh lebih kecil dari tahun mulai!";
        return;
    }
    
    $data = [
        'tujuan_pd_id'  => $tujuan_pd_id,
        'sasaran_pd'    => $sasaran,
        'tahun_mulai'   => $tahun_mulai,
        'tahun_akhir'   => $tahun_akhir,
        'updated_at'    => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id);
    $this->db->update('sasaran_pd', $data);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
}

/**
 * Hapus Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusSasaranPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('sasaran_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
        return;
    }
    
    $this->db->where('id', $id);
    $this->db->update('sasaran_pd', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus data!';
}

  // =====================================================
// TUJUAN SASARAN PD (NSPK)
// =====================================================

/**
 * Halaman Tujuan Sasaran PD
 */
public function TujuanSasaranPD() {
    $Header['Halaman'] = 'NSPK, Tujuan & Sasaran PD';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ===================== DATA NSPK =====================
    // Data NSPK dengan JOIN ke nspk_detail untuk mendapatkan jenis
    // TANPA filter deleted_at
    $data['ListNSPK'] = [
        'Norma' => [],
        'Standar' => [],
        'Prosedur' => [],
        'Kriteria' => []
    ];
    
    // Query NSPK tanpa deleted_at
    $nspkData = $this->db->select('nspk.*, nd.jenis, nd.isi, nd.urutan')
        ->from('nspk')
        ->join('nspk_detail nd', 'nd.nspk_id = nspk.id', 'left')
        ->order_by('nd.jenis', 'ASC')
        ->order_by('nspk.judul_nspk', 'ASC')
        ->get()
        ->result_array();
    
    // Kelompokkan berdasarkan jenis dari nspk_detail
    foreach ($nspkData as $row) {
        $jenis = $row['jenis'] ?? 'Lainnya';
        if (!isset($data['ListNSPK'][$jenis])) {
            $data['ListNSPK'][$jenis] = [];
        }
        $data['ListNSPK'][$jenis][] = $row;
    }
    // ===================== END DATA NSPK =====================
    
    // Data Sasaran RPJMD
    $data['ListSasaranRPJMD'] = $this->db->select('id, Sasaran')
        ->order_by('id', 'ASC')
        ->get('sasaranrpjmd')
        ->result_array();
    
    // Data Tujuan PD (hanya milik instansi sendiri untuk Role 4)
    $data['ListTujuanPD'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, tujuan_pd')
            ->from('tujuan_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['ListTujuanPD'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    // Data Sasaran PD (hanya milik instansi sendiri untuk Role 4)
    $data['ListSasaranPD'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, sasaran_pd')
            ->from('sasaran_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['ListSasaranPD'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    // ========== AMBIL DATA MASTER ==========
    $data['TujuanSasaranPD'] = [];
    
    if ($KodeWilayah) {
        $master_query = $this->db->select('m.*, sr.Sasaran AS sasaran_relevan_text, tp.tujuan_pd AS tujuan_text')
            ->from('tujuansasaran_pd_master m')
            ->join('sasaranrpjmd sr', 'sr.id = m.sasaran_relevan_id', 'left')
            ->join('tujuan_pd tp', 'tp.id = m.tujuan_id', 'left')
            ->where('m.KodeWilayah', $KodeWilayah)
            ->where('m.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $master_query->where('m.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $master_query->where('m.id_instansi', (int)$filter_instansi_id);
        }
        
        $masters = $master_query->order_by('m.id', 'ASC')->get()->result_array();
        
        foreach ($masters as &$m) {
            // Proses NSPK - TANPA filter deleted_at
            $norma_ids = !empty($m['nspk_norma_id']) ? explode('|||', $m['nspk_norma_id']) : [];
            $standar_ids = !empty($m['nspk_standar_id']) ? explode('|||', $m['nspk_standar_id']) : [];
            $prosedur_ids = !empty($m['nspk_prosedur_id']) ? explode('|||', $m['nspk_prosedur_id']) : [];
            $kriteria_ids = !empty($m['nspk_kriteria_id']) ? explode('|||', $m['nspk_kriteria_id']) : [];
            
            // Ambil data Norma - TANPA deleted_at
            $m['norma_list'] = [];
            if (!empty($norma_ids)) {
                $m['norma_list'] = $this->db->select('nspk.*, nd.jenis, nd.isi')
                    ->from('nspk')
                    ->join('nspk_detail nd', 'nd.nspk_id = nspk.id', 'left')
                    ->where_in('nspk.id', $norma_ids)
                    ->where('nd.jenis', 'Norma')
                    ->get()
                    ->result_array();
            }
            
            // Ambil data Standar - TANPA deleted_at
            $m['standar_list'] = [];
            if (!empty($standar_ids)) {
                $m['standar_list'] = $this->db->select('nspk.*, nd.jenis, nd.isi')
                    ->from('nspk')
                    ->join('nspk_detail nd', 'nd.nspk_id = nspk.id', 'left')
                    ->where_in('nspk.id', $standar_ids)
                    ->where('nd.jenis', 'Standar')
                    ->get()
                    ->result_array();
            }
            
            // Ambil data Prosedur - TANPA deleted_at
            $m['prosedur_list'] = [];
            if (!empty($prosedur_ids)) {
                $m['prosedur_list'] = $this->db->select('nspk.*, nd.jenis, nd.isi')
                    ->from('nspk')
                    ->join('nspk_detail nd', 'nd.nspk_id = nspk.id', 'left')
                    ->where_in('nspk.id', $prosedur_ids)
                    ->where('nd.jenis', 'Prosedur')
                    ->get()
                    ->result_array();
            }
            
            // Ambil data Kriteria - TANPA deleted_at
            $m['kriteria_list'] = [];
            if (!empty($kriteria_ids)) {
                $m['kriteria_list'] = $this->db->select('nspk.*, nd.jenis, nd.isi')
                    ->from('nspk')
                    ->join('nspk_detail nd', 'nd.nspk_id = nspk.id', 'left')
                    ->where_in('nspk.id', $kriteria_ids)
                    ->where('nd.jenis', 'Kriteria')
                    ->get()
                    ->result_array();
            }
            
            // Ambil detail
            $detail_query = $this->db->select('d.*, sp.sasaran_pd AS sasaran_text')
                ->from('tujuansasaran_pd_detail d')
                ->join('sasaran_pd sp', 'sp.id = d.sasaran_id', 'left')
                ->where('d.master_id', $m['id'])
                ->where('d.deleted_at IS NULL');
            
            if ($is_role_4 && $instansi_id) {
                $detail_query->where('d.id_instansi', $instansi_id);
            } elseif (!empty($filter_instansi_id)) {
                $detail_query->where('d.id_instansi', (int)$filter_instansi_id);
            }
            
            $m['details'] = $detail_query->order_by('d.id', 'ASC')->get()->result_array();
        }
        
        $data['TujuanSasaranPD'] = $masters;
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/TujuanSasaranPD', $data);
}

    /**
     * Input Master Tujuan Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
     */
    public function InputTujuanSasaranPD_Master() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        if (!$this->can_crud()) {
            echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
            return;
        }
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        
        if (!$KodeWilayah) {
            echo "Wilayah belum dipilih!";
            return;
        }
        
        if (!$instansi_id) {
            echo "Data instansi tidak ditemukan!";
            return;
        }
        
        $nspk_norma_id = $this->input->post('nspk_norma_id');
        $nspk_standar_id = $this->input->post('nspk_standar_id');
        $nspk_prosedur_id = $this->input->post('nspk_prosedur_id');
        $nspk_kriteria_id = $this->input->post('nspk_kriteria_id');
        
        $norma_str = is_array($nspk_norma_id) ? implode('|||', array_filter($nspk_norma_id)) : '';
        $standar_str = is_array($nspk_standar_id) ? implode('|||', array_filter($nspk_standar_id)) : '';
        $prosedur_str = is_array($nspk_prosedur_id) ? implode('|||', array_filter($nspk_prosedur_id)) : '';
        $kriteria_str = is_array($nspk_kriteria_id) ? implode('|||', array_filter($nspk_kriteria_id)) : '';
        
        $sasaran_relevan_id = (int)$this->input->post('sasaran_relevan_id', true);
        $tujuan_id = (int)$this->input->post('tujuan_id', true);
        
        if (!$sasaran_relevan_id) {
            echo "Sasaran RPJMD harus dipilih!";
            return;
        }
        
        if (!$tujuan_id) {
            echo "Tujuan harus dipilih!";
            return;
        }
        
        $data = [
            'KodeWilayah'        => $KodeWilayah,
            'id_instansi'        => $instansi_id,
            'nspk_norma_id'      => $norma_str,
            'nspk_standar_id'    => $standar_str,
            'nspk_prosedur_id'   => $prosedur_str,
            'nspk_kriteria_id'   => $kriteria_str,
            'sasaran_relevan_id' => $sasaran_relevan_id,
            'tujuan_id'          => $tujuan_id,
            'created_at'         => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('tujuansasaran_pd_master', $data);
        echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan data!';
    }

    /**
     * Edit Master Tujuan Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
     */
    public function EditTujuanSasaranPD_Master() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        if (!$this->can_crud()) {
            echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
            return;
        }
        
        $id = (int)$this->input->post('id', true);
        $instansi_id = $this->get_instansi_id();
        
        if (!$id) {
            echo "ID tidak valid!";
            return;
        }
        
        // Validasi kepemilikan data
        $existing = $this->db->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('tujuansasaran_pd_master')
            ->row_array();
        
        if (!$existing) {
            echo "Data tidak ditemukan!";
            return;
        }
        
        if ($existing['id_instansi'] != $instansi_id) {
            echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
            return;
        }
        
        $nspk_norma_id = $this->input->post('nspk_norma_id');
        $nspk_standar_id = $this->input->post('nspk_standar_id');
        $nspk_prosedur_id = $this->input->post('nspk_prosedur_id');
        $nspk_kriteria_id = $this->input->post('nspk_kriteria_id');
        
        $norma_str = is_array($nspk_norma_id) ? implode('|||', array_filter($nspk_norma_id)) : '';
        $standar_str = is_array($nspk_standar_id) ? implode('|||', array_filter($nspk_standar_id)) : '';
        $prosedur_str = is_array($nspk_prosedur_id) ? implode('|||', array_filter($nspk_prosedur_id)) : '';
        $kriteria_str = is_array($nspk_kriteria_id) ? implode('|||', array_filter($nspk_kriteria_id)) : '';
        
        $sasaran_relevan_id = (int)$this->input->post('sasaran_relevan_id', true);
        $tujuan_id = (int)$this->input->post('tujuan_id', true);
        
        $data = [
            'nspk_norma_id'      => $norma_str,
            'nspk_standar_id'    => $standar_str,
            'nspk_prosedur_id'   => $prosedur_str,
            'nspk_kriteria_id'   => $kriteria_str,
            'sasaran_relevan_id' => $sasaran_relevan_id,
            'tujuan_id'          => $tujuan_id,
            'updated_at'         => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        $this->db->update('tujuansasaran_pd_master', $data);
        
        echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
    }

    /**
     * Hapus Master Tujuan Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
     */
    public function HapusTujuanSasaranPD_Master() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        if (!$this->can_crud()) {
            echo "Akses ditolak! Hanya Instansi yang dapat menghapus.";
            return;
        }
        
        $id = (int)$this->input->post('id', true);
        $instansi_id = $this->get_instansi_id();
        
        if (!$id) {
            echo "ID tidak valid!";
            return;
        }
        
        // Validasi kepemilikan data
        $existing = $this->db->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('tujuansasaran_pd_master')
            ->row_array();
        
        if (!$existing) {
            echo "Data tidak ditemukan!";
            return;
        }
        
        if ($existing['id_instansi'] != $instansi_id) {
            echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
            return;
        }
        
        // Soft delete master
        $this->db->where('id', $id);
        $this->db->update('tujuansasaran_pd_master', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        
        // Soft delete semua detail
        $this->db->where('master_id', $id);
        $this->db->update('tujuansasaran_pd_detail', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        
        echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus data!';
    }

    /**
     * Input Detail Tujuan Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
     */
    public function InputTujuanSasaranPD_Detail() {
    // Enable error reporting untuk debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    // Cek apakah request AJAX
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Cek role
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    
    try {
        // Ambil data dari session
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        
        // Validasi wilayah
        if (!$KodeWilayah) {
            echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
            return;
        }
        
        // Validasi instansi
        if (!$instansi_id) {
            echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
            return;
        }
        
        // Ambil dan validasi master_id
        $master_id = (int)$this->input->post('master_id', true);
        
        if ($master_id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Master ID tidak valid!']);
            return;
        }
        
        // Cek apakah master ada dan milik instansi ini
        $master = $this->db->where('id', $master_id)
            ->where('deleted_at IS NULL')
            ->get('tujuansasaran_pd_master')
            ->row_array();
        
        if (!$master) {
            echo json_encode(['status' => 'error', 'message' => 'Master data tidak ditemukan!']);
            return;
        }
        
        if ($master['id_instansi'] != $instansi_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menambah data ke master milik sendiri.']);
            return;
        }
        
        // Ambil data dari POST
        $sasaran_id = $this->input->post('sasaran_id', true);
        $indikator = trim($this->input->post('indikator', true));
        $keterangan = trim($this->input->post('keterangan', true));
        
        // Validasi indikator
        if (empty($indikator)) {
            echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi!']);
            return;
        }
        
        // Validasi sasaran_id jika diisi
        if (!empty($sasaran_id) && is_numeric($sasaran_id)) {
            $cek_sasaran = $this->db->where('id', $sasaran_id)
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->get('sasaran_pd')
                ->row_array();
            
            if (!$cek_sasaran) {
                echo json_encode(['status' => 'error', 'message' => 'Sasaran PD tidak valid!']);
                return;
            }
        } else {
            $sasaran_id = null;
        }
        
        // Siapkan data untuk insert - SESUAI STRUKTUR TABEL ANDA
        $data = [
            'id_instansi'   => $instansi_id,
            'master_id'     => $master_id,
            'sasaran_id'    => $sasaran_id,
            'indikator'     => $indikator,
            't2025'         => $this->input->post('t2025', true) ?: null,
            't2026'         => $this->input->post('t2026', true) ?: null,
            't2027'         => $this->input->post('t2027', true) ?: null,
            't2028'         => $this->input->post('t2028', true) ?: null,
            't2029'         => $this->input->post('t2029', true) ?: null,
            't2030'         => $this->input->post('t2030', true) ?: null,
            'keterangan'    => $keterangan,
            'created_at'    => date('Y-m-d H:i:s')
        ];
        
        // Insert ke database
        $insert = $this->db->insert('tujuansasaran_pd_detail', $data);
        
        if ($insert) {
            $insert_id = $this->db->insert_id();
            echo json_encode(['status' => 'success', 'message' => '1', 'id' => $insert_id]);
        } else {
            $error = $this->db->error();
            echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data: ' . $error['message']]);
        }
        
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
}

/**
 * Edit Detail Tujuan Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
 * SESUAI DENGAN STRUKTUR TABEL
 */
public function EditTujuanSasaranPD_Detail() {
    // Enable error reporting untuk debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    try {
        $id = (int)$this->input->post('id', true);
        $instansi_id = $this->get_instansi_id();
        
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
            return;
        }
        
        // Validasi kepemilikan data
        $existing = $this->db->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('tujuansasaran_pd_detail')
            ->row_array();
        
        if (!$existing) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
            return;
        }
        
        if ($existing['id_instansi'] != $instansi_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.']);
            return;
        }
        
        $sasaran_id = $this->input->post('sasaran_id', true) ?: null;
        $indikator = trim($this->input->post('indikator', true));
        $keterangan = trim($this->input->post('keterangan', true));
        
        if (empty($indikator)) {
            echo json_encode(['status' => 'error', 'message' => 'Indikator harus diisi!']);
            return;
        }
        
        $data = [
            'sasaran_id'    => $sasaran_id,
            'indikator'     => $indikator,
            't2025'         => $this->input->post('t2025', true) ?: null,
            't2026'         => $this->input->post('t2026', true) ?: null,
            't2027'         => $this->input->post('t2027', true) ?: null,
            't2028'         => $this->input->post('t2028', true) ?: null,
            't2029'         => $this->input->post('t2029', true) ?: null,
            't2030'         => $this->input->post('t2030', true) ?: null,
            'keterangan'    => $keterangan,
            'updated_at'    => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        $this->db->update('tujuansasaran_pd_detail', $data);
        
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'message' => '1']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada perubahan data!']);
        }
        
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
}

/**
 * Hapus Detail Tujuan Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusTujuanSasaranPD_Detail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    try {
        $id = (int)$this->input->post('id', true);
        $instansi_id = $this->get_instansi_id();
        
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
            return;
        }
        
        // Validasi kepemilikan data
        $existing = $this->db->where('id', $id)
            ->where('deleted_at IS NULL')
            ->get('tujuansasaran_pd_detail')
            ->row_array();
        
        if (!$existing) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
            return;
        }
        
        if ($existing['id_instansi'] != $instansi_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
            return;
        }
        
        $this->db->where('id', $id);
        $this->db->update('tujuansasaran_pd_detail', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        
        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'message' => '1']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data!']);
        }
        
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
}

    // =====================================================
// ARAH KEBIJAKAN PD
// =====================================================

/**
 * Halaman Arah Kebijakan PD
 */
public function ArahKebijakanPD() {
    $Header['Halaman'] = 'Arah Kebijakan Perangkat Daerah';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA UNTUK DROPDOWN (FILTER BERDASARKAN INSTANSI) ==========

// Permasalahan PD (gunakan instansi_id)
$data['ListPermasalahan'] = [];
if ($KodeWilayah) {
    $query = $this->db->select('id, masalah')
        ->from('permasalahan_pd')
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL');
    
    if ($is_role_4 && $instansi_id) {
        $query->where('instansi_id', $instansi_id);  // ← instansi_id
    } elseif (!empty($filter_instansi_id)) {
        $query->where('instansi_id', (int)$filter_instansi_id);  // ← instansi_id
    }
    
    $data['ListPermasalahan'] = $query->order_by('id', 'ASC')->get()->result_array();
}

// Isu Strategis PD (gunakan instansi_id)
$data['ListIsuStrategis'] = [];
if ($KodeWilayah) {
    $query = $this->db->select('id, isu_strategis')
        ->from('isu_strategis_pd')
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL');
    
    if ($is_role_4 && $instansi_id) {
        $query->where('instansi_id', $instansi_id);  // ← instansi_id
    } elseif (!empty($filter_instansi_id)) {
        $query->where('instansi_id', (int)$filter_instansi_id);  // ← instansi_id
    }
    
    $data['ListIsuStrategis'] = $query->order_by('id', 'ASC')->get()->result_array();
}

// Tujuan PD (gunakan id_instansi)
$data['ListTujuanPD'] = [];
if ($KodeWilayah) {
    $query = $this->db->select('id, tujuan_pd')
        ->from('tujuan_pd')
        ->where('kode_wilayah', $KodeWilayah)
        ->where('deleted_at IS NULL');
    
    if ($is_role_4 && $instansi_id) {
        $query->where('id_instansi', $instansi_id);  // ← id_instansi
    } elseif (!empty($filter_instansi_id)) {
        $query->where('id_instansi', (int)$filter_instansi_id);  // ← id_instansi
    }
    
    $data['ListTujuanPD'] = $query->order_by('id', 'ASC')->get()->result_array();
}

// Sasaran PD (gunakan id_instansi)
$data['ListSasaranPD'] = [];
if ($KodeWilayah) {
    $query = $this->db->select('id, sasaran_pd')
        ->from('sasaran_pd')
        ->where('kode_wilayah', $KodeWilayah)
        ->where('deleted_at IS NULL');
    
    if ($is_role_4 && $instansi_id) {
        $query->where('id_instansi', $instansi_id);  // ← id_instansi
    } elseif (!empty($filter_instansi_id)) {
        $query->where('id_instansi', (int)$filter_instansi_id);  // ← id_instansi
    }
    
    $data['ListSasaranPD'] = $query->order_by('id', 'ASC')->get()->result_array();
}

// ========== AMBIL DATA ARAH KEBIJAKAN PD ==========
$data['ArahKebijakanPD'] = [];

if ($KodeWilayah) {
    $query = $this->db->select('a.*, 
            p.masalah, 
            i.isu_strategis, 
            t.tujuan_pd, 
            s.sasaran_pd')
        ->from('arah_kebijakan_pd a')
        ->join('permasalahan_pd p', 'p.id = a.permasalahan_id', 'left')
        ->join('isu_strategis_pd i', 'i.id = a.isu_strategis_id', 'left')
        ->join('tujuan_pd t', 't.id = a.tujuan_id', 'left')
        ->join('sasaran_pd s', 's.id = a.sasaran_id', 'left')
        ->where('a.kode_wilayah', $KodeWilayah)
        ->where('a.deleted_at IS NULL');
    
    if ($is_role_4 && $instansi_id) {
        $query->where('a.id_instansi', $instansi_id);  // ← id_instansi (untuk tabel arah_kebijakan_pd)
    } elseif (!empty($filter_instansi_id)) {
        $query->where('a.id_instansi', (int)$filter_instansi_id);  // ← id_instansi
    }
    
    $data['ArahKebijakanPD'] = $query->order_by('a.id', 'ASC')->get()->result_array();
}
// Sasaran PD (hanya milik instansi sendiri untuk Role 4)
$data['ListSasaranPD'] = [];
if ($KodeWilayah) {
    $query = $this->db->select('id, sasaran_pd')
        ->from('sasaran_pd')
        ->where('kode_wilayah', $KodeWilayah)
        ->where('deleted_at IS NULL');
    
    if ($is_role_4 && $instansi_id) {
        $query->where('id_instansi', $instansi_id);  // GANTI
    } elseif (!empty($filter_instansi_id)) {
        $query->where('id_instansi', (int)$filter_instansi_id);  // GANTI
    }
    
    $data['ListSasaranPD'] = $query->order_by('id', 'ASC')->get()->result_array();
}

// ========== AMBIL DATA ARAH KEBIJAKAN PD ==========
$data['ArahKebijakanPD'] = [];

if ($KodeWilayah) {
    $query = $this->db->select('a.*, 
            p.masalah, 
            i.isu_strategis, 
            t.tujuan_pd, 
            s.sasaran_pd')
        ->from('arah_kebijakan_pd a')
        ->join('permasalahan_pd p', 'p.id = a.permasalahan_id', 'left')
        ->join('isu_strategis_pd i', 'i.id = a.isu_strategis_id', 'left')
        ->join('tujuan_pd t', 't.id = a.tujuan_id', 'left')
        ->join('sasaran_pd s', 's.id = a.sasaran_id', 'left')
        ->where('a.kode_wilayah', $KodeWilayah)
        ->where('a.deleted_at IS NULL');
    
    if ($is_role_4 && $instansi_id) {
        $query->where('a.id_instansi', $instansi_id);  // GANTI
    } elseif (!empty($filter_instansi_id)) {
        $query->where('a.id_instansi', (int)$filter_instansi_id);  // GANTI
    }
    
    $data['ArahKebijakanPD'] = $query->order_by('a.id', 'ASC')->get()->result_array();
}
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/ArahKebijakanPD', $data);
}

/**
 * Input Arah Kebijakan PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputArahKebijakanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $permasalahan_id = $this->input->post('permasalahan_id', true) ?: null;
    $isu_strategis_id = $this->input->post('isu_strategis_id', true) ?: null;
    $tujuan_id = $this->input->post('tujuan_id', true) ?: null;
    $sasaran_id = $this->input->post('sasaran_id', true) ?: null;
    $strategi = trim($this->input->post('strategi', true));
    $arah_kebijakan = trim($this->input->post('arah_kebijakan', true));
    
    if (empty($strategi)) {
        echo "Strategi harus diisi!";
        return;
    }
    
    if (empty($arah_kebijakan)) {
        echo "Arah Kebijakan harus diisi!";
        return;
    }
    
    $data = [
        'kode_wilayah'       => $KodeWilayah,
        'instansi_id'        => $instansi_id,
        'permasalahan_id'    => $permasalahan_id,
        'isu_strategis_id'   => $isu_strategis_id,
        'tujuan_id'          => $tujuan_id,
        'sasaran_id'         => $sasaran_id,
        'strategi'           => $strategi,
        'arah_kebijakan'     => $arah_kebijakan,
        'created_at'         => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('arah_kebijakan_pd', $data);
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan!';
}

/**
 * Edit Arah Kebijakan PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditArahKebijakanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
    
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('arah_kebijakan_pd')
        ->row_array();

    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }

    if ($existing['id_instansi'] != $instansi_id) {  // GANTI: instansi_id -> id_instansi
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $permasalahan_id = $this->input->post('permasalahan_id', true) ?: null;
    $isu_strategis_id = $this->input->post('isu_strategis_id', true) ?: null;
    $tujuan_id = $this->input->post('tujuan_id', true) ?: null;
    $sasaran_id = $this->input->post('sasaran_id', true) ?: null;
    $strategi = trim($this->input->post('strategi', true));
    $arah_kebijakan = trim($this->input->post('arah_kebijakan', true));
    
    if (empty($strategi)) {
        echo "Strategi harus diisi!";
        return;
    }
    
    if (empty($arah_kebijakan)) {
        echo "Arah Kebijakan harus diisi!";
        return;
    }
    
    $data = [
        'permasalahan_id'    => $permasalahan_id,
        'isu_strategis_id'   => $isu_strategis_id,
        'tujuan_id'          => $tujuan_id,
        'sasaran_id'         => $sasaran_id,
        'strategi'           => $strategi,
        'arah_kebijakan'     => $arah_kebijakan,
        'updated_at'         => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id);
    $this->db->update('arah_kebijakan_pd', $data);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
}

/**
 * Hapus Arah Kebijakan PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusArahKebijakanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
$existing = $this->db->where('id', $id)
    ->where('deleted_at IS NULL')
    ->get('arah_kebijakan_pd')
    ->row_array();

if (!$existing) {
    echo "Data tidak ditemukan!";
    return;
}

if ($existing['id_instansi'] != $instansi_id) {  // GANTI: instansi_id -> id_instansi
    echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
    return;
}
    
    $this->db->where('id', $id);
    $this->db->update('arah_kebijakan_pd', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus!';
}

// =====================================================
// NSPK OPERASIONALISASI PD
// =====================================================

/**
 * Halaman NSPK Operasionalisasi PD
 */
public function NSPKOperasionalisasiPD() {
    $Header['Halaman'] = 'NSPK Operasionalisasi PD';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA UNTUK DROPDOWN (FILTER BERDASARKAN INSTANSI) ==========
    
    // List NSPK (tujuansasaran_pd_master)
    $data['ListNSPK'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('m.id, m.nspk_norma_id, m.nspk_standar_id, m.nspk_prosedur_id, m.nspk_kriteria_id,
                                   sr.Sasaran as sasaran_rpjmd')
            ->from('tujuansasaran_pd_master m')
            ->join('sasaranrpjmd sr', 'sr.id = m.sasaran_relevan_id', 'left')
            ->where('m.KodeWilayah', $KodeWilayah)
            ->where('m.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('m.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('m.id_instansi', (int)$filter_instansi_id);
        }
        
        $masters = $query->order_by('m.id', 'ASC')->get()->result_array();
        
        foreach ($masters as $m) {
            $all_ids = array_merge(
                array_filter(explode("|||", $m['nspk_norma_id'] ?? "")),
                array_filter(explode("|||", $m['nspk_standar_id'] ?? "")),
                array_filter(explode("|||", $m['nspk_prosedur_id'] ?? "")),
                array_filter(explode("|||", $m['nspk_kriteria_id'] ?? ""))
            );
            
            $judul = [];
            if (!empty($all_ids)) {
                $rows = $this->db->select("judul_nspk")->where_in("id", $all_ids)->get("nspk")->result_array();
                $judul = array_column($rows, "judul_nspk");
            }
            
            $data['ListNSPK'][] = [
                "id" => $m['id'],
                "nama_nspk" => implode(" • ", $judul),
                "sasaran_rpjmd" => $m['sasaran_rpjmd'] ?? ''
            ];
        }
    }
    
    // List Arah Kebijakan RPJMD
    $data['ListArahKebijakanRPJMD'] = $this->db->select('id, arah_kebijakan')
        ->where('deleted_at IS NULL')
        ->order_by('id', 'ASC')
        ->get('arah_kebijakan_rpjmd')
        ->result_array();
    
    // List Arah Kebijakan Renstra PD (hanya milik instansi sendiri untuk Role 4)
    $data['ListArahKebijakanRenstraPD'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, arah_kebijakan')
            ->from('arah_kebijakan_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['ListArahKebijakanRenstraPD'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    // ========== AMBIL DATA NSPK OPERASIONALISASI PD ==========
    $data['NSPKOperasionalisasiPD'] = [];
    
    if ($KodeWilayah) {
        $query = $this->db->select("n.*, r1.arah_kebijakan AS arah_rpjmd_text, r2.arah_kebijakan AS arah_renstra_text")
            ->from("nspk_operasionalisasi_pd n")
            ->join("tujuansasaran_pd_master t", "t.id = n.tujuansasaranpd_master_id", "left")
            ->join("arah_kebijakan_rpjmd r1", "r1.id = n.arah_kebijakan_rpjmd_id", "left")
            ->join("arah_kebijakan_pd r2", "r2.id = n.arah_kebijakan_renstra_pd_id", "left")
            ->where("n.kode_wilayah", $KodeWilayah)
            ->where("n.deleted_at IS NULL");
        
        if ($is_role_4 && $instansi_id) {
            $query->where("n.id_instansi", $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where("n.id_instansi", (int)$filter_instansi_id);
        }
        
        $rows = $query->order_by("n.id", "ASC")->get()->result_array();
        
        foreach ($rows as &$row) {
            // Ambil master untuk mendapatkan NSPK
            $master = $this->db->where("id", $row['tujuansasaranpd_master_id'])
                ->get("tujuansasaran_pd_master")
                ->row_array();
            
            if ($master) {
                $norma_ids = array_filter(explode("|||", $master['nspk_norma_id'] ?? ""));
                $standar_ids = array_filter(explode("|||", $master['nspk_standar_id'] ?? ""));
                $prosedur_ids = array_filter(explode("|||", $master['nspk_prosedur_id'] ?? ""));
                $kriteria_ids = array_filter(explode("|||", $master['nspk_kriteria_id'] ?? ""));
                
                $row['nspk_text'] = [
                    "norma" => !empty($norma_ids) ? array_column($this->db->select("judul_nspk")->where_in("id", $norma_ids)->get("nspk")->result_array(), "judul_nspk") : [],
                    "standar" => !empty($standar_ids) ? array_column($this->db->select("judul_nspk")->where_in("id", $standar_ids)->get("nspk")->result_array(), "judul_nspk") : [],
                    "prosedur" => !empty($prosedur_ids) ? array_column($this->db->select("judul_nspk")->where_in("id", $prosedur_ids)->get("nspk")->result_array(), "judul_nspk") : [],
                    "kriteria" => !empty($kriteria_ids) ? array_column($this->db->select("judul_nspk")->where_in("id", $kriteria_ids)->get("nspk")->result_array(), "judul_nspk") : []
                ];
            }
            
            // Proses RPJMD
            $ids_rpjmd = array_filter(explode("|||", $row['arah_kebijakan_rpjmd_id'] ?? ""));
            $row['arah_rpjmd_text'] = !empty($ids_rpjmd) ? array_column($this->db->where_in("id", $ids_rpjmd)->get("arah_kebijakan_rpjmd")->result_array(), "arah_kebijakan") : [];
            
            // Proses Renstra
            $ids_renstra = array_filter(explode("|||", $row['arah_kebijakan_renstra_pd_id'] ?? ""));
            $row['arah_renstra_text'] = !empty($ids_renstra) ? array_column($this->db->where_in("id", $ids_renstra)->get("arah_kebijakan_pd")->result_array(), "arah_kebijakan") : [];
        }
        
        $data['NSPKOperasionalisasiPD'] = $rows;
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/NSPKOperasionalisasiPD', $data);
}

/**
 * Input NSPK Operasionalisasi PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputNSPKOperasionalisasiPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $tujuansasaran_pd_id = (int)$this->input->post('tujuansasaran_pd_id', true);
    $arah_rpjmd = array_filter((array)$this->input->post('arah_kebijakan_rpjmd_id'));
    $arah_renstra = array_filter((array)$this->input->post('arah_kebijakan_renstra_pd_id'));
    $keterangan = trim($this->input->post('keterangan', true));
    
    if (!$tujuansasaran_pd_id) {
        echo "Operasionalisasi NSPK wajib dipilih!";
        return;
    }
    
    if (empty($arah_rpjmd)) {
        echo "Minimal pilih 1 Arah Kebijakan RPJMD!";
        return;
    }
    
    if (empty($arah_renstra)) {
        echo "Minimal pilih 1 Arah Kebijakan Renstra PD!";
        return;
    }
    
    // Validasi apakah master milik instansi ini
    $master = $this->db->where('id', $tujuansasaran_pd_id)
        ->where('deleted_at IS NULL')
        ->get('tujuansasaran_pd_master')
        ->row_array();
    
    if (!$master || $master['id_instansi'] != $instansi_id) {
        echo "Data NSPK tidak valid atau bukan milik instansi Anda!";
        return;
    }
    
    $data = [
        'kode_wilayah' => $KodeWilayah,
        'id_instansi' => $instansi_id,
        'tujuansasaranpd_master_id' => $tujuansasaran_pd_id,
        'arah_kebijakan_rpjmd_id' => implode("|||", $arah_rpjmd),
        'arah_kebijakan_renstra_pd_id' => implode("|||", $arah_renstra),
        'keterangan' => $keterangan ?: NULL,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('nspk_operasionalisasi_pd', $data);
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan data!';
}

/**
 * Edit NSPK Operasionalisasi PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditNSPKOperasionalisasiPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('nspk_operasionalisasi_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $tujuansasaran_pd_id = (int)$this->input->post('tujuansasaran_pd_id', true);
    $arah_rpjmd = array_filter((array)$this->input->post('arah_kebijakan_rpjmd_id'));
    $arah_renstra = array_filter((array)$this->input->post('arah_kebijakan_renstra_pd_id'));
    $keterangan = trim($this->input->post('keterangan', true));
    
    if (!$tujuansasaran_pd_id) {
        echo "Operasionalisasi NSPK wajib dipilih!";
        return;
    }
    
    if (empty($arah_rpjmd)) {
        echo "Minimal pilih 1 Arah Kebijakan RPJMD!";
        return;
    }
    
    if (empty($arah_renstra)) {
        echo "Minimal pilih 1 Arah Kebijakan Renstra PD!";
        return;
    }
    
    // Validasi apakah master milik instansi ini
    $master = $this->db->where('id', $tujuansasaran_pd_id)
        ->where('deleted_at IS NULL')
        ->get('tujuansasaran_pd_master')
        ->row_array();
    
    if (!$master || $master['id_instansi'] != $instansi_id) {
        echo "Data NSPK tidak valid atau bukan milik instansi Anda!";
        return;
    }
    
    $data = [
        'tujuansasaranpd_master_id' => $tujuansasaran_pd_id,
        'arah_kebijakan_rpjmd_id' => implode("|||", $arah_rpjmd),
        'arah_kebijakan_renstra_pd_id' => implode("|||", $arah_renstra),
        'keterangan' => $keterangan ?: NULL,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id);
    $this->db->update('nspk_operasionalisasi_pd', $data);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
}

/**
 * Hapus NSPK Operasionalisasi PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusNSPKOperasionalisasiPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('nspk_operasionalisasi_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
        return;
    }
    
    $this->db->where('id', $id);
    $this->db->update('nspk_operasionalisasi_pd', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus data!';
}

// =====================================================
// RUMUSAN RENSTRA PD
// =====================================================

/**
 * Halaman Rumusan Renstra PD
 */
public function RumusanRenstraPD() {
    $Header['Halaman'] = 'Rumusan Renstra Perangkat Daerah';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA UNTUK DROPDOWN ==========
    
    // List NSPK (tujuansasaran_pd_master)
    $data['ListNSPK'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('m.*, sr.Sasaran AS sasaran_rpjmd')
            ->from('tujuansasaran_pd_master m')
            ->join('sasaranrpjmd sr', 'sr.id = m.sasaran_relevan_id', 'left')
            ->where('m.KodeWilayah', $KodeWilayah)
            ->where('m.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('m.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('m.id_instansi', (int)$filter_instansi_id);
        }
        
        $masters = $query->order_by('m.id', 'ASC')->get()->result_array();
        
        foreach ($masters as $m) {
            $all_ids = array_merge(
                array_filter(explode("|||", $m['nspk_norma_id'] ?? "")),
                array_filter(explode("|||", $m['nspk_standar_id'] ?? "")),
                array_filter(explode("|||", $m['nspk_prosedur_id'] ?? "")),
                array_filter(explode("|||", $m['nspk_kriteria_id'] ?? ""))
            );
            
            $judul = [];
            if (!empty($all_ids)) {
                $rows = $this->db->select("judul_nspk")->where_in("id", $all_ids)->get("nspk")->result_array();
                $judul = array_column($rows, "judul_nspk");
            }
            
            $data['ListNSPK'][] = [
                "id" => $m['id'],
                "nama_nspk" => implode(" • ", $judul),
                "sasaran_rpjmd" => $m['sasaran_rpjmd'] ?? ''
            ];
        }
    }
    
    // List Tujuan PD
    $data['ListTujuan'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, tujuan_pd')
            ->from('tujuan_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['ListTujuan'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    // List Sasaran PD
    $data['ListSasaran'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, sasaran_pd')
            ->from('sasaran_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['ListSasaran'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    // Map Tujuan dan Sasaran
    $data['MapTujuan'] = array_column($data['ListTujuan'], 'tujuan_pd', 'id');
    $data['MapSasaran'] = array_column($data['ListSasaran'], 'sasaran_pd', 'id');
    
    // ========== AMBIL DATA RUMUSAN RENSTRA ==========
    $data['RumusanRenstra'] = [];
    $data['GroupCounts'] = [];
    
    if ($KodeWilayah) {
        // Query header
        $header_query = $this->db->select('h.id as header_id, h.tujuansasaran_master_id, h.tujuan_pd,
                                    m.nspk_norma_id, m.nspk_standar_id, m.nspk_prosedur_id, m.nspk_kriteria_id,
                                    sr.Sasaran AS sasaran_rpjmd')
            ->from('rumusanrenstra_header h')
            ->join('tujuansasaran_pd_master m', 'm.id = h.tujuansasaran_master_id', 'left')
            ->join('sasaranrpjmd sr', 'sr.id = m.sasaran_relevan_id', 'left')
            ->where('h.kode_wilayah', $KodeWilayah)
            ->where('h.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $header_query->where('h.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $header_query->where('h.id_instansi', (int)$filter_instansi_id);
        }
        
        $headers = $header_query->order_by('h.id', 'ASC')->get()->result_array();
        
        $result = [];
        $groupCounts = [];
        
        foreach ($headers as $header) {
            // Ambil NSPK detail
            $norma_ids = !empty($header['nspk_norma_id']) ? explode('|||', $header['nspk_norma_id']) : [];
            $standar_ids = !empty($header['nspk_standar_id']) ? explode('|||', $header['nspk_standar_id']) : [];
            $prosedur_ids = !empty($header['nspk_prosedur_id']) ? explode('|||', $header['nspk_prosedur_id']) : [];
            $kriteria_ids = !empty($header['nspk_kriteria_id']) ? explode('|||', $header['nspk_kriteria_id']) : [];
            
            $header['norma'] = !empty($norma_ids) ? $this->db->select("judul_nspk")->where_in("id", $norma_ids)->get("nspk")->result_array() : [];
            $header['standar'] = !empty($standar_ids) ? $this->db->select("judul_nspk")->where_in("id", $standar_ids)->get("nspk")->result_array() : [];
            $header['prosedur'] = !empty($prosedur_ids) ? $this->db->select("judul_nspk")->where_in("id", $prosedur_ids)->get("nspk")->result_array() : [];
            $header['kriteria'] = !empty($kriteria_ids) ? $this->db->select("judul_nspk")->where_in("id", $kriteria_ids)->get("nspk")->result_array() : [];
            
            // Ambil detail
            // Pastikan id diambil sebagai detail_id
            $detail_query = $this->db->select('d.id as detail_id, d.*')
                ->from('rumusanrenstra_detail d')
                ->where('d.header_id', $header['header_id'])
                ->where('d.deleted_at IS NULL')
                ->order_by('d.urutan', 'ASC');
            
            if ($is_role_4 && $instansi_id) {
                $detail_query->where('d.id_instansi', $instansi_id);
            } elseif (!empty($filter_instansi_id)) {
                $detail_query->where('d.id_instansi', (int)$filter_instansi_id);
            }
            
            $details = $detail_query->get()->result_array();
            
            $groupCounts[$header['header_id']] = count($details) > 0 ? count($details) : 1;
            
            if (empty($details)) {
                $result[] = array_merge($header, [
                    'detail_id' => null,
                    'sasaran_pd' => null,
                    'outcome' => null,
                    'output' => null,
                    'indikator' => null,
                    'program' => null,
                    'kegiatan' => null,
                    'sub_kegiatan' => null,
                    'keterangan' => null
                ]);
            } else {
                foreach ($details as $detail) {
                    $result[] = array_merge($header, $detail);
                }
            }
        }
        
        $data['RumusanRenstra'] = $result;
        $data['GroupCounts'] = $groupCounts;
    }

    // Pastikan semua data yang akan ditampilkan aman
    foreach ($data['RumusanRenstra'] as &$r) {
        $r['detail_id'] = $r['detail_id'] ?? null;
        $r['sasaran_pd'] = $r['sasaran_pd'] ?? null;
        $r['outcome'] = $r['outcome'] ?? '';
        $r['output'] = $r['output'] ?? '';
        $r['indikator'] = $r['indikator'] ?? '';
        $r['program'] = $r['program'] ?? '';
        $r['kegiatan'] = $r['kegiatan'] ?? '';
        $r['sub_kegiatan'] = $r['sub_kegiatan'] ?? '';
        $r['keterangan'] = $r['keterangan'] ?? '';
        $r['tujuan_pd'] = $r['tujuan_pd'] ?? 0;
        $r['tujuansasaran_master_id'] = $r['tujuansasaran_master_id'] ?? 0;
        $r['sasaran_rpjmd'] = $r['sasaran_rpjmd'] ?? '';
        $r['norma'] = $r['norma'] ?? [];
        $r['standar'] = $r['standar'] ?? [];
        $r['prosedur'] = $r['prosedur'] ?? [];
        $r['kriteria'] = $r['kriteria'] ?? [];
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/RumusanRenstraPD', $data);
}

/**
 * Simpan Header Rumusan Renstra PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function SimpanRumusanRenstraPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status'=>'error', 'message'=>'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo json_encode(['status'=>'error','message'=>'Wilayah tidak ditemukan']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status'=>'error','message'=>'Data instansi tidak ditemukan!']);
        return;
    }
    
    $tujuansasaran_master_id = (int)$this->input->post("tujuansasaran_master_id", true);
    $tujuan_pd = (int)$this->input->post("tujuan_pd", true);
    
    if (!$tujuansasaran_master_id) {
        echo json_encode(['status'=>'error','message'=>'NSPK harus dipilih!']);
        return;
    }
    
    if (!$tujuan_pd) {
        echo json_encode(['status'=>'error','message'=>'Tujuan PD harus dipilih!']);
        return;
    }
    
    $data = [
        'kode_wilayah'            => $kode_wilayah,
        'id_instansi'             => $instansi_id,
        'tujuansasaran_master_id' => $tujuansasaran_master_id,
        'tujuan_pd'               => $tujuan_pd,
        'created_at'              => date("Y-m-d H:i:s")
    ];
    
    $this->db->insert("rumusanrenstra_header", $data);
    
    echo json_encode([
        'status' => $this->db->affected_rows() ? 'success' : 'error'
    ]);
}

/**
 * Update Header Rumusan Renstra PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function UpdateHeaderRenstra() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $id = (int)$this->input->post("id", true);
    
    if (!$id) {
        echo json_encode(['status'=>'error','message'=>'ID tidak valid!']);
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rumusanrenstra_header')
        ->row_array();
    
    if (!$existing) {
        echo json_encode(['status'=>'error','message'=>'Data tidak ditemukan!']);
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.']);
        return;
    }
    
    $data = [
        "tujuansasaran_master_id" => (int)$this->input->post("tujuansasaran_master_id", true),
        "tujuan_pd"              => (int)$this->input->post("tujuan_pd", true),
        "updated_at"             => date("Y-m-d H:i:s")
    ];
    
    $this->db->where("id", $id)
             ->where("kode_wilayah", $kode_wilayah)
             ->update("rumusanrenstra_header", $data);
    
    echo json_encode([
        "status" => $this->db->affected_rows() ? "success" : "error"
    ]);
}

/**
 * Hapus Header Rumusan Renstra PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusHeader() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $id = (int)$this->input->post("id", true);
    
    if (!$id) {
        echo json_encode(['status'=>'error','message'=>'ID tidak valid!']);
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rumusanrenstra_header')
        ->row_array();
    
    if (!$existing) {
        echo json_encode(['status'=>'error','message'=>'Data tidak ditemukan!']);
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        return;
    }
    
    $now = date("Y-m-d H:i:s");
    
    // Soft delete header
    $this->db->where("id", $id)
             ->where("kode_wilayah", $kode_wilayah)
             ->update("rumusanrenstra_header", ['deleted_at' => $now]);
    
    // Soft delete semua detail
    $this->db->where("header_id", $id)
             ->where("kode_wilayah", $kode_wilayah)
             ->update("rumusanrenstra_detail", ['deleted_at' => $now]);
    
    echo json_encode([
        'status' => $this->db->affected_rows() ? 'success' : 'error'
    ]);
}

/**
 * Tambah Detail Rumusan Renstra PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function TambahDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $header_id = (int)$this->input->post("header_id", true);
    $sasaran_pd = (int)$this->input->post("sasaran_pd", true);
    
    if (!$header_id) {
        echo json_encode(['status'=>'error','message'=>'Header tidak valid']);
        return;
    }
    
    if (!$sasaran_pd) {
        echo json_encode(['status'=>'error','message'=>'Sasaran PD harus dipilih!']);
        return;
    }
    
    // Validasi header milik instansi ini
    $header = $this->db->where("id", $header_id)
        ->where("kode_wilayah", $kode_wilayah)
        ->where("deleted_at IS NULL")
        ->get("rumusanrenstra_header")
        ->row_array();
    
    if (!$header) {
        echo json_encode(['status'=>'error','message'=>'Header tidak valid!']);
        return;
    }
    
    if ($header['id_instansi'] != $instansi_id) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Anda hanya dapat menambah data ke header milik sendiri.']);
        return;
    }
    
    // Urutan otomatis
    $last = $this->db->select("MAX(urutan) as max_urutan")
        ->where("header_id", $header_id)
        ->where("deleted_at IS NULL")
        ->get("rumusanrenstra_detail")
        ->row_array();
    
    $urutan = ($last['max_urutan'] ?? 0) + 10;
    
    $data = [
        'header_id'     => $header_id,
        'kode_wilayah'  => $kode_wilayah,
        'id_instansi'   => $instansi_id,
        'sasaran_pd'    => $sasaran_pd,
        'urutan'        => $urutan,
        'created_at'    => date("Y-m-d H:i:s")
    ];
    
    $this->db->insert("rumusanrenstra_detail", $data);
    
    echo json_encode([
        'status' => $this->db->affected_rows() ? 'success' : 'error'
    ]);
}

/**
 * Update Detail (Sasaran PD) Rumusan Renstra PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function UpdateDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $id = (int)$this->input->post("id", true);
    $sasaran_pd = (int)$this->input->post("sasaran_pd", true);
    
    if (!$id) {
        echo json_encode(['status'=>'error','message'=>'ID tidak valid!']);
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rumusanrenstra_detail')
        ->row_array();
    
    if (!$existing) {
        echo json_encode(['status'=>'error','message'=>'Data tidak ditemukan!']);
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.']);
        return;
    }
    
    $this->db->where("id", $id)
             ->where("kode_wilayah", $kode_wilayah)
             ->update("rumusanrenstra_detail", [
                 'sasaran_pd' => $sasaran_pd,
                 'updated_at' => date("Y-m-d H:i:s")
             ]);
    
    echo json_encode([
        'status' => $this->db->affected_rows() ? 'success' : 'error'
    ]);
}

/**
 * Update Kolom Multi Value (Outcome, Output, Indikator, Program, Kegiatan, Sub Kegiatan, Keterangan)
 */
public function UpdateKolomDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $id = (int)$this->input->post("id", true);
    $kolom = strtolower(trim($this->input->post("kolom")));
    $nilai = trim($this->input->post("nilai"));
    $mode = $this->input->post("mode");
    
    $allowed = ['outcome', 'output', 'indikator', 'program', 'kegiatan', 'sub_kegiatan', 'keterangan'];
    
    if (!in_array($kolom, $allowed)) {
        echo json_encode(['status'=>'error','message'=>'Kolom tidak valid']);
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rumusanrenstra_detail')
        ->row_array();
    
    if (!$existing) {
        echo json_encode(['status'=>'error','message'=>'Data tidak ditemukan!']);
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.']);
        return;
    }
    
    // Mode replace
    if ($mode === "replace") {
        $this->db->where("id", $id)
                 ->where("kode_wilayah", $kode_wilayah)
                 ->update("rumusanrenstra_detail", [
                     $kolom => $nilai,
                     'updated_at' => date("Y-m-d H:i:s")
                 ]);
        
        echo json_encode(['status'=>'success']);
        return;
    }
    
    // Mode tambah (append)
    $old = $this->db->select($kolom)
        ->where("id", $id)
        ->where("kode_wilayah", $kode_wilayah)
        ->get("rumusanrenstra_detail")
        ->row_array();
    
    $oldValue = $old[$kolom] ?? "";
    
    if (!empty($oldValue) && !empty($nilai)) {
        $nilai = $oldValue . "|||" . $nilai;
    }
    
    $this->db->where("id", $id)
             ->where("kode_wilayah", $kode_wilayah)
             ->update("rumusanrenstra_detail", [
                 $kolom => $nilai,
                 'updated_at' => date("Y-m-d H:i:s")
             ]);
    
    echo json_encode(['status'=>'success']);
}

/**
 * Hapus Detail Rumusan Renstra PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $id = (int)$this->input->post("id", true);
    
    if (!$id) {
        echo json_encode(['status'=>'error','message'=>'ID tidak valid!']);
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rumusanrenstra_detail')
        ->row_array();
    
    if (!$existing) {
        echo json_encode(['status'=>'error','message'=>'Data tidak ditemukan!']);
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo json_encode(['status'=>'error','message'=>'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        return;
    }
    
    $this->db->where("id", $id)
             ->where("kode_wilayah", $kode_wilayah)
             ->update("rumusanrenstra_detail", [
                 'deleted_at' => date("Y-m-d H:i:s")
             ]);
    
    echo json_encode([
        'status' => $this->db->affected_rows() ? 'success' : 'error'
    ]);
}

// =====================================================
// RENCANA PROGRAM PENDANAAN
// =====================================================

/**
 * Halaman Rencana Program Pendanaan
 */
public function RencanaProgramPendanaan() {
    $Header['Halaman'] = 'Rencana Program Pendanaan';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA UNTUK DROPDOWN ==========
    
    // Data Urusan PD 
        $data['listUrusan'] = [];
        if ($KodeWilayah) {
            $data['listUrusan'] = $this->db->select('id, nama_urusan')
                ->from('urusan_pd')
                ->where('kodewilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('nama_urusan', 'ASC')
                ->get()
                ->result_array();
        }
    
    // Data Renstra (rumusanrenstra_detail) - hanya milik instansi sendiri
    $data['listRenstra'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, outcome, output, program, kegiatan, sub_kegiatan')
            ->from('rumusanrenstra_detail')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        }
        
        $data['listRenstra'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    // Data Indikator (dari rumusanrenstra_detail)
    $data['listIndikator'] = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, indikator')
            ->from('rumusanrenstra_detail')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('indikator IS NOT NULL')
            ->where('indikator != ""')
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        }
        
        $renstra_indikator = $query->get()->result_array();
        
        $listIndikator = [];
        foreach ($renstra_indikator as $row) {
            $parts = explode('|||', $row['indikator']);
            foreach ($parts as $p) {
                $p = trim($p);
                if ($p != '') {
                    $listIndikator[] = [
                        'id' => $row['id'],
                        'text' => $p
                    ];
                }
            }
        }
        $data['listIndikator'] = $listIndikator;
    }
    
    // ========== AMBIL DATA RENCANA PROGRAM PENDANAAN ==========
    $data['list'] = [];
    
    if ($KodeWilayah) {
        $this->db->select("r.*, 
            CASE 
                WHEN r.sumber_tipe = 'urusan' THEN u.nama_urusan
                WHEN r.sumber_tipe = 'outcome' THEN d.outcome
                WHEN r.sumber_tipe = 'output' THEN d.output
                WHEN r.sumber_tipe = 'program' THEN d.program
                WHEN r.sumber_tipe = 'kegiatan' THEN d.kegiatan
                WHEN r.sumber_tipe = 'sub_kegiatan' THEN d.sub_kegiatan
            END as nama_sumber,
            ri.indikator as nama_indikator")
            ->from('rencana_program_pendanaan r')
            ->join('urusan_pd u', 'u.id = r.sumber_id', 'left')
            ->join('rumusanrenstra_detail d', 'd.id = r.sumber_id', 'left')
            ->join('rumusanrenstra_detail ri', 'ri.id = r.indikator_id', 'left')
            ->where('r.kodewilayah', $KodeWilayah)
            ->where('r.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $this->db->where('r.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $this->db->where('r.id_instansi', (int)$filter_instansi_id);
        }
        
        $data['list'] = $this->db->order_by('r.id', 'ASC')->get()->result_array();
    }
    
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/RencanaProgramPendanaan', $data);
}

/**
 * Input Rencana Program Pendanaan (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputRencanaProgramPendanaan() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $sumber_tipe = $this->input->post("sumber_tipe");
    $sumber_id = $this->input->post("sumber_id");
    
    if (empty($sumber_tipe) || empty($sumber_id)) {
        echo "Sumber data wajib dipilih!";
        return;
    }
    
    $data = [
        'kodewilayah'     => $KodeWilayah,
        'id_instansi'     => $instansi_id,
        'sumber_tipe'     => $sumber_tipe,
        'sumber_id'       => $sumber_id,
        'sumber_nilai'    => $this->input->post("sumber_nilai"),
        'indikator_id'    => $this->input->post("indikator_id"),
        'indikator_text'  => $this->input->post("indikator_text"),
        'baseline'        => $this->input->post("baseline"),
        'target_2026'     => $this->input->post("target_2026"),
        'pagu_2026'       => $this->input->post("pagu_2026"),
        'target_2027'     => $this->input->post("target_2027"),
        'pagu_2027'       => $this->input->post("pagu_2027"),
        'target_2028'     => $this->input->post("target_2028"),
        'pagu_2028'       => $this->input->post("pagu_2028"),
        'target_2029'     => $this->input->post("target_2029"),
        'pagu_2029'       => $this->input->post("pagu_2029"),
        'target_2030'     => $this->input->post("target_2030"),
        'pagu_2030'       => $this->input->post("pagu_2030"),
        'keterangan'      => $this->input->post("keterangan"),
        'created_at'      => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert("rencana_program_pendanaan", $data);
    echo $this->db->affected_rows() ? '1' : 'Gagal menyimpan data!';
}

/**
 * Edit Rencana Program Pendanaan (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditRencanaProgramPendanaan() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = $this->input->post("id");
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('rencana_program_pendanaan')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $sumber_tipe = $this->input->post("sumber_tipe");
    $sumber_id = $this->input->post("sumber_id");
    
    if (empty($sumber_tipe) || empty($sumber_id)) {
        echo "Sumber data wajib dipilih!";
        return;
    }
    
    $data = [
        'sumber_tipe'     => $sumber_tipe,
        'sumber_id'       => $sumber_id,
        'sumber_nilai'    => $this->input->post("sumber_nilai"),
        'indikator_id'    => $this->input->post("indikator_id"),
        'indikator_text'  => $this->input->post("indikator_text"),
        'baseline'        => $this->input->post("baseline"),
        'target_2026'     => $this->input->post("target_2026"),
        'pagu_2026'       => $this->input->post("pagu_2026"),
        'target_2027'     => $this->input->post("target_2027"),
        'pagu_2027'       => $this->input->post("pagu_2027"),
        'target_2028'     => $this->input->post("target_2028"),
        'pagu_2028'       => $this->input->post("pagu_2028"),
        'target_2029'     => $this->input->post("target_2029"),
        'pagu_2029'       => $this->input->post("pagu_2029"),
        'target_2030'     => $this->input->post("target_2030"),
        'pagu_2030'       => $this->input->post("pagu_2030"),
        'keterangan'      => $this->input->post("keterangan"),
        'updated_at'      => date('Y-m-d H:i:s')
    ];
    
    $this->db->where("id", $id);
    $this->db->update("rencana_program_pendanaan", $data);
    echo "1";
}

/**
 * Hapus Rencana Program Pendanaan (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusRencanaProgramPendanaan() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
        return;
    }
    
    $id = $this->input->post("id");
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('rencana_program_pendanaan')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
        return;
    }
    
    $this->db->where("id", $id);
    $this->db->update("rencana_program_pendanaan", [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo "1";
}

// =====================================================
// SUB KEGIATAN PRIORITAS
// =====================================================

/**
 * Halaman Sub Kegiatan Prioritas
 */
public function SubKegiatanPrioritas() {
    $Header['Halaman'] = 'Sub Kegiatan Prioritas';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA SUB KEGIATAN PRIORITAS ==========
    $data['Data'] = [];
    
    if ($KodeWilayah) {
        $query = $this->db->from('sub_kegiatan_prioritas')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['Data'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/SubKegiatanPrioritas', $data);
}

/**
 * Input Sub Kegiatan Prioritas (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputSubKegiatanPrioritas() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $program_prioritas = trim($this->input->post('program_prioritas', true));
    $outcome = trim($this->input->post('outcome', true));
    $kegiatan = trim($this->input->post('kegiatan', true));
    $sub_kegiatan = trim($this->input->post('sub_kegiatan', true));
    $keterangan = trim($this->input->post('keterangan', true));
    
    if (empty($program_prioritas)) {
        echo "Program Prioritas harus diisi!";
        return;
    }
    
    if (empty($outcome)) {
        echo "Outcome harus diisi!";
        return;
    }
    
    if (empty($kegiatan)) {
        echo "Kegiatan harus diisi!";
        return;
    }
    
    if (empty($sub_kegiatan)) {
        echo "Sub Kegiatan harus diisi!";
        return;
    }
    
    $data = [
        'kode_wilayah'      => $KodeWilayah,
        'id_instansi'       => $instansi_id,
        'program_prioritas' => $program_prioritas,
        'outcome'           => $outcome,
        'kegiatan'          => $kegiatan,
        'sub_kegiatan'      => $sub_kegiatan,
        'keterangan'        => $keterangan,
        'created_at'        => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('sub_kegiatan_prioritas', $data);
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan data!';
}

/**
 * Edit Sub Kegiatan Prioritas (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditSubKegiatanPrioritas() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('sub_kegiatan_prioritas')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $program_prioritas = trim($this->input->post('program_prioritas', true));
    $outcome = trim($this->input->post('outcome', true));
    $kegiatan = trim($this->input->post('kegiatan', true));
    $sub_kegiatan = trim($this->input->post('sub_kegiatan', true));
    $keterangan = trim($this->input->post('keterangan', true));
    
    if (empty($program_prioritas)) {
        echo "Program Prioritas harus diisi!";
        return;
    }
    
    $data = [
        'program_prioritas' => $program_prioritas,
        'outcome'           => $outcome,
        'kegiatan'          => $kegiatan,
        'sub_kegiatan'      => $sub_kegiatan,
        'keterangan'        => $keterangan,
        'updated_at'        => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id);
    $this->db->update('sub_kegiatan_prioritas', $data);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
}

/**
 * Hapus Sub Kegiatan Prioritas (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusSubKegiatanPrioritas() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('sub_kegiatan_prioritas')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat menghapusdata-table-basic instansi sendiri.";
        return;
    }
    
    $this->db->where('id', $id);
    $this->db->update('sub_kegiatan_prioritas', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus!';
}

// =====================================================
// IKU PD
// =====================================================

/**
 * Halaman IKU PD
 */
public function IkuPD() {
    $Header['Halaman'] = 'IKU Perangkat Daerah';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA IKU PD ==========
    $data['Data'] = [];
    
    if ($KodeWilayah) {
        $query = $this->db->from('iku_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['Data'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/IkuPD', $data);
}

/**
 * Input IKU PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputIkuPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $indikator = trim($this->input->post('indikator', true));
    $satuan = trim($this->input->post('satuan', true));
    
    if (empty($indikator)) {
        echo "Indikator harus diisi!";
        return;
    }
    
    if (empty($satuan)) {
        echo "Satuan harus diisi!";
        return;
    }
    
    $data = [
        'kode_wilayah'   => $KodeWilayah,
        'id_instansi'    => $instansi_id,
        'indikator'      => $indikator,
        'satuan'         => $satuan,
        'baseline_2024'  => $this->input->post('baseline_2024', true),
        't_2025'         => $this->input->post('t_2025', true),
        't_2026'         => $this->input->post('t_2026', true),
        't_2027'         => $this->input->post('t_2027', true),
        't_2028'         => $this->input->post('t_2028', true),
        't_2029'         => $this->input->post('t_2029', true),
        't_2030'         => $this->input->post('t_2030', true),
        'keterangan'     => $this->input->post('keterangan', true),
        'created_at'     => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('iku_pd', $data);
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan!';
}

/**
 * Edit IKU PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditIkuPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('iku_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $indikator = trim($this->input->post('indikator', true));
    $satuan = trim($this->input->post('satuan', true));
    
    if (empty($indikator)) {
        echo "Indikator harus diisi!";
        return;
    }
    
    $data = [
        'indikator'      => $indikator,
        'satuan'         => $satuan,
        'baseline_2024'  => $this->input->post('baseline_2024', true),
        't_2025'         => $this->input->post('t_2025', true),
        't_2026'         => $this->input->post('t_2026', true),
        't_2027'         => $this->input->post('t_2027', true),
        't_2028'         => $this->input->post('t_2028', true),
        't_2029'         => $this->input->post('t_2029', true),
        't_2030'         => $this->input->post('t_2030', true),
        'keterangan'     => $this->input->post('keterangan', true),
        'updated_at'     => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id);
    $this->db->update('iku_pd', $data);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan!';
}

/**
 * Hapus IKU PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusIkuPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('iku_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat menghapus instansi sendiri.";
        return;
    }
    
    $this->db->where('id', $id);
    $this->db->update('iku_pd', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus!';
}

// =====================================================
// IKK PD
// =====================================================

/**
 * Halaman IKK PD
 */
public function IkkPD() {
    $Header['Halaman'] = 'IKK Perangkat Daerah';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    $urusan_id = $this->input->get('urusan_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    $data['UrusanAktif'] = $urusan_id;
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // Data Urusan PD (tidak perlu filter id_instansi)
    $data['Urusan'] = [];
    if ($KodeWilayah) {
        $data['Urusan'] = $this->db->select('id, nama_urusan')
            ->from('urusan_pd')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama_urusan', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA IKK PD ==========
    $data['Data'] = [];
    
    if ($KodeWilayah && $urusan_id) {
        $query = $this->db->from('ikk_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('urusan_id', $urusan_id)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['Data'] = $query->order_by('id', 'ASC')->get()->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/IkkPD', $data);
}

/**
 * Input IKK PD (AJAX) - HANYA UNTUK ROLE 4
 */
/**
 * Input IKK PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function InputIkkPD() {
    // Debug: log semua POST data
    log_message('debug', 'InputIkkPD - POST data: ' . print_r($this->input->post(), true));
    
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menambah data.";
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo "Wilayah belum dipilih!";
        return;
    }
    
    if (!$instansi_id) {
        echo "Data instansi tidak ditemukan!";
        return;
    }
    
    $urusan_id = (int)$this->input->post('urusan_id', true);
    $indikator = trim($this->input->post('indikator', true));
    $satuan = trim($this->input->post('satuan', true));
    
    // Debug
    log_message('debug', "urusan_id: $urusan_id, indikator: $indikator, satuan: $satuan");
    
    if (!$urusan_id) {
        echo "Urusan PD harus dipilih!";
        return;
    }
    
    if (empty($indikator)) {
        echo "Indikator harus diisi!";
        return;
    }
    
    if (empty($satuan)) {
        echo "Satuan harus diisi!";
        return;
    }
    
    $data = [
        'kode_wilayah'   => $KodeWilayah,
        'id_instansi'    => $instansi_id,
        'urusan_id'      => $urusan_id,
        'indikator'      => $indikator,
        'satuan'         => $satuan,
        'baseline_2024'  => $this->input->post('baseline_2024', true),
        't_2025'         => $this->input->post('t_2025', true),
        't_2026'         => $this->input->post('t_2026', true),
        't_2027'         => $this->input->post('t_2027', true),
        't_2028'         => $this->input->post('t_2028', true),
        't_2029'         => $this->input->post('t_2029', true),
        't_2030'         => $this->input->post('t_2030', true),
        'keterangan'     => $this->input->post('keterangan', true),
        'created_at'     => date('Y-m-d H:i:s')
    ];
    
    // Debug: log data yang akan diinsert
    log_message('debug', 'Data to insert: ' . print_r($data, true));
    
    $insert = $this->db->insert('ikk_pd', $data);
    
    if ($insert) {
        echo '1';
    } else {
        $error = $this->db->error();
        log_message('error', 'Database error: ' . print_r($error, true));
        echo 'Gagal menyimpan data: ' . $error['message'];
    }
}

/**
 * Edit IKK PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function EditIkkPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat mengedit data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('ikk_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
        return;
    }
    
    $indikator = trim($this->input->post('indikator', true));
    $satuan = trim($this->input->post('satuan', true));
    
    if (empty($indikator)) {
        echo "Indikator harus diisi!";
        return;
    }
    
    $data = [
        'indikator'      => $indikator,
        'satuan'         => $satuan,
        'baseline_2024'  => $this->input->post('baseline_2024', true),
        't_2025'         => $this->input->post('t_2025', true),
        't_2026'         => $this->input->post('t_2026', true),
        't_2027'         => $this->input->post('t_2027', true),
        't_2028'         => $this->input->post('t_2028', true),
        't_2029'         => $this->input->post('t_2029', true),
        't_2030'         => $this->input->post('t_2030', true),
        'keterangan'     => $this->input->post('keterangan', true),
        'updated_at'     => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id);
    $this->db->update('ikk_pd', $data);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
}

/**
 * Hapus IKK PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function HapusIkkPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo "Akses ditolak! Hanya Instansi yang dapat menghapus data.";
        return;
    }
    
    $id = (int)$this->input->post('id', true);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo "ID tidak valid!";
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('ikk_pd')
        ->row_array();
    
    if (!$existing) {
        echo "Data tidak ditemukan!";
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo "Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.";
        return;
    }
    
    $this->db->where('id', $id);
    $this->db->update('ikk_pd', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus data!';
}

/**
 * Get Nomenklatur Berdasarkan Level (AJAX) - Untuk semua role
 */
public function getNomenklaturByLevel() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $level = (int)$this->input->post('level');
    $parent_kode = $this->input->post('parent_kode');
    
    if ($level < 1 || $level > 5) {
        echo json_encode([]);
        return;
    }
    
    $this->db->select('Kode, Nomenklatur');
    $this->db->from('nomenklaturkabupaten');
    
    // Logika khusus untuk struktur data dengan lompatan titik
    if ($level == 1) {
        // Urusan: 0 titik
        $this->db->where('Kode NOT LIKE', '%.%');
        $this->db->where('LENGTH(Kode) = 1');
    } elseif ($level == 2) {
        // Bidang Urusan: 1 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1);
        if ($parent_kode) {
            $this->db->where('Kode LIKE', $parent_kode . '.%');
        }
    } elseif ($level == 3) {
        // Program: 2 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 2);
        if ($parent_kode) {
            $this->db->where('Kode LIKE', $parent_kode . '.%');
        }
    } elseif ($level == 4) {
        // Kegiatan: 4 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 4);
        if ($parent_kode) {
            $this->db->where('Kode LIKE', $parent_kode . '.%');
            $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 4);
        }
    } elseif ($level == 5) {
        // Sub Kegiatan: 5 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 5);
        if ($parent_kode) {
            $this->db->where('Kode LIKE', $parent_kode . '.%');
        }
    }
    
    $this->db->order_by('Kode', 'ASC');
    $data = $this->db->get()->result_array();
    
    echo json_encode($data);
}

/**
 * Get Detail Nomenklatur by Kode (AJAX)
 */
public function getNomenklaturDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kode = $this->input->post('kode');
    
    if (!$kode) {
        echo json_encode(['status' => 'error', 'message' => 'Kode tidak ditemukan']);
        return;
    }
    
    $data = $this->db
        ->select('Kode, Nomenklatur, Kinerja, Indikator, Satuan')
        ->from('nomenklaturkabupaten')
        ->where('Kode', $kode)
        ->get()
        ->row_array();
    
    if ($data) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
}

// =====================================================
// ULTIMATE OUTCOME PD (LEVEL 1) - PERANGKAT DAERAH
// =====================================================

/**
 * Halaman Ultimate Outcome PD (Level 1)
 * - Role 4: Bisa CRUD
 * - Role lain: Hanya melihat
 */
public function Ultimate_outcome_pd()
{
    $Header['Halaman'] = 'Ultimate Outcome PD';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter (hanya untuk non-role 4)
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA INTERMEDIATE SEKTOR UNTUK DROPDOWN ==========
    $data['intermediate_sektor'] = [];
    $data['intermediate_taktikal'] = [];
    
    if ($KodeWilayah) {
        // Ambil data dari pk_intermediate_sektor (hanya untuk dropdown)
        $data['intermediate_sektor'] = $this->db
            ->select('id, kinerja, indikator')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('id', 'ASC')
            ->get('pk_intermediate_sektor')
            ->result_array();
        
        // Ambil data dari pk_intermediate_taktikal (hanya untuk dropdown)
        $data['intermediate_taktikal'] = $this->db
            ->select('id, kinerja, indikator')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('id', 'ASC')
            ->get('pk_intermediate_taktikal')
            ->result_array();
    }
    
    // ========== AMBIL DATA ULTIMATE OUTCOME PD ==========
    $data['items'] = [];
    
    if ($KodeWilayah) {
        $query = $this->db->from('ultimate_outcome_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        // Filter berdasarkan role
        if ($is_role_4 && $instansi_id) {
            // Role 4: Hanya melihat data instansi sendiri
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            // Filter manual untuk admin/superadmin
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['items'] = $query->order_by('urutan', 'ASC')
                              ->order_by('id', 'ASC')
                              ->get()
                              ->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/Ultimate_outcome_pd', $data);
}

/**
 * Simpan Ultimate Outcome PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function Ultimate_outcome_pd_simpan()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Hanya Role 4 yang bisa menyimpan
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah/mengedit data.'
        ]);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Wilayah belum dipilih'
        ]);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data instansi tidak ditemukan!'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kinerja = trim($this->input->post('kinerja', TRUE));
    $indikator_raw = $this->input->post('indikator', TRUE);
    
    if (empty($kinerja)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Kinerja wajib diisi'
        ]);
        return;
    }
    
    if (empty($indikator_raw)) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data sumber minimal satu harus dipilih'
        ]);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        if ($id > 0) {
            // Cek data exists dan kepemilikan
            $existing = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kode_wilayah)
                ->where('deleted_at IS NULL')
                ->get('ultimate_outcome_pd')
                ->row();
            
            if (!$existing) {
                throw new Exception('Data tidak ditemukan');
            }
            
            if ($existing->id_instansi != $instansi_id) {
                throw new Exception('Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.');
            }
            
            // Update data
            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kode_wilayah)
                    ->update('ultimate_outcome_pd', [
                        'kinerja' => $kinerja,
                        'indikator' => $indikator_raw,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            $msg = 'Data berhasil diperbarui';
        } else {
            // Dapatkan urutan terakhir
            $last_urutan = $this->db
                ->select_max('urutan')
                ->where('kode_wilayah', $kode_wilayah)
                ->where('id_instansi', $instansi_id)
                ->where('deleted_at IS NULL')
                ->get('ultimate_outcome_pd')
                ->row()
                ->urutan;
            
            $urutan = ($last_urutan ? $last_urutan + 1 : 1);
            
            // Insert data baru
            $this->db->insert('ultimate_outcome_pd', [
                'kode_wilayah' => $kode_wilayah,
                'id_instansi' => $instansi_id,
                'kinerja' => $kinerja,
                'indikator' => $indikator_raw,
                'urutan' => $urutan,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $msg = 'Data berhasil ditambahkan';
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => $msg,
            'data' => ['id' => $id > 0 ? $id : $this->db->insert_id()]
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

/**
 * Hapus Ultimate Outcome PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function Ultimate_outcome_pd_hapus()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Hanya Role 4 yang bisa menghapus
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Parameter tidak lengkap'
        ]);
        exit;
    }
    
    // Cek data exists dan kepemilikan
    $existing = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('ultimate_outcome_pd')
        ->row();
    
    if (!$existing) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Data tidak ditemukan'
        ]);
        exit;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.'
        ]);
        exit;
    }
    
    // Soft delete
    $this->db->where('id', $id)
            ->where('kode_wilayah', $kode_wilayah)
            ->update('ultimate_outcome_pd', ['deleted_at' => date('Y-m-d H:i:s')]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Data berhasil dihapus'
    ]);
    exit;
}

/**
 * Get Ultimate Outcome PD (AJAX) - Untuk edit, HANYA UNTUK ROLE 4
 */
public function Ultimate_outcome_pd_get()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Hanya Role 4 yang bisa mengambil data untuk edit
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        return;
    }
    
    $data = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('ultimate_outcome_pd')
        ->row_array();
    
    if ($data) {
        // Cek kepemilikan
        if ($data['id_instansi'] != $instansi_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Akses ditolak! Data bukan milik instansi Anda.'
            ]);
            return;
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

// =====================================================
// INTERMEDIATE OUTCOME PD (LEVEL 2) - PERANGKAT DAERAH
// =====================================================

/**
 * Halaman Intermediate Outcome PD (Level 2)
 * - Role 4: Bisa CRUD
 * - Role lain: Hanya melihat
 */
public function Intermediate_outcome_pd()
{
    $Header['Halaman'] = 'Intermediate Outcome PD';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter (hanya untuk non-role 4)
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA ULTIMATE OUTCOME UNTUK DROPDOWN ==========
    $sql_ultimate = "
        SELECT 
            u.id,
            u.kinerja as ultimate_kinerja
        FROM ultimate_outcome_pd u
        WHERE u.kode_wilayah = ? 
            AND u.deleted_at IS NULL
            AND u.id_instansi = ?
        ORDER BY u.id ASC
    ";
    
    $data['ultimate_options'] = [];
    if ($KodeWilayah) {
        if ($is_role_4 && $instansi_id) {
            $data['ultimate_options'] = $this->db->query($sql_ultimate, array($KodeWilayah, $instansi_id))->result_array();
        } elseif (!empty($filter_instansi_id)) {
            $data['ultimate_options'] = $this->db->query($sql_ultimate, array($KodeWilayah, $filter_instansi_id))->result_array();
        } else {
            $data['ultimate_options'] = $this->db->query($sql_ultimate, array($KodeWilayah, $instansi_id))->result_array();
        }
    }
    
    // ========== AMBIL DATA INTERMEDIATE OUTCOME PD ==========
    $data['items'] = [];
    
    if ($KodeWilayah) {
        $sql_items = "
            SELECT 
                i.*,
                u.kinerja as ultimate_kinerja,
                a.nama as nama_instansi
            FROM intermediate_outcome_pd i
            LEFT JOIN ultimate_outcome_pd u ON u.id = i.ultimate_outcome_id AND u.deleted_at IS NULL
            LEFT JOIN akun_instansi a ON a.id = i.id_instansi
            WHERE i.kode_wilayah = ?
                AND i.deleted_at IS NULL
        ";
        
        $params = [$KodeWilayah];
        
        if ($is_role_4 && $instansi_id) {
            $sql_items .= " AND i.id_instansi = ?";
            $params[] = $instansi_id;
        } elseif (!empty($filter_instansi_id)) {
            $sql_items .= " AND i.id_instansi = ?";
            $params[] = $filter_instansi_id;
        }
        
        $sql_items .= " ORDER BY i.urutan ASC, i.id ASC";
        
        $data['items'] = $this->db->query($sql_items, $params)->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    // PERBAIKAN: Load view dari folder Instansi
    $this->load->view('Daerah/Intermediate_outcome_pd', $data);
}

/**
 * Get Daftar Dinas (AJAX) - Untuk dropdown
 */
public function Intermediate_outcome_pd_get_daftar_dinas()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$kodewilayah) {
        echo json_encode([]);
        return;
    }
    
    $dinas = $this->db
        ->select('id, nama')
        ->from('akun_instansi')
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC')
        ->get()
        ->result_array();

    echo json_encode($dinas);
    exit;
}

/**
 * Get Pelaksana by Dinas (AJAX)
 */
public function Intermediate_outcome_pd_get_pelaksana_by_dinas()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
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
 * Get Detail Pelaksana (AJAX)
 */
public function Intermediate_outcome_pd_get_pelaksana_detail()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = $this->input->post('id', TRUE);
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$id || !$kodewilayah) {
        echo json_encode([]);
        return;
    }
    
    $detail = $this->db
        ->select('id, nama, nip, jabatan, dinas_id')
        ->from('akun_karyawan')
        ->where('id', $id)
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();

    echo json_encode($detail);
    exit;
}

/**
 * Get Perangkat Daerah (AJAX)
 */
public function Intermediate_outcome_pd_get_perangkat_daerah()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$kodewilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih', 'data' => []]);
        return;
    }
    
    $data = $this->db
        ->select('id, nama')
        ->from('akun_instansi')
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC')
        ->get()
        ->result_array();
    
    echo json_encode([
        'status' => 'success',
        'data' => $data
    ]);
    exit;
}

/**
 * Simpan Intermediate Outcome PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function Intermediate_outcome_pd_simpan()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah/mengedit data.'
        ]);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $ultimate_id = (int)$this->input->post('ultimate_id', TRUE);
    $kinerja = trim($this->input->post('kinerja', TRUE));
    $pelaksana_id = $this->input->post('pelaksana', TRUE);
    
    // Ambil data array
    $indikator_arr = $this->input->post('indikator', TRUE);
    $inovasi_arr = $this->input->post('inovasi_daerah', TRUE);
    $outcome_arr = $this->input->post('outcome_inovasi', TRUE);
    $output_arr = $this->input->post('output_inovasi', TRUE);
    $crosscutting_pd = $this->input->post('crosscutting_pd');
    $crosscutting_ket = $this->input->post('crosscutting_ket');
    
    if (empty($kinerja)) {
        echo json_encode(['status' => 'error', 'message' => 'Kinerja wajib diisi']);
        return;
    }
    
    // Konversi array ke string dengan delimiter |||
    $indikator = is_array($indikator_arr) ? implode('|||', array_filter($indikator_arr)) : '';
    $inovasi = is_array($inovasi_arr) ? implode('|||', array_filter($inovasi_arr)) : '';
    $outcome = is_array($outcome_arr) ? implode('|||', array_filter($outcome_arr)) : '';
    $output = is_array($output_arr) ? implode('|||', array_filter($output_arr)) : '';
    
    // Handle crosscutting
    $crosscutting_pd_json = null;
    $crosscutting_ket_json = null;
    
    if (!empty($crosscutting_pd) && is_array($crosscutting_pd)) {
        $crosscutting_pd_json = json_encode($crosscutting_pd);
    }
    if (!empty($crosscutting_ket) && is_array($crosscutting_ket)) {
        $crosscutting_ket_json = json_encode($crosscutting_ket);
    }
    
    $this->db->trans_start();
    
    try {
        if ($id > 0) {
            // Cek data exists dan kepemilikan
            $existing = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kode_wilayah)
                ->where('deleted_at IS NULL')
                ->get('intermediate_outcome_pd')
                ->row();
            
            if (!$existing) {
                throw new Exception('Data tidak ditemukan');
            }
            
            if ($existing->id_instansi != $instansi_id) {
                throw new Exception('Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.');
            }
            
            // Update data
            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kode_wilayah)
                    ->update('intermediate_outcome_pd', [
                        'ultimate_outcome_id' => $ultimate_id ?: NULL,
                        'kinerja' => $kinerja,
                        'indikator' => $indikator,
                        'pelaksana' => $pelaksana_id ?: NULL,
                        'inovasi_daerah' => $inovasi,
                        'outcome_inovasi' => $outcome,
                        'output_inovasi' => $output,
                        'crosscutting_pd' => $crosscutting_pd_json,
                        'crosscutting_keterangan' => $crosscutting_ket_json,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            $msg = 'Data berhasil diperbarui';
        } else {
            // Dapatkan urutan terakhir
            $last_urutan = $this->db
                ->select_max('urutan')
                ->where('kode_wilayah', $kode_wilayah)
                ->where('id_instansi', $instansi_id)
                ->where('deleted_at IS NULL')
                ->get('intermediate_outcome_pd')
                ->row()
                ->urutan;
            
            $urutan = ($last_urutan ? $last_urutan + 1 : 1);
            
            // Insert data baru
            $this->db->insert('intermediate_outcome_pd', [
                'kode_wilayah' => $kode_wilayah,
                'id_instansi' => $instansi_id,
                'ultimate_outcome_id' => $ultimate_id ?: NULL,
                'kinerja' => $kinerja,
                'indikator' => $indikator,
                'pelaksana' => $pelaksana_id ?: NULL,
                'inovasi_daerah' => $inovasi,
                'outcome_inovasi' => $outcome,
                'output_inovasi' => $output,
                'crosscutting_pd' => $crosscutting_pd_json,
                'crosscutting_keterangan' => $crosscutting_ket_json,
                'urutan' => $urutan,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $msg = 'Data berhasil ditambahkan';
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => $msg
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

/**
 * Hapus Intermediate Outcome PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function Intermediate_outcome_pd_hapus()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        exit;
    }
    
    // Cek data exists dan kepemilikan
    $existing = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('intermediate_outcome_pd')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        exit;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        exit;
    }
    
    // Soft delete
    $this->db->where('id', $id)
            ->where('kode_wilayah', $kode_wilayah)
            ->update('intermediate_outcome_pd', ['deleted_at' => date('Y-m-d H:i:s')]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Data berhasil dihapus'
    ]);
    exit;
}

/**
 * Get Intermediate Outcome PD (AJAX) - Untuk edit, HANYA UNTUK ROLE 4
 */
public function Intermediate_outcome_pd_get()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Hanya Role 4 yang bisa mengambil data untuk edit
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        return;
    }
    
    $data = $this->db
        ->select('i.*, u.kinerja as ultimate_kinerja')
        ->from('intermediate_outcome_pd i')
        ->join('ultimate_outcome_pd u', 'u.id = i.ultimate_outcome_id', 'left')
        ->where('i.id', $id)
        ->where('i.kode_wilayah', $kode_wilayah)
        ->where('i.deleted_at IS NULL')
        ->get()
        ->row_array();
    
    if ($data) {
        // Cek kepemilikan
        if ($data['id_instansi'] != $instansi_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Akses ditolak! Data bukan milik instansi Anda.'
            ]);
            return;
        }
        
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

// =====================================================
// IMMEDIATE OUTCOME PD (LEVEL 3) - PERANGKAT DAERAH
// =====================================================

/**
 * Halaman Immediate Outcome PD (Level 3)
 * - Role 4: Bisa CRUD
 * - Role lain: Hanya melihat
 */
public function Immediate_outcome_pd()
{
    $Header['Halaman'] = 'Immediate Outcome PD';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter (hanya untuk non-role 4)
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA INTERMEDIATE OUTCOME UNTUK DROPDOWN ==========
    $sql_intermediate = "
        SELECT 
            i.id,
            i.kinerja
        FROM intermediate_outcome_pd i
        WHERE i.kode_wilayah = ? 
            AND i.deleted_at IS NULL
            AND i.id_instansi = ?
        ORDER BY i.urutan ASC, i.id ASC
    ";
    
    $data['intermediate_options'] = [];
    if ($KodeWilayah) {
        if ($is_role_4 && $instansi_id) {
            $data['intermediate_options'] = $this->db->query($sql_intermediate, array($KodeWilayah, $instansi_id))->result_array();
        } elseif (!empty($filter_instansi_id)) {
            $data['intermediate_options'] = $this->db->query($sql_intermediate, array($KodeWilayah, $filter_instansi_id))->result_array();
        } else {
            $data['intermediate_options'] = $this->db->query($sql_intermediate, array($KodeWilayah, $instansi_id))->result_array();
        }
    }
    
    // ========== AMBIL DATA IMMEDIATE OUTCOME PD ==========
    $data['items'] = [];
    
    if ($KodeWilayah) {
        $sql_items = "
            SELECT 
                i.*,
                inter.kinerja as intermediate_kinerja,
                a.nama as nama_instansi
            FROM immediate_outcome_pd i
            LEFT JOIN intermediate_outcome_pd inter ON inter.id = i.intermediate_outcome_id AND inter.deleted_at IS NULL
            LEFT JOIN akun_instansi a ON a.id = i.id_instansi
            WHERE i.kode_wilayah = ?
                AND i.deleted_at IS NULL
        ";
        
        $params = [$KodeWilayah];
        
        if ($is_role_4 && $instansi_id) {
            $sql_items .= " AND i.id_instansi = ?";
            $params[] = $instansi_id;
        } elseif (!empty($filter_instansi_id)) {
            $sql_items .= " AND i.id_instansi = ?";
            $params[] = $filter_instansi_id;
        }
        
        $sql_items .= " ORDER BY i.urutan ASC, i.id ASC";
        
        $data['items'] = $this->db->query($sql_items, $params)->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    // PERBAIKAN: Ganti dari 'Daerah/Immediate_outcome_pd' menjadi 'Instansi/Immediate_outcome_pd'
    $this->load->view('Daerah/Immediate_outcome_pd', $data);
}

/**
 * Get Daftar Dinas (AJAX) - Untuk dropdown
 */
public function Immediate_outcome_pd_get_daftar_dinas()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$kodewilayah) {
        echo json_encode([]);
        return;
    }
    
    $dinas = $this->db
        ->select('id, nama')
        ->from('akun_instansi')
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC')
        ->get()
        ->result_array();

    echo json_encode($dinas);
    exit;
}

/**
 * Get Pelaksana by Dinas (AJAX)
 */
public function Immediate_outcome_pd_get_pelaksana_by_dinas()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
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
 * Get Detail Pelaksana (AJAX)
 */
public function Immediate_outcome_pd_get_pelaksana_detail()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = $this->input->post('id', TRUE);
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$id || !$kodewilayah) {
        echo json_encode([]);
        return;
    }
    
    $detail = $this->db
        ->select('id, nama, nip, jabatan, dinas_id')
        ->from('akun_karyawan')
        ->where('id', $id)
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();

    echo json_encode($detail);
    exit;
}

/**
 * Get Perangkat Daerah (AJAX)
 */
public function Immediate_outcome_pd_get_perangkat_daerah()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$kodewilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih', 'data' => []]);
        return;
    }
    
    $data = $this->db
        ->select('id, nama')
        ->from('akun_instansi')
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC')
        ->get()
        ->result_array();
    
    echo json_encode([
        'status' => 'success',
        'data' => $data
    ]);
    exit;
}

/**
 * Simpan Immediate Outcome PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function Immediate_outcome_pd_simpan()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah/mengedit data.'
        ]);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $intermediate_id = (int)$this->input->post('intermediate_id', TRUE);
    $kinerja = trim($this->input->post('kinerja', TRUE));
    $pelaksana_id = $this->input->post('pelaksana', TRUE);
    
    // Ambil data array
    $indikator_arr = $this->input->post('indikator', TRUE);
    $inovasi_arr = $this->input->post('inovasi_daerah', TRUE);
    $outcome_arr = $this->input->post('outcome_inovasi', TRUE);
    $output_arr = $this->input->post('output_inovasi', TRUE);
    $crosscutting_pd = $this->input->post('crosscutting_pd');
    $crosscutting_ket = $this->input->post('crosscutting_ket');
    
    if (empty($kinerja)) {
        echo json_encode(['status' => 'error', 'message' => 'Kinerja wajib diisi']);
        return;
    }
    
    // Konversi array ke string dengan delimiter |||
    $indikator = is_array($indikator_arr) ? implode('|||', array_filter($indikator_arr)) : '';
    $inovasi = is_array($inovasi_arr) ? implode('|||', array_filter($inovasi_arr)) : '';
    $outcome = is_array($outcome_arr) ? implode('|||', array_filter($outcome_arr)) : '';
    $output = is_array($output_arr) ? implode('|||', array_filter($output_arr)) : '';
    
    // Handle crosscutting
    $crosscutting_pd_json = null;
    $crosscutting_ket_json = null;
    
    if (!empty($crosscutting_pd) && is_array($crosscutting_pd)) {
        $crosscutting_pd_json = json_encode($crosscutting_pd);
    }
    if (!empty($crosscutting_ket) && is_array($crosscutting_ket)) {
        $crosscutting_ket_json = json_encode($crosscutting_ket);
    }
    
    $this->db->trans_start();
    
    try {
        if ($id > 0) {
            // Cek data exists dan kepemilikan
            $existing = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kode_wilayah)
                ->where('deleted_at IS NULL')
                ->get('immediate_outcome_pd')
                ->row();
            
            if (!$existing) {
                throw new Exception('Data tidak ditemukan');
            }
            
            if ($existing->id_instansi != $instansi_id) {
                throw new Exception('Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.');
            }
            
            // Update data
            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kode_wilayah)
                    ->update('immediate_outcome_pd', [
                        'intermediate_outcome_id' => $intermediate_id ?: NULL,
                        'kinerja' => $kinerja,
                        'indikator' => $indikator,
                        'pelaksana' => $pelaksana_id ?: NULL,
                        'inovasi_daerah' => $inovasi,
                        'outcome_inovasi' => $outcome,
                        'output_inovasi' => $output,
                        'crosscutting_pd' => $crosscutting_pd_json,
                        'crosscutting_keterangan' => $crosscutting_ket_json,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            $msg = 'Data berhasil diperbarui';
        } else {
            // Dapatkan urutan terakhir
            $last_urutan = $this->db
                ->select_max('urutan')
                ->where('kode_wilayah', $kode_wilayah)
                ->where('id_instansi', $instansi_id)
                ->where('deleted_at IS NULL')
                ->get('immediate_outcome_pd')
                ->row()
                ->urutan;
            
            $urutan = ($last_urutan ? $last_urutan + 1 : 1);
            
            // Insert data baru
            $this->db->insert('immediate_outcome_pd', [
                'kode_wilayah' => $kode_wilayah,
                'id_instansi' => $instansi_id,
                'intermediate_outcome_id' => $intermediate_id ?: NULL,
                'kinerja' => $kinerja,
                'indikator' => $indikator,
                'pelaksana' => $pelaksana_id ?: NULL,
                'inovasi_daerah' => $inovasi,
                'outcome_inovasi' => $outcome,
                'output_inovasi' => $output,
                'crosscutting_pd' => $crosscutting_pd_json,
                'crosscutting_keterangan' => $crosscutting_ket_json,
                'urutan' => $urutan,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $msg = 'Data berhasil ditambahkan';
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => $msg
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

/**
 * Hapus Immediate Outcome PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function Immediate_outcome_pd_hapus()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        exit;
    }
    
    // Cek data exists dan kepemilikan
    $existing = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('immediate_outcome_pd')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        exit;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        exit;
    }
    
    // Soft delete
    $this->db->where('id', $id)
            ->where('kode_wilayah', $kode_wilayah)
            ->update('immediate_outcome_pd', ['deleted_at' => date('Y-m-d H:i:s')]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Data berhasil dihapus'
    ]);
    exit;
}

/**
 * Get Immediate Outcome PD (AJAX) - Untuk edit, HANYA UNTUK ROLE 4
 */
public function Immediate_outcome_pd_get()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Hanya Role 4 yang bisa mengambil data untuk edit
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        return;
    }
    
    $data = $this->db
        ->select('i.*, inter.kinerja as intermediate_kinerja')
        ->from('immediate_outcome_pd i')
        ->join('intermediate_outcome_pd inter', 'inter.id = i.intermediate_outcome_id', 'left')
        ->where('i.id', $id)
        ->where('i.kode_wilayah', $kode_wilayah)
        ->where('i.deleted_at IS NULL')
        ->get()
        ->row_array();
    
    if ($data) {
        // Cek kepemilikan
        if ($data['id_instansi'] != $instansi_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Akses ditolak! Data bukan milik instansi Anda.'
            ]);
            return;
        }
        
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

// =====================================================
// OUTPUT PD (LEVEL 4) - PERANGKAT DAERAH
// =====================================================

/**
 * Halaman Output PD (Level 4)
 * - Role 4: Bisa CRUD
 * - Role lain: Hanya melihat
 */
public function Output_pd()
{
    $Header['Halaman'] = 'Output Perangkat Daerah';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter (hanya untuk non-role 4)
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA IMMEDIATE OUTCOME UNTUK DROPDOWN ==========
    $sql_immediate = "
        SELECT 
            i.id,
            i.kinerja
        FROM immediate_outcome_pd i
        WHERE i.kode_wilayah = ? 
            AND i.deleted_at IS NULL
            AND i.id_instansi = ?
        ORDER BY i.urutan ASC, i.id ASC
    ";
    
    $data['immediate_options'] = [];
    if ($KodeWilayah) {
        if ($is_role_4 && $instansi_id) {
            $data['immediate_options'] = $this->db->query($sql_immediate, array($KodeWilayah, $instansi_id))->result_array();
        } elseif (!empty($filter_instansi_id)) {
            $data['immediate_options'] = $this->db->query($sql_immediate, array($KodeWilayah, $filter_instansi_id))->result_array();
        } else {
            $data['immediate_options'] = $this->db->query($sql_immediate, array($KodeWilayah, $instansi_id))->result_array();
        }
    }
    
    // ========== AMBIL DATA OUTPUT PD ==========
    $data['items'] = [];
    
    if ($KodeWilayah) {
        $sql_items = "
            SELECT 
                o.*,
                imm.kinerja as immediate_kinerja,
                a.nama as nama_instansi
            FROM output_pd o
            LEFT JOIN immediate_outcome_pd imm ON imm.id = o.immediate_outcome_id AND imm.deleted_at IS NULL
            LEFT JOIN akun_instansi a ON a.id = o.id_instansi
            WHERE o.kode_wilayah = ?
                AND o.deleted_at IS NULL
        ";
        
        $params = [$KodeWilayah];
        
        if ($is_role_4 && $instansi_id) {
            $sql_items .= " AND o.id_instansi = ?";
            $params[] = $instansi_id;
        } elseif (!empty($filter_instansi_id)) {
            $sql_items .= " AND o.id_instansi = ?";
            $params[] = $filter_instansi_id;
        }
        
        $sql_items .= " ORDER BY o.urutan ASC, o.id ASC";
        
        $data['items'] = $this->db->query($sql_items, $params)->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/Output_pd', $data);
}

/**
 * Get Daftar Dinas (AJAX) - Untuk dropdown
 */
public function Output_pd_get_daftar_dinas()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$kodewilayah) {
        echo json_encode([]);
        return;
    }
    
    $dinas = $this->db
        ->select('id, nama')
        ->from('akun_instansi')
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC')
        ->get()
        ->result_array();

    echo json_encode($dinas);
    exit;
}

/**
 * Get Pelaksana by Dinas (AJAX)
 */
public function Output_pd_get_pelaksana_by_dinas()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
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
 * Get Detail Pelaksana (AJAX)
 */
public function Output_pd_get_pelaksana_detail()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = $this->input->post('id', TRUE);
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$id || !$kodewilayah) {
        echo json_encode([]);
        return;
    }
    
    $detail = $this->db
        ->select('id, nama, nip, jabatan, dinas_id')
        ->from('akun_karyawan')
        ->where('id', $id)
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();

    echo json_encode($detail);
    exit;
}

/**
 * Get Perangkat Daerah (AJAX)
 */
public function Output_pd_get_perangkat_daerah()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$kodewilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih', 'data' => []]);
        return;
    }
    
    $data = $this->db
        ->select('id, nama')
        ->from('akun_instansi')
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC')
        ->get()
        ->result_array();
    
    echo json_encode([
        'status' => 'success',
        'data' => $data
    ]);
    exit;
}

/**
 * Simpan Output PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function Output_pd_simpan()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah/mengedit data.'
        ]);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $immediate_id = (int)$this->input->post('immediate_id', TRUE);
    $kinerja = trim($this->input->post('kinerja', TRUE));
    $pelaksana_id = $this->input->post('pelaksana', TRUE);
    
    // Ambil data array
    $indikator_arr = $this->input->post('indikator', TRUE);
    $inovasi_arr = $this->input->post('inovasi_daerah', TRUE);
    $outcome_arr = $this->input->post('outcome_inovasi', TRUE);
    $output_arr = $this->input->post('output_inovasi', TRUE);
    $crosscutting_pd = $this->input->post('crosscutting_pd');
    $crosscutting_ket = $this->input->post('crosscutting_ket');
    
    if (empty($kinerja)) {
        echo json_encode(['status' => 'error', 'message' => 'Kinerja wajib diisi']);
        return;
    }
    
    // Konversi array ke string dengan delimiter |||
    $indikator = is_array($indikator_arr) ? implode('|||', array_filter($indikator_arr)) : '';
    $inovasi = is_array($inovasi_arr) ? implode('|||', array_filter($inovasi_arr)) : '';
    $outcome = is_array($outcome_arr) ? implode('|||', array_filter($outcome_arr)) : '';
    $output = is_array($output_arr) ? implode('|||', array_filter($output_arr)) : '';
    
    // Handle crosscutting
    $crosscutting_pd_json = null;
    $crosscutting_ket_json = null;
    
    if (!empty($crosscutting_pd) && is_array($crosscutting_pd)) {
        $crosscutting_pd_json = json_encode($crosscutting_pd);
    }
    if (!empty($crosscutting_ket) && is_array($crosscutting_ket)) {
        $crosscutting_ket_json = json_encode($crosscutting_ket);
    }
    
    $this->db->trans_start();
    
    try {
        if ($id > 0) {
            // Cek data exists dan kepemilikan
            $existing = $this->db
                ->where('id', $id)
                ->where('kode_wilayah', $kode_wilayah)
                ->where('deleted_at IS NULL')
                ->get('output_pd')
                ->row();
            
            if (!$existing) {
                throw new Exception('Data tidak ditemukan');
            }
            
            if ($existing->id_instansi != $instansi_id) {
                throw new Exception('Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.');
            }
            
            // Update data
            $this->db->where('id', $id)
                    ->where('kode_wilayah', $kode_wilayah)
                    ->update('output_pd', [
                        'immediate_outcome_id' => $immediate_id ?: NULL,
                        'kinerja' => $kinerja,
                        'indikator' => $indikator,
                        'pelaksana' => $pelaksana_id ?: NULL,
                        'inovasi_daerah' => $inovasi,
                        'outcome_inovasi' => $outcome,
                        'output_inovasi' => $output,
                        'crosscutting_pd' => $crosscutting_pd_json,
                        'crosscutting_keterangan' => $crosscutting_ket_json,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
            $msg = 'Data berhasil diperbarui';
        } else {
            // Dapatkan urutan terakhir
            $last_urutan = $this->db
                ->select_max('urutan')
                ->where('kode_wilayah', $kode_wilayah)
                ->where('id_instansi', $instansi_id)
                ->where('deleted_at IS NULL')
                ->get('output_pd')
                ->row()
                ->urutan;
            
            $urutan = ($last_urutan ? $last_urutan + 1 : 1);
            
            // Insert data baru
            $this->db->insert('output_pd', [
                'kode_wilayah' => $kode_wilayah,
                'id_instansi' => $instansi_id,
                'immediate_outcome_id' => $immediate_id ?: NULL,
                'kinerja' => $kinerja,
                'indikator' => $indikator,
                'pelaksana' => $pelaksana_id ?: NULL,
                'inovasi_daerah' => $inovasi,
                'outcome_inovasi' => $outcome,
                'output_inovasi' => $output,
                'crosscutting_pd' => $crosscutting_pd_json,
                'crosscutting_keterangan' => $crosscutting_ket_json,
                'urutan' => $urutan,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
            $msg = 'Data berhasil ditambahkan';
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => $msg
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

/**
 * Hapus Output PD (AJAX) - HANYA UNTUK ROLE 4
 */
public function Output_pd_hapus()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        exit;
    }
    
    // Cek data exists dan kepemilikan
    $existing = $this->db
        ->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('output_pd')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        exit;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        exit;
    }
    
    // Soft delete
    $this->db->where('id', $id)
            ->where('kode_wilayah', $kode_wilayah)
            ->update('output_pd', ['deleted_at' => date('Y-m-d H:i:s')]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Data berhasil dihapus'
    ]);
    exit;
}

/**
 * Get Output PD (AJAX) - Untuk edit, HANYA UNTUK ROLE 4
 */
public function Output_pd_get()
{
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Hanya Role 4 yang bisa mengambil data untuk edit
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        return;
    }
    
    $data = $this->db
        ->select('o.*, imm.kinerja as immediate_kinerja')
        ->from('output_pd o')
        ->join('immediate_outcome_pd imm', 'imm.id = o.immediate_outcome_id', 'left')
        ->where('o.id', $id)
        ->where('o.kode_wilayah', $kode_wilayah)
        ->where('o.deleted_at IS NULL')
        ->get()
        ->row_array();
    
    if ($data) {
        // Cek kepemilikan
        if ($data['id_instansi'] != $instansi_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Akses ditolak! Data bukan milik instansi Anda.'
            ]);
            return;
        }
        
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

// =====================================================
// TAMPIL POHON KINERJA PERANGKAT DAERAH (4 Level)
// =====================================================

/**
 * Tampil Pohon Kinerja Perangkat Daerah (Visualisasi 4 Level)
 * - Role 4: Hanya melihat data milik instansinya sendiri
 * - Role lain: Bisa melihat semua data dengan filter instansi
 */
public function TampilPohonKinerjaPD()
{
    $Header['Halaman'] = 'Pohon Kinerja PD';
    
    // ==============================
    // 1. CEK SESSION WILAYAH
    // ==============================
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // ==============================
    // 2. DATA PROVINSI UNTUK FILTER
    // ==============================
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // ==============================
    // 3. DAFTAR INSTANSI UNTUK FILTER (NON ROLE 4)
    // ==============================
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ==============================
    // 4. AMBIL NAMA WILAYAH & TOTAL DATA
    // ==============================
    $data['NamaWilayah'] = '';
    $data['TotalData'] = [
        'level1' => 0,
        'level2' => 0,
        'level3' => 0,
        'level4' => 0
    ];
    
    // Data perangkat daerah untuk mapping crosscutting
    $data['perangkat_daerah'] = [];
    
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        
        // Ambil data perangkat daerah untuk mapping crosscutting (Level 2 - akun_instansi)
        $data['perangkat_daerah'] = $this->db
            ->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ==============================
    // 5. AMBIL DATA PELAKSANA UNTUK MAPPING
    // ==============================
    $pelaksanaData = [];
    if ($KodeWilayah) {
        $query = $this->db->select('
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
            ->where('akun_karyawan.kodewilayah', $KodeWilayah)
            ->where('akun_karyawan.deleted_at IS NULL')
            ->group_by('akun_karyawan.id');
        
        $pelaksanaData = $query->get()->result_array();
    }
    
    // Buat mapping pelaksana berdasarkan ID
    $pelaksanaMap = [];
    foreach ($pelaksanaData as $p) {
        $pelaksanaMap[$p['id']] = [
            'nama' => $p['nama'],
            'nip' => $p['nip'],
            'jabatan' => $p['jabatan'],
            'dinas' => $p['nama_dinas'] ?? '-'
        ];
    }
    $data['PelaksanaData'] = $pelaksanaMap;
    
    // ==============================
    // 6. AMBIL ULTIMATE OUTCOME (LEVEL 1)
    // ==============================
    $ultimate = [];
    if ($KodeWilayah) {
        $query = $this->db->select('id, kinerja as nama, indikator, urutan')
            ->from('ultimate_outcome_pd')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        // Filter berdasarkan role
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $ultimate = $query->order_by('urutan', 'ASC')
                         ->order_by('id', 'ASC')
                         ->get()
                         ->result_array();
    }
    
    // ==============================
    // 7. AMBIL INTERMEDIATE OUTCOME (LEVEL 2)
    // ==============================
    $intermediate = [];
    if ($KodeWilayah) {
        $query = $this->db->select('
                i.id, 
                i.kinerja as nama, 
                i.indikator, 
                i.pelaksana, 
                i.inovasi_daerah, 
                i.outcome_inovasi, 
                i.output_inovasi,
                i.crosscutting_pd, 
                i.crosscutting_keterangan,
                i.ultimate_outcome_id as parent_id,
                i.urutan
            ')
            ->from('intermediate_outcome_pd i')
            ->where('i.kode_wilayah', $KodeWilayah)
            ->where('i.deleted_at IS NULL');
        
        // Filter berdasarkan role
        if ($is_role_4 && $instansi_id) {
            $query->where('i.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('i.id_instansi', (int)$filter_instansi_id);
        }
        
        $intermediate = $query->order_by('i.urutan', 'ASC')
                             ->order_by('i.id', 'ASC')
                             ->get()
                             ->result_array();
    }
    
    // ==============================
    // 8. AMBIL IMMEDIATE OUTCOME (LEVEL 3)
    // ==============================
    $immediate = [];
    if ($KodeWilayah) {
        $query = $this->db->select('
                i.id, 
                i.kinerja as nama, 
                i.indikator, 
                i.pelaksana,
                i.inovasi_daerah, 
                i.outcome_inovasi, 
                i.output_inovasi,
                i.crosscutting_pd, 
                i.crosscutting_keterangan,
                i.intermediate_outcome_id as parent_id,
                i.urutan
            ')
            ->from('immediate_outcome_pd i')
            ->where('i.kode_wilayah', $KodeWilayah)
            ->where('i.deleted_at IS NULL');
        
        // Filter berdasarkan role
        if ($is_role_4 && $instansi_id) {
            $query->where('i.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('i.id_instansi', (int)$filter_instansi_id);
        }
        
        $immediate = $query->order_by('i.urutan', 'ASC')
                          ->order_by('i.id', 'ASC')
                          ->get()
                          ->result_array();
    }
    
    // ==============================
    // 9. AMBIL OUTPUT (LEVEL 4)
    // ==============================
    $output = [];
    if ($KodeWilayah) {
        $query = $this->db->select('
                o.id, 
                o.kinerja as nama, 
                o.indikator, 
                o.pelaksana,
                o.inovasi_daerah, 
                o.outcome_inovasi, 
                o.output_inovasi,
                o.crosscutting_pd, 
                o.crosscutting_keterangan,
                o.immediate_outcome_id as parent_id,
                o.urutan
            ')
            ->from('output_pd o')
            ->where('o.kode_wilayah', $KodeWilayah)
            ->where('o.deleted_at IS NULL');
        
        // Filter berdasarkan role
        if ($is_role_4 && $instansi_id) {
            $query->where('o.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('o.id_instansi', (int)$filter_instansi_id);
        }
        
        $output = $query->order_by('o.urutan', 'ASC')
                       ->order_by('o.id', 'ASC')
                       ->get()
                       ->result_array();
    }
    
    // ==============================
    // 10. UPDATE TOTAL DATA
    // ==============================
    $data['TotalData'] = [
        'level1' => count($ultimate),
        'level2' => count($intermediate),
        'level3' => count($immediate),
        'level4' => count($output)
    ];
    
    // ==============================
    // 11. PERKAYA DATA DENGAN DETAIL PELAKSANA
    // ==============================
    $intermediate = $this->enrichWithPelaksanaDetail($intermediate, $pelaksanaMap);
    $immediate = $this->enrichWithPelaksanaDetail($immediate, $pelaksanaMap);
    $output = $this->enrichWithPelaksanaDetail($output, $pelaksanaMap);
    
    // ==============================
    // 12. STRUKTURKAN DATA UNTUK TREE
    // ==============================
    $tree_data = $this->buildTreeDataPD($ultimate, $intermediate, $immediate, $output);
    
    $chart_data = [
        'nama' => 'ROOT',
        'children' => $tree_data
    ];
    
    $data['ChartData'] = json_encode($chart_data);
    
    // ==============================
    // 13. LOAD VIEW
    // ==============================
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/TampilPohonKinerjaPD', $data);
}

/**
 * Memperkaya data dengan detail pelaksana
 */
private function enrichWithPelaksanaDetail($items, $pelaksanaMap)
{
    foreach ($items as &$item) {
        if (!empty($item['pelaksana']) && isset($pelaksanaMap[$item['pelaksana']])) {
            $item['pelaksana_detail'] = $pelaksanaMap[$item['pelaksana']];
        } else {
            $item['pelaksana_detail'] = null;
        }
        
        // Parse crosscutting JSON jika diperlukan
        if (!empty($item['crosscutting_pd']) && is_string($item['crosscutting_pd'])) {
            $item['crosscutting_pd'] = json_decode($item['crosscutting_pd'], true);
        }
        if (!empty($item['crosscutting_keterangan']) && is_string($item['crosscutting_keterangan'])) {
            $item['crosscutting_keterangan'] = json_decode($item['crosscutting_keterangan'], true);
        }
    }
    return $items;
}

/**
 * Membangun struktur tree data untuk 4 level
 */
private function buildTreeDataPD($ultimate, $intermediate, $immediate, $output)
{
    $tree_data = [];

    // Buat mapping untuk memudahkan pencarian
    $intermediate_by_parent = [];
    foreach ($intermediate as $inter) {
        $intermediate_by_parent[$inter['parent_id']][] = $inter;
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
        $kinerja_text = $ult['nama'] ?? '—';
        
        $ult_node = [
            'id' => 'l1_' . $ult['id'],
            'original_id' => $ult['id'],
            'nama' => $kinerja_text,
            'indikator' => $ult['indikator'] ?? null,
            'pelaksana' => null,
            'pelaksana_detail' => null,
            'inovasi' => null,
            'outcome_inovasi' => null,
            'output_inovasi' => null,
            'crosscutting_pd' => null,
            'crosscutting_ket' => null,
            'level' => 1,
            'children' => []
        ];
        
        // Cari Level 2 (Intermediate) yang memiliki parent_id = $ult['id']
        if (isset($intermediate_by_parent[$ult['id']])) {
            foreach ($intermediate_by_parent[$ult['id']] as $inter) {
                $pelaksana_detail = null;
                if (!empty($inter['pelaksana_detail'])) {
                    $pelaksana_detail = $inter['pelaksana_detail'];
                }
                
                $inter_node = [
                    'id' => 'l2_' . $inter['id'],
                    'original_id' => $inter['id'],
                    'nama' => $inter['nama'] ?? '—',
                    'indikator' => $inter['indikator'] ?? null,
                    'pelaksana' => $inter['pelaksana'] ?? null,
                    'pelaksana_detail' => $pelaksana_detail,
                    'inovasi' => $inter['inovasi_daerah'] ?? null,
                    'outcome_inovasi' => $inter['outcome_inovasi'] ?? null,
                    'output_inovasi' => $inter['output_inovasi'] ?? null,
                    'crosscutting_pd' => $inter['crosscutting_pd'] ?? null,
                    'crosscutting_ket' => $inter['crosscutting_keterangan'] ?? null,
                    'level' => 2,
                    'children' => []
                ];
                
                // Cari Level 3 (Immediate) yang memiliki parent_id = $inter['id']
                if (isset($immediate_by_parent[$inter['id']])) {
                    foreach ($immediate_by_parent[$inter['id']] as $imm) {
                        $pelaksana_detail_imm = null;
                        if (!empty($imm['pelaksana_detail'])) {
                            $pelaksana_detail_imm = $imm['pelaksana_detail'];
                        }
                        
                        $imm_node = [
                            'id' => 'l3_' . $imm['id'],
                            'original_id' => $imm['id'],
                            'nama' => $imm['nama'] ?? '—',
                            'indikator' => $imm['indikator'] ?? null,
                            'pelaksana' => $imm['pelaksana'] ?? null,
                            'pelaksana_detail' => $pelaksana_detail_imm,
                            'inovasi' => $imm['inovasi_daerah'] ?? null,
                            'outcome_inovasi' => $imm['outcome_inovasi'] ?? null,
                            'output_inovasi' => $imm['output_inovasi'] ?? null,
                            'crosscutting_pd' => $imm['crosscutting_pd'] ?? null,
                            'crosscutting_ket' => $imm['crosscutting_keterangan'] ?? null,
                            'level' => 3,
                            'children' => []
                        ];
                        
                        // Cari Level 4 (Output) yang memiliki parent_id = $imm['id']
                        if (isset($output_by_parent[$imm['id']])) {
                            foreach ($output_by_parent[$imm['id']] as $out) {
                                $pelaksana_detail_out = null;
                                if (!empty($out['pelaksana_detail'])) {
                                    $pelaksana_detail_out = $out['pelaksana_detail'];
                                }
                                
                                $imm_node['children'][] = [
                                    'id' => 'l4_' . $out['id'],
                                    'original_id' => $out['id'],
                                    'nama' => $out['nama'] ?? '—',
                                    'indikator' => $out['indikator'] ?? null,
                                    'pelaksana' => $out['pelaksana'] ?? null,
                                    'pelaksana_detail' => $pelaksana_detail_out,
                                    'inovasi' => $out['inovasi_daerah'] ?? null,
                                    'outcome_inovasi' => $out['outcome_inovasi'] ?? null,
                                    'output_inovasi' => $out['output_inovasi'] ?? null,
                                    'crosscutting_pd' => $out['crosscutting_pd'] ?? null,
                                    'crosscutting_ket' => $out['crosscutting_keterangan'] ?? null,
                                    'level' => 4,
                                    'children' => []
                                ];
                            }
                        }
                        
                        $inter_node['children'][] = $imm_node;
                    }
                }
                
                $ult_node['children'][] = $inter_node;
            }
        }
        
        $tree_data[] = $ult_node;
    }

    return $tree_data;
}

    // =====================================================
    // RENJA PERANGKAT DAERAH (DENGAN DROPDOWN NOMENKLATUR)
    // =====================================================

   /**
 * Halaman Renja PD (Header + Detail)
 * Dengan notifikasi perubahan dari Daerah
 */
public function RenjaPD() {
    $Header['Halaman'] = 'Renja Perangkat Daerah';
    
    // ==============================
    // 1. AMBIL DATA DARI SESSION
    // ==============================
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    
    $tahun = $this->input->get('tahun', TRUE) ?: date('Y');
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    $data['TahunAktif'] = $tahun;
    
    // ==============================
    // 2. AMBIL NAMA WILAYAH
    // ==============================
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // ==============================
    // 3. DATA PROVINSI UNTUK DROPDOWN
    // ==============================
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // ==============================
    // 4. DAFTAR INSTANSI UNTUK FILTER
    // ==============================
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ==============================
    // 5. DATA NOMENKLATUR UNTUK DROPDOWN
    // ==============================
    $data['NomenklaturData'] = $this->db
        ->select('Kode, Nomenklatur')
        ->from('nomenklaturkabupaten')
        ->order_by('Kode', 'ASC')
        ->get()
        ->result_array();
    
    // ==============================
    // 6. AMBIL DATA RENJA (DENGAN NOTIFIKASI)
    // ==============================
    $data['RenjaData'] = [];
    $data['TotalNotifikasi'] = 0;
    
    if ($KodeWilayah) {
        // Ambil Header
        $query_header = $this->db->select('h.*, a.nama as instansi_nama')
            ->from('renja_pd_header h')
            ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
            ->where('h.kode_wilayah', $KodeWilayah)
            ->where('h.tahun', $tahun)
            ->where('h.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query_header->where('h.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query_header->where('h.id_instansi', (int)$filter_instansi_id);
        }
        
        $headers = $query_header->order_by('h.id', 'ASC')->get()->result_array();
        
        // Ambil Detail untuk setiap header
        foreach ($headers as &$header) {
            $details = $this->db->select('
                    d.*,
                    a.nama as bidang_pengampu_nama,
                    ak.nama as pengampu_nama,
                    ak.jabatan as pengampu_jabatan,
                    d.edited_by_daerah,
                    d.daerah_edit_fields,
                    d.daerah_edit_time
                ')
                ->from('renja_pd_detail d')
                ->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left')
                ->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left')
                ->where('d.header_id', $header['id'])
                ->where('d.deleted_at IS NULL')
                ->order_by('d.urutan', 'ASC')
                ->order_by('d.id', 'ASC')
                ->get()
                ->result_array();
            
            // Hitung total notifikasi
            foreach ($details as $detail) {
                if (!empty($detail['edited_by_daerah']) && $detail['edited_by_daerah'] == 1) {
                    $data['TotalNotifikasi']++;
                }
            }
            
            $header['details'] = $details;
            $header['detail_count'] = count($details);
        }
        
        $data['RenjaData'] = $headers;
    }
    
    // ==============================
    // 7. LOAD VIEW
    // ==============================
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/RenjaPD', $data);
}

/**
 * TAMBAH Header Renja PD (AJAX) - HANYA UNTUK ROLE 4
 * URL: Instansi/tambahRenjaHeader
 */
public function tambahRenjaHeader() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
    
    // Ambil data dari dropdown nomenklatur
    $mode_nomenklatur = (int)$this->input->post('mode_nomenklatur', TRUE);
    
    $kode_rekening = '';
    $tujuan = '';
    $sasaran = '';
    $program = '';
    $kegiatan = '';
    $sub_kegiatan = '';
    
    if ($mode_nomenklatur == 1) {
        // Mode pilih dari nomenklatur
        $urusan_kode = trim($this->input->post('urusan_kode', TRUE));
        $bidang_kode = trim($this->input->post('bidang_kode', TRUE));
        $program_kode = trim($this->input->post('program_kode', TRUE));
        $kegiatan_kode = trim($this->input->post('kegiatan_kode', TRUE));
        $sub_kegiatan_kode = trim($this->input->post('sub_kegiatan_kode', TRUE));
        
        // Ambil nama dari kode
        if ($urusan_kode) {
            $urusan = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $urusan_kode)->get()->row_array();
            $tujuan = $urusan ? $urusan['Nomenklatur'] : '';
        }
        if ($bidang_kode) {
            $bidang = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $bidang_kode)->get()->row_array();
            $sasaran = $bidang ? $bidang['Nomenklatur'] : '';
        }
        if ($program_kode) {
            $prog = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $program_kode)->get()->row_array();
            $program = $prog ? $prog['Nomenklatur'] : '';
        }
        if ($kegiatan_kode) {
            $keg = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $kegiatan_kode)->get()->row_array();
            $kegiatan = $keg ? $keg['Nomenklatur'] : '';
        }
        if ($sub_kegiatan_kode) {
            $sub = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $sub_kegiatan_kode)->get()->row_array();
            $sub_kegiatan = $sub ? $sub['Nomenklatur'] : '';
        }
        
        // Generate kode rekening
        if ($sub_kegiatan_kode) {
            $kode_rekening = $sub_kegiatan_kode;
        } elseif ($kegiatan_kode) {
            $kode_rekening = $kegiatan_kode;
        } elseif ($program_kode) {
            $kode_rekening = $program_kode;
        } elseif ($bidang_kode) {
            $kode_rekening = $bidang_kode;
        } elseif ($urusan_kode) {
            $kode_rekening = $urusan_kode;
        }
        
        if (empty($urusan_kode) && empty($bidang_kode) && empty($program_kode) && empty($kegiatan_kode) && empty($sub_kegiatan_kode)) {
            echo json_encode(['status' => 'error', 'message' => 'Silakan pilih minimal satu level nomenklatur!']);
            return;
        }
    } else {
        // Mode manual
        $kode_rekening = trim($this->input->post('kode_rekening', TRUE));
        $tujuan = trim($this->input->post('tujuan_manual', TRUE));
        $sasaran = trim($this->input->post('sasaran_manual', TRUE));
        $program = trim($this->input->post('program_manual', TRUE));
        $kegiatan = trim($this->input->post('kegiatan_manual', TRUE));
        $sub_kegiatan = trim($this->input->post('sub_kegiatan_manual', TRUE));
        
        if (empty($kode_rekening) && empty($tujuan) && empty($sasaran) && empty($program) && empty($kegiatan) && empty($sub_kegiatan)) {
            echo json_encode(['status' => 'error', 'message' => 'Silakan isi minimal Kode Rekening atau salah satu field!']);
            return;
        }
    }
    
    $data = [
        'kode_wilayah' => $kode_wilayah,
        'id_instansi' => $instansi_id,
        'kode_rekening' => $kode_rekening ?: null,
        'tujuan' => $tujuan,
        'sasaran' => $sasaran,
        'program' => $program,
        'kegiatan' => $kegiatan,
        'sub_kegiatan' => $sub_kegiatan,
        'tahun' => $tahun,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    // Di method tambahRenjaHeader(), setelah insert
    $result = $this->db->insert('renja_pd_header', $data);
    $new_id = $this->db->insert_id();

    // TAMBAHKAN INI:
    if ($result && $new_id) {
        // Sinkronisasi otomatis ke rancangan
        $this->sync_rancangan_renja($new_id, $kode_wilayah, $instansi_id, $tahun);
    }

    if ($result && $new_id) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Header berhasil ditambahkan',
            'data' => ['id' => $new_id]
        ]);
    }
    
    if ($result && $new_id) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Header berhasil ditambahkan',
            'data' => ['id' => $new_id]
        ]);
    } else {
        $error = $this->db->error();
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal menyimpan data: ' . $error['message']
        ]);
    }
    exit;
}

/**
 * EDIT Header Renja PD (AJAX) - HANYA UNTUK ROLE 4
 * URL: Instansi/editRenjaHeader
 */
public function editRenjaHeader() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    // 🔧 CEK APAKAH DATA ADA DAN MILIK INSTANSI INI
    $existing = $this->db->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('renja_pd_header')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan atau sudah dihapus!']);
        return;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.']);
        return;
    }
    
    $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
    
    // Ambil data dari dropdown nomenklatur
    $mode_nomenklatur = (int)$this->input->post('mode_nomenklatur', TRUE);
    
    $kode_rekening = '';
    $tujuan = '';
    $sasaran = '';
    $program = '';
    $kegiatan = '';
    $sub_kegiatan = '';
    
    if ($mode_nomenklatur == 1) {
        // Mode pilih dari nomenklatur
        $urusan_kode = trim($this->input->post('urusan_kode', TRUE));
        $bidang_kode = trim($this->input->post('bidang_kode', TRUE));
        $program_kode = trim($this->input->post('program_kode', TRUE));
        $kegiatan_kode = trim($this->input->post('kegiatan_kode', TRUE));
        $sub_kegiatan_kode = trim($this->input->post('sub_kegiatan_kode', TRUE));
        
        // Ambil nama dari kode
        if ($urusan_kode) {
            $urusan = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $urusan_kode)->get()->row_array();
            $tujuan = $urusan ? $urusan['Nomenklatur'] : '';
        }
        if ($bidang_kode) {
            $bidang = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $bidang_kode)->get()->row_array();
            $sasaran = $bidang ? $bidang['Nomenklatur'] : '';
        }
        if ($program_kode) {
            $prog = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $program_kode)->get()->row_array();
            $program = $prog ? $prog['Nomenklatur'] : '';
        }
        if ($kegiatan_kode) {
            $keg = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $kegiatan_kode)->get()->row_array();
            $kegiatan = $keg ? $keg['Nomenklatur'] : '';
        }
        if ($sub_kegiatan_kode) {
            $sub = $this->db->select('Nomenklatur')->from('nomenklaturkabupaten')->where('Kode', $sub_kegiatan_kode)->get()->row_array();
            $sub_kegiatan = $sub ? $sub['Nomenklatur'] : '';
        }
        
        // Generate kode rekening
        if ($sub_kegiatan_kode) {
            $kode_rekening = $sub_kegiatan_kode;
        } elseif ($kegiatan_kode) {
            $kode_rekening = $kegiatan_kode;
        } elseif ($program_kode) {
            $kode_rekening = $program_kode;
        } elseif ($bidang_kode) {
            $kode_rekening = $bidang_kode;
        } elseif ($urusan_kode) {
            $kode_rekening = $urusan_kode;
        }
        
        if (empty($urusan_kode) && empty($bidang_kode) && empty($program_kode) && empty($kegiatan_kode) && empty($sub_kegiatan_kode)) {
            echo json_encode(['status' => 'error', 'message' => 'Silakan pilih minimal satu level nomenklatur!']);
            return;
        }
    } else {
        // Mode manual
        $kode_rekening = trim($this->input->post('kode_rekening', TRUE));
        $tujuan = trim($this->input->post('tujuan_manual', TRUE));
        $sasaran = trim($this->input->post('sasaran_manual', TRUE));
        $program = trim($this->input->post('program_manual', TRUE));
        $kegiatan = trim($this->input->post('kegiatan_manual', TRUE));
        $sub_kegiatan = trim($this->input->post('sub_kegiatan_manual', TRUE));
        
        if (empty($kode_rekening) && empty($tujuan) && empty($sasaran) && empty($program) && empty($kegiatan) && empty($sub_kegiatan)) {
            echo json_encode(['status' => 'error', 'message' => 'Minimal isi Kode Rekening atau salah satu field!']);
            return;
        }
    }
    
    // 🔧 DATA YANG AKAN DIUPDATE - PASTIKAN SEMUA FIELD TERMASUK
    $data = [
        'kode_rekening' => $kode_rekening ?: null,
        'tujuan' => $tujuan,
        'sasaran' => $sasaran,
        'program' => $program,
        'kegiatan' => $kegiatan,
        'sub_kegiatan' => $sub_kegiatan,
        'tahun' => $tahun,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    // 🔧 PERBAIKAN: Update hanya berdasarkan ID, tanpa where kode_wilayah
    $this->db->where('id', $id);
    $result = $this->db->update('renja_pd_header', $data);

    if ($result) {
    // Sinkronisasi otomatis ke rancangan
    $this->sync_rancangan_renja($id, $kode_wilayah, $instansi_id, $tahun);
    }

    
    // 🔧 CEK HASIL UPDATE
    if ($result) {
        $affected = $this->db->affected_rows();
        if ($affected > 0) {
            echo json_encode([
                'status' => 'success',
                'message' => 'Header berhasil diperbarui',
                'data' => ['id' => $id, 'affected' => $affected]
            ]);
        } else {
            // Cek apakah data benar-benar berubah
            $check = $this->db->where('id', $id)->get('renja_pd_header')->row_array();
            if ($check) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Tidak ada perubahan data (data sudah sama)',
                    'data' => ['id' => $id, 'affected' => 0]
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Gagal mengupdate data!'
                ]);
            }
        }
    } else {
        // Debug: tampilkan error
        $error = $this->db->error();
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal update: ' . $error['message']
        ]);
    }
    exit;
}

    /**
     * Hapus Header Renja PD (AJAX)
     */
    public function hapusRenjaHeader() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        if (!$this->can_crud()) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        $kode_wilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
            return;
        }
        
        $existing = $this->db->where('id', $id)
            ->where('kode_wilayah', $kode_wilayah)
            ->where('deleted_at IS NULL')
            ->get('renja_pd_header')
            ->row();
        
        if (!$existing) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            return;
        }
        
        if ($existing->id_instansi != $instansi_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
            return;
        }
        
        $now = date('Y-m-d H:i:s');
        
        // Soft delete header
        $this->db->where('id', $id)->update('renja_pd_header', ['deleted_at' => $now]);
        
        // Soft delete semua detail
        $this->db->where('header_id', $id)->update('renja_pd_detail', ['deleted_at' => $now]);
        // Sinkronisasi otomatis (hapus dari rancangan)
        $this->sync_rancangan_renja($id, $kode_wilayah, $instansi_id, $existing->tahun);
        
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        exit;
    }

public function ResetNotifikasiRanwal() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $instansi_id = $this->get_instansi_id();
    
    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    // Ambil data detail untuk mendapatkan header_id
    $detail = $this->db->select('header_id, id_instansi, kode_wilayah')
        ->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('renja_pd_detail')
        ->row();
    
    if (!$detail) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    if ($detail->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat mereset data instansi sendiri.']);
        return;
    }
    
    $this->db->where('id', $id);
    $this->db->update('renja_pd_detail', [
        'edited_by_daerah' => 0,
        'daerah_edit_fields' => null,
        'daerah_edit_time' => null
    ]);
    
    // ================================================
    // ✅ TAMBAHKAN INI: SINKRONISASI KE RANCANGAN
    // ================================================
    $kode_wilayah = $this->get_kode_wilayah();
    $header = $this->db->select('tahun')->where('id', $detail->header_id)->get('renja_pd_header')->row();
    if ($header) {
        $this->sync_rancangan_renja($detail->header_id, $kode_wilayah, $instansi_id, $header->tahun);
    }
    
    echo json_encode(['status' => 'success', 'message' => 'Notifikasi direset']);
    exit;
}

/**
 * Get Header Renja PD by ID (AJAX) - UNTUK EDIT
 * URL: Instansi/getRenjaHeaderData
 */
public function getRenjaHeaderData() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    // Hanya Role 4 yang bisa mengambil data untuk edit
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        return;
    }
    
    // 🔧 PERBAIKAN: Hapus where('kode_wilayah') karena sudah dicek via instansi
    $data = $this->db->select('*')
        ->from('renja_pd_header')
        ->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();
    
    if ($data) {
        // Cek kepemilikan
        if ($data['id_instansi'] != $instansi_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Akses ditolak! Data bukan milik instansi Anda.'
            ]);
            return;
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

// =====================================================
// GET DAFTAR DINAS UNTUK BIDANG PENGAMPU (RENJA)
// =====================================================

/**
 * Get Daftar Dinas untuk dropdown Bidang Pengampu
 * URL: Instansi/getDaftarDinasRenja
 */
public function getDaftarDinasRenja() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$kodewilayah) {
        echo json_encode([]);
        return;
    }
    
    $dinas = $this->db
        ->select('id, nama')
        ->from('akun_instansi')
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC')
        ->get()
        ->result_array();

    echo json_encode($dinas);
    exit;
}

/**
 * Get Pelaksana by Dinas untuk dropdown Pengampu (Renja)
 * URL: Instansi/getPelaksanaByDinasRenja
 */
public function getPelaksanaByDinasRenja() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kodewilayah = $this->get_kode_wilayah();
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
    ->where('akun_karyawan.Level', 4)  // Level 4 = Pelaksana
    ->where('akun_karyawan.kodewilayah', $kodewilayah)
    ->where('akun_karyawan.deleted_at IS NULL');
    
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
 * Get Detail Pelaksana untuk dropdown Pengampu (Renja)
 * URL: Instansi/getPelaksanaDetailRenja
 */
public function getPelaksanaDetailRenja() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = $this->input->post('id', TRUE);
    $kodewilayah = $this->get_kode_wilayah();
    
    if (!$id || !$kodewilayah) {
        echo json_encode([]);
        return;
    }
    
    $detail = $this->db
        ->select('id, nama, nip, jabatan, dinas_id')
        ->from('akun_karyawan')
        ->where('id', $id)
        ->where('kodewilayah', $kodewilayah)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();

    echo json_encode($detail);
    exit;
}

    /**
 * Simpan Detail Indikator Renja PD (AJAX)
 * - Menambah atau mengupdate indikator di Renja PD
 * - Otomatis sinkronisasi ke Rancangan Renja
 */
public function simpanRenjaDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah/mengedit data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $header_id = (int)$this->input->post('header_id', TRUE);
    
    if (!$header_id) {
        echo json_encode(['status' => 'error', 'message' => 'Header tidak valid']);
        return;
    }
    
    // Validasi header milik instansi ini
    $header = $this->db->where('id', $header_id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('renja_pd_header')
        ->row();
    
    if (!$header) {
        echo json_encode(['status' => 'error', 'message' => 'Header tidak ditemukan']);
        return;
    }
    
    if ($header->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menambah data ke header milik sendiri.']);
        return;
    }
    
    // Format Rupiah helper
    $formatRp = function($val) {
        if (empty($val)) return null;
        $val = str_replace(['Rp', ' ', '.', ','], '', $val);
        return $val !== '' ? (float)$val : null;
    };
    
    $data = [
        'header_id' => $header_id,
        'kode_wilayah' => $kode_wilayah,
        'id_instansi' => $instansi_id,
        'indikator_kinerja' => trim($this->input->post('indikator_kinerja', TRUE)),
        'satuan' => trim($this->input->post('satuan', TRUE)),
        'lokasi' => trim($this->input->post('lokasi', TRUE)),
        'prioritas_daerah' => trim($this->input->post('prioritas_daerah', TRUE)),
        'prioritas_nasional' => trim($this->input->post('prioritas_nasional', TRUE)),
        'ranwal_kinerja' => trim($this->input->post('ranwal_kinerja', TRUE)),
        'ranwal_rp' => $formatRp($this->input->post('ranwal_rp', TRUE)),
        'rancangan_kinerja' => trim($this->input->post('rancangan_kinerja', TRUE)),
        'rancangan_rp' => $formatRp($this->input->post('rancangan_rp', TRUE)),
        'ranhir_kinerja' => trim($this->input->post('ranhir_kinerja', TRUE)),
        'ranhir_rp' => $formatRp($this->input->post('ranhir_rp', TRUE)),
        'renja_kinerja' => trim($this->input->post('renja_kinerja', TRUE)),
        'renja_rp' => $formatRp($this->input->post('renja_rp', TRUE)),
        'dpa_murni_kinerja' => trim($this->input->post('dpa_murni_kinerja', TRUE)),
        'dpa_murni_rp' => $formatRp($this->input->post('dpa_murni_rp', TRUE)),
        'sumber_dana' => trim($this->input->post('sumber_dana', TRUE)),
        'dpa_perubahan_kinerja' => trim($this->input->post('dpa_perubahan_kinerja', TRUE)),
        'dpa_perubahan_rp' => $formatRp($this->input->post('dpa_perubahan_rp', TRUE)),
        'bidang_pengampu' => trim($this->input->post('bidang_pengampu', TRUE)),
        'pengampu' => trim($this->input->post('pengampu', TRUE)),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    // Gunakan transaksi untuk memastikan konsistensi data
    $this->db->trans_start();
    
    try {
        if ($id > 0) {
            // Update detail
            $existing = $this->db->where('id', $id)
                ->where('kode_wilayah', $kode_wilayah)
                ->where('deleted_at IS NULL')
                ->get('renja_pd_detail')
                ->row();
            
            if (!$existing) {
                throw new Exception('Data tidak ditemukan');
            }
            
            if ($existing->id_instansi != $instansi_id) {
                throw new Exception('Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.');
            }
            
            $this->db->where('id', $id)->update('renja_pd_detail', $data);
            $message = 'Indikator berhasil diperbarui';
            $detail_id = $id;
        } else {
            // Insert detail
            $last_urutan = $this->db->select_max('urutan')
                ->where('header_id', $header_id)
                ->where('deleted_at IS NULL')
                ->get('renja_pd_detail')
                ->row()
                ->urutan;
            
            $data['urutan'] = ($last_urutan ? $last_urutan + 10 : 10);
            $data['created_at'] = date('Y-m-d H:i:s');
            
            $this->db->insert('renja_pd_detail', $data);
            $detail_id = $this->db->insert_id();
            $message = 'Indikator berhasil ditambahkan';
        }
        
        // ================================================
        // SINKRONISASI OTOMATIS KE RANCANGAN RENJA
        // ================================================
        if ($detail_id > 0) {
            // Panggil method sync untuk header
            $this->sync_rancangan_renja($header_id, $kode_wilayah, $instansi_id, $header->tahun);
        }

        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => $message,
            'data' => ['id' => $detail_id]
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}

public function hapusRenjaDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    // Ambil data detail sebelum dihapus untuk mendapatkan header_id
    $detail = $this->db->select('header_id, id_instansi, kode_wilayah')
        ->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('renja_pd_detail')
        ->row();
    
    if (!$detail) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('renja_pd_detail')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        return;
    }
    
    $header_id = $detail->header_id;
    
    // Ambil tahun dari header
    $header = $this->db->select('tahun')
        ->where('id', $header_id)
        ->where('deleted_at IS NULL')
        ->get('renja_pd_header')
        ->row();
    
    if (!$header) {
        echo json_encode(['status' => 'error', 'message' => 'Header tidak ditemukan']);
        return;
    }
    
    $tahun = $header->tahun;
    
    $this->db->trans_start();
    
    try {
        // Soft delete detail
        $this->db->where('id', $id)->update('renja_pd_detail', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        
        // ================================================
        // ✅ TAMBAHKAN INI: SINKRONISASI KE RANCANGAN
        // ================================================
        $this->sync_rancangan_renja($header_id, $kode_wilayah, $instansi_id, $tahun);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menghapus data');
        }
        
        echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil dihapus']);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
    exit;
}
/**
 * Sinkronisasi Manual dari Renja PD ke Rancangan Renja
 * - Update atau insert semua data berdasarkan Renja PD
 */
public function SyncRancanganRenja() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak!']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
    
    if (!$kode_wilayah || !$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // Ambil semua header Renja PD
        $headers = $this->db->select('id, tahun')
            ->from('renja_pd_header')
            ->where('kode_wilayah', $kode_wilayah)
            ->where('id_instansi', $instansi_id)
            ->where('tahun', $tahun)
            ->where('deleted_at IS NULL')
            ->get()
            ->result_array();
        
        if (empty($headers)) {
            throw new Exception('Tidak ada data Renja PD untuk tahun ' . $tahun);
        }
        
        // Hapus data rancangan lama (soft delete)
        $this->db->where('kode_wilayah', $kode_wilayah)
            ->where('id_instansi', $instansi_id)
            ->where('tahun', $tahun)
            ->where('deleted_at IS NULL')
            ->update('rancangan_renja_header', ['deleted_at' => date('Y-m-d H:i:s')]);
        
        $this->db->where('kode_wilayah', $kode_wilayah)
            ->where('id_instansi', $instansi_id)
            ->where('deleted_at IS NULL')
            ->update('rancangan_renja_detail', ['deleted_at' => date('Y-m-d H:i:s')]);
        
        // Sinkronisasi ulang semua header
        foreach ($headers as $header) {
            $this->sync_rancangan_renja($header['id'], $kode_wilayah, $instansi_id, $header['tahun']);
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal sinkronisasi');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Sinkronisasi berhasil! ' . count($headers) . ' header diproses.'
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}

/**
 * Hapus semua data Rancangan Renja
 */
public function HapusSemuaRancangan() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak!']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
    
    if (!$kode_wilayah || !$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
        return;
    }
    
    $this->db->where('kode_wilayah', $kode_wilayah)
        ->where('id_instansi', $instansi_id)
        ->where('tahun', $tahun)
        ->where('deleted_at IS NULL')
        ->update('rancangan_renja_header', ['deleted_at' => date('Y-m-d H:i:s')]);
    
    $this->db->where('kode_wilayah', $kode_wilayah)
        ->where('id_instansi', $instansi_id)
        ->where('deleted_at IS NULL')
        ->update('rancangan_renja_detail', ['deleted_at' => date('Y-m-d H:i:s')]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Semua data Rancangan Renja berhasil dihapus'
    ]);
}


/**
 * Get Detail Renja PD by ID (AJAX) - DIPERBAIKI DENGAN JOIN NAMA
 */
public function getRenjaDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    // 🔥 TAMBAHKAN pengampu_jabatan di SELECT
    $this->db->select('
        d.*, 
        h.kode_rekening, 
        h.tujuan, 
        h.sasaran, 
        h.program, 
        h.kegiatan, 
        h.sub_kegiatan, 
        h.tahun,
        a.nama as bidang_pengampu_nama,
        ak.nama as pengampu_nama,
        ak.jabatan as pengampu_jabatan  -- ⬅️ TAMBAHKAN INI
    ');
    $this->db->from('renja_pd_detail d');
    $this->db->join('renja_pd_header h', 'h.id = d.header_id', 'left');
    $this->db->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left');
    $this->db->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left');
    $this->db->where('d.id', $id);
    $this->db->where('d.kode_wilayah', $kode_wilayah);
    $this->db->where('d.deleted_at IS NULL');
    
    $data = $this->db->get()->row_array();
    
    if ($data) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    exit;
}

    /**
     * Get Header Renja PD by ID (AJAX)
     */
    public function getRenjaHeader() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $id = (int)$this->input->post('id', TRUE);
        $kode_wilayah = $this->get_kode_wilayah();
        
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
            return;
        }
        
        $data = $this->db->select('*')
            ->from('renja_pd_header')
            ->where('id', $id)
            ->where('kode_wilayah', $kode_wilayah)
            ->where('deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
        exit;
    }

    /**
 * Get Nomenklatur Berdasarkan Level (AJAX) - UNTUK RENJA
 */
public function getNomenklaturByLevelRenja() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $level = (int)$this->input->post('level');
    $parent_kode = $this->input->post('parent_kode');
    
    if ($level < 1 || $level > 5) {
        echo json_encode([]);
        return;
    }
    
    $this->db->select('Kode, Nomenklatur, Kinerja, Indikator, Satuan');
    $this->db->from('nomenklaturkabupaten');
    // TIDAK ADA FILTER deleted_at
    
    if ($level == 1) {
        // Urusan: 0 titik, panjang 1
        $this->db->where('Kode NOT LIKE', '%.%');
        $this->db->where('LENGTH(Kode) = 1');
    } elseif ($level == 2) {
        // Bidang Urusan: 1 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 1);
        if ($parent_kode) {
            $this->db->where('Kode LIKE', $parent_kode . '.%');
        }
    } elseif ($level == 3) {
        // Program: 2 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 2);
        if ($parent_kode) {
            $this->db->where('Kode LIKE', $parent_kode . '.%');
        }
    } elseif ($level == 4) {
        // Kegiatan: 4 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 4);
        if ($parent_kode) {
            $this->db->where('Kode LIKE', $parent_kode . '.%');
        }
    } elseif ($level == 5) {
        // Sub Kegiatan: 5 titik
        $this->db->where('(LENGTH(Kode) - LENGTH(REPLACE(Kode, ".", ""))) =', 5);
        if ($parent_kode) {
            $this->db->where('Kode LIKE', $parent_kode . '.%');
        }
    }
    
    $this->db->order_by('Kode', 'ASC');
    $data = $this->db->get()->result_array();
    
    echo json_encode($data);
}

/**
 * Get list Provinsi untuk dropdown
 */
public function getProvinsiList() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $provinsi = $this->db
        ->select('Kode, Nama')
        ->where("Kode LIKE '__'")
        ->where('LENGTH(Kode) = 2')
        ->order_by('Nama', 'ASC')
        ->get('kodewilayah')
        ->result_array();
    
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($provinsi));
}

/**
 * Get list Kab/Kota berdasarkan Provinsi
 */
public function getKabKotaByProvinsi() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kode_provinsi = $this->input->post('kode_provinsi', TRUE);
    
    if (empty($kode_provinsi)) {
        $this->output->set_content_type('application/json')->set_output(json_encode([]));
        return;
    }
    
    // Cari semua Kab/Kota dengan kode yang dimulai dengan kode provinsi
    $kabkota = $this->db
        ->select('Kode, Nama')
        ->from('kodewilayah')
        ->like('Kode', $kode_provinsi . '.', 'after')
        ->where('LENGTH(REPLACE(Kode, ".", "")) = 4', null, false)
        ->order_by('Nama', 'ASC')
        ->get()
        ->result_array();
    
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($kabkota));
}

/**
 * Get detail lokasi berdasarkan Kode
 */
public function getLokasiDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $kode = $this->input->post('kode', TRUE);
    
    if (empty($kode)) {
        $this->output->set_content_type('application/json')->set_output(json_encode(null));
        return;
    }
    
    $data = $this->db
        ->select('Kode, Nama')
        ->from('kodewilayah')
        ->where('Kode', $kode)
        ->get()
        ->row_array();
    
    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));
}

// =====================================================
// RANCANGAN RENJA PERANGKAT DAERAH (COPY DATA)
// =====================================================

/**
 * Halaman Rancangan Renja PD (Copy dari Renja PD)
 * - Role 4: Bisa CRUD di tabel rancangan terpisah
 * - Tidak mempengaruhi data Renja PD asli
 */
public function RancanganRenjaPD() {
    $Header['Halaman'] = 'Rancangan Renja Perangkat Daerah';
    
    // Ambil data session
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    $tahun = $this->input->get('tahun', TRUE) ?: date('Y');
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    $data['TahunAktif'] = $tahun;
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // Data nomenklatur untuk dropdown
    $data['NomenklaturData'] = $this->db
        ->select('Kode, Nomenklatur')
        ->from('nomenklaturkabupaten')
        ->order_by('Kode', 'ASC')
        ->get()
        ->result_array();
    
    // ========== AMBIL DATA RANCANGAN RENJA ==========
    $data['RancanganData'] = [];
    
    if ($KodeWilayah) {
        // Ambil Header dari rancangan_renja_header
        $query_header = $this->db->select('r.*, a.nama as instansi_nama')
            ->from('rancangan_renja_header r')
            ->join('akun_instansi a', 'a.id = r.id_instansi', 'left')
            ->where('r.kode_wilayah', $KodeWilayah)
            ->where('r.tahun', $tahun)
            ->where('r.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query_header->where('r.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query_header->where('r.id_instansi', (int)$filter_instansi_id);
        }
        
        $headers = $query_header->order_by('r.id', 'ASC')->get()->result_array();
        
        // Ambil Detail untuk setiap header
        foreach ($headers as &$header) {
            $details = $this->db->select('
                    d.*,
                    a.nama as bidang_pengampu_nama,
                    ak.nama as pengampu_nama,
                    ak.jabatan as pengampu_jabatan 
                ')
                ->from('rancangan_renja_detail d')
                ->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left')
                ->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left')
                ->where('d.header_id', $header['id'])
                ->where('d.deleted_at IS NULL')
                ->order_by('d.urutan', 'ASC')
                ->order_by('d.id', 'ASC')
                ->get()
                ->result_array();
            
            $header['details'] = $details;
            $header['detail_count'] = count($details);
        }
        
        $data['RancanganData'] = $headers;
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/RancanganRenjaPD', $data);
}

/**
 * COPY Data dari Renja PD ke Rancangan Renja
 * - Meng-copy semua data header dan detail dari renja_pd
 * - Hanya untuk Role 4
 */
public function CopyRenjaToRancangan() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menyalin data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    // Cek apakah sudah ada data rancangan untuk tahun ini
    $existing = $this->db->where('kode_wilayah', $kode_wilayah)
        ->where('id_instansi', $instansi_id)
        ->where('tahun', $tahun)
        ->where('deleted_at IS NULL')
        ->get('rancangan_renja_header')
        ->num_rows();
    
    if ($existing > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Data rancangan untuk tahun ' . $tahun . ' sudah ada! Silakan hapus terlebih dahulu.']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // 1. Ambil data Header dari renja_pd_header
        $headers = $this->db->select('*')
            ->from('renja_pd_header')
            ->where('kode_wilayah', $kode_wilayah)
            ->where('id_instansi', $instansi_id)
            ->where('tahun', $tahun)
            ->where('deleted_at IS NULL')
            ->get()
            ->result_array();
        
        if (empty($headers)) {
            throw new Exception('Tidak ada data Renja PD untuk tahun ' . $tahun);
        }
        
        foreach ($headers as $header) {
            // Insert ke rancangan_renja_header
            $header_data = [
                'kode_wilayah' => $header['kode_wilayah'],
                'id_instansi' => $header['id_instansi'],
                'kode_rekening' => $header['kode_rekening'],
                'tujuan' => $header['tujuan'],
                'sasaran' => $header['sasaran'],
                'program' => $header['program'],
                'kegiatan' => $header['kegiatan'],
                'sub_kegiatan' => $header['sub_kegiatan'],
                'tahun' => $header['tahun'],
                'sumber_data_id' => $header['id'], // Simpan ID asal
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('rancangan_renja_header', $header_data);
            $new_header_id = $this->db->insert_id();
            
            // 2. Ambil data Detail dari renja_pd_detail
            $details = $this->db->select('*')
                ->from('renja_pd_detail')
                ->where('header_id', $header['id'])
                ->where('kode_wilayah', $kode_wilayah)
                ->where('id_instansi', $instansi_id)
                ->where('deleted_at IS NULL')
                ->get()
                ->result_array();
            
            foreach ($details as $detail) {
                $detail_data = [
                    'header_id' => $new_header_id,
                    'kode_wilayah' => $detail['kode_wilayah'],
                    'id_instansi' => $detail['id_instansi'],
                    'indikator_kinerja' => $detail['indikator_kinerja'],
                    'satuan' => $detail['satuan'],
                    'lokasi' => $detail['lokasi'],
                    'prioritas_daerah' => $detail['prioritas_daerah'],
                    'prioritas_nasional' => $detail['prioritas_nasional'],
                    'ranwal_kinerja' => $detail['ranwal_kinerja'],
                    'ranwal_rp' => $detail['ranwal_rp'],
                    'rancangan_kinerja' => $detail['rancangan_kinerja'],
                    'rancangan_rp' => $detail['rancangan_rp'],
                    'ranhir_kinerja' => $detail['ranhir_kinerja'],
                    'ranhir_rp' => $detail['ranhir_rp'],
                    'renja_kinerja' => $detail['renja_kinerja'],
                    'renja_rp' => $detail['renja_rp'],
                    'dpa_murni_kinerja' => $detail['dpa_murni_kinerja'],
                    'dpa_murni_rp' => $detail['dpa_murni_rp'],
                    'sumber_dana' => $detail['sumber_dana'],
                    'dpa_perubahan_kinerja' => $detail['dpa_perubahan_kinerja'],
                    'dpa_perubahan_rp' => $detail['dpa_perubahan_rp'],
                    'bidang_pengampu' => $detail['bidang_pengampu'],
                    'pengampu' => $detail['pengampu'],
                    'urutan' => $detail['urutan'],
                    'sumber_data_id' => $detail['id'], // Simpan ID asal
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('rancangan_renja_detail', $detail_data);
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyalin data');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Data berhasil disalin ke Rancangan Renja'
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}

/**
 * Hapus semua data Rancangan Renja untuk tahun tertentu
 * - Hanya menghapus data di tabel rancangan, tidak mempengaruhi asli
 */
public function HapusRancanganRenja() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $tahun = (int)$this->input->post('tahun', TRUE);
    
    if (!$kode_wilayah || !$tahun) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        return;
    }
    
    // Soft delete semua header
    $this->db->where('kode_wilayah', $kode_wilayah)
        ->where('id_instansi', $instansi_id)
        ->where('tahun', $tahun)
        ->where('deleted_at IS NULL')
        ->update('rancangan_renja_header', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    
    // Soft delete semua detail
    $this->db->where('kode_wilayah', $kode_wilayah)
        ->where('id_instansi', $instansi_id)
        ->where('deleted_at IS NULL')
        ->update('rancangan_renja_detail', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Data Rancangan Renja berhasil dihapus'
    ]);
}

/**
 * Edit Detail Rancangan Renja (AJAX)
 * - Hanya mengubah data di tabel rancangan_renja_detail
 */
public function EditRancanganDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $id = (int)$this->input->post('id', TRUE);
    $header_id = (int)$this->input->post('header_id', TRUE);
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    // Cek data di tabel rancangan_detail
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rancangan_renja_detail')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.']);
        return;
    }
    
    // Format Rupiah helper
    $formatRp = function($val) {
        if (empty($val)) return null;
        $val = str_replace(['Rp', ' ', '.', ','], '', $val);
        return $val !== '' ? (float)$val : null;
    };
    
    $data = [
        'indikator_kinerja' => trim($this->input->post('indikator_kinerja', TRUE)),
        'satuan' => trim($this->input->post('satuan', TRUE)),
        'lokasi' => trim($this->input->post('lokasi', TRUE)),
        'prioritas_daerah' => trim($this->input->post('prioritas_daerah', TRUE)),
        'prioritas_nasional' => trim($this->input->post('prioritas_nasional', TRUE)),
        'ranwal_kinerja' => trim($this->input->post('ranwal_kinerja', TRUE)),
        'ranwal_rp' => $formatRp($this->input->post('ranwal_rp', TRUE)),
        'rancangan_kinerja' => trim($this->input->post('rancangan_kinerja', TRUE)),
        'rancangan_rp' => $formatRp($this->input->post('rancangan_rp', TRUE)),
        'ranhir_kinerja' => trim($this->input->post('ranhir_kinerja', TRUE)),
        'ranhir_rp' => $formatRp($this->input->post('ranhir_rp', TRUE)),
        'renja_kinerja' => trim($this->input->post('renja_kinerja', TRUE)),
        'renja_rp' => $formatRp($this->input->post('renja_rp', TRUE)),
        'dpa_murni_kinerja' => trim($this->input->post('dpa_murni_kinerja', TRUE)),
        'dpa_murni_rp' => $formatRp($this->input->post('dpa_murni_rp', TRUE)),
        'sumber_dana' => trim($this->input->post('sumber_dana', TRUE)),
        'dpa_perubahan_kinerja' => trim($this->input->post('dpa_perubahan_kinerja', TRUE)),
        'dpa_perubahan_rp' => $formatRp($this->input->post('dpa_perubahan_rp', TRUE)),
        'bidang_pengampu' => trim($this->input->post('bidang_pengampu', TRUE)),
        'pengampu' => trim($this->input->post('pengampu', TRUE)),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id)->update('rancangan_renja_detail', $data);
    
    echo json_encode([
        'status' => 'success',
        'message' => 'Indikator Rancangan berhasil diperbarui'
    ]);
}

/**
 * Hapus Detail Rancangan Renja (AJAX)
 */
public function HapusRancanganDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rancangan_renja_detail')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        return;
    }
    
    $this->db->where('id', $id)->update('rancangan_renja_detail', [
        'deleted_at' => date('Y-m-d H:i:s')
    ]);
    
    echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil dihapus']);
}

/**
 * Get Header Rancangan Renja by ID (AJAX)
 */
public function getRancanganHeader() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    $data = $this->db->select('*')
        ->from('rancangan_renja_header')
        ->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();
    
    if ($data) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
}

/**
 * Get Detail Rancangan Renja by ID (AJAX)
 */
public function getRancanganDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    // 🔥 TAMBAHKAN pengampu_jabatan di SELECT
    $this->db->select('
        d.*, 
        h.kode_rekening, 
        h.tujuan, 
        h.sasaran, 
        h.program, 
        h.kegiatan, 
        h.sub_kegiatan, 
        h.tahun,
        a.nama as bidang_pengampu_nama,
        ak.nama as pengampu_nama,
        ak.jabatan as pengampu_jabatan  -- ⬅️ TAMBAHKAN INI
    ');
    $this->db->from('rancangan_renja_detail d');
    $this->db->join('rancangan_renja_header h', 'h.id = d.header_id', 'left');
    $this->db->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left');
    $this->db->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left');
    $this->db->where('d.id', $id);
    $this->db->where('d.kode_wilayah', $kode_wilayah);
    $this->db->where('d.deleted_at IS NULL');
    
    $data = $this->db->get()->row_array();
    
    if ($data) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    exit;
}

// =====================================================
// SINKRONISASI OTOMATIS RANCANGAN RENJA
// =====================================================
// =====================================================
// SINKRONISASI OTOMATIS RANCANGAN RENJA
// =====================================================

/**
 * Generate sync hash dari data
 */
private function generate_sync_hash($data) {
    // Hapus field yang tidak mempengaruhi sync
    unset($data['id']);
    unset($data['created_at']);
    unset($data['updated_at']);
    unset($data['deleted_at']);
    unset($data['sumber_data_id']);
    unset($data['sync_hash']);
    unset($data['last_sync_at']);
    
    // Sort array untuk konsistensi
    ksort($data);
    return md5(json_encode($data));
}

/**
 * Sinkronisasi otomatis Rancangan Renja dengan Renja PD
 * Dipanggil setelah setiap operasi CRUD di Renja PD
 */
private function sync_rancangan_renja($renja_header_id, $kode_wilayah, $instansi_id, $tahun) {
    // Cek apakah ada data rancangan
    $existing_rancangan = $this->db->select('id, sync_hash, sumber_data_id')
        ->from('rancangan_renja_header')
        ->where('kode_wilayah', $kode_wilayah)
        ->where('id_instansi', $instansi_id)
        ->where('tahun', $tahun)
        ->where('sumber_data_id', $renja_header_id)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();
    
    // Ambil data Renja PD
    $renja_data = $this->db->select('*')
        ->from('renja_pd_header')
        ->where('id', $renja_header_id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('id_instansi', $instansi_id)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();
    
    if (!$renja_data) {
        // Data Renja PD sudah dihapus, hapus juga rancangan
        if ($existing_rancangan) {
            $this->db->where('sumber_data_id', $renja_header_id)
                ->where('kode_wilayah', $kode_wilayah)
                ->update('rancangan_renja_header', ['deleted_at' => date('Y-m-d H:i:s')]);
            
            $this->db->where('header_id', $existing_rancangan['id'])
                ->update('rancangan_renja_detail', ['deleted_at' => date('Y-m-d H:i:s')]);
        }
        return;
    }
    
    // Generate hash dari data renja
    $new_hash = $this->generate_sync_hash($renja_data);
    
    if ($existing_rancangan) {
        // Cek apakah ada perubahan
        if ($existing_rancangan['sync_hash'] !== $new_hash) {
            // Update header rancangan
            $header_data = [
                'kode_rekening' => $renja_data['kode_rekening'],
                'tujuan' => $renja_data['tujuan'],
                'sasaran' => $renja_data['sasaran'],
                'program' => $renja_data['program'],
                'kegiatan' => $renja_data['kegiatan'],
                'sub_kegiatan' => $renja_data['sub_kegiatan'],
                'tahun' => $renja_data['tahun'],
                'sync_hash' => $new_hash,
                'last_sync_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->where('id', $existing_rancangan['id'])
                ->update('rancangan_renja_header', $header_data);
            
            // Sync detail
            $this->sync_rancangan_detail($renja_header_id, $existing_rancangan['id'], $kode_wilayah, $instansi_id);
        }
    } else {
        // Buat baru di rancangan
        $header_data = [
            'kode_wilayah' => $renja_data['kode_wilayah'],
            'id_instansi' => $renja_data['id_instansi'],
            'kode_rekening' => $renja_data['kode_rekening'],
            'tujuan' => $renja_data['tujuan'],
            'sasaran' => $renja_data['sasaran'],
            'program' => $renja_data['program'],
            'kegiatan' => $renja_data['kegiatan'],
            'sub_kegiatan' => $renja_data['sub_kegiatan'],
            'tahun' => $renja_data['tahun'],
            'sumber_data_id' => $renja_header_id,
            'sync_hash' => $new_hash,
            'last_sync_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('rancangan_renja_header', $header_data);
        $new_header_id = $this->db->insert_id();
        
        // Sync detail
        $this->sync_rancangan_detail($renja_header_id, $new_header_id, $kode_wilayah, $instansi_id);
    }
}

private function sync_rancangan_detail($renja_header_id, $rancangan_header_id, $kode_wilayah, $instansi_id) {
    // Ambil detail Renja PD
    $renja_details = $this->db->select('*')
        ->from('renja_pd_detail')
        ->where('header_id', $renja_header_id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('id_instansi', $instansi_id)
        ->where('deleted_at IS NULL')
        ->order_by('urutan', 'ASC')
        ->get()
        ->result_array();
    
    // Ambil detail rancangan yang ada
    $rancangan_details = $this->db->select('*')
        ->from('rancangan_renja_detail')
        ->where('header_id', $rancangan_header_id)
        ->where('deleted_at IS NULL')
        ->get()
        ->result_array();
    
    // Buat mapping ID asal ke ID rancangan
    $source_to_rancangan = [];
    foreach ($rancangan_details as $rd) {
        if (!empty($rd['sumber_data_id'])) {
            $source_to_rancangan[$rd['sumber_data_id']] = $rd;
        }
    }
    
    $processed_source_ids = [];
    
    // Proses setiap detail renja
    foreach ($renja_details as $renja_detail) {
        $processed_source_ids[] = $renja_detail['id'];
        
        // HAPUS FIELD UNTUK HASH
        $detail_for_hash = $renja_detail;
        unset($detail_for_hash['id']);
        unset($detail_for_hash['created_at']);
        unset($detail_for_hash['updated_at']);
        unset($detail_for_hash['deleted_at']);
        unset($detail_for_hash['sumber_data_id']);
        unset($detail_for_hash['sync_hash']);
        unset($detail_for_hash['last_sync_at']);
        unset($detail_for_hash['edited_by_daerah']);
        unset($detail_for_hash['daerah_edit_fields']);
        unset($detail_for_hash['daerah_edit_time']);
        unset($detail_for_hash['daerah_edit_old_data']);
        
        $detail_hash = md5(json_encode($detail_for_hash));
        
        $detail_data = [
            'header_id' => $rancangan_header_id,
            'kode_wilayah' => $renja_detail['kode_wilayah'],
            'id_instansi' => $renja_detail['id_instansi'],
            'indikator_kinerja' => $renja_detail['indikator_kinerja'],
            'satuan' => $renja_detail['satuan'],
            'lokasi' => $renja_detail['lokasi'],
            'lokasi_nama' => $renja_detail['lokasi_nama'] ?? null,
            'prioritas_daerah' => $renja_detail['prioritas_daerah'],
            'prioritas_nasional' => $renja_detail['prioritas_nasional'],
            'ranwal_kinerja' => $renja_detail['ranwal_kinerja'],
            'ranwal_rp' => $renja_detail['ranwal_rp'],
            'rancangan_kinerja' => $renja_detail['rancangan_kinerja'],
            'rancangan_rp' => $renja_detail['rancangan_rp'],
            'ranhir_kinerja' => $renja_detail['ranhir_kinerja'],
            'ranhir_rp' => $renja_detail['ranhir_rp'],
            'renja_kinerja' => $renja_detail['renja_kinerja'],
            'renja_rp' => $renja_detail['renja_rp'],
            'dpa_murni_kinerja' => $renja_detail['dpa_murni_kinerja'],
            'dpa_murni_rp' => $renja_detail['dpa_murni_rp'],
            'sumber_dana' => $renja_detail['sumber_dana'],
            'dpa_perubahan_kinerja' => $renja_detail['dpa_perubahan_kinerja'],
            'dpa_perubahan_rp' => $renja_detail['dpa_perubahan_rp'],
            'bidang_pengampu' => $renja_detail['bidang_pengampu'],
            'pengampu' => $renja_detail['pengampu'],
            'urutan' => $renja_detail['urutan'],
            'sumber_data_id' => $renja_detail['id'],
            'sync_hash' => $detail_hash,
            'last_sync_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        if (isset($source_to_rancangan[$renja_detail['id']])) {
            // Update existing
            $existing = $source_to_rancangan[$renja_detail['id']];
            
            // Cek apakah ada perubahan
            if ($existing['sync_hash'] !== $detail_hash) {
                unset($detail_data['created_at']);
                $this->db->where('id', $existing['id'])
                    ->update('rancangan_renja_detail', $detail_data);
            }
        } else {
            // Insert baru
            $detail_data['created_at'] = date('Y-m-d H:i:s');
            $this->db->insert('rancangan_renja_detail', $detail_data);
        }
    }
    
    // Hapus detail rancangan yang tidak ada di renja (soft delete)
    $to_delete = array_diff(array_keys($source_to_rancangan), $processed_source_ids);
    if (!empty($to_delete)) {
        $this->db->where_in('sumber_data_id', $to_delete)
            ->where('header_id', $rancangan_header_id)
            ->update('rancangan_renja_detail', ['deleted_at' => date('Y-m-d H:i:s')]);
    }
}
// =====================================================
// RANCANGAN AKHIR RENJA PERANGKAT DAERAH
// =====================================================


public function RancanganAkhirRenjaPD() {
    $Header['Halaman'] = 'Rancangan Akhir Renja PD';
    
    // Ambil data session
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    $tahun = $this->input->get('tahun', TRUE) ?: date('Y');
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    $data['TahunAktif'] = $tahun;
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // Data nomenklatur untuk dropdown
    $data['NomenklaturData'] = $this->db
        ->select('Kode, Nomenklatur')
        ->from('nomenklaturkabupaten')
        ->order_by('Kode', 'ASC')
        ->get()
        ->result_array();
    
    // ========== CEK APAKAH ADA DATA RANCANGAN RENJA ==========
    $data['HasRancanganData'] = false;
    $data['JumlahRancanganData'] = 0;
    
    if ($KodeWilayah) {
        $query = $this->db->select('COUNT(*) as total')
            ->from('rancangan_renja_header')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('id_instansi', $instansi_id)
            ->where('tahun', $tahun)
            ->where('deleted_at IS NULL')
            ->get()
            ->row();
        
        if ($query && $query->total > 0) {
            $data['HasRancanganData'] = true;
            $data['JumlahRancanganData'] = $query->total;
        }
    }
    
    // ========== AMBIL DATA RANCANGAN AKHIR RENJA ==========
    $data['RancanganAkhirData'] = [];
    $data['LastSyncAt'] = null;
    
    if ($KodeWilayah) {
        // Ambil Header dari rancangan_akhir_renja_header
        $query_header = $this->db->select('r.*, a.nama as instansi_nama')
            ->from('rancangan_akhir_renja_header r')
            ->join('akun_instansi a', 'a.id = r.id_instansi', 'left')
            ->where('r.kode_wilayah', $KodeWilayah)
            ->where('r.tahun', $tahun)
            ->where('r.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query_header->where('r.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query_header->where('r.id_instansi', (int)$filter_instansi_id);
        }
        
        $headers = $query_header->order_by('r.id', 'ASC')->get()->result_array();
        
        // Ambil last_sync_at dari data pertama
        if (!empty($headers)) {
            $data['LastSyncAt'] = $headers[0]['last_sync_at'] ?? null;
        }
        
        // Ambil Detail untuk setiap header
        foreach ($headers as &$header) {
            $details = $this->db->select('
                    d.*,
                    a.nama as bidang_pengampu_nama,
                    ak.nama as pengampu_nama,
                    ak.jabatan as pengampu_jabatan
                ')
                ->from('rancangan_akhir_renja_detail d')
                ->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left')
                ->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left')
                ->where('d.header_id', $header['id'])
                ->where('d.deleted_at IS NULL')
                ->order_by('d.urutan', 'ASC')
                ->order_by('d.id', 'ASC')
                ->get()
                ->result_array();
            
            $header['details'] = $details;
            $header['detail_count'] = count($details);
        }
        
        $data['RancanganAkhirData'] = $headers;
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/RancanganAkhirRenjaPD', $data);
}

// =====================================================
// AMBIL DATA DARI RANCANGAN RENJA KE RANCANGAN AKHIR
// =====================================================

/**
 * Ambil Data dari Rancangan Renja ke Rancangan Akhir Renja
 * - Hapus semua data rancangan akhir yang ada
 * - Copy semua data dari rancangan_renja_*
 * - Hanya untuk Role 4
 */
public function AmbilDataRancanganAkhir() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengambil data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
    
    if (!$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // 1. Cek apakah ada data Rancangan Renja
        $rancangan_check = $this->db->select('COUNT(*) as total')
            ->from('rancangan_renja_header')
            ->where('kode_wilayah', $kode_wilayah)
            ->where('id_instansi', $instansi_id)
            ->where('tahun', $tahun)
            ->where('deleted_at IS NULL')
            ->get()
            ->row();
        
        if (!$rancangan_check || $rancangan_check->total == 0) {
            throw new Exception('Tidak ada data Rancangan Renja untuk tahun ' . $tahun . '. Silakan buat data Rancangan Renja terlebih dahulu.');
        }
        
        // 2. Hapus semua data Rancangan Akhir yang ada (soft delete)
        $this->db->where('kode_wilayah', $kode_wilayah)
            ->where('id_instansi', $instansi_id)
            ->where('tahun', $tahun)
            ->where('deleted_at IS NULL')
            ->update('rancangan_akhir_renja_header', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
        
        $this->db->where('kode_wilayah', $kode_wilayah)
            ->where('id_instansi', $instansi_id)
            ->where('deleted_at IS NULL')
            ->update('rancangan_akhir_renja_detail', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);
        
        // 3. Ambil data Header dari rancangan_renja_header
        $headers = $this->db->select('*')
            ->from('rancangan_renja_header')
            ->where('kode_wilayah', $kode_wilayah)
            ->where('id_instansi', $instansi_id)
            ->where('tahun', $tahun)
            ->where('deleted_at IS NULL')
            ->get()
            ->result_array();
        
        $total_headers = count($headers);
        $total_details = 0;
        
        foreach ($headers as $header) {
            // Generate hash
            $hash = md5(json_encode($header));
            
            // Insert ke rancangan_akhir_renja_header
            $header_data = [
                'kode_wilayah' => $header['kode_wilayah'],
                'id_instansi' => $header['id_instansi'],
                'kode_rekening' => $header['kode_rekening'],
                'tujuan' => $header['tujuan'],
                'sasaran' => $header['sasaran'],
                'program' => $header['program'],
                'kegiatan' => $header['kegiatan'],
                'sub_kegiatan' => $header['sub_kegiatan'],
                'tahun' => $header['tahun'],
                'sumber_data_id' => $header['id'],
                'sync_hash' => $hash,
                'last_sync_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->insert('rancangan_akhir_renja_header', $header_data);
            $new_header_id = $this->db->insert_id();
            
            // 4. Ambil data Detail dari rancangan_renja_detail
            $details = $this->db->select('*')
                ->from('rancangan_renja_detail')
                ->where('header_id', $header['id'])
                ->where('kode_wilayah', $kode_wilayah)
                ->where('id_instansi', $instansi_id)
                ->where('deleted_at IS NULL')
                ->get()
                ->result_array();
            
            foreach ($details as $detail) {
                $detail_hash = md5(json_encode($detail));
                
                $detail_data = [
                    'header_id' => $new_header_id,
                    'kode_wilayah' => $detail['kode_wilayah'],
                    'id_instansi' => $detail['id_instansi'],
                    'indikator_kinerja' => $detail['indikator_kinerja'],
                    'satuan' => $detail['satuan'],
                    'lokasi' => $detail['lokasi'],
                    'prioritas_daerah' => $detail['prioritas_daerah'],
                    'prioritas_nasional' => $detail['prioritas_nasional'],
                    'ranwal_kinerja' => $detail['ranwal_kinerja'],
                    'ranwal_rp' => $detail['ranwal_rp'],
                    'rancangan_kinerja' => $detail['rancangan_kinerja'],
                    'rancangan_rp' => $detail['rancangan_rp'],
                    'ranhir_kinerja' => $detail['ranhir_kinerja'],
                    'ranhir_rp' => $detail['ranhir_rp'],
                    'renja_kinerja' => $detail['renja_kinerja'],
                    'renja_rp' => $detail['renja_rp'],
                    'dpa_murni_kinerja' => $detail['dpa_murni_kinerja'],
                    'dpa_murni_rp' => $detail['dpa_murni_rp'],
                    'sumber_dana' => $detail['sumber_dana'],
                    'dpa_perubahan_kinerja' => $detail['dpa_perubahan_kinerja'],
                    'dpa_perubahan_rp' => $detail['dpa_perubahan_rp'],
                    'bidang_pengampu' => $detail['bidang_pengampu'],
                    'pengampu' => $detail['pengampu'],
                    'urutan' => $detail['urutan'],
                    'sumber_data_id' => $detail['id'],
                    'sync_hash' => $detail_hash,
                    'last_sync_at' => date('Y-m-d H:i:s'),
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                $this->db->insert('rancangan_akhir_renja_detail', $detail_data);
                $total_details++;
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal mengambil data');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Data berhasil diambil dari Rancangan Renja',
            'data' => [
                'headers' => $total_headers,
                'details' => $total_details
            ]
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}



// =====================================================
// GET DETAIL RANCANGAN AKHIR RENJA (AJAX)
// =====================================================
public function getRancanganAkhirDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.'
        ]);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id || !$kode_wilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        return;
    }
    
    // Ambil data detail dengan join ke header, bidang pengampu, dan pengampu
    $this->db->select('
        d.*, 
        h.kode_rekening, 
        h.tujuan, 
        h.sasaran, 
        h.program, 
        h.kegiatan, 
        h.sub_kegiatan, 
        h.tahun,
        a.nama as bidang_pengampu_nama,
        ak.nama as pengampu_nama,
        ak.nip as pengampu_nip,
        ak.jabatan as pengampu_jabatan
    ');
    $this->db->from('rancangan_akhir_renja_detail d');
    $this->db->join('rancangan_akhir_renja_header h', 'h.id = d.header_id', 'left');
    $this->db->join('akun_instansi a', 'a.id = d.bidang_pengampu', 'left');
    $this->db->join('akun_karyawan ak', 'ak.id = d.pengampu', 'left');
    $this->db->where('d.id', $id);
    $this->db->where('d.kode_wilayah', $kode_wilayah);
    $this->db->where('d.deleted_at IS NULL');
    
    $data = $this->db->get()->row_array();
    
    if ($data) {
        // Cek kepemilikan data
        if ($data['id_instansi'] != $instansi_id) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Akses ditolak! Data bukan milik instansi Anda.'
            ]);
            return;
        }
        
        // Tambahkan data pelaksana detail untuk dropdown
        $data['pelaksana_detail'] = [
            'nama' => $data['pengampu_nama'] ?? '',
            'jabatan' => $data['pengampu_jabatan'] ?? '',
            'nip' => $data['pengampu_nip'] ?? ''
        ];
        
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

// =====================================================
// EDIT DETAIL RANCANGAN AKHIR RENJA (AJAX)
// =====================================================

/**
 * Edit Detail Rancangan Akhir Renja (AJAX)
 * - Hanya mengubah data di tabel rancangan_akhir_renja_detail
 * - Tidak mempengaruhi Rancangan Renja asli
 */
public function EditRancanganAkhirDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $id = (int)$this->input->post('id', TRUE);
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    // Cek data di tabel rancangan_akhir_detail
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rancangan_akhir_renja_detail')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.']);
        return;
    }
    
    // Validasi indikator kinerja wajib diisi
    $indikator = trim($this->input->post('indikator_kinerja', TRUE));
    if (empty($indikator)) {
        echo json_encode(['status' => 'error', 'message' => 'Indikator Kinerja wajib diisi!']);
        return;
    }
    
    // Format Rupiah helper
    $formatRp = function($val) {
        if (empty($val)) return null;
        $val = str_replace(['Rp', ' ', '.', ','], '', $val);
        return $val !== '' ? (float)$val : null;
    };
    
    // Siapkan data untuk update - SEMUA FIELD
    $data = [
        'indikator_kinerja' => $indikator,
        'satuan' => trim($this->input->post('satuan', TRUE)),
        'lokasi' => trim($this->input->post('lokasi_kode', TRUE)) ?: trim($this->input->post('lokasi_nama', TRUE)),
        'lokasi_nama' => trim($this->input->post('lokasi_nama', TRUE)),
        'prioritas_daerah' => trim($this->input->post('prioritas_daerah', TRUE)),
        'prioritas_nasional' => trim($this->input->post('prioritas_nasional', TRUE)),
        'ranwal_kinerja' => trim($this->input->post('ranwal_kinerja', TRUE)),
        'ranwal_rp' => $formatRp($this->input->post('ranwal_rp', TRUE)),
        'rancangan_kinerja' => trim($this->input->post('rancangan_kinerja', TRUE)),
        'rancangan_rp' => $formatRp($this->input->post('rancangan_rp', TRUE)),
        'ranhir_kinerja' => trim($this->input->post('ranhir_kinerja', TRUE)),
        'ranhir_rp' => $formatRp($this->input->post('ranhir_rp', TRUE)),
        'renja_kinerja' => trim($this->input->post('renja_kinerja', TRUE)),
        'renja_rp' => $formatRp($this->input->post('renja_rp', TRUE)),
        'dpa_murni_kinerja' => trim($this->input->post('dpa_murni_kinerja', TRUE)),
        'dpa_murni_rp' => $formatRp($this->input->post('dpa_murni_rp', TRUE)),
        'sumber_dana' => trim($this->input->post('sumber_dana', TRUE)),
        'dpa_perubahan_kinerja' => trim($this->input->post('dpa_perubahan_kinerja', TRUE)),
        'dpa_perubahan_rp' => $formatRp($this->input->post('dpa_perubahan_rp', TRUE)),
        'bidang_pengampu' => trim($this->input->post('bidang_pengampu', TRUE)),
        'pengampu' => trim($this->input->post('pengampu', TRUE)),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    // Update data
    $this->db->where('id', $id)
             ->where('kode_wilayah', $kode_wilayah)
             ->update('rancangan_akhir_renja_detail', $data);
    
    if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil diperbarui']);
    } else {
        // Cek apakah data benar-benar berubah
        $check = $this->db->where('id', $id)
            ->where('kode_wilayah', $kode_wilayah)
            ->where('deleted_at IS NULL')
            ->get('rancangan_akhir_renja_detail')
            ->row_array();
        
        if ($check) {
            echo json_encode(['status' => 'success', 'message' => 'Tidak ada perubahan data (data sudah sama)']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Gagal mengupdate data!']);
        }
    }
    exit;
}

// =====================================================
// HAPUS DETAIL RANCANGAN AKHIR RENJA (AJAX)
// =====================================================

/**
 * Hapus Detail Rancangan Akhir Renja (AJAX)
 * - Hanya menghapus data di tabel rancangan_akhir_renja_detail
 * - Tidak mempengaruhi Rancangan Renja asli
 */
public function HapusRancanganAkhirDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('id', $id)
        ->where('kode_wilayah', $kode_wilayah)
        ->where('deleted_at IS NULL')
        ->get('rancangan_akhir_renja_detail')
        ->row();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        return;
    }
    
    // Soft delete
    $this->db->where('id', $id)
             ->where('kode_wilayah', $kode_wilayah)
             ->update('rancangan_akhir_renja_detail', [
                 'deleted_at' => date('Y-m-d H:i:s')
             ]);
    
    echo json_encode(['status' => 'success', 'message' => 'Indikator berhasil dihapus']);
    exit;
}

public function getSasaranDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $sasaran_id = (int)$this->input->post('sasaran_id', TRUE);
    if (!$sasaran_id) {
        echo json_encode(['status' => 'error', 'message' => 'ID sasaran tidak valid']);
        return;
    }
    
    // Ambil data sasaran beserta bidang dari tabel renstra_sasaran
    $this->db->select('
        s.*, 
        k.id as bidang_id, 
        k.nama as bidang_nama, 
        k.jabatan as bidang_jabatan, 
        k.satuan_unit_kerja as bidang_satuan
    ');
    $this->db->from('renstra_sasaran s');
    $this->db->join('akun_karyawan k', 'k.id = s.bidang_id', 'left');
    $this->db->where('s.id', $sasaran_id);
    $this->db->where('s.deleted_at IS NULL');
    
    $data = $this->db->get()->row_array();
    
    if ($data) {
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
 * Get Program by Sasaran (AJAX)
 */
public function getProgramBySasaran() {
    if (!$this->input->is_ajax_request()) show_404();
    $sasaran_id = (int)$this->input->post('sasaran_id');
    if (!$sasaran_id) {
        echo json_encode([]);
        return;
    }
    $programs = $this->db->select('id, nama')
        ->from('renstra_program')
        ->where('sasaran_id', $sasaran_id)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC')
        ->get()->result_array();
    echo json_encode($programs);
}

/**
 * Get Sub Kegiatan by Program (AJAX)
 */
public function getSubKegiatanByProgram() {
    if (!$this->input->is_ajax_request()) show_404();
    $program_id = (int)$this->input->post('program_id');
    if (!$program_id) {
        echo json_encode([]);
        return;
    }
    $this->db->select('sk.id, sk.nama as sub_kegiatan_nama, k.nama as kegiatan_nama')
        ->from('renstra_sub_kegiatan sk')
        ->join('renstra_kegiatan k', 'k.id = sk.kegiatan_id', 'left')
        ->where('k.program_id', $program_id)
        ->where('sk.deleted_at IS NULL')
        ->where('k.deleted_at IS NULL')
        ->order_by('k.nama', 'ASC')
        ->order_by('sk.nama', 'ASC');
    $subs = $this->db->get()->result_array();
    // Format untuk dropdown
    $options = [];
    foreach ($subs as $s) {
        $options[] = [
            'id' => $s['id'],
            'text' => $s['kegiatan_nama'] . ' - ' . $s['sub_kegiatan_nama']
        ];
    }
    echo json_encode($options);
}

// =====================================================
// RENSTRA PERANGKAT DAERAH (PD) - CRUD TANPA JSON
// =====================================================

public function MenuRenstraPD() {
    $Header['Halaman'] = 'Menu Renstra PD';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $level = isset($_SESSION['Level']) ? $_SESSION['Level'] : null;
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    if (empty($filter_instansi_id) && isset($_SESSION['TempInstansiId']) && !empty($_SESSION['TempInstansiId'])) {
        $filter_instansi_id = $_SESSION['TempInstansiId'];
    }
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['Level'] = $level;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // Ambil data Renstra PD dengan struktur OUTCOME → INDIKATOR
    $data['RenstraData'] = $this->getRenstraPDDataWithOutcome($KodeWilayah, $instansi_id, $is_role_4, $filter_instansi_id);
    
    // Data Perangkat Daerah untuk dropdown
    $data['PerangkatDaerah'] = [];
    if ($KodeWilayah) {
        $data['PerangkatDaerah'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // Data Sasaran RPJMD untuk dropdown
    $data['SasaranRPJMD'] = [];
    if ($KodeWilayah) {
        $data['SasaranRPJMD'] = $this->db->select('Id, Sasaran')
            ->where('KodeWilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('Sasaran', 'ASC')
            ->get('sasaranrpjmd')
            ->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/MenuRenstraPD', $data);
}

/**
 * GET DATA RENSTRA PD DENGAN STRUKTUR OUTCOME → INDIKATOR
 */
private function getRenstraPDDataWithOutcome($KodeWilayah, $instansi_id, $is_role_4, $filter_instansi_id) {
    $result = [];
    if (!$KodeWilayah) return $result;
    
    // 1. Ambil semua Tujuan
    $this->db->select('*');
    $this->db->from('renstra_tujuan');
    $this->db->where('kode_wilayah', $KodeWilayah);
    $this->db->where('deleted_at IS NULL');
    if ($is_role_4 && $instansi_id) {
        $this->db->where('id_instansi', $instansi_id);
    } elseif (!empty($filter_instansi_id)) {
        $this->db->where('id_instansi', (int)$filter_instansi_id);
    }
    $tujuan_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($tujuan_list as &$tujuan) {
        // Ambil Indikator Tujuan
        $tujuan['indikators'] = $this->db
            ->select('*')
            ->from('renstra_tujuan_indikator')
            ->where('tujuan_id', $tujuan['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get()
            ->result_array();

        // 2. Ambil Sasaran per Tujuan
        $tujuan['sasaran_list'] = $this->getRenstraSasaranWithProgramsOutcomeFull($tujuan['id'], $KodeWilayah);
    }
    
    return $tujuan_list;
}

private function getRenstraSasaranWithProgramsOutcomeFull($tujuan_id, $KodeWilayah) {
    $result = [];
    
    $this->db->select('*');
    $this->db->from('renstra_sasaran');
    $this->db->where('tujuan_id', $tujuan_id);
    $this->db->where('deleted_at IS NULL');
    $sasaran_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($sasaran_list as &$sasaran) {
        // Ambil Indikator Sasaran
        $sasaran['indikators'] = $this->db
            ->select('*')
            ->from('renstra_sasaran_indikator')
            ->where('sasaran_id', $sasaran['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get()
            ->result_array();

        // Ambil Program dengan OUTCOME, INDIKATOR, KEGIATAN, & SUB KEGIATAN
        $sasaran['program_list'] = $this->getRenstraProgramWithFullData($sasaran['id']);
    }
    
    return $sasaran_list;
}

private function getRenstraProgramWithFullData($sasaran_id) {
    $result = [];
    
    // Ambil semua program dari sasaran
    $this->db->select('p.*');
    $this->db->from('renstra_program p');
    $this->db->where('p.sasaran_id', $sasaran_id);
    $this->db->where('p.deleted_at IS NULL');
    $program_list = $this->db->order_by('p.id', 'ASC')->get()->result_array();
    
    foreach ($program_list as &$program) {
        // ============================================================
        // 1. AMBIL OUTCOME DARI renstra_program_outcome
        // ============================================================
        $outcomes = $this->db
            ->select('*')
            ->from('renstra_program_outcome')
            ->where('program_id', $program['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get()
            ->result_array();
        
        foreach ($outcomes as &$outcome) {
            // Ambil indikator untuk outcome ini
            $outcome['indikator_list'] = $this->db
    ->select('*')
    ->from('renstra_program_indikator')
    ->where('outcome_id', $outcome['id'])
    ->where('deleted_at IS NULL')
    ->order_by('urutan', 'ASC')
    ->get()
    ->result_array();
        }
        $program['outcomes'] = $outcomes;
        
        // ============================================================
        // 2. AMBIL KEGIATAN DENGAN SASARAN & INDIKATOR
        // ============================================================
        $program['kegiatan_list'] = $this->getKegiatanWithSasaranAndIndikator($program['id']);
        
        // ============================================================
        // 3. HITUNG TOTAL ANGGARAN PROGRAM
        // ============================================================
        $total = ['2026'=>0, '2027'=>0, '2028'=>0, '2029'=>0, '2030'=>0];
        
        // Dari outcome
        foreach ($program['outcomes'] as $out) {
            foreach ($out['indikator_list'] as $ind) {
                $total['2026'] += (float)($ind['anggaran_2026'] ?? 0);
                $total['2027'] += (float)($ind['anggaran_2027'] ?? 0);
                $total['2028'] += (float)($ind['anggaran_2028'] ?? 0);
                $total['2029'] += (float)($ind['anggaran_2029'] ?? 0);
                $total['2030'] += (float)($ind['anggaran_2030'] ?? 0);
            }
        }
        
        // Dari kegiatan (indikator kegiatan)
        foreach ($program['kegiatan_list'] as $keg) {
            foreach ($keg['sasaran_list'] as $ks) {
                foreach ($ks['indikators'] as $ind) {
                    $total['2026'] += (float)($ind['anggaran_2026'] ?? 0);
                    $total['2027'] += (float)($ind['anggaran_2027'] ?? 0);
                    $total['2028'] += (float)($ind['anggaran_2028'] ?? 0);
                    $total['2029'] += (float)($ind['anggaran_2029'] ?? 0);
                    $total['2030'] += (float)($ind['anggaran_2030'] ?? 0);
                }
            }
        }
        
        $program['total_anggaran_2026'] = $total['2026'];
        $program['total_anggaran_2027'] = $total['2027'];
        $program['total_anggaran_2028'] = $total['2028'];
        $program['total_anggaran_2029'] = $total['2029'];
        $program['total_anggaran_2030'] = $total['2030'];
    }
    
    return $program_list;
}

private function getKegiatanWithSasaranAndIndikator($program_id) {
    $result = [];
    
    // Ambil semua kegiatan dari program
    $this->db->select('*');
    $this->db->from('renstra_kegiatan');
    $this->db->where('program_id', $program_id);
    $this->db->where('deleted_at IS NULL');
    $kegiatan_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($kegiatan_list as &$kegiatan) {
        // Ambil sasaran kegiatan
        $sasaran = $this->db
            ->select('*')
            ->from('renstra_kegiatan_sasaran')
            ->where('kegiatan_id', $kegiatan['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get()
            ->result_array();
        
        foreach ($sasaran as &$sas) {
            // Ambil indikator untuk setiap sasaran
            $sas['indikators'] = $this->db
                ->select('ki.*, ai.nama as perangkat_daerah_nama')
                ->from('renstra_kegiatan_indikator ki')
                ->join('akun_instansi ai', 'ai.id = ki.perangkat_daerah_id', 'left')
                ->where('ki.kegiatan_id', $kegiatan['id'])
                ->where('ki.sasaran_id', $sas['id'])
                ->where('ki.deleted_at IS NULL')
                ->order_by('ki.urutan', 'ASC')
                ->get()
                ->result_array();
        }
        $kegiatan['sasaran_list'] = $sasaran;
        
        // ============================================================
        // AMBIL SUB KEGIATAN DENGAN SASARAN & INDIKATOR
        // ============================================================
        $kegiatan['sub_kegiatan_list'] = $this->getSubKegiatanWithSasaranAndIndikator($kegiatan['id']);
    }
    
    return $kegiatan_list;
}

private function getSubKegiatanWithSasaranAndIndikator($kegiatan_id) {
    $result = [];
    
    // Ambil semua sub kegiatan dari kegiatan
    $this->db->select('*');
    $this->db->from('renstra_sub_kegiatan');
    $this->db->where('kegiatan_id', $kegiatan_id);
    $this->db->where('deleted_at IS NULL');
    $sub_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($sub_list as &$sub) {
        // Ambil sasaran sub kegiatan
        $sasaran = $this->db
            ->select('*')
            ->from('renstra_sub_kegiatan_sasaran')
            ->where('sub_kegiatan_id', $sub['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get()
            ->result_array();
        
        foreach ($sasaran as &$sas) {
            // Ambil indikator untuk setiap sasaran
            $sas['indikators'] = $this->db
                ->select('ski.*, ai.nama as perangkat_daerah_nama')
                ->from('renstra_sub_kegiatan_indikator ski')
                ->join('akun_instansi ai', 'ai.id = ski.perangkat_daerah_id', 'left')
                ->where('ski.sub_kegiatan_id', $sub['id'])
                ->where('ski.sasaran_id', $sas['id'])
                ->where('ski.deleted_at IS NULL')
                ->order_by('ski.urutan', 'ASC')
                ->get()
                ->result_array();
        }
        $sub['sasaran_list'] = $sasaran;
    }
    
    return $sub_list;
}

/**
 * GET SASARAN DENGAN PROGRAM, OUTCOME, DAN INDIKATOR
 */
private function getRenstraSasaranWithProgramsOutcome($tujuan_id, $KodeWilayah) {
    $result = [];
    
    $this->db->select('*');
    $this->db->from('renstra_sasaran');
    $this->db->where('tujuan_id', $tujuan_id);
    $this->db->where('deleted_at IS NULL');
    $sasaran_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($sasaran_list as &$sasaran) {
        // Ambil Program dengan OUTCOME dan INDIKATOR - LANGSUNG DARI PROGRAM
        $sasaran['program_list'] = $this->getRenstraProgramWithOutcomeAndIndikator($sasaran['id']);
    }
    
    return $sasaran_list;
}

/**
 * GET PROGRAM DENGAN OUTCOME DAN INDIKATOR
 * - Digunakan untuk menampilkan data di tabel Renstra PD
 */
private function getRenstraProgramWithOutcomeAndIndikator($sasaran_id) {
    $result = [];
    
    // Ambil semua program dari sasaran
    $this->db->select('p.*');
    $this->db->from('renstra_program p');
    $this->db->where('p.sasaran_id', $sasaran_id);
    $this->db->where('p.deleted_at IS NULL');
    $program_list = $this->db->order_by('p.id', 'ASC')->get()->result_array();
    
    foreach ($program_list as &$program) {
        // ============================================================
        // AMBIL OUTCOME DARI renstra_program_outcome
        // ============================================================
        $outcomes = $this->db
            ->select('*')
            ->from('renstra_program_outcome')
            ->where('program_id', $program['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get()
            ->result_array();
        
        foreach ($outcomes as &$outcome) {
            // Ambil indikator untuk outcome ini
            $outcome['indikator_list'] = $this->db
    ->select('*')
    ->from('renstra_program_indikator')
    ->where('outcome_id', $outcome['id'])
    ->where('deleted_at IS NULL')
    ->order_by('urutan', 'ASC')
    ->get()
    ->result_array();
        }
        
        $program['outcomes'] = $outcomes;
        
        // Hitung total anggaran dari semua indikator
        $total = ['2026'=>0, '2027'=>0, '2028'=>0, '2029'=>0, '2030'=>0];
        foreach ($program['outcomes'] as $out) {
            foreach ($out['indikator_list'] as $ind) {
                $total['2026'] += (float)($ind['anggaran_2026'] ?? 0);
                $total['2027'] += (float)($ind['anggaran_2027'] ?? 0);
                $total['2028'] += (float)($ind['anggaran_2028'] ?? 0);
                $total['2029'] += (float)($ind['anggaran_2029'] ?? 0);
                $total['2030'] += (float)($ind['anggaran_2030'] ?? 0);
            }
        }
        $program['total_anggaran_2026'] = $total['2026'];
        $program['total_anggaran_2027'] = $total['2027'];
        $program['total_anggaran_2028'] = $total['2028'];
        $program['total_anggaran_2029'] = $total['2029'];
        $program['total_anggaran_2030'] = $total['2030'];
    }
    
    return $program_list;
}

private function getRenstraPDData($KodeWilayah, $instansi_id, $is_role_4, $filter_instansi_id) {
    $result = [];
    if (!$KodeWilayah) return $result;
    
    $this->db->select('*');
    $this->db->from('renstra_tujuan');
    $this->db->where('kode_wilayah', $KodeWilayah);
    $this->db->where('deleted_at IS NULL');
    if ($is_role_4 && $instansi_id) {
        $this->db->where('id_instansi', $instansi_id);
    } elseif (!empty($filter_instansi_id)) {
        $this->db->where('id_instansi', (int)$filter_instansi_id);
    }
    $tujuan_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($tujuan_list as &$tujuan) {
        $tujuan['sasaran_list'] = $this->getRenstraSasaranWithPrograms($tujuan['id'], $KodeWilayah);
    }
    return $tujuan_list;
}

private function getRenstraSasaranWithPrograms($tujuan_id, $KodeWilayah) {
    $result = [];
    
    $this->db->select('*');
    $this->db->from('renstra_sasaran');
    $this->db->where('tujuan_id', $tujuan_id);
    $this->db->where('deleted_at IS NULL');
    
    $sasaran_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($sasaran_list as &$sasaran) {
        // Ambil Program beserta indikator dan outcome
        $sasaran['program_list'] = $this->getRenstraProgramWithIndikatorAndOutcome($sasaran['id']);
    }
    
    return $sasaran_list;
}

private function getRenstraProgramWithIndikatorAndOutcome($sasaran_id) {
    $result = [];
    
    // Ambil semua program dari sasaran
    $this->db->select('p.*');
    $this->db->from('renstra_program p');
    $this->db->where('p.sasaran_id', $sasaran_id);
    $this->db->where('p.deleted_at IS NULL');
    $program_list = $this->db->order_by('p.id', 'ASC')->get()->result_array();
    
    foreach ($program_list as &$program) {
        // Ambil semua outcome untuk program ini
        $outcomes = $this->db
            ->select('*')
            ->from('program_outcome')
            ->where('program_id', $program['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get()
            ->result_array();
        
        foreach ($outcomes as &$outcome) {
            // Ambil semua indikator untuk outcome ini
            $outcome['indikator_list'] = $this->db
    ->select('*')
    ->from('renstra_program_indikator')
    ->where('outcome_id', $outcome['id'])
    ->where('deleted_at IS NULL')
    ->order_by('urutan', 'ASC')
    ->get()
    ->result_array();
        }
        
        $program['outcomes'] = $outcomes;
        
        // Hitung total anggaran dari semua indikator (untuk keperluan total pagu)
        $total = ['2026'=>0,'2027'=>0,'2028'=>0,'2029'=>0,'2030'=>0];
        foreach ($outcomes as $out) {
            foreach ($out['indikator_list'] as $ind) {
                $total['2026'] += (float)($ind['pagu_2026'] ?? 0);
                $total['2027'] += (float)($ind['pagu_2027'] ?? 0);
                $total['2028'] += (float)($ind['pagu_2028'] ?? 0);
                $total['2029'] += (float)($ind['pagu_2029'] ?? 0);
                $total['2030'] += (float)($ind['pagu_2030'] ?? 0);
            }
        }
        $program['total_anggaran_2026'] = $total['2026'];
        $program['total_anggaran_2027'] = $total['2027'];
        $program['total_anggaran_2028'] = $total['2028'];
        $program['total_anggaran_2029'] = $total['2029'];
        $program['total_anggaran_2030'] = $total['2030'];
    }
    
    return $program_list;
}

private function getRenstraKegiatanWithSub($program_id) {
    $result = [];
    
    $this->db->select('*');
    $this->db->from('renstra_kegiatan');
    $this->db->where('program_id', $program_id);
    $this->db->where('deleted_at IS NULL');
    $kegiatan_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($kegiatan_list as &$kegiatan) {
        // Ambil sub kegiatan
        $subs = $this->getRenstraSubKegiatan($kegiatan['id']);
        $kegiatan['sub_kegiatan_list'] = $subs;
        
        // ========== HITUNG TOTAL ANGGARAN DARI SUB KEGIATAN ==========
        $total = [
            'anggaran_2026' => 0,
            'anggaran_2027' => 0,
            'anggaran_2028' => 0,
            'anggaran_2029' => 0,
            'anggaran_2030' => 0
        ];
        foreach ($subs as $sub) {
            $total['anggaran_2026'] += (float)($sub['anggaran_2026'] ?? 0);
            $total['anggaran_2027'] += (float)($sub['anggaran_2027'] ?? 0);
            $total['anggaran_2028'] += (float)($sub['anggaran_2028'] ?? 0);
            $total['anggaran_2029'] += (float)($sub['anggaran_2029'] ?? 0);
            $total['anggaran_2030'] += (float)($sub['anggaran_2030'] ?? 0);
        }
        $kegiatan['total_anggaran_2026'] = $total['anggaran_2026'];
        $kegiatan['total_anggaran_2027'] = $total['anggaran_2027'];
        $kegiatan['total_anggaran_2028'] = $total['anggaran_2028'];
        $kegiatan['total_anggaran_2029'] = $total['anggaran_2029'];
        $kegiatan['total_anggaran_2030'] = $total['anggaran_2030'];
        // =============================================================
    }
    
    return $kegiatan_list;
}

private function getRenstraSubKegiatan($kegiatan_id) {
    $this->db->select('*');
    $this->db->from('renstra_sub_kegiatan');
    $this->db->where('kegiatan_id', $kegiatan_id);
    $this->db->where('deleted_at IS NULL');
    
    return $this->db->order_by('id', 'ASC')->get()->result_array();
}

/**
 * Ambil Sasaran berdasarkan Tujuan ID
 */
private function getRenstraSasaranByTujuan($tujuan_id) {
    $result = [];
    
    $this->db->select('*');
    $this->db->from('renstra_sasaran');
    $this->db->where('tujuan_id', $tujuan_id);
    $this->db->where('deleted_at IS NULL');
    
    $sasaran_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($sasaran_list as &$sasaran) {
        $sasaran['program_list'] = $this->getRenstraProgramBySasaran($sasaran['id']);
    }
    
    return $sasaran_list;
}

/**
 * Ambil Program berdasarkan Sasaran ID
 */
private function getRenstraProgramBySasaran($sasaran_id) {
    $result = [];
    
    $this->db->select('*');
    $this->db->from('renstra_program');
    $this->db->where('sasaran_id', $sasaran_id);
    $this->db->where('deleted_at IS NULL');
    
    $program_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($program_list as &$program) {
        $program['kegiatan_list'] = $this->getRenstraKegiatanByProgram($program['id']);
    }
    
    return $program_list;
}

/**
 * Ambil Kegiatan berdasarkan Program ID
 */
private function getRenstraKegiatanByProgram($program_id) {
    $result = [];
    
    $this->db->select('*');
    $this->db->from('renstra_kegiatan');
    $this->db->where('program_id', $program_id);
    $this->db->where('deleted_at IS NULL');
    
    $kegiatan_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    foreach ($kegiatan_list as &$kegiatan) {
        $kegiatan['sub_kegiatan_list'] = $this->getRenstraSubKegiatanByKegiatan($kegiatan['id']);
    }
    
    return $kegiatan_list;
}

/**
 * Ambil Sub Kegiatan berdasarkan Kegiatan ID
 */
private function getRenstraSubKegiatanByKegiatan($kegiatan_id) {
    $result = [];
    
    $this->db->select('*');
    $this->db->from('renstra_sub_kegiatan');
    $this->db->where('kegiatan_id', $kegiatan_id);
    $this->db->where('deleted_at IS NULL');
    
    $sub_list = $this->db->order_by('id', 'ASC')->get()->result_array();
    
    return $sub_list;
}

// =====================================================
// CRUD HELPER - Ambil Data POST untuk Target
// =====================================================

private function getTargetData() {
    return [
        'indikator' => trim($this->input->post('indikator', TRUE)),
        'satuan' => trim($this->input->post('satuan', TRUE)),
        'target_2025' => trim($this->input->post('target_2025', TRUE)),
        'target_2026' => trim($this->input->post('target_2026', TRUE)),
        'target_2027' => trim($this->input->post('target_2027', TRUE)),
        'target_2028' => trim($this->input->post('target_2028', TRUE)),
        'target_2029' => trim($this->input->post('target_2029', TRUE)),
        'target_2030' => trim($this->input->post('target_2030', TRUE))
    ];
}

private function getAnggaranData() {
    return [
        'anggaran_2025' => trim($this->input->post('anggaran_2025', TRUE)),
        'anggaran_2026' => trim($this->input->post('anggaran_2026', TRUE)),
        'anggaran_2027' => trim($this->input->post('anggaran_2027', TRUE)),
        'anggaran_2028' => trim($this->input->post('anggaran_2028', TRUE)),
        'anggaran_2029' => trim($this->input->post('anggaran_2029', TRUE)),
        'anggaran_2030' => trim($this->input->post('anggaran_2030', TRUE))
    ];
}

// =====================================================
// CRUD: TUJUAN RENSTRA PD
// =====================================================

public function tambahRenstraTujuanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    if (!$KodeWilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih']);
        return;
    }
    if (!$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Data instansi tidak ditemukan!']);
        return;
    }
    
    $sasaran_rpjmd_id = $this->input->post('sasaran_rpjmd_id', TRUE) ?: null;
    $uraian = trim($this->input->post('uraian', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE) ?: null;
    
    if (empty($uraian)) {
        echo json_encode(['status' => 'error', 'message' => 'Uraian Tujuan wajib diisi!']);
        return;
    }
    
    // Parse Indikators
    $indikators_raw = $this->input->post('indikators');
    if (is_string($indikators_raw)) {
        $indikators_data = json_decode($indikators_raw, true) ?: [];
    } elseif (is_array($indikators_raw)) {
        $indikators_data = $indikators_raw;
    } else {
        $indikators_data = [];
    }

    // Fallback if single indicator sent
    if (empty($indikators_data) && !empty(trim($this->input->post('indikator', TRUE)))) {
        $indikators_data[] = [
            'indikator'    => trim($this->input->post('indikator', TRUE)),
            'satuan'       => trim($this->input->post('satuan', TRUE)),
            'kondisi_awal' => trim($this->input->post('kondisi_awal', TRUE)),
            'target_2026'  => trim($this->input->post('target_2026', TRUE)),
            'target_2027'  => trim($this->input->post('target_2027', TRUE)),
            'target_2028'  => trim($this->input->post('target_2028', TRUE)),
            'target_2029'  => trim($this->input->post('target_2029', TRUE)),
            'target_2030'  => trim($this->input->post('target_2030', TRUE)),
        ];
    }
    
    $first_ind = $indikators_data[0] ?? [];

    $data = [
        'kode_wilayah'   => $KodeWilayah,
        'id_instansi'    => $instansi_id,
        'sasaran_rpjmd_id' => $sasaran_rpjmd_id,
        'uraian'         => $uraian,
        'bidang_id'      => $bidang_id,
        'indikator'      => $first_ind['indikator'] ?? '',
        'satuan'         => $first_ind['satuan'] ?? '',
        'kondisi_awal'   => $first_ind['kondisi_awal'] ?? '',
        'target_2026'    => $first_ind['target_2026'] ?? '',
        'target_2027'    => $first_ind['target_2027'] ?? '',
        'target_2028'    => $first_ind['target_2028'] ?? '',
        'target_2029'    => $first_ind['target_2029'] ?? '',
        'target_2030'    => $first_ind['target_2030'] ?? '',
        'created_at'     => date('Y-m-d H:i:s'),
        'updated_at'     => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('renstra_tujuan', $data);
    $insert_id = $this->db->insert_id();
    if ($insert_id) {
        // Insert into renstra_tujuan_indikator
        $urutan = 10;
        foreach ($indikators_data as $ind) {
            $indText = trim($ind['indikator'] ?? '');
            if (empty($indText)) continue;
            $this->db->insert('renstra_tujuan_indikator', [
                'tujuan_id'          => $insert_id,
                'perangkat_daerah_id'=> $instansi_id,
                'indikator'          => $indText,
                'satuan'             => trim($ind['satuan'] ?? ''),
                'kondisi_awal'       => trim($ind['kondisi_awal'] ?? ''),
                'target_2026'        => trim($ind['target_2026'] ?? ''),
                'target_2027'        => trim($ind['target_2027'] ?? ''),
                'target_2028'        => trim($ind['target_2028'] ?? ''),
                'target_2029'        => trim($ind['target_2029'] ?? ''),
                'target_2030'        => trim($ind['target_2030'] ?? ''),
                'urutan'             => $urutan,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s')
            ]);
            $urutan += 10;
        }

        echo json_encode(['status' => 'success', 'message' => 'Tujuan berhasil ditambahkan', 'data' => ['id' => $insert_id]]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
    }
    exit;
}

public function editRenstraTujuanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    $instansi_id = $this->get_instansi_id();
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_tujuan')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
        return;
    }
    
    $sasaran_rpjmd_id = $this->input->post('sasaran_rpjmd_id', TRUE) ?: null;
    $uraian = trim($this->input->post('uraian', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE) ?: null;
    
    if (empty($uraian)) {
        echo json_encode(['status' => 'error', 'message' => 'Uraian Tujuan wajib diisi!']);
        return;
    }
    
    // Parse Indikators
    $indikators_raw = $this->input->post('indikators');
    if (is_string($indikators_raw)) {
        $indikators_data = json_decode($indikators_raw, true) ?: [];
    } elseif (is_array($indikators_raw)) {
        $indikators_data = $indikators_raw;
    } else {
        $indikators_data = [];
    }

    if (empty($indikators_data) && !empty(trim($this->input->post('indikator', TRUE)))) {
        $indikators_data[] = [
            'indikator'    => trim($this->input->post('indikator', TRUE)),
            'satuan'       => trim($this->input->post('satuan', TRUE)),
            'kondisi_awal' => trim($this->input->post('kondisi_awal', TRUE)),
            'target_2026'  => trim($this->input->post('target_2026', TRUE)),
            'target_2027'  => trim($this->input->post('target_2027', TRUE)),
            'target_2028'  => trim($this->input->post('target_2028', TRUE)),
            'target_2029'  => trim($this->input->post('target_2029', TRUE)),
            'target_2030'  => trim($this->input->post('target_2030', TRUE)),
        ];
    }
    
    $first_ind = $indikators_data[0] ?? [];

    $data = [
        'sasaran_rpjmd_id' => $sasaran_rpjmd_id,
        'uraian'         => $uraian,
        'bidang_id'      => $bidang_id,
        'indikator'      => $first_ind['indikator'] ?? '',
        'satuan'         => $first_ind['satuan'] ?? '',
        'kondisi_awal'   => $first_ind['kondisi_awal'] ?? '',
        'target_2026'    => $first_ind['target_2026'] ?? '',
        'target_2027'    => $first_ind['target_2027'] ?? '',
        'target_2028'    => $first_ind['target_2028'] ?? '',
        'target_2029'    => $first_ind['target_2029'] ?? '',
        'target_2030'    => $first_ind['target_2030'] ?? '',
        'updated_at'     => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id)->update('renstra_tujuan', $data);

    // Update renstra_tujuan_indikator
    $this->db->where('tujuan_id', $id)->update('renstra_tujuan_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
    
    $urutan = 10;
    foreach ($indikators_data as $ind) {
        $indText = trim($ind['indikator'] ?? '');
        if (empty($indText)) continue;
        $this->db->insert('renstra_tujuan_indikator', [
            'tujuan_id'          => $id,
            'perangkat_daerah_id'=> $instansi_id,
            'indikator'          => $indText,
            'satuan'             => trim($ind['satuan'] ?? ''),
            'kondisi_awal'       => trim($ind['kondisi_awal'] ?? ''),
            'target_2026'        => trim($ind['target_2026'] ?? ''),
            'target_2027'        => trim($ind['target_2027'] ?? ''),
            'target_2028'        => trim($ind['target_2028'] ?? ''),
            'target_2029'        => trim($ind['target_2029'] ?? ''),
            'target_2030'        => trim($ind['target_2030'] ?? ''),
            'urutan'             => $urutan,
            'created_at'         => date('Y-m-d H:i:s'),
            'updated_at'         => date('Y-m-d H:i:s')
        ]);
        $urutan += 10;
    }

    echo json_encode(['status' => 'success', 'message' => 'Tujuan berhasil diperbarui']);
    exit;
}

public function hapusRenstraTujuanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    $instansi_id = $this->get_instansi_id();
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_tujuan')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    if ($existing->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
        return;
    }
    $this->db->where('id', $id)->update('renstra_tujuan', ['deleted_at' => date('Y-m-d H:i:s')]);
    $this->db->where('tujuan_id', $id)->update('renstra_tujuan_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo json_encode(['status' => 'success', 'message' => 'Tujuan berhasil dihapus']);
    exit;
}

public function getRenstraTujuanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    $data = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_tujuan')->row_array();
    if ($data) {
        // Ambil Indikators
        $indikators = $this->db
            ->select('*')
            ->from('renstra_tujuan_indikator')
            ->where('tujuan_id', $id)
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get()
            ->result_array();
            
        // Fallback jika belum ada di tabel indikator
        if (empty($indikators) && !empty($data['indikator'])) {
            $indikators[] = [
                'id'           => 0,
                'indikator'    => $data['indikator'],
                'satuan'       => $data['satuan'] ?? '',
                'kondisi_awal' => $data['kondisi_awal'] ?? '',
                'target_2026'  => $data['target_2026'] ?? '',
                'target_2027'  => $data['target_2027'] ?? '',
                'target_2028'  => $data['target_2028'] ?? '',
                'target_2029'  => $data['target_2029'] ?? '',
                'target_2030'  => $data['target_2030'] ?? ''
            ];
        }
        $data['indikators'] = $indikators;
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    exit;
}

// =====================================================
// CRUD: SASARAN RENSTRA PD
// =====================================================
public function tambahRenstraSasaranPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    $tujuan_id = (int)$this->input->post('tujuan_id', TRUE);
    $uraian = trim($this->input->post('uraian', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE);
    $instansi_id = $this->get_instansi_id();
    
    if (!$tujuan_id) {
        echo json_encode(['status' => 'error', 'message' => 'Tujuan tidak valid!']);
        return;
    }
    if (empty($uraian)) {
        echo json_encode(['status' => 'error', 'message' => 'Uraian Sasaran wajib diisi!']);
        return;
    }
    
    // Parse Indikators
    $indikators_raw = $this->input->post('indikators');
    if (is_string($indikators_raw)) {
        $indikators_data = json_decode($indikators_raw, true) ?: [];
    } elseif (is_array($indikators_raw)) {
        $indikators_data = $indikators_raw;
    } else {
        $indikators_data = [];
    }

    if (empty($indikators_data) && !empty(trim($this->input->post('indikator', TRUE)))) {
        $indikators_data[] = [
            'indikator'    => trim($this->input->post('indikator', TRUE)),
            'satuan'       => trim($this->input->post('satuan', TRUE)),
            'kondisi_awal' => trim($this->input->post('kondisi_awal', TRUE)),
            'target_2026'  => trim($this->input->post('target_2026', TRUE)),
            'target_2027'  => trim($this->input->post('target_2027', TRUE)),
            'target_2028'  => trim($this->input->post('target_2028', TRUE)),
            'target_2029'  => trim($this->input->post('target_2029', TRUE)),
            'target_2030'  => trim($this->input->post('target_2030', TRUE)),
        ];
    }
    
    $first_ind = $indikators_data[0] ?? [];

    $data = [
        'tujuan_id'      => $tujuan_id,
        'uraian'         => $uraian,
        'bidang_id'      => $bidang_id,
        'indikator'      => $first_ind['indikator'] ?? '',
        'satuan'         => $first_ind['satuan'] ?? '',
        'kondisi_awal'   => $first_ind['kondisi_awal'] ?? '',
        'target_2026'    => $first_ind['target_2026'] ?? '',
        'target_2027'    => $first_ind['target_2027'] ?? '',
        'target_2028'    => $first_ind['target_2028'] ?? '',
        'target_2029'    => $first_ind['target_2029'] ?? '',
        'target_2030'    => $first_ind['target_2030'] ?? '',
        'created_at'     => date('Y-m-d H:i:s'),
        'updated_at'     => date('Y-m-d H:i:s')
    ];
    $this->db->insert('renstra_sasaran', $data);
    $insert_id = $this->db->insert_id();
    if ($insert_id) {
        $urutan = 10;
        foreach ($indikators_data as $ind) {
            $indText = trim($ind['indikator'] ?? '');
            if (empty($indText)) continue;
            $this->db->insert('renstra_sasaran_indikator', [
                'sasaran_id'         => $insert_id,
                'perangkat_daerah_id'=> $instansi_id,
                'indikator'          => $indText,
                'satuan'             => trim($ind['satuan'] ?? ''),
                'kondisi_awal'       => trim($ind['kondisi_awal'] ?? ''),
                'target_2026'        => trim($ind['target_2026'] ?? ''),
                'target_2027'        => trim($ind['target_2027'] ?? ''),
                'target_2028'        => trim($ind['target_2028'] ?? ''),
                'target_2029'        => trim($ind['target_2029'] ?? ''),
                'target_2030'        => trim($ind['target_2030'] ?? ''),
                'urutan'             => $urutan,
                'created_at'         => date('Y-m-d H:i:s'),
                'updated_at'         => date('Y-m-d H:i:s')
            ]);
            $urutan += 10;
        }

        echo json_encode(['status' => 'success', 'message' => 'Sasaran berhasil ditambahkan', 'data' => ['id' => $insert_id]]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data!']);
    }
    exit;
}

public function editRenstraSasaranPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    $instansi_id = $this->get_instansi_id();
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_sasaran')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    $tujuan = $this->db->where('id', $existing->tujuan_id)->where('deleted_at IS NULL')->get('renstra_tujuan')->row();
    if (!$tujuan || $tujuan->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
        return;
    }
    $uraian = trim($this->input->post('uraian', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE);
    if (empty($uraian)) {
        echo json_encode(['status' => 'error', 'message' => 'Uraian Sasaran wajib diisi!']);
        return;
    }
    
    // Parse Indikators
    $indikators_raw = $this->input->post('indikators');
    if (is_string($indikators_raw)) {
        $indikators_data = json_decode($indikators_raw, true) ?: [];
    } elseif (is_array($indikators_raw)) {
        $indikators_data = $indikators_raw;
    } else {
        $indikators_data = [];
    }

    if (empty($indikators_data) && !empty(trim($this->input->post('indikator', TRUE)))) {
        $indikators_data[] = [
            'indikator'    => trim($this->input->post('indikator', TRUE)),
            'satuan'       => trim($this->input->post('satuan', TRUE)),
            'kondisi_awal' => trim($this->input->post('kondisi_awal', TRUE)),
            'target_2026'  => trim($this->input->post('target_2026', TRUE)),
            'target_2027'  => trim($this->input->post('target_2027', TRUE)),
            'target_2028'  => trim($this->input->post('target_2028', TRUE)),
            'target_2029'  => trim($this->input->post('target_2029', TRUE)),
            'target_2030'  => trim($this->input->post('target_2030', TRUE)),
        ];
    }
    
    $first_ind = $indikators_data[0] ?? [];

    $data = [
        'uraian'         => $uraian,
        'bidang_id'      => $bidang_id,
        'indikator'      => $first_ind['indikator'] ?? '',
        'satuan'         => $first_ind['satuan'] ?? '',
        'kondisi_awal'   => $first_ind['kondisi_awal'] ?? '',
        'target_2026'    => $first_ind['target_2026'] ?? '',
        'target_2027'    => $first_ind['target_2027'] ?? '',
        'target_2028'    => $first_ind['target_2028'] ?? '',
        'target_2029'    => $first_ind['target_2029'] ?? '',
        'target_2030'    => $first_ind['target_2030'] ?? '',
        'updated_at'     => date('Y-m-d H:i:s')
    ];
    $this->db->where('id', $id)->update('renstra_sasaran', $data);

    // Update renstra_sasaran_indikator
    $this->db->where('sasaran_id', $id)->update('renstra_sasaran_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
    
    $urutan = 10;
    foreach ($indikators_data as $ind) {
        $indText = trim($ind['indikator'] ?? '');
        if (empty($indText)) continue;
        $this->db->insert('renstra_sasaran_indikator', [
            'sasaran_id'         => $id,
            'perangkat_daerah_id'=> $instansi_id,
            'indikator'          => $indText,
            'satuan'             => trim($ind['satuan'] ?? ''),
            'kondisi_awal'       => trim($ind['kondisi_awal'] ?? ''),
            'target_2026'        => trim($ind['target_2026'] ?? ''),
            'target_2027'        => trim($ind['target_2027'] ?? ''),
            'target_2028'        => trim($ind['target_2028'] ?? ''),
            'target_2029'        => trim($ind['target_2029'] ?? ''),
            'target_2030'        => trim($ind['target_2030'] ?? ''),
            'urutan'             => $urutan,
            'created_at'         => date('Y-m-d H:i:s'),
            'updated_at'         => date('Y-m-d H:i:s')
        ]);
        $urutan += 10;
    }

    echo json_encode(['status' => 'success', 'message' => 'Sasaran berhasil diperbarui']);
    exit;
}

public function hapusRenstraSasaranPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    $instansi_id = $this->get_instansi_id();
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_sasaran')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    $tujuan = $this->db->where('id', $existing->tujuan_id)->where('deleted_at IS NULL')->get('renstra_tujuan')->row();
    if (!$tujuan || $tujuan->id_instansi != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
        return;
    }
    $this->db->where('id', $id)->update('renstra_sasaran', ['deleted_at' => date('Y-m-d H:i:s')]);
    $this->db->where('sasaran_id', $id)->update('renstra_sasaran_indikator', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo json_encode(['status' => 'success', 'message' => 'Sasaran berhasil dihapus']);
    exit;
}

public function getRenstraSasaranPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    $data = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_sasaran')->row_array();
    if ($data) {
        $indikators = $this->db
            ->select('*')
            ->from('renstra_sasaran_indikator')
            ->where('sasaran_id', $id)
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get()
            ->result_array();
            
        if (empty($indikators) && !empty($data['indikator'])) {
            $indikators[] = [
                'id'           => 0,
                'indikator'    => $data['indikator'],
                'satuan'       => $data['satuan'] ?? '',
                'kondisi_awal' => $data['kondisi_awal'] ?? '',
                'target_2026'  => $data['target_2026'] ?? '',
                'target_2027'  => $data['target_2027'] ?? '',
                'target_2028'  => $data['target_2028'] ?? '',
                'target_2029'  => $data['target_2029'] ?? '',
                'target_2030'  => $data['target_2030'] ?? ''
            ];
        }
        $data['indikators'] = $indikators;
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    exit;
}

public function tambahRenstraProgramPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    
    $sasaran_id = (int)$this->input->post('sasaran_id', TRUE);
    $nama = trim($this->input->post('nama', TRUE));
    $kode_program = trim($this->input->post('kode_program', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE);
    
    // Ambil data outcomes dari POST (JSON)
    $outcomes_data = $this->input->post('outcomes', TRUE);
    
    if (!$sasaran_id) {
        echo json_encode(['status' => 'error', 'message' => 'Sasaran tidak valid!']);
        return;
    }
    if (empty($nama)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Program wajib diisi!']);
        return;
    }
    
    // Validasi: minimal ada 1 outcome dengan indikator
    $validOutcomes = 0;
    $totalIndikator = 0;
    if (!empty($outcomes_data) && is_array($outcomes_data)) {
        foreach ($outcomes_data as $out) {
            $outcomeText = trim($out['outcome_text'] ?? '');
            if (!empty($outcomeText)) {
                $validOutcomes++;
                $indikators = $out['indikators'] ?? [];
                foreach ($indikators as $ind) {
                    if (!empty(trim($ind['indikator'] ?? ''))) {
                        $totalIndikator++;
                    }
                }
            }
        }
    }
    
    if ($validOutcomes == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Outcome!']);
        return;
    }
    if ($totalIndikator == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Setiap Outcome minimal memiliki 1 Indikator!']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // ============================================================
        // INSERT PROGRAM KE renstra_program
        // ============================================================
        $data = [
            'sasaran_id' => $sasaran_id,
            'nama' => $nama,
            'kode_program' => $kode_program ?: null,
            'bidang_id' => $bidang_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('renstra_program', $data);
        $program_id = $this->db->insert_id();
        
        if (!$program_id) {
            throw new Exception('Gagal menyimpan program');
        }
        
        // ============================================================
        // PROSES OUTCOMES - SIMPAN KE renstra_program_outcome
        // ============================================================
        $urutanOutcome = 10;
        foreach ($outcomes_data as $out) {
            $outcomeText = trim($out['outcome_text'] ?? '');
            if (empty($outcomeText)) continue;
            
            // Insert Outcome ke renstra_program_outcome
            $outcomeData = [
                'program_id' => $program_id,
                'outcome_text' => $outcomeText,
                'urutan' => $urutanOutcome,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('renstra_program_outcome', $outcomeData);
            $outcome_id = $this->db->insert_id();
            $urutanOutcome += 10;
            
            // ============================================================
            // PROSES INDIKATOR - SIMPAN KE renstra_program_indikator
            // ============================================================
            $indikators = $out['indikators'] ?? [];
            $urutanInd = 10;
            foreach ($indikators as $ind) {
                if (empty(trim($ind['indikator'] ?? ''))) continue;
                
                $indData = [
                    'program_id' => $program_id,
                    'outcome_id' => $outcome_id,
                    'indikator' => trim($ind['indikator']),
                    'satuan' => trim($ind['satuan'] ?? ''),
                    'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                    'target_2026' => trim($ind['target_2026'] ?? ''),
                    'anggaran_2026' => $this->parseRupiah($ind['anggaran_2026'] ?? null),
                    'target_2027' => trim($ind['target_2027'] ?? ''),
                    'anggaran_2027' => $this->parseRupiah($ind['anggaran_2027'] ?? null),
                    'target_2028' => trim($ind['target_2028'] ?? ''),
                    'anggaran_2028' => $this->parseRupiah($ind['anggaran_2028'] ?? null),
                    'target_2029' => trim($ind['target_2029'] ?? ''),
                    'anggaran_2029' => $this->parseRupiah($ind['anggaran_2029'] ?? null),
                    'target_2030' => trim($ind['target_2030'] ?? ''),
                    'anggaran_2030' => $this->parseRupiah($ind['anggaran_2030'] ?? null),
                    'urutan' => $urutanInd,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('renstra_program_indikator', $indData);
                $urutanInd += 10;
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data!');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Program berhasil ditambahkan!',
            'data' => ['id' => $program_id]
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

public function editRenstraProgramPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $nama = trim($this->input->post('nama', TRUE));
    $kode_program = trim($this->input->post('kode_program', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE);
    $outcomes_data = $this->input->post('outcomes', TRUE);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    if (empty($nama)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Program wajib diisi!']);
        return;
    }
    
    // Cek kepemilikan data
    $existing = $this->db->where('id', $id)->get('renstra_program')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    
    // Cek kepemilikan melalui sasaran -> tujuan
    $sasaran = $this->db->where('id', $existing->sasaran_id)->get('renstra_sasaran')->row();
    if ($sasaran) {
        $tujuan = $this->db->where('id', $sasaran->tujuan_id)->get('renstra_tujuan')->row();
        if (!$tujuan || $tujuan->id_instansi != $instansi_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
            return;
        }
    }
    
    // Validasi outcome
    $validOutcomes = 0;
    $totalIndikator = 0;
    if (!empty($outcomes_data) && is_array($outcomes_data)) {
        foreach ($outcomes_data as $out) {
            $outcomeText = trim($out['outcome_text'] ?? '');
            if (!empty($outcomeText)) {
                $validOutcomes++;
                $indikators = $out['indikators'] ?? [];
                foreach ($indikators as $ind) {
                    if (!empty(trim($ind['indikator'] ?? ''))) {
                        $totalIndikator++;
                    }
                }
            }
        }
    }
    
    if ($validOutcomes == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Outcome!']);
        return;
    }
    if ($totalIndikator == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Setiap Outcome minimal memiliki 1 Indikator!']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // ============================================================
        // 1. UPDATE PROGRAM
        // ============================================================
        $this->db->where('id', $id)->update('renstra_program', [
            'nama' => $nama,
            'kode_program' => $kode_program ?: null,
            'bidang_id' => $bidang_id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // ============================================================
        // 2. AMBIL SEMUA ID OUTCOME LAMA UNTUK DICEK
        // ============================================================
        $oldOutcomes = $this->db
            ->select('id')
            ->where('program_id', $id)
            ->get('renstra_program_outcome')
            ->result_array();
        $oldOutcomeIds = array_column($oldOutcomes, 'id');
        
        // ============================================================
        // 3. UPDATE/INSERT OUTCOME
        // ============================================================
        $newOutcomeIds = [];
        $urutanOutcome = 10;
        
        foreach ($outcomes_data as $out) {
            $outcomeText = trim($out['outcome_text'] ?? '');
            if (empty($outcomeText)) continue;
            
            $outcome_id = isset($out['id']) && !empty($out['id']) ? (int)$out['id'] : 0;
            
            if ($outcome_id > 0 && in_array($outcome_id, $oldOutcomeIds)) {
                // ✅ UPDATE outcome yang sudah ada
                $this->db->where('id', $outcome_id)
                         ->where('program_id', $id)
                         ->update('renstra_program_outcome', [
                             'outcome_text' => $outcomeText,
                             'urutan' => $urutanOutcome,
                             'updated_at' => date('Y-m-d H:i:s')
                         ]);
                $newOutcomeIds[] = $outcome_id;
            } else {
                // ✅ INSERT outcome baru
                $this->db->insert('renstra_program_outcome', [
                    'program_id' => $id,
                    'outcome_text' => $outcomeText,
                    'urutan' => $urutanOutcome,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $outcome_id = $this->db->insert_id();
                $newOutcomeIds[] = $outcome_id;
            }
            
            // ============================================================
            // 4. AMBIL SEMUA ID INDIKATOR LAMA UNTUK OUTCOME INI
            // ============================================================
            $oldIndikators = $this->db
                ->select('id')
                ->where('program_id', $id)
                ->where('outcome_id', $outcome_id)
                ->get('renstra_program_indikator')
                ->result_array();
            $oldIndikatorIds = array_column($oldIndikators, 'id');
            
            // ============================================================
            // 5. UPDATE/INSERT INDIKATOR
            // ============================================================
            $indikators = $out['indikators'] ?? [];
            $newIndikatorIds = [];
            $urutanInd = 10;
            
            foreach ($indikators as $ind) {
                if (empty(trim($ind['indikator'] ?? ''))) continue;
                
                $ind_id = isset($ind['id']) && !empty($ind['id']) ? (int)$ind['id'] : 0;
                
                $indData = [
                    'program_id' => $id,
                    'outcome_id' => $outcome_id,
                    'indikator' => trim($ind['indikator']),
                    'satuan' => trim($ind['satuan'] ?? ''),
                    'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                    'target_2026' => trim($ind['target_2026'] ?? ''),
                    'anggaran_2026' => $this->parseRupiah($ind['anggaran_2026'] ?? null),
                    'target_2027' => trim($ind['target_2027'] ?? ''),
                    'anggaran_2027' => $this->parseRupiah($ind['anggaran_2027'] ?? null),
                    'target_2028' => trim($ind['target_2028'] ?? ''),
                    'anggaran_2028' => $this->parseRupiah($ind['anggaran_2028'] ?? null),
                    'target_2029' => trim($ind['target_2029'] ?? ''),
                    'anggaran_2029' => $this->parseRupiah($ind['anggaran_2029'] ?? null),
                    'target_2030' => trim($ind['target_2030'] ?? ''),
                    'anggaran_2030' => $this->parseRupiah($ind['anggaran_2030'] ?? null),
                    'urutan' => $urutanInd,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                if ($ind_id > 0 && in_array($ind_id, $oldIndikatorIds)) {
                    // ✅ UPDATE indikator yang sudah ada
                    $this->db->where('id', $ind_id)
                             ->where('program_id', $id)
                             ->update('renstra_program_indikator', $indData);
                    $newIndikatorIds[] = $ind_id;
                } else {
                    // ✅ INSERT indikator baru
                    $indData['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('renstra_program_indikator', $indData);
                    $newIndikatorIds[] = $this->db->insert_id();
                }
                $urutanInd += 10;
            }
            
            // ============================================================
            // 6. HAPUS INDIKATOR YANG TIDAK ADA DI DATA BARU (hard delete)
            // ============================================================
            $indikatorToDelete = array_diff($oldIndikatorIds, $newIndikatorIds);
            if (!empty($indikatorToDelete)) {
                $this->db->where_in('id', $indikatorToDelete)
                        ->where('program_id', $id)
                        ->delete('renstra_program_indikator');
            }
            }

            // ============================================================
            // 7. HAPUS OUTCOME YANG TIDAK ADA DI DATA BARU (hard delete)
            // ============================================================
            $outcomeToDelete = array_diff($oldOutcomeIds, $newOutcomeIds);
            if (!empty($outcomeToDelete)) {
                // Hapus outcome
                $this->db->where_in('id', $outcomeToDelete)
                        ->where('program_id', $id)
                        ->delete('renstra_program_outcome');
                
                // Hapus indikator dari outcome yang dihapus
                $this->db->where_in('outcome_id', $outcomeToDelete)
                        ->where('program_id', $id)
                        ->delete('renstra_program_indikator');
            }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data!');
        }
        
        echo json_encode(['status' => 'success', 'message' => 'Program berhasil diperbarui!']);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

public function hapusRenstraProgramPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $instansi_id = $this->get_instansi_id();
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    // Cek kepemilikan data
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_program')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    
    // Cek kepemilikan melalui sasaran -> tujuan
    $sasaran = $this->db->where('id', $existing->sasaran_id)->where('deleted_at IS NULL')->get('renstra_sasaran')->row();
    if ($sasaran) {
        $tujuan = $this->db->where('id', $sasaran->tujuan_id)->where('deleted_at IS NULL')->get('renstra_tujuan')->row();
        if (!$tujuan || $tujuan->id_instansi != $instansi_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
            return;
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
        return;
    }
    
    $now = date('Y-m-d H:i:s');
    
    // Soft delete program
    $this->db->where('id', $id)->update('renstra_program', ['deleted_at' => $now]);
    
    // Soft delete semua outcome
    $this->db->where('program_id', $id)->update('renstra_program_outcome', ['deleted_at' => $now]);
    
    // Soft delete semua indikator
    $this->db->where('program_id', $id)->update('renstra_program_indikator', ['deleted_at' => $now]);
    
    echo json_encode(['status' => 'success', 'message' => 'Program berhasil dihapus']);
    exit;
}

/**
 * GET PROGRAM RENSTRA BY ID (dengan outcomes dan indikators)
 */
public function getRenstraProgramById() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $kodeWilayah = $this->get_kode_wilayah();
    
    if ($id <= 0 || empty($kodeWilayah)) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
        return;
    }
    
    // Ambil program
    $program = $this->db
        ->select('p.*')
        ->from('renstra_program p')
        ->where('p.id', $id)
        ->where('p.deleted_at IS NULL')
        ->get()
        ->row_array();
    
    if (!$program) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    // ============================================================
    // AMBIL OUTCOME DARI renstra_program_outcome
    // ============================================================
    $outcomes = $this->db
        ->select('*')
        ->where('program_id', $id)
        ->where('deleted_at IS NULL')
        ->order_by('urutan', 'ASC')
        ->get('renstra_program_outcome')
        ->result_array();
    
    foreach ($outcomes as &$out) {
        // Ambil indikator untuk setiap outcome
        $out['indikators'] = $this->db
            ->select('*, id as indikator_id')
            ->where('outcome_id', $out['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get('renstra_program_indikator')
            ->result_array();
    }
    $program['outcomes'] = $outcomes;
    
    echo json_encode(['status' => 'success', 'data' => $program]);
}

public function getRenstraProgramPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    // Ambil data program
    $program = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_program')->row_array();
    
    if ($program) {
        // Ambil semua indikator dari tabel renstra_program_indikator
        $program['indikator_list'] = $this->db
            ->where('program_id', $id)
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get('renstra_program_indikator')
            ->result_array();
        
        // Ambil outcome dari program_data
        if (!empty($program['kode_program'])) {
            $program_data = $this->db
                ->select('outcome, nama_program')
                ->where('kode_program', $program['kode_program'])
                ->where('deleted_at IS NULL')
                ->get('program_data')
                ->row_array();
            if ($program_data) {
                $program['outcome'] = $program_data['outcome'] ?? '';
                if (empty($program['nama']) && !empty($program_data['nama_program'])) {
                    $program['nama'] = $program_data['nama_program'];
                }
            }
        }
        
        // Format anggaran untuk setiap indikator
        foreach ($program['indikator_list'] as &$ind) {
            foreach (['2026','2027','2028','2029','2030'] as $thn) {
                $field = 'anggaran_'.$thn;
                if (!empty($ind[$field])) {
                    $ind[$field.'_formatted'] = 'Rp ' . number_format((float)$ind[$field], 0, ',', '.');
                } else {
                    $ind[$field.'_formatted'] = '';
                }
            }
        }
        
        echo json_encode(['status' => 'success', 'data' => $program]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    exit;
}



// =====================================================
// CRUD: KEGIATAN RENSTRA PD
// =====================================================
public function tambahRenstraKegiatanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    
    $program_id = (int)$this->input->post('program_id', TRUE);
    $nama = trim($this->input->post('nama', TRUE));
    $kode_nomenklatur = trim($this->input->post('kode_nomenklatur', TRUE)); // ✅ TAMBAHKAN
    $bidang_id = $this->input->post('bidang_id', TRUE);
    $sasaran_data = $this->input->post('sasaran_data', TRUE); // JSON dari frontend
    
    if (!$program_id) {
        echo json_encode(['status' => 'error', 'message' => 'Program tidak valid!']);
        return;
    }
    if (empty($nama)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Kegiatan wajib diisi!']);
        return;
    }
    
    $sasaran_array = json_decode($sasaran_data, true);
    if (!is_array($sasaran_array) || empty($sasaran_array)) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Sasaran dengan Indikator!']);
        return;
    }
    
    // Validasi: setiap sasaran minimal punya 1 indikator
    $validSasaran = 0;
    $totalIndikator = 0;
    foreach ($sasaran_array as $sas) {
        $sasaranText = trim($sas['sasaran_text'] ?? '');
        if (!empty($sasaranText)) {
            $validSasaran++;
            $indikators = $sas['indikators'] ?? [];
            foreach ($indikators as $ind) {
                if (!empty(trim($ind['indikator'] ?? ''))) {
                    $totalIndikator++;
                }
            }
        }
    }
    
    if ($validSasaran == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Sasaran!']);
        return;
    }
    if ($totalIndikator == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Setiap Sasaran minimal memiliki 1 Indikator!']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // Insert Kegiatan dengan kode_nomenklatur
        $data = [
            'program_id' => $program_id,
            'nama' => $nama,
            'kode_nomenklatur' => $kode_nomenklatur ?: null, // ✅ TAMBAHKAN
            'bidang_id' => $bidang_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('renstra_kegiatan', $data);
        $kegiatan_id = $this->db->insert_id();
        
        if (!$kegiatan_id) {
            throw new Exception('Gagal menyimpan kegiatan');
        }
        
        // Proses Sasaran & Indikator
        $urutanSasaran = 10;
        foreach ($sasaran_array as $sas) {
            $sasaranText = trim($sas['sasaran_text'] ?? '');
            if (empty($sasaranText)) continue;
            
            // Insert Sasaran ke renstra_kegiatan_sasaran
            $sasaranData = [
                'kegiatan_id' => $kegiatan_id,
                'sasaran_text' => $sasaranText,
                'urutan' => $urutanSasaran,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('renstra_kegiatan_sasaran', $sasaranData);
            $sasaran_id = $this->db->insert_id();
            $urutanSasaran += 10;
            
            // Proses Indikator untuk sasaran ini
            $indikators = $sas['indikators'] ?? [];
            $urutanInd = 10;
            foreach ($indikators as $ind) {
                if (empty(trim($ind['indikator'] ?? ''))) continue;
                
                $indData = [
                    'kegiatan_id' => $kegiatan_id,
                    'sasaran_id' => $sasaran_id,
                    'indikator' => trim($ind['indikator']),
                    'satuan' => trim($ind['satuan'] ?? ''),
                    'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                    'target_2026' => trim($ind['target_2026'] ?? ''),
                    'anggaran_2026' => $this->parseRupiah($ind['anggaran_2026'] ?? null),
                    'target_2027' => trim($ind['target_2027'] ?? ''),
                    'anggaran_2027' => $this->parseRupiah($ind['anggaran_2027'] ?? null),
                    'target_2028' => trim($ind['target_2028'] ?? ''),
                    'anggaran_2028' => $this->parseRupiah($ind['anggaran_2028'] ?? null),
                    'target_2029' => trim($ind['target_2029'] ?? ''),
                    'anggaran_2029' => $this->parseRupiah($ind['anggaran_2029'] ?? null),
                    'target_2030' => trim($ind['target_2030'] ?? ''),
                    'anggaran_2030' => $this->parseRupiah($ind['anggaran_2030'] ?? null),
                    'urutan' => $urutanInd,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('renstra_kegiatan_indikator', $indData);
                $urutanInd += 10;
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data!');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Kegiatan berhasil ditambahkan!',
            'data' => ['id' => $kegiatan_id]
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

/**
 * EDIT KEGIATAN DENGAN MULTIPLE SASARAN & INDIKATOR
 */
public function editRenstraKegiatanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $nama = trim($this->input->post('nama', TRUE));
    $kode_nomenklatur = trim($this->input->post('kode_nomenklatur', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE);
    $sasaran_data = $this->input->post('sasaran_data', TRUE);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    // Cek kepemilikan data (tanpa deleted_at IS NULL)
    $existing = $this->db->where('id', $id)->get('renstra_kegiatan')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    
    // Cek kepemilikan melalui program -> sasaran -> tujuan (tanpa deleted_at IS NULL)
    $program = $this->db->where('id', $existing->program_id)->get('renstra_program')->row();
    if ($program) {
        $sasaran = $this->db->where('id', $program->sasaran_id)->get('renstra_sasaran')->row();
        if ($sasaran) {
            $tujuan = $this->db->where('id', $sasaran->tujuan_id)->get('renstra_tujuan')->row();
            if (!$tujuan || $tujuan->id_instansi != $instansi_id) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
                return;
            }
        }
    }
    
    if (empty($nama)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Kegiatan wajib diisi!']);
        return;
    }
    
    $sasaran_array = json_decode($sasaran_data, true);
    if (!is_array($sasaran_array) || empty($sasaran_array)) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Sasaran dengan Indikator!']);
        return;
    }
    
    // Validasi
    $validSasaran = 0;
    $totalIndikator = 0;
    foreach ($sasaran_array as $sas) {
        $sasaranText = trim($sas['sasaran_text'] ?? '');
        if (!empty($sasaranText)) {
            $validSasaran++;
            $indikators = $sas['indikators'] ?? [];
            foreach ($indikators as $ind) {
                if (!empty(trim($ind['indikator'] ?? ''))) {
                    $totalIndikator++;
                }
            }
        }
    }
    
    if ($validSasaran == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Sasaran!']);
        return;
    }
    if ($totalIndikator == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Setiap Sasaran minimal memiliki 1 Indikator!']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // Update Kegiatan
        $this->db->where('id', $id)->update('renstra_kegiatan', [
            'nama' => $nama,
            'kode_nomenklatur' => $kode_nomenklatur ?: null,
            'bidang_id' => $bidang_id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // ============================================================
        // 1. AMBIL SEMUA ID SASARAN LAMA
        // ============================================================
        $oldSasaran = $this->db
            ->select('id')
            ->where('kegiatan_id', $id)
            ->get('renstra_kegiatan_sasaran')
            ->result_array();
        $oldSasaranIds = array_column($oldSasaran, 'id');
        
        // ============================================================
        // 2. PROSES SASARAN BARU
        // ============================================================
        $newSasaranIds = [];
        $urutanSasaran = 10;
        
        foreach ($sasaran_array as $sas) {
            $sasaranText = trim($sas['sasaran_text'] ?? '');
            if (empty($sasaranText)) continue;
            
            $sasaran_id = isset($sas['id']) && !empty($sas['id']) ? (int)$sas['id'] : 0;
            
            if ($sasaran_id > 0 && in_array($sasaran_id, $oldSasaranIds)) {
                // UPDATE sasaran yang sudah ada
                $this->db->where('id', $sasaran_id)
                         ->where('kegiatan_id', $id)
                         ->update('renstra_kegiatan_sasaran', [
                             'sasaran_text' => $sasaranText,
                             'urutan' => $urutanSasaran,
                             'updated_at' => date('Y-m-d H:i:s')
                         ]);
                $newSasaranIds[] = $sasaran_id;
            } else {
                // INSERT sasaran baru
                $this->db->insert('renstra_kegiatan_sasaran', [
                    'kegiatan_id' => $id,
                    'sasaran_text' => $sasaranText,
                    'urutan' => $urutanSasaran,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $sasaran_id = $this->db->insert_id();
                $newSasaranIds[] = $sasaran_id;
            }
            
            // ============================================================
            // 3. AMBIL INDIKATOR LAMA UNTUK SASARAN INI
            // ============================================================
            $oldIndikators = $this->db
                ->select('id')
                ->where('kegiatan_id', $id)
                ->where('sasaran_id', $sasaran_id)
                ->get('renstra_kegiatan_indikator')
                ->result_array();
            $oldIndikatorIds = array_column($oldIndikators, 'id');
            
            // ============================================================
            // 4. PROSES INDIKATOR BARU
            // ============================================================
            $indikators = $sas['indikators'] ?? [];
            $newIndikatorIds = [];
            $urutanInd = 10;
            
            foreach ($indikators as $ind) {
                if (empty(trim($ind['indikator'] ?? ''))) continue;
                
                $ind_id = isset($ind['id']) && !empty($ind['id']) ? (int)$ind['id'] : 0;
                
                $indData = [
                    'kegiatan_id' => $id,
                    'sasaran_id' => $sasaran_id,
                    'indikator' => trim($ind['indikator']),
                    'satuan' => trim($ind['satuan'] ?? ''),
                    'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                    'target_2026' => trim($ind['target_2026'] ?? ''),
                    'anggaran_2026' => $this->parseRupiah($ind['anggaran_2026'] ?? null),
                    'target_2027' => trim($ind['target_2027'] ?? ''),
                    'anggaran_2027' => $this->parseRupiah($ind['anggaran_2027'] ?? null),
                    'target_2028' => trim($ind['target_2028'] ?? ''),
                    'anggaran_2028' => $this->parseRupiah($ind['anggaran_2028'] ?? null),
                    'target_2029' => trim($ind['target_2029'] ?? ''),
                    'anggaran_2029' => $this->parseRupiah($ind['anggaran_2029'] ?? null),
                    'target_2030' => trim($ind['target_2030'] ?? ''),
                    'anggaran_2030' => $this->parseRupiah($ind['anggaran_2030'] ?? null),
                    'urutan' => $urutanInd,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                if ($ind_id > 0 && in_array($ind_id, $oldIndikatorIds)) {
                    // UPDATE indikator yang sudah ada
                    $this->db->where('id', $ind_id)
                             ->where('kegiatan_id', $id)
                             ->update('renstra_kegiatan_indikator', $indData);
                    $newIndikatorIds[] = $ind_id;
                } else {
                    // INSERT indikator baru
                    $indData['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('renstra_kegiatan_indikator', $indData);
                    $newIndikatorIds[] = $this->db->insert_id();
                }
                $urutanInd += 10;
            }
            
            // ============================================================
            // 5. HAPUS INDIKATOR YANG TIDAK ADA (HARD DELETE)
            // ============================================================
            $indikatorToDelete = array_diff($oldIndikatorIds, $newIndikatorIds);
            if (!empty($indikatorToDelete)) {
                $this->db->where_in('id', $indikatorToDelete)
                         ->where('kegiatan_id', $id)
                         ->delete('renstra_kegiatan_indikator');
            }
        }
        
        // ============================================================
        // 6. HAPUS SASARAN YANG TIDAK ADA (HARD DELETE)
        // ============================================================
        $sasaranToDelete = array_diff($oldSasaranIds, $newSasaranIds);
        if (!empty($sasaranToDelete)) {
            // Hapus sasaran
            $this->db->where_in('id', $sasaranToDelete)
                     ->where('kegiatan_id', $id)
                     ->delete('renstra_kegiatan_sasaran');
            
            // Hapus indikator dari sasaran yang dihapus
            $this->db->where_in('sasaran_id', $sasaranToDelete)
                     ->where('kegiatan_id', $id)
                     ->delete('renstra_kegiatan_indikator');
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data!');
        }
        
        echo json_encode(['status' => 'success', 'message' => 'Kegiatan berhasil diperbarui!']);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

public function getRenstraKegiatanById() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    // ✅ SUDAH ADA kode_nomenklatur di SELECT
    $kegiatan = $this->db->select('*, kode_nomenklatur')
        ->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('renstra_kegiatan')
        ->row_array();
    
    if (!$kegiatan) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    // Ambil sasaran
    $sasaran = $this->db->where('kegiatan_id', $id)
        ->where('deleted_at IS NULL')
        ->order_by('urutan', 'ASC')
        ->get('renstra_kegiatan_sasaran')
        ->result_array();
    
    foreach ($sasaran as &$sas) {
        $sas['indikators'] = $this->db
            ->where('kegiatan_id', $id)
            ->where('sasaran_id', $sas['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get('renstra_kegiatan_indikator')
            ->result_array();
    }
    $kegiatan['sasaran_list'] = $sasaran;
    
    echo json_encode(['status' => 'success', 'data' => $kegiatan]);
    exit;
}

/**
 * GET KEGIATAN PD (SEDERHANA UNTUK DROPDOWN)
 */
public function getRenstraKegiatanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    $data = $this->db->select('id, program_id, nama, bidang_id')
        ->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('renstra_kegiatan')
        ->row_array();
    
    if ($data) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    exit;
}

/**
 * HAPUS KEGIATAN (dengan soft delete sasaran & indikator)
 */
public function hapusRenstraKegiatanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    $instansi_id = $this->get_instansi_id();
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_kegiatan')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    
    // Cek kepemilikan
    $program = $this->db->where('id', $existing->program_id)->where('deleted_at IS NULL')->get('renstra_program')->row();
    if ($program) {
        $sasaran = $this->db->where('id', $program->sasaran_id)->where('deleted_at IS NULL')->get('renstra_sasaran')->row();
        if ($sasaran) {
            $tujuan = $this->db->where('id', $sasaran->tujuan_id)->where('deleted_at IS NULL')->get('renstra_tujuan')->row();
            if (!$tujuan || $tujuan->id_instansi != $instansi_id) {
                echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
                return;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
            return;
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
        return;
    }
    
    $now = date('Y-m-d H:i:s');
    $this->db->where('id', $id)->update('renstra_kegiatan', ['deleted_at' => $now]);
    $this->db->where('kegiatan_id', $id)->update('renstra_kegiatan_sasaran', ['deleted_at' => $now]);
    $this->db->where('kegiatan_id', $id)->update('renstra_kegiatan_indikator', ['deleted_at' => $now]);
    
    echo json_encode(['status' => 'success', 'message' => 'Kegiatan berhasil dihapus']);
    exit;
}

// =====================================================
// CRUD: SUB KEGIATAN RENSTRA PD
// =====================================================

public function tambahRenstraSubKegiatanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah data.']);
        return;
    }
    
    // Ambil data dari POST
    $kegiatan_id = (int)$this->input->post('kegiatan_id', TRUE);
    $nama = trim($this->input->post('nama', TRUE));
    $kode_nomenklatur = trim($this->input->post('kode_nomenklatur', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE);
    $sasaran_data = $this->input->post('sasaran_data', TRUE);
    
    // Validasi
    if (!$kegiatan_id) {
        echo json_encode(['status' => 'error', 'message' => 'Kegiatan tidak valid!']);
        return;
    }
    if (empty($nama)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Sub Kegiatan wajib diisi!']);
        return;
    }
    
    // Parse sasaran data
    $sasaran_array = json_decode($sasaran_data, true);
    if (!is_array($sasaran_array) || empty($sasaran_array)) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Sasaran dengan Indikator!']);
        return;
    }
    
    // Validasi: setiap sasaran minimal punya 1 indikator
    $validSasaran = 0;
    $totalIndikator = 0;
    foreach ($sasaran_array as $sas) {
        $sasaranText = trim($sas['sasaran_text'] ?? '');
        if (!empty($sasaranText)) {
            $validSasaran++;
            $indikators = $sas['indikators'] ?? [];
            foreach ($indikators as $ind) {
                if (!empty(trim($ind['indikator'] ?? ''))) {
                    $totalIndikator++;
                }
            }
        }
    }
    
    if ($validSasaran == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Sasaran!']);
        return;
    }
    if ($totalIndikator == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Setiap Sasaran minimal memiliki 1 Indikator!']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // Insert Sub Kegiatan dengan kode_nomenklatur
        $data = [
            'kegiatan_id' => $kegiatan_id,
            'nama' => $nama,
            'kode_nomenklatur' => $kode_nomenklatur ?: null,
            'bidang_id' => $bidang_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('renstra_sub_kegiatan', $data);
        $sub_kegiatan_id = $this->db->insert_id();
        
        if (!$sub_kegiatan_id) {
            throw new Exception('Gagal menyimpan sub kegiatan');
        }
        
        // Proses Sasaran & Indikator
        $urutanSasaran = 10;
        foreach ($sasaran_array as $sas) {
            $sasaranText = trim($sas['sasaran_text'] ?? '');
            if (empty($sasaranText)) continue;
            
            // Insert Sasaran ke renstra_sub_kegiatan_sasaran
            $sasaranData = [
                'sub_kegiatan_id' => $sub_kegiatan_id,
                'sasaran_text' => $sasaranText,
                'urutan' => $urutanSasaran,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            $this->db->insert('renstra_sub_kegiatan_sasaran', $sasaranData);
            $sasaran_id = $this->db->insert_id();
            $urutanSasaran += 10;
            
            // Proses Indikator untuk sasaran ini
            $indikators = $sas['indikators'] ?? [];
            $urutanInd = 10;
            foreach ($indikators as $ind) {
                if (empty(trim($ind['indikator'] ?? ''))) continue;
                
                $indData = [
                    'sub_kegiatan_id' => $sub_kegiatan_id,
                    'sasaran_id' => $sasaran_id,
                    'indikator' => trim($ind['indikator']),
                    'satuan' => trim($ind['satuan'] ?? ''),
                    'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                    'target_2026' => trim($ind['target_2026'] ?? ''),
                    'anggaran_2026' => $this->parseRupiah($ind['anggaran_2026'] ?? null),
                    'target_2027' => trim($ind['target_2027'] ?? ''),
                    'anggaran_2027' => $this->parseRupiah($ind['anggaran_2027'] ?? null),
                    'target_2028' => trim($ind['target_2028'] ?? ''),
                    'anggaran_2028' => $this->parseRupiah($ind['anggaran_2028'] ?? null),
                    'target_2029' => trim($ind['target_2029'] ?? ''),
                    'anggaran_2029' => $this->parseRupiah($ind['anggaran_2029'] ?? null),
                    'target_2030' => trim($ind['target_2030'] ?? ''),
                    'anggaran_2030' => $this->parseRupiah($ind['anggaran_2030'] ?? null),
                    'urutan' => $urutanInd,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('renstra_sub_kegiatan_indikator', $indData);
                $urutanInd += 10;
            }
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data!');
        }
        
        echo json_encode([
            'status' => 'success',
            'message' => 'Sub Kegiatan berhasil ditambahkan!',
            'data' => ['id' => $sub_kegiatan_id]
        ]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

/**
 * EDIT SUB KEGIATAN DENGAN MULTIPLE SASARAN & INDIKATOR
 */
public function editRenstraSubKegiatanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat mengedit data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $nama = trim($this->input->post('nama', TRUE));
    $kode_nomenklatur = trim($this->input->post('kode_nomenklatur', TRUE));
    $bidang_id = $this->input->post('bidang_id', TRUE);
    $sasaran_data = $this->input->post('sasaran_data', TRUE);
    $instansi_id = $this->get_instansi_id();
    
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    // Cek kepemilikan data (tanpa deleted_at IS NULL)
    $existing = $this->db->where('id', $id)->get('renstra_sub_kegiatan')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    
    // Cek kepemilikan melalui kegiatan -> program -> sasaran -> tujuan (tanpa deleted_at IS NULL)
    $kegiatan = $this->db->where('id', $existing->kegiatan_id)->get('renstra_kegiatan')->row();
    if ($kegiatan) {
        $program = $this->db->where('id', $kegiatan->program_id)->get('renstra_program')->row();
        if ($program) {
            $sasaran = $this->db->where('id', $program->sasaran_id)->get('renstra_sasaran')->row();
            if ($sasaran) {
                $tujuan = $this->db->where('id', $sasaran->tujuan_id)->get('renstra_tujuan')->row();
                if (!$tujuan || $tujuan->id_instansi != $instansi_id) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
                    return;
                }
            }
        }
    }
    
    if (empty($nama)) {
        echo json_encode(['status' => 'error', 'message' => 'Nama Sub Kegiatan wajib diisi!']);
        return;
    }
    
    $sasaran_array = json_decode($sasaran_data, true);
    if (!is_array($sasaran_array) || empty($sasaran_array)) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Sasaran dengan Indikator!']);
        return;
    }
    
    // Validasi
    $validSasaran = 0;
    $totalIndikator = 0;
    foreach ($sasaran_array as $sas) {
        $sasaranText = trim($sas['sasaran_text'] ?? '');
        if (!empty($sasaranText)) {
            $validSasaran++;
            $indikators = $sas['indikators'] ?? [];
            foreach ($indikators as $ind) {
                if (!empty(trim($ind['indikator'] ?? ''))) {
                    $totalIndikator++;
                }
            }
        }
    }
    
    if ($validSasaran == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Minimal tambahkan 1 Sasaran!']);
        return;
    }
    if ($totalIndikator == 0) {
        echo json_encode(['status' => 'error', 'message' => 'Setiap Sasaran minimal memiliki 1 Indikator!']);
        return;
    }
    
    $this->db->trans_start();
    
    try {
        // Update Sub Kegiatan
        $this->db->where('id', $id)->update('renstra_sub_kegiatan', [
            'nama' => $nama,
            'kode_nomenklatur' => $kode_nomenklatur ?: null,
            'bidang_id' => $bidang_id,
            'updated_at' => date('Y-m-d H:i:s')
        ]);
        
        // ============================================================
        // 1. AMBIL SEMUA ID SASARAN LAMA
        // ============================================================
        $oldSasaran = $this->db
            ->select('id')
            ->where('sub_kegiatan_id', $id)
            ->get('renstra_sub_kegiatan_sasaran')
            ->result_array();
        $oldSasaranIds = array_column($oldSasaran, 'id');
        
        // ============================================================
        // 2. PROSES SASARAN BARU
        // ============================================================
        $newSasaranIds = [];
        $urutanSasaran = 10;
        
        foreach ($sasaran_array as $sas) {
            $sasaranText = trim($sas['sasaran_text'] ?? '');
            if (empty($sasaranText)) continue;
            
            $sasaran_id = isset($sas['id']) && !empty($sas['id']) ? (int)$sas['id'] : 0;
            
            if ($sasaran_id > 0 && in_array($sasaran_id, $oldSasaranIds)) {
                // UPDATE sasaran yang sudah ada
                $this->db->where('id', $sasaran_id)
                         ->where('sub_kegiatan_id', $id)
                         ->update('renstra_sub_kegiatan_sasaran', [
                             'sasaran_text' => $sasaranText,
                             'urutan' => $urutanSasaran,
                             'updated_at' => date('Y-m-d H:i:s')
                         ]);
                $newSasaranIds[] = $sasaran_id;
            } else {
                // INSERT sasaran baru
                $this->db->insert('renstra_sub_kegiatan_sasaran', [
                    'sub_kegiatan_id' => $id,
                    'sasaran_text' => $sasaranText,
                    'urutan' => $urutanSasaran,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                $sasaran_id = $this->db->insert_id();
                $newSasaranIds[] = $sasaran_id;
            }
            
            // ============================================================
            // 3. AMBIL INDIKATOR LAMA UNTUK SASARAN INI
            // ============================================================
            $oldIndikators = $this->db
                ->select('id')
                ->where('sub_kegiatan_id', $id)
                ->where('sasaran_id', $sasaran_id)
                ->get('renstra_sub_kegiatan_indikator')
                ->result_array();
            $oldIndikatorIds = array_column($oldIndikators, 'id');
            
            // ============================================================
            // 4. PROSES INDIKATOR BARU
            // ============================================================
            $indikators = $sas['indikators'] ?? [];
            $newIndikatorIds = [];
            $urutanInd = 10;
            
            foreach ($indikators as $ind) {
                if (empty(trim($ind['indikator'] ?? ''))) continue;
                
                $ind_id = isset($ind['id']) && !empty($ind['id']) ? (int)$ind['id'] : 0;
                
                $indData = [
                    'sub_kegiatan_id' => $id,
                    'sasaran_id' => $sasaran_id,
                    'indikator' => trim($ind['indikator']),
                    'satuan' => trim($ind['satuan'] ?? ''),
                    'kondisi_awal' => trim($ind['kondisi_awal'] ?? ''),
                    'target_2026' => trim($ind['target_2026'] ?? ''),
                    'anggaran_2026' => $this->parseRupiah($ind['anggaran_2026'] ?? null),
                    'target_2027' => trim($ind['target_2027'] ?? ''),
                    'anggaran_2027' => $this->parseRupiah($ind['anggaran_2027'] ?? null),
                    'target_2028' => trim($ind['target_2028'] ?? ''),
                    'anggaran_2028' => $this->parseRupiah($ind['anggaran_2028'] ?? null),
                    'target_2029' => trim($ind['target_2029'] ?? ''),
                    'anggaran_2029' => $this->parseRupiah($ind['anggaran_2029'] ?? null),
                    'target_2030' => trim($ind['target_2030'] ?? ''),
                    'anggaran_2030' => $this->parseRupiah($ind['anggaran_2030'] ?? null),
                    'urutan' => $urutanInd,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                
                if ($ind_id > 0 && in_array($ind_id, $oldIndikatorIds)) {
                    // UPDATE indikator yang sudah ada
                    $this->db->where('id', $ind_id)
                             ->where('sub_kegiatan_id', $id)
                             ->update('renstra_sub_kegiatan_indikator', $indData);
                    $newIndikatorIds[] = $ind_id;
                } else {
                    // INSERT indikator baru
                    $indData['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('renstra_sub_kegiatan_indikator', $indData);
                    $newIndikatorIds[] = $this->db->insert_id();
                }
                $urutanInd += 10;
            }
            
            // ============================================================
            // 5. HAPUS INDIKATOR YANG TIDAK ADA (HARD DELETE)
            // ============================================================
            $indikatorToDelete = array_diff($oldIndikatorIds, $newIndikatorIds);
            if (!empty($indikatorToDelete)) {
                $this->db->where_in('id', $indikatorToDelete)
                         ->where('sub_kegiatan_id', $id)
                         ->delete('renstra_sub_kegiatan_indikator');
            }
        }
        
        // ============================================================
        // 6. HAPUS SASARAN YANG TIDAK ADA (HARD DELETE)
        // ============================================================
        $sasaranToDelete = array_diff($oldSasaranIds, $newSasaranIds);
        if (!empty($sasaranToDelete)) {
            // Hapus sasaran
            $this->db->where_in('id', $sasaranToDelete)
                     ->where('sub_kegiatan_id', $id)
                     ->delete('renstra_sub_kegiatan_sasaran');
            
            // Hapus indikator dari sasaran yang dihapus
            $this->db->where_in('sasaran_id', $sasaranToDelete)
                     ->where('sub_kegiatan_id', $id)
                     ->delete('renstra_sub_kegiatan_indikator');
        }
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            throw new Exception('Gagal menyimpan data!');
        }
        
        echo json_encode(['status' => 'success', 'message' => 'Sub Kegiatan berhasil diperbarui!']);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}

/**
 * GET SUB KEGIATAN BY ID (dengan sasaran & indikator)
 */
public function getRenstraSubKegiatanById() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    // Ambil sub kegiatan - TAMBAHKAN kode_nomenklatur
    $sub = $this->db->select('*, kode_nomenklatur')
        ->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('renstra_sub_kegiatan')
        ->row_array();
    
    if (!$sub) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    // Ambil sasaran
    $sasaran = $this->db->where('sub_kegiatan_id', $id)
        ->where('deleted_at IS NULL')
        ->order_by('urutan', 'ASC')
        ->get('renstra_sub_kegiatan_sasaran')
        ->result_array();
    
    foreach ($sasaran as &$sas) {
        $sas['indikators'] = $this->db
            ->where('sub_kegiatan_id', $id)
            ->where('sasaran_id', $sas['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get('renstra_sub_kegiatan_indikator')
            ->result_array();
    }
    $sub['sasaran_list'] = $sasaran;
    
    echo json_encode(['status' => 'success', 'data' => $sub]);
    exit;
}

/**
 * GET SUB KEGIATAN PD (SEDERHANA UNTUK DROPDOWN)
 */
public function getRenstraSubKegiatanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    $data = $this->db->select('id, kegiatan_id, nama, bidang_id, kode_nomenklatur')
        ->where('id', $id)
        ->where('deleted_at IS NULL')
        ->get('renstra_sub_kegiatan')
        ->row_array();
    
    if ($data) {
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
    exit;
}

/**
 * HAPUS SUB KEGIATAN (dengan soft delete sasaran & indikator)
 */
public function hapusRenstraSubKegiatanPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    $id = (int)$this->input->post('id', TRUE);
    $instansi_id = $this->get_instansi_id();
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid!']);
        return;
    }
    
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('renstra_sub_kegiatan')->row();
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan!']);
        return;
    }
    
    // Cek kepemilikan
    $kegiatan = $this->db->where('id', $existing->kegiatan_id)->where('deleted_at IS NULL')->get('renstra_kegiatan')->row();
    if ($kegiatan) {
        $program = $this->db->where('id', $kegiatan->program_id)->where('deleted_at IS NULL')->get('renstra_program')->row();
        if ($program) {
            $sasaran = $this->db->where('id', $program->sasaran_id)->where('deleted_at IS NULL')->get('renstra_sasaran')->row();
            if ($sasaran) {
                $tujuan = $this->db->where('id', $sasaran->tujuan_id)->where('deleted_at IS NULL')->get('renstra_tujuan')->row();
                if (!$tujuan || $tujuan->id_instansi != $instansi_id) {
                    echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data bukan milik instansi Anda.']);
                    return;
                }
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
                return;
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
            return;
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
        return;
    }
    
    $now = date('Y-m-d H:i:s');
    $this->db->where('id', $id)->update('renstra_sub_kegiatan', ['deleted_at' => $now]);
    $this->db->where('sub_kegiatan_id', $id)->update('renstra_sub_kegiatan_sasaran', ['deleted_at' => $now]);
    $this->db->where('sub_kegiatan_id', $id)->update('renstra_sub_kegiatan_indikator', ['deleted_at' => $now]);
    
    echo json_encode(['status' => 'success', 'message' => 'Sub Kegiatan berhasil dihapus']);
    exit;
}

// =====================================================
// GET DATA UNTUK DROPDOWN
// =====================================================

public function getSasaranRPJMD() {
    try {
        // Cek AJAX request
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        // Ambil KodeWilayah dari session
        $KodeWilayah = isset($_SESSION['KodeWilayah']) ? $_SESSION['KodeWilayah'] : null;
        
        // Jika tidak ada KodeWilayah, coba ambil dari TempKodeWilayah
        if (empty($KodeWilayah)) {
            $KodeWilayah = isset($_SESSION['TempKodeWilayah']) ? $_SESSION['TempKodeWilayah'] : null;
        }
        
        // Jika masih kosong, return empty
        if (empty($KodeWilayah)) {
            $this->output->set_content_type('application/json')->set_output(json_encode([]));
            return;
        }
        
        // Query dengan pengecekan tabel
        $this->db->select('Id, Sasaran');
        $this->db->from('sasaranrpjmd');
        $this->db->where('KodeWilayah', $KodeWilayah);
        $this->db->where('deleted_at IS NULL');
        $this->db->order_by('Sasaran', 'ASC');
        $query = $this->db->get();
        
        // Cek apakah query berhasil
        if (!$query) {
            $error = $this->db->error();
            log_message('error', 'getSasaranRPJMD: ' . $error['message']);
            $this->output->set_content_type('application/json')->set_output(json_encode([]));
            return;
        }
        
        $sasaran = $query->result_array();
        
        // Kirim response
        $this->output->set_content_type('application/json')->set_output(json_encode($sasaran));
        
    } catch (Exception $e) {
        log_message('error', 'getSasaranRPJMD Error: ' . $e->getMessage());
        $this->output->set_content_type('application/json')->set_output(json_encode([]));
    }
}

// =====================================================
// GET BIDANG/SUB/KOORDINATOR DARI AKUN_KARYAWAN
// =====================================================

public function getBidangList() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$KodeWilayah) {
        echo json_encode([]);
        return;
    }
    
    // Ambil data bidang dari akun_karyawan
    $this->db->select('id, nama, nip, jabatan, satuan_unit_kerja, bidang_sub_koordinator')
        ->from('akun_karyawan')
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL')
        ->order_by('nama', 'ASC');
    
    // Jika role 4, filter berdasarkan instansi
    if ($this->is_role_4() && $instansi_id) {
        $this->db->where("FIND_IN_SET('$instansi_id', dinas_id) > 0");
    }
    
    $bidang = $this->db->get()->result_array();
    
    echo json_encode($bidang);
    exit;
}

// =====================================================
// GET DETAIL BIDANG BY ID (UNTUK EDIT)
// =====================================================

public function getBidangDetail() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $KodeWilayah = $this->get_kode_wilayah();
    
    if (!$id || !$KodeWilayah) {
        echo json_encode([]);
        return;
    }
    
    $data = $this->db
        ->select('id, nama, nip, jabatan, satuan_unit_kerja, bidang_sub_koordinator')
        ->from('akun_karyawan')
        ->where('id', $id)
        ->where('kodewilayah', $KodeWilayah)
        ->where('deleted_at IS NULL')
        ->get()
        ->row_array();
    
    echo json_encode($data);
    exit;
}

// ================================================================
// GET INDIKATOR DARI PROGRAM PD (UNTUK RENSTRA)
// ================================================================

public function getIndikatorProgramPD() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    try {
        $KodeWilayah = $this->get_kode_wilayah();
        if (empty($KodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
            return;
        }
        
        $kodeProgram = trim($this->input->post('kode_program', TRUE));
        $tahun = (int)$this->input->post('tahun', TRUE) ?: date('Y');
        
        if (empty($kodeProgram)) {
            echo json_encode(['status' => 'error', 'message' => 'Kode Program tidak valid!']);
            return;
        }
        
        // Validasi tahun (2026-2030)
        $validYears = [2026, 2027, 2028, 2029, 2030];
        if (!in_array($tahun, $validYears)) {
            $tahun = 2026;
        }
        
        // Cari program berdasarkan kode_program
        $program = $this->db
            ->select('p.*, b.nama_bidang, b.kode_bidang, u.nama_urusan, u.kode_urusan')
            ->from('program_data p')
            ->join('program_bidang_urusan b', 'b.id = p.bidang_urusan_id', 'left')
            ->join('program_urusan u', 'u.id = b.urusan_id', 'left')
            ->where('p.kode_wilayah', $KodeWilayah)
            ->where('p.kode_program', $kodeProgram)
            ->where('p.deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if (!$program) {
            // Coba cari berdasarkan nama
            $program = $this->db
                ->select('p.*, b.nama_bidang, b.kode_bidang, u.nama_urusan, u.kode_urusan')
                ->from('program_data p')
                ->join('program_bidang_urusan b', 'b.id = p.bidang_urusan_id', 'left')
                ->join('program_urusan u', 'u.id = b.urusan_id', 'left')
                ->where('p.kode_wilayah', $KodeWilayah)
                ->where('p.nama_program LIKE', '%' . $kodeProgram . '%')
                ->where('p.deleted_at IS NULL')
                ->get()
                ->row_array();
        }
        
        if (!$program) {
            echo json_encode([
                'status' => 'error',
                'message' => 'Program tidak ditemukan!'
            ]);
            return;
        }
        
        // Ambil indikator dari program_indikator - HANYA KOLOM 2026-2030
        $targetField = 'target_' . $tahun;
        $paguField = 'pagu_' . $tahun;
        
        // Cek apakah kolom target tahun ada
        $columns = $this->db->query("SHOW COLUMNS FROM program_indikator LIKE 'target_" . $tahun . "'")->num_rows();
        
        if ($columns > 0) {
            $indikator = $this->db
                ->select('id, indikator, satuan, kondisi_awal, ' . $targetField . ' as target, ' . $paguField . ' as pagu')
                ->where('program_id', $program['id'])
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->order_by('id', 'ASC')
                ->get('program_indikator')
                ->result_array();
        } else {
            // Fallback: ambil semua dan filter di PHP
            $allIndikator = $this->db
                ->select('*')
                ->where('program_id', $program['id'])
                ->where('kode_wilayah', $KodeWilayah)
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->get('program_indikator')
                ->result_array();
            
            $indikator = [];
            foreach ($allIndikator as $row) {
                $indikator[] = [
                    'id' => $row['id'],
                    'indikator' => $row['indikator'],
                    'satuan' => $row['satuan'],
                    'kondisi_awal' => $row['kondisi_awal'],
                    'target' => $row['target_' . $tahun] ?? '',
                    'pagu' => $row['pagu_' . $tahun] ?? null
                ];
            }
        }
        
        // Format pagu
        foreach ($indikator as &$item) {
            if (!empty($item['pagu']) && is_numeric($item['pagu'])) {
                $item['pagu_formatted'] = 'Rp ' . number_format((float)$item['pagu'], 0, ',', '.');
            } else {
                $item['pagu_formatted'] = '';
            }
        }
        
        echo json_encode([
            'status' => 'success',
            'data' => [
                'program' => $program,
                'indikator' => $indikator,
                'tahun' => $tahun
            ]
        ]);
        
    } catch (Exception $e) {
        log_message('error', 'getIndikatorProgramPD: ' . $e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
}

// ================================================================
// GET INDIKATOR PROGRAM PD UNTUK RENSTRA (DENGAN SEMUA OUTCOME)
// ================================================================

public function getIndikatorProgramPDRenstra() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    try {
        $KodeWilayah = $this->get_kode_wilayah();
        if (empty($KodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
            return;
        }
        
        $kodeProgram = trim($this->input->post('kode_program', TRUE));
        $tahun = (int)$this->input->post('tahun', TRUE) ?: 2026;
        
        if (empty($kodeProgram)) {
            echo json_encode(['status' => 'error', 'message' => 'Kode Program tidak valid!']);
            return;
        }
        
        $validYears = [2026, 2027, 2028, 2029, 2030];
        if (!in_array($tahun, $validYears)) {
            $tahun = 2026;
        }
        
        // Cari program berdasarkan kode_program
        $program = $this->db
            ->select('p.id, p.kode_program, p.nama_program')
            ->from('program_data p')
            ->where('p.kode_wilayah', $KodeWilayah)
            ->where('p.kode_program', $kodeProgram)
            ->where('p.deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if (!$program) {
            // Coba LIKE
            $program = $this->db
                ->select('p.id, p.kode_program, p.nama_program')
                ->from('program_data p')
                ->where('p.kode_wilayah', $KodeWilayah)
                ->like('p.kode_program', $kodeProgram, 'after')
                ->where('p.deleted_at IS NULL')
                ->limit(1)
                ->get()
                ->row_array();
        }
        
        if (!$program) {
            log_message('error', "Program tidak ditemukan untuk kode: " . $kodeProgram);
            echo json_encode([
                'status' => 'error',
                'message' => 'Program tidak ditemukan! Kode: ' . $kodeProgram
            ]);
            return;
        }
        
        // ============================================================
        // AMBIL SEMUA OUTCOME (BUKAN HANYA SATU)
        // ============================================================
        $outcomes = $this->db
            ->select('id, outcome_text')
            ->from('program_outcome')
            ->where('program_id', $program['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get()
            ->result_array();
        
        // Untuk setiap outcome, ambil indikatornya
        foreach ($outcomes as &$out) {
            $out['indikator'] = $this->db
                ->select('id, indikator, satuan, kondisi_awal, 
                         target_2026, target_2027, target_2028, target_2029, target_2030,
                         pagu_2026, pagu_2027, pagu_2028, pagu_2029, pagu_2030')
                ->where('outcome_id', $out['id'])
                ->where('deleted_at IS NULL')
                ->order_by('urutan', 'ASC')
                ->order_by('id', 'ASC')
                ->get('program_indikator')
                ->result_array();
        }
        
        // Format pagu
        foreach ($outcomes as &$out) {
            foreach ($out['indikator'] as &$item) {
                foreach ([2026, 2027, 2028, 2029, 2030] as $y) {
                    $paguField = 'pagu_' . $y;
                    if (!empty($item[$paguField]) && is_numeric($item[$paguField])) {
                        $item[$paguField . '_formatted'] = 'Rp ' . number_format((float)$item[$paguField], 0, ',', '.');
                    } else {
                        $item[$paguField . '_formatted'] = '';
                    }
                }
            }
        }
        
        echo json_encode([
            'status' => 'success',
            'data' => [
                'program' => $program,
                'outcomes' => $outcomes,
                'tahun' => $tahun
            ]
        ]);
        
    } catch (Exception $e) {
        log_message('error', 'getIndikatorProgramPDRenstra Exception: ' . $e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
}

// ================================================================
// GET PROGRAM DETAIL BY KODE (UNTUK MENDAPATKAN SEMUA OUTCOME)
// ================================================================

public function getProgramDetailByKode() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    try {
        $KodeWilayah = $this->get_kode_wilayah();
        if (empty($KodeWilayah)) {
            echo json_encode(['status' => 'error', 'message' => 'Wilayah belum dipilih!']);
            return;
        }
        
        $kodeProgram = trim($this->input->post('kode_program', TRUE));
        if (empty($kodeProgram)) {
            echo json_encode(['status' => 'error', 'message' => 'Kode Program tidak valid!']);
            return;
        }
        
        // Cari program
        $program = $this->db
            ->select('id, kode_program, nama_program')
            ->from('program_data')
            ->where('kode_wilayah', $KodeWilayah)
            ->where('kode_program', $kodeProgram)
            ->where('deleted_at IS NULL')
            ->get()
            ->row_array();
        
        if (!$program) {
            $program = $this->db
                ->select('id, kode_program, nama_program')
                ->from('program_data')
                ->where('kode_wilayah', $KodeWilayah)
                ->like('kode_program', $kodeProgram, 'after')
                ->where('deleted_at IS NULL')
                ->limit(1)
                ->get()
                ->row_array();
        }
        
        if (!$program) {
            $program = $this->db
                ->select('id, kode_program, nama_program')
                ->from('program_data')
                ->where('kode_wilayah', $KodeWilayah)
                ->like('nama_program', $kodeProgram, 'both')
                ->where('deleted_at IS NULL')
                ->limit(1)
                ->get()
                ->row_array();
        }
        
        if (!$program) {
            echo json_encode(['status' => 'error', 'message' => 'Program tidak ditemukan!']);
            return;
        }
        
        // Ambil SEMUA outcome
        $outcomes = $this->db
            ->select('outcome_text')
            ->from('program_outcome')
            ->where('program_id', $program['id'])
            ->where('deleted_at IS NULL')
            ->order_by('urutan', 'ASC')
            ->get()
            ->result_array();
        
        $program['outcomes'] = $outcomes;
        
        echo json_encode([
            'status' => 'success',
            'data' => $program
        ]);
        
    } catch (Exception $e) {
        log_message('error', 'getProgramDetailByKode Exception: ' . $e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
}

// ================================================================
// GET INDIKATOR DARI PROGRAM PD (UNTUK RENSTRA)
// ================================================================

/**
 * Helper untuk mendapatkan nama dari kode nomenklatur
 */
private function getNomenklaturName($kode) {
    if (empty($kode)) return '';
    $data = $this->db->select('Nomenklatur')
        ->where('Kode', $kode)
        ->get('nomenklaturkabupaten')
        ->row_array();
    return $data ? $data['Nomenklatur'] : $kode;
}

/**
 * Format angka Rupiah ke number
 */
private function formatRupiahToNumber($value) {
    if (empty($value)) return null;
    $clean = str_replace(['Rp', ' ', '.', ','], '', $value);
    if (!is_numeric($clean)) return null;
    return (float)$clean;
}

/**
 * Format angka ke format Rupiah untuk display
 */
private function formatRupiah($angka) {
    if (empty($angka) && $angka !== 0 && $angka !== '0') {
        return '';
    }
    return 'Rp ' . number_format((float)$angka, 0, ',', '.');
}

/**
 * Parse angka dari format Rupiah ke float
 */
private function parseRupiah($rupiah) {
    if (empty($rupiah)) return null;
    $clean = str_replace(['Rp', ' ', '.', ','], '', $rupiah);
    if (!is_numeric($clean)) return null;
    return (float)$clean;
}

// =====================================================
// PERJANJIAN KINERJA PD (LENGKAP CRUD)
// =====================================================

/**
 * Halaman Perjanjian Kinerja PD
 */
public function PerjanjianKinerjaPD() {
    $Header['Halaman'] = 'Perjanjian Kinerja Perangkat Daerah';
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_logged_in = $this->is_logged_in();
    $is_role_4 = $this->is_role_4();
    $is_role_3 = $this->is_role_3();
    $filter_instansi_id = $this->input->get('instansi_id', TRUE);
    if (empty($filter_instansi_id) && isset($_SESSION['TempInstansiId']) && !empty($_SESSION['TempInstansiId'])) {
        $filter_instansi_id = $_SESSION['TempInstansiId'];
    }
    
    $data['KodeWilayah'] = $KodeWilayah;
    $data['InstansiId'] = $instansi_id;
    $data['IsLoggedIn'] = $is_logged_in;
    $data['IsRole4'] = $is_role_4;
    $data['IsRole3'] = $is_role_3;
    $data['UserLevel'] = isset($_SESSION['Level']) ? (int)$_SESSION['Level'] : 0;
    $data['FilterInstansiId'] = $filter_instansi_id;
    $data['NamaInstansi'] = isset($_SESSION['NamaInstansi']) ? $_SESSION['NamaInstansi'] : '';
    
    // Ambil nama wilayah
    $data['NamaWilayah'] = '';
    if ($KodeWilayah) {
        $wilayah = $this->db->select('Nama')->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
        $data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
    }
    
    // Data provinsi untuk dropdown filter
    $data['Provinsi'] = $this->db->where("Kode LIKE '__'")
                                 ->order_by('Nama')
                                 ->get('kodewilayah')
                                 ->result_array();
    
    // Daftar instansi untuk filter (hanya untuk non-role 4)
    $data['ListInstansi'] = [];
    if (!$is_role_4 && $KodeWilayah) {
        $data['ListInstansi'] = $this->db->select('id, nama')
            ->from('akun_instansi')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // Ambil data perjanjian kinerja
    $data['PerjanjianKinerja'] = [];
    if ($KodeWilayah) {
        $this->db->select('pk.*, 
            i.nama as nama_instansi,
            p.nama as pengampu_nama, p.nip as pengampu_nip, p.jabatan as pengampu_jabatan, p.eselon as eselon,
            a.nama as atasan_nama, a.nip as atasan_nip, a.jabatan as atasan_jabatan')
            ->from('perjanjian_kinerja pk')
            ->join('akun_instansi i', 'i.id = pk.id_instansi', 'left')
            ->join('akun_karyawan p', 'p.id = pk.pegawai_pengampu_id', 'left')
            ->join('akun_karyawan a', 'a.id = pk.atasan_langsung_id', 'left')
            ->where('pk.kode_wilayah', $KodeWilayah)
            ->where('pk.deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $this->db->where('pk.id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $this->db->where('pk.id_instansi', (int)$filter_instansi_id);
        }
        
        $data['PerjanjianKinerja'] = $this->db->order_by('pk.id', 'ASC')->get()->result_array();
    }
    
    // Data untuk dropdown pegawai pengampu
    $data['PegawaiList'] = [];
    if ($KodeWilayah) {
        $this->db->select('id, nama, nip, jabatan, eselon, satuan_unit_kerja, dinas_id')
            ->from('akun_karyawan')
            ->where('kodewilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        if ($is_role_4 && $instansi_id) {
            $this->db->where('dinas_id', $instansi_id);
        }
        $data['PegawaiList'] = $this->db->order_by('nama', 'ASC')->get()->result_array();
    }
    $data['AtasanList'] = $data['PegawaiList'];
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/PerjanjianKinerjaPD', $data);
}

public function getSasaranByLevel() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    $level = $this->input->post('level', TRUE);
    $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
    $kode_wilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    $is_role_4 = $this->is_role_4();
    
    if (!$kode_wilayah || !$level) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap: kode_wilayah=' . ($kode_wilayah ?: 'null') . ', level=' . ($level ?: 'null') . ', session_level=' . (isset($_SESSION['Level']) ? $_SESSION['Level'] : 'null') . ', instansi_id=' . ($instansi_id ?: 'null')]);
        return;
    }
    
    $allowed = ['program', 'kegiatan', 'sub_kegiatan'];
    if (!in_array($level, $allowed)) {
        echo json_encode(['status' => 'error', 'message' => 'Level tidak valid']);
        return;
    }
    
    // Tentukan field target berdasarkan tahun
    $target_field = 'target_' . $tahun;
    
    $result = [];
    
    try {
        if ($level == 'program') {
            // Ambil semua program
            $this->db->select("p.id, p.nama as nama, COALESCE(NULLIF(k.bidang_sub_koordinator, ''), NULLIF(k.satuan_unit_kerja, ''), k.jabatan) as sub_unit", false);
            $this->db->from('renstra_program p');
            $this->db->join('renstra_sasaran s', 's.id = p.sasaran_id', 'left');
            $this->db->join('renstra_tujuan t', 't.id = s.tujuan_id', 'left');
            $this->db->join('akun_karyawan k', 'k.id = s.bidang_id', 'left');
            $this->db->where('t.kode_wilayah', $kode_wilayah);
            $this->db->where('p.deleted_at IS NULL');
            $this->db->where('s.deleted_at IS NULL');
            $this->db->where('t.deleted_at IS NULL');
            if ($is_role_4 && $instansi_id) {
                $this->db->where('t.id_instansi', $instansi_id);
            }
            $programs = $this->db->get()->result_array();
            
            // Cek keberadaan kolom target di renstra_program_indikator
            $escaped_field = $this->db->escape($target_field);
            $col_exists = $this->db->query("SHOW COLUMNS FROM `renstra_program_indikator` LIKE $escaped_field")->num_rows() > 0;
            $select_target = $col_exists ? "$target_field as target" : "NULL as target";
            
            // Untuk setiap program, ambil outcome dan indikator per outcome
            foreach ($programs as &$prog) {
                // Ambil sasaran / outcome dari renstra_program_outcome
                $outcomes = $this->db->select('id, outcome_text')
                    ->from('renstra_program_outcome')
                    ->where('program_id', $prog['id'])
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get()
                    ->result_array();
                
                $all_indikators = [];
                foreach ($outcomes as &$out) {
                    $out_indikators = $this->db->select("id, indikator, satuan, $select_target")
                        ->from('renstra_program_indikator')
                        ->where('outcome_id', $out['id'])
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->get()
                        ->result_array();
                    $out['indikator_list'] = $out_indikators;
                    foreach ($out_indikators as $oi) {
                        $all_indikators[] = $oi;
                    }
                }
                
                $prog['outcomes'] = $outcomes;
                $prog['sasaran'] = !empty($outcomes) ? implode('; ', array_column($outcomes, 'outcome_text')) : '';
                $prog['indikator_list'] = $all_indikators;
            }
            $result = $programs;

        } elseif ($level == 'kegiatan') {
            // Ambil semua kegiatan
            $this->db->select("k.id, k.nama as nama, COALESCE(NULLIF(ak.bidang_sub_koordinator, ''), NULLIF(ak.satuan_unit_kerja, ''), ak.jabatan) as sub_unit", false);
            $this->db->from('renstra_kegiatan k');
            $this->db->join('renstra_program p', 'p.id = k.program_id', 'left');
            $this->db->join('renstra_sasaran s', 's.id = p.sasaran_id', 'left');
            $this->db->join('renstra_tujuan t', 't.id = s.tujuan_id', 'left');
            $this->db->join('akun_karyawan ak', 'ak.id = k.bidang_id', 'left');
            $this->db->where('t.kode_wilayah', $kode_wilayah);
            $this->db->where('k.deleted_at IS NULL');
            $this->db->where('p.deleted_at IS NULL');
            $this->db->where('s.deleted_at IS NULL');
            $this->db->where('t.deleted_at IS NULL');
            if ($is_role_4 && $instansi_id) {
                $this->db->where('t.id_instansi', $instansi_id);
            }
            $rows = $this->db->get()->result_array();
            
            // Cek keberadaan kolom target di renstra_kegiatan_indikator
            $escaped_field = $this->db->escape($target_field);
            $col_exists = $this->db->query("SHOW COLUMNS FROM `renstra_kegiatan_indikator` LIKE $escaped_field")->num_rows() > 0;
            $select_target = $col_exists ? "$target_field as target" : "NULL as target";
            
            // Untuk setiap kegiatan, ambil sasaran dan indikator per sasaran
            foreach ($rows as &$row) {
                $sasarans = $this->db->select('id, sasaran_text')
                    ->from('renstra_kegiatan_sasaran')
                    ->where('kegiatan_id', $row['id'])
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get()
                    ->result_array();
                
                $all_indikators = [];
                foreach ($sasarans as &$sas) {
                    $sas_indikators = $this->db->select("id, indikator, satuan, $select_target")
                        ->from('renstra_kegiatan_indikator')
                        ->where('sasaran_id', $sas['id'])
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->get()
                        ->result_array();
                    $sas['indikator_list'] = $sas_indikators;
                    foreach ($sas_indikators as $si) {
                        $all_indikators[] = $si;
                    }
                }
                
                $row['sasaran_list'] = $sasarans;
                $row['sasaran'] = !empty($sasarans) ? implode('; ', array_column($sasarans, 'sasaran_text')) : '';
                $row['indikator_list'] = $all_indikators;
            }
            $result = $rows;

        } elseif ($level == 'sub_kegiatan') {
            // Ambil semua sub kegiatan
            $this->db->select("sk.id, sk.nama as nama, COALESCE(NULLIF(ak.bidang_sub_koordinator, ''), NULLIF(ak.satuan_unit_kerja, ''), ak.jabatan) as sub_unit", false);
            $this->db->from('renstra_sub_kegiatan sk');
            $this->db->join('renstra_kegiatan k', 'k.id = sk.kegiatan_id', 'left');
            $this->db->join('renstra_program p', 'p.id = k.program_id', 'left');
            $this->db->join('renstra_sasaran s', 's.id = p.sasaran_id', 'left');
            $this->db->join('renstra_tujuan t', 't.id = s.tujuan_id', 'left');
            $this->db->join('akun_karyawan ak', 'ak.id = sk.bidang_id', 'left');
            $this->db->where('t.kode_wilayah', $kode_wilayah);
            $this->db->where('sk.deleted_at IS NULL');
            $this->db->where('k.deleted_at IS NULL');
            $this->db->where('p.deleted_at IS NULL');
            $this->db->where('s.deleted_at IS NULL');
            $this->db->where('t.deleted_at IS NULL');
            if ($is_role_4 && $instansi_id) {
                $this->db->where('t.id_instansi', $instansi_id);
            }
            $rows = $this->db->get()->result_array();
            
            // Cek keberadaan kolom target di renstra_sub_kegiatan_indikator
            $escaped_field = $this->db->escape($target_field);
            $col_exists = $this->db->query("SHOW COLUMNS FROM `renstra_sub_kegiatan_indikator` LIKE $escaped_field")->num_rows() > 0;
            $select_target = $col_exists ? "$target_field as target" : "NULL as target";
            
            // Untuk setiap sub kegiatan, ambil sasaran dan indikator per sasaran
            foreach ($rows as &$row) {
                $sasarans = $this->db->select('id, sasaran_text')
                    ->from('renstra_sub_kegiatan_sasaran')
                    ->where('sub_kegiatan_id', $row['id'])
                    ->where('deleted_at IS NULL')
                    ->order_by('urutan', 'ASC')
                    ->get()
                    ->result_array();
                
                $all_indikators = [];
                foreach ($sasarans as &$sas) {
                    $sas_indikators = $this->db->select("id, indikator, satuan, $select_target")
                        ->from('renstra_sub_kegiatan_indikator')
                        ->where('sasaran_id', $sas['id'])
                        ->where('deleted_at IS NULL')
                        ->order_by('urutan', 'ASC')
                        ->get()
                        ->result_array();
                    $sas['indikator_list'] = $sas_indikators;
                    foreach ($sas_indikators as $si) {
                        $all_indikators[] = $si;
                    }
                }
                
                $row['sasaran_list'] = $sasarans;
                $row['sasaran'] = !empty($sasarans) ? implode('; ', array_column($sasarans, 'sasaran_text')) : '';
                $row['indikator_list'] = $all_indikators;
            }
            $result = $rows;
        }
    } catch (Exception $e) {
        log_message('error', 'getSasaranByLevel Exception: ' . $e->getMessage());
        echo json_encode(['status' => 'error', 'message' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        return;
    }
    
    echo json_encode([
        'status' => 'success',
        'data' => $result,
        '_debug' => [
            'kode_wilayah' => $kode_wilayah,
            'instansi_id' => $instansi_id,
            'is_role_4' => $is_role_4,
            'level' => $level,
            'tahun' => $tahun,
            'target_field' => $target_field,
            'count' => count($result),
        ]
    ]);
    exit;
}

/**
 * Simpan Perjanjian Kinerja (AJAX)
 */
public function simpanPerjanjianKinerja() {
    if (!$this->input->is_ajax_request()) show_404();
    if (!$this->can_crud() || !$this->is_role_4()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Akun Instansi (Role 4) yang berhak menambah data.']);
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    if (!$KodeWilayah || !$instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Sesi wilayah atau instansi tidak valid']);
        return;
    }
    
    $pegawai_pengampu_id = (int)$this->input->post('pegawai_pengampu_id', TRUE);
    $atasan_langsung_id = (int)$this->input->post('atasan_langsung_id', TRUE);
    $jenis_perjanjian = $this->input->post('jenis_perjanjian', TRUE);
    $periode_awal = (int)$this->input->post('periode_awal', TRUE);
    $periode_akhir = (int)$this->input->post('periode_akhir', TRUE);
    $anggaran = $this->input->post('anggaran', TRUE) ? 1 : 0;
    $sasaran_level = $this->input->post('sasaran_level', TRUE);
    $sasaran_data = $this->input->post('sasaran_data', TRUE); // JSON string
    $sub_unit = trim($this->input->post('sub_unit', TRUE));
    
    // Validasi input
    if (!$pegawai_pengampu_id || !$atasan_langsung_id || !$jenis_perjanjian || !$periode_awal || !$periode_akhir || !$sasaran_level || empty($sasaran_data)) {
        echo json_encode(['status' => 'error', 'message' => 'Semua field wajib diisi!']);
        return;
    }
    
    // Upload Dokumen Helper
    $upload_helper = function($fieldName) {
        if (!isset($_FILES[$fieldName]) || $_FILES[$fieldName]['error'] !== UPLOAD_ERR_OK) {
            return null;
        }
        $config['upload_path'] = './uploads/perjanjian_kinerja/';
        $config['allowed_types'] = 'pdf|doc|docx|jpg|png|jpeg';
        $config['max_size'] = 5120; // 5MB
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        
        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, TRUE);
        }
        
        if ($this->upload->do_upload($fieldName)) {
            return $this->upload->data('file_name');
        }
        return false;
    };

    // Upload Definitif (PK Murni)
    $dok_utama = $upload_helper('dokumen_utama');
    $dok_lampiran = $upload_helper('dokumen_lampiran');

    // Upload PK Perubahan
    $dok_perubahan_utama = $upload_helper('dokumen_perubahan_utama');
    $dok_perubahan_lampiran = $upload_helper('dokumen_perubahan_lampiran');

    // Upload PK PLT
    $dok_plt_utama = $upload_helper('dokumen_plt_utama');
    $dok_plt_lampiran = $upload_helper('dokumen_plt_lampiran');
    
    $doc_time = time();
    $data = [
        'kode_wilayah' => $KodeWilayah,
        'id_instansi' => $instansi_id,
        'pegawai_pengampu_id' => $pegawai_pengampu_id,
        'atasan_langsung_id' => $atasan_langsung_id,
        'jenis_perjanjian' => $jenis_perjanjian,
        'periode_awal' => $periode_awal,
        'periode_akhir' => $periode_akhir,
        'anggaran' => $anggaran,
        'sasaran_level' => $sasaran_level,
        'sasaran_data' => $sasaran_data,
        'sub_unit' => $sub_unit,
        'status' => 'menunggu', // Default status saat input data selalu otomatis 'menunggu'
        'definitif_doc_id' => ($dok_utama || $dok_lampiran) ? 'DOC-' . $doc_time : null,
        'pk_perubahan_doc_id' => ($dok_perubahan_utama || $dok_perubahan_lampiran) ? 'DOC-P-' . $doc_time : null,
        'pk_plt_doc_id' => ($dok_plt_utama || $dok_plt_lampiran) ? 'DOC-PLT-' . $doc_time : null,
        'dokumen_utama' => $dok_utama ?: null,
        'dokumen_lampiran' => $dok_lampiran ?: null,
        'dokumen_perubahan_utama' => $dok_perubahan_utama ?: null,
        'dokumen_perubahan_lampiran' => $dok_perubahan_lampiran ?: null,
        'dokumen_plt_utama' => $dok_plt_utama ?: null,
        'dokumen_plt_lampiran' => $dok_plt_lampiran ?: null,
        'created_at' => date('Y-m-d H:i:s'),
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->insert('perjanjian_kinerja', $data);
    if ($this->db->affected_rows() > 0) {
        echo json_encode(['status' => 'success', 'message' => 'Perjanjian Kinerja berhasil disimpan dengan status Menunggu']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal menyimpan data']);
    }
}

/**
 * Get Perjanjian Kinerja by ID (AJAX) - untuk edit & detail
 */
public function getPerjanjianKinerja() {
    if (!$this->input->is_ajax_request()) show_404();
    $id = (int)$this->input->post('id', TRUE);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    $data = $this->db
        ->select('pk.*, 
            p.nama as pengampu_nama, p.nip as pengampu_nip, p.jabatan as pengampu_jabatan, p.satuan_unit_kerja as pengampu_satuan, p.eselon as pengampu_eselon,
            a.nama as atasan_nama, a.nip as atasan_nip, a.jabatan as atasan_jabatan, a.satuan_unit_kerja as atasan_satuan, a.eselon as atasan_eselon')
        ->from('perjanjian_kinerja pk')
        ->join('akun_karyawan p', 'p.id = pk.pegawai_pengampu_id', 'left')
        ->join('akun_karyawan a', 'a.id = pk.atasan_langsung_id', 'left')
        ->where('pk.id', $id)
        ->where('pk.deleted_at IS NULL')
        ->get()
        ->row_array();
        
    if ($data) {
        // URLs Dokumen Definitif
        $data['dokumen_utama_url'] = !empty($data['dokumen_utama']) ? base_url('uploads/perjanjian_kinerja/' . $data['dokumen_utama']) : '';
        $data['dokumen_lampiran_url'] = !empty($data['dokumen_lampiran']) ? base_url('uploads/perjanjian_kinerja/' . $data['dokumen_lampiran']) : '';
        
        // URLs Dokumen PK Perubahan
        $data['dokumen_perubahan_utama_url'] = !empty($data['dokumen_perubahan_utama']) ? base_url('uploads/perjanjian_kinerja/' . $data['dokumen_perubahan_utama']) : '';
        $data['dokumen_perubahan_lampiran_url'] = !empty($data['dokumen_perubahan_lampiran']) ? base_url('uploads/perjanjian_kinerja/' . $data['dokumen_perubahan_lampiran']) : '';
        
        // URLs Dokumen PK PLT
        $data['dokumen_plt_utama_url'] = !empty($data['dokumen_plt_utama']) ? base_url('uploads/perjanjian_kinerja/' . $data['dokumen_plt_utama']) : '';
        $data['dokumen_plt_lampiran_url'] = !empty($data['dokumen_plt_lampiran']) ? base_url('uploads/perjanjian_kinerja/' . $data['dokumen_plt_lampiran']) : '';
        
        echo json_encode(['status' => 'success', 'data' => $data]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
    }
}

/**
 * Update Perjanjian Kinerja (AJAX) - Hanya Akun Instansi Role 4 pada wilayah terkait
 */
public function updatePerjanjianKinerja() {
    if (!$this->input->is_ajax_request()) show_404();
    if (!$this->can_crud() || !$this->is_role_4()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Akun Instansi (Role 4) pada wilayah ini yang berhak mengedit data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    // Cek kepemilikan data instansi dan wilayah
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('perjanjian_kinerja')->row();
    if (!$existing || $existing->id_instansi != $instansi_id || $existing->kode_wilayah != $KodeWilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data tidak ditemukan atau bukan milik Instansi Anda pada wilayah ini.']);
        return;
    }
    
    $pegawai_pengampu_id = (int)$this->input->post('pegawai_pengampu_id', TRUE);
    $atasan_langsung_id = (int)$this->input->post('atasan_langsung_id', TRUE);
    $jenis_perjanjian = $this->input->post('jenis_perjanjian', TRUE);
    $periode_awal = (int)$this->input->post('periode_awal', TRUE);
    $periode_akhir = (int)$this->input->post('periode_akhir', TRUE);
    $anggaran = $this->input->post('anggaran', TRUE) ? 1 : 0;
    $sasaran_level = $this->input->post('sasaran_level', TRUE);
    $sasaran_data = $this->input->post('sasaran_data', TRUE);
    $sub_unit = trim($this->input->post('sub_unit', TRUE));
    
    // Helper upload & delete file
    $upload_path = './uploads/perjanjian_kinerja/';
    if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, TRUE);
    }

    $upload_helper = function($fieldName, $existingFile, $deleteFlag) use ($upload_path) {
        // 1. Jika ada upload file baru
        if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] === UPLOAD_ERR_OK) {
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'pdf|doc|docx|jpg|png|jpeg';
            $config['max_size'] = 5120;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            
            if ($this->upload->do_upload($fieldName)) {
                // Hapus file lama jika ada
                if ($existingFile && file_exists($upload_path . $existingFile)) {
                    @unlink($upload_path . $existingFile);
                }
                return $this->upload->data('file_name');
            }
        }
        
        // 2. Jika user meminta hapus file lama (tanpa upload baru)
        if ($deleteFlag == 1) {
            if ($existingFile && file_exists($upload_path . $existingFile)) {
                @unlink($upload_path . $existingFile);
            }
            return null;
        }

        // 3. Pertahankan file lama
        return $existingFile;
    };

    $del_utama = (int)$this->input->post('delete_dokumen_utama', TRUE);
    $del_lampiran = (int)$this->input->post('delete_dokumen_lampiran', TRUE);
    $del_perubahan_utama = (int)$this->input->post('delete_dokumen_perubahan_utama', TRUE);
    $del_perubahan_lampiran = (int)$this->input->post('delete_dokumen_perubahan_lampiran', TRUE);
    $del_plt_utama = (int)$this->input->post('delete_dokumen_plt_utama', TRUE);
    $del_plt_lampiran = (int)$this->input->post('delete_dokumen_plt_lampiran', TRUE);

    // Definitif
    $dok_utama = $upload_helper('dokumen_utama', $existing->dokumen_utama, $del_utama);
    $dok_lampiran = $upload_helper('dokumen_lampiran', $existing->dokumen_lampiran, $del_lampiran);

    // PK Perubahan
    $dok_perubahan_utama = $upload_helper('dokumen_perubahan_utama', $existing->dokumen_perubahan_utama, $del_perubahan_utama);
    $dok_perubahan_lampiran = $upload_helper('dokumen_perubahan_lampiran', $existing->dokumen_perubahan_lampiran, $del_perubahan_lampiran);

    // PK PLT
    $dok_plt_utama = $upload_helper('dokumen_plt_utama', $existing->dokumen_plt_utama, $del_plt_utama);
    $dok_plt_lampiran = $upload_helper('dokumen_plt_lampiran', $existing->dokumen_plt_lampiran, $del_plt_lampiran);

    $doc_time = time();
    
    // Hitung doc_id
    $definitif_doc_id = $existing->definitif_doc_id;
    if ($dok_utama || $dok_lampiran) {
        if (!$definitif_doc_id) $definitif_doc_id = 'DOC-' . $doc_time;
    } else {
        $definitif_doc_id = null;
    }

    $pk_perubahan_doc_id = $existing->pk_perubahan_doc_id;
    if ($dok_perubahan_utama || $dok_perubahan_lampiran) {
        if (!$pk_perubahan_doc_id) $pk_perubahan_doc_id = 'DOC-P-' . $doc_time;
    } else {
        $pk_perubahan_doc_id = null;
    }

    $pk_plt_doc_id = $existing->pk_plt_doc_id;
    if ($dok_plt_utama || $dok_plt_lampiran) {
        if (!$pk_plt_doc_id) $pk_plt_doc_id = 'DOC-PLT-' . $doc_time;
    } else {
        $pk_plt_doc_id = null;
    }

    $data = [
        'pegawai_pengampu_id' => $pegawai_pengampu_id,
        'atasan_langsung_id' => $atasan_langsung_id,
        'jenis_perjanjian' => $jenis_perjanjian,
        'periode_awal' => $periode_awal,
        'periode_akhir' => $periode_akhir,
        'anggaran' => $anggaran,
        'sasaran_level' => $sasaran_level,
        'sasaran_data' => $sasaran_data,
        'sub_unit' => $sub_unit,
        'definitif_doc_id' => $definitif_doc_id,
        'pk_perubahan_doc_id' => $pk_perubahan_doc_id,
        'pk_plt_doc_id' => $pk_plt_doc_id,
        'dokumen_utama' => $dok_utama,
        'dokumen_lampiran' => $dok_lampiran,
        'dokumen_perubahan_utama' => $dok_perubahan_utama,
        'dokumen_perubahan_lampiran' => $dok_perubahan_lampiran,
        'dokumen_plt_utama' => $dok_plt_utama,
        'dokumen_plt_lampiran' => $dok_plt_lampiran,
        'updated_at' => date('Y-m-d H:i:s')
    ];
    
    $this->db->where('id', $id)->update('perjanjian_kinerja', $data);
    echo json_encode(['status' => 'success', 'message' => 'Perjanjian Kinerja berhasil diperbarui']);
}

/**
 * Hapus Perjanjian Kinerja (AJAX) - Hanya Akun Instansi Role 4 pada wilayah terkait
 */
public function hapusPerjanjianKinerja() {
    if (!$this->input->is_ajax_request()) show_404();
    if (!$this->can_crud() || !$this->is_role_4()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Akun Instansi (Role 4) pada wilayah ini yang berhak menghapus data.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    if (!$id) {
        echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('perjanjian_kinerja')->row();
    if (!$existing || $existing->id_instansi != $instansi_id || $existing->kode_wilayah != $KodeWilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Data tidak ditemukan atau bukan milik Instansi Anda pada wilayah ini.']);
        return;
    }
    
    // Hapus file fisik
    $path = './uploads/perjanjian_kinerja/';
    $files = [$existing->dokumen_utama, $existing->dokumen_lampiran, $existing->dokumen_perubahan_utama, $existing->dokumen_perubahan_lampiran, $existing->dokumen_plt_utama, $existing->dokumen_plt_lampiran];
    foreach ($files as $f) {
        if ($f && file_exists($path . $f)) {
            @unlink($path . $f);
        }
    }
    
    $this->db->where('id', $id)->update('perjanjian_kinerja', ['deleted_at' => date('Y-m-d H:i:s')]);
    echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
}

/**
 * Update Status Perjanjian Kinerja (AJAX) - Khusus Akun Daerah Level 3
 */
public function updateStatusPerjanjianKinerja() {
    if (!$this->input->is_ajax_request()) show_404();
    if (!$this->is_role_3()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Akun Daerah (Level 3) yang berhak mengubah status verifikasi.']);
        return;
    }
    
    $id = (int)$this->input->post('id', TRUE);
    $status = strtolower(trim($this->input->post('status', TRUE)));
    
    if (!$id || !in_array($status, ['menunggu', 'disetujui', 'ditolak'])) {
        echo json_encode(['status' => 'error', 'message' => 'Status atau ID tidak valid!']);
        return;
    }
    
    $KodeWilayah = $this->get_kode_wilayah();
    $existing = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('perjanjian_kinerja')->row();
    
    if (!$existing || $existing->kode_wilayah != $KodeWilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan atau berada di luar wilayah Anda.']);
        return;
    }
    
    $this->db->where('id', $id)->update('perjanjian_kinerja', [
        'status' => $status,
        'updated_at' => date('Y-m-d H:i:s')
    ]);
    
    echo json_encode([
        'status' => 'success', 
        'message' => 'Status Perjanjian Kinerja berhasil diubah menjadi ' . ucfirst($status),
        'new_status' => $status
    ]);
}

    // ================================================================
    // BELANJA SUB KEGIATAN (PINDAHAN DARI DAERAH)
    // ================================================================

    private function _getKodeWilayah() {
        return $this->get_kode_wilayah();
    }

    public function BelanjaSubKegiatan() {
        $Header['Halaman'] = 'Belanja Sub Kegiatan';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE);
        $filter_instansi = $this->input->get('instansi_id', TRUE);
        
        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }
        
        // Data Provinsi untuk filter
        $Data['Provinsi'] = $this->db
            ->where("Kode LIKE '__'")
            ->order_by('Nama')
            ->get('kodewilayah')
            ->result_array();
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';
        
        // Ambil Nama Wilayah jika ada
        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }
        
        // List Instansi
        $Data['ListInstansi'] = [];
        if (!empty($KodeWilayah)) {
            $provKode = substr($KodeWilayah, 0, 2);
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where("(kodewilayah = " . $this->db->escape($KodeWilayah) . " OR kodewilayah = " . $this->db->escape($provKode) . ")")
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        } else {
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        }
        
        // Ambil daftar tahun dari database
        $dbYears = $this->db->select('DISTINCT(tahun) as thn')
            ->where('deleted_at IS NULL')
            ->order_by('tahun', 'DESC')
            ->get('belanja_sub_kegiatan_header')
            ->result_array();
        
        $listTahun = [];
        if (!empty($dbYears)) {
            foreach ($dbYears as $dy) {
                if (!empty($dy['thn'])) {
                    $listTahun[] = (int)$dy['thn'];
                }
            }
        }
        // Tambahkan rentang tahun standar
        $currentY = (int)date('Y');
        for ($y = $currentY + 1; $y >= $currentY - 5; $y--) {
            if (!in_array($y, $listTahun)) {
                $listTahun[] = $y;
            }
        }
        rsort($listTahun);
        $Data['ListTahun'] = $listTahun;
        
        // Tentukan tahun aktif
        if (empty($tahun)) {
            if (!empty($dbYears) && !empty($dbYears[0]['thn'])) {
                $tahun = $dbYears[0]['thn'];
            } else {
                $tahun = date('Y');
            }
        }
        $Data['TahunAktif'] = $tahun;
        
        // Ambil Data Belanja
        $this->db->select('h.*, COALESCE(a.nama, h.nama_perangkat_daerah) as instansi_nama')
            ->from('belanja_sub_kegiatan_header h')
            ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
            ->where('h.deleted_at IS NULL');
        
        if (!empty($KodeWilayah)) {
            $this->db->where('h.kode_wilayah', $KodeWilayah);
        }
        
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('h.tahun', $tahun);
        }
        
        if (!empty($filter_instansi)) {
            $this->db->where('h.id_instansi', (int)$filter_instansi);
        }
        
        $belanjaData = $this->db
            ->order_by('h.kode_program', 'ASC')
            ->order_by('h.kode_kegiatan', 'ASC')
            ->order_by('h.kode_sub_kegiatan', 'ASC')
            ->order_by('h.id', 'DESC')
            ->get()
            ->result_array();
        
        // Ambil rekening & rincian untuk setiap header
        if (!empty($belanjaData)) {
            $headerIds = array_column($belanjaData, 'id');
            $rekenings = $this->db
                ->where_in('header_id', $headerIds)
                ->where('deleted_at IS NULL')
                ->order_by('kode_rekening', 'ASC')
                ->get('belanja_rekening')
                ->result_array();
            
            $rincianList = [];
            if (!empty($rekenings)) {
                $rekIds = array_column($rekenings, 'id');
                $rincianRows = $this->db
                    ->where_in('rekening_id', $rekIds)
                    ->where('deleted_at IS NULL')
                    ->order_by('id', 'ASC')
                    ->get('belanja_rincian')
                    ->result_array();
                
                foreach ($rincianRows as $rinc) {
                    $rincianList[$rinc['rekening_id']][] = $rinc;
                }
            }
            
            $rekeningByHeader = [];
            foreach ($rekenings as $rek) {
                $rek['rincian'] = isset($rincianList[$rek['id']]) ? $rincianList[$rek['id']] : [];
                $rekeningByHeader[$rek['header_id']][] = $rek;
            }
            
            foreach ($belanjaData as &$item) {
                $item['rekening'] = isset($rekeningByHeader[$item['id']]) ? $rekeningByHeader[$item['id']] : [];
            }
        }
        
        $Data['BelanjaData'] = $belanjaData;
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/BelanjaSubKegiatan', $Data);
    }

    // ================================================================
    // GET BELANJA DATA (AJAX) - UNTUK FILTER TANPA RELOAD
    // ================================================================

    public function GetBelanjaData() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        $KodeWilayah = $this->get_kode_wilayah();
        $is_role_4 = $this->is_role_4();
        $instansi_id = $this->get_instansi_id();
        $tahun = $this->input->post('tahun', TRUE);
        $filter_instansi = $this->input->post('instansi', TRUE);
        
        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }
        
        $this->db->select('h.*, COALESCE(a.nama, h.nama_perangkat_daerah) as instansi_nama')
            ->from('belanja_sub_kegiatan_header h')
            ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
            ->where('h.deleted_at IS NULL');
        
        if (!empty($KodeWilayah)) {
            $this->db->where('h.kode_wilayah', $KodeWilayah);
        }
        
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('h.tahun', $tahun);
        }
        
        if (!empty($filter_instansi)) {
            $this->db->where('h.id_instansi', (int)$filter_instansi);
        }
        
        $data = $this->db
            ->order_by('h.kode_program', 'ASC')
            ->order_by('h.kode_kegiatan', 'ASC')
            ->order_by('h.kode_sub_kegiatan', 'ASC')
            ->order_by('h.id', 'DESC')
            ->get()
            ->result_array();
        
        // Ambil rekening & rincian untuk setiap header
        if (!empty($data)) {
            $headerIds = array_column($data, 'id');
            $rekenings = $this->db
                ->where_in('header_id', $headerIds)
                ->where('deleted_at IS NULL')
                ->order_by('kode_rekening', 'ASC')
                ->get('belanja_rekening')
                ->result_array();
            
            $rincianList = [];
            if (!empty($rekenings)) {
                $rekIds = array_column($rekenings, 'id');
                $rincianRows = $this->db
                    ->where_in('rekening_id', $rekIds)
                    ->where('deleted_at IS NULL')
                    ->order_by('id', 'ASC')
                    ->get('belanja_rincian')
                    ->result_array();
                
                foreach ($rincianRows as $rinc) {
                    $rincianList[$rinc['rekening_id']][] = $rinc;
                }
            }
            
            $rekeningByHeader = [];
            foreach ($rekenings as $rek) {
                $rek['rincian'] = isset($rincianList[$rek['id']]) ? $rincianList[$rek['id']] : [];
                $rekeningByHeader[$rek['header_id']][] = $rek;
            }
            
            foreach ($data as &$item) {
                $item['rekening'] = isset($rekeningByHeader[$item['id']]) ? $rekeningByHeader[$item['id']] : [];
            }
        }
        
        echo json_encode(['status' => 'success', 'data' => $data]);
    }

    // ================================================================
    // GET BELANJA BY ID (UNTUK EDIT & DETAIL)
    // ================================================================

    public function GetBelanjaById() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        $id = (int)$this->input->post('id', TRUE);
        $KodeWilayah = $this->get_kode_wilayah();
        
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $this->db
            ->select('h.*, COALESCE(a.nama, h.nama_perangkat_daerah) as instansi_nama')
            ->from('belanja_sub_kegiatan_header h')
            ->join('akun_instansi a', 'a.id = h.id_instansi', 'left')
            ->where('h.id', $id)
            ->where('h.deleted_at IS NULL');
            
        if (!empty($KodeWilayah)) {
            $this->db->where('h.kode_wilayah', $KodeWilayah);
        }
        
        $header = $this->db->get()->row_array();
        
        if (!$header) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            return;
        }
        
        // Ambil rekening
        $header['rekening'] = $this->db
            ->where('header_id', $id)
            ->where('deleted_at IS NULL')
            ->order_by('kode_rekening', 'ASC')
            ->get('belanja_rekening')
            ->result_array();
        
        // Ambil rincian untuk setiap rekening
        foreach ($header['rekening'] as &$rek) {
            $rek['rincian'] = $this->db
                ->where('rekening_id', $rek['id'])
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('belanja_rincian')
                ->result_array();
        }
        
        echo json_encode(['status' => 'success', 'data' => $header]);
    }

    // ================================================================
    // SAVE BELANJA (CREATE & UPDATE)
    // ================================================================

    public function SaveBelanja() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        try {
            $KodeWilayah = $this->get_kode_wilayah();
            if (empty($KodeWilayah)) {
                $KodeWilayah = $this->input->post('kode_wilayah', TRUE);
            }
            if (empty($KodeWilayah)) {
                $KodeWilayah = '35.73';
            }
            
            $id = (int)$this->input->post('id', TRUE);
            $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
            $id_instansi = $this->input->post('id_instansi', TRUE);
            
            // Data Header
            $data_header = [
                'kode_wilayah' => $KodeWilayah,
                'tahun' => $tahun,
                'id_instansi' => !empty($id_instansi) ? (int)$id_instansi : null,
                'kode_perangkat_daerah' => $this->input->post('kode_perangkat_daerah', TRUE),
                'nama_perangkat_daerah' => $this->input->post('nama_perangkat_daerah', TRUE),
                'kode_sub_unit' => $this->input->post('kode_sub_unit', TRUE),
                'nama_sub_unit' => $this->input->post('nama_sub_unit', TRUE),
                'kode_bidang_urusan' => $this->input->post('kode_bidang_urusan', TRUE),
                'nama_bidang_urusan' => $this->input->post('nama_bidang_urusan', TRUE),
                'kode_program' => $this->input->post('kode_program', TRUE),
                'nama_program' => $this->input->post('nama_program', TRUE),
                'kode_kegiatan' => $this->input->post('kode_kegiatan', TRUE),
                'nama_kegiatan' => $this->input->post('nama_kegiatan', TRUE),
                'kode_sub_kegiatan' => $this->input->post('kode_sub_kegiatan', TRUE),
                'nama_sub_kegiatan' => $this->input->post('nama_sub_kegiatan', TRUE),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            $this->db->trans_start();
            
            if ($id > 0) {
                // UPDATE
                $this->db->where('id', $id)->update('belanja_sub_kegiatan_header', $data_header);
                $header_id = $id;
                
                // Soft delete rincian & rekening lama
                $old_rek_ids = $this->db->select('id')->where('header_id', $id)->where('deleted_at IS NULL')->get('belanja_rekening')->result_array();
                if (!empty($old_rek_ids)) {
                    $ids = array_column($old_rek_ids, 'id');
                    $this->db->where_in('rekening_id', $ids)->update('belanja_rincian', ['deleted_at' => date('Y-m-d H:i:s')]);
                }
                $this->db->where('header_id', $id)->update('belanja_rekening', ['deleted_at' => date('Y-m-d H:i:s')]);
            } else {
                // INSERT
                $data_header['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('belanja_sub_kegiatan_header', $data_header);
                $header_id = $this->db->insert_id();
            }
            
            if (!$header_id) {
                throw new Exception('Gagal menyimpan header!');
            }
            
            // ============================================================
            // PROSES REKENING DAN RINCIAN
            // ============================================================
            $rekening_kode = $this->input->post('rekening_kode', TRUE);
            $rekening_uraian = $this->input->post('rekening_uraian', TRUE);
            $rekening_level = $this->input->post('rekening_level', TRUE);
            
            // Ambil semua rincian
            $rincian_uraian = $this->input->post('rincian_uraian', TRUE);
            $rincian_koefisien = $this->input->post('rincian_koefisien', TRUE);
            $rincian_harga = $this->input->post('rincian_harga', TRUE);
            $rincian_ppn = $this->input->post('rincian_ppn', TRUE);
            $rincian_jumlah = $this->input->post('rincian_jumlah', TRUE);
            $rincian_sumber = $this->input->post('rincian_sumber_dana', TRUE);
            $rincian_keterangan = $this->input->post('rincian_keterangan', TRUE);
            $rincian_rekening_index = $this->input->post('rincian_rekening_index', TRUE);
            
            $total_belanja = 0;
            
            if (!empty($rekening_kode) && is_array($rekening_kode)) {
                foreach ($rekening_kode as $key => $kode) {
                    if (empty(trim($kode))) continue;
                    
                    $rek_total = 0;
                    
                    // Insert rekening
                    $rek_data = [
                        'header_id' => $header_id,
                        'kode_rekening' => trim($kode),
                        'uraian_rekening' => isset($rekening_uraian[$key]) ? trim($rekening_uraian[$key]) : '',
                        'level_rekening' => isset($rekening_level[$key]) ? (int)$rekening_level[$key] : 1,
                        'created_at' => date('Y-m-d H:i:s')
                    ];
                    
                    $this->db->insert('belanja_rekening', $rek_data);
                    $rekening_id = $this->db->insert_id();
                    
                    // Insert rincian untuk rekening ini
                    if (!empty($rincian_uraian) && is_array($rincian_uraian)) {
                        foreach ($rincian_uraian as $rkey => $uraian) {
                            if (!isset($rincian_rekening_index[$rkey]) || (int)$rincian_rekening_index[$rkey] != $key) {
                                continue;
                            }
                            
                            if (empty(trim($uraian))) continue;
                            
                            $koef = isset($rincian_koefisien[$rkey]) ? (float)str_replace(',', '.', $rincian_koefisien[$rkey]) : 0;
                            $harga = isset($rincian_harga[$rkey]) ? (float)str_replace(['Rp', ' ', '.', ','], '', $rincian_harga[$rkey]) : 0;
                            $ppn = isset($rincian_ppn[$rkey]) ? (float)str_replace(',', '.', $rincian_ppn[$rkey]) : 0;
                            
                            $jumlah = isset($rincian_jumlah[$rkey]) ? (float)str_replace(['Rp', ' ', '.', ','], '', $rincian_jumlah[$rkey]) : 0;
                            if ($jumlah <= 0 && ($koef > 0 || $harga > 0)) {
                                $jumlah = round($koef * $harga * (1 + $ppn / 100));
                            }
                            
                            $rek_total += $jumlah;
                            
                            $rincian_data = [
                                'rekening_id' => $rekening_id,
                                'uraian' => trim($uraian),
                                'koefisien' => $koef,
                                'harga_satuan' => $harga,
                                'ppn' => $ppn,
                                'jumlah' => $jumlah,
                                'sumber_dana' => isset($rincian_sumber[$rkey]) ? trim($rincian_sumber[$rkey]) : null,
                                'keterangan' => isset($rincian_keterangan[$rkey]) ? trim($rincian_keterangan[$rkey]) : null,
                                'created_at' => date('Y-m-d H:i:s')
                            ];
                            
                            $this->db->insert('belanja_rincian', $rincian_data);
                        }
                    }
                    
                    // Update total rekening
                    $this->db->where('id', $rekening_id)->update('belanja_rekening', ['total' => $rek_total]);
                    $total_belanja += $rek_total;
                }
            }
            
            // Update total belanja di header
            $this->db->where('id', $header_id)->update('belanja_sub_kegiatan_header', ['total_belanja' => $total_belanja]);
            
            $this->db->trans_complete();
            
            if ($this->db->trans_status() === FALSE) {
                throw new Exception('Gagal menyimpan data!');
            }
            
            echo json_encode([
                'status' => 'success',
                'message' => $id > 0 ? 'Data berhasil diupdate!' : 'Data berhasil disimpan!',
                'id' => $header_id
            ]);
            
        } catch (Exception $e) {
            $this->db->trans_rollback();
            log_message('error', 'SaveBelanja: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // ================================================================
    // DELETE BELANJA (SOFT DELETE)
    // ================================================================

    public function DeleteBelanja() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        $id = (int)$this->input->post('id', TRUE);
        
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak valid']);
            return;
        }
        
        $this->db->trans_start();
        
        // Soft delete header
        $this->db->where('id', $id)->update('belanja_sub_kegiatan_header', ['deleted_at' => date('Y-m-d H:i:s')]);
        
        // Soft delete rincian
        $rek_ids = $this->db->select('id')->where('header_id', $id)->get('belanja_rekening')->result_array();
        if (!empty($rek_ids)) {
            $ids = array_column($rek_ids, 'id');
            $this->db->where_in('rekening_id', $ids)->update('belanja_rincian', ['deleted_at' => date('Y-m-d H:i:s')]);
        }
        
        // Soft delete rekening
        $this->db->where('header_id', $id)->update('belanja_rekening', ['deleted_at' => date('Y-m-d H:i:s')]);
        
        $this->db->trans_complete();
        
        if ($this->db->trans_status() === FALSE) {
            echo json_encode(['status' => 'error', 'message' => 'Gagal menghapus data']);
        } else {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil dihapus']);
        }
    }

    // ================================================================
    // GET INSTANSI DETAIL
    // ================================================================

    public function GetInstansiDetail() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        header('Content-Type: application/json');
        
        $id = (int)$this->input->post('id', TRUE);
        
        if ($id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID tidak valid']);
            return;
        }
        
        $data = $this->db->where('id', $id)->where('deleted_at IS NULL')->get('akun_instansi')->row_array();
        
        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    // ================================================================
    // GET REFERENSI JENIS STANDAR HARGA
    // ================================================================

    public function GetRefJenisStandarHarga() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        
        $data = $this->db
            ->order_by('nama', 'ASC')
            ->get('ref_jenis_standar_harga')
            ->result_array();
        
        echo json_encode($data);
    }

    // ================================================================
    // GET STANDAR HARGA (HSPK & ASB)
    // ================================================================

    public function GetStandarHarga() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $type = strtolower($this->input->post('type', TRUE) ?: 'hspk');
        $q = trim($this->input->post('q', TRUE) ?: '');
        $kode_rekening = trim($this->input->post('kode_rekening', TRUE) ?: '');
        $limit = (int)($this->input->post('limit', TRUE) ?: 50);

        $table = ($type === 'asb') ? 'asb_kab_banyuwangi' : 'hspk_kab_banyuwangi';

        $this->db->select('id_standar_harga, kode_barang, uraian_barang, spesifikasi, satuan, harga_satuan, kode_rekening, uraian_kelompok_barang')
            ->from($table)
            ->where('kode_barang !=', 'KODE BARANG');

        if (!empty($q)) {
            $this->db->group_start()
                ->like('uraian_barang', $q)
                ->or_like('kode_barang', $q)
                ->or_like('spesifikasi', $q)
                ->or_like('uraian_kelompok_barang', $q)
                ->group_end();
        }

        if (!empty($kode_rekening)) {
            $this->db->like('kode_rekening', $kode_rekening);
        }

        $items = $this->db->limit($limit)->get()->result_array();
        echo json_encode(['status' => 'success', 'type' => $type, 'data' => $items]);
    }

    // ================================================================
    // GET MASTER REKENING
    // ================================================================

    public function GetMasterRekening() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $q = trim($this->input->post('q', TRUE) ?: '');
        $this->db->from('master_rekening');
        if (!empty($q)) {
            $this->db->group_start()
                ->like('kode_rekening', $q)
                ->or_like('nama_rekening', $q)
                ->group_end();
        }
        $items = $this->db->order_by('kode_rekening', 'ASC')->get()->result_array();
        echo json_encode(['status' => 'success', 'data' => $items]);
    }

    // ================================================================
    // SAVE SINGLE RINCIAN ITEM (FOR MODAL TAMBAH/EDIT)
    // ================================================================
    public function SaveRincianSingleItem() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $KodeWilayah = $this->get_kode_wilayah();
            if (empty($KodeWilayah)) {
                $KodeWilayah = $this->input->post('kode_wilayah', TRUE) ?: '35.73';
            }

            $rincian_id = (int)$this->input->post('rincian_id', TRUE);
            $sub_kegiatan_kode = trim($this->input->post('sub_kegiatan_kode', TRUE));
            $tahun = trim($this->input->post('tahun', TRUE)) ?: date('Y');
            $id_instansi = (int)$this->input->post('id_instansi', TRUE);

            // Cari atau buat Header Sub Kegiatan
            $header = $this->db
                ->where('kode_sub_kegiatan', $sub_kegiatan_kode)
                ->where('tahun', $tahun)
                ->where('deleted_at IS NULL')
                ->get('belanja_sub_kegiatan_header')
                ->row_array();

            if (!$header) {
                // Buat Header baru
                $header_data = [
                    'kode_wilayah' => $KodeWilayah,
                    'tahun' => $tahun,
                    'id_instansi' => $id_instansi > 0 ? $id_instansi : null,
                    'kode_perangkat_daerah' => $this->input->post('kode_perangkat_daerah', TRUE),
                    'nama_perangkat_daerah' => $this->input->post('nama_perangkat_daerah', TRUE),
                    'kode_sub_unit' => $this->input->post('kode_sub_unit', TRUE),
                    'nama_sub_unit' => $this->input->post('nama_sub_unit', TRUE),
                    'kode_bidang_urusan' => $this->input->post('kode_bidang_urusan', TRUE),
                    'nama_bidang_urusan' => $this->input->post('nama_bidang_urusan', TRUE),
                    'kode_program' => $this->input->post('kode_program', TRUE),
                    'nama_program' => $this->input->post('nama_program', TRUE),
                    'kode_kegiatan' => $this->input->post('kode_kegiatan', TRUE),
                    'nama_kegiatan' => $this->input->post('nama_kegiatan', TRUE),
                    'kode_sub_kegiatan' => $sub_kegiatan_kode,
                    'nama_sub_kegiatan' => $this->input->post('nama_sub_kegiatan', TRUE),
                    'total_belanja' => 0,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('belanja_sub_kegiatan_header', $header_data);
                $header_id = $this->db->insert_id();
            } else {
                $header_id = $header['id'];
            }

            // Cari atau buat Rekening
            $rekening_kode = trim($this->input->post('rekening_kode', TRUE));
            $rekening_nama = trim($this->input->post('rekening_nama', TRUE));
            $rekening_level = (int)$this->input->post('rekening_level', TRUE) ?: 6;

            $rek = $this->db
                ->where('header_id', $header_id)
                ->where('kode_rekening', $rekening_kode)
                ->where('deleted_at IS NULL')
                ->get('belanja_rekening')
                ->row_array();

            if (!$rek) {
                $rek_data = [
                    'header_id' => $header_id,
                    'kode_rekening' => $rekening_kode,
                    'uraian_rekening' => $rekening_nama,
                    'level_rekening' => $rekening_level,
                    'total' => 0,
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('belanja_rekening', $rek_data);
                $rekening_id = $this->db->insert_id();
            } else {
                $rekening_id = $rek['id'];
            }

            // Hitung subtotal
            $koef = (float)str_replace(',', '.', $this->input->post('koefisien', TRUE));
            $vol = (float)str_replace(',', '.', $this->input->post('volume', TRUE) ?: '1');
            $harga = (float)str_replace(['Rp', ' ', '.', ','], '', $this->input->post('harga_satuan', TRUE));
            $ppn = (float)str_replace(',', '.', $this->input->post('ppn', TRUE) ?: '0');
            $subtotal = $koef * $vol * $harga;
            $jumlah = round($subtotal + ($subtotal * ($ppn / 100)));

            $rincian_data = [
                'rekening_id' => $rekening_id,
                'uraian' => trim($this->input->post('uraian_pengelompokan', TRUE)),
                'komponen' => trim($this->input->post('komponen', TRUE)),
                'spesifikasi_komponen' => trim($this->input->post('spesifikasi', TRUE)),
                'satuan' => trim($this->input->post('satuan', TRUE)),
                'koefisien' => $koef,
                'koefisien_volume' => $vol,
                'harga_satuan' => $harga,
                'ppn' => $ppn,
                'jumlah' => $jumlah,
                'sumber_dana' => trim($this->input->post('sumber_dana', TRUE)),
                'jenis_standar_harga' => trim($this->input->post('jenis_standar_harga', TRUE)),
                'keterangan' => trim($this->input->post('keterangan', TRUE)),
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($rincian_id > 0) {
                $this->db->where('id', $rincian_id)->update('belanja_rincian', $rincian_data);
            } else {
                $rincian_data['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('belanja_rincian', $rincian_data);
                $rincian_id = $this->db->insert_id();
            }

            // Update Total Rekening
            $rek_total = (float)$this->db->select_sum('jumlah')->where('rekening_id', $rekening_id)->where('deleted_at IS NULL')->get('belanja_rincian')->row()->jumlah;
            $this->db->where('id', $rekening_id)->update('belanja_rekening', ['total' => $rek_total]);

            // Update Total Header
            $hdr_total = (float)$this->db->select_sum('total')->where('header_id', $header_id)->where('deleted_at IS NULL')->get('belanja_rekening')->row()->total;
            $this->db->where('id', $header_id)->update('belanja_sub_kegiatan_header', ['total_belanja' => $hdr_total]);

            echo json_encode([
                'status' => 'success',
                'message' => 'Rincian belanja berhasil disimpan!',
                'rincian_id' => $rincian_id,
                'rekening_id' => $rekening_id,
                'header_id' => $header_id
            ]);

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // ================================================================
    // DELETE SINGLE RINCIAN ITEM
    // ================================================================
    public function DeleteRincianSingleItem() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $rincian_id = (int)$this->input->post('rincian_id', TRUE);
        if ($rincian_id <= 0) {
            echo json_encode(['status' => 'error', 'message' => 'ID rincian tidak valid']);
            return;
        }

        $rinc = $this->db->where('id', $rincian_id)->get('belanja_rincian')->row_array();
        if (!$rinc) {
            echo json_encode(['status' => 'error', 'message' => 'Data rincian tidak ditemukan']);
            return;
        }

        $rekening_id = $rinc['rekening_id'];
        $rek = $this->db->where('id', $rekening_id)->get('belanja_rekening')->row_array();
        $header_id = $rek ? $rek['header_id'] : 0;

        $this->db->where('id', $rincian_id)->update('belanja_rincian', ['deleted_at' => date('Y-m-d H:i:s')]);

        // Update Total Rekening
        $rek_total = (float)$this->db->select_sum('jumlah')->where('rekening_id', $rekening_id)->where('deleted_at IS NULL')->get('belanja_rincian')->row()->jumlah;
        $this->db->where('id', $rekening_id)->update('belanja_rekening', ['total' => $rek_total]);

        // Update Total Header
        if ($header_id > 0) {
            $hdr_total = (float)$this->db->select_sum('total')->where('header_id', $header_id)->where('deleted_at IS NULL')->get('belanja_rekening')->row()->total;
            $this->db->where('id', $header_id)->update('belanja_sub_kegiatan_header', ['total_belanja' => $hdr_total]);
        }

        echo json_encode(['status' => 'success', 'message' => 'Rincian belanja berhasil dihapus']);
    }

    // ================================================================
    // (OPSIONAL) EXPORT EXCEL
    // ================================================================

    public function ExportBelanjaExcel() {
        $id = (int)$this->input->get('id', TRUE);
        $KodeWilayah = $this->get_kode_wilayah();
        
        if ($id <= 0 || empty($KodeWilayah)) {
            show_404();
            return;
        }
        
        // Ambil data header
        $header = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->get('belanja_sub_kegiatan_header')
            ->row_array();
        
        if (!$header) {
            show_404();
            return;
        }
        
        // Ambil rekening dan rincian
        $header['rekening'] = $this->db
            ->where('header_id', $id)
            ->where('deleted_at IS NULL')
            ->order_by('kode_rekening', 'ASC')
            ->get('belanja_rekening')
            ->result_array();
        
        foreach ($header['rekening'] as &$rek) {
            $rek['rincian'] = $this->db
                ->where('rekening_id', $rek['id'])
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('belanja_rincian')
                ->result_array();
        }
        
        // Untuk sementara redirect ke detail
        redirect('Instansi/BelanjaSubKegiatan');
    }

    // ================================================================
    // (OPSIONAL) PRINT
    // ================================================================

    public function PrintBelanja() {
        $id = (int)$this->input->get('id', TRUE);
        $KodeWilayah = $this->get_kode_wilayah();
        
        if ($id <= 0 || empty($KodeWilayah)) {
            show_404();
            return;
        }
        
        $Data['header'] = $this->db
            ->where('id', $id)
            ->where('kode_wilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->get('belanja_sub_kegiatan_header')
            ->row_array();
        
        if (!$Data['header']) {
            show_404();
            return;
        }
        
        $Data['rekening'] = $this->db
            ->where('header_id', $id)
            ->where('deleted_at IS NULL')
            ->order_by('kode_rekening', 'ASC')
            ->get('belanja_rekening')
            ->result_array();
        
        foreach ($Data['rekening'] as &$rek) {
            $rek['rincian'] = $this->db
                ->where('rekening_id', $rek['id'])
                ->where('deleted_at IS NULL')
                ->order_by('id', 'ASC')
                ->get('belanja_rincian')
                ->result_array();
        }
        
        $this->load->view('Daerah/PrintBelanja', $Data);
    }

    // ================================================================
    // DPA (DOKUMEN PELAKSANAAN ANGGARAN)
    // ================================================================

    public function DPA() {
        $Header['Halaman'] = 'DPA';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE);
        $filter_instansi = $this->input->get('instansi_id', TRUE);
        
        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }
        
        // Data Provinsi untuk filter
        $Data['Provinsi'] = $this->db
            ->where("Kode LIKE '__'")
            ->order_by('Nama')
            ->get('kodewilayah')
            ->result_array();
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';
        
        // Ambil Nama Wilayah jika ada
        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }
        
        // List Instansi
        $Data['ListInstansi'] = [];
        if (!empty($KodeWilayah)) {
            $provKode = substr($KodeWilayah, 0, 2);
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where("(kodewilayah = " . $this->db->escape($KodeWilayah) . " OR kodewilayah = " . $this->db->escape($provKode) . ")")
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        } else {
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        }
        
        // List Tahun
        $dbYears = $this->db->select('DISTINCT(tahun) as thn')
            ->where('deleted_at IS NULL')
            ->order_by('tahun', 'DESC')
            ->get('belanja_sub_kegiatan_header')
            ->result_array();
        
        $listTahun = [];
        if (!empty($dbYears)) {
            foreach ($dbYears as $dy) {
                if (!empty($dy['thn'])) {
                    $listTahun[] = (int)$dy['thn'];
                }
            }
        }
        $currentY = (int)date('Y');
        for ($y = $currentY + 1; $y >= $currentY - 5; $y--) {
            if (!in_array($y, $listTahun)) {
                $listTahun[] = $y;
            }
        }
        rsort($listTahun);
        $Data['ListTahun'] = $listTahun;
        
        if (empty($tahun)) {
            if (!empty($dbYears) && !empty($dbYears[0]['thn'])) {
                $tahun = $dbYears[0]['thn'];
            } else {
                $tahun = date('Y');
            }
        }
        $Data['TahunAktif'] = $tahun;
        $Data['FilterInstansi'] = $filter_instansi;

        // Ambil Data Hierarki DPA
        $Data['DPAData'] = $this->_buildDPAHierarchy($KodeWilayah, $tahun, $filter_instansi);
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/DPA', $Data);
    }

    public function GetDPAData() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $KodeWilayah = $this->get_kode_wilayah();
        $is_role_4 = $this->is_role_4();
        $instansi_id = $this->get_instansi_id();
        $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
        $filter_instansi = $this->input->post('instansi', TRUE);

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        $tree = $this->_buildDPAHierarchy($KodeWilayah, $tahun, $filter_instansi);
        echo json_encode(['status' => 'success', 'data' => $tree]);
    }

    public function SaveDPARak() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $KodeWilayah = $this->get_kode_wilayah() ?: $this->input->post('kode_wilayah', TRUE) ?: '35.73';
            $tahun = (int)($this->input->post('tahun', TRUE) ?: date('Y'));
            $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
            $header_id = (int)($this->input->post('header_id', TRUE));
            $rincian_list = $this->input->post('rincian');

            if (empty($kode_sub_kegiatan)) {
                throw new Exception('Kode sub kegiatan wajib diisi!');
            }

            // Ambil data header dari belanja_sub_kegiatan_header untuk relasi FK
            $headerRow = null;
            if ($header_id > 0) {
                $headerRow = $this->db->where('id', $header_id)
                                      ->where('deleted_at IS NULL')
                                      ->get('belanja_sub_kegiatan_header')
                                      ->row_array();
            }
            if (!$headerRow) {
                // Fallback: cari header berdasarkan kode_sub_kegiatan + tahun
                $headerRow = $this->db->where('kode_sub_kegiatan', $kode_sub_kegiatan)
                                      ->where('tahun', $tahun)
                                      ->where('deleted_at IS NULL')
                                      ->get('belanja_sub_kegiatan_header')
                                      ->row_array();
            }
            // Gunakan data header untuk kode_wilayah dan id_instansi
            if ($headerRow) {
                $KodeWilayah = $headerRow['kode_wilayah'] ?: $KodeWilayah;
                $header_id = (int)$headerRow['id'];
            }
            $id_instansi = $headerRow ? (int)$headerRow['id_instansi'] : (int)$this->get_instansi_id();

            if (!empty($rincian_list) && is_array($rincian_list)) {
                foreach ($rincian_list as $item) {
                    $kode_rek = isset($item['kode']) ? trim($item['kode']) : '';
                    $uraian = isset($item['uraian']) ? trim($item['uraian']) : '';
                    $alokasi = isset($item['alokasi']) ? (float)$item['alokasi'] : 0;
                    $rincian_id = isset($item['id']) && is_numeric($item['id']) ? (int)$item['id'] : null;
                    $jenis = isset($item['jenis']) ? trim($item['jenis']) : 'operasi';
                    $sumber_dana = isset($item['sumberDana']) ? trim($item['sumberDana']) : '';
                    $lokasi = isset($item['lokasi']) ? trim($item['lokasi']) : '';

                    $monthly = isset($item['monthly']) && is_array($item['monthly']) ? $item['monthly'] : array_fill(0, 12, 0);
                    $mVal = [];
                    for ($m = 0; $m < 12; $m++) {
                        $mVal[$m] = isset($monthly[$m]) ? (float)$monthly[$m] : 0;
                    }
                    $total_rak = array_sum($mVal);
                    $selisih = $alokasi - $total_rak;

                    // Cek apakah sudah ada record di dpa_rak_rincian
                    $this->db->where('kode_sub_kegiatan', $kode_sub_kegiatan)
                             ->where('tahun', $tahun);
                    if ($rincian_id > 0) {
                        $this->db->where('rincian_id', $rincian_id);
                    } else if (!empty($kode_rek)) {
                        $this->db->where('kode_rekening', $kode_rek);
                    }
                    $existing = $this->db->where('deleted_at IS NULL')->get('dpa_rak_rincian')->row_array();

                    $data_rak = [
                        'header_id' => $header_id > 0 ? $header_id : null,
                        'id_instansi' => $id_instansi > 0 ? $id_instansi : null,
                        'kode_wilayah' => $KodeWilayah,
                        'tahun' => $tahun,
                        'kode_sub_kegiatan' => $kode_sub_kegiatan,
                        'kode_rekening' => $kode_rek,
                        'uraian' => $uraian,
                        'jenis_belanja' => $jenis,
                        'sumber_dana' => $sumber_dana,
                        'lokasi' => $lokasi,
                        'alokasi' => $alokasi,
                        'jan' => $mVal[0],
                        'feb' => $mVal[1],
                        'mar' => $mVal[2],
                        'apr' => $mVal[3],
                        'mei' => $mVal[4],
                        'jun' => $mVal[5],
                        'jul' => $mVal[6],
                        'ags' => $mVal[7],
                        'sep' => $mVal[8],
                        'okt' => $mVal[9],
                        'nov' => $mVal[10],
                        'des' => $mVal[11],
                        'total_rak' => $total_rak,
                        'selisih' => $selisih,
                        'updated_at' => date('Y-m-d H:i:s')
                    ];

                    if ($existing) {
                        $this->db->where('id', $existing['id'])->update('dpa_rak_rincian', $data_rak);
                    } else {
                        $data_rak['rincian_id'] = $rincian_id;
                        $data_rak['created_at'] = date('Y-m-d H:i:s');
                        $this->db->insert('dpa_rak_rincian', $data_rak);
                    }
                }
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Anggaran Kas (RAK) Sub Kegiatan berhasil disimpan!'
            ]);

        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function _getUrusanName($kode) {
        $map = [
            "1" => "URUSAN PEMERINTAHAN WAJIB YANG BERKAITAN DENGAN PELAYANAN DASAR",
            "2" => "URUSAN PEMERINTAHAN WAJIB YANG TIDAK BERKAITAN DENGAN PELAYANAN DASAR",
            "3" => "URUSAN PEMERINTAHAN PILIHAN",
            "4" => "UNSUR PENDUKUNG URUSAN PEMERINTAHAN",
            "5" => "UNSUR PENUNJANG URUSAN PEMERINTAHAN",
            "6" => "UNSUR PENGAWASAN URUSAN PEMERINTAHAN",
            "7" => "UNSUR KEWILAYAHAN",
            "8" => "UNSUR PEMERINTAHAN UMUM"
        ];
        return isset($map[$kode]) ? $map[$kode] : "URUSAN PEMERINTAHAN KODE " . $kode;
    }

    private function _getBidangName($kode, $fallback = '') {
        $map = [
            "1.01" => "PENDIDIKAN",
            "1.02" => "KESEHATAN",
            "1.03" => "PEKERJAAN UMUM DAN PENATAAN RUANG",
            "1.04" => "PERUMAHAN RAKYAT DAN KAWASAN PERMUKIMAN",
            "1.05" => "KETENTRAMAN DAN KETERTIBAN UMUM SERTA PERLINDUNGAN MASYARAKAT",
            "1.06" => "SOSIAL",
            "2.09" => "TENAGA KERJA",
            "2.11" => "LINGKUNGAN HIDUP",
            "2.15" => "PERHUBUNGAN",
            "2.16" => "KOMUNIKASI DAN INFORMATIKA",
            "2.17" => "KOPERASI, USAHA KECIL DAN MENENGAH",
            "5.01" => "PERENCANAAN",
            "5.02" => "KEUANGAN",
            "5.03" => "KEPEGAWAIAN, PENDIDIKAN DAN PELATIHAN"
        ];
        if (isset($map[$kode])) return $map[$kode];
        return !empty($fallback) ? strtoupper($fallback) : "BIDANG URUSAN " . $kode;
    }

    private function _buildDPAHierarchy($KodeWilayah, $tahun, $filter_instansi = null) {
        $this->db->select('*')
            ->from('belanja_sub_kegiatan_header')
            ->where('deleted_at IS NULL');

        if (!empty($KodeWilayah)) {
            $this->db->where('kode_wilayah', $KodeWilayah);
        }
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('tahun', $tahun);
        }
        if (!empty($filter_instansi)) {
            $this->db->where('id_instansi', (int)$filter_instansi);
        }

        $headers = $this->db
            ->order_by('kode_program', 'ASC')
            ->order_by('kode_kegiatan', 'ASC')
            ->order_by('kode_sub_kegiatan', 'ASC')
            ->get()
            ->result_array();

        $urusanMap = [];

        if (!empty($headers)) {
            $headerIds = array_column($headers, 'id');
            $rekenings = $this->db
                ->where_in('header_id', $headerIds)
                ->where('deleted_at IS NULL')
                ->order_by('kode_rekening', 'ASC')
                ->get('belanja_rekening')
                ->result_array();

            $rincianList = [];
            if (!empty($rekenings)) {
                $rekIds = array_column($rekenings, 'id');
                $rincianRows = $this->db
                    ->where_in('rekening_id', $rekIds)
                    ->where('deleted_at IS NULL')
                    ->order_by('id', 'ASC')
                    ->get('belanja_rincian')
                    ->result_array();

                foreach ($rincianRows as $rinc) {
                    $rincianList[$rinc['rekening_id']][] = $rinc;
                }
            }

            $rekeningByHeader = [];
            foreach ($rekenings as $rek) {
                $rek['rincian'] = isset($rincianList[$rek['id']]) ? $rincianList[$rek['id']] : [];
                $rekeningByHeader[$rek['header_id']][] = $rek;
            }

            // Ambil semua data RAK tersimpan untuk tahun ini
            $rakSaved = $this->db
                ->where('tahun', $tahun)
                ->where('deleted_at IS NULL')
                ->get('dpa_rak_rincian')
                ->result_array();
            
            $rakMapByRincianId = [];
            $rakMapBySubKegKode = [];
            foreach ($rakSaved as $rs) {
                if (!empty($rs['rincian_id'])) {
                    $rakMapByRincianId[$rs['rincian_id']] = $rs;
                }
                $key = $rs['kode_sub_kegiatan'] . '_' . $rs['kode_rekening'];
                $rakMapBySubKegKode[$key] = $rs;
            }

            foreach ($headers as $h) {
                $subKegKode = $h['kode_sub_kegiatan'] ?: '5.01.01.1.01.01';
                $kegKode = $h['kode_kegiatan'] ?: substr($subKegKode, 0, 13);
                $progKode = $h['kode_program'] ?: substr($kegKode, 0, 7);
                $bidangKode = $h['kode_bidang_urusan'] ?: substr($progKode, 0, 4);
                $urusanKode = substr($bidangKode, 0, 1);

                if (!isset($urusanMap[$urusanKode])) {
                    $urusanMap[$urusanKode] = [
                        'kode' => $urusanKode,
                        'uraian' => $this->_getUrusanName($urusanKode),
                        'bidang' => []
                    ];
                }

                if (!isset($urusanMap[$urusanKode]['bidang'][$bidangKode])) {
                    $urusanMap[$urusanKode]['bidang'][$bidangKode] = [
                        'kode' => $bidangKode,
                        'uraian' => $this->_getBidangName($bidangKode, $h['nama_bidang_urusan']),
                        'program' => []
                    ];
                }

                if (!isset($urusanMap[$urusanKode]['bidang'][$bidangKode]['program'][$progKode])) {
                    $urusanMap[$urusanKode]['bidang'][$bidangKode]['program'][$progKode] = [
                        'kode' => $progKode,
                        'uraian' => $h['nama_program'] ?: 'PROGRAM ' . $progKode,
                        'kegiatan' => []
                    ];
                }

                if (!isset($urusanMap[$urusanKode]['bidang'][$bidangKode]['program'][$progKode]['kegiatan'][$kegKode])) {
                    $urusanMap[$urusanKode]['bidang'][$bidangKode]['program'][$progKode]['kegiatan'][$kegKode] = [
                        'kode' => $kegKode,
                        'uraian' => $h['nama_kegiatan'] ?: 'KEGIATAN ' . $kegKode,
                        'subKegiatan' => []
                    ];
                }

                // Format rincian items
                $rList = [];
                $hReks = isset($rekeningByHeader[$h['id']]) ? $rekeningByHeader[$h['id']] : [];
                foreach ($hReks as $rek) {
                    $rekRincs = isset($rek['rincian']) ? $rek['rincian'] : [];
                    foreach ($rekRincs as $rinc) {
                        $rId = (int)$rinc['id'];
                        $m = array_fill(0, 12, 0);

                        $kKey = $subKegKode . '_' . $rek['kode_rekening'];
                        $rakRow = isset($rakMapByRincianId[$rId]) ? $rakMapByRincianId[$rId] : (isset($rakMapBySubKegKode[$kKey]) ? $rakMapBySubKegKode[$kKey] : null);
                        
                        if ($rakRow) {
                            $m = [
                                (float)$rakRow['jan'], (float)$rakRow['feb'], (float)$rakRow['mar'],
                                (float)$rakRow['apr'], (float)$rakRow['mei'], (float)$rakRow['jun'],
                                (float)$rakRow['jul'], (float)$rakRow['ags'], (float)$rakRow['sep'],
                                (float)$rakRow['okt'], (float)$rakRow['nov'], (float)$rakRow['des']
                            ];
                        }

                        $rList[] = [
                            'id' => $rId,
                            'kode' => $rek['kode_rekening'],
                            'uraian' => $rinc['uraian'] ?: ($rinc['komponen'] ?: $rek['uraian_rekening']),
                            'jenis' => (strpos($rek['kode_rekening'], '5.2') === 0) ? 'modal' : ((strpos($rek['kode_rekening'], '5.3') === 0) ? 'tidakTerduga' : ((strpos($rek['kode_rekening'], '5.4') === 0) ? 'transfer' : 'operasi')),
                            'sumberDana' => $rinc['sumber_dana'] ?: 'Pendapatan Bagi Hasil',
                            'lokasi' => 'Kab. Bojonegoro, Semua Kecamatan, Semua Kelurahan/Desa',
                            'alokasi' => (float)$rinc['jumlah'],
                            'monthly' => $m
                        ];
                    }
                }

                $subKegData = [
                    'id' => $h['id'],
                    'headerId' => (int)$h['id'],
                    'idInstansi' => (int)$h['id_instansi'],
                    'kode' => $subKegKode,
                    'uraian' => $h['nama_sub_kegiatan'] ?: 'Sub Kegiatan ' . $subKegKode,
                    'perangkatDaerah' => $h['nama_perangkat_daerah'] ?: '',
                    'sumberDana' => count($rList) > 0 && !empty($rList[0]['sumberDana']) ? $rList[0]['sumberDana'] : 'Pendapatan Bagi Hasil',
                    'lokasi' => 'Kab. Bojonegoro, Semua Kecamatan, Semua Kelurahan/Desa',
                    'totalBelanja' => (float)$h['total_belanja'],
                    'flagged' => false,
                    'rincian' => $rList
                ];

                $urusanMap[$urusanKode]['bidang'][$bidangKode]['program'][$progKode]['kegiatan'][$kegKode]['subKegiatan'][] = $subKegData;
            }
        }

        // Convert associative maps to clean arrays
        $result = [];
        foreach ($urusanMap as $u) {
            $uItem = ['kode' => $u['kode'], 'uraian' => $u['uraian'], 'bidang' => []];
            foreach ($u['bidang'] as $b) {
                $bItem = ['kode' => $b['kode'], 'uraian' => $b['uraian'], 'program' => []];
                foreach ($b['program'] as $p) {
                    $pItem = ['kode' => $p['kode'], 'uraian' => $p['uraian'], 'kegiatan' => []];
                    foreach ($p['kegiatan'] as $k) {
                        $kItem = ['kode' => $k['kode'], 'uraian' => $k['uraian'], 'subKegiatan' => $k['subKegiatan']];
                        $pItem['kegiatan'][] = $kItem;
                    }
                    $bItem['program'][] = $pItem;
                }
                $uItem['bidang'][] = $bItem;
            }
            $result[] = $uItem;
        }

        return $result;
    }

    // ================================================================
    // TARGET RENAKSI (RENCANA AKSI & TARGET KINERJA)
    // ================================================================

    public function TargetRenaksi() {
        $Header['Halaman'] = 'Target Renaksi';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE);
        $filter_instansi = $this->input->get('instansi_id', TRUE);
        
        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }
        
        // Data Provinsi untuk filter
        $Data['Provinsi'] = $this->db
            ->where("Kode LIKE '__'")
            ->order_by('Nama')
            ->get('kodewilayah')
            ->result_array();
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';
        
        // Ambil Nama Wilayah jika ada
        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }
        
        // List Instansi
        $Data['ListInstansi'] = [];
        if (!empty($KodeWilayah)) {
            $provKode = substr($KodeWilayah, 0, 2);
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where("(kodewilayah = " . $this->db->escape($KodeWilayah) . " OR kodewilayah = " . $this->db->escape($provKode) . ")")
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        } else {
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        }
        
        // List Tahun
        $dbYears = $this->db->select('DISTINCT(tahun) as thn')
            ->where('deleted_at IS NULL')
            ->order_by('tahun', 'DESC')
            ->get('belanja_sub_kegiatan_header')
            ->result_array();
        
        $listTahun = [];
        if (!empty($dbYears)) {
            foreach ($dbYears as $dy) {
                if (!empty($dy['thn'])) {
                    $listTahun[] = (int)$dy['thn'];
                }
            }
        }
        $currentY = (int)date('Y');
        for ($y = $currentY + 1; $y >= $currentY - 5; $y--) {
            if (!in_array($y, $listTahun)) {
                $listTahun[] = $y;
            }
        }
        rsort($listTahun);
        $Data['ListTahun'] = $listTahun;
        
        if (empty($tahun)) {
            if (!empty($dbYears) && !empty($dbYears[0]['thn'])) {
                $tahun = $dbYears[0]['thn'];
            } else {
                $tahun = date('Y');
            }
        }
        $Data['TahunAktif'] = $tahun;
        $Data['FilterInstansi'] = $filter_instansi;

        // Ambil Data Hierarki Target Renaksi
        $Data['RenaksiTree'] = $this->_buildTargetRenaksiHierarchy($KodeWilayah, $tahun, $filter_instansi);
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/TargetRenaksi', $Data);
    }

    public function GetTargetRenaksiData() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $KodeWilayah = $this->get_kode_wilayah();
        $is_role_4 = $this->is_role_4();
        $instansi_id = $this->get_instansi_id();
        $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
        $filter_instansi = $this->input->post('instansi', TRUE);

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        $tree = $this->_buildTargetRenaksiHierarchy($KodeWilayah, $tahun, $filter_instansi);
        echo json_encode(['status' => 'success', 'data' => $tree]);
    }

    public function GetSubKegiatanTargetDetail() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $header_id = (int)$this->input->post('header_id', TRUE);
        $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
        $tahun = (int)($this->input->post('tahun', TRUE) ?: date('Y'));

        $this->db->where('deleted_at IS NULL');
        if ($header_id > 0) {
            $this->db->where('id', $header_id);
        } else if (!empty($kode_sub_kegiatan)) {
            $this->db->where('kode_sub_kegiatan', $kode_sub_kegiatan)->where('tahun', $tahun);
        }
        $header = $this->db->get('belanja_sub_kegiatan_header')->row_array();

        if (!$header) {
            echo json_encode(['status' => 'error', 'message' => 'Data Sub Kegiatan tidak ditemukan.']);
            return;
        }

        $hId = (int)$header['id'];
        $subKode = $header['kode_sub_kegiatan'];
        $thn = (int)$header['tahun'];

        // Indikator Sub Kegiatan
        $indikators = $this->db
            ->where('deleted_at IS NULL')
            ->group_start()
                ->where('header_id', $hId)
                ->or_group_start()
                    ->where('entity_code', $subKode)
                    ->where('tahun', $thn)
                ->group_end()
            ->group_end()
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get('target_renaksi_indikator')
            ->result_array();

        // Target Anggaran Bulanan
        $anggaran = $this->db
            ->where('deleted_at IS NULL')
            ->group_start()
                ->where('header_id', $hId)
                ->or_group_start()
                    ->where('kode_sub_kegiatan', $subKode)
                    ->where('tahun', $thn)
                ->group_end()
            ->group_end()
            ->get('target_renaksi_anggaran_bulanan')
            ->row_array();

        // Fallback RAK DPA jika anggaran renaksi belum tersimpan
        if (!$anggaran) {
            $rakRows = $this->db
                ->where('tahun', $thn)
                ->where('kode_sub_kegiatan', $subKode)
                ->where('deleted_at IS NULL')
                ->get('dpa_rak_rincian')
                ->result_array();

            $m = array_fill(0, 12, 0);
            $totalRak = 0;
            if (!empty($rakRows)) {
                foreach ($rakRows as $r) {
                    $m[0] += (float)$r['jan'];
                    $m[1] += (float)$r['feb'];
                    $m[2] += (float)$r['mar'];
                    $m[3] += (float)$r['apr'];
                    $m[4] += (float)$r['mei'];
                    $m[5] += (float)$r['jun'];
                    $m[6] += (float)$r['jul'];
                    $m[7] += (float)$r['ags'];
                    $m[8] += (float)$r['sep'];
                    $m[9] += (float)$r['okt'];
                    $m[10] += (float)$r['nov'];
                    $m[11] += (float)$r['des'];
                    $totalRak += (float)$r['total_rak'];
                }
            } else {
                $totalRak = (float)$header['total_belanja'];
            }

            $anggaran = [
                'jan' => $m[0], 'feb' => $m[1], 'mar' => $m[2], 'apr' => $m[3],
                'mei' => $m[4], 'jun' => $m[5], 'jul' => $m[6], 'ags' => $m[7],
                'sep' => $m[8], 'okt' => $m[9], 'nov' => $m[10], 'des' => $m[11],
                'total_anggaran' => $totalRak
            ];
        }

        // Tahapan Proses
        $tahapan = $this->db
            ->where('deleted_at IS NULL')
            ->group_start()
                ->where('header_id', $hId)
                ->or_group_start()
                    ->where('kode_sub_kegiatan', $subKode)
                    ->where('tahun', $thn)
                ->group_end()
            ->group_end()
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get('target_renaksi_tahapan_proses')
            ->result_array();

        echo json_encode([
            'status' => 'success',
            'data' => [
                'header' => $header,
                'indikators' => $indikators,
                'anggaranBulanan' => $anggaran,
                'tahapanProses' => $tahapan
            ]
        ]);
    }

    public function SaveTargetRenaksiSubKegiatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $header_id = (int)$this->input->post('header_id', TRUE);
            $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
            $tahun = (int)($this->input->post('tahun', TRUE) ?: date('Y'));
            $kode_wilayah = $this->input->post('kode_wilayah', TRUE) ?: $this->get_kode_wilayah() ?: '35.73';
            $id_instansi = (int)($this->input->post('id_instansi', TRUE) ?: $this->get_instansi_id() ?: 1);

            $header = null;
            if ($header_id > 0) {
                $header = $this->db->where('id', $header_id)->where('deleted_at IS NULL')->get('belanja_sub_kegiatan_header')->row_array();
            }
            if (!$header && !empty($kode_sub_kegiatan)) {
                $header = $this->db->where('kode_sub_kegiatan', $kode_sub_kegiatan)->where('tahun', $tahun)->where('deleted_at IS NULL')->get('belanja_sub_kegiatan_header')->row_array();
            }

            if ($header) {
                $header_id = (int)$header['id'];
                $kode_sub_kegiatan = $header['kode_sub_kegiatan'];
                $kode_wilayah = $header['kode_wilayah'] ?: $kode_wilayah;
                $id_instansi = $header['id_instansi'] ? (int)$header['id_instansi'] : $id_instansi;
            }

            $indikators = $this->input->post('indikators');
            $anggaran = $this->input->post('anggaran_bulanan');
            $tahapan = $this->input->post('tahapan_proses');

            $this->db->trans_begin();
            $now = date('Y-m-d H:i:s');

            // 1. Simpan Anggaran Bulanan
            if (!empty($anggaran) && is_array($anggaran)) {
                $mJan = isset($anggaran['jan']) ? (float)$anggaran['jan'] : 0;
                $mFeb = isset($anggaran['feb']) ? (float)$anggaran['feb'] : 0;
                $mMar = isset($anggaran['mar']) ? (float)$anggaran['mar'] : 0;
                $mApr = isset($anggaran['apr']) ? (float)$anggaran['apr'] : 0;
                $mMei = isset($anggaran['mei']) ? (float)$anggaran['mei'] : 0;
                $mJun = isset($anggaran['jun']) ? (float)$anggaran['jun'] : 0;
                $mJul = isset($anggaran['jul']) ? (float)$anggaran['jul'] : 0;
                $mAgs = isset($anggaran['ags']) ? (float)$anggaran['ags'] : (isset($anggaran['agu']) ? (float)$anggaran['agu'] : 0);
                $mSep = isset($anggaran['sep']) ? (float)$anggaran['sep'] : 0;
                $mOkt = isset($anggaran['okt']) ? (float)$anggaran['okt'] : 0;
                $mNov = isset($anggaran['nov']) ? (float)$anggaran['nov'] : 0;
                $mDes = isset($anggaran['des']) ? (float)$anggaran['des'] : 0;
                $totAng = $mJan + $mFeb + $mMar + $mApr + $mMei + $mJun + $mJul + $mAgs + $mSep + $mOkt + $mNov + $mDes;

                $existAng = $this->db
                    ->where('deleted_at IS NULL')
                    ->group_start()
                        ->where('header_id', $header_id)
                        ->or_group_start()
                            ->where('kode_sub_kegiatan', $kode_sub_kegiatan)
                            ->where('tahun', $tahun)
                        ->group_end()
                    ->group_end()
                    ->get('target_renaksi_anggaran_bulanan')
                    ->row_array();

                $angData = [
                    'header_id' => $header_id,
                    'kode_wilayah' => $kode_wilayah,
                    'tahun' => $tahun,
                    'id_instansi' => $id_instansi,
                    'kode_sub_kegiatan' => $kode_sub_kegiatan,
                    'jan' => $mJan, 'feb' => $mFeb, 'mar' => $mMar, 'apr' => $mApr,
                    'mei' => $mMei, 'jun' => $mJun, 'jul' => $mJul, 'ags' => $mAgs,
                    'sep' => $mSep, 'okt' => $mOkt, 'nov' => $mNov, 'des' => $mDes,
                    'total_anggaran' => $totAng,
                    'updated_at' => $now
                ];

                if ($existAng) {
                    $this->db->where('id', $existAng['id'])->update('target_renaksi_anggaran_bulanan', $angData);
                } else {
                    $angData['created_at'] = $now;
                    $this->db->insert('target_renaksi_anggaran_bulanan', $angData);
                }
            }

            // 2. Simpan Indikators
            $savedIndikatorIds = [];
            $indCount = 0;
            if (!empty($indikators) && is_array($indikators)) {
                $indCount = count($indikators);
                foreach ($indikators as $idx => $ind) {
                    $indId = isset($ind['id']) && is_numeric($ind['id']) ? (int)$ind['id'] : 0;
                    $uraian = isset($ind['uraian']) ? trim($ind['uraian']) : (isset($ind['nama']) ? trim($ind['nama']) : '');
                    $satuan = isset($ind['satuan']) ? trim($ind['satuan']) : '';
                    $targetTahunan = isset($ind['targetTahunan']) ? (float)$ind['targetTahunan'] : (isset($ind['target_tahunan']) ? (float)$ind['target_tahunan'] : 0);
                    $tw1 = (isset($ind['tw1']) && $ind['tw1'] !== '' && $ind['tw1'] !== null) ? (float)$ind['tw1'] : null;
                    $tw2 = (isset($ind['tw2']) && $ind['tw2'] !== '' && $ind['tw2'] !== null) ? (float)$ind['tw2'] : null;
                    $tw3 = (isset($ind['tw3']) && $ind['tw3'] !== '' && $ind['tw3'] !== null) ? (float)$ind['tw3'] : null;
                    $tw4 = (isset($ind['tw4']) && $ind['tw4'] !== '' && $ind['tw4'] !== null) ? (float)$ind['tw4'] : null;

                    if (empty($uraian)) continue;

                    // Hitung Validitas: TW sum vs Target Tahunan
                    $sumTw = ($tw1 ?: 0) + ($tw2 ?: 0) + ($tw3 ?: 0) + ($tw4 ?: 0);
                    $validitas = (abs($sumTw - $targetTahunan) < 0.0001) ? 'Valid' : 'Invalid';

                    $indRow = [
                        'header_id' => $header_id,
                        'kode_wilayah' => $kode_wilayah,
                        'tahun' => $tahun,
                        'id_instansi' => $id_instansi,
                        'level_type' => 'sub_kegiatan',
                        'entity_code' => $kode_sub_kegiatan,
                        'entity_name' => $header ? $header['nama_sub_kegiatan'] : '',
                        'uraian_indikator' => $uraian,
                        'satuan' => $satuan,
                        'target_tahunan' => $targetTahunan,
                        'tw1' => $tw1,
                        'tw2' => $tw2,
                        'tw3' => $tw3,
                        'tw4' => $tw4,
                        'validitas' => $validitas,
                        'urutan' => $idx + 1,
                        'updated_at' => $now
                    ];

                    if ($indId > 0) {
                        $this->db->where('id', $indId)->update('target_renaksi_indikator', $indRow);
                        $savedIndikatorIds[] = $indId;
                    } else {
                        $indRow['created_at'] = $now;
                        $this->db->insert('target_renaksi_indikator', $indRow);
                        $savedIndikatorIds[] = $this->db->insert_id();
                    }
                }

                // Hapus indikator lama yang tidak ada lagi di submit
                if (!empty($savedIndikatorIds)) {
                    $this->db->where('level_type', 'sub_kegiatan')
                        ->group_start()
                            ->where('header_id', $header_id)
                            ->or_group_start()
                                ->where('entity_code', $kode_sub_kegiatan)
                                ->where('tahun', $tahun)
                            ->group_end()
                        ->group_end()
                        ->where_not_in('id', $savedIndikatorIds)
                        ->update('target_renaksi_indikator', ['deleted_at' => $now]);
                }
            }

            // 3. Simpan Tahapan Proses
            $this->db->where('header_id', $header_id)
                ->or_group_start()
                    ->where('kode_sub_kegiatan', $kode_sub_kegiatan)
                    ->where('tahun', $tahun)
                ->group_end()
                ->delete('target_renaksi_tahapan_proses');

            $jumlahIndikator = max($indCount, 1);
            if (!empty($tahapan) && is_array($tahapan)) {
                foreach ($tahapan as $tIdx => $tRow) {
                    $uraian = isset($tRow['uraian']) ? trim($tRow['uraian']) : '';
                    $nilai = isset($tRow['nilai']) && $tRow['nilai'] !== '' ? (float)$tRow['nilai'] : 0;
                    $satuan = isset($tRow['satuan']) ? trim($tRow['satuan']) : '';
                    $bobotOutput = isset($tRow['bobot']) ? (float)$tRow['bobot'] : (isset($tRow['bobot_output']) ? (float)$tRow['bobot_output'] : 0);
                    $bulan = isset($tRow['bulan']) ? trim($tRow['bulan']) : '';
                    $ket = isset($tRow['keterangan']) ? trim($tRow['keterangan']) : (isset($tRow['ket']) ? trim($tRow['ket']) : '');
                    
                    // Rumus: Bobot Sub Kegiatan = Bobot Output / Jumlah Indikator
                    $bobotSubKeg = $bobotOutput / $jumlahIndikator;

                    if (!empty($uraian) || $nilai > 0 || !empty($satuan) || $bobotOutput > 0 || !empty($bulan)) {
                        $this->db->insert('target_renaksi_tahapan_proses', [
                            'header_id' => $header_id,
                            'indikator_id' => isset($savedIndikatorIds[0]) ? $savedIndikatorIds[0] : null,
                            'kode_wilayah' => $kode_wilayah,
                            'tahun' => $tahun,
                            'id_instansi' => $id_instansi,
                            'kode_sub_kegiatan' => $kode_sub_kegiatan,
                            'uraian' => $uraian,
                            'target_output_nilai' => $nilai,
                            'target_output_satuan' => $satuan,
                            'bobot_kinerja_output' => $bobotOutput,
                            'rencana_bulan' => $bulan,
                            'bobot_kinerja_sub_kegiatan' => round($bobotSubKeg, 2),
                            'keterangan' => $ket,
                            'urutan' => $tIdx + 1,
                            'created_at' => $now
                        ]);
                    }
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Gagal menyimpan ke database.');
            } else {
                $this->db->trans_commit();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Target Renaksi Sasaran Sub Kegiatan berhasil disimpan!'
                ]);
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function SaveTargetRenaksiHierarchy() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $level_type = $this->input->post('level_type', TRUE);
            $entity_code = trim($this->input->post('entity_code', TRUE));
            $entity_name = trim($this->input->post('entity_name', TRUE));
            $nomenklatur = trim($this->input->post('nomenklatur', TRUE));
            $tahun = (int)($this->input->post('tahun', TRUE) ?: date('Y'));
            $kode_wilayah = $this->input->post('kode_wilayah', TRUE) ?: $this->get_kode_wilayah() ?: '35.73';
            $id_instansi = (int)($this->input->post('id_instansi', TRUE) ?: $this->get_instansi_id() ?: 1);
            $indikators = $this->input->post('indikators');

            if (empty($level_type) || empty($entity_code)) {
                throw new Exception('Data level atau kode entitas tidak valid.');
            }

            $this->db->trans_begin();
            $now = date('Y-m-d H:i:s');

            if (!empty($indikators) && is_array($indikators)) {
                foreach ($indikators as $idx => $ind) {
                    $indId = isset($ind['id']) && is_numeric($ind['id']) ? (int)$ind['id'] : 0;
                    $nama = isset($ind['nama']) ? trim($ind['nama']) : '';
                    $satuan = isset($ind['satuan']) ? trim($ind['satuan']) : '';
                    $targetTahunan = isset($ind['targetTahunan']) ? (float)$ind['targetTahunan'] : 0;
                    $tw1 = (isset($ind['tw1']) && $ind['tw1'] !== '' && $ind['tw1'] !== null) ? (float)$ind['tw1'] : null;
                    $tw2 = (isset($ind['tw2']) && $ind['tw2'] !== '' && $ind['tw2'] !== null) ? (float)$ind['tw2'] : null;
                    $tw3 = (isset($ind['tw3']) && $ind['tw3'] !== '' && $ind['tw3'] !== null) ? (float)$ind['tw3'] : null;
                    $tw4 = (isset($ind['tw4']) && $ind['tw4'] !== '' && $ind['tw4'] !== null) ? (float)$ind['tw4'] : null;

                    if (empty($nama) && $indId <= 0) continue;

                    $hierRow = [
                        'kode_wilayah' => $kode_wilayah,
                        'tahun' => $tahun,
                        'id_instansi' => $id_instansi,
                        'level_type' => $level_type,
                        'entity_code' => $entity_code,
                        'entity_name' => $entity_name,
                        'nomenklatur' => $nomenklatur,
                        'indikator_nama' => $nama,
                        'satuan' => $satuan,
                        'target_tahunan' => $targetTahunan,
                        'tw1' => $tw1,
                        'tw2' => $tw2,
                        'tw3' => $tw3,
                        'tw4' => $tw4,
                        'urutan' => $idx + 1,
                        'updated_at' => $now
                    ];

                    if ($indId > 0) {
                        $this->db->where('id', $indId)->update('target_renaksi_hierarchy', $hierRow);
                    } else {
                        $exist = $this->db->where('level_type', $level_type)
                            ->where('entity_code', $entity_code)
                            ->where('indikator_nama', $nama)
                            ->where('tahun', $tahun)
                            ->where('deleted_at IS NULL')
                            ->get('target_renaksi_hierarchy')
                            ->row_array();

                        if ($exist) {
                            $this->db->where('id', $exist['id'])->update('target_renaksi_hierarchy', $hierRow);
                        } else {
                            $hierRow['created_at'] = $now;
                            $this->db->insert('target_renaksi_hierarchy', $hierRow);
                        }
                    }
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Gagal menyimpan target hierarki.');
            } else {
                $this->db->trans_commit();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Target Kinerja Triwulan berhasil disimpan!'
                ]);
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function SyncDPAAnggaran() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $tahun = (int)($this->input->post('tahun', TRUE) ?: date('Y'));
            $instansi_id = $this->input->post('instansi_id', TRUE);
            $kode_wilayah = $this->get_kode_wilayah() ?: '35.73';

            $this->db->where('tahun', $tahun)->where('deleted_at IS NULL');
            if (!empty($instansi_id)) {
                $this->db->where('id_instansi', (int)$instansi_id);
            }
            $headers = $this->db->get('belanja_sub_kegiatan_header')->result_array();

            $syncedCount = 0;
            $now = date('Y-m-d H:i:s');

            foreach ($headers as $h) {
                $hId = (int)$h['id'];
                $subKode = $h['kode_sub_kegiatan'];

                // Ambil RAK DPA
                $rakRows = $this->db->where('tahun', $tahun)
                    ->where('kode_sub_kegiatan', $subKode)
                    ->where('deleted_at IS NULL')
                    ->get('dpa_rak_rincian')
                    ->result_array();

                $m = array_fill(0, 12, 0);
                $totalRak = 0;
                if (!empty($rakRows)) {
                    foreach ($rakRows as $r) {
                        $m[0] += (float)$r['jan'];
                        $m[1] += (float)$r['feb'];
                        $m[2] += (float)$r['mar'];
                        $m[3] += (float)$r['apr'];
                        $m[4] += (float)$r['mei'];
                        $m[5] += (float)$r['jun'];
                        $m[6] += (float)$r['jul'];
                        $m[7] += (float)$r['ags'];
                        $m[8] += (float)$r['sep'];
                        $m[9] += (float)$r['okt'];
                        $m[10] += (float)$r['nov'];
                        $m[11] += (float)$r['des'];
                        $totalRak += (float)$r['total_rak'];
                    }
                } else {
                    $totalRak = (float)$h['total_belanja'];
                }

                $exist = $this->db->where('deleted_at IS NULL')
                    ->group_start()
                        ->where('header_id', $hId)
                        ->or_group_start()
                            ->where('kode_sub_kegiatan', $subKode)
                            ->where('tahun', $tahun)
                        ->group_end()
                    ->group_end()
                    ->get('target_renaksi_anggaran_bulanan')
                    ->row_array();

                $angData = [
                    'header_id' => $hId,
                    'kode_wilayah' => $h['kode_wilayah'] ?: $kode_wilayah,
                    'tahun' => $tahun,
                    'id_instansi' => $h['id_instansi'],
                    'kode_sub_kegiatan' => $subKode,
                    'jan' => $m[0], 'feb' => $m[1], 'mar' => $m[2], 'apr' => $m[3],
                    'mei' => $m[4], 'jun' => $m[5], 'jul' => $m[6], 'ags' => $m[7],
                    'sep' => $m[8], 'okt' => $m[9], 'nov' => $m[10], 'des' => $m[11],
                    'total_anggaran' => $totalRak,
                    'updated_at' => $now
                ];

                if ($exist) {
                    $this->db->where('id', $exist['id'])->update('target_renaksi_anggaran_bulanan', $angData);
                } else {
                    $angData['created_at'] = $now;
                    $this->db->insert('target_renaksi_anggaran_bulanan', $angData);
                }
                $syncedCount++;
            }

            echo json_encode([
                'status' => 'success',
                'message' => "Berhasil menyinkronkan $syncedCount data anggaran kas DPA ke Target Renaksi!"
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function _buildTargetRenaksiHierarchy($KodeWilayah, $tahun, $filter_instansi = null) {
        // 1. Ambil data headers belanja sub kegiatan
        $this->db->select('*')
            ->from('belanja_sub_kegiatan_header')
            ->where('deleted_at IS NULL');

        if (!empty($KodeWilayah)) {
            $this->db->where('kode_wilayah', $KodeWilayah);
        }
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('tahun', $tahun);
        }
        if (!empty($filter_instansi)) {
            $this->db->where('id_instansi', (int)$filter_instansi);
        }

        $headers = $this->db
            ->order_by('kode_program', 'ASC')
            ->order_by('kode_kegiatan', 'ASC')
            ->order_by('kode_sub_kegiatan', 'ASC')
            ->get()
            ->result_array();

        // 2. Ambil data indikator sub kegiatan
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('tahun', $tahun);
        }
        $indikatorsSaved = $this->db
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get('target_renaksi_indikator')
            ->result_array();

        $indikatorMap = [];
        foreach ($indikatorsSaved as $ind) {
            $item = [
                'id' => (string)$ind['id'],
                'nama' => $ind['uraian_indikator'],
                'satuan' => $ind['satuan'] ?: 'Dokumen',
                'targetTahunan' => $ind['target_tahunan'] !== null ? (float)$ind['target_tahunan'] : 1,
                'tw1' => $ind['tw1'] !== null ? (float)$ind['tw1'] : null,
                'tw2' => $ind['tw2'] !== null ? (float)$ind['tw2'] : null,
                'tw3' => $ind['tw3'] !== null ? (float)$ind['tw3'] : null,
                'tw4' => $ind['tw4'] !== null ? (float)$ind['tw4'] : null,
                'validitas' => $ind['validitas'] ?: 'Valid'
            ];
            if (!empty($ind['header_id'])) {
                $indikatorMap['h_' . $ind['header_id']][] = $item;
            }
            if (!empty($ind['entity_code'])) {
                $indikatorMap['c_' . $ind['entity_code']][] = $item;
            }
        }

        // 3. Ambil data tahapan proses
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('tahun', $tahun);
        }
        $tahapanSaved = $this->db
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get('target_renaksi_tahapan_proses')
            ->result_array();

        $tahapanMap = [];
        foreach ($tahapanSaved as $tp) {
            $item = [
                'id' => (string)$tp['id'],
                'uraian' => $tp['uraian'],
                'nilai' => $tp['target_output_nilai'] !== null ? (float)$tp['target_output_nilai'] : 1,
                'satuan' => $tp['target_output_satuan'] ?: 'berkas',
                'bobot' => $tp['bobot_kinerja_output'] !== null ? (float)$tp['bobot_kinerja_output'] : 0,
                'bulan' => $tp['rencana_bulan'] ?: 'Januari',
                'bobotSubKeg' => $tp['bobot_kinerja_sub_kegiatan'] !== null ? (float)$tp['bobot_kinerja_sub_kegiatan'] : 0,
                'keterangan' => $tp['keterangan'] ?: ''
            ];
            if (!empty($tp['header_id'])) {
                $tahapanMap['h_' . $tp['header_id']][] = $item;
            }
            if (!empty($tp['kode_sub_kegiatan'])) {
                $tahapanMap['c_' . $tp['kode_sub_kegiatan']][] = $item;
            }
        }

        // 4. Ambil data anggaran bulanan
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('tahun', $tahun);
        }
        $anggaranSaved = $this->db
            ->get('target_renaksi_anggaran_bulanan')
            ->result_array();

        $anggaranMap = [];
        foreach ($anggaranSaved as $ang) {
            $pagu = [
                'jan' => (float)$ang['jan'], 'feb' => (float)$ang['feb'], 'mar' => (float)$ang['mar'],
                'apr' => (float)$ang['apr'], 'mei' => (float)$ang['mei'], 'jun' => (float)$ang['jun'],
                'jul' => (float)$ang['jul'], 'agu' => (float)$ang['ags'], 'sep' => (float)$ang['sep'],
                'okt' => (float)$ang['okt'], 'nov' => (float)$ang['nov'], 'des' => (float)$ang['des']
            ];
            $val = [
                'pagu' => $pagu,
                'total' => (float)$ang['total_anggaran']
            ];
            if (!empty($ang['header_id'])) {
                $anggaranMap['h_' . $ang['header_id']] = $val;
            }
            if (!empty($ang['kode_sub_kegiatan'])) {
                $anggaranMap['c_' . $ang['kode_sub_kegiatan']] = $val;
            }
        }

        // Fallback RAK DPA jika belum ada di target_renaksi_anggaran_bulanan
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('tahun', $tahun);
        }
        $dpaRak = $this->db->get('dpa_rak_rincian')->result_array();

        $dpaMap = [];
        foreach ($dpaRak as $dr) {
            $sk = $dr['kode_sub_kegiatan'];
            if (!isset($dpaMap[$sk])) {
                $dpaMap[$sk] = [
                    'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0,
                    'mei' => 0, 'jun' => 0, 'jul' => 0, 'agu' => 0,
                    'sep' => 0, 'okt' => 0, 'nov' => 0, 'des' => 0,
                    'total' => 0
                ];
            }
            $dpaMap[$sk]['jan'] += (float)$dr['jan'];
            $dpaMap[$sk]['feb'] += (float)$dr['feb'];
            $dpaMap[$sk]['mar'] += (float)$dr['mar'];
            $dpaMap[$sk]['apr'] += (float)$dr['apr'];
            $dpaMap[$sk]['mei'] += (float)$dr['mei'];
            $dpaMap[$sk]['jun'] += (float)$dr['jun'];
            $dpaMap[$sk]['jul'] += (float)$dr['jul'];
            $dpaMap[$sk]['agu'] += (float)$dr['ags'];
            $dpaMap[$sk]['sep'] += (float)$dr['sep'];
            $dpaMap[$sk]['okt'] += (float)$dr['okt'];
            $dpaMap[$sk]['nov'] += (float)$dr['nov'];
            $dpaMap[$sk]['des'] += (float)$dr['des'];
            $dpaMap[$sk]['total'] += (float)$dr['total_rak'];
        }

        // 5. Ambil data target hierarchy (Tujuan, Sasaran Strategis, Program, Kegiatan)
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('tahun', $tahun);
        }
        $hierSaved = $this->db
            ->order_by('urutan', 'ASC')
            ->get('target_renaksi_hierarchy')
            ->result_array();

        $hierMap = [];
        foreach ($hierSaved as $hRow) {
            $k = $hRow['level_type'] . '_' . $hRow['entity_code'];
            $hierMap[$k][] = [
                'id' => (string)$hRow['id'],
                'nama' => $hRow['indikator_nama'],
                'satuan' => $hRow['satuan'] ?: '%',
                'targetTahunan' => $hRow['target_tahunan'] !== null ? (float)$hRow['target_tahunan'] : 100,
                'tw1' => $hRow['tw1'] !== null ? (float)$hRow['tw1'] : null,
                'tw2' => $hRow['tw2'] !== null ? (float)$hRow['tw2'] : null,
                'tw3' => $hRow['tw3'] !== null ? (float)$hRow['tw3'] : null,
                'tw4' => $hRow['tw4'] !== null ? (float)$hRow['tw4'] : null
            ];
        }

        // 6. Susun pohon Tujuan -> Sasaran Strategis -> Sasaran Program -> Sasaran Kegiatan -> Sasaran Sub Kegiatan
        $progGroups = [];
        foreach ($headers as $h) {
            $hId = (int)$h['id'];
            $subKode = $h['kode_sub_kegiatan'];
            $kegKode = $h['kode_kegiatan'] ?: substr($subKode, 0, 13);
            $progKode = $h['kode_program'] ?: substr($kegKode, 0, 7);

            // Indikators
            $inds = isset($indikatorMap['h_' . $hId]) ? $indikatorMap['h_' . $hId] : (isset($indikatorMap['c_' . $subKode]) ? $indikatorMap['c_' . $subKode] : []);
            if (empty($inds)) {
                $inds = [
                    [
                        'id' => 'ind_def_' . $hId,
                        'nama' => 'Jumlah output sub kegiatan ' . ($h['nama_sub_kegiatan'] ?: $subKode),
                        'satuan' => 'Dokumen',
                        'targetTahunan' => 1,
                        'tw1' => 1, 'tw2' => null, 'tw3' => null, 'tw4' => null,
                        'validitas' => 'Valid'
                    ]
                ];
            }

            // Tahapan Proses
            $tps = isset($tahapanMap['h_' . $hId]) ? $tahapanMap['h_' . $hId] : (isset($tahapanMap['c_' . $subKode]) ? $tahapanMap['c_' . $subKode] : []);

            // Anggaran
            $pagu = [
                'jan' => 0, 'feb' => 0, 'mar' => 0, 'apr' => 0,
                'mei' => 0, 'jun' => 0, 'jul' => 0, 'agu' => 0,
                'sep' => 0, 'okt' => 0, 'nov' => 0, 'des' => 0
            ];
            $totalAnggaran = 0;

            if (isset($anggaranMap['h_' . $hId])) {
                $pagu = $anggaranMap['h_' . $hId]['pagu'];
                $totalAnggaran = $anggaranMap['h_' . $hId]['total'];
            } else if (isset($anggaranMap['c_' . $subKode])) {
                $pagu = $anggaranMap['c_' . $subKode]['pagu'];
                $totalAnggaran = $anggaranMap['c_' . $subKode]['total'];
            } else if (isset($dpaMap[$subKode])) {
                $pagu = $dpaMap[$subKode];
                $totalAnggaran = $dpaMap[$subKode]['total'] ?: (float)$h['total_belanja'];
            } else {
                $totalAnggaran = (float)$h['total_belanja'];
            }

            $subItem = [
                'id' => (string)$hId,
                'headerId' => $hId,
                'kode' => $subKode,
                'nama' => $h['nama_sub_kegiatan'] ?: 'Sub Kegiatan ' . $subKode,
                'nomenklatur' => $h['nama_sub_kegiatan'] ?: 'Sub Kegiatan ' . $subKode,
                'perangkatDaerah' => $h['nama_perangkat_daerah'] ?: '',
                'subUnit' => $h['nama_sub_unit'] ?: '',
                'bidangUrusan' => $h['nama_bidang_urusan'] ?: '',
                'programNama' => $h['nama_program'] ?: '',
                'kegiatanNama' => $h['nama_kegiatan'] ?: '',
                'indikators' => $inds,
                'paguBulanan' => $pagu,
                'anggaran' => $totalAnggaran,
                'tahapanProses' => $tps
            ];

            $progGroups[$progKode][$kegKode][] = $subItem;
        }

        // Bangun Sasaran Program & Sasaran Kegiatan
        $spList = [];
        foreach ($progGroups as $pKode => $kegGroup) {
            $pName = 'PROGRAM ' . $pKode;
            $skList = [];
            $progTotalAnggaran = 0;

            foreach ($kegGroup as $kKode => $subList) {
                $kName = 'KEGIATAN ' . $kKode;
                $kegTotalAnggaran = 0;
                foreach ($subList as $s) {
                    $kegTotalAnggaran += (float)$s['anggaran'];
                    $pName = $s['programNama'] ?: $pName;
                    $kName = $s['kegiatanNama'] ?: $kName;
                }
                $progTotalAnggaran += $kegTotalAnggaran;

                $kInds = isset($hierMap['kegiatan_' . $kKode]) ? $hierMap['kegiatan_' . $kKode] : [
                    [
                        'id' => 'ind_sk_' . str_replace('.', '_', $kKode),
                        'nama' => 'Persentase ketercapaian target output ' . $kName,
                        'satuan' => '%',
                        'targetTahunan' => 100,
                        'tw1' => 25, 'tw2' => 25, 'tw3' => 25, 'tw4' => 25
                    ]
                ];

                $skList[] = [
                    'id' => 'sk_' . str_replace('.', '_', $kKode),
                    'kode' => $kKode,
                    'nama' => 'Tersedianya Layanan dan Data ' . $kName,
                    'nomenklatur' => $kName,
                    'indikators' => $kInds,
                    'anggaran' => $kegTotalAnggaran,
                    'sasaranSubKegiatanList' => $subList
                ];
            }

            $pInds = isset($hierMap['program_' . $pKode]) ? $hierMap['program_' . $pKode] : [
                [
                    'id' => 'ind_sp_' . str_replace('.', '_', $pKode),
                    'nama' => 'Persentase pemenuhan standar kualitas proses ' . $pName,
                    'satuan' => '%',
                    'targetTahunan' => 100,
                    'tw1' => 100, 'tw2' => null, 'tw3' => null, 'tw4' => null
                ]
            ];

            $spList[] = [
                'id' => 'sp_' . str_replace('.', '_', $pKode),
                'kode' => $pKode,
                'nama' => 'Meningkatnya Kualitas Proses ' . $pName,
                'nomenklatur' => $pName,
                'indikators' => $pInds,
                'anggaran' => $progTotalAnggaran,
                'sasaranKegiatanList' => $skList
            ];
        }

        // Bangun Tujuan & Sasaran Strategis
        $ss1Inds = isset($hierMap['sasaran_strategis_SS_1']) ? $hierMap['sasaran_strategis_SS_1'] : [
            ['id' => 'ind_ss1_1', 'nama' => 'Indeks Perencanaan Pembangunan Daerah', 'satuan' => 'Nilai', 'targetTahunan' => 90, 'tw1' => null, 'tw2' => null, 'tw3' => 90, 'tw4' => null],
            ['id' => 'ind_ss1_2', 'nama' => 'Nilai Komponen Perencanaan SAKIP', 'satuan' => 'Nilai', 'targetTahunan' => 27.88, 'tw1' => null, 'tw2' => null, 'tw3' => 27.88, 'tw4' => null]
        ];
        $ss2Inds = isset($hierMap['sasaran_strategis_SS_2']) ? $hierMap['sasaran_strategis_SS_2'] : [
            ['id' => 'ind_ss2_1', 'nama' => 'Persentase rekomendasi kebijakan pembangunan daerah yang dijadikan sebagai landasan dalam implementasi pembangunan daerah', 'satuan' => '%', 'targetTahunan' => 85, 'tw1' => null, 'tw2' => null, 'tw3' => null, 'tw4' => 85]
        ];

        $tujuanInds = isset($hierMap['tujuan_T_1']) ? $hierMap['tujuan_T_1'] : [
            ['id' => 'ind_t1_1', 'nama' => 'Persentase ketercapaian indikator tujuan pembangunan daerah', 'satuan' => '%', 'targetTahunan' => 100, 'tw1' => null, 'tw2' => null, 'tw3' => null, 'tw4' => 100],
            ['id' => 'ind_t1_2', 'nama' => 'Persentase ketercapaian indikator sasaran pembangunan daerah', 'satuan' => '%', 'targetTahunan' => 200, 'tw1' => null, 'tw2' => null, 'tw3' => null, 'tw4' => 200]
        ];

        $tujuanList = [
            [
                'id' => 't_1',
                'kode' => 'T_1',
                'nama' => 'Meningkatnya Kinerja Pembangunan Daerah',
                'indikators' => $tujuanInds,
                'sasaranStrategisList' => [
                    [
                        'id' => 'ss_1',
                        'kode' => 'SS_1',
                        'nama' => 'Meningkatnya Kualitas Perencanaan',
                        'indikators' => $ss1Inds,
                        'sasaranProgramList' => $spList
                    ],
                    [
                        'id' => 'ss_2',
                        'kode' => 'SS_2',
                        'nama' => 'Meningkatnya Pemanfaatan Hasil Kelitbangan',
                        'indikators' => $ss2Inds,
                        'sasaranProgramList' => []
                    ]
                ]
            ]
        ];

        return [
            'tujuanList' => $tujuanList
        ];
    }

    // ================================================================
    // REALISASI RENAKSI (REALISASI KINERJA & ANGGARAN)
    // ================================================================

    public function RealisasiRenaksi() {
        $Header['Halaman'] = 'Realisasi Renaksi';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE);
        $filter_instansi = $this->input->get('instansi_id', TRUE);
        $bulanIdx = $this->input->get('bulan', TRUE) !== null ? (int)$this->input->get('bulan', TRUE) : 0;
        
        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        // Batasi rentang bulan 0-11
        if ($bulanIdx < 0) $bulanIdx = 0;
        if ($bulanIdx > 11) $bulanIdx = 11;

        // Data Provinsi untuk filter
        $Data['Provinsi'] = $this->db
            ->where("Kode LIKE '__'")
            ->order_by('Nama')
            ->get('kodewilayah')
            ->result_array();
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';
        
        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }
        
        // List Instansi
        $Data['ListInstansi'] = [];
        if (!empty($KodeWilayah)) {
            $provKode = substr($KodeWilayah, 0, 2);
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where("(kodewilayah = " . $this->db->escape($KodeWilayah) . " OR kodewilayah = " . $this->db->escape($provKode) . ")")
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        } else {
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        }
        
        // List Tahun
        $dbYears = $this->db->select('DISTINCT(tahun) as thn')
            ->where('deleted_at IS NULL')
            ->order_by('tahun', 'DESC')
            ->get('belanja_sub_kegiatan_header')
            ->result_array();
        
        $listTahun = [];
        if (!empty($dbYears)) {
            foreach ($dbYears as $dy) {
                if (!empty($dy['thn'])) {
                    $listTahun[] = (int)$dy['thn'];
                }
            }
        }
        $currentY = (int)date('Y');
        for ($y = $currentY + 1; $y >= $currentY - 5; $y--) {
            if (!in_array($y, $listTahun)) {
                $listTahun[] = $y;
            }
        }
        rsort($listTahun);
        $Data['ListTahun'] = $listTahun;
        
        if (empty($tahun)) {
            if (!empty($dbYears) && !empty($dbYears[0]['thn'])) {
                $tahun = $dbYears[0]['thn'];
            } else {
                $tahun = date('Y');
            }
        }
        $Data['TahunAktif'] = $tahun;
        $Data['FilterInstansi'] = $filter_instansi;
        $Data['BulanAktif'] = $bulanIdx;

        // Ambil Data Hierarki Realisasi Renaksi
        $Data['RealisasiTree'] = $this->_buildRealisasiRenaksiHierarchy($KodeWilayah, $tahun, $filter_instansi, $bulanIdx);
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/RealisasiRenaksi', $Data);
    }

    public function GetRealisasiRenaksiData() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $KodeWilayah = $this->get_kode_wilayah();
        $is_role_4 = $this->is_role_4();
        $instansi_id = $this->get_instansi_id();
        $tahun = $this->input->post('tahun', TRUE) ?: date('Y');
        $filter_instansi = $this->input->post('instansi', TRUE);
        $bulanIdx = $this->input->post('bulan', TRUE) !== null ? (int)$this->input->post('bulan', TRUE) : 0;

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        $tree = $this->_buildRealisasiRenaksiHierarchy($KodeWilayah, $tahun, $filter_instansi, $bulanIdx);
        echo json_encode(['status' => 'success', 'data' => $tree]);
    }

    public function GetSubKegiatanRealisasiDetail() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $header_id = (int)$this->input->post('header_id', TRUE);
        $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
        $tahun = (int)($this->input->post('tahun', TRUE) ?: date('Y'));
        $bulanIdx = $this->input->post('bulan', TRUE) !== null ? (int)$this->input->post('bulan', TRUE) : 0;

        $this->db->where('deleted_at IS NULL');
        if ($header_id > 0) {
            $this->db->where('id', $header_id);
        } else if (!empty($kode_sub_kegiatan)) {
            $this->db->where('kode_sub_kegiatan', $kode_sub_kegiatan)->where('tahun', $tahun);
        }
        $header = $this->db->get('belanja_sub_kegiatan_header')->row_array();

        if (!$header) {
            echo json_encode(['status' => 'error', 'message' => 'Data Sub Kegiatan tidak ditemukan.']);
            return;
        }

        $hId = (int)$header['id'];
        $subKode = $header['kode_sub_kegiatan'];
        $thn = (int)$header['tahun'];

        // 1. Target Anggaran Bulanan
        $targetAng = $this->db->where('deleted_at IS NULL')
            ->group_start()
                ->where('header_id', $hId)
                ->or_group_start()
                    ->where('kode_sub_kegiatan', $subKode)
                    ->where('tahun', $thn)
                ->group_end()
            ->group_end()
            ->get('target_renaksi_anggaran_bulanan')
            ->row_array();

        // 2. Realisasi Anggaran Bulanan
        $realAng = $this->db->where('deleted_at IS NULL')
            ->group_start()
                ->where('header_id', $hId)
                ->or_group_start()
                    ->where('kode_sub_kegiatan', $subKode)
                    ->where('tahun', $thn)
                ->group_end()
            ->group_end()
            ->get('realisasi_renaksi_anggaran_bulanan')
            ->row_array();

        $monthKeys = ['jan','feb','mar','apr','mei','jun','jul','ags','sep','okt','nov','des'];
        $monthNames = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $bulananList = [];
        $runningReal = 0;
        for ($m = 0; $m < 12; $m++) {
            $k = $monthKeys[$m];
            $tVal = $targetAng ? (float)$targetAng[$k] : 0;
            $rVal = $realAng && $realAng[$k] !== null ? (float)$realAng[$k] : null;
            if ($rVal !== null) {
                $runningReal += $rVal;
            }
            $bulananList[] = [
                'bulanIdx' => $m,
                'bulanNama' => $monthNames[$m],
                'target' => $tVal,
                'realisasi' => $rVal,
                'saldoAkumulasi' => $runningReal
            ];
        }

        // 3. Target & Realisasi Indikator
        $targetInds = $this->db->where('deleted_at IS NULL')
            ->group_start()
                ->where('header_id', $hId)
                ->or_group_start()
                    ->where('entity_code', $subKode)
                    ->where('tahun', $thn)
                ->group_end()
            ->group_end()
            ->order_by('urutan', 'ASC')
            ->order_by('id', 'ASC')
            ->get('target_renaksi_indikator')
            ->result_array();

        $realInds = $this->db->where('deleted_at IS NULL')
            ->group_start()
                ->where('header_id', $hId)
                ->or_group_start()
                    ->where('entity_code', $subKode)
                    ->where('tahun', $thn)
                ->group_end()
            ->group_end()
            ->get('realisasi_renaksi_indikator')
            ->result_array();

        $realIndMap = [];
        foreach ($realInds as $ri) {
            if ($ri['indikator_id']) {
                $realIndMap[$ri['indikator_id']] = $ri;
            }
        }

        $indikatorDetailList = [];
        foreach ($targetInds as $ti) {
            $indId = (int)$ti['id'];
            $ri = isset($realIndMap[$indId]) ? $realIndMap[$indId] : null;
            $indikatorDetailList[] = [
                'id' => $indId,
                'uraian' => $ti['uraian_indikator'],
                'satuan' => $ti['satuan'],
                'targetTahunan' => (float)$ti['target_tahunan'],
                'tw' => [
                    ['target' => $ti['tw1'] !== null ? (float)$ti['tw1'] : null, 'realisasi' => $ri && $ri['tw1'] !== null ? (float)$ri['tw1'] : null],
                    ['target' => $ti['tw2'] !== null ? (float)$ti['tw2'] : null, 'realisasi' => $ri && $ri['tw2'] !== null ? (float)$ri['tw2'] : null],
                    ['target' => $ti['tw3'] !== null ? (float)$ti['tw3'] : null, 'realisasi' => $ri && $ri['tw3'] !== null ? (float)$ri['tw3'] : null],
                    ['target' => $ti['tw4'] !== null ? (float)$ti['tw4'] : null, 'realisasi' => $ri && $ri['tw4'] !== null ? (float)$ri['tw4'] : null]
                ]
            ];
        }

        echo json_encode([
            'status' => 'success',
            'data' => [
                'header' => $header,
                'bulanan' => $bulananList,
                'indikators' => $indikatorDetailList,
                'bulanAktif' => $bulanIdx
            ]
        ]);
    }

    public function SaveRealisasiSubKegiatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $header_id = (int)$this->input->post('header_id', TRUE);
            $kode_sub_kegiatan = trim($this->input->post('kode_sub_kegiatan', TRUE));
            $tahun = (int)($this->input->post('tahun', TRUE) ?: date('Y'));
            $kode_wilayah = $this->input->post('kode_wilayah', TRUE) ?: $this->get_kode_wilayah() ?: '35.73';
            $id_instansi = (int)($this->input->post('id_instansi', TRUE) ?: $this->get_instansi_id() ?: 1);

            $header = null;
            if ($header_id > 0) {
                $header = $this->db->where('id', $header_id)->where('deleted_at IS NULL')->get('belanja_sub_kegiatan_header')->row_array();
            }
            if (!$header && !empty($kode_sub_kegiatan)) {
                $header = $this->db->where('kode_sub_kegiatan', $kode_sub_kegiatan)->where('tahun', $tahun)->where('deleted_at IS NULL')->get('belanja_sub_kegiatan_header')->row_array();
            }
            if ($header) {
                $header_id = (int)$header['id'];
                $kode_sub_kegiatan = $header['kode_sub_kegiatan'];
                $kode_wilayah = $header['kode_wilayah'] ?: $kode_wilayah;
                $id_instansi = $header['id_instansi'] ? (int)$header['id_instansi'] : $id_instansi;
            }

            $bulananReal = $this->input->post('bulanan_realisasi');
            $indikatorsReal = $this->input->post('indikators_realisasi');

            $this->db->trans_begin();
            $now = date('Y-m-d H:i:s');

            // 1. Simpan Realisasi Anggaran Bulanan
            if (!empty($bulananReal) && is_array($bulananReal)) {
                $monthKeys = ['jan','feb','mar','apr','mei','jun','jul','ags','sep','okt','nov','des'];
                $mVal = [];
                $totReal = 0;
                foreach ($monthKeys as $mk) {
                    $val = isset($bulananReal[$mk]) && $bulananReal[$mk] !== '' && $bulananReal[$mk] !== null ? (float)$bulananReal[$mk] : 0;
                    $mVal[$mk] = $val;
                    $totReal += $val;
                }

                $existAng = $this->db->where('deleted_at IS NULL')
                    ->group_start()
                        ->where('header_id', $header_id)
                        ->or_group_start()
                            ->where('kode_sub_kegiatan', $kode_sub_kegiatan)
                            ->where('tahun', $tahun)
                        ->group_end()
                    ->group_end()
                    ->get('realisasi_renaksi_anggaran_bulanan')
                    ->row_array();

                $angData = [
                    'header_id' => $header_id,
                    'kode_wilayah' => $kode_wilayah,
                    'tahun' => $tahun,
                    'id_instansi' => $id_instansi,
                    'kode_sub_kegiatan' => $kode_sub_kegiatan,
                    'jan' => $mVal['jan'], 'feb' => $mVal['feb'], 'mar' => $mVal['mar'],
                    'apr' => $mVal['apr'], 'mei' => $mVal['mei'], 'jun' => $mVal['jun'],
                    'jul' => $mVal['jul'], 'ags' => $mVal['ags'], 'sep' => $mVal['sep'],
                    'okt' => $mVal['okt'], 'nov' => $mVal['nov'], 'des' => $mVal['des'],
                    'total_realisasi' => $totReal,
                    'updated_at' => $now
                ];

                if ($existAng) {
                    $this->db->where('id', $existAng['id'])->update('realisasi_renaksi_anggaran_bulanan', $angData);
                } else {
                    $angData['created_at'] = $now;
                    $this->db->insert('realisasi_renaksi_anggaran_bulanan', $angData);
                }
            }

            // 2. Simpan Realisasi Indikators (Triwulan)
            if (!empty($indikatorsReal) && is_array($indikatorsReal)) {
                foreach ($indikatorsReal as $ir) {
                    $indId = isset($ir['indikator_id']) ? (int)$ir['indikator_id'] : (isset($ir['id']) ? (int)$ir['id'] : 0);
                    $tw1 = (isset($ir['tw1']) && $ir['tw1'] !== '' && $ir['tw1'] !== null) ? (float)$ir['tw1'] : null;
                    $tw2 = (isset($ir['tw2']) && $ir['tw2'] !== '' && $ir['tw2'] !== null) ? (float)$ir['tw2'] : null;
                    $tw3 = (isset($ir['tw3']) && $ir['tw3'] !== '' && $ir['tw3'] !== null) ? (float)$ir['tw3'] : null;
                    $tw4 = (isset($ir['tw4']) && $ir['tw4'] !== '' && $ir['tw4'] !== null) ? (float)$ir['tw4'] : null;

                    if ($indId <= 0) continue;

                    $existInd = $this->db->where('deleted_at IS NULL')
                        ->where('indikator_id', $indId)
                        ->where('tahun', $tahun)
                        ->get('realisasi_renaksi_indikator')
                        ->row_array();

                    $realIndRow = [
                        'indikator_id' => $indId,
                        'header_id' => $header_id,
                        'kode_wilayah' => $kode_wilayah,
                        'tahun' => $tahun,
                        'id_instansi' => $id_instansi,
                        'level_type' => 'sub_kegiatan',
                        'entity_code' => $kode_sub_kegiatan,
                        'tw1' => $tw1,
                        'tw2' => $tw2,
                        'tw3' => $tw3,
                        'tw4' => $tw4,
                        'updated_at' => $now
                    ];

                    if ($existInd) {
                        $this->db->where('id', $existInd['id'])->update('realisasi_renaksi_indikator', $realIndRow);
                    } else {
                        $realIndRow['created_at'] = $now;
                        $this->db->insert('realisasi_renaksi_indikator', $realIndRow);
                    }
                }
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Gagal menyimpan realisasi ke database.');
            } else {
                $this->db->trans_commit();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Realisasi Renaksi Sasaran Sub Kegiatan berhasil disimpan!'
                ]);
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function SaveRealisasiHierarchy() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $level_type = $this->input->post('level_type', TRUE);
            $entity_code = trim($this->input->post('entity_code', TRUE));
            $tahun = (int)($this->input->post('tahun', TRUE) ?: date('Y'));
            $kode_wilayah = $this->input->post('kode_wilayah', TRUE) ?: $this->get_kode_wilayah() ?: '35.73';
            $id_instansi = (int)($this->input->post('id_instansi', TRUE) ?: $this->get_instansi_id() ?: 1);
            $tw1 = ($this->input->post('tw1', TRUE) !== '' && $this->input->post('tw1', TRUE) !== null) ? (float)$this->input->post('tw1', TRUE) : null;
            $tw2 = ($this->input->post('tw2', TRUE) !== '' && $this->input->post('tw2', TRUE) !== null) ? (float)$this->input->post('tw2', TRUE) : null;
            $tw3 = ($this->input->post('tw3', TRUE) !== '' && $this->input->post('tw3', TRUE) !== null) ? (float)$this->input->post('tw3', TRUE) : null;
            $tw4 = ($this->input->post('tw4', TRUE) !== '' && $this->input->post('tw4', TRUE) !== null) ? (float)$this->input->post('tw4', TRUE) : null;

            if (empty($level_type) || empty($entity_code)) {
                throw new Exception('Data level atau kode entitas tidak valid.');
            }

            $this->db->trans_begin();
            $now = date('Y-m-d H:i:s');

            $exist = $this->db->where('deleted_at IS NULL')
                ->where('level_type', $level_type)
                ->where('entity_code', $entity_code)
                ->where('tahun', $tahun)
                ->get('realisasi_renaksi_indikator')
                ->row_array();

            $row = [
                'header_id' => null,
                'indikator_id' => null,
                'kode_wilayah' => $kode_wilayah,
                'tahun' => $tahun,
                'id_instansi' => $id_instansi,
                'level_type' => $level_type,
                'entity_code' => $entity_code,
                'tw1' => $tw1,
                'tw2' => $tw2,
                'tw3' => $tw3,
                'tw4' => $tw4,
                'updated_at' => $now
            ];

            if ($exist) {
                $this->db->where('id', $exist['id'])->update('realisasi_renaksi_indikator', $row);
            } else {
                $row['created_at'] = $now;
                $this->db->insert('realisasi_renaksi_indikator', $row);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
                throw new Exception('Gagal menyimpan realisasi kinerja.');
            } else {
                $this->db->trans_commit();
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Realisasi Kinerja Triwulan berhasil disimpan!'
                ]);
            }
        } catch (Exception $e) {
            $this->db->trans_rollback();
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    private function _buildRealisasiRenaksiHierarchy($KodeWilayah, $tahun, $filter_instansi, $bulanIdx) {
        $monthKeys = ['jan','feb','mar','apr','mei','jun','jul','ags','sep','okt','nov','des'];

        // 1. Headers Sub Kegiatan
        $this->db->select('*')->from('belanja_sub_kegiatan_header')->where('deleted_at IS NULL');
        if (!empty($KodeWilayah)) $this->db->where('kode_wilayah', $KodeWilayah);
        if (!empty($tahun) && $tahun !== 'all') $this->db->where('tahun', $tahun);
        if (!empty($filter_instansi)) $this->db->where('id_instansi', (int)$filter_instansi);

        $headers = $this->db
            ->order_by('kode_program', 'ASC')
            ->order_by('kode_kegiatan', 'ASC')
            ->order_by('kode_sub_kegiatan', 'ASC')
            ->get()
            ->result_array();

        // 2. Target Anggaran Bulanan
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') $this->db->where('tahun', $tahun);
        $targetAngList = $this->db->get('target_renaksi_anggaran_bulanan')->result_array();
        $targetAngMap = [];
        foreach ($targetAngList as $ta) {
            if (!empty($ta['header_id'])) $targetAngMap['h_' . $ta['header_id']] = $ta;
            if (!empty($ta['kode_sub_kegiatan'])) $targetAngMap['c_' . $ta['kode_sub_kegiatan']] = $ta;
        }

        // 3. Realisasi Anggaran Bulanan
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') $this->db->where('tahun', $tahun);
        $realAngList = $this->db->get('realisasi_renaksi_anggaran_bulanan')->result_array();
        $realAngMap = [];
        foreach ($realAngList as $ra) {
            if (!empty($ra['header_id'])) $realAngMap['h_' . $ra['header_id']] = $ra;
            if (!empty($ra['kode_sub_kegiatan'])) $realAngMap['c_' . $ra['kode_sub_kegiatan']] = $ra;
        }

        // 4. Target Indikator
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') $this->db->where('tahun', $tahun);
        $targetInds = $this->db->order_by('urutan', 'ASC')->order_by('id', 'ASC')->get('target_renaksi_indikator')->result_array();
        $targetIndMap = [];
        foreach ($targetInds as $ti) {
            $item = [
                'id' => (int)$ti['id'],
                'uraian' => $ti['uraian_indikator'],
                'satuan' => $ti['satuan'],
                'targetTahunan' => (float)$ti['target_tahunan'],
                'tw' => [
                    $ti['tw1'] !== null ? (float)$ti['tw1'] : null,
                    $ti['tw2'] !== null ? (float)$ti['tw2'] : null,
                    $ti['tw3'] !== null ? (float)$ti['tw3'] : null,
                    $ti['tw4'] !== null ? (float)$ti['tw4'] : null
                ]
            ];
            if (!empty($ti['header_id'])) $targetIndMap['h_' . $ti['header_id']][] = $item;
            if (!empty($ti['entity_code'])) $targetIndMap['c_' . $ti['entity_code']][] = $item;
        }

        // 5. Realisasi Indikator
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') $this->db->where('tahun', $tahun);
        $realInds = $this->db->get('realisasi_renaksi_indikator')->result_array();
        $realIndMap = [];
        $realHierMap = [];
        foreach ($realInds as $ri) {
            if ($ri['indikator_id']) {
                $realIndMap[$ri['indikator_id']] = [
                    $ri['tw1'] !== null ? (float)$ri['tw1'] : null,
                    $ri['tw2'] !== null ? (float)$ri['tw2'] : null,
                    $ri['tw3'] !== null ? (float)$ri['tw3'] : null,
                    $ri['tw4'] !== null ? (float)$ri['tw4'] : null
                ];
            }
            $k = $ri['level_type'] . '_' . $ri['entity_code'];
            $realHierMap[$k] = [
                $ri['tw1'] !== null ? (float)$ri['tw1'] : null,
                $ri['tw2'] !== null ? (float)$ri['tw2'] : null,
                $ri['tw3'] !== null ? (float)$ri['tw3'] : null,
                $ri['tw4'] !== null ? (float)$ri['tw4'] : null
            ];
        }

        // 6. Target Hierarki (Program & Kegiatan)
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') $this->db->where('tahun', $tahun);
        $hierSaved = $this->db->get('target_renaksi_hierarchy')->result_array();
        $targetHierMap = [];
        foreach ($hierSaved as $hRow) {
            $k = $hRow['level_type'] . '_' . $hRow['entity_code'];
            $targetHierMap[$k] = [
                'nama' => $hRow['indikator_nama'],
                'satuan' => $hRow['satuan'] ?: '%',
                'targetTahunan' => $hRow['target_tahunan'] !== null ? (float)$hRow['target_tahunan'] : 100,
                'tw' => [
                    $hRow['tw1'] !== null ? (float)$hRow['tw1'] : null,
                    $hRow['tw2'] !== null ? (float)$hRow['tw2'] : null,
                    $hRow['tw3'] !== null ? (float)$hRow['tw3'] : null,
                    $hRow['tw4'] !== null ? (float)$hRow['tw4'] : null
                ]
            ];
        }

        // Susun struktur pohon Program -> Kegiatan -> Sub Kegiatan
        $progGroups = [];
        $currentTW = (int)floor($bulanIdx / 3) + 1; // 1 s.d. 4

        foreach ($headers as $h) {
            $hId = (int)$h['id'];
            $subKode = $h['kode_sub_kegiatan'];
            $kegKode = $h['kode_kegiatan'] ?: substr($subKode, 0, 13);
            $progKode = $h['kode_program'] ?: substr($kegKode, 0, 7);

            // Target & Realisasi Anggaran Sub Kegiatan
            $tAngRow = isset($targetAngMap['h_' . $hId]) ? $targetAngMap['h_' . $hId] : (isset($targetAngMap['c_' . $subKode]) ? $targetAngMap['c_' . $subKode] : null);
            $rAngRow = isset($realAngMap['h_' . $hId]) ? $realAngMap['h_' . $hId] : (isset($realAngMap['c_' . $subKode]) ? $realAngMap['c_' . $subKode] : null);

            $subTargetTotal = $tAngRow ? (float)$tAngRow['total_anggaran'] : (float)$h['total_belanja'];
            $subBulanan = [];
            $subRealBulan = null;
            $anyReal = false;
            $runningReal = 0;

            for ($m = 0; $m < 12; $m++) {
                $mk = $monthKeys[$m];
                $tM = $tAngRow ? (float)$tAngRow[$mk] : ($subTargetTotal / 12);
                $rM = ($rAngRow && $rAngRow[$mk] !== null) ? (float)$rAngRow[$mk] : null;
                if ($rM !== null) {
                    $anyReal = true;
                    $runningReal += $rM;
                }
                if ($m <= $bulanIdx && $rM !== null) {
                    $subRealBulan = $runningReal;
                }
                $subBulanan[] = [
                    'target' => $tM,
                    'realisasi' => $rM
                ];
            }

            // Indikators Target & Realisasi
            $inds = isset($targetIndMap['h_' . $hId]) ? $targetIndMap['h_' . $hId] : (isset($targetIndMap['c_' . $subKode]) ? $targetIndMap['c_' . $subKode] : []);
            if (empty($inds)) {
                $inds = [
                    [
                        'id' => 0,
                        'uraian' => 'Jumlah output sub kegiatan ' . ($h['nama_sub_kegiatan'] ?: $subKode),
                        'satuan' => 'Dokumen',
                        'targetTahunan' => 1,
                        'tw' => [1, null, null, null]
                    ]
                ];
            }

            $subIndikatorData = [];
            foreach ($inds as $iObj) {
                $iId = $iObj['id'];
                $rTw = isset($realIndMap[$iId]) ? $realIndMap[$iId] : [null, null, null, null];
                $twObjList = [];
                for ($t = 0; $t < 4; $t++) {
                    $twObjList[] = [
                        'target' => $iObj['tw'][$t],
                        'realisasi' => $rTw[$t]
                    ];
                }
                $subIndikatorData[] = [
                    'id' => $iId,
                    'uraian' => $iObj['uraian'],
                    'satuan' => $iObj['satuan'],
                    'tw' => $twObjList
                ];
            }

            $progGroups[$progKode][$kegKode][] = [
                'id' => $hId,
                'headerId' => $hId,
                'kode' => $subKode,
                'nama' => $h['nama_sub_kegiatan'] ?: 'Sub Kegiatan ' . $subKode,
                'perangkatDaerah' => $h['nama_perangkat_daerah'] ?: '',
                'subUnit' => $h['nama_sub_unit'] ?: '',
                'bidangUrusan' => $h['nama_bidang_urusan'] ?: '',
                'programNama' => $h['nama_program'] ?: '',
                'kegiatanNama' => $h['nama_kegiatan'] ?: '',
                'bulanan' => $subBulanan,
                'targetAnggaran' => $subTargetTotal,
                'realisasiAnggaran' => $subRealBulan,
                'indikator' => $subIndikatorData
            ];
        }

        // Susun Program & Kegiatan
        $programs = [];
        foreach ($progGroups as $pKode => $kegGroup) {
            $pName = 'PROGRAM ' . $pKode;
            $kegList = [];

            foreach ($kegGroup as $kKode => $subList) {
                $kName = 'KEGIATAN ' . $kKode;
                foreach ($subList as $s) {
                    $pName = $s['programNama'] ?: $pName;
                    $kName = $s['kegiatanNama'] ?: $kName;
                }

                $kKey = 'kegiatan_' . $kKode;
                $tKegKin = isset($targetHierMap[$kKey]) ? $targetHierMap[$kKey] : [
                    'nama' => 'Persentase ketercapaian target output ' . $kName,
                    'satuan' => '%',
                    'targetTahunan' => 100,
                    'tw' => [25, 25, 25, 25]
                ];
                $rKegKin = isset($realHierMap[$kKey]) ? $realHierMap[$kKey] : [null, null, null, null];
                $kegKinTW = [];
                for ($t = 0; $t < 4; $t++) {
                    $kegKinTW[] = [
                        'target' => $tKegKin['tw'][$t],
                        'realisasi' => $rKegKin[$t]
                    ];
                }

                $kegList[] = [
                    'kode' => $kKode,
                    'nama' => $kName,
                    'kinerja' => [
                        'uraian' => $tKegKin['nama'],
                        'satuan' => $tKegKin['satuan'],
                        'tw' => $kegKinTW
                    ],
                    'subKegiatan' => $subList
                ];
            }

            $pKey = 'program_' . $pKode;
            $tProgKin = isset($targetHierMap[$pKey]) ? $targetHierMap[$pKey] : [
                'nama' => 'Persentase pemenuhan kualitas pelaksanaan ' . $pName,
                'satuan' => '%',
                'targetTahunan' => 100,
                'tw' => [null, null, null, 95]
            ];
            $rProgKin = isset($realHierMap[$pKey]) ? $realHierMap[$pKey] : [null, null, null, null];
            $progKinTW = [];
            for ($t = 0; $t < 4; $t++) {
                $progKinTW[] = [
                    'target' => $tProgKin['tw'][$t],
                    'realisasi' => $rProgKin[$t]
                ];
            }

            $programs[] = [
                'kode' => $pKode,
                'nama' => $pName,
                'kinerja' => [
                    'uraian' => $tProgKin['nama'],
                    'satuan' => $tProgKin['satuan'],
                    'tw' => $progKinTW
                ],
                'kegiatan' => $kegList
            ];
        }

        return $programs;
    }

    // ================================================================
    // LAPORAN ANGGARAN (REKAPITULASI REALISASI ANGGARAN)
    // ================================================================

    public function LaporanAnggaran() {
        $Header['Halaman'] = 'Laporan Anggaran';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE);
        $filter_instansi = $this->input->get('instansi_id', TRUE);
        $bulan_sampai = $this->input->get('bulan_sampai', TRUE) !== null ? (int)$this->input->get('bulan_sampai', TRUE) : 7; // Default: Agustus (idx 7)

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        if ($bulan_sampai < 0) $bulan_sampai = 0;
        if ($bulan_sampai > 11) $bulan_sampai = 11;

        // Data Provinsi untuk filter
        $Data['Provinsi'] = $this->db
            ->where("Kode LIKE '__'")
            ->order_by('Nama')
            ->get('kodewilayah')
            ->result_array();
        
        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';
        
        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }
        
        // List Instansi
        $Data['ListInstansi'] = [];
        if (!empty($KodeWilayah)) {
            $provKode = substr($KodeWilayah, 0, 2);
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where("(kodewilayah = " . $this->db->escape($KodeWilayah) . " OR kodewilayah = " . $this->db->escape($provKode) . ")")
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        } else {
            $Data['ListInstansi'] = $this->db
                ->select('id, nama')
                ->from('akun_instansi')
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        }
        
        // List Tahun
        $dbYears = $this->db->select('DISTINCT(tahun) as thn')
            ->where('deleted_at IS NULL')
            ->order_by('tahun', 'DESC')
            ->get('belanja_sub_kegiatan_header')
            ->result_array();
        
        $listTahun = [];
        if (!empty($dbYears)) {
            foreach ($dbYears as $dy) {
                if (!empty($dy['thn'])) {
                    $listTahun[] = (int)$dy['thn'];
                }
            }
        }
        $currentY = (int)date('Y');
        for ($y = $currentY + 1; $y >= $currentY - 5; $y--) {
            if (!in_array($y, $listTahun)) {
                $listTahun[] = $y;
            }
        }
        rsort($listTahun);
        $Data['ListTahun'] = $listTahun;
        
        if (empty($tahun)) {
            $tahun = 2025;
        }
        $Data['TahunAktif'] = $tahun;
        $Data['FilterInstansi'] = $filter_instansi ?: 1;
        $Data['BulanSampai'] = $bulan_sampai;

        // Ambil Data Rekapitulasi Realisasi Anggaran
        $this->db->where('deleted_at IS NULL');
        if (!empty($tahun) && $tahun !== 'all') {
            $this->db->where('tahun', (int)$tahun);
        }
        if (!empty($filter_instansi)) {
            $this->db->where('id_instansi', (int)$filter_instansi);
        }

        $items = $this->db->order_by('urutan', 'ASC')->order_by('id', 'ASC')->get('laporan_anggaran_rekap')->result_array();

        // Hitung Grand Totals
        $totMurni = 0;
        $totPerubahan = 0;
        $totRealisasi = 0;
        $totSisa = 0;

        foreach ($items as &$it) {
            $murni = (float)$it['anggaran_murni'];
            $perubahan = (float)$it['anggaran_perubahan'];
            $realisasi = (float)$it['realisasi_anggaran'];
            $sisa = $perubahan - $realisasi;
            $persen = ($perubahan > 0) ? round(($realisasi / $perubahan) * 100, 2) : 0;
            $status = ($perubahan >= $murni) ? '+' : '-';

            $it['sisa_anggaran'] = $sisa;
            $it['persen_capaian'] = $persen;
            $it['perubahan_status'] = $status;

            $totMurni += $murni;
            $totPerubahan += $perubahan;
            $totRealisasi += $realisasi;
            $totSisa += $sisa;
        }
        unset($it);

        $persenCapaian = ($totPerubahan > 0) ? round(($totSisa / $totPerubahan) * 100, 2) : 0;
        $persenSerapan = ($totPerubahan > 0) ? round(($totRealisasi / $totPerubahan) * 100, 2) : 0;

        $Data['Items'] = $items;
        $Data['Summary'] = [
            'total_murni' => $totMurni,
            'total_perubahan' => $totPerubahan,
            'total_realisasi' => $totRealisasi,
            'total_sisa' => $totSisa,
            'persen_capaian' => $persenCapaian,
            'persen_serapan' => $persenSerapan
        ];
        
        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/LaporanAnggaran', $Data);
    }

    public function GetLaporanAnggaranData() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $tahun = (int)($this->input->post('tahun', TRUE) ?: 2025);
        $filter_instansi = (int)($this->input->post('instansi_id', TRUE) ?: 1);
        $bulan_sampai = $this->input->post('bulan_sampai', TRUE) !== null ? (int)$this->input->post('bulan_sampai', TRUE) : 7;

        $this->db->where('deleted_at IS NULL');
        if ($tahun > 0) $this->db->where('tahun', $tahun);
        if ($filter_instansi > 0) $this->db->where('id_instansi', $filter_instansi);

        $items = $this->db->order_by('urutan', 'ASC')->order_by('id', 'ASC')->get('laporan_anggaran_rekap')->result_array();

        $totMurni = 0;
        $totPerubahan = 0;
        $totRealisasi = 0;
        $totSisa = 0;

        foreach ($items as &$it) {
            $murni = (float)$it['anggaran_murni'];
            $perubahan = (float)$it['anggaran_perubahan'];
            $realisasi = (float)$it['realisasi_anggaran'];
            $sisa = $perubahan - $realisasi;
            $persen = ($perubahan > 0) ? round(($realisasi / $perubahan) * 100, 2) : 0;
            $status = ($perubahan >= $murni) ? '+' : '-';

            $it['sisa_anggaran'] = $sisa;
            $it['persen_capaian'] = $persen;
            $it['perubahan_status'] = $status;

            $totMurni += $murni;
            $totPerubahan += $perubahan;
            $totRealisasi += $realisasi;
            $totSisa += $sisa;
        }
        unset($it);

        $persenCapaian = ($totPerubahan > 0) ? round(($totSisa / $totPerubahan) * 100, 2) : 0;
        $persenSerapan = ($totPerubahan > 0) ? round(($totRealisasi / $totPerubahan) * 100, 2) : 0;

        echo json_encode([
            'status' => 'success',
            'data' => [
                'items' => $items,
                'summary' => [
                    'total_murni' => $totMurni,
                    'total_perubahan' => $totPerubahan,
                    'total_realisasi' => $totRealisasi,
                    'total_sisa' => $totSisa,
                    'persen_capaian' => $persenCapaian,
                    'persen_serapan' => $persenSerapan
                ]
            ]
        ]);
    }

    public function SaveLaporanAnggaranItem() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            $anggaran_murni = (float)str_replace(',', '', $this->input->post('anggaran_murni', TRUE));
            $anggaran_perubahan = (float)str_replace(',', '', $this->input->post('anggaran_perubahan', TRUE));
            $realisasi_anggaran = (float)str_replace(',', '', $this->input->post('realisasi_anggaran', TRUE));

            if ($id <= 0) {
                throw new Exception('ID item laporan anggaran tidak valid.');
            }

            $sisa_anggaran = $anggaran_perubahan - $realisasi_anggaran;
            $persen_capaian = ($anggaran_perubahan > 0) ? round(($realisasi_anggaran / $anggaran_perubahan) * 100, 2) : 0;
            $perubahan_status = ($anggaran_perubahan >= $anggaran_murni) ? '+' : '-';

            $updateData = [
                'anggaran_murni' => $anggaran_murni,
                'anggaran_perubahan' => $anggaran_perubahan,
                'realisasi_anggaran' => $realisasi_anggaran,
                'sisa_anggaran' => $sisa_anggaran,
                'persen_capaian' => $persen_capaian,
                'perubahan_status' => $perubahan_status,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->db->where('id', $id)->update('laporan_anggaran_rekap', $updateData);

            echo json_encode([
                'status' => 'success',
                'message' => 'Data baris Laporan Anggaran berhasil diperbarui!',
                'data' => array_merge(['id' => $id], $updateData)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function SyncLaporanAnggaran() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $tahun = (int)($this->input->post('tahun', TRUE) ?: 2025);
            $filter_instansi = (int)($this->input->post('instansi_id', TRUE) ?: 1);
            $bulan_sampai = $this->input->post('bulan_sampai', TRUE) !== null ? (int)$this->input->post('bulan_sampai', TRUE) : 7;

            $monthCols = ['jan','feb','mar','apr','mei','jun','jul','ags','sep','okt','nov','des'];
            $selectedMonths = array_slice($monthCols, 0, $bulan_sampai + 1);

            // Ambil realisasi bulanan dari realisasi_renaksi_anggaran_bulanan
            $realRows = $this->db->where('deleted_at IS NULL')->where('tahun', $tahun)->get('realisasi_renaksi_anggaran_bulanan')->result_array();
            $realMap = [];
            foreach ($realRows as $rr) {
                $sum = 0;
                foreach ($selectedMonths as $mc) {
                    $sum += (float)$rr[$mc];
                }
                $realMap[$rr['kode_sub_kegiatan']] = $sum;
            }

            // Update ke laporan_anggaran_rekap
            $updated = 0;
            $items = $this->db->where('deleted_at IS NULL')->where('tahun', $tahun)->get('laporan_anggaran_rekap')->result_array();
            foreach ($items as $it) {
                $code = $it['kode_rekening'];
                if (isset($realMap[$code])) {
                    $newReal = $realMap[$code];
                    $perubahan = (float)$it['anggaran_perubahan'];
                    $sisa = $perubahan - $newReal;
                    $persen = ($perubahan > 0) ? round(($newReal / $perubahan) * 100, 2) : 0;

                    $this->db->where('id', $it['id'])->update('laporan_anggaran_rekap', [
                        'realisasi_anggaran' => $newReal,
                        'sisa_anggaran' => $sisa,
                        'persen_capaian' => $persen,
                        'bulan_sampai' => $bulan_sampai,
                        'updated_at' => date('Y-m-d H:i:s')
                    ]);
                    $updated++;
                }
            }

            echo json_encode([
                'status' => 'success',
                'message' => "Berhasil menyinkronkan $updated data Realisasi Renaksi ke Laporan Anggaran!"
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // ================================================================
    // 1. E-LKPJ: PENGISIAN KEBIJAKAN STRATEGIS
    // ================================================================

    public function PengisianKebijakanStrategis() {
        $Header['Halaman'] = 'Pengisian Kebijakan Strategis';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE) ?: 2026;
        $filter_instansi = $this->input->get('instansi_id', TRUE);

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';

        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }

        $Data['ListInstansi'] = $this->db->select('id, nama')->from('akun_instansi')->where('deleted_at IS NULL')->order_by('nama', 'ASC')->get()->result_array();
        $Data['ListTahun'] = [2027, 2026, 2025, 2024, 2023];
        $Data['TahunAktif'] = (int)$tahun;
        $Data['FilterInstansi'] = $filter_instansi ? (int)$filter_instansi : 1;

        $this->db->where('deleted_at IS NULL');
        if ($tahun) $this->db->where('tahun', (int)$tahun);
        if ($filter_instansi) $this->db->where('instansi_id', (int)$filter_instansi);
        $Data['Items'] = $this->db->order_by('id', 'ASC')->get('lkpj_kebijakan_strategis')->result_array();

        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/PengisianKebijakanStrategis', $Data);
    }

    public function GetKebijakanStrategis() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
        $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: 1);

        $this->db->where('deleted_at IS NULL');
        if ($tahun > 0) $this->db->where('tahun', $tahun);
        if ($instansi_id > 0) $this->db->where('instansi_id', $instansi_id);

        $items = $this->db->order_by('id', 'ASC')->get('lkpj_kebijakan_strategis')->result_array();
        echo json_encode(['status' => 'success', 'data' => $items]);
    }

    public function SaveKebijakanStrategis() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
            $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: ($this->get_instansi_id() ?: 1));
            $kode_wilayah = $this->get_kode_wilayah() ?: '35.12';
            $kebijakan = trim($this->input->post('kebijakan_strategis', TRUE));
            $hukum = trim($this->input->post('dasar_hukum', TRUE));
            $tujuan = trim($this->input->post('tujuan_masalah', TRUE));

            if (empty($kebijakan) || empty($hukum) || empty($tujuan)) {
                throw new Exception('Semua kolom bertanda bintang (*) wajib diisi.');
            }

            $saveData = [
                'kodewilayah' => $kode_wilayah,
                'instansi_id' => $instansi_id,
                'tahun' => $tahun,
                'kebijakan_strategis' => $kebijakan,
                'dasar_hukum' => $hukum,
                'tujuan_masalah' => $tujuan,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($id > 0) {
                $this->db->where('id', $id)->update('lkpj_kebijakan_strategis', $saveData);
                $msg = 'Data Kebijakan Strategis berhasil diperbarui.';
            } else {
                $saveData['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('lkpj_kebijakan_strategis', $saveData);
                $id = $this->db->insert_id();
                $msg = 'Data Kebijakan Strategis berhasil ditambahkan.';
            }

            echo json_encode([
                'status' => 'success',
                'message' => $msg,
                'data' => array_merge(['id' => $id], $saveData)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function DeleteKebijakanStrategis() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) throw new Exception('ID data tidak valid.');

            $this->db->where('id', $id)->update('lkpj_kebijakan_strategis', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            echo json_encode(['status' => 'success', 'message' => 'Data Kebijakan Strategis berhasil dihapus.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // ================================================================
    // 2. E-LKPJ: PENGISIAN CAPAIAN PROGRAM KEGIATAN
    // ================================================================

    public function PengisianCapaianProgramKegiatan() {
        $Header['Halaman'] = 'Pengisian Capaian Program Kegiatan';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE) ?: 2026;
        $filter_urusan = $this->input->get('urusan', TRUE) ?: 'Perencanaan';
        $filter_instansi = $this->input->get('instansi_id', TRUE);

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';

        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }

        $Data['ListInstansi'] = $this->db->select('id, nama')->from('akun_instansi')->where('deleted_at IS NULL')->order_by('nama', 'ASC')->get()->result_array();
        $Data['ListTahun'] = [2027, 2026, 2025, 2024, 2023];
        $Data['TahunAktif'] = (int)$tahun;
        $Data['FilterInstansi'] = $filter_instansi ? (int)$filter_instansi : 1;
        $Data['FilterUrusan'] = $filter_urusan;

        // Ambil daftar Urusan yang tersedia di DB
        $dbUrusan = $this->db->select('DISTINCT(urusan) as ur')->where('deleted_at IS NULL')->get('lkpj_capaian_program_kegiatan')->result_array();
        $listUrusan = [];
        foreach ($dbUrusan as $du) {
            if (!empty($du['ur'])) $listUrusan[] = $du['ur'];
        }
        if (!in_array('Perencanaan', $listUrusan)) $listUrusan[] = 'Perencanaan';
        if (!in_array('Keuangan', $listUrusan)) $listUrusan[] = 'Keuangan';
        if (!in_array('Kepegawaian', $listUrusan)) $listUrusan[] = 'Kepegawaian';
        $Data['ListUrusan'] = $listUrusan;

        // Ambil Grouped Data
        $Data['Groups'] = $this->_get_capaian_program_kegiatan_groups((int)$tahun, $filter_urusan, $filter_instansi ? (int)$filter_instansi : 1);

        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/PengisianCapaianProgramKegiatan', $Data);
    }

    private function _get_capaian_program_kegiatan_groups($tahun, $urusan, $instansi_id) {
        $this->db->where('deleted_at IS NULL');
        if ($tahun > 0) $this->db->where('tahun', $tahun);
        if (!empty($urusan)) $this->db->where('urusan', $urusan);
        if ($instansi_id > 0) $this->db->where('instansi_id', $instansi_id);

        $rows = $this->db->order_by('urutan', 'ASC')->order_by('id', 'ASC')->get('lkpj_capaian_program_kegiatan')->result_array();

        $groups = [];
        $programMap = [];

        foreach ($rows as $row) {
            if ($row['tipe'] === 'program') {
                $pId = (int)$row['id'];
                $group = [
                    'id' => $pId,
                    'kebijakan' => $row['kebijakan'],
                    'program' => $row,
                    'kegiatan' => []
                ];
                $groups[$pId] = $group;
                $programMap[$pId] = &$groups[$pId];
            }
        }

        foreach ($rows as $row) {
            if ($row['tipe'] === 'kegiatan') {
                $parentId = (int)$row['parent_id'];
                if (isset($groups[$parentId])) {
                    $groups[$parentId]['kegiatan'][] = $row;
                } else {
                    // Fallback: assign to first program or create standalone group
                    if (!empty($groups)) {
                        $firstKey = array_key_first($groups);
                        $groups[$firstKey]['kegiatan'][] = $row;
                    } else {
                        $groups[0] = [
                            'id' => 0,
                            'kebijakan' => $row['kebijakan'],
                            'program' => null,
                            'kegiatan' => [$row]
                        ];
                    }
                }
            }
        }

        return array_values($groups);
    }

    public function GetCapaianProgramKegiatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
        $urusan = $this->input->post('urusan', TRUE) ?: 'Perencanaan';
        $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: 1);

        $groups = $this->_get_capaian_program_kegiatan_groups($tahun, $urusan, $instansi_id);
        echo json_encode(['status' => 'success', 'data' => $groups]);
    }

    public function SaveCapaianProgramKegiatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
            $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: ($this->get_instansi_id() ?: 1));
            $kode_wilayah = $this->get_kode_wilayah() ?: '35.12';
            $urusan = trim($this->input->post('urusan', TRUE) ?: 'Perencanaan');
            $kebijakan = trim($this->input->post('kebijakan', TRUE));
            $tipe = trim($this->input->post('tipe', TRUE) ?: 'kegiatan');
            $parent_id = $this->input->post('parent_id', TRUE) ? (int)$this->input->post('parent_id', TRUE) : null;
            $uraian = trim($this->input->post('uraian', TRUE));
            $indikator = trim($this->input->post('indikator', TRUE));
            $satuan = trim($this->input->post('satuan', TRUE));

            $target = (float)str_replace(',', '.', str_replace(' ', '', $this->input->post('target', TRUE)));
            $realisasi = (float)str_replace(',', '.', str_replace(' ', '', $this->input->post('realisasi', TRUE)));
            $anggaran = (float)str_replace(',', '', str_replace('.', '', $this->input->post('anggaran', TRUE)));
            $realisasi_anggaran = (float)str_replace(',', '', str_replace('.', '', $this->input->post('realisasi_anggaran', TRUE)));

            $capaian = ($target > 0) ? round(($realisasi / $target) * 100, 2) : 0;
            $capaian_anggaran = ($anggaran > 0) ? round(($realisasi_anggaran / $anggaran) * 100, 2) : 0;

            $permasalahan = trim($this->input->post('permasalahan', TRUE));
            $upaya = trim($this->input->post('upaya', TRUE));
            $tinjut = trim($this->input->post('tinjut', TRUE));

            if (empty($uraian)) {
                throw new Exception('Uraian Program/Kegiatan wajib diisi.');
            }

            $saveData = [
                'kodewilayah' => $kode_wilayah,
                'instansi_id' => $instansi_id,
                'tahun' => $tahun,
                'urusan' => $urusan,
                'kebijakan' => $kebijakan,
                'tipe' => $tipe,
                'parent_id' => $parent_id,
                'uraian' => $uraian,
                'indikator' => $indikator,
                'satuan' => $satuan,
                'target' => $target,
                'realisasi' => $realisasi,
                'capaian' => $capaian,
                'anggaran' => $anggaran,
                'realisasi_anggaran' => $realisasi_anggaran,
                'capaian_anggaran' => $capaian_anggaran,
                'permasalahan' => $permasalahan,
                'upaya' => $upaya,
                'tinjut' => $tinjut,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($id > 0) {
                $this->db->where('id', $id)->update('lkpj_capaian_program_kegiatan', $saveData);
                $msg = 'Data Capaian Program/Kegiatan berhasil diperbarui.';
            } else {
                $maxUrutan = $this->db->select_max('urutan')->where('tahun', $tahun)->where('instansi_id', $instansi_id)->get('lkpj_capaian_program_kegiatan')->row_array();
                $saveData['urutan'] = isset($maxUrutan['urutan']) ? ((int)$maxUrutan['urutan'] + 1) : 1;
                $saveData['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('lkpj_capaian_program_kegiatan', $saveData);
                $id = $this->db->insert_id();
                $msg = 'Data Capaian Program/Kegiatan berhasil ditambahkan.';
            }

            echo json_encode([
                'status' => 'success',
                'message' => $msg,
                'data' => array_merge(['id' => $id], $saveData)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function SaveEvaluasiProgramKegiatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) throw new Exception('ID program/kegiatan tidak valid.');

            $permasalahan = trim($this->input->post('permasalahan', TRUE));
            $upaya = trim($this->input->post('upaya', TRUE));
            $tinjut = trim($this->input->post('tinjut', TRUE));

            $updateData = [
                'permasalahan' => $permasalahan,
                'upaya' => $upaya,
                'tinjut' => $tinjut,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            $this->db->where('id', $id)->update('lkpj_capaian_program_kegiatan', $updateData);

            echo json_encode([
                'status' => 'success',
                'message' => 'Evaluasi (Permasalahan, Upaya & Tinjut) berhasil disimpan!',
                'data' => array_merge(['id' => $id], $updateData)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function DeleteCapaianProgramKegiatan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) throw new Exception('ID data tidak valid.');

            // Soft delete parent and its sub-kegiatans
            $this->db->where('id', $id)->or_where('parent_id', $id)->update('lkpj_capaian_program_kegiatan', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            echo json_encode(['status' => 'success', 'message' => 'Data Capaian Program/Kegiatan berhasil dihapus.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // ================================================================
    // 3. E-LKPJ: PENGISIAN TINJUT REKOMENDASI DPRD N-1
    // ================================================================

    public function PengisianTinjutRekomendasiDPRDn1() {
        $Header['Halaman'] = 'Pengisian Tindak Lanjut Rekomendasi DPRD n-1';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE) ?: 2026;
        $filter_instansi = $this->input->get('instansi_id', TRUE);

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';

        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }

        $Data['ListInstansi'] = $this->db->select('id, nama')->from('akun_instansi')->where('deleted_at IS NULL')->order_by('nama', 'ASC')->get()->result_array();
        $Data['ListTahun'] = [2027, 2026, 2025, 2024, 2023];
        $Data['TahunAktif'] = (int)$tahun;
        $Data['FilterInstansi'] = $filter_instansi ? (int)$filter_instansi : 1;

        $this->db->where('deleted_at IS NULL');
        if ($tahun) $this->db->where('tahun', (int)$tahun);
        if ($filter_instansi) $this->db->where('instansi_id', (int)$filter_instansi);
        $items = $this->db->order_by('id', 'ASC')->get('lkpj_tinjut_rekomendasi_dprd')->result_array();

        $filled = 0;
        foreach ($items as $it) {
            if (!empty(trim($it['tindak_lanjut'])) && !empty(trim($it['tujuan_masalah']))) {
                $filled++;
            }
        }
        $total = count($items);
        $pending = $total - $filled;

        $Data['Items'] = $items;
        $Data['Stats'] = [
            'total' => $total,
            'filled' => $filled,
            'pending' => $pending
        ];

        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/PengisianTinjutRekomendasiDPRDn1', $Data);
    }

    // Alias method
    public function PengisianTinjutRekomendasiDPRD() {
        $this->PengisianTinjutRekomendasiDPRDn1();
    }

    public function GetTinjutRekomendasiDPRD() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
        $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: 1);

        $this->db->where('deleted_at IS NULL');
        if ($tahun > 0) $this->db->where('tahun', $tahun);
        if ($instansi_id > 0) $this->db->where('instansi_id', $instansi_id);

        $items = $this->db->order_by('id', 'ASC')->get('lkpj_tinjut_rekomendasi_dprd')->result_array();

        $filled = 0;
        foreach ($items as $it) {
            if (!empty(trim($it['tindak_lanjut'])) && !empty(trim($it['tujuan_masalah']))) {
                $filled++;
            }
        }
        $total = count($items);
        $pending = $total - $filled;

        echo json_encode([
            'status' => 'success',
            'data' => $items,
            'stats' => [
                'total' => $total,
                'filled' => $filled,
                'pending' => $pending
            ]
        ]);
    }

    public function SaveTinjutRekomendasiDPRD() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
            $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: ($this->get_instansi_id() ?: 1));
            $kode_wilayah = $this->get_kode_wilayah() ?: '35.12';
            $tindak_lanjut = trim($this->input->post('tindak_lanjut', TRUE));
            $tujuan_masalah = trim($this->input->post('tujuan_masalah', TRUE));

            if ($id > 0) {
                // Rekomendasi DPRD bersifat mutlak / immutable dari relasi data lain
                $saveData = [
                    'kodewilayah' => $kode_wilayah,
                    'instansi_id' => $instansi_id,
                    'tahun' => $tahun,
                    'tindak_lanjut' => $tindak_lanjut,
                    'tujuan_masalah' => $tujuan_masalah,
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->where('id', $id)->update('lkpj_tinjut_rekomendasi_dprd', $saveData);
                $msg = 'Tindak Lanjut Rekomendasi DPRD berhasil diperbarui.';
            } else {
                $rekomendasi = trim($this->input->post('rekomendasi', TRUE));
                if (empty($rekomendasi)) {
                    throw new Exception('Rekomendasi DPRD wajib diisi.');
                }
                $saveData = [
                    'kodewilayah' => $kode_wilayah,
                    'instansi_id' => $instansi_id,
                    'tahun' => $tahun,
                    'rekomendasi' => $rekomendasi,
                    'tindak_lanjut' => $tindak_lanjut,
                    'tujuan_masalah' => $tujuan_masalah,
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->insert('lkpj_tinjut_rekomendasi_dprd', $saveData);
                $id = $this->db->insert_id();
                $msg = 'Tindak Lanjut Rekomendasi DPRD berhasil ditambahkan.';
            }

            echo json_encode([
                'status' => 'success',
                'message' => $msg,
                'data' => array_merge(['id' => $id], $saveData)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function DeleteTinjutRekomendasiDPRD() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) throw new Exception('ID data tidak valid.');

            $this->db->where('id', $id)->update('lkpj_tinjut_rekomendasi_dprd', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            echo json_encode(['status' => 'success', 'message' => 'Data Rekomendasi DPRD berhasil dihapus.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // ================================================================
    // 4. E-LKPJ: CAPAIAN KINERJA PELAKSANAAN TUGAS PEMBANTUAN
    // ================================================================

    public function CapaianKinerjaPelaksanaanTugasPembantuan() {
        $Header['Halaman'] = 'Capaian Kinerja Pelaksanaan Tugas Pembantuan';
        
        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE) ?: 2026;
        $filter_instansi = $this->input->get('instansi_id', TRUE);

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';

        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }

        $Data['ListInstansi'] = $this->db->select('id, nama')->from('akun_instansi')->where('deleted_at IS NULL')->order_by('nama', 'ASC')->get()->result_array();
        $Data['ListTahun'] = [2027, 2026, 2025, 2024, 2023];
        $Data['TahunAktif'] = (int)$tahun;
        $Data['FilterInstansi'] = $filter_instansi ? (int)$filter_instansi : 1;

        $this->db->where('deleted_at IS NULL');
        if ($tahun) $this->db->where('tahun', (int)$tahun);
        if ($filter_instansi) $this->db->where('instansi_id', (int)$filter_instansi);
        $Data['Items'] = $this->db->order_by('id', 'ASC')->get('lkpj_tugas_pembantuan')->result_array();

        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/CapaianKinerjaPelaksanaanTugasPembantuan', $Data);
    }

    public function GetTugasPembantuan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
        $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: 1);

        $this->db->where('deleted_at IS NULL');
        if ($tahun > 0) $this->db->where('tahun', $tahun);
        if ($instansi_id > 0) $this->db->where('instansi_id', $instansi_id);

        $items = $this->db->order_by('id', 'ASC')->get('lkpj_tugas_pembantuan')->result_array();
        echo json_encode(['status' => 'success', 'data' => $items]);
    }

    public function SaveTugasPembantuan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
            $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: ($this->get_instansi_id() ?: 1));
            $kode_wilayah = $this->get_kode_wilayah() ?: '35.12';

            $dasar_penugasan = trim($this->input->post('dasar_penugasan', TRUE));
            $instansi_pemberi = trim($this->input->post('instansi_pemberi', TRUE));
            $program = trim($this->input->post('program', TRUE));
            $kegiatan_output = trim($this->input->post('kegiatan_output', TRUE));
            $lokasi = trim($this->input->post('lokasi', TRUE));
            $satuan_unit = trim($this->input->post('satuan_unit', TRUE));
            $sumber_dana = trim($this->input->post('sumber_dana', TRUE));

            $pagu = (float)str_replace(',', '', str_replace('.', '', $this->input->post('pagu', TRUE)));
            $realisasi = (float)str_replace(',', '', str_replace('.', '', $this->input->post('realisasi', TRUE)));

            $manual_capaian = $this->input->post('capaian', TRUE);
            if ($manual_capaian !== null && $manual_capaian !== '') {
                $capaian = (float)str_replace(',', '.', $manual_capaian);
            } else {
                $capaian = ($pagu > 0) ? round(($realisasi / $pagu) * 100, 2) : 0;
            }

            $permasalahan = trim($this->input->post('permasalahan', TRUE));
            $solusi = trim($this->input->post('solusi', TRUE));

            if (empty($dasar_penugasan) || empty($instansi_pemberi) || empty($program) || empty($kegiatan_output)) {
                throw new Exception('Field bertanda bintang (*) wajib dilengkapi.');
            }

            $saveData = [
                'kodewilayah' => $kode_wilayah,
                'instansi_id' => $instansi_id,
                'tahun' => $tahun,
                'dasar_penugasan' => $dasar_penugasan,
                'instansi_pemberi' => $instansi_pemberi,
                'program' => $program,
                'kegiatan_output' => $kegiatan_output,
                'lokasi' => $lokasi,
                'satuan_unit' => $satuan_unit,
                'pagu' => $pagu,
                'realisasi' => $realisasi,
                'sumber_dana' => $sumber_dana,
                'capaian' => $capaian,
                'permasalahan' => $permasalahan,
                'solusi' => $solusi,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($id > 0) {
                $this->db->where('id', $id)->update('lkpj_tugas_pembantuan', $saveData);
                $msg = 'Data Tugas Pembantuan berhasil diperbarui.';
            } else {
                $saveData['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('lkpj_tugas_pembantuan', $saveData);
                $id = $this->db->insert_id();
                $msg = 'Data Tugas Pembantuan berhasil ditambahkan.';
            }

            echo json_encode([
                'status' => 'success',
                'message' => $msg,
                'data' => array_merge(['id' => $id], $saveData)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function DeleteTugasPembantuan() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $id = (int)$this->input->post('id', TRUE);
            if ($id <= 0) throw new Exception('ID data tidak valid.');

            $this->db->where('id', $id)->update('lkpj_tugas_pembantuan', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            echo json_encode(['status' => 'success', 'message' => 'Data Tugas Pembantuan berhasil dihapus.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    // ================================================================
    // 5. IPPD: TABEL INDEKS PERENCANAAN PEMBANGUNAN DAERAH
    // ================================================================

    private function get_ippd_master_data() {
        return [
            [
                'code' => '1',
                'title' => 'SINERGI',
                'bobot' => 32,
                'aspek' => [
                    [
                        'code' => '1.a',
                        'letter' => 'a',
                        'title' => 'Keselarasan Dokumen RPJMD dengan Dokumen RPJMN',
                        'bobot' => 9,
                        'indikator' => [
                            [
                                'code' => '1.a.1',
                                'no' => '1',
                                'title' => 'Keselarasan Sasaran dan antara Prioritas Pembangunan Daerah dalam RPJMD dengan Sasaran Prioritas Nasional (PN) RPJMN',
                                'bobot' => 2,
                                'sub' => [
                                    ['code' => '1.a.1.a', 'letter' => 'a', 'title' => 'Tingkat Keterkaitan indikator sasaran pembangunan daerah RPJMD RPJMN dengan PN', 'bobot' => 0.5],
                                    ['code' => '1.a.1.b', 'letter' => 'b', 'title' => 'Tersedianya tabel antara persandingan Sasaran Pembangunan daerah RPJMD dengan PN RPJMN', 'bobot' => 0.5],
                                    ['code' => '1.a.1.c', 'letter' => 'c', 'title' => 'Tingkat Keselarasan Prioritas Pembangunan Daerah dalam RPJMD dengan PN RPJMN', 'bobot' => 0.5],
                                    ['code' => '1.a.1.d', 'letter' => 'd', 'title' => 'Tersedianya tabel persandingan antara PN RPJMN dengan Prioritas Pembangunan Daerah', 'bobot' => 0.5]
                                ]
                            ],
                            [
                                'code' => '1.a.2',
                                'no' => '2',
                                'title' => 'Tersedianya dukungan program daerah dalam RPJMD untuk mendukung Kegiatan Prioritas dalam RPJMN',
                                'bobot' => 3,
                                'sub' => [
                                    ['code' => '1.a.2.a', 'letter' => 'a', 'title' => 'Ketersediaan dukungan program daerah dalam RPJMD untuk mendukung kegiatan prioritas dalam PN 1 RPJMN sesuai kewenangan daerah', 'bobot' => 0.375],
                                    ['code' => '1.a.2.b', 'letter' => 'b', 'title' => 'Ketersediaan dukungan program daerah dalam RPJMD untuk mendukung kegiatan prioritas dalam PN 2 RPJMN sesuai kewenangan daerah', 'bobot' => 0.375],
                                    ['code' => '1.a.2.c', 'letter' => 'c', 'title' => 'Ketersediaan dukungan program daerah dalam RPJMD untuk mendukung kegiatan prioritas dalam PN 3 RPJMN sesuai kewenangan daerah', 'bobot' => 0.375],
                                    ['code' => '1.a.2.d', 'letter' => 'd', 'title' => 'Ketersediaan dukungan program daerah dalam RPJMD untuk mendukung kegiatan prioritas dalam PN 4 RPJMN sesuai kewenangan daerah', 'bobot' => 0.375],
                                    ['code' => '1.a.2.e', 'letter' => 'e', 'title' => 'Ketersediaan dukungan program daerah dalam RPJMD untuk mendukung kegiatan prioritas dalam PN 5 RPJMN sesuai kewenangan daerah', 'bobot' => 0.375],
                                    ['code' => '1.a.2.f', 'letter' => 'f', 'title' => 'Ketersediaan dukungan program daerah dalam RPJMD untuk mendukung kegiatan prioritas dalam PN 6 RPJMN sesuai kewenangan daerah', 'bobot' => 0.375],
                                    ['code' => '1.a.2.g', 'letter' => 'g', 'title' => 'Ketersediaan dukungan program daerah dalam RPJMD untuk mendukung kegiatan prioritas dalam PN 7 RPJMN sesuai kewenangan daerah', 'bobot' => 0.375],
                                    ['code' => '1.a.2.h', 'letter' => 'h', 'title' => 'Ketersediaan dukungan program daerah dalam RPJMD untuk mendukung kegiatan prioritas dalam PN 8 RPJMN sesuai kewenangan daerah', 'bobot' => 0.375]
                                ]
                            ],
                            [
                                'code' => '1.a.3',
                                'no' => '3',
                                'title' => 'Indikator makro pada RPJMD selaras dengan indikator makro pada RPJMN:',
                                'bobot' => 1,
                                'sub' => [
                                    ['code' => '1.a.3.a', 'letter' => 'a', 'title' => 'Tingkat Pengangguran Terbuka (TPT) (%)', 'bobot' => 0.5],
                                    ['code' => '1.a.3.b', 'letter' => 'b', 'title' => 'Tingkat Kemiskinan (%)', 'bobot' => 0.5]
                                ]
                            ],
                            [
                                'code' => '1.a.4',
                                'no' => '4',
                                'title' => 'Dokumen RPJMD selaras dengan Proyek Prioritas Strategis',
                                'bobot' => 1,
                                'sub' => []
                            ],
                            [
                                'code' => '1.a.5',
                                'no' => '5',
                                'title' => 'Komponen SPM di RPJMD disclaraskan dengan komponen SPM Nasional',
                                'bobot' => 1,
                                'sub' => []
                            ],
                            [
                                'code' => '1.a.6',
                                'no' => '6',
                                'title' => 'Target SPM diselaraskan dengan target daerah SPM nasional',
                                'bobot' => 1,
                                'sub' => []
                            ]
                        ]
                    ],
                    [
                        'code' => '1.b',
                        'letter' => 'b',
                        'title' => 'Keselarasan Dokumen RKPD dengan RKP',
                        'bobot' => 13,
                        'indikator' => [
                            [
                                'code' => '1.b.1',
                                'no' => '1',
                                'title' => 'Keselarasan antara Sasaran dan Prioritas Pembangunan Daerah dalam RKPD dengan Sasaran Prioritas Nasional (PN) RKP',
                                'bobot' => 2.5,
                                'sub' => [
                                    ['code' => '1.b.1.a', 'letter' => 'a', 'title' => 'Tingkat indikator Keterkaitan pembangunan sasaran daerah RKPD dengan PN RKP', 'bobot' => 0.625],
                                    ['code' => '1.b.1.b', 'letter' => 'b', 'title' => 'Tersedianya persandingan tabel antara Sasaran Pembangunan daerah RKPD dengan PN RKP', 'bobot' => 0.625],
                                    ['code' => '1.b.1.c', 'letter' => 'c', 'title' => 'Tingkat Keselarasan Prioritas Pembangunan Dacrah dalam RKPD dengan PN RKP', 'bobot' => 0.625],
                                    ['code' => '1.b.1.d', 'letter' => 'd', 'title' => 'Tersedianya tabel persandingan antara PN RKP dengan Prioritas Pembangunan Daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.2',
                                'no' => '2',
                                'title' => 'Tersedianya Dukungan Program Daerah RKPD terhadap Kegiatan Prioritas pada PN 1',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.2.a', 'letter' => 'a', 'title' => 'Tingkat dukungan program daerah terhadap kegiatan prioritas pada PN 1 RKP sesuai dengan kewenangan daerah', 'bobot' => 0.625],
                                    ['code' => '1.b.2.b', 'letter' => 'b', 'title' => 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.3',
                                'no' => '3',
                                'title' => 'Tersedianya Dukungan Program Daerah RKPD terhadap Kegiatan Prioritas pada PN 2 RKP',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.3.a', 'letter' => 'a', 'title' => 'Tingkat program dukungan daerah terhadap kegiatan prioritas pada PN 2 RKP sesuai dengan kewenangan daerah', 'bobot' => 0.625],
                                    ['code' => '1.b.3.b', 'letter' => 'b', 'title' => 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.4',
                                'no' => '4',
                                'title' => 'Tersedianya Dukungan Program Daerah RKPD terhadap Kegiatan Prioritas pada PN 3 RKP',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.4.a', 'letter' => 'a', 'title' => 'Tingkat program dukungan daerah terhadap kegiatan prioritas pada PN 3 RKP sesuai dengan kewenangan daerah', 'bobot' => 0.625],
                                    ['code' => '1.b.4.b', 'letter' => 'b', 'title' => 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.5',
                                'no' => '5',
                                'title' => 'Tersedianya Dukungan Program Daerah RKPD terhadap Kegiatan Prioritas pada PN 4 RKP',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.5.a', 'letter' => 'a', 'title' => 'Tingkat program dukungan daerah terhadap kegiatan prioritas pada PN 4 RKP sesuai dengan kewenangan daerah', 'bobot' => 0.625],
                                    ['code' => '1.b.5.b', 'letter' => 'b', 'title' => 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.6',
                                'no' => '6',
                                'title' => 'Tersedianya Dukungan Program Daerah RKPD terhadap Kegiatan Prioritas pada PN 5 RKP',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.6.a', 'letter' => 'a', 'title' => 'Tingkat program dukungan daerah terhadap kegiatan prioritas pada PN 5 RKP sesuai dengan kewenangan daerah', 'bobot' => 0.625],
                                    ['code' => '1.b.6.b', 'letter' => 'b', 'title' => 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.7',
                                'no' => '7',
                                'title' => 'Tersedianya Dukungan Program Daerah RKPD terhadap Kegiatan Prioritas pada PN 6 RKP',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.7.a', 'letter' => 'a', 'title' => 'Tingkat program dukungan daerah terhadap kegiatan prioritas pada PN 6 RKP sesuai dengan kewenangan daerah', 'bobot' => 0.625],
                                    ['code' => '1.b.7.b', 'letter' => 'b', 'title' => 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.8',
                                'no' => '8',
                                'title' => 'Tersedianya Dukungan Program Daerah RKPD terhadap Kegiatan Prioritas pada PN 7 RKP',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.8.a', 'letter' => 'a', 'title' => 'Tingkat program dukungan daerah terhadap kegiatan prioritas pada PN 7 RKP sesuai dengan kewenangan daerah', 'bobot' => 0.625],
                                    ['code' => '1.b.8.b', 'letter' => 'b', 'title' => 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.9',
                                'no' => '9',
                                'title' => 'Tersedianya Dukungan Program Daerah RKPD terhadap Kegiatan Prioritas pada PN 8 RKP',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.9.a', 'letter' => 'a', 'title' => 'Tingkat program dukungan daerah terhadap kegiatan prioritas pada PN 8 RKP sesuai dengan kewenangan daerah', 'bobot' => 0.625],
                                    ['code' => '1.b.9.b', 'letter' => 'b', 'title' => 'Tersedianya informasi eksplisit persandingan keterkaitan program prioritas/kegiatan Prioritas RKP dengan program daerah', 'bobot' => 0.625]
                                ]
                            ],
                            [
                                'code' => '1.b.10',
                                'no' => '10',
                                'title' => 'Indikator pada makro RKPD selaras dengan indikator makro pada RKP',
                                'bobot' => 1.25,
                                'sub' => [
                                    ['code' => '1.b.10.a', 'letter' => 'a', 'title' => 'Tingkat Pengangguran Terbuka (TPT) (%)', 'bobot' => 0.625],
                                    ['code' => '1.b.10.b', 'letter' => 'b', 'title' => 'Tingkat Kemiskinan (%)', 'bobot' => 0.625]
                                ]
                            ]
                        ]
                    ],
                    [
                        'code' => '1.c',
                        'letter' => 'c',
                        'title' => 'Kesesuaian Anggaran Daerah (APBD) untuk Membiayai Program Prioritas Nasional/Kegiatan Prioritas Utama (KPU) dalam dokumen RKPD',
                        'bobot' => 10,
                        'indikator' => [
                            [
                                'code' => '1.c.1',
                                'no' => '1',
                                'title' => 'Tersedianya APBD untuk Prioritas dukungan Program Nasional/Kegiatan Prioritas Utama (KPU) dalam Dokumen RKPD',
                                'bobot' => 10,
                                'sub' => []
                            ]
                        ]
                    ]
                ]
            ],
            [
                'code' => '2',
                'title' => 'KUALITAS PERENCANAAN',
                'bobot' => 58,
                'aspek' => [
                    [
                        'code' => '2.a',
                        'letter' => 'a',
                        'title' => 'Kesesuaian antara Isu Strategis TargetProgram/Kegiatan/Proyek di RPJMD atau RKPD',
                        'bobot' => 49,
                        'indikator' => [
                            [
                                'code' => '2.a.1',
                                'no' => '1',
                                'title' => 'Kesesuaian Isu Strategis dengan Kebutuhan Daerah',
                                'bobot' => 18,
                                'sub' => [
                                    ['code' => '2.a.1.a', 'letter' => 'a', 'title' => 'Keterkaitan permasalahan daerah (kebutuhan daerah) dengan hasil evaluasi', 'bobot' => 6],
                                    ['code' => '2.a.1.b', 'letter' => 'b', 'title' => 'Keterkaitan Prioritas daerah pembangunan dengan permasalahan pembangunan', 'bobot' => 6],
                                    ['code' => '2.a.1.c', 'letter' => 'c', 'title' => 'Penyusunan Prioritas pembangunan daerah berdasarkan isu strategis', 'bobot' => 6]
                                ]
                            ],
                            [
                                'code' => '2.a.2',
                                'no' => '2',
                                'title' => 'Kesesuaian Target Sasaran dan Pembangunan dalam menyelesaikan Isu dan Prioritas Daerah',
                                'bobot' => 14,
                                'sub' => [
                                    ['code' => '2.a.2.a', 'letter' => 'a', 'title' => 'Tersedianya indikator sasaran untuk isu strategis/prioritas pembangunan daerah', 'bobot' => 6],
                                    ['code' => '2.a.2.b', 'letter' => 'b', 'title' => 'Tingkat kesesuaian sasaran indikator prioritas pembangunan daerah menyelesaikan isu strategis dalam daerah/prioritas pembangunan daerah', 'bobot' => 8]
                                ]
                            ],
                            [
                                'code' => '2.a.3',
                                'no' => '3',
                                'title' => 'Kesesuaian Program/Kegiatan/Proyek dalam mencapai target dan sasaran program',
                                'bobot' => 17,
                                'sub' => [
                                    ['code' => '2.a.3.a', 'letter' => 'a', 'title' => 'Prioritas Pembangunan Daerah dijabarkan menjadi program prioritas', 'bobot' => 8.5],
                                    ['code' => '2.a.3.b', 'letter' => 'b', 'title' => 'Tingkat indikator Keterkaitan sasaran Prioritas pembangunan daerah dengan indikator kinerja Program Prioritas', 'bobot' => 8.5]
                                ]
                            ]
                        ]
                    ],
                    [
                        'code' => '2.b',
                        'letter' => 'b',
                        'title' => 'Program Unggulan Perencanaan Pembangunan',
                        'bobot' => 9,
                        'indikator' => [
                            [
                                'code' => '2.b.1',
                                'no' => '1',
                                'title' => 'Keterkaitan Permasalahan dengan Program Unggulan yang dilaksanakan',
                                'bobot' => 4.5,
                                'sub' => []
                            ],
                            [
                                'code' => '2.b.2',
                                'no' => '2',
                                'title' => 'Keterkaitan Output dengan outcome unggulan program',
                                'bobot' => 4.5,
                                'sub' => []
                            ]
                        ]
                    ]
                ]
            ],
            [
                'code' => '3',
                'title' => 'KETERHUBUNGAN PERENCANAAN PEMBANGUNAN DENGAN PERENCANAAN KINERJA',
                'bobot' => 10,
                'aspek' => [
                    [
                        'code' => '3.a',
                        'letter' => 'a',
                        'title' => 'Target dan Sasaran Pembangunan daerah menjadi Target dan Sasaran Kinerja Lembaga terkait',
                        'bobot' => 10,
                        'indikator' => [
                            [
                                'code' => '3.a.1',
                                'no' => '1',
                                'title' => 'Cascading Target Pembangunan Daerah menjadi Target Kinerja Lembaga Terkait di dalam Pemerintah Daerah',
                                'bobot' => 10,
                                'sub' => [
                                    ['code' => '3.a.1.a', 'letter' => 'a', 'title' => 'Tersedianya penanggungjawab OPD untuk masing-masing program prioritas', 'bobot' => 5],
                                    ['code' => '3.a.1.b', 'letter' => 'b', 'title' => 'Target dan sasaran prioritas daerah menjadi IKU OPD yang bertanggungjawab', 'bobot' => 5]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }

    public function TabelIPPD() {
        $Header['Halaman'] = 'Tabel Indeks Perencanaan Pembangunan Daerah (IPPD)';

        $KodeWilayah = $this->get_kode_wilayah();
        $instansi_id = $this->get_instansi_id();
        $is_role_4 = $this->is_role_4();
        $tahun = $this->input->get('tahun', TRUE) ?: 2026;
        $filter_instansi = $this->input->get('instansi_id', TRUE);

        if ($is_role_4 && $instansi_id) {
            $filter_instansi = $instansi_id;
        }

        $Data['KodeWilayah'] = $KodeWilayah;
        $Data['NamaWilayah'] = '';
        $Data['IsRole4'] = $is_role_4;
        $Data['InstansiId'] = $instansi_id;
        $Data['ControllerName'] = 'Instansi';

        if (!empty($KodeWilayah)) {
            $wilayah = $this->db->where('Kode', $KodeWilayah)->get('kodewilayah')->row_array();
            $Data['NamaWilayah'] = $wilayah ? $wilayah['Nama'] : '';
        }

        $Data['ListInstansi'] = $this->db->select('id, nama')->from('akun_instansi')->where('deleted_at IS NULL')->order_by('nama', 'ASC')->get()->result_array();
        $Data['ListTahun'] = [2027, 2026, 2025, 2024, 2023];
        $Data['TahunAktif'] = (int)$tahun;
        $Data['FilterInstansi'] = $filter_instansi ? (int)$filter_instansi : 1;
        $Data['MasterData'] = $this->get_ippd_master_data();

        // Get saved scores
        $this->db->where('deleted_at IS NULL');
        if ($tahun) $this->db->where('tahun', (int)$tahun);
        if ($filter_instansi) $this->db->where('instansi_id', (int)$filter_instansi);
        if ($KodeWilayah) $this->db->where('kodewilayah', $KodeWilayah);
        $savedScores = $this->db->get('ippd_penilaian')->result_array();

        $scoresMap = [];
        foreach ($savedScores as $sc) {
            $scoresMap[$sc['item_code']] = [
                'id' => $sc['id'],
                'bobot_capaian' => ($sc['bobot_capaian'] !== null) ? (float)$sc['bobot_capaian'] : null,
                'opsi_aksi' => $sc['opsi_aksi'],
                'catatan' => $sc['catatan'],
                'bukti_dukung' => $sc['bukti_dukung'],
                'status_verifikasi' => $sc['status_verifikasi']
            ];
        }
        $Data['SavedScores'] = $scoresMap;

        $this->load->view('Daerah/header', $Header);
        $this->load->view('Daerah/TabelIPPD', $Data);
    }

    // Alias
    public function IPPD() {
        $this->TabelIPPD();
    }

    public function GetIPPDData() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
        $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: 1);
        $kode_wilayah = $this->get_kode_wilayah() ?: '35.12';

        $this->db->where('deleted_at IS NULL');
        if ($tahun > 0) $this->db->where('tahun', $tahun);
        if ($instansi_id > 0) $this->db->where('instansi_id', $instansi_id);
        if ($kode_wilayah) $this->db->where('kodewilayah', $kode_wilayah);

        $savedScores = $this->db->get('ippd_penilaian')->result_array();
        $scoresMap = [];
        foreach ($savedScores as $sc) {
            $scoresMap[$sc['item_code']] = [
                'id' => $sc['id'],
                'bobot_capaian' => ($sc['bobot_capaian'] !== null) ? (float)$sc['bobot_capaian'] : null,
                'opsi_aksi' => $sc['opsi_aksi'],
                'catatan' => $sc['catatan'],
                'bukti_dukung' => $sc['bukti_dukung'],
                'status_verifikasi' => $sc['status_verifikasi']
            ];
        }

        echo json_encode([
            'status' => 'success',
            'master' => $this->get_ippd_master_data(),
            'scores' => $scoresMap
        ]);
    }

    public function SaveIPPDScore() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
            $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: ($this->get_instansi_id() ?: 1));
            $kode_wilayah = $this->get_kode_wilayah() ?: '35.12';
            $item_code = trim($this->input->post('item_code', TRUE));
            $bobot_capaian = $this->input->post('bobot_capaian', TRUE);
            $opsi_aksi = trim($this->input->post('opsi_aksi', TRUE));
            $catatan = trim($this->input->post('catatan', TRUE));
            $bukti_dukung = trim($this->input->post('bukti_dukung', TRUE));

            if (empty($item_code)) {
                throw new Exception('Item indikator / sub-indikator tidak valid.');
            }

            $bobot_val = ($bobot_capaian !== '' && $bobot_capaian !== null) ? (float)$bobot_capaian : null;

            // Check if existing record
            $existing = $this->db->where([
                'kodewilayah' => $kode_wilayah,
                'instansi_id' => $instansi_id,
                'tahun' => $tahun,
                'item_code' => $item_code,
                'deleted_at IS NULL' => null
            ])->get('ippd_penilaian')->row_array();

            $saveData = [
                'kodewilayah' => $kode_wilayah,
                'instansi_id' => $instansi_id,
                'tahun' => $tahun,
                'item_code' => $item_code,
                'bobot_capaian' => $bobot_val,
                'opsi_aksi' => $opsi_aksi,
                'catatan' => $catatan,
                'bukti_dukung' => $bukti_dukung,
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($existing) {
                $this->db->where('id', $existing['id'])->update('ippd_penilaian', $saveData);
                $id = $existing['id'];
            } else {
                $saveData['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('ippd_penilaian', $saveData);
                $id = $this->db->insert_id();
            }

            echo json_encode([
                'status' => 'success',
                'message' => 'Penilaian IPPD berhasil disimpan.',
                'data' => array_merge(['id' => $id], $saveData)
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function SaveAllIPPDScore() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
            $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: ($this->get_instansi_id() ?: 1));
            $kode_wilayah = $this->get_kode_wilayah() ?: '35.12';
            $itemsJson = $this->input->post('items', FALSE);
            $items = json_decode($itemsJson, TRUE);

            if (!is_array($items)) {
                throw new Exception('Format data penilaian tidak valid.');
            }

            $count = 0;
            foreach ($items as $item) {
                if (empty($item['item_code'])) continue;

                $item_code = trim($item['item_code']);
                $bobot_val = (isset($item['bobot_capaian']) && $item['bobot_capaian'] !== '' && $item['bobot_capaian'] !== null) ? (float)$item['bobot_capaian'] : null;
                $opsi_aksi = isset($item['opsi_aksi']) ? trim($item['opsi_aksi']) : null;
                $catatan = isset($item['catatan']) ? trim($item['catatan']) : null;
                $bukti_dukung = isset($item['bukti_dukung']) ? trim($item['bukti_dukung']) : null;

                $existing = $this->db->where([
                    'kodewilayah' => $kode_wilayah,
                    'instansi_id' => $instansi_id,
                    'tahun' => $tahun,
                    'item_code' => $item_code,
                    'deleted_at IS NULL' => null
                ])->get('ippd_penilaian')->row_array();

                $saveData = [
                    'kodewilayah' => $kode_wilayah,
                    'instansi_id' => $instansi_id,
                    'tahun' => $tahun,
                    'item_code' => $item_code,
                    'bobot_capaian' => $bobot_val,
                    'opsi_aksi' => $opsi_aksi,
                    'catatan' => $catatan,
                    'bukti_dukung' => $bukti_dukung,
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if ($existing) {
                    $this->db->where('id', $existing['id'])->update('ippd_penilaian', $saveData);
                } else {
                    $saveData['created_at'] = date('Y-m-d H:i:s');
                    $this->db->insert('ippd_penilaian', $saveData);
                }
                $count++;
            }

            echo json_encode([
                'status' => 'success',
                'message' => "Berhasil menyimpan {$count} data penilaian IPPD."
            ]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function ResetIPPDData() {
        if (!$this->input->is_ajax_request()) {
            show_404();
            return;
        }
        header('Content-Type: application/json');

        try {
            $tahun = (int)($this->input->post('tahun', TRUE) ?: 2026);
            $instansi_id = (int)($this->input->post('instansi_id', TRUE) ?: 1);
            $kode_wilayah = $this->get_kode_wilayah() ?: '35.12';

            $this->db->where([
                'kodewilayah' => $kode_wilayah,
                'instansi_id' => $instansi_id,
                'tahun' => $tahun
            ])->update('ippd_penilaian', [
                'deleted_at' => date('Y-m-d H:i:s')
            ]);

            echo json_encode(['status' => 'success', 'message' => 'Data penilaian IPPD berhasil direset.']);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

}
?>