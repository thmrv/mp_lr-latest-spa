<?php

namespace App\DropBlockEditor\Blocks;

use Jeffreyvr\DropBlockEditor\Blocks\Block;

class Masthead extends Block
{
    public string $title = 'Masthead';

    public array $data = [];

    public string $blockEditComponent = 'masthead';

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
