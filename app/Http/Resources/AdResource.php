<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AdResource extends JsonResource
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
            'title'         => $this->title,
            'description'   => $this->description,
            'start date'    => $this->start_date,
            'type'          => $this->type,
            'category'      => $this->category,
            'user'          => $this->user,
            'tags'          => $this->tags,
        ];
    }
}
