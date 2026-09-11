<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Ticket;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TicketSchemaTest extends TestCase
{
    use RefreshDatabase;

    public function test_ticket_can_be_created_with_department_relationship(): void
    {
        $department = Department::create(['name' => 'Pusat Komputer']);

        $ticket = Ticket::create([
            'tracking_id' => 'TKT-2026-000001',
            'guest_name' => 'Ali Ahmad',
            'guest_email' => 'ali@example.test',
            'guest_phone' => '0123456789',
            'department_id' => $department->id,
            'subject' => 'Masalah akses sistem',
            'message' => 'Tidak dapat log masuk.',
        ]);

        $this->assertDatabaseHas('tickets', ['tracking_id' => 'TKT-2026-000001']);
        $this->assertTrue($ticket->department->is($department));
    }
}
