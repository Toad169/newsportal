<?php

include '../config/config.php';

// Get statistics
$sql_post = mysqli_query($con, "SELECT * FROM tbl_posts WHERE author='$_SESSION[pengguna]'");
$data_post = mysqli_num_rows($sql_post);

$sql_user = mysqli_query($con, 'SELECT * FROM tbl_users');
$data_user = mysqli_num_rows($sql_user);

$sql_galeri = mysqli_query($con, 'SELECT * FROM tbl_gallery');
$data_galeri = mysqli_num_rows($sql_galeri);

// Get all posts for admin
$sql_all_posts = mysqli_query($con, 'SELECT * FROM tbl_posts');
$data_all_posts = mysqli_num_rows($sql_all_posts);

// Get comments count
$sql_comments = mysqli_query($con, 'SELECT * FROM tbl_comments');
$data_comments = mysqli_num_rows($sql_comments);

// Get approved comments
$sql_approved_comments = mysqli_query($con, "SELECT * FROM tbl_comments WHERE status='approved'");
$data_approved_comments = mysqli_num_rows($sql_approved_comments);

// Get categories count
$sql_categories = mysqli_query($con, 'SELECT * FROM tbl_categories');
$data_categories = mysqli_num_rows($sql_categories);

// Get posts by category for chart
$posts_by_category = [];
$cat_query = mysqli_query($con, 'SELECT c.nama_kategori, COUNT(p.id_post) as jumlah FROM tbl_categories c LEFT JOIN tbl_posts p ON c.id_kategori = p.id_kategori GROUP BY c.id_kategori');
while ($cat = mysqli_fetch_array($cat_query)) {
  $posts_by_category[] = [
    'kategori' => $cat['nama_kategori'],
    'jumlah' => $cat['jumlah']
  ];
}

// Get posts by month for line chart (last 6 months)
$posts_by_month = [];
for ($i = 5; $i >= 0; $i--) {
  $month = date('Y-m', strtotime("-$i months"));
  $month_name = date('M Y', strtotime("-$i months"));
  $month_query = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tbl_posts WHERE DATE_FORMAT(date, '%Y-%m') = '$month'");
  $month_data = mysqli_fetch_array($month_query);
  $posts_by_month[] = [
    'month' => $month_name,
    'jumlah' => (int)$month_data['jumlah']
  ];
}

// Get recent posts (last 5)
$recent_posts = mysqli_query($con, 'SELECT * FROM tbl_posts ORDER BY date DESC LIMIT 5');

// Get recent comments (last 5)
$recent_comments = mysqli_query($con, 'SELECT c.*, p.judul FROM tbl_comments c LEFT JOIN tbl_posts p ON c.id_post = p.id_post ORDER BY c.created_at DESC LIMIT 5');
?>

<style>
.dashboard-modern {
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
}

.stat-card {
  background: #ffffff;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid #e8eaf0;
  transition: all 0.3s ease;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}

.stat-card:hover {
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
  transform: translateY(-2px);
}

.stat-card-icon {
  width: 56px;
  height: 56px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 16px;
  font-size: 24px;
  color: #ffffff;
}

