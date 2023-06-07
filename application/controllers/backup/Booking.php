<?php 
defined('BASEPATH') or exit('No Direct Script Access Allowed');
date_default_timezone_set('Asia/Jakarta');

class Booking extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    cek_login();
    $this->load->model(['ModelBooking', 'ModelUser']);
    
  }
    public function index()
    {
      // $id = ['bo.id_user' => $this->uri->segment(3)];
      // var_dump($id);
      $id_user = $this->session->userdata('id_user');
      // $data['booking'] = $this->ModelBooking->joinOrder($id)->result();

      $user = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();

      foreach($user as $a){
        $data = [
          'image' => $user['image'],
          'user' => $user['nama'],
          'email' => $user['email'],
          'tanggal_input' => $user['tanggal_input']
        ];
      }
      $dtb = $this->ModelBooking->showtemp(['id_user' => $id_user])->num_rows();

      if($dtb < 1){
        $this->session->set_flashdata('pesan', '<div class="alert alert-massage alert-danger" role="alert">Tidak ada buku dikeranjang</div>');
        redirect(base_url());
      }else{
        $data['temp'] = $this->db->query("select image, judul_buku, penulis, penerbit, tahun_terbit, id_buku from temp where id_user='$id_user'")->result_array();
      }
      $data['judul'] = "Data Booking";

      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('booking/data-booking', $data);
      $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/templates-user/footer');
    }

    public function tambahBooking()
    {
      $id_buku = $this->uri->segment(3);

      //Mengambil semua kolom dari tabel buku dimana idBuku = 15 hanya
      //untuk 1 record
      $d = $this->db->query("SELECT * FROM buku where id='$id_buku'")->row();

      var_dump($this->session->userdata('id_user'));
      //Menyimpan data dari $d kedalam $isi
      $isi = [
        'id_buku' => $id_buku, 
        'judul_buku' => $d->judul_buku, 
        'id_user' => $this->session->userdata('id_user'),
        'email_user' => $this->session->userdata('email'),
        'tgl_booking' => date('Y-m-d H:i:s'),
        'image' => $d->image,
        'penulis' => $d->pengarang,
        'penerbit' => $d->penerbit, 
        'tahun_terbit' => $d->tahun_terbit
      ];

      //mendapatkan jumlah record didalam tabel temp apakah sudah ada buku yang dimaksud
      $temp = $this->ModelBooking->getDataWhere('temp', ['id_buku' => $id_buku])->num_rows();

      //Menyimpan id_user kedalam $userId
      $userid = $this->session->userdata('id_user');

      //mendapatkan jumlah record di dalam tabel temp dimana id_user adalah $user_id
      $tempuser = $this->db->query("SELECT*FROM temp WHERE id_user='$userid'")->num_rows();
      //Mendapatkan jumlah record di dalam tabel booking dimana id_user adalah $user_id
      $databooking = $this->db->query("SELECT*FROM booking where id_user='$userid'")->num_rows();

      //Jika jumlah databooking lebih dari 0 atau ada
      if($databooking > 0){
        //maka error, muncul pesan ada booking yg belum diambil.
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Masih ada booking buku sebelumnya yang belum diambil.<br> Ambil buku yang dibooking atau tunggu 1x24 jam untuk bisa booking kembali </div>');
        //Halaman diarahkan ke base_url()
        redirect(base_url());
      }
      //Jika ada id buku yang sama di tabel temp
      if($temp > 0){
        //Maka akan muncul pesan error, buku ini sudah ada yang booking
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert"> Buku ini sudah dibooking </div>');
        //Halaman diarahkan ke base_url()/home
        redirect(base_url(). 'home');
      }
      //Jika pada tabel temp(keranjang), ada 1 user yang telah berisi
      //maka akan muncul pesan error, keranjang tidak boleh berisi lebih dari 3
      if ($tempuser == 3) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Booking Buku tidak boleh lebih dari 3</div>');
        
        redirect(base_url(). 'home');
      }
      //Akan membuat record ke tabel temp
      $this->ModelBooking->createTemp();
      $this->ModelBooking->insertData('temp', $isi);

      $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Buku berhasil ditambahkan ke keranjang </div>');
      redirect(base_url(). 'home');
    }

    public function hapusbooking()
    {
      $id_buku = $this->uri->segment(3);
      $id_user = $this->session->userdata('id_user');

      $this->ModelBooking->deleteData(['id_buku' => $id_buku], 'temp');
      $kosong = $this->db->query("SELECT*FROM temp WHERE id_user='$id_user'")->num_rows();

      if($kosong < 1) {
        $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Tidak ada buku dikeranjang</div>');
        redirect(base_url());
      }else{
        redirect(base_url(). 'booking');
      }
    }

    public function bookingSelesai($where)
    {
      $this->db->query("UPDATE buku, temp SET buku.dibooking= buku.dibooking+1, buku.stok = buku.stok-1 WHERE buku.id = temp.id_buku");

      $tglsekarang = date('Y-m-d');
      $isibooking = [
        'id_booking' => $this->ModelBooking->kodeOtomatis('booking', 'id_booking'),
        'tgl_booking' => date('Y-m-d H:m:s'),
        'batas_ambil' => date('Y-m-d', strtotime('+2 days', strtotime($tglsekarang))),
        'id_user' => $where
      ];

      $this->ModelBooking->insertData('booking', $isibooking);
      $this->ModelBooking->simpanDetail($where);
      $this->ModelBooking->kosongkanData('temp');

      redirect(base_url() . 'booking/info');
    }

    public function info()
    {
      $where = $this->session->userdata('id_user');
      $data['user'] = $this->session->userdata('nama');
      $data['judul'] = 'Selesai Booking';
      $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();

      $data['items']= $this->db->query("SELECT*FROM booking bo, booking_detail d, buku bu where d.id_booking=bo.id_booking and d.id_buku=bu.id and bo.id_user='$where'")->result_array();

      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('booking/info-booking', $data);
      $this->load->view('templates/templates-user/modal');
      $this->load->view('templates/templates-user/footer');
    }

    public function exportToPdf()
    {
      $id_user = $this->session->userdata('id_user');
      $data['user'] = $this->session->userdata('nama');
      $data['judul'] = "Cetak Bukti Booking";
      $data['useraktif'] = $this->ModelUser->cekData(['id' => $this->session->userdata('id_user')])->result();

      $data['items'] = $this->db->query("SELECT*FROM booking bo, booking_detail d, buku bu WHERE d.id_booking = bo.id_booking AND d.id_buku=bu.id and bo.id_user='$id_user'")->result_array();

      $this->load->library('dompdf_gen');
      $this->load->view('booking/bukti-pdf', $data);

      $paper_size = 'A4';
      $orientation = 'landscape';
      $html = $this->output->get_output();

      $this->dompdf->set_paper($paper_size, $orientation);
      $this->dompdf->load_html($html);
      $this->dompdf->render();
      $this->dompdf->stream("bukti-booking-$id_user.pdf", array('Attachment' => 0));
    }

}
?>