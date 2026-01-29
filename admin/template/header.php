<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Dashboard | PPLG News</title>

  <link rel="shortcut icon" href="../assets/img/be/img/logo.png" type="image/x-icon">

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../assets/css/be/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="../assets/css/ionicons.min.css">
  <!-- Main CSS -->
  <link rel="stylesheet" href="../assets/css/be/adminlte.min.css">

  <style>
    .table tr td {
      width: 20px;
    }

    /* Modern Minimalistic School Theme */
    body {
      font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background: #f5f7fa;
    }

    /* Navbar Modernization */
    .main-header {
      background: #ffffff !important;
      border-bottom: 1px solid #e8eaf0 !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05) !important;
      padding: 0.5rem 1rem;
    }

    .main-header .navbar-nav .nav-link {
      color: #4b5563 !important;
      font-weight: 500;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .main-header .navbar-nav .nav-link:hover {
      background: #f3f4f6;
      color: #dc2626 !important;
    }

    .main-header .navbar-nav .nav-link i {
      margin-right: 6px;
    }

    /* Sidebar Modernization */
    .main-sidebar {
      background: linear-gradient(180deg, #000000 0%, #1a1a1a 100%) !important;
      box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
    }

    .brand-link {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
      padding: 1.25rem 1rem !important;
    }

    .brand-text {
      font-weight: 600 !important;
      font-size: 1.1rem;
      color: #ffffff !important;
      letter-spacing: 0.5px;
    }

    .brand-image {
      border: 2px solid rgba(255, 255, 255, 0.2);
    }

    .user-panel {
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding-bottom: 1rem !important;
      margin-bottom: 1rem !important;
    }

    .user-panel .info a {
      color: #ffffff !important;
      font-weight: 500;
      font-size: 0.95rem;
    }

    .user-panel .image img {
      border: 2px solid rgba(255, 255, 255, 0.3);
    }

    /* Sidebar Navigation */
    .nav-sidebar > .nav-item > .nav-link {
      color: rgba(255, 255, 255, 0.85) !important;
      border-radius: 8px;
      margin: 2px 8px;
      padding: 0.75rem 1rem !important;
      transition: all 0.2s;
      font-weight: 500;
    }

    .nav-sidebar > .nav-item > .nav-link:hover {
      background: rgba(255, 255, 255, 0.1) !important;
      color: #ffffff !important;
    }

    .nav-sidebar > .nav-item > .nav-link.active {
      background: rgba(255, 255, 255, 0.15) !important;
      color: #ffffff !important;
      font-weight: 600;
    }

    .nav-sidebar .nav-icon {
      width: 20px;
      margin-right: 10px;
      text-align: center;
    }

    .nav-treeview {
      background: rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      margin: 4px 8px;
      padding: 4px 0;
    }

    .nav-treeview .nav-link {
      color: rgba(255, 255, 255, 0.75) !important;
      padding: 0.5rem 1rem 0.5rem 2.5rem !important;
      font-size: 0.9rem;
    }

    .nav-treeview .nav-link:hover {
      background: rgba(255, 255, 255, 0.1) !important;
      color: #ffffff !important;
    }

    /* Content Wrapper */
    .content-wrapper {
      background: #f5f7fa;
    }

    .content-header {
      background: transparent;
      padding: 1.5rem 0 1rem 0;
    }

    .content-header h1 {
      font-size: 1.5rem;
      font-weight: 600;
      color: #1f2937;
    }

    .breadcrumb {
      background: transparent;
      padding: 0;
      margin: 0;
    }

    .breadcrumb-item a {
      color: #6b7280;
      text-decoration: none;
      font-weight: 500;
    }

    .breadcrumb-item.active {
      color: #1f2937;
      font-weight: 600;
    }

    .breadcrumb-item + .breadcrumb-item::before {
      content: "/";
      color: #d1d5db;
      padding: 0 0.5rem;
    }

    /* Cards */
    .card {
      border: 1px solid #e8eaf0;
      border-radius: 12px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      margin-bottom: 1.5rem;
    }

    .card-header {
      background: #f9fafb;
      border-bottom: 1px solid #e8eaf0;
      padding: 1rem 1.5rem;
      border-radius: 12px 12px 0 0;
    }

    .card-title {
      font-size: 1rem;
      font-weight: 600;
      color: #1f2937;
      margin: 0;
    }

    /* Buttons */
    .btn {
      border-radius: 8px;
      font-weight: 500;
      padding: 0.5rem 1.25rem;
      transition: all 0.2s;
    }

    .btn-primary {
      background: #dc2626;
      border-color: #dc2626;
    }

    .btn-primary:hover {
      background: #b91c1c;
      border-color: #b91c1c;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    /* Tables */
    .table {
      font-size: 0.9rem;
    }

    .table thead th {
      border-bottom: 2px solid #e8eaf0;
      font-weight: 600;
      color: #6b7280;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
      background: #f9fafb;
    }
    
    /* Override AdminLTE primary colors */
    .card-primary {
      border-top-color: #dc2626 !important;
    }
    
    .text-primary {
      color: #dc2626 !important;
    }
  </style>
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a href="logout.php" class="nav-link">
          <i class="fas fa-sign-out-alt"></i> Log Out
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../assets/img/be/img/logo.png" alt="PPLG Logo" class="brand-image img-circle elevation-3" style="opacity: .9">
      <span class="brand-text font-weight-light">PPLG News</span>
    </a>

    <?php
    include '../config/config.php';

    $sql = mysqli_query($con, "SELECT * FROM tbl_users WHERE id_user='$_SESSION[id]'");
    $data = mysqli_fetch_array($sql);
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../assets/img/<?= $data[
            'img'
          ] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $_SESSION['pengguna'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php if ($_SESSION['lvluser'] == 1) { ?>
            <li class="nav-item menu-open">
              <a href="index.php?page=home" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
          </li>
          <li class="nav-item">
              <a href="index.php?page=tampil-beranda" class="nav-link">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>
                  Manajemen Berita
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=tambah-berita" class="nav-link">
                <i class="nav-icon fas fa-clipboard"></i>
                <p>
                  Tambah Berita
                </p>
              </a>
            </li>
          <li class="nav-item">
            <!-- <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Posting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a> -->
            <ul class="nav nav-treeview">
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Post Beranda
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?page=tampil-beranda" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Data Beranda</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?page=tambah-beranda" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Tambah Data</p>
                    </a>
                  </li>
                </ul>
              </li> -->
              <!-- <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Post Berita
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?page=tampil-berita" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Data Berita</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?page=tambah-berita" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Tambah Berita</p>
                    </a>
                  </li>
                </ul>
              </li> -->
            </ul>
            <!-- <li class="nav-item">
              <a href="index.php?page=kebijakan" class="nav-link">
                <i class="nav-icon fas fa-book"></i>
                <p>
                  Kebijakan
                  
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=peraturan" class="nav-link">
                <i class="nav-icon fas fa-sticky-note"></i>
                <p>
                  Peraturan
                </p>
              </a>
            </li> -->
            <li class="nav-item">
              <a href="index.php?page=galeri" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Galeri
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=data-kategori" class="nav-link">
                <i class="nav-icon fas fa-tags"></i>
                <p>
                  Kategori
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=data-komentar" class="nav-link">
                <i class="nav-icon fas fa-comments"></i>
                <p>
                  Komentar
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=data-user" class="nav-link">
                <i class="nav-icon fas fa-users-cog"></i>
                <p>
                  Manajemen User
                </p>
              </a>
            </li>
            <!-- <li class="nav-item">
              <a href="index.php?page=struktur-organisasi" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Struktur Organisasi
                  
                </p>
              </a>
            </li> -->
          </li>
        <?php } elseif ($_SESSION['lvluser'] == 2) { ?>
          <li class="nav-item menu-open">
              <a href="index.php?page=home" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-clipboard"></i>
              <p>
                Posting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Post Berita
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="index.php?page=tampil-berita" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Data Berita</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="index.php?page=tambah-berita" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Tambah Berita</p>
                    </a>
                  </li>
                </ul>
              </li>
            </ul>
          </li>
        <?php } ?>
          <li class="nav-item">
              <a href="index.php?page=user" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Akun
                  <!-- <span class="right badge badge-danger">New</span> -->
                </p>
              </a>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"></h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <?php if (!empty($_GET['page'])): ?>
                <li class="breadcrumb-item active">
                  <?= htmlspecialchars($_GET['page']) ?>
                </li>
              <?php endif; ?>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->