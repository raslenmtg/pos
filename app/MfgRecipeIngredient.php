<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MfgRecipeIngredient extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'quantity_per_batch' => 'float',
        'wastage_percent' => 'float',
    ];

    public function recipe()
    {
        return $this->belongsTo(\App\MfgRecipe::class, 'recipe_id');
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

