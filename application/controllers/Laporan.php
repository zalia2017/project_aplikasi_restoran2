<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class Laporan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(['ModelUser', 'ModelKategori']);
  }

  // Laporan Kategori
  public function laporan_kategori()
  {
    $data['judul'] = 'Daftar Kategori';
    $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
    $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/laporan/kategori/laporan_kategori', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_laporan_kategori()
  {
    $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
    $this->load->view('admin/laporan/kategori/laporan_print_kategori', $data);
  }

  public function laporan_kategori_pdf()
  {
    $this->load->library('dompdf_gen');
    $data['kategori'] = $this->ModelKategori->getKategori()->result_array();

    $this->load->view('admin/laporan/kategori/laporan_pdf_kategori', $data);

    $paper_size = 'A4';
    $orientation = 'landscape';
    $html = $this->output->get_output();

    $this->dompdf->set_paper($paper_size, $orientation);
    $this->dompdf->load_html($html);
   
    $this->dompdf->render();
    $this->dompdf->stream("laporan_data_kategori.pdf", array('Attachment' => 0));
  }

  public function export_excel_kategori()
  {
    $tgl = date('Ymd');
    $data['title'] = 'Laporan Kategori-'.$tgl;
    $data['kategori'] = $this->ModelKategori->getKategori()->result_array();

    $this->load->view('admin/laporan/kategori/export_excel_kategori', $data);
  }

  //Laporan Produk
  public function laporan_produk()
  {
    $data['judul'] = 'Daftar Produk';
    $data['produk'] = $this->ModelProduk->getProduk()->result_array();
    $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();
    

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('admin/laporan/produk/laporan_produk', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_laporan_produk()
  {
    $data['produk'] = $this->ModelProduk->getProduk()->result_array();
    $data['jumlah_produk'] = $this->ModelProduk->getProduk()->num_rows();
    $this->load->view('admin/laporan/produk/laporan_print_produk', $data);
  }

  public function laporan_produk_pdf()
  {
    $this->load->library('dompdf_gen');
    $data['produk'] = $this->ModelProduk->getProduk()->result_array();

    $this->load->view('admin/laporan/produk/laporan_pdf_produk', $data);

    $paper_size = 'A4';
    $orientation = 'landscape';
    $html = $this->output->get_output();

    $this->dompdf->set_paper($paper_size, $orientation);
    $this->dompdf->load_html($html);
   
    $this->dompdf->render();
    $this->dompdf->stream("laporan_data_produk.pdf", array('Attachment' => 0));
  }

  public function export_excel_produk()
  {
    $tgl = date('Ymd');
    $data['title'] = 'Laporan produk-'.$tgl;
    $data['produk'] = $this->ModelProduk->getProduk()->result_array();

    $this->load->view('admin/laporan/produk/export_excel_produk', $data);
  }

  public function laporan_pesanan()
  {
    //Untuk memberikan judul pada tab browser
    $data['judul'] = 'Daftar Pesanan';
    $submit = $this->input->post('submit', TRUE);
    //Untuk menampilkan data dari tabel pesanan
    // $data['pesanan'] = $this->ModelPesanan->getPesanan()->result_array();
    $tglMulai = $this->input->post('tglMulai', TRUE);
    $tglSelesai = $this->input->post('tglSelesai', TRUE);
    
    if($submit == "Reset" || $submit == NULL){
      //Jika tanggal mulai adalah kosong maka akan menampilkan pesanan hari ini
      $data['pesanan'] = $this->ModelPesanan->getTodayPesanan()->result_array();
      $data['tanggal'] = date('d M Y');
      $data['tgl_mulai'] = "";
    }else{
      //Jika tanggal mulai diisi maka akan menampilkan pesanan sesuai pencarian
      $data['pesanan'] = $this->ModelPesanan->getPesananBySearch($tglMulai, $tglSelesai)->result_array();
      $data['tanggal'] = date("d M Y", strtotime($tglMulai)) ." s.d ". date("d M Y", strtotime($tglSelesai));
      $data['tgl_mulai'] = $tglMulai;
      $data['tgl_selesai'] = $tglSelesai;
    }
    
    //Untuk menampilkan nama user pada topbar
    $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();

    //Data-data diatas dilempar ke dalam view
    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    //Data-data isi dari pesanan di tampilkan pada view admin/pesanan/daftarPesanan
    $this->load->view('admin/laporan/pesanan/laporan_pesanan', $data);
    $this->load->view('templates/footer');
  }

  public function cetak_laporan_pesanan()
  {
   

    $tglMulai = $this->uri->segment(3);
    $tglSelesai = $this->uri->segment(4);
    if($tglMulai == ""){
      //Jika tanggal mulai adalah kosong maka akan menampilkan pesanan hari ini
      $data['pesanan'] = $this->ModelPesanan->getTodayPesanan()->result_array();
      $data['tanggal'] = date('d M Y');
      $data['tgl_mulai'] = "";
      $data['jumlah_pesanan'] = $this->ModelPesanan->getTodayPesanan()->num_rows();
    }else{
       //Jika tanggal mulai diisi maka akan menampilkan pesanan sesuai pencarian
       $data['pesanan'] = $this->ModelPesanan->getPesananBySearch($tglMulai, $tglSelesai)->result_array();
       $data['tanggal'] = date("d M Y", strtotime($tglMulai)) ." s.d ". date("d M Y", strtotime($tglSelesai));
       $data['tgl_mulai'] = $tglMulai;
       $data['tgl_selesai'] = $tglSelesai;
       $data['jumlah_pesanan'] = $this->ModelPesanan->getPesananBySearch($tglMulai, $tglSelesai)->num_rows();
    }
    $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();
    $this->load->view('admin/laporan/pesanan/laporan_print_pesanan', $data);
  }
}