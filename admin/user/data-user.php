<?php

include '../config/config.php';

// Only allow admin to access user management
if ($_SESSION['lvluser'] != 1) {
  echo "<script>alert('Akses Ditolak! Hanya Admin yang dapat mengakses halaman ini.')</script>";
  echo "<script>window.location.href='index.php?page=home'</script>";
  exit;
}

$sql = mysqli_query($con, "SELECT u.*, l.leveluser FROM tbl_users u LEFT JOIN tbl_lvuser l ON u.id_lvuser = l.id_lvuser ORDER BY u.id_user DESC");
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h5>Data User</h5>
			</div>
			<div class="card-body">
				<a href="index.php?page=tambah-user" class="btn btn-primary mb-3">
					<i class="fas fa-plus"></i> Tambah User
				</a>
				<table class="table table-bordered table-striped">
					<thead>
						<tr class="text-center">
							<th>#</th>
							<th>Foto</th>
							<th>Username</th>
							<th>Nama Pengguna</th>
							<th>Level User</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
				<?php
    $no = 1;
    while ($data = mysqli_fetch_array($sql)): ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center">
								<img src="../assets/img/<?= $data['img'] ?>" alt="<?= htmlspecialchars($data['nama_pengguna']) ?>" class="img-circle" style="width: 50px; height: 50px; object-fit: cover;">
							</td>
							<td><?= htmlspecialchars($data['username']) ?></td>
							<td><?= htmlspecialchars($data['nama_pengguna']) ?></td>
							<td class="text-center">
								<?php if ($data['id_lvuser'] == 1) {
          echo "<span class='badge badge-danger'>Admin</span>";
        } elseif ($data['id_lvuser'] == 2) {
          echo "<span class='badge badge-info'>User</span>";
        } else {
          echo "<span class='badge badge-secondary'>-</span>";
        } ?>
							</td>
							<td class="text-center">
								<a href="index.php?page=edit-user&id=<?= $data['id_user'] ?>" class="btn btn-warning btn-sm text-white">
									<i class="fas fa-edit"></i> Edit
								</a>
								<?php if ($data['id_user'] != $_SESSION['id']): ?>
									<a href="index.php?page=hapus-user&id=<?= $data['id_user'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus user <?= htmlspecialchars($data['nama_pengguna']) ?>?')">
										<i class="fas fa-trash"></i> Hapus
									</a>
								<?php else: ?>
									<button class="btn btn-secondary btn-sm" disabled title="Tidak dapat menghapus akun sendiri">
										<i class="fas fa-trash"></i> Hapus
									</button>
								<?php endif; ?>
							</td>
						</tr>
				<?php endwhile;
    ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
