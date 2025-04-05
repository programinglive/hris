import { NavFooter } from '@/Components/nav-footer';
import { NavUser } from '@/Components/nav-user';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuItem, SidebarMenuButton, SidebarMenuSub, SidebarMenuSubButton } from '@/Components/ui/sidebar';
import { type NavItem } from '@/types';
import { Link, usePage } from '@inertiajs/react';
import { Clock, FileText, LayoutGrid, Users, Building, Package, ChevronRight } from 'lucide-react';
import AppLogo from './app-logo';
import {
    Collapsible,
    CollapsibleContent,
    CollapsibleTrigger,
} from "@/Components/ui/collapsible";
import { useMemo } from 'react';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
        icon: LayoutGrid,
    },
    {
        title: 'Employee',
        href: '#',
        icon: Users,
        submenu: [
            {
                title: 'Lists',
                href: '/employee',
            },
        ],
    },
    {
        title: 'Organization',
        href: '#',
        icon: Building,
        submenu: [
            {
                title: 'Company',
                href: '/organization/company',
            },
            {
                title: 'Branch',
                href: '/organization/branch',
            },
            {
                title: 'Brand',
                href: '/organization/brand',
            },
            {
                title: 'Department',
                href: '/organization/department',
            },
            {
                title: 'Division',
                href: '/organization/division',
            },
            {
                title: 'Sub Division',
                href: '/organization/subdivision',
            },
            {
                title: 'Level',
                href: '/organization/level',
            },
            {
                title: 'Position',
                href: '/organization/position',
            },
        ],
    },
    {
        title: 'Attendance',
        href: '#',
        icon: Clock,
        submenu: [
            {
                title: 'Time',
                href: '/attendance/time',
            },
            {
                title: 'Leave',
                href: '/attendance/leave',
            },
            {
                title: 'Overtime',
                href: '/attendance/overtime',
            },
            {
                title: 'Switch Off',
                href: '/attendance/switch-off',
            },
            {
                title: 'Working Calendar',
                href: '/attendance/working-calendar',
            },
            {
                title: 'Working Shift',
                href: '/attendance/working-shift',
            },
            {
                title: 'Leave Type',
                href: '/attendance/leave-type',
            },
        ],
    },
    {
        title: 'Assets',
        href: '#',
        icon: Package,
        submenu: [
            {
                title: 'Category',
                href: '/assets/category',
            },
            {
                title: 'Sub Category',
                href: '/assets/sub-category',
            },
            {
                title: 'Inventory',
                href: '/assets/inventory',
            },
            {
                title: 'Lists',
                href: '/assets',
            },
            {
                title: 'Request',
                href: '/assets/request',
            },
        ],
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Settings',
        href: '/settings',
        icon: FileText,
    },
    {
        title: 'Documentation',
        href: '/docs',
        icon: FileText,
    },
    {
        title: 'Base Data',
        href: '#',
        icon: FileText,
        submenu: [
            {
                title: 'Users',
                href: '/employee/users',
            },
            {
                title: 'FAQ',
                href: '/basedata/faq',
            },
        ],
    }
];

export function AppSidebar() {
    const { url } = usePage();
    const currentPath = url;

    // Function to check if a menu item should be open based on current URL
    const shouldMenuBeOpen = (item: NavItem): boolean => {
        if (!item.submenu) return false;
        
        // Check if any submenu item's href matches the current path
        return item.submenu.some(subItem => 
            currentPath.startsWith(subItem.href)
        );
    };

    // Determine which menus should be open
    const openMenus = useMemo(() => {
        const result: Record<string, boolean> = {};
        
        // Check main nav items
        mainNavItems.forEach(item => {
            if (item.submenu) {
                result[item.title] = shouldMenuBeOpen(item);
            }
        });
        
        // Check footer nav items
        footerNavItems.forEach(item => {
            if (item.submenu) {
                result[item.title] = shouldMenuBeOpen(item);
            }
        });
        
        return result;
    }, [currentPath]);

    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href="/dashboard" prefetch preserveScroll>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <SidebarMenu>
                    {mainNavItems.map((item) => (
                        item.submenu ? (
                            <Collapsible
                                key={item.title}
                                asChild
                                className="group/collapsible"
                                defaultOpen={openMenus[item.title]}
                            >
                                <SidebarMenuItem>
                                    <CollapsibleTrigger asChild>
                                        <SidebarMenuButton tooltip={item.title}>
                                            {item.icon && <item.icon className="mr-2" />}
                                            <span>{item.title}</span>
                                            <ChevronRight className="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                                        </SidebarMenuButton>
                                    </CollapsibleTrigger>
                                    <CollapsibleContent>
                                        <SidebarMenuSub>
                                            {item.submenu.map((subItem) => (
                                                <SidebarMenuItem key={subItem.title}>
                                                    <SidebarMenuSubButton
                                                        asChild
                                                        size="md"
                                                        isActive={currentPath.startsWith(subItem.href)}
                                                    >
                                                        <Link href={subItem.href} prefetch preserveScroll>
                                                            {subItem.title}
                                                        </Link>
                                                    </SidebarMenuSubButton>
                                                </SidebarMenuItem>
                                            ))}
                                        </SidebarMenuSub>
                                    </CollapsibleContent>
                                </SidebarMenuItem>
                            </Collapsible>
                        ) : (
                            <SidebarMenuItem key={item.title}>
                                <SidebarMenuButton 
                                    asChild 
                                    tooltip={item.title}
                                    isActive={currentPath === item.href}
                                >
                                    <Link href={item.href} prefetch preserveScroll>
                                        {item.icon && <item.icon className="mr-2" />}
                                        <span>{item.title}</span>
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        )
                    ))}
                </SidebarMenu>
            </SidebarContent>

            <SidebarFooter>
                <SidebarMenu>
                    {footerNavItems.map((item) => (
                        item.submenu ? (
                            <Collapsible
                                key={item.title}
                                asChild
                                className="group/collapsible"
                                defaultOpen={openMenus[item.title]}
                            >
                                <SidebarMenuItem>
                                    <CollapsibleTrigger asChild>
                                        <SidebarMenuButton tooltip={item.title}>
                                            {item.icon && <item.icon className="mr-2" />}
                                            <span>{item.title}</span>
                                            <ChevronRight className="ml-auto transition-transform duration-200 group-data-[state=open]/collapsible:rotate-90" />
                                        </SidebarMenuButton>
                                    </CollapsibleTrigger>
                                    <CollapsibleContent>
                                        <SidebarMenuSub>
                                            {item.submenu.map((subItem) => (
                                                <SidebarMenuItem key={subItem.title}>
                                                    <SidebarMenuSubButton
                                                        asChild
                                                        size="md"
                                                        isActive={currentPath.startsWith(subItem.href)}
                                                    >
                                                        <Link href={subItem.href} prefetch preserveScroll>
                                                            {subItem.title}
                                                        </Link>
                                                    </SidebarMenuSubButton>
                                                </SidebarMenuItem>
                                            ))}
                                        </SidebarMenuSub>
                                    </CollapsibleContent>
                                </SidebarMenuItem>
                            </Collapsible>
                        ) : (
                            <SidebarMenuItem key={item.title}>
                                <SidebarMenuButton 
                                    asChild 
                                    tooltip={item.title}
                                    isActive={currentPath === item.href}
                                >
                                    <Link href={item.href} prefetch preserveScroll>
                                        {item.icon && <item.icon className="mr-2" />}
                                        <span>{item.title}</span>
                                    </Link>
                                </SidebarMenuButton>
                            </SidebarMenuItem>
                        )
                    ))}
                </SidebarMenu>
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}