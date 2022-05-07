<?php

namespace Galoa\GameManager;

use Galoa\GamePlay\Country\ComputerPlayerCountry;
use Galoa\GamePlay\Country\HumanPlayerCountry;

/**
 * Cria uma lista de países para o jogo.
 */
class CountryList {

  /**
   * Cria uma lista de países, com um jogador humano
   *
   * @return \Galoa\GamePlay\Country\CountryInterface[]
   *   Uma lista de países.
   */
  public static function createWorld(): array {
    $map = [
      'Gondor' => ['Enedwaith', 'Rohan', 'Harondor', 'Mordor'],
      'Enedwaith' => ['Gondor', 'Rohan'],
      'Rohan' => ['Enedwaith', 'Gondor', 'Rhovanion'],
      'Rhovanion' => ['Rohan'],
      'Harondor' => ['Gondor', 'Mordor'],
      'Mordor' => ['Harondor', 'Gondor'],
    ]; 

    $countries = [];

    foreach (array_keys($map) as $index => $name) {

      if ($index) {

        $countries[$name] = new ComputerPlayerCountry($name);
        readline_add_history($name);
      
      } else {
       
        $countries[$name] = new HumanPlayerCountry($name);
      
      }
    }

    foreach ($map as $name => $neighborNames) {

      $countries[$name]->setNeighbors(array_map(function ($countryName) use ($countries) {
        
        return $countries[$countryName];
      
      }, $neighborNames));

    }

    return $countries;
  }

}
