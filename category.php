<?php
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sydney
 */

get_header(); 

$layout = sydney_blog_layout();

?>

	<?php do_action('sydney_before_content'); ?>

	<div id="primary" class="content-area col-md-9 <?php echo esc_attr( $layout ); ?>">

		<?php sydney_yoast_seo_breadcrumbs(); ?>

		<main id="main" class="post-wrap" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h3 class="archive-title">', '</h3>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="posts-layout">
			<?php while ( have_posts() ) : the_post(); ?>

				<?php
					if ( $layout != 'classic-alt' ) {
						get_template_part( 'content', get_post_format() );
					} else {
						get_template_part( 'content', 'classic-alt' );
					}
				?>

			<?php endwhile; ?>
			</div>
			
		<?php
			the_posts_pagination( array(
				'mid_size'  => 1,
			) );
		?>	

		<?php else : ?>

			<?php get_template_part( 'content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php do_action('sydney_after_content'); ?>
<?php 
	if ( ( $layout == 'classic-alt' ) || ( $layout == 'classic' ) ) :
	get_sidebar();
	endif;
?>

<?php get_footer(); ?>