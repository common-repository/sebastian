<?php

/**
 * @package    Sebastian
 * @subpackage Sebastian/public
 * @author     Batuhan Kök <hello@batuhan.me>
 * @link       https://batuhan.me
 */
class Sebastian_Public {

	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sebastian-public.css', array(), $this->version, 'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sebastian-public.js', array( 'jquery' ), $this->version, false );
	}
	
	public function add_sebastian_div_to_footer() {

		$sebastian_settings = get_option( 'sebastian_settings' );
		$is_active = $sebastian_settings['is_active'];
		if (!$is_active) {
			return;
		}

		$redirect_link = $sebastian_settings['redirect_link'];
		$alert_message = $sebastian_settings['alert_message'];
		$debug_active = $sebastian_settings['debug_active'];
		$dot_color = $sebastian_settings['dot_color'];

		if (!empty($redirect_link) && $redirect_link !== "#") {
			$action = "window.location.href = '{$redirect_link}'";
		} else {
			$action = "alert('{$alert_message}');";
		}

		$additional_styles = 'background-color:' . $dot_color . ';';
		if ($debug_active) {
			$additional_styles .= 'width: 5px; height: 5px;';
		}

		echo '<div id="sebastian"></div>';
		echo '<script>
				(function($) {
					$(document).ready(function(){
						$("#sebastian").mouseover(function(){
							'. $action .'
						})
						.mousedown(function() {
							sebastianPause();
						});
					});
				})( jQuery );
			</script>';
		echo "<style>#sebastian { {$additional_styles} }</style>";
	}
}