<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'jongcoding' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'VGe.}cL} nA&A?C$c9,fDB1@)vh4(=;R55VB)amqda(Y1u}N+$V,KAKh#%R_*u@]' );
define( 'SECURE_AUTH_KEY',  '};c1GWQ5U`}S pYijGV{kinxFK.SdR`^d|r#im04@TFb~#?.0WA(;/E$$/}wBR/n' );
define( 'LOGGED_IN_KEY',    ',P:%vluCz8o!Izd=oR~>ifqQ,.ycK>XBL$Grgu$Ons?>xNJ_oMH-sI;q19F%O]K?' );
define( 'NONCE_KEY',        'GP%y`vd5Lw=V)ODwU>lQP_2/+YSrN<8Zw*^9/f}Ms*cx<0S&14^%]ko?*ZtOgXwK' );
define( 'AUTH_SALT',        '7|1J,P!NV^@>~3YO)IWxOsl0/|a%f-Ern48MU{L*N/v>v$k$;G)&5)nGy*t]k{$U' );
define( 'SECURE_AUTH_SALT', '/Tj3-F!B&zfl^8>m{hH:@!^/,XXW$oF=7*35pF~,zfWNTM7+^sGMP&|D,+YpubDJ' );
define( 'LOGGED_IN_SALT',   'IdkVGP-C&L`)Uq1$|]SqZrhDuWz0U^rQKFkd)/ydP-q#`+xt>|;-W<!Mv9nTC2L_' );
define( 'NONCE_SALT',       'gsa=<-|?:~[8/.!.6jLJ7v2-!ca_<|hlbZy B|%>+2i$1xp-Z0AXXo[?qO4Bb5?i' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
