<?php

namespace Gamify\Domain\Repository;

use Doctrine\Common\Collections\Collection;
use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Event\EventId;

interface EventRepositoryInterface
{
    public function persist(Event $event);

    public function getById(EventId $id) : Collection;

    public function getByTextualId(string $id) : Collection;

    public function getByName(string $name) : Collection;

    public function remove(Event $event);
}