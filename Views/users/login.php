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
<body>
<style>
  .form-control {
      width: 100px;
  }
  label {
      color: white;
  }
  h2 {
      color: white;
  }
  a {
      color: white; /* Add this line to set the color of anchor tag to white */
  }
  .right-fl {
      width: 80%;
  }
</style>
<link rel="stylesheet" href="css/style.css">

<div class="jumbotron jumbotron-fluid position-relative mb-0 pt-5">
<div class="row">
			<a href="./../../" class="btn btn-primary px-4">Trang chủ</a>
		</div>
    <div class="row">
        <div class="col-md-6 bg-primary d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
            <h1 class="text-white display-4 text-uppercase mt-4 mb-4">Học lập trình</h1>
            <h3 class="text-white display-5 text-uppercase mb-5">với Edu90minute</h3>
			<img src="img/aaaa.png" width="50%">
        </div>
        <div class="col-md-6 bg-primary right-fl">
            <h2 class="mt-5 mb-3">Đăng nhập</h2>
              <form method="post" style="width: 300px;">
            <div class="form-group">
              <label for="username">Tài khoản</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
            </div>
            <div class="form-group">
              <label for="password">Mật khẩu</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
            <div class="form-group justify-content-between">
              <div class="form-check text-right">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember">Nhớ mật khẩu</label>
              </div>
            </div>
            <div class="form-group d-flex justify-content-between">
              <div class="ml-auto">
                <button type="submit" class="btn btn-warning" name="btn-login" id="btn-login">Đăng nhập</button>
              </div>
              <div class="ml-auto">
                <a href="./forgot.php">Quên mật khẩu?</a>
              </div>
            </div>
            <div class="text-center">
            Bạn chưa có tài khoản? <a href="./register.php"> Đăng ký</a>
          </form>

			<?php echo '<p style="color:red;">' .$warning. '</p>'; ?>
         </div>
            <p style="color:orange">
                <?php 
                    if(!empty($warning)){
                        echo $warning;
                    }
                ?>
            </p>
        </div>
    </div>
</div>

<?php include_once "../footer.php" ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>