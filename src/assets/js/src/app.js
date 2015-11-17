(function (window, document, $, undefined) {

  setTimeout(function() {
    var heights = {
      sidebar: $('#secondary').outerHeight() - 50,
      posts: $('.post-wrap').outerHeight()
    };

    if(heights.sidebar > heights.posts) {
      $('.post-wrap').css('min-height', heights.sidebar);
    }
  }, 500);

  var $$ = {
    featuredSlider: $('#featured-slick'),
    ingredientsPanel: $('#oss-ingredients'),
    postPanel: $('.oss_recipe .post-content'),
    html: $('html'),
    adminBar: $('#wpadminbar')
  };

  if($$.featuredSlider.length > 0) {
    $$.featuredSlider.slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: false,
      centerMode: true,
      centerPadding: '30%',
      variableWidth: true,
      dots: true,
      responsive: [
        {
          breakpoint: 800,
          settings: {
            variableWidth: false,
            centerMode: false,
            centerPadding: 0
          }
        }
      ]
    });
  }

  $(function(){
    if($$.ingredientsPanel.length > 0) {
      $$.ingredientsPanel.sticky({
        topSpacing: ($$.adminBar.length > 0 ? 60 : 50),
        bottomSpacing: $$.html.outerHeight() - ($$.postPanel.offset().top + $$.postPanel.outerHeight() - 40)
      });
    }
  });

  var $window = $(window),
      $html = $('html'),
      $nav = $('#site-navigation');

  var windowWidth = $window.width(),
      prevWidth = windowWidth;

  $nav.click(function() {
    if ($html.hasClass('open')) {
      console.log('remove open');
      $html.removeClass('open').addClass('closed');
    } else {
      console.log('remove closed');
      $html.removeClass('closed').addClass('open');
    }
  });

  var handleNav = function() {
    if (windowWidth < 651 && prevWidth >= 651 || prevWidth < 651 && windowWidth >= 651) {
      $html.removeClass('open');
      $html.addClass('closed');
    }
  };

  window.addEventListener('orientationchange', function() {
    prevWidth = windowWidth;
    windowWidth = $window.width();
    handleNav();
  });

  window.addEventListener('resize', function() {
    prevWidth = windowWidth;
    windowWidth = $window.width();
    handleNav();
  });

})(window, document, jQuery);
