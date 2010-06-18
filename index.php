<?php
include('icy/icy-adapter.php');
$icy->load("index", false, 1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Icy CMS demo.</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<?php $icy->head(); ?>
</head>
<body>
<div class="header">
	<div class="center">
		<h1>Company Name, inc.</h1>
        <a href="page2.php" class="menu">Second page</a>
    </div>
</div>
<div class="center">
	<div class="divider" id="scroller"></div>
    <img src="cityscape.jpg" alt="cityscape" />
    <div class="divider"></div>
    <div class="textBody">
    	<h2>Contrary to popular belief,</h2>
        <div class="divider"></div>
        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui</p>
        <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
    </div>
    <div class="sidebar">
    	<p class="imgtext">Above: Photograph of the HQ of Company Name inc, comfortably located on the 87<sup>TH</sup> floor of the J. Doe building, identifiable as the tall building with windows.
        </p>
		<h4 class="f">About us</h4>
        <ul>
        	<li>Founded: <i>1849</i></li>
            <li>Owned by: <i>Jane D Oh</i></li>
            <li>Chairman: <i>Lucas T Ford</i></li>
            <li>Employees: <i>89 444</i></li>
            <li>Clients: <i>634 996</i></li>
            <li>Earnings: <i>$188 000 144</i></li>
            <li>Generic: <i>Yes</i></li>
        </ul>
    </div>
    <div class="divider"></div>
	<div class="mantra">Long generic mantra with words like effectivity and initiatives supposed to make us seem more trustworthy.</div>
    <div class="divider"></div>
    <div class="exp left">
    "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."
    </div>
    <div class="exp right">
    	"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet.
    </div>
    <div class="divider"></div>
</div>
<div class="footer">
</div>
</div>
<?php if(!$icy->is_editing()) : ?>
	<script type="text/javascript" src="icy/lib/jquery.js"></script>
	<script type="text/javascript" src="main.js"></script>
<?php endif; ?>
</body>
</html>