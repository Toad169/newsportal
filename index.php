<?php 
session_start();
include "config/config.php";

// Handle login form submission BEFORE any HTML output
if(isset($_POST['submit']) && isset($_GET['page']) && $_GET['page'] == 'login') {
	$username = mysqli_real_escape_string($con, $_POST['username']);
	$password = md5($_POST['password']);

	$sql = mysqli_query($con, "SELECT * FROM tbl_users WHERE username='$username' AND password='$password' AND id_lvuser=2");
	$cek = mysqli_num_rows($sql);

	if($cek > 0) {
		$data = mysqli_fetch_array($sql);
		
		$_SESSION['frontend_user_id'] = $data['id_user'];
		$_SESSION['frontend_username'] = $data['username'];
		$_SESSION['frontend_nama'] = $data['nama_pengguna'];
		$_SESSION['frontend_email'] = isset($data['email']) ? $data['email'] : '';
		
		header("location: index.php?page=beranda");
		exit;
	} else {
		$_SESSION['login_error'] = "Username atau Password salah!";
		header("location: index.php?page=login");
		exit;
	}
}

// Redirect to beranda if no page parameter is set
if(!isset($_GET['page'])) {
	header("location: index.php?page=beranda");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PPLG News</title>

	<link rel="stylesheet" href="assets/css/bootstrap-grid.css">
	<link rel="stylesheet" href="assets/css/bootstrap-reboot.css">
	<link rel="stylesheet" href="assets/css/bootstrap-utilities.css">
	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/ionicons.min.css">
	<link rel="stylesheet" href="assets/css/style.css">

	<style>
		ul .dropdown-menu {
			background-color: #212529;
		}

		li .dropdown-item:hover {
			background-color:rgb(25, 28, 31);
		}
	</style>
</head>
<body>
	
	<nav class="navbar navbar-expand-lg navbar-light bg-dark p-2">
	  <div class="container-fluid">
	    <a class="navbar-brand d-flex align-items-center" href="#">
	    	<img src="assets/img/logo-sidoarjo.png" width="30" height="24">
	    	&nbsp; <span>PPLG News</span>
	    </a>
	    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
	      <span class="navbar-toggler-icon"></span>
	    </button>
	    <div class="collapse navbar-collapse" id="navbarScroll">
	      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
	        <li class="nav-item">
	          <a class="nav-link active" aria-current="page" href="index.php?page=beranda">Beranda</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="index.php?page=berita">Berita</a>
	        </li>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            Kategori
	          </a>
	          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
	            <?php 
	              if(!isset($con)) {
	                include "config/config.php";
	              }
	              $kat_query = mysqli_query($con, "SELECT * FROM tbl_categories ORDER BY nama_kategori ASC");
	              while($kat = mysqli_fetch_array($kat_query)):
	            ?>
	            <li><a class="dropdown-item" href="index.php?page=kategori&id=<?= $kat['id_kategori'] ?>"><?= $kat['nama_kategori'] ?></a></li>
	            <?php endwhile; ?>
	          </ul>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link" href="index.php?page=galeri">Galeri</a>
	        </li>
	      </ul>
	      <!-- Search Bar -->
	      <form class="d-flex me-2" method="GET" action="index.php">
	        <input type="hidden" name="page" value="search">
	        <input class="form-control me-2" type="search" name="q" placeholder="Cari berita..." aria-label="Search" value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
	        <button class="btn btn-outline-light" type="submit">
	          <i class="ion-search"></i>
	        </button>
	      </form>
	      <!-- User Menu -->
	      <ul class="navbar-nav">
	        <?php 
	          if(isset($_SESSION['frontend_user_id'])):
	        ?>
	        <li class="nav-item dropdown">
	          <a class="nav-link dropdown-toggle text-white" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
	            <i class="ion-person"></i> <?= htmlspecialchars($_SESSION['frontend_nama']) ?>
	          </a>
	          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
	            <li><a class="dropdown-item" href="index.php?page=profil">Profil</a></li>
	            <li><hr class="dropdown-divider"></li>
	            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
	          </ul>
	        </li>
	        <?php else: ?>
	        <li class="nav-item">
	          <a class="nav-link text-white" href="index.php?page=login">Login</a>
	        </li>
	        <li class="nav-item">
	          <a class="nav-link text-white" href="index.php?page=register">Daftar</a>
	        </li>
	        <?php endif; ?>
	      </ul>
	    </div>
	  </div>
	</nav>
	<header id="header">
		<div class="d-flex align-items-center p-3">
			<div class="container header-box mt-3">
				<div class="row">
					<div class="col-md-12 text-center">
						<img src="assets/img/logo-sidoarjo.png" class="img-fluid">
						<h3 class="mt-2">Website PPLG News</h3>
						<p>"Menuju PPLG dan News"</p>
						<!-- <br><center><p>Repost by <a href='https://stokcoding.com/' title='StokCoding.com' target='_blank'>StokCoding.com</a></p></center> -->
						
					</div>
				</div>
			</div>
		</div>
	</header>

	<section id="sec-article" class="mt-3">
		

		<div class="container">

			<nav aria-label="breadcrumb">
			  <ol class="breadcrumb">
			    <li class="breadcrumb-item"><a href="index.php?page=beranda">Home</a></li>
			    <li class="breadcrumb-item active" aria-current="page"><?= isset($_GET['page']) ? ucfirst($_GET['page']) : 'Beranda' ?></li>
			  </ol>
			</nav>

			<div class="row mt-3">
			<?php 

				$page = $_GET['page'];

				switch ($page) {
					case 'beranda':
						include "halaman/beranda.php";
						break;

					case 'berita':
						include "halaman/berita.php";
						break;

					case 'detail':
						include "halaman/detail-post.php";
						break;

					case 'kategori':
						include "halaman/kategori.php";
						break;

					case 'search':
						include "halaman/search.php";
						break;

					case 'login':
						include "halaman/login.php";
						break;

					case 'register':
						include "halaman/register.php";
						break;

					case 'profil':
						include "halaman/profil.php";
						break;

					case 'galeri':
						include "halaman/galeri.php";
						break;

					default:
						echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
						break;
				}

			 ?>

	</section>

	<footer id="footer" class="mt-5 p-3 bg-dark">
		<div class="container text-center">
			<p class="text-white">&copy;&nbsp; Copyright By PPLG News
			</p>
		</div>
	</footer>



	<script src="assets/js/bootstrap.js"></script>

</body>
</html>