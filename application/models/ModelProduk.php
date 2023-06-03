<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelProduk extends CI_Model
{
    //manajemen kategori
    public function getProduk()
    {
        return $this->db->get('produk');
    }
    public function getProdukWhere($where)
    {
        return $this->db->get_where('produk', $where);
    }

    public function produkWhere($where)
    {
        return $this->db->get_where('produk', $where);
    }

    public function simpanBuku($data = null)
    {
        $this->db->insert('buku',$data);
    }

    public function updateBuku($data = null, $where = null)
    {
        $this->db->update('buku', $data, $where);
    }

    public function hapusBuku($where = null)
    {
        $this->db->delete('buku', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if(!empty($where) && count($where) > 0){
            $this->db->where($where);
        }
        $this->db->from('buku');
        return $this->db->get()->row($field);
    }

    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    //join
    public function joinKategoriBuku($where)
    {
        $this->db->select('buku.*, buku.id_kategori,kategori.kategori');
        $this->db->from('buku');
        $this->db->join('kategori','kategori.id = buku.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }

    public function getLimitBuku()
    {
        $this->db->limit(5);
        return $this->db->get('buku');
    }
}