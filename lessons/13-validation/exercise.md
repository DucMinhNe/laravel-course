# Exercise — Lesson 13

Add a registration endpoint in `routes/web.php` or a controller:

```php
Route::post('/register', function (Illuminate\Http\Request $request) {
    $data = $request->validate([
        'name'     => ['required', 'string', 'max:255'],
        'email'    => ['required', 'email'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);

    // 'confirmed' requires a matching password_confirmation field
    return ['ok' => true, 'name' => $data['name']];
});
```

1. POST with a short password → observe the `422` and the `errors.password`
   message.
2. POST with mismatched `password` / `password_confirmation` → see the
   `confirmed` rule fire.
3. POST valid data → get `{"ok": true, ...}`.

**Done when:** invalid input returns structured `422` errors and valid input
passes.
