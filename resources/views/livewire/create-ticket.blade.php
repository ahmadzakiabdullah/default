<div class="mx-auto max-w-3xl p-6">
    <h1 class="mb-6 text-2xl font-bold">{{ __('ticket.create_title') }}</h1>

    @if ($trackingId)
        <div class="mb-6 rounded bg-green-100 p-4 text-green-900">
            {{ __('ticket.submitted') }} <strong>{{ $trackingId }}</strong>
            <br>{{ __('ticket.access_token') }} <strong>{{ $accessToken }}</strong>
        </div>
    @endif

    <form wire:submit="submit" class="space-y-4">
        <input wire:model="guestName" placeholder="{{ __('ticket.name') }}" class="w-full rounded border p-2">
        @error('guestName') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        <input wire:model="guestEmail" type="email" placeholder="{{ __('ticket.email') }}" class="w-full rounded border p-2">
        @error('guestEmail') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        <input wire:model="guestPhone" placeholder="{{ __('ticket.phone') }}" class="w-full rounded border p-2">
        @error('guestPhone') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        <select wire:model="departmentId" class="w-full rounded border p-2">
            <option value="">{{ __('ticket.department') }}</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
        @error('departmentId') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        <input wire:model="subject" placeholder="{{ __('ticket.subject') }}" class="w-full rounded border p-2">
        @error('subject') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        <textarea wire:model="message" placeholder="{{ __('ticket.message') }}" rows="6" class="w-full rounded border p-2"></textarea>
        @error('message') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        <input wire:model="attachments" type="file" multiple class="w-full rounded border p-2">
        <p class="text-sm text-gray-600">{{ __('ticket.attachments_help') }}</p>
        @error('attachments.*') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
        <button type="submit" class="rounded bg-blue-600 px-4 py-2 text-white">{{ __('ticket.submit') }}</button>
    </form>
</div>
