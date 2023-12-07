<?php 
  namespace task_game;
  use task_game\EnumActionState;
  class BattleController {
    private Player $player;
    private $playerId;
    private Player $opponent;
    private $opponentId;
    private Bool $isControllable;
    private Bool $isEnd;

    public function __construct($playerId, $opponentId) {
      //必要なクラスをインスタンス化
      require_once('../game/player.php');
      require_once('../DAO/GameUser.php');
      require_once('../game/EnumActionState.php');
      $gameUser = new GameUser();
      $this->isEnd = false;

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

    public function isEnd() {
      return $this->isEnd;
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
    
    //攻撃
    public function attack($targetId) {
      $damage_ = 0;
      switch ($targetId) {
        //呼び出す関数（decreaseHP()）側で呼び出し元に応じた処理を行うようにしたい
  
        //相手に攻撃
        case $this->opponentId:
          $damage_ =  $this->opponent->decreaseHP($this->player->getATK());
          //自身のステータスを更新
          $this->player->setActionState(EnumActionState::NEUTRAL);

          //相手のHPがあるかチェック
          if($this->opponent->getActionState() == EnumActionState::DEAD) {
            $this->isEnd = true;
          }
          break;
          
        //プレイヤーに攻撃
        case $this->playerId:
          $damage_ =  $this->player->decreaseHP($this->opponent->getATK());
          //自身のステータスを更新
          $this->opponent->setActionState(EnumActionState::NEUTRAL);

          //相手のHPがあるかチェック
          if($this->player->getActionState() == EnumActionState::DEAD) {
            $this->isEnd = true;
          }
          break;

        default:
          # code...
          break;
      }
      
      return $damage_;
    }

    //防御
    public function defence($targetId) {
      switch ($targetId) {
        case $this->opponentId:
          $this->opponent->defence();
          break;

        case $this->playerId:
          $this->player->defence();
          break;

        default:
          # code...
          break;
      }
    }

    //回避
    public function avoid($targetId) {
      switch ($targetId) {
        case $this->opponentId:
          $this->opponent->avoid();
          break;

        case $this->playerId:
          $this->player->avoid();
          break;

        default:
          # code...
          break;
      }
    }

    public function getPlayer() {
      return $this->player;
    }

    public function getOpponent() {
      return $this->opponent;
    }

    public function getPlayerState() {
      return $this->player->getActionState();
    }

    public function getOpponentState() {
      return $this->opponent->getActionState();
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
  }
?>