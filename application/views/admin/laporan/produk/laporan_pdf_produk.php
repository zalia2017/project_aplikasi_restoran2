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
    </head>

    <body>
        <h3>
            <center>Laporan Data Produk Restoran MacDee</center>
        </h3>
        <br />
        <table class="table-data">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Satuan Produk</th>
                <th scope="col">Harga Produk</th>
                <th scope="col">Deskripsi Produk</th>
                <th scope="col">Kategori</th>
            </tr>
            <?php 
        $no = 1;
        foreach($produk as $p):
      ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $p['nama_produk']; ?></td>
                <td><?= $p['satuan_produk']; ?></td>
                <td><?= $p['harga_produk']; ?></td>
                <td><?= $p['desk_produk']; ?></td>
                <td><?= $p['nama_kategori']; ?></td>
            </tr>
            <?php endforeach;?>
        </table>
    </body>

    </html>