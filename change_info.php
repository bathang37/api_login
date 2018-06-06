<?php 
session_start();
include("functions.php");
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
if (isset($_POST['ok'])) 
{
    //Kết nối tới database
    include("model.php");
     
    //Lấy dữ liệu nhập vào
    $username = xssClean(replaceBadChar($_POST['txtUsername']));
    $password = xssClean($_POST['oldPassword']);
    // mã hóa pasword
    $password = md5($password);
	$id = intval($_POST['id']);
     
    //Kiểm tra username
    if (!$username) {
        echo "Vui lòng nhập đầy đủ tên đăng nhập.<a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
     
    //Kiểm tra tên đăng nhập có tồn tại không
	$dB = new getDataFromDb();
	
    $checkUsername = json_decode($dB->checkUsernameForUpdate($id,$username));
    if ($checkUsername == NULL || $checkUsername == '') {
        echo "Tên đăng nhập này đã tồn tại. Vui lòng chọn tên khác. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
	
	$newPassword = xssClean($_POST['newPassword']);
	$newPassword2 = xssClean($_POST['newPassword2']);
	
	if ($newPassword != '' || $newPassword2 != '') {
		 
		//Check old password
		$checkPass = json_decode($dB->checkPassword($username,$password));
		
		//So sánh 2 mật khẩu mới có trùng khớp hay không
		if ($checkPass == false || $checkPass == '' || $checkPass == NULL) {
			echo "Mật khẩu hiện tại của bạn không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;
		}
		
		if ($newPassword != $newPassword2) {
			echo "Mật khẩu mới và xác nhận mật khẩu mới không chính xác. <a href='javascript: history.go(-1)'>Trở lại</a>";
			exit;		
		}
	}
    $address = addslashes($_POST['txtAddress']);
	$phone = addslashes(xssClean($_POST['txtPhone']));
    //Lưu thông tin mới
    $dB->updateUser($id, $username, $newPassword, $address, $phone);
    js_message("Bạn đã cập nhật thông tin thành công. Vui lòng đăng nhập lại!");
	session_destroy();
	js_redirect('index.php');
}
?>