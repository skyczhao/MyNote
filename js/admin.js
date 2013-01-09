$(function(){

	$('.delete_user').mousedown(function(){
		var $uid = $(this).val();
		deleteUser($uid);
		$(this).hide();
		//alert(0);
	});
		
	$('.delete_group').mousedown(function(){	
		var $gid = $(this).val();
		//alert(0);
		deleteGroup($gid);
		$(this).hide();
	});
	
	$('.delete_group_mem').mousedown(function(){	
		var $get = $(this).val();
		//alert($get);
		deleteGroupMem($get);
		//$(this).hide();
	});	
	

});

function deleteUser($uid){
	
	$.ajax({
		type: "post",
		url: "ajax/adminControl.php",
		dataType: 'text',
		data: 'userid=' + $uid,
		//alert($data);
		success: function($data){
		
			if($data == 1){
				//alert("删除用户成功！");
				
			}
			else if($data == 0){
				alert("删除用户失败！");
			}
			
		}
	
	});
	
}

function deleteGroup($gid){
	
	$.ajax({
		type: "post",
		url: "ajax/adminControl.php",
		dataType: 'text',
		data: 'groupid=' + $gid,
		//alert($data);
		success: function($data){
		
			if($data == 1){
				//alert("删除小组成功! ");
				//$(this).hide();
			}
			else if($data == 0){
				alert("删除小组失败！");
			}
			
		}
	
	});
}

function deleteGroupMem($get){
	//alert($get);
	$.ajax({
		type: "post",
		url: "ajax/adminControl.php",
		dataType: 'text',
		data: 'msg=' + $get,
		//alert($data); 
		success: function($data){
		
			if($data == 1){
				alert("删除组员成功! ");
				//$(this).hide();
			}
			else if($data == 0){
				alert("删除组员失败！");
			}
			
		}
	
	});

}
