<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLine extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    public function inventory()
    {
        return $this->belongsTo(\App\Inventory::class);
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

