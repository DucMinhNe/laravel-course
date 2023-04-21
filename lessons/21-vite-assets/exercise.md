# Exercise — Lesson 21

1. Ensure your layout `<head>` has:
   ```blade
   @vite(['resources/css/app.css', 'resources/js/app.js'])
   ```
2. Edit `resources/css/app.css`:
   ```css
   body { font-family: system-ui, sans-serif; background: #f8fafc; }
   ```
3. Edit `resources/js/app.js`:
   ```js
   console.log('Vite is wired up ✅');
   ```
4. Run the dev server:
   ```bash
   npm install
   npm run dev      # keep running; serve the app in another terminal
   ```
5. Build for production and inspect the manifest:
   ```bash
   npm run build
   cat public/build/manifest.json
   ```

**Done when:** the CSS applies, the console logs your message in dev, and
`npm run build` produces hashed assets under `public/build`.
