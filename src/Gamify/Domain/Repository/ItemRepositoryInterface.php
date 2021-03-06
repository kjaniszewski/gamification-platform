<?php

namespace Gamify\Domain\Repository;

use Doctrine\Common\Collections\Collection;
use Gamify\Domain\Entity\Item;
use Gamify\Domain\Entity\Item\ItemId;

interface ItemRepositoryInterface
{
    public function persist(Item $item);

    public function getById(ItemId $id) : Item;

    public function getByTextualId(string $id) : Item;

    public function getByName(string $name) : Collection;

    public function remove(Item $item);
}