<?php
namespace Manager;

/**
 * ..........................
 */
class Main {

  /**
   * Execussão principal da interface do usuário do jogo.
   */


  //Implementa uma class static que retorna uma vazio(void) 
  public static function run(): void {
    print "#########################################\n";
    print "### Bem vindo ao jogo de War da Chuva ###\n";
    print "#########################################\n";

    
    //Chama a class game e implementa o método create()
    $game = Game::create();

    //implementa o método play() de Game
    //$game->play();

    //implementa o método results() de Game
    $game->results();

    //Quebra uma linha
   // print "\n";
    
  }

}
