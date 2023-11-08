<?php 
	include_once "function.php";
	$user = $_GET['id'];
	$otp = "";
	$new_password = "";
	$confirm_password = "";
	$warning = "";
	if(isset($_POST['btn-submit'])){
		$otp = trim($_POST['otp']);
		$new_password = trim($_POST['new-password']);
		$confirm_password = trim($_POST['confirm-password']);
		$data = getCodeConfirmByMd5($user);
		if (!empty($data) && $otp == $data[0]['code']){
			if($new_password==$confirm_password){
				resetPassword($data[0]['username'], $new_password);
				deleteCodeConfirmByUsername($data[0]['username']);
				$warning = "Khoi phuc mat khau thanh cong. Bam vao <a href='./login.php'>day de dang nhap</a>";
			}
		}
		else if(empty($data)){
			$warning = "He thong khong tim thay yeu cau khoi phuc mat khau, <a href='./forgotpassword.php'>hay thu lai</a>";
		}
		else{
			$warning = "Khong the khoi phuc mat khau, <a href='./forgotpassword.php'>hay thu lai</a>";
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset mật khẩu</title>
    <!-- Liên kết với Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5 mb-3">Reset mật khẩu</h2>
                <form action="" method="POST">
					<div class="form-group">
                        <label for="otp">Ma OTP:</label>
                        <input type="text" class="form-control" name="otp" id="otp" required>
                    </div>
                    <div class="form-group">
                        <label for="new-password">Mật khẩu mới:</label>
                        <input type="password" class="form-control" name="new-password" id="new-password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Xác nhận mật khẩu:</label>
                        <input type="password" class="form-control" name="confirm-password" id="confirm-password" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn-submit" id="btn-submit">Đặt lại mật khẩu</button>
                </form>
				<p style="color:red">
				<?php 
					if(!empty($warning)){
						echo $warning;
					}
				?>
			</p>
            </div>
        </div>
    </div>

    <!-- Liên kết với Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>