<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
if(isset($_GET['delid'])){
	$id=$_GET['delid'];
}else{
	header("location:brandlist.php");
}
?>

<?php 
include "../classes/brand.php";
$brand=new Brand();
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 
			   		<?php 
						$GetDatabyid=$brand->getdataByid($id);
						if($GetDatabyid){
						while($result=$GetDatabyid->fetch_assoc()){
					?>	
                 <form action="" method="post">
                    <table class="form">				
                        <tr>
                            <td>
                                <input type="text" name="brandname" value="<?php echo $result['brandname']; ?>" class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Delete" />
                            </td>
                        </tr>
                    </table>

                    </form>
			<?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>