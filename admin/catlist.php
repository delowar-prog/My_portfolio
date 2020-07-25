<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
include_once "../classes/category.php";
$cat=new Category();
 ?>
 <div class="grid_10">
	
            <div class="box round first grid">
                <h2>Category List</h2>
<?php 
error_reporting(0);
if(isset($_GET['delid'])||$_GET['delid']!=NULL){
	$delid=$_GET['delid'];
	$deletedata=$cat->delData($delid);
	if(isset($deletedata)){
	echo"<script>window.alert('Category deleted Successfully !')</script>";
	}else{
	echo"<span style='color:red'>Category Not deleted !!</span>";
	}
}
?>
<div class="block">
                	<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					$Getdata=$cat->getAlldata();
					if($Getdata){
						$i=0;
						while($value=$Getdata->fetch_assoc()){
							$i++;
					?>
					<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $value['catname']; ?></td>
							<td><a href="editcat.php?catid=<?php echo $value['id']; ?>">Edit</a> || <a onclick="return confirm('Are you sure to delete')"; href="?delid=<?php echo $value['id']; ?>">Delete</a></td>
						</tr>
					<?php } } ?>
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

