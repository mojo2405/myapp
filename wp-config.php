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
define('DB_NAME', 'myapp');

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
define('AUTH_KEY',         'q$fNC#^F>2AtEvr_c*DSt+[$O;u6$5um2)vMej<TdF0j 5f]ZNhw[V10Xmmra+wg');
define('SECURE_AUTH_KEY',  'gy`0LPJ6RM$B$ala/uL0?1[P%NE(5!hUa#6Y`72DBJHS~Z}tSgjq~o@L%v];2O4w');
define('LOGGED_IN_KEY',    'l}|MV<OMEBmRdy.GRRV<Y`GEk@aceyUa5P,09t=,7jjNc]<j;Ms0V|lfNlg#1(,s');
define('NONCE_KEY',        '&y+!+XfALpNIx^aAFp-YlKLJ7db|A&+,H~~0Ks{BtkA$U`0LeaipIPM D8?[9qy~');
define('AUTH_SALT',        '+q7VI! L(Y@FNr!<0Jy+[8IB:ST9)**&,/=.H>@W&G@7z+[)3Oqob}0)MgcpE|>k');
define('SECURE_AUTH_SALT', 'm?ye&^ia3}GqtRXP[O=sI{I,7i*|o1+K.}j5Q9A|f7?xGCd-r7)f{MZc}h0b?=h2');
define('LOGGED_IN_SALT',   'm~A(nx.&s@~qfL[hOe[lmK_E)6tC[:4/nOw8<%4&Z2*bw887-InG<u5>@}bw*8b5');
define('NONCE_SALT',       'Dxiqa}R[g8?So1#M{Z:lOV7/wKjG^DVXy%oPf_J.Iv~u_nEEPeyYLFjPDE1?$8_3');

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
