<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/adminlogin.php';
    $ad=new AdminLogin();
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">  
        <?php
           if($_SERVER['REQUEST_METHOD']=='POST'){
                $Updatepassword=$ad->UpdatePass($_POST);
                if($Updatepassword){
                    echo $Updatepassword;
                }
            }
        ?>             
         <form action="changepassword.php" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Enter Email..."  name="email" class="medium" />
                    </td>
                </tr>

                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="oldpass" class="medium" />
                    </td>
                </tr>
				 <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="newpass" class="medium" />
                    </td>
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