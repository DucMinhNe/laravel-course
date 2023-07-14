# Exercise — Database transactions

1. Create an `accounts` table with a `balance` integer (cents) and seed two
   accounts.
2. Write a `transfer($from, $to, $cents)` using `DB::transaction(...)` that
   decrements one and increments the other.
3. Add a guard that `throw`s when the source has insufficient funds, and confirm
   **neither** balance changes when it throws.
4. Wrap a side effect in `DB::afterCommit(fn () => ...)` and verify it only runs
   on a successful commit.

**Done when:** a successful transfer moves the money atomically, a failed one
leaves both balances untouched, and the after-commit callback only fires on
success.
