<?php

date_default_timezone_set('Europe/London');
error_reporting(E_ALL);
spl_autoload_register(function ($class) {
    $class = strtolower($class);
    include_once('../class/class.' . $class . '.php');
});

$action = isset($_GET['action'])?$_GET['action']:"";
$action = isset($_GET['token'])?$_GET['token']:"";

if($action == "createNewQueue"){
	$name = isset($_GET['name'])?$_GET['name']:"";
	$estimatedTime = isset($_GET['time'])?$_GET['time']:5;
	$queueID = Queue::createNewQueue($name, $estimatedTime);
	$queue = new Queue($queueID);
	$queue->setMyCookie();
}



?>