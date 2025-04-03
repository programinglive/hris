<?php

namespace App\Http\Controllers\Installation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompleteController extends Controller
{
    public function index()
    {
        return inertia('Installation/Complete', [
            'currentStep' => 4,
            'totalSteps' => 4,
        ]);
    }
}
