<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
if(isset($_GET['brandid'])){
	$id=$_GET['brandid'];
}else{
	header("location:brandlist.php");
}
?>

<?php 
include "../classes/brand.php";
$brand=new Brand();
if(isset($_POST['submit'])){
	$brandname=$_POST['brandname'];
	$EditbrandData=$brand->UpdatebrandData($brandname,$id);
}
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Brand</h2>
               <div class="block copyblock"> 
			   <?php 
			   if(isset($EditbrandData)){
				   echo $EditbrandData;
			   }
			   ?>
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
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>

                    </form>
			<?php } } ?>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>