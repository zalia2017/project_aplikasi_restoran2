<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        // cek_user();
        $this->load->model('ModelKategori');
    }

    /**
     * 4 Method pengelolaan produk
     * 1. Menampilkan data produk
     * 2. Menambahkan data produk
     * 3. Mengedit data produk
     * 4. Menghapus data produk
     */
    public function index()
    {
        $data['judul'] = 'Daftar Produk';
        $data['produk'] = $this->ModelProduk->getProduk()->result_array();
        $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
        $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/produk/daftarProduk', $data);
        $this->load->view('templates/footer');
    }

    public function tambahProduk()
    {
        $this->form_validation->set_rules('produk', 'Nama Produk', 'required|min_length[3]', [
            'required' => 'Nama Produk harus diisi',
            'min_length' => 'Nama Produk terlalu pendek'
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan Produk', 'required|min_length[2]', [
            'required' => 'Nama Satuan harus diisi',
            'min_length' => 'Nama Satuan terlalu pendek'
        ]);
        $this->form_validation->set_rules('harga', 'Harga Produk', 'required', [
            'required' => 'Harga Produk harus diisi',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Produk', 'required|min_length[3]', [
            'required' => 'Deskripsi Produk harus diisi',
            'min_length' => 'Deskripsi Produk terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal Menyimpan, ada data yang kurang lengkap </div>');
                    redirect('produk');
        } else {
            // jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '3000';
                $config['max_width'] = '10000';
                $config['max_height'] = '10000';
                $config['file_name'] = 'img' . time();

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')) {
                    $data = [
                           'nama_produk' => $this->input->post('produk', TRUE),
                           'satuan_produk' => $this->input->post('satuan', TRUE),
                           'harga_produk' => $this->input->post('harga', TRUE),
                           'desk_produk' => $this->input->post('deskripsi', TRUE),
                           'id_kategori' => $this->input->post('kategori', TRUE),
                           'image_produk' => $this->upload->data('file_name')
                    ];
                    $this->ModelProduk->simpanProduk($data);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Produk berhasil ditambahkan</div>');
                    redirect('produk');
                }else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal Menyimpan </div>');
                    redirect('produk');
                 }
            }
        }
    }

    public function ubahProduk()
    {
        $idProduk = $this->uri->segment(3);
        $data['judul'] = 'Ubah Produk';
        $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
        $data['produk'] = $this->ModelProduk->getProdukWhere(['produk.id'=>$idProduk])->row_array();
        $this->form_validation->set_rules('produk', 'Nama Produk', 'required|min_length[3]', [
            'required' => 'Nama Produk harus diisi',
            'min_length' => 'Nama Produk terlalu pendek'
        ]);
        $this->form_validation->set_rules('satuan', 'Satuan Produk', 'required|min_length[2]', [
            'required' => 'Nama Satuan harus diisi',
            'min_length' => 'Nama Satuan terlalu pendek'
        ]);
        $this->form_validation->set_rules('harga', 'Harga Produk', 'required', [
            'required' => 'Harga Produk harus diisi',
        ]);
        $this->form_validation->set_rules('deskripsi', 'Deskripsi Produk', 'required|min_length[3]', [
            'required' => 'Deskripsi Produk harus diisi',
            'min_length' => 'Deskripsi Produk terlalu pendek'
        ]);
        $gambarBaru = "";

        if ($this->form_validation->run() === false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/produk/ubah_produk', $data);
            $this->load->view('templates/footer');
        } else {;
            // jika ada gambar yang akan diupload
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['upload_path'] = './assets/img/upload/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '3000';
                $config['max_width'] = '10000';
                $config['max_height'] = '10000';
                $config['file_name'] = 'img' . time();

                $this->load->library('upload', $config);

                if($this->upload->do_upload('image')) {
                    $gambar_lama = $data['produk']['image_produk'];
                    $gambarBaru = $this->upload->data('file_name');
                    if ($gambar_lama != 'default.jpg' || $gambar_lama != $gambarBaru) {
                        unlink(FCPATH . 'assets/img/upload/' . $gambar_lama);
                    }
                    
                    
                }else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal </div>');
                    redirect('produk');
                 }
            }

            $myData = [
                'nama_produk' => $this->input->post('produk', TRUE),
                'satuan_produk' => $this->input->post('satuan', TRUE),
                'harga_produk' => $this->input->post('harga', TRUE),
                'desk_produk' => $this->input->post('deskripsi', TRUE),
                'id_kategori' => $this->input->post('kategori', TRUE),
            ];
            if($gambarBaru != ""){
                $myData['image_produk'] = $gambarBaru;
            }
            $this->ModelProduk->updateProduk($myData, ['id' => $idProduk]);
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Produk berhasil diubah</div>');
            redirect('produk');
        }
    }
  
    public function hapusProduk()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelProduk->hapusProduk($where);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Produk berhasil dihapus</div>');
        redirect('produk');
    }
}