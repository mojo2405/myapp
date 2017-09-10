function calculateTitleTransform(){
	"use strict";
	jQuery('div.hgr_advimage').each( function() { 
		var elementH = jQuery(this).height();
		var titleH = jQuery(this).find('.hgr-advimage-title').outerHeight(true);
		jQuery(this).find('.hgr_advimage_elements_container').css({	"-webkit-transform":"translateY( calc("+elementH+"px - "+titleH+"px) )",
																	"-ms-transform":"translateY( calc("+elementH+"px - "+titleH+"px) )",
																	"transform":"translateY( calc("+elementH+"px - "+titleH+"px) )"
																  }); 
	});
}

jQuery(document).ready(function($) {
	"use strict";
	calculateTitleTransform();
	$( window ).resize(function() {calculateTitleTransform();});
	$( "div.hgr_advimage" ).mouseenter(function() {
		var elementH = jQuery(this).height();
		var containerH = jQuery(this).find('.hgr_advimage_elements_container').outerHeight(true);
		jQuery(this).find('.hgr_advimage_elements_container').css({	"-webkit-transform":"translateY( calc("+elementH+"px - "+containerH+"px) )",
																	"-ms-transform":"translateY( calc("+elementH+"px - "+containerH+"px) )",
																	"transform":"translateY( calc("+elementH+"px - "+containerH+"px) )"
																  });  
	  })
	  .mouseleave(function() {
		var elementH = jQuery(this).height();
		var containerH = jQuery(this).find('.hgr_advimage_elements_container').outerHeight(true);
		var titleH = jQuery(this).find('.hgr-advimage-title').outerHeight(true);
		
		console.log("down by .hgr_advimage_elements_container height "+containerH);
		
		jQuery(this).find('.hgr_advimage_elements_container').css({	"-webkit-transform":"translateY( calc("+elementH+"px - "+titleH+"px) )",
																	"-ms-transform":"translateY( calc("+elementH+"px - "+titleH+"px) )",
																	"transform":"translateY( calc("+elementH+"px - "+titleH+"px) )"
																  }); 
	  });
});