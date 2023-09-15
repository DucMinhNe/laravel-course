# Exercise — Custom validation rules

1. Generate a rule:
   ```bash
   php artisan make:rule StrongPassword
   ```
   Fail unless the value has 8+ chars, a number, and a letter.
2. Use it: `'password' => ['required', new StrongPassword]`.
3. Add a `Rule::unique(...)->ignore($id)` to an update endpoint so a user can
   keep their own email.
4. Validate a nested array: `'tags' => 'array'`, `'tags.*' => 'string|max:20'`.

**Done when:** weak passwords fail with your message, updates don't false-flag
the user's own email, and per-item array validation works.
