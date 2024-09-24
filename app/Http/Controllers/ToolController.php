<?php

namespace App\Http\Controllers;

class ToolController extends Controller
{
    /**
     * @param $code
     * @return string
     */
    public static function sanitizeString($code): string
    {
        return strtoupper(trim(preg_replace('/\s+/', '', $code)));
    }
}