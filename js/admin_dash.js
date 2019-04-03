$(document).ready(function() {
	//alert("asd");
	function getQList(){
		//alert("asd");
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: { "request": "getQuestionList"},			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("ul.gn-menu").html(response); 
				//alert(response);
			}
		});
	}
	getQList();
	$('body').on('click', '#q-add', function () {
	//$("#q-add").click(function() {
		//alert("asd");
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: { "request": "addQuestion"},			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				//$("#responsecontainer").html(response); 
				//alert(response);
			}
		});
		getQList();
	});
	
	$('body').on('click', '.question-remove', function () {
		$id = $(this).attr('id');
		var clicked = function() {
			$.ajax( {
				type: "POST",
				url: "ajax_response.php",
				data: { "request": "removeQuestion", "qid" : $id},			
				dataType: "html",   //expect html to be returned                
				success: function(response) {  
					$("#responsecontainer").html(""); 
					//alert(response);
				}
			});
			$.fallr.hide();
			getQList();
		};
		
		$.fallr.show( {
			buttons : {
				button1 : {text: 'Yes', danger: true, onclick: clicked},
				button2 : {text: 'Cancel'}
			},
			content : '<p>Are you sure you want to delete the question?</p>',
			icon    : 'error',
			position:'center'
		});
	});
	
	$('body').on('click', '.question-no', function () {
		$id = $(this).attr('id');
		$qno = parseInt($(this).text().substring(1));
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: { "request": "getQuestion", "qid" : $id, "qno" : $qno},			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("#main-window").html(response); 
				//alert(response);
			}
		});
	});
	
	$('body').on('click', '.question-edit', function () {
		$id = $(this).attr('id');
		$qno = parseInt($("a.question-no#"+$id).text().substring(1));
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: { "request": "editQuestion", "qid" : $id, "qno" : $qno},			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("#main-window").html(response); 
				//alert(response);
			}
		});
	});
	
	$('body').on('submit', '#q-form', function (e) {
		e.preventDefault();
		$datetime=$('#yy').val() + "-" + $('#mm').val() + "-" + $('#dd').val() + " " + $('#hh').val() + ":" + $('#mt').val() + ":" + "00";
		$img = null;
		var formData = new FormData($('#q-form')[0]);		
		if($('#q_image').val() === undefined  || $('#q_image').val() == "")
			$img=null;
		else{
			$.ajax( {
				type: "POST",
				url: "upload_image.php",
				data: formData,		
				dataType: "html",   //expect html to be returned 
				contentType: false,
				cache: false,
				processData:false,				
				success: function(response) {  
					//$("#main-window").html(response);
					$img=response;
					//alert("sss");
					//alert(response);
					//alert($img);
				}
			});
		}
		if($img=="0")
			$img=null;
		//alert($img);
		$formData1 = {
            'request'              : "updateQuestion",
            'qid'             : $('input[name=qid]').val(),
            'qno'    : $('input[name=qno]').val(),
			'q_title'             : $('#q_title').val(),
            'q_desc'    : $('#q_desc').val(),
			'q_image'             : $img,
            'date'    : 		$datetime,
			'q_exp'             : $('#q_exp').val()
        };
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: $formData1,			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("#main-window").html("<h1>Save Successfull</h1>"); 
				//alert(response);
			}
		});
		getQList();
	});
});