<?php

namespace Galoa\War\GamePlay\Country;

/**
 * Defines a country, that is also a player.
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

}
