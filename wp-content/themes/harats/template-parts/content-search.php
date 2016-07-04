<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package harats
 */

?>

<div>
	<article class="uk-article">
		<img src="<?=get_the_post_thumbnail_url(); ?>" alt="">
		<h2><?php the_title(); ?></h2>
		<p class="uk-article-lead"><?php the_excerpt(); ?></p>
		<a href="<?=get_permalink(); ?>" class="read-more">Подробнее...</a>
	</article>
</div>