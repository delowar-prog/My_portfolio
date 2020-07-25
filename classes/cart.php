<?php $Filepath=realpath(dirname(__FILE__));
include_once ($Filepath."/../lib/database.php");
include_once ($Filepath."/../helper/format.php");
?>
<?php

class Cart{
	public $db;
	public $fm;
public function __construct(){
	$this->db= new Database();
	$this->fm= new Format();
  }
public function Addtocart($quantity,$productId){
$quantity=$this->fm->validation($quantity);
$quantity=mysqli_real_escape_string($this->db->link,$quantity);
$productId=mysqli_real_escape_string($this->db->link,$productId);
$sId=session_id();


$sqlquery="SELECT * FROM tbl_product WHERE productId='$productId'";
$result=$this->db->select($sqlquery)->fetch_assoc();
$productName=$result['productName'];
$price=$result['price'];
$image=$result['image'];

$Chkquery="SELECT * FROM tbl_cart WHERE productId='$productId'AND sId='$sId'";
$queryresult=$this->db->select($Chkquery);
if($queryresult){
	 echo "<script>window.alert('Product allredy added.!')</script>";
}else{
$query = "INSERT INTO tbl_cart(sId,productId,productName,price,quantity,image) 
	VALUES('$sId','$productId','$productName','$price','$quantity','$image')";
	$inserted_rows = $this->db->insert($query);
	if ($inserted_rows) {
	 header('location:cart.php');
	}else{
	 echo "<span style='color:red'>Not Found !</span>";
	}
}
}
public function selectproductintoCart(){
$sId=session_id();
$sqlquery="SELECT * FROM tbl_cart WHERE sId='$sId'";
$result = $this->db->select($sqlquery);
return $result;
}
public function Updatequantity($quantity,$cartId){
	$quantity=$this->fm->validation($quantity);
	$cartId=$this->fm->validation($cartId);

	if(empty($quantity)){
		$msg="<span style='color:red'> Quantity Field must not be empty</span>";
		return $msg;
	}else{
		$query="UPDATE tbl_cart 
		SET quantity='$quantity'
		WHERE cartId='$cartId'";
		$update=$this->db->update($query);
		if($update){
		$msg="<span style='color:green'>Updated Successfully !.</span>";
		return $msg;
		}else{
		$msg="<span style='color:red'>Not Updated !.</span>";
		return $msg;
		}
	}
}
public function DeleteproductfromCart($cartId){
	$query="DELETE FROM tbl_cart WHERE cartId='$cartId'";
	$result = $this->db->delete($query);
	if($result){
		$msg="<span style='color:green'>Deleted Successfully !.</span>";
		return $msg;
	}else{
		$msg="<span style='color:red'>Not Deleted !.</span>";
		return $msg;

	}
}
public function DelCartData(){
$sId=session_id();
$query="DELETE FROM tbl_cart WHERE sId='$sId'";
$result = $this->db->delete($query);
return $result;
}

public function orderProduct($userId){
	$sId=session_id();
	$sqlquery="SELECT * FROM tbl_cart WHERE sId='$sId'";
	$result = $this->db->select($sqlquery);
	if($result){
	while($value=$result->fetch_assoc()){
		$productId=$value['productId'];
		$productName=$value['productName'];
		$price=$value['price'];
		$quantity=$value['quantity'];
		$image=$value['image'];
	$query = "INSERT INTO tbl_order(userId,productId,productName,quantity,price,image) 
	VALUES('$userId','$productId','$productName','$quantity','$price','$image')";
	$inserted_rows = $this->db->insert($query);	
		
	}
	}
}

}
?>