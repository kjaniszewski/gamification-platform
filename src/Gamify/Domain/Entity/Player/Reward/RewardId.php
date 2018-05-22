<?php

declare(strict_types=1);

namespace Gamify\Domain\Entity\Player\Reward;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;

class RewardId extends BaseId
{
    /**
     * @return BaseId|RewardId
     * @throws InvalidUuidFormatException
     */
    public static function generate() : RewardId
    {
        return new self(BaseId::generate());
    }
}
