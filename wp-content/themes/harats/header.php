<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package harats
 */

?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php  wp_head()?>
	<!-- Stylesheets-->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/css/uikit.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/css/components/slider.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/css/components/dotnav.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/css/components/slidenav.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/public/bower_components/uikit/css/components/sticky.min.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/public/css/app.css">

</head>
<body>
<?php
$mainUrls = explode('/', $_SERVER['REQUEST_URI']);
$countOfUrl = count($mainUrls);

if(!strpos($_SERVER['REQUEST_URI'], 'en')) {
	if($countOfUrl == 3) {
		$mainBg = true;
	} else {
		$mainBg = false;
	}
} else {

	if($countOfUrl == 4) {
		$mainBg = true;
	} else {
		$mainBg = false;
	}
}

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

$tempCurrentCats = get_categories(array(
	'parent' => $currentCat->term_id,
	'hide_empty' => 0
));

$tempArray = json_decode(json_encode($tempCurrentCats), true);

$currentCats = [];

foreach($tempArray as $value) {
	$currentCats[$value['slug']] = $value;
}
?>

<?php if($mainBg):?>
	<section class="section welcome" style="background-image: url('<?php bloginfo('template_url'); ?>/public/img/welcome-bg.png');">
		<div  class="uk-flex uk-flex-center uk-flex-middle">
			<img src="<?php bloginfo('template_url'); ?>/public/img/welcome-logo.png" alt="">
		</div>
	</section>
<?php endif; ?>
<!-- Main Navigation-->
<style>
	.uk-sticky-placeholder{
	float: none !important;
	}
</style>
<nav <?=$sticky_nav = ($post->post_type == 'page') ? 'data-uk-sticky' : ''; ?> class="main-navigation uk-navbar">
	<div class="uk-container uk-container-center">
		<a href="/<?=$currentCat->slug; ?>" class="uk-visible-large uk-navbar-brand"><img src="<?php bloginfo('template_url'); ?>/public/img/logo.png" alt=""></a>
		<a style="float: right;top: -12px;position: relative;margin-left: 5px;" class="" href="/"><img src="<?php bloginfo('template_directory') ?>/public/img/harats_2.png" alt=""></a>

		<ul class="uk-navbar-nav uk-visible-large" data-uk-scrollspy-nav="{closest: 'li', smoothscroll: {offset: 100}}">
			<li><a class="move-to-nav" href="#to-top"><?=get_field('about')?></a></li>
			<li><a class="move-to-nav" href="#to-today-harats"><?=get_field('harats_to_day')?></a></li>
			<li><a class="move-to-nav" href="#to-beer"><?=get_field('beer')?></a></li>
			<li><a class="move-to-nav" href="#to-menu"><?=get_field('menu')?></a></li>
			<li><a class="move-to-nav" href="#to-gallery"><?=get_field('gallery')?></a></li>
			<li><a class="move-to-nav" href="#to-contacts"><?=get_field('contacts')?></a></li>
		</ul>
		<a id="menu-nav" href="#mobile-nav" data-uk-offcanvas="" class="uk-navbar-toggle uk-hidden-large"></a>
		<a href="/<?=$currentCat->slug; ?>" class="has-logo uk-navbar-brand uk-navbar-center uk-hidden-large uk-text-center"><img src="<?php bloginfo('template_url'); ?>/public/img/logo.png" alt=""></a>
	</div>
</nav>
<!-- Main Navigation end-->

<!-- Mobile Navigation-->
<div id="mobile-nav" class="uk-offcanvas">
	<div class="uk-offcanvas-bar">
		<div class="uk-list">
			<li><a href="/<?=$currentCat->slug; ?>">Главная</a></li>
			<?php foreach($currentCats as $cat) : ?>
				<?php
					if($cat['slug'] == 'beer') {
						$beerCat = get_category_by_slug('menu');
						$catID = $beerCat->term_id;
					} else {
						$catID = $cat['term_id'];
					}
				$echo=true;
				if (stristr($cat['name'],'Барная карта')&&(strlen($cat['name'])>strlen('Барная карта'))) {
					$echo=false;
				}
				?>
				<li><a href="<?=get_term_link($catID);?>"><?php if ($echo) echo ($cat['name']); ?></a></li>
			<?php endforeach;?>
		</div>
	</div>
</div>
<!-- Mobile Navigation end-->