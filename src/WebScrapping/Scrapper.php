<?php

namespace Galoa;

use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use DOMDocument;
use DOMXPath;
use Exception;

/**
 * Faz a raspagem de uma página da web.
 */
class Scrapper {

  /**
   * Carrega as informações do papel do HTML e cria um arquivo XLSX.
   */
  public function scrap(\DOMDocument $dom): void {

    //raspando pela id="job"
    // $domTag = $dom->getElementById('job');

    //  1 print $dom->saveHTML();
    // print $dom->saveHTML($domTag);

    $finder = new DOMXPath($dom);
    $postClass = new Post($finder);
    $posts = $postClass->all();

    $rows[] = WriterEntityFactory::createRowFromArray(ExcelWriter::header($finder), ExcelWriter::headerStyle());

    foreach($posts as $post){
        $postData = [
            ExcelWriter::formatter($postClass->getId($post)),
            ExcelWriter::formatter($postClass->getTitle($post)),
            ExcelWriter::formatter($postClass->getType($post)),
        ];
        $authorData = $postClass->getAuthors($post);
        $rowData = array_merge($postData, $authorData);
        $rows[] = WriterEntityFactory::createRowFromArray($rowData, ExcelWriter::rowStyle());
    }

    ExcelWriter::write($rows);
    

  
  }

}
