<?php

namespace Gamify\Domain\Entity\Player;

use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Item;
use Gamify\Domain\Entity\Player;
use Gamify\Domain\Entity\Player\AwardedItem\AwardedItemId;

class AwardedItem
{
    /**
     * @var AwardedItemId
     */
    private $id;

    /**
     * @var Player
     */
    private $player;

    /**
     * @var \Gamify\Domain\Entity\Reward
     */
    private $reward;

    /**
     * @var \Gamify\Domain\Entity\Item
     */
    private $item;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var string|null
     */
    private $value;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Player constructor.
     * @param AwardedItemId $id
     * @param Player $player
     * @param \Gamify\Domain\Entity\Reward $reward
     * @param Item $item
     * @param Event $event
     * @param null|string $value
     * @throws \Exception
     */
    public function __construct(AwardedItemId $id, Player $player, \Gamify\Domain\Entity\Reward $reward, Item $item, Event $event, ?string $value)
    {
        $this->id = $id;
        $this->player = $player;
        $this->reward = $reward;
        $this->event = $event;
        $this->createdAt = new \DateTimeImmutable();
        $this->item = $item;
        $this->value = $value;
    }

    /**
     * @return AwardedItemId
     */
    public function getId() : AwardedItemId
    {
        return $this->id;
    }

    /**
     * @return Player
     */
    public function getPlayer() : Player
    {
        return $this->player;
    }

    /**
     * @return \Gamify\Domain\Entity\Reward
     */
    public function getReward() : \Gamify\Domain\Entity\Reward
    {
        return $this->reward;
    }

    /**
     * @return Event
     */
    public function getEvent() : Event
    {
        return $this->event;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Item
     */
    public function getItem() : Item
    {
        return $this->item;
    }

    /**
     * @return null|string
     */
    public function getValue() : ?string
    {
        return $this->value;
    }
}