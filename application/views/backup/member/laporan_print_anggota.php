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
        <center>Laporan Data Anggota Perputakaan Online</center>
    </h3> <br />
    <table class="table-data">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Foto</th>
            </tr>
        </thead>
        <tbody>
            <?php
 $no = 1;
 foreach($anggota as $b){
 ?>
            <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $b['nama']; ?></td>
                <td><?= $b['alamat']; ?></td>
                <td><?= $b['email']; ?></td>
                <td>
                    <picture>
                        <source srcset="" type="image/svg+xml">
                        <img src="<?= base_url('assets/img/profile/') . $b['image']; ?>" class="img-fluid img-thumbnail"
                            alt="..." style="width:60px;height:80px;">
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