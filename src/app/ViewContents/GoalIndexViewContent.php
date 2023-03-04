<?php
declare(strict_types=1);

namespace App\ViewContents;

use App\Consts\GoalConsts;
use App\Models\Goal;
use App\Models\LevelMaster;
use App\ViewContents\ExpViewContent;

class GoalIndexViewContent
{

  public function __construct (
    private $goal = null,
    private int $goal_status,
    private LevelMaster $level,
    private ExpViewContent $exp_content)
  {
    $this->goal = $goal;
    $this->goal_status = $goal_status;
    $this->level = $level;
    $this->exp_content = $exp_content;
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
  public function getExpContent ()
  {
    return $this->exp_content;
  }

  // Viewに目標を表示させる判定処理
  public function isExistToDoGoal ()
  {
    // TODO: 0を定数に置き換え(定数クラスを使用)
    return !$this->isGoalEmpty() && ($this->getGoalStatus() === GoalConsts::GOAL_STATUS_TODO);
  }

}