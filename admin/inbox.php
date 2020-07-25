<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Message</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$UserMessage=$user->UserMessage();
							if($UserMessage){
							while($message=$UserMessage->fetch_assoc()) {
						?>
						<tr class="odd gradeX">
							<td><?php echo $message['contactId'];?></td>
							<td><?php echo $message['name'];?></td>
							<td><?php echo $fm->textShorten($message['Message'], 30);?></td>
							<td><a href="viewmessage.php?contactId=<?php echo $message['contactId'];?>">View</a></td>
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
