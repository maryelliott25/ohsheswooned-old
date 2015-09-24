(function (window, document, $, undefined) {

  $$ = {
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
      dots: true
    });
  }

  $(function(){
    if($$.ingredientsPanel.length > 0) {
      $$.ingredientsPanel.sticky({
        topSpacing: ($$.adminBar.length > 0 ? 60 : 30),
        bottomSpacing: $$.html.height() - ($$.postPanel.offset().top + $$.postPanel.height() - $$.ingredientsPanel.height())
      });
    }
  });

})(window, document, jQuery);
