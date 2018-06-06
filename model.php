<?php
include("connect_db.php");
class getDataFromDb {
	private $dbVar;
	var $vDbConnect;
	var $result;
	var $table = '';

	function __construct(){
		$this->table = 'user';
	}

	function __destruct(){

	}

	/*
	* Kiem tra tai khoan co ton tai hay khong
	*/	
	function checkUsername($username) {
		$this->dbVar = new dbConfig();
		$this->vDbConnect = $this->dbVar->dbConnect();

		$sql = "SELECT * FROM ".$this->table." WHERE username = '".$username."'";
		$this->result = $this->vDbConnect->query($sql);
		if($this->result->num_rows > 0){
			$resultSet = array();
			while($row = $this->result->fetch_assoc()) {
				$resultSet[] = $row;
			}
			$response = json_encode($resultSet);
		}else{
			$response = '';
		}	
		return $response;
	}
	
	/*
	* Kiem tra mat khau co dung khong
	*/	
	function checkPassword($username, $password) {
		$this->dbVar = new dbConfig();
		$this->vDbConnect = $this->dbVar->dbConnect();
		
		$sql = "SELECT * FROM ".$this->table." WHERE username = '".$username."' AND password = '".$password."'";
		$this->result = $this->vDbConnect->query($sql);
		if($this->result->num_rows > 0){
			return true;
		}else{
			return false;
		}	
	}
	
	/*
	* Lay thong tin user = username
	*/	
	function getUserByUsername($username) {
		$this->dbVar = new dbConfig();
		$this->vDbConnect = $this->dbVar->dbConnect();
		
		$sql = "SELECT * FROM ".$this->table." WHERE username = '".$username."'";
		$this->result = $this->vDbConnect->query($sql);
		if($this->result->num_rows > 0){
			$resultSet = array();
			while($row = $this->result->fetch_assoc()) {
				$resultSet[] = $row;
			}
			$response = json_encode($resultSet);
		}else{
			$response = '';
		}	
		return $response;
	}	
	
	/*
	* Kiem tra thong tin username bi trung
	*/	
	function checkUsernameForUpdate($id,$username) {
		$this->dbVar = new dbConfig();
		$this->vDbConnect = $this->dbVar->dbConnect();
		
		$sql = "SELECT * FROM ".$this->table." WHERE username = '".$username."' AND id != '".$id."'";
		$this->result = $this->vDbConnect->query($sql);
		if($this->result->num_rows > 0){
			return false;
		}else{
			return true;
		}	
	}
	
	/*
	* Cap nhat thong tin nguoi dung
	*/
	function updateUser($id, $username, $password = '', $address, $phone) {
		$this->dbVar = new dbConfig();
		$this->vDbConnect = $this->dbVar->dbConnect();
		
		if ($password == '') {
			$sql = "UPDATE ".$this->table." SET username = '".$username."',address = '".$address."', phone = '".$phone."' WHERE id='".$id."'";
		} else {
			$sql = "UPDATE ".$this->table." SET username = '".$username."',address = '".$address."',password = '".md5($password)."', phone = '".$phone."' WHERE id='".$id."'";
		}
		//echo $sql;die;
		$this->result = $this->vDbConnect->query($sql);
	}
}
?>