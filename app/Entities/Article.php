<?php

namespace App\Entities;

/**
 * The article entity
 * PHP version >= 7.0
 *
 * @category Entities
 * @package  Goods
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
class Article implements Entity
{
    /**
     * Specifies a description of the item
     *
     * @var string
     */
    private string $name;

    /**
     * Specifies the item group id
     *
     * @var mixed
     */
    private $group;

    /**
     * Specifies the price
     *
     * @var float
     */
    private float $price;

    /**
     * @return string
     */
    public function __toString(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * @param string $name
     *
     * @return Article
     */
    public function setName(string $name): Article
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param mixed $group
     *
     * @return Article
     */
    public function setGroup($group): Article
    {
        $this->group = $group;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param float $price
     *
     * @return Article
     */
    public function setPrice(float $price): Article
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "name" => $this->name,
            "group" => $this->group,
            "price" => $this->price
        ];
    }
}
