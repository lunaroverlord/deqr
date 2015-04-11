public class Queue{

  public $id;
  public $name;
  public $estimated_service_time;
  public $current_number;
  public $token;


  public __construct($id){
    $db = DB::getInstance();
    foreach($db->query("SELECT * FROM Queues WHERE id =".$id) as $row){
        $this->id = $row['id'];
        $this->name = $row['name'];
        $this->estimated_service_time = $row['estimated_service_time'];
        $this->current_number = $row['current_number'];
        $this->token = $row['token'];
    }
  }

}
