<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Domain\ValueObjects;

final class UserIsActive
{
    private $value;

    public function __construct(bool $active)
    {
        $this->value = $active;
    }

    public function value(): bool
    {
        return $this->value;
    }
}
