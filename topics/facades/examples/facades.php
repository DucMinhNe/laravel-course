<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

// Facade call ...
Cache::put('greeting', 'hi', now()->addMinutes(10));
$g = Cache::get('greeting');

// ... is exactly this under the hood:
app('cache')->put('greeting', 'hi', now()->addMinutes(10));
$g = app('cache')->get('greeting');

// In tests, facades become spies/mocks:
//   Mail::fake();
//   // ... code that should send mail ...
//   Mail::assertSent(WelcomeMail::class);
//
//   Cache::shouldReceive('get')->once()->andReturn('cached');

// Real-time facade — call your own class statically without writing a facade:
//   use Facades\App\Services\Weather;
//   Weather::forecast('Saigon');   // container resolves App\Services\Weather
