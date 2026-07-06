<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold">{{ __('My Links') }}</h3>
                        <a href="{{ url('/') }}" class="text-sm text-red-600 hover:underline">{{ __('Create new') }}</a>
                    </div>

                    @if ($kaltas->isEmpty())
                        <p class="text-gray-500 dark:text-gray-400">
                            {{ __("You haven't created any links yet. Head to the homepage to shorten a URL, upload a file, generate a QR code, or set up your bio page.") }}
                        </p>
                    @else
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-sm text-left">
                                <thead class="text-xs uppercase text-gray-500 dark:text-gray-400 border-b dark:border-gray-700">
                                    <tr>
                                        <th class="py-2 pr-4">{{ __('Type') }}</th>
                                        <th class="py-2 pr-4">{{ __('Short link') }}</th>
                                        <th class="py-2 pr-4">{{ __('Destination') }}</th>
                                        <th class="py-2 pr-4">{{ __('Created') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kaltas as $kalta)
                                        @php
                                            $type = class_basename($kalta->kaltaable_type ?? '');
                                            $destination = match ($type) {
                                                'Short' => $kalta->kaltaable->long_url ?? null,
                                                'File' => $kalta->kaltaable->name ?? null,
                                                'Bio' => $kalta->kaltaable->title ?? null,
                                                default => null,
                                            };
                                        @endphp
                                        <tr class="border-b dark:border-gray-700">
                                            <td class="py-2 pr-4">
                                                <span class="inline-block px-2 py-0.5 rounded text-xs bg-gray-100 dark:bg-gray-700">
                                                    {{ $type ?: 'Kalta' }}
                                                </span>
                                            </td>
                                            <td class="py-2 pr-4">
                                                <a href="{{ route('kaltas.show', $kalta->url) }}" target="_blank" class="text-red-600 hover:underline">
                                                    {{ $kalta->url }}
                                                </a>
                                            </td>
                                            <td class="py-2 pr-4 max-w-xs truncate" title="{{ $destination }}">
                                                {{ $destination ?? '—' }}
                                            </td>
                                            <td class="py-2 pr-4 text-gray-500 dark:text-gray-400">
                                                {{ $kalta->created_at->diffForHumans() }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
