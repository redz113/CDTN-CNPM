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
      <div class="col-md-8">
        <h2 class="text-center mb-4">Tạo tài khoản</h2>
        <form method="post">
			<div class="row">
				<div class="col-md-6 form-group">
					<strong class="form-lable " for="name">Họ và tên</strong>
					<input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
				</div>
				<div class="col-md-6 form-group">
					<strong class="form-lable " for="username">Tên đăng nhập</strong>
					<input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
				</div>
			</div>

			<div class="row">
				<div class="col-md-6 form-group">
					<strong class="form-lable " for="password">Mật khẩu</strong>
					<input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
				</div>

				<div class="col-md-6 form-group">
					<strong class="form-lable " for="confirm-password">Xác nhận mật khẩu</strong>
					<input type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm your password">
				</div>
			</div>
          
		  	
			<div class="form-group">
				<strong class="form-lable " for="email">Địa chỉ email</strong>
				<input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
			</div>

			<div class="row">
				<div class="form-group col-auto">
					<strong class="form-lable " for="role">Vai trò</strong>
					<select name="role" class="form-control text-center" id="role">
						<option value=" " selected>-------</option>
						<?php
							$roles = getAll('roles');
							foreach($roles as $role){
								echo "<option value=' " . $role['id'] . " '> " . $role['name'] . " </option>";
							}
						?>
					</select>
				</div>
			</div>
		  
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