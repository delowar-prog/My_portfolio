<?php include_once "../classes/siteoption.php"; 
$st=new Siteoption();
?>
 <div class="clear">
        </div>
    </div>
    <div class="clear">
    </div>
    <div id="site_info">
    <?php $GetData=$st->GetallData();
    	if($GetData){
    		$result=$GetData->fetch_assoc();
    ?>
        <p>
         &copy; Copyright <a href="http://trainingwithliveproject.com"><?php echo $result['copyrightname'];?></a>
        </p>
    <?php } ?>
    </div>
</body>
</html>
