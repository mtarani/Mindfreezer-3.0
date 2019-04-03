$(document).ready(function() {
	//alert("asd");
	function getQList(){
		//alert("asd");
		$.ajax( {
			type: "POST",
			url: "player_ajax_response.php",
			data: { "request": "getQuestionList"},			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("ul.gn-menu").html(response); 
				//alert(response);
			}
		});
	}
	getQList();
	$('body').on('click', '.question-no', function () {
		$id = $(this).attr('id');
		$qno = parseInt($(this).text().substring(1));
		$.ajax( {
			type: "POST",
			url: "player_ajax_response.php",
			data: { "request": "getQuestion", "qid" : $id, "qno" : $qno},			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("#main-window").html(response); 
				//alert(response);
			}
		});
	});

	$('body').on('submit', '#q-form', function (e) {
		e.preventDefault();
		var formData = new FormData($('#q-form')[0]);
		if($('#q_sub').val()==""){
			return;
		}
		
		$.ajax( {
			type: "POST",
			url: "player_ajax_response.php",
			data: formData,			
			dataType: "html",   //expect html to be returned 
			contentType: false,
			cache: false,
			processData:false,
			beforeSend: function() { 
				$(".submit-msg").html('<img id="loading" src="images/loading2.gif">');
				$("#q-submit").prop('disabled', true); // disable button
				
			},
			success: function(response) {  
				//$("#main-window").html("Save Successfull"); 
				//alert("hhh");
				//$(".submit-msg").html('<p>Submission Successfull</p>');
				$("#q-submit").prop('disabled', false); // disable button
				if(response=="1")
					$(".submit-msg").html('<p>Submission Successfull</p>');
				else
					$(".submit-msg").html('Technical Error E-101. Please try after some time.');
				$('.submit-msg').focus();
				//alert(response);
			},
			error: function(XMLHttpRequest, textStatus, errorThrown) { 
				$(".submit-msg").html('Technical Error E-105. Please try after some time.');
				$("#q-submit").prop('disabled', false);
				$('.submit-msg').focus();
			}      
		});
	});
});