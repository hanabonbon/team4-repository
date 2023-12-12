<?php
  namespace task_game;

  class Connection{
    
    private $pdo;
    private $dsn = 'mysql:dbname=task_game;host=localhost';
    private $username = 'webuser';
    private $password = 'abccsd2';
    private $dbname = 'task_game';
    private $hostname = "localhost";


    public function __construct() {
      try{
        $this->pdo = new \PDO($this->dsn, $this->username, $this->password);
      }catch (\PDOException $e){
        print('Error:'.$e->getMessage());
        die();
      }
    }

    public function getPdo(){
      return $this->pdo;
    }

    public function getDsn(){
      return $this->dsn;
    }

    public function getUsername(){
      return $this->username;
    }

    public function getPassword(){
      return $this->password;
    }

    public function getDbname(){
      return $this->dbname;
    }

    public function getHostname(){
      return $this->hostname;
    }
  }
?>
