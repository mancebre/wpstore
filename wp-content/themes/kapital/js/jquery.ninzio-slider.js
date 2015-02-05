/*
 Ninzio Slider 1.0.0
 http://www.ninzio.com
 Copyright 2014 Ninzio Team
*/

;(function($, window, document, undefined) {
    
    "use strict";
   
  	// DEFAULTS
   	var defaults = {
	};

    // CONSTRUCTOR FUNCTION
	function NinzioSlider (element, options){
		
		this.config = $.extend({}, defaults, options);
		this.element = element;
		this.init();
	}

	// METHOD
	NinzioSlider.prototype.init = function(){

		// Variables declaration
		// ====================================================

		var slider           = this.element,
			layout           = slider.data('layout'),
			slidesContainer  = slider.find('.ninzio-slides'),
			slide            = slidesContainer.children('li'),
			layer            = slide.find('.ninzio-layer'),
			totalSlides      = slide.length,
			responsiveValues = "",
			active           = 0;

		// Options
		// ====================================================

			var optAutoplay      = slider.data('autoplay'),
				optAutoplaydelay = slider.data('autoplaydelay'),
				optBullets       = slider.data('bullets'),
				optMobile        = slider.data('mobile'),
				optHeight        = slider.data('height'),
				optAutoHeight    = slider.data('autoheight');

		// Functions
		// ====================================================

			function OffsetValues(){
				var canvasWidth = slide.find('.slider-canvas').first().width(),
					sliderWidth = slider.outerWidth(),
					offsetArray = [canvasWidth, sliderWidth, Math.round((sliderWidth - canvasWidth)/2)];
				return offsetArray;
			}

			function LayerCoords(){

				layer.each(function(){

					var $this          = $(this),
					    $thisWidth     = $this.width(),
					    $thisHeight    = $this.height(),
						$thisDirection = $this.data('direction');

					$.when(function(){

						if (Modernizr.mq("only screen and (min-width: 1025px)")) {
							
							$thisWidth     = $this.width();
							$thisHeight    = $this.height();

						} else

						if (Modernizr.mq("only screen and (min-width: 1024px)")) {
							
							$thisWidth  = (Math.round($this.width()*0.82));
							$thisHeight = (Math.round($this.height()*0.82));

						} else

						if (Modernizr.mq("only screen and (min-width: 768px)")) {

							$thisWidth  = (Math.round($this.width()*0.62));
							$thisHeight = (Math.round($this.height()*0.62));

						}

						if (optMobile == true) {

							if (Modernizr.mq("only screen and (min-width: 480px)")) {
								
								$thisWidth  = (Math.round($this.width()*0.38));
								$thisHeight = (Math.round($this.height()*0.38));

							} else

							if (Modernizr.mq("only screen and (min-width: 320px)")) {
							
								$thisWidth  = (Math.round($this.width()*0.25));
								$thisHeight = (Math.round($this.height()*0.25));

							}
							
						};

					}).done(function(){

						switch ($thisDirection) {

							case 'left':
							$this.css({'left': -(responsiveValues[2]+$thisWidth) + "px"});
							break;

							case 'right':
							$this.css({'left': (layout == "boxed") ? responsiveValues[1] - responsiveValues[2] : responsiveValues[1] + "px"});
							break;

							case 'top':
							$this.css({'top': -($thisHeight) + "px"});
							break;

							case 'bottom':
							$this.css({'top': "103%"});
							break;

						}

					});

				});
			}

			function Navigate(direction){

				slide.first().removeClass('first-active');

				active += ~~(direction === 'next') || -1;
				active = (active < 0) ? totalSlides -1 : active % totalSlides;

				if(direction === 'next'){

					if (active == 0) {

						// We are at the last slide right now
						slide.eq(totalSlides-1)
						.addClass("navOutNext")
						.removeClass("navInNext")
						.removeClass("navInPrev")
						.removeClass("navOutPrev")
						.removeClass("active");

						slide.eq(active)
						.addClass("navInNext")
						.removeClass("navOutNext")
						.removeClass("navInPrev")
						.removeClass("navOutPrev")
						.addClass("active");
						
					} else {

						slide.eq(active-1)
						.addClass("navOutNext")
						.removeClass("navInNext")
						.removeClass("navInPrev")
						.removeClass("navOutPrev")
						.removeClass("active");

						slide.eq(active)
						.addClass("navInNext")
						.removeClass("navOutNext")
						.removeClass("navInPrev")
						.removeClass("navOutPrev")
						.addClass("active");

					}
					
				} else {

					if (active == totalSlides - 1) {
						// We are at the first slide right now
						slide.eq(0)
						.addClass("navOutPrev")
						.removeClass("navInPrev")
						.removeClass("navInNext")
						.removeClass("navOutNext")
						.removeClass("active");

						slide.eq(active)
						.addClass("navInPrev")
						.removeClass("navOutPrev")
						.removeClass("navInNext")
						.removeClass("navOutNext")
						.addClass("active");

					} else {

						slide.eq(active+1)
						.addClass("navOutPrev")
						.removeClass("navInPrev")
						.removeClass("navInNext")
						.removeClass("navOutNext")
						.removeClass("active");

						slide.eq(active)
						.addClass("navInPrev")
						.removeClass("navOutPrev")
						.removeClass("navInNext")
						.removeClass("navOutNext")
						.addClass("active");

					}
					
				}

				return active;
			}

			function BulletsNavigation(bulletArray, condition){
				
				if (condition) {$(bulletArray[active]).addClass('current-bullet').siblings().removeClass('current-bullet');};
			}

			function PlayVideo(activeSlide, target){
				var video = target.eq(activeSlide).children('video');
				if (video.length) {
					video[0].play();
				};
			}

		imagesLoaded( slider, function() {

			responsiveValues = OffsetValues();

			$.when(LayerCoords()).done(
				function(){
					setTimeout(function(){

						slide.first().addClass('active').addClass('first-active');
						
						layer.wrapInner( "<div class='layer-wrap'></div>")

						PlayVideo(active, slide);

						if(totalSlides > 1){
							$('<span data-direction="prev" class="controls prev slider-nav icon-arrow-left8"></span><span data-direction="next" class="controls next slider-nav icon-arrow-right8"></span>').appendTo(slider);
						}

						if (optBullets == true) {

							if(totalSlides > 1){
								$("<div class='ninzio-slider-bullets nz-clearfix'></div>").appendTo(slider);
							}

							var bulletsContainer = slider.children('.ninzio-slider-bullets');

							for (var i = 1; i <= totalSlides; i++) {
								$('<span>&nbsp;</span>').appendTo(bulletsContainer);
							};

							var bulletItems = bulletsContainer.find('span');
								bulletItems.first().addClass('current-bullet');
							
							bulletItems.on('click', function(){
								var $this = $(this);

								$this.addClass('current-bullet').siblings().removeClass('current-bullet');

								// Old slide
								slide.eq(active)
								.addClass("navOutNext")
								.removeClass("navInNext")
								.removeClass("navInPrev")
								.removeClass("navOutPrev")
								.removeClass("active");
								
								active = $this.index();

								// Current slide
								slide.eq(active)
								.addClass("navInNext")
								.removeClass("navOutNext")
								.removeClass("navInPrev")
								.removeClass("navOutPrev")
								.addClass("active");

								PlayVideo(active, slide);
								
							});

						};

						slider.find('.controls').on('click', function(){
							Navigate($(this).data('direction'));
							BulletsNavigation(bulletItems,optBullets);
							PlayVideo(active, slide);
						});

						if(totalSlides > 1){

							slider
							.on('swipeleft', function(){
								Navigate("next");
								BulletsNavigation(bulletItems,optBullets);
								PlayVideo(active, slide);
							})
							.on('swiperight', function(){
								Navigate("prev");
								BulletsNavigation(bulletItems,optBullets);
								PlayVideo(active, slide);
							});

						}

						if (optAutoplay == true) {

							if(totalSlides > 1){

								var AutoplayStart = window.setInterval(function(){
									Navigate("next");
									BulletsNavigation(bulletItems,optBullets);
									PlayVideo(active, slide);
								}, optAutoplaydelay);
								
								slider
								.mouseover(function(){
								    window.clearInterval(AutoplayStart);
								})
								.mouseout(function(){
									AutoplayStart = window.setInterval(function(){
										Navigate("next");
										BulletsNavigation(bulletItems,optBullets);
										PlayVideo(active, slide);
									}, optAutoplaydelay);
								})

								if (slider.is(':hover')) {
									window.clearInterval(AutoplayStart);
								};

							}

						};

						slider.find('.slider-loader').fadeOut(400, function(){
							$(this).addClass('hidden');
							slider.find('#slider-arrow').addClass('vis');
						});

					}, 2000);
				}
			)

		});

		$(window).resize(function(){

			responsiveValues = OffsetValues();
			LayerCoords();

			slide.eq(active).removeClass("active");
			slide.eq(active).find('.ninzio-layer').addClass('hidden');
			setTimeout(function(){
				slide.eq(active).addClass("active");
				slide.eq(active).find('.ninzio-layer').removeClass('hidden');
			}, 500);

		});

		// Opacity on scroll
		var win = $(window);
		win.scroll(function(){
			var percent = ($(document).scrollTop()/win.height());
			layer.find('.layer-wrap').css('opacity', 1 - percent);
		});


		if (slider.hasClass('preview')) {

			$(".single-ninzio-slider .grid")
			.mousemove(function(e){
				$('#ninzio-slider-coords .posx').html(Math.round((e.pageX-$(this).offset().left),0)+"px");
				$('#ninzio-slider-coords .posy').html(Math.round((e.pageY-$(this).offset().top),0)+"px");
			})
			.mouseout(function(e){
				$('#ninzio-slider-coords .posx').html("");
				$('#ninzio-slider-coords .posy').html("");
			});


			$("#ninzio-slider-controls #animate-out").on("click", function(e){
				e.preventDefault();
				slide.removeClass("active");
			});

			$("#ninzio-slider-controls #animate-in").on("click", function(e){
				e.preventDefault();
				slide.addClass("active");
			});

		};
		

	}

	// EXTENDING NEW FUNCTION
		
	$.fn.NinzioSlider = function(options){
		new NinzioSlider(this, options);
		return this;
	};
	
} (jQuery, window, document));