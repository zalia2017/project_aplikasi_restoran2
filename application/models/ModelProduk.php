<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelProduk extends CI_Model
{
    //manajemen Produk
    public function getProduk()
    {
        //Menampilkan semua kolom di tabel produk dan kolom nama kategori di tabel kategori
        $this->db->select('produk.*, kategori.nama_kategori');
        //Dari tabel produk
        $this->db->from('produk');
        //Join tabel kategori, dimana kolom id di tabel kategori = id_kategori di tabel produk
        $this->db->join('kategori', 'kategori.id=produk.id_kategori', 'left');
        //Return get
        return $this->db->get();
    }
    public function getProdukWhere($where)
    {
        $this->db->select('produk.*, kategori.nama_kategori');
        $this->db->from('produk');
        $this->db->join('kategori', 'kategori.id=produk.id_kategori', 'left');
        $this->db->where($where);
        return $this->db->get();
    }

    public function produkWhere($where)
    {
        return $this->db->get_where('produk', $where);
    }
//--
    public function simpanProduk($data = null)
    {
        $this->db->insert('produk',$data);
    }
//--
    public function updateProduk($data = null, $where = null)
    {
        $this->db->update('produk', $data, $where);
    }

    public function hapusProduk($where = null)
    {
        $this->db->delete('produk', $where);
    }

    // public function total($field, $where)
    // {
    //     $this->db->select_sum($field);
    //     if(!empty($where) && count($where) > 0){
    //         $this->db->where($where);
    //     }
    //     $this->db->from('buku');
    //     return $this->db->get()->row($field);
    // }

    // public function simpanKategori($data = null)
    // {
    //     $this->db->insert('kategori', $data);
    // }

 

    // public function updateKategori($where = null, $data = null)
    // {
    //     $this->db->update('kategori', $data, $where);
    // }

    // //join
    // public function joinKategoriBuku($where)
    // {
    //     $this->db->select('buku.*, buku.id_kategori,kategori.kategori');
    //     $this->db->from('buku');
    //     $this->db->join('kategori','kategori.id = buku.id_kategori');
    //     $this->db->where($where);
    //     return $this->db->get();
    // }

    // public function getLimitBuku()
    // {
    //     $this->db->limit(5);
    //     return $this->db->get('buku');
    // }
}