<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package harats
 */
	$currentCat = get_category_by_slug($post->post_name);
	$tempCurrentCats = get_categories(array(
		'parent' => $currentCat->term_id,
		'hide_empty' => 0
	));

	$tempArray = json_decode(json_encode($tempCurrentCats), true);

	$currentCats = [];

	foreach($tempArray as $value) {
		if (strpos($value['slug'], '-') !== false) {
			$arraySlug = explode('-', $value['slug']);
			$currentCats[$arraySlug[0]] = $value;
		} else {
			$currentCats[$value['slug']] = $value;
		}

	}
?>
<!-- Content-->
<!-- About Us section-->
<section style="background-image: url('<?php bloginfo('template_url'); ?>/public/img/about-us-bg.png')" class="about-us section" id="to-top">
	<div class="uk-container uk-container-center">
		<h2 class="section-title"><a href="/<?=$currentCat->slug; ?>">О НАС</a></h2>
		<div class="uk-grid uk-grid-width-small-1-1">
			<article class="uk-clearfix">
				<img src="<?=get_the_post_thumbnail_url(); ?>" alt="">
				<p><?php the_content(); ?></p>
			</article>
		</div>
	</div>
</section>
<!-- About Us section end-->
<!-- Today Harats section-->
<?php
$todayHarats = get_posts(array(
	'posts_per_page'   => 6,
	'category'         => $currentCats['haratsnews']['term_id']
));
?>
<?php if(!empty($todayHarats)) : ?>
<section style="background-image: url('<?php bloginfo('template_url'); ?>/public/img/today-harats-bg.png')" class="today-harats section" id="to-today-harats">
	<div class="uk-container uk-container-center">
		<h2 class="section-title"><a href="<?=get_term_link($currentCats['haratsnews']['term_id']); ?>">сегодня в harat’s</a></h2>
		<div data-uk-slideset="{small: 1, medium: 2, large: 3}">
			<div class="uk-slidenav-position">
				<ul class="uk-grid uk-slideset">
					<?php foreach($todayHarats as $todayHarat) : ?>
						<li>
							<article><img src="<?=get_the_post_thumbnail_url($todayHarat->ID);?>" alt="">
								<h4><?=$todayHarat->post_title; ?></h4>
								<p><?=$todayHarat->post_excerpt; ?></p>
								<a href="<?=get_permalink($todayHarat->ID);?>">Смотреть</a>
							</article>
						</li>
					<?php endforeach; ?>
				</ul>
				<ul class="uk-slideset-nav uk-dotnav uk-flex-center"></ul>
			</div>
		</div>
	</div>
</section>

<?php endif; ?>
<!-- Today Harats section end-->
<!-- Beer section-->
<?php

	$beerCat = get_category_by_slug('bar-card-home-' . $currentCat->slug);

	$beers = get_posts(array(
		'posts_per_page'   => 10,
		'category'         => $beerCat->term_id
	));
?>
<?php if(!empty($beers)):?>
	<section style="background-image: url('<?php bloginfo('template_url'); ?>/public/img/beer-bg.png')" class="beer-section section" id="to-beer">
		<div class="uk-container uk-container-center">
			<h2 class="section-title"><a href="<?=get_term_link($currentCats['menu']['term_id']);?>"><?=$beerCat->description;?></a></h2>
			<div data-uk-slider="{infinite: false}" class="uk-slidenav-position">
				<div class="uk-slider-container">
					<ul class="uk-slider uk-grid-width-small-1-1 uk-grid-width-medium-1-3 uk-grid-width-large-1-4">
						<?php foreach($beers as $beer) : ?>
							<li>
								<article>
									<h4><?=$beer->post_title; ?></h4>
									<p><?=$beer->post_excerpt; ?></p>
									<img src="<?=get_the_post_thumbnail_url($beer->ID);?>" alt="">
								</article>
							</li>
						<?php endforeach; ?>
					</ul>
					<a href="" data-uk-slider-item="previous" class="uk-slidenav uk-slidenav-previous"></a>
					<a href="" data-uk-slider-item="next" class="uk-slidenav uk-slidenav-next"></a>
				</div>
			</div>
		</div>
	</section>
<?php endif; ?>
<!-- Beer section end-->
<!-- Menu section-->
<section style="background-image: url('<?php bloginfo('template_url'); ?>/public/img/menu-bg.png')" class="menu-section section" id="to-menu">
	<div class="uk-container uk-container-center">
		<h2 class="section-title">
			<a href="<?=get_term_link($currentCats['menu']['term_id']);?>">
				Меню <br>
				<small style="font-size: 12px;">посмотреть все меню</small>
			</a></h2>
		<?php
			$menuCats = get_categories(array(
				'parent' => $currentCats['menu']['term_id'],
				'number' => 5
			));
		$menuItemsCat=array();
		$menuItemsCats=wp_get_nav_menu_items($currentCat->slug.'-menu');
		echo '<br>';
		foreach ($menuItemsCats as $val ){
			$menuItemsCat[]=get_term($val->object_id);
		}
		?>
		<div data-uk-grid class="uk-grid-width-small-1-1 uk-grid width-medium-1-2 uk-grid-width-large-1-3">
			<?php foreach($menuItemsCat as $menuCat) :?>
				<?php
					$menuItems = get_posts(array(
						'posts_per_page'   => 4,
						'category' => $menuCat->term_id
					));
				?>
				<div>
					<ul class="uk-list">
						<li class="list-title"><?=$menuCat->name; ?></li>
						<?php foreach($menuItems as $menuItem): ?>
							<li>
								<div class="has-flex">
									<span class="title"><?=$menuItem->post_title; ?></span>
									<span class="has-dots"><i></i></span>
									<span class="price"><?=get_field('price', $menuItem->ID); ?> <i style="text-transform: lowercase; font-style: normal;">тг</i></span>
								</div>
								<div>
									<i style="text-transform: lowercase; font-size: 12px;"><?=$menuItem->post_excerpt; ?></i>
								</div>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>
<!-- Menu section end-->
<!-- Photo Gallery-->
<section style="background-image: url('<?php bloginfo('template_url'); ?>/public/img/about-us-bg.png')" class="photo-gallery section" id="to-gallery">
	<div class="uk-container uk-container-center">
		<h2 class="section-title"><a href="<?=get_term_link($currentCats['gallery']['term_id']);?>">Фотоотчет</a></h2>
		<div data-uk-slideset="{infinite: false, small: 1, medium: 2, large: 3, animation: 'scale', duration: 200}" class="uk-slidenav-position">
			<ul class="uk-grid uk-slideset">
				<?php
					$galleries = get_posts(array(
						'posts_per_page'   => 6,
						'category'         => $currentCats['gallery']['term_id']
					));
				?>
				<?php foreach($galleries as $gallery) : ?>
					<li>
						<article>
							<div>
								<h5><?=$gallery->post_title; ?></h5>
								<p><?=$gallery->post_excerpt; ?></p>
							</div>
							<img src="<?=get_the_post_thumbnail_url($gallery->ID); ?>" alt="">
						</article>
						<a href="<?=get_permalink($gallery->ID);?>">Смотреть</a>
					</li>
				<?php endforeach; ?>
			</ul>
			<ul class="uk-slideset-nav uk-dotnav uk-flex-center"></ul>
		</div>
	</div>
</section>
<!-- Photo Gallery end-->
<!-- Map-->
<?=get_field('map', 'category_' . $currentCat->term_id); ?>
<!-- Map end-->