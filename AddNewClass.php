<?php 
require_once 'configMySQL.php';

$myarray = (isset($_POST['myarray'])) ? $_POST['myarray'] : ['0'];
$myarray = json_decode($myarray, true);

date_default_timezone_set('UTC');

$sql = "CREATE TABLE IF NOT EXISTS Classes (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
CourseID VARCHAR(30) NOT NULL, 
CourseName VARCHAR(30) NOT NULL,
Building VARCHAR(30) NOT NULL,
Room VARCHAR(30) NOT NULL,
BeginDate VARCHAR(30) NOT NULL,
EndDate VARCHAR(30) NOT NULL,
BeginTime VARCHAR(30) NOT NULL,
EndTime VARCHAR(30) NOT NULL,
Schedule VARCHAR(70) NOT NULL
)";
$link->query($sql);

$n=5; 		//random string length

function getRandString($n) { 
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
	$randomString = ''; 
	  
	for ($i = 0; $i < $n; $i++) { 
		$index = rand(0, strlen($characters) - 1); 
		$randomString .= $characters[$index]; 
	}  
	
	return $randomString; 
} 

//string to convert to array
$string = $myarray['Schedule'];

//array of days in schedule
$scheduleArray = explode(" ", $string); 

$CourseID = $myarray['CourseID'];
$sql = "SELECT * FROM Classes WHERE CourseID LIKE $CourseID;";
$result = $link->query($sql) or die($link->error);
$num_rows = mysqli_num_rows($result);

$sql = "INSERT INTO Classes (CourseID, CourseName, Building, Room, BeginDate, EndDate, BeginTime, EndTime, Schedule) VALUES (?,?,?,?,?,?,?,?,?);";
if(($stmt = mysqli_prepare($link, $sql)) && ($num_rows == 0)){
		mysqli_stmt_bind_param($stmt, "sssssssss", $CourseID, $CourseName, $Building, $Room, $BeginDate, $EndDate, $BeginTime, $EndTime, $Schedule);
		
		$CourseID = $myarray['CourseID'];
		$CourseName = $myarray['CourseName'];
		$Building = $myarray['Building'];
		$Room = $myarray['Room'];
		$BeginDate = $myarray['BeginDate'];
		$EndDate = $myarray['EndDate'];
		$BeginTime = $myarray['BeginTime'];
		$EndTime = $myarray['EndTime'];
		$Schedule = $myarray['Schedule'];
		
		$tableName = $myarray['CourseID'].$myarray['CourseName'];
		
		$sql = "CREATE TABLE IF NOT EXISTS `".$tableName."` (
			id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
			Date VARCHAR(20) NOT NULL, 
			Day VARCHAR(15) NOT NULL,
			ClassBegin VARCHAR(20) NOT NULL,
			ClassEnd VARCHAR(20) NOT NULL,
			ClassRoom VARCHAR(20) NOT NULL,
			ClassBuilding VARCHAR(20) NOT NULL,
			ClassCode VARCHAR(10) NOT NULL
			)";
			
		$link->query($sql) or die ("did not create table");
		
		if(mysqli_stmt_execute($stmt)){
			mysqli_stmt_close($stmt);
			$jsonAcceptResponse = new stdClass();
			$jsonAcceptResponse->status = "accepted";
			$jsonAcceptResponse->reason = "Class created";

		} else{
			mysqli_stmt_close($stmt);
			$jsonAcceptResponse = new stdClass();
			$jsonAcceptResponse->status = "rejected";
			$jsonAcceptResponse->reason = "Class not created";
		}
	}else{
		mysqli_stmt_close($stmt);
		$jsonAcceptResponse = new stdClass();
		$jsonAcceptResponse->status = "rejected";
		$jsonAcceptResponse->reason = "Class already exists";
	}
	
	$tableName = $myarray['CourseID'].$myarray['CourseName'];
	$sql = "INSERT INTO `".$tableName."` (Date, Day, ClassBegin, ClassEnd, ClassRoom, ClassBuilding, ClassCode) VALUES (?,?,?,?,?,?,?);";
	if($stmt1 = mysqli_prepare($link, $sql)){
		mysqli_stmt_bind_param($stmt1, "sssssss", $Date, $Day, $ClassBegin, $ClassEnd, $Room, $Building, $randString);
		
		$date = $myarray['BeginDate'];
		$end_date = $myarray['EndDate'];
		$scheduleString = $myarray['Schedule'];
		$scheduleArray = explode(" ", $scheduleString); 
		$n = 5;
		//start of while loop to get correct dates and days according to schedule
		while (strtotime($date) <= strtotime($end_date)) {
			if(in_array(date('D', strtotime($date)), $scheduleArray)){ 
				
				$Date = $date;
				$Day = date('D', strtotime($date));
				$ClassBegin = $myarray['BeginTime'];
				$ClassEnd = $myarray['EndTime'];
				$Room = $myarray['Room'];
				$Building = $myarray['Building'];
				$randString = getRandString($n);
				
				$stmt1->execute();
				}
			$date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));//progress date by one day
		}
	}
	
	mysqli_close($link);
	echo json_encode($jsonAcceptResponse);
?>