<?php 

	$sql = mysqli_query($con, "SELECT * FROM tbl_categories ORDER BY created_at DESC");

 ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h5>Data Kategori</h5>
			</div>
			<div class="card-body">
				<a href="index.php?page=tambah-kategori" class="btn btn-primary mb-3">
					<i class="fas fa-plus"></i> Tambah Kategori
				</a>
				<table class="table table-bordered">
					<tr class="text-center">
						<th>#</th>
						<th>Nama Kategori</th>
						<th>Slug</th>
						<th>Deskripsi</th>
						<th>Tanggal Dibuat</th>
						<th>Aksi</th>
					</tr>
				<?php $no = 1; foreach($sql as $data): ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $data['nama_kategori'] ?></td>
						<td><?= $data['slug'] ?></td>
						<td><?= substr($data['deskripsi'], 0, 50) ?><?= strlen($data['deskripsi']) > 50 ? '...' : '' ?></td>
						<td><?= date('d M Y', strtotime($data['created_at'])) ?></td>
						<td class="text-center">
							<a href="index.php?page=edit-kategori&id=<?=$data['id_kategori'] ?>" class="btn btn-warning text-white">
								<i class="fas fa-edit"></i>
							</a>
							<a href="index.php?page=hapus-kategori&id=<?=$data['id_kategori'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus kategori ini?')">
								<i class="fas fa-trash"></i>
							</a>
						</td>
					</tr>
				<?php endforeach; ?>
				</table>
			</div>
		</div>
	</div>
</div>
