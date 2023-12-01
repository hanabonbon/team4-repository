<?php 
  class BattleController {
    private $player;
    private $playerId;
    private $opponent;
    private $opponentId;

    public function __construct($playerId, $opponentId) {
      //必要なクラスをインスタンス化
      require_once('../game/player.php');
      require_once('../DAO/GameUser.php');
      $gameUser = new GameUser();

      //自分
      $this->$playerId = $playerId;
      $userStatusLv = $gameUser->fetchUserStatusLv($playerId);
      //プレイヤーインスタンス
      $this->player = new Player($userStatusLv);

      //相手
      $this->opponentId = $opponentId;
      $opponentStatusLv = $gameUser->fetchUserStatusLv($opponentId);
      //相手インスタンス
      $this->opponent = new Player($opponentStatusLv);
    }

    //ターンの管理
    
    public function attack($targetId) {
      switch ($targetId) {
        case $this->opponentId:
          $this->opponent->decreaseHP($this->player->getAttack());
          break;

        case $this->playerId:
          $this->player->decreaseHP($this->opponent->getAttack());
          break;

        default:
          # code...
          break;
      }
    }

    public function getHP() {
      return $this->player->getHitPoint();
    }


    


  }
?>