<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Solak Core Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */

final class Solak_Extension {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */

	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';


	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */

	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init' ] );
	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {

		// Check if Elementor installed and activated

		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return;
		}

		// Check for required Elementor version

		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return;
		}

		// Check for required PHP version

		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return;
		}


		// Add Plugin actions

		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );


        // Register widget scripts

		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'widget_scripts' ]);


		// Specific Register widget scripts

		// add_action( 'elementor/frontend/after_register_scripts', [ $this, 'solak_regsiter_widget_scripts' ] );
		// add_action( 'elementor/frontend/before_register_scripts', [ $this, 'solak_regsiter_widget_scripts' ] );


        // category register

		add_action( 'elementor/elements/categories_registered',[ $this, 'solak_elementor_widget_categories' ] );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'solak' ),
			'<strong>' . esc_html__( 'Solak Core', 'solak' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'solak' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */

			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'solak' ),
			'<strong>' . esc_html__( 'Solak Core', 'solak' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'solak' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(

			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'solak' ),
			'<strong>' . esc_html__( 'Solak Core', 'solak' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'solak' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */

	public function init_widgets() {

		$widget_register = \Elementor\Plugin::instance()->widgets_manager;

		// Header Include file & Widget Register
		require_once( SOLAK_ADDONS . '/header/header.php' );
		require_once( SOLAK_ADDONS . '/header/header2.php' );

		$widget_register->register ( new \Solak_Header() );
		$widget_register->register ( new \Solak_Header2() );


		// Include All Widget Files
		foreach($this->Solak_Include_File() as $widget_file_name){
			require_once( SOLAK_ADDONS . '/widgets/solak-'."$widget_file_name".'.php' );
		}
		// All Widget Register
		foreach($this->Solak_Register_File() as $name){
			$widget_register->register ( $name );
		}
		
	}

	public function Solak_Include_File(){
		return [
			'banner', 
			'banner2', 
			'section-title', 
			'button', 
			'blog', 
			'service', 
			'service2', 
			'testimonial', 
			'team', 
			'team-info', 
			'image', 
			'contact-info', 
			'contact-form', 
			'counterup', 
			'faq', 
			'client-logo', 
			'cta', 
			'gallery', 
			'info-box', 
			'newsletter', 
			'menu-select',
			'footer-widgets',

			'before-after',

			'social',
			'animated-shape', 
			'arrows', 
			'tab-builder', 
			'skill', 
			'step', 
			'features', 
			'video', 
			'price',
			'project',
			'project-info',
			'choose-us',
			'service-list',
			'marquee',
			'download',
			'megamenu',
		];
	}

	public function Solak_Register_File(){
		return [
			new \Solak_Banner1(),
			new \Solak_Banner2(),
			new \Solak_Section_Title(),
			new \Solak_Button(),
			new \Solak_Blog(),
			new \Solak_Service(),
			new \Solak_Service2(),
			new \Solak_Testimonial(),
			new \Solak_Team(),
			new \Solak_Team_info(),
			new \Solak_Image(),
			new \Solak_Contact_Info(),
			new \Solak_Contact_Form(),
			new \Solak_Counterup(),
			new \Solak_Faq(),
			new \Solak_Client_Logos(), 
			new \Solak_Cta(),
			new \Solak_Gallery(),
			new \Solak_Info_Box(),
			new \solak_Newsletter(),
			new \Solak_Menu(),
			new \Solak_Footer_Widgets(),

			new \Solak_Before_After(),

			new \Solak_Social(),
			new \Solak_Animated_Shape(),
			new \Solak_Arrows(),
			new \Solak_Tab_Builder(),
			new \solak_Skill(),
			new \solak_Step(),
			new \Solak_Features(),
			new \solak_Video(),
			new \Solak_Price(),
			new \Solak_Project(), 
			new \Solak_project_List(), 
			new \solak_Choose_Us(),
			new \Solak_Service_List(),
			new \Solak_Marquee(),
			new \Solak_Download(),
			new \Solak_Megamenu(),
		];
	}

    public function widget_scripts() {

        // wp_enqueue_script(
        //     'solak-frontend-script',
        //     SOLAK_PLUGDIRURI . 'assets/js/solak-frontend.js',
        //     array('jquery'),
        //     false,
        //     true
		// );

	}


    function solak_elementor_widget_categories( $elements_manager ) {

        $elements_manager->add_category(
            'solak',
            [
                'title' => __( 'Solak', 'solak' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );

        $elements_manager->add_category(
            'solak_footer_elements',
            [
                'title' => __( 'Solak Footer Elements', 'solak' ),
                'icon' 	=> 'fa fa-plug',
            ]
		);

		$elements_manager->add_category(
            'solak_header_elements',
            [
                'title' => __( 'Solak Header Elements', 'solak' ),
                'icon' 	=> 'fa fa-plug',
            ]
        );
	}
}

Solak_Extension::instance();