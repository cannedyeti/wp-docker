// Custom scripts for input/gform integration

jQuery( document ).ready(function( $ ) {

    // FORM SCRIPTS
    const SITELABEL = 'rr';

    var locitems = localStorage;

    if(!localStorage.getItem(SITELABEL)) {
    localStorage.setItem(SITELABEL, '{}');
    }

    var siteObj = JSON.parse(localStorage.getItem(SITELABEL));

    $('.form-input-to-save').each(function() {
    var id = $(this).attr('data-id');
    // check to see if this already has a value
    if(siteObj[id]) {
        $(this).val(siteObj[id]);
    }
    $(this).on('change', function() {
        var newId = $(this).attr('data-id')
        var val = $(this).val();
        siteObj[newId] = val;
        localStorage.setItem(SITELABEL, JSON.stringify(siteObj));
    })
    })

    var formItems = locitems[SITELABEL];


    var gformExists = $('.gform_wrapper');

    // If gravity forms is on the page
    if(gformExists[0]) {
        var siteObj = JSON.parse(localStorage.getItem(SITELABEL));
        console.log('exists', siteObj)
        Object.keys(siteObj).forEach(function(key) {
            let value = siteObj[key];
            //use key and value here
            var gformInput = $('.' + key + ' .textarea');
            gformInput.val(value);
        });
    }

});