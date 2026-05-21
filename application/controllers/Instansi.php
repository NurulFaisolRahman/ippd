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
        return $this->is_logged_in() && isset($_SESSION['Level']) && $_SESSION['Level'] == 4;
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
                ->where('Level', 4)
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
                ->where('Level', 4)
                ->where('deleted_at IS NULL')
                ->order_by('nama', 'ASC')
                ->get()
                ->result_array();
        }
        
        // Data NSPK
        $data['ListNSPK'] = $this->db->where('deleted_at IS NULL')
                                     ->order_by('jenis_nspk', 'ASC')
                                     ->order_by('judul_nspk', 'ASC')
                                     ->get('nspk')
                                     ->result_array();
        
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
        
        // Ambil data master dengan filter instansi
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
                // Proses NSPK
                $norma_ids = !empty($m['nspk_norma_id']) ? explode('|||', $m['nspk_norma_id']) : [];
                $standar_ids = !empty($m['nspk_standar_id']) ? explode('|||', $m['nspk_standar_id']) : [];
                $prosedur_ids = !empty($m['nspk_prosedur_id']) ? explode('|||', $m['nspk_prosedur_id']) : [];
                $kriteria_ids = !empty($m['nspk_kriteria_id']) ? explode('|||', $m['nspk_kriteria_id']) : [];
                
                $m['norma_list'] = !empty($norma_ids) ? $this->db->where_in('id', $norma_ids)->get('nspk')->result_array() : [];
                $m['standar_list'] = !empty($standar_ids) ? $this->db->where_in('id', $standar_ids)->get('nspk')->result_array() : [];
                $m['prosedur_list'] = !empty($prosedur_ids) ? $this->db->where_in('id', $prosedur_ids)->get('nspk')->result_array() : [];
                $m['kriteria_list'] = !empty($kriteria_ids) ? $this->db->where_in('id', $kriteria_ids)->get('nspk')->result_array() : [];
                
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
        
        $master_id = (int)$this->input->post('master_id', true);
        
        // Validasi apakah master milik instansi ini
        $master = $this->db->where('id', $master_id)
            ->where('deleted_at IS NULL')
            ->get('tujuansasaran_pd_master')
            ->row_array();
        
        if (!$master) {
            echo "Master data tidak ditemukan!";
            return;
        }
        
        if ($master['id_instansi'] != $instansi_id) {
            echo "Akses ditolak! Anda hanya dapat menambah data ke master milik sendiri.";
            return;
        }
        
        $sasaran_id = $this->input->post('sasaran_id', true) ?: null;
        $indikator = trim($this->input->post('indikator', true));
        $keterangan = trim($this->input->post('keterangan', true));
        
        if (!$indikator) {
            echo "Indikator harus diisi!";
            return;
        }
        
        $data = [
            'master_id'     => $master_id,
            'kode_wilayah'  => $KodeWilayah,
            'id_instansi'   => $instansi_id,
            'sasaran_id'    => $sasaran_id,
            'indikator'     => $indikator,
            't2025'         => $this->input->post('t2025', true),
            't2026'         => $this->input->post('t2026', true),
            't2027'         => $this->input->post('t2027', true),
            't2028'         => $this->input->post('t2028', true),
            't2029'         => $this->input->post('t2029', true),
            't2030'         => $this->input->post('t2030', true),
            'keterangan'    => $keterangan,
            'created_at'    => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('tujuansasaran_pd_detail', $data);
        echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menyimpan!';
    }

    /**
     * Edit Detail Tujuan Sasaran PD (AJAX) - HANYA UNTUK ROLE 4
     */
    public function EditTujuanSasaranPD_Detail() {
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
            ->get('tujuansasaran_pd_detail')
            ->row_array();
        
        if (!$existing) {
            echo "Data tidak ditemukan!";
            return;
        }
        
        if ($existing['id_instansi'] != $instansi_id) {
            echo "Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.";
            return;
        }
        
        $sasaran_id = $this->input->post('sasaran_id', true) ?: null;
        $indikator = trim($this->input->post('indikator', true));
        $keterangan = trim($this->input->post('keterangan', true));
        
        if (!$indikator) {
            echo "Indikator harus diisi!";
            return;
        }
        
        $data = [
            'sasaran_id'    => $sasaran_id,
            'indikator'     => $indikator,
            't2025'         => $this->input->post('t2025', true),
            't2026'         => $this->input->post('t2026', true),
            't2027'         => $this->input->post('t2027', true),
            't2028'         => $this->input->post('t2028', true),
            't2029'         => $this->input->post('t2029', true),
            't2030'         => $this->input->post('t2030', true),
            'keterangan'    => $keterangan,
            'updated_at'    => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id', $id);
        $this->db->update('tujuansasaran_pd_detail', $data);
        
        echo $this->db->affected_rows() > 0 ? '1' : 'Tidak ada perubahan data!';
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
            ->get('tujuansasaran_pd_detail')
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
        $this->db->update('tujuansasaran_pd_detail', [
            'deleted_at' => date('Y-m-d H:i:s')
        ]);
        
        echo $this->db->affected_rows() > 0 ? '1' : 'Gagal menghapus data!';
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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

// =====================================================
// MENU RENSTRA PD
// =====================================================

/**
 * Halaman Menu Renstra PD
 */
public function MenuRenstra() {
    $Header['Halaman'] = 'Menu Renstra PD';
    
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
            ->where('Level', 4)
            ->where('deleted_at IS NULL')
            ->order_by('nama', 'ASC')
            ->get()
            ->result_array();
    }
    
    // ========== AMBIL DATA ANGGARAN RENSTRA ==========
    $data['anggaran'] = [];
    
    if ($KodeWilayah) {
        $query = $this->db->from('menurenstrapd')
            ->where('KodeWilayah', $KodeWilayah)
            ->where('deleted_at IS NULL');
        
        if ($is_role_4 && $instansi_id) {
            $query->where('id_instansi', $instansi_id);
        } elseif (!empty($filter_instansi_id)) {
            $query->where('id_instansi', (int)$filter_instansi_id);
        }
        
        $data['anggaran'] = $query->order_by('Id', 'ASC')->get()->result_array();
    }
    
    $this->load->view('Daerah/header', $Header);
    $this->load->view('Daerah/MenuRenstra', $data);
}

/**
 * Simpan/Update Data Menu Renstra (AJAX) - HANYA UNTUK ROLE 4
 */
public function simpanMenuRenstra() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menambah/mengedit data.']);
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
    
    $Id = (int)$this->input->post('Id');
    $NoManual = trim($this->input->post('NoManual'));
    $Uraian = trim($this->input->post('Uraian'));
    $IndikatorKinerja = trim($this->input->post('IndikatorKinerja'));
    $Satuan = trim($this->input->post('Satuan'));
    $Keterangan = trim($this->input->post('Keterangan'));
    
    if (empty($Uraian)) {
        echo json_encode(['status' => 'error', 'message' => 'Uraian tidak boleh kosong']);
        return;
    }
    
    $data = [
        'KodeWilayah'      => $KodeWilayah,
        'id_instansi'      => $instansi_id,
        'NoManual'         => $NoManual,
        'Uraian'           => $Uraian,
        'IndikatorKinerja' => $IndikatorKinerja,
        'Satuan'           => $Satuan,
        'Keterangan'       => $Keterangan,
        'updated_at'       => date('Y-m-d H:i:s')
    ];
    
    // Target dan pagu tahunan
    for ($thn = 2025; $thn <= 2030; $thn++) {
        $data["Target$thn"] = $this->input->post("Target$thn") ?: null;
        $data["Rp$thn"] = $this->input->post("Rp$thn") ?: null;
    }
    
    if ($Id > 0) {
        // Validasi kepemilikan data untuk edit
        $existing = $this->db->where('Id', $Id)
            ->where('KodeWilayah', $KodeWilayah)
            ->where('deleted_at IS NULL')
            ->get('menurenstrapd')
            ->row_array();
        
        if (!$existing) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
            return;
        }
        
        if ($existing['id_instansi'] != $instansi_id) {
            echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat mengedit data instansi sendiri.']);
            return;
        }
        
        $this->db->where('Id', $Id)
                 ->where('KodeWilayah', $KodeWilayah)
                 ->update('menurenstrapd', $data);
    } else {
        $data['created_at'] = date('Y-m-d H:i:s');
        $this->db->insert('menurenstrapd', $data);
    }
    
    $affected = $this->db->affected_rows();
    echo json_encode([
        'status'  => $affected > 0 ? 'success' : 'error',
        'message' => $affected > 0 ? 'Data berhasil disimpan' : 'Tidak ada perubahan'
    ]);
}

