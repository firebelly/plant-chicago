// PlantChicago - Firebelly 2015

// Good Design for Good Reason for Good Namespace
var PlantChicago = (function($) {

  var screen_width = 0,
      breakpoint_small = false,
      breakpoint_medium = false,
      breakpoint_large = false,
      breakpoint_array = [480,1000,1200],
      $document,
      $sidebar,
      loadingTimer,
      page_at;

  function _init() {
    // touch-friendly fast clicks
    FastClick.attach(document.body);

    // Cache some common DOM queries
    $document = $(document);
    $('body').addClass('loaded');

    // Set screen size vars
    _resize();

    // Fit them vids!
    $('main').fitVids();
 
    _initNav();
    _initBigClicky();
    _initSearch();
    _injectSvgSprite();
    _initPeopleModals();

    // People/post nav arrow handlers
    // Next
    $(document).keydown(function(e) {
      if (e.keyCode === 39) {
        if ($('.person.-active').length) {
          _nextPerson();
        } else if ($('body').is('.single') && $('.post-nav .next a').length) {
          var $postLink = $('.post-nav .next a').attr('href');
          window.location = $postLink;
        }
      }
    });
    // Previous
    $(document).keydown(function(e) {
      if (e.keyCode === 37) {
        if ($('.person.-active').length) {
          _prevPerson();
        } else if ($('body').is('.single') && $('.post-nav .previous a').length) {
          var $postLink = $('.post-nav .previous a').attr('href');
          window.location = $postLink;
        }
      }
    });

    // Esc handlers
    $(document).keyup(function(e) {
      if (e.keyCode === 27) {
        if ($('.site-header .search-form.-active').length) {
          _hideSearch();
        }
        if ($('.person.-active').length) {
          _closePerson();
        }
      }
    });

    // Smoothscroll links
    $('a.smoothscroll').click(function(e) {
      e.preventDefault();
      var href = $(this).attr('href');
      _scrollBody($(href));
    });

    // Scroll down to hash afer page load
    $(window).load(function() {
      if (window.location.hash) {
        _scrollBody($(window.location.hash)); 
      }
    });

  } // end init()

  function _injectSvgSprite() {
    boomsvgloader.load('/app/themes/plantchicago/assets/svgs/build/svgs-defs.svg'); 
  }

  function _scrollBody(element, duration, delay) {
    if ($('#wpadminbar').length) {
      wpOffset = $('#wpadminbar').height();
    } else {
      wpOffset = 0;
    } 
    element.velocity("scroll", {
      duration: duration,
      delay: delay,
      offset: -wpOffset
    }, "easeOutSine");
  }


  function _initBigClicky() {
    $(document).on('click', '.bigclicky', function(e) {
      if (!$(e.target).is('a')) {
        e.preventDefault();
        var link = $(this).find('a:first');
        var href = link.attr('href');
        if (href) {
          if (e.metaKey || link.attr('target')) {
            window.open(href);
          } else {
            location.href = href;
          }
        }
      }
    });
  }

  var _searchFocusTimeout; // A var to hold the timeouts we'll use to autofocus this.  We will need to reference it to clear it.

  function _initSearch() {

    // Show on click or focus of search-toggle
    $('.search-toggle').on('click focus', function(e) {
      e.preventDefault();
      _openSearch();
    });

    // Show on focus of field itself
    $('.site-header .search-field').focus(function(e){
      _openSearch();
    });

    // Hide header search form when clicking away
    $('body').on('click', function(e) {
      if ($('.site-header .search-form').is('.-active') && !$(e.target).closest('.search-toggle').length && !$(e.target).closest('.site-header .search-field').length) {
        _hideSearch(); 
      }
    });

    // Hide on blur
    $('.site-header .search-field').on('blur', function(e) {
      _hideSearch();
    });

    // Hide with close button
    $('.search-form .close-button').on('click', function() {
      _hideSearch();
    });
  }

  function _openSearch() {
    if(!$('.site-header .search-form').hasClass('-active')) {
      $('.site-header .search-form').addClass('-active');
      clearTimeout( _searchFocusTimeout );
      _searchFocusTimeout = setTimeout( function() {
        $('.site-header .search-field').focus();
      },500);
    }
  }

  function _hideSearch() {
    $('.search-form').removeClass('-active');
    clearTimeout( _searchFocusTimeout );
    if( $('.search-form .search-field').is(':focus') ){ // Must test for this or we will recursively blur (_hideSearch is called on blur)
      $('.search-form .search-field').blur();
    }
  }

  // Handles main nav
  function _initNav() {
    // SEO-useless nav toggler
    $('.nav-toggle').on('click', function(e) {
      $('body, .site-header, .nav-toggle').toggleClass('nav-open');
      $('.site-nav').toggleClass('-active');
    });
  }

  function _initPeopleModals() {
    $('.person-activate').on('click', function(e) {
      var $activeContainer = $('.active-person-container'),
          $activeDataContainer = $activeContainer.find('.person-data-container'),
          $thisPerson = $(this).closest('.person'),
          $personData = $thisPerson.find('.person-data'),
          thisPersonOffset = -(($('.people-section').offset().top) - ($thisPerson.offset().top));

      _showOverlay();

      $('.person.-active, .people-grid.-active').removeClass('-active');
      $activeDataContainer.empty();
      $thisPerson.addClass('-active');
      $thisPerson.closest('.people-grid').addClass('-active');
      $personData.clone().appendTo($activeDataContainer);
      $activeContainer.css('top', thisPersonOffset);
      $activeContainer.addClass('-active');
      _scrollBody($activeContainer, 250, 0);
    }); 

    // Shut it down!
    $('html, body').on('click', '.person-deactivate', function(e) {
      _closePerson();
      _hideOverlay();
    });
    // Close if user clicks outside modal
    $('html, body').on('click', '.global-overlay', function() {
      if($('.active-person-container').is('.-active')) {
        _closePerson();
      }
    });

    // People Grid navigation
    $('.next-person').on('click', function(e) {
      $('.active-person-container .person-data').addClass('exitLeft');
      setTimeout(function() {
        _nextPerson();
      }, 200);
    });
    $('.previous-person').on('click', function(e) {
      $('.active-person-container .person-data').addClass('exitRight');
      setTimeout(function() {
        _prevPerson();
      }, 200);
    });

  }

  function _nextPerson() {
    var $active = $('.people-grid.-active').find('.person.-active');
    // find next or first person
    var $next = ($active.next('.person').length > 0) ? $active.next('.person') : $('.people-grid.-active .person:first');
    $next.find('.person-activate').trigger('click');
    $('.active-person-container .person-data').addClass('enterRight');
  }

  function _prevPerson() {
    var $active = $('.people-grid.-active').find('.person.-active');
    // find prev or last person
    var $prev = ($active.prev('.person').length > 0) ? $active.prev('.person') : $('.people-grid.-active .person:last');
    $prev.find('.person-activate').trigger('click');
    $('.active-person-container .person-data').addClass('enterLeft');
  }

  function _showOverlay() {
    $('.global-overlay').addClass('-active');
  }

  function _hideOverlay() {
    $('.global-overlay').removeClass('-active');
  }

  function _closePerson() {
    var $activeContainer = $('.active-person-container'),
        $activeDataContainer = $('.person-data-container');

    _hideOverlay();
    $activeContainer.removeClass('-active');
    $('.person.-active').removeClass('-active');
    $('.person-grid.-active').removeClass('-active');
    $activeDataContainer.empty();
  }

  // Track ajax pages in Analytics
  function _trackPage() {
    if (typeof ga !== 'undefined') { ga('send', 'pageview', document.location.href); }
  }

  // Track events in Analytics
  function _trackEvent(category, action) {
    if (typeof ga !== 'undefined') { ga('send', 'event', category, action); }
  }

  // Called in quick succession as window is resized
  function _resize() {
    screenWidth = document.documentElement.clientWidth;
    breakpoint_small = (screenWidth > breakpoint_array[0]);
    breakpoint_medium = (screenWidth > breakpoint_array[1]);
    breakpoint_large = (screenWidth > breakpoint_array[2]);
  }

  // Called on scroll
  // function _scroll(dir) {
  //   var wintop = $(window).scrollTop();
  // }

  // Public functions
  return {
    init: _init,
    resize: _resize,
    scrollBody: function(section, duration, delay) {
      _scrollBody(section, duration, delay);
    }
  };

})(jQuery);

// Fire up the mothership
jQuery(document).ready(PlantChicago.init);

// Zig-zag the mothership
jQuery(window).resize(PlantChicago.resize);
