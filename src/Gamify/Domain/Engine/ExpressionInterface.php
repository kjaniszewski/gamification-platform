<?php

namespace Gamify\Domain\Engine;


interface ExpressionInterface
{
    public function evaluate($expression, $values = array());
}