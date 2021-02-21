<?php

namespace App\Services;

use App\Entities\Article;
use Fox\Collection\Collection;
use Fox\Collection\CollectionInterface;

/**
 * This class will create an article from incoming articles
 * PHP version >= 7.0
 *
 * @category Services
 * @package  Goods
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class ArticleMaker
{
    /**
     * ArticleMaker constructor.
     *
     * @param CollectionInterface|Article $articles
     */
    public function __construct(private CollectionInterface|Article $articles)
    {
        if ($this->articles instanceof Article) {
            $this->articles = (new Collection())->add($this->articles);
        }
    }

    /**
     * @return Article[]|Collection
     */
    public function make(): Collection
    {
        $newArticles = new Collection();
        /** @var Article[]|Collection $articleGroups */
        $articleGroups = $this->articles->groupBy("group");
        foreach ($articleGroups as $groupId => $articles) {
            if ($this->isDefaultGroup($groupId)) {
                $newArticles->merge($articles);
                continue;
            }
            $newArticles->merge($this->handleOtherGroup($groupId, $articles));
        }
        return $newArticles;
    }

    /**
     * @param $groupId
     *
     * @return bool
     */
    private function isDefaultGroup($groupId): bool
    {
        return $groupId == config("groups.default_group");
    }

    /**
     * @param int        $groupId
     * @param Collection $articles
     *
     * @return Collection
     */
    private function handleOtherGroup(int $groupId, Collection $articles): Collection
    {
        $group = new Collection();
        $article = new Article();
        $article->setName(implode(", ", array_keys($articles->groupBy("name")->toArray())))
            ->setGroup($groupId)
            ->setPrice($articles->sum("price"));
        $group->add($article);
        return $group;
    }
}
