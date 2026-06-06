---
name: Ecommerce feature
description: Online store + admin order management module built on top of the POS system.
---

# Ecommerce Feature

## Key decisions

- `business` table (not `businesses`) — confirmed via `psql \dt`.
- Online store uses slug-based routing at `/store/{slug}` (no subdomain in dev; subdomain works in production via reverse proxy).
- Online orders stored in `online_orders` table (NOT in `transactions`) to keep them separate until admin explicitly converts them.
- No auth for store visitors — cart is session-keyed by `online_cart_{business_id}`.
- Shipping statuses reuse the existing `Util::shipping_statuses()` values: ordered, packed, shipped, delivered, cancelled.
- `sell_online` boolean (default true) added to products table.
- `ecom_slug` nullable unique string added to business table.

**Why:** Keeping online orders separate avoids polluting the POS transaction log; admin can manually create a Contact and link it when ready.

## Files

- `database/migrations/2026_06_06_232110_add_sell_online_to_products_table.php`
- `database/migrations/2026_06_06_232136_add_ecom_slug_to_businesses_table.php`
- `database/migrations/2026_06_06_232155_create_online_orders_table.php`
- `app/OnlineOrder.php` — model with status_label / shipping_status_label accessors
- `app/Http/Controllers/EcomOrderController.php` — admin: index (DataTable), show (modal), updateStatus, createContact
- `app/Http/Controllers/OnlineStoreController.php` — public: index, show, cart, addToCart, removeFromCart, updateCart, checkout, placeOrder, success
- `resources/views/ecom/orders/index.blade.php` — admin orders list
- `resources/views/ecom/orders/show.blade.php` — admin order detail modal
- `resources/views/online_store/layout.blade.php` — public store layout (standalone, no admin layout)
- `resources/views/online_store/{index,show,cart,checkout,success}.blade.php`
- `resources/views/online_store/partials/pagination.blade.php`

## How to apply

- Admin sets slug in Business Settings → "Boutique en ligne" section.
- Store is then accessible at `/store/{slug}`.
- "Boutique en ligne" dropdown appears in admin sidebar for all users.
- `sell_online` checkbox appears in product create/edit form.
