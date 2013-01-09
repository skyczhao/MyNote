$(function(){
	
	$('#out_group').mousedown(function(){
		
		outGroup();
	});

});


function outGroup(){
	var $url = window.location.search;
	var $param = $url.split('=');
	var $gid = $param[1];
	
	$.ajax({
		type: "post",
		url: "ajax/out_group.php",
		dataType: 'text',
		data: 'gid=' + $gid,
		success: function($data){
			if($data == 1){
				alert("成功退出小组！");
				window.location.href = "group.php?gid=" + $gid;
			}
			else if($data == 0){
				alert("退出小组失败！");
			}
		}
	
	});

}