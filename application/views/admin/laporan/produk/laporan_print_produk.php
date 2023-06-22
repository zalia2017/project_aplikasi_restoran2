<!DOCTYPE html>
<html>

<head>
    <title></title>
</head>

<body>
    <style type="text/css">
    .table-data {
        width: 100%;
        border-collapse: collapse;
    }

    .table-data tr th,
    .table-data tr td {
        border: 1px solid black;
        font-size: 11pt;
        font-family: Verdana;
        padding: 10px 10px 10px 10px;
    }

    h3 {
        font-family: Verdana;
    }
    </style>
    <h3>
        <center>Laporan Data Produk Restoran MacDee</center>
    </h3> <br />
    <span style="font-size:12pt">Jumlah Produk Terdaftar = <?= $jumlah_produk;?></span>
    <table class="table-data">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Satuan Produk</th>
                <th scope="col">Harga Produk</th>
                <th scope="col">Deskripsi Produk</th>
                <th scope="col">Kategori</th>
                <th scope="col">Gambar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($produk as $p){
                ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $p['nama_produk']; ?></td>
                <td><?= $p['satuan_produk']; ?></td>
                <td><?= $p['harga_produk']; ?></td>
                <td><?= $p['desk_produk']; ?></td>
                <td><?= $p['nama_kategori']; ?></td>
                <td>
                    <picture>
                        <source srcset="" type="image/svg+xml">
                        <img src="<?= base_url('assets/img/upload/') . $p['image_produk']; ?>"
                            class="img-fluid img-thumbnail" alt="..." style="width:60px;height:80px;">
                    </picture>
                </td>
            </tr>
            <?php
 }
 ?>
        </tbody>
    </table>
    <script type="text/javascript">
    window.print();
    </script>
</body>

</html>