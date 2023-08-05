<?php

namespace App\Http\Resources;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $showCompany = (bool)$request['showCompany'] ?? false;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'user' => $this->user->name,
            $this->mergeWhen($request->isMethod('get'), [
                'is_completed' => $this->is_completed,
                'start_at' => $this->start_at,
                'expired_at' => $this->expired_at
            ]),
            'company' =>  CompanyResource::make($this->whenLoaded('company'))
        ];
    }
}
