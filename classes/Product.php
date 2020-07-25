		<?php 
		$Filepath=realpath(dirname(__FILE__));
		include_once ($Filepath."/../lib/database.php");
		include_once ($Filepath."/../helper/format.php");
		?>
		<?php

		class Product{
			public $db;
			public $fm;
		public function __construct(){
			$this->db= new Database();
			$this->fm= new Format();
		  }
		public function ProductInsert($data, $file){
			$Productname=mysqli_real_escape_string($this->db->link,$data['Productname']);
			$catId=mysqli_real_escape_string($this->db->link,$data['catId']);
			$brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
			$body=mysqli_real_escape_string($this->db->link,$data['body']);
			$price=mysqli_real_escape_string($this->db->link,$data['price']);
			$type=mysqli_real_escape_string($this->db->link,$data['type']);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_temp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()),0,10).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;

			if($Productname==''||$catId==''||$brandId==''||$file_name==''||$body==''||$price==''
			|| $type=='')
			{
			echo "<span style='color:red'>Field must not be empty.!!</span>";
			}elseif($file_size >1048576) {
			 echo "<span class='error'>Image Size should be less then 1MB!
			 </span>";
			}elseif(in_array($file_ext, $permited) === false) {
			 echo "<span class='error'>You can upload only:-"
			 .implode(', ', $permited)."</span>";
			} else{
			move_uploaded_file($file_temp, $uploaded_image);
			$query = "INSERT INTO tbl_product(productName,catId,brandId,image,body,price, type) 
			VALUES('$Productname','$catId','$brandId','$uploaded_image','$body','$price','$type')";
			$inserted_rows = $this->db->insert($query);
			if ($inserted_rows) {
			 echo "<span style='color:green'>Product Added Successfully.
			 </span>";
			}else{
			 echo "<span style='color:red'>Product Not Inserted !</span>";
			}
			}
		}
		public function getAlldata(){
			$query="SELECT p.*, c.catname, b.brandname 
					FROM tbl_product as p, tbl_categury as c, tbl_brand as b
					WHERE p.catId=c.id AND p.brandId=b.id
					ORDER BY p.productId DESC";
			/*$query="SELECT tbl_product.*, tbl_categury.catname, tbl_brand.brandname 
					FROM tbl_product
					INNER JOIN tbl_categury 
					ON tbl_product.catId = tbl_categury.id
					INNER JOIN tbl_brand
					ON tbl_product.brandId = tbl_brand.id
					ORDER BY tbl_product.productId DESC";
			*/
			$result=$this->db->select($query);
			return $result;
		} 

		public function DelAllData($id){
			$query="DELETE FROM  tbl_product WHERE productId='$id'";
			$delete=$this->db->delete($query);
			return $delete;
		}

		public function getProductbyId($id){
			$query="SELECT * FROM tbl_product WHERE productId='$id'";
			$select=$this->db->select($query);
			return $select;
		}

		public function ProductUpdate($data, $file, $id){

			$Productname=mysqli_real_escape_string($this->db->link,$data['Productname']);
			$catId=mysqli_real_escape_string($this->db->link,$data['catId']);
			$brandId=mysqli_real_escape_string($this->db->link,$data['brandId']);
			$body=mysqli_real_escape_string($this->db->link,$data['body']);
			$price=mysqli_real_escape_string($this->db->link,$data['price']);
			$type=mysqli_real_escape_string($this->db->link,$data['type']);

			$permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $file['image']['name'];
			$file_size = $file['image']['size'];
			$file_temp = $file['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()),0,10).'.'.$file_ext;
			$uploaded_image = "upload/".$unique_image;

			if($Productname==''||$catId==''||$brandId==''||$body==''||$price==''
			|| $type=='')
			{
			echo "<span style='color:red'>Field must not be empty.!!</span>";
			}else{
				if(!empty($file_name)){
				if($file_size >1048576) {
				 echo "<span class='error'>Image Size should be less then 1MB!
				 </span>";
				}elseif(in_array($file_ext, $permited) === false) {
				 echo "<span class='error'>You can upload only:-"
				 .implode(', ', $permited)."</span>";
				}else{
					move_uploaded_file($file_temp, $uploaded_image);
					$query = "UPDATE tbl_product SET
							 productName='$Productname',
							 catId='$catId',
							 brandId='$brandId',
							 image='$uploaded_image',
							 body='$body',
							 price='$price', 
							 type='$type'
							 WHERE productId='$id'";
					$Updaterow = $this->db->update($query);
					if ($Updaterow) {
					 echo "<span style='color:green'>Product Updated Successfully.
					 </span>";
					}else{
					 echo "<span style='color:red'>Product Not Updated !</span>";
					}
					}
			}else{
					$query = "UPDATE tbl_product SET
							 productName='$Productname',
							 catId='$catId',
							 brandId='$brandId',
							 body='$body',
							 price='$price', 
							 type='$type'
							 WHERE productId='$id'";
					$Updaterow = $this->db->update($query);
					if ($Updaterow) {
					 echo "<span style='color:green'>Product Updated Successfully.
					 </span>";
					}else{
					 echo "<span style='color:red'>Product Not Updated !</span>";
					}
			}
			}

		}

		public function getAllproduct(){
			$query="SELECT * FROM tbl_product ORDER BY productId DESC LIMIT 8";
			$result=$this->db->select($query);
			return $result;
		}

		public function getFproduct(){
			$query="SELECT * FROM tbl_product WHERE type='0' ORDER BY productId DESC LIMIT 8";
			$result=$this->db->select($query);
			return $result;
		}

		public function SelectsingleData($id){
		$query="SELECT p.*, c.catname, b.brandname 
				FROM tbl_product as p, tbl_categury as c, tbl_brand as b
				WHERE p.catId=c.id AND p.brandId=b.id AND p.productId='$id'";
				$result=$this->db->select($query);
				return $result;		
		}
		public function getNBrand(){
			$query="SELECT * FROM tbl_product WHERE type='1' ORDER BY productId DESC LIMIT 8";
			$result=$this->db->select($query);
			return $result;
		} 
		public function getBashundharaProduct(){
		$query="SELECT p.*, b.brandname
				FROM tbl_product as p, tbl_brand as b
				WHERE p.brandId=b.id AND b.id=19 LIMIT 8";
		$result=$this->db->select($query);
		return $result;
		}
		public function getPranProduct(){
		$query="SELECT p.*, b.brandname
				FROM tbl_product as p, tbl_brand as b
				WHERE p.brandId=b.id AND b.id=20 LIMIT 8";
		$result=$this->db->select($query);
		return $result;
		}
		public function getTeerProduct(){
		$query="SELECT p.*, b.brandname
				FROM tbl_product as p, tbl_brand as b
				WHERE p.brandId=b.id AND b.id=17 LIMIT 8";
		$result=$this->db->select($query);
		return $result;
		} 
		public function GetSonyProduct(){
			$query="SELECT p.*, b.brandname 
					FROM tbl_product as p, tbl_brand as b
					WHERE p.brandId=b.id AND b.id=16 LIMIT 1";
			$result=$this->db->select($query);
			return $result;
		}
		public function GetCasioProduct(){
			$query="SELECT p.*, b.brandname 
					FROM tbl_product as p, tbl_brand as b
					WHERE p.brandId=b.id AND b.id=15 LIMIT 1";
			$result=$this->db->select($query);
			return $result;
		} 

		public function AllproductbyCat($id){
			$query="SELECT * FROM tbl_product WHERE catId='$id' LIMIT 4";
			$result=$this->db->select($query);
			if($result){
				return $result;
			}else{
			echo "<span style='color:red'>Product Empty..!</span>";
			}
		} 
		}
		?>