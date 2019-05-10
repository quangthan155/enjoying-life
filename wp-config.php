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
define('DB_NAME', 'enjoying-life');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '172.20.0.101');

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
define('AUTH_KEY',         'rq$>uK8S!%)=!W|4~/GJtNmIgd%wv5Ndhu>Oif`pVZz!Y6|r$[[$yIhfR2`4TyJn');
define('SECURE_AUTH_KEY',  'olhN%}.&?lh?Qd SjRL,PlG}We:jj(N6;zQBUCjl]0/J_X@8.gnq_i^dVIWs=IMu');
define('LOGGED_IN_KEY',    'U43r+!UxWr^Vr72,]uEq%-Bq)6B%zCXC}0H1mp7I2J;CNId)_t$LBbf>+2cE9ARq');
define('NONCE_KEY',        'N<=Cas*anvSmef)3T)dk]u;&o.g=xzk/(!.8RF8uJb5R>22U n3qE-^.Yh>]/k+0');
define('AUTH_SALT',        'M!s| 7StzgE3o?w$z:4M4je8q<)f-HN4>#B>s-fZ_%|OZ9Z#-i8h>:<gOPb;mI1*');
define('SECURE_AUTH_SALT', 'U~$p79VItenHr>wl0gWCjf[%-gB^te95j.rtFy*q&tX}1?:T,JJ`B8!D5b@RY(?!');
define('LOGGED_IN_SALT',   '^I+<VmJ$>`VE.EoAo8=_f%*v;9cs$:6CB0@q::4rX[3Nwhx^>f}Z!?#(Y|W[RsX*');
define('NONCE_SALT',       '!YUA{=?Ofj)i~m[mi vR1gr(TSn0Z9k!B_hC+D9+^/`~S>^)=50;3s2cbJ^aa[cL');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';



/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');


// Enable WP_DEBUG mode
define('WP_DEBUG', false);

// Enable Debug logging to the /wp-content/debug.log file
define('WP_DEBUG_LOG', true);

// Disable display of errors and warnings
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', E_ALL);

// Use dev versions of core JS and CSS files (only needed if you are modifying these core files)
define('SCRIPT_DEBUG', true);
