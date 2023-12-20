<?php 
	include_once "function.php";
	$user = $_SESSION['id'];
	$userInfo = getUserInfo($user);
    $edit_enable = "";
    $warning  = "";
    $success = false;
    if(isset($_POST['btn-save'])){
        $name = trim($_POST['fullname']);
        $email = trim($_POST['email']);
        $ngaysinh = trim($_POST['birthdate']);
        if(UpdateInfor($_SESSION['id'], $name, $email, $ngaysinh)){
            $warning  = "Thay đổi thông tin cá nhân thành công.";
            $success = true;
            $_SESSION['name'] = $name;
        }
        else{
            $warning  = "Thay đổi thông tin cá nhân không thành công.";
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <label for="username">Tên đăng nhập:</label>
                <input type="text" class="form-control" name="username" id="username" style="width: 200px;" value="<?php echo $userInfo[0]['username']; ?>" <?php if(!$edit_enable){echo "disabled";}?>>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" name="email" id="email" style="width: 300px;" value="<?php echo $userInfo[0]['email']; ?>" <?php if(!$edit_enable){echo "disabled";}?>>
            </div>
            <div class="form-group">
                <label for="fullname">Họ và tên:</label>
                <input type="text" class="form-control" name="fullname" id="fullname" style="width: 300px;" value="<?php echo $userInfo[0]['name']; ?>" <?php if(!$edit_enable){echo "disabled";}?>>
            </div>
            <div class="form-group">
                <label for="birthdate">Ngày sinh:</label>
                <input type="date" class="form-control" name="birthdate" id="birthdate" style="width: 200px;" value="<?php if($userInfo[0]['birthday']!=null) {echo $userInfo[0]['birthday'];} ?>" <?php if(!$edit_enable){echo "disabled";}?>>
            </div>
                <input type="submit" class="btn btn-warning" name="btn-edit" id="btn-edit" value="Chỉnh sửa.">
                <input type="submit" class="btn btn-warning" name="btn-save" id="btn-save" value="Lưu" hidden>
            </form>
            <p style="color:red">
                <?php 
                    if(!empty($warning)){
                        echo $warning;
                    }
                ?>
            </p>
        </div>
    </div>
</div>

    <!-- Liên kết với Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<?php 
    include_once "../footer.php";
    if($success){
        $success = false;
        echo '<script>setTimeout(function(){ location.reload(); }, 3000);</script>';
    }
?>

<script>
    $(document).ready(function(){
        $('#btn-edit').click(function(event){
            event.preventDefault(); // Ngăn chặn hành động mặc định của nút submit
            $('input').prop('disabled', false); // Tắt thuộc tính disabled của các trường input
            $('#btn-edit').prop('disabled', true); // Tắt nút "btn-edit"
            $('#btn-save').prop('hidden', false); // Tắt thuộc tính disabled của các trường input
        });
    });
</script>



