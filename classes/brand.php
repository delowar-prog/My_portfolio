<?php include_once "../lib/database.php"; ?>
<?php include_once "../helper/format.php"; ?>
<?php

class Brand{
	public $db;
	public $fm;
public function __construct(){
	$this->db= new Database();
	$this->fm= new Format();
  }
public function insertbrandData($brandname){
	$brandname=$this->fm->validation($brandname);
	$brandname=mysqli_real_escape_string($this->db->link,$brandname);
	if(empty($brandname)){
		$msg="<span style='color:red'>Field must not be empty</span>";
		return $msg;
	}else{
		$query="INSERT INTO tbl_brand (brandname) VALUES ('$brandname')";
		$insert=$this->db->insert($query);
		if($insert){
		$msg="<span style='color:green'>Brand Inserted Successfully !.</span>";
		return $msg;
		}else{
		$msg="<span style='color:red'>Brand Not Inserted !.</span>";
		return $msg;
		}
	}
}

public function getAlldata(){
	$query="SELECT * FROM tbl_brand ORDER BY id DESC";
	$select=$this->db->select($query);
	return $select;
}
public function getdataByid($id){
	$query="SELECT * FROM tbl_brand WHERE id='$id'";
	$select=$this->db->select($query);
	return $select;
}
public function UpdatebrandData($brandname, $id){
	$brandname=$this->fm->validation($brandname);
	$brandname=mysqli_real_escape_string($this->db->link,$brandname);
	$id=mysqli_real_escape_string($this->db->link,$id);
	if(empty($brandname)){
		$msg="<span style='color:red'>Field must not be empty</span>";
		return $msg;
	}else{
		$query="UPDATE tbl_brand 
		SET brandname='$brandname'
		WHERE id='$id'";
		$update=$this->db->update($query);
		if($update){
		$msg="<span style='color:green'>Brand Updated Successfully !.</span>";
		return $msg;
		}else{
		$msg="<span style='color:red'>Brand Not Updated !.</span>";
		return $msg;
		}
	}
}

public function delData($delid){
	$query="DELETE FROM tbl_brand WHERE id='$delid'";
	$delete=$this->db->delete($query);
	return $delete;
}
}
?>