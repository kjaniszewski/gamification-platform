<?php

declare(strict_types=1);

namespace Gamify\Domain\Entity\Player\AwardedItem;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;

class AwardedItemId extends BaseId
{
    /**
     * @return BaseId|AwardedItemId
     * @throws InvalidUuidFormatException
     */
    public static function generate() : AwardedItemId
    {
        return new self(BaseId::generate());
    }
}
