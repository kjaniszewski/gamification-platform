<?php

declare(strict_types=1);

namespace Gamify\Domain\Entity\Reward;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;

class TriggeringEventId extends BaseId
{
    /**
     * @return BaseId|TriggeringEventId
     * @throws InvalidUuidFormatException
     */
    public static function generate() : TriggeringEventId
    {
        return new self(BaseId::generate());
    }
}
