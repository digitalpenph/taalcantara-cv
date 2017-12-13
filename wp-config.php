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
define('DB_NAME', 'id2511193_taalcantara_cv');

/** MySQL database username */
define('DB_USER', 'id2511193_taalcantara');

/** MySQL database password */
define('DB_PASSWORD', 'taalcantara');

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
define('AUTH_KEY',         ' &%K6NI`NH0_Uw9.Y_CWD[_Poh]t.6K/pq.F{(d1QlP)o/u/m^gTSg}:[z;2Vflx');
define('SECURE_AUTH_KEY',  'rMK^@!f24G1e`]DvesVl@PP;hp^ShSL4s.dSM`WWo~?jEVx{7>J*O[*dL[)QOgLH');
define('LOGGED_IN_KEY',    '|zEZAKp-Sm.ojBvxr#x*^EU//9HBD`Wvi.U,9jrPy9!ROv@F+ESw?NxNm>7k`~<[');
define('NONCE_KEY',        'LlZu/k.YL7+tMY>LRN,$nQ_]+xf>8VSlx;K ts~6w-Ri)4axYwxCkpsF=aIGbpD=');
define('AUTH_SALT',        'zSwQ/oEE#`e0thq*l^gajM(jCa?U~f[J{iKa9![GO.3>y:[zxe~ew fw]I]2*&1/');
define('SECURE_AUTH_SALT', '<NiTgnsM N:;Uv$%ge&PT1RQTc}fz-Pi1^:q.V`qqC~{ZkPE|G1UPh-Yb;),VycZ');
define('LOGGED_IN_SALT',   'j4HI_9Gvn%Us!:ZSD&M@VK3RPV?VoQ,rLHVl$Gm;pF~<Y%@>6-:yUKnzEA-^3&[@');
define('NONCE_SALT',       'oqwS2m $%.]+?pZl1<-3PY4qF>i^ }CV@B/9--S ZI{>L8Q}X}=w1WPs[ 5UW`..');

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
