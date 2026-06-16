<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Category
 */
class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->uuid,
            'name' => $this->name,
            // 'created_at' => $this->created_at->format('M d, Y g:i A'),
            // 'updated_at' => $this->updated_at->format('Y-m-d H:i'),
            // 'created_at' => new DateTimeResource($this->created_at)->resolve($request),
            // 'updated_at' => new DateTimeResource($this->updated_at)->resolve($request),
            'created_at' => (new DateTimeResource($this->created_at, false))->resolve($request),
            'updated_at' => (new DateTimeResource($this->updated_at, false))->resolve($request),
        ];
        // return $this->collection->getIterator();
    }
}
