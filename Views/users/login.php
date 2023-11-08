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
					$warning = "Wrong login information.";
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
<div class="container">
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <h2 class="text-center mb-4">Login</h2>
        <form method="post">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
          </div>
			<div class="form-group justify-content-between">
            <div class="form-check text-right">
              <input type="checkbox" class="form-check-input" id="remember" name="remember">
              <label class="form-check-label" for="remember">Remember me</label>
            </div>
          </div>
          <div class="form-group d-flex justify-content-between">
            <div class="ml-auto">
              <button type="submit" class="btn btn-primary" name="btn-login" id="btn-login">Submit</button>
            </div>
            <div class="ml-auto">
              <a href="./forgot.php">Forgot password?</a>
            </div>
          </div>
        </form>
		<div class="text-center">
            Do not have an account? <a href="./register.php">Register here</a>
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