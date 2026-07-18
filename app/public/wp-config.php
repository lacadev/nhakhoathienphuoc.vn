<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '1$sQ2?Fs!KsnV Xiu@duA=ysW9bM:u7+?VjPsCqG<cww[biT:%w<e]I=]r@|fR<d' );
define( 'SECURE_AUTH_KEY',   'm$q6caCdu_g3YWxPD+hu/YafUzwCmrC-QK]]wfih)?->RR#R]8UV;MjG//[P3k8A' );
define( 'LOGGED_IN_KEY',     'KnTORwmT7|.d@DFNn7_G{.ENrIV=}GoPYMQ_ADJ#v Epzfn*G#bch4j/q;q(vFa{' );
define( 'NONCE_KEY',         '}o[sL<Zfyy Jy@Q`/l`:2>Li?Z,@kPp6CjxT/+=&NVHL0fqqPs{mu}52p; 6oTfL' );
define( 'AUTH_SALT',         'xx<|X{#o%Ay@E7I]b<:-SU7x-ndi#R8 bb$1UM2e(|qpg@rkq9tri2dMaQiY,azd' );
define( 'SECURE_AUTH_SALT',  'UKVil1K0wzHY9]jjJ{p]^dY#=g{K@?4gkn7FzEw<7td$tBJ}bL:V?Xcm;#F(V.A=' );
define( 'LOGGED_IN_SALT',    'h(b!fDp2I:p?lFRwnM0F??%TIB6WSJ`LGZ0]/b:oJ`8vz8,M=$bFWcQr%6+rcQxG' );
define( 'NONCE_SALT',        'b:{^<XaQ=VN%c%2v9)[.:4dJ/GG98_~KQ(_vOyobCDJkRIbxkzD3)2[c~.U<ax@?' );
define( 'WP_CACHE_KEY_SALT', '2mv<8Wr~yk %?:aK#dK`^^mc-q&rvC-;_6cuNdBJv>z XS[z**djf45^mcS|IYSk' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
