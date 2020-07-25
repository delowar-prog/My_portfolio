<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php 
if(isset($_GET['catid'])){
	$id=$_GET['catid'];
}else{
	header("location:catlist.php");
}
?>

<?php 
include "../classes/category.php";
$cat=new Category();
if(isset($_POST['submit'])){
	$catname=$_POST['catname'];
	$EditcatData=$cat->UpdatecatData($catname,$id);
}
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Update Category</h2>
               <div class="block copyblock"> 
			   <?php 
			   if(isset($EditcatData)){
				   echo $EditcatData;
			   }
			   ?>
			   		<?php 
						$GetDatabyid=$cat->getdataByid($id);
						if($GetDatabyid){
						while($result=$GetDatabyid->fetch_assoc()){
					?>	
                 <form action="" method="post">
                    <table class="form">				
                        <tr>
                            <td>
                                <input type="text" name="catname" value="<?php echo $result['catname']; ?>" class="medium" />
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