<div class="container">
    <center>
        <table>
            <tr>
                <td nowrap>Terima Kasih <b><?= $pesanan['nama_pemesan']; ?></b>
                </td>
            </tr>
            <tr>
                <td nowrap>No Pesanan : <b><?= $pesanan['no_pesanan']; ?></b>
                </td>
            </tr>
            <tr>
                <td nowrap>Nomor Meja : <b><?= $pesanan['no_meja']; ?></b>
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
                                    <th scope="col">#</th>
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
                    foreach ($detail as $p) { ?>
                    <tr>
                        <th scope="row" align="center"><?= $a++; ?></th>
                        <td>
<b><?= $p['nama_produk']; ?></b>
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
                        <td align="right">
                            Rp.<?= number_format($totalHarga,0,',','.');?>
                            <input type="hidden" id="totalHarga" value="<?=$totalHarga;?>">
                            
                        </td>   
                    </tr>
                    <tr style="padding:10px;">
                        <td colspan="5" align="right"><b>Pembayaran :</b></td>
                       
                        <td align="right"><?=$pesanan['jenis_bayar'];?>
                        </td>
                    </tr>
                    <tr style="padding:10px;">
                        <td colspan="5" align="right"><b>Jumlah Bayar :</b></td>
                        <td align="right">
                        <?=$pesanan['total_bayar'];?>
                        </td>
                    </tr>
                    <tr style="padding:10px;">
                        <td colspan="5" align="right"><b>Kembali :</b></td>
                        <td align="right">
                            <?=$pesanan['total_bayar']-$pesanan['total_harga'];?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                            <td colspan="2">
                        <a target="_blank" class="btn col-12 btn-sm btn-success" href="<?= base_url('pesanan/cetakPesanan/'.$pesanan['no_pesanan']);?>"> Cetak Struk</a>
                        </td>
                    </tr>

                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>

        </table>
    </center>
</div>