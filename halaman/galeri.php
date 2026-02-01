<?php
include 'config/config.php';
$sql = mysqli_query($con, 'SELECT * FROM tbl_gallery ORDER BY id_img DESC');
?>

<div class="col-12 mb-4">
	<h4 class="mb-3 border-bottom pb-2" style="border-bottom: 2px solid #4988C4 !important; display: inline-block; color: #4988C4;">
		<i class="fas fa-images me-2"></i> Galeri Kegiatan
	</h4>
	<p class="text-muted">Dokumentasi kegiatan dan momen penting.</p>
</div>

<?php if (mysqli_num_rows($sql) > 0): ?>
	<div class="row g-4">
		<?php foreach ($sql as $data): ?>
			<div class="col-lg-4 col-md-6">
				<div class="card border-0 shadow-sm h-100 hover-zoom">
					<div class="overflow-hidden rounded" style="cursor: pointer;">
						<img src="assets/img/<?= $data['nama'] ?>" alt="Gallery Image" class="img-fluid w-100 transition-transform" style="height: 250px; object-fit: cover; transition: transform 0.3s ease;">
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	
	<style>
		.hover-zoom:hover img {
			transform: scale(1.05) !important;
		}
	</style>
<?php else: ?>
	<div class="col-12 text-center py-5">
		<i class="far fa-images fa-3x text-muted mb-3"></i>
		<p class="text-muted">Belum ada foto di galeri.</p>
	</div>
<?php endif; ?>
