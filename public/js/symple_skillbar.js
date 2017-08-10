jQuery(function($){
	$(document).ready(function(){
		$('.symple-skillbar').each(function(){
			$(this).find('.symple-skillbar-bar').animate({ width: $(this).attr('data-percent') }, 1500 );
		});
	});
});