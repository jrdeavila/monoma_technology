<?php

namespace App\Http\Resources;

use App\Utilities\JsonResponseUtility;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return JsonResponseUtility::response($this->resource->toArray());
    }
}
