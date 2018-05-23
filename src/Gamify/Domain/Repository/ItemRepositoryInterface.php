<?php

namespace Gamify\Domain\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Gamify\Domain\Entity\Item;
use Gamify\Domain\Entity\Item\ItemId;

interface ItemRepositoryInterface
{
    public function persist(Item $item);

    public function getById(ItemId $id) : ArrayCollection;

    public function getByTextualId(string $id) : ArrayCollection;

    public function getByName(string $name) : ArrayCollection;

    public function remove(Item $item);
}