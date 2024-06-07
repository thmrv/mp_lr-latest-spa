<?php

namespace App\DropBlockEditor\Blocks;

use Jeffreyvr\DropBlockEditor\Blocks\Block;

class WelcomeSection extends Block
{
    public string $title = 'WelcomeSection';

    public array $data = [];

    public string $blockEditComponent = 'welcome-section';

    public function render()
    {
        return <<<'blade'
            <div></div>
        blade;
    }
}
