<?php

namespace App\Entities;

/**
 * The group entity
 * PHP version >= 7.0
 *
 * @category Entities
 * @package  Goods
 * @author   Hamed Ghasempour <hamedghasempour@gmail.com>
 */
interface Entity
{
    /**
     * @return array
     */
    public function toArray(): array;
}
