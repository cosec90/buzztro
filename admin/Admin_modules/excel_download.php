<?php
include '../Admin_config/connection.php';
include '../Admin_controllers/newsletters.php';

if (isset($_POST['download_excel'])) 
{
	$all_newsletters = FETCH_NEWSLETTERS_ALL();
			 
	$filename = "newsletter_data_".date('Ymd').".csv"; 
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Content-type: text/csv");
	header("Content-Disposition: attachment; filename=\"$filename\"");
	ExportCSVFile($all_newsletters);
	//$_POST["ExportType"] = '';
    exit();

}
?>