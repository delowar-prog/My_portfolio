<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
if($_SERVER['REQUEST_METHOD']=='POST'){
	$brandname=$_POST['brandname'];
	$AddbrandData=$brand->insertbrandData($brandname);
}
 ?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Brand</h2>
               <div class="block copyblock"> 
			   <?php 
			   if(isset($AddbrandData)){
				   echo $AddbrandData;
			   }
			   ?>
                 <form action="addbrand.php" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="brandname" placeholder="Enter Brand Name..." class="medium" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>