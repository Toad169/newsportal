<?php 

	include "config/config.php";

	$id = $_GET['id'];

	// Handle comment submission
	if(isset($_POST['submit_comment'])) {
		$id_post = $_POST['id_post'];
		$nama = $_POST['nama'];
		$email = $_POST['email'];
		$komentar = $_POST['komentar'];
		$status = 'pending'; // Comments need approval by default

		$sql = mysqli_query($con, "INSERT INTO tbl_comments (id_post, nama, email, komentar, status) VALUES ('$id_post', '$nama', '$email', '$komentar', '$status')");
		
		if($sql) {
			echo "<script>alert('Komentar berhasil dikirim! Menunggu persetujuan admin.')</script>";
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
			$kat_query = mysqli_query($con, "SELECT nama_kategori FROM tbl_categories WHERE id_kategori='".$data['id_kategori']."'");
			if($kat_data = mysqli_fetch_array($kat_query)) {
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
			$comment_count = mysqli_query($con, "SELECT * FROM tbl_comments WHERE id_post='$id' AND status='approved'");
			echo mysqli_num_rows($comment_count);
		?>)</h4>
		
		<!-- Display Comments -->
		<div class="mt-3">
			<?php 
				$comments_query = mysqli_query($con, "SELECT * FROM tbl_comments WHERE id_post='$id' AND status='approved' ORDER BY created_at DESC");
				if(mysqli_num_rows($comments_query) > 0):
					while($comment = mysqli_fetch_array($comments_query)):
			?>
			<div class="card mb-3">
				<div class="card-body">
					<h6 class="card-title"><?= htmlspecialchars($comment['nama']) ?></h6>
					<p class="text-muted" style="font-size: 12px;">
						<i class="ion-email"></i> <?= htmlspecialchars($comment['email']) ?> &nbsp;&nbsp;
						<i class="ion-calendar"></i> <?= date('d M Y, H:i', strtotime($comment['created_at'])) ?>
					</p>
					<p class="card-text"><?= nl2br(htmlspecialchars($comment['komentar'])) ?></p>
				</div>
			</div>
			<?php 
					endwhile;
				else:
			?>
			<p class="text-muted">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
			<?php endif; ?>
		</div>
		
		<!-- Comment Form -->
		<div class="mt-4">
			<h5>Tinggalkan Komentar</h5>
			<form method="POST">
				<input type="hidden" name="id_post" value="<?= $id ?>">
				<div class="row mt-3">
					<div class="col-md-6">
						<div class="mb-3">
							<label for="nama" class="form-label">Nama</label>
							<input type="text" class="form-control" name="nama" id="nama" required>
						</div>
					</div>
					<div class="col-md-6">
						<div class="mb-3">
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" name="email" id="email" required>
						</div>
					</div>
				</div>
				<div class="mb-3">
					<label for="komentar" class="form-label">Komentar</label>
					<textarea class="form-control" name="komentar" id="komentar" rows="5" required></textarea>
				</div>
				<button type="submit" name="submit_comment" class="btn btn-primary">Kirim Komentar</button>
			</form>
		</div>
	</div>
 </div>
 <div class="col-lg-2"></div>
