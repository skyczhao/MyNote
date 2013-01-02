$(function(){
	var $face = $('#face');
	$face.click(function(){
		window.open("face.php", 'face', 'width=400,height=400,top=0,left=0,scrollbars=1');
	});

	var $code = $('#codeimg');
	$code.click(function(){
		this.src = "functions/code.php?tm=" + Math.random();
	
	});
	
	// $('#submit input').click(function(){
		// alert($('#code input').val() + '+' + $_SE)
		// if($('#code input').val() != $_SESSION['code']){
			$('#code input').css('display', 'inline');
			// alert('!');
		// }
	
	// });
	
	$('#unamewrapper input').blur(function(){
		reg = /[\W]/;
		//alert($(this).val().match(reg));
		//alert($('#unamewrapper span.error').css('display'));
		if($(this).val().length < 4 || $(this).val().length > 10
			|| $(this).val().match(reg) != null){
			$('#unamewrapper span.error').css('display', 'inline');
			//alert($('#unamewrapper span.error').css('display'));
		}
		else{
			$('#unamewrapper span.error').css('display', 'none');
		}
		
	});
	
	$('#pswwrapper input').blur(function(){
		reg = /[\W]/;
		//alert($('#unamewrapper span.error').css('display'));
		if($(this).val().length < 8 || $(this).val().length > 15
			|| $(this).val().match(reg) != null){
			$('#pswwrapper span.error').css('display', 'inline');
			//alert($('#unamewrapper span.error').css('display'));
		}
		else{
			$('#pswwrapper span.error').css('display', 'none');
		}
		
	});
	
	$('#pswverifywrapper input').blur(function(){
		//alert($('#unamewrapper span.error').css('display'));
		if($(this).val() != $('#pswwrapper input').val()){
			$('#pswverifywrapper span.error').css('display', 'inline');
			//alert($('#unamewrapper span.error').css('display'));
		}
		else{
			$('#pswverifywrapper span.error').css('display', 'none');
		}
		
	});
	
	$('#nknamewrapper input').blur(function(){
		//alert($('#unamewrapper span.error').css('display'));
		if($(this).val().length == 0){
			$('#nknamewrapper span.error').css('display', 'inline');
			//alert($('#unamewrapper span.error').css('display'));
		}
		else{
			$('#nknamewrapper span.error').css('display', 'none');
		}
		
	});
});
