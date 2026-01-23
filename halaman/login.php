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

		$sql = mysqli_query($con, "SELECT * FROM tbl_users WHERE username='$username' AND password='$password' AND id_lvuser=2");
		$cek = mysqli_num_rows($sql);

		if($cek > 0) {
			$data = mysqli_fetch_array($sql);
			
			$_SESSION['frontend_user_id'] = $data['id_user'];
			$_SESSION['frontend_username'] = $data['username'];
			$_SESSION['frontend_nama'] = $data['nama_pengguna'];
			$_SESSION['frontend_email'] = isset($data['email']) ? $data['email'] : '';
			
			header("location: index.php?page=beranda");
		} else {
			$error = "Username atau Password salah!";
		}
	}

 ?>

<div class="col-lg-6 offset-lg-3">
	<div class="card">
		<div class="card-header bg-primary text-white">
			<h4 class="mb-0 text-center">Login</h4>
		</div>
		<div class="card-body">
			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?= $error ?>
				</div>
			<?php endif; ?>

			<form method="POST">
				<div class="mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" class="form-control" id="username" name="username" required>
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Password</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<div class="d-grid">
					<button type="submit" name="submit" class="btn btn-primary">Login</button>
				</div>
			</form>
			<hr>
			<p class="text-center mb-0">
				Belum punya akun? <a href="index.php?page=register">Daftar di sini</a>
			</p>
		</div>
	</div>
</div>
