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
}

?>