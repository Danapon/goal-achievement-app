<?php
declare(strict_types=1);

namespace App\ViewContents;

class ExpViewContent
{

  public function __construct (
    private int $required_exp_max,
    private float $current_exp,
    private int $next_exp)
  {
    $this->required_exp_max = $required_exp_max;
    $this->current_exp = $current_exp;
    $this->next_exp = $next_exp;
  }

  public function getRequireExpMax ()
  {
    return $this->required_exp_max;
  }

  public function getCurrentExp ()
  {
    return $this->current_exp;
  }

  public function getNextExp ()
  {
    return $this->next_exp;
  }

}