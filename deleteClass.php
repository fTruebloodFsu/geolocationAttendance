<?php
require_once 'configMySQL.php';

$myarray = (isset($_POST['myarray'])) ? $_POST['myarray'] : ['0'];
$myarray = json_decode($myarray, true);

$CID = $myarray['CourseID'];
$CName = $myarray['CourseName'];

$sql = "SELECT * FROM classes WHERE CourseID = '$CID' AND CourseName = '$CName';";
$result = $link->query($sql) or die($link->error);

$resultsJSON = array();

while($row = $result->fetch_assoc()){
	$resultsJSON[] = $row;
}

if(count($resultsJSON) == 1){
	$sql = "DELETE FROM classes WHERE CourseID = '$CID' AND CourseName = '$CName';";
	$link->query($sql) or die($link->error);
	
	$Tname = $CID.$CName;
	
	$sql1 = "DROP TABLE `".$Tname."`;";
	$link->query($sql1) or die($link->error);
	
	$jsonAcceptResponse = new stdClass();
	$jsonAcceptResponse->status = "success";
	$jsonAcceptResponse->reason = "Class Deleted";
}else{
	$jsonAcceptResponse = new stdClass();
	$jsonAcceptResponse->status = "failed";
	$jsonAcceptResponse->reason = "Class Not Found";
}

echo json_encode($jsonAcceptResponse);
?>