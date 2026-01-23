<div class="row">
	<div class="col-lg-10 m-auto">
		<div class="card card-primary">
			<div class="card-header">
				<h5>Tambah Kategori</h5>
			</div>
			<div class="card-body">
				<form method="POST">
					<div class="row">
						<div class="col-lg-12">
							<label for="nama_kategori">Nama Kategori</label>
							<input type="text" name="nama_kategori" placeholder="Masukkan Nama Kategori" class="form-control" required>
						</div>
						<div class="col-lg-12 mt-3">
							<label for="slug">Slug (URL-friendly)</label>
							<input type="text" name="slug" placeholder="contoh: berita-terkini" class="form-control" required>
							<small class="text-muted">Slug akan otomatis dibuat dari nama kategori jika dikosongkan</small>
						</div>
						<div class="col-lg-12 mt-3">
							<label for="deskripsi">Deskripsi</label>
							<textarea class="form-control" name="deskripsi" cols="30" rows="5" placeholder="Masukkan deskripsi kategori (opsional)"></textarea>
						</div>
						<div class="col-lg-12 mt-3">
							<button name="submit" class="btn btn-primary btn-block">Tambah Kategori</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php 

	if(isset($_POST['submit'])) {
		$nama_kategori = $_POST['nama_kategori'];
		$slug = $_POST['slug'];
		$deskripsi = $_POST['deskripsi'];

		// Generate slug from nama_kategori if slug is empty
		if(empty($slug)) {
			$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $nama_kategori)));
		} else {
			$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug)));
		}

		// Check if slug already exists
		$check_slug = mysqli_query($con, "SELECT * FROM tbl_categories WHERE slug='$slug'");
		if(mysqli_num_rows($check_slug) > 0) {
			$slug = $slug . '-' . time();
		}

		$sql = mysqli_query($con, "INSERT INTO tbl_categories (nama_kategori, slug, deskripsi) VALUES ('$nama_kategori', '$slug', '$deskripsi')");
		
		if($sql) {
			echo "<script>alert('Kategori Berhasil Ditambahkan!')</script>";
			echo "<script>window.location.href='index.php?page=data-kategori'</script>";
		} else {
			echo "<script>alert('Gagal menambahkan kategori!')</script>";
		}
	}

 ?>
