<?php 
$Filepath=realpath(dirname(__FILE__));
include_once ($Filepath."/../lib/database.php");
include_once ($Filepath."/../helper/format.php");
?>
<?php
class Category{
	public $db;
	public $fm;
public function __construct(){
	$this->db= new Database();
	$this->fm= new Format();
  }
public function insertcatData($catname){
	$catname=$this->fm->validation($catname);
	$catname=mysqli_real_escape_string($this->db->link,$catname);
	if(empty($catname)){
		$msg="<span style='color:red'>Field must not be empty</span>";
		return $msg;
	}else{
		$query="INSERT INTO tbl_categury (catname) VALUES ('$catname')";
		$insert=$this->db->insert($query);
		if($insert){
		$msg="<span style='color:green'>Category Inserted Successfully !.</span>";
		return $msg;
		}else{
		$msg="<span style='color:red'>Category Not Inserted !.</span>";
		return $msg;
		}
	}
}

public function getAlldata(){
	$query="SELECT * FROM tbl_categury ORDER BY id DESC";
	$select=$this->db->select($query);
	return $select;
}
public function getdataByid($id){
	$query="SELECT * FROM tbl_categury WHERE id='$id'";
	$select=$this->db->select($query);
	return $select;
}
public function UpdatecatData($catname, $id){
	$catname=$this->fm->validation($catname);
	$catname=mysqli_real_escape_string($this->db->link,$catname);
	$id=mysqli_real_escape_string($this->db->link,$id);
	if(empty($catname)){
		$msg="<span style='color:red'>Field must not be empty</span>";
		return $msg;
	}else{
		$query="UPDATE tbl_categury 
		SET catname='$catname'
		WHERE id='$id'";
		$update=$this->db->update($query);
		if($update){
		$msg="<span style='color:green'>Category Updated Successfully !.</span>";
		return $msg;
		}else{
		$msg="<span style='color:red'>Category Not Updated !.</span>";
		return $msg;
		}
	}
}

public function delData($id){
	$query="DELETE FROM  tbl_categury WHERE id='$id'";
	$delete=$this->db->delete($query);
	return $delete;
}
public function GetCategoryData(){
	$query="SELECT * FROM tbl_categury ORDER BY id DESC";
	$select=$this->db->select($query);
	return $select;
}
}
?>