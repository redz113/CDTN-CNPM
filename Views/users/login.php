<?php 
	include_once "function.php";

  CheckLogined();
	
	if(CheckLogined()){
		header('location: ../../index.php');
	}

	$warning = "";
	if(isset($_POST['btn-login'])){
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
		$rememberMe = false;
        if(empty($_POST['username']) || empty($_POST['password'])){
            $warning = "Please enter your username and password.\n";
        }
        else{
				if(isset($_POST['remember'])) {
					$rememberMe = true;
				}
            if(login($username, $password, $rememberMe)){
                header('location: ../../index.php');
            }
            else{
				$data = checkIfNotEmailVerified($username);
				if(!empty($data)){
					$md5 = $data[0]['md5'];
					header("Location: ./enterconfirmcode.php?user=". $md5);
				}
				else{
					$warning = "Thông tin đăng nhập sai!";
				}
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <title>Login</title>
</head>
<body style="background-color: #D9EEE1;">
<div class="fixed-top">  
  <!-- Navbar Start -->
  <div class="container-fluid p-0">
        <nav class="navbar navbar-expand-lg bg-dark navbar-light py-3 py-lg-0 px-lg-2 px-xl-5">
            <a href="./../../" class="navbar-brand ml-lg-3">
                <h3 class="m-0 py-3 text-uppercase text-primary"><i class="fa fa-book-reader mr-3"></i>Edu90minute</h3>
            </a>
            <strong class="text-light h5 m-0">Đăng nhập</strong>
        </nav>
    </div>
</div>
<div style="height: 60px;"></div>
<div class="container mt-5">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4 p-3 bg-light rounded">
        <h2 class="text-center mb-4">Đăng nhập</h2>
        <form method="post">
          <div class="form-group">
            <label for="username">Tài khoản</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
          </div>
          <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
			<div class="form-group d-flex justify-content-between">
            <div class="form-check text-right">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Nhớ mật khẩu</label>
            </div>
             <div class="ml-auto">
              <a href="./forgot.php">Quên mật khẩu?</a>
            </div>
          </div>
          <div class="form-group text-center">
            <div class="ml-auto">
              <button type="submit" class="btn btn-primary" name="btn-login" id="btn-login">Đăng nhập</button>
            </div>
          </div>
        </form>
		<div class="text-center">
            Bạn chưa có tài khoản? <a href="./register.php"> Đăng ký</a>
			<?php echo '<p style="color:red;">' .$warning. '</p>'; ?>
         </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>