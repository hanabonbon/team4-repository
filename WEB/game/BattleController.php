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
      $this->playerId = $playerId;
      $userStatusLv = $gameUser->fetchUserStatusLv($playerId);
      //プレイヤーインスタンス
      $this->player = new Player($userStatusLv);

      //相手
      $this->opponentId = $opponentId;
      $opponentStatusLv = $gameUser->fetchUserStatusLv($opponentId);
      //相手インスタンス
      $this->opponent = new Player($opponentStatusLv);
      
      echo "コンストラクタ opponentId:$this->opponentId, playerId:$this->playerId";

    }

    public function getPlayer() {
      return $this->player;
    }

    public function getOpponent() {
      return $this->opponent;
    }

    public function setPlayer(Player $player) {
      $this->player = $player;
    }

    public function setOpponent(Player $opponent) {
      $this->opponent = $opponent;
    }

    public function getPlayerId() {
      return $this->playerId;
    }

    public function getOpponentId() {
      return $this->opponentId;
    }

    //ターンの管理
    
    public function attack($targetId) {
      switch ($targetId) {
        case $this->opponentId:
          //相手に攻撃
          $this->opponent->decreaseHP($this->player->getATK());
          break;

        case $this->playerId:
          $this->player->decreaseHP($this->opponent->getATK());
          break;

        default:
          # code...
          break;
      }
    }
    


  }
?>