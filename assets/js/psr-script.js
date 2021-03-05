; (function ($) {
    $(document).ready(function () {
        function showProject(e) {
            var projectname = e.attr('psr-data');
            var selectorsearch = '.' + projectname;
            if (projectname != 'all') {
                $('.showroom-projetcs').find(selectorsearch).fadeIn('slow');
                $('.showroom-project').not(selectorsearch).fadeOut('slow');
            } else {
                $('.showroom-project').fadeIn(800);
            }
        }

        $('.psr-nav').click(function (e) {
            if ($(this).hasClass('active')) {
            } else {
                $(this).closest('.showroom-projects').find('.active').removeClass('active');
                $(this).addClass('active');
                showProject($(this));
            }
        });
    });
})(jQuery);