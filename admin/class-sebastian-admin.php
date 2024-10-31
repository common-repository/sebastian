<?php

/**
 * @package    Sebastian
 * @subpackage Sebastian/admin
 * @author     Batuhan Kök <hello@batuhan.me>
 * @link       https://batuhan.me
 */
class Sebastian_Admin {

	private $plugin_name;
	private $version;
	private $sebastian_settings_options;
	private $admin_theme;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/sebastian-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'wp-color-picker' );

	}

	public function enqueue_scripts() {
		// not needed now
		// wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/sebastian-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'wp-color-picker' );
	}

	public function sebastian_add_plugin_page_settings_link($links) {
		$links[] = '<a href="' . admin_url( 'options-general.php?page=sebastian' ) . '">' . __('Settings') . '</a>';
		return $links;
	} 

	public function sebastian_settings_add_plugin_page() {
		$icon_base64 = 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/PjxzdmcgZGF0YS1uYW1lPSIwMTZfRk9PRCIgaWQ9Il8wMTZfRk9PRCIgdmlld0JveD0iMCAwIDI0IDI0IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjxkZWZzPjxzdHlsZT4uY2xzLTF7ZmlsbDojMzMzO308L3N0eWxlPjwvZGVmcz48cGF0aCBjbGFzcz0iY2xzLTEiIGQ9Ik0xMiwyMmMtNSwwLTgtMy04LThDNCw4LjUsOC4zNCwyLDEyLDJjMy41MSwwLDcuMTcsNS42NCw3Ljg3LDEwLjNhMSwxLDAsMCwxLTIsLjNDMTcuMjQsOC4yNSwxNCw0LDEyLDQsOS42OSw0LDYsOS40Niw2LDE0YzAsNS4yMiwzLjc2LDYsNiw2czQuODktLjY3LDUuNzQtMy44NGExLDEsMCwxLDEsMS45My41MkMxOC43NiwyMC4wNiwxNiwyMiwxMiwyMloiLz48L3N2Zz4=';
		
		add_menu_page(
			'Sebastian ' . __('Settings'),
			'Sebastian',
			'manage_options',
			'sebastian',
			array( $this, 'sebastian_settings_create_admin_page' ),
			$icon_base64,
			82
		);
	}

	public function sebastian_settings_create_admin_page() {
		$this->sebastian_settings_options = get_option( 'sebastian_settings' ); 
		$this->admin_theme = new Admin_Theme(); 
		$this->admin_theme->get_header(); 
		?>

			<h2 class="hndle sebastian-flex sebastian-widgets-heading">
                <span><?php echo __('general_settings', 'sebastian') ?></span>
			</h2>
			<?php settings_errors(); ?>
			<div class="sebastian-list-section">
				<form class="sebastian-form" method="post" action="options.php">
					<?php
						settings_fields( 'sebastian_settings_option_group' );
						do_settings_sections( 'sebastian-settings-admin' );
						submit_button();
					?>
				</form>
			</div>
	<?php 
		$this->admin_theme->get_footer();
	}

	public function sebastian_settings_page_init() {
		register_setting(
			'sebastian_settings_option_group',
			'sebastian_settings',
			array( $this, 'sebastian_settings_sanitize' )
		);

		add_settings_section(
			'sebastian_general_settings_section',
			__('', 'sebastian'),
			array( $this, 'sebastian_settings_section_info' ),
			'sebastian-settings-admin'
		);

		add_settings_field(
			'is_active',
			__('status', 'sebastian'),
			array( $this, 'is_active_callback' ),
			'sebastian-settings-admin',
			'sebastian_general_settings_section'
		);

		add_settings_field(
			'dot_color',
			__('dot_color', 'sebastian'),
			array( $this, 'dot_color_callback' ),
			'sebastian-settings-admin',
			'sebastian_general_settings_section'
		);

		add_settings_field(
			'alert_message',
			__('alert_message', 'sebastian'),
			array( $this, 'alert_message_callback' ),
			'sebastian-settings-admin',
			'sebastian_general_settings_section'
		);

		add_settings_field(
			'redirect_link',
			__('redirect_link', 'sebastian'),
			array( $this, 'redirect_link_callback' ),
			'sebastian-settings-admin',
			'sebastian_general_settings_section'
		);

		add_settings_field(
			'debug_active',
			__('debug_mode', 'sebastian'),
			array( $this, 'debug_active_callback' ),
			'sebastian-settings-admin',
			'sebastian_general_settings_section'
		);
	}

	public function sebastian_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['is_active'] ) ) {
			$sanitary_values['is_active'] = $input['is_active'];
		}

		if ( isset( $input['alert_message'] ) ) {
			$sanitary_values['alert_message'] = sanitize_text_field( $input['alert_message'] );
		}

		if ( isset( $input['redirect_link'] ) ) {
			$sanitary_values['redirect_link'] = sanitize_text_field( $input['redirect_link'] );
		}

		if ( isset( $input['debug_active'] ) ) {
			$sanitary_values['debug_active'] = $input['debug_active'];
		}

		if ( isset( $input['dot_color'] ) ) {
			$sanitary_values['dot_color'] = sanitize_text_field( $input['dot_color'] );
		}

		return $sanitary_values;
	}

	public function sebastian_settings_section_info() {
	}

	public function is_active_callback() {
		?> <fieldset><?php $checked = ( isset( $this->sebastian_settings_options['is_active'] ) && $this->sebastian_settings_options['is_active'] === '1' ) ? 'checked' : '' ; ?>
		<label for="is_active-0"><input type="radio" name="sebastian_settings[is_active]" id="is_active-0" value="1" <?php echo $checked; ?>> <?php echo __('enabled', 'sebastian') ?></label><br>
		<?php $checked = ( isset( $this->sebastian_settings_options['is_active'] ) && $this->sebastian_settings_options['is_active'] === '0' ) ? 'checked' : '' ; ?>
		<label for="is_active-1"><input type="radio" name="sebastian_settings[is_active]" id="is_active-1" value="0" <?php echo $checked; ?>> <?php echo __('disabled', 'sebastian') ?></label></fieldset> <?php
	}

	public function alert_message_callback() {
		printf(
			'<input class="regular-text" type="text" name="sebastian_settings[alert_message]" id="alert_message" value="%s">',
			isset( $this->sebastian_settings_options['alert_message'] ) ? esc_attr( $this->sebastian_settings_options['alert_message']) : ''
		);
	}

	public function redirect_link_callback() {
		printf(
			'<input class="regular-text" type="text" name="sebastian_settings[redirect_link]" id="redirect_link" value="%s">',
			isset( $this->sebastian_settings_options['redirect_link'] ) ? esc_attr( $this->sebastian_settings_options['redirect_link']) : ''
		);
	}

	public function dot_color_callback() {
		printf(
			'<input type="text" name="sebastian_settings[dot_color]" id="dot_color" value="%s" data-default-color="#000000">',
			isset( $this->sebastian_settings_options['dot_color'] ) ? esc_attr( $this->sebastian_settings_options['dot_color']) : '#000000'
		);
		echo "<script type='text/javascript'>jQuery(document).ready(function($) { $('#dot_color').wpColorPicker(); });</script>";
	}

	public function debug_active_callback() {
		?> <fieldset><?php $checked = ( isset( $this->sebastian_settings_options['debug_active'] ) && $this->sebastian_settings_options['debug_active'] === '1' ) ? 'checked' : '' ; ?>
		<label for="debug_active-0"><input type="radio" name="sebastian_settings[debug_active]" id="debug_active-0" value="1" <?php echo $checked; ?>> <?php echo __('active', 'sebastian') ?></label><br>
		<?php $checked = ( isset( $this->sebastian_settings_options['debug_active'] ) && $this->sebastian_settings_options['debug_active'] === '0' ) ? 'checked' : '' ; ?>
		<label for="debug_active-1"><input type="radio" name="sebastian_settings[debug_active]" id="debug_active-1" value="0" <?php echo $checked; ?>> <?php echo __('passive', 'sebastian') ?></label></fieldset>
		<label for="redirect_link" class="s-info"><?php echo __('debug_mode_description', 'sebastian'); ?></label>
		<?php
	}
}