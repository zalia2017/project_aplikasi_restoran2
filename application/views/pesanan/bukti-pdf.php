<table>
    <tr>
        <td nowrap>Terima Kasih <b><?= $nama_pemesan; ?></b>
        </td>
    </tr>
    <tr>
        <td nowrap>No Pesanan : <b><?= $no_pesanan; ?></b>
        </td>
    </tr>
    <tr>
        <td nowrap>Nomor Meja :<b><?= $no_meja; ?></b>
        </td>
    </tr>
    <tr>
        <td>Rincian Pesanan Anda:</td>
    </tr>
    <tr>
        <td>
            <table border="1">
                <tr>
                    <th>No.</th>
                    <th scope="col">Nama Produk</th>
                    <th scope="col">Satuan Produk</th>
                    <th scope="col">Harga Produk</th>
                    <th scope="col">Jumlah Beli</th>
                    <th scope="col">Total Harga</th>
                </tr>
                <?php
                    $a = 1;
                    $totalItem = 0;
                    $totalHarga = 0;
                    foreach ($pesanan as $p) { ?>
                <tr>
                    <th scope="row" align="center"><?= $a++; ?></th>
                    <td>
                        <?=$p['nama_produk']; ?></b>
                    </td>
                    <td align="center"><?= $p['satuan_produk']; ?></td>
                    <td align="right">Rp.<?= $p['harga_produk']; ?></td>
                    <td align="center"><?= $p['jumlah_beli']; ?></td>
                    <td align="right">Rp.<?= $p['harga_produk']*$p['jumlah_beli']; ?></td>
                </tr>
                <?php 
                      $totalItem = $totalItem+$p['jumlah_beli'];
                      $totalHarga = $totalHarga+($p['harga_produk']*$p['jumlah_beli']);
                    } ?>
                <tr>
                    <td colspan="4" align="center"><b>Grand Total :</b></td>
                    <td align="center"><?=$totalItem;?></td>
                    <td align="right">Rp.<?= number_format($totalHarga,0,',','.');?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td>* Silahkan cetak dan bawa bukti pesanan ini ke kasir</td>
                </tr>

</table>