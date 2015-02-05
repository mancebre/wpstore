<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'hif_invest');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'ahm671et');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'yx2&I%Bw7+c,hT++oJR?T)fOPbZa*dNr&-v1zLjZi(tWgDpQ,j};?,,Nl?]#+S>m');
define('SECURE_AUTH_KEY',  'T[u}OM(,&dv+29DS}Uv4HIQ,6UsdH>z-f.WpJ}`R{y}gr+b$ 0+%`AWh?K1(^a[`');
define('LOGGED_IN_KEY',    'gREz6-!xEkg+By-6-JJe-x_q6@w)8Nn)r-Tt^+h|/o5!H:J6$rOo9|#t j&5h!W1');
define('NONCE_KEY',        'r~O?IID_0H!~)jb+Ns-Vq(^ ]|vT70)pYze[WZY[aJJ?M,V%9pQ}t7crcIX+cB5a');
define('AUTH_SALT',        '#P%g.ecsc+%XtPeSYD^$oH3Yu->ma`I|6A[~8 = -Q[OJ/%=62<[ Bi048|E*fJT');
define('SECURE_AUTH_SALT', '@sTbE?. h^nJI}=gS?#>#z/J]iGo?QPRU9|0~_{bPYix;2IFSO}zf9LWZ_v5+JFm');
define('LOGGED_IN_SALT',   'HA~X(ulL |`.lFX6mI9%RNcTxEQ&7aw=M=UU69d:3ZRU`?-x:!E{;FtKV?pz$88|');
define('NONCE_SALT',       'q&PNL+>=W/1P6F/J2K]]2O(@8JPISg[hw*Lb/{#2/_b07_XZ_VP9..{LNCs%-_Yn');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
