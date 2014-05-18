$(document).ready(function(){
	$('a.toggle').on('click', function(e) {    
		e.preventDefault();    
		$('.menu').slideToggle(300);})		
});

$(document).ready(function(){
	// Target your .container, .wrapper, .post, etc.
	$(".video-container").fitVids();
});