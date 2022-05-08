<?php

namespace Playcountry;

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
