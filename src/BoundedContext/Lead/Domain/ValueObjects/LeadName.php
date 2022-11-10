<?php

declare(strict_types=1);

namespace Src\BoundedContext\Lead\Domain\ValueObjects;

final class LeadName
{
    private $value;

    public function __construct(string $name)
    {
        $this->value = $name;
    }

    public function value(): string
    {
        return $this->value;
    }
}
