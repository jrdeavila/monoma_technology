<?php

declare(strict_types=1);

namespace Src\BoundedContext\Lead\Domain\ValueObjects;

final class LeadSource
{
    private $value;

    public function __construct(string $source)
    {
        $this->value = $source;
    }

    public function value(): string
    {
        return $this->value;
    }
}
