<?php

namespace App\Board;


use Symfony\Component\Console\Helper\Table;

class Console extends Board
{
  public function render($output)
  {
    $table = new Table($output);
    $rows = $this->transpose($this->columns);
    $table->setHeaders(range(1, self::COLUMNS));
    $table->setRows($rows);
    $table->render();
  }

  private function transpose($array): array {
    $out = [];
    foreach ($array as $key => &$row) {
      $row = array_reverse($row);
      foreach ($row as $subkey => $subvalue) {
        $out[$subkey][$key] = $subvalue;
      }
    }

    return $out;
  }
}