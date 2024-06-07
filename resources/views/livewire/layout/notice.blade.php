<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    public $content = '';
    public $expanded = true;

    public function update() {
        return $expanded ? $expanded = false : $expanded = true;
    }
}; ?>

<nav class="navigation notice">
    <div class="flex {{ $expanded == true ? 'expanded' : ''}}" wire:click="update">
        <div class="icon expander dark:hidden">
            <img src="{{URL::asset('/images/svg/light_close.svg')}}" alt="expand" height="100" width="100">
        </div>
        <div class="icon expander dark:block">
            <img src="{{URL::asset('/images/svg/dark_close.svg')}}" alt="expand" height="100" width="100">
        </div>
    </div>
    <
</nav>
