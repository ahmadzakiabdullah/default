<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'UTeM Helpdesk') }}</title>
    @livewireStyles
</head>
<body class="bg-gray-50 text-gray-900">
    <nav class="flex gap-4 border-b bg-white p-4">
        <a href="{{ route('tickets.create') }}">{{ __('ticket.create_title') }}</a>
        <a href="{{ route('tickets.track') }}">{{ __('ticket.track_title') }}</a>
    </nav>
    {{ $slot }}
    @livewireScripts
</body>
</html>
