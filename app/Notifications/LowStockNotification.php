<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Product name
     *
     * @var string
     */
    protected $product_name;

    /**
     * Current stock quantity
     *
     * @var float
     */
    protected $current_stock;

    /**
     * Days remaining before stock rupture
     *
     * @var float
     */
    protected $days_remaining;

    /**
     * Quantity to reorder
     *
     * @var float
     */
    protected $reorder_qty;

    /**
     * Product variation ID (optional, for linking)
     *
     * @var int|null
     */
    protected $variation_id;

    /**
     * Supplier ID (optional, for linking)
     *
     * @var int|null
     */
    protected $supplier_id;

    /**
     * Create a new notification instance.
     *
     * @param string $product_name
     * @param float $current_stock
     * @param float $days_remaining
     * @param float $reorder_qty
     * @param int|null $variation_id
     * @param int|null $supplier_id
     */
    public function __construct($product_name, $current_stock, $days_remaining, $reorder_qty, $variation_id = null, $supplier_id = null)
    {
        $this->product_name = $product_name;
        $this->current_stock = $current_stock;
        $this->days_remaining = $days_remaining;
        $this->reorder_qty = $reorder_qty;
        $this->variation_id = $variation_id;
        $this->supplier_id = $supplier_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $link = null;
        if ($this->variation_id) {
            if ($this->supplier_id) {
                $link = route('purchases.create', [
                    'variation_id' => $this->variation_id, 
                    'supplier_id' => $this->supplier_id,
                    'quantity' => $this->reorder_qty
                ]);
            } else {
                $link = route('purchase-requisition.create', [
                    'variation_id' => $this->variation_id,
                    'quantity' => $this->reorder_qty
                ]);
            }
        }
        
        $msg = "⚠️ *{$this->product_name}* " . __('messages.current_stock') . ": {$this->current_stock} | " . __('messages.days_remaining') . ": {$this->days_remaining} | " . __('messages.reorder_qty') . ": *{$this->reorder_qty}*";

        return [
            'message' => $msg,
            'link' => $link,
            'product_name' => $this->product_name,
            'current_stock' => $this->current_stock,
            'days_remaining' => $this->days_remaining,
            'reorder_qty' => $this->reorder_qty,
            'variation_id' => $this->variation_id,
            'supplier_id' => $this->supplier_id,
            'urgency' => $this->days_remaining <= 3 ? 'critical' : ($this->days_remaining <= 5 ? 'high' : 'medium'),
        ];
    }
}
