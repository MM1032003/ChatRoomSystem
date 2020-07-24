<?php 
    /*
     * PDO Database Class
     * Connect To Database
     * Create Prepared Statments
     * bind Values
     * Return Rows & Results
     */ 
class Database {
    private $host   = DB_HOST,
            $user   = DB_USER,
            $dbname = DB_NAME,
            $pass   = DB_PASS,
            $dbcon, $stmt, $err;

    public function __construct() {
        $dsn    = "mysql:host=$this->host;dbname=$this->dbname";
        $options= array(
            PDO::ATTR_PERSISTENT => TRUE,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->dbcon  = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (PDOException $e) {
            $this->err  =  $e->getMessage();
            echo $this->err;
        }

    }
    public function query($sql) {
        $this->stmt = $this->dbcon->prepare($sql);
    }
    public function bindParams($param, $value, $type = NULL) {
        $this->stmt->bindParam($param, $value);
    }
    public function bindVal($param, $value, $type = NULL) {
        switch(true) {
            case is_int($type):
                $type   = PDO::PARAM_INT;
                break;
            case is_bool($type):
                $type   = PDO::PARAM_BOOL;                
            break;
            case is_null($type):
                $type   = PDO::PARAM_NULL;
                break;
            default:
                $type   = PDO::PARAM_STR;
                break;
        }
        $this->stmt->bindValue($param, $value, $type);
    }
    // Execute Prepared Statmetn
    public function execute() {
        return  $this->stmt->execute();
    }
    public function fetchObj() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function fetch() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    // Get Single Record
    public function single() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }
    public function rowCount() {
        $this->execute();
        return $this->stmt->rowCount();
    }
}

?>