<?php
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
  //自分のランク順位
  public function selectMyRanking($user_id){
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
}
?>