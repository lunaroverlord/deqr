<?php

class Customer{

  public $id;
  public $number;
  public $queue_id;
  public $token;

    public function __construct($id){
        $db = DB::getInstance();
        foreach($db->query("SELECT * FROM `Customers` WHERE id =".$id) as $row){
        $this->id = $row['id'];
        $this->number = $row['number'];
        $this->queue_id = $row['queue_id'];
        $this->token = $row['token'];
    }
    }



}

?>
