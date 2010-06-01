<?php
class Database {
	
	/*******************************************
	* Configure the database here
	*
	*******************************************/
	
	protected $db_address = "localhost";
	protected $db_name = "public";
	protected $db_username = "default";
	protected $db_password = "default";
	
	/*******************************************
	* Don't alter anything below this line 
	* unless you know what you are doing
	*******************************************/
	
	protected $db;

	public function connect() {
		$this->db = mysql_pconnect($this->db_address,$this->db_username,$this->db_password);
		mysql_select_db($this->db_name,$this->db);
	}
	public function close() {
		mysql_close($this->db);
		return true;
	}
	public function query($q){
		return mysql_query($q, $this->db);
	}
	public function error(){
		return mysql_error($this->db);
	}
	
}
$db = new Database;



?>