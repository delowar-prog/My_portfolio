<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include_once '../classes/siteoption.php';
    $st=new Siteoption();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <div class="block sloginblock">               
         <form action="titleslogan.php" method="post" enctype="multipart/form-data">
        <?php 
        if(isset($_POST['submit'])){
            $Updatetitle=$st->Updatetitleslogan($_POST, $_FILES);
            if($Updatetitle){
                echo $Updatetitle;
            }
        }
        ?>
            <table class="form">					
                <tr>
                    <td>
                        <label>Website Title</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Website Title..."  name="title" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>Website Slogan</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Website Slogan..." name="slogan" class="medium" />
                    </td>
                </tr>
				
                <tr>
                    <td><label>Logo</label></td>
                    <td><input type="file" name="logo" class="medium"></td>
                </tr> 
				
				 <tr>
                    <td>
                    </td>
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