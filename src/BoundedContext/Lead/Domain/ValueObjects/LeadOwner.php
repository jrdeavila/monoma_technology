<?php

declare(strict_types=1);

namespace Src\BoundedContext\Lead\Domain\ValueObjects;

use InvalidArgumentException;

final class LeadOwner
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
