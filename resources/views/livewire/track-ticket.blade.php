<div class="mx-auto max-w-3xl p-6">
    <h1 class="mb-6 text-2xl font-bold">{{ __('ticket.track_title') }}</h1>

    <form wire:submit="search" class="mb-6 flex gap-2">
        <input wire:model="trackingId" placeholder="{{ __('ticket.tracking_id') }}" class="flex-1 rounded border p-2">
        <input wire:model="accessToken" placeholder="{{ __('ticket.access_token') }}" class="flex-1 rounded border p-2">
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">{{ __('ticket.search') }}</button>
    </form>
    @error('trackingId') <span class="text-sm text-red-600">{{ $message }}</span> @enderror

    @if ($searched && ! $ticket)
        <div class="rounded bg-yellow-100 p-4 text-yellow-900">{{ __('ticket.not_found') }}</div>
    @elseif ($ticket)
        <div class="space-y-4 rounded border bg-white p-5 shadow-sm">
            <div class="flex justify-between"><strong>{{ $ticket->tracking_id }}</strong><span>{{ $ticket->status }}</span></div>
            <p><strong>{{ __('ticket.subject') }}:</strong> {{ $ticket->subject }}</p>
            <p><strong>{{ __('ticket.department') }}:</strong> {{ $ticket->department->name }}</p>
            <p><strong>{{ __('ticket.message') }}:</strong><br>{{ $ticket->message }}</p>
            @if ($ticket->attachments->isNotEmpty())
                <h2 class="border-t pt-4 font-semibold">{{ __('ticket.attachments') }}</h2>
                @foreach ($ticket->attachments as $attachment)
                    <a class="text-sm text-blue-600 underline" href="{{ route('tickets.attachments.download', [$ticket->tracking_id, $attachment, $accessToken]) }}">
                        {{ $attachment->file_name }} ({{ number_format(($attachment->file_size ?? 0) / 1024, 1) }} KB)
                    </a>
                @endforeach
            @endif
            @if ($ticket->replies->isNotEmpty())
                <h2 class="border-t pt-4 font-semibold">{{ __('ticket.replies') }}</h2>
                @foreach ($ticket->replies as $reply)
                    <div class="rounded bg-gray-50 p-3">{{ $reply->reply_text }}</div>
                @endforeach
            @endif
        </div>
    @endif
</div>
