<?php 
	include "function.php";
	$id = $_GET['id'];
	if(deleteUser($id)){
		echo "
		<script>
			alert('Xóa thành công');
		</script>";
	}
	
?>
<script>
	history.back();
</script>