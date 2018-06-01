<?php

namespace Gamify\Domain\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Gamify\Domain\Entity\Exception\Player\AwardedItemAlreadyAssignedToPlayerException;
use Gamify\Domain\Entity\Player\AwardedItem;
use Gamify\Domain\Entity\Player\PlayerId;
use Gamify\Domain\Entity\Player\Reward;

class Player
{
    /**
     * @var PlayerId
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var Collection|Reward[]
     */
    private $rewards;

    /**
     * @var Collection|AwardedItem[]
     */
    private $awardedItems;

    /**
     * @var array
     */
    private $itemSummaries;

    /**
     * Player constructor.
     * @param PlayerId $id
     * @param string $name
     */
    public function __construct(PlayerId $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
        $this->rewards = new ArrayCollection();
        $this->awardedItems = new ArrayCollection();
        $this->itemSummaries = [];
    }

    /**
     * @return PlayerId
     */
    public function getId() : PlayerId
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
     * @return Collection|Reward[]
     */
    public function getRewards()
    {
        return $this->rewards;
    }

    /**
     * @param Reward $reward
     * @param array|null $customValues
     * @return Collection
     * @throws AwardedItemAlreadyAssignedToPlayerException
     * @throws Exception\InvalidUuidFormatException
     * @throws \Exception
     */
    public function addReward(Reward $reward, ?array $customValues = []) : Collection
    {
        $this->rewards->add($reward);

        $awardedItems = new ArrayCollection();

        foreach ($reward->getReward()->getAwardedItems() as $awardedItem) {
            $value = $awardedItem->getValue();

            if (array_key_exists($awardedItem->getItem()->getTextualId(), $customValues)) {
                $value = $customValues[$awardedItem->getItem()->getTextualId()];
            }
            $item = new AwardedItem(AwardedItem\AwardedItemId::generate(), $this, $reward->getReward(), $awardedItem->getItem(), $reward->getEvent(), $value);
            $this->addAwardedItem($item);
            $awardedItems->add($item);
        }

        return $awardedItems;
    }

    /**
     * @return Collection|AwardedItem[]
     */
    public function getAwardedItems() : Collection
    {
        return $this->awardedItems;
    }

    /**
     * @param AwardedItem $awardedItem
     * @throws AwardedItemAlreadyAssignedToPlayerException
     */
    public function addAwardedItem(AwardedItem $awardedItem) : void
    {
        if ($this->awardedItems->contains($awardedItem)) {
            throw new AwardedItemAlreadyAssignedToPlayerException;
        }

        $this->awardedItems->add($awardedItem);
        $this->updateSummaries($awardedItem);
    }

    /**
     * @param AwardedItem $awardedItem
     */
    public function removeAwardedItem(AwardedItem $awardedItem) : void
    {
        if ($this->awardedItems->contains($awardedItem)) {
            $this->awardedItems->removeElement($awardedItem);
            return;
        }
    }

    /**
     * @return array
     */
    public function getItemSummaries() : array
    {
        return $this->itemSummaries;
    }

    /**
     * @param AwardedItem $awardedItem
     */
    public function updateSummaries(AwardedItem $awardedItem) : void
    {
        $item = $awardedItem->getItem();
        $group = $item->getType()->getTextualId();
        $itemId = $item->getTextualId();

        if (!array_key_exists($group, $this->itemSummaries)) {
            $this->itemSummaries[$group] = [];
        }

        if (!array_key_exists($itemId, $this->itemSummaries[$group])) {
            $this->itemSummaries[$group][$itemId] = null;
        }

        if ($item->isCummulative()) {
            $this->itemSummaries[$group][$itemId] += $awardedItem->getValue();
        } else if ($awardedItem->getValue() !== null) {
            $this->itemSummaries[$group][$itemId] = $awardedItem->getValue();
        } else {
            $this->itemSummaries[$group][$itemId] = $item->getName();
        }
    }
}