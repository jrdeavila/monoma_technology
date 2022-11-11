<?php

namespace Src\BoundedContext\Lead\Application;

use Src\BoundedContext\Lead\Domain\Contract\LeadRepositoryContract;
use Src\BoundedContext\Lead\Domain\Lead;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadCreatedBy;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadName;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadOwner;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadSource;

class CreateLeadUseCase
{

    private LeadRepositoryContract $repository;

    public function __construct(LeadRepositoryContract $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $name, string $source, string $owner, string $createdBy)
    {
        $lead = Lead::create(
            new LeadName($name),
            new LeadSource($source),
            new LeadOwner($owner),
            new LeadCreatedBy($createdBy)
        );

        return $this->repository->save($lead);
    }
}
