jQuery(function ($) {
  $('.js-accordion-title').on('click', function () {
    /*クリックで開閉*/
    $('.accordion-content').slideToggle(200);
    /*矢印の向き*/
    $(this).toggleClass('open', 200);
  });

});
