<?php

namespace Gamify\Domain\Repository;

use Doctrine\Common\Collections\Collection;
use Gamify\Domain\Entity\Player;
use Gamify\Domain\Entity\Player\PlayerId;

interface PlayerRepositoryInterface
{
    public function persist(Player $player);

    public function getById(PlayerId $id) : Collection;

    public function getByName(string $name) : Collection;

    public function remove(Player $player);
}