<?php

namespace App\Livewire;

use App\Models\Ticket;
use Illuminate\Support\Facades\RateLimiter;
use Livewire\Component;

class TrackTicket extends Component
{
    public string $trackingId = '';
    public string $accessToken = '';
    public ?Ticket $ticket = null;
    public bool $searched = false;

    public function search(): void
    {
        $this->validate([
            'trackingId' => ['required', 'string', 'max:30'],
            'accessToken' => ['required', 'string', 'size:32'],
        ]);
        $key = 'ticket-track:'.request()->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $this->addError('trackingId', __('ticket.too_many_attempts'));
            return;
        }
        RateLimiter::hit($key, 60);
        $this->ticket = Ticket::query()
            ->with(['department', 'replies.user', 'attachments'])
            ->where('tracking_id', strtoupper(trim($this->trackingId)))
            ->where('access_token_hash', hash('sha256', $this->accessToken))
            ->where(function ($query): void {
                $query->whereNull('access_token_expires_at')->orWhere('access_token_expires_at', '>', now());
            })
            ->first();
        $this->searched = true;
    }

    public function render()
    {
        return view('livewire.track-ticket')->layout('components.layouts.app');
    }
}
