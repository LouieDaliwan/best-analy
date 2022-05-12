<?php

namespace Survey;

use Illuminate\Database\Eloquent\Model;

class SDMIIndexScore extends Model
{
    protected $table = 'smdi_index_scores';


    protected $fillable = [
        'taxonomy_id',
        'month_key',
        'metadata',
    ]; 

    protected $cast = [
        'metadata' => 'array'
    ];


    public function taxonomy 
    {
        return $this->belongTo(Taxonomy::class, 'taxonomy_id', 'id');
    }
}
