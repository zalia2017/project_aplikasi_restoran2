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
        <center>Laporan Data Kategori Restoran MacDee</center>
    </h3> <br />
    <table class="table-data">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Gambar Kategori</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($kategori as $k){
                ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $k['nama_kategori']; ?></td>
                <td>
                    <img width="100px" src="<?= base_url('assets/img/upload/').$k['image_kategori'];?>" />
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