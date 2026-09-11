<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\TicketAttachment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class TicketAttachmentDownloadTest extends TestCase
{
    use RefreshDatabase;

    public function test_attachment_can_be_downloaded_with_valid_token(): void
    {
        Storage::fake('local');
        $department = Department::create(['name' => 'Pusat Komputer']);
        $token = '12345678901234567890123456789012';
        $ticket = Ticket::create([
            'tracking_id' => 'TKT-20260911-DOWN01', 'access_token_hash' => hash('sha256', $token),
            'access_token_expires_at' => now()->addDay(), 'guest_name' => 'Ali',
            'guest_email' => 'ali@example.test', 'guest_phone' => '0123456789',
            'department_id' => $department->id, 'subject' => 'Fail', 'message' => 'Semak fail',
        ]);
        Storage::disk('local')->put('tickets/1/file.pdf', 'content');
        $attachment = TicketAttachment::create(['ticket_id' => $ticket->id, 'file_name' => 'file.pdf', 'file_path' => 'tickets/1/file.pdf']);

        $this->get(route('tickets.attachments.download', [$ticket->tracking_id, $attachment, $token]))
            ->assertOk()->assertDownload('file.pdf');
    }

    public function test_attachment_download_is_rejected_with_invalid_token(): void
    {
        $this->get(route('tickets.attachments.download', ['TKT-UNKNOWN', 1, 'invalid']))->assertNotFound();
    }
}
