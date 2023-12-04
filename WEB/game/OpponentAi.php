<?php
  //相手の行動プログラム
  //ランダムで行動を決定する
  //0:攻撃 1:防御 2:回避
  class OpponentAi {
    private BattleController $battle;

    public function __construct(BattleController $battle) {
      $this->battle = $battle;
    }

    public function action() {
      //行動の決定
      $action = rand(0, 2);

      //行動の実行
      switch ($action) {
        case 0:
          //攻撃
          $this->battle->attack($this->battle->getPlayerId());
          break;

        case 1:
          //攻撃
          $this->battle->attack($this->battle->getPlayerId());
          break;

        case 2:
          //攻撃
          $this->battle->attack($this->battle->getPlayerId());
          break;
      }

      //必須
      return $this->battle;
    }

  }
?>