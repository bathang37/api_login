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
    $password = xssClean($_POST['txtPassword']);
	
    // mã hóa pasword
    $password = md5($password);
     
    //Kiểm tra tên đăng nhập có tồn tại không
	$dB = new getDataFromDb();
	
    $checkUsername = json_decode($dB->checkUsername($username));
    if ($checkUsername == NULL || $checkUsername == '') {
        echo "Tên đăng nhập này không tồn tại. Vui lòng kiểm tra lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
     
    //Check password
    $checkPass = json_decode($dB->checkPassword($username,$password));
    //So sánh 2 mật khẩu có trùng khớp hay không
    if ($checkPass == false || $checkPass == '' || $checkPass == NULL) {
        echo "Mật khẩu không đúng. Vui lòng nhập lại. <a href='javascript: history.go(-1)'>Trở lại</a>";
        exit;
    }
     
    //Lưu tên đăng nhập
    $_SESSION['username'] = $username;
    echo "Xin chào " . $username . ". Bạn đã đăng nhập thành công.";
	header("Location: thongtin.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/index.js"></script>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
    </head>
    <body>
		<div align="center">
			<div class="form-login-container">
				<form id="form_login" action='index.php' method='POST'>
					<input type="hidden" name="ok" value="1" />
					<table cellpadding='5' cellspacing='0' border='0'>
						<tr>
							<td>Tên đăng nhập :</td>
							<td>
								<input type='text' id='txtUsername' name='txtUsername' />
							</td>
						</tr>
						<tr>
							<td>Mật khẩu :</td>
							<td>
								<input type='password' id='txtPassword' name='txtPassword' />
							</td>
						</tr>
						<tr>
							<td></td>
							<td><button type="button" id="button_login">Đăng nhập</button></td>
					</table>
					
				</form>
			</div>
		</div>
    </body>
</html>