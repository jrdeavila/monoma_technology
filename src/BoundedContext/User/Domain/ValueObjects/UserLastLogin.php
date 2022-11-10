<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Domain\ValueObjects;

use DateTime;

final class UserLastLogin
{
    private $value;

    public function __construct(?DateTime $dateTime)
    {
        $this->value = $dateTime;
    }

    public function value(): ?DateTime
    {
        return $this->value;
    }
}
