<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Relation extends Pivot
{
    use HasFactory;

    public $table = 'relations';
    public $incrementing = true;

    protected $guarded=[];

    /*public function Nodes(){
        return $this->belongsTo()
    }*/
}
