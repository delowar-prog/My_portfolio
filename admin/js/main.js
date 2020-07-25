$(function()){
			
			$("#adminemail_error_msg").hide();
			$("#password_error_msg").hide();
			var error_email=false;
			var error_pass=false;



			$("#adminemail").focusout(function(){
				check_adminemail();
			});





	function check_adminemail(){
		var pattern=new RegExp(/^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/);
		if(pattern.text($('#adminemail').val())){
				$("#adminemail_error_msg").hide();
		} else{
				$("#adminemail_error_msg").html("Invalied Email Address");
				$("#adminemail_error_msg").show();
				error_email true;
		}

	}

	
		$("#adminLoginForm").submit(function(){
			var error_email=false;
			var error_pass=false;
			if(error_email==false){
				return true;
			}else{
				return false;
			}
		});
}