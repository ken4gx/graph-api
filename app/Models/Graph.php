<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graph extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function Nodes(){
        return $this->hasMany('App\Models\Node', 'graph_id');
    }
}
