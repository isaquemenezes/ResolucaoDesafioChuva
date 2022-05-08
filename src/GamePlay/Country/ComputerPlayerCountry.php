<?php

namespace Playcountry;
/**
 * Define um país que é gerenciado pelo Computador.
 */
class ComputerPlayerCountry extends BaseCountry {

  /**
   * Escolha um país para atacar ou nenhum.
   *
   * O computador pode escolher atacar ou não. Se ele escolher não atacar,
   * retorna NULO. Se ele escolher atacar, retorne um vizinho para atacar.
   *
   * NÃO deve ser um país conquistado.
   *
   * @return Playcountry\CountryInterface|null
   *  O país que será atacado, NULL se nenhum for.
   */
  public function chooseToAttack(): ?CountryInterface {
    // @TODO
  }

}
