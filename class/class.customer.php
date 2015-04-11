<?php

class Customer{

  public $id;
  public $number;
  public $queueID;
  public $token;

    public function __construct($id){
        $db = DB::getInstance();
        foreach($db->query("SELECT * FROM `Customers` WHERE id =".$id) as $row){
            $this->id = $row['id'];
            $this->number = $row['number'];
            $this->queueID = $row['queue_id'];
            $this->token = $row['token'];
        }
    }
    public function create($queueID, $number, $token){
        $db = DB::getInstance();
        $token = md5($token.$number);
        $db->exec("INSERT INTO `Customers`(`number`, `queue_id`, `token`) VALUES($number, $queueID, $token)");
    }
}

?>
