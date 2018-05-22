<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */
/** @noinspection AccessModifierPresentedInspection */

namespace spec\Gamify\Domain\Entity;

use Gamify\Domain\Entity\Event;
use PhpSpec\ObjectBehavior;

class EventSpec extends ObjectBehavior
{
    const EVENT_NAME = 'User login';
    const EVENT_TEXTUAL_ID = 'user.login';

    function let() {
        $this->beConstructedWith(Event\EventId::generate(), self::EVENT_NAME, self::EVENT_TEXTUAL_ID);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Event::class);
    }
}
