<?php
/*
Template Name: No-Sidebar Page Template
*/
get_header();

get_template_part('title_breadcrumb_bar');

?>

	<section>
		<div class="container">

			<div class="row">

				<div class="span12 content">
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
						<?php the_content();?>
					<?php endwhile; endif;?>
				</div><!-- end span8 main-content -->

				

			</div><!-- end row -->

		</div>
	</section>

<?php get_footer();