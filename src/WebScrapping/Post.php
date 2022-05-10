<?php
namespace Galoa;

use DOMNode;
use DOMXPath;

class Post
{
    /**
     * @var DOMXPath
     */
    protected $finder;

    public function __construct(DOMXPath $finder)
    {
        $this->finder = $finder;
    }
    
    public function all()
    {
        return $this->finder->query("//*[contains(@class, 'paper-card')]");
    }

    public function withHighestAuthors(): int
    {
        $authorsQuantity = [0];
        $authors = $this->finder->query("//*[contains(@class, 'authors')]");
        foreach($authors as $author){
            echo $this->finder->query("./span", $author)->length, "\n";
            $authorsQuantity[] = $this->finder->query("./span", $author)->length;
        }
        return max($authorsQuantity);
    }

    public function getId($post): ?string
    {
        $lastDivInA = $this->lastDiv($post);
        $lastDivInDivInfo = $this->lastDiv($lastDivInA);
        return $this->finder->query("./div[contains(@class, 'volume-info')]", $lastDivInDivInfo)->item(0)->nodeValue;
    }

    public function getTitle($post): ?string
    {
        $typeTitle = $this->finder->query("./h4[contains(@class, 'paper-title')]", $post)->item(0);
        return $typeTitle->nodeValue;
    }

    public function getType($post): ?string
    {
        $lastDivInA = $this->lastDiv($post);
        $typeNode = $this->finder->query("./div[contains(@class, 'tags mr-sm')]", $lastDivInA)->item(0);
        return $typeNode->nodeValue;
    }

    public function getAuthors($post): ?array
    {
        $authors = [];
        $postAuthor = $this->finder->query("./div[contains(@class, 'authors')]", $post)->item(0);
        foreach ($this->finder->query("./span", $postAuthor) as $child) {
            $authors[] = $child->nodeValue;
            $authors[] = $child->getAttribute('title');
        }
        return $authors;
    }

    public function lastDiv($post): ?DOMNode
    {
        $divs = $this->finder->query("./div", $post);
        $divsLength = $divs->length;
        return $divs->item($divsLength - 1);
    }
}