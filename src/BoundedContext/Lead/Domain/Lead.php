<?php

namespace Src\BoundedContext\Lead\Domain;

use Src\BoundedContext\Lead\Domain\ValueObjects\LeadCreatedAt;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadCreatedBy;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadId;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadName;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadOwner;
use Src\BoundedContext\Lead\Domain\ValueObjects\LeadSource;

class Lead
{
    private LeadId $id;
    private LeadName $name;
    private LeadSource $source;
    private LeadOwner $owner;
    private LeadCreatedAt $createdAt;
    private LeadCreatedBy $createBy;

    public function __construct(
        LeadName $name,
        LeadSource $source,
        LeadOwner $owner,
        LeadCreatedAt $createdAt,
        LeadCreatedBy $createBy
    ) {
        $this->name = $name;
        $this->source = $source;
        $this->owner = $owner;
        $this->createdAt = $createdAt;
        $this->createBy = $createBy;
    }

    public static function create(
        LeadName $name,
        LeadSource $source,
        LeadOwner $owner,
        LeadCreatedBy $createBy
    ): self {
        return new self(
            $name,
            $source,
            $owner,
            new LeadCreatedAt(new \DateTime('now')),
            $createBy,
        );
    }


    public function getId(): LeadId
    {
        return $this->id;
    }

    public function setId(LeadId $id): void
    {
        $this->id = $id;
    }

    public function getName(): LeadName
    {
        return $this->name;
    }

    public function setName(LeadName $name): void
    {
        $this->name = $name;
    }

    public function getSource(): LeadSource
    {
        return $this->source;
    }

    public function setSource(LeadSource $source): void
    {
        $this->source = $source;
    }

    public function getOwner(): LeadOwner
    {
        return $this->owner;
    }

    public function setOwner(LeadOwner $owner): void
    {
        $this->owner = $owner;
    }

    public function getCreatedAt(): LeadCreatedAt
    {
        return $this->createdAt;
    }

    public function setCreatedAt(LeadCreatedAt $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getCreateBy(): LeadCreatedBy
    {
        return $this->createBy;
    }

    public function setCreateBy(LeadCreatedBy $createBy): void
    {
        $this->createBy = $createBy;
    }

    public function toArray()
    {
        return [
            'id' => $this->id->value(),
            'name' => $this->name->value(),
            'source' => $this->source->value(),
            'owner' => $this->owner->value(),
            'created_at' => $this->createdAt->value()->format('Y-m-d H:i:s'),
            'created_by' => $this->createBy->value(),
        ];
    }
}
