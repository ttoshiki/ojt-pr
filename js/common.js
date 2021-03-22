$(function(){
	$('a[href*=\\#]:not([href=\\#])').click(function() {
	if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var $target = $(this.hash);
			$target = $target.length && $target || $('[name=' + this.hash.slice(1) +']');
			if ($target.length) {
				if($(this).parents('.menuBox').length){
					setTimeout(function(){
						var targetOffset = $target.offset().top;
						$('html,body').animate({scrollTop: targetOffset}, 1000);
					},100);
				}else{
					var targetOffset = $target.offset().top;
					$('html,body').animate({scrollTop: targetOffset}, 1000);
				}
				return false;
			}
		}
	});
	$(window).scroll(function(){
		if($(window).scrollTop() > 300){
			$('.fixBtnUl').fadeIn();
		}else{
			$('.fixBtnUl').fadeOut();
		}
	});
	
	var state = false;
	var scrollpos;
	$('#gHeader .menu').on('click', function() {
		if (state == false) {
			scrollpos = $(window).scrollTop();
			$('body').addClass('fixed').css({ 'top': -scrollpos });
			$('.menuBox').fadeIn().addClass('open');
			state = true;
		} else {
			$('body').removeClass('fixed').css({ 'top': 0 });
			window.scrollTo(0, scrollpos);
			$('.menuBox').removeClass('open').fadeOut();
			state = false;
		}
		return false;
	});

	$('.menuBox .naviUl li').each(function() {
		var num = $(this).index();
		$(this).css('transition-delay',0.1*num+'s');
	})
	
	$('.menuBox .close').click(function(){
		if($(window).width() < 768){
			$('body').removeClass('fixed').css({ 'top': 0 });
			window.scrollTo(0, scrollpos);
			$('.menuBox').removeClass('open').fadeOut();
		}
		state = false;
	});
});

$(window).on('load',function(){
	var localLink = window.location+'';
	if(localLink.indexOf("#") != -1 && localLink.slice(-1) != '#'){	
		localLink = localLink.slice(localLink.indexOf("#")+1);
		$('html,body').animate({scrollTop: $('#'+localLink).offset().top}, 500);
	}
});