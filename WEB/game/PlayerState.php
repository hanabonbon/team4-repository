<?php
  class PlayerState {
    private int $hihPoint;
    private int $attack;
    private int $defense;
    private int $agility;
    private int $luck;

    public function __construct($statusLv = array()) {
      $status =  $this->culcStatus($statusLv);

      $this->hihPoint = $status['hihPoint'];
      $this->attack = $status['attack'];
      $this->defense = $status['defense'];
      $this->agility = $status['agility'];
      $this->luck = $status['luck'];
    }

    public function culcStatus($statusLv) {
      $status = array();

      //体力値の計算
      $status['hihPoint'] = 100 + $statusLv['hihPoint'] * 5;
      //攻撃力の計算
      $status['attack'] = 20 + $statusLv['attack'];
      //防御力の計算
      switch ($statusLv['defense']) {
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

      return $status;
    }

    


  }
?>