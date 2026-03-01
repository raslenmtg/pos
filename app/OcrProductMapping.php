<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OcrProductMapping extends Model
{
    protected $guarded = ['id'];

    protected $dates = ['last_used_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
