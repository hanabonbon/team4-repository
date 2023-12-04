<?php
  class Player {
    private float $hihpoint;
    private float $attack;
    private float $defence;
    private float $agility;
    private float $luck;

    public function __construct($statusLv = array()) {
      $status =  $this->culcStatus($statusLv);

      $this->hihpoint = $status['hihpoint'];
      $this->attack = $status['attack'];
      $this->defence = $status['defence'];
      $this->agility = $status['agility'];
      $this->luck = $status['luck'];
    }

    public function getHP() {
      return $this->hihpoint;
    }

    public function getATK() {
      return $this->attack;
    }

    public function getDEF() {
      return $this->defence;
    }

    public function getAGL() {
      return $this->agility;
    }

    public function getLUK() {
      return $this->luck;
    }

    public function decreaseHP(float $damage) {
      $this->hihpoint -= $damage;
    }

    public function culcStatus($statusLv) {
      $status = array();

      //体力値の計算
      $status['hihpoint'] = 100 + $statusLv['hitpoint'] * 5;

      //攻撃力の計算
      $status['attack'] = 20 + $statusLv['attack'];

      //防御力の計算
      switch ($statusLv['defence']) {
        case $statusLv['defence'] <= 50:
          $status['defence'] = 0.05 + $statusLv['defence'] * 0.004;
          break;
        case $statusLv['defence'] <= 100:
          $status['defence'] = 0.25 + 50 * 0.004 + ($statusLv['defence'] - 50) * 0.005;
          break;
        case $statusLv['defence'] >=101:
          $status['defence'] = 0.25 + 50 * 0.004 + 50 * 0.005 + ($statusLv['defence'] - 100) * 0.001;
          break;
        default:
          # code...
          break;
      }

      //すばやさの計算
      switch ($statusLv['agility']) {
        case $statusLv['agility'] <= 50:
          $status['agility'] = 0.1 + $statusLv['agility'] * 0.004;
          break;
        case $statusLv['agility'] <= 100:
          $status['agility'] = 0.3 + 50 * 0.004 + ($statusLv['agility'] - 50) * 0.008;
          break;
        case $statusLv['agility'] >=101:
          $status['agility'] = 0.3 + 50 * 0.004 + 50 * 0.008 + ($statusLv['agility'] - 100) * 0.001;
          break;
        default:
          # code...
          break;
      }

      //幸運の計算
      switch ($statusLv['luck']) {
        case $statusLv['luck'] <= 50:
          $status['luck'] = 0.006 + $statusLv['luck'] * 0.006;
          break;
        case $statusLv['luck'] <= 100:
          $status['luck'] = 0.3 + 50 * 0.006 + ($statusLv['luck'] - 50) * 0.004;
          break;
        case $statusLv['luck'] >=101:
          $status['luck'] = 0.3 + 50 * 0.006 + 50 * 0.004 + ($statusLv['luck'] - 100) * 0.001;
          break;
        default:
          # code...
          break;
      }

      return $status;
    }

    


  }
?>