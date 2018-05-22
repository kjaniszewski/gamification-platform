<?php

namespace Gamify\Domain\Entity\Player;

use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Player;
use Gamify\Domain\Entity\Player\AwardedItem\AwardedItemId;
use Gamify\Domain\Entity\Reward\Item;

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
     * @var \Gamify\Domain\Entity\Reward\Item
     */
    private $item;

    /**
     * @var Event
     */
    private $event;

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
     * @throws \Exception
     */
    public function __construct(AwardedItemId $id, Player $player, \Gamify\Domain\Entity\Reward $reward, Item $item, Event $event)
    {
        $this->id = $id;
        $this->player = $player;
        $this->reward = $reward;
        $this->event = $event;
        $this->createdAt = new \DateTimeImmutable();
        $this->item = $item;
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
}