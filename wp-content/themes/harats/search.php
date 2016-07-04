<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package harats
 */

get_header(); ?>

	<div class="uk-container uk-container-center">
		<section id="primary" class="section content-area">
			<main id="main" class="site-main" role="main">

				<?php
				if ( have_posts() ) : ?>

					<header class="page-header">
						<h1 class="page-title"><?php printf( esc_html__( 'Результаты поиска: %s', 'harats' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
					</header><!-- .page-header -->
					<div class="page-content uk-grid uk-grid-width-small-1-1 uk-grid-width-medium-1-2" data-uk-grid-margin>
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						/**
						 * Run the loop for the search to output the results.
						 * If you want to overload this in a child theme then include a file
						 * called content-search.php and that will be used instead.
						 */
						get_template_part( 'template-parts/content', 'search' );

					endwhile;?>


					</div>
				<?php
					the_posts_navigation();

				else :
					echo
						"<div class=\"section\">
							<h2>По вашему запросу ничего не найдено</h2>
							<div style=\"height: 300px;\">

							</div>
						</div>";

					//get_template_part( 'template-parts/content', 'none' );

				endif; ?>

			</main><!-- #main -->
		</section><!-- #primary -->
	</div>

<?php
get_footer();
