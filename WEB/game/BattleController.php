<?php 
  namespace task_game;
  use task_game\EnumActionState;
  class BattleController {
    private Player $player;
    private $playerId;
    private Player $opponent;
    private $opponentId;
    private Bool $isControllable;

    public function __construct($playerId, $opponentId) {
      //必要なクラスをインスタンス化
      require_once('../game/player.php');
      require_once('../DAO/GameUser.php');
      require_once('../game/EnumActionState.php');
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

      $this->isControllable = true;
      
      echo "コンストラクタ opponentId:$this->opponentId, playerId:$this->playerId";
    }

    public function isControllable() {
      return $this->isControllable;
    }

    //isControllableを逆にする
    public function switchControllable() {
      $this->isControllable = !$this->isControllable;
    }

    //プレイヤーの操作を無効化
    public function disabledPlayerAction() {
      $this->isControllable = false;
    }

    //プレイヤーの操作を有効化
    public function enabledPlayerAction() {
      $this->isControllable = true;
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

    //次に受けるダメージを50%カット
    public function defence() {
      
    }

    


  }
?>