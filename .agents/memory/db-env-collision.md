---
name: DB env var collision with Replit secrets
description: Replit secrets can set DB_* vars as literal template strings that override .env file values.
---

# DB Env Var Collision

**Rule:** Never set DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD in Replit shared secrets — they collide with .env file values.

**Why:** Replit's managed DB secrets set these as `${PGHOST}`, `${PGPORT}` etc. as literal strings. PHP/Laravel reads system env before .env, so these literals override the correct .env values, causing connection errors like "invalid integer value '${PGPORT}'".

**How to apply:** Use PG* variables directly in .env (PGHOST, PGPORT etc. are set correctly as actual values by Replit). The .env file has DB_* set to actual resolved values (helium, 5432, heliumdb, postgres, password). The pgsql config in config/database.php was also modified to remove the `url => env('DATABASE_URL')` line to avoid the DATABASE_URL env var override.
