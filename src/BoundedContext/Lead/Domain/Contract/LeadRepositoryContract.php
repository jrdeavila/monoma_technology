<?php

namespace Src\BoundedContext\Lead\Domain\Contract;

use Src\BoundedContext\Lead\Domain\Lead;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadId;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadOwner;

interface LeadRepositoryContract
{
    public function all(): array;
    public function findById(LeadId $id): ?Lead;
    public function findByOwner(LeadOwner $owner): array;
    public function save(Lead $lead): Lead;
}
