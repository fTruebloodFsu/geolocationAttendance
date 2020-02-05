<?php
require_once 'configMySQL.php';

$myarray = (isset($_POST['myarray'])) ? $_POST['myarray'] : ['0'];
$myarray = json_decode($myarray, true);

$SID = $myarray['StudentID'];
$CID = $myarray['CourseID'];

$sql1 = "SELECT * FROM students WHERE StudentID = '$SID' AND CourseID = '$CID';";
$result = $link->query($sql1) or die($link->error);

$resultsJSON = array();

while($row = $result->fetch_assoc()){
	$resultsJSON[] = $row;
}

if(count($resultsJSON) == 1){
	$sql = "DELETE FROM students WHERE StudentID = '$SID' AND CourseID = '$CID';";
	$link->query($sql) or die($link->error);
	
	$jsonAcceptResponse = new stdClass();
	$jsonAcceptResponse->status = "success";
	$jsonAcceptResponse->reason = "Student Deleted";
}else{
	$jsonAcceptResponse = new stdClass();
	$jsonAcceptResponse->status = "failed";
	$jsonAcceptResponse->reason = "Student Not Found";
}

echo json_encode($jsonAcceptResponse);
?>