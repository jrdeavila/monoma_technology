<?php

namespace Src\BoundedContext\Lead\Infrastructure;

use App\Http\Requests\LeadRequest;
use App\Http\Resources\LeadResource;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Src\BoundedContext\Lead\Application\CreateLeadUseCase;
use Src\BoundedContext\Lead\Domain\Lead;
use Src\BoundedContext\Lead\Infrastructure\Repository\MongoLeadRepository;

class CreateLeadController
{
    private MongoLeadRepository $repository;

    public function __construct(MongoLeadRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $userId, LeadRequest $request): Lead
    {
        $useCase = new CreateLeadUseCase($this->repository);
        $lead = $useCase->__invoke(
            $request->name,
            $request->source,
            $request->owner,
            $userId,
        );

        return $lead;
    }
}
