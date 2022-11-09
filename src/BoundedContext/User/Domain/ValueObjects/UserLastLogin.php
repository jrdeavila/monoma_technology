<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Domain\ValueObjects;

use DateTime;

final class UserLastLogin
{
    private $value;

    public function __construct(?DateTime $password)
    {
        $this->value = $password;
    }

    public function value(): ?DateTime
    {
        return $this->value;
    }
}
