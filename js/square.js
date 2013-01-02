// square.js 
// version 1.0 (Dec, 22th. 2012)
// created by kylejan for web2.0 project

$(function(){
	var $container = $('.footprint');
	$container.imagesLoaded(function(){
		$container.masonry({
			itemSelector : '.item'
		});
	});
});