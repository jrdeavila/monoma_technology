<?php

declare(strict_types=1);

namespace Src\BoundedContext\Lead\Domain\ValueObjects;


final class LeadCreatedBy
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
