$(function(){
	$('#submit').mousedown(function(){
		login();
	});
});

function login(){
	var $username = $("#login form input[type='text']").val();
	var $password = $("#login form input[type='password']").val();
	$.ajax({ //一个Ajax过程 
		type: "post", //以post方式与后台沟通 
		url : "ajax/login.php", //与此php页面沟通 
		dataType:'text',//从php返回的值以 JSON方式 解释 
		data: 'username='+$username+'&password='+$password, //发给php的数据有两项，分别是上面传来的u和p 
		success: function ($data){
			if($data == 1){
				$('#error1').css('display', 'inline');
				$('#error1').fadeOut(3000);
			}
			else if($data == 2){
				$('#error2').css('display', 'inline');
				$('#error2').fadeOut(3000);
			}
			else if($data == 5){
				window.location.assign("admin.php");
			}
			else{
				window.location.assign("person.php");
			}
		}
	});
};
