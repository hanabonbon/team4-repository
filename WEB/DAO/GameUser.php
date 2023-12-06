<?php
  namespace task_game;
  use \PDO;
  class GameUser{
    private $pdo;
    
    public function __construct() {
      require_once('Connection.php');
      $connection = new Connection();
      $this->pdo = $connection->getPdo();
    }

    public function getUserName($user_id) {
      $sql = "SELECT * FROM v_game_user WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $user_id, PDO::PARAM_INT); 
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result['nickname']; 
    }

    //ログイン中のユーザーを除いた上位ユーザーを取得
    public function fetchTopPlayer($currentUser, $limit = 10) {
      $sql = "SELECT * FROM v_game_user WHERE NOT user_id = :currentUser ORDER BY level DESC LIMIT :limit";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(':limit', $limit, PDO::PARAM_INT);
      $ps->bindValue(':currentUser', $currentUser, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetchAll(PDO::FETCH_ASSOC);
      return $result;
    }

    public function findOnePlayerData($user_id) {
      $sql = "SELECT * FROM v_game_user WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $user_id, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result;
    }

    public function fetchUserStatusLv($user_id) {
      $sql = "SELECT user_id, hitpoint, attack, defence, agility, luck FROM v_game_user WHERE user_id = ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $user_id, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result;
    }
  }
?>