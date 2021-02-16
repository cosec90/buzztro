<?php 
include '../Admin_controllers/enquiries.php';

session_start();

if(isset($_POST['submit']))
{
	$id = $_SESSION['user_id'];
	$name = ucwords($_POST['name']);
	$subject = ucfirst($_POST['subject']);
	$email = $_POST['email'];
	$msg = str_replace("'","\'",nl2br($_POST['message']));

	$res = ADD_ENQUIRY($id,$name,$subject,$email,$msg);
}

if(isset($_POST['about_submit']))
{
	$comp_name = ucwords($_POST['company_name']);
	$mob_num = $_POST['mob_num'];
	$email = $_POST['email'];

	$res = ADD_ABOUT_ENQUIRY($comp_name,$mob_num,$email);
}

?>