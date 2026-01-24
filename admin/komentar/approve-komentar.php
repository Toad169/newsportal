<?php

$id = $_GET['id'];

$sql = mysqli_query($con, "UPDATE tbl_comments SET status='approved' WHERE id_comment='$id'");

if ($sql) {
  echo "<script>alert('Komentar Berhasil Disetujui!')</script>";
  echo "<script>window.location.href='index.php?page=data-komentar'</script>";
} else {
  echo "<script>alert('Gagal menyetujui komentar!')</script>";
  echo "<script>window.location.href='index.php?page=data-komentar'</script>";
}

?>
