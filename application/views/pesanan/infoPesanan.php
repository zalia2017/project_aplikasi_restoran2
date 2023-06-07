<div class="container">
    <center>
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
                <td nowrap>Nomor Meja : <b><?= $no_meja; ?></b>
                </td>
            </tr>
            <tr>
                <td>Rincian Pesanan Anda:</td>
            </tr>
            <tr>
                <td>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover" id="table-datatable">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Satuan Produk</th>
                                    <th scope="col">Harga Produk</th>
                                    <th scope="col">Jumlah Beli</th>
                                    <th scope="col">Total Harga</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                    $a = 1;
                    $totalItem = 0;
                    $totalHarga = 0;
                    foreach ($pesanan as $p) { ?>
                                <tr>
                                    <th scope="row" align="center"><?= $a++; ?></th>
                                    <td>
                                        <a
                                            href="<?= base_url('home/produk/'.$p['produk_id']);?>"><b><?= $p['nama_produk']; ?></b></a>
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
                                <tr style="background-color:gray;padding:10px;color:white;">
                                    <td colspan="4" align="center"><b>Grand Total :</b></td>
                                    <td align="center"><?=$totalItem;?></td>
                                    <td align="right">Rp.<?= number_format($totalHarga,0,',','.');?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    * Cetak bukti pesanan ini dan bawa ke kasir
                    <hr>
                </td>
            </tr>
            <tr>
                <td>
                <a class="btn btn-sm btn-outline-danger"
                        href="<?php echo base_url() . 'home/exportPesananToPdf/'.$no_pesanan; ?>"><span
                            class="far fa-lg fa-fw fa-file-pdf"></span>Cetak Pdf</a>
                </td>
            </tr>
        </table>
    </center>
</div>