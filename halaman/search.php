<?php
include 'config/config.php';

$search_query = isset($_GET['q']) ? $_GET['q'] : '';
$search_term = mysqli_real_escape_string($con, $search_query);

if (!empty($search_term)) {
  $query = mysqli_query($con, "SELECT * FROM tbl_posts WHERE (judul LIKE '%$search_term%' OR artikel LIKE '%$search_term%') ORDER BY date DESC");
  $total_results = mysqli_num_rows($query);
} else {
  $query = null;
  $total_results = 0;
}
?>

<div class="col-12 mb-4">
	<h4 class="mb-3 border-bottom pb-2" style="border-bottom: 2px solid #dc2626 !important; display: inline-block; color: #dc2626;">
		<i class="fas fa-search me-2"></i> Hasil Pencarian
	</h4>
	<?php if (!empty($search_term)): ?>
		<p class="text-muted">Menampilkan <?= $total_results ?> hasil untuk "<strong><?= htmlspecialchars($search_query) ?></strong>"</p>
	<?php else: ?>
		<div class="alert alert-warning">
			<i class="fas fa-exclamation-triangle me-2"></i> Silakan masukkan kata kunci di kolom pencarian.
		</div>
	<?php endif; ?>
</div>

<?php if ($query && mysqli_num_rows($query) > 0): ?>
	<div class="col-12">
		<?php foreach ($query as $data): ?>
			<div class="card mb-4 shadow-sm border-0">
				<div class="row g-0">
					<div class="col-md-4">
						<img src="assets/file/post/<?= $data['img'] ?>" class="img-fluid rounded-start h-100" alt="<?= htmlspecialchars($data['judul']) ?>" style="object-fit: cover; min-height: 200px;">
					</div>
					<div class="col-md-8">
						<div class="card-body h-100 d-flex flex-column justify-content-center">
							<div class="mb-2 text-muted small">
								<i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($data['date'])) ?>
								<span class="mx-1">•</span>
								<i class="far fa-user me-1"></i> <?= htmlspecialchars($data['author']) ?>
							</div>
							<h5 class="card-title">
								<a href="index.php?page=detail&id=<?= $data['id_post'] ?>" class="text-decoration-none text-dark">
									<?= htmlspecialchars($data['judul']) ?>
								</a>
							</h5>
							<p class="card-text text-muted">
								<?= htmlspecialchars(substr(strip_tags($data['artikel']), 0, 180)) ?>...
							</p>
							<div class="mt-3">
								<a href="index.php?page=detail&id=<?= $data['id_post'] ?>" class="btn btn-sm btn-primary">
									Baca Selengkapnya
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php elseif (!empty($search_term)): ?>
	<div class="col-12 text-center py-5">
		<i class="fas fa-search-minus fa-3x text-muted mb-3"></i>
		<p class="text-muted">Tidak ada hasil ditemukan untuk "<?= htmlspecialchars($search_query) ?>".</p>
		<a href="index.php?page=beranda" class="btn btn-outline-primary mt-2">Kembali ke Beranda</a>
	</div>
<?php endif; ?>
