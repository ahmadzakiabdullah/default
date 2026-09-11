<?php

namespace Tests\Feature;

use App\Livewire\CreateTicket;
use App\Models\Department;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class CreateTicketTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_can_submit_a_ticket(): void
    {
        $department = Department::create(['name' => 'Pusat Komputer']);

        Livewire::test(CreateTicket::class)
            ->set('guestName', 'Ali Ahmad')
            ->set('guestEmail', 'ali@example.test')
            ->set('guestPhone', '0123456789')
            ->set('departmentId', $department->id)
            ->set('subject', 'Akses sistem')
            ->set('message', 'Saya tidak dapat log masuk.')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertSet('trackingId', fn ($value) => str_starts_with($value, 'TKT-'));

        $this->assertDatabaseCount('tickets', 1);
    }

    public function test_guest_can_submit_a_ticket_with_private_attachment(): void
    {
        Storage::fake('local');
        $department = Department::create(['name' => 'Pusat Komputer']);

        Livewire::test(CreateTicket::class)
            ->set('guestName', 'Ali Ahmad')->set('guestEmail', 'ali@example.test')
            ->set('guestPhone', '0123456789')->set('departmentId', $department->id)
            ->set('subject', 'Resit')->set('message', 'Lampiran disertakan.')
            ->set('attachments', [UploadedFile::fake()->create('resit.pdf', 100, 'application/pdf')])
            ->call('submit')->assertHasNoErrors();

        $this->assertDatabaseCount('ticket_attachments', 1);
        $path = \App\Models\TicketAttachment::query()->value('file_path');
        Storage::disk('local')->assertExists($path);
    }
}
