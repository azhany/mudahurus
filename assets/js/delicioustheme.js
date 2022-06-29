$(document).ready(function(){
	var top = $("#topContainer");
	var contentWrapper = $("#contentWrapper");
	var naviWrap = $("#navigationWrap");
	var windowH = $(window);
	var headerHeight = 0;
	var folMenu = $("#followMenu");
	
	//generate responsive menu
	$( ".mainMenu" ).clone().prependTo( "#followMenu" );

	var lastId,
	    topMenu = $("#followMenu .mainMenu"),
	    topMenuHeight = 76,
	    // All list items
	    menuItems = topMenu.find("a"),
	    // Anchors corresponding to menu items
	    scrollItems = menuItems.map(function(){
	      var item = $($(this).attr("href"));
	      if (item.length) { return item; }
	    });

	//init style of header
	window.setTimeout(initDelicious, 1000);

	/**
	 * 
	 * scroll funciton
	 * 
	 */
	$(window).scroll(function() {
		bgPos = $(window).scrollTop() * 1.2;
		$('.textureBgSection').css('background-position', '0px '+bgPos+'px');


	   // Get container scroll position
	   var fromTop = $(this).scrollTop() + topMenuHeight;
	   
	   // Get id of current scroll item
	   var cur = scrollItems.map(function(){
	     if ($(this).offset().top <= (fromTop+5))
	       return this;
	   });
	   // Get the id of the current element
	   cur = cur[cur.length-1];
	   var id = cur && cur.length ? cur[0].id : "";
	   
	   if (lastId !== id) {
	       lastId = id;
	       // Set/remove active class
	       menuItems
	         .parent().removeClass("menuActive")
	         .end().filter("[href=#"+id+"]").parent().addClass("menuActive");
	   }      

		if (headerHeight !== 0 && ($(window).scrollTop()+50) > headerHeight) {
			if (!folMenu.hasClass("fmshown")) {
				folMenu.addClass("fmshown");
				//folMenu.stop().fadeIn(300); 
			}

		}
		else {
			if (folMenu.hasClass("fmshown")) {
				folMenu.removeClass("fmshown");
				//folMenu.stop().fadeOut(300);
			}
		}

	});

	$(".mainMenu a, #layerslider a").click(function(e) {
		e.preventDefault();
		var target = $(this).attr("href");
		//alert();

     $('html,body').animate({
         scrollTop: ($(target).offset().top - topMenuHeight)
    }, 800);
	});

	/**
	 * 
	 * change styles on resize
	 * 
	 */
	function resizedw() {
		initDelicious();
	};

	var doit;
	window.onresize = function(){
	  clearTimeout(doit);
	  doit = setTimeout(resizedw, 300);
	};

	/**
	 * 
	 * set header slider dimensions and stuff
	 * 
	 */
	function initDelicious() {
		headerHeight = top.height();
		contentWrapper.css('top', headerHeight);

		//adjust on small screens
		if ((headerHeight-100) > $(window).height())
			top.css('position', 'absolute');
		else
			top.css('position', 'fixed');
	}

	/**
	 * 
	 * contact form submit
	 * 
	 */
	$( "#sendmail" ).on( "submit", function( event ) {
		event.preventDefault();
		$(".fa-form-wait").css('display', 'inline-block');

		$.ajax( {
			type: "POST",
			url: $( "#sendmail" ).attr( 'action' ),
			data: $( "#sendmail" ).serialize(),
			success: function( response ) {
				var rpl = JSON.parse(response);

				$(".fa-form-wait").css('display', 'none');

				if (rpl.type == "error")
					$("#formSubmitMessage").html('<span style="color: #AA0000;"><i class="fa fa-exclamation-circle"></i> ' + rpl.text + '</span>');
				else {
					$("#formSubmitMessage").html('<span style="color: #40A6A6;"><i class="fa fa-check-circle"></i> ' + rpl.text + '</span>');
					$("#sendmail").slideUp();
				}
			}
		});
	});
});


function isElementInViewport (el) {

    //special bonus for those using jQuery
    if (el instanceof jQuery) {
        el = el[0];
    }

    var rect = el.getBoundingClientRect();
    //console.log(rect.top)
    return (
        rect.top == 0
    );
}