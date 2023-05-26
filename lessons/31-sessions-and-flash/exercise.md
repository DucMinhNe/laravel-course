# Exercise — Lesson 31

```php
use Illuminate\Http\Request;

// 1. A session counter
Route::get('/visits', function (Request $request) {
    $n = $request->session()->increment('visits');
    return "Visit #{$n}";
});

// 2. Flash on redirect
Route::post('/ping', fn () => redirect('/pong')->with('status', 'Done!'));

// 3. Read the flash, then have it vanish on reload
Route::get('/pong', fn () => session('status', '(no message)'));
```

Steps:
1. Hit `/visits` a few times — the count climbs.
2. POST to `/ping`; you land on `/pong` showing "Done!".
3. Reload `/pong` — it now shows "(no message)" because flash lasts one request.

**Done when:** the counter persists and the flash message shows exactly once.
