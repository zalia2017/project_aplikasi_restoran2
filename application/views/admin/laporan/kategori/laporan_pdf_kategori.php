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
  <h3><center>Laporan Data Kategori Restoran MacDee</center>
  </h3>
  <br/>
  <table class="table-data">
      <tr>
        <th>No</th>
        <th>Nama Kategori</th>
      </tr>
      <?php 
        $no = 1;
        foreach($kategori as $k):
      ?>
      <tr>
        <th scope="row"><?= $no++;?></th>
        <td><?= $k['nama_kategori'];?></td>
      </tr>
      <?php endforeach;?>
  </table>
</body>
</html>