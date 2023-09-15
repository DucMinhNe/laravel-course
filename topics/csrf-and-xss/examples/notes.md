# CSRF & XSS — quick reference

## CSRF

```blade
{{-- Every state-changing form needs the token --}}
<form method="POST" action="/posts">
    @csrf
    @method('PUT')   {{-- for PUT/PATCH/DELETE --}}
    ...
</form>
```

```html
<!-- For JS clients: expose the token, then send it as a header -->
<meta name="csrf-token" content="{{ csrf_token() }}">
```

```js
fetch('/posts', {
  method: 'POST',
  headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content },
});
```

## XSS

```blade
{{ $userInput }}      {{-- escaped — safe by default --}}
{!! $trustedHtml !!}  {{-- raw — only for sanitised/own content --}}
```

```php
// If you must render user HTML, sanitise first:
$clean = Purifier::clean($request->input('bio'));  // mews/purifier or similar
```

Webhook exception (the ONLY common reason to skip CSRF — it has its own
signature):

```php
// app/Http/Middleware/VerifyCsrfToken.php
protected $except = ['stripe/webhook'];
```
