<?php 
	include_once "lib/session.php"; 
	Session::checkLogin();
	include_once "lib/database.php";
	include_once "helper/format.php";
?>
<?php 
class UserLogin{
	private $db;
	private $fm;

	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}
public function UserLogin($email,$password){
	$email=$this->fm->validation($email);
	$password=$this->fm->validation($password);
	if(empty($email)||empty($password)){
		$msg="Field Must not be empty!";
		return $msg;
	} else{
		$query="SELECT * FROM tbl_user WHERE email='$email' AND password='$password'";
		$result=$this->db->select($query);
		if($result){
			$value=$result->fetch_assoc();
			Session::set('login',true);
			Session::set('Username',$value['name']);
			Session::set('Useremail',$value['email']);
			Session::set('Userphoto',$value['photo']);
			Session::set('UserId',$value['id']);
			header("Location:index.php");
		} else{
			$msg="Email and password not Metch!";
			return $msg;
		}
	}

}

public function RegisterDataInsert($Data){
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

	if(empty($name)||empty($city)||empty($zipcode)||empty($email)||empty($address)||empty($country)||empty($phone)||empty($password)){
		echo "<span style='color:red'>Field Must Not be Empty..!</span>";
	}else{
		$sql="SELECT name AND email FROM tbl_user WHERE name='$name' AND email='$email'";
		$sql_result=$this->db->select($sql);
		if($sql_result){
			echo "<span style='color:green'>User Allready Registared..</span>";
		}else{
		$query="INSERT INTO tbl_user (name, city, zip, email, address, country, phone, password) VALUES('$name','$city','$zipcode','$email','$address','$country','$phone','$password')";
		$QueryResult=$this->db->insert($query);
		if($QueryResult){
			echo "<span style='color:green'>Registared Successfully..!</span>";
		}else{
			echo "<span style='color:green'>Not Registared..</span>";
		}
		}
	}
}



public function UpdatePass($Data){
            $email = $this->fm->validation (mysqli_real_escape_string($this->db->link,$Data['email']));
            $oldpass = $this->fm->validation (mysqli_real_escape_string($this->db->link,$Data['oldpass']));
            $newpass = $this->fm->validation (mysqli_real_escape_string($this->db->link,$Data['newpass']));
             if(empty($email)||empty($oldpass)||empty($newpass)){
             echo "<span style='color:red'>Field Must Not be Empty..</span>";
             }else{
                $query="SELECT id FROM tbl_adminlogin WHERE email='$email' AND password='$oldpass'";
                $sql_result=$this->db->select($query);
                if($sql_result->num_rows>0){
                    $sql="UPDATE tbl_adminlogin
                        SET 
                        password='$newpass'";
                    $result=$this->db->update($sql);
                    if($result){
                       echo "<span style='color:red'>Password Updated successfully..</span>"; 
                    }else{
                       echo "<span style='color:red'>Password Not Updated..</span>";  
                    }
                }else{
                    echo "<span style='color:red'>Email and Password Not Match..</span>";
                }
        }

        }

}
?>