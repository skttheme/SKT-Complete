jQuery(document).ready(function() {
	jQuery(".header-search-toggle").click(function() {
	   jQuery(".header-search-form").toggle();
	   jQuery(".header-search-form .search-field").focus();
	 });
});

jQuery(window).load(function() {
		if(jQuery('#slider') > 0) {
        jQuery('.nivoSlider').nivoSlider({
        	effect:'fade',
    });
		} else {
			jQuery('#slider').nivoSlider({
        	effect:'fade',
    });
		}
});
// NAVIGATION CALLBACK
var ww = jQuery(window).width();
jQuery(document).ready(function() { 
	jQuery(".sitenav li a").each(function() {
		if (jQuery(this).next().length > 0) {
			jQuery(this).addClass("parent");
		};
	})
	jQuery(".toggleMenu").click(function(e) { 
		e.preventDefault();
		jQuery(this).toggleClass("active");
		jQuery(".sitenav").slideToggle('fast');
	});
	adjustMenu();
})
// navigation orientation resize callbak
jQuery(window).bind('resize orientationchange', function() {
	ww = jQuery(window).width();
	adjustMenu();
});
var adjustMenu = function() {
	if (ww < 981) {
		jQuery(".toggleMenu").css("display", "block");
		if (!jQuery(".toggleMenu").hasClass("active")) {
			jQuery(".sitenav").hide();
		} else {
			jQuery(".sitenav").show();
		}
		jQuery(".sitenav li").unbind('mouseenter mouseleave');
	} else {
		jQuery(".toggleMenu").css("display", "none");
		jQuery(".sitenav").show();
		jQuery(".sitenav li").removeClass("hover");
		jQuery(".sitenav li a").unbind('click');
		jQuery(".sitenav li").unbind('mouseenter mouseleave').bind('mouseenter mouseleave', function() {
			jQuery(this).toggleClass('hover');
		});
	}
}
jQuery(document).ready(function() {
  	jQuery('.srchicon').click(function() {
			jQuery('.searchtop').toggle();
			jQuery('.topsocial').toggle();
		});	
});

// Animation JS //
// .bounce, .flash, .pulse, .shake, .swing, .tada, .wobble, .bounceIn, .bounceInDown, .bounceInLeft, .bounceInRight, .bounceInUp, .bounceOut, .bounceOutDown, .bounceOutLeft, .bounceOutRight, .bounceOutUp, .fadeIn, .fadeInDown, .fadeInDownBig, .fadeInLeft, .fadeInLeftBig, .fadeInRight, .fadeInRightBig, .fadeInUp, .fadeInUpBig, .fadeOut, .fadeOutDown, .fadeOutDownBig, .fadeOutLeft, .fadeOutLeftBig, .fadeOutRight, .fadeOutRightBig, .fadeOutUp, .fadeOutUpBig, .flip, .flipInX, .flipInY, .flipOutX, .flipOutY, .lightSpeedIn, .lightSpeedOut, .rotateIn, .rotateInDownLeft, .rotateInDownRight, .rotateInUpLeft, .rotateInUpRight, .rotateOut, .rotateOutDownLeft, .rotateOutDownRight, .rotateOutUpLeft, .rotateOutUpRight, .slideInDown, .slideInLeft, .slideInRight, .slideOutLeft, .slideOutRight, .slideOutUp, .rollIn, .rollOut, .zoomIn, .zoomInDown, .zoomInLeft, .zoomInRight, .zoomInUp
jQuery.noConflict();
jQuery(document).ready(function(){
jQuery(window).scroll(function(){
    // This is then function used to detect if the element is scrolled into view
    function elementScrolled(elem)
    {
        var docViewTop = jQuery(window).scrollTop();
        var docViewBottom = docViewTop + jQuery(window).height();
        var elemTop = jQuery(elem).offset().top;
        return ((elemTop <= docViewBottom) && (elemTop >= docViewTop));
    }
    // This is where we use the function to detect if ".box2" is scrolled into view, and when it is add the class ".animated" to the <p> child element
	if (jQuery('.home_section1_content').length > 0) {
    if(elementScrolled('.home_section1_content')) {
        var els = jQuery('.home_section1_content'),
            i = 0,
            f = function () {
                jQuery(els[i++]).addClass('fadeInUp');
                if(i < els.length) setTimeout(f, 400);
            };
        f();
    }}

	if (jQuery('.hometwo-row').length > 0) { 
	if(elementScrolled('.hometwo-row')) {
        var els = jQuery('.hometwo-row'),
            i = 0,
            f = function () {
                jQuery(els[i++]).addClass('fadeInLeft');
                if(i < els.length) setTimeout(f, 400);
            };
        f();
    }}	
	
	if (jQuery('.home3-area').length > 0) { 
	if(elementScrolled('.home3-area')) {
        var els = jQuery('.home3-area'),
            i = 0,
            f = function () {
                jQuery(els[i++]).addClass('fadeInUp');
                if(i < els.length) setTimeout(f, 400);
            };
        f();
    }}	
});
});
 
jQuery(document).ready(function() {
        jQuery('.logo h2').each(function(index, element) {
            var heading = jQuery(element);
            var word_array, last_word, first_part;
            word_array = heading.html().split(/\s+/); // split on spaces
            last_word = word_array.pop();             // pop the last word
            first_part = word_array.join(' ');        // rejoin the first words together
            heading.html([first_part, ' <span>', last_word, '</span>'].join(''));
        });
});	