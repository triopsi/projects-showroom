; (function ($) {
    $(document).ready(function () {

        $('#publish').click(function () {
            if (!$('#title').val()) {
                alert(psrobjjs.no_title);
                $('#title').focus();
            }
            if ($("#set-post-thumbnail").find('img').size() > 0) {
                return true;
            } else {
                alert(psrobjjs.no_image);
                $('#set-post-thumbnail').focus();
                return false;
            }
        });
    });
})(jQuery);