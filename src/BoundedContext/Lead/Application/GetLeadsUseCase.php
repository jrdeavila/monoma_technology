<?php

namespace Src\BoundedContext\Lead\Application;

use Src\BoundedContext\Lead\Domain\Contract\LeadRepositoryContract;

class GetLeadsUseCase
{
    private LeadRepositoryContract $repository;

    public function __construct(LeadRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        return $this->repository->all();
    }
}
