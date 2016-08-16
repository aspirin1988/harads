<?php

/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package harats
 */
	$mainUrls = explode('/', $_SERVER['REQUEST_URI']);



if($post) {
	if($post->post_type != 'post') {
		$currentCat = get_category_by_slug($post->post_name);
	} else {
		$hasString = strpos($_SERVER['REQUEST_URI'], 'en');
		if ($hasString == 1) {
			$currentCat = get_category_by_slug($mainUrls[3]);
		} else {
			$currentCat = get_category_by_slug($mainUrls[2]);
		}

	}
}
$currentCatID = $currentCat->term_id;

?>
	<!-- Main footer-->
	<footer class="main-footer" id="<?=$to_contacts_id = ($post->post_type == 'page') ? 'to-contacts' : ''; ?>">
		<div class="uk-container uk-container-center">
			<div class="uk-grid">
				<!-- Contacts info-->
				<div class="uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-3">
					<ul class="footer-list uk-list">
						<li class="list-title">Наши контакты</li>
						<li class="uk-clearfix"><i class="uk-icon-map-marker"></i><span><?=get_field('address', 'category_' . $currentCatID); ?></span></li>
						<li class="uk-clearfix"><i class="uk-icon-mobile-phone"></i><span>Телефон:<a href=""><?=get_field('phone', 'category_' . $currentCatID); ?></a></span></li>
						<li class="uk-clearfix"><i class="uk-icon-envelope"></i><span>E-mail:<a href=""><?=get_field('email', 'category_' . $currentCatID); ?></a></span></li>
					</ul>
				</div>
				<!-- Contacts info end-->
				<!-- Work info-->
				<div class="uk-width-small-1-2 uk-width-medium-1-3 uk-width-large-1-3">
					<ul class="footer-list uk-list">
						<li class="list-title">Режим работы</li>
						<?=get_field('work-time', 'category_' . $currentCatID); ?>
					</ul>
				</div>
				<!-- Work info end-->
				<div class="search-socials uk-width-small-1-1 uk-width-medium-1-3 uk-width-large-1-3 uk-text-right">
					<hr class="uk-visible-small">
					<a href="/<?=$currentCat->slug; ?>"><img src="<?php bloginfo('template_url'); ?>/public/img/logo.png" alt="" class="footer-logo"></a>
					<ul class="footer-list uk-list">
						<li>
							<form action="<?=get_term_link($currentCatID); ?>" role="search" method="get">
								<input type="text" name="s">
								<button type="submit" class="uk-text-center"><i class="uk-icon-search"></i></button>
							</form>
						</li>
						<li class="socials">
							<a href="<?=get_field('instagram', 'category_' . $currentCatID); ?>"><i class="uk-icon-instagram circle"></i></a>
							<a href="<?=get_field('facebook', 'category_' . $currentCatID); ?>"><i class="uk-icon-facebook circle"></i></a>
							<a href="<?=get_field('twitter', 'category_' . $currentCatID); ?>"><i class="uk-icon-twitter circle"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!-- Scripts-->
	<script src="<?php bloginfo('template_url'); ?>/public/bower_components/jquery/dist/jquery.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/js/uikit.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/js/components/slideset.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/js/components/slider.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/js/components/grid.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/js/components/sticky.min.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/js/components/lightbox.min.js"></script>
	<!--<script src="js/app.js"></script>-->

	<?php if($post->post_type != 'page') : ?>
		<script>
			$(document).ready(function() {
				(function() {
					$('.move-to-nav').click(function(e) {
						var urlItems = $(this).attr('href');
							urlItem = urlItems.split('#');
						window.location.href = '/<?=$currentCat->slug; ?>/#' + urlItem[1];
					});
				})();
			});
		</script>
	<?php else: ?>
		<script>
			$(document).ready(function() {
				setTimeout(function () {
					(function() {
						var hash = window.location.hash;

						$('.move-to-nav').each(function(e) {
							if($(this).attr('href') === hash) {
								$(this).click();
							}
						});
					})();
				}, 1)
			});
		</script>
	<?php endif; ?>

<script>
	$(document).ready(function() {
		(function(){
			setTimeout(function () {
				var hash = location.hash;
				if (hash) {
					console.log(hash);
					$(hash).trigger("click");
					return false;
				}
			},200);
			return false;
		})();


		(function(){
			var langBtn = $("#weglot_switcher .wgcurrent a"),
				langsUl = $('#weglot_switcher ul');

			langBtn.click(function() {
				langsUl.slideToggle();
			});
		})();
	});
</script>
<?php wp_footer(); ?>
</body>
</html>