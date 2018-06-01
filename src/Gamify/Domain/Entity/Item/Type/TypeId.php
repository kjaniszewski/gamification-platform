<?php

declare(strict_types=1);

namespace Gamify\Domain\Entity\Item\Type;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;

class TypeId extends BaseId
{
    /**
     * @return BaseId|TypeId
     * @throws InvalidUuidFormatException
     */
    public static function generate() : TypeId
    {
        return new self(BaseId::generate());
    }
}
