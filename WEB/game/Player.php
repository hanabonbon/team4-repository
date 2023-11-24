<?php
  class Player {
    private int $hihPoint;
    private int $attack;
    private int $defense;
    private int $agility;
    private int $luck;

    public function __construct() {
      $this->hihPoint = 0;
      $this->attack = 0;
      $this->defense = 0;
      $this->agility = 0;
      $this->luck = 0;
    }

    public function attack() {
      echo '攻撃';
    }
    public function defence() {
      echo '防御';
    }
    public function avert() {
      echo '回避';
    }
    public function skill() {
      echo 'スキル';
    }

  }
?>