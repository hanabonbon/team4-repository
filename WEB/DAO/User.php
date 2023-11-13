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
    
    public function getUserDataByMail($mailaddress) {
      $sql = "SELECT * FROM user WHERE mailaddress = :mailaddress";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':mailaddress', $mailaddress, PDO::PARAM_STR); 
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result; 
    }

    //登録情報変更
    public function updateUserProfile($userData){
      $sql = "UPDATE user
              SET nickname = ?,mailaddress = ?,icon_path = ?
              WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1,$userData['nickname'],PDO::PARAM_STR);
      $ps->bindValue(2,$userData['mailaddress'],PDO::PARAM_STR);
      $ps->bindValue(3,$userData['icon_path'],PDO::PARAM_STR);
      $ps->bindValue(4,$userData['user_id'],PDO::PARAM_INT);
      $ps->execute();
    }

    //user_idでユーザー情報を取得
    public function getUserDataByUserId($user_id){
      $sql = "SELECT * FROM user WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1,$user_id,PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    public function getUserskilpointlByUserId($user_id){
      $sql = "SELECT * FROM user WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $user_id, PDO::PARAM_INT); 
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result['skill_point']; 
    }
  }
?>