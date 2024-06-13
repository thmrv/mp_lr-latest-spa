<x-filament-panels::page>
    <link rel="stylesheet" href="{{asset('/css/admin/editor.css')}}">
    <script src="{{ asset('/js/admin/editor.js') }}"></script>
    <form>
        {{ $this->form }}
        <div class="blockeditor dark:editor-dark">
            @livewire('dropblockeditor', [
            'title' => __('general.page_editor')
            ])
        </div>
        <x-filament::button type="submit" class="mt-8 mb-8">
            {{ __('general.save') }}
        </x-filament::button>
    </form>
</x-filament-panels::page>
