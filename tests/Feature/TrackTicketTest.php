<?php

namespace Tests\Feature;

use App\Livewire\TrackTicket;
use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Livewire;
use Tests\TestCase;

class TrackTicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_find_ticket_by_tracking_id(): void
    {
        $department = Department::create(['name' => 'Pusat Komputer']);
        $accessToken = '12345678901234567890123456789012';
        Ticket::create([
            'tracking_id' => 'TKT-20260911-ABC123', 'access_token_hash' => hash('sha256', $accessToken),
            'access_token_expires_at' => now()->addDay(), 'guest_name' => 'Ali',
            'guest_email' => 'ali@example.test', 'guest_phone' => '0123456789',
            'department_id' => $department->id, 'subject' => 'Akses', 'message' => 'Bantuan diperlukan',
        ]);

        Livewire::test(TrackTicket::class)
            ->set('trackingId', 'tkt-20260911-abc123')->set('accessToken', $accessToken)->call('search')
            ->assertHasNoErrors()->assertSet('searched', true)
            ->assertSet('ticket.tracking_id', 'TKT-20260911-ABC123');
    }

    public function test_unknown_tracking_id_returns_no_ticket(): void
    {
        Livewire::test(TrackTicket::class)
            ->set('trackingId', 'TKT-UNKNOWN')->set('accessToken', '12345678901234567890123456789012')->call('search')
            ->assertHasNoErrors()->assertSet('searched', true)->assertSet('ticket', null);
    }

    public function test_ticket_search_is_rate_limited(): void
    {
        RateLimiter::clear('ticket-track:'.request()->ip());
        $component = Livewire::test(TrackTicket::class)
            ->set('trackingId', 'TKT-UNKNOWN')->set('accessToken', '12345678901234567890123456789012');

        for ($attempt = 0; $attempt < 5; $attempt++) {
            $component->call('search');
        }

        $component->call('search')->assertHasErrors('trackingId');
    }
}
