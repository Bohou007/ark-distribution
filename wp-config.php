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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ark007');

/** Database username */
define('DB_USER', 'root');

/** Database password */
define('DB_PASSWORD', 'Scaleway@12345');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'uD?k8|/:*W:UA&$W<}5aRYCPSPU0rkGr,<LQB0SmTMyd?8.*<b& BAeA*/OJz3h:');
define('SECURE_AUTH_KEY',  '*+R`B[zo2+jR)61&c4cww%|%9z,fOoY)EFP63lj~YLhs}iS3)o5,ZC,RC*dt=uoB');
define('LOGGED_IN_KEY',    'I5>5&pfRGo;@E2Q?`SkDV&F-Y6e?RL}~<{@!6E!G8rU6f^bS+aGpA/oYF#@c[z,x');
define('NONCE_KEY',        ',RRp45J_!,zzY*mpDAm}$d790jH~+;]Cr:2:;QK}lcpv:wINh`OK!5oULYH-,1Jc');
define('AUTH_SALT',        'L#(4]m87WJrB:-4kczKd+1-6I6B}iO)RQ]g&,IuA%L&}bG@Sx|Fq$r.$o+~NOAtS');
define('SECURE_AUTH_SALT', 'pkO2tzqo6-n(|!-NZ_+rGdX}RY=nel82D]9R;p1.pB 6y!KGP{?x>K<<=#IKdj03');
define('LOGGED_IN_SALT',   'L*S:TuoS(U|f_FExpzw [2icm(aDXKF0!1/s&1JK.rI?`^L=@:Q[Nc)(QysBsvor');
define('NONCE_SALT',       '17Y]F5@Ams`h3jIt^ `3 sItsQnF&C_yIn5tA<bvx}ArZvRoxh`q.C%!=s1c;Jj4');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';