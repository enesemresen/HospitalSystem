<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnalyseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'result' => $this->result,
            'created_id' => $this->created_id,
            'patient_id' => $this->patient_id,
            'personal_id' => $this->personal_id,
            'createdBy' => new UserResource($this->whenLoaded('createdBy')),
            'patient' => new UserResource($this->whenLoaded('patient')),
            'personal' => new UserResource($this->whenLoaded('personal')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
