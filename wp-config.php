<?php
/***
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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wpstagea_devtest' );

/** MySQL database username */
define( 'DB_USER', 'wpstagea_super' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Welcome@789A' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'eg_ TEwpdEK[RB>/K[P~;}coJsEU/:s_C[+ur%i2MNY9hz6 _p6{y.%!++<:WJV-' );
define( 'SECURE_AUTH_KEY',  'x4^T~`d~iC^zkL?>qW7EUgcAWw=V3U -Xd*`.?6<dNP.LMb(b7J@0w!80J0?z>-h' );
define( 'LOGGED_IN_KEY',    '[g!iar:$$w4T`x+X@ji:f7dNc}pF++b|<Z-VdOcL<v~M!cX4F`X&f>/cM0:W7D*2' );
define( 'NONCE_KEY',        'fYQT_;{froU~~_1Fq]}UM!/SG@iH/]q6|kOq|84BPO;k>_%T<fm5@s.5>lqHH8z3' );
define( 'AUTH_SALT',        'eXwrPstt;^3F/%-h50<G|v<dIj)jWOF7/GX?u-n&0{{4.*Z04Q_3Qu,HXQ-a6@ 4' );
define( 'SECURE_AUTH_SALT', 'bOwd)>^cqD5Z [U|D[3]<@P%ilB 0$$S S|MuhbJnr#]IQzbpK4Kicg}gJ{@%CSH' );
define( 'LOGGED_IN_SALT',   '-v;L_U].cd<LYdijTOFowb|(z; Vi$,Fj`s5bA7G <]Njq+=rg1^,GsBLPSp@YIe' );
define( 'NONCE_SALT',       ']:#$JLw rf>t>M=021/HYH[H7XZRIni`.s.I+9xWX$>O%uWu1O)):s8C5ROn-oTH' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
