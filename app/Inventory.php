<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

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

