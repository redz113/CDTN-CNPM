<?php 
	// session_start();
    // require_once "../../../Controllers/BaseController.php";
    // require_once "../../../Core/Database.php";
    // require_once "../../../Models/BaseModel.php";
	
	$database = new Database();
	$conn = $database->connect();

	//Get all 
	function getAll($table, $select = ['*']){
		GLOBAL $conn;
		$select = implode(',', $select);
		$sql = "SELECT $select FROM $table";
		$query = mysqli_query($conn, $sql);
		$data = [];
		while($row = mysqli_fetch_array($query)){
			$data[] = $row;
		}

		return $data;
	}
	
	function getlistuser($pageIndex){
		GLOBAL $conn;
		$offset = $pageIndex * 10; // Calculate the offset based on the page index
		$sql = "SELECT users.id, users.name, users.username, users.email, roles.name as role
				FROM users 
				JOIN roles ON users.role = roles.id 
				WHERE users.email_verified_at IS NOT NULL 
				LIMIT 10 OFFSET $offset";
		$query = mysqli_query($conn, $sql);
		$data = array();
		if($query) { // Check if the query was successful
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
		}
		return $data;
	}
	
	// create users
	function validateRegistrationData($username, $password, $confirmPassword, $name, $email, $role) {
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
		    // Kiểm tra tính hợp lệ của role
		if (empty($role)) {
			$errors[] = "Vui lòng chọn quyền (Role)";
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
		function register($username, $password, $name, $email, $role){
        GLOBAL $conn;
        $filter_username = mysqli_real_escape_string($conn, $username);
        $filter_password = mysqli_real_escape_string($conn, $password);
        $sql = "select * from users where username = '".$filter_username."'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) < 1){
            $sql = "insert into users (username, password, name, email, email_verified_at, role) values('$filter_username','$filter_password', '$name', '$email', NOW(), '$role')";
            $query = mysqli_query($conn, $sql);
            return true;
        }
        else{
            return false;
        }
    }
	
	//Get detail
	function getdetailbyid($id){
    GLOBAL $conn;
    $sql = "SELECT *
            FROM users 
            WHERE users.id = $id AND email_verified_at IS NOT NULL";
	$query = mysqli_query($conn, $sql);
		$data = array();
		if($query) { // Check if the query was successful
			while($row = mysqli_fetch_assoc($query)){
				$data[] = $row;
			}
		}
		return $data;
}

	//update
	function isFormDataChanged($id, $username, $password, $name, $email, $role, $user){
		// So sánh giá trị trước và sau khi gửi form
		if ($username != $user['username'] || $password != $user['password'] || $name != $user['name'] || $email != $user['email'] || $role != $user['role']) {
			return true; // Dữ liệu đã thay đổi
		} else {
			return false; // Dữ liệu không thay đổi
		}
	}
	function updateUser($id, $username, $password, $name, $email, $role){
		GLOBAL $conn;
		// Khởi tạo câu truy vấn SQL
		$sql = "UPDATE users 
            SET username = '$username', password = '$password', name = '$name', email = '$email', role = '$role' 
            WHERE id = $id";
		$result = mysqli_query($conn, $sql);
		return $result;
	}
	
	//delete
	function deleteUser($id){
		GLOBAL $conn;
		$sql = "Delete from users WHERE id = $id";
		$result = mysqli_query($conn, $sql);
		return $result;
	}
?>