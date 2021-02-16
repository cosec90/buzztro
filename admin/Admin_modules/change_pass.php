<?php 
include '../Admin_config/connection.php';
include '../Admin_controllers/user.php';

session_start();

if(isset($_POST['change'])){
	$username = $_SESSION['adm_username'];
	$old = md5($_POST['old']);
	$new = $_POST['new'];
	$confirm = $_POST['confirm'];

	$check = USER_VALIDATE($username,$old);

	if($check != $old) 
	{ 
		echo '<script type="text/javascript">alert("Old password did not match");';
	 	echo 'window.location.href = "../views/changepass.php?error";';
	 	echo '</script>';
	} 
	else
	{
		if ($new != $confirm) {
		echo '<script type="text/javascript">alert("New Password & Corfirm Password did not match");';
		echo 'window.location.href = "../views/changepass.php?error";';
		echo '</script>';
		}else{
			$hashed = md5($new);
			$change_pass = USER_CHANGE_PASS($username,$hashed);
		}
	}
}

?>