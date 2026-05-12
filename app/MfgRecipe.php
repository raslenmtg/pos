<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MfgRecipe extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'yield_quantity' => 'float',
        'is_active' => 'boolean',
    ];

    public function finishedVariation()
    {
        return $this->belongsTo(\App\Variation::class, 'finished_variation_id');
    }

    public function finishedProduct()
    {
        return $this->belongsTo(\App\Product::class, 'finished_product_id');
    }

    public function ingredients()
    {
        return $this->hasMany(\App\MfgRecipeIngredient::class, 'recipe_id');
    }

    public function work_orders()
    {
        return $this->hasMany(\App\MfgWorkOrder::class, 'recipe_id');
    }
}

