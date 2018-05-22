<?php

declare(strict_types=1);

namespace Gamify\Domain\Entity\Event;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;

class EventId extends BaseId
{
    /**
     * @return BaseId|EventId
     * @throws InvalidUuidFormatException
     */
    public static function generate() : EventId
    {
        return new self(BaseId::generate());
    }
}
