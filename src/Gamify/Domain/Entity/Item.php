<?php

namespace Gamify\Domain\Entity;


use Gamify\Domain\Entity\Item\ItemId;

class Item
{
    /**
     * @var ItemId
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
     * @var bool
     */
    private $cummulative;

    /**
     * Player constructor.
     * @param ItemId $id
     * @param string $name
     * @param string $textualId
     * @param bool $cummulative
     */
    public function __construct(ItemId $id, string $name, string $textualId, bool $cummulative)
    {
        $this->id = $id;
        $this->name = $name;
        $this->textualId = $textualId;
        $this->cummulative = $cummulative;
    }

    /**
     * @return ItemId
     */
    public function getId() : ItemId
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

    /**
     * @return bool
     */
    public function isCummulative() : bool
    {
        return $this->cummulative;
    }

    /**
     * @param bool $cummulative
     */
    public function setCummulative(bool $cummulative) : void
    {
        $this->cummulative = $cummulative;
    }

    public function __toString()
    {
        return (string)$this->id;
    }


}