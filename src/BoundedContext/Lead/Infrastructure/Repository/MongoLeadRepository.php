<?php

namespace Src\BoundedContext\Lead\Infrastructure\Repository;

use Src\BoundedContext\Lead\Domain\Contract\LeadRepositoryContract;
use Src\BoundedContext\Lead\Domain\Lead;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadId;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadOwner;

use Src\Shared\Models\MongoLead;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadCreatedAt;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadCreatedBy;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadName;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadSource;

class MongoLeadRepository implements LeadRepositoryContract
{

    private MongoLead $model;

    public function __construct(MongoLead $model)
    {
        $this->model = $model;
    }

    private function mapToLead(MongoLead|array $model)
    {
        $lead = new Lead(
            new LeadName($model['name']),
            new LeadSource($model['source']),
            new LeadOwner($model['owner']),
            new LeadCreatedAt($model['created_at'] ? new \DateTime($model['created_at']) : null),
            new LeadCreatedBy($model['created_by'])
        );
        $lead->setId(new LeadId($model['_id']));

        return $lead;
    }

    private function toModel(Lead $lead): MongoLead
    {
        $model = MongoLead::createByDomainModel($lead);
        return $model;
    }

    public function all(): array
    {
        $collection = $this->model->where('seq', null)->get();
        return array_map(function (array $item) {
            return $this->mapToLead($item);
        }, $collection->toArray());
    }

    public function findById(LeadId $id): ?Lead
    {
        $model = $this->model->findOrFail($id->value());
        return $this->mapToLead($model);
    }
    public function findByOwner(LeadOwner $owner): array
    {
        $list = $this->model->where('owner', '=', $owner->value())->get();
        return $list->map(function ($model) {
            return $this->mapToLead($model);
        })->toArray();
    }
    public function save(Lead $lead): Lead
    {
        $model = $this->toModel($lead);
        $model->save();
        return $this->mapToLead($model);
    }
}
