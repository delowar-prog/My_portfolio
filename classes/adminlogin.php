<?php 
	include_once "../lib/session.php"; 
	Session::checkLogin();
	include_once "../lib/database.php";
	include_once "../helper/format.php";
?>
<?php 
class AdminLogin{
	private $db;
	private $fm;

	public function __construct(){
		$this->db=new Database();
		$this->fm=new Format();
	}
public function AdLogin($adminemail,$adminpass){
	$adminemail=$this->fm->validation($adminemail);
	$adminpass=$this->fm->validation($adminpass);
	if(empty($adminemail)||empty($adminpass)){
		$msg="Field Must not be empty!";
		return $msg;
	} else{
		$query="SELECT * FROM tbl_adminlogin WHERE email='$adminemail' AND password='$adminpass'";
		$result=$this->db->select($query);
		if($result){
			$value=$result->fetch_assoc();
			Session::set('login',true);
			Session::set('Username',$value['name']);
			Session::set('Useremail',$value['email']);
			Session::set('UserId',$value['id']);
			header("Location:dashboard.php");
		} else{
			$msg="Email and password not Metch!";
			return $msg;
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