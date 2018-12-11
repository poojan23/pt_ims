<?php

# Version
define('VERSION', '1.1.0.1');

# Config File
if(is_file('config.php')) {
    include_once 'config.php';
}

# Startup File
require_once DIR_SYSTEM . 'startup.php';

start('template');