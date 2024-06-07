<?php

namespace App\DropBlockEditor\Blocks;

use Jeffreyvr\DropBlockEditor\Blocks\Block;

class Paragraph extends Block
{
    public string $title = 'Paragraph';

    public array $data = [];

    public string $blockEditComponent = 'paragraph';

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
