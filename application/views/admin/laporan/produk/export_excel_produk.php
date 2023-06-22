<?php 
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3>
    <center>Laporan Data Produk Restoran MacDee</center>
</h3>
<br />
<table class="table-data">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Produk</th>
            <th scope="col">Satuan Produk</th>
            <th scope="col">Harga Produk</th>
            <th scope="col">Deskripsi Produk</th>
            <th scope="col">Kategori</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;
    foreach($produk as $p):?>
        <tr>
            <th scope="row"><?= $no++; ?></th>
            <td><?= $p['nama_produk']; ?></td>
            <td><?= $p['satuan_produk']; ?></td>
            <td><?= $p['harga_produk']; ?></td>
            <td><?= $p['desk_produk']; ?></td>
            <td><?= $p['nama_kategori']; ?></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>