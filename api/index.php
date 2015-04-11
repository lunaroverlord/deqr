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
	echo "creating queue";
	$name = isset($_GET['name'])?$_GET['name']:"";
	$estimatedTime = isset($_GET['time'])?$_GET['time']:5;
	$queueID = Queue::createNewQueue($name, $estimatedTime);
	echo $queueID;
	$queue = new Queue($queueID);
	$data = array();
	$data['id'] = $queue->getID();
	$data['token'] = $queue->getToken();
	echo json_encode($data);
}
elseif ($action=="deleteQueue") {
	$id = isset($_GET['id'])?$_GET['id']:"";
	$queue = new Queue($id);
	$queue->delete();
}
elseif($action=="createNewCustomer"){
	$id = isset($_GET['id'])?$_GET['id']:"";
	$token = isset($_GET['token'])?$_GET['token']:"";
	$queue = new Queue($id);
	if($queue->checkToken()){
		$customer = new Customer($id, $token);
	}
}




?>
