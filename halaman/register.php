<?php
include 'config/config.php';

// Redirect if already logged in
if (isset($_SESSION['frontend_user_id'])) {
  echo "<script>window.location.href='index.php?page=beranda';</script>";
  exit();
}

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($con, $_POST['username']);
  $password = md5($_POST['password']);
  $nama_pengguna = mysqli_real_escape_string($con, $_POST['nama_pengguna']);

  // Check if username already exists
  $check_user = mysqli_query($con, "SELECT * FROM tbl_users WHERE username='$username'");
  if (mysqli_num_rows($check_user) > 0) {
    $error = 'Username sudah digunakan!';
  } else {
    // Insert new user with level 2 (regular user)
    // Note: email column doesn't exist in tbl_users table, so we don't save it
    $sql = mysqli_query($con, "INSERT INTO tbl_users (username, password, nama_pengguna, img, id_lvuser) VALUES ('$username', '$password', '$nama_pengguna', 'avatar2.png', 2)");

    if ($sql) {
      $success = 'Registrasi berhasil! Silakan login.';
    } else {
      $error = 'Gagal mendaftar. Silakan coba lagi.';
    }
  }
}
?>

<div class="col-lg-6 offset-lg-3 mt-4">
	<div class="card shadow-lg border-0 rounded-lg">
		<div class="card-header text-white text-center py-4 rounded-top" style="background-color: #000000;">
			<h4 class="mb-0 fw-bold">Daftar Akun Baru</h4>
			<p class="mb-0 small text-white-50">Bergabung dengan komunitas PPLG</p>
		</div>
		<div class="card-body p-4">
			<?php if (isset($error)): ?>
				<div class="alert alert-danger d-flex align-items-center">
					<i class="fas fa-exclamation-triangle me-2"></i>
					<div><?= $error ?></div>
				</div>
			<?php endif; ?>

			<?php if (isset($success)): ?>
				<div class="text-center py-5">
					<div class="mb-4 text-success">
						<i class="fas fa-check-circle fa-4x"></i>
					</div>
					<h4 class="text-success mb-3">Registrasi Berhasil!</h4>
					<p class="text-muted mb-4"><?= $success ?></p>
					<a href="index.php?page=login" class="btn btn-primary px-5">Login Sekarang</a>
				</div>
			<?php else: ?>
				<form method="POST" class="row g-3">
					<div class="col-md-12">
						<label for="nama_pengguna" class="form-label">Nama Lengkap</label>
						<input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required placeholder="Contoh: Budi Santoso">
					</div>
					
					<div class="col-md-6">
						<label for="username" class="form-label">Username</label>
						<input type="text" class="form-control" id="username" name="username" required placeholder="Username unik">
					</div>
					
					<!-- Email field removed - not stored in database -->
					
					<div class="col-md-6">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" required minlength="6" placeholder="Minimal 6 karakter">
					</div>
					
					<div class="col-md-6">
						<label for="password_confirm" class="form-label">Konfirmasi Password</label>
						<input type="password" class="form-control" id="password_confirm" name="password_confirm" required placeholder="Ulangi password">
					</div>
					
					<div class="col-12 mt-4">
						<button type="submit" name="submit" class="btn w-100 py-2 fw-bold text-white" style="background-color: #dc2626; border-color: #dc2626;">
							<i class="fas fa-user-plus me-2"></i> Daftar Sekarang
						</button>
					</div>
				</form>
				
				<div class="text-center mt-4 pt-3 border-top">
					<p class="mb-0 text-muted">Sudah punya akun?</p>
					<a href="index.php?page=login" class="text-decoration-none fw-bold">Login di sini</a>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<script>
	// Password confirmation validation
	document.getElementById('password_confirm')?.addEventListener('input', function() {
		var password = document.getElementById('password').value;
		var passwordConfirm = this.value;
		
		if(password !== passwordConfirm) {
			this.setCustomValidity('Password tidak cocok');
		} else {
			this.setCustomValidity('');
		}
	});
</script>
