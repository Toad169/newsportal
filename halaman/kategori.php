<?php
include 'config/config.php';

$kategori_id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$kategori_nama = 'Semua Kategori';

if ($kategori_id > 0) {
  $kat_info = mysqli_query($con, "SELECT * FROM tbl_categories WHERE id_kategori='$kategori_id'");
  $kat_data = mysqli_fetch_array($kat_info);

  if ($kat_data) {
    $kategori_nama = $kat_data['nama_kategori'];
    $query = mysqli_query($con, "SELECT * FROM tbl_posts WHERE id_kategori='$kategori_id' ORDER BY date DESC");
  } else {
    $kategori_nama = 'Kategori Tidak Ditemukan';
    $query = null;
  }
} else {
  $query = mysqli_query($con, 'SELECT * FROM tbl_posts ORDER BY date DESC');
}
?>

<div class="col-12 mb-4">
	<h4 class="mb-3 border-bottom pb-2" style="border-bottom: 2px solid #4988C4 !important; display: inline-block; color: #4988C4;">
		<i class="fas fa-tag me-2"></i> Kategori: <?= htmlspecialchars($kategori_nama) ?>
	</h4>
</div>

<?php if ($query && mysqli_num_rows($query) > 0): ?>
	<?php foreach ($query as $data): ?>
		<div class="col-md-4 col-sm-6 mb-4">
			<div class="card h-100">
				<div class="position-relative">
					<img src="assets/file/post/<?= $data['img'] ?>" alt="<?= htmlspecialchars($data['judul']) ?>" class="card-img-top" style="height: 220px; object-fit: cover;">
				</div>
				<div class="card-body d-flex flex-column">
					<div class="mb-2 text-muted small">
						<i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($data['date'])) ?>
						<span class="mx-1">•</span>
						<i class="far fa-user me-1"></i> <?= htmlspecialchars($data['author']) ?>
					</div>
					<h5 class="card-title">
						<a href="index.php?page=detail&id=<?= $data['id_post'] ?>" class="text-decoration-none text-dark stretched-link">
							<?= htmlspecialchars($data['judul']) ?>
						</a>
					</h5>
					<p class="card-text text-muted mb-4 flex-grow-1">
						<?= htmlspecialchars(substr(strip_tags($data['artikel']), 0, 100)) ?>...
					</p>
					<div class="mt-auto">
						<a href="index.php?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-outline-primary btn-sm w-100">
							Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php endforeach; ?>
<?php else: ?>
	<div class="col-12 text-center py-5">
		<i class="far fa-folder-open fa-3x text-muted mb-3"></i>
		<p class="text-muted">Belum ada postingan dalam kategori ini.</p>
		<a href="index.php?page=beranda" class="btn btn-primary mt-2">Kembali ke Beranda</a>
	</div>
<?php endif; ?>
