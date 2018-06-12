<?php
	session_start();

	$mysqli=mysqli_connect('localhost','root','','COMPANY') or die("Database Error");
    
	$choice = mysqli_real_escape_string($mysqli, $_GET['oldname']);
	
	$query = "SELECT * FROM EMPLOYEE WHERE FullName='$choice'";
	
	$result = mysqli_query($mysqli, $query);
	
	$row = mysqli_fetch_array($result);
	
	$_POST['fn'] = $row{'FullName'};
	$_POST['pn'] = $row{'PositionName'};
	$_POST['bd'] = $row{'Bdate'};
	$_POST['s'] = $row{'Sex'};

	 
	//echo $row{'FullName'}. ' '. $row{'PositionName'}. ' '. $row{'Bdate'}. ' '.$row{'Sex'};
?>
