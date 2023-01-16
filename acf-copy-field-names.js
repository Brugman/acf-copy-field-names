(function($) {

    // get names
    function acfn_get_field_names() {
        var names = '';
        $('.acf-tbody > .li-field-name').each( function () {
            names += $( this ).text().trim() + '\r\n';
        });
        return names;
    }

    // create button
    $('#submitpost').prepend('<a href="#" class="acf-btn acf-btn-secondary js-copy-field-names">Copy Field Names</a>');

    // on click copy to clipboard
    new ClipboardJS( '.js-copy-field-names', {
        text: function ( trigger ) {
            return acfn_get_field_names();
        }
    });

})( jQuery );