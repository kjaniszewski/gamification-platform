<?php

namespace Gamify\Domain\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Event\EventId;

interface EventRepositoryInterface
{
    public function persist(Event $event);

    public function getById(EventId $id) : ArrayCollection;

    public function getByTextualId(string $id) : ArrayCollection;

    public function getByName(string $name) : ArrayCollection;

    public function remove(Event $event);
}