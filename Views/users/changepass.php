<?php 
	include_once "function.php";
	$user = $_SESSION['id'];
	$old_password = "";
	$new_password = "";
	$confirm_password = "";
	$warning = "";
    $success = false;
	if(isset($_POST['btn-submit'])){
		$old_password = trim($_POST['old-password']);
		$new_password = trim($_POST['new-password']);
		$confirm_password = trim($_POST['confirm-password']);
		$data = getUserInfo($user);
		if (!empty($data) && $old_password == $data[0]['password']){
			if($old_password == $new_password){
				$warning = "Mật khẩu cũ và mật khẩu mới không được trùng nhau.\n";
			}
			else{
				if($new_password==$confirm_password){
					updatePassword($user, $new_password);
                    $success = true;
					$warning = "Đổi mật khẩu thành công. Vui lòng đăng nhập lại.";
				} else {
					$warning = "Mật khẩu mới không khớp, vui lòng thử lại";
				}
			}
			
		} else {
			$warning = "Mật khẩu cũ không đúng, vui lòng thử lại";
		}
	}
	include_once "../menu.php";
?>
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
.right-fl {
    width: 80%;
}
</style>
<link rel="stylesheet" href="css/style.css">
<div class="jumbotron jumbotron-fluid position-relative mb-0 pt-5">
    <div class="row">
        <div class="col-md-6 bg-primary d-flex flex-column justify-content-center align-items-center" style="height: 100vh;">
            <h1 class="text-white display-4 text-uppercase mt-4 mb-4">Học lập trình</h1>
            <h3 class="text-white display-5 text-uppercase mb-5">với Edu90minute</h3>
			<img src="img/aaaa.png" width="50%">
        </div>
        <div class="col-md-6 bg-primary right-fl">
            <h2 class="mt-5 mb-3">Đổi mật khẩu</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="otp">Nhập mật khẩu cũ:</label>
                    <input type="password" class="form-control" name="old-password" id="old-password" required style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="new-password">Mật khẩu mới:</label>
                    <input type="password" class="form-control" name="new-password" id="new-password" required style="width: 200px;">
                </div>
                <div class="form-group">
                    <label for="confirm-password">Xác nhận mật khẩu:</label>
                    <input type="password" class="form-control" name="confirm-password" id="confirm-password" required style="width: 200px;">
                </div>
                <button type="submit" class="btn btn-warning" name="btn-submit" id="btn-submit">Đặt lại mật khẩu</button>
            </form>
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
		<!-- Header End -->

		<svg style="background-color:#D9EEE1;" width="100%" height="70" viewBox="0 0 100 100" preserveAspectRatio="none">
		<path id="wavepath" d="M0,0  L110,0C35,150 35,0 0,100z" fill="rgba(40, 120, 235, 0.9)"></path>
		</svg>
    </div>

    <!-- Liên kết với Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?php 
    include_once "../footer.php";
?>
<?php 
    if($success){
        $success = false;
        echo '<script>setTimeout(function(){ window.location.href = "../../logout.php"; }, 3000);</script>';
    }
?>