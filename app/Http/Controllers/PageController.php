<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function show (Page $page){
        return view('templates.' . ($page->template_name ?? 'single'), ['page' => $page]);
    }
}
