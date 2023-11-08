<?php 
	include_once "function.php";
	$username = $password = $confirmPassword = $name = $email =  "";
	$agree = false;
	$errors = array();
	if (isset($_POST['btn-register'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirm-password'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		if(isset($_POST['agree'])){
			$agree = true;
		}
		$errors = validateRegistrationData($username, $password, $confirmPassword, $name, $email, $agree);
		    if (empty($errors)) {
        // Dữ liệu hợp lệ, tiếp tục xử lý đăng ký
		if(register($username, $password, $name, $email)){
			header("Location: ./enterconfirmcode.php?user=". urlencode(md5($username)));
			exit;
		}
		else{
			array_push($errors, "Tai khoan da ton tai");
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
  <title>Registration</title>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <h2 class="text-center mb-4">Registration</h2>
        <form method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
          </div>
          <div class="form-group">
            <label for="confirm-password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password">
          </div>
		  <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
          </div>
		  <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
          </div>
          <div class="form-group">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="agree" name="agree">
              <label class="form-check-label" for="agree">I agree to the terms and conditions</label>
            </div>
          </div>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="btn-register" id = "btn-register">Register</button>
          </div>
		  <div class="text-center">
            Already have an account? <a href="./login.php">Login here</a>
			<p style="color:red">
				<?php 
				if(!empty($errors)){
					foreach ($errors as $error) {
						echo $error . "<br>";
					}
				}			
				?>
			</p>

          </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>