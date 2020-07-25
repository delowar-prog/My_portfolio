<?php 
$Filepath=realpath(dirname(__FILE__));
include_once ($Filepath."/../lib/database.php");
include_once ($Filepath."/../helper/format.php");
?>
<?php

class User{
	public $db;
	public $fm;
public function __construct(){
	$this->db= new Database();
	$this->fm= new Format();
  }
public function InsertcontactData($Data){
	$name=$this->fm->validation($Data['name']);
	$name=mysqli_real_escape_string($this->db->link,$Data['name']);
	$email=$this->fm->validation($Data['email']);
	$email=mysqli_real_escape_string($this->db->link,$Data['email']);
	$phone=$this->fm->validation($Data['phone']);
	$phone=mysqli_real_escape_string($this->db->link,$Data['phone']);
	$subject=$this->fm->validation($Data['subject']);
	$subject=mysqli_real_escape_string($this->db->link,$Data['subject']);

	if(empty($name)||empty($email)||empty($phone)||empty($subject)){
		echo "<span style='color:red'>Field Must Not be Empty..!</span>";
	}else{
		$query="INSERT INTO tbl_contact (name, email, phone, message) VALUES('$name','$email','$phone','$subject')";
		$QueryResult=$this->db->insert($query);
		if($QueryResult){
			echo "<span style='color:green'>Data Inserted Successfully..!</span>";
		}else{
			echo "<span style='color:green'>Data Not Inserted</span>";
		}
	}
}

public function UserMessage(){
		$query="SELECT * FROM tbl_contact ORDER BY name DESC";
			$result=$this->db->select($query);
			return $result;
}

public function GetUserData($userid){
		$query="SELECT * FROM tbl_user WHERE id='$userid'";
		$result=$this->db->select($query);
		return $result;
}
public function UpdateUserData($Data, $userid){
	$name=$this->fm->validation($Data['name']);
	$name=mysqli_real_escape_string($this->db->link,$Data['name']);
	$city=$this->fm->validation($Data['city']);
	$city=mysqli_real_escape_string($this->db->link,$Data['city']);
	$zipcode=$this->fm->validation($Data['zip-code']);
	$zipcode=mysqli_real_escape_string($this->db->link,$Data['zip-code']);
	$email=$this->fm->validation($Data['email']);
	$email=mysqli_real_escape_string($this->db->link,$Data['email']);
	$address=$this->fm->validation($Data['address']);
	$address=mysqli_real_escape_string($this->db->link,$Data['address']);
	$country=$this->fm->validation($Data['country']);
	$country=mysqli_real_escape_string($this->db->link,$Data['country']);
	$phone=$this->fm->validation($Data['phone']);
	$phone=mysqli_real_escape_string($this->db->link,$Data['phone']);
	$password=$this->fm->validation($Data['password']);
	$password=mysqli_real_escape_string($this->db->link,$Data['password']);
	
	$query="UPDATE tbl_user SET 
	name='$name',
	city='$city', 
	zip ='$zipcode',
	email='$email',
	address='$address', 
	country='$country', 
	phone='$phone', 
	password='$password'
	WHERE id='$userid'";
		$QueryResult=$this->db->update($query);
		if($QueryResult){
			echo "<span style='color:green; margin:5px 0 5px 200px; font-size:18px;'>Updated Successfully..!</span>";
		}else{
			echo "<span style='color:green'>Not Updated..</span>";
		}
}

}
?>