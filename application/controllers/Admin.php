<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ModelProduk', 'ModelUser', 'ModelKategori']);
        cek_login();
        // cek_user();
    }

    public function index()
    {
        $data['judul'] = 'Dashboard';
        //Menampilkan nama pada topbar
        $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();
        //Menampilkan jumlah kasir, staff, kategori, produk
        $data['jumlah_kasir'] = $this->ModelUser->getUserWhere(['role_id'=>'1'])->num_rows();
        $data['jumlah_staff'] = $this->ModelUser->getUserWhere(['role_id'=>'2'])->num_rows();
        $data['jumlah_kategori'] = $this->ModelKategori->getKategori()->num_rows();
        $data['jumlah_produk'] = $this->ModelProduk->getProduk()->num_rows();
        //Menampilkan data(list) kategori dan produk
        $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
        $data['produk'] = $this->ModelProduk->getProduk()->result_array();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

}