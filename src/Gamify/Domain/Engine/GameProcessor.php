<?php


namespace Gamify\Domain\Engine;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ExpressionBuilder;
use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Player;
use Gamify\Domain\Entity\Player\Reward\RewardId;
use Gamify\Domain\Entity\Reward;
use Gamify\Domain\Repository\RewardRepositoryInterface;

class GameProcessor
{
    /**
     * @var RewardRepositoryInterface
     */
    private $rewardRepository;
    /**
     * @var ExpressionInterface
     */
    private $expression;

    /**
     * GameProcessor constructor.
     * @param RewardRepositoryInterface $rewardRepository
     * @param ExpressionInterface $expression
     */
    public function __construct(RewardRepositoryInterface $rewardRepository, ExpressionInterface $expression)
    {
        $this->rewardRepository = $rewardRepository;
        $this->expression = $expression;
    }

    /**
     * @param Player $player
     * @param Event $event
     * @param null|array $customRewardValues
     * @return Collection
     * @throws \Gamify\Domain\Entity\Exception\InvalidUuidFormatException
     * @throws \Gamify\Domain\Entity\Exception\Player\AwardedItemAlreadyAssignedToPlayerException
     */
    public function advance(Player $player, Event $event, ?array $customRewardValues = null) : Collection
    {
        $awardedRewards = new ArrayCollection();

        $playerRewards = $player->getRewards();

        $allRewards = $this->rewardRepository->getByTriggeringEvent($event);
        $this->processRewards($player, $event, $customRewardValues, $allRewards, $playerRewards, $awardedRewards);

        $alwaysTriggered = $this->rewardRepository->getAlwaysTriggered();
        $this->processRewards($player, $event, $customRewardValues, $alwaysTriggered, $playerRewards, $awardedRewards);

        return $awardedRewards;
    }

    /**
     * @param Collection $playerRewards
     * @param Reward $possibleReward
     * @return bool
     */
    public function isRewardAlreadyAwarded(Collection $playerRewards, Reward $possibleReward) : bool
    {
        return $playerRewards->filter(
            function (Player\Reward $playerReward) use ($possibleReward) {
                return (string)$playerReward->getReward()->getId() === (string)$possibleReward->getId();
            }
        )->count() > 0;
    }

    /**
     * @param Player $player
     * @param Event $event
     * @param Reward $possibleReward
     * @param ArrayCollection $awardedRewards
     * @param array|null $customRewardValues
     * @throws \Gamify\Domain\Entity\Exception\InvalidUuidFormatException
     * @throws \Gamify\Domain\Entity\Exception\Player\AwardedItemAlreadyAssignedToPlayerException
     * @throws \Exception
     */
    public function processReward(Player $player, Event $event, Reward $possibleReward, ArrayCollection $awardedRewards, ?array $customRewardValues = []) : void
    {
        if ($this->expression->evaluate($possibleReward->getExpression(), [
                'playerRewards' => $player->getRewards(),
                'playerAwardedItems' => $player->getAwardedItems(),
                'playerSummaries' => $player->getItemSummaries(),
                'criteria' => Criteria::create(),
                'expressionBuilder' => new ExpressionBuilder()
            ]) === true) {
            if (array_key_exists($event->getTextualId(), $customRewardValues)) {
                $awarded = $player->addReward(new Player\Reward(RewardId::generate(), $player, $possibleReward, $event), $customRewardValues[$event->getTextualId()]);
            } else {
                $awarded = $player->addReward(new Player\Reward(RewardId::generate(), $player, $possibleReward, $event));
            }
            foreach ($awarded as $item) {
                $awardedRewards->add($item);
            }
        }
    }

    /**
     * @param Player $player
     * @param Event $event
     * @param array|null $customRewardValues
     * @param $rewards
     * @param $playerRewards
     * @param $awardedRewards
     * @throws \Gamify\Domain\Entity\Exception\InvalidUuidFormatException
     * @throws \Gamify\Domain\Entity\Exception\Player\AwardedItemAlreadyAssignedToPlayerException
     */
    public function processRewards(Player $player, Event $event, ?array $customRewardValues, $rewards, $playerRewards, ArrayCollection $awardedRewards) : void
    {
        /** @var Reward $possibleReward */
        foreach ($rewards as $possibleReward) {
            if (!$possibleReward->isMultiple() && $this->isRewardAlreadyAwarded($playerRewards, $possibleReward)) {
                continue;
            }

            $this->processReward($player, $event, $possibleReward, $awardedRewards, $customRewardValues);
        }
    }
}