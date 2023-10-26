<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
     return [
        'id' => $this->id,
        'nrp' => $this->nrp,
        'name' => $this->name,
        'email' => $this->email,
        'no_handphone' => $this->no_handphone,
        'date_born' => $this->date_born,
        'address' => $this->address,
        'password' => $this->password,
        'company' => $this->company,
        'departemen' => $this->departemen,
     ];
    }
}
