<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GraphsResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //displaying a meta data of the graphs (id, name, description)
        return [
            'Graph id' => $this->id,
            'Graph name' => $this->graph_name,
            'Graph description'=>substr($this->graph_descrip, 0, 20) . '...',

        ];
    }
}
