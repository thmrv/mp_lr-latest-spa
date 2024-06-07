<div class="gutenberg wrapper w-full mt-8 dark:dark light:light">
    <textarea id="data.content" name="{{ $name }}" hidden></textarea>
    <livewire:placeholders.skeleton />
    <script>Laraberg.init('data.content', { laravelFilemanager: true, height: '100vh'})</script>
</div>
