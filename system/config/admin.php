<?php
// Site
$_['site_url']          = HTTP_SERVER;
$_['site_ssl']          = HTTP_SERVER;

// Database
$_['db_autostart']      = true;
$_['db_engine']         = DB_DRIVER; // mpdo, mssql, mysql, mysqli or postgre
$_['db_hostname']       = DB_HOST;
$_['db_username']       = DB_USER;
$_['db_password']       = DB_PASS;
$_['db_database']       = DB_NAME;
$_['db_port']           = DB_PORT;

// Session
$_['session_autostart'] = true;

// Template
$_['template_cache']    = true;

// Actions
$_['action_pre_action'] = array(
	'startup/startup',
	'startup/error',
	'startup/event',
	'startup/login',
	'startup/permission'
);

// Actions
$_['action_default'] = 'home/dashboard';

// Action Events
$_['action_event'] = array(
	'controller/*/before' => array(
		'event/language/before'
	),
	'controller/*/after' => array(
		'event/language/after'
	),
	'view/*/before' => array(
		999  => 'event/language',
		1000 => 'event/theme'
	),
	'view/*/before' => array(
		'event/language'
	)
);
