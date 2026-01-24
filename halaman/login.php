<?php 

	// Redirect if already logged in (using JavaScript since headers already sent)
	if(isset($_SESSION['frontend_user_id'])) {
		echo "<script>window.location.href='index.php?page=beranda';</script>";
		exit;
	}

	// Get error message from session if exists
	$error = isset($_SESSION['login_error']) ? $_SESSION['login_error'] : '';
	unset($_SESSION['login_error']); // Clear error after displaying

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

			<form method="POST" action="index.php?page=login">
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
