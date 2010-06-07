<?php
/*********************************************
This is the Icy CMS adapter. Include this file
on all pages with editable content.
*********************************************/


class ICYCMS {
	private $in_editor_mode = false;
	
	
	function __construct() {
		define('SYSINIT', true); 
		require('config.php');
	}
	
	public function cache() { //caches page to a file by using the output buffer. Requires $this->eod(). Use at top of 
		
	}
	
	public function eod() { //End-of-document. Required in combination with $this->cache().
		
	}
	
	public function head($include_jquery) {
		
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


//Shorthand functions below. Configure in config.php

if($config['use_shorthand']===true) {
	function element($fi, $el, $ty = "field", $id = "", $cl = "") {
		$icy->e($fi,$el,$ty,$id,$cl);
	}
	function image($fi,$he=0,$wi=0,$id="",$cl="") {
		$icy->img($fi,$he, $wi, $id, $cl);
	}
}

?>