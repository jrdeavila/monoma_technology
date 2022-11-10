<?php

declare(strict_types=1);

namespace Src\BoundedContext\Lead\Domain\ValueObjects;

use DateTime;

final class LeadCreatedAt
{
    private $value;

    public function __construct(?DateTime $datetime)
    {
        $this->value = $datetime;
    }

    public function value(): ?DateTime
    {
        return $this->value;
    }
}
