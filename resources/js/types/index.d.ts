import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon | null;
    isActive?: boolean;
    submenu?: NavItem[];
}

export interface ProjectItem {
    name: string;
    url: string;
    icon: LucideIcon;
}

export interface PageProps {
    auth: Auth;
    ziggy: Config & { location: string };
    [key: string]: any;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface WorkingCalendar {
    id: number;
    name: string;
    start_date: string;
    end_date: string;
    description: string | null;
    is_active: boolean;
    company_id: number;
    created_at: string;
    updated_at: string;
}

export interface Holiday {
    id: number;
    name: string;
    date: string;
    description: string | null;
    is_recurring: boolean;
    company_id: number;
    created_at: string;
    updated_at: string;
}
