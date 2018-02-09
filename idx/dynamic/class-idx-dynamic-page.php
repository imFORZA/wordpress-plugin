<?php
namespace IDX\Dynamic;

class IDX_Dynamic_Page {
	private $api_key;

	function __construct() {
		$this->$api_key = $this->api_key();
		add_action( 'admin_menu', array( $this, 'register_menu' ) );
	}

	function register_menu() {
		add_menu_page( 'Dynamic Pages', 'Dynamic Pages', 'administrator', 'dynamic_pages', array( $this, 'print_key' ) );
	}

	function print_key() {
		echo esc_html( "My secret api key that should never be displayed: {$this->$api_key}" );
	}

	private function api_key() {
		return get_option( 'idx_broker_apikey' );
	}
}
