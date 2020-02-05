<?php
	// Set timezone
	date_default_timezone_set('UTC');
	
	$n=5; 
	function getName($n) { 
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; 
		$randomString = ''; 
	  
		for ($i = 0; $i < $n; $i++) { 
			$index = rand(0, strlen($characters) - 1); 
			$randomString .= $characters[$index]; 
		} 
	  
		return $randomString; 
	} 

	// Start date
	$date = '2019-09-06';
	// End date
	$end_date = '2019-12-31';
	//string to convert to array
	$string = "Mon Wed Fri";
	//array of days in schedule
	$scheduleArray = explode (" ", $string); 
	
	function makeScheduleWithRandomCode($date, $end_date, $scheduleArray, $n){
		while (strtotime($date) <= strtotime($end_date)) {
		if(in_array(date('D', strtotime($date)), $scheduleArray)){ 
			echo "$date <br>"; 
			echo date('D', strtotime($date));
			echo "<br>";
			echo getName($n);
			echo "<br>";
			}
        $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
		echo "<br>";
		}
	}
	
	makeScheduleWithRandomCode($date, $end_date, $scheduleArray, $n);

?>