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
            <h1 align="center" class="mb-3">Keranjang Pesanan</h1>
            <table class="table table-hover">
                <thead>
                    <tr align="center">
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Satuan Produk</th>
                        <th scope="col">Harga Produk</th>
                        <th scope="col">Jumlah Beli</th>
                        <th scope="col">Total Harga</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $a = 1;
                    $totalItem = 0;
                    $totalHarga = 0;
                    foreach ($keranjang as $p) { ?>
                        <tr>
                            <th scope="row" align="center"><?= $a++; ?></th>
                            <td>
                            <a  href="<?= base_url('home/produk/'.$p['produk_id']);?>"><b><?= $p['nama_produk']; ?></b></a>  
                            </td>
                            <td align="center"><?= $p['satuan_produk']; ?></td>
                            <td align="right">Rp.<?= $p['harga_produk']; ?></td>
                            <td align="center"><?= $p['jumlah_beli']; ?></td>
                            <td align="right">Rp.<?= $p['harga_produk']*$p['jumlah_beli']; ?></td>
                            <td>
                            <a href="<?= base_url('home/hapusPesanan/') . $p['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus Pesanan <?= $p['nama_produk']; ?> ?');" class="badge badge-danger p-2"><i class="fas fa-trash"></i> Hapus</a>

                            </td>
                        </tr>
                    <?php 
                      $totalItem = $totalItem+$p['jumlah_beli'];
                      $totalHarga = $totalHarga+($p['harga_produk']*$p['jumlah_beli']);
                    } ?>
                    <tr style="background-color:gray;padding:10px;color:white;">
                      <td colspan="4" align="center"><b>Grand Total :</b></td>
                      <td align="center"><?=$totalItem;?></td>
                      <td align="right">Rp.<?= number_format($totalHarga,0,',','.');?></td>
                      <td></td>
                    </tr>
                    <?= form_open_multipart('home/pesananSelesai/'); ?>
                    <tr style="padding:10px;">
                      <td colspan="5" align="right"><b>Nomor Meja :</b></td>
                      <td colspan="2">
                        <input type="hidden" name="totalHarga" value="<?=$totalHarga;?>">
                        <input type="number" name="noMeja" required class="form-control">
                    </td>
                    </tr>
                    <tr style="padding:10px;">
                      <td colspan="5" align="right"><b>Nama Pemesan :</b></td>
                      <td colspan="2">
                        <input type="text" name="namaPemesan" required class="form-control">
                    </td>
                    </tr>

                </tbody>
            </table>
            <a class="btn btn-sm btn-outline-primary" href="<?=base_url();?>"><span
              class="fas fw fa-play"></span> Lanjutkan Pemesanan</a>
          <button class="btn btn-sm btn-outline-success" onclick="return confirm('Kamu yakin akan menyelesaikan Pesanan ini');"
           ><span
              class="fas fw fa-stop"></span> Selesaikan Pesanan</button>
                  </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
