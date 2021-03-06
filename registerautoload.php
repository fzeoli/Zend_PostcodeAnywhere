<?php
/**
 *	This is used in the Testing and Validation phase of the mvn test
**/

define('APPLICATION_PATH', 		realpath(dirname(__FILE__)).'/src/main/php/Lookup/PostcodeAnywhere');
define('TEST_PATH',				realpath(dirname(__FILE__)).'/src/test/php/Lookup/PostcodeAnywhere/');
$paths = array(	get_include_path(),
				APPLICATION_PATH,
				realpath(dirname(__FILE__)).'/src/main/php',
				realpath(dirname(__FILE__)).'/target/phpinc',
				'.');
set_include_path(implode(PATH_SEPARATOR, $paths));

require_once 'environments.php';
defined('APPLICATION_ENV')		or define('APPLICATION_ENV', 	ENVIRONMENT_UNIT_TEST);

require_once "Zend/Loader/Autoloader.php";
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->registerNamespace('PHPUnit_');
$autoloader->registerNamespace('Zend_');
$autoloader->registerNamespace('Lookup_Lookup_PostcodeAnywhere_');


