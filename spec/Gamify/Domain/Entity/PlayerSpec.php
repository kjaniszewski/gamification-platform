<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */
/** @noinspection AccessModifierPresentedInspection */

namespace spec\Gamify\Domain\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Item;
use Gamify\Domain\Entity\Player;
use Gamify\Domain\Entity\Reward;
use PhpSpec\ObjectBehavior;

class PlayerSpec extends ObjectBehavior
{
    const PLAYER_NAME = 'john.doe';

    function let() {
        $this->beConstructedWith(Player\PlayerId::generate(), self::PLAYER_NAME);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Player::class);
    }

    function it_saves_awarded_items_upon_adding_rewards(
        Reward $reward,
        Player\Reward $playerReward,
        Event $event,
        Reward\Item $awardedItem,
        Item $item
    )
    {
        $playerReward->getReward()->willReturn($reward);
        $playerReward->getEvent()->willReturn($event);
        $reward->getAwardedItems()->willReturn(new ArrayCollection([$awardedItem->getWrappedObject()]));
        $item->getTextualId()->willReturn('item.id');
        $item->isCummulative()->willReturn(false);
        $item->getName()->willReturn('Item name');
        $awardedItem->getItem()->willReturn($item);

        $this->addReward($playerReward);

        $this->getAwardedItems()->count()->shouldReturn(1);
    }

    function it_updates_item_summary_on_adding_rewards(
        Reward $reward,
        Player\Reward $playerReward,
        Event $event,
        Reward\Item $awardedItem,
        Item $item
    )
    {
        $playerReward->getReward()->willReturn($reward);
        $playerReward->getEvent()->willReturn($event);
        $reward->getAwardedItems()->willReturn(new ArrayCollection([$awardedItem->getWrappedObject()]));
        $item->isCummulative()->willReturn(false);
        $item->getTextualId()->willReturn('reward.test');
        $item->getName()->willReturn('Reward test');
        $awardedItem->getItem()->willReturn($item);

        $this->addReward($playerReward);

        $this->getItemSummaries()->shouldHaveKeyWithValue('reward.test', 'Reward test');
    }

    function it_summarizes_item_values_on_adding_rewards(
        Reward $reward,
        Player\Reward $playerReward,
        Event $event,
        Reward\Item $awardedItem,
        Item $item
    )
    {
        $playerReward->getReward()->willReturn($reward);
        $playerReward->getEvent()->willReturn($event);
        $reward->getAwardedItems()->willReturn(new ArrayCollection([$awardedItem->getWrappedObject()]));
        $item->isCummulative()->willReturn(true);
        $item->getTextualId()->willReturn('reward.test');
        $item->getName()->willReturn('Reward test');
        $awardedItem->getItem()->willReturn($item);
        $awardedItem->getValue()->willReturn(1);

        $this->addReward($playerReward);

        $this->getItemSummaries()->shouldHaveKeyWithValue('reward.test', 1);
    }
}
