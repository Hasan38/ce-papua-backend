<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TutorialResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'machine_type' => $this->machine_type,
            'type' => $this->type,
            'user_id' => $this->user_id,
            'customer' => $this->whenNotNull($this->customer),
            'title' =>$this->title,
            'content' => $this->whenNotNull($this->content),
            'link' => $this->whenNotNull($this->link),
        ];
    }
}
