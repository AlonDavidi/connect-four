<?php

namespace App\Board;


use Exception;

abstract class Board
{
  protected const ROWS = 6;
  protected const COLUMNS = 7;
  protected const DIAMETER = 4;

  public $columns = [];

  public function __construct()
  {
    // initiating board with null values
    $this->columns = array_fill(0, self::COLUMNS, array_fill(0, self::ROWS, null));
  }

    /**
     * @throws Exception
     */
    public function drop($column, $disk): Board {
    if (!in_array($column, $this->getAllowedCollumns())) {
      throw new Exception("$column column is full");
    }

    foreach ($this->columns[$column] as &$slot) {
      if ($slot === null) {
        $slot = $disk;
        break;
      }
    }

    return $this;
  }

  public function getAllowedCollumns(): array {
    $moves = [];
    foreach ($this->columns as $i => $column) {
      if (count(array_filter($this->columns[$i])) < self::ROWS) {
        $moves[] = $i;
      }
    }
    return $moves;
  }

  public function detectWin(): bool
  {
    for ($i = 0; $i <= self::COLUMNS - self::DIAMETER; $i++) {

      for ($j = 0; $j <= self::ROWS - self::DIAMETER; $j++) {

        if ($this->detectConnection($i, $j)) {
          return true;
        }

      }
    }
    return false;
  }

  public function detectConnection($column, $row): bool
  {
    $lines = $this->getLines($column, $row);
    foreach ($lines as $line) {
      if (count(array_unique($line)) == 1 && count(array_filter($line)) == self::DIAMETER) {
        return true;
      }
    }
    return false;
  }

  public function getLines($column, $row): array
  {
    $lines = [];
    for ($i = 0; $i < self::DIAMETER; $i++) {
      $lines['vertical'][] = $this->columns[$column][$row + $i];
      $lines['horizontal'][] = $this->columns[$column + $i][$row];
      $lines['diagonal'][] = $this->columns[$column + $i][$row + $i] ?? null;
      $lines['diagonal2'][] = $this->columns[$column + $i][$row - $i] ?? null;
    }
    return $lines;
  }
}