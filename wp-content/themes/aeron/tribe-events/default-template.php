<?php
/**
 * Default Events Template
 * This file is the basic wrapper template for all the views if 'Default Events Template'
 * is selected in Events -> Settings -> Template -> Events Template.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/default-template.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

get_header();
get_template_part('title_breadcrumb_bar');

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

?>
<section>
	<div class="container">
		<div id="tribe-events-pg-template">
			<?php tribe_events_before_html(); ?>
			<?php tribe_get_view(); ?>
			<?php tribe_events_after_html(); ?>
		</div> <!-- #tribe-events-pg-template -->
	</div>
</section>

<?php if (is_singular( 'tribe_events' ) && !tribe_is_month()): ?>
	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<section>
			<div class="container">
				<ul class="tribe-events-sub-nav">
					<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
					<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
				</ul>
			</div>
		</section>
		<!-- .tribe-events-sub-nav -->
	</div>
<?php elseif (tribe_is_event() && !tribe_is_month() && !tribe_is_day() && !is_single()): ?>
	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<section>
			<div class="container">
				<ul class="tribe-events-sub-nav">
					<li class="tribe-events-nav-previous"><?php tribe_the_prev_event_link( '<span>&laquo;</span> %title%' ) ?></li>
					<li class="tribe-events-nav-next"><?php tribe_the_next_event_link( '%title% <span>&raquo;</span>' ) ?></li>
				</ul>
			</div>
		</section>
		<!-- .tribe-events-sub-nav -->
	</div>
<?php elseif (tribe_is_event() && tribe_is_day() && !tribe_is_month()): ?>
	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<section>
			<div class="container">
				<h3 class="screen-reader-text" tabindex="0"><?php esc_html_e( 'Day Navigation', 'the-events-calendar' ) ?></h3>
				<ul class="tribe-events-sub-nav">
					<!-- Previous Page Navigation -->
					<li class="tribe-events-nav-previous" aria-label="previous day link"><?php tribe_the_day_link( 'previous day' ) ?></li>
					<!-- Next Page Navigation -->
					<li class="tribe-events-nav-next" aria-label="next day link"><?php tribe_the_day_link( 'next day' ) ?></li>
				</ul>
			</div>
		</section>
		<!-- .tribe-events-sub-nav -->
	</div>
<?php elseif (tribe_is_event() && tribe_is_month()): ?>
	<!-- Event footer -->
	<div id="tribe-events-footer">
		<!-- Navigation -->
		<section>
			<div class="container">
				<h3 class="screen-reader-text" tabindex="0"><?php esc_html_e( 'Calendar Month Navigation', 'the-events-calendar' ) ?></h3>
				<ul class="tribe-events-sub-nav">
					<li class="tribe-events-nav-previous" aria-label="previous month link">
						<?php tribe_events_the_previous_month_link( 'previous day' ); ?>
					</li>
					<!-- .tribe-events-nav-previous -->
					<li class="tribe-events-nav-next" aria-label="next month link">
						<?php tribe_events_the_next_month_link( 'next day' ); ?>
					</li>
					<!-- .tribe-events-nav-next -->
				</ul><!-- .tribe-events-sub-nav -->
			</div>
		</section>
		<!-- .tribe-events-sub-nav -->
	</div>
<?php endif ?>

<?php
get_footer();
