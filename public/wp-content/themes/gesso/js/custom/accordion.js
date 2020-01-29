// Custom accordion file

jQuery( document ).ready(function( $ ) {

// faq toggle
$('.accordion__entry').each(function() {
    $(this).find('.accordion__answer').slideUp();
    $(this).on('click', function() {
      $(this).toggleClass('active')
      $(this).find('.accordion__answer').slideToggle();
    })
  })

  $('.accordion__show-all').on('click', function() {
    $('.accordion__entry').each(function() {
      $(this).removeClass('hidden');
    });
    $(this).addClass('hidden');
  });

});
