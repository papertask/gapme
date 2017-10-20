<?php
global $aeron_options;
global $ABdev_aeron_title_bar_below;
global $ABdev_aeron_title_bar_title;
global $wp_query;

if(!get_theme_mod('hide_title_bar', false)):?>
	<section class="title_bar <?php echo (get_theme_mod( 'show_announcement_bar', false))? ' with_topbar' : '';?><?php echo (isset($ABdev_aeron_title_bar_below) && $ABdev_aeron_title_bar_below == 1) ? ' title_bar_below' :''; ?>">
		<div class="container">
			<div class="row">
				<div class="span6">
					<?php if( is_singular( 'tribe_events' ) ): ?>
						<h1><?php echo esc_html(get_the_title()); ?></h1>
					<?php elseif( function_exists( 'tribe_is_month' ) && tribe_is_month() && !is_tax() ): ?>
						<h1><?php echo esc_html__( 'Events Calendar', 'ABdev_aeron' ); ?></h1>
					<?php elseif( function_exists( 'tribe_is_month' ) && tribe_is_month() && is_tax() ): ?>
						<h1><?php echo esc_html__( 'Events Calendar', 'ABdev_aeron' ); ?></h1>
					<?php elseif( function_exists( 'tribe_is_event' ) && tribe_is_event() && !tribe_is_day() && !is_single() ): ?>
						<h1><?php echo esc_html__( 'Events List', 'ABdev_aeron' ); ?></h1>
					<?php elseif( function_exists( 'tribe_is_event' ) && tribe_is_event() && is_single() ): ?>
						<h1><?php echo esc_html(get_the_title()); ?></h1>
					<?php elseif( function_exists( 'tribe_is_day' ) && tribe_is_day() ): ?>
						<h1><?php echo esc_html__( 'Events on: ', 'ABdev_aeron' ). date('F j, Y', strtotime($wp_query->query_vars['eventDate'])); ?></h1>
					<?php else: ?>
						<h1><?php echo (!empty($ABdev_aeron_title_bar_title)) ? $ABdev_aeron_title_bar_title : get_the_title();?></h1>
					<?php endif; ?>
				</div>
				<div class="span6">
					<?php ABdevFW_simple_breadcrumb(); ?>
				</div>
			</div>
		</div>
	</section>
<?php elseif(empty($ABdev_aeron_title_bar_below)): ?>
	<div class="no_title_bar_spacer <?php echo (get_theme_mod( 'show_announcement_bar', false))? ' with_topbar' : '';?><?php echo (isset($ABdev_aeron_title_bar_below) && $ABdev_aeron_title_bar_below == 1) ? ' title_bar_below' :''; ?>"></div>
<?php endif;