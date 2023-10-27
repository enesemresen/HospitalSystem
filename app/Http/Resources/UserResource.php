<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'adress' => $this->adress,
            'role' => $this->role,
            'image' => $this->image,
            'user_identity' => new UserIdentityResource($this->whenLoaded('userIdentity')),//hasOne
            'appointments_patient' => UserResource::collection($this->whenLoaded('appointmentsPatient')),
            'appointments_personal' => UserResource::collection($this->whenLoaded('appointmentsPersonal')),
            'polyclinics' => PolyclinicResource::collection($this->whenLoaded('polyclinics')),
            'analysesCreated' => UserResource::collection($this->whenLoaded('analysesCreated')),
            'analysesPatient' => UserResource::collection($this->whenLoaded('analysesPatient')),
            'analysesPersonal' => UserResource::collection($this->whenLoaded('analysesPersonal')),
            
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
