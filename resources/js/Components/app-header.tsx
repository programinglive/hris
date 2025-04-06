import { Breadcrumbs } from '@/Components/breadcrumbs';
import { Icon } from '@/Components/icon';
import { Avatar, AvatarFallback, AvatarImage } from '@/Components/ui/avatar';
import { Button } from '@/Components/ui/button';
import { DropdownMenu, DropdownMenuContent, DropdownMenuTrigger } from '@/Components/ui/dropdown-menu';
import {
    NavigationMenu,
    NavigationMenuContent,
    NavigationMenuItem,
    NavigationMenuLink,
    NavigationMenuList,
    NavigationMenuTrigger,
    navigationMenuTriggerStyle
} from '@/Components/ui/navigation-menu';
import { Sheet, SheetContent, SheetHeader, SheetTitle, SheetTrigger } from '@/Components/ui/sheet';
import { UserMenuContent } from '@/Components/user-menu-content';
import { useInitials } from '@/hooks/use-initials';
import { cn } from '@/lib/utils';
import { type BreadcrumbItem, type NavItem, type SharedData } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { ChevronDown, Folder, LayoutGrid, Menu } from 'lucide-react';
import AppLogoIcon from './app-logo-icon';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'HR Management',
        href: '#',
        icon: Folder,
        submenu: [
            {
                title: 'Employee Management',
                href: '/employee-management',
            },
            {
                title: 'Payroll Management',
                href: '/payroll-management',
            },
            {
                title: 'Time-Off Management',
                href: '/time-off-management',
            },
            {
                title: 'Performance Management',
                href: '/performance-management',
            },
        ],
    },
];

const rightNavItems: NavItem[] = [
    {
        title: 'Base Data',
        href: '#',
        icon: Folder,
    }
];

const activeItemStyles = 'text-neutral-900 dark:bg-neutral-800 dark:text-neutral-100';

interface AppHeaderProps {
    breadcrumbs?: BreadcrumbItem[];
}

