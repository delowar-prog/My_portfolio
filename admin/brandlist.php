<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
include_once "../classes/brand.php";
$brand=new Brand();
?>
 <div class="grid_10">
            <div class="box round first grid">
                <h2>Brand List</h2>
					<div class="block">

<?php 
error_reporting(0);
if(isset($_GET['delid'])||$_GET['delid']!=NULL){
	$delid=$_GET['delid'];
	$deletedata=$brand->delData($delid);
	if(isset($deletedata)){
	echo"<script>window.alert('brand deleted Successfully !')</script>";
	}else{
	echo"<span style='color:red'>brand Not deleted !!</span>";
	}
}
?>

                	<table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Brand Name</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$getdata=$brand->getAlldata();
						if($getdata){
							$i=0;
							while ($result=$getdata->fetch_assoc()) {
							$i++;
					?>
					<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['brandname']; ?></td>
							<td><a href="editbrand.php?brandid=<?php echo $result['id']; ?>;">Edit</a> || <a href="?delid=<?php echo $result['id']; ?>">Delete</a></td>
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

