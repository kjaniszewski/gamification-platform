<?php

namespace Gamify\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gamify\Domain\Entity\Exception\Reward\EventAlreadyAssignedToRewardException;
use Gamify\Domain\Entity\Exception\Reward\RewardItemAlreadyAssignedToRewardException;
use Gamify\Domain\Entity\Reward\Item;
use Gamify\Domain\Entity\Reward\RewardId;
use Gamify\Domain\Entity\Reward\TriggeringEvent;
use Gamify\Domain\Entity\Reward\TriggeringEventId;

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
     * @var bool|null
     */
    private $alwaysTriggered;

    /**
     * @var Collection|TriggeringEvent[]
     */
    private $triggeringEvents;

    /**
     * @var Collection|Item[]
     */
    private $awardedItems;

    /**
     * @var null|Reward
     */
    private $nextRewardInChain;

    /**
     * @var null|Reward
     */
    private $previousRewardInChain;

    /**
     * @var bool
     */
    private $multiple;

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
        $this->multiple = false;
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
     * @return Collection
     */
    public function getTriggeringEvents() : Collection
    {
        return $this->triggeringEvents;
    }

    /**
     * @param Event $event
     * @throws EventAlreadyAssignedToRewardException
     * @throws Exception\InvalidUuidFormatException
     */
    public function addTriggeringEvent(Event $event) : void
    {
        foreach ($this->triggeringEvents as $existingEvent) {
            if ($existingEvent->getEvent()->getId()->isEqual($event->getId())) {
                throw new EventAlreadyAssignedToRewardException;
            }
        }

        $newEvent = new TriggeringEvent(TriggeringEventId::generate(), $this, $event);

        $this->triggeringEvents->add($newEvent);
    }

    /**
     * @param Event $event
     */
    public function removeTriggeringEvent(Event $event) : void
    {
        foreach ($this->triggeringEvents as $existingEvent) {
            if ($existingEvent->getEvent()->getId()->isEqual($event->getId())) {
                $this->triggeringEvents->removeElement($existingEvent);
            }
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
     * @return Collection|Item[]
     */
    public function getAwardedItems() : Collection
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

    public function __toString()
    {
        return (string)$this->id;
    }

    /**
     * @return bool|null
     */
    public function getAlwaysTriggered() : ?bool
    {
        return $this->alwaysTriggered;
    }

    /**
     * @param bool|null $alwaysTriggered
     */
    public function setAlwaysTriggered(?bool $alwaysTriggered) : void
    {
        $this->alwaysTriggered = $alwaysTriggered;
    }

    /**
     * @return Reward|null
     */
    public function getNextRewardInChain()
    {
        return $this->nextRewardInChain;
    }

    /**
     * @param Reward|null $nextRewardInChain
     */
    public function setNextRewardInChain(?Reward $nextRewardInChain) : void
    {
        $this->nextRewardInChain = $nextRewardInChain;
    }

    /**
     * @return Reward|null
     */
    public function getPreviousRewardInChain() : ?Reward
    {
        return $this->previousRewardInChain;
    }

    /**
     * @param Reward|null $previousRewardInChain
     */
    public function setPreviousRewardInChain(?Reward $previousRewardInChain) : void
    {
        $this->previousRewardInChain = $previousRewardInChain;
    }

    /**
     * @return bool
     */
    public function isMultiple() : bool
    {
        return $this->multiple;
    }

    /**
     * @param bool $multiple
     */
    public function setMultiple(bool $multiple) : void
    {
        $this->multiple = $multiple;
    }
}