<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'inventories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'business_id',
        'location_id',
        'ref_no',
        'inventory_date',
        'notes',
        'status',
        'stock_adjustment_transaction_id',
        'created_by',
        'updated_by',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'inventory_date' => 'datetime',
    ];

    public function lines()
    {
        return $this->hasMany(\App\InventoryLine::class);
    }

    public function location()
    {
        return $this->belongsTo(\App\BusinessLocation::class, 'location_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(\App\User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(\App\User::class, 'updated_by');
    }

    public function adjustmentTransaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'stock_adjustment_transaction_id');
    }
}

