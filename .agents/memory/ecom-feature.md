---
name: Ecommerce feature
description: Online store + admin order management as a proper Laravel module under Modules/Ecommerce.
---

# Ecommerce Feature — Modules/Ecommerce

## Architecture

Built as a nwidart/laravel-modules module mirroring `Modules/Superadmin` structure.
Module is auto-loaded via `bootstrap/cache/ecommerce_module.php`.

## Key decisions

- `business` table (not `businesses`) — confirmed via `psql \dt`.
- Online orders stored in existing `transactions` table with `status = 'online'`, `type = 'sell'`.
- `transactions.status` CHECK constraint was altered to add `'online'` to the allowed values.
- Subdomain routing: `{subdomain}.simplexgestion.tn` for production; `/ecom-store/{subdomain}` dev fallback.
- No auth for store visitors — cart is session-keyed by `ecom_cart_{business_id}`.
- Contact created at checkout time using name/phone — no null contact_id needed.
- `online_store_enabled` (bool, default true) on products.
- `online_store_subdomain` (unique nullable string) on business.
- `online_store_enabled` checkbox uses `online_store_enabled` field; product edit falls back to `sell_online` if not set.

**Why:** Using existing transactions table keeps orders in the same reporting flow; `status=online` keeps them filtered out of regular sales until finalized.

## Files — Module

- `Modules/Ecommerce/module.json`
- `Modules/Ecommerce/Config/config.php` — domain config key `ecommerce.domain`
- `Modules/Ecommerce/Providers/EcommerceServiceProvider.php`
- `Modules/Ecommerce/Providers/RouteServiceProvider.php`
- `Modules/Ecommerce/Routes/web.php` — subdomain + dev path + admin routes
- `Modules/Ecommerce/Http/Controllers/OnlineStoreController.php`
- `Modules/Ecommerce/Http/Controllers/OnlineOrdersController.php`
- `Modules/Ecommerce/Resources/views/store/{layout,index,show,cart,checkout,success}.blade.php`
- `Modules/Ecommerce/Resources/views/orders/{index,show_modal}.blade.php`
- `Modules/Ecommerce/Database/Migrations/2026_06_07_000001_add_online_store_enabled_to_products.php`
- `Modules/Ecommerce/Database/Migrations/2026_06_07_000002_add_online_store_subdomain_to_business.php`
- `Modules/Ecommerce/Database/Migrations/2026_06_07_000003_alter_transactions_status_allow_online.php`
- `bootstrap/cache/ecommerce_module.php`

## Route names

- `ecom.orders.index` / `ecom.orders.show` / `ecom.orders.finalize` — admin
- `ecom.dev.index` / `ecom.dev.cart` / etc. — public dev path routes
- `ecom.store.index` / etc. — production subdomain routes

## How to activate

1. Admin goes to Settings → Business Settings → "Boutique en ligne" section
2. Sets subdomain (e.g. `phonex`) → store live at `phonex.simplexgestion.tn` (prod) or `/ecom-store/phonex` (dev)
3. Products with `online_store_enabled = true` appear in the store
4. Online orders appear in "Boutique en ligne → Commandes en ligne" sidebar menu
5. "Finaliser" button: selects expedition status → changes transaction status to `final`
