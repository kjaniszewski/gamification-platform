<?php

namespace Gamify\Domain\Entity\Reward;


use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Reward;

class TriggeringEvent
{
    /**
     * @var TriggeringEventId
     */
    private $id;

    /**
     * @var Event
     */
    private $event;

    /**
     * @var Reward
     */
    private $reward;

    /**
     * Player constructor.
     * @param TriggeringEventId $id
     * @param Reward $reward
     * @param Event $event
     */
    public function __construct(TriggeringEventId $id, Reward $reward, Event $event)
    {
        $this->id = $id;
        $this->event = $event;
        $this->reward = $reward;
    }

    /**
     * @return TriggeringEventId
     */
    public function getId() : TriggeringEventId
    {
        return $this->id;
    }

    /**
     * @return Event
     */
    public function getEvent() : Event
    {
        return $this->event;
    }

    /**
     * @return Reward
     */
    public function getReward() : Reward
    {
        return $this->reward;
    }

    /**
     * @param Event $event
     */
    public function setEvent(Event $event) : void
    {
        $this->event = $event;
    }

    /**
     * @param Reward $reward
     */
    public function setReward(Reward $reward) : void
    {
        $this->reward = $reward;
    }
}