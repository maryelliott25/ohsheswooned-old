(function (window, document, $, undefined) {

  var setPostsHeight = function() {
    setTimeout(function() {
      var heights = {
        sidebar: $('#secondary').outerHeight() - 50,
        posts: $('.post-wrap').outerHeight()
      };

      if(heights.sidebar > heights.posts) {
        $('.post-wrap').css('min-height', heights.sidebar);
      }
    }, 500);
  };

  if (windowWidth > 970) {
    setPostsHeight();
  }

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
      $nav = $('.nav-icon'),
      $ingredients = $('.ingredients-icon'),
      $icon = $('.menu-icon');

  var windowWidth = $window.width(),
      prevWidth = windowWidth;

  var handleClick = function(icon, iconName, otherIcon) {
    icon.click(function() {
      if ($html.hasClass(iconName + '-open')) {
        $html.removeClass('open').addClass('closed');
        setTimeout(function() {
          $html.removeClass(iconName + '-open').addClass(iconName + '-closed');
        }, 300);
      } else if ($html.hasClass(otherIcon + '-open')) {
        $html.removeClass(otherIcon + '-open').addClass(otherIcon + '-closed').removeClass(iconName + '-closed').addClass(iconName + '-open');
      } else {
        $html.removeClass(iconName + '-closed').addClass(iconName + '-open').addClass('open').removeClass('closed');
      }
    });
  };

  handleClick($nav, 'nav', 'ingredients');
  handleClick($ingredients, 'ingredients', 'nav');

  var handleNav = function(iconName, breakpoint) {
    if (((windowWidth < breakpoint) && (prevWidth >= breakpoint)) || ((prevWidth < breakpoint) && (windowWidth >= breakpoint))) {
      $html.removeClass(iconName + '-open');
      $html.addClass(iconName + '-closed');
    }
  };

  var resizeFunc = function() {
    prevWidth = windowWidth;
    windowWidth = $window.width();
    handleNav('nav', 651);
    handleNav('ingredients', 1010);
  };

  window.addEventListener('orientationchange', function() {
    resizeFunc();
    console.log(windowWidth);
    if (windowWidth > 970) {
      setPostsHeight();
    } else {
      $('.post-wrap').css('min-height', 'auto');
    }
  });

  window.addEventListener('resize', function() {
    resizeFunc();
    console.log(windowWidth);
    if (windowWidth > 970) {
      setPostsHeight();
    } else {
      $('.post-wrap').css('min-height', 'auto');
    }
  });

})(window, document, jQuery);
