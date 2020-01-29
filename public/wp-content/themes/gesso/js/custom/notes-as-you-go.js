// Custom scripts for notes as you go component
jQuery( document ).ready(function( $ ) {

    'use strict';


    // notes as you go scripts
    const notesBtn = $('#notes-as-you-go__open-btn');
    const notesInput = $('#notes-as-you-go__input');
    const notesInputContainer = $('.notes-as-you-go__input-container');
    const notesBtnOpen = $('.notes-as-you-go__button-text--open');
    const notesBtnClose = $('.notes-as-you-go__button-text--close');
    const commentFormNotes = $('.commentNotes');


    notesInputContainer.hide( );

    // When the user clicks on open/close, the text will change accordingly
    notesBtn.on('click', function() {
    // notesInputContainer.toggleClass('is-active');
    notesBtnClose.toggleClass('is-active');
    notesBtnOpen.toggleClass('is-active');
    notesInputContainer.slideToggle('slow' );
    })

    // If the note item in local storage exists, the input will fill with the value.
    if(localStorage.getItem('note')) {
    notesInput.val(localStorage.getItem('note'));
    }

    // if you're on the comment page..
    if (commentFormNotes.val() == "") {
    var form = commentFormNotes.find('textarea');
    form.html(localStorage.getItem('note'));
    }

    // When the user changes a note, the local storage will update.
    notesInput.on('change', function() {
    const newNote = notesInput.val();
    localStorage.setItem('note', newNote);
    })

});