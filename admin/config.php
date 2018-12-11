<?php

# Error reporting
error_reporting(E_ALL);

// Check if SSL
if ((isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) || $_SERVER['SERVER_PORT'] == 443) {
	$protocol = 'https://';
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	$protocol = 'https://';
} else {
	$protocol = 'http://';
}

# URL ROOT
define('HTTP_SERVER', $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/');

# URL MAIN ROOT
define('HTTP_CATALOG', $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname(dirname($_SERVER['SCRIPT_NAME'])), '/.\\') . '/');
//define('HTTP_CATALOG', 'http://localhost/popaya_framework/');

# STARTING YEAR
define('YEAR', '2018');


# DIRECTORY SEPARATOR
define('DS', DIRECTORY_SEPARATOR);

# ROOT DIR
define('DIR_ROOT', realpath(dirname(dirname(__FILE__))) . DS);

# DIR
define('DIR_APPLICATION', DIR_ROOT . 'admin' . DS);
define('DIR_SYSTEM', DIR_ROOT . 'system' . DS);
define('DIR_IMAGE', DIR_ROOT . 'image' . DS);
define('DIR_STORAGE', DIR_SYSTEM . 'storage' . DS);
define('DIR_CATALOG', DIR_ROOT . 'template' . DS);
define('DIR_LANGUAGE', DIR_APPLICATION . 'language' . DS);
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/html' . DS);
define('DIR_CONFIG', DIR_SYSTEM . 'config' . DS);
define('DIR_CACHE', DIR_STORAGE . 'cache' . DS);
define('DIR_DOWNLOAD', DIR_STORAGE . 'download' . DS);
define('DIR_LOGS', DIR_STORAGE . 'logs' . DS);
define('DIR_MODIFICATION', DIR_STORAGE . 'modification' . DS);
//define('DIR_SESSION', DIR_STORAGE . 'session/');
//define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

# DATABSE CONNECTION
define('DB_DRIVER', 'PDO');
define('DB_HOST', '127.0.0.1');
define('DB_USER', 'root');
define('DB_PASS', 'root');
define('DB_NAME', 'pt_inventory');
define('DB_PORT', '3306');
define('DB_PREFIX', 'pt_');

# GODADDY DATABSE CONNECTION
/*define('DB_DRIVER', 'pdo');
define('DB_HOST', 'procomdb.db.9510973.b5b.hostedresource.net');
define('DB_USER', 'procomdb');
define('DB_PASS', 'Popaya@123');
define('DB_NAME', 'procomdb');
define('DB_PORT', '3306');
define('DB_PREFIX', 'pt_');*/