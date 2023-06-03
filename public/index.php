<?php

/////////////////////////////////////////////////////////////////////////////////////////
// For development. Comment these out for production
/////////////////////////////////////////////////////////////////////////////////////////
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$start = microtime(true);



/* Set $privateDirectory equal to the path where you have installed the ragephp/private
 * directory. This path can be anywhere as long as the webserver has permission to
 * read/write/execute. It is advised not to have this directory inside of your public
 * webserver directory for security reasons.
 *****************************************************************************************/
$privateDirectory = __DIR__ . '/..';



/* Require composer dependency autoloader
 *****************************************************************************************/
require $privateDirectory . '/vendor/autoload.php';



/* Bootstrap the application. Tell the Main method that we wish to perform processing of an
 * http request. Pass the $privateDirectory path into our Main class for further usage.
 *****************************************************************************************/
$main = new \Dren\Main($privateDirectory);



//echo '<br/><br/>';
//$end = microtime(true);
//echo $end - $start;

//echo get_include_path();

//require('/home/jason/dev/test.php');

//echo 'made it here';
