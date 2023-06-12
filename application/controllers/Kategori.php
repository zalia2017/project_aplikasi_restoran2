<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        // cek_user();
    }
    /**
     * 4 Method
     * 1. Menampilkan
     * 2. Menambahkan
     * 3. Mengedit
     * 4. Menghapus
     */
    //Untuk memunculkan data kategori
    public function index()
    {
        $data['judul'] = 'Daftar Kategori';
        $data['kategori'] = $this->ModelKategori->getKategori()->result_array();
        $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/kategori/daftarKategori', $data);
        $this->load->view('templates/footer');
    }

    public function tambahKategori()
    {

        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
            'required' => 'Nama Kategori harus diisi',
            'min_length' => 'Nama Kategori terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal Menyimpan, ada data yang kurang lengkap </div>');
                    redirect('kategori');
        } else {
            $nama = $this->input->post('nama', true);

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
                           'nama_kategori' => $this->input->post('kategori', TRUE),
                           'image_kategori' => $this->upload->data('file_name')
                    ];
                    $this->ModelKategori->simpanKategori($data);
                    $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Kategori berhasil ditambahkan</div>');
                    redirect('kategori');
                }else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal Menyimpan </div>');
                    redirect('kategori');
                 }
            }
        }
    }

    public function ubahKategori()
    {
        $idKategori = $this->uri->segment(3);
        $data['judul'] = 'Data Kategori';
        $data['user'] = $this->ModelUser->cekData(['email_user' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelKategori->getKategoriWhere(['id'=>$idKategori])->row_array();
        // var_dump($data['kategori']);
        $this->form_validation->set_rules('nama', 'Nama Kategori', 'required|min_length[3]', [
            'required' => 'Nama Kategori harus diisi',
            'min_length' => 'Nama Kategori terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/kategori/ubah_kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $nama = $this->input->post('nama', true);

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
                    var_dump($this->upload->do_upload('image'));
                    $gambar_lama = $data['kategori']['image_kategori'];
                    if ($gambar_lama != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/upload/' . $gambar_lama);
                    }
                    $gambarBaru = $this->upload->data('file_name');
                    $this->db->set('image_kategori', $gambarBaru);
                }else {
                    $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-message" role="alert">Gagal </div>');
                    redirect('kategori');
                 }
            }

            $this->db->set('nama_kategori', $nama);
            $this->db->where('id', $idKategori);
            $this->db->update('kategori');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-message" role="alert">Kategori berhasil diubah</div>');
            redirect('kategori');
        }
    }

   

    // public function ubahKategori2()
    // {
    //     $data['judul'] = 'Ubah Data Kategori';
    //     $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
    //     $data['kategori'] = $this->ModelBuku->kategoriWhere(['id' => $this->uri->segment(3)])->result_array();


    //     $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|min_length[3]', [
    //         'required' => 'Nama Kategori harus diisi',
    //         'min_length' => 'Nama Kategori terlalu pendek'
    //     ]);

    //     if ($this->form_validation->run() == false) {
    //         $this->load->view('templates/header', $data);
    //         $this->load->view('templates/sidebar', $data);
    //         $this->load->view('templates/topbar', $data);
    //         $this->load->view('buku/ubah_kategori', $data);
    //         $this->load->view('templates/footer');
    //     } else {

    //         $data = [
    //             'kategori' => $this->input->post('kategori', true)
    //         ];

    //         $this->ModelBuku->updateKategori(['id' => $this->input->post('id')], $data);
    //         redirect('buku/kategori');
    //     }
    // }

    public function hapusKategori()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelKategori->hapusKategori($where);
        redirect('kategori');
    }
}