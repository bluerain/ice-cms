<?php
/*********************************************
This is the Icy CMS adapter. Include this file
on all pages with editable content.
*********************************************/
define('SYSINIT', true);
require_once('icy-config.php');
require_once('lib/db.class.php');

//Globals
$pageContent = array();

//Output buffer callback
function icyOBcallback($d) {
	global $config;
	chdir(dirname($_SERVER['SCRIPT_FILENAME']));
	$c = explode("/", $_SERVER['PHP_SELF']);
	$cfile = $config['sys_folder']."cache/".$c[count($c) - 1].".txt";
	file_put_contents($cfile, $d);
	return $d;
}

class ICYCMS {
	private $in_editor_mode = false;
	private $currentPage = "";
	
	function __construct() {
		if($_REQUEST['edit']=="true") {
			$this->in_editor_mode = true;
		}
	}
	
	public function load($page_name, $cache = 'n', $lifetime = 0) {
		global $config, $db, $pageContent;
		if($cache==='n') { $cache = (boolean) $config['use_cache']; }
		$this->currentPage = $this->sanitize($page_name);
		
		//Cache
		if($cache==true) {
			$c = explode("/", $_SERVER['PHP_SELF']);
			$cfile = $config['sys_folder']."cache/".$c[count($c) - 1].".txt";
			if(file_exists($cfile) && time() - filemtime($cfile) < $lifetime*60) {
				echo file_get_contents($cfile);
				die();
			} else {
				ob_start("icyOBcallback");	
			}
		}
		$this->loadPageData();
	}

	public function head($include_jquery = true) {
		return 0;	
	}
	
	public function e($field_name, $element, $type = "field", $attrs = array()) {  //Inserts an element into the page. Equal to element().
		global $config, $pageContent;
		switch($type) {
			case "field":
				$type = "field"; break;
			case "area":
				$type = "area"; break;
			default:
				echo "Error: Invalid type.";
				return false;
				break;
		}
		$field_name = $this->sanitize($field_name);
		echo '<', $element, ' ';
		if(is_array($attrs) && count($attrs) > 0) {
			foreach($attrs as $key => $val) {
				echo "$key=\"$val\" ";
			}
		}
		echo ">";
		if(!isset($pageContent[$field_name])) {
			$this->createDBrecord($field_name, $type);
		} else {
			echo $pageContent[$field_name];
		}
		echo "</", $element, ">";
	}
	
	public function img($field_name, $height=0, $width=0, $attrs = array()) {
		
	}
	public function createDBrecord($field_name, $type) {
		global $config, $db;
		$cp = $this->currentPage;
		if($config['dev_mode']==false) {
			echo 'Dev-mode off -- Record creation failed';
			return false;
		}
		$sql = 'INSERT IGNORE INTO ' . $config['content_table'] . " (fieldname, content, pagename, fieldtype) VALUES ('$field_name', 'Empty Element', '$cp', '$type');";
		$db->connect();
		$r = $db->query($sql);
		if(!$r) {
			echo 'Database Error';
		}
		echo "Empty Element";
		return true;
	}
	
	public function loadPageData() {
		//Create the array of page fields
		global $db, $config, $pageContent;
		$sql = "SELECT content, fieldname FROM ". $config['content_table'] ." WHERE pagename = '$this->currentPage'";
		$db->connect();
		$res = $db->query($sql);
		
		if($res) {
			while($row = mysql_fetch_array($res)) {
				$pageContent[$row['fieldname']] = $row['content'];
			}
		}
		$db->close();
	}
	
	public function is_editing() {
		return $this->in_editor_mode;	
	}
	public function sanitize($str) {
		$reg = '/[^A-Za-z0-9_]/';
		return preg_replace($reg,'',$str);
	}
	
}

if($_REQUEST['edit']=="true") { // This is just for now
	require_once('editor/editor.php');
	$icy = new ICYCMSEDIT();
} else {
	$icy = new ICYCMS();
}

//Shorthand functions below. Enable/disable in config.php

if($config['use_shorthand']===true) {
	function element($field_name, $element, $type = "field", $attrs = array()) {
		global $icy;
		$icy->e($field_name, $element, $type, $attrs);
	}
}

?>