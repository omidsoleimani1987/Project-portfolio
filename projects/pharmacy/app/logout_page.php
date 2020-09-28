<?php
session_start();
/**
 * class auto loader:
 */
require $_SERVER["DOCUMENT_ROOT"].'/projects/pharmacy/includes/autoloader.inc.php';

/**
 * config:
 */
require $_SERVER["DOCUMENT_ROOT"].'/projects/pharmacy/includes/config.inc.php';

/**
 * logout function from config file:
 */
logout();