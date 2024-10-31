<?php

/**
 * @package    Sebastian
 * @subpackage Sebastian/includes
 * @author     Batuhan Kök <hello@batuhan.me>
 * @link       https://batuhan.me
 */
class Sebastian {

	protected $loader;
	protected $plugin_name;
	protected $version;

	public function __construct() {
		if ( defined( 'SEBASTIAN_VERSION' ) ) {
			$this->version = SEBASTIAN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'sebastian';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sebastian-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-sebastian-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-sebastian-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin-theme.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-sebastian-public.php';

		$this->loader = new Sebastian_Loader();
	}

	private function set_locale() {
		$plugin_i18n = new Sebastian_i18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	private function define_admin_hooks() {
		$plugin_admin = new Sebastian_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'admin_menu', $plugin_admin, 'sebastian_settings_add_plugin_page');
		$this->loader->add_action( 'admin_init', $plugin_admin, 'sebastian_settings_page_init');
		$this->loader->add_filter( 'plugin_action_links_sebastian/sebastian.php', $plugin_admin, 'sebastian_add_plugin_page_settings_link');
	}

	private function define_public_hooks() {
		$plugin_public = new Sebastian_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wp_footer', $plugin_public, 'add_sebastian_div_to_footer' );
	}

	public function run() {
		$this->loader->run();
	}

	public function get_plugin_name() {
		return $this->plugin_name;
	}

	public function get_loader() {
		return $this->loader;
	}

	public function get_version() {
		return $this->version;
	}
}
