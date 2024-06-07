<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Jeffreyvr\DropBlockEditor\Parsers\Parse;

class BlockEditorSaveButton extends Component
{
	public $properties;

    protected $listeners = [
        'editorIsUpdated' => 'editorIsUpdated',
    ];

    public function editorIsUpdated($properties)
    {
        $this->properties = $properties;
    }

    public function save()
    {
        // Example of getting a json string of the active blocks.
        $activeBlocks = collect($this->properties['activeBlocks'])
        	->toJson();

        // If you want to generate the output, you can do:
        $output = Parse::execute([
             'activeBlocks' => $this->properties['activeBlocks'],
             'base' => $this->properties['base'],
             'context' => 'rendered',
             'parsers' => $this->properties['parsers'],
    	]);
    }

    public function render()
    {
        return <<<'blade'
            <div>
                <button wire:click="save" class="bg-blue-200 text-blue-900 rounded px-3 py-1 text-sm">save</button>
            </div>
            blade;
    }
}