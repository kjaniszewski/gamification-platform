<?php
declare(strict_types=1);

namespace Gamify\Domain\Entity;

use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;
use Ramsey\Uuid\Uuid;

class BaseId
{
    /**
     * @var string
     */
    private $value;

    /**
     * @param $id
     *
     * @throws InvalidUuidFormatException
     */
    public function __construct($id)
    {
        if (!preg_match('/' . Uuid::VALID_PATTERN . '/', (string)$id)) {
            throw new InvalidUuidFormatException();
        }

        $this->value = (string)$id;
    }

    /** @noinspection ReturnTypeCanBeDeclaredInspection */

    /**
     * @return BaseId
     * @throws InvalidUuidFormatException
     */
    public static function generate()
    {
        return new BaseId(Uuid::uuid4());
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->value;
    }

    /**
     * @param BaseId $id
     * @return bool
     */
    public function isEqual(BaseId $id) : bool
    {
        return $this->value === $id->value;
    }
}