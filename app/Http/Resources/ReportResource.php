<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        $upRate = $this->ratings()->where('rating_type', 'up')->count();
        $downRate = $this->ratings()->where('rating_type', 'down')->count();
        return [
            'id' => $this->id,
            'title' => $this->title,
            'category' => $this->category->category,
            'description' => $this->description,
            'media' => $this->media,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'address' => $this->address,
            'up_rate' => $upRate,
            'down_rate' => $downRate,
            'status' => $this->status->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
