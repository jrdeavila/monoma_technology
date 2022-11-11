<?php

namespace Src\BoundedContext\Lead\Infrastructure;

use App\Http\Resources\LeadCollection;
use Src\BoundedContext\Lead\Application\GetLeadsByOwnerUseCase;
use Src\BoundedContext\Lead\Infrastructure\Repository\MongoLeadRepository;

class GetLeadsByAgentController
{
    private MongoLeadRepository $repository;

    public function __construct(MongoLeadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): LeadCollection
    {
        $useCase = new GetLeadsByOwnerUseCase($this->repository);
        return new LeadCollection($useCase->__invoke($id));
    }
}
