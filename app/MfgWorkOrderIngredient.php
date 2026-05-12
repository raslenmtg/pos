<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MfgWorkOrderIngredient extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'quantity_per_batch' => 'float',
        'required_quantity' => 'float',
        'wastage_percent' => 'float',
        'consumed_quantity' => 'float',
    ];

    public function workOrder()
    {
        return $this->belongsTo(\App\MfgWorkOrder::class, 'work_order_id');
    }

    public function product()
    {
        return $this->belongsTo(\App\Product::class, 'product_id');
    }

    public function variation()
    {
        return $this->belongsTo(\App\Variation::class, 'variation_id');
    }
}

