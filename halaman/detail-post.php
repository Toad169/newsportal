<?php
include 'config/config.php';
$id = $_GET['id'];

// Handle comment submission
if (isset($_POST['submit_comment'])) {
  if (!isset($_SESSION['frontend_user_id'])) {
    echo "<script>alert('Anda harus login untuk mengirim komentar!')</script>";
    echo "<script>window.location.href='index.php?page=login'</script>";
    exit();
  }

  $id_post = $_POST['id_post'];
  $nama = $_SESSION['frontend_nama'];
  $email = isset($_SESSION['frontend_email']) ? $_SESSION['frontend_email'] : '';
  $komentar = mysqli_real_escape_string($con, $_POST['komentar']);
  $status = 'approved'; 

  $sql = mysqli_query($con, "INSERT INTO tbl_comments (id_post, nama, email, komentar, status) VALUES ('$id_post', '$nama', '$email', '$komentar', '$status')");

  if ($sql) {
    echo "<script>alert('Komentar berhasil dikirim!')</script>";
    echo "<script>window.location.href='index.php?page=detail&id=$id_post'</script>";
  } else {
    echo "<script>alert('Gagal mengirim komentar!')</script>";
  }
}

$query = mysqli_query($con, "SELECT * FROM tbl_posts WHERE id_post='$id'");
$data = mysqli_fetch_array($query);
?>

<?php if (mysqli_num_rows($query) > 0): ?>

	<div class="col-lg-8 offset-lg-2">
		<div class="card mb-4">
			<img src="assets/file/post/<?= $data['img'] ?>" class="card-img-top" alt="<?= htmlspecialchars($data['judul']) ?>" style="max-height: 400px; object-fit: cover;">
			<div class="card-body p-4">
				<?php
					$kat_query = mysqli_query($con, "SELECT nama_kategori FROM tbl_categories WHERE id_kategori='" . $data['id_kategori'] . "'");
					if ($kat_data = mysqli_fetch_array($kat_query)) {
						$kategori_nama = $kat_data['nama_kategori'];
					} else {
						$kategori_nama = $data['kategori'];
					}
					?>
				<div class="mb-3">
					<span class="badge me-2 text-white" style="background-color: #4988C4;"><?= htmlspecialchars($kategori_nama) ?></span>
					<span class="text-muted small"><i class="far fa-calendar-alt me-1"></i> <?= date('d M Y', strtotime($data['date'])) ?></span>
					<span class="text-muted small mx-2">•</span>
					<span class="text-muted small"><i class="far fa-user me-1"></i> <?= htmlspecialchars($data['author']) ?></span>
				</div>
				
				<h2 class="card-title fw-bold mb-4"><?= htmlspecialchars($data['judul']) ?></h2>
				
				<div class="article-content" style="line-height: 1.8; color: #374151;">
					<?= nl2br(htmlspecialchars($data['artikel'])) ?>
				</div>
			</div>
		</div>

		<!-- Comments Section -->
		<div class="card mt-4 mb-5">
			<div class="card-header bg-white border-bottom py-3">
				<h5 class="mb-0" style="color: #4988C4;">
					<i class="far fa-comments me-2"></i> 
					Komentar (<?php
		$comment_count = mysqli_query($con, "SELECT * FROM tbl_comments WHERE id_post='$id' AND status='approved'");
		echo mysqli_num_rows($comment_count);
		?>)
				</h5>
			</div>
			<div class="card-body">
				<!-- Display Comments -->
				<div class="comments-list mb-4">
					<?php
						$comments_query = mysqli_query($con, "SELECT * FROM tbl_comments WHERE id_post='$id' AND status='approved' ORDER BY created_at DESC");
						if (mysqli_num_rows($comments_query) > 0):
						while ($comment = mysqli_fetch_array($comments_query)): ?>
						<div class="d-flex mb-4 border-bottom pb-3">
							<div class="flex-shrink-0">
								<div class="rounded-circle bg-light d-flex align-items-center justify-content-center fw-bold" style="width: 50px; height: 50px; font-size: 1.2rem; color: #4988C4;">
									<?= strtoupper(substr($comment['nama'], 0, 1)) ?>
								</div>
							</div>
							<div class="flex-grow-1 ms-3">
								<div class="d-flex justify-content-between align-items-center mb-1">
									<h6 class="fw-bold mb-0"><?= htmlspecialchars($comment['nama']) ?></h6>
									<small class="text-muted"><?= date('d M Y, H:i', strtotime($comment['created_at'])) ?></small>
								</div>
								<p class="mb-0 text-secondary"><?= nl2br(htmlspecialchars($comment['komentar'])) ?></p>
							</div>
						</div>
						<?php endwhile;
		else:
		?>
						<div class="text-center py-4 text-muted">
							<i class="far fa-comment-dots fa-2x mb-2"></i>
							<p>Belum ada komentar. Jadilah yang pertama!</p>
						</div>
					<?php
		endif;
		?>
				</div>
				
				<!-- Comment Form -->
				<div class="comment-form mt-4 p-4 bg-light rounded">
					<h6 class="mb-3 fw-bold">Tinggalkan Komentar</h6>
					<?php if (isset($_SESSION['frontend_user_id'])): ?>
						<form method="POST">
							<input type="hidden" name="id_post" value="<?= $id ?>">
							<div class="mb-3">
								<small class="text-muted">Login sebagai: <strong class="text-dark"><?= htmlspecialchars($_SESSION['frontend_nama']) ?></strong></small>
							</div>
							<div class="mb-3">
								<textarea class="form-control" name="komentar" rows="4" required placeholder="Tulis pendapat Anda di sini..." style="resize: none;"></textarea>
							</div>
							<div class="text-end">
								<button type="submit" name="submit_comment" class="btn btn-primary px-4">
									<i class="far fa-paper-plane me-2"></i> Kirim
								</button>
							</div>
						</form>
					<?php else: ?>
						<div class="text-center py-3">
							<p class="mb-3">Silakan login untuk mengirim komentar.</p>
							<div class="d-flex justify-content-center gap-2">
								<a href="index.php?page=login" class="btn btn-primary btn-sm px-4">Login</a>
								<a href="index.php?page=register" class="btn btn-outline-primary btn-sm px-4">Daftar</a>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>

<?php else: ?>

	<div class="col-lg-8 offset-lg-2">
		<div class="col-12 text-center py-5">
			<i class="fas fa-exclamation-circle fa-3x text-muted mb-3"></i>
			<h3>Berita tidak ditemukan</h3>
			<a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
		</div>'
	</div>

<?php endif; ?>