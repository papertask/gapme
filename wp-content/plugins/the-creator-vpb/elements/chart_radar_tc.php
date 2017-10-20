<?php

/*********** Shortcode: Chart Radar ************************************************************/

$tcvpb_elements['chart_radar_tc'] = array(
	'name' => esc_html__('Chart Radar', 'the-creator-vpb' ),
	'type' => 'block',
	'icon' => 'pi-chart-radar',
	'category' =>  esc_html__('Charts', 'the-creator-vpb'),
	'child' => 'chart_radars_tc',
	'child_button' => esc_html__('New Label', 'the-creator-vpb'),
	'child_title' => esc_html__('Label Section', 'the-creator-vpb'),
	'attributes' => array(
		'width' => array(
			'description' => esc_html__('Width', 'the-creator-vpb'),
			'info' => esc_html__('Width of the Chart, type % or px at the end of the number.', 'the-creator-vpb'),
			'default' => '100%',
		),
		'labels' => array(
			'description' => esc_html__('Labels', 'the-creator-vpb'),
			'info' => esc_html__('Type labels with commas and without spaces(e.g. Eating,Drinking,Sleeping,Designing,Coding,Cycling,Running)', 'the-creator-vpb'),
		),
		'id' => array(
			'description' => esc_html__('ID', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom ID', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),	
		'class' => array(
			'description' => esc_html__('Class', 'the-creator-vpb'),
			'info' => esc_html__('Additional custom classes for custom styling', 'the-creator-vpb'),
			'tab' => esc_html__('Advanced', 'the-creator-vpb'),
		),
	),
);

function tcvpb_chart_radar_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('chart_radar_tc'), $attributes));
	static $i = 0;
	$i++;

	$id_out = ($id!='') ? 'id='.$id.'' : '';
	$class_out = ($class!='') ? 'class='.$class.'' : '';

	$labels = str_replace(',','","',$labels);
	$labels_out = '"' . implode("", explode(' ', $labels)) . '"';

	return '<div '.esc_attr($id_out).' '.esc_attr($class_out).' style=" width:'.esc_attr($width).'; ">
				<canvas id="radar_canvas'.$i.'"></canvas>
			</div>

		<script>
			var radarChartData'.$i.' = {
				labels: ['.$labels_out.'],
				datasets : [
					'.do_shortcode($content).'
				]
			}

		window.addEventListener("load",function(event) {
			window.myRadar = new Chart(document.getElementById("radar_canvas'.$i.'").getContext("2d")).Radar(radarChartData'.$i.', {
				responsive: true
			});
		},false);

		</script>';
	
}

$tcvpb_elements['chart_radars_tc'] = array(
	'name' => esc_html__('Line Section', 'the-creator-vpb' ),
	'type' => 'child',
	'attributes' => array(
		'label' => array(
			'default' => 'My First dataset',
			'description' => esc_html__('Label', 'the-creator-vpb'),
		),
		'fillcolor' => array(
			'description' => esc_html__('Fill Color', 'the-creator-vpb'),
			'type' => 'coloralpha',
			'default' => 'rgba(220,220,220,0.2)',
		),
		'strokecolor' => array(
			'description' => esc_html__('Stroke Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'pointcolor' => array(
			'description' => esc_html__('Point Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'pointstrokecolor' => array(
			'description' => esc_html__('Point Stroke Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => '#fff',
		),
		'pointhighlightFill' => array(
			'description' => esc_html__('Point Highlight Fill Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => '#fff',
		),
		'pointhighlightstroke' => array(
			'description' => esc_html__('Point Highlight Stroke Color', 'the-creator-vpb'),
			'type' => 'color',
			'default' => 'rgba(220,220,220,1)',
		),
		'data' => array(
			'description' => esc_html__('Radar Points', 'the-creator-vpb'),
			'info' => esc_html__('Seperate numbers with comma (e.g. 28, 48, 40, 19, 86, 27, 90)', 'the-creator-vpb'),
		),
	),
);

function tcvpb_chart_radars_tc_shortcode( $attributes, $content = null ) {
	extract(shortcode_atts(tcvpb_extract_attributes('chart_radars_tc'), $attributes));
	$radar_attr = '
		label: "'.esc_attr($label).'",
		fillColor : "'.esc_attr($fillcolor).'",
		strokeColor : "'.esc_attr($strokecolor).'",
		pointColor : "'.esc_attr($pointcolor).'",
		pointStrokeColor : "'.esc_attr($pointstrokecolor).'",
		pointHighlightFill : "'.esc_attr($pointhighlightFill).'",
		pointHighlightStroke : "'.esc_attr($pointhighlightstroke).'",
		data : ['.esc_attr($data).']';

	$return = '{'.$radar_attr.'},';
  
	return $return;
}

function tcvpb_enqueue_chart_radar_script() {
	global $post;
	if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'chart_radar_tc') ) {
		wp_enqueue_script('chart', TCVPB_DIR.'js/chart.js', array('jquery'), TCVPB_VERSION, true);
	}
}
add_action( 'wp_enqueue_scripts', 'tcvpb_enqueue_chart_radar_script' );