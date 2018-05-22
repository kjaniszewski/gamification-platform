<?php

namespace Gamify\Domain\Entity\Reward;


use Gamify\Domain\Entity\Reward;

class Item
{
    /**
     * @var RewardItemId
     */
    private $id;

    /**
     * @var \Gamify\Domain\Entity\Item
     */
    private $item;

    /**
     * @var Reward
     */
    private $reward;

    /**
     * @var null|integer
     */
    private $value;

    /**
     * Player constructor.
     * @param RewardItemId $id
     * @param Item $item
     * @param Reward $reward
     */
    public function __construct(RewardItemId $id, Item $item, Reward $reward)
    {
        $this->id = $id;
        $this->item = $item;
        $this->reward = $reward;
    }

    /**
     * @return int|null
     */
    public function getValue() : ?int
    {
        return $this->value;
    }

    /**
     * @param int|null $value
     */
    public function setValue(?int $value) : void
    {
        $this->value = $value;
    }

    /**
     * @return \Gamify\Domain\Entity\Reward\RewardItemId
     */
    public function getId() : \Gamify\Domain\Entity\Reward\RewardItemId
    {
        return $this->id;
    }

    /**
     * @return \Gamify\Domain\Entity\Item
     */
    public function getItem() : \Gamify\Domain\Entity\Item
    {
        return $this->item;
    }

    /**
     * @return Reward
     */
    public function getReward() : Reward
    {
        return $this->reward;
    }
}