<?php
include_once('constants.php');
class database {
    private $RDBMType = DB_TYPE;  //In the PHP PDO format
    private $username = DB_USER;
    private $password = DB_PASS;
    private $dbhost = DB_HOST;
    private $database =DB_DATABASE;
  public $LastInsertId=0;

    function __construct() {
        //Connection string
   	$this->pdo = new PDO($this->RDBMType . ":host=" . $this->dbhost . ";dbname=" . $this->database, $this->username,
   	$this->password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"));
     }
     public function Disconnect(){
            $this->pdo = null;
            $this->isConnected = false;
        }
      public function getRow($query, $params=array())
     	   {
                $stmt = $this->pdo->prepare($query);
                $stmt->execute($params);
                return $stmt->fetch();
           }
      	public function getRows($query, $params=array()){
      	        $stmt = $this->pdo->prepare($query);
                $stmt->execute($params);
                return $stmt->fetchAll();
            }
        public function insertRow($query, $params=array()){
                $stmt = $this->pdo->prepare($query);
                $stmt->execute($params);
                return $stmt->rowCount();
              //  return  pdo->lastInsertId();
              }

        public function updateRow($query, $params=array()){
            return $this->insertRow($query, $params);
        }
}
$db = new database;
?>

