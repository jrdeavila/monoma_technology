<?php

namespace Src\Shared\Models;


class MongoLead extends MongoModel
{
    protected $collection = 'leads';
    protected $fillable = [
        'name',
        'source',
        'owner',
        'created_by'
    ];

    public static function createByDomainModel(\Src\BoundedContext\Lead\Domain\Lead $lead): self
    {
        $nuser = new self();
        $nuser->name = $lead->getName()->value();
        $nuser->source = $lead->getSource()->value();
        $nuser->owner = $lead->getOwner()->value();
        $nuser->created_by = $lead->getCreateBy()->value();
        return $nuser;
    }
}
