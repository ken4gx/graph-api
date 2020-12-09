<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NodesResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     * implode(', ' , $this->Relations()->get()->pluck('id')->toArray())
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //maping a node and all his relations
        return [
            'node id'=>$this->id,
            "Graph's node"=>$this->Graph->id,
            'relation:'=> RelationResouce::collection($this->Relations),
        ];
    }
}
