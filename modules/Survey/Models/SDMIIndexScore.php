<?php

namespace Survey;

use Customer\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Taxonomy\Models\Taxonomy;

class SDMIIndexScore extends Model
{
    protected $table = 'smdi_index_scores';


    protected $fillable = [
        'customer_id',
        'taxonomy_id',
        'month_key',
        'metadata',
    ]; 

    protected $casts = [
        'metadata' => 'array'
    ];


    public function taxonomy() 
    {
        return $this->belongTo(Taxonomy::class, 'taxonomy_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
}
