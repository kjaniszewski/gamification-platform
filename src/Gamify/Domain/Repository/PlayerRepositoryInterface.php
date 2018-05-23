<?php

namespace Gamify\Domain\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Gamify\Domain\Entity\Player;
use Gamify\Domain\Entity\Player\PlayerId;

interface PlayerRepositoryInterface
{
    public function persist(Player $player);

    public function getById(PlayerId $id) : ArrayCollection;

    public function getByName(string $name) : ArrayCollection;

    public function remove(Player $player);
}