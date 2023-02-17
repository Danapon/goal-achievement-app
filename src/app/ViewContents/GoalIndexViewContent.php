<?php
declare(strict_types=1);

namespace App\ViewContents;

use App\Consts\GoalConsts;
use App\Models\Goal;
use App\Models\LevelMaster;

class GoalIndexViewContent
{

  private $goal;
  private $goal_status;
  private $level;
  private $exp_array;

  public function __construct (
    Goal $goal = null,
    int $goal_status,
    LevelMaster $level,
    array $exp_array)
  {
    $this->goal = $goal;
    $this->goal_status = $goal_status;
    $this->level = $level;
    $this->exp_array = $exp_array;
  }

  public function getGoals ()
  {
    return $this->goal;
  }
  public function isGoalEmpty ()
  {
    // 値が存在すればfalse,nullならtrueを返す
    return is_null($this->goal);
  }
  public function getGoalStatus ()
  {
    return empty($this->goal) ? GoalConsts::GOAL_STATUS_TODO : $this->goal->status;
  }
  public function getLevel ()
  {
    return $this->level;
  }
  public function getExpArray ()
  {
    return $this->exp_array;
  }

  // Viewに目標を表示させる判定処理
  public function isExistToDoGoal ()
  {
    // TODO: 0を定数に置き換え(定数クラスを使用)
    return !$this->isGoalEmpty() && ($this->getGoalStatus() === GoalConsts::GOAL_STATUS_TODO);
  }

}