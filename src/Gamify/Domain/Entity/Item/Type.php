<?php

namespace Gamify\Domain\Entity\Item;


use Gamify\Domain\Entity\Item\Type\TypeId;

class Type
{
    /**
     * @var TypeId
     */
    private $id;

    /**
     * @var string
     */
    private $textualId;

    /**
     * @var string
     */
    private $name;

    /**
     * Player constructor.
     * @param TypeId $id
     * @param string $name
     * @param string $textualId
     */
    public function __construct(TypeId $id, string $name, string $textualId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->textualId = $textualId;
    }

    /**
     * @return TypeId
     */
    public function getId() : TypeId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTextualId() : string
    {
        return $this->textualId;
    }

    /**
     * @param string $textualId
     */
    public function setTextualId(string $textualId) : void
    {
        $this->textualId = $textualId;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return (string)$this->id;
    }


}