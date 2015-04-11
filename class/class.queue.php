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
  public $token;


  public function __construct($id){
    $db = DB::getInstance();
    foreach($db->query("SELECT * FROM Queues WHERE id =".$id) as $row){
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->estimated_service_time = $row['estimated_service_time'];
        $this->current_number = $row['current_number'];
        $this->token = $row['token'];
    }
  }

  public static function create($name, $estimated_service_time){
    $db = DB::getInstance();
    $timeRightNow = time();
    $token = md5($name.$estimated_service_time.$timeRightNow);
    $stmt = $db->prepare("INSERT INTO Queues(`name`, `estimated_service_time`,`current_number`, `token`) VALUES(?, ?, 1, ?)");
    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $estimated_service_time);
    $stmt->bindParam(3, $token);
    $stmt->execute();
    return $db->lastInsertId();
  }

  public function setMyCookie(){
    setcookie($this->name, $this->token, time() + (86400 * 30), "/");
  }





  public function nextCustomer(){
    $db = DB::getInstance();
    $current_number = $current_number + 1;
    $db->exec("UPDATE `Queues` SET `current_number` = $current_number");
  }

  public function checkCurrentPerson(){

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