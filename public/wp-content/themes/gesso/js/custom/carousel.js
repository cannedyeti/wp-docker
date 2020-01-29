// Carousel scripts


jQuery( document ).ready(function( $ ) {
  // siema carousel
    Siema.prototype.addArrows = function() {
      // make buttons & append them inside Siema's container
      this.prevArrow = this.selector.parentElement.querySelector('.carousel__arrow--prev');
      this.nextArrow = this.selector.parentElement.querySelector('.carousel__arrow--next'); 
      // event handlers on buttons
      this.prevArrow.addEventListener('click', () => this.prev());
      this.nextArrow.addEventListener('click', () => this.next());
    }
    const siemas = document.querySelectorAll('.carousel__carousel');
    for(var i = 0; i < siemas.length; i++) {
      var temp = siemas[i];
      var slidesToShow = parseInt(temp.dataset.slidesToShow) || 1;
      var thisSiema = new Siema({
        selector: temp,
        loop: true,
        perPage: 1
      })
      thisSiema.addArrows();
    };
    
    window.addEventListener("resize", thisSiema.addArrows());
    
    const heroSiemas = document.querySelectorAll('.hero__carousel');
    for(var i = 0; i < heroSiemas.length; i++) {
      var temp = heroSiemas[i];
      var slidesToShow = parseInt(temp.dataset.slidesToShow) || 1;
      var thisSiema = new Siema({
        selector: temp,
        loop: false,
        perPage: 1
      })
      thisSiema.addArrows();
    }

});
