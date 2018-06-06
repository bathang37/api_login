<?php 
session_start();
include("functions.php");
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION['username']) || $_SESSION['username'] == '') {
	header("Location: thongtin.php");
	exit();
} else {
    //Kết nối tới database
    include("model.php");
	
	$dB = new getDataFromDb();
	
	$username = $_SESSION['username'];
	$dataUser = json_decode($dB->getUserByUsername($username), true);
	if (check_array($dataUser[0])) { ?>
		<!DOCTYPE html>
		<html>
			<head>
				<title></title>
				<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
				<script type="text/javascript" src="js/jquery.min.js"></script>
				<script type="text/javascript" src="js/thongtin.js"></script>
				<link rel="stylesheet" type="text/css" href="css/style.css" />
			</head>
			<body>
				<div align="center">
					<center><h4>THÔNG TIN CỦA BẠN</h4></center>
					<form action='change_info.php' method='POST' id="form_change">
						<input type="hidden" name="id" value="<?php echo $dataUser[0]['id']; ?>" />
						<input type="hidden" name="ok" value="1" />
						<table align="center" border="1" cellpadding="5" cellspacing="0">
							<tr>
								<td>Tên đăng nhập:</td>
								<td><input type="text" id="txtUsername" name="txtUsername" value="<?php echo $dataUser[0]['username']; ?>" /></td>
							</tr>
							<tr>
								<td>Mật khẩu cũ:</td>
								<td><input type="password" name="oldPassword" value="" /></td>
							</tr>
							<tr>
								<td>Mật khẩu mới:</td>
								<td><input type="password" name="newPassword" value="" /></td>
							</tr>
							<tr>
								<td>Nhập lại mật khẩu mới:</td>
								<td><input type="password" name="newPassword2" value="" /></td>
							</tr>
							<tr>
								<td>Email:</td>
								<td><?php echo $dataUser[0]['email']; ?></td>
							</tr>
							<tr>
								<td>Địa chỉ:</td>
								<td><input type="text" name="txtAddress" value="<?php echo $dataUser[0]['address']; ?>" /></td>
							</tr>
							<tr>
								<td>Số điện thoại:</td>
								<td><input type="text" name="txtPhone" value="<?php echo $dataUser[0]['phone']; ?>" /></td>
							</tr>
							<tr>
								<td></td>
								<td><button type="button" id="button_change">Thay đổi thông tin</button></td>
							</tr>
						</table>
					</form>
				</div>
			</body>
		</html>
	<?php
	}
}