<!-- Begin Page Content -->
<div class="container-fluid">
    <?= $this->session->flashdata('pesan'); ?>
    <div class="row">
        <div class="col-lg-12">
            <?php if(validation_errors()){?>
            <div class="alert alert-danger" role="alert">
                <?= validation_errors();?>
            </div>
            <?php }?>
            <?= $this->session->flashdata('pesan'); ?>
            <!-- Tombol pertama untuk cetak langsung ke printer -->
            <a target="_blank" href="<?= base_url('laporan/cetak_laporan_produk'); ?>" class="btn btn-primary mb-3"><i
                    class="fas fa-print"></i>
                Print
            </a>
            <!-- Tombol kedua untuk cetak dalam bentuk pdf -->
            <a target="_blank" href="<?= base_url('laporan/laporan_produk_pdf'); ?>" class="btn btn-warning mb-3"><i
                    class="far fa-file-pdf"></i>
                Download Pdf
            </a>
            <!-- Tombol ketiga untuk cetak dalam bentuk excel -->
            <a href="<?= base_url('laporan/export_excel_produk'); ?>" class="btn btn-success mb-3"><i
                    class="far fa-file-excel"></i>
                Export ke Excel
            </a>
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
                    </tr>
                </thead>
                <tbody>
                    <?php
          $a = 1;
          //Memunculkan setiap record dari tabel buku ke dalam bentuk html untuk diprint
          foreach ($produk as $p) { ?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $p['nama_produk']; ?></td>
                        <td><?= $p['satuan_produk']; ?></td>
                        <td><?= $p['harga_produk']; ?></td>
                        <td><?= $p['desk_produk']; ?></td>
                        <td><?= $p['nama_kategori']; ?></td>
                        <td>
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/upload/') . $p['image_produk']; ?>"
                                    class="img-fluid img-thumbnail" alt="..." style="width:60px;height:80px;">
                            </picture>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->