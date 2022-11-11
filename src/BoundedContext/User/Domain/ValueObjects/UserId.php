<?php

declare(strict_types=1);

namespace Src\BoundedContext\User\Domain\ValueObjects;

use InvalidArgumentException;

final class UserId
{
    private $value;

    public function __construct(string $id)
    {
        $this->value = $id;
    }

    public function value(): string
    {
        return $this->value;
    }
}
