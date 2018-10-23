<?php
define("DB","sportnews");
define("DBHOST","localhost");
define("DBUSER","root");
define("DBPASS","");
define("APP_DIR","C:/wamp64/www/assignment3_oop/");
function __autoload($class){                               // autoload sistem
	require_once APP_DIR . "classes/".$class.".php";
}