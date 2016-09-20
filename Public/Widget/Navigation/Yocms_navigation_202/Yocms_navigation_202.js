require(['jquery'], function($){
		/* 	1st example	*/
		/// wrap inner content of each anchor with first layer and append background layer
		$("#Yocms_navigation_202 li a").wrapInner( '<span class="out"></span>' ).append( '<span class="bg"></span>' );
		// loop each anchor and add copy of text content
		$("#Yocms_navigation_202 li a").each(function() {
		$( '<span class="over">' +  $(this).text() + '</span>' ).appendTo( this );
	});
	$("#Yocms_navigation_202 li a").hover(function() {
		// this function is fired when the mouse is moved over
		$(".out",	this).stop().animate({'top':	'40px'},	250); // move down - hide
		$(".over",	this).stop().animate({'top':	'0px'},		250); // move down - show
		$(".bg",	this).stop().animate({'top':	'0px'},		120); // move down - show
	}, function() {
		// this function is fired when the mouse is moved off
		$(".out",	this).stop().animate({'top':	'0px'},		250); // move up - show
		$(".over",	this).stop().animate({'top':	'-40px'},	250); // move up - hide
		$(".bg",	this).stop().animate({'top':	'-40px'},	120); // move up - hide
	});
});
var ListYocms_navigation_202_is_load=1;