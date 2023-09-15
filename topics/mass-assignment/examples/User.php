<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Allowlist: only these can be set via create()/update()/fill().
    protected $fillable = ['name', 'email', 'password'];

    // is_admin is NOT fillable, so this is safe even with raw input:
    //   User::create($request->all());   // is_admin silently dropped
}

// Better still — never pass raw input; pass validated data:
//
//   $data = $request->validate([
//       'name'  => 'required|string|max:255',
//       'email' => 'required|email',
//   ]);
//   User::create($data);                 // only validated keys
//
// Make accidental extra keys throw in development:
//   Model::preventSilentlyDiscardingAttributes(! app()->isProduction());
