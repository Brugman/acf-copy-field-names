(function($) {

    function acfn_get_field_names() {
        var names = '';
        $('.acf-tbody > .li-field-name').each( function() {
            names += $( this ).text().trim() + '\r\n';
        });
        return names;
    }

    new ClipboardJS( '.js-acf-copy-field-names', {
        text: function(trigger) {
            return acfn_get_field_names();
        }
    });

})( jQuery );