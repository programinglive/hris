import DocsLayout from './layout';
import { type BreadcrumbItem } from '@/types';
import { Link } from '@inertiajs/react';
import { usePage } from '@inertiajs/react';
import { useEffect, useState } from 'react';
import { marked } from 'marked';

export default function Show({ file }: { file: string }) {
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
        {
            title: 'Documentation',
            href: '/docs',
        },
        {
            title: decodeURIComponent(file).replace('.md', ''),
            href: `/docs/${encodeURIComponent(file)}`,
        }
    ];

    const [content, setContent] = useState('');
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState<string | null>(null);

    useEffect(() => {
        const fetchDoc = async () => {
            setLoading(true);
            setError(null);
            try {
                // Clean up the file path
                const filePath = file.replace(/\/+/g, '/');
                const url = new URL(`/resources/docs/${filePath}`, window.location.origin);
                
                const response = await fetch(url);
                if (!response.ok) throw new Error(`Failed to fetch documentation: ${response.statusText}`);
                const text = await response.text();
                
                // Parse markdown
                const html = marked.parse(text);
                setContent(html);
            } catch (error) {
                console.error('Error fetching documentation:', error);
                if (error instanceof Error) {
                    setError(error.message);
                } else if (error instanceof TypeError) {
                    setError('TypeScript error: ' + error.message);
                } else {
                    setError('An unknown error occurred');
                }
            } finally {
                setLoading(false);
            }
        };

        fetchDoc();
    }, [file]);

    return (
        <DocsLayout title={decodeURIComponent(file).replace('.md', '')} breadcrumbs={breadcrumbs}>
            <div className="max-w-4xl mx-auto">
                {loading && (
                    <div className="text-center py-8">
                        <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900 mx-auto"></div>
                    </div>
                )}
                {error && (
                    <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <span className="block sm:inline">{error}</span>
                    </div>
                )}
                {!loading && !error && (
                    <div dangerouslySetInnerHTML={{ __html: content }}></div>
                )}
            </div>
        </DocsLayout>
    );
}
