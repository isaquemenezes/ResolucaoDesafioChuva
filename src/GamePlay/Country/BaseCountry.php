<?php

namespace Playcountry;

/**
 * Define um país, que também é um jogador.
 */
class BaseCountry implements CountryInterface {

  /**
   * O nome do país..
   *
   * @var string
   */
  protected $name;

  /**
   * Builder.
   *
   * @param string $name
   *   O nome do país..
   */
  public function __construct(string $name) {
    $this->name = $name;
  }

  public function getName(){ }
  public function setNeighbors(array $neighbors){}
  public function getNeighbors(){}
  public function getNumberOfTroops(){}
  public function isConquered(){}
  public function conquer(CountryInterface $conqueredCountry){}
  public function killTroops(int $killedTroops){}


}
