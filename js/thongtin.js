$(document).ready(function() {
	$('#button_change').click(function(){
		if ($('#txtUsername').val() == '') {
			alert('Bạn phải nhập tên đăng nhập!');
			$('#txtUsername').focus();
			return;
		}
		$('#form_change').submit();
	})
	$('#form_change').keyup(function(e){
		if(e.keyCode == 13)
		{
			if ($('#txtUsername').val() == '') {
				alert('Bạn phải nhập tên đăng nhập!');
				$('#txtUsername').focus();
				return;
			}
			$('#form_change').submit();
		}
	});
})