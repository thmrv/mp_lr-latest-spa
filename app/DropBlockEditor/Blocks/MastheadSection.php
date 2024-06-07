<?php

namespace App\DropBlockEditor\Blocks;

use Jeffreyvr\DropBlockEditor\Blocks\Block;

class MastheadSection extends Block
{
    public string $title = 'MastheadSection';

    public array $data = [];

    public string $blockEditComponent = 'masthead-section';

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
