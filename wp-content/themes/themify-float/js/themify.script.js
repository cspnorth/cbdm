var FixedHeader = {},LayoutAndFilter = {}, themifyScript;

// jQuery functions
(function($){

	// Fixed Header /////////////////////////
	FixedHeader = {
		headerHeight: 0,
		init: function() {
			if(!$('body').hasClass('header-leftpane') && !$('body').hasClass('header-rightpane')){
				var $pagrwrap = $('#pagewrap'),
					$headerwrap = $('#headerwrap');
				if( '' !== themifyScript.fixedHeader) {
					this.headerHeight = $headerwrap.outerHeight(true);
					this.activate();
					$(window).on('scroll touchstart.touchScroll touchmove.touchScroll', this.activate);
					$pagrwrap.css('paddingTop', Math.floor( this.headerHeight ));
					$(window).on( 'debouncedresize', function() {
						$pagrwrap.css('paddingTop', $headerwrap.outerHeight(true));
						setTimeout(function(){$pagrwrap.css('paddingTop', $headerwrap.outerHeight(true));},260);
					});
				}
			}
			if(themifyScript.sticky_header){
				var img = '<img id="sticky_header_logo" src="' + themifyScript.sticky_header.src + '"';
					if(themifyScript.sticky_header.imgwidth){
						img+=' width="'+themifyScript.sticky_header.imgwidth+'"';
					}
					if(themifyScript.sticky_header.imgheight){
						img+=' height="'+themifyScript.sticky_header.imgheight+'"';
					}
					img+='/>';
				$('#site-logo a').prepend(img);
			}
		},
		activate: function() {
			var $window = $(window),
				scrollTop = $window.scrollTop(),
				$headerWrap = $('#headerwrap');
			$('#pagewrap').css('paddingTop', Math.floor( this.headerHeight ));
			if( scrollTop >= FixedHeader.headerHeight ) {
				if ( ! $headerWrap.hasClass( 'fixed-header' ) ) {
					FixedHeader.scrollEnabled();
				}
			} else {
				if ( $headerWrap.hasClass( 'fixed-header' ) ) {
					FixedHeader.scrollDisabled();
				}
			}
		},
		scrollDisabled: function() {
			$('#pagewrap').css('paddingTop', Math.floor( this.headerHeight ));
			$('#headerwrap').removeClass('fixed-header');
			$('#header').removeClass('header-on-scroll');
			$('body').removeClass('fixed-header-on');
		},
		scrollEnabled: function() {
			$('#headerwrap').addClass('fixed-header');
			$('#header').addClass('header-on-scroll');
			$('body').addClass('fixed-header-on');
		}
	};
	
// Test if this is a touch device /////////
function is_touch_device() {
	return $('body').hasClass('touch');
}

// Infinite Scroll ///////////////////////////////
function doInfinite($container, selector, is_shortcode) {

	if ('undefined' !== typeof $.fn.infinitescroll) {

		// Get max pages for regular category pages and home
		var $loader = $container.next('.load-more');

		// disable auto infinite scroll based on user selection
		if ('auto' === themifyScript.autoInfinite && !$loader.hasClass('load-more-show')) {
			$loader.hide();
		}
		var scrollMaxPages = parseInt($loader.data('max')),
				$href = $loader.children('a'),
				$visible = $loader.is(':visible');

		// infinite scroll
		var $args = {
			navSelector: $href, // selector for the paged navigation
			nextSelector: $href, // selector for the NEXT link (to page 2)
			itemSelector: selector, // selector for all items you'll retrieve
			appendCallback: true,
			loadingText: ' ',
			donetext: '',
			msgText: '',
			maxPage: scrollMaxPages,
			behavior: $visible ? 'twitter' : '',
			bufferPx: 50,
			page: 1,
			pixelsFromNavToBottom: $('#footerwrap').height(),
		};
		if (!$visible) {
			$args.loading = { img: themifyScript.loadingImg };
		}
		else {
			$container.addClass('infinity_without_loader');
		}
		if (is_shortcode) {
			$args.path = function (nextPage) {
				if ($visible) {
					$loader.addClass('loader-wait');
					$container.find('#infscr-loading').remove();
				}
				return $href.prop('href').replace(/paging=([0-9]*)/, 'paging=' + nextPage);
			};
		}
		else {
			if ($visible) {
				$args.path = function (nextPage) {
                                    $loader.addClass('loader-wait');
                                    return $href.prop('href').replace(/page=([0-9]*)/, 'page=' + nextPage).replace(/page\/([0-9]*)/, 'page\/' + nextPage);
				};
			}
			$args.pathParse = function (path) {
				return path.match(/^(.*?)\b2\b(?!.*\b2\b)(.*?$)/).slice(1);
			};
		}
		$container.infinitescroll($args, function (newElements, opts) {
			// call Isotope for new elements
			var $newElems = $(newElements);

			// Mark new items: remove newItems from already loaded items and add it to loaded items
			$('.newItems').removeClass('newItems');
			$newElems.first().addClass('newItems');
			if ('reset' === themifyScript.resetFilterOnLoad) {
				// Make filtered elements visible again
				LayoutAndFilter.reset();
			}

			$newElems.hide().imagesLoaded().always(function (instance) {

				$('.wp-audio-shortcode, .wp-video-shortcode').not('div').each(function () {
					var $self = $(this);
					if ($self.closest('.mejs-audio').length === 0) {
						ThemifyMediaElement.init($self);
					}
				});
				$newElems.fadeIn();
				// Apply lightbox/fullscreen gallery to new items
				Themify.InitGallery();
				if ('object' === typeof $container.data('isotope')) {
					$container.isotope('appended', $newElems);
				}

				/**
				 * Fires event after the elements and its images are loaded.
				 *
				 * @event infiniteloaded.themify
				 * @param {object} $newElems The elements that were loaded.
				 */

				if (LayoutAndFilter.filterActive) {
					// If new elements with new categories were added enable them in filter bar
					LayoutAndFilter.enableFilters();
				}
				if (themifyScript.scrollToNewOnLoad) {
					LayoutAndFilter.restore($container);
				}
				$('body').trigger('infiniteloaded.themify', [$newElems]);
				$(window).trigger('resize');
				$('#infscr-loading').fadeOut('normal');
				if (1 === scrollMaxPages) {
					$loader.remove();
				}
				$loader.removeClass('loader-wait');

			});
			scrollMaxPages = scrollMaxPages - 1;

			if (1 < scrollMaxPages && 'auto' !== themifyScript.autoInfinite) {
				$loader.show();
			}
		});
	}
}

// Entry Filter /////////////////////////
LayoutAndFilter = {
	filterActive: false,
	init: function () {
		if ($('.post-filter').length > 0) {
			
			$('.post-filter + .loops-wrapper,.loops-wrapper.grid4,.loops-wrapper.grid3,.loops-wrapper.grid2').not('.builder-posts-wrap,.list-post').prepend('<div class="grid-sizer"></div><div class="gutter-sizer"></div>');
			this.enableFilters();
			this.filter();
			this.filterActive = true;
		}
	},
	enableFilters: function () {
		var $filter = $('.post-filter');
		if ($filter.find('a').length > 0 && 'undefined' !== typeof $.fn.isotope) {
			$filter.find('li').each(function () {
				var $li = $(this),
					$entries = $li.closest('.loops-wrapper'),
					cat = $li.attr('class').replace(/(current-cat)|(cat-item)|(-)|(active)/g, '').replace(' ', '');
				if ($entries.find('.post.cat-' + cat).length <= 0) {
					$li.hide();
				} else {
					$li.show();
				}
			});
		}
	},
	filter: function () {
		var $filter = $('.post-filter'),
			$rtl = $('body').hasClass('rtl');
		if ($filter.find('a').length > 0 && 'undefined' !== typeof $.fn.isotope) {
			$filter.each(function(){
				
				var $entries = $(this).closest('.loops-wrapper'),
					$gutter = 0,//$entries.find('.gutter-sizer').width(),
					$grid = $entries.find('.grid-sizer').width();
					$entries.find('.gutter-sizer,.grid-sizer').remove();
					var $this = $(this),
					$filter_title = $this.closest('.portfolio-filter-wrap').find('.post-filter-title');
					
					$this.addClass('filter-visible').on('click', 'a', function (e) {
						e.preventDefault();
						if ($this.hasClass('filter-disable')) {
							return;
						}
						$this.addClass('filter-disable');
						var $li = $(this).parent(),
							$cat = false,
							$masonry = {gutter: $gutter,grid:$grid};
						
						if ($li.hasClass('active')) {
							
							$li.removeClass('active');
							$entries.isotope({
								masonry: $masonry,
								isResizeBound : true,
								isOriginLeft: !$rtl,
								filter: '*'
							});
							$filter_title.text('');
						}
						else {
							$li.siblings('.active').removeClass('active');
							$li.addClass('active');
							$cat = $li.attr('class').replace(/(current-cat)|(cat-item)|(-)|(active)/g, '').replace(' ', '');
							$filter_title.text($(this).text());
							$entries.isotope({
								masonry: $masonry,
								isResizeBound : true,
								itemSelector: '.post',
								isOriginLeft: !$rtl,
								filter: '.filter-wrapper,.cat-' + $cat
							});
						}
						$this.removeClass('filter-disable');
					});
			});
		}
	},
	scrolling: false,
	reset: function() {
		$('.post-filter').find('li.active').find('a').addClass('previous-active').trigger('click');
		this.scrolling = true;
	},
	restore: function($container) {
		var $first = $container.find('.newItems').first();
		if ($first) {
			var self = this,
					to = $first.offset().top - ($first.outerHeight(true) / 2),
					speed = 800;
			if (to >= 800) {
				speed = 800 + Math.abs((to / 1000) * 100);
			}
			$('html,body').stop().animate({
				scrollTop: to
			}, speed, function () {
				self.scrolling = false;
			});
		}
	},
	layout: function () {
			var $isotop = $('.loops-wrapper.portfolio,.masonry').not('.builder-posts-wrap');

			if ($isotop.length > 0) {
				var $rtl = $('body').hasClass('rtl');
				$isotop.each(function () {
					var $this = $(this),
						$masonry = {},
						$is_post = $this.children('.post').length > 0;
					if ($is_post) {
						if($this.hasClass('portfolio') && $this.find('.portfolio-filter-wrap').length===0){
							return true;
						}
						$masonry = {
							gutter: $this.hasClass('portfolio')?0:'.gutter-sizer'
						};
						if($this.prev('.post-filter').length === 0 && $this.find('.gutter-sizer').length === 0){
							$this.prepend('<div class="grid-sizer"></div><div class="gutter-sizer"></div>');
						}
						$this.find('.portfolio-filter-wrap').height($this.find('.post').not('.size-large,.filter-wrapper').first().height());
					}
					$this.imagesLoaded().always(function (instance) {
						$this.isotope({
							masonry: $masonry,
							isOriginLeft: !$rtl,
							isResizeBound : true,
							itemSelector: $is_post ? '.post' : '.item'
						}).addClass('masonry-done');
						
					});
				});
				var $this = this;
				$this.resize($isotop);
				$(window).resize(function(){
					$this.resize($isotop);
				});
			}
			if($('body').hasClass('masonry-enabled') && $('.woocommerce.archive').length>0){
				$('.woocommerce.archive').find('#content').find('ul.products').each(function(){
					var $this = $(this);
					$this.imagesLoaded().always(function(){
						$this.isotope({
							layoutMode: 'packery',
							itemSelector : '.product',
							isOriginLeft : ! $( 'body' ).hasClass( 'rtl' )
						}).addClass('masonry-done');
					});
				});
			}
		}
	,
	resize:function($isotop){
		$isotop.each(function () {
			var $this = $(this);
			if($this.hasClass('portfolio') && $this.find('.portfolio-filter-wrap').length===0){
				return true;
			}
			$this.imagesLoaded().always(function (instance) {
				$this.find('.portfolio-filter-wrap').height($this.find('.post').not('.size-large,.filter-wrapper').first().height());
			});
		});
	}
};

/////////////////////////////////////////////
// jQuery functions					
/////////////////////////////////////////////
$(document).ready(function($){
	
	var $body = $('body');
	var themify_svg_height = function(){
 		var $items = $('.post-media-svg+img');
 		$items.each(function(){
 			var $this = $(this);
			$this.imagesLoaded().always(function(){
 				var $parent = $this.prev('.post-media-svg');
 				$parent.height($this.height());
			});
		});
 	};
	
	//clip-path svg hack for IE 9-11,Edge
	if($('.svg-image').length>0){
		themify_svg_height();
		$(window).on('debouncedresize',themify_svg_height);
	}
	FixedHeader.init();
	
	/////////////////////////////////////////////
	// Initialize Packery Layout and Filter
	/////////////////////////////////////////////
	LayoutAndFilter.init();
	LayoutAndFilter.layout();
	
	/////////////////////////////////////////////
	// Scroll to top 							
	/////////////////////////////////////////////
	$('.back-top a').click(function () {
		$('body,html').animate({
			scrollTop: 0
		}, 800);
		return false;
	});
	
	/////////////////////////////////////////////
	// Toggle main nav on mobile 							
	/////////////////////////////////////////////
	// touch dropdown menu
	if( $( 'body' ).hasClass( 'touch' ) && typeof jQuery.fn.themifyDropdown != 'function' ) {
		Themify.LoadAsync(themify_vars.url + '/js/themify.dropdown.js', function(){
			$( 'body.horizontal-menu #main-nav' ).themifyDropdown();
		});
	}
    
	$('#menu-icon').themifySideMenu({
		close: '#menu-icon-close'
	});
	
	var $overlay = $( '<div class="body-overlay">' );
	$body.append( $overlay ).on( 'sidemenushow.themify', function () {
		$overlay.addClass( 'body-overlay-on' );
	}).on( 'sidemenuhide.themify', function () {
		$overlay.removeClass( 'body-overlay-on' );
	}).on( 'click.themify touchend.themify', '.body-overlay', function () {
		$( '#menu-icon' ).themifySideMenu( 'hide' );
	}); 
	
    // Reset slide nav width
    $(window).on('debouncedresize', function () {
		if( $( '#menu-icon' ).is(':visible') && $('#mobile-menu').hasClass('sidemenu-on')){
			$overlay.addClass( 'body-overlay-on' );
		}
		else{
			 $overlay.removeClass( 'body-overlay-on' );
		}
		var viewport = $(window).width();
		if (viewport > 780) {
			$('body').removeAttr('style');
		}
	});

	// Set Dropdown Arrow
	$("#main-nav li.menu-item-has-children > a, #main-nav li.page_item_has_children > a").after(
		"<span class='child-arrow'></span>"
	);
	$('#main-nav li.menu-item-has-children > .child-arrow, #main-nav li.page_item_has_children > .child-arrow').click(function() {
		$(this).toggleClass('toggle-on');
		$body.trigger('themify_sidemnenu');
		return true;
	});
	
	 

	/////////////////////////////////////////////
	// SET NICESCROLL SCROLLBAR
	/////////////////////////////////////////////	
	// Set Header Leftpane & Header Rightpane niceScroll
	if('undefined' !== typeof $.fn.niceScroll){
            if (! is_touch_device() && ($body.hasClass( 'header-rightpane' ) || $body.hasClass( 'header-leftpane' ) )) {

                    var $niceScrollTarget = $('#headerwrap');
                    $niceScrollTarget.niceScroll({horizrailenabled:false});
                    var $el = $('#'+$niceScrollTarget.getNiceScroll()[0].id);
                    $el.addClass('nicescroll-rails-hidden');
                    $body.on( 'sidemenushow.themify themify_sidemnenu', function(){
                        setTimeout(function(){
                            $niceScrollTarget.getNiceScroll().resize();
                            $el.removeClass('nicescroll-rails-hidden');
                        },320);

                    }).on( 'sidemenuhide.themify themify_sidemnenu', function(){
                        setTimeout(function(){
                            $el.addClass('nicescroll-rails-hidden');
                        },200);
                    });
            }
            // Set default #mobile-menu niceScroll
            else if ($('body').hasClass("no-touch")) {
                    var $niceScrollTarget = $('body:not(.horizontal-menu):not(.header-leftpane):not(.header-rightpane) #mobile-menu');
                    $niceScrollTarget.niceScroll({horizrailenabled:false});
                    $body.on('sidemenushow.themify themify_sidemnenu', function(){
                            setTimeout(function(){
                                    $niceScrollTarget.getNiceScroll().resize();
                            }, 200);
                    });

            }
	}
	
	// Sticky - plugin //////////////////////////////
     $(window).on('debouncedresize', function () {
		var viewport = $(window).width();
		if (viewport > 1400) {
			if(typeof $.fn.sticky !== 'undefined'){
				var $el = $('body:not(.sidebar-left).single .social-share');
				$el.sticky({
					topSpacing: 125,
					stopper: '#footerwrap'
				});
			}
		}
	});
	
});

$(window).load(function(){
	// Lightbox / Fullscreen initialization ///////////
	if(typeof ThemifyGallery !== 'undefined'){
		ThemifyGallery.init({'context': $(themifyScript.lightboxContext)}); 
	}
	var $body = $('body');
	
	///////////////////////////////////////////
	// Initialize infinite scroll
	///////////////////////////////////////////
	if ($body.hasClass('woocommerce') && $body.hasClass('archive')) {
		doInfinite($('#content ul.products'), '#content .product');
	}
	$('.loops-wrapper').each(function () {
		var $load = $(this).find('.load-more');
		if ($load.length > 0) {
			$(this).after($load);
			doInfinite($(this), '.post', true);
		}
		else if ($(this).next('.load-more').length > 0) {
			doInfinite($(this), '.post', false);
		}

	});
	// EDGE MENU //
	$(function ($) {
		$("#main-nav li").on('mouseenter mouseleave dropdown_open', function (e) {
			if ($('ul', this).length) {
				var elm = $('ul:first', this);
				var off = elm.offset();
				var l = off.left;
				var w = elm.width();
				var docW = $(window).width();
				var isEntirelyVisible = (l + w <= docW);

				if (!isEntirelyVisible) {
					$(this).addClass('edge');
				} else {
					$(this).removeClass('edge');
				}

			}
		});
	});
	
});

})(jQuery);