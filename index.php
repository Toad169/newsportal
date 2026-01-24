<?php
session_start();
include 'config/config.php';

// Handle login form submission BEFORE any HTML output
if (isset($_POST['submit']) && isset($_GET['page']) && $_GET['page'] == 'login') {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = md5($_POST['password']);

  $sql = mysqli_query(
    $con,
    "SELECT * FROM tbl_users WHERE username='$username' AND password='$password' AND id_lvuser=2",
  );
  $cek = mysqli_num_rows($sql);

  if ($cek > 0) {
    $data = mysqli_fetch_array($sql);

    $_SESSION['frontend_user_id'] = $data['id_user'];
    $_SESSION['frontend_username'] = $data['username'];
    $_SESSION['frontend_nama'] = $data['nama_pengguna'];
    $_SESSION['frontend_email'] = isset($data['email']) ? $data['email'] : '';

    header('location: index.php?page=beranda');
    exit();
  } else {
    $_SESSION['login_error'] = 'Username atau Password salah!';
    header('location: index.php?page=login');
    exit();
  }
}

// Redirect to beranda if no page parameter is set
if (!isset($_GET['page'])) {
  header('location: index.php?page=beranda');
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PPLG News | Portal Berita Sekolah</title>

	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/css/be/fontawesome-free/css/all.min.css">
	
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<style>
		:root {
			--primary-color: #000000;
			--primary-light: #dc2626;
			--secondary-color: #991b1b;
			--bg-color: #f3f4f6;
			--text-main: #1f2937;
			--text-muted: #6b7280;
			--white: #ffffff;
			--card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
			--hover-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
		}

		body {
			font-family: 'Inter', sans-serif;
			background-color: var(--bg-color);
			color: var(--text-main);
			line-height: 1.6;
		}

		/* Navbar Styling */
		.navbar {
			background-color: var(--white) !important;
			box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
			padding: 1rem 0;
		}

		.navbar-brand {
			font-weight: 700;
			color: var(--primary-color) !important;
			font-size: 1.25rem;
		}
		
		.navbar-brand:hover {
			color: var(--primary-light) !important;
		}

		.nav-link {
			color: var(--text-main) !important;
			font-weight: 500;
			padding: 0.5rem 1rem !important;
			transition: color 0.2s;
		}

		.nav-link:hover, .nav-link.active {
			color: var(--primary-light) !important;
		}
		
		.dropdown-item:hover {
			background-color: #fee2e2;
			color: var(--primary-light);
		}

		.dropdown-menu {
			border: none;
			box-shadow: var(--hover-shadow);
			border-radius: 0.5rem;
		}

		.dropdown-item {
			padding: 0.5rem 1.5rem;
			font-weight: 500;
		}


		/* Header/Hero Section */
		#header {
			background: linear-gradient(135deg, var(--primary-color) 0%, #1a1a1a 100%);
			color: var(--white);
			padding: 4rem 0;
			margin-bottom: 2rem;
			position: relative;
			overflow: hidden;
		}

		#header::before {
			content: "";
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			bottom: 0;
			background-image: url('assets/img/pattern.png'); /* Optional pattern */
			opacity: 0.1;
		}

		.header-box h3 {
			font-weight: 700;
			font-size: 2.5rem;
			margin-bottom: 0.5rem;
		}

		.header-box p {
			font-size: 1.1rem;
			opacity: 0.9;
		}

		/* Cards Modernization */
		.card {
			border: none;
			border-radius: 0.75rem;
			box-shadow: var(--card-shadow);
			transition: transform 0.2s, box-shadow 0.2s;
			background: var(--white);
			overflow: hidden;
		}

		.card:hover {
			transform: translateY(-2px);
			box-shadow: var(--hover-shadow);
		}

		.card-img-top, .img-thumbnail {
			border-radius: 0.75rem 0.75rem 0 0;
			border: none;
			padding: 0;
		}
		
		.img-thumbnail {
			border-radius: 0.75rem;
			width: 100%;
			height: 200px;
			object-fit: cover;
		}

		.card-body {
			padding: 1.5rem;
		}

		.card-title {
			font-weight: 600;
			color: var(--text-main);
			margin-bottom: 0.75rem;
		}

		.card-title a {
			color: inherit;
			text-decoration: none;
		}

		.card-title a:hover {
			color: var(--primary-light);
		}
		
		.card-title a {
			transition: color 0.2s;
		}

		.text-muted {
			color: #9ca3af !important;
		}

		/* Buttons */
		.btn-primary {
			background-color: var(--primary-light);
			border-color: var(--primary-light);
			padding: 0.5rem 1.25rem;
			border-radius: 0.5rem;
			font-weight: 500;
			color: var(--white);
		}

		.btn-primary:hover {
			background-color: #b91c1c;
			border-color: #b91c1c;
			color: var(--white);
		}
		
		.btn-outline-primary {
			border-color: var(--primary-light);
			color: var(--primary-light);
		}
		
		.btn-outline-primary:hover {
			background-color: var(--primary-light);
			border-color: var(--primary-light);
			color: var(--white);
		}
		
		.btn-outline-light {
			color: var(--primary-color);
			border-color: #e5e7eb;
		}
		
		.btn-outline-light:hover {
			background-color: #f3f4f6;
			color: var(--primary-light);
			border-color: #d1d5db;
		}

		/* Footer */
		#footer {
			background-color: var(--white) !important;
			border-top: 1px solid #e5e7eb;
			padding: 2rem 0;
			margin-top: 4rem;
		}

		#footer p {
			color: var(--text-muted);
			margin: 0;
			font-size: 0.9rem;
		}

		/* Search Bar */
		.form-control {
			border-radius: 0.5rem;
			border: 1px solid #d1d5db;
			padding: 0.5rem 1rem;
		}

		.form-control:focus {
			border-color: var(--primary-light);
			box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
		}
		
		/* Breadcrumb */
		.breadcrumb {
			background: transparent;
			padding: 0;
			margin-bottom: 1.5rem;
		}
		
		.breadcrumb-item a {
			color: var(--primary-light);
			text-decoration: none;
		}
		
		.breadcrumb-item a:hover {
			color: #b91c1c;
		}
		
		.breadcrumb-item.active {
			color: var(--text-muted);
		}

		/* Search styling adjustment for navbar */
		.navbar .form-control {
			background-color: #f3f4f6;
			border: none;
			min-width: 200px;
		}
		
		.navbar .form-control:focus {
			background-color: #fff;
			border: 1px solid var(--primary-light);
		}
		
		/* Override Bootstrap primary colors */
		.bg-primary {
			background-color: var(--primary-color) !important;
		}
		
		.text-primary {
			color: var(--primary-light) !important;
		}
		
		.badge.bg-primary {
			background-color: var(--primary-light) !important;
		}
		
		.border-primary {
			border-color: var(--primary-light) !important;
		}
	</style>
