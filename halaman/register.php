<?php 

	include "config/config.php";
	// session_start();

	// Redirect if already logged in
	if(isset($_SESSION['frontend_user_id'])) {
		header("location: index.php?page=beranda");
		exit;
	}

	if(isset($_POST['submit'])) {
		$username = mysqli_real_escape_string($con, $_POST['username']);
		$password = md5($_POST['password']);
		$nama_pengguna = mysqli_real_escape_string($con, $_POST['nama_pengguna']);
		$email = mysqli_real_escape_string($con, $_POST['email']);

		// Check if username already exists
		$check_user = mysqli_query($con, "SELECT * FROM tbl_users WHERE username='$username'");
		if(mysqli_num_rows($check_user) > 0) {
			$error = "Username sudah digunakan!";
		} else {
			// Check if email already exists (if email field exists)
			if(!empty($email)) {
				$check_email = mysqli_query($con, "SELECT * FROM tbl_users WHERE email='$email'");
				if(mysqli_num_rows($check_email) > 0) {
					$error = "Email sudah digunakan!";
				}
			}

			if(!isset($error)) {
				// Insert new user with level 2 (regular user)
				$sql = mysqli_query($con, "INSERT INTO tbl_users (username, password, nama_pengguna, img, id_lvuser) VALUES ('$username', '$password', '$nama_pengguna', 'avatar2.png', 2)");
				
				if($sql) {
					$success = "Registrasi berhasil! Silakan login.";
				} else {
					$error = "Gagal mendaftar. Silakan coba lagi.";
				}
			}
		}
	}

 ?>

<div class="col-lg-6 offset-lg-3">
	<div class="card">
		<div class="card-header bg-success text-white">
			<h4 class="mb-0 text-center">Daftar Akun Baru</h4>
		</div>
		<div class="card-body">
			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?= $error ?>
				</div>
			<?php endif; ?>

			<?php if(isset($success)): ?>
				<div class="alert alert-success">
					<?= $success ?>
					<br>
					<a href="index.php?page=login" class="btn btn-primary btn-sm mt-2">Login Sekarang</a>
				</div>
			<?php else: ?>
				<form method="POST">
					<div class="mb-3">
						<label for="nama_pengguna" class="form-label">Nama Lengkap</label>
						<input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" required>
					</div>
					<div class="mb-3">
						<label for="username" class="form-label">Username</label>
						<input type="text" class="form-control" id="username" name="username" required>
						<small class="form-text text-muted">Username harus unik</small>
					</div>
					<div class="mb-3">
						<label for="email" class="form-label">Email (Opsional)</label>
						<input type="email" class="form-control" id="email" name="email">
					</div>
					<div class="mb-3">
						<label for="password" class="form-label">Password</label>
						<input type="password" class="form-control" id="password" name="password" required minlength="6">
						<small class="form-text text-muted">Minimal 6 karakter</small>
					</div>
					<div class="mb-3">
						<label for="password_confirm" class="form-label">Konfirmasi Password</label>
						<input type="password" class="form-control" id="password_confirm" name="password_confirm" required>
					</div>
					<div class="d-grid">
						<button type="submit" name="submit" class="btn btn-success">Daftar</button>
					</div>
				</form>
				<hr>
				<p class="text-center mb-0">
					Sudah punya akun? <a href="index.php?page=login">Login di sini</a>
				</p>
			<?php endif; ?>
		</div>
	</div>
</div>

<script>
	// Password confirmation validation
	document.getElementById('password_confirm').addEventListener('input', function() {
		var password = document.getElementById('password').value;
		var passwordConfirm = this.value;
		
		if(password !== passwordConfirm) {
			this.setCustomValidity('Password tidak cocok');
		} else {
			this.setCustomValidity('');
		}
	});
</script>
