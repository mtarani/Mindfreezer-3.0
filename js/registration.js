$(document).ready(function() {
	
	$('body').on('submit', '#reg-form', function (e) {
		e.preventDefault();
		var formData = new FormData($('#reg-form')[0]);
		if($('.input10').val()==""){
			return;
		}
		//alert("1");
		if($('#pass').val()!=$('#cpass').val()){
			$("#err").html("Password does not match");
			return;
		}
		//alert("2");
		if($('#uname').val().length<4 || $('#uname').val().length>12){
			$("#err").html("Username must have 4 - 12 characters");
			return;
		}
		//alert($('#uname').val().length);
		$.ajax( {
			type: "POST",
			url: "reg_script.php",
			data: formData,			
			dataType: "html",   //expect html to be returned 
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function() { 
				$(".login100-form-btn").prop('disabled', true); // disable button
				
			},
			success: function(response) {  
				$(".login100-form-btn").prop('disabled', false); // disable button
				if(response=="err")
					document.getElementById('err').style.visibility='visible';
				else if(response=="1")
					window.location.replace("login.php");
				
				else
					$("#err").html(response);
					//document.getElementById('err').style.visibility='visible';
				$('#err').focus();
				//alert(response);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				//document.getElementById('err').style.visibility='visible';
				$("#err").html(response);
				$(".login100-form-btn").prop('disabled', false);
				$('#err').focus();
			}      
		});
	});
});