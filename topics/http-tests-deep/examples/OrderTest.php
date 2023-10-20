<?php

namespace Tests\Feature;

use App\Models\User;
use App\Mail\OrderShipped;
use App\Jobs\ProcessOrder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function test_checkout_queues_a_job_and_sends_mail(): void
    {
        Queue::fake();
        Mail::fake();
        // Stub the external payment API so no real call is made
        Http::fake(['api.stripe.com/*' => Http::response(['id' => 'ch_1'], 200)]);

        $user = User::factory()->create();

        $this->actingAs($user)
            ->postJson('/api/checkout', ['amount' => 1999])
            ->assertCreated()
            ->assertJsonPath('status', 'processing');

        Queue::assertPushed(ProcessOrder::class);
        Mail::assertSent(OrderShipped::class, fn ($m) => $m->hasTo($user->email));
        Http::assertSent(fn ($req) => str_contains($req->url(), 'stripe'));
    }

    public function test_checkout_validates_amount(): void
    {
        $this->actingAs(User::factory()->create())
            ->postJson('/api/checkout', [])
            ->assertStatus(422)
            ->assertJsonValidationErrors('amount');
    }
}
