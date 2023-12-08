<?php
  namespace task_game;
  use task_game\EnumActionState;
  //相手の行動プログラム
  //ランダムで行動を決定する
  //0:攻撃 1:防御 2:回避
  class OpponentAi {
    private BattleController $battle;

    public function __construct() {
      // $this->battle = $battle;
      require_once('../game/EnumActionState.php');
    }

    public function action() {
      //行動の決定
      //$actionCode = rand(0, 2);
      $actionCode = 0;
      $action = "";

      //行動の実行
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

      //必須
      return $action;
    }

  }
?>