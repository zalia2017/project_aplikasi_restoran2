<!-- Begin Page Content -->
<div class="container-fluid">

    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if (validation_errors()) { ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php } ?>
            No Pesanan : <b><?= $pesanan['no_pesanan']; ?></b><br />
            Nama Pemesan : <b><?= $pesanan['nama_pemesan'];?></b><br />
            No Meja : <b><?= $pesanan['no_meja'];?></b>

            <table class="table table-hover">
                <thead>
                    <tr align="center">
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
                        <td align="right">
                            Rp.<?= number_format($totalHarga,0,',','.');?>
                            <input type="hidden" id="totalHarga" value="<?=$totalHarga;?>">
                            
                        </td>
                    </tr>
                    <?= form_open('Pesanan/bayarPesanan/'); ?>
                    <tr style="padding:10px;">
                        <td colspan="4" align="right"><b>Pembayaran :</b></td>
                       
                        <td colspan="2"><input type="radio" id="jenisCash" checked name="jenisBayar" value="cash"> Cash &nbsp;
                        <input type="hidden" name="noPesanan" value="<?=$pesanan['no_pesanan'];?>">   
                        <input type="radio" name="jenisBayar" id="jenisCC" value="kartu(kredit/debet)"> Kartu Kredit/Debet
                        </td>
                    </tr>
                    <tr style="padding:10px;">
                        <td colspan="4" align="right"><b>Jumlah Bayar :</b></td>
                        <td colspan="2"><input type="number"  value="<?=$totalHarga;?>"  name="jumlahBayar" id="jumlahBayar" class="form-control">
                        </td>
                    </tr>
                    <tr style="padding:10px;">
                        <td colspan="4" align="right"><b>Kembali :</b></td>
                        <td colspan="2"><input type="number" value="0" readonly name="jumlahKembali" id="jumlahKembali" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4"></td>
                            <td colspan="2">
                        <button class="btn col-12 btn-sm btn-success"
                onclick="return confirm('Kamu yakin akan membayar Pesanan ini');"> Bayar</button>
                        </td>
                    </tr>
                    </form>
                </tbody>
            </table>
            <button class="btn btn-sm btn-outline-primary" onClick="history.back()"><span class="fas fw fa-left-arrow"></span>
                Kembali</button>
           
            
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->