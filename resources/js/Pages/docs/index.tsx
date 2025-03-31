import DocsLayout from './layout';
import { type BreadcrumbItem } from '@/types';
import { Link } from '@inertiajs/react';

const docs = {
    'Getting Started': 'getting-started/README.md',
    'Organization': 'organization/README.md',
    'Employee': 'employee/README.md',
    'API Documentation': 'api/README.md',
};

export default function Index() {
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        },
        {
            title: 'Documentation',
            href: '/docs',
        }
    ];

    return (
        <DocsLayout title="Documentation" breadcrumbs={breadcrumbs}>
            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {Object.entries(docs).map(([title, file]) => (
                    <Link
                        key={file}
                        href={`/docs/${encodeURIComponent(file)}`}
                        className="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow"
                    >
                        <h2 className="text-xl font-semibold mb-2">{title}</h2>
                        <p className="text-gray-600">Click to view documentation</p>
                    </Link>
                ))}
            </div>
        </DocsLayout>
    );
}
