<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay;

use Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface;

/**
 * Define uma classe que irá rolar os dados e computar os vencedores de uma batalha.
 */
interface BattlefieldInterface {

  /**
   * Joga os dados para um país.
   *
   * @param \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface $country
   *  O país que está rolando os dados.
   * @param bool $isAtacking
   *   VERDADEIRO se o dado estiver sendo rolado pelo atacante, FALSO se pelo
      
   *   defensor
   *
   * @return int[]
   *  Uma matriz com valores de 1 a 6. A matriz deve ter tantos itens quanto:
   *      o número de tropas do país, quando o defensor está rolando
   *        o dado.
   *     o número de tropas do país MENOS UM, quando o atacante é
   *      aquele que rola os dados.
   */
  public function rollDice(CountryInterface $country, bool $isAtacking): array;

  /**
   * Calcula os vencedores e perdedores de uma batalha.
   *
   * @param \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface $attackingCountry
   *   O país que está atacando.
   * @param int[] $attackingDice
   *   O número
   * @param \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface $defendingCountry
   *   O país que está se defendendo do ataque.
   */
  public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void;

}
