<?php

namespace Gamify\Domain\Repository;

use Doctrine\Common\Collections\Collection;
use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Reward;
use Gamify\Domain\Entity\Reward\RewardId;

interface RewardRepositoryInterface
{
    public function persist(Reward $reward);

    public function getById(RewardId $id) : Reward;

    public function getByTextualId(string $id) : Reward;

    public function getByTriggeringEvent(Event $event) : Collection;

    public function remove(Reward $reward);
}