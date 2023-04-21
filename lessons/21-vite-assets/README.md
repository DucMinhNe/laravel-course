# Lesson 21: Asset bundling with Vite

Laravel 10 ships with Vite for compiling CSS and JS.

## What you'll learn

- `vite.config.js` lists your entry points (`resources/css/app.css`,
  `resources/js/app.js`).
- In Blade, load them with the `@vite([...])` directive — it outputs the right
  `<link>`/`<script>` tags and handles hashed filenames in production.
- Dev workflow: `npm install` then `npm run dev` (hot reload). Build for
  production: `npm run build` (outputs to `public/build`).
- Reference static files (images in `public/`) with the `asset()` helper.
- The `@vite` directive auto-detects the dev server vs the built manifest — no
  config switching.

```blade
<head>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
```

## Example

See `examples/app.blade.php`.

## Exercise

1. In a layout's `<head>`, add `@vite(['resources/css/app.css', 'resources/js/app.js'])`.
2. Add a rule to `resources/css/app.css` and a `console.log` to
   `resources/js/app.js`.
3. Run `npm run dev`, load the page, and confirm the style + log appear.
4. Run `npm run build` and inspect `public/build/manifest.json`.
