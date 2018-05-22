<?php

namespace Gamify\Domain\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Reward;
use Gamify\Domain\Entity\Reward\RewardId;

interface RewardRepositoryInterface
{
    public function persist(Reward $achievement);

    public function getById(RewardId $id) : ArrayCollection;

    public function getByTextualId(string $id) : ArrayCollection;

    public function getByTriggeringEvent(Event $event) : ArrayCollection;

    public function remove(Reward $achievement);
}