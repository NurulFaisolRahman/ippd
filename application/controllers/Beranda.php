<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Beranda extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function index() {
        // Query untuk menghitung total akun
        $query_akun = $this->db->select('COUNT(*) as total_akun')
                              ->from('akun')
                              ->get();
        
        // Query untuk menghitung total akun instansi
        $query_instansi = $this->db->select('COUNT(*) as total_instansi')
                                  ->from('akun_instansi')
                                  ->get();

        $data['total_akun'] = $query_akun->row()->total_akun;
        $data['total_instansi'] = $query_instansi->row()->total_instansi;
        
        $this->load->view('Beranda', $data);
    }
}