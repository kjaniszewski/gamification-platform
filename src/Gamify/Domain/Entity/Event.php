<?php

namespace Gamify\Domain\Entity;


use Gamify\Domain\Entity\Event\EventId;

class Event
{
    /**
     * @var EventId
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
     * @var string
     */
    private $description;

    /**
     * Player constructor.
     * @param EventId $id
     * @param string $name
     * @param string $textualId
     */
    public function __construct(EventId $id, string $name, string $textualId)
    {
        $this->id = $id;
        $this->name = $name;
        $this->textualId = $textualId;
    }

    /**
     * @return EventId
     */
    public function getId() : EventId
    {
        return $this->id;
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
     * @return null|string
     */
    public function getDescription() : ?string
    {
        return $this->description;
    }

    /**
     * @param null|string $description
     */
    public function setDescription(?string $description) : void
    {
        $this->description = $description;
    }
}