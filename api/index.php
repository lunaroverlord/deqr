<?php
spl_autoload_register(function ($class) {
    $class = strtolower($class);
    include_once('../class/class.' . $class . '.php');
});

$action = isset($_GET['action'])?$_GET['action']:"";

if($action == "createNewQueue"){
	$name = isset($_GET['name'])?$_GET['name']:"";
	$estimatedTime = isset($_GET['time'])?$_GET['time']:5;
	$queueID = Queue::create($name, $estimatedTime);
	$queue = new Queue($queueID);

	$data = array();
	$data['id'] = $queueID;
	echo json_encode($data);
}
elseif ($action=="deleteQueue") {
	$id = isset($_GET['id'])?$_GET['id']:"";
	$queue = new Queue($id);
	$queue->delete();
}
elseif($action=="createNewCustomer"){
	$id = isset($_GET['id'])?$_GET['id']:"";
	$queue = new Queue($id);
	$number = $queue->nextCustomer();
	
	$customerID = Customer::create($id, $number);
	$data = array();
	$data['id'] = $customerID;
	echo json_encode($data);
}
elseif($action=="checkCustomer"){
	$id = isset($_GET['id'])?$_GET['id']:"";
	$customer = new Customer($id);
	$queueid = $customer->getQueueID();
	$queue = new Queue($queueid);
	$data = array();
	if($queue->getCurrentNumber()==$customer->getNumber()){
		$queue->getToNextCustomer();
		$data['result']=true;
	}else{
		$data['result']=false;
	}
	echo json_encode($data);
}
elseif($action=="getStatus"){
	$id = isset($_GET['id'])?$_GET['id']:"";
	$customer = new Customer($id);
	$queueid = $customer->getQueueID();
	$queue = new Queue($queueid);
	$data = array();
	$data['currentNumber'] = $queue->getCurrentNumber();
	if($data['currentNumber']==0){
		$data['currentNumber']=1;
	}
	$data['customerNumber'] = $customer->getNumber();
	$data['lastPersonNumber'] = $queue->getLastCustomerNumber();
	$data['queueName'] = $queue->name;
	$data['estimatedTime'] = $queue->estimated_service_time*($customer->getNumber() - $queue->getCurrentNumber());
	echo json_encode($data);
}
?>

