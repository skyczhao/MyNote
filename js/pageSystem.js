$(function()){
	var winH = $(window).height();	//ҳ���������߶�
	var i = 1;		//��ǰҳ��
	$(window).scroll(function(){
		var pageH = $(document.body).height();	//ҳ���ܸ߶�
		var scrollT = $(window).scrollTop();	//������top
		var aa = (pageH-winH-scrollT)/winH;
		if(aa<0.02){
			$.getJSON("result.php",{page:i},function(json){
				if(json){
					var str = "";
					$.each(json,funtion(index,array){
						var str = "...";
					$('#mian').append(str);
					});
					i++;
				}else{
					$(".nodata).show().html("����������~");
					return false;
				}
			});
		}
	});
});