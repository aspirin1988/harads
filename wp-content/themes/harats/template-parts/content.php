<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package harats
 */

?>
<div class="uk-container uk-container-center">

	<div class="section">
		<div class="uk-grid">
			<div class="uk-width-small-1-1">
				<?php
				$parentCat = get_the_category();

				$currentCat = get_category($parentCat[0]->category_parent);
				?>
				<?php pp_get_breadcrumb('uk-breadcrumb', '/' . $currentCat->slug); ?>
			</div>
			<div class="uk-width-small-1-1">
				<h1 class="page-title"><?php the_title(); ?></h1>
			</div>
			<div class="uk-width-small-1-1">
				<img src="<?=get_the_post_thumbnail_url();?>" alt="" style="float: left; margin: 0 10px 10px 0;">
				<div style="margin: 0; padding: 0;">
					<?php the_content(); ?>
				</div>
			</div>

		</div>
	</div>

</div>