.stat-card-icon.posts {
  background: linear-gradient(135deg, #000000 0%, #dc2626 100%);
}

.stat-card-icon.users {
  background: linear-gradient(135deg, #065f46 0%, #10b981 100%);
}

.stat-card-icon.comments {
  background: linear-gradient(135deg, #92400e 0%, #f59e0b 100%);
}

.stat-card-icon.categories {
  background: linear-gradient(135deg, #7c2d12 0%, #ef4444 100%);
}

.stat-card-value {
  font-size: 32px;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 4px;
  line-height: 1.2;
}

.stat-card-label {
  font-size: 14px;
  color: #6b7280;
  font-weight: 500;
  margin-bottom: 12px;
}

.stat-card-link {
  color: #dc2626;
  text-decoration: none;
  font-size: 13px;
  font-weight: 500;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: color 0.2s;
}

.stat-card-link:hover {
  color: #b91c1c;
}

.modern-card {
  background: #ffffff;
  border-radius: 12px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid #e8eaf0;
  overflow: hidden;
  margin-bottom: 24px;
}

.modern-card-header {
  padding: 20px 24px;
  border-bottom: 1px solid #e8eaf0;
  background: #f9fafb;
}

.modern-card-title {
  font-size: 16px;
  font-weight: 600;
  color: #1f2937;
  margin: 0;
  display: flex;
  align-items: center;
  gap: 8px;
}

.modern-card-title i {
  color: #dc2626;
  font-size: 18px;
}

.modern-card-body {
  padding: 24px;
}

.welcome-card {
  background: linear-gradient(135deg, #000000 0%, #1a1a1a 100%);
  color: white;
  border-radius: 12px;
  padding: 32px;
  text-align: center;
}

.welcome-card h4 {
  font-size: 24px;
  font-weight: 600;
  margin-bottom: 8px;
}

.welcome-card p {
  font-size: 14px;
  opacity: 0.9;
  margin-bottom: 16px;
}

.welcome-card .date {
  font-size: 13px;
  opacity: 0.8;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 6px;
}

.progress-card {
  background: #ffffff;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
  border: 1px solid #e8eaf0;
  text-align: center;
}

.progress-value {
  font-size: 36px;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 8px;
}

.progress-label {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 16px;
}

.progress-bar-modern {
  height: 8px;
  background: #e5e7eb;
  border-radius: 4px;
  overflow: hidden;
  margin-bottom: 12px;
}

.progress-fill {
  height: 100%;
  background: linear-gradient(90deg, #10b981 0%, #34d399 100%);
  border-radius: 4px;
  transition: width 0.3s ease;
  display: flex;
  align-items: center;
  justify-content: flex-end;
  padding-right: 8px;
  color: white;
  font-size: 11px;
  font-weight: 600;
}

.gallery-card {
  text-align: center;
  padding: 24px;
}

.gallery-value {
  font-size: 36px;
  font-weight: 700;
  color: #1f2937;
  margin-bottom: 8px;
}

.gallery-label {
  font-size: 14px;
  color: #6b7280;
  margin-bottom: 16px;
}

.btn-modern {
  background: #dc2626;
  color: white;
  border: none;
  padding: 10px 20px;
  border-radius: 8px;
  font-size: 13px;
  font-weight: 500;
  transition: all 0.2s;
  text-decoration: none;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

.btn-modern:hover {
  background: #b91c1c;
  color: white;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
}

.table-modern {
  width: 100%;
  border-collapse: collapse;
}

.table-modern thead {
  background: #f9fafb;
}

.table-modern th {
  padding: 12px 16px;
  text-align: left;
  font-size: 12px;
  font-weight: 600;
  color: #6b7280;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  border-bottom: 2px solid #e8eaf0;
}

.table-modern td {
  padding: 14px 16px;
  font-size: 14px;
  color: #1f2937;
  border-bottom: 1px solid #f3f4f6;
}

.table-modern tbody tr:hover {
  background: #f9fafb;
}

.table-modern tbody tr:last-child td {
  border-bottom: none;
}

.card-footer-modern {
  padding: 16px 24px;
  border-top: 1px solid #e8eaf0;
  background: #f9fafb;
  display: flex;
  justify-content: flex-end;
}

.btn-link-modern {
  color: #dc2626;
  text-decoration: none;
  font-size: 13px;
  font-weight: 500;
  display: inline-flex;
  align-items: center;
  gap: 6px;
  transition: color 0.2s;
}

.btn-link-modern:hover {
  color: #b91c1c;
}

.chart-container {
  position: relative;
  height: 280px;
  padding: 16px;
}

.section-title {
  font-size: 20px;
  font-weight: 600;
  color: #1f2937;
  margin-bottom: 24px;
  padding-bottom: 12px;
  border-bottom: 2px solid #e8eaf0;
}

.mb-32 {
  margin-bottom: 32px;
}
</style>

<div class="dashboard-modern">
<?php if ($_SESSION['lvluser'] == 1) { ?>
  <!-- Welcome Section -->
  <div class="row mb-32">
    <div class="col-12">
      <div class="welcome-card">
        <h4>Selamat Datang, <?= htmlspecialchars($_SESSION['user']) ?>!</h4>
        <p>Administrator Dashboard</p>
        <div class="date">
          <i class="fas fa-calendar"></i>
          <span><?= date('d F Y') ?></span>
        </div>
      </div>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="row mb-32">
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="stat-card">
        <div>
          <div class="stat-card-icon posts">
            <i class="fas fa-newspaper"></i>
          </div>
          <div class="stat-card-value"><?= $data_all_posts ?></div>
          <div class="stat-card-label">Total Postingan</div>
        </div>
        <a href="index.php?page=tampil-beranda" class="stat-card-link">
          Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="stat-card">
        <div>
          <div class="stat-card-icon users">
            <i class="fas fa-users"></i>
          </div>
          <div class="stat-card-value"><?= $data_user ?></div>
          <div class="stat-card-label">Total User</div>
        </div>
        <a href="index.php?page=user" class="stat-card-link">
          Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="stat-card">
        <div>
          <div class="stat-card-icon comments">
            <i class="fas fa-comments"></i>
          </div>
          <div class="stat-card-value"><?= $data_comments ?></div>
          <div class="stat-card-label">Total Komentar</div>
        </div>
        <a href="index.php?page=data-komentar" class="stat-card-link">
          Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-6 mb-4">
      <div class="stat-card">
        <div>
          <div class="stat-card-icon categories">
            <i class="fas fa-tags"></i>
          </div>
          <div class="stat-card-value"><?= $data_categories ?></div>
          <div class="stat-card-label">Total Kategori</div>
        </div>
        <a href="index.php?page=data-kategori" class="stat-card-link">
          Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
  </div>

  <!-- Charts Row -->
  <div class="row mb-32">
    <div class="col-lg-6 mb-4">
      <div class="modern-card">
        <div class="modern-card-header">
          <h3 class="modern-card-title">
            <i class="fas fa-chart-pie"></i>
            Postingan Berdasarkan Kategori
          </h3>
        </div>
        <div class="modern-card-body">
          <div class="chart-container">
            <canvas id="categoryChart"></canvas>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="modern-card">
        <div class="modern-card-header">
          <h3 class="modern-card-title">
            <i class="fas fa-chart-line"></i>
            Postingan Per Bulan (6 Bulan Terakhir)
          </h3>
        </div>
        <div class="modern-card-body">
          <div class="chart-container">
            <canvas id="monthlyChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Additional Stats Row -->
  <div class="row mb-32">
    <div class="col-lg-4 mb-4">
      <div class="progress-card">
        <div class="progress-value"><?= $data_approved_comments ?></div>
        <div class="progress-label">Komentar Disetujui dari <?= $data_comments ?> total</div>
        <div class="progress-bar-modern">
          <div class="progress-fill" style="width: <?= $data_comments > 0 ? ($data_approved_comments / $data_comments * 100) : 0 ?>%">
            <?= $data_comments > 0 ? round($data_approved_comments / $data_comments * 100) : 0 ?>%
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="gallery-card modern-card">
        <div class="gallery-value"><?= $data_galeri ?></div>
        <div class="gallery-label">Total Foto di Galeri</div>
        <a href="index.php?page=galeri" class="btn-modern">
          <i class="fas fa-eye"></i> Lihat Galeri
        </a>
      </div>
    </div>
    <div class="col-lg-4 mb-4">
      <div class="modern-card">
        <div class="modern-card-header">
          <h3 class="modern-card-title">
            <i class="fas fa-info-circle"></i>
            Informasi Sistem
          </h3>
        </div>
        <div class="modern-card-body">
          <div style="font-size: 14px; color: #6b7280; line-height: 1.8;">
            <div><i class="fas fa-database" style="color: #dc2626; margin-right: 8px;"></i> Database: Aktif</div>
            <div><i class="fas fa-server" style="color: #10b981; margin-right: 8px;"></i> Server: Online</div>
            <div><i class="fas fa-shield-alt" style="color: #f59e0b; margin-right: 8px;"></i> Keamanan: Aktif</div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Activity Row -->
  <div class="row">
    <div class="col-lg-6 mb-4">
      <div class="modern-card">
        <div class="modern-card-header">
          <h3 class="modern-card-title">
            <i class="fas fa-newspaper"></i>
            Postingan Terbaru
          </h3>
        </div>
        <div class="modern-card-body" style="padding: 0;">
          <div class="table-responsive">
            <table class="table-modern">
              <thead>
                <tr>
                  <th>Judul</th>
                  <th>Tanggal</th>
                  <th>Author</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($post = mysqli_fetch_array($recent_posts)): ?>
                <tr>
                  <td><?= substr(htmlspecialchars($post['judul']), 0, 30) ?>...</td>
                  <td><?= date('d M Y', strtotime($post['date'])) ?></td>
                  <td><?= htmlspecialchars($post['author']) ?></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer-modern">
          <a href="index.php?page=tampil-beranda" class="btn-link-modern">
            Lihat Semua Postingan <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
    <div class="col-lg-6 mb-4">
      <div class="modern-card">
        <div class="modern-card-header">
          <h3 class="modern-card-title">
            <i class="fas fa-comments"></i>
            Komentar Terbaru
          </h3>
        </div>
        <div class="modern-card-body" style="padding: 0;">
          <div class="table-responsive">
            <table class="table-modern">
              <thead>
                <tr>
                  <th>Nama</th>
                  <th>Postingan</th>
                  <th>Tanggal</th>
                </tr>
              </thead>
              <tbody>
                <?php while ($comment = mysqli_fetch_array($recent_comments)): ?>
                <tr>
                  <td><?= htmlspecialchars($comment['nama']) ?></td>
                  <td><?= substr(htmlspecialchars($comment['judul']), 0, 20) ?>...</td>
                  <td><?= date('d M Y', strtotime($comment['created_at'])) ?></td>
                </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer-modern">
          <a href="index.php?page=data-komentar" class="btn-link-modern">
            Lihat Semua Komentar <i class="fas fa-arrow-right"></i>
          </a>
        </div>
      </div>
    </div>
  </div>

  <script>
  // Category Chart (Doughnut Chart with modern colors)
  var categoryCtx = document.getElementById('categoryChart').getContext('2d');
  var categoryChart = new Chart(categoryCtx, {
    type: 'doughnut',
    data: {
      labels: [<?php foreach($posts_by_category as $cat) { echo "'".$cat['kategori']."',"; } ?>],
      datasets: [{
        data: [<?php foreach($posts_by_category as $cat) { echo $cat['jumlah'].","; } ?>],
        backgroundColor: [
          '#dc2626',
          '#991b1b',
          '#7f1d1d',
          '#b91c1c',
          '#ef4444',
          '#f87171',
          '#fca5a5',
          '#fee2e2'
        ],
        borderWidth: 0
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'bottom',
          labels: {
            padding: 15,
            font: {
              size: 12,
              family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif'
            },
            usePointStyle: true
          }
        }
      }
    }
  });

  // Monthly Posts Chart (Line Chart with modern styling)
  var monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
  var monthlyChart = new Chart(monthlyCtx, {
    type: 'line',
    data: {
      labels: [<?php foreach($posts_by_month as $month) { echo "'".$month['month']."',"; } ?>],
      datasets: [{
        label: 'Jumlah Postingan',
        data: [<?php foreach($posts_by_month as $month) { echo $month['jumlah'].","; } ?>],
        borderColor: '#dc2626',
        backgroundColor: 'rgba(220, 38, 38, 0.1)',
        borderWidth: 3,
        fill: true,
        tension: 0.4,
        pointBackgroundColor: '#dc2626',
        pointBorderColor: '#ffffff',
        pointBorderWidth: 2,
        pointRadius: 5,
        pointHoverRadius: 7
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: true,
          position: 'top',
          labels: {
            font: {
              size: 12,
              family: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif'
            },
            padding: 15
          }
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            font: {
              size: 11
            }
          },
          grid: {
            color: '#f3f4f6'
          }
        },
        x: {
          grid: {
            display: false
          },
          ticks: {
            font: {
              size: 11
            }
          }
        }
      }
    }
  });
  </script>

<?php } else { ?>
  <!-- Regular User Dashboard -->
  <div class="row mb-32">
    <div class="col-12">
      <div class="welcome-card">
        <h4>Selamat Datang, <?= htmlspecialchars($_SESSION['user']) ?>!</h4>
        <p>Dashboard Anda</p>
        <div class="date">
          <i class="fas fa-calendar"></i>
          <span><?= date('d F Y') ?></span>
        </div>
      </div>
    </div>
  </div>

  <div class="row mb-32">
    <div class="col-lg-4 mb-4">
      <div class="stat-card">
        <div>
          <div class="stat-card-icon posts">
            <i class="fas fa-newspaper"></i>
          </div>
          <div class="stat-card-value"><?= $data_post ?></div>
          <div class="stat-card-label">Postingan Saya</div>
        </div>
        <a href="index.php?page=tampil-berita" class="stat-card-link">
          Lihat Semua <i class="fas fa-arrow-right"></i>
        </a>
      </div>
    </div>
    <div class="col-lg-8 mb-4">
      <div class="modern-card">
        <div class="modern-card-header">
          <h3 class="modern-card-title">
            <i class="fas fa-chart-bar"></i>
            Aktivitas Postingan
          </h3>
        </div>
        <div class="modern-card-body">
          <div class="chart-container">
            <canvas id="userPostChart"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="modern-card">
        <div class="modern-card-header">
          <h3 class="modern-card-title">
            <i class="fas fa-info-circle"></i>
            Informasi Akun
          </h3>
        </div>
        <div class="modern-card-body">
          <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 24px;">
            <div>
              <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px;">Username</div>
              <div style="font-size: 16px; font-weight: 600; color: #1f2937;">
                <i class="fas fa-user" style="color: #dc2626; margin-right: 8px;"></i>
                <?= htmlspecialchars($_SESSION['user']) ?>
              </div>
            </div>
            <div>
              <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px;">Tanggal</div>
              <div style="font-size: 16px; font-weight: 600; color: #1f2937;">
                <i class="fas fa-calendar" style="color: #10b981; margin-right: 8px;"></i>
                <?= date('d F Y') ?>
              </div>
            </div>
            <div>
              <div style="font-size: 12px; color: #6b7280; margin-bottom: 4px;">Waktu</div>
              <div style="font-size: 16px; font-weight: 600; color: #1f2937;">
                <i class="fas fa-clock" style="color: #f59e0b; margin-right: 8px;"></i>
                <?= date('H:i') ?>
              </div>
            </div>
          </div>
          <div style="margin-top: 24px; padding-top: 24px; border-top: 1px solid #e8eaf0;">
            <a href="index.php?page=tambah-berita" class="btn-modern">
              <i class="fas fa-plus"></i> Buat Postingan Baru
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
  // User Post Chart
  var userPostCtx = document.getElementById('userPostChart').getContext('2d');
  var userPostChart = new Chart(userPostCtx, {
    type: 'bar',
    data: {
      labels: [<?php foreach($posts_by_month as $month) { echo "'".$month['month']."',"; } ?>],
      datasets: [{
        label: 'Postingan Saya',
        data: [<?php 
          foreach($posts_by_month as $month) {
            $month_only = date('Y-m', strtotime($month['month']));
            $user_month_query = mysqli_query($con, "SELECT COUNT(*) as jumlah FROM tbl_posts WHERE author='$_SESSION[pengguna]' AND DATE_FORMAT(date, '%Y-%m') = '$month_only'");
            $user_month_data = mysqli_fetch_array($user_month_query);
            echo $user_month_data['jumlah'].",";
          }
        ?>],
        backgroundColor: '#dc2626',
        borderColor: '#dc2626',
        borderWidth: 0,
        borderRadius: 8
      }]
    },
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        legend: {
          display: false
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            stepSize: 1,
            font: {
              size: 11
            }
          },
          grid: {
            color: '#f3f4f6'
          }
        },
        x: {
          grid: {
            display: false
          },
          ticks: {
            font: {
              size: 11
            }
          }
        }
      }
    }
  });
  </script>

<?php } ?>
</div>
