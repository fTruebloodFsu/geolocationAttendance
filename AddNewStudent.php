<?php 
require_once 'configMySQL.php';

$myarray = (isset($_POST['myarray'])) ? $_POST['myarray'] : ['0'];
$myarray = json_decode($myarray, true);

$sql = "CREATE TABLE IF NOT EXISTS Students (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
StudentID VARCHAR(30) NOT NULL,
StudentName VARCHAR(40) NOT NULL,
CourseID VARCHAR(30) NOT NULL,
CourseName VARCHAR(30) NOT NULL,
LastLogin VARCHAR(20),
NumTimeSignedIn VARCHAR(20),
Attendance FLOAT(10)
)";

$link->query($sql);

$StudentID = $myarray['StudentID'];
$CourseID = $myarray['CourseID'];
$sql = "SELECT * FROM Students WHERE CourseID LIKE $CourseID AND StudentID LIKE $StudentID;";
$result = $link->query($sql) or die($link->error);
$num_rows = mysqli_num_rows($result);

$sql = "INSERT INTO Students (StudentID, StudentName, CourseID, CourseName) VALUES (?,?,?,?);";
if(($stmt = mysqli_prepare($link, $sql)) && ($num_rows == 0)){
		mysqli_stmt_bind_param($stmt, "ssss", $StudentID, $StudentName, $CourseID, $CourseName);
		
		$StudentID = $myarray['StudentID'];
		$StudentName = $myarray['StudentName'];
		$CourseID = $myarray['CourseID'];
		$CourseName = $myarray['CourseName'];
		$LastLogin = "2019-01-01";
		$NumTimeSignedIn = "0";
		$Attendance = "0";
		
		if(mysqli_stmt_execute($stmt)){
			$jsonAcceptResponse = new stdClass();
			$jsonAcceptResponse->status = "accepted";
			$jsonAcceptResponse->reason = "Student created";
			
		}else{
			$jsonAcceptResponse = new stdClass();
			$jsonAcceptResponse->status = "rejected";
			$jsonAcceptResponse->reason = "Class not created";
			
		}
	}else{
		$jsonAcceptResponse = new stdClass();
		$jsonAcceptResponse->status = "rejected";
		$jsonAcceptResponse->reason = "Student already exists";
		
	}
	
	//mysqli_stmt_close($stmt);
	//mysqli_close($link);
	echo json_encode($jsonAcceptResponse);
?>