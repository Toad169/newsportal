<?php

include 'config/config.php';
// session_start();

$id = $_GET['id'];

// Handle comment submission
if (isset($_POST['submit_comment'])) {
  // Check if user is logged in
  if (!isset($_SESSION['frontend_user_id'])) {
    echo "<script>alert('Anda harus login untuk mengirim komentar!')</script>";
    echo "<script>window.location.href='index.php?page=login'</script>";
    exit();
  }

  $id_post = $_POST['id_post'];
  $nama = $_SESSION['frontend_nama'];
  $email = isset($_SESSION['frontend_email']) ? $_SESSION['frontend_email'] : '';
  $komentar = mysqli_real_escape_string($con, $_POST['komentar']);
  $status = 'approved'; // Comments are instantly approved for logged-in users

  $sql = mysqli_query(
    $con,
    "INSERT INTO tbl_comments (id_post, nama, email, komentar, status) VALUES ('$id_post', '$nama', '$email', '$komentar', '$status')",
  );

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

 <div class="col-lg-10 col-xs-12">
	<h3><?= $data['judul'] ?></h3>
	<p class="mt-3 text-muted" style="font-size: 12px;">
		<i class="ion-calendar"></i>&nbsp;<?= $data['date'] ?>&nbsp;&nbsp;
		<?php
  // Get category name from categories table
  $kat_query = mysqli_query(
    $con,
    "SELECT nama_kategori FROM tbl_categories WHERE id_kategori='" . $data['id_kategori'] . "'",
  );
  if ($kat_data = mysqli_fetch_array($kat_query)) {
    $kategori_nama = $kat_data['nama_kategori'];
  } else {
    $kategori_nama = $data['kategori'];
  }
  ?>
		<a href="#" class="text-muted" style="text-transform: uppercase;text-decoration: none;"><?= $kategori_nama ?></a>
	</p>	
	<img src="assets/file/post/<?= $data['img'] ?>" class="img-fluid">		
	<p class="mt-4 text-justify"><?= $data['artikel'] ?></p>
	
	<!-- Comments Section -->
	<div class="mt-5">
		<h4>Komentar (<?php
  $comment_count = mysqli_query(
    $con,
    "SELECT * FROM tbl_comments WHERE id_post='$id' AND status='approved'",
  );
  echo mysqli_num_rows($comment_count);
  ?>)</h4>
		
		<!-- Display Comments -->
		<div class="mt-3">
			<?php
   $comments_query = mysqli_query(
     $con,
     "SELECT * FROM tbl_comments WHERE id_post='$id' AND status='approved' ORDER BY created_at DESC",
   );
   if (mysqli_num_rows($comments_query) > 0):
     while ($comment = mysqli_fetch_array($comments_query)): ?>
			<div class="card mb-3">
				<div class="card-body">
					<div class="d-flex justify-content-between align-items-start">
						<div>
							<h6 class="card-title mb-1"><?= htmlspecialchars($comment['nama']) ?></h6>
							<p class="text-muted mb-2" style="font-size: 12px;">
								<i class="ion-calendar"></i> <?= date('d M Y, H:i', strtotime($comment['created_at'])) ?>
							</p>
						</div>
					</div>
					<p class="card-text mt-2"><?= nl2br(htmlspecialchars($comment['komentar'])) ?></p>
				</div>
			</div>
			<?php endwhile;
   else:
      ?>
			<p class="text-muted">Belum ada komentar. <?= isset($_SESSION['frontend_user_id'])
     ? 'Jadilah yang pertama berkomentar!'
     : 'Login untuk berkomentar!' ?></p>
			<?php
   endif;
   ?>
		</div>
		
		<!-- Comment Form -->
		<div class="mt-4">
			<h5>Tinggalkan Komentar</h5>
			<?php if (isset($_SESSION['frontend_user_id'])): ?>
				<form method="POST">
					<input type="hidden" name="id_post" value="<?= $id ?>">
					<div class="mb-3">
						<label class="form-label">Anda login sebagai: <strong><?= htmlspecialchars(
        $_SESSION['frontend_nama'],
      ) ?></strong></label>
					</div>
					<div class="mb-3">
						<label for="komentar" class="form-label">Komentar</label>
						<textarea class="form-control" name="komentar" id="komentar" rows="5" required placeholder="Tulis komentar Anda di sini..."></textarea>
					</div>
					<button type="submit" name="submit_comment" class="btn btn-primary">Kirim Komentar</button>
				</form>
			<?php else: ?>
				<div class="alert alert-info">
					<p class="mb-2"><strong>Anda harus login untuk mengirim komentar.</strong></p>
					<p class="mb-0">
						<a href="index.php?page=login" class="btn btn-primary btn-sm">Login</a>
						atau
						<a href="index.php?page=register" class="btn btn-success btn-sm">Daftar</a>
					</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
 </div>
 <div class="col-lg-2"></div>
