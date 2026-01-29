<?php

include '../config/config.php';

// Only allow admin to access user management
if ($_SESSION['lvluser'] != 1) {
  echo "<script>alert('Akses Ditolak! Hanya Admin yang dapat mengakses halaman ini.')</script>";
  echo "<script>window.location.href='index.php?page=home'</script>";
  exit;
}

$id = intval($_GET['id']); // Sanitize input

// Get user data
$sql = mysqli_query($con, "SELECT * FROM tbl_users WHERE id_user='$id'");
$data = mysqli_fetch_array($sql);

if (!$data) {
  echo "<script>alert('User tidak ditemukan!')</script>";
  echo "<script>window.location.href='index.php?page=data-user'</script>";
  exit;
}

// Get user levels for dropdown
$sql_level = mysqli_query($con, "SELECT * FROM tbl_lvuser");
?>
<div class="row">
	<div class="col-lg-10 m-auto">
		<div class="card card-primary">
			<div class="card-header">
				<h5>Edit User</h5>
			</div>
			<div class="card-body">
				<form method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-12 text-center mb-3">
							<img src="../assets/img/<?= $data['img'] ?>" alt="<?= htmlspecialchars($data['nama_pengguna']) ?>" class="img-circle" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #ddd;">
							<p class="mt-2"><strong>Foto Saat Ini</strong></p>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="user">Username</label>
								<input type="text" name="user" id="user" class="form-control" placeholder="Masukkan Username" value="<?= htmlspecialchars($data['username']) ?>" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="pass">Password</label>
								<input type="password" name="pass" id="pass" class="form-control" placeholder="Kosongkan jika tidak ingin mengubah password">
								<small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="pengguna">Nama Pengguna</label>
								<input type="text" name="pengguna" id="pengguna" class="form-control" placeholder="Masukkan Nama Pengguna" value="<?= htmlspecialchars($data['nama_pengguna']) ?>" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="file">Unggah Gambar Baru</label>
								<input type="file" name="file" id="file" class="form-control" accept="image/png,image/jpeg,image/jpg">
								<small class="text-muted">Format: PNG, JPG, JPEG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto</small>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="lvluser">Level User</label>
								<select name="lvluser" id="lvluser" class="form-control" required>
									<option value="">Pilih Level User</option>
									<?php 
									mysqli_data_seek($sql_level, 0); // Reset pointer
									while ($level = mysqli_fetch_array($sql_level)): 
										$selected = ($data['id_lvuser'] == $level['id_lvuser']) ? 'selected' : '';
									?>
										<option value="<?= $level['id_lvuser'] ?>" <?= $selected ?>><?= htmlspecialchars($level['leveluser']) ?></option>
									<?php endwhile; ?>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<button name="submit" class="btn btn-primary btn-block">
								<i class="fas fa-save"></i> Update User
							</button>
							<a href="index.php?page=data-user" class="btn btn-secondary btn-block">
								<i class="fas fa-arrow-left"></i> Kembali
							</a>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php if (isset($_POST['submit'])) {
  $id = intval($_GET['id']); // Sanitize input
  $user = mysqli_real_escape_string($con, $_POST['user']);
  $pass = $_POST['pass'];
  $pengguna = mysqli_real_escape_string($con, $_POST['pengguna']);
  $lvluser = $_POST['lvluser'];

  // Check if username already exists (excluding current user)
  $check_user = mysqli_query($con, "SELECT * FROM tbl_users WHERE username='$user' AND id_user != '$id'");
  if (mysqli_num_rows($check_user) > 0) {
    echo "<script>alert('Username sudah digunakan! Silakan gunakan username lain.')</script>";
    echo "<script>window.location.href='index.php?page=edit-user&id=$id'</script>";
    exit;
  }

  // Get current user data
  $sql_current = mysqli_query($con, "SELECT * FROM tbl_users WHERE id_user='$id'");
  $data_current = mysqli_fetch_array($sql_current);
  $gambar = $data_current['img']; // Keep current image by default

  // Handle image upload if new image is provided
  $ekstensi_boleh = ['png', 'jpg', 'jpeg'];
  
  if (!empty($_FILES['file']['name'])) {
    $gambar_new = $_FILES['file']['name'];
    $ex = explode('.', $gambar_new);
    $ekstensi = strtolower(end($ex));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_boleh) === true) {
      if ($ukuran < 2000000) {
        // Generate unique filename
        $gambar = time() . '_' . $gambar_new;
        move_uploaded_file($file_tmp, '../assets/img/' . $gambar);
      } else {
        echo "<script>alert('Ukuran file tidak boleh lebih dari 2MB!')</script>";
        echo "<script>window.location.href='index.php?page=edit-user&id=$id'</script>";
        exit;
      }
    } else {
      echo "<script>alert('Ekstensi file tidak diizinkan! Hanya PNG, JPG, JPEG.')</script>";
      echo "<script>window.location.href='index.php?page=edit-user&id=$id'</script>";
      exit;
    }
  }

  // Build update query
  if (!empty($pass)) {
    $pass_hash = md5($pass);
    $sql = mysqli_query(
      $con,
      "UPDATE tbl_users SET username='$user', password='$pass_hash', nama_pengguna='$pengguna', img='$gambar', id_lvuser='$lvluser' WHERE id_user='$id'"
    );
  } else {
    $sql = mysqli_query(
      $con,
      "UPDATE tbl_users SET username='$user', nama_pengguna='$pengguna', img='$gambar', id_lvuser='$lvluser' WHERE id_user='$id'"
    );
  }

  if ($sql) {
    echo "<script>alert('User Berhasil Diupdate!')</script>";
    echo "<script>window.location.href='index.php?page=data-user'</script>";
  } else {
    echo "<script>alert('Gagal mengupdate user!')</script>";
    echo "<script>window.location.href='index.php?page=edit-user&id=$id'</script>";
  }
}
?>
