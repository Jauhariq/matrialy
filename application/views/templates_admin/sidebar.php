<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo base_url('admin/home_admin') ?>" class="brand-link">
    <img src="<?php echo base_url('assets/gambar/logo/logoicon.png') ?>" alt="AdminLTE Logo" class="brand-image">
    <img src="<?php echo base_url('assets/gambar/logo/logo.png') ?>" class="brand-image">
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?php echo base_url('auth/info_akun/')?>" class="nav-link">
            <i class="text-green nav-icon fas fa-user"></i>
            <p class="text-white"><?php echo $this->session->userdata('nama'); ?></p>
          </a>
        </li>
      </ul>
    </div>
    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="<?php echo base_url('admin/home_admin') ?>" class="nav-link">
            <i class="text-green nav-icon fas fa-file"></i>
            <p>
              Menu Utama
            </p>
          </a>
        </li>
        <!-- Kategori -->
        <li class="nav-header">Kontrol Admin</li>
        <li class="nav-item">
          <a href="<?php echo base_url('admin/data_produk') ?>" class="nav-link">
            <i class="text-green nav-icon fas fa-book"></i>
            <p>Data Produk</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?php echo base_url('admin/invoice') ?>" class="nav-link">
            <i class="text-green nav-icon fas fa-credit-card"></i>
            <p>Invoice</p>
          </a>
        </li>
        <li class="nav-item user-panel">
          <a href="<?php echo base_url()?>auth/logout" class="nav-link bg-danger">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar -->
  </div>
</aside>