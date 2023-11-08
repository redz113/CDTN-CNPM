<?php 
	session_start();
    require_once "../../Controllers/BaseController.php";
    require_once "../../Core/Database.php";
    require_once "../../Models/BaseModel.php";
	
	$database = new Database();
	$conn = $database->connect();
	
	/**
	 * Login
	 */

	function login($username, $password, $rememberMe) {
    GLOBAL $conn;
    $filter_username = mysqli_real_escape_string($conn, $username);
    $filter_password = mysqli_real_escape_string($conn, $password);
    $sql = "SELECT * FROM users WHERE username = '$filter_username' AND password = '$filter_password' AND email_verified_at IS NOT NULL";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) == 1) {
        while ($row = mysqli_fetch_assoc($query)) {
            $_SESSION['id'] = $row['id'];
			$_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];
            if($rememberMe) {
                // Đặt thời gian tồn tại cho session là 30 ngày
                session_set_cookie_params(86400 * 30);
            } else {
                // Đặt thời gian tồn tại cho session là 1 ngày
                session_set_cookie_params(86400 * 1);
            }

            // session_start();
            break;
        }
        return true;
    }
    return false;
}
	function checkIfNotEmailVerified($username){
		GLOBAL $conn;
		$data = array();
		$filter_username = mysqli_real_escape_string($conn, $username);
		$sql = "SELECT * FROM users WHERE username = '$filter_username' AND email_verified_at IS NULL";
		$query = mysqli_query($conn, $sql);
		if(mysqli_num_rows($query) == 1) {
			$sql2 = "SELECT * FROM code_confirm WHERE username = '$filter_username'";
			$query2 = mysqli_query($conn, $sql2);
			if(mysqli_num_rows($query2) == 1) {
				while ($row = mysqli_fetch_assoc($query2)) {
					array_push($data, $row);
				}
			}	
		}
		return $data;
	}
	function CheckLogined(){
		if (isset($_SESSION['role'])){
			return true;
		}
		return false;
	}



	/**
	 * Regster
	 */
	 use PHPMailer\PHPMailer\PHPMailer;
	 use PHPMailer\PHPMailer\Exception;

	require './phpmailer/src/Exception.php';
	require './phpmailer/src/PHPMailer.php';	
	require './phpmailer/src/SMTP.php';
	
		function validateRegistrationData($username, $password, $confirmPassword, $name, $email, $agree) {
		GLOBAL $conn;
		$errors = [];
		// Kiểm tra tính hợp lệ của username
		if (empty($username)) {
			$errors[] = "Username không được để trống";
		}
		// Kiểm tra tính hợp lệ của password
		if (empty($password)) {
			$errors[] = "Password không được để trống";
		}
		// Kiểm tra tính hợp lệ của confirm password
		if (empty($confirmPassword)) {
			$errors[] = "Confirm Password không được để trống";
		} elseif ($password !== $confirmPassword) {
			$errors[] = "Confirm Password không khớp với Password";
		}
		// Kiểm tra tính hợp lệ của name
		if (empty($name)) {
			$errors[] = "Name không được để trống";
		}
		// Kiểm tra tính hợp lệ của email
		if (empty($email)) {
			$errors[] = "Email không được để trống";
		} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$errors[] = "Email không hợp lệ";
		}
		// Kiểm tra tính hợp lệ của agree
		if (!$agree) {
			$errors[] = "Bạn phải đồng ý với các điều khoản";
		}
        GLOBAL $conn;	
		$filter_username = mysqli_real_escape_string($conn, $username);
		$sql = "select * from users where username = '".$filter_username."'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
			$errors[] = "Tài khoản đã tồn tại";
		}
		$filter_email = mysqli_real_escape_string($conn, $email);
		$sql = "select * from users where email = '".$filter_email."'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
			$errors[] = "Email đã tồn tại";
		}
		return $errors;
	}
	
	function register($username, $password, $name, $email){
        GLOBAL $conn;
        $filter_username = mysqli_real_escape_string($conn, $username);
        $filter_password = mysqli_real_escape_string($conn, $password);
        $sql = "select * from users where username = '".$filter_username."'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) < 1){
            $sql = "insert into users (username, password, name, email, role) values('$filter_username','$filter_password', '$name', '$email', '3')";
            $query = mysqli_query($conn, $sql);
			SendMailConfirm($filter_username, $email);
            return true;
        }
        else{
            return false;
        }
    }
	
		function SendMailConfirm($username, $emailTo){
		$randomNumbers = '';
		for ($i = 0; $i < 6; $i++) {
			$randomNumbers .= rand(0, 9);
		}
		$randomString = (string) $randomNumbers;
		
		$mail = new PHPMailer(true);
		
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'hnueschoolapp@gmail.com';
		$mail->Password = 'omxvkhrwlbyyselg';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
		
		$mail->setFrom('hnueschoolapp@gmail.com');
		$mail->addAddress($emailTo);
		$mail->Subject = "Email xac nhan dang ky";
		$mail->Body = "Ma xac nhan cua ban la: ".$randomString;
		$mail->send();
		$md5 = md5($username);
		GLOBAL $conn;
		$sql = "insert into code_confirm (username, code, md5) values('$username','$randomString', '$md5')";
        $query = mysqli_query($conn, $sql);
	}



	/**
	 * Forgot Password
	 */
	function getUserDataByEmail($email){
		GLOBAL $conn;
		$data = array();
		$filter_email = mysqli_real_escape_string($conn, $email);
		$sql = "select * from users where email = '".$filter_email."' AND email_verified_at IS NOT NULL";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
			while ($row = mysqli_fetch_assoc($query)) {
				array_push($data, $row);
			}
		}
		return $data;
	}
		function SendMailResetPassword($username, $emailTo){
		GLOBAL $conn;
		// Kiểm tra xem có hàng nào trong bảng code_confirm tồn tại username hay chưa
		$checkSql = "SELECT * FROM code_confirm WHERE username = '$username'";
		$checkQuery = mysqli_query($conn, $checkSql);

		if (mysqli_num_rows($checkQuery) > 0) {
			// Có hàng tồn tại, không thực hiện DELETE
			$checkSql2 = "DELETE from code_confirm WHERE username = '$username'";
			$checkQuery2 = mysqli_query($conn, $checkSql2);
		} 
		$randomNumbers = '';
		for ($i = 0; $i < 6; $i++) {
			$randomNumbers .= rand(0, 9);
		}
		$randomString = (string) $randomNumbers;
		$link = "localhost/quang/Views/restpassword?id=".md5($username);
		$mail = new PHPMailer(true);
		
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = 'hnueschoolapp@gmail.com';
		$mail->Password = 'omxvkhrwlbyyselg';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = 465;
		
		$mail->setFrom('hnueschoolapp@gmail.com');
		$mail->addAddress($emailTo);
		$mail->Subject = "Email khoi phuc mat khau";
		$mail->Body = "Ma xac nhan cua ban la: ".$randomString ."\nBam vao day de khoi phuc may khau: ".$link;
		$mail->send();
		$md5 = md5($username);
		
		$sql = "INSERT INTO code_confirm (username, code, md5) VALUES ('$username','$randomString', '$md5')";
		$query = mysqli_query($conn, $sql);
	}



	/**
	 * Enter Confirm Code
	 */
	function getCodeConfirmByMd5($md5){
		GLOBAL $conn;	
		$code = array();
		$sql = "select * from code_confirm where md5 = '".$md5."'";
        $query = mysqli_query($conn, $sql);
		if(mysqli_num_rows($query) == 1) {
        while ($row = mysqli_fetch_assoc($query)) {
            array_push($code, $row);
        }
		}
		return $code;
	}
	
	function updateEmailVerificationTime($username){
		GLOBAL $conn;
		
		// Lấy thời gian hiện tại
		$verificationTime = date("Y-m-d H:i:s");
		
		// Escape và xử lý tên người dùng
		$filter_username = mysqli_real_escape_string($conn, $username);
		
		// Câu truy vấn UPDATE để cập nhật thời gian xác nhận email
		$sql = "UPDATE users SET email_verified_at = '$verificationTime' WHERE username = '$filter_username'";
		
		// Thực thi câu truy vấn
		$query = mysqli_query($conn, $sql);
		
		// Kiểm tra xem câu truy vấn đã thành công hay không
		if($query){
			return true;
		} else{
			return false;
		}
	}
	function deleteCodeConfirmByUsername($username) {
		GLOBAL $conn;

		// Chuẩn bị câu truy vấn DELETE
		$sql = "DELETE FROM code_confirm WHERE username = '$username'";

		// Thực thi câu truy vấn DELETE
		$query = mysqli_query($conn, $sql);
		
		// Kiểm tra xem câu truy vấn đã thành công hay không
		if($query){
			return true;
		} else{
			return false;
		}
	}



	/**
	 * Reset Password
	 */
	
	 function resetPassword($username, $newpassword){
		GLOBAL $conn;
		$filter_username = mysqli_real_escape_string($conn, $username);
		$filter_newpassword = mysqli_real_escape_string($conn, $newpassword);
		$sql = "update users set password = '".$filter_newpassword."' where username = '".$filter_username."'";
        $query = mysqli_query($conn, $sql);
	}
	// 	function deleteCodeConfirmByUsername($username) {
	// 	GLOBAL $conn;

	// 	// Chuẩn bị câu truy vấn DELETE
	// 	$sql = "DELETE FROM code_confirm WHERE username = '$username'";

	// 	// Thực thi câu truy vấn DELETE
	// 	$query = mysqli_query($conn, $sql);
		
	// 	// Kiểm tra xem câu truy vấn đã thành công hay không
	// 	if($query){
	// 		return true;
	// 	} else{
	// 		return false;
	// 	}
	// }
	// function getCodeConfirmByMd5($md5){
	// 	GLOBAL $conn;	
	// 	$code = array();
	// 	$sql = "select * from code_confirm where md5 = '".$md5."'";
    //     $query = mysqli_query($conn, $sql);
	// 	if(mysqli_num_rows($query) == 1) {
    //     while ($row = mysqli_fetch_assoc($query)) {
    //         array_push($code, $row);
    //     }
	// 	}
	// 	return $code;
	// }
?>