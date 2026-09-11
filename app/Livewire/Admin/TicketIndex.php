<?php
namespace App\Livewire\Admin;
use App\Models\Ticket;
use App\Models\AuditLog;
use Livewire\Component;
use Livewire\WithPagination;
class TicketIndex extends Component
{
    use WithPagination;
    public string $status = '';
    public string $search = '';
    public ?int $replyingTo = null;
    public string $replyText = '';
    public function updateStatus(int $ticketId, string $status): void
    {
        abort_unless(in_array($status, ['baru','terbuka','dalam_tindakan','selesai','ditutup'], true), 422);
        $ticket = Ticket::findOrFail($ticketId);
        $oldStatus = $ticket->status;
        $ticket->update(['status' => $status]);
        AuditLog::create(['user_id' => auth()->id(), 'action' => 'status_changed', 'description' => "{$ticket->tracking_id}: {$oldStatus} -> {$status}"]);
    }
    public function addReply(int $ticketId): void
    {
        $this->validate(['replyText' => ['required', 'string', 'max:10000']]);
        $ticket = Ticket::findOrFail($ticketId);
        $ticket->replies()->create(['user_id' => auth()->id(), 'reply_text' => $this->replyText]);
        AuditLog::create(['user_id' => auth()->id(), 'action' => 'reply_added', 'description' => "Reply added to {$ticket->tracking_id}"]);
        $this->reset(['replyingTo', 'replyText']);
    }
    public function render()
    {
        return view('livewire.admin.ticket-index', ['tickets' => Ticket::with('department')->when($this->status, fn ($q) => $q->where('status', $this->status))->when($this->search, fn ($q) => $q->where('subject', 'like', "%{$this->search}%"))->latest()->paginate(15)])->layout('components.layouts.app');
    }
}
