<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketAttachmentController;
use App\Livewire\CreateTicket;
use App\Livewire\TrackTicket;
use App\Livewire\Admin\TicketIndex;

Route::get('/', CreateTicket::class)->name('tickets.create');
Route::get('/tickets/track', TrackTicket::class)->name('tickets.track');
Route::get('/admin/tickets', TicketIndex::class)->middleware(['auth', 'verified', 'permission:view tickets'])->name('admin.tickets');
Route::get('/tickets/{trackingId}/attachments/{attachment}/download/{token}', [TicketAttachmentController::class, 'download'])
    ->name('tickets.attachments.download');

Route::get('dashboard', function () {
    return view('dashboard', [
        'totalTickets' => \App\Models\Ticket::count(),
        'newTickets' => \App\Models\Ticket::where('status', 'baru')->count(),
        'inProgressTickets' => \App\Models\Ticket::where('status', 'dalam_tindakan')->count(),
        'closedTickets' => \App\Models\Ticket::whereIn('status', ['selesai', 'ditutup'])->count(),
    ]);
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
