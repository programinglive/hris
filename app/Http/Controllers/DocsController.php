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
                    background: #1E2938;
                    color: var(--gray-900);
                }
                
                .docs-content h1 {
                    display: none;
                }
                
                .docs-content h2, .docs-content h3 {
                    margin-top: 2rem;
                    margin-bottom: 1rem;
                    line-height: 1.2;
                }
                
                .docs-content h2 {
                    font-size: 2rem;
                    border-bottom: 1px solid var(--gray-200);
                    padding-bottom: 0.25rem;
                }
                
                .docs-content h3 {
                    font-size: 1.5rem;
                }
                
                .docs-content p {
                    margin-bottom: 1rem;
                    color: var(--gray-900);
                }
                
                .docs-content ul, .docs-content ol {
                    margin-bottom: 1rem;
                    padding-left: 1.5rem;
                    color: var(--gray-900);
                }
                
                .docs-content code {
                    background: #263238;
                    padding: 0.2rem 0.5rem;
                    border-radius: 4px;
                    font-family: 'Fira Code', 'Consolas', monospace;
                    color: #e0e0e0;
                }
                
                .docs-content pre {
                    background: #263238;
                    padding: 1.25rem;
                    border-radius: 8px;
                    overflow-x: auto;
                    margin: 1.5rem 0;
                    border-left: 4px solid #4CAF50;
                    position: relative;
                    display: flex;
                    align-items: flex-start;
                }
                
                .docs-content pre code {
                    background: none;
                    padding: 0;
                    color: #e0e0e0;
                    font-size: 0.9rem;
                    line-height: 1.6;
                    flex: 1;
                }
                
                .docs-content .copy-button {
                    position: absolute;
                    top: 0.5rem;
                    right: 0.5rem;
                    background: rgba(255, 255, 255, 0.1);
                    border: none;
                    border-radius: 4px;
                    padding: 0.25rem 0.5rem;
                    color: #e0e0e0;
                    cursor: pointer;
                    font-size: 0.875rem;
                    transition: all 0.2s ease;
                    z-index: 10;
                }
                
                .docs-content .copy-button:hover {
                    background: rgba(255, 255, 255, 0.2);
                }
                
                .docs-content .copy-button:active {
                    background: rgba(255, 255, 255, 0.3);
                }
                
                .docs-content .copy-button.copied {
                    color: #4CAF50;
                }
                
                .docs-content a {
                    color: var(--gray-900);
                    text-decoration: none;
                }
                
                .docs-content a:hover {
                    text-decoration: underline;
                }
            </style>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const preElements = document.querySelectorAll('.docs-content pre');
                    
                    preElements.forEach(pre => {
                        const code = pre.querySelector('code');
                        if (code) {
                            const button = document.createElement('button');
                            button.className = 'copy-button';
                            button.textContent = 'Copy';
                            
                            button.addEventListener('click', function() {
                                navigator.clipboard.writeText(code.textContent)
                                    .then(() => {
                                        button.textContent = 'Copied!';
                                        button.classList.add('copied');
                                        setTimeout(() => {
                                            button.textContent = 'Copy';
                                            button.classList.remove('copied');
                                        }, 2000);
                                    })
                                    .catch(err => {
                                        console.error('Failed to copy text: ', err);
                                    });
                            });
                            
                            pre.appendChild(button);
                        }
                    });
                });
            </script>
            <div class='docs-content'>$html</div>
        ";

        return Inertia::render('Docs/Show', [
            'html' => $styledHtml,
            'file' => $file,
        ]);
    }
}
