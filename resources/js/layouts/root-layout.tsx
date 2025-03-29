import { AppSidebar } from '@/components/app-sidebar';
import { cn } from '@/lib/utils';
import { SidebarProvider } from '@/components/ui/sidebar';

interface RootLayoutProps {
    children: React.ReactNode;
    className?: string;
}

export function RootLayout({ children, className }: RootLayoutProps) {
    return (
        <SidebarProvider>
            <div className="flex min-h-screen">
                <AppSidebar />
                <main className={cn('flex-1 overflow-x-hidden p-4', className)}>
                    {children}
                </main>
            </div>
        </SidebarProvider>
    );
}
