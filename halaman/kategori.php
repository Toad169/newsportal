<?php 

	include "config/config.php";
	// session_start();

	$kategori_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

	if($kategori_id > 0) {
		// Get category info
		$kat_info = mysqli_query($con, "SELECT * FROM tbl_categories WHERE id_kategori='$kategori_id'");
		$kat_data = mysqli_fetch_array($kat_info);

		if($kat_data) {
			$kategori_nama = $kat_data['nama_kategori'];
			$query = mysqli_query($con, "SELECT * FROM tbl_posts WHERE id_kategori='$kategori_id' ORDER BY date DESC");
		} else {
			$kategori_nama = "Kategori Tidak Ditemukan";
			$query = null;
		}
	} else {
		$kategori_nama = "Semua Kategori";
		$query = mysqli_query($con, "SELECT * FROM tbl_posts ORDER BY date DESC");
	}

 ?>

<div class="col-lg-12">
	<h3>Kategori: <?= htmlspecialchars($kategori_nama) ?></h3>
	<hr>

	<?php if($query && mysqli_num_rows($query) > 0): ?>
		<div class="row">
			<?php foreach($query as $data): ?>
				<div class="col-md-4 col-xs-12 mt-3">
					<div class="card h-100">
						<img src="assets/file/post/<?= $data['img'] ?>" class="card-img-top" alt="<?= htmlspecialchars($data['judul']) ?>" style="height: 200px; object-fit: cover;">
						<div class="card-body">
							<h5 class="card-title" style="height: 60px; overflow: hidden;">
								<a href="index.php?page=detail&id=<?= $data['id_post'] ?>" class="text-decoration-none">
									<?= htmlspecialchars($data['judul']) ?>
								</a>
							</h5>
							<p class="card-text">
								<small class="text-muted">
									<i class="ion-calendar"></i> <?= $data['date'] ?> &nbsp;&nbsp;
									<i class="ion-person"></i> <?= htmlspecialchars($data['author']) ?>
								</small>
							</p>
							<p class="card-text"><?= substr(htmlspecialchars($data['artikel']), 0, 100) ?>...</p>
							<a href="index.php?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	<?php else: ?>
		<div class="alert alert-info">
			<p class="mb-0">Belum ada postingan dalam kategori ini.</p>
		</div>
	<?php endif; ?>
</div>
