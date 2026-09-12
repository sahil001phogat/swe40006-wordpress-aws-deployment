<?php
/**
 * The base configuration for WordPress
 *
 * REDACTED TEMPLATE — for SWE40006 Deployment Portfolio Task 3 submission.
 * All credentials, hostnames, and secret keys below are placeholders.
 * Replace with your own values when deploying; do not commit real secrets.
 *
 * @package WordPress
 */

// ** Database settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpressdb' );

/** Database username */
define( 'DB_USER', 'YOUR_DB_USER_HERE' );

/** Database password */
define( 'DB_PASSWORD', 'YOUR_DB_PASSWORD_HERE' );

/** Database hostname (Amazon RDS endpoint) */
define( 'DB_HOST', 'YOUR_RDS_ENDPOINT_HERE.ap-southeast-2.rds.amazonaws.com:3306' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. */
define( 'DB_COLLATE', '' );

/**
 * Authentication unique keys and salts.
 * Generate your own at https://api.wordpress.org/secret-key/1.1/salt/
 * Do NOT reuse the placeholders below in a real deployment.
 */
define( 'AUTH_KEY',         'REPLACE_WITH_YOUR_OWN_UNIQUE_KEY' );
define( 'SECURE_AUTH_KEY',  'REPLACE_WITH_YOUR_OWN_UNIQUE_KEY' );
define( 'LOGGED_IN_KEY',    'REPLACE_WITH_YOUR_OWN_UNIQUE_KEY' );
define( 'NONCE_KEY',        'REPLACE_WITH_YOUR_OWN_UNIQUE_KEY' );
define( 'AUTH_SALT',        'REPLACE_WITH_YOUR_OWN_UNIQUE_KEY' );
define( 'SECURE_AUTH_SALT', 'REPLACE_WITH_YOUR_OWN_UNIQUE_KEY' );
define( 'LOGGED_IN_SALT',   'REPLACE_WITH_YOUR_OWN_UNIQUE_KEY' );
define( 'NONCE_SALT',       'REPLACE_WITH_YOUR_OWN_UNIQUE_KEY' );

/**
 * WordPress database table prefix.
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 */
define( 'WP_DEBUG', false );

/* Custom values: enforce TLS/SSL connection to Amazon RDS */
define( 'MYSQL_SSL_CA', '/var/www/html/ap-southeast-2-bundle.pem' );
define( 'MYSQL_CLIENT_FLAGS', MYSQLI_CLIENT_SSL );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
