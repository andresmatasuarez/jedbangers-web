<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

require_once 'config.php';

define('WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST']);
define('WP_HOME'   , 'http://' . $_SERVER['HTTP_HOST']);

if (getenv('ENV') !== 'production'){
  define('WP_DEBUG', true);
  define('WP_DEBUG_LOG', true);
}

$dbUrl = parse_url(Config::$DATABASE_URL);
$dbName      = trim($dbUrl['path'], '/');
$dbUser      = $dbUrl['user'];
$dbPass      = $dbUrl['pass'];
$dbHost      = $dbUrl['host'];
$dbCharset   = 'utf8';
$dbCollate   = '';

define('DB_NAME'     , $dbName);
define('DB_USER'     , $dbUser);
define('DB_PASSWORD' , $dbPass);
define('DB_HOST'     , $dbHost);
define('DB_CHARSET'  , $dbCharset);
define('DB_COLLATE'  , $dbCollate);


/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */

define('AUTH_KEY',         Config::$AUTH_KEY);
define('SECURE_AUTH_KEY',  Config::$SECURE_AUTH_KEY);
define('LOGGED_IN_KEY',    Config::$LOGGED_IN_KEY);
define('NONCE_KEY',        Config::$NONCE_KEY);
define('AUTH_SALT',        Config::$AUTH_SALT);
define('SECURE_AUTH_SALT', Config::$SECURE_AUTH_SALT);
define('LOGGED_IN_SALT',   Config::$LOGGED_IN_SALT);
define('NONCE_SALT',       Config::$NONCE_SALT);

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = Config::$TABLE_PREFIX;

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
