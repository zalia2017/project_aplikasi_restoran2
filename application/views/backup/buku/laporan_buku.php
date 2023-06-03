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
      <a target="_blank" href="<?= base_url('laporan/cetak_laporan_buku'); ?>" class="btn btn-primary mb-3"><i
          class="fas fa-print"></i>
        Print
      </a>
      <!-- Tombol kedua untuk cetak dalam bentuk pdf -->
      <!-- Menjalankan controller laporan, method laporan_buku_pdf -->
      <a target="_blank" href="<?= base_url('laporan/laporan_buku_pdf'); ?>" class="btn btn-warning mb-3"><i
          class="far fa-file-pdf"></i> 
          Download Pdf
      </a>
      <!-- Tombol ketiga untuk cetak dalam bentuk excel -->
      <!-- Menjalankan controller laporan, method export_excel -->
      <a href="<?= base_url('laporan/export_excel_anggota'); ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i>
        Export ke Excel
      </a>
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Pengarang</th>
            <th scope="col">Penerbit</th>
            <th scope="col">Tahun Terbit</th>
            <th scope="col">ISBN</th>
            <th scope="col">Stok</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $a = 1;
          //Memunculkan setiap record dari tabel buku ke dalam bentuk html untuk diprint
          foreach ($buku as $b) { ?>
          <tr>
            <th scope="row"><?= $a++; ?></th>
            <td><?= $b['judul_buku']; ?></td>
            <td><?= $b['pengarang']; ?></td>
            <td><?= $b['penerbit']; ?></td>
            <td><?= $b['tahun_terbit']; ?></td>
            <td><?= $b['isbn']; ?></td>
            <td><?= $b['stok']; ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<!-- /.container-fluid -->