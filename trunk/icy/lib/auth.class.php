<?php
class Authentication {
	
	public $error;
	
	public function __construct() {
		session_start();
		if(!isset($_SESSION['userlevel'])) $_SESSION['userlevel'] = 0;
		
		return true;
	}
	public function init($req_userlevel){
		if($_SESSION['userlevel']==0 && $req_userlevel > 0) {
			if(file_exists('./ad-login.php')) {
				header("Location: ./ad-login.php?next=".urlencode($_SERVER['PHP_SELF'])."&msg=You+need+to+login+to+view+this+resource.");
			} else {
				header("Location: ./admin/ad-login.php?next=".urlencode($_SERVER['PHP_SELF'])."&msg=You+need+to+login+to+view+this+resource.");
			}
			die();
		}
		elseif($_SESSION['userlevel']<$req_userlevel) {
			die('You are not allowed to view this page.');
		}
	}
	public function loginProcess() {
		if(isset($_POST['username'])) {
			
			$_POST = $this->sanitize($_POST);
			
			$db->connect();
			$sql = "SELECT username, password, userlevel FROM users WHERE username='".$_POST['username']."' LIMIT 1";
			$result = $db->query($sql);
			if(!$result) { if($_GET['xhr']==true){die(0);} $this->error = "Wrong username/password"; }
			while($row = mysql_fetch_array($result))
			  {
				if($row['password']==md5($_POST['password'])) {
					$_SESSION['username']=$row['username'];
					$_SESSION['userlevel'] = $row['userlevel'];
					if($_GET['xhr']==true){die(1);}
					if(isset($_POST['nextpage'])) {header('Location: '.urldecode(strip_tags($_POST['nextpage']))); die();}
					else{header('Location: ./');}
					continue;
				} else {
					if($_GET['xhr']==true){die(0);}
					$this->error = "Wrong username/password";
					continue;
				}
			  }
		}
		elseif(isset($_GET['logout'])){
			session_destroy();
			header('Location: ./');
		}
	}
	public function sanitize($input) {
		
		if(is_array($input)) {
		  foreach($input as $key => $val){
			  $input[$key] = $this->sanitize($val);
		  }
		  return $input;
		}
		else if(is_string($input)) {
			return filter_var($input, FILTER_SANITIZE_STRING);
		}
		else if(is_int($input)) {
			return filter_var($val, FILTER_SANITIZE_NUMBER_INT);
		}
		else if(is_float($input)) {
			return ilter_var($val, FILTER_SANITIZE_NUMBER_FLOAT);
		}
	}
}

$Auth = new Authentication();

?>