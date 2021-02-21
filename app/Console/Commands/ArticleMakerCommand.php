<?php

namespace App\Console\Commands;

use App\Entities\Article;
use App\Services\ArticleMaker;
use Fox\Collection\Collection;
use Fox\Console\Console;

/**
 * The sample command
 * PHP version >= 7.0
 *
 * @category Commands
 * @package  Fox
 */
class ArticleMakerCommand extends Console
{
    public const SIGNATURE = "article:make";

    /**
     * Run the command
     *
     * @return void
     */
    public function run()
    {
        $initialArticles = $this->getArticles();
        $articleMaker = new ArticleMaker($initialArticles);
        $newArticles = $articleMaker->make();
        echo "Name | Group | Price" . PHP_EOL;
        foreach ($newArticles as $newArticle) {
            echo $newArticle->getName() . " | " . $newArticle->getGroup() . " | " . $newArticle->getPrice() . PHP_EOL;
        }
    }

    /**
     * @return Collection
     */
    private function getArticles(): Collection
    {
        $articles = new Collection();
        $defaultGroup = config("groups.default_group");
        $articles->add($this->getArticle("AA", 1, 100.00))
            ->add($this->getArticle("BB", 1, 50.00))
            ->add($this->getArticle("CC", 2, 75.00))
            ->add($this->getArticle("AA", 1, 20.00))
            ->add($this->getArticle("AA", $defaultGroup, 100.00))
            ->add($this->getArticle("BB", 2, 75.00))
            ->add($this->getArticle("CC", 2, 80.00))
            ->add($this->getArticle("AA", $defaultGroup, 20.00));
        return $articles;
    }

    /**
     * @param string $name
     * @param float  $price
     * @param int    $group
     *
     * @return Article
     */
    private function getArticle(string $name, int $group, float $price): Article
    {
        return (new Article())->setName($name)->setGroup($group)->setPrice($price);
    }
}
