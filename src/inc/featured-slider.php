<?php
/**
 * The template for displaying the featured content slider.
 *
 * @package oss
 */

// Remove hook for the default shortcode...
remove_shortcode('gallery', 'gallery_shortcode');
// .. and create a new shortcode with the default WordPress shortcode name (tag) for the gallery
add_shortcode('gallery', function($atts)
{
	$attrs =
		shortcode_atts(array(
			'slider'              => md5(microtime().rand()), // Slider ID (is per default unique)
			'slider_class_name'   => '', // Optional slider css class
			'ids'                 => '', // Comma separated list of image ids
			'size'                => 'thumbnail', // Image format (could be an custom image format)
			'slides_to_show'      => 1,
			'slides_to_scroll'    => 1,
			'dots'                => false,
			'infinite'            => true,
			'speed'               => 300,
			'touch_move'          => true,
			'autoplay'            => false,
			'autoplay_speed'      => 2000,
			'accessibility'       => true,
			'arrows'              => true,
			'center_mode'         => false,
			'center_padding'      => '50px',
			'css_ease'            => 'ease',
			'dots_class'          => 'slick-dots',
			'draggable'           => true,
			'easing'              => 'linear',
			'fade'                => false,
			'focus_on_select'     => false,
			'lazy_load'           => 'ondemand',
			'on_before_change'    => null,
			'pause_on_hover'      => true,
			'pause_on_dots_hover' => false,
			'rtl'                 => false,
			'slide'               => 'div',
			'swipe'               => true,
			'touch_move'          => true,
			'touch_threshold'     => 5,
			'use_css'             => true,
			'vertical'            => false,
			'wait_for_animate'    => true
		), $atts);

	extract($attrs);

	// Verify if the chosen image format really exist
	if( !in_array( $size, get_intermediate_image_sizes()) )
	{
		echo 'Image Format <strong>'.$size.'</strong> Not Available!';
		exit;
	}

	// Iterate over attribute array, cleanup and make the array elements JavaScript ready
	foreach( $attrs as $key => $attr )
	{
		// CamelCase the array keys
		$new_key_name = lcfirst(str_replace(array(' ', 'Css'), array('', 'CSS'), ucwords(str_replace('_', ' ', $key))));

		// Remove unnecessary array elements
		if( in_array($key, array('size', 'ids', 'slider_class_name')) || strpos($key, '_') !== false )
		{
			unset($attrs[$key]);
		}

		// Fix the type before passing the array elements to JavaScript
		if( is_numeric($attr) )
		{
			$attrs[$new_key_name] = (int) $attr;
		}else if( is_bool($attr) || (strpos($attr, 'true') !== false || strpos($attr, 'false') !== false) )
		{
			$attrs[$new_key_name] = filter_var($attr, FILTER_VALIDATE_BOOLEAN);
		}else if( is_int($attr) )
		{
			$attrs[$new_key_name] = filter_var($attr, FILTER_VALIDATE_INT);
		}
	}

	// Determine if the script has already been registered and register the script and stylesheets only once
	if( !wp_script_is(get_template_directory_uri().'/slick/slick.min.js', 'enqueue') )
	{
		// Register the Slick JavaScript library
		wp_register_script('slick-js', get_template_directory_uri().'/slick/slick.min.js', array('jquery'), null);
		wp_enqueue_script('slick-js');

		// Register the Slick Stylesheets
		wp_register_style('slick-css', get_template_directory_uri().'/slick/slick.css');
		wp_enqueue_style('slick-css');

		// Register your own custom Stylesheets for Slick
		wp_register_style('slick-custom-css', get_template_directory_uri().'/css/slick-custom.css');
		wp_enqueue_style('slick-custom-css');
	}

	// Create an empty variable for return html content
	$html_output = '';

	// Check if the slider should be unique and do some unique stuff (*optional)
	if( ctype_xdigit($slider) && strlen($slider) === 32 )
	{
		$is_unique = true;
	}else{
		$is_unique = false;
	}

	// Initiate the slider with the slider id and pass the php array as a json object
	$html_output .= '<script>$(function() {$(".'.$slider.'").slick('.json_encode($attrs).'); });</script>';

	// Build the html slider structure (open)
	$html_output .= '<div class="'.$slider_class_name.' '.$slider.' slider wp-slick-slider">';

	// Iterate over the comma separated list of image ids and keep only the real numeric ids
	foreach( array_filter( array_map(function($id){ return (int) $id; }, explode(',', $ids)) ) as $media_id)
	{
		// Get the image by media id and build the html div group with the image source, width and height
		if( $image_data = wp_get_attachment_image_src( $media_id, $size ) )
		{
			$html_output .= '<div><div class="image"><img src="'.esc_url($image_data[0]).'" height="'.$image_data[0].'" width="'.$image_data[0].'" /></div></div>';
		}
	}

	// Close the html slider structure and return the html output
	return $html_output.'</div>';
});

?>