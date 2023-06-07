<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- row ux-->
  <div class="row">
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2 bg-primary">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Kasir</div>
              <div class="h1 mb-0 font-weight-bold text-white"><?= $jumlah_kasir;?></div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('user/anggota'); ?>"><i class="fas fa-users fa-3x text-warning"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2 bg-warning">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-white text-uppercase mb-1">
                Jumlah Staff
              </div>
              <div class="h1 mb-0 font-weight-bold text-white">
                <?= $jumlah_staff;?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('buku'); ?>"><i class="fas fa-book fa-3x text-primary"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2 bg-danger">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Kategori</div>
              <div class="h1 mb-0 font-weight-bold text-white">
                <?= $jumlah_kategori?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('user'); ?>"><i class="fas fa-user-tag fa-3x text-success"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-warning shadow h-100 py-2 bg-success">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-md font-weight-bold text-white text-uppercase mb-1">Jumlah Produk</div>
              <div class="h1 mb-0 font-weight-bold text-white">
                <?= $jumlah_produk?>
              </div>
            </div>
            <div class="col-auto">
              <a href="<?= base_url('user'); ?>"><i class="fas fa-shopping-cart fa-3x text-danger"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- end row ux-->

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- row table-->
  <div class="row">
    <div class="table-responsive table-bordered col-sm-5 ml-auto mr-auto mt-2">
      <div class="page-header">
        <span class="fas fa-users text-primary mt-2 "> Data Kategori</span>
        <a class="text-danger" href="<?php echo base_url('kategori'); ?>"><i class="fas fa-search mt-2 float-right"> Tampilkan</i></a>
      </div>
      <table class="table mt-3">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Kategori</th>
            <th>Gambar Kategori</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $i = 1;
          foreach ($kategori as $k) { ?>
            <tr>
              <td><?= $i++; ?></td>
              <td><?= $k['nama_kategori']; ?></td>
              <td align="center">
              <picture>
                                    <source srcset="" type="image/svg+xml">
                                    <img src="<?= base_url('assets/img/upload/') . $k['image_kategori']; ?>" class="img-fluid img-thumbnail" alt="..." style="width:60px;height:80px;">
                                </picture>
            </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>


    <div class="table-responsive table-bordered col-sm-5 ml-auto mr-auto mt-2">
      <div class="page-header">
        <span class="fas fa-book text-warning mt-2"> Data Produk</span>
        <a href="<?= base_url('buku'); ?>"><i class="fas fa-search text-primary mt-2 float-right"> Tampilkan</i></a>
      </div>
      <div class="table-responsive">
        <table class="table mt-3" id="table-datatable">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Produk</th>
              <th>Satuan Produk</th>
              <th>Harga Produk</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $i = 1;
            foreach ($produk as $b) { ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= $b['nama_produk']; ?></td>
                <td><?= $b['satuan_produk']; ?></td>
                <td><?= $b['harga_produk']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>


  </div>
  <!-- end of row table-->

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->