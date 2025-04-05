import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { PageProps } from '@/types';
import { Button } from '@/Components/ui/button';
import { Card, CardContent } from '@/Components/ui/card';
import { Loader2 } from 'lucide-react';
import { type BreadcrumbItem } from '@/types';

interface Props extends PageProps {
  workShift: any;
}

export default function Show({ auth, workShift }: Props) {
  return (
    <AppLayout
      title="View Work Shift"
      breadcrumbs={[
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Attendance', href: route('attendance') },
        { title: 'Working Shifts', href: route('attendance.work-shifts.index') },
        { title: 'View', href: route('attendance.work-shifts.show', workShift.id) },
      ]}
    >
      <Head title="Working Shift Details" />

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <Card className="w-full">
            <CardContent className="p-6 flex flex-col items-center justify-center space-y-4">
              <Loader2 className="h-12 w-12 animate-spin text-muted-foreground" />
              <h2 className="text-2xl font-semibold">Work Shift Management Module</h2>
              <p className="text-muted-foreground text-center">This module is currently under development and will be available soon.</p>
            </CardContent>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
