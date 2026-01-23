<?php 

	$sql = mysqli_query($con, "SELECT c.*, p.judul FROM tbl_comments c 
		LEFT JOIN tbl_posts p ON c.id_post = p.id_post 
		ORDER BY c.created_at DESC");

 ?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<h5>Data Komentar</h5>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<tr class="text-center">
						<th>#</th>
						<th>Nama</th>
						<th>Email</th>
						<th>Komentar</th>
						<th>Postingan</th>
						<th>Status</th>
						<th>Tanggal</th>
						<th>Aksi</th>
					</tr>
				<?php $no = 1; foreach($sql as $data): ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= htmlspecialchars($data['nama']) ?></td>
						<td><?= htmlspecialchars($data['email']) ?></td>
						<td><?= substr(htmlspecialchars($data['komentar']), 0, 50) ?><?= strlen($data['komentar']) > 50 ? '...' : '' ?></td>
						<td><?= htmlspecialchars($data['judul']) ?></td>
						<td>
							<?php 
								if($data['status'] == 'approved') {
									echo '<span class="badge badge-success">Disetujui</span>';
								} elseif($data['status'] == 'spam') {
									echo '<span class="badge badge-danger">Spam</span>';
								} else {
									echo '<span class="badge badge-warning">Menunggu</span>';
								}
							?>
						</td>
						<td><?= date('d M Y, H:i', strtotime($data['created_at'])) ?></td>
						<td class="text-center">
							<?php if($data['status'] == 'pending'): ?>
								<a href="index.php?page=approve-komentar&id=<?=$data['id_comment'] ?>" class="btn btn-success btn-sm" title="Setujui">
									<i class="fas fa-check"></i>
								</a>
							<?php endif; ?>
							<a href="index.php?page=hapus-komentar&id=<?=$data['id_comment'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus komentar ini?')" title="Hapus">
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
