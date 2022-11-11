<?php

namespace App\Http\Resources;

use App\Utilities\JsonResponseUtility;
use Illuminate\Http\Resources\Json\JsonResource;

class LeadCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return JsonResponseUtility::response(array_map(function ($item) {
            return $item->toArray();
        }, $this->resource));
    }

    public static $wrap = null;
}
