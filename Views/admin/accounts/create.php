<?php 
	include_once "function.php";
	$username = $password = $confirmPassword = $name = $email = $role = "";
	$errors = array();
	if (isset($_POST['btn-register'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirm-password'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$role = $_POST['role'];
		$errors = validateRegistrationData($username, $password, $confirmPassword, $name, $email, $role);
		 if (empty($errors)) {
			// Dữ liệu hợp lệ, tiếp tục xử lý đăng ký
			if(register($username, $password, $name, $email, $role)){
				array_push($errors, "Tao tai khoan thanh cong.");
				
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
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
  <title>tạo tài khoản</title>
</head>
<body>
  <div class="container">
  <div class="row">
			<a href="./?us=users&act=index" class="btn btn-primary">Quay lại</a>
		</div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <h2 class="text-center mb-4">Tạo tài khoản</h2>
        <form method="post">
          <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
          </div>
          <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
          </div>
          <div class="form-group">
            <label for="confirm-password">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password">
          </div>
		  <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
          </div>
		  <div class="form-group">
            <label for="email">Địa chỉ email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
          </div>

		<?php 
			$roles = getAll('roles');
			foreach ($roles as $role) {
		?>
			<div class="col-xs-12 col-sm-6">
				<input type="radio" id="role-<?php echo $role['id'];?>" name="role" value="<?php echo $role['id']; ?>">
				<label for="role-<?php echo $role['id'];?>"><?php echo $role['name']; ?></label>
			</div>
		<?php
			}
		?>
		  
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="btn-register" id = "btn-register">Đăng ký</button>
          </div>
		  <div class="text-center">
            <!-- Already have an account? <a href="login.php">Login here</a> -->
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