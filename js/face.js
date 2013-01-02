$(function(){
	var $container = $('#faces');
	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.items',
			columnWidth: 30,	//一列的宽度
		});
	});
	
	var $items = $("img");
	for(var $i = 0; $i < 64; $i++){
		$items[$i].onclick = function(){
			opener.document.getElementById("face").src = this.src;
			opener.document.getElementsByName('facepath')[0].value = this.alt;
			//opener.window.alert("dfdf0");
		};
	}
});