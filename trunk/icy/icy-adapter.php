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
	
	function __construct() {
		
	}
	
	public function load($page_name, $cache = 'n', $lifetime = 0) {
		global $config, $db, $pageContent;
		if($cache==='n') { $cache = (boolean) $config['use_cache']; }
		
		//Cache
		if($cache==true && $this->in_editor_mode != true) {
			$c = explode("/", $_SERVER['PHP_SELF']);
			$cfile = $config['sys_folder']."cache/".$c[count($c) - 1].".txt";
			if(file_exists($cfile) && time() - filemtime($cfile) < $lifetime*60) {
				echo file_get_contents($cfile);
				die();
			} else {
				ob_start("icyOBcallback");	
			}
		}
		
		//Create the array of page fields
		$sql = "SELECT content, fieldname FROM ". $config['content_table'] ." WHERE pagename = '$page_name'";
		$db->connect();
		$res = $db->query($sql);
		
		if($res) {
			while($row = mysql_fetch_array($res)) {
				$pageContent[$row['fieldname']] = $row['content'];
			}
		}
		$db->close();
		print_r($pageContent);
	}

	public function head($include_jquery = true) {
		if($this->in_editor_mode!=true) { return 0; }
		global $config;
		if($include_jquery===true) {
			echo '<script type="text/javascript" src="', $config['baseurl'], $config['sys_folder'], 'lib/jquery.js"></script>';
		}
		echo '<script type="text/javascript" src="', $config['baseurl'], $config['sys_folder'], 'editor/editor.js"></script>';
		return 0;	
	}
	
	public function e($field_name, $element, $type = "field", $id = "", $classes = "") {  //Inserts an element into the page. Equal to element().
		
	}
	
	public function img($field_name, $height=0, $width=0, $id = "", $classes = "") {
		
	}
	
	public function is_editing() {
		return $this->in_editor_mode;	
	}
	
}

$icy = new ICYCMS();


//Shorthand functions below. Enable/disable in config.php

if($config['use_shorthand']===true) {
	function element($fi, $el, $ty = "field", $id = "", $cl = "") {
		$icy->e($fi,$el,$ty,$id,$cl);
	}
	function image($fi,$he=0,$wi=0,$id="",$cl="") {
		$icy->img($fi,$he, $wi, $id, $cl);
	}
}

?>