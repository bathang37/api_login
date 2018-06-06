$(document).ready(function() {
	$('#button_login').click(function(){
		if ($('#txtUsername').val() == '') {
			alert('Bạn phải nhập tên đăng nhập!');
			$('#txtUsername').focus();
			return;
		}
		if ($('#txtPassword').val() == '') {
			alert('Bạn phải nhập mật khẩu!');
			$('#txtPassword').focus();
			return;
		}
		$('#form_login').submit();
	})
	$('#form_login').keyup(function(e){
		if(e.keyCode == 13)
		{
			if ($('#txtUsername').val() == '') {
				alert('Bạn phải nhập tên đăng nhập!');
				$('#txtUsername').focus();
				return;
			}
			if ($('#txtPassword').val() == '') {
				alert('Bạn phải nhập mật khẩu!');
				$('#txtPassword').focus();
				return;
			}
			$('#form_login').submit();
		}
	});
})