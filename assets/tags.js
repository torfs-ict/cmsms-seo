(function($) {
    $(document).ready(function() {
        var field = $('#tags').data('name');
        $('#tags').tagit({
            allowSpaces: true,
            removeConfirmation: true,
            placeholderText: 'Typ hier...',
            fieldName: field
        });
    });
})(jQuery);