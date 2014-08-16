$(function() {
	$("#sub_btn").click(function(){
		var search_name = $("#name").val();
		$.ajax({
	        type: "POST",
	        url: "search.php",
	        data: "search_name=" + search_name,
	        success: function(Respond){
	        	$("#list").html(Respond)
	        }
	    });

	});
    
});