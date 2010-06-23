<?php defined('SYSINIT') or die('<b>Error:</b> No direct access allowed');

require_once('lib/auth.class.php');

class ICYCMSEDIT extends ICYCMS {
	
	public function load($page_name,$c,$l) {
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
	}
	
	public function head($include_jquery = true) {
		if($include_jquery===true) {
			echo '<script type="text/javascript" src="', $config['baseurl'], $config['sys_folder'], 'lib/jquery.js"></script>';
		}
		echo '<script type="text/javascript" src="', $config['baseurl'], $config['sys_folder'], 'editor/editor.js"></script>';
	}
	
}
?>