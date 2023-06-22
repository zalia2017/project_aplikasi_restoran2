<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3><center>Laporan Data Kategori Restoran MacDee</center></h3>
<br/>
<table class="table-data">
  <thead>
    <tr>
      <th>No</th>
      <th>Nama Kategori</th>
    </tr>
  </thead>
  <tbody>
    <?php $no=1;
    foreach($kategori as $k):?>
    <tr>
      <td><?= $no++;?></td>
      <td><?= $k['nama_kategori'];?></td>
    </tr>
    <?php endforeach;?>
  </tbody>
</table>