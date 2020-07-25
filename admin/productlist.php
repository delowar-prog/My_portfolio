<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once "../classes/Product.php";?>
<?php include_once "../helper/format.php"; ?>


	<?php 
		 $pd=new Product();
		 $fm=new Format();
		 error_reporting(0);
	if(isset($_GET['delid'])||$_GET['delid']!=NULL){
		$id=$_GET['delid'];
		$DelData=$pd->DelAllData($id);
        	if(isset($DelData)){
        		echo"<script>window.alert('Product deleted Successfully !')</script>";
        	}else{
        		echo"<script>window.alert('Product Not deleted !')</script>";
        	}
	}
	?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block">  

            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>Sl</th>
					<th>Product Name</th>
					<th>Category</th>
					<th>Brand</th>
					<th>Image</th>
					<th>Description</th>
					<th>Price</th>
					<th>Type</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
	<?php 
		$Alldata=$pd->getAlldata();
		if($Alldata){
			$i=0;
			while($value=$Alldata->fetch_assoc()){
			$i++;
	?>
				<tr class="odd gradeX">
					<td><?php echo $i;?></td>
					<td><?php echo $value['productName'];?></td>
					<td><?php echo $value['catname'];?></td>
					<td><?php echo $value['brandname'];?></td>
					<td><img src="<?php echo $value['image'];?>" height=50px width=80px></td>
					<td><?php echo $fm->textShorten($value['body'],20);?></td>
					<td><?php echo $value['price'];?></td>
					<td><?php echo $value['type'];?></td>
					<td><a href="editproduct.php?proid=<?php echo $value['productId'];?>">Edit</a>||<a onclick ="return confirm('Are you sure to delete')"; href="?delid=<?php echo $value['productId'];?>">Delete</a></td>
				</tr>
		<?php } }?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
