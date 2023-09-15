# Exercise — CSRF & XSS

1. Build a POST form **without** `@csrf` and submit it → observe the **419**.
   Add `@csrf` and confirm it now works.
2. Create a route that stores a `bio` field and a view that renders it. Submit
   `<script>alert(1)</script>` and confirm `{{ $bio }}` shows it as text (not
   executed).
3. Switch the view to `{!! $bio !!}` and re-test — now it executes. Revert, and
   note when raw output is acceptable (only trusted/sanitised HTML).
4. Add a `<meta name="csrf-token">` and make a `fetch()` POST send the
   `X-CSRF-TOKEN` header.

**Done when:** you can demonstrate CSRF rejection without a token and XSS being
neutralised by Blade's default escaping.
