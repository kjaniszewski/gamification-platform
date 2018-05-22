<?php

namespace Gamify\Domain\Entity\Player;

use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Player;
use Gamify\Domain\Entity\Player\Reward\RewardId;

class Reward
{
    /**
     * @var RewardId
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
     * @var Event
     */
    private $event;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Player constructor.
     * @param RewardId $id
     * @param Player $player
     * @param \Gamify\Domain\Entity\Reward $reward
     * @param Event $event
     * @throws \Exception
     */
    public function __construct(RewardId $id, Player $player, \Gamify\Domain\Entity\Reward $reward, Event $event)
    {
        $this->id = $id;
        $this->player = $player;
        $this->reward = $reward;
        $this->event = $event;
        $this->createdAt = new \DateTimeImmutable();
    }

    /**
     * @return RewardId
     */
    public function getId() : RewardId
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
}