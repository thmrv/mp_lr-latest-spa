<?php

namespace App\Services\Generators\TemplateEngine;

class BasePageTemplateService extends AbstractPageTemplateService
{
    function __construct(){
        parent::__construct();
    }

    public function render() {
        $content = '';
        return $content;
    }
}