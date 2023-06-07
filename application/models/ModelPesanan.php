<?php 

if(!defined('BASEPATH')) exit ('No direct script allowed');

class ModelPesanan extends CI_Model
{
  public function getTemp()
  {
    $this->db->select('temp.*, produk.id, produk.nama_produk, produk.satuan_produk, produk');
    $this->db->from('temp');
    $this->db->join('produk', 'produk.id=temp.id_produk', 'left');
    return $this->db->get();
  }
  public function getTempWhere($where)
  {
    $this->db->select('temp.*,produk.id as produk_id, produk.nama_produk, produk.satuan_produk, produk.harga_produk');
    $this->db->from('temp');
    $this->db->join('produk', 'produk.id=temp.id_produk', 'left');
    $this->db->where($where);
    return $this->db->get();
  }
  public function getPesanan()
  {
    $this->db->select('pesanan.*');
    $this->db->from('pesanan');
    $this->db->join('produk', 'produk.id=user.role_id', 'left');
    return $this->db->get();
  }
  public function getPesananWhere($where)
  {
    return $this->db->get_where('pesanan', $where);
  }
  public function simpanData($table, $data = null)
  {
    return $this->db->insert($table, $data);
  }

  public function getDetailPesananWhere($where)
  {
    $this->db->select('detail_pesanan.*,produk.id as produk_id, produk.nama_produk, produk.satuan_produk, produk.harga_produk');
    $this->db->from('detail_pesanan');
    $this->db->join('produk', 'produk.id=detail_pesanan.id_produk', 'left');
    $this->db->where($where);
    return $this->db->get();
  }
  public function updateData($table, $data, $where)
  {
    $this->db->update($table, $data, $where);
  }

  public function getOrderByLimit($table, $order, $limit)
  {
    $this->db->order_by($order, 'desc');
    $this->db->limit($limit);
    return $this->db->get($table);
  }

  // public function joinOrder($where)
  // {
  //   $this->db->select('*');
  //   $this->db->from('booking bo');
  //   $this->db->join('booking_detail d', 'd.id_booking=bo.id_booking');
  //   $this->db->join('buku bu', 'bu.id=d.id_buku');
  //   $this->db->where($where);

  //   return $this->db->get();
  // }

  // public function simpanDetail($where = null)
  // {
  //   $sql = "INSERT INTO booking_detail(id_booking, id_buku) SELECT booking.id_booking, temp.id_buku FROM booking, temp WHERE temp.id_user=booking.id_user AND booking.id_user='$where'";

  //   $this->db->query($sql);
  // }

  public function insertData($table, $data)
  {
    $this->db->insert($table, $data);
  }

  

  public function deleteData($table, $where)
  {
    $this->db->where($where);
    $this->db->delete($table);
  }

  public function find($where)
  {
    $this->db->limit(1);
    return $this->db->get('buku', $where);
  }

  // public function ha($table)
  // {
  //   return $this->db->truncate($table);
  // }

  // public function createTemp()
  // {
  //   $this->db->query('CREATE TABLE IF NOT EXISTS temp(id_booking varchar(12), tgl_booking DATETIME, email_user varchar(128), id_buku int)');
  // }

  // public function selectJoin()
  // {
  //   $this->db->select('*');
  //   $this->db->from('booking');
  //   $this->db->join('booking_detail', 'booking_detail.id_booking=booking.id_booking');
  //   $this->db->join('buku', 'booking_detail.id_buku=buku.id');
  //   return $this->db->get();
  // }

  // public function showtemp($where)
  // {
  //   return $this->db->get('temp', $where);
  // }

  public function kodeOtomatis($table, $key)
  {
    $this->db->select('right('.$key.',3) as kode', false);
    $this->db->order_by($key, 'desc');
    $this->db->limit(1);
    $query = $this->db->get($table);
    if($query->num_rows() <> 0){
      $data = $query->row();
      $kode = intval($data->kode) + 1;
    }else{
      $kode = 1;
    }
    $kodemax = str_pad($kode, 3, "0", STR_PAD_LEFT);
    $kodejadi = date('dmY'). $kodemax;

    return $kodejadi;
  }
  
}
?>