<?php
  namespace task_game;
  use task_game\EnumActionState;
  class Player {    
    private float $hitpoint;
    private float $attack;
    private float $defence;
    private float $agility;
    private float $luck;
    //プレイヤーの状態（通常,防御,回避)
    private EnumActionState $actionState = EnumActionState::NEUTRAL;
    //前回の行動を保存
    
    public function __construct($statusLv = array()) {
      $status =  $this->culcStatus($statusLv);
      $this->hitpoint = $status['hitpoint'];
      $this->attack = $status['attack'];
      $this->defence = $status['defence'];
      $this->agility = $status['agility'];
      $this->luck = $status['luck'];
      require_once __DIR__ . '/EnumActionState.php';
      //$this->actionState = EnumActionState::NEUTRAL;
    }

    public function setActionState(EnumActionState $actionState) {
      $this->actionState = $actionState;
    }

    public function getActionState() {
      return $this->actionState;
    }

    

    public function decreaseHP(float $damage) {
      $damage_ = $damage;
      switch ($this->actionState) {
        case EnumActionState::NEUTRAL:
          //TODO: 防御ステータスによるダメージカットの計算
          
          break;
        case EnumActionState::DEFENCE:
          $damage_ = $damage_ * 0.5;
          break;

        case EnumActionState::AVOID:
          //回避成功の場合はダメージを受けない
          //失敗した場合は回避確率の分ダメージカット
          $avoid = rand(0, 100);
          if ($avoid >= $this->agility * 100) {
            $damage_ = 0;
          } else {
            $damage_ = $damage_ - $damage_ * $this->agility;
          }
          break;

        default:
          # code...
          break;
      }

      //ダメージを受ける
      $this->hitpoint -= $damage_;

      //状態のリセット
      $this->actionState = EnumActionState::NEUTRAL;

      //生存判定
      if($this->hitpoint <= 0) {
        //HPが0以下の場合は状態を更新
        $this->actionState = EnumActionState::DEAD;
      }
      
      return $damage_;
    }

    public function defence() {
      $this->actionState = EnumActionState::DEFENCE;
    }

    public function culcStatus($statusLv) {
      $status = array();

      //体力値の計算
      $status['hitpoint'] = 100 + $statusLv['hitpoint'] * 5;

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

    public function getHP() {
      return $this->hitpoint;
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
  }
?>