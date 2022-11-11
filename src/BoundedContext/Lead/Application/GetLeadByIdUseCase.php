<?php

namespace Src\BoundedContext\Lead\Application;

use Src\BoundedContext\Lead\Domain\Contract\LeadRepositoryContract;
use Src\BoundedContext\Lead\Domain\Lead;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadId;

class GetLeadByIdUseCase
{

    private LeadRepositoryContract $repository;

    public function __construct(LeadRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): Lead
    {
        return $this->repository->findById(new LeadId($id));
    }
}
