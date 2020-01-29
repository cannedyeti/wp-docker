// Custom scripts for scroll to top button
jQuery( document ).ready(function( $ ) {
    // Scroll to top button 
    $("#scroll-to-top").click(function(event) {
        event.preventDefault();
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });
});