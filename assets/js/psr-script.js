; (function ($) {
    $(document).ready(function () {

        function showProject(e) {
            var projectname = e.attr('psr-data');
            var selectorsearch = '.' + projectname;
            if (projectname != 'all') {
                $('.showroom-project').not(selectorsearch).fadeOut(1000);
                $('.showroom-projetcs').find(selectorsearch).fadeIn(1000, 'linear');
            } else {
                $('.showroom-project').fadeIn(1000, 'linear');
            }
        }

        $('.psr-nav').click(function (e) {
            if (!$(this).hasClass('active')) {
                $(this).closest('.showroom-projects').find('.active').removeClass('active');
                $(this).addClass('active');
                showProject($(this));
            }
        });
    });
})(jQuery);