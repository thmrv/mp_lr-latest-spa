<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */

    

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav class="navigation header">
    <div class="flex">
        <a href="{{ route('home') }}" wire:navigate>
            <x-application-logo class="w-auto" />
        </a>
    </div>
</nav>
