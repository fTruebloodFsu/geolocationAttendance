<?php
require_once 'configMySQL.php';

$myarray = (isset($_POST['myarray'])) ? $_POST['myarray'] : ['0'];
$myarray = json_decode($myarray, true);

$tableName = $myarray['tableName'];
$sessionDate = $myarray['sessionDate'];
$sessionCode = $myarray['sessionCode'];


$sql = "DELETE FROM `".$tableName."` WHERE Date = '$sessionDate';";
$link->query($sql) or die($link->error);

mysqli_close($link);

echo json_encode($myarray);
?>