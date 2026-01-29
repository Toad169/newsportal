<?php

include '../config/config.php';

// Only allow admin to access user management
if ($_SESSION['lvluser'] != 1) {
  echo "<script>alert('Akses Ditolak! Hanya Admin yang dapat mengakses halaman ini.')</script>";
  echo "<script>window.location.href='index.php?page=home'</script>";
  exit;
}

$id = intval($_GET['id']); // Sanitize input

// Prevent deleting own account
if ($id == $_SESSION['id']) {
  echo "<script>alert('Tidak dapat menghapus akun sendiri!')</script>";
  echo "<script>window.location.href='index.php?page=data-user'</script>";
  exit;
}

// Check if user exists
$check_user = mysqli_query($con, "SELECT * FROM tbl_users WHERE id_user='$id'");
if (mysqli_num_rows($check_user) == 0) {
  echo "<script>alert('User tidak ditemukan!')</script>";
  echo "<script>window.location.href='index.php?page=data-user'</script>";
  exit;
}

// Get user data to delete image file
$user_data = mysqli_fetch_array($check_user);
$img_file = '../assets/img/' . $user_data['img'];

// Check if user has posts (optional - you might want to prevent deletion if user has posts)
$author_name = mysqli_real_escape_string($con, $user_data['nama_pengguna']);
$check_posts = mysqli_query($con, "SELECT * FROM tbl_posts WHERE author='$author_name'");
$post_count = mysqli_num_rows($check_posts);

if ($post_count > 0) {
  echo "<script>alert('User tidak dapat dihapus karena masih memiliki $post_count postingan!')</script>";
  echo "<script>window.location.href='index.php?page=data-user'</script>";
  exit;
}

// Delete user
$sql = mysqli_query($con, "DELETE FROM tbl_users WHERE id_user='$id'");

if ($sql) {
  // Delete image file if it exists and is not default avatar
  if (file_exists($img_file) && $user_data['img'] != 'avatar2.png' && $user_data['img'] != 'avatar5.png') {
    unlink($img_file);
  }
  
  echo "<script>alert('User Berhasil Dihapus!')</script>";
  echo "<script>window.location.href='index.php?page=data-user'</script>";
} else {
  echo "<script>alert('Gagal menghapus user!')</script>";
  echo "<script>window.location.href='index.php?page=data-user'</script>";
}

?>
