<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

// php artisan make:rule Uppercase
class Uppercase implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! is_string($value) || strtoupper($value) !== $value) {
            $fail('The :attribute must be uppercase.');
        }
    }
}

// Usage:
//   $request->validate([
//       'country_code' => ['required', 'size:2', new Uppercase],
//   ]);
//
// Update with self-ignore on a unique column:
//   use Illuminate\Validation\Rule;
//   'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
//
// Conditional + nested array rules:
//   'type'        => ['required', 'in:book,course'],
//   'isbn'        => ['required_if:type,book'],
//   'items'       => ['array'],
//   'items.*.qty' => ['integer', 'min:1'],
