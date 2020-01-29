// Custom scripts file

jQuery( document ).ready(function( $ ) {

  'use strict';

  // Function to retrieve URL params
  $.urlParam = function(name){
    var results = new RegExp('[\?&]' + name + '=([^&#]*)').exec(window.location.href);
    if (results==null){
      return null;
    }
    else{
      return decodeURI(results[1]) || 0;
    }
  }

  // Generic function that runs on window resize.
  function resizeStuff() {
  }

  // Runs function once on window resize.
  var TO = false;
  $(window).resize(function () {
    if (TO !== false) {
      clearTimeout(TO);
    }

    

    // 200 is time in miliseconds.
    TO = setTimeout(resizeStuff, 200);
  }).resize();

  // Detect if menu will go off screen
  $(".menu__item").on('mouseenter mouseleave', function (e) {
    if ($('ul', this).length) {
        var elm = $('ul:first', this);
        var off = elm.offset();
        var l = off.left;
        var w = elm.width();
        var docH = $(".container").height();
        var docW = $(".container").width();

        var isEntirelyVisible = (l + w <= docW);

        if (!isEntirelyVisible) {
            $(this).addClass('edge');
        } else {
            $(this).removeClass('edge');
        }
    }
  });

});
