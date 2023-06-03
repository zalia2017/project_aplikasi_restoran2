        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

          <!-- Sidebar - Brand -->
          <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
            <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-book"></i>
            </div>
            <div class="sidebar-brand-text mx-3">MacDee Restaurant</div>
          </a>

          <!-- Divider -->
          <hr class="sidebar-divider">



          <!-- Looping Menu-->
          <div class="sidebar-heading">
            Home
          </div>
          <li class="nav-item active">
            <!-- Nav Item - Dashboard -->
          <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('admin'); ?>">
              <i class="fa fa-fw fa book"></i>
              <span>Dashboard</span></a>
          </li>
          </li>

          <!-- Divider -->
          <hr class="sidebar-divider mt-3">

          <!-- Heading -->
          <div class="sidebar-heading">
            Master Data
          </div>
          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('user/daftar_user'); ?>">
              <i class="fa fa-fw fa-users"></i>
              <span>Data User</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('kategori'); ?>">
              <i class="fa fa-fw fa-list"></i>
              <span>Data Kategori</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('buku'); ?>">
              <i class="fa fa-fw fa-book"></i>
              <span>Data Produk</span></a>
          </li>

          </li>
          <!-- Divider -->
          <hr class="sidebar-divider mt-3">

          <!-- Heading -->
          <div class="sidebar-heading">
            Transaksi
          </div>
          <!-- Nav Item - Dashboard -->
          <li class="nav-item active">
          <li class="nav-item">
            <a href="<?= base_url('pinjam');?>" class="nav-link pb-0"><i class="fa fa-fw fa-shopping-cart"></i>
              <span>Data Peminjaman</span></a>
          </li>
          <li class="nav-item"><a href="<?= base_url('pinjam/daftarBooking');?>" class="nav-link pb-0"><i
                class="fa fa-fw fa-list"></i>
              <span>Data Booking</span>
            </a>
          </li>
          </li>


          <!-- Divider -->
          <hr class="sidebar-divider">
          <div calss="sidebar-heading">
            Laporan
          </div>

          <!-- Nav Item Dashbaord -->

          <li class="nav-item active">
          <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('laporan/laporan_buku');?>">
              <i class="fa fa-fw fa-address-book"></i>
              <span>Laporan Data Buku</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('laporan/laporan_anggota');?>">
              <i class="fa fa-fw fa-address-book"></i>
              <span>Laporan Data Anggota</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link pb-0" href="<?= base_url('laporan/laporan_pinjam');?>">
              <i class="fa fa-fw fa-address-book"></i>
              <span>Laporan Data Peminjaman</span>
            </a>
          </li>
          </li>

          <!-- Sidebar Toggler (Sidebar) -->
          <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
          </div>

        </ul>
        <!-- End of Sidebar --   > 
        
        