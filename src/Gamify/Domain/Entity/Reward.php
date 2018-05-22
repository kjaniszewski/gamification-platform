<?php

namespace Gamify\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Gamify\Domain\Entity\Exception\Reward\EventAlreadyAssignedToRewardException;
use Gamify\Domain\Entity\Exception\Reward\RewardItemAlreadyAssignedToRewardException;
use Gamify\Domain\Entity\Reward\Item;
use Gamify\Domain\Entity\Reward\RewardId;

class Reward
{
    /**
     * @var RewardId
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
     * @var string
     */
    private $expression;

    /**
     * @var ArrayCollection|Event[]
     */
    private $triggeringEvents;

    /**
     * @var ArrayCollection|Item[]
     */
    private $awardedItems;

    /**
     * Player constructor.
     * @param RewardId $id
     * @param string $name
     * @param string $textualId
     * @param string $expression
     */
    public function __construct(RewardId $id, string $name, string $textualId, string $expression)
    {
        $this->id = $id;
        $this->name = $name;
        $this->textualId = $textualId;
        $this->triggeringEvents = new ArrayCollection();
        $this->awardedItems = new ArrayCollection();
        $this->expression = $expression;
    }

    /**
     * @return RewardId
     */
    public function getId() : RewardId
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

    /**
     * @return ArrayCollection
     */
    public function getTriggeringEvents() : ArrayCollection
    {
        return $this->triggeringEvents;
    }

    /**
     * @param Event $event
     * @throws EventAlreadyAssignedToRewardException
     */
    public function addTriggeringEvent(Event $event) : void
    {
        if ($this->triggeringEvents->contains($event)) {
            throw new EventAlreadyAssignedToRewardException;
        }

        $this->triggeringEvents[] = $event;
    }

    /**
     * @param Event $event
     */
    public function removeTriggeringEvent(Event $event) : void
    {
        if ($this->triggeringEvents->contains($event)) {
            $this->triggeringEvents->removeElement($event);
            return;
        }
    }

    /**
     * @return string
     */
    public function getExpression() : string
    {
        return $this->expression;
    }

    /**
     * @param string $expression
     */
    public function setExpression(string $expression) : void
    {
        $this->expression = $expression;
    }

    /**
     * @return ArrayCollection|Item[]
     */
    public function getAwardedItems() : ArrayCollection
    {
        return $this->awardedItems;
    }

    /**
     * @param Item $item
     * @throws RewardItemAlreadyAssignedToRewardException
     */
    public function addAwardedItem(Item $item) : void
    {
        if ($this->awardedItems->contains($item)) {
            throw new RewardItemAlreadyAssignedToRewardException;
        }

        $this->awardedItems[] = $item;
    }

    /**
     * @param Item $item
     */
    public function removeAwardedItem(Item $item) : void
    {
        if ($this->awardedItems->contains($item)) {
            $this->awardedItems->removeElement($item);
            return;
        }
    }
}