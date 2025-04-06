<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use Inertia\Inertia;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\MarkdownConverter;

class DocsController extends Controller
{
    public function index()
    {
        $docs = [
            'Introduction' => 'getting-started.md',
            'Installation' => 'installation.md',
            'Installation Wizard' => 'installation-wizard.md',
            'API Documentation' => 'api.md',
            'Employee Management' => 'employee.md',
            'Organization Structure' => 'organization.md',
            'README' => 'README.md',
        ];

        return Inertia::render('Docs/Index', [
            'docs' => $docs,
        ]);
    }

    public function show($file)
    {
        // Get the full path to the docs directory
        $path = base_path('resources/docs/' . $file);

        if (!File::exists($path)) {
            abort(404);
        }

        $content = File::get($path);
        
        // Create a new environment and add the CommonMark extension
        $environment = new Environment([
            'html_input' => 'escape',
            'allow_unsafe_links' => false,
            'enable_html' => true,
        ]);
        
        $environment->addExtension(new CommonMarkCoreExtension());
        
        // Create the converter with the environment
        $converter = new MarkdownConverter($environment);
        
        // Convert markdown to HTML using the modern API
        $html = $converter->convert($content)->getContent();

        // Add custom styling
        $styledHtml = "
            <style>
                .docs-content {
                    line-height: 1.7;
                    background: white;
                    border-radius: 8px;
                }
                
                .docs-content h1, .docs-content h2, .docs-content h3 {
                    margin-top: 2rem;
                    margin-bottom: 1rem;
                    line-height: 1.2;
                }
                
                .docs-content h1 {
                    font-size: 2.5rem;
                    border-bottom: 2px solid #e5e7eb;
                    padding-bottom: 0.5rem;
                }
                
                .docs-content h2 {
                    font-size: 2rem;
                    border-bottom: 1px solid #e5e7eb;
                    padding-bottom: 0.25rem;
                }
                
                .docs-content h3 {
                    font-size: 1.5rem;
                }
                
                .docs-content p {
                    margin-bottom: 1rem;
                }
                
                .docs-content ul, .docs-content ol {
                    margin-bottom: 1rem;
                    padding-left: 1.5rem;
                }
                
                .docs-content code {
                    background: #f3f4f6;
                    padding: 0.2rem 0.5rem;
                    border-radius: 4px;
                    font-family: 'Fira Code', 'Consolas', monospace;
                }
                
                .docs-content pre {
                    background: #1f2937;
                    padding: 1rem;
                    border-radius: 8px;
                    overflow-x: auto;
                }
                
                .docs-content pre code {
                    background: none;
                    padding: 0;
                    color: #e5e7eb;
                }
                
                .docs-content a {
                    color: #3b82f6;
                    text-decoration: none;
                }
                
                .docs-content a:hover {
                    text-decoration: underline;
                }
            </style>
            <div class='docs-content'>$html</div>
        ";

        return Inertia::render('Docs/Show', [
            'html' => $styledHtml,
            'file' => $file,
        ]);
    }
}
