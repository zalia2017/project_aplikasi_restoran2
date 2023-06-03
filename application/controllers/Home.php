<?php 

class Home extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model(['ModelUser']);
  }

  public function index()
  {
    //Menyiapkan data
    $data = [
      'judul' => 'Halaman Pesanan', 
      'kategori' => $this->ModelKategori->getKategori()->result()
    ];
    $data['user'] = 'Pengunjung';
    //Jika sudah berhasil login, session email akan ada isinya
      $this->load->view('templates/templates-user/header', $data);
      $this->load->view('kategori/daftarKategori', $data);
      $this->load->view('templates/templates-user/modal', $data);
      $this->load->view('templates/templates-user/footer', $data);
  }

  public function detailProduk()
  {
    //segment 1 : Controller
    //segment 2 : method/function
    //segment 3 dan seterusnya : parameter
    $id = $this->uri->segment(3);
    $buku = $this->ModelProduk->joinKategoriProduk(['produk.id' => $id])->result();
    $data['user'] = "Pengunjung";
    $data['title'] = "Detail Buku";

    foreach ($buku as $fields) {
      $data['judul'] = $fields->judul_buku;
      $data['pengarang'] = $fields->pengarang;
      $data['penerbit'] = $fields->penerbit;
      $data['kategori'] = $fields->kategori;
      $data['tahun'] = $fields->tahun_terbit;
      $data['isbn'] = $fields->isbn;
      $data['gambar'] = $fields->image;
      $data['dipinjam'] = $fields->dipinjam;
      $data['stok'] = $fields->stok;
      $data['dibooking'] = $fields->dibooking;
      $data['id'] = $id;
    }

    $this->load->view('templates/templates-user/header',$data);
    $this->load->view('buku/detailbuku', $data);
    $this->load->view('templates/templates-user/modal');
    $this->load->view('templates/templates-user/footer');
  }
}
 ?>