<?php include_once "../lib/database.php"; ?>
<?php include_once "../helper/format.php"; ?>
<?php
class Siteoption{
	public $db;
	public $fm;
public function __construct(){
	$this->db= new Database();
	$this->fm= new Format();
  }
public function UpdatecopyrightData($copyright){
	$copyrightname=$this->fm->validation($copyright);
	$copyrightname=mysqli_real_escape_string($this->db->link,$copyright);

	if(empty($copyright)){
		echo "<span style='color:green'>Field must not be empty !.</span>";
	}else{
		$query="UPDATE tbl_copyright 
		SET copyrightname='$copyrightname'
		WHERE id='1'";
		$update=$this->db->update($query);
		if($update){
		$msg="<span style='color:green'>Copyright Updated Successfully !.</span>";
		return $msg;
		}else{
		$msg="<span style='color:red'>Copyright Not Updated !.</span>";
		return $msg;
		}
	}
}

public function GetallData(){
	$query="SELECT * FROM tbl_copyright";
	$Read=$this->db->select($query);
	return $Read;
}

public function Updatetitleslogan($data, $file){
	$title=mysqli_real_escape_string($this->db->link,$data['title']);
	$slogan=mysqli_real_escape_string($this->db->link,$data['slogan']);

	$permited  = array('png', 'gif');
	$file_name = $file['logo']['name'];
	$file_size = $file['logo']['size'];
	$file_temp = $file['logo']['tmp_name'];

	$div = explode('.', $file_name);
	$file_ext = strtolower(end($div));
	$Logo_image = 'logo'.'.'.$file_ext;
	$uploaded_image = "upload/".$Logo_image;

	if($title==''||$slogan=='')
	{
	echo "<span style='color:red'>Field must not be empty.!!</span>";
	} else{
		if(!empty($file_name)){
				if ($file_size >1048567) {
				 echo "<span class='error'>Image Size should be less then 1MB!
				 </span>";
				} elseif (in_array($file_ext, $permited) === false) {
				 echo "<span class='error'>You can upload only:-"
				 .implode(', ', $permited)."</span>";
				} else{
				move_uploaded_file($file_temp, $uploaded_image);
				$edit_query="UPDATE tbl_siteoption
							 SET
							 sitename='$title',
							 slogan='$slogan',
							 logo='$uploaded_image'
							 WHERE id = '1' ";
				$update_rows = $this->db->update($edit_query);
				if ($update_rows) {
				 echo "<span style='color:green'>Updated Successfully.
				 </span>";
				}else {
				 echo "<span style='color:red'>Data Not Updated !</span>";
				}
				}
	}else{
		$edit_query="UPDATE tbl_siteoption
							 SET
							 sitename='$title',
							 slogan='$slogan'
							 WHERE id = '1' ";
		$update_rows = $this->db->update($edit_query);
		if ($update_rows) {
		 echo "<span style='color:green'>Updated Successfully.
		 </span>";
		}else {
		 echo "<span style='color:red'>Data Not Updated !</span>";
		}						
	}
	}
}

public function GetSiteData(){
	$query="SELECT * FROM tbl_siteoption";
	$Read=$this->db->select($query);
	return $Read;
}
}
?>