export function AppHeader({ breadcrumbs = [] }: AppHeaderProps) {
    const page = usePage<SharedData>();
    const { auth } = page.props;
    const getInitials = useInitials();
    
    // Show login button if not authenticated
    const showLoginButton = !auth.user;
    
    return (
        <>
            <div className="border-sidebar-border/80 border-b">
                <div className="mx-auto flex h-16 items-center px-4 md:max-w-7xl">
                    {/* Mobile Menu */}
                    <div className="lg:hidden">
                        <Sheet>
                            <SheetTrigger asChild>
                                <Button variant="ghost" size="icon" className="mr-2 h-[34px] w-[34px]">
                                    <Menu className="h-5 w-5" />
                                </Button>
                            </SheetTrigger>
                            <SheetContent side="left" className="bg-sidebar flex h-full w-64 flex-col items-stretch justify-between">
                                <SheetTitle className="sr-only">Navigation Menu</SheetTitle>
                                <SheetHeader className="flex justify-start text-left">
                                    <AppLogoIcon className="h-6 w-6 fill-current text-black dark:text-white" />
                                </SheetHeader>
                                <div className="flex h-full flex-col space-y-4 p-4">
                                    <div className="flex h-full flex-col justify-between text-sm">
                                        <div className="flex flex-col space-y-4">
                                            {mainNavItems.map((item) => (
                                                <div key={item.title}>
                                                    {item.submenu ? (
                                                        <div className="flex flex-col space-y-2">
                                                            <div className="flex items-center space-x-2 font-medium">
                                                                {item.icon && <Icon iconNode={item.icon} className="h-5 w-5" />}
                                                                <span>{item.title}</span>
                                                            </div>
                                                            <div className="pl-6">
                                                                {item.submenu.map((subItem) => (
                                                                    <Link
                                                                        key={subItem.title}
                                                                        href={subItem.href}
                                                                        className={cn(
                                                                            'flex items-center space-x-2 rounded-md px-3 py-2 text-sm font-normal transition-colors hover:bg-sidebar/50',
                                                                            activeItemStyles
                                                                        )}
                                                                    >
                                                                        <span>{subItem.title}</span>
                                                                    </Link>
                                                                ))}
                                                            </div>
                                                        </div>
                                                    ) : (
                                                        <Link
                                                            href={item.href}
                                                            className={cn(
                                                                'flex items-center space-x-2 rounded-md px-3 py-2 text-sm font-medium transition-colors hover:bg-sidebar/50',
                                                                activeItemStyles
                                                            )}
                                                        >
                                                            {item.icon && <Icon iconNode={item.icon} className="h-5 w-5" />}
                                                            <span>{item.title}</span>
                                                        </Link>
                                                    )}
                                                </div>
                                            ))}
                                        </div>
                                    </div>
                                </div>
                            </SheetContent>
                        </Sheet>
                    </div>

                    {/* Desktop Navigation */}
                    <div className="hidden lg:flex lg:items-center lg:space-x-4">
                        <NavigationMenu>
                            <NavigationMenuList>
                                {mainNavItems.map((item) => (
                                    <NavigationMenuItem key={item.title}>
                                        {item.submenu ? (
                                            <NavigationMenuTrigger className={navigationMenuTriggerStyle()}>
                                                <div className="flex items-center space-x-2">
                                                    {item.icon && <Icon iconNode={item.icon} className="h-5 w-5" />}
                                                    <span>{item.title}</span>
                                                    <ChevronDown className="h-4 w-4" />
                                                </div>
                                            </NavigationMenuTrigger>
                                        ) : (
                                            <NavigationMenuLink asChild>
                                                <Link
                                                    href={item.href}
                                                    className={cn(
                                                        navigationMenuTriggerStyle(),
                                                        'flex items-center space-x-2',
                                                        activeItemStyles
                                                    )}
                                                >
                                                    {item.icon && <Icon iconNode={item.icon} className="h-5 w-5" />}
                                                    <span>{item.title}</span>
                                                </Link>
                                            </NavigationMenuLink>
                                        )}
                                        {item.submenu && (
                                            <NavigationMenuContent>
                                                <div className="flex flex-col space-y-2">
                                                    {item.submenu.map((subItem) => (
                                                        <Link
                                                            key={subItem.title}
                                                            href={subItem.href}
                                                            className={cn(
                                                                'flex items-center space-x-2 rounded-md px-3 py-2 text-sm font-normal transition-colors hover:bg-sidebar/50',
                                                                activeItemStyles
                                                            )}
                                                        >
                                                            <span>{subItem.title}</span>
                                                        </Link>
                                                    ))}
                                                </div>
                                            </NavigationMenuContent>
                                        )}
                                    </NavigationMenuItem>
                                ))}
                            </NavigationMenuList>
                        </NavigationMenu>
                    </div>

                    {/* Right side content */}
                    <div className="ml-auto flex items-center space-x-4">
                        {showLoginButton ? (
                            <Link href="/login" className="text-sm font-medium">
                                Login
                            </Link>
                        ) : (
                            <DropdownMenu>
                                <DropdownMenuTrigger asChild>
                                    <Button variant="ghost" size="icon" className="h-8 w-8">
                                        <Avatar className="h-8 w-8">
                                            {auth.user && (
                                                <>
                                                    <AvatarImage 
                                                        src={auth.user.profile_photo_url as string} 
                                                        alt={auth.user.name as string} 
                                                    />
                                                    <AvatarFallback>{getInitials(auth.user.name as string)}</AvatarFallback>
                                                </>
                                            )}
                                        </Avatar>
                                    </Button>
                                </DropdownMenuTrigger>
                                <DropdownMenuContent align="end" className="w-[200px]">
                                    {auth.user && <UserMenuContent user={auth.user} />}
                                </DropdownMenuContent>
                            </DropdownMenu>
                        )}
                    </div>
                </div>
            </div>

            {/* Breadcrumbs */}
            {breadcrumbs.length > 0 && (
                <div className="border-sidebar-border/70 flex w-full border-b">
                    <div className="mx-auto flex h-12 w-full items-center justify-start px-4 text-neutral-500 md:max-w-7xl">
                        <Breadcrumbs breadcrumbs={breadcrumbs} />
                    </div>
                </div>
            )}
        </>
    );
}