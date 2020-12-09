<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function Graph(){
        return $this->belongsTo('App\Models\Graph','graph_id');
    }

    public function Relations(){
        return $this->belongsToMany('App\Models\Node','relations','parent_node','child_node')
                    ->using('App\Models\Relation')
                    ->withPivot('id','rel_name')
                    ->withTimestamps();
    }
}
