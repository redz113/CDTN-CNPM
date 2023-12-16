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
<body style="background-color: #D9EEE1;">
<div class="fixed-top">  
  <!-- Navbar Start -->
  <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-light py-3 py-lg-0 px-lg-2 px-xl-5">
            <a href="./../../" class="navbar-brand ml-lg-3">
                <h3 class="m-0 py-3 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Edu90minute</h3>
            </a>
            <strong class="text-light h5 m-0">Quên mật khẩu</strong>
        </nav>
    </div>
</div>
<div style="height: 60px;"></div>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center bg-light rounded">
                <h2 class="my-3">Quên mật khẩu</h2>
                <form action="" method="POST">
                    <div class="form-group text-left">
                        <label for="email" class="form-lable">Email:</label>
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