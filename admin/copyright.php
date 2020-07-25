<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/siteoption.php';
    $st=new Siteoption();
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php 
        if(isset($_POST['submit'])){
            $copyright=$_POST['copyright'];
            $EditcopyrightData=$st->UpdatecopyrightData($copyright);
            if(isset($EditcopyrightData)){
                echo $EditcopyrightData;
            }
        }
        ?>
        <div class="block copyblock"> 
         <form action="copyright.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" placeholder="Enter Copyright Text..." name="copyright" class="large" />
                    </td>
                </tr>
				
				 <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>