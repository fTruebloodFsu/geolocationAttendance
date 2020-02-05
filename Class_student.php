<?php
class Student{
	private $Student_ID;
	private $Student_name;
	private $Course_ID;
	private $Course_name;
	
	public function Get_Student_ID() {
		return $this->Student_ID; 
	}
	
	public function Get_Student_name() {
		return $this->Student_name; 
	}
	
	public function Get_Course_ID() {
		return $this->Course_ID; 
	}
	
	public function Get_Course_name() {
		return $this->Course_name; 
	}

	public function Set_Student_ID($S_ID){
		$this->Student_ID=$S_ID;
	}
	
	public function Set_Student_ID($S_Name){
		$this->Student_name=$S_Name;
	}
	
	public function Set_Student_ID($C_ID){
		$this->Course_ID=$C_ID;
	}
	
	public function Set_Student_ID($C_Name){
		$this->Course_name=$C_Name;
	}
}
?>