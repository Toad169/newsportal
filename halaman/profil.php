<?php
include 'config/config.php';

// Check if user is logged in
if (!isset($_SESSION['frontend_user_id'])) {
  echo "<script>window.location.href='index.php?page=login';</script>";
  exit();
}

$user_id = $_SESSION['frontend_user_id'];
$user_query = mysqli_query($con, "SELECT * FROM tbl_users WHERE id_user='$user_id'");
$user_data = mysqli_fetch_array($user_query);

if (isset($_POST['update'])) {
  $nama_pengguna = mysqli_real_escape_string($con, $_POST['nama_pengguna']);

  // Note: email column doesn't exist in tbl_users table, so we only update nama_pengguna
  $update_sql = mysqli_query($con, "UPDATE tbl_users SET nama_pengguna='$nama_pengguna' WHERE id_user='$user_id'");

  if ($update_sql) {
    $_SESSION['frontend_nama'] = $nama_pengguna;
    $success = 'Profil berhasil diperbarui!';
    // Refresh user data
    $user_query = mysqli_query($con, "SELECT * FROM tbl_users WHERE id_user='$user_id'");
    $user_data = mysqli_fetch_array($user_query);
  } else {
    $error = 'Gagal memperbarui profil!';
  }
}
?>

<div class="col-lg-8 offset-lg-2 mt-4">
	<div class="card shadow border-0">
		<div class="card-header bg-white border-bottom py-3">
			<h5 class="mb-0 fw-bold" style="color: #dc2626;"><i class="fas fa-user-cog me-2"></i> Pengaturan Profil</h5>
		</div>
		<div class="card-body p-4">
			<?php if (isset($success)): ?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<i class="fas fa-check-circle me-2"></i> <?= $success ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<?php if (isset($error)): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<i class="fas fa-exclamation-circle me-2"></i> <?= $error ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

			<div class="row">
				<div class="col-md-4 text-center mb-4 mb-md-0">
					<div class="profile-img-container mb-3">
						<img src="assets/img/avatar2.png" alt="Profile" class="rounded-circle img-thumbnail bg-light" style="width: 150px; height: 150px;">
					</div>
					<h5 class="fw-bold"><?= htmlspecialchars($user_data['nama_pengguna']) ?></h5>
					<p class="text-muted small">Anggota</p>
				</div>
				<div class="col-md-8">
					<form method="POST">
						<div class="mb-3">
							<label for="username" class="form-label text-muted small text-uppercase fw-bold">Username</label>
							<div class="input-group">
								<span class="input-group-text bg-light"><i class="fas fa-at"></i></span>
								<input type="text" class="form-control bg-light" id="username" value="<?= htmlspecialchars($user_data['username']) ?>" disabled>
							</div>
							<div class="form-text">Username tidak dapat diubah.</div>
						</div>
						
						<div class="mb-3">
							<label for="nama_pengguna" class="form-label text-muted small text-uppercase fw-bold">Nama Lengkap</label>
							<div class="input-group">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
								<input type="text" class="form-control" id="nama_pengguna" name="nama_pengguna" value="<?= htmlspecialchars($user_data['nama_pengguna']) ?>" required>
							</div>
						</div>
						
						<!-- Email field removed - not stored in database -->
						
						<div class="d-flex justify-content-end">
							<button type="submit" name="update" class="btn btn-primary px-4">
								<i class="fas fa-save me-2"></i> Simpan Perubahan
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
