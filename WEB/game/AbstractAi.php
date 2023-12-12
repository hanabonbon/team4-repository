<?php
  //以下2行も必須です
  namespace task_game;
  use task_game\EnumActionState;
  
  //相手の行動プログラム
  //ランダムで行動を決定する
  //0:攻撃 1:防御 2:回避
  abstract class AbstractAi {
    abstract function action(): String ;
  }
?>