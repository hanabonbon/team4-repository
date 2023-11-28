<?php 
  class BattleController {
    private $player;
    private $opponent;

    public function __construct($playerId, $opponentId) {
      //必要なクラスをインスタンス化
      require_once('../game/player.php');
      require_once('../DAO/GameUser.php');
      $gameUser = new GameUser();

      //自分
      $user_id = $playerId;
      $userStatusLv = $gameUser->fetchUserStatusLv($user_id);
      //プレイヤーインスタンス
      $this->player = new Player($userStatusLv);

      //相手
      $opponentStatusLv = $gameUser->fetchUserStatusLv($opponentId);
      //相手インスタンス
      $this->opponent = new Player($opponentStatusLv);
    }

    public function attack($target) {
      
    }

    


  }
?>