/**
 * Hapus Data Menu Renstra (AJAX) - HANYA UNTUK ROLE 4
 */
public function hapusMenuRenstra() {
    if (!$this->input->is_ajax_request()) {
        show_404();
        return;
    }
    
    if (!$this->can_crud()) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Hanya Instansi yang dapat menghapus data.']);
        return;
    }
    
    $Id = (int)$this->input->post('Id');
    $KodeWilayah = $this->get_kode_wilayah();
    $instansi_id = $this->get_instansi_id();
    
    if (!$Id || !$KodeWilayah) {
        echo json_encode(['status' => 'error', 'message' => 'Parameter tidak lengkap']);
        return;
    }
    
    // Validasi kepemilikan data
    $existing = $this->db->where('Id', $Id)
        ->where('KodeWilayah', $KodeWilayah)
        ->where('deleted_at IS NULL')
        ->get('menurenstrapd')
        ->row_array();
    
    if (!$existing) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        return;
    }
    
    if ($existing['id_instansi'] != $instansi_id) {
        echo json_encode(['status' => 'error', 'message' => 'Akses ditolak! Anda hanya dapat menghapus data instansi sendiri.']);
        return;
    }
    
    $this->db->where('Id', $Id)
             ->where('KodeWilayah', $KodeWilayah)
             ->update('menurenstrapd', [
                 'deleted_at' => date('Y-m-d H:i:s')
             ]);
    
    echo json_encode([
        'status'  => $this->db->affected_rows() > 0 ? 'success' : 'error',
        'message' => $this->db->affected_rows() > 0 ? 'Data berhasil dihapus' : 'Data tidak ditemukan'
    ]);
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
    $this->db->from('nomenklaturprovinsi');
    
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
        ->select('Kode, Nomenklatur')
        ->from('nomenklaturprovinsi')
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
            ->where('Level', 4)
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
            ->where('Level', 4)
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
        ->where('Level', 4)
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
        ->where('Level', 2)
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
            ->where('Level', 4)
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
        ->where('Level', 4)
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
        ->where('Level', 2)
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
            ->where('Level', 4)
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
        ->where('Level', 4)
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
        ->where('Level', 2)
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
            ->where('Level', 4)
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
            ->where('Level', 2)
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
    
}
?>