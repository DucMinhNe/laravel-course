# Topic: Custom validation rules

When the built-in rules aren't enough.

## Inline closure rule

For one-off logic:

```php
$request->validate([
    'slug' => ['required', function ($attribute, $value, $fail) {
        if (str_contains($value, ' ')) {
            $fail("The {$attribute} cannot contain spaces.");
        }
    }],
]);
```

## Rule object (reusable)

`php artisan make:rule Uppercase` → a class implementing `ValidationRule` with a
`validate()` method:

```php
class Uppercase implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strtoupper($value) !== $value) {
            $fail('The :attribute must be uppercase.');
        }
    }
}

// Usage:  'code' => ['required', new Uppercase],
```

## Built-in helpers worth knowing

- Conditional: `required_if:type,book`, `required_with:a,b`,
  `required_without`, `sometimes` (only validate if present).
- `Rule::unique('users')->ignore($user->id)` — ignore self on update.
- `Rule::in([...])`, `Rule::exists('table', 'col')`,
  `Rule::requiredIf(fn () => ...)`.
- Arrays: `'items' => 'array'`, `'items.*.qty' => 'integer|min:1'`.

## Custom messages & attributes

Third arg of `validate()`, or `messages()` / `attributes()` in a Form Request.

## Example

See `examples/Uppercase.php`.

## Exercise

See `exercise.md`.
