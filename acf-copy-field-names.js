(function() {

    // get names
    function acfn_get_field_names() {
        let names = '';
        let name_fields = document.querySelectorAll('.acf-tbody > .li-field-name');
        name_fields.forEach( function ( name_field ) {
            names += name_field.textContent.trim() + '\r\n';
        });
        return names;
    }

    // create button
    const acfn_btn = document.createElement('a');
    acfn_btn.href = "javascript:;";
    acfn_btn.classList.add('acf-btn', 'acf-btn-secondary', 'js-copy-field-names');
    acfn_btn.textContent = "Copy Field Names";
    document.getElementById('submitpost')?.prepend( acfn_btn );

    // on click copy to clipboard
    new ClipboardJS( acfn_btn, {
        text: function ( trigger ) {
            return acfn_get_field_names();
        }
    });

})();