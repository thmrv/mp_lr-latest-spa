<x-filament-panels::page>
    <link rel="stylesheet" href="{{asset('/css/admin/robots.css')}}">
    <form>
        {{ $this->form }}
        <x-filament::button type="submit" style="margin-top:2em;" class="mt-12 mb-8">
            {{ __('general.save') }}
        </x-filament::button>
    </form>
</x-filament-panels::page>
