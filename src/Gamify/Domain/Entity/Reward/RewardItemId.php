<?php

declare(strict_types=1);

namespace Gamify\Domain\Entity\Reward;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;

class RewardItemId extends BaseId
{
    /**
     * @return BaseId|RewardItemId
     * @throws InvalidUuidFormatException
     */
    public static function generate() : RewardItemId
    {
        return new self(BaseId::generate());
    }
}
