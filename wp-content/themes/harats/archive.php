<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package harats
 */

get_header();
$currentObj = get_queried_object();
$currentObjPosts = get_posts(array(
	'category' => $currentObj->term_id
));
?>

	<div class="uk-container uk-container-center">
		<div class="section">
			<div class="uk-grid">
				<div class="uk-width-small-1-1">
					<?php
					$currentCat = get_category($currentObj->category_parent);
					?>
					<?php pp_get_breadcrumb('uk-breadcrumb', '/' . $currentCat->slug); ?>
				</div>
				<div class="uk-width-small-1-1">
					<h1 class="page-title"><?=$currentObj->name; ?>
						<hr></h1>
				</div>
			</div>
			<div class="page-content uk-grid uk-grid-width-small-1-1 uk-grid-width-medium-1-2" data-uk-grid-margin>
				<?php foreach($currentObjPosts as $post) : ?>
					<div>
						<article class="uk-article">
							<img src="<?=get_the_post_thumbnail_url($post->ID); ?>" alt="">
							<h2><?=$post->post_title; ?></h2>
							<p class="uk-article-lead"><?=$post->post_excerpt; ?></p>
							<a href="<?=get_permalink($post->ID); ?>" class="read-more">Подробнее...</a>
						</article>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>

<?php
get_footer();
