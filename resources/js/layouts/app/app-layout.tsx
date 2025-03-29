import AppLayoutTemplate from '@/layouts/app/app-sidebar-layout';
import {type BreadcrumbItem, User} from '@/types';
import {Head} from '@inertiajs/react';
import React from "react";

interface AppLayoutProps {
  children: React.ReactNode,
  className?: string,
  title?: string,
  breadcrumbs?: BreadcrumbItem[],
  user?: User
}

export default function AppLayout({children, className, title, breadcrumbs = [], user}: AppLayoutProps) {
  return (
    <>
      {title && <Head title={title}/>}
      <AppLayoutTemplate breadcrumbs={breadcrumbs}>
        {children}
      </AppLayoutTemplate>
    </>
  );
}
