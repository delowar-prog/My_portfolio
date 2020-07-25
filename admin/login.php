<?php 
	include_once "../classes/adminlogin.php"; 
	$al=new AdminLogin();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/main.js" type="text/javascript"></script>
</head>
<body>
<div class="container">
	<section id="content">
	<?php
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$adminemail=$_POST['adminemail'];
			$adminpass=$_POST['adminpass'];
			$LoginResult=$al->AdLogin($adminemail,$adminpass);

	}

	?>
	<?php
	if(isset($LoginResult)){
		echo $LoginResult;
	}
	?>
		<form id="adminLoginForm" action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" id="adminemail" placeholder="Username" name="adminemail"/><br/>
				<span class="error_form" id="adminemail_error_msg"></span>
			</div>
			<div>
				<input type="password" id="adminemail" placeholder="Password"  name="adminpass"/><br/>
				<span class="error_form" id="password_error_msg"></span>
			</div>
			<div>
				<input type="submit" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Created by Delowar Hossain</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>