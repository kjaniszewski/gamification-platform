<?php

declare(strict_types=1);

namespace Gamify\Domain\Entity\Player;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;

class PlayerId extends BaseId
{
    /**
     * @return BaseId|PlayerId
     * @throws InvalidUuidFormatException
     */
    public static function generate() : PlayerId
    {
        return new self(BaseId::generate());
    }
}
