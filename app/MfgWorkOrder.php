<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MfgWorkOrder extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'planned_output_qty' => 'float',
        'produced_output_qty' => 'float',
        'overhead_cost' => 'float',
        'wastage_cost' => 'float',
        'total_ingredient_cost' => 'float',
        'total_cost' => 'float',
        'started_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function recipe()
    {
        return $this->belongsTo(\App\MfgRecipe::class, 'recipe_id');
    }

    public function location()
    {
        return $this->belongsTo(\App\BusinessLocation::class, 'location_id');
    }

    public function ingredients()
    {
        return $this->hasMany(\App\MfgWorkOrderIngredient::class, 'work_order_id');
    }

    public function consumptionTransaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'consumption_transaction_id');
    }

    public function productionTransaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'production_transaction_id');
    }
}

