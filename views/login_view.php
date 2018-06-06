<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
<link rel="stylesheet" type="text/css" href="views/style.css" />
</head>
<body>
<div class="form-login" align="center">
	<?php
        if(isset($data['error']) && $data['error'] != ""){
            foreach($data['error'] as $err){
                echo "$err<br />";	
            }
        }
    ?>
    <form action="index.php/login" method="post">
    <fieldset>
		<legend>Member Login</legend>
        <label>Username:</label> <input type="text" name="txtuser" size="30" /><br />
        <label>Password:</label> <input type="password" name="txtpass" size="30" /><br />
        <label>&nbsp;</label> <input type="submit" name="ok" value="Submit" />
    </fieldset>   
    </form>
</div>
</body>
</html>