<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PolyclinicResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'personal_id' => $this->personal_id,
            'personal' => new UserResource($this->whenLoaded('personal')),
            'hospital_id' => $this->hospital_id,
            'hospital' => new HospitalResource($this->whenLoaded('hospital')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
