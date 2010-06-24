<?php defined('SYSINIT') or die('<b>Error:</b> No direct access allowed');

require_once('/../lib/auth.class.php');

class ICYCMSEDIT extends ICYCMS {
	private $currentPage = '';
	
	public function head($include_jquery = true) {
		global $config;
		if($include_jquery===true) {
			echo '<script type="text/javascript" src="', $config['baseurl'], $config['sys_folder'], 'lib/jquery.js"></script>';
		}
		echo '<script type="text/javascript" src="', $config['baseurl'], $config['sys_folder'], 'editor/editor.js"></script>';
	}
	
	public function e($field_name, $element, $type = 'field', $attrs = array()) {  //Inserts an element into the page. Equal to element().
		global $config, $pageContent;
		switch($type) {
			case 'field':
				$type = 'field'; break;
			case "area":
				$type = 'area'; break;
			default:
				echo 'Error: Invalid type.';
				return false;
				break;
		}
		$field_name = $this->sanitize($field_name);
		echo '<', $element, ' ';
		if(is_array($attrs) && count($attrs) > 0) {
			$attrs = array_change_key_case($attrs);
			if(!isset($attrs['class'])) {
				$attrs['class'] = '';
			}
			$attrs['class'] .= ' icyEditable';
			if($type == 'field') {
				$attrs['class'] .= ' icyField';
			} else {
				$attrs['class'] .= ' icyArea';
			}
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
	
}
?>