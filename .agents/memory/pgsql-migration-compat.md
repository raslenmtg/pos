---
name: PostgreSQL migration compatibility
description: UltimatePOS was written for MySQL; all MySQL-specific migration SQL was rewritten for PostgreSQL during Replit import.
---

# MySQL → PostgreSQL Migration Fixes

**Rule:** This project originally targeted MySQL. Any new migrations must use PostgreSQL syntax.

**Why:** Running `php artisan migrate` against Replit's PostgreSQL database failed on 30+ migrations using MySQL-only syntax.

**How to apply:** When writing new migrations:
- Use `ALTER TABLE t ALTER COLUMN c TYPE newtype` not `MODIFY COLUMN`
- Use `RENAME COLUMN old TO new` not `CHANGE COLUMN old new type`
- No `SET FOREIGN_KEY_CHECKS`, `ENUM()` type changes, or backtick identifiers
- For `GROUP BY`, PostgreSQL requires all selected columns to be in GROUP BY or aggregated
- `DROP TABLE IF EXISTS` needs `CASCADE` if foreign keys exist
- Double-quoted strings in SQL are identifiers in PostgreSQL; use single quotes for string literals
