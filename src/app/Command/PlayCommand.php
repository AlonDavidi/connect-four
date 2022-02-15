<?php

namespace App\Command;

use App\Board\Console;
use App\Player\Human;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class PlayCommand extends Command
{
  protected function configure()
  {
    $this->setName('play');
  }

    /**
     * @throws Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
  {
    $board = new Console();

    $output->writeLn([
      'Welcome to the Connect Four game',
      '=================================',
    ]);

    $redPlayer = new Human('Player1','1');
    $bluePlayer = new Human('Player2', '2');

    $output->writeln([
      "$redPlayer->name ($redPlayer->disk) vs $bluePlayer->name ($bluePlayer->disk)"
    ]);

    $players = [$redPlayer, $bluePlayer];
    $turn = 0; // which player should drop next

    while ($board->getAllowedCollumns()) {
      $turn = ($turn + 1) % count($players);
      $player = $players[$turn];
      $player->drop($board);
      $board->render($output);
      if ($board->detectWin()) {
        $output->writeln("$player->name won!");
        break;
      }
    }
  }
}