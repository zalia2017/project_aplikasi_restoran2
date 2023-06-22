<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk</title>
    <style>
        .kotak-produk {
            border-collapse: collapse
        }
        .kotak-produk tr td, .kotak-produk tr th{
            border:1px solid gray;
            padding: 5px;
            
        }
    </style>

</head>
<body>
<table style="border:1px solid black;padding:5px">
<tr>
    <td align="center" style="border-bottom:1px solid gray">
        <h1 style="margin-bottom:0px">MacDee Restaurant</h1>
        Jl.Fatmawati Raya No.9
    </td>
</tr>
<tr>
        <td nowrap><?= $tanggal;?>
        </td>
    </tr>
    <tr>
        <td nowrap>Terima Kasih <b><?= $pesanan['nama_pemesan']; ?></b>
        </td>
    </tr>
    <tr>
        <td nowrap>No Pesanan : <b><?= $pesanan['no_pesanan']; ?></b>
        </td>
    </tr>
    <tr>
        <td nowrap>Nomor Meja :<b><?= $pesanan['no_meja']; ?></b>
        </td>
    </tr>
    <tr>
        <td>Rincian Pesanan Anda:</td>
    </tr>
    <tr>
        <td>
            <table style="border: 1px solid gray" class="kotak-produk">
                <tr>
                    <th>No.</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Satuan</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Total Harga</th>
                </tr>
                <?php
                    $a = 1;
                    $totalItem = 0;
                    $totalHarga = 0;
                    foreach ($detail_pesanan as $p) { ?>
                <tr>
                    <th scope="row" align="center"><?= $a++; ?></th>
                    <td>
                        <?=$p['nama_produk']; ?></b>
                    </td>
                    <td align="center"><?= $p['satuan_produk']; ?></td>
                    <td align="right">Rp.<?= number_format($p['harga_produk'],0,',','.'); ?></td>
                    <td align="center"><?= $p['jumlah_beli']; ?></td>
                    <td align="right">Rp.<?= number_format($p['harga_produk']*$p['jumlah_beli'], 0, ',','.'); ?></td>
                </tr>
                <?php 
                      $totalItem = $totalItem+$p['jumlah_beli'];
                      $totalHarga = $totalHarga+($p['harga_produk']*$p['jumlah_beli']);
                    } ?>
                <tr>
                    <td colspan="4" align="center"><b>Grand Total :</b></td>
                    <td align="center"><b><?=$totalItem;?></b></td>
                    <td align="right"><b>Rp.<?= number_format($totalHarga,0,',','.');?></b></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>Jenis Pembayaran : <b><?= $pesanan['jenis_bayar'];?></b></td>
    </tr>
    <tr>
        <td>Total Harga : <b>Rp. <?= number_format($pesanan['total_harga'],0,',','.');?></b></td>
    </tr>
    <tr>
        <td>Total Bayar : <b>Rp. <?= number_format($pesanan['total_bayar'],0,',','.');?></b></td>
    </tr>
    <tr>
        <td>Total Kembalian : <b>Rp. <?= number_format($pesanan['total_bayar']-$pesanan['total_harga'],0,',','.');?></b></td>
    </tr>
    <tr>
        <td>Kasir : <b><?= $pesanan['nama_user'];?></b></td>
    </tr>
    <tr>
        <td align="center"><b>~Terima kasih Atas Kunjungan Anda ~</b></td>
    </tr>

</table>
    <script>
    window.print();
    </script>
</body>
</html>
