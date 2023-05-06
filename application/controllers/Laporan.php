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
    //Untuk judul
    $data['judul'] = 'Laporan Data Buku';
    //Untuk nama di pojok kanan
    $data['user'] = $this->ModelUser->cekData(['email'=>$this->session->userdata('email')])->row_array();
    //Untuk mendapatkan data buku
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    //untuk mendapatkan data kategori
    // $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar', $data);
    $this->load->view('templates/topbar', $data);
    $this->load->view('buku/laporan_buku', $data);
    $this->load->view('templates/footer');
  }

  public function laporan_pinjam()
  {
    $data['judul'] = 'Laporan Data Peminjaman';
    $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    $data['laporan'] = $this->db->query("SELECT*FROM pinjam p, detail_pinjam d, buku b, user u where d.id_buku=b.id and p.id_user=u.id and p.no_pinjam=d.no_pinjam")->result_array();

    $this->load->view('templates/header', $data);
    $this->load->view('templates/sidebar');
    $this->load->view('templates/topbar', $data);
    $this->load->view('pinjam/laporan-pinjam', $data);
    $this->load->view('templates/footer');
  }

  public function laporan_pinjam_pdf()
  {
    $this->load->library('dompdf_gen');
    $data['laporan'] = $this->db->query("SELECT*FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array();

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
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();
    $data['kategori'] = $this->ModelBuku->getKategori()->result_array();

    $this->load->view('buku/laporan_print_buku', $data);
  }

  public function cetak_laporan_pinjam()
  {
    $data['laporan'] = $this->db->query("SELECT*FROM pinjam p, detail_pinjam d, buku b, user u WHERE d.id_buku=b.id AND p.id_user=u.id AND p.no_pinjam=d.no_pinjam")->result_array();
    $this->load->view('pinjam/laporan-print-pinjam', $data);
  }

  public function laporan_buku_pdf()
  {
    $this->load->library('dompdf_gen');
    $data['buku'] = $this->ModelBuku->getBuku()->result_array();

    $this->load->view('buku/laporan_pdf_buku', $data);

    $paper_size = 'A4';
    $orientation = 'landscape';
    $html = $this->output->get_output();

    $this->dompdf->set_paper($paper_size, $orientation);
    $this->dompdf->load_html($html);
   
    $this->dompdf->render();
    $this->dompdf->stream("laporan_data_buku.pdf", array('Attachment' => 0));
  }

  public function export_excel()
  {
    $data = array('title' => 'Laporan Buku', 
    'buku' => $this->ModelBuku->getBuku()->result_array());
    $this->load->view('buku/export_excel_buku', $data);
  }
}
?>