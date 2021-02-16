<?php

session_start();

if (isset($_GET['logout'])) 
{
	session_destroy();
	echo '<script type="text/javascript">alert ("You have been logged out successfully");';
	echo 'window.location.href = "index.php?logged_out";';
	echo '</script>';
}
else
{
	session_destroy();
	echo '<script type="text/javascript">';
	echo 'window.location.href = "index.php?logged_out";';
	echo '</script>';
}

?>