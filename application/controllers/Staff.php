<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Staff extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(['ModelProduk', 'ModelUser', 'ModelKategori']);
        cek_login();
        // cek_user();
    }

    //hanya ada 2 method diluar method constructor
    /**
     * 1. index. Untuk menampilkan halaman pesanan
     * 2. ubahStatus. Untuk mengubah status pesanan
     */
    public function index()
    {
        $data['judul'] = 'Daftar Pesanan';
        //Menampilkan nama pada topbar
        $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();
        //Menampilkan detail pesanan dimana status pesanannya adalah bukan Dipesan
        // $data['detail_pesanan'] = $this->ModelPesanan->getDetailPesananWhere(['pesanan.status_pesanan !=' =>'Dipesan'])->result_array();
        $data['detail_pesanan'] = $this->ModelPesanan->getTodayDetailPesananWhere(['pesanan.status_pesanan !=' =>'Dipesan'])->result_array();
        $this->load->view('templates/header', $data);
        // $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('staff/pesanan/daftarPesanan', $data);
        $this->load->view('templates/footer');
    }
    public function ubahStatus()
    {
        //untuk mendapatkan uri segment 3 yang berisi no pesanan
        $noPesanan = $this->uri->segment(3);
        //untuk mendapatkan status sebelumnya berdasarkan no pesanan
        $statusLama = $this->ModelPesanan->getPesananWhere(['no_pesanan'=>$noPesanan])->row()->status_pesanan;

        switch($statusLama){
            case "Dibayar": 
                $statusBaru = "Siap disajikan";
                break;
            case "Siap disajikan": 
                $statusBaru = "Diantar";
                break;
            case "Diantar": 
                $statusBaru = "Selesai";
                break;
        }
        $myData = [
            "status_pesanan" => $statusBaru
        ];
        //Diupdate data di tabel pesanan untuk kolom status_pesanan
        $this->ModelPesanan->updatePesananWhere($myData, ['no_pesanan' => $noPesanan]);
        //Menyiapkan data dari tabel detail pesanan untuk ditampilkan pada halaman pesanan di view staff
        $data['detail_pesanan'] = $this->ModelPesanan->getDetailPesananWhere(['pesanan.status_pesanan !=' =>'Dipesan'])->result_array();
        //Menampilkan sesssion set_flash data pesan "status Pesanan berhasil diubah"
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Status Pesanan berhasil diubah</div>');
        //redirect ke controller staff
        redirect('staff');
    }

}