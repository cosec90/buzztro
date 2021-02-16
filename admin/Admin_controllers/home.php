<?php 

error_reporting(0);

function HOME_CALL(){
	include '../Admin_config/connection.php';
	
	$home = array();

	//0
	$events_sql= "SELECT `evt_name` FROM `blog_events` WHERE `evt_status`='Ongoing'";
	$ev_result=mysqli_query($conn,$events_sql);
	$fetch=mysqli_fetch_assoc($ev_result);
	array_push($home, $fetch['evt_name']);

	//1
	$articles_sql= "SELECT COUNT(*) AS `tot_at` FROM `blog_article`";
	$at_result=mysqli_query($conn,$articles_sql);
	$fetch=mysqli_fetch_assoc($at_result);
	array_push($home, $fetch['tot_at']);

	//2
	$enq_sql= "SELECT COUNT(*) AS `tot_enq` FROM `blog_contact`";
	$enq_result=mysqli_query($conn,$enq_sql);
	$fetch=mysqli_fetch_assoc($enq_result);
	array_push($home, $fetch['tot_enq']);

	//3
	$enq_sql= "SELECT COUNT(*) AS `tot_enq` FROM `blog_contact`";
	$enq_result=mysqli_query($conn,$enq_sql);
	$fetch=mysqli_fetch_assoc($enq_result);
	array_push($home, $fetch['tot_enq']);

	return($home);
}
 ?>