<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserIdentityResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'tc_no' => $this->tc_no,
            'mother_name' => $this->mother_name,
            'father_name' => $this->father_name,
            'serial_no' => $this->serial_no,
            'birthday' => $this->birthday,
            'birthplace' => $this->birthplace,
            'user_id' => $this->user_id,
            'user' => new UserResource($this->whenLoaded('user')),//hasOne
            'insurance_number' => $this->insurance_number,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
