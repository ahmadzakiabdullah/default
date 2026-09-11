<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="grid gap-4 md:grid-cols-4">
                        @foreach ([__('ui.dashboard_total') => $totalTickets, __('ui.dashboard_new') => $newTickets, __('ui.dashboard_in_progress') => $inProgressTickets, __('ui.dashboard_closed') => $closedTickets] as $label => $count)
                            <div class="rounded border p-4"><div class="text-sm text-gray-500">{{ $label }}</div><div class="text-2xl font-bold">{{ $count }}</div></div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
