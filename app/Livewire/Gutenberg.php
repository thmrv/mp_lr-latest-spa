<?php

namespace App\Livewire;

use Livewire\Component;

class Gutenberg extends Component

{
    public $inputId;
    public $name;

    public function mount()
    {
        $this->inputId = 'data.content';
        $this->name = 'content';
    }

    public function placeholder(array $params = [])
    {
        return view('livewire.placeholders.skeleton', $params);
    }
}
