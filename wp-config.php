<?php
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
define( 'DB_NAME', 'bipinsahawordpress_db' );

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
define( 'AUTH_KEY',         '<alWJDrLl<i~!&uCcLhZypCO=vNW2.BK}D)+kgzo0^bt be/p~9{ DmNl(j$Dx8x' );
define( 'SECURE_AUTH_KEY',  ',83g!-Iuo+fc(zXrkxgftCD4v*J%l9*L-ZP12uy{ibRI,#*ml@H3jQ52Mw^XUenh' );
define( 'LOGGED_IN_KEY',    'j3&4oKM@+D;a:SQ6[{A V}%JuM@;8hrA;@#3he85Anzbv2 xis[+S*-BWF?HkB6o' );
define( 'NONCE_KEY',        '5a*Lme(WOgM,Pv#&7MpzN@j*h0&19U ((k%L8Wicw>8=cq0hS;-640!d/X1v,S-o' );
define( 'AUTH_SALT',        '26BT]C0cEFcrLP>{di5(cd_eyh2+!(W^lW[z~2[#|itu<P/G illAq@GTH$f ve7' );
define( 'SECURE_AUTH_SALT', '+u):3CXC,)^Hjn9L&@`GLq<|E%$ Fi*i$yyc*)a,Epez2*DuHL>}}hYvw]UB~j|N' );
define( 'LOGGED_IN_SALT',   'kS+}yr1P$H:@ 9N*A(vD&%?Oj-nT{iNj}>E:}4]j9cnE|VI$W5LLfz&T5:[IJf>-' );
define( 'NONCE_SALT',       'reR<XlK3vo.T2A&3!MeP1!i1%a&r4VM+.bh`Wdk^d*Ou^y</$iUj&fVd I(X9O-Q' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

@ini_set('upload_max_size' , '256M' );

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
