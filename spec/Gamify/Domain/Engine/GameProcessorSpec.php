<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */
/** @noinspection AccessModifierPresentedInspection */

namespace spec\Gamify\Domain\Engine;

use Doctrine\Common\Collections\ArrayCollection;
use Gamify\Domain\Engine\ExpressionInterface;
use Gamify\Domain\Engine\GameProcessor;
use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Player;
use Gamify\Domain\Entity\Reward;
use Gamify\Domain\Repository\RewardRepositoryInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class GameProcessorSpec extends ObjectBehavior
{
    function let(RewardRepositoryInterface $rewardRepository, ExpressionInterface $expression) {
        $this->beConstructedWith($rewardRepository, $expression);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(GameProcessor::class);
    }

    function it_should_advance_player_after_completed_event (
        Player $player,
        Event $event,
        RewardRepositoryInterface $rewardRepository,
        Reward $reward,
        ExpressionInterface $expression)
    {
        $rewardRepository->getByTriggeringEvent($event)->willReturn(new ArrayCollection([$reward->getWrappedObject()]));
        $reward->getExpression()->willReturn('reward.id = 0');
        $expression->evaluate(Argument::any(), Argument::type('array'))->willReturn(true);
        /** @noinspection PhpParamsInspection */
        $player->addReward(Argument::any())->shouldBeCalled();
        $player->getRewards()->willReturn(new ArrayCollection());
        $player->getAwardedItems()->willReturn(new ArrayCollection());
        $player->getItemSummaries()->willReturn([]);

        $awardedRewards = $this->advance($player, $event);
        $awardedRewards->count()->shouldReturn(1);
    }

    function it_should_not_award_same_reward_twice (
        Player $player,
        Event $event,
        RewardRepositoryInterface $rewardRepository,
        Reward $reward,
        ExpressionInterface $expression,
        Player\Reward $playerReward)
    {
        $rewardRepository->getByTriggeringEvent($event)->willReturn(new ArrayCollection([$reward->getWrappedObject()]));
        $reward->getExpression()->willReturn('reward.id = 0');
        $reward->getId()->willReturn(Reward\RewardId::generate());

        $expression->evaluate(Argument::any())->willReturn(true);

        $playerReward->getReward()->willReturn($reward);
        $player->getRewards()->willReturn(new ArrayCollection([$playerReward->getWrappedObject()]));

        /** @noinspection PhpParamsInspection */
        $player->addReward(Argument::any())->shouldNotBeCalled();

        $this->advance($player, $event);
    }
}
