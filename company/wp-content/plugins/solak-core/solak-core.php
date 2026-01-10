<?php
/**
 * 
 * Plugin Name: Solak Core
 * Description: This is a helper plugin of solak theme
 * Version:     1.0
 * Author:      Themeholy
 * Author URI:  https://themeforest.net/user/themeholy
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path: /languages
 * Text Domain: solak
 * 
 */

// Blocking direct access

if( ! defined( 'ABSPATH' ) ) {

    exit();

}

// Define Constant

define( 'SOLAK_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

define( 'SOLAK_PLUGIN_INC_PATH', plugin_dir_path( __FILE__ ) . 'inc/' );
define( 'SOLAK_PLUGIN_CMB2EXT_PATH', plugin_dir_path( __FILE__ ) . 'cmb2-ext/' );

define( 'SOLAK_PLUGIN_WIDGET_PATH', plugin_dir_path( __FILE__ ) . 'inc/widgets/' );

define( 'SOLAK_PLUGDIRURI', plugin_dir_url( __FILE__ ) );

define( 'SOLAK_ADDONS', plugin_dir_path( __FILE__ ) .'addons/' );

define( 'SOLAK_ELEMENTOR_OPTIONS', plugin_dir_url( __FILE__ ) .'addons/elementor-options/' );

define( 'SOLAK_ASSETS', plugin_dir_url( __FILE__ ) .'assets/' );

define( 'SOLAK_CORE_PLUGIN_TEMP', plugin_dir_path( __FILE__ ) .'solak-template/' );

// load textdomain
add_action('init', function()
{
    load_plugin_textdomain('solak', false, basename( dirname( __FILE__ ) ) . '/languages');
});

//include file.

require_once SOLAK_PLUGIN_INC_PATH .'solakcore-functions.php';
require_once SOLAK_PLUGIN_INC_PATH .'builder/builder.php';
require_once SOLAK_PLUGIN_INC_PATH . 'MCAPI.class.php';
require_once SOLAK_PLUGIN_INC_PATH .'solakajax.php';
require_once SOLAK_PLUGIN_INC_PATH .'megamenu.php';

require_once SOLAK_PLUGIN_CMB2EXT_PATH . 'cmb2ext-init.php';

//Widget

require_once SOLAK_PLUGIN_WIDGET_PATH . 'recent-post-widget.php';
require_once SOLAK_PLUGIN_WIDGET_PATH . 'search-form.php';
require_once SOLAK_PLUGIN_WIDGET_PATH . 'categories-lists.php';
require_once SOLAK_PLUGIN_WIDGET_PATH . 'about-us-widget.php';
// require_once SOLAK_PLUGIN_WIDGET_PATH . 'author-widget.php';
require_once SOLAK_PLUGIN_WIDGET_PATH . 'offer-banner.php';

//addons

require_once SOLAK_ADDONS . 'addons.php';
require_once SOLAK_ADDONS . 'addons-style-functions.php';
require_once SOLAK_ADDONS . 'addons-field-functions.php';

// Register widget styles
add_action( 'elementor/editor/after_enqueue_scripts', 'widget_styles' );

function widget_styles() {

    wp_register_style( 'editor-style-1', plugins_url( 'assets/css/editor.css', __FILE__ ) );
    wp_enqueue_style( 'editor-style-1' );

}


