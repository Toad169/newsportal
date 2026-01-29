<?php

include '../config/config.php';

// Only allow admin to access user management
if ($_SESSION['lvluser'] != 1) {
  echo "<script>alert('Akses Ditolak! Hanya Admin yang dapat mengakses halaman ini.')</script>";
  echo "<script>window.location.href='index.php?page=home'</script>";
  exit;
}

// Get user levels for dropdown
$sql_level = mysqli_query($con, "SELECT * FROM tbl_lvuser");
?>
<div class="row">
	<div class="col-lg-10 m-auto">
		<div class="card card-primary">
			<div class="card-header">
				<h5>Tambah User</h5>
			</div>
			<div class="card-body">
				<form method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-lg-6">
							<div class="form-group">
								<label for="user">Username</label>
								<input type="text" name="user" id="user" class="form-control" placeholder="Masukkan Username" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="pass">Password</label>
								<input type="password" name="pass" id="pass" class="form-control" placeholder="Masukkan Password" required>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<label for="pengguna">Nama Pengguna</label>
								<input type="text" name="pengguna" id="pengguna" class="form-control" placeholder="Masukkan Nama Pengguna" required>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="file">Unggah Gambar</label>
								<input type="file" name="file" id="file" class="form-control" accept="image/png,image/jpeg,image/jpg">
								<small class="text-muted">Format: PNG, JPG, JPEG. Maksimal 2MB</small>
							</div>
						</div>
						<div class="col-lg-6">
							<div class="form-group">
								<label for="lvluser">Level User</label>
								<select name="lvluser" id="lvluser" class="form-control" required>
									<option value="">Pilih Level User</option>
									<?php while ($level = mysqli_fetch_array($sql_level)): ?>
										<option value="<?= $level['id_lvuser'] ?>"><?= htmlspecialchars($level['leveluser']) ?></option>
									<?php endwhile; ?>
								</select>
							</div>
						</div>
						<div class="col-lg-12">
							<button name="submit" class="btn btn-primary btn-block">
								<i class="fas fa-save"></i> Tambah User
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
  $user = mysqli_real_escape_string($con, $_POST['user']);
  $pass = md5($_POST['pass']);
  $pengguna = mysqli_real_escape_string($con, $_POST['pengguna']);
  $lvluser = $_POST['lvluser'];

  // Check if username already exists
  $check_user = mysqli_query($con, "SELECT * FROM tbl_users WHERE username='$user'");
  if (mysqli_num_rows($check_user) > 0) {
    echo "<script>alert('Username sudah digunakan! Silakan gunakan username lain.')</script>";
    echo "<script>window.location.href='index.php?page=tambah-user'</script>";
    exit;
  }

  // Handle image upload
  $gambar = 'avatar2.png'; // Default avatar
  $ekstensi_boleh = ['png', 'jpg', 'jpeg'];
  
  if (!empty($_FILES['file']['name'])) {
    $gambar = $_FILES['file']['name'];
    $ex = explode('.', $gambar);
    $ekstensi = strtolower(end($ex));
    $ukuran = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_boleh) === true) {
      if ($ukuran < 2000000) {
        // Generate unique filename
        $gambar = time() . '_' . $gambar;
        move_uploaded_file($file_tmp, '../assets/img/' . $gambar);
      } else {
        echo "<script>alert('Ukuran file tidak boleh lebih dari 2MB!')</script>";
        echo "<script>window.location.href='index.php?page=tambah-user'</script>";
        exit;
      }
    } else {
      echo "<script>alert('Ekstensi file tidak diizinkan! Hanya PNG, JPG, JPEG.')</script>";
      echo "<script>window.location.href='index.php?page=tambah-user'</script>";
      exit;
    }
  }

  $sql = mysqli_query(
    $con,
    "INSERT INTO tbl_users (username, password, nama_pengguna, img, id_lvuser) VALUES ('$user', '$pass', '$pengguna', '$gambar', '$lvluser')"
  );

  if ($sql) {
    echo "<script>alert('User Berhasil Ditambahkan!')</script>";
    echo "<script>window.location.href='index.php?page=data-user'</script>";
  } else {
    echo "<script>alert('Gagal menambahkan user!')</script>";
    echo "<script>window.location.href='index.php?page=tambah-user'</script>";
  }
}
?>
