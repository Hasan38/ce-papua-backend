<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MachineResource extends JsonResource
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
            'customer_id' => $this->customer_id,
            'customer_type' => $this->customer_type,
            'area_id' =>$this->area_id,
            'branch' => $this->branch, 
            'terminal_id' => $this->terminal_id,
            'sn' => $this->sn, 
            'machine_type' => $this->machine_type,
            'address' => $this->address, 
            'zona' => $this->zona, 
            'service_status' => $this->service_status,
            'pengelola' => $this->pengelola,
            'lat' => $this->whenNotNull($this->lat) ,
            'long'=> $this->whenNotNull($this->long),
            'logo' => $this->whenNotNull($this->long)
        ];
    }
}

