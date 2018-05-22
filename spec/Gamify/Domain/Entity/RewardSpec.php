<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */
/** @noinspection AccessModifierPresentedInspection */

namespace spec\Gamify\Domain\Entity;

use Gamify\Domain\Entity\Event;
use Gamify\Domain\Entity\Exception\Reward\EventAlreadyAssignedToRewardException;
use Gamify\Domain\Entity\Reward;
use PhpSpec\ObjectBehavior;

class RewardSpec extends ObjectBehavior
{
    const REWARD_NAME = 'System user';
    const REWARD_TEXTUAL_ID = 'system.user';
    const REWARD_EXPRESSION = '1==1';

    function let()
    {
        $this->beConstructedWith(Reward\RewardId::generate(), self::REWARD_NAME, self::REWARD_TEXTUAL_ID, self::REWARD_EXPRESSION);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Reward::class);
    }

    function it_should_not_allow_add_duplicate_events(Event $event)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $event->getId()->willReturn(Event\EventId::generate());

        $this->addTriggeringEvent($event);
        $this->shouldThrow(EventAlreadyAssignedToRewardException::class)->during('addTriggeringEvent', [$event]);
    }

    function it_should_add_triggering_events(Event $event)
    {
        $this->addTriggeringEvent($event);

        $this->getTriggeringEvents()->shouldHaveCount(1);
    }

    function it_should_remove_triggering_event(Event $event)
    {
        $event->getId()->willReturn(Event\EventId::generate());

        $this->addTriggeringEvent($event);
        $this->removeTriggeringEvent($event);
        $this->getTriggeringEvents()->shouldHaveCount(0);
    }
}
