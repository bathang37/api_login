<?php 
	/*
	* Ham in ra mang du lieu
	*/
	function pre($arr= array()) {
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
	}
	
	/*
	* Ham bao mat xoa xss
	*/
	function xssClean($data)
	{
		// Fix &entity\n;
		$data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
		$data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
		$data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
		$data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

		// Remove any attribute starting with "on" or xmlns
		$data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

		// Remove javascript: and vbscript: protocols
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
		$data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

		// Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
		$data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

		// Remove namespaced elements (we do not need them)
		$data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

		do {
			// Remove really unwanted tags
			$old_data = $data;
			$data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
		}
		while ($old_data !== $data);

		// we are done...
		return $data;
	}
	
	/*
	* Ham xoa nhung ki tu dac biet
	*/
	function replaceBadChar($p_string)
	{
		if ( get_magic_quotes_gpc()) {
			$p_string = stripslashes($p_string);
		}
		$p_string = str_replace('<', '&lt;', $p_string);
		$p_string = str_replace('>', '&gt;', $p_string);
		$p_string = str_replace('"', '&#34;', $p_string);
		$p_string = str_replace("'", '&#39;', $p_string);
		$p_string = str_replace('\\', '&#92;', $p_string);
		$p_string = str_replace('=', '&#61;', $p_string);
		$p_string = str_replace('(', '&#40;', $p_string);
		$p_string = str_replace(')', '&#41;', $p_string);
		$p_string = str_replace("|", '&#124;', $p_string);
		return $p_string;
	}
	
	/*
	* Ham kiem tra mang
	*/
	function check_array($p_array){
		if(is_array($p_array) and sizeof($p_array)>0){
			return true;
		}else{
			return false;
		}
	}

	/*
	* Ham alert thong bao
	*/
	function js_message($message)
	{
		js_set("alert('".$message."')");
	}
	
	/*
	* Ham set js
	*/
	function js_set($js_code, $output=true)
	{
		$text = "<script language=\"javascript\" type=\"text/javascript\">".$js_code."</script>";
		if ($output) {
			echo $text;
		}
		return $text;
	}
	
	/*
	* Ham redirect
	*/
	function js_redirect($url)
	{
		echo "<script>top.location.href=\"" .$url. "\"</script>";
		exit();
	}
?>