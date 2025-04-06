import React from 'react';
import { Link } from '@inertiajs/react';
import { Head } from '@inertiajs/react';

interface Section {
    [key: string]: string[];
}

interface DocMapping {
    'Introduction': 'getting-started.md';
    'Installation': 'installation.md';
    'Installation Wizard': 'installation-wizard.md';
    'API Documentation': 'api.md';
    'Employee Management': 'employee.md';
    'Organization Structure': 'organization.md';
    'README': 'README.md';
}

type DocTitle = keyof DocMapping;

const sections: Section = {
    'Getting Started': [
        'Introduction',
        'Installation',
        'Installation Wizard'
    ] as DocTitle[],
    'Features': [
        'Employee Management',
        'Organization Structure'
    ] as DocTitle[],
    'API': [
        'API Documentation'
    ] as DocTitle[],
    'Reference': [
        'README'
    ] as DocTitle[]
};

const docs: DocMapping = {
    'Introduction': 'getting-started.md',
    'Installation': 'installation.md',
    'Installation Wizard': 'installation-wizard.md',
    'API Documentation': 'api.md',
    'Employee Management': 'employee.md',
    'Organization Structure': 'organization.md',
    'README': 'README.md'
};

interface DocsLayoutProps {
    children: React.ReactNode;
    title: string;
    activeFile?: string;
}

export default function DocsLayout({ children, title, activeFile }: DocsLayoutProps) {
    const renderNavigation = () => {
        return Object.entries(sections).map(([sectionName, items]) => (
            <div key={sectionName} className="space-y-1">
                <h3 className="text-sm font-semibold text-gray-400 uppercase tracking-wider">
                    {sectionName}
                </h3>
                <ul className="space-y-1">
                    {items.map((item: string) => {
                        const file = docs[item as DocTitle];
                        return (
                            <li key={file}>
                                <Link
                                    href={route('docs.show', { file })}
                                    className={`block rounded-md text-sm font-medium ${
                                        activeFile === file
                                            ? 'bg-blue-50 text-blue-700'
                                            : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900'
                                    }`}
                                >
                                    {item}
                                </Link>
                            </li>
                        );
                    })}
                </ul>
            </div>
        ));
    };

    return (
        <div className="min-h-screen bg-gray-100">
            <Head title={title} />
            
            {/* Header */}
            <header className="bg-white border-b">
                <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div className="flex justify-between h-16">
                        <div className="flex items-center">
                            <Link href="/" className="text-xl font-bold text-gray-800">
                                HRIS Open Source
                            </Link>
                        </div>
                        <div className="flex items-center space-x-4">
                            <Link href="/docs" className="text-gray-600 hover:text-gray-900">
                                Documentation
                            </Link>
                            <Link href="/github" className="text-gray-600 hover:text-gray-900">
                                GitHub
                            </Link>
                        </div>
                    </div>
                </div>
            </header>

            {/* Main Content */}
            <main className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div className="grid grid-cols-12 gap-8">
                    {/* Sidebar */}
                    <aside className="col-span-12 lg:col-span-3">
                        <nav>
                            {renderNavigation()}
                        </nav>
                    </aside>

                    {/* Content */}
                    <div className="col-span-12 lg:col-span-9 bg-white rounded-lg shadow">
                        <div className="prose prose-lg max-w-none">
                            {children}
                        </div>
                    </div>
                </div>
            </main>
        </div>
    );
}
