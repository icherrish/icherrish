<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'iche_solak_db_wordpress' );

/** Database username */
define( 'DB_USER', 'iche_solak_db_wordpress_user' );

/** Database password */
define( 'DB_PASSWORD', '!C@dd1tKt!E1AD1G' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '8@|u^O+bc!YCZ^gw/|t//5m~D)>#645,U56l$fuj8OwP#nQQO9KQu_PVV60P2!L`' );
define( 'SECURE_AUTH_KEY',  'cVAhS=Lq46`@<$p@#e<ehCnaq>9mt=C!i@&736hAHLkX.e0rawsV6pI88K[s?_Q&' );
define( 'LOGGED_IN_KEY',    'fc>y5m=O}[s|^W<5$RnhjZ^XR #Q`m.a1cisvcjOd^IBnNF@V+a;wEFU^H*eThz)' );
define( 'NONCE_KEY',        '@y(XQr7m^;,{B1VL.CM!tKAJn{*z2itJ&6| 2OtBvhy.|mG/4~Ldd[gx;c@(6wX=' );
define( 'AUTH_SALT',        '@mO,V]4[r~E<RSeoz}A/e/,^fDUVLWX16:jBeu1$SQ<%~+TJgv%Kl& E8)n5g[1=' );
define( 'SECURE_AUTH_SALT', 'I|@0~(R!/v%%c@P=qz`lGgDgiG8L:y.:l2FsxZJo#FH9v3Tyg5EPN-nW?K3/LeiZ' );
define( 'LOGGED_IN_SALT',   'UcA4av:E`W@zK$,FX^RH8URo4X8v-66vyQtcw{&8C}I1TDAukh^Zj$z_Uu +DEa.' );
define( 'NONCE_SALT',       'TPZ4<:%&&P@zU$%~`C(|HQU{wFM;LT:&?U5dOG}yE%`9-/ZLWYBq-#O|9H|I1_RL' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

define( 'WP_MEMORY_LIMIT', '1024M' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
