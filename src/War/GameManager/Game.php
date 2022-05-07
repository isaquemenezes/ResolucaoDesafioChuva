<?php

namespace Galoa\ExerciciosPhp2022\War\GameManager;

use Galoa\ExerciciosPhp2022\War\GamePlay\Battlefield;
use Galoa\ExerciciosPhp2022\War\GamePlay\BattlefieldInterface;
use Galoa\ExerciciosPhp2022\War\GamePlay\Country\ComputerPlayerCountry;
use Galoa\ExerciciosPhp2022\War\GamePlay\Country\HumanPlayerCountry;

/**
 * Define um jogo, mantém os jogadores e interage com a interface do usuário.
 */
class Game {

  /**
   * The battlefield. O campo de batalha.
   *
   * @var \Galoa\ExerciciosPhp2022\War\GamePlay\BattlefieldInterface
   */
  protected $battlefield;

  /**
   * Os países do jogo, incluindo os conquistados, indexados por nome.
   *
   * @var \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface[]
   */
  protected $countries;

  /**
   * Instancia um novo jogo.
   */
  public static function create(): Game {
    return new static(new Battlefield(), CountryList::createWorld());
  }

  /**
   * Builder. Construtora.
   *
   * @param \Galoa\ExerciciosPhp2022\War\GamePlay\BattlefieldInterface $battlefield
   *   The battle field.
   * @param \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface[] $countries
   *   Uma lista de países.
   */
  public function __construct(BattlefieldInterface $battlefield, array $countries) {
    $this->battlefield = $battlefield;
    $this->countries = $countries;
  }

  /**
   * Joga o jogo.
   */
  public function play(): void {
    $i = 0;

    while (!$this->gameOver()) {
      $i++;
      print "===== Rodada # $i =====\n";
      $this->stats();
      $this->playRound();
    }
    
  }

  /**
   * Exibir estatísticas.
   */
  public function stats(): void {
    foreach ($this->countries as $country) {
      print "  " . $country->getName() . ": " . ($country->isConquered() ? "DERROTADO" : $country->getNumberOfTroops() . " tropas") . "\n";
    }
  }

  /**
   * Exibe os resultados do jogo.
   */
  public function results(): void {
    $countries = $this->getUnconqueredCountries();
    // Deveria ter apenas um.
    if ($winner = reset($countries)) {
      print "~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~\n";
      print "~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~\n";
      print $winner->getName() . " conquistou toda a Terra-Média!!!\n";
      print "~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~\n";
      print "~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~*~\n";
    }

    $this->stats();
  }

  /**
   *Joga uma rodada.
   */
  protected function playRound(): void {

    foreach ($this->getUnconqueredCountries() as $attackingCountry) {
      print "----- Vez de " . $attackingCountry->getName() . "\n";

      $defendingCountry = NULL;

      if ($attackingCountry instanceof ComputerPlayerCountry) {

        $defendingCountry = $attackingCountry->chooseToAttack();
      
      } elseif ($attackingCountry instanceof HumanPlayerCountry) {
        
        $neighbors = $attackingCountry->getNeighbors();
        
        $defendingCountryName = NULL;
        
        do {
          $typedName = readline("Digite o nome de um país para atacar ou deixe em branco para não atacar ninguém:\n");
          $defendingCountryName = trim($typedName);
        }
        
        while ($defendingCountryName && !isset($neighbors[$defendingCountryName]));

        if ($defendingCountryName) {
          $defendingCountry = $this->countries[$defendingCountryName];
        }
      
      }

      // Se houver um ataque, vamos lutar.
      if ($defendingCountry) {
        print "  vai atacar " . $defendingCountry->getName() . "\n";

        $attackingDice = $this->battlefield->rollDice($attackingCountry, TRUE);
        $defendingDice = $this->battlefield->rollDice($defendingCountry, FALSE);

        print "  dados de " . $attackingCountry->getName() . ": " . implode("-", $attackingDice) . "\n";
        print "  dados de " . $defendingCountry->getName() . ": " . implode("-", $defendingDice) . "\n";

        $this->battlefield->computeBattle($attackingCountry, $attackingDice, $defendingCountry, $defendingDice);

        if ($defendingCountry->isConquered()) {
          $attackingCountry->conquer($defendingCountry);
          print "  " . $defendingCountry->getName() . " foi anexado por " . $attackingCountry->getName() . "!\n";
        } else {
          print "  " . $defendingCountry->getName() . " conseguiu se defender!\n";
        }
      }
      
      sleep(1);
    }
  }

  /**
   * Verifica se o jogo está completo.
   *
   * @return bool
   *   TRUE se o jogo acabou, FALSE caso contrário.
   */
  protected function gameOver(): bool {
    // Se houver apenas um país restante, o jogo acabou.
    return count($this->getUnconqueredCountries()) <= 1;
  }

  /**
   * Lista os países que não foram conquistados.
   *
   * @return \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface[]
   *   Uma série de países.
   */
  protected function getUnconqueredCountries(): array {

    return array_filter($this->countries, function($country) {
     
      return !$country->isConquered();
    
    });
  }

}
