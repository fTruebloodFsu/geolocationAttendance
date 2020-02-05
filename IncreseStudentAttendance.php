<?php
require_once 'configMySQL.php';

$myarray = (isset($_POST['myarray'])) ? $_POST['myarray'] : ['0'];
$myarray = json_decode($myarray, true);

$StudentName = $myarray['StudentName'];
$CourseID = $myarray['CourseID'];

$sql = "SELECT * FROM students WHERE StudentName = '$StudentName' AND CourseID = '$CourseID';";

$result = $link->query($sql) or die($link->error);

$resultsJSON = array();

while($row = $result->fetch_assoc()){
	$resultsJSON[] = $row;
}

if(count($resultsJSON) == 1){
	$SN = $resultsJSON[0]['StudentName'];
	$CID = $resultsJSON[0]['CourseID'];
	$NUM = (Float) $resultsJSON[0]['NumTimeSignedIn'];
	$ATT = (Float) $resultsJSON[0]['Attendance'];

	$newNUM = $NUM + 1;
	$newATT = ($newNUM * $ATT)/$NUM;

	$sql1 = "UPDATE students SET NumTimeSignedIn = '$newNUM', Attendance = '$newATT' WHERE StudentName = '$SN' AND CourseID = '$CID';";
	$result1 = $link->query($sql1) or die($link->error);
	
	$jsonAcceptResponse = new stdClass();
	$jsonAcceptResponse->status = "Success";
	$jsonAcceptResponse->reason = "Attendance Increased";
	}else{
		$jsonAcceptResponse = new stdClass();
		$jsonAcceptResponse->status = "Failed";
		$jsonAcceptResponse->reason = "Student Not Found";
	}
echo json_encode($jsonAcceptResponse);
?>