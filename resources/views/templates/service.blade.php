<x-app-layout>
    <x-slot name="masthead">
       <livewire:masthead />
    </x-slot>

    <div class="py-12">
        {{ $service->name ?? 'Service Name'}}
        {{ $service->title ?? 'Service Title'}}
    </div>
</x-app-layout>