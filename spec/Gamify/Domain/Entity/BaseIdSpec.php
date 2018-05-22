<?php
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection ReturnTypeCanBeDeclaredInspection */
/** @noinspection AccessModifierPresentedInspection */

namespace spec\Gamify\Domain\Entity;

use Gamify\Domain\Entity\BaseId;
use Gamify\Domain\Entity\Exception\InvalidUuidFormatException;
use PhpSpec\ObjectBehavior;

class BaseIdSpec extends ObjectBehavior
{
    private const CORRECT_IDENTIFIER = '3efaf8dc-e9c1-474c-e80b-2fb95cf61312';
    private const INCORRECT_IDENTIFIER = '3efaf8dc';

    function let()
    {
        $this->beConstructedWith(self::CORRECT_IDENTIFIER);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BaseId::class);
    }

    function it_checks_for_correct_format()
    {
        $this->beConstructedWith(self::INCORRECT_IDENTIFIER);
        $this->shouldThrow(InvalidUuidFormatException::class)->duringInstantiation();

        $this->beConstructedWith(self::CORRECT_IDENTIFIER);
        $this->__toString()->shouldBeEqualTo(self::CORRECT_IDENTIFIER);
    }

    function it_can_compare_two_identifiers() {
        $this->beConstructedWith(self::CORRECT_IDENTIFIER);
        $this->isEqual(new BaseId(self::CORRECT_IDENTIFIER))->shouldReturn(true);
    }
}
