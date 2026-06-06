<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OnlineOrder extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'items' => 'array',
    ];

    public function business()
    {
        return $this->belongsTo(\App\Business::class, 'business_id');
    }

    public function contact()
    {
        return $this->belongsTo(\App\Contact::class, 'contact_id');
    }

    public function transaction()
    {
        return $this->belongsTo(\App\Transaction::class, 'transaction_id');
    }

    public static function generateOrderNumber($business_id)
    {
        $last = static::where('business_id', $business_id)
            ->orderBy('id', 'desc')
            ->first();

        $next = $last ? ((int) substr($last->order_number, -6)) + 1 : 1;

        return 'ONL-' . str_pad($next, 6, '0', STR_PAD_LEFT);
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'new'        => '<span class="label label-primary">Nouvelle</span>',
            'processing' => '<span class="label label-warning">En traitement</span>',
            'completed'  => '<span class="label label-success">Complétée</span>',
            'cancelled'  => '<span class="label label-danger">Annulée</span>',
        ];
        return $labels[$this->status] ?? $this->status;
    }

    public function getShippingStatusLabelAttribute()
    {
        $labels = [
            'ordered'   => '<span class="label label-default">Commandé</span>',
            'packed'    => '<span class="label label-info">Emballé</span>',
            'shipped'   => '<span class="label label-warning">Expédié</span>',
            'delivered' => '<span class="label label-success">Livré</span>',
            'cancelled' => '<span class="label label-danger">Annulé</span>',
        ];
        return isset($this->shipping_status) ? ($labels[$this->shipping_status] ?? $this->shipping_status) : '<span class="label label-default">—</span>';
    }
}
