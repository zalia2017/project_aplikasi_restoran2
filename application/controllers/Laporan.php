<?php
defined('BASEPATH') or exit('No Direct script access allowed');

class Laporan extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(['ModelUser', 'ModelBuku', 'ModelPinjam']);
  }

  public function laporan_buku()
  {
    //Untuk judul yang akan ditampilkan di header
    $data['judul'] = 'Laporan Data Buku';
    //Untuk nama di pojok kanan ditampilkan di topbar
    $data['user'] = $this->ModelUser->cekData(['email'=>$this->session->userdata('email')])->row_array();
    //Untuk mendapatkan data buku, semua data buku dari tabel buku, ditampilkan dalam bentuk array
    //result_array(), result(), row_array(), row()
    //result_array(), seluruh baris/record disajikan dalam bentuk array. $user['nama']
    //result, seuluruh baris/record disajikan dalam bentuk objek, $user->nama
    //row_array(), hanya menampilkan 1 baris/record teratas dari pencarian dalam bentuk array
    //row(), hanya menampilkan 1 baris/record teratas dari pencarian dalam bentuk objek
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    //untuk mendapatkan data kategori
    // $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('buku/laporan_buku', $data);
    $this->load->view('templates/footer');
  }

  public function laporan_anggota()
  {
    //Menyimpan judul kedalam $data['judul']
    $data['judul'] = 'Laporan Data Anggota';
    //Menyimpan nama user ke dalam $data['user] 
    $data['user'] = $this->ModelUser->cekData(['email'=>$this->session->userdata('email')])->row_array();
    //Menyimpan data anggota ke dalam $data['anggota']
    // $data['anggota'] = $this->ModelUser->getUser()->result_array();
    $data['anggota'] = $this->ModelUser->getMember()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('member/laporan_anggota', $data);
    $this->load->view('templates/footer');
  }

  public function laporan_pinjam()
  {
    //Menyiapkan judul pada tab browser
    $data['judul'] = 'Laporan Data Peminjaman';
    //Menyiapkan nama user pada header
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    //Menyiapkan data pinjam dari tabel pinjam dan detail
    // $data['laporan'] = $this->db->query("SELECT*FROM pinjam p, detail_pinjam d, buku b, user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();
    $data['laporan'] = $this->db->query("SELECT*FROM pinjam p, detail_pinjam d, buku b, user u, kategori k where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam and k.id=b.id_kategori")->result_array();

    // var_dump($data['laporan']);

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('pinjam/laporan-pinjam', $data);
    $this->load->view('templates/footer');
  }

  public function laporan_pinjam_pdf()
  {
    //Load library dompdf_gen
    $this->load->library('dompdf_gen');
    //Menyiapkan data laporan pinjam dan disimpan ke dalam $data['laporan']
    $data['laporan'] = $this->db->query("SELECT*FROM pinjam p, detail_pinjam d, buku b, user u, kategori k WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam AND k.id=b.id_kategori")->result_array();

    // $sroot = $_SERVER['DOCUMENT_ROOT'];
    // include $sroot . "/pustaka-booking/application/third_party/dompdf/autoload.inc.php";
    // $dompdf = new Dompdf\Dompdf();
    $this->load->view('pinjam/laporan_pdf_pinjam', $data);
    $paper_size = 'A4';
    $orientation = 'landscape';
    $html = $this->output->get_output();

    $this->dompdf->set_paper($paper_size, $orientation);

    $this->dompdf->load_html($html);
    $this->dompdf->render();
    $this->dompdf->stream("laporan data peminjaman.pdf", array('Attachment' => 0));

    // $this->load->library('dompdf_gen');
    // $data['buku'] = $this->ModelBuku->getBuku()->result_array();

    // $this->load->view('buku/laporan_pdf_buku', $data);

    // $paper_size = 'A4';
    // $orientation = 'landscape';
    // $html = $this->output->get_output();

    // $this->dompdf->set_paper($paper_size, $orientation);
    // $this->dompdf->load_html($html);
   
    // $this->dompdf->render();
    // $this->dompdf->stream("laporan_data_buku.pdf", array('Attachment' => 0));
  }

  public function cetak_laporan_buku()
  {
    //Mengirimkan data dari getBuku dalam bentuk result_array();

    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    // $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->load->view('buku/laporan_print_buku', $data);
  }
  public function cetak_laporan_anggota()
  {
    //Mengambil data dari user dimana role_id = 2 (pengunjung biasa)
    //Lalu dimasukkan ke dalam $data['anggota']
    $data['anggota'] = $this->ModelUser->getMember()->result_array();
    //Menload view member/laporan_print_anggota, dan menyertakan nilai dari $data['anggota']
    $this->load->view('member/laporan_print_anggota', $data);
  }
  public function cetak_laporan_pinjam()
  {
    //Data laporan pinjam disimpan ke array $data['laporan']
    $data['laporan'] = $this->db->query("SELECT*FROM pinjam p, detail_pinjam d, buku b, user u, kategori k WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam AND k.id = b.id_kategori")->result_array();
    $this->load->view('pinjam/laporan-print-pinjam', $data);
  }

  public function laporan_buku_pdf()
  {
    //Menload library dompdf_gen
    $this->load->library('dompdf_gen');
    //Mengambil data dari tabelBuku lalu disimpan dalam variabel $data['buku]
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();

    //Menload view buku/laporan_pdf_buku dengan membawa data
    $this->load->view('buku/laporan_pdf_buku', $data);

    //konfigurasi ukuran kertas ke dalam $paper_size
    $paper_size = 'A4';
    //konfigurasi orientasi kertas ke dalam $orientation
    $orientation = 'landscape';
    //Menyimpan output ke dalam variabel $html
    $html = $this->output->get_output();

    //konfigurasi dompdf dan membuat file pdf dari konfigurasi sebelumnya
    $this->dompdf->set_paper($paper_size, $orientation);
    $this->dompdf->load_html($html);
   
    $this->dompdf->render();
    //menyimpan file pdf dengan nama laporan_data_buku.pdf
    $this->dompdf->stream("laporan_data_buku.pdf", array('Attachment' => 0));
  }
  public function laporan_anggota_pdf()
  {
    //Menload library dompdf_gen
    $this->load->library('dompdf_gen');

    $data['anggota'] = $this->ModelUser->getUser()->result_array();
    $this->load->view('member/laporan_pdf_anggota', $data);

    $paper_size = 'A4';
    $orientation = 'landscape';

    $html = $this->output->get_output();

    $this->dompdf->set_paper($paper_size, $orientation);
    $this->dompdf->load_html($html);
   
    $this->dompdf->render();
    $this->dompdf->stream("laporan_data_anggota.pdf", array('Attachment' => 0));
  }

  public function export_excel()
  {
    //Menyimpan data
    // $data = array('title' => 'Laporan Buku', 'buku' => $this->ModelBuku->getBuku()->result_array());
    $tgl = date('Ymd');
    $data['title'] = 'Laporan Buku-'.$tgl;
    //Mendapatkan data getBuku lalu disimpan dalam $data['buku']
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    //Data dari buku dikirim ke view (buku/export_excel_buku)
    $this->load->view('buku/export_excel_buku', $data);
  }

  public function export_excel_anggota()
  {
    //Menyimpan data
    $tgl = date('Ymd');
    $data['title'] = 'Laporan Anggota-'.$tgl;
    //Mendapatkan data getMember lalu disimpan dalam $data['anggota']
    $data['anggota'] = $this->ModelUser->getMember()->result_array();
    //Data dari buku dikirim ke view (buku/export_excel_buku)
    $this->load->view('member/export_excel_anggota', $data);
  }

  public function export_excel_pinjam()
 {
  $data['title'] = 'Laporan Data Peminjaman Buku';
  $data['laporan'] = $this->db->query("SELECT * FROM pinjam p,detail_pinjam d, buku b,user u, kategori k WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam AND k.id=b.id_kategori")->result_array();
  $this->load->view('pinjam/export-excel-pinjam', $data);
 }
}
?>