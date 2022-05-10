<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

use DOMDocument;

/**
 * Runner for the Webscrapping exercice.
 */
class Main {

  /**
   * Main runner, instantiates a Scrapper and runs.
   */
  public static function run(): void {
    
      $dom = new DOMDocument('1.0', 'utf-8');
      $dom2 = new DOMDocument('1.0', 'utf-8');
      
      // $d = $dom->loadHTMLFile(__DIR__ . '/../../webscrapping/origin.html');
      // $d = $dom2->loadHTMLFile(__DIR__ . '/../../webscrapping/origin2.html');
      // $d = simplexml_load_file(__DIR__ . '/../../webscrapping/paises.xml');
      // var_dump($d);
      // (new Scrapper())->scrap($dom);

      echo "gg";
  }

}
