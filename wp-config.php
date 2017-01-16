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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '-w+_@9C+at8QE |2/V=bZ_xc#91TI^-*9p<f;u`d?=)R)JY:2}[,0>v*^i4QL!?;');
define('SECURE_AUTH_KEY',  '[]Kq6+3_5e#C 5{w?Au13W?z5L^XLvtfOX1Z=I({}CuwNb~[et+2!{1sOby/(uKl');
define('LOGGED_IN_KEY',    'i#%(vfusVz}_*%k^ glW&h<-%^MtBW2?SJ5L%.N(mn!<a^8;eu{R|?JLW^QeoP}I');
define('NONCE_KEY',        '9X]1Hr.1Y&=HbSW2:uH:3XpJ <NuW~`{~=K A*kUZ2GoW,A&Xk$O<jpl^]PW}|l=');
define('AUTH_SALT',        'cI<G^]GQG=-QKCR&&@`B(eyr0HWQ.97B7^pT&$$vo (bY[|?no(M|j(l$U^1j6Vi');
define('SECURE_AUTH_SALT', '>S(?(OV}8NEbOOf9?L$&cz^TxxtL:w$pXQa0vx8qI~/NeF,m`z.).{1[l&,0x5}8');
define('LOGGED_IN_SALT',   '-hfn2@L[K7g<LsNZYH4rQvZ9(UJ#8M8T`UmmG0 |ug&EtzQ,q<rIB7T2H|#}(An`');
define('NONCE_SALT',       'YxQ6CtJo#gjV<4(A^<B~kk@_7!U5FmAuB4lO]L+#/,D#|5ZBZ^8NNJy]>k.]v@lt');

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
define('WP_DEBUG', true);

define('WP_ALLOW_MULTISITE', true);

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', false);
define('DOMAIN_CURRENT_SITE', 'localhost');
define('PATH_CURRENT_SITE', '/wordpress/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);


/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
