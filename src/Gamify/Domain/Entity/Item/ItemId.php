<?php

declare(strict_types=1);

namespace Gamify\Domain\Entity\Item;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;

class ItemId extends BaseId
{
    /**
     * @return BaseId|ItemId
     * @throws InvalidUuidFormatException
     */
    public static function generate() : ItemId
    {
        return new self(BaseId::generate());
    }
}
