$(function(){
	var $container = $('#main');
	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.item',
			columnWidth:240,	//һ�еĿ��
		});
	});
});
