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
}
