<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use League\CommonMark\CommonMarkConverter;

class DocsController extends Controller
{
    public function index()
    {
        $docs = [
            'Getting Started' => 'getting-started.md',
            'Development Guidelines' => 'development-guidelines.md',
            'Contributing' => 'contributing.md',
            'Deployment Guide' => 'deployment-guide.md',
            'README' => 'README.md'
        ];

        return Inertia::render('docs/index', [
            'docs' => $docs
        ]);
    }

    public function show($file)
    {
        $fileLower = strtolower($file);
        $pathLower = base_path('docs/' . $fileLower);
        
        if (File::exists($pathLower)) {
            $content = File::get($pathLower);
            $converter = new CommonMarkConverter();
            $html = $converter->convertToHtml($content);
            
            return Inertia::render('docs/show', [
                'html' => $html,
                'file' => $fileLower
            ]);
        }
        
        $pathProper = base_path('docs/' . $file);
        
        if (File::exists($pathProper)) {
            $content = File::get($pathProper);
            $converter = new CommonMarkConverter();
            $html = $converter->convertToHtml($content);
            
            return Inertia::render('docs/show', [
                'html' => $html,
                'file' => $file
            ]);
        }

        abort(404);
    }
}
