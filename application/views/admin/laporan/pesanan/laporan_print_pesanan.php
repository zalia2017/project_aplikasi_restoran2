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
        <center>Laporan Data Pesanan Restoran MacDee</center>
    </h3> <br />
    <p style="font-size:12pt">Jumlah Pesanan Terdaftar = <?= $jumlah_pesanan;?></p>
    <p>Periode Laporan Pesanan : <?= $tanggal;?></p>
    <p>Tanggal Cetak : <?= date('d/m/Y (h:i:s)');?>
    <p>Di cetak Oleh : <?= $user['nama_user'];?>
    <table class="table-data">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">No Pesanan</th>
                <th scope="col">Nama Pemesan</th>
                <th scope="col">Waktu Pesanan</th>
                <th scope="col">No Meja</th>
                <th scope="col">Total Harga</th>
                <th scope="col">Total Bayar</th>
                <th scope="col">Jenis Bayar</th>
                <th scope="col">Status</th>
                <th scope="col">Kasir</th>
            </tr>
        </thead>
        <tbody>

            <?php
                    $a = 1;
                    $grandTotalHarga = 0;
                    $grandTotalBayar = 0;
                    foreach ($pesanan as $p) {
                        $grandTotalHarga += $p['total_harga'];
                        $grandTotalBayar += $p['total_bayar'];

                        ?>
            <tr>
                <th scope="row"><?= $a++; ?></th>
                <td>
                    <?= $p['no_pesanan']; ?></a>
                </td>
                <td><?= $p['nama_pemesan']; ?></td>
                <td>
                    <?= date("d M Y", strtotime($p['tgl_pesanan']));?>
                    (<?= $p['waktu_pesanan'];?>)
                </td>
                <td><?= $p['no_meja']; ?></td>
                <td align="right"><?= number_format($p['total_harga'],0,',','.'); ?></td>
                <td align="right"><?= number_format($p['total_bayar'],0,',','.'); ?></td>
                <td><?= $p['jenis_bayar']; ?></td>
                <td><?= $p['status_pesanan']; ?></td>
                <td><?= $p['nama_user']; ?></td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="5" align="right"><b>Total :</b></td>
                <td align="right"><b><?=number_format($grandTotalHarga,0,',','.');?></b></td>
                <td align="right"><b><?=number_format($grandTotalBayar,0,',','.');?></b></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>
    <script type="text/javascript">
    // window.print();
    </script>
</body>

</html>