<?php


namespace Gamify\Domain\Engine;


use Doctrine\Common\Collections\ArrayCollection;
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
     * @return ArrayCollection
     * @throws \Exception
     */
    public function advance(Player $player, Event $event) : ArrayCollection
    {
        $awardedRewards = new ArrayCollection();

        $allRewards = $this->rewardRepository->getByTriggeringEvent($event);
        $playerRewards = $player->getRewards();

        /** @var Reward $possibleReward */
        foreach ($allRewards as $possibleReward) {
            if ($this->isRewardAlreadyAwarded($playerRewards, $possibleReward)) {
                continue;
            }

            if ($this->expression->evaluate($possibleReward->getExpression(), [
                    'playerRewards' => $player->getRewards(),
                    'playerAwardedItems' => $player->getAwardedItems(),
                    'playerSummaries' => $player->getItemSummaries()
                ]) === true) {
                $player->addReward(new Player\Reward(RewardId::generate(), $player, $possibleReward, $event));
                $awardedRewards->add($possibleReward);
            }
        }

        return $awardedRewards;
    }

    /**
     * @param ArrayCollection $playerRewards
     * @param Reward $possibleReward
     * @return bool
     */
    public function isRewardAlreadyAwarded(ArrayCollection $playerRewards, Reward $possibleReward) : bool
    {
        return $playerRewards->filter(
            function (Player\Reward $playerReward) use ($possibleReward) {
                return (string)$playerReward->getReward()->getId() === (string)$possibleReward->getId();
            }
        )->count() > 0;
    }
}