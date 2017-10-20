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
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'globalpme');

/** MySQL database username */
define('DB_USER', 'globalpme');

/** MySQL database password */
define('DB_PASSWORD', 'Globalpme2017!');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '3J=9|hz<n/i?k{Ccuw/mg~!>y{*!TW; @5M(m4><T)iQT9l&HW%ppM|K+6ot1JAJ');
define('SECURE_AUTH_KEY',  ',B~k<SZ[A4k(dM6Q<*Q,==R>|2gFi>igV~|{gcv6*j#0eX Ut(AB#^*wq@TM}Vw2');
define('LOGGED_IN_KEY',    'Yc3jo~O)8;^Kud*1SO)*%K0CcY5Uy%28!Sr}d+y+<EQR{SnDe@u_;g)1p9K>*GTp');
define('NONCE_KEY',        'J%LX3R?VdR}7$mK:xNRq!R}Da0zp(<ae96*mt$YmA{[o}F0t^O~&l/aY TL,Y1>C');
define('AUTH_SALT',        '=b:z{ js[NCOPGi)-bZ?%GdcxE=^P0=nH/)j>P%h|++<g$QNb|S#=W&4q ;*2k1R');
define('SECURE_AUTH_SALT', 'XH8$!Lx.;B$i%oa/PnnyJj;^+g>NuKm)(p+iZS&E;x0of}%0mXQ-N=+*YvyoR${K');
define('LOGGED_IN_SALT',   '9/r=v`}ibe,h24|Q5%k`@(A`ZvIepP/MZbLg]+0ag*VQI4IN[%|Nk^rg;oK;/vF-');
define('NONCE_SALT',       '^(]4[fc)X+w2Ek~LGLay*=!-;%[Q M;#B*5T+ei9>^[mGoTDDMwb6Y^nS~GJeUl;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
