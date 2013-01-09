$(function(){
	
	$('#add_friend').mousedown(function(){
		
		addFriend();
	});

});


function addFriend(){
	var $url = window.location.search;
	var $param = $url.split('=');
	var $uid = $param[1];
	
	
	$.ajax({
		type: "post",
		url: "ajax/add_friend.php",
		dataType: 'text',
		data: 'userid=' + $uid,
		success: function($data){
			
			//alert($data);
			if($data == 1){
				alert("成功添加好友!");
			}
			else if($data == 0){
				alert("好友添加失败");
			}
		}
	
	});
	//alert($param[1]);

}