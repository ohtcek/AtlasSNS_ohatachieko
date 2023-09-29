$(function () {
  $('.accordion').click(function () {
    $(this).toggleClass('active');
    if ($(this).hasClass('active')) {
      $('.accordion-menu').addClass('active');
    } else {
      $('.accordion-menu').removeClass('active');
    }
  });
});

$(function () {
  $('.menu').css("display", "none");
  $('.accordion').on('click', function () {
    $(this).next().slideToggle();
  })
});
