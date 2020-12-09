<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RelationResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //maping different relations of a node
        return [
            'relation id'=>$this->pivot->id,
            'relation name'=>$this->pivot->rel_name,
            'child_node'=>$this->pivot->child_node
        ];
    }
}
