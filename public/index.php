<?php

/////////////////////////////////////////////////////////////////////////////////////////
// For development. Comment these out for production
/////////////////////////////////////////////////////////////////////////////////////////
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$start = microtime(true);


/* Set $privateDirectory equal to the path where you have installed the drencrom/private
 * directory. This path can be anywhere as long as the webserver has correct permissions.
 * Do not put this inside your public webserver directory for security reasons.
 *****************************************************************************************/
$privateDirectory = __DIR__ . '/..';


/* Require composer dependency autoloader
 *****************************************************************************************/
require $privateDirectory . '/vendor/autoload.php';


/* Bootstrap the application. Tell the Main method that we wish to perform processing of an
 * http request. Pass the $privateDirectory path into our Main class for further usage.
 *****************************************************************************************/
\Dren\App::init($privateDirectory);
\Dren\App::get()->execute();



//echo '<br/><br/>';
//$end = microtime(true);
//echo $end - $start;

// force an error for testing as this file does not exist in this directory
//require('/home/jason/dev/test.php');
