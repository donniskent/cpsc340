$(document).ready(function (){
	 $(document).on('click','.acceptFriend',function () {
		var val = $(this).val();
		//alert(val + " accept");
		
		
		
		$.post("friendRequestProcessing.php", {
			inst: val,
			response: 1
		}, function(){
			//reload the 
			
			
			
			$("#comments").load("commentsReset.php");
			
		}
		
		
		);
		
		
		
		
		
	
		
	
	
	
	
	});
	
	$(document).on('click','.declineFriend',function (){
		var val = $(this).val();
		//alert(val + " deny");
		
		$.post("friendRequestProcessing.php", {
			inst: val,
			response: 0
		}, function() {
			$("#friendrequests").load("friendsReset.php");
		})
		
		
	});