# Topic: Database transactions

All-or-nothing writes — commit everything, or roll it all back.

## The closure form (preferred)

```php
use Illuminate\Support\Facades\DB;

DB::transaction(function () {
    $order = Order::create([...]);
    $order->items()->createMany($items);
    Inventory::where('id', $id)->decrement('stock', $qty);
});
// Any exception inside → automatic rollback. No partial order.
```

The closure form auto-commits on success and rolls back on any thrown
exception. It also **retries** on deadlock if you pass a second arg:
`DB::transaction(fn () => ..., $attempts = 3)`.

## Manual control

When you need finer control:

```php
DB::beginTransaction();
try {
    // ... writes ...
    DB::commit();
} catch (\Throwable $e) {
    DB::rollBack();
    throw $e;
}
```

## What to know

- Transactions need a transactional engine (InnoDB on MySQL, Postgres always).
  MyISAM silently ignores them.
- Keep transactions **short** — they hold locks. Don't call external APIs or
  dispatch sync jobs inside one.
- Side effects (emails, queue jobs) should fire **after** commit, or you may
  notify users about an order that rolled back. Use
  `DB::afterCommit()` or queued jobs (which dispatch after commit by default
  when configured).
- Nested `DB::transaction` calls use savepoints, not real nested transactions.

## Example

See `examples/transfer.php`.

## Exercise

See `exercise.md`.
