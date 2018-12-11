<?php
// Site
$_['site_url']             = '';
$_['site_ssl']             = false;

// Url
$_['url_autostart']        = true;

// Language
$_['language_directory']   = 'en';
$_['language_autoload']    = array('en');

// Date
$_['date_timezone']        = 'UTC';

// Database
$_['db_engine']            = 'PDO'; // mpdo, mssql, mysql, mysqli or postgre
$_['db_hostname']          = '127.0.0.1';
$_['db_username']          = 'root';
$_['db_password']          = 'root';
$_['db_database']          = 'pt_inventory';
$_['db_port']              = 3306;
$_['db_autostart']         = false;

// Mail
$_['mail_engine']          = 'mail'; // mail or smtp
$_['mail_from']            = 'donotreply@prismimpex.in'; // Your E-Mail
$_['mail_sender']          = 'Prism Impex'; // Your name or company name
$_['mail_reply_to']        = 'sales@prismimpex.in'; // Reply to E-Mail
$_['mail_smtp_hostname']   = '';
$_['mail_smtp_username']   = '';
$_['mail_smtp_password']   = '';
$_['mail_smtp_port']       = 25;
$_['mail_smtp_timeout']    = 5;
$_['mail_verp']            = false;
$_['mail_parameter']       = '';

// Cache
$_['cache_engine']         = 'file'; // apc, file, mem or memcached
$_['cache_expire']         = 3600;

// Session
$_['session_engine']       = 'db';
$_['session_autostart']    = true;
$_['session_name']         = 'PTSESSID';

// Template
$_['template_engine']      = 'php';
$_['template_directory']   = '';
$_['template_cache']       = false;

// Error
$_['error_display']        = true;
$_['error_log']            = true;
$_['error_filename']       = 'error.log';

// Reponse
$_['response_header']      = array('Content-Type: text/html; charset=utf-8');
$_['response_compression'] = 0;

// Autoload Configs
$_['config_autoload']      = array();

// Autoload Libraries
$_['library_autoload']     = array();

// Autoload Libraries
$_['model_autoload']       = array();

// Actions
$_['action_default']       = 'home/home';
$_['action_router']        = 'startup/router';
$_['action_error']         = 'error/not_found';
$_['action_pre_action']    = array();
$_['action_event']         = array();