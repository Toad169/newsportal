<?php

include 'config/config.php';
// session_start();

$search_query = isset($_GET['q']) ? $_GET['q'] : '';
$search_term = mysqli_real_escape_string($con, $search_query);

if (!empty($search_term)) {
  $query = mysqli_query(
    $con,
    "SELECT * FROM tbl_posts 
			WHERE (judul LIKE '%$search_term%' OR artikel LIKE '%$search_term%') 
			ORDER BY date DESC",
  );
  $total_results = mysqli_num_rows($query);
} else {
  $query = null;
  $total_results = 0;
}
?>

<div class="col-lg-12">
	<h3>Hasil Pencarian</h3>
	<?php if (!empty($search_term)): ?>
		<p class="text-muted">Menampilkan <?= $total_results ?> hasil untuk "<strong><?= htmlspecialchars(
   $search_query,
 ) ?></strong>"</p>
	<?php else: ?>
		<p class="text-muted">Masukkan kata kunci untuk mencari berita</p>
	<?php endif; ?>
	
	<hr>

	<?php if ($query && mysqli_num_rows($query) > 0): ?>
		<?php foreach ($query as $data): ?>
			<div class="card mb-3">
				<div class="row g-0">
					<div class="col-md-3">
						<img src="assets/file/post/<?= $data[
        'img'
      ] ?>" class="img-fluid rounded-start" alt="<?= htmlspecialchars(
  $data['judul'],
) ?>" style="height: 150px; width: 100%; object-fit: cover;">
					</div>
					<div class="col-md-9">
						<div class="card-body">
							<h5 class="card-title">
								<a href="index.php?page=detail&id=<?= $data['id_post'] ?>" class="text-decoration-none">
									<?= htmlspecialchars($data['judul']) ?>
								</a>
							</h5>
							<p class="card-text">
								<small class="text-muted">
									<i class="ion-calendar"></i> <?= $data['date'] ?> &nbsp;&nbsp;
									<i class="ion-person"></i> <?= htmlspecialchars($data['author']) ?> &nbsp;&nbsp;
									<?php
         $kat_query = mysqli_query(
           $con,
           "SELECT nama_kategori FROM tbl_categories WHERE id_kategori='" .
             $data['id_kategori'] .
             "'",
         );
         if ($kat_data = mysqli_fetch_array($kat_query)) {
           echo '<i class="ion-pricetag"></i> ' . htmlspecialchars($kat_data['nama_kategori']);
         }
         ?>
								</small>
							</p>
							<p class="card-text"><?= substr(htmlspecialchars($data['artikel']), 0, 200) ?>...</p>
							<a href="index.php?page=detail&id=<?= $data[
         'id_post'
       ] ?>" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	<?php elseif (!empty($search_term)): ?>
		<div class="alert alert-info">
			<p class="mb-0">Tidak ada hasil ditemukan untuk "<strong><?= htmlspecialchars(
     $search_query,
   ) ?></strong>"</p>
			<p class="mb-0 mt-2">Coba gunakan kata kunci lain atau <a href="index.php?page=beranda">kembali ke beranda</a></p>
		</div>
	<?php else: ?>
		<div class="alert alert-warning">
			<p class="mb-0">Silakan masukkan kata kunci di kolom pencarian</p>
		</div>
	<?php endif; ?>
</div>
