<?php
  namespace task_game;
  use PDO;
  class Test {
    private $pdo;
    
    public function __construct() {
      require_once('connection.php');
      $connection = new Connection();
      $this->pdo = $connection->getPdo();
    }

  //ランク順位
  public function selectAllRanking(){
    $sql = "SELECT * FROM user ORDER BY rank_point DESC";
    $ps = $this->pdo->prepare($sql);
    $ps->execute();
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);

    return $result;
  }
  //自分のランク順位 使わない関数
  public function selectMyRanking1($user_id){
    $sql = "SELECT user_id, rank_point,
          (SELECT COUNT(DISTINCT rank_point) FROM user WHERE rank_point > u.rank_point) + 1 AS rank
          FROM user u
          WHERE user_id = :user_id";
    $ps = $this->pdo->prepare($sql);
    $ps->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $ps->execute();
    $result = $ps->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['rank'];
    } else {
        echo "User not found or an error occurred.";
    }
  }
  public function getSpByUserId($user_id){
    $sql = "SELECT skill_point FROM user WHERE user_id = ?";
    $ps = $this->pdo->prepare($sql);
    $ps->bindValue(1, $user_id, PDO::PARAM_INT);
    $ps->execute();
    $result = $ps->fetch(PDO::FETCH_ASSOC);

    return $result;
  }

  //スキルポイント加算
  public function updateSkillPoint($sp, $user_id){
    $sql = "UPDATE user SET skill_point = ? WHERE user_id = ?";
    $ps = $this->pdo->prepare($sql);
    $ps->bindValue(1, $sp, PDO::PARAM_INT);
    $ps->bindValue(2, $user_id, PDO::PARAM_INT);
    $ps->execute();
  }

  // 自分のランク順位 修正版
  public function selectMyRanking($user_id){
    $sql = "SELECT user_id, rank_point,
        (SELECT COUNT(*) FROM user WHERE rank_point > u.rank_point OR (rank_point = u.rank_point AND user_id < u.user_id)) + 1 AS rank
        FROM user u
        WHERE user_id = :user_id";
    $ps = $this->pdo->prepare($sql);
    $ps->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $ps->execute();
    $result = $ps->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo $result['rank'];
    } else {
        echo "User not found or an error occurred.";
    }
}
  //対戦記録対戦相手取得
  public function getBattlerecordByUserId($user_id){
    $sql = "SELECT m.match_id,m.user_is_win,m.enemy_user_id,m.user_id,u.user_id,u.nickname,u.icon_path
    FROM match_record m INNER JOIN user u
    ON m.enemy_user_id=u.user_id
    WHERE m.user_id=?
    ORDER BY m.match_id desc";
    $ps = $this->pdo->prepare($sql);
    $ps->bindValue(1,$user_id,PDO::PARAM_INT);
    $ps->execute();
    $result = $ps->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  //通算試合数カウント
  public function gettotalbattle($user_id) {
    $sql = "SELECT COUNT(*) FROM match_record
    WHERE user_id = ?";
    $ps = $this->pdo->prepare($sql);
    $ps->bindValue(1, $user_id, PDO::PARAM_INT);
    $ps->execute();
    $result = $ps->fetch(PDO::FETCH_ASSOC);
    return $result['COUNT(*)'];
  }                          

  //対戦記録勝敗カウント
  public function getcountbattleresult($user_id,$battle_result) {
      $sql = "SELECT COUNT(*) FROM match_record
      WHERE user_id = ? AND user_is_win= ?";
      $ps = $this->pdo->prepare($sql);
      $ps->bindValue(1, $user_id, PDO::PARAM_INT);
      $ps->bindValue(2, $battle_result, PDO::PARAM_INT);
      $ps->execute();
      $result = $ps->fetch(PDO::FETCH_ASSOC);
      return $result['COUNT(*)'];
  }
  
  //対戦記録登録
  public function insertMatchRecord($n,$opponentId,$playerId){
    $sql = "INSERT INTO match_record (user_is_win, enemy_user_id, user_id) VALUES (?, ?, ?)";
    $ps = $this->pdo->prepare($sql);
    $ps->bindValue(1, $n, PDO::PARAM_INT);
    $ps->bindValue(2, $opponentId, PDO::PARAM_INT);
    $ps->bindValue(3, $playerId, PDO::PARAM_INT);
    $ps->execute();
    

  }
}
?>