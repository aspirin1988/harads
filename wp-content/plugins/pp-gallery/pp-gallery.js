window.onload = function () {

    (function($) {
        $('.remove-pp-img').click(function (event) {
            var removeId = $(this).data('pp-id');
            $.post('/wp-content/plugins/pp-gallery/', {removeId: removeId}, function (response) {
                console.log('[data-row="'+removeId+'"]');
                if (response==1) {
                    UIkit.notify("<div class='notify-suc'><i class='uk-icon-check'></i> Данные успешно удалены! </div>");
                    $('[data-row="'+removeId+'"]').hide(200);
                }
                else
                {
                    UIkit.notify("<div class='notify-err'><i class='uk-icon-remove'></i> Данные не были удалены! <br> Или изменены! </div>");

                }
            });
        });

        $('.edit-pp-img').click(function (event) {
            var editId = $(this).data('pp-id');
            var data={};
            data['name']=$('#name'+editId).val();
            data['alt']=$('#alt'+editId).val();
            data['description']=$('#description'+editId).val();
            console.log(data);
            $.post('/wp-content/plugins/pp-gallery/', {editId: editId,pp:data}, function (response) {
                console.log(response);
                if (response==1) {
                    UIkit.notify("<div class='notify-suc'><i class='uk-icon-check'></i> Данные успешно сохранены! </div>");
                }
                else 
                {
                    UIkit.notify("<div class='notify-err'><i class='uk-icon-remove'></i> Данные не были сохранены! <br> Или изменены! </div>");

                }
            });
        });

        $(function(){

            var progressbar = $("#progressbar"),
                bar         = progressbar.find('.uk-progress-bar'),
                postID      = $('#postID').val(),
                settings    = {

                    action: '/wp-content/plugins/pp-gallery/?postID=' + postID, // upload url

                    allow : '*.(jpg|jpeg|gif|png)', // allow only images

                    loadstart: function() {
                        bar.css("width", "0%").text("0%");
                        progressbar.removeClass("uk-hidden");
                    },

                    progress: function(percent) {
                        percent = Math.ceil(percent);
                        bar.css("width", percent+"%").text(percent+"%");
                    },

                    allcomplete: function(response) {

                        bar.css("width", "100%").text("100%");

                        setTimeout(function(){
                            progressbar.addClass("uk-hidden");
                        }, 250);

                        location.reload();
                    }
                };

            var select = UIkit.uploadSelect($("#upload-select"), settings),
                drop   = UIkit.uploadDrop($("#upload-drop"), settings);
        });
    })(jQuery);
};