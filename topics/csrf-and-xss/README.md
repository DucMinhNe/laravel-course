# Topic: CSRF & XSS protection

The two web vulnerabilities Laravel guards by default — and how not to disable
that protection by accident.

## CSRF (Cross-Site Request Forgery)

An attacker tricks a logged-in user's browser into submitting a state-changing
request to your site. Laravel's `VerifyCsrfToken` middleware (in the `web`
group) blocks this by requiring a token on every POST/PUT/PATCH/DELETE.

- Blade forms: add `@csrf` (a hidden token field). Missing → **419**.
- AJAX/SPA: send the `X-CSRF-TOKEN` header (from a `<meta>` tag) or use the
  `XSRF-TOKEN` cookie (axios does this automatically).
- **API routes (`api.php`) are stateless** — no CSRF, they use token/Sanctum
  auth instead.
- Don't add URLs to `$except` unless you truly mean to disable CSRF for them
  (a webhook with its own signature check is the valid case).

## XSS (Cross-Site Scripting)

Injecting `<script>` via user content. Blade's `{{ $value }}` **escapes HTML by
default** — that's your main defence.

- `{{ $value }}` — escaped (safe).
- `{!! $value !!}` — raw (dangerous). Only for content *you* generated or have
  sanitised.
- Rendering user-submitted HTML (rich text)? Sanitise it server-side with a
  library (e.g. HTMLPurifier) before storing or before `{!! !!}`.
- Set a Content-Security-Policy header for defence in depth.

## Example

See `examples/notes.md` (concept reference).

## Exercise

See `exercise.md`.
