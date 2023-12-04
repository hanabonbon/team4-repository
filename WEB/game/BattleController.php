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

    //ターンの管理
    
    public function attack($targetId) {
      switch ($targetId) {
        case $this->opponentId:
          $this->opponent->decreaseHP($this->player->getAttack());
          echo '相手に攻撃を与えた';
          break;

        case $this->playerId:
          $this->player->decreaseHP($this->opponent->getAttack());
          echo 'あなたは攻撃を受けた';
          break;

        default:
          # code...
          echo "targetId:$targetId,  opponentId:$this->opponentId, playerId:$this->playerId";
          break;
      }
    }

    public function getHP() {
      return $this->player->getHitPoint();
    }


    


  }
?>