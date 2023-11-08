<?php 
	include_once "function.php";
	$email = "";
	$data = array();
	$warning = array();
	if(isset($_POST['btn-submit'])){
		$email = trim($_POST['email']);
		if(!empty($email)){
			$data = getUserDataByEmail($email);
			if(!empty($data)){
				SendMailResetPassword($data[0]['username'], $email);
				array_push($warning, "Vui long kiem tra email.");
				header("Location: ./resetpassword.php?id=". urlencode(md5($data[0]['username'])));
			}
			else{
				array_push($warning, "Khong ton tai email.");
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quên mật khẩu</title>
    <!-- Liên kết với Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mt-5 mb-3">Quên mật khẩu</h2>
                <form action="" method="POST">
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="btn-submit" id="btn-submit">Gửi mã xác nhận</button>
					<p style="color:red">
						<?php 
							foreach ($warning as $w) {
								echo $w . "<br>";
							}
						?>
					</p>
                </form>
            </div>
        </div>
    </div>

    <!-- Liên kết với Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>