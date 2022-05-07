<?php

namespace Galoa\War\GameManager;

/**
 * ..........................
 */
class Main {

  /**
   * Execussão principal da interface do usuário do jogo.
   */
  public static function run(): void {
    print "#########################################\n";
    print "### Bem vindo ao jogo de War da Chuva ###\n";
    print "#########################################\n";

    $game = Game::create();
    $game->play();
    $game->results();

    print "\n";
    
  }

}
