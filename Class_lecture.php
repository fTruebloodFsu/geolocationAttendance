<?php
class Student{
	private $CourseID;
	private $CourseName;
	private $Building;
	private $Room;
	private $BeginDate;
	private $EndDate;
	private $BeginTime;
	private $EndTime;
	private $Schedule;
	
	public function Get_CourseID() {
		return $this->CourseID; 
	}
	
	public function Get_CourseName() {
		return $this->CourseName; 
	}
	
	public function Get_Building() {
		return $this->Building; 
	}
	
	public function Get_Room() {
		return $this->Room; 
	}
	
	public function Get_BeginDate() {
		return $this->BeginDate; 
	}
	
	public function Get_EndDate() {
		return $this->EndDate; 
	}
	
	public function Get_BeginTime() {
		return $this->BeginTime; 
	}
	
	public function Get_EndTime() {
		return $this->EndTime; 
	}
	
	public function Get_Schedule() {
		return $this->Schedule; 
	}
	
	public function Set_CourseID($C_ID){
		$this->CourseID=$C_ID;
	}
	
	public function Set_CourseName($C_Name){
		$this->CourseName=$C_Name;
	}
	
	public function Set_Building($B){
		$this->Building=$B;
	}
	
	public function Set_Room($R){
		$this->Room=$R;
	}
	
	public function Set_BeginDate($B_Date){
		$this->BeginDate=$B_Date;
	}
	
	public function Set_EndDate($E_Date){
		$this->EndDate=$E_Date;
	}
	
	public function Set_BeginTime($B_Time){
		$this->BeginTime=$B_Time;
	}
	
	public function Set_EndTime($E_Time){
		$this->EndTime=$E_Time;
	}
	
	public function Set_Schedule($S){
		$this->Schedule=$S;
	}
?>

