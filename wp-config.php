<?php
ob_start();
session_start();
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
define('DB_NAME', 'desihomerl259');

/** MySQL database username */
define('DB_USER', 'desihomerl259');

/** MySQL database password */
define('DB_PASSWORD', 'Desihomes123');

/** MySQL hostname */
define('DB_HOST', 'desihomerl259.mysql.db');

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
define('AUTH_KEY',         '=b{H*</Q_v2@J0!pCg|hew{8w4;FOg3hQtXMf@ y[ELXONg:~O/74y(EUst;pW/,');
define('SECURE_AUTH_KEY',  '[z*-qiW>Z@cq@r 82!1XeXWhTW?NNR[hAJ1;c=(aq@Aq3S5;Rw=8,hbU;k[1<SLx');
define('LOGGED_IN_KEY',    'SXe_.~[RSG[*x$.H?-gw6]a:E#<orjl,D;qITwL#I0q>UB=CMXYIDa`UTcj2S,2l');
define('NONCE_KEY',        'o0~i,7^+S.F>mN!xjGR5l)vbw_MFa62Y@!6aK.4GlQ,z;_}2_U ,E~~@MX,rI5W(');
define('AUTH_SALT',        '~2CFS`Vg9r8(>G+Wo=Ei0%H$fAzwD$>EhO>;W=VwyC*!L*F<X{Vqd2[_mc2en9,^');
define('SECURE_AUTH_SALT', '&9= ,^<+D(f&+x!8qt.n_D- ->_1CWw#4GfL.FgB{vh*LG|hmRwh]B+*In&15_tX');
define('LOGGED_IN_SALT',   'c7Gce{x]PM`]$jg$vsWERTO W56v@w/yeVR_cEfUOzXO8_f|y.$MR]!oE]dj&]ag');
define('NONCE_SALT',       'fMK9AR,J?)sB*I/Pv6B5#?Lj.BEyp}mI?iEVIXUM[i9@i769G4,|w|h<B9o&QL2S');
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
$url = 'https://desihomes.co.uk/';
define ('SITEURL',$url);
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
 define('ABSPATH', dirname(__FILE__) . '/');
//$url = 'http://'.($_SERVER['SERVER_NAME']==='localhost')?'localhost/listingwebsite':$_SERV‌​ER['SERVER_NAME']; 
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');