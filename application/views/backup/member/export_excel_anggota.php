<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3><center>Laporan Data Buku Perpustakaan Online</center></h3>
<br/>
<table class="table-data">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama</th>
      <th>Alamat</th>
      <th>Email</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1;
    foreach($anggota as $b):?>
    <tr>
      <td><?= $no++;?></td>
      <td><?= $b['nama'];?></td>
      <td><?= $b['alamat'];?></td>
      <td><?= $b['email'];?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>