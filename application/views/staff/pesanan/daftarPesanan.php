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
            <h5>Tanggal : <?= date('d M Y');?></h5>
            <hr/>
            <table class="table table-hover table-striped table-bordered" id="table-datatable">
                <thead>
                    <tr align="center">
                        <th scope="col">#</th>
                        <th scope="col">No Pesanan</th>
                        <th scope="col">Nama Pemesan</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Waktu Pemesanan</th>
                        <th scope="col">Nomor Meja</th>
                        <th scope="col">Status</th>
                        <th scope="col">Kasir</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $a = 1;
                    foreach ($detail_pesanan as $p) { ?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td>
                            <?= $p['no_pesanan']; ?>
                        </td>
                        <td>
                            <?= $p['nama_pemesan'];?>
                        </td>
                        <td><b><?= $p['nama_produk']; ?></b></td>
                        <td align="center">
                            <?= $p['waktu_pesanan'];?>
                        </td>
                        <td align="center"><b><?= $p['no_meja']; ?></b></td>
                        <td align="center" style="font-weight:bold" <?php if($p['status_pesanan'] == "Dibayar") {?>
                            class="bg-success"
                            <?php }else if($p['status_pesanan'] == "Siap disajikan") {?>
                            class="bg-primary"
                            <?php }else if($p['status_pesanan'] == "Diantar") { ?>
                            class="bg-info"
                            <?php }else{ ?>
                            class="bg-danger"
                            <?php } ?>

                            >
                            <span class="text-light"><?= $p['status_pesanan'];?></span>

                        </td>
                        <td><?= $p['nama_user']; ?></td>
                        <td>
                            <?php if($p['status_pesanan'] != "Selesai"){ ?>
                            <a href="<?= base_url('staff/ubahStatus/') . $p['no_pesanan']; ?>"
                                onclick="return confirm('Kamu yakin akan mengubah status Pesanan ini??');"
                                class="badge badge-info p-2"> Ubah Status</a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Tambah kategori baru-->
<div class="modal fade" id="produkBaruModal" tabindex="-1" role="dialog" aria-labelledby="kategoriBaruModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ProdukBaruModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('produk/tambahProduk'); ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="produk" id="produk" placeholder="Masukkan Nama Produk"
                            class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <input type="text" name="satuan" id="satuan" placeholder="Masukkan Satuan Produk"
                            class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <input type="number" name="harga" id="harga" placeholder="Masukkan Harga Produk"
                            class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi Produk"
                            class="form-control form-control-user"></textarea>
                    </div>
                    <div class="form-group">
                        <select name="kategori" id="kategori" placeholder="Masukkan Kategori Produk"
                            class="form-control form-control-user">
                            <?php foreach($kategori as $kategori):?>
                            <option value="<?= $kategori['id'];?>"><?= $kategori['nama_kategori'];?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="file" class="form-control form-control-user" id="image" name="image">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i>
                        Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Mneu -->