<?php
class database {
    private $host = 'localhost';
    private $db = '';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    private $pdo;

    public function connect(){
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        try{
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }catch(PDOException $e){
            echo'Connection Failed: ' . $e->getMessage();
        }
    }

}
?>