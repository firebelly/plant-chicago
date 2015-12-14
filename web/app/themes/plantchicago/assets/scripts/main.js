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
    // _initLoadMore();
    _injectSvgSprite();
    _initPeopleModals();

    // Esc handlers
    $(document).keyup(function(e) {
      if (e.keyCode === 27) {
        _hideSearch();
        _hideMobileNav();
        _closePerson();
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

  function _initSearch() {
    $('.search-toggle').on('click', function() {
      if ($('.search-form').hasClass('-active')) {
        $('.search-form').removeClass('-active');
      } else {
        $('.search-form').addClass('-active');
        $('.search-field:first').focus();
      }
    });

    $('.search-form .close-button').on('click', function() {
      _hideSearch();
    });
  }

  function _hideSearch() {
    $('.search-form').removeClass('-active');
    $('.search-field').blur();
  }

  // Handles main nav
  function _initNav() {
    // SEO-useless nav toggler
    $('.nav-toggle').on('click', function(e) {
      $('body, .site-header, .nav-toggle').toggleClass('nav-open');
      $('.site-nav').toggleClass('-active');
    });
  }

  function _showMobileNav() {
    $('.nav-toggle').addClass('nav-open');
    $('.site-nav').addClass('-active');
  }

  function _hideMobileNav() {
    $('.nav-toggle').removeClass('nav-open');
    $('.site-nav').removeClass('-active');
  }

  function _initLoadMore() {
    $document.on('click', '.load-more a', function(e) {
      e.preventDefault();
      var $load_more = $(this).closest('.load-more');
      var post_type = $load_more.attr('data-post-type') ? $load_more.attr('data-post-type') : 'news';
      var page = parseInt($load_more.attr('data-page-at'));
      var per_page = parseInt($load_more.attr('data-per-page'));
      var category = $load_more.attr('data-category');
      var more_container = $load_more.parents('section,main').find('.load-more-container');
      loadingTimer = setTimeout(function() { more_container.addClass('loading'); }, 500);

      $.ajax({
          url: wp_ajax_url,
          method: 'post',
          data: {
              action: 'load_more_posts',
              post_type: post_type,
              page: page+1,
              per_page: per_page,
              category: category
          },
          success: function(data) {
            var $data = $(data);
            if (loadingTimer) { clearTimeout(loadingTimer); }
            more_container.append($data).removeClass('loading');
            if (breakpoint_medium) {
              more_container.masonry('appended', $data, true);
            }
            $load_more.attr('data-page-at', page+1);

            // Hide load more if last page
            if ($load_more.attr('data-total-pages') <= page + 1) {
                $load_more.addClass('hide');
            }
          }
      });
    });
  }

  function _initPeopleModals() {
    $('.person-toggle').on('click', function(e) {
      var $activeContainer = $('.active-person-container'),
          $activeDataContainer = $activeContainer.find('.person-data-container');

      if ($(this).is('.person-activate')) {
        _showOverlay();
        var $thisPerson = $(this).closest('.person'),
            $personData = $thisPerson.find('.person-data')
            thisPersonOffset = -(($('.people-section').offset().top) - ($thisPerson.offset().top));

        $activeDataContainer.empty();
        $thisPerson.addClass('-active');
        $personData.clone().appendTo($activeDataContainer);
        $activeContainer.css('top', thisPersonOffset);
        $activeContainer.addClass('-active');
        _scrollBody($activeContainer, 500, 0);


      } else {

        _closePerson();
        _hideOverlay();

      }
 
    });

    // Close if user clicks outside modal
    $('html, body').on('click', '.global-overlay', function() {
      if($('.active-person-container').is('.-active')) {
        _closePerson();
      }
    });

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
