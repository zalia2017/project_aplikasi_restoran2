<DOCTYPE html>
<html>
<head>
<title></title>
<style type="text/css">
  .table-data {
    width: 100%;
    border-collapse: collapse;
  }
  .table-data tr th,
  .table-data tr td {
    border: 1px solid black;
    font-size: 11pt;
    padding: 10px 10px 10px 10px;
  }
  </style>
</head><body>
  <h3><center>Laporan Data Anggota Perpustakaan Online</center>
  </h3>
  <br/>
  <table class="table-data">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Email</th>
      </tr>
      <?php 
        $no = 1;
        foreach($anggota as $b):
      ?>
      <tr>
        <th scope="row"><?= $no++;?></th>
        <td><?= $b['nama'];?></td>
        <td><?= $b['alamat'];?></td>
        <td><?= $b['email'];?></td>
      </tr>
      <?php endforeach;?>
  </table>
</body>
</html>