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
            <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#produkBaruModal"><i class="fas fa-file-alt"></i> Tambah Produk</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Produk</th>
                        <th scope="col">Satuan Produk</th>
                        <th scope="col">Harga Produk</th>
                        <th scope="col">Deskripsi Produk</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Gambar</th>
                        <th scope="col">Pilihan</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $a = 1;
                    foreach ($produk as $p) { ?>
                        <tr>
                            <th scope="row"><?= $a++; ?></th>
                            <td><?= $p['nama_produk']; ?></td>
                            <td><?= $p['satuan_produk']; ?></td>
                            <td><?= $p['harga_produk']; ?></td>
                            <td><?= $p['desk_produk']; ?></td>
                            <td><?= $p['nama_kategori']; ?></td>
                            <td><picture>
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/upload/') . $p['image_produk']; ?>" class="img-fluid img-thumbnail" alt="..." style="width:60px;height:80px;">
                                </picture>
                    </td>
                            <td>
                                <a href="<?= base_url('produk/ubahProduk/') . $p['id']; ?>" class="badge badge-info"><i class="fas fa-edit"></i> Ubah</a>
                                <a href="<?= base_url('produk/hapusProduk/') . $p['id']; ?>" onclick="return confirm('Kamu yakin akan menghapus <?= $judul . ' ' . $p['nama_produk']; ?> ?');" class="badge badge-danger"><i class="fas fa-trash"></i> Hapus</a>
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
<div class="modal fade" id="produkBaruModal" tabindex="-1" role="dialog" aria-labelledby="kategoriBaruModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ProdukBaruModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('produk/tambahProduk'); ?>" method="post"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" name="produk" id="produk" placeholder="Masukkan Nama Produk" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <input type="text" name="satuan" id="satuan" placeholder="Masukkan Satuan Produk" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <input type="number" name="harga" id="harga" placeholder="Masukkan Harga Produk" class="form-control form-control-user">
                    </div>
                    <div class="form-group">
                        <textarea name="deskripsi" id="deskripsi" placeholder="Masukkan Deskripsi Produk" class="form-control form-control-user"></textarea>
                    </div>
                    <div class="form-group">
                        <select name="kategori" id="kategori" placeholder="Masukkan Kategori Produk" class="form-control form-control-user">
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-ban"></i> Close</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Tambah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End of Modal Tambah Mneu -->