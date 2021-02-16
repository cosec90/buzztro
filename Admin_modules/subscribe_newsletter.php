<?php 
include '../Admin_controllers/newsletter.php';

session_start();

if(isset($_POST['newsletter_button']))
{
	$email = $_POST['newsletter_mail'];

	$res = ADD_NEWSLETTER($email);
}

?>