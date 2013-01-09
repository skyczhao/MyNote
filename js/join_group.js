$(function(){
	
	$('#join_group').mousedown(function(){
		
		joinGroup();
	});

});


function joinGroup(){
	var $url = window.location.search;
	var $param = $url.split('=');
	var $gid = $param[1];
	
	$.ajax({
		type: "post",
		url: "ajax/join_group.php",
		dataType: 'text',
		data: 'gid=' + $gid,
		success: function($data){
			if($data == 1){
				alert("成功加入小组！");
				window.location.href = "group.php?gid=" + $gid;
			}
			else if($data == 0){
				alert("加入小组失败！");
			}
		}
	
	});

}