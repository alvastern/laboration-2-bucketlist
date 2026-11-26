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
define( 'DB_NAME', 'alst2511' );

/** Database username */
define( 'DB_USER', 'alst2511' );

/** Database password */
define( 'DB_PASSWORD', 'q7Q!cF@Y!@' );

/** Database hostname */
define( 'DB_HOST', 'studentmysql.miun.se' );

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
define( 'AUTH_KEY',         ']x1m&q33.a.bmEcp%]knoC=`9#)L- eGcZRNY.D/}Ymxf!rDs-lI9%>D88U-#%TT' );
define( 'SECURE_AUTH_KEY',  '=.4}7?<PCU;liJPW7M;]dkC:Jx9o>kSm=(]dkv3+5itVoPn5T?)nF<# Exhv#)iW' );
define( 'LOGGED_IN_KEY',    '5Wit<L2LK2l3*46zB8O;,rKCQ*s[6=-/$$=tUIUM=x.%7U,T}|F8(sJM e#-q/Pe' );
define( 'NONCE_KEY',        '#{XMPqe0Mq>%[@e~e hL-m4J166v(`E[uXowy,#o>%50{.(|LF;|>)J!a^/0`2vo' );
define( 'AUTH_SALT',        '4l3%_C=}ym@$|=1Y5&z9 T00I,SdgOj:K#JiDuRn2~;8=??>kIZhu>`f^Z%WBmF{' );
define( 'SECURE_AUTH_SALT', 'R(vw-nm^);N,g9tu* /GQ57[uxG}{to2dyFRfIOQwi~6A/`-`E89CD9Dj|*)hr!(' );
define( 'LOGGED_IN_SALT',   'uF`7ar~|ysBV$0B_gxj9U_Qic^w2_AXSyVKbx+c~Qc^mj5_Of+])Kl^F4LE<H|wy' );
define( 'NONCE_SALT',       'w+@1}b{q||U530ZA8`xbF%6BmhO55) t7LhlPB]|Cy|sz?3`2JeIW=Q_v=gA#wc_' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
