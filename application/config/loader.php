<?php

/*
 * APP LOADER
 */

// The Composer auto-loader (official way to load Composer contents) to load external stuff automatically
$lib = '../vendor' . '/autoload.php';
$config = 'config.php';
if (file_exists($lib)) {
    require $lib;
    if (!file_exists($config)) {
        $ERROR = "File " . $config . " might be corrupted or missing.<br />Create a copy with config.php.example. ";
        require_once '_fb/error.html';
        exit;
    }
    $browser = new Browser();
} else {
    $ERROR = "The COMPOSER file " . $lib . " might be corrupted or missing.";
    require_once '_fb/error.html';
    exit;
}

// BOWER ASSETS
$bower = realpath('../' . BOWER);
// If it exist, check if it's a directory
if($bower == false AND !is_dir($bower)) {
    // Path/folder does not exist
    $ERROR = "The BOWER directory does not exist. Should be like this: " . BOWER . "<br />Make sure you must install bower using your command shell<br /><br /><code>$ bower install</code><br /><br />";
    require_once '_fb/error.html';
    exit;
}

// load application config (error reporting etc.)
require APP . 'config/init.php';

// load external libraries/classes. have a look all the files in that directory for details.
foreach (glob(APP . 'libs/*.php') as $files) { require $files; }

// load application class
require APP . 'core/application.php';
require APP . 'core/controller.php';
