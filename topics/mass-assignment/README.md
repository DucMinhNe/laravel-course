# Topic: Mass assignment

Why `Model::create($request->all())` is a footgun, and how Laravel protects you.

## The vulnerability

Mass assignment = setting many attributes from an array at once
(`create([...])`, `update([...])`, `fill([...])`). If you pass raw request input
straight in, a user can set fields you never meant them to:

```php
// DANGER — user can POST is_admin=1 and escalate privileges
User::create($request->all());
```

## The guard

Eloquent refuses to mass-assign unless you declare intent on the model:

- **`$fillable`** — an allowlist (preferred). Only these can be mass-assigned.
  ```php
  protected $fillable = ['name', 'email', 'password'];
  ```
- **`$guarded`** — a blocklist. `protected $guarded = ['id', 'is_admin'];`
  (or `['*']` to block everything and only set attributes explicitly).

Anything outside `$fillable` (or inside `$guarded`) is silently dropped on
mass-assign, and `Model::preventSilentlyDiscardingAttributes()` can make it
throw in dev so you notice.

## The real fix: validate, then assign validated

```php
$data = $request->validate([
    'name'  => 'required|string',
    'email' => 'required|email',
]);
User::create($data);     // $data has ONLY the validated keys
```

Validating to a clean array means you never hand `create()` anything unexpected
in the first place — `$fillable` is the safety net, not the strategy.

## Example

See `examples/User.php`.

## Exercise

See `exercise.md`.
