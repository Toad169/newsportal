<?php 

	$id = $_GET['id'];

	// Check if category is being used by any posts
	$check_posts = mysqli_query($con, "SELECT * FROM tbl_posts WHERE id_kategori='$id'");
	
	if(mysqli_num_rows($check_posts) > 0) {
		echo "<script>alert('Kategori tidak dapat dihapus karena masih digunakan oleh beberapa postingan!')</script>";
		echo "<script>window.location.href='index.php?page=data-kategori'</script>";
	} else {
		$sql = mysqli_query($con, "DELETE FROM tbl_categories WHERE id_kategori='$id'");
		
		if($sql) {
			echo "<script>alert('Kategori Berhasil Dihapus!')</script>";
			echo "<script>window.location.href='index.php?page=data-kategori'</script>";
		} else {
			echo "<script>alert('Gagal menghapus kategori!')</script>";
			echo "<script>window.location.href='index.php?page=data-kategori'</script>";
		}
	}

 ?>
