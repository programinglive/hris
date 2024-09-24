<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ToolController extends Controller
{
    /**
     * @param $code
     * @return string
     */
    public static function sanitizeString($code): string
    {
        return trim(preg_replace('/\s+/', '', $code));
    }
}