<?php 

class Home extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(['ModelUser']);
  }
  /**
   * 1. Menampilkan halaman kategori (awal halaman)
   * 2. Memunculkan halaman produk dari kategori yang dipilih
   * 3. Memunculkan halaman detail produk
   * 4. Memproses penambahan pemesanan. Menyimpan data ke tabel temp (keranjang)
   * 5. Memunculkan halaman keranjang (pesanan sementara)
   * 6. Untuk melakukan proses pemesanan ketika keranjang siap dibayar
   * 7. Untuk memunculkan data pesanan yang sudah dibuat dan siap dicetak
   * 8. Untuk melakukan proses penghapusan pada tabel temp (keranjang) satu persatu
   * 9. Untuk melakukan proses export ke pdf
   */

  public function index()
  {
    $data = [
      'judul' => 'Halaman Pesanan', 
      'kategori' => $this->ModelKategori->getKategori()->result()
    ];
    $data['user'] = 'Pengunjung';
      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('kategori/daftarKategori', $data);
      $this->load->view('templates/templates-user/modal', $data);
      $this->load->view('templates/templates-user/footer', $data);
  }

  //Memunculkan produk dari kategori yang dipilih
  public function kategori()
    {
      //Untuk mendapatkan parameter id dari kategori
        $idKategori = $this->uri->segment(3);
        $namaKategori = $this->ModelKategori->getKategoriWhere(['id'=>$idKategori])->row()->nama_kategori;
        $data['judul'] = $namaKategori;
        //Memunculkan semua kategori
        $data['kategori'] = $this->ModelKategori->getKategori()->result();
        //Memunculkan produk dengan kategori yang dipilih
        $data['produk'] = $this->ModelProduk->getProdukWhere(['id_kategori'=>$idKategori])->result_array();

        $this->load->view('templates/templates-user/header',$data);
        $this->load->view('produk/daftarProduk', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    }
    
    //Memunculkan detail produk
    public function produk()
    {
      //Untuk mendapatkan id produk
        $idProduk = $this->uri->segment(3);
        //Untuk mendapatkan nama produk
        $namaProduk = $this->ModelProduk->getProdukWhere(['produk.id'=>$idProduk])->row()->nama_produk;
        //Nama Produk akan diletakkan dijudul
        $data['judul'] = $namaProduk;
        // Untuk memunculkan semua kategori pada menu di header
        $data['kategori'] = $this->ModelKategori->getKategori()->result();
        //Memunculkan data produk berdasarkan id dari produk tersebut
        $data['produk'] = $this->ModelProduk->getProdukWhere(['produk.id'=>$idProduk])->row_array();

        $this->load->view('templates/templates-user/header',$data);
        $this->load->view('produk/detailProduk', $data);
        $this->load->view('templates/templates-user/modal');
        $this->load->view('templates/templates-user/footer');
    }
    //Memproses penambahan pemesanan. Menyimpan data ke dalam tabel temp (keranjang)
    public function tambahPesanan()
    {
      //Menambahkan id pada session
      $idSession = $this->session->userdata('my_session_id');
      //Jika idSession kosong
      if(!isset($idSession)){
        //akan membuat satu nomor unique baru
        $uniqueId = uniqid(rand(), TRUE);
        //Disimpan kedalam session my_session_id
        $this->session->set_userdata("my_session_id", md5($uniqueId));
        $idSession = $uniqueId;
      }
      $idProduk = $this->input->post('id', TRUE);
      $jumlahBeli = $this->input->post('jumlah', TRUE);
      $myData = $this->ModelPesanan->getTempWhere( ['id_session' => $idSession, 'id_produk' => $idProduk])->num_rows();
      $data = [
        'id_session' => $idSession,
        'id_produk' => $idProduk,
      ];
      //Jika ada produk yang sama pada keranjang yang sama.
      if($myData>0){
        //jumlah beli yang ada di tabel temp
        $jmlBeli = $this->ModelPesanan->getTempWhere(['id_session' => $idSession, 'id_produk' => $idProduk])->row()->jumlah_beli;
        $data['jumlah_beli'] = $jmlBeli + $jumlahBeli;
        //Mengupdate data yang sudah ada
        $this->ModelPesanan->updateData('temp', $data, ['id_session' => $idSession, 'id_produk' => $idProduk]);
      }else{
        //Menambahkan item baru ke dalam tabel temp
        $data['jumlah_beli'] = $jumlahBeli;
        $this->ModelPesanan->simpanData('temp', $data);
      }
      
    //Jika berhasil maka akan muncul pesan berhasil
    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Produk berhasil ditambahkan ke keranjang</div>');
    redirect('home/produk/'.$idProduk);
    }
  //Untuk memunculkan halaman keranjang(pesanan)
  public function pesanan()
  {
    $idSession = $this->session->userdata('my_session_id');
    $data['judul'] = 'Data Pesanan';
    //Untuk header
    $data['kategori'] = $this->ModelKategori->getKategori()->result();
    //Untuk memunculkan data dari tabel temp, berdasarkan id_session manual
    $data['keranjang'] = $this->ModelPesanan->getTempWhere(['id_session'=>$idSession])->result_array();
    $this->load->view('templates/templates-user/header',$data);
    $this->load->view('pesanan/daftarPesanan', $data);
    $this->load->view('templates/templates-user/modal');
    $this->load->view('templates/templates-user/footer');
  }

  //Untuk melakukan proses pemesanan ketika keranjang siap dibayar
  //Proses memindahkan data dari tabel temp (keranjang) ke tabel pesanan dan detail_pesanan
  public function pesananSelesai()
  {
    //Untuk mendapatkan session my_session_id dari komputer tersebut
    $idSession = $this->session->userdata('my_session_id');
    $tglsekarang = date('Y-m-d');
    //Untuk mendapatkan data kategori
    $data['kategori'] = $this->ModelKategori->getKategori()->result();

    //Untuk mendapatkan detail pesanan pada tabel temp(keranjang)
    $detailPesanan = $this->ModelPesanan->getTempWhere(['id_session' => $idSession])->result_array();
    //Untuk mendapatkan kode otomatis untuk no_pesanan
    $kodeOtomatis = $this->ModelPesanan->kodeOtomatis('pesanan', 'no_pesanan');
    //Untuk mendapatkan nama pemesan dari form
    $namaPemesan = $this->input->post('namaPemesan');
    //Untuk mendapatkan nomor meja dari form
    $noMeja = $this->input->post('noMeja');
    //Untuk mendapatkan total harga
    $totalHarga = $this->input->post('totalHarga');
    //Isi pesanan didapatkan dari data-data diatas
    $isiPesanan = [
      'no_pesanan' => $kodeOtomatis,
      'tgl_pesanan' => date('Y-m-d H:m:s'),
      'total_harga' => $totalHarga,
      'waktu_pesanan' => date('H:m:s'),
      'nama_pemesan' => $namaPemesan,
      'no_meja' => $noMeja
    ];
    //Memasukkan data kedalam tabel pesanan dari data diatas
    $this->ModelPesanan->insertData('pesanan', $isiPesanan);

    //Dari tabel temp akan dimasukkan ke dalam tabel detail_pesanan
    //Dengan looping atau perulangan, maka data dari temporary berdasarkan session my_session_id
    //Akan disimpan ke dalam tabel detail_pesanan
    foreach($detailPesanan as $detail){
      $isiDetail = [
        'no_pesanan' => $kodeOtomatis,
        'id_produk' => $detail['produk_id'],
        'jumlah_beli' => $detail['jumlah_beli'],
        'harga_produk' => $detail['harga_produk'],
        'total_harga' => $detail['jumlah_beli'] * $detail['harga_produk'],
      ];
      //Akan disimpan ke dalam tabel detail_pesanan
      $this->ModelPesanan->insertData('detail_pesanan', $isiDetail);
    }
    //Menghapus data dari tabel temp, sesuai idSessionnya
    $this->ModelPesanan->deleteData('temp', ['id_session' => $idSession]);

    redirect('home/info/'.$kodeOtomatis);
    
  }
  //Untuk menampilkan data pesanan yang sudah dibuat
  public function info()
  {
    $data['kategori'] = $this->ModelKategori->getKategori()->result();
    $noPesanan = $this->uri->segment(3);
    $data['judul'] = 'Data Detail Pesanan';
    $data['pesanan'] = $this->ModelPesanan->getDetailPesananWhere(['detail_pesanan.no_pesanan' => $noPesanan])->result_array();
    $headerPesanan = $this->ModelPesanan->getPesananWhere(['no_pesanan' => $noPesanan])->row();
    //Menampilkan data2 yang akan dimunculkan di info pemesanan
    $data['no_meja'] = $headerPesanan->no_meja;
    $data['nama_pemesan'] = $headerPesanan->nama_pemesan;
    $data['no_pesanan'] = $noPesanan;
    $this->load->view('templates/templates-user/header',$data);
    $this->load->view('pesanan/infoPesanan', $data);
    $this->load->view('templates/templates-user/modal');
    $this->load->view('templates/templates-user/footer');
  }

  //Melakukan penghapusan pesanan dari tabel temp (keranjang)
  public function hapusPesanan()
  {
    $idTemp = $this->uri->segment(3);
    $idSession = $this->session->userdata('my_session_id');
    $this->ModelPesanan->deleteData('temp', ['id' => $idTemp]);
    $kosong = $this->ModelPesanan->getTempWhere(['id_session'=>$idSession])->num_rows();

    if($kosong < 1) {
      $this->session->set_flashdata('pesan', '<div class="alert alert-message alert-danger" role="alert">Tidak ada pesanan dikeranjang</div>');
      redirect('home');
    }else{
      redirect('home/pesanan');
    }
  }

  public function cetakPesanan(){
      $noPesanan = $this->uri->segment(3);
      //Menampilkan data dari tabel detail_pesanan sesuai nomer pesanan
      //Dalam bentuk result_array()
      //Ditampilkan banyak data(record) dalam bentuk array, ditampilkan menggunakan looping (foreach)
      //Menampilkannya sebagai contoh $pesanan['no_pesanan']
      $data['pesanan'] = $this->ModelPesanan->getDetailPesananWhere(['detail_pesanan.no_pesanan' => $noPesanan])->result_array();
      //Untuk menampilkan data dari tabel pesanan dalam bentuk row
      //Menampilkan satu data(record) teratas dari query dalam bentuk object
      //Menampilkannya sebagai contoh: $headerPesanan->nama_pemesan 
      $headerPesanan = $this->ModelPesanan->getPesananWhere(['no_pesanan' => $noPesanan])->row();
      //data headerPesanan dipecah kedalam masing-masing kolom dan disimpan dalam $data
      $data['no_meja'] = $headerPesanan->no_meja;
      $data['nama_pemesan'] = $headerPesanan->nama_pemesan;
      $data['no_pesanan'] = $noPesanan;

      $this->load->view('pesanan/bukti-cetak', $data);

  }
  //Untuk mengeksport data pesanan ke dalam pdf
  public function exportPesananToPdf()
    {
      $noPesanan = $this->uri->segment(3);
      //Menampilkan data dari tabel detail_pesanan sesuai nomer pesanan
      //Dalam bentuk result_array()
      //Ditampilkan banyak data(record) dalam bentuk array, ditampilkan menggunakan looping (foreach)
      //Menampilkannya sebagai contoh $pesanan['no_pesanan']
      $data['pesanan'] = $this->ModelPesanan->getDetailPesananWhere(['detail_pesanan.no_pesanan' => $noPesanan])->result_array();
      //Untuk menampilkan data dari tabel pesanan dalam bentuk row
      //Menampilkan satu data(record) teratas dari query dalam bentuk object
      //Menampilkannya sebagai contoh: $headerPesanan->nama_pemesan 
      $headerPesanan = $this->ModelPesanan->getPesananWhere(['no_pesanan' => $noPesanan])->row();
      //data headerPesanan dipecah kedalam masing-masing kolom dan disimpan dalam $data
      $data['no_meja'] = $headerPesanan->no_meja;
      $data['nama_pemesan'] = $headerPesanan->nama_pemesan;
      $data['no_pesanan'] = $noPesanan;

      //Diproses converting ke dalam bentuk pdf
      $this->load->library('dompdf_gen');
      $this->load->view('pesanan/bukti-pdf', $data);

      $paper_size = 'A5';
      $orientation = 'portrait';
      $html = $this->output->get_output();

      $this->dompdf->set_paper($paper_size, $orientation);
      $this->dompdf->load_html($html);
      $this->dompdf->render();
      $this->dompdf->stream("bukti-pesanan-$id_user.pdf", array('Attachment' => 0));
    }
}
 ?>