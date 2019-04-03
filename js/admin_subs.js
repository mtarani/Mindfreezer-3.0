$(document).ready(function() {
	//alert("asd");
	function getQList(){
		//alert("asd");
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: { "request": "getQuestionListSub"},			
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
			url: "ajax_response.php",
			data: { "request": "getQuestionSubs", "qid" : $id, "qno" : $qno},			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("#main-window").html(response); 
				//alert(response);
			}
		});
	});
	$('body').on('click', '.sub-head', function () {
		//alert("ss");
		$subid = $(this).attr('id');
		$qid = $('#qid').val();
		$qno = $('#qno').val();
		//alert($subid);
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: { "request": "openSubmission", "subid" : $subid, "qid" : $qid, "qno" :$qno },			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("#main-window").html(response); 
				//alert(response);
			}
		});
	});
	$('body').on('click', '.check', function () {
		//alert("ss");
		$check = $(this).attr('id') == "right" ? "1" : "0";
		$subid = $('#subid').val();
		$qid = $('#qid').val();
		$qno = $('#qno').val();
		//alert($subid);
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: { "request": "checkQuestionSubmissions", "subid" : $subid, "check" : $check, "qid" : $qid, "qno" : $qno },			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("#main-window").html(response); 
				//alert(response);
			}
		});
	});
	$('body').on('click', '#l-update', function () {
		//alert("ss");
		$qid = $('#qid').val();
		//alert($subid);
		$.ajax( {
			type: "POST",
			url: "ajax_response.php",
			data: { "request": "updateLeaderboard", "qid" : $qid},			
			dataType: "html",   //expect html to be returned                
			success: function(response) {  
				$("#main-window").html("<p>Leaderboard Updated</p>"); 
				//alert(response);
			}
		});
	});
});