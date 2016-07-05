
    <!-- Scripts -->
    <script src="<?php bloginfo('template_url')?>/public/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php bloginfo('template_url')?>/public/bower_components/uikit/js/uikit.min.js"></script>
    <script src="<?php bloginfo('template_url')?>/public/bower_components/uikit/js/components/slider.min.js"></script>
    <script src="<?php bloginfo('template_url')?>/public/bower_components/uikit/js/components/slideset.min.js"></script>
    <script src="<?php bloginfo('template_url')?>/public/js/homepage.js"></script>

    <script>
        $(document).ready(function() {
            ;(function(){
                var langBtn = $("#weglot_switcher .wgcurrent a"),
                    langsUl = $('#weglot_switcher ul');

                langBtn.click(function() {
                    langsUl.slideToggle();
                });
            })();
        });
    </script>
    <?php wp_footer() ?>
</body>
</html>