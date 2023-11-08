<?php 
	include_once "function.php";
	$user = $_GET['user'];
	if(isset($_POST['btn-submit'])){
		$code = trim($_POST['confirmation_code']);
		$data = getCodeConfirmByMd5($user);
		$codeSQL = $data[0]['code'];
		if($code==$codeSQL){
			if(updateEmailVerificationTime($data[0]['username'])){
				if(deleteCodeConfirmByUsername($data[0]['username'])){
					header("Location: ./login.php");
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Trang nhập mã xác nhận</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Nhập mã xác nhận</h1>
        <form method="post">
            <div class="form-group">
                <label for="confirmation_code">Mã xác nhận:</label>
                <input type="text" class="form-control" id="confirmation_code" name="confirmation_code" required>
            </div>
            <br><br>
            <button type="submit" class="btn btn-primary" name="btn-submit" id="btn-submit">Xác nhận</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>