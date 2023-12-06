<?php 
	include "function.php";
	$id = $_GET['id'];
	$user = getdetailbyid($id);
	$data = $user[0];
	if(isset($_POST['btn-register'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$name = $_POST['name'];
		$email = $_POST['email'];
		$role = $_POST['role'];
		$errors = array();
		if(isFormDataChanged($id, $username, $password, $name, $email, $role, $data)){
			updateUser($id, $username, $password, $name, $email, $role);
			array_push($errors, "Cập nhật thành công.");
		}
	}
	$user = getdetailbyid($id);
	$data = $user[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"> -->
  <title>Xem chi tiết tài khoản</title>
</head>
<body class="bg-light">
  <div class="container">
  		<div class="row">
			<a href="./?us=users&act=index" class="btn btn-primary">Quay lại</a>
		</div>
    <div class="row justify-content-center mt-5">
      <div class="col-md-4">
        <h2 class="text-center mb-4">Xem chi tiết tài khoản</h2>
        <form method="post">
          <div class="form-group">
            <label for="username">Tên đăng nhập</label>
            <input type="text" class="form-control" id="username" name="username"  placeholder="Enter your username" value="<?php echo $data['username']; ?>">
          </div>
          <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="text" class="form-control" id="password" name="password"  placeholder="Enter your password" value="<?php echo $data['password']; ?>">
          </div>
		  <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" class="form-control" id="name" name="name"  placeholder="Enter your name" value="<?php echo $data['name']; ?>">
          </div>
		  <div class="form-group">
            <label for="email">Địa chỉ email</label>
            <input type="email" class="form-control" id="email" name="email"  placeholder="Enter your email" value="<?php echo $data['email']; ?>">
          </div>

		<?php 
			$roles = getAll('roles');
			foreach ($roles as $role) {
		?>
			<div class="col-xs-12 col-sm-6">
				<input type="radio" id="role-<?php echo $role['id'];?>" name="role" value="<?php echo $role['id'];?>" <?php if(isset($data['role']) && $data['role'] == $role['id']) echo 'checked'; ?>>
				<label for="role-<?php echo $role['id'];?>"><?php echo $role['name']; ?></label>
			</div>
		<?php
			}
		?>
          <div class="form-group text-center">
            <button type="submit" class="btn btn-primary" name="btn-register" id = "btn-register">Update</button>
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