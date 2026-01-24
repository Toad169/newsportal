<?php
include '../config/config.php';
$sql = mysqli_query($con, 'SELECT * FROM tbl_gallery');
?>

<style>
.gallery-modern {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

.gallery-card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid #e8eaf0;
  overflow: hidden;
  margin-bottom: 24px;
}

.gallery-card-header {
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
  color: white;
  padding: 20px 24px;
  border-bottom: none;
}

.gallery-card-header h5 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
}

.gallery-card-body {
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

.gallery-image {
  border-radius: 8px;
  object-fit: cover;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s;
}

.gallery-image:hover {
  transform: scale(1.05);
}

.btn-action-danger {
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
  background: #fee2e2;
  color: #dc2626;
}

.btn-action-danger:hover {
  background: #dc2626;
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.form-group-modern {
  margin-bottom: 24px;
}

.form-label-modern {
  display: block;
  font-size: 14px;
  font-weight: 600;
  color: #374151;
  margin-bottom: 12px;
}

.file-upload-wrapper {
  position: relative;
}

.file-upload-label {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 60px 20px;
  border: 2px dashed #d1d5db;
  border-radius: 8px;
  background: #f9fafb;
  cursor: pointer;
  transition: all 0.2s;
  text-align: center;
}

.file-upload-label:hover {
  border-color: #8b5cf6;
  background: #f5f3ff;
}

.file-upload-label.has-file {
  border-color: #10b981;
  background: #f0fdf4;
}

.file-upload-input {
  position: absolute;
  width: 1px;
  height: 1px;
  opacity: 0;
  overflow: hidden;
}

.file-upload-text {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 12px;
  color: #6b7280;
}

.file-upload-text i {
  font-size: 48px;
  color: #9ca3af;
}

.file-upload-text.has-file {
  color: #10b981;
}

.file-upload-text.has-file i {
  color: #10b981;
}

.file-info {
  font-size: 12px;
  color: #6b7280;
  margin-top: 8px;
  display: flex;
  align-items: center;
  gap: 6px;
}

.file-info i {
  color: #8b5cf6;
}

.btn-modern-primary {
  background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
  color: white;
  border: none;
  padding: 14px 32px;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.btn-modern-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 16px rgba(139, 92, 246, 0.3);
}

.btn-modern-primary:active {
  transform: translateY(0);
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

<div class="gallery-modern">
  <div class="row">
    <div class="col-lg-6 col-xs-12 mb-4">
      <div class="gallery-card">
        <div class="gallery-card-header">
          <h5>
            <i class="fas fa-images"></i>
            Galeri Diunggah
          </h5>
        </div>
        <div class="gallery-card-body">
          <?php if (mysqli_num_rows($sql) > 0): ?>
          <div class="table-responsive">
            <table class="table-modern">
              <thead>
                <tr>
                  <th width="50">#</th>
                  <th class="text-center">Gambar</th>
                  <th class="text-center" width="100">Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $no = 1;
                while ($data = mysqli_fetch_array($sql)):
                ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td class="text-center">
                    <img 
                      src="../assets/img/<?= htmlspecialchars($data['nama']) ?>" 
                      alt="Gallery Image" 
                      class="gallery-image"
                      style="width: 200px; height: 120px; object-fit: cover;"
                    >
                  </td>
                  <td class="text-center">
                    <a 
                      href="index.php?page=hapus-galeri&id=<?= $data['id_img'] ?>" 
                      class="btn-action-danger" 
                      title="Hapus"
                      onclick="return confirm('Apakah Anda yakin ingin menghapus gambar ini?')"
                    >
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
            <i class="fas fa-images"></i>
            <h5 style="margin-top: 16px; color: #374151;">Tidak ada gambar</h5>
            <p>Belum ada gambar yang diunggah ke galeri.</p>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-xs-12 mb-4">
      <div class="gallery-card">
        <div class="gallery-card-header">
          <h5>
            <i class="fas fa-upload"></i>
            Form Unggah Galeri
          </h5>
        </div>
        <div class="gallery-card-body">
          <form method="POST" enctype="multipart/form-data" id="galleryForm">
            <div class="form-group-modern">
              <label class="form-label-modern">
                Pilih Gambar
              </label>
              <div class="file-upload-wrapper">
                <label for="file" class="file-upload-label" id="fileLabel">
                  <div class="file-upload-text" id="fileText">
                    <i class="fas fa-cloud-upload-alt"></i>
                    <span>Klik untuk memilih gambar</span>
                    <small>JPG, PNG maks. 2MB</small>
                  </div>
                  <input 
                    type="file" 
                    id="file" 
                    name="file" 
                    class="file-upload-input" 
                    accept="image/jpeg,image/png,image/jpg"
                    onchange="updateFileLabel(this)"
                    required
                  >
                </label>
              </div>
              <div class="file-info">
                <i class="fas fa-info-circle"></i>
                <span>Ekstensi yang diperbolehkan: JPG, PNG (maks. 2MB)</span>
              </div>
            </div>

            <div class="form-group-modern" style="margin-top: 32px; margin-bottom: 0;">
              <button type="submit" name="submit" class="btn-modern-primary">
                <i class="fas fa-upload"></i>
                Unggah Gambar
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function updateFileLabel(input) {
  const label = document.getElementById('fileLabel');
  const text = document.getElementById('fileText');
  
  if (input.files && input.files[0]) {
    const fileName = input.files[0].name;
    const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
    label.classList.add('has-file');
    text.classList.add('has-file');
    text.innerHTML = `
      <i class="fas fa-check-circle"></i>
      <span>${fileName}</span>
      <small>${fileSize} MB</small>
    `;
  } else {
    label.classList.remove('has-file');
    text.classList.remove('has-file');
    text.innerHTML = `
      <i class="fas fa-cloud-upload-alt"></i>
      <span>Klik untuk memilih gambar</span>
      <small>JPG, PNG maks. 2MB</small>
    `;
  }
}
</script>

<?php
include '../config/config.php';

if (isset($_POST['submit'])) {
  // Set Upload Gambar
  $ekstensi_boleh = ['png', 'jpg'];
  $gambar = $_FILES['file']['name'];
  $ex = explode('.', $gambar);
  $ekstensi = strtolower(end($ex));
  $ukuran = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name'];

  if (!empty($gambar)) {
    if (in_array($ekstensi, $ekstensi_boleh) === true) {
      if ($ukuran < 2000000) {
        move_uploaded_file($file_tmp, '../assets/img/' . $gambar);
        $sql = mysqli_query($con, "INSERT INTO tbl_gallery VALUES ('', '$gambar')");
        echo "<script>alert('Data Berhasil Ditambahkan!')</script>";
        echo "<script>window.location.href='index.php?page=galeri'</script>";
      } else {
        echo "<script>alert('Ukuran tidak boleh > 2MB')</script>";
      }
    } else {
      echo "<script>alert('Ekstensi tidak sesuai')</script>";
    }
  } else {
    echo "<script>alert('Mohon memilih file yang akan di upload')</script>";
  }
}
?>
