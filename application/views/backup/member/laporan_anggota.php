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
            <!-- Menjalankan controller laporan, method cetak_laporan_buku -->
            <a target="_blank" href="<?= base_url('laporan/cetak_laporan_anggota'); ?>" class="btn btn-primary mb-3"><i
                    class="fas fa-print"></i>
                Print
            </a>
            <!-- Tombol kedua untuk cetak dalam bentuk pdf -->
            <!-- Menjalankan controller laporan, method laporan_buku_pdf -->
            <a target="_blank" href="<?= base_url('laporan/laporan_anggota_pdf'); ?>" class="btn btn-warning mb-3"><i
                    class="far fa-file-pdf"></i>
                Download Pdf
            </a>
            <!-- Tombol ketiga untuk cetak dalam bentuk excel -->
            <!-- Menjalankan controller laporan, method export_excel -->
            <a href="<?= base_url('laporan/export_excel_anggota'); ?>" class="btn btn-success mb-3"><i
                    class="far fa-file-excel"></i>
                Export ke Excel
            </a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Email</th>
                        <th scope="col">Foto</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
          $a = 1;
          //Memunculkan setiap record dari tabel anggota ke dalam bentuk html untuk diprint
          foreach ($anggota as $b) { ?>
                    <tr>
                        <th scope="row"><?= $a++; ?></th>
                        <td><?= $b['nama']; ?></td>
                        <td><?= $b['alamat']; ?></td>
                        <td><?= $b['email']; ?></td>
                        <td>
                            <picture>
                                <source srcset="" type="image/svg+xml">
                                <img src="<?= base_url('assets/img/profile/') . $b['image']; ?>"
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