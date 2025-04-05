import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Link, usePage } from '@inertiajs/react';
import { ArrowLeft, Construction } from 'lucide-react';
import { type BreadcrumbItem } from '@/types';

interface PageProps {
    pageTitle?: string;
}

export default function ComingSoon() {
    const { url, props } = usePage<{ pageTitle?: string }>();
    const pageTitle = props.pageTitle || 'Coming Soon';
    
    // Generate breadcrumbs based on the current URL
    const breadcrumbs: BreadcrumbItem[] = generateBreadcrumbs(url, pageTitle);
    
    return (
        <AppLayout title={pageTitle} breadcrumbs={breadcrumbs}>
            <div className="flex min-h-[80vh] flex-col items-center justify-center gap-4 text-center">
                <Construction className="size-24 text-muted-foreground" />
                <h1 className="text-4xl font-bold">{pageTitle}</h1>
                <p className="text-lg text-muted-foreground">
                    This page is under construction and will be available soon.
                </p>
                <Button asChild variant="outline" className="mt-4">
                    <Link href="/dashboard" preserveScroll>
                        <ArrowLeft className="mr-2 size-4" />
                        Back to Dashboard
                    </Link>
                </Button>
            </div>
        </AppLayout>
    );
}

// Helper function to generate breadcrumbs based on URL
function generateBreadcrumbs(url: string, pageTitle: string): BreadcrumbItem[] {
    const parts = url.split('/').filter(Boolean);
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Dashboard',
            href: '/dashboard',
        }
    ];

    // For nested routes, add intermediate breadcrumbs
    if (parts.length > 1) {
        // If we have a path like /employee/lists, add the "Employee" breadcrumb
        if (parts[0] === 'employee' || parts[0] === 'attendance') {
            const title = parts[0].charAt(0).toUpperCase() + parts[0].slice(1);
            breadcrumbs.push({
                title,
                href: `/${parts[0]}`,
            });
        }
    }
    
    // Add the current page as the last breadcrumb
    if (parts.length > 0 && url !== '/dashboard') {
        breadcrumbs.push({
            title: pageTitle,
            href: url,
        });
    }
    
    return breadcrumbs;
}
