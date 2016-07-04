;(function($) {
    $(document).ready(function() {
        $('.fil0').click(function(e) {
            var that = $(this),
                obln = that.attr('id');

            $('.fil0').removeClass('active');
            that.addClass('active');

            console.log(obln);

            $('.for-check-obl').each(function() {
                if(obln === $(this).data('obl')) {
                    $(this).click();
                }

            });

        });

        setTimeout(function () {
            $('.for-check-obl').each(function() {
                if($(this).hasClass('uk-active')) {
                    $('#' + $(this).data('obl')).addClass('active');
                }

            });
        }, 1)
    });

    /*$.post('/requests', {country: 'get'}, function(data) {
        var object = JSON.parse(data);
        console.log(object);
    });*/
})(jQuery);