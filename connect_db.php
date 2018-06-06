<?php 
	class dbConfig {
		var $vDbConnect;
		function _construct() {
			
		}
		
		function _destruct() {
			$this->vDbConnect->close();
		}
		
		function dbConnect() {
			$this->vDbConnect = new mysqli('localhost','root','','api_login');
			if ($this->vDbConnect->connect_errno) {
				echo "Can't connect Database";die;
			} else {
				return $this->vDbConnect;
			}
		}
	}
?>