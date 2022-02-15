<?php

namespace App\Player;

use App\Board\Board;

abstract class Player
{
  public $disk;
  public $name;

  abstract public function drop(Board $board): Board;

  /**
   * @return mixed
   */
  public function __construct($name, $disk)
  {
    $this->name = $name;
    $this->disk = $disk;
  }
}