<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

/**
 * Does the scrapping of a webpage.
 */
class Scrapper {

  /**
   * Loads paper information from the HTML and creates a XLSX file.
   */
  public function scrap(\DOMDocument $dom): void {

    print $dom->saveHTML();
  
  }

}