</head>
<body>
	
	<nav class="navbar navbar-expand-lg sticky-top">
	  <div class="container">
	    <a class="navbar-brand d-flex align-items-center" href="index.php">
	    	<img src="assets/img/be/img/logo.png" width="32" height="32" class="me-2">
	    	<span>PPLG News</span>
	    </a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarScroll">
	      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll">
	        <li class="nav-item">
	          <a class="nav-link <?= !isset($_GET['page']) || $_GET['page'] == 'beranda' ? 'active' : '' ?>" href="index.php?page=beranda">Beranda</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'berita' ? 'active' : '' ?>" href="index.php?page=berita">Berita</a>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            Kategori
	          </a>
	          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <?php
             $kat_query = mysqli_query(
               $con,
               'SELECT * FROM tbl_categories ORDER BY nama_kategori ASC',
             );
             while ($kat = mysqli_fetch_array($kat_query)): ?>
	            <li><a class="dropdown-item" href="index.php?page=kategori&id=<?= $kat[
               'id_kategori'
             ] ?>"><?= $kat['nama_kategori'] ?></a></li>
	            <?php endwhile;
             ?>
	          </ul>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link <?= isset($_GET['page']) && $_GET['page'] == 'galeri' ? 'active' : '' ?>" href="index.php?page=galeri">Galeri</a>
	        </li>
	      </ul>
	      
	      <!-- Search Bar -->
	      <form class="d-flex me-3" method="GET" action="index.php">
	        <input type="hidden" name="page" value="search">
	        <input class="form-control me-2" type="search" name="q" placeholder="Cari..." aria-label="Search" value="<?= isset(
           $_GET['q'],
         )
           ? htmlspecialchars($_GET['q'])
           : '' ?>">
	        <button class="btn btn-outline-light" type="submit" style="border: 1px solid #d1d5db; color: #6b7280;">
	          <i class="fas fa-search"></i>
	        </button>
	      </form>

	      <!-- User Menu -->
	      <ul class="navbar-nav">
	        <?php if (isset($_SESSION['frontend_user_id'])): ?>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle btn btn-primary text-white px-3" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 2rem;">
	            <i class="fas fa-user-circle me-1"></i> <?= htmlspecialchars(
               $_SESSION['frontend_nama'],
             ) ?>
	          </a>
	          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
	            <li><a class="dropdown-item" href="index.php?page=profil"><i class="fas fa-user me-2"></i> Profil</a></li>
	            <li><hr class="dropdown-divider"></li>
	            <li><a class="dropdown-item text-danger" href="logout.php"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
	          </ul>
	        </li>
	        <?php else: ?>
	        <li class="nav-item d-flex gap-2">
	          <a class="btn btn-outline-primary btn-sm px-3" href="index.php?page=login">Login</a>
	          <a class="btn btn-primary btn-sm px-3" href="index.php?page=register">Daftar</a>
	        </li>
	        <?php endif; ?>
	      </ul>
	    </div>
	  </div>
	</nav>

	<?php if (
   !isset($_GET['page']) ||
   $_GET['page'] == 'beranda' ||
   $_GET['page'] == ''
 ): ?>
	<header id="header">
		<div class="container text-center">
			<div class="row justify-content-center">
				<div class="col-lg-8">
					<img src="assets/img/be/img/logo.png" class="img-fluid mb-4" width="100" height="100" style="filter: drop-shadow(0 4px 6px rgba(0,0,0,0.1));">
					<div class="header-box">
						<h3>Portal Berita PPLG</h3>
						<p class="lead">"Menuju PPLG yang Informatif dan Kreatif"</p>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php else: ?>
	<div class="container mt-4"></div>
	<?php endif; ?>

	<section id="main-content">
		<div class="container">
			<?php if (
     isset($_GET['page']) &&
     $_GET['page'] != 'beranda' &&
     $_GET['page'] != ''
   ): ?>
			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="index.php?page=beranda"><i class="fas fa-home"></i> Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page"><?= ucfirst(
       $_GET['page'],
     ) ?></li>
			  </ol>
			</nav>
			<?php endif; ?>

			<div class="row">
			<?php
   $page = isset($_GET['page']) ? $_GET['page'] : 'beranda';

   switch ($page) {
     case 'beranda':
       include 'halaman/beranda.php';
       break;

     case 'berita':
       include 'halaman/berita.php';
       break;

     case 'detail':
       include 'halaman/detail-post.php';
       break;

     case 'kategori':
       include 'halaman/kategori.php';
       break;

     case 'search':
       include 'halaman/search.php';
       break;

     case 'login':
       include 'halaman/login.php';
       break;

     case 'register':
       include 'halaman/register.php';
       break;

     case 'profil':
       include 'halaman/profil.php';
       break;

     case 'galeri':
       include 'halaman/galeri.php';
       break;

     default:
       echo '<div class="col-12 text-center py-5">
						<i class="fas fa-exclamation-circle fa-3x text-muted mb-3"></i>
						<h3>Halaman tidak ditemukan</h3>
						<a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
					 </div>';
       break;
   }
   ?>
			</div>
		</div>
	</section>

	<footer id="footer">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 text-center text-md-start">
					<p class="mb-0">&copy; <?= date('Y') ?> <strong>PPLG News</strong>. All Rights Reserved.</p>
				</div>
				<div class="col-md-6 text-center text-md-end mt-3 mt-md-0">
					<div class="social-links">
						<a href="#" class="text-muted me-3"><i class="fab fa-facebook-f"></i></a>
						<a href="#" class="text-muted me-3"><i class="fab fa-twitter"></i></a>
						<a href="#" class="text-muted me-3"><i class="fab fa-instagram"></i></a>
						<a href="#" class="text-muted"><i class="fab fa-youtube"></i></a>
					</div>
				</div>
			</div>
		</div>
	</footer>

	<script src="assets/js/bootstrap.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
