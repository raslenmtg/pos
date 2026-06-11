<?php

namespace Modules\Ecommerce\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsAppService
{
    protected string $token;
    protected string $phoneNumberId;
    protected string $apiVersion = 'v19.0';

    public function __construct()
    {
        $this->token         = config('WHATSAPP_TOKEN', '');
        $this->phoneNumberId = config('WHATSAPP_PHONE_ID', '');
    }

    /**
     * Send a plain-text WhatsApp message to a recipient number.
     *
     * @param  string  $to      E.164 format, e.g. "+21693796501"
     * @param  string  $message
     * @return bool
     */
    public function send(string $to, string $message): bool
    {
        $to = preg_replace('/[^0-9+]/', '', $to);

        try {
            $response = Http::withToken($this->token)
                ->post("https://graph.facebook.com/{$this->apiVersion}/{$this->phoneNumberId}/messages", [
                    'messaging_product' => 'whatsapp',
                    'to'                => '+216'.$to,
                    'type'              => 'text',
                    'text'              => ['body' => $message],
                ]);

            if ($response->successful()) {
                Log::info('[WhatsApp] Message sent to '.$to);
                return true;
            }

            Log::error('[WhatsApp] API error: '.$response->body());
            return false;

        } catch (\Throwable $e) {
            Log::error('[WhatsApp] Exception: '.$e->getMessage());
            return false;
        }
    }

    /**
     * Build the new-order notification message.
     */
    public static function buildOrderMessage(array $info, string $ref, float $total): string
    {
        $name    = $info['customer_name']    ?? '—';
        $phone   = $info['customer_phone']   ?? '—';
        $address = $info['customer_address'] ?? '—';

        return "🛍️ *Nouvelle commande en ligne !*\n\n"
            ."📋 Référence : *{$ref}*\n"
            ."👤 Client : {$name}\n"
            ."📞 Tél : {$phone}\n"
            ."📍 Adresse : {$address}\n"
            ."💰 Total : *".number_format($total, 2)." DT*\n\n"
            ."Connectez-vous à votre espace admin pour traiter cette commande.";
    }
}
