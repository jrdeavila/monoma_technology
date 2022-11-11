<?php

namespace Src\BoundedContext\Lead\Application;

use Src\BoundedContext\Lead\Domain\Contract\LeadRepositoryContract;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadOwner;

class GetLeadsByOwnerUseCase
{

    private LeadRepositoryContract $repository;

    public function __construct(LeadRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $owner): array
    {
        return $this->repository->findByOwner(new LeadOwner($owner));
    }
}
