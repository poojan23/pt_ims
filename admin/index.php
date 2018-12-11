<?php

# Version
define('VERSION', '2.0.1.0');

# Config
if(is_file('config.php')) {
    include_once 'config.php';
}

# Startup File
require_once DIR_SYSTEM . 'startup.php';

start('admin');