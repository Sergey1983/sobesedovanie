<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Speedster
 */

?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
								<?php
									if ( is_singular() ) :
										the_title( '<h1 class="entry-title">', '</h1>' );
									else :
										the_title( '<h1 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h1>' );
									endif;

									if ( 'post' === get_post_type() ) : ?>
									<div class="entry-meta">
										<?php speedster_posted_on(); ?>
										<?php speedster_entry_footer(); ?>
									</div><!-- .entry-meta -->
									<?php
									endif; ?>
							</header>
							<figure class="img-responsive-center">
									 <?php if(has_post_thumbnail()){ $arg=array( 'class'=> 'img-responsive' ); the_post_thumbnail('',$arg); } ?>
							</figure>
							<div class="entry-content clearfix">
								<p>
									<?php
											the_excerpt( sprintf(
												wp_kses(
													/* translators: %s: Name of current post. Only visible to screen readers */
													__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'speedster' ),
													array(
														'span' => array(
															'class' => array(),
														),
													)
												),
												get_the_title()
											) );

											wp_link_pages( array(
												'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'speedster' ),
												'after'  => '</div>',
											) );
										?>
								</p>
								<div class="read-more cl-effect-14">
									<a href="<?php the_permalink(); ?>" class="more-link"> <?php esc_html_e('Continue reading','speedster'); ?> <span class="meta-nav">→</span></a>
								</div>
							</div>
						</article>


