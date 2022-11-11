<?php

namespace Src\BoundedContext\Lead\Infrastructure;

use App\Http\Resources\LeadCollection;
use Src\BoundedContext\Lead\Application\GetLeadsByOwnerUseCase;
use Src\BoundedContext\Lead\Application\GetLeadsUseCase;
use Src\BoundedContext\Lead\Infrastructure\Repository\MongoLeadRepository;

class GetLeadsController
{
    private MongoLeadRepository $repository;

    public function __construct(MongoLeadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $role, string $owner): array
    {
        $leads = [];
        if ($role === 'agent') {
            $leads = (new GetLeadsByOwnerUseCase($this->repository))->__invoke($owner);
        } else {
            $leads = (new GetLeadsUseCase($this->repository))->__invoke();
        }
        return $leads;
    }
}
