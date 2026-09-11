<?php

namespace App\Livewire;

use App\Models\Department;
use App\Models\Ticket;
use App\Mail\TicketSubmitted;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateTicket extends Component
{
    use WithFileUploads;

    public string $guestName = '';
    public string $guestEmail = '';
    public string $guestPhone = '';
    public string $guestAddress = '';
    public ?int $departmentId = null;
    public string $subject = '';
    public string $message = '';
    public ?string $trackingId = null;
    public ?string $accessToken = null;
    public array $attachments = [];

    protected function rules(): array
    {
        return [
            'guestName' => ['required', 'string', 'max:255'],
            'guestEmail' => ['required', 'email', 'max:255'],
            'guestPhone' => ['required', 'string', 'max:50'],
            'guestAddress' => ['nullable', 'string', 'max:2000'],
            'departmentId' => ['required', 'exists:departments,id'],
            'subject' => ['required', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:10000'],
            'attachments' => ['array', 'max:5'],
            'attachments.*' => ['file', 'mimes:jpg,jpeg,png,pdf,doc,docx', 'max:5120'],
        ];
    }

    public function submit(): void
    {
        $validated = $this->validate();
        $trackingId = 'TKT-'.now()->format('Ymd').'-'.Str::upper(Str::random(6));
        $accessToken = Str::random(32);

        $ticket = Ticket::create([
            'tracking_id' => $trackingId,
            'access_token_hash' => hash('sha256', $accessToken),
            'access_token_expires_at' => now()->addDays(30),
            'guest_name' => $validated['guestName'],
            'guest_email' => $validated['guestEmail'],
            'guest_phone' => $validated['guestPhone'],
            'guest_address' => $validated['guestAddress'] ?: null,
            'department_id' => $validated['departmentId'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
        ]);

        foreach ($this->attachments as $attachment) {
            $path = $attachment->store('tickets/'.$ticket->id, 'local');
            $ticket->attachments()->create([
                'file_name' => $attachment->getClientOriginalName(),
                'file_path' => $path,
                'file_size' => $attachment->getSize(),
                'mime_type' => $attachment->getMimeType(),
                'checksum' => hash_file('sha256', $attachment->getRealPath()),
            ]);
        }

        Mail::to($ticket->guest_email)->send(new TicketSubmitted($ticket, $accessToken));

        $this->trackingId = $trackingId;
        $this->accessToken = $accessToken;
        $this->reset(['guestName', 'guestEmail', 'guestPhone', 'guestAddress', 'departmentId', 'subject', 'message', 'attachments']);
    }

    public function render()
    {
        return view('livewire.create-ticket', [
            'departments' => Department::query()->where('is_active', true)->orderBy('name')->get(),
        ])->layout('components.layouts.app');
    }
}
