<?php

namespace Galoa;

use DOMDocument;

/**
 * Corredor para o exercício Web Scraping.
 */
class Main {

  /**
   * Corredor principal, instancia um Scrapper e corre.
   * O “ @” serve para ignorar os erros do HTML
   */
  public static function run(): void {
    
    $dom = new DOMDocument('1.0', 'utf-8');
    @$dom->loadHTMLFile(__DIR__ . '/../../webscrapping/origin.html');

    (new Scrapper())->scrap($dom);

    
  }

}
