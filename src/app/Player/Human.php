<?php

namespace App\Player;

use App\Board\Board;
use Exception;

class Human extends Player
{
    /**
     * @throws Exception
     */
    public function drop(Board $board): Board
  {
    $column = null;
    $options = array_map(function ($v) {
      return ++$v;
    },$board->getAllowedCollumns());

    while (!in_array($column, $options)) {
      $column = readline($this->name.' Please enter a column number (' . implode($options, ',') . '): ');
    }
    $board->drop(--$column,$this->disk);
    return $board;
  }
}