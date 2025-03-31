import React from 'react';
import { Link } from '@inertiajs/react';
import { AppContent } from '@/components/app-content';
import { AppShell } from '@/components/app-shell';
import { AppSidebar } from '@/components/app-sidebar';
import { AppSidebarHeader } from '@/components/app-sidebar-header';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';
import AppLogo from '@/components/app-logo';

interface DocsLayoutProps {
    children: React.ReactNode;
    title: string;
    breadcrumbs: BreadcrumbItem[];
}

export default function DocsLayout({ children, title, breadcrumbs }: DocsLayoutProps) {
    return (
        <>
            <Head title={title} />
            <AppShell variant="sidebar">
                <AppSidebar />
                <AppContent variant="sidebar">
                    <AppSidebarHeader breadcrumbs={breadcrumbs} />
                    <div className="p-6">
                        <div className="flex justify-between items-center mb-6">
                            <h1 className="text-3xl font-bold">{title}</h1>
                            <Link href="/dashboard" className="text-blue-600 hover:text-blue-800">
                                &lt; Back to Dashboard
                            </Link>
                        </div>
                        {children}
                    </div>
                </AppContent>
            </AppShell>
        </>
    );
}
