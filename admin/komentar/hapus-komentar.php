<?php

$id = $_GET['id'];

$sql = mysqli_query($con, "DELETE FROM tbl_comments WHERE id_comment='$id'");

if ($sql) {
  echo "<script>alert('Komentar Berhasil Dihapus!')</script>";
  echo "<script>window.location.href='index.php?page=data-komentar'</script>";
} else {
  echo "<script>alert('Gagal menghapus komentar!')</script>";
  echo "<script>window.location.href='index.php?page=data-komentar'</script>";
}

?>
