<?php
error_reporting(0);

function FETCH_NEWSLETTERS()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT * FROM `buzztro_newsletter` WHERE `status` = 'Not Downloaded'";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) 
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$newsletters[] = $row;
		}
	}

	return ($newsletters);
}

function FETCH_NEWSLETTERS_ALL()
{
	include '../Admin_config/connection.php';

	$sql= "SELECT `mail` FROM `buzztro_newsletter`";
	$result=mysqli_query($conn,$sql);
	$count = mysqli_num_rows($result);

	if ($count > 0) 
	{
		while($row = mysqli_fetch_assoc($result))
		{
			$newsletters[] = $row;
		}
	}

	return ($newsletters);
}


function ExportCSVFile($records) 
{
	include '../Admin_config/connection.php';
	// create a file pointer connected to the output stream
	$fh = fopen( 'php://output', 'w' );
	$heading = false;

	if(!empty($records))
	  foreach($records as $row) {
		if(!$heading) {
		  // output the column headings
		  fputcsv($fh, "Emails");
		  $heading = true;
		}
		// loop over the rows, outputting them
		 fputcsv($fh, array_values($row));
		 
	  }
	  

	$sql= "UPDATE `buzztro_newsletter` SET `status`='Downloaded' WHERE 1";
	$result=mysqli_query($conn,$sql);

	fclose($fh);
}

?>