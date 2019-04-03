$(document).ready(function() {
	
	$('body').on('submit', '#ver-form', function (e) {
		e.preventDefault();
		var formData = new FormData($('#ver-form')[0]);
		if($('.input100').val()==""){
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "ver_script.php",
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
					window.location.replace("player_dashboard.php");
				
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