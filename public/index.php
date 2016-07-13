<?php

/**
 * Performance and Evaluation Monitoring System
 * POWERED BY MyPHP Framework (github.com/jcultima123/MyPHP)
 *
 * @package REALPAGE PEMS
 * @author REALPAGE
 * @license GNU General Public License 2
 * 
 */

ob_start(); //turn on output buffering

define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

//3rd party assets
define('ASSETS', 'public' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR);
define('BOWER', ASSETS . 'bower' . DIRECTORY_SEPARATOR);

// This will load all libraries and configurations required for this app.
require APP . 'config/loader.php';

$app = new Application(); // APP START
