<?php

/**
 * @package    Sebastian
 * @subpackage Sebastian/includes
 * @author     Batuhan Kök <hello@batuhan.me>
 * @link       https://batuhan.me
 */
class Sebastian_Activator {

	public static function activate() {
		update_option( 'sebastian_settings', [
				'is_active'       => '1',
				'dot_color'       => '#000000',
				'alert_message'   => 'Sebastian!',
				'redirect_link'   => '#',
				'debug_active'    => '0'
			] 
		);
	}
}