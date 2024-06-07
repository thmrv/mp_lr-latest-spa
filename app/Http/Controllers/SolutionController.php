<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solution;

class SolutionController extends Controller
{
    public function show (Solution $solution){
        return view('templates.' . ($solution->template_name ?? 'solution'), ['solution' => $solution]);
    }
}
