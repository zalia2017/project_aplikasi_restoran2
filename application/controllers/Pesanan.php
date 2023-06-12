<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        // cek_user();
        $this->load->model('ModelKategori');
        $this->load->model('ModelPesanan');
    }

    /**
     * 4 Method pengelolaan pesanan
     * 1. Menampilkan data pesanan
     * 2. Menampilkan data detail pesanan
     * 3. Menjalankan aksi bayar pesanan
     * 4. Menampilkan halaman info 
     * 4. Menghapus data produk
     */
    //1. Menampilkan data pesanan
    public function index()
    {
      //Untuk memberikan judul pada tab browser
        $data['judul'] = 'Daftar Pesanan';
        //Untuk menampilkan data dari tabel pesanan
        $data['pesanan'] = $this->ModelPesanan->getPesanan()->result_array();
        //Untuk menampilkan nama user pada topbar
        $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();

        //Data-data diatas dilempar ke dalam view
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        //Data-data isi dari pesanan di tampilkan pada view admin/pesanan/daftarPesanan
        $this->load->view('admin/pesanan/daftarPesanan', $data);
        $this->load->view('templates/footer');
    }
    //2.Menampilkan detail pesanan
    public function detailPesanan()
    {
      $noPesanan = $this->uri->segment(3);
      $data['judul'] = 'Detail Pesanan';

      $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();

      $data['pesanan'] =$this->ModelPesanan->getPesananWhere(['no_pesanan'=>$noPesanan])->row_array();

      //Untuk mendapatkan data detailPesanan sesuai dengan no_pesanan
      $data['detail'] = $this->ModelPesanan->getDetailPesananWhere(['pesanan.no_pesanan'=>$noPesanan])->result_array();
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/pesanan/daftarDetailPesanan', $data);
    //   $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/footer');
    }

    //3.Menjalankan aksi bayarPesanan
    public function bayarPesanan()
    {
      //Mendapatkan data dari form pembayaran
        $noPesanan = $this->input->post('noPesanan', true);
        $totalBayar = $this->input->post('jumlahBayar', true);
        $jenisBayar = $this->input->post('jenisBayar', true);
        $statusPesanan = "Dibayar";
        //Session id_user didapatkan ketika kasir/usernya login
        $idKasir = $this->session->userdata('id_user');
        $data = [
            'total_bayar' => $totalBayar,
            'jenis_bayar' => $jenisBayar,
            'status_pesanan' => $statusPesanan,
            'id_kasir' => $idKasir
        ];
        //Update data di tabel pesanan
        $this->ModelPesanan->updatePesananWhere($data, ['no_pesanan' => $noPesanan]);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Data berhasil dibayar</div>');
        redirect('pesanan/info/'.$noPesanan);
    }
    //Untuk menampilkan halaman info sebelum cetak struk
    public function info($noPesanan)
    {
      $noPesanan = $this->uri->segment(3);
      $data['judul'] = 'Detail Pesanan';
      //Untuk memunculkan data dari tabel temp, berdasarkan id_session manual
      $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();
        $data['pesanan'] =$this->ModelPesanan->getPesananWhere(['pesanan.no_pesanan'=>$noPesanan])->row_array();
      $data['detail'] = $this->ModelPesanan->getDetailPesananWhere(['detail_pesanan.no_pesanan'=>$noPesanan])->result_array();
      
      $this->load->view('templates/header',$data);
      $this->load->view('templates/sidebar', $data);
      $this->load->view('templates/topbar', $data);
      $this->load->view('admin/pesanan/infoPesanan', $data);
    //   $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/footer');
    }
    //5. Cetak pesanan untuk menampilkan halaman struk
    public function cetakPesanan()
    {
        $noPesanan = $this->uri->segment(3);
        $data['tanggal'] = date("d/m/Y (H:i:s)");
        $data['detail_pesanan'] = $this->ModelPesanan->getDetailPesananWhere(['detail_pesanan.no_pesanan' => $noPesanan])->result_array();

        $data['pesanan'] = $this->ModelPesanan->getPesananWhere(['pesanan.no_pesanan' => $noPesanan])->row_array();

        $this->load->view('admin/pesanan/print-pesanan', $data);
    }
}