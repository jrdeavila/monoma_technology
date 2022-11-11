<?php

namespace Src\BoundedContext\Lead\Infrastructure;

use App\Http\Resources\LeadResource;
use Illuminate\Auth\Access\AuthorizationException;
use Src\BoundedContext\Lead\Application\GetLeadByIdUseCase;
use Src\BoundedContext\Lead\Infrastructure\Repository\MongoLeadRepository;

class GetLeadByIdController
{
    private MongoLeadRepository $repository;

    public function __construct(MongoLeadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id, string $role, string $owner)
    {
        $useCase = new GetLeadByIdUseCase($this->repository);
        $lead = $useCase->__invoke($id);
        $owner = $role == 'manager' || $lead->getOwner()->value() == $owner;
        throw_unless($owner, new AuthorizationException());
        return $lead;
    }
}
