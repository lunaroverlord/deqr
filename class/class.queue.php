<?php
error_reporting(E_ALL);
spl_autoload_register(function ($class) {
    $class = strtolower($class);
    include_once('class.' . $class . '.php');
});
class Queue{

  public $id;
  public $name;
  public $estimated_service_time;
  public $current_number;
  public $last_customer_number;
  public $token;


  public function __construct($id){
    $db = DB::getInstance();
    foreach($db->query("SELECT * FROM `queues` WHERE id =".$id) as $row){
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->estimated_service_time = $row['estimated_service_time'];
        $this->current_number = $row['current_number'];
        $this->token = $row['token'];
        $this->last_customer_number = $row['last_customer_number'];

    }
  }

  public static function create($name, $estimated_service_time){
	  $mysqli = new mysqli("localhost", "root", "", "qr");
	  /*
    $db = DB::getInstance();
	   */
    $timeRightNow = time();
    $token = md5($name.$estimated_service_time.$timeRightNow);
    $stmt = $mysqli->query("INSERT INTO queues(`name`, `estimated_service_time`,`current_number`,`last_customer_number`, `token`) VALUES('$name', '$estimated_service_time', 1, 1, '$token')");
    /*
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $estimated_service_time);
    $stmt->bindParam(3, $token);
    $stmt->execute();
     */
    return $mysqli->insert_id;
  }

  public function setMyCookie(){
    setcookie($this->name, $this->token, time() + (86400 * 30), "/");
  }

  public function delete(){
    $db = DB::getInstance();
    $id = $this->id;
    $db->exec("DELETE FROM `Queues` WHERE `id` = $id");
  }

  public function checkToken($token){
    return ($this->token==$token)?true:false;
  }

  public function nextCustomer(){
    $db = DB::getInstance();
    $this->last_customer_number = $this->last_customer_number + 1;
    $db->exec("UPDATE `Queues` SET `last_customer_number` = ".$this->last_customer_number." WHERE id = ".$this->id);
  }

  public function getToNextCustomer(){
     $db = DB::getInstance();
    $this->current_number = $this->current_number + 1;
    $db->exec("UPDATE `Queues` SET `current_number` = $current_number WHERE id = ".$this->id);
  }

  public function getID(){
    return $this->id;
  }
  public function getName(){
    return $this->name;
  }
  public function getEstimated_service_time(){
    return $this->estimated_service_time;
  }
  public function getCurrent_number(){
    return $this->current_number;
  }
  public function getToken(){
    return $this->token;
  }

}
?>
