<?php
//相手AIのサンプル
//action()の戻り値に文字列で"attack", "defence", "avoid"のいずれかをようにすればOK
  namespace task_game;
  use task_game\EnumActionState;
  //相手の行動プログラム
  //ランダムで行動を決定する
  //0:攻撃 1:防御 2:回避
  require_once('../game/AbstractAi.php');
  class OpponentAi extends AbstractAi{
    private BattleController $battle;
    private $opponent;
    private $player;

    public function __construct(BattleController $battle) {
      require_once('../game/EnumActionState.php');
      require_once('../game/BattleController.php');
      $this->battle = $battle;
      $this->opponent = $battle->getOpponent();
      $this->player = $battle->getPlayer();
    }
    

    public function action(): String {
      //行動の決定ロジックは自由です。
      $actionCode = rand(0, 2);
      $action = "";

      switch ($actionCode) {
        case 0:
          //攻撃
          $action = "attack";
          break;

        case 1:
          //防御
          $action = "defence";
          break;

        case 2:
          //TODO:回避
          //回避
          $action = "avoid";
          break;
      }

      //必須 戻り値は文字列で"attack", "defence", "avoid"のいずれか
      return $action;
    }

  }
?>