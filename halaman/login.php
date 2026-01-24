<?php
include 'config/config.php';

// Redirect if already logged in
if (isset($_SESSION['frontend_user_id'])) {
  echo "<script>window.location.href='index.php?page=beranda';</script>";
  exit();
}

$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
unset($_SESSION['login_error']);
?>

<div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 mt-5">
	<div class="card shadow-lg border-0 rounded-lg">
		<div class="card-header text-white text-center py-4 rounded-top" style="background-color: #000000;">
			<h4 class="mb-0 fw-bold">Login Siswa</h4>
			<p class="mb-0 small text-white-50">Masuk ke Portal Berita PPLG</p>
		</div>
		<div class="card-body p-4">
			<?php if (!empty($error)): ?>
				<div class="alert alert-danger d-flex align-items-center" role="alert">
					<i class="fas fa-exclamation-circle me-2"></i>
					<div><?= $error ?></div>
				</div>
			<?php endif; ?>

			<form method="POST" action="index.php?page=login">
				<div class="form-floating mb-3">
					<input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
					<label for="username">Username</label>
				</div>
				<div class="form-floating mb-4">
					<input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
					<label for="password">Password</label>
				</div>
				<div class="d-grid gap-2">
					<button type="submit" name="submit" class="btn btn-primary btn-lg fw-bold">
						<i class="fas fa-sign-in-alt me-2"></i> Masuk
					</button>
				</div>
			</form>
			
			<div class="text-center mt-4 pt-3 border-top">
				<p class="mb-0 text-muted">Belum punya akun?</p>
				<a href="index.php?page=register" class="text-decoration-none fw-bold">Daftar sekarang</a>
			</div>
		</div>
	</div>
</div>
