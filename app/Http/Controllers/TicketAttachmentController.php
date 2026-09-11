<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TicketAttachmentController extends Controller
{
    public function download(Request $request, string $trackingId, TicketAttachment $attachment, string $token)
    {
        $ticket = Ticket::query()->where('tracking_id', strtoupper($trackingId))->firstOrFail();

        abort_unless(
            hash_equals((string) $ticket->access_token_hash, hash('sha256', $token))
            && ($ticket->access_token_expires_at === null || $ticket->access_token_expires_at->isFuture())
            && $attachment->ticket_id === $ticket->id,
            403
        );

        abort_unless(Storage::disk('local')->exists($attachment->file_path), 404);

        return Storage::disk('local')->download($attachment->file_path, $attachment->file_name);
    }
}
