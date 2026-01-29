<?php
$sql = mysqli_query($con, 'SELECT * FROM tbl_posts ORDER BY date DESC');
?>

<style>
.table-modern-wrapper {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

.data-card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid #e8eaf0;
  overflow: hidden;
}

.data-card-header {
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
  color: white;
  padding: 20px 24px;
  border-bottom: none;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.data-card-header h5 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
}

.data-card-body {
  padding: 24px;
}

.table-modern {
  width: 100%;
  border-collapse: collapse;
  font-size: 14px;
}

.table-modern thead {
  background: #f9fafb;
}

.table-modern th {
  padding: 14px 16px;
  text-align: left;
  font-size: 12px;
  font-weight: 600;
  color: #6b7280;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border-bottom: 2px solid #e8eaf0;
}

.table-modern th.text-center {
  text-align: center;
}

.table-modern td {
  padding: 16px;
  color: #1f2937;
  border-bottom: 1px solid #f3f4f6;
  vertical-align: middle;
}

.table-modern tbody tr {
  transition: background 0.2s;
}

.table-modern tbody tr:hover {
  background: #f9fafb;
}

.table-modern tbody tr:last-child td {
  border-bottom: none;
}

.table-modern td.text-center {
  text-align: center;
}

.badge-modern {
  display: inline-block;
  padding: 4px 12px;
  border-radius: 12px;
  font-size: 12px;
  font-weight: 500;
  background: #e0e7ff;
  color: #3730a3;
}

.btn-action {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  width: 36px;
  height: 36px;
  border-radius: 8px;
  border: none;
  cursor: pointer;
  transition: all 0.2s;
  text-decoration: none;
  margin: 0 4px;
}

.btn-action-danger {
  background: #fee2e2;
  color: #dc2626;
}

.btn-action-danger:hover {
  background: #dc2626;
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.btn-action-warning {
  background: #fef3c7;
  color: #d97706;
}

.btn-action-warning:hover {
  background: #d97706;
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(217, 119, 6, 0.3);
}

.text-truncate {
  max-width: 300px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.empty-state {
  text-align: center;
  padding: 48px 24px;
  color: #6b7280;
}

.empty-state i {
  font-size: 48px;
  color: #d1d5db;
  margin-bottom: 16px;
}
</style>

<div class="table-modern-wrapper">
  <div class="row">
    <div class="col-lg-12">
      <div class="data-card">
        <div class="data-card-header">
          <h5>
            <i class="fas fa-list"></i>
            Data Postingan Beranda
          </h5>
        </div>
        <div class="data-card-body">
          <?php if (mysqli_num_rows($sql) > 0): ?>
          <div class="table-responsive">
            <table class="table-modern">
              <thead>
                <tr>
                  <th width="50">#</th>
                  <th>Judul</th>
                  <th>Artikel</th>
                  <th>Tanggal</th>
                  <th>Kategori</th>
                  <th>Author</th>
                  <th class="text-center" width="120">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($sql)):
                  $kat_query = mysqli_query($con, "SELECT nama_kategori FROM tbl_categories WHERE id_kategori='" . $data['id_kategori'] . "'");
                  $kategori = 'Tidak ada';
                  if ($kat_data = mysqli_fetch_array($kat_query)) {
                    $kategori = $kat_data['nama_kategori'];
                  } else {
                    $kategori = $data['kategori'];
                  }
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td>
                    <strong><?= htmlspecialchars($data['judul']) ?></strong>
                  </td>
                  <td>
                    <div class="text-truncate" title="<?= htmlspecialchars($data['artikel']) ?>">
                      <?= htmlspecialchars(substr($data['artikel'], 0, 100)) ?>...
                    </div>
                  </td>
                  <td><?= date('d M Y', strtotime($data['date'])) ?></td>
                  <td>
                    <span class="badge-modern"><?= htmlspecialchars($kategori) ?></span>
                  </td>
                  <td><?= htmlspecialchars($data['author']) ?></td>
                  <td class="text-center">
                    <a href="index.php?page=edit-beranda&id=<?= $data['id_post'] ?>" class="btn-action btn-action-warning" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="index.php?page=hapus-beranda&id=<?= $data['id_post'] ?>" class="btn-action btn-action-danger" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
          <?php else: ?>
          <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <h5 style="margin-top: 16px; color: #374151;">Tidak ada data</h5>
            <p>Belum ada postingan beranda yang ditambahkan.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>
