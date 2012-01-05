<?php
$rootPath = realpath(dirname(__FILE__));

if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', $rootPath . '/../application');
}

if (!defined('APPLICATION_ENV')) {
    define('APPLICATION_ENV', 'testing');
}

set_include_path(implode(PATH_SEPARATOR, array(
    '.',
    $rootPath . '/library',
    $rootPath . '/../library',
    get_include_path()
)));

require_once 'Zend/Loader/Autoloader.php';
$loader = Zend_Loader_Autoloader::getInstance();
// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);
$application->bootstrap();
Zend_Session::$_unitTestEnabled = true;
clearstatcache();
