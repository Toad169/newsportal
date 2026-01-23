<?php 

	include "config/config.php";
	// session_start();

	// Check if user is logged in
	if(!isset($_SESSION['frontend_user_id'])) {
		header("location: index.php?page=login");
		exit;
	}

	$user_id = $_SESSION['frontend_user_id'];
	$user_query = mysqli_query($con, "SELECT * FROM tbl_users WHERE id_user='$user_id'");
	$user_data = mysqli_fetch_array($user_query);

	if(isset($_POST['update'])) {
		$nama_pengguna = mysqli_real_escape_string($con, $_POST['nama_pengguna']);
		$email = mysqli_real_escape_string($con, $_POST['email']);

		$update_sql = mysqli_query($con, "UPDATE tbl_users SET nama_pengguna='$nama_pengguna' WHERE id_user='$user_id'");
		
		if($update_sql) {
			$_SESSION['frontend_nama'] = $nama_pengguna;
			$success = "Profil berhasil diupdate!";
			// Refresh user data
			$user_query = mysqli_query($con, "SELECT * FROM tbl_users WHERE id_user='$user_id'");
			$user_data = mysqli_fetch_array($user_query);
		} else {
			$error = "Gagal mengupdate profil!";
		}
	}

 ?>

<div class="col-lg-8 offset-lg-2">
	<div class="card">
		<div class="card-header bg-info text-white">
			<h4 class="mb-0">Profil Saya</h4>
		</div>
		<div class="card-body">
			<?php if(isset($success)): ?>
				<div class="alert alert-success">
					<?= $success ?>
				</div>
			<?php endif; ?>

			<?php if(isset($error)): ?>
				<div class="alert alert-danger">
					<?= $error ?>
				</div>
			<?php endif; ?>

			<form method="POST">
				<div class="mb-3">
					<label for="username" class="form-label">Username</label>
					<input type="text" class="form-control" id="username" value="<?= htmlspecialchars($user_data['username']) ?>" disabled>
					<small class="form-text text-muted">Username tidak dapat diubah</small>
				</div>
				<div class="mb-3">
					<label for="nama_pengguna" class="form-label">Nama Lengkap</label>
					<input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?= htmlspecialchars($user_data['nama_pengguna']) ?>" required>
				</div>
				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" id="email" name="email" value="<?= isset($user_data['email']) ? htmlspecialchars($user_data['email']) : '' ?>">
				</div>
				<div class="d-grid">
					<button type="submit" name="update" class="btn btn-primary">Update Profil</button>
				</div>
			</form>
		</div>
	</div>
</div>
