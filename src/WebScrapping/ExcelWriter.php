<?php
namespace Galoa;

use Box\Spout\Common\Entity\Style\Style;
use Box\Spout\Writer\Common\Creator\Style\StyleBuilder;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use DOMXPath;
use Exception;
use Throwable;

class ExcelWriter
{
    public static $filename = 'webscrapping/model.xlsx';

    /**
     * @param DOMXPath $finder
     * @return string[]
     */
    public static function header(DOMXPath $finder): array
    {

        $highestAuthors = (new Post($finder))->withHighestAuthors() + 1;
        $columns = [
            "ID",
            "Title",
            "Type",
        ];

        for ($i = 1; $i < $highestAuthors; $i++) {
            $columns[] = "Author $i";
            $columns[] = "Author $i Institution";
        }
        return $columns;
    }

    /**
     * @return Style
     */
    public static function headerStyle(): Style
    {
        return (new StyleBuilder())
            ->setFontBold()
            ->setFontSize(10)
            ->setFontName('Arial')
            ->build();
    }

    /**
     * @param string|null $text
     * @return string
     */
    public static function formatter(?string $text): string
    {
        $textWithoutBreakline = str_replace("\n", " ", $text);
        $textWithoutUnecessarySpacesBetweenWords = preg_replace('/\s\s+/', ' ', $textWithoutBreakline);

        return trim($textWithoutUnecessarySpacesBetweenWords);
    }

    /**
     * @return Style
     */
    public static function rowStyle(): Style
    {
        return (new StyleBuilder())
            ->setFontSize(10)
            ->setFontName('Arial')
            ->build();
    }

    /**
     * @param array $rows
     * @return void
     * @throws Exception
     */
    public static function write(array $rows)
    {
        try {
            $writer = WriterEntityFactory::createXLSXWriter();
            $writer->openToFile(self::$filename);
            $writer->addRows($rows);
            $writer->close();
        } catch (Throwable $e) {
            throw new Exception('Ocorreu um erro, por favor confira o nome do arquivo');
        }
    }
}