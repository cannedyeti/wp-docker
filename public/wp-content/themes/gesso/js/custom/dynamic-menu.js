jQuery( document ).ready(function( $ ) {

  'use strict';

   var $dynamicMenu = $('<div class="dynamic-menu__menu"></div>'),
       $menuConstrain = $('<div class="l-constrain"></div>'),
       $menuBuilder = $('.dynamic-menu__builder'),
       $menuLink = $('.section-header__slug.is-active');

      // Insert Menu at top of Page Builder
      $dynamicMenu.insertBefore($menuBuilder);

      //Count each Menu Link and create a unique ID
      $menuLink.attr("id", function(index){
        return "menu-item-" + index;
      })

      // Build menu links and append to the dynamic menu
      $menuLink.each(function(){
        var el = $(this),
            link = $('<a>');

        $(link).attr({
          class: 'dynamic-menu__link',
          href: "#" + el.attr('id'),
        }).html(el.html()).appendTo($dynamicMenu);
      })

      //Smooth Scroll on Page builder
        $('a[href*="#"]').on('click', function(e) {
          e.preventDefault()

          $('html, body').animate(
            {
              scrollTop: $($(this).attr('href')).offset().top,
            },
            500,
            'linear'
          )
      })

      // Make Menu Sticky
      jQuery( document ).ready(function( $ ) {
          $('.dynamic-menu').sticky({topSpacing:0});
      });

});
