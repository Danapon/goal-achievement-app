<?php
declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Models\Goal;
use App\Models\LevelMaster;
use App\Services\TotalExpService;
use App\Services\LevelService;
use App\Consts\GoalConsts;
use App\ViewContents\GoalIndexViewContent;

class GoalService
{

    private $total_exp_service;
    private $level_master;
    private $level_service;

    // コンストラクタインジェクション
    public function __construct(
      TotalExpService $total_exp_service,
      LevelMaster $level_master,
      LevelService $level_service
    )
    {
      $this->total_exp_service = $total_exp_service;
      $this->level_master = $level_master;
      $this->level_service = $level_service;
    }

    /* goalsテーブルのステータスを取得する処理③ */
    public function getGoalIndexViewContent(User $user):GoalIndexViewContent
    {
      // サービスクラスは状態を持たず、処理のみを実行
      // 状態を返す他のクラス(GoalIndexViewContent)を持った方がいい

      /* 累計経験値を取得する処理① */
      $total_exp = $this->total_exp_service->getTotalExp();

      /* 現在のレベルのレコードをlevel_mastersテーブルから取得する処理②-1 */
      $level = $this->level_master->getLevelMaster($total_exp);

      /* レベルアップゲージに表示させる値を計算して取得する処理②-2 */
      $exp_content = $this->level_service->getExp($level, $total_exp);

      /* 目標テーブルのレコードを取得する処理 */
      $goal = $user->goals->sortByDesc('id')->first();

      return  new GoalIndexViewContent($goal, $total_exp, $level, $exp_content);
 
    }

}
