<?php

namespace App\Http\Controllers;

class ToolController extends Controller
{
    public static function sanitizeString($code): string
    {
        return strtoupper(trim(preg_replace('/\s+/', '', $code)));
    }
}
