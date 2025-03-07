<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaInstansi extends CI_Controller {
    public function index() {
        $this->load->view('templates/header_akun');
        $this->load->view('Akun_Instansi/kelola_instansi');
    }

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function tambah_akun() {
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');
    
        if (empty($nama) || empty($password)) {
            echo json_encode(["status" => "error", "message" => "Semua field harus diisi!"]);
            return;
        }
    
        $data = [
            'nama' => $nama,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ];
    
        $this->db->insert('akun_instansi', $data);
    
        echo json_encode(["status" => "success", "message" => "Akun berhasil ditambahkan!"]);
    }

    public function get_akun() {
        // Hanya ambil data yang belum dihapus (deleted_at IS NULL)
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get('akun_instansi');

        echo json_encode($query->result());
    }

    public function edit_akun() {
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password'); // Password baru (opsional)
    
        // Data yang akan diupdate
        $data = ['nama' => $nama];
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT); // Hash password baru
        }
    
        // Update data
        $this->db->where('id', $id);
        $this->db->update('akun_instansi', $data);
    
        // Ambil data terbaru setelah diupdate
        $this->db->where('id', $id);
        $query = $this->db->get('akun_instansi');
        $updatedData = $query->row();
    
        echo json_encode(["status" => "success", "message" => "Akun diperbarui!", "data" => $updatedData]);
    }

    public function hapus_akun() {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('akun_instansi', ['deleted_at' => date('Y-m-d H:i:s')]);

        echo json_encode(["status" => "success", "message" => "Akun dihapus (soft delete)!"]);
    }

    public function hapus_permanen() {
        $id = $this->input->post('id');

        // Hapus data secara permanen
        $this->db->where('id', $id);
        $this->db->delete('akun_instansi');

        echo json_encode(["status" => "success", "message" => "Akun dihapus permanen!"]);
    }

    // Halaman utama restore data
    public function restore_page() {
        $this->load->view('templates/header_akun');
        $this->load->view('Akun_Instansi/restoreakun_instansi'); // Halaman khusus restore
    }

    // Ambil data yang sudah di-soft delete
    public function get_deleted_akun() {
        // Hanya ambil data yang sudah dihapus (deleted_at IS NOT NULL)
        $this->db->where('deleted_at IS NOT NULL', NULL, FALSE);
        $query = $this->db->get('akun_instansi');

        echo json_encode($query->result());
    }

    // Restore data: Set deleted_at kembali ke NULL
    public function restore_akun() {
        $id = $this->input->post('id');

        $this->db->where('id', $id);
        $this->db->update('akun_instansi', ['deleted_at' => NULL]);

        echo json_encode(["status" => "success", "message" => "Akun berhasil dipulihkan!"]);
    }
}