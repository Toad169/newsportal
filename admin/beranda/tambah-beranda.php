<style>
.form-modern {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

.form-card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid #e8eaf0;
  overflow: hidden;
}

.form-card-header {
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
  color: white;
  padding: 20px 24px;
  border-bottom: none;
}

.form-card-header h5 {
  margin: 0;
  font-size: 18px;
  font-weight: 600;
  display: flex;
  align-items: center;
  gap: 10px;
}

.form-card-body {
  padding: 32px;
}

.form-group-modern {
  margin-bottom: 24px;
}

.form-label-modern {
  display: block;
  font-size: 14px;
  font-weight: 600;
  color: #374151;
  margin-bottom: 8px;
}

.form-label-modern .required {
  color: #ef4444;
  margin-left: 4px;
}

.form-control-modern {
  width: 100%;
  padding: 12px 16px;
  font-size: 14px;
  color: #1f2937;
  background: #ffffff;
  border: 1.5px solid #d1d5db;
  border-radius: 8px;
  transition: all 0.2s;
  font-family: inherit;
}

.form-control-modern:focus {
  outline: none;
  border-color: #dc2626;
  box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
}

.form-control-modern::placeholder {
  color: #9ca3af;
}

select.form-control-modern {
  cursor: pointer;
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
  background-position: right 12px center;
  background-repeat: no-repeat;
  background-size: 16px;
  padding-right: 40px;
  appearance: none;
}

textarea.form-control-modern {
  resize: vertical;
  min-height: 120px;
  font-family: inherit;
  line-height: 1.6;
}

.file-upload-wrapper {
  position: relative;
}

.file-upload-label {
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 40px 20px;
  border: 2px dashed #d1d5db;
  border-radius: 8px;
  background: #f9fafb;
  cursor: pointer;
  transition: all 0.2s;
  text-align: center;
}

.file-upload-label:hover {
  border-color: #dc2626;
  background: #fee2e2;
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
  gap: 8px;
  color: #6b7280;
}

.file-upload-text i {
  font-size: 32px;
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
  color: #dc2626;
}

.btn-modern-primary {
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
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
  box-shadow: 0 8px 16px rgba(220, 38, 38, 0.3);
}

.btn-modern-primary:active {
  transform: translateY(0);
}

.form-row-modern {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 24px;
}

@media (max-width: 768px) {
  .form-row-modern {
    grid-template-columns: 1fr;
  }
  
  .form-card-body {
    padding: 24px;
  }
}
</style>

<div class="form-modern">
  <div class="row">
    <div class="col-lg-10 m-auto">
      <div class="form-card">
        <div class="form-card-header">
          <h5>
            <i class="fas fa-plus-circle"></i>
            Tambah Postingan Beranda
          </h5>
        </div>
        <div class="form-card-body">
          <form method="POST" enctype="multipart/form-data" id="berandaForm">
            <div class="form-group-modern">
              <label for="judul" class="form-label-modern">
                Judul Artikel <span class="required">*</span>
              </label>
              <input 
                type="text" 
                id="judul" 
                name="judul" 
                placeholder="Masukkan judul artikel" 
                class="form-control-modern" 
                required
              >
            </div>

            <div class="form-row-modern">
              <div class="form-group-modern">
                <label for="id_kategori" class="form-label-modern">
                  Kategori <span class="required">*</span>
                </label>
                <select name="id_kategori" id="id_kategori" class="form-control-modern" required>
                  <option value="" disabled selected>Pilih Kategori</option>
                  <?php
                  $kategori_query = mysqli_query($con, 'SELECT * FROM tbl_categories ORDER BY nama_kategori ASC');
                  while ($kat = mysqli_fetch_array($kategori_query)): ?>
                    <option value="<?= $kat['id_kategori'] ?>"><?= htmlspecialchars($kat['nama_kategori']) ?></option>
                  <?php endwhile; ?>
                </select>
              </div>

              <div class="form-group-modern">
                <label class="form-label-modern">
                  Gambar Artikel
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
                    >
                  </label>
                </div>
                <div class="file-info">
                  <i class="fas fa-info-circle"></i>
                  <span>Ekstensi yang diperbolehkan: JPG, PNG (maks. 2MB)</span>
                </div>
                <input type="hidden" name="tanggal" value="<?php echo date('Y-m-d'); ?>">
              </div>
            </div>

            <div class="form-group-modern">
              <label for="artikel" class="form-label-modern">
                Isi Artikel <span class="required">*</span>
              </label>
              <textarea 
                id="artikel" 
                name="artikel" 
                class="form-control-modern" 
                rows="10" 
                placeholder="Tulis isi artikel di sini..."
                required
              ></textarea>
            </div>

            <div class="form-group-modern" style="margin-top: 32px; margin-bottom: 0;">
              <button type="submit" name="submit" class="btn-modern-primary">
                <i class="fas fa-check"></i>
                Tambah Postingan
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
    label.classList.add('has-file');
    text.classList.add('has-file');
    text.innerHTML = `
      <i class="fas fa-check-circle"></i>
      <span>${fileName}</span>
      <small>File dipilih</small>
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

<?php if (isset($_POST['submit'])) {
  $judul = $_POST['judul'];
  $id_kategori = $_POST['id_kategori'];
  $date = $_POST['tanggal'];
  $artikel = $_POST['artikel'];
  $author = $_SESSION['pengguna'];

  // Get category slug for backward compatibility
  $kat_query = mysqli_query($con, "SELECT slug FROM tbl_categories WHERE id_kategori='$id_kategori'");
  $kat_data = mysqli_fetch_array($kat_query);
  $kategori = $kat_data['slug'];

  // Set Upload Gambar
  $ekstensi_boleh = ['png', 'jpg', 'jpeg'];
  $gambar = $_FILES['file']['name'];
  $ex = explode('.', $gambar);
  $ekstensi = strtolower(end($ex));
  $ukuran = $_FILES['file']['size'];
  $file_tmp = $_FILES['file']['tmp_name'];

  if (in_array($ekstensi, $ekstensi_boleh) === true) {
    if ($ukuran < 2000000) {
      move_uploaded_file($file_tmp, '../assets/file/post/' . $gambar);
      $sql = mysqli_query($con, "INSERT INTO tbl_posts (img, judul, artikel, date, kategori, author, id_kategori) VALUES ('$gambar', '$judul', '$artikel', '$date', '$kategori', '$author', '$id_kategori')");
      echo "<script>alert('Data Berhasil Ditambahkan!')</script>";
      echo "<script>window.location.href='index.php?page=tampil-beranda'</script>";
    } else {
      echo "<script>alert('Ukuran tidak boleh > 2MB')</script>";
    }
  } else {
    echo "<script>alert('Ekstensi tidak sesuai')</script>";
  }
}
?>
