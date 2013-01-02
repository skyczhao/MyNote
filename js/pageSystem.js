$(function()){
	var winH = $(window).height();	//页面可视区域高度
	var i = 1;		//当前页数
	$(window).scroll(function(){
		var pageH = $(document.body).height();	//页面总高度
		var scrollT = $(window).scrollTop();	//滚动条top
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
					$(".nodata).show().html("到底了哇呜~");
					return false;
				}
			});
		}
	});
});