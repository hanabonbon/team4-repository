<?php
  class User {
    private $pdo;
    
    public function __construct() {
      require_once('connection.php');
      $connection = new Connection();
      $this->pdo = $connection->getPdo();
    }
    
    public function registUser($userData) {
      $sql = "INSERT INTO user (nickname, mailaddress, password) 
              VALUES (?, ?, ?)";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $userData['nickname'], PDO::PARAM_STR);
      $ps->bindValue(2, $userData['mailaddress'], PDO::PARAM_STR);
      $ps->bindValue(3, password_hash($userData['password'], PASSWORD_DEFAULT), 
        PDO::PARAM_STR);
      $ps->execute();
    }

    public function getUserName($user_id) {
      $sql = "SELECT * FROM user WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $user_id, PDO::PARAM_INT); 
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result['username']; 
    }
    // public function insertUser() {
    //   $sql = "INSERT INTO user (nickname, mailaddress, password) VALUES (?, ?, ?)";
    //   $ps = $this->pdo->prepare($sql);
    //   $ps->bindValue(1, $_POST['nickname'], PDO::PARAM_STR);
    //   $ps->bindValue(2, $_POST['mailaddress'], PDO::PARAM_STR);
    //   $ps->bindValue(3, $_POST['password'], PDO::PARAM_STR);
    //   $ps->execute();
    // }
  }
?>