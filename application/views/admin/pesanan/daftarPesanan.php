<!-- Begin Page Content -->
<div class="row">
    

    <?= $this->session->flashdata('pesan'); ?>
    <div class="container-fluid">
        <div class="col-12">
            <?php if (validation_errors()) { ?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors(); ?>
            </div>
            <?php } ?>
            <form action="<?= base_url('pesanan'); ?>" method="post">
            <div class="row">
                
                    <div class="col-12 col-sm-4">
                        <input type="date" class="form-control" name="tglMulai" placeholder="Tanggal Mulai">
                    </div>
                    <div class="col-12 col-sm-4">
                        <input type="date" class="form-control" name="tglSelesai" placeholder="Tanggal Selesai">
                    </div>
                    <div class="col-12 col-sm-2">
                        <input type="submit" name="submit" value="Cari" class="btn btn-primary col-12"/>
                    </div>
                    <div class="col-12 col-sm-2">
                        <input type="submit" name="submit" value="Reset" class="btn btn-dark col-12"/>
                    </div>
                
            </div>
            </form>
            <hr/>
            <h5 align="left">Tanggal : <?= $tanggal;?></h5>
            <hr/>
            <!-- <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#produkBaruModal"><i class="fas fa-file-alt"></i> Tambah Produk</a> -->
            <div class="table-responsive">
                <table class="table table-hover" id="table-datatable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">No Pesanan</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Waktu Pemesanan</th>
                            <th scope="col">Nomor Meja</th>
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
                    foreach ($pesanan as $p) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td>
                                <?php if($p['status_pesanan'] == 'Dipesan') { ?>
                                <a href="<?= base_url('pesanan/detailPesanan/') . $p['no_pesanan']; ?>"
                                    style="font-size:14px;" class="badge badge-success p-2">
                                    <?= $p['no_pesanan']; ?></a>
                                <?php }else{ ?>
                                <a href="<?= base_url('pesanan/info/') . $p['no_pesanan']; ?>" style="font-size:14px;"
                                    class="badge badge-info p-2">
                                    <?= $p['no_pesanan']; ?></a>
                                <?php } ?>
                            </td>
                            <td><?= $p['nama_pemesan']; ?></td>
                            <td>
                                <?= date("d M Y", strtotime($p['tgl_pesanan']));?>
                                (<?= $p['waktu_pesanan'];?>)
                            </td>
                            <td><?= $p['no_meja']; ?></td>
                            <td><?= number_format($p['total_harga'],0,',','.'); ?></td>
                            <td><?= number_format($p['total_bayar'],0,',','.'); ?></td>
                            <td><?= $p['jenis_bayar']; ?></td>
                            <td><?= $p['status_pesanan']; ?></td>
                            <td><?= $p['nama_user']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- End of Modal Tambah Mneu -->