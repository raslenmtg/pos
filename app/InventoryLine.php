<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InventoryLine extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventory_lines';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inventory_id',
        'product_id',
        'variation_id',
        'theoretical_qty',
        'real_qty',
        'difference_qty',
        'unit_price',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'theoretical_qty' => 'decimal:4',
        'real_qty' => 'decimal:4',
        'difference_qty' => 'decimal:4',
        'unit_price' => 'decimal:4',
    ];

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

