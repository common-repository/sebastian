<?php

/**
 * @package    Sebastian
 * @subpackage Sebastian/includes
 * @author     Batuhan Kök <hello@batuhan.me>
 * @link       https://batuhan.me
 */
class Sebastian_i18n {
	
	public function load_plugin_textdomain() {
		load_plugin_textdomain(
			'sebastian',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);
	}
}
