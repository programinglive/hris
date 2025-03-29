import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { PageProps } from '@/types';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardFooter, CardHeader, CardTitle, CardDescription } from '@/components/ui/card';
import { ArrowLeft, Edit } from 'lucide-react';
import { WorkShift } from '@/types/models';

interface Props extends PageProps {
  workShift: WorkShift;
}

export default function Show({ auth, workShift }: Props) {
  return (
    <AppLayout
      breadcrumbs={[
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Work Shifts', href: route('attendance.work-shifts.index') },
        { title: workShift.name, href: route('attendance.work-shifts.show', workShift.id) }
      ]}
    >
      <Head title="Working Shift Details" />

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <Card>
            <CardHeader>
              <CardTitle className="text-2xl font-bold">Working Shift: {workShift.name}</CardTitle>
              <CardDescription>View details of this working shift</CardDescription>
            </CardHeader>
            <CardContent className="space-y-6">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <h3 className="text-sm font-medium text-gray-500">Shift Name</h3>
                  <p className="mt-1 text-lg font-semibold">{workShift.name}</p>
                </div>
                <div>
                  <h3 className="text-sm font-medium text-gray-500">Company</h3>
                  <p className="mt-1 text-lg font-semibold">{workShift.company?.name}</p>
                </div>
              </div>

              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                  <h3 className="text-sm font-medium text-gray-500">Start Time</h3>
                  <p className="mt-1 text-lg font-semibold">{workShift.start_time}</p>
                </div>
                <div>
                  <h3 className="text-sm font-medium text-gray-500">End Time</h3>
                  <p className="mt-1 text-lg font-semibold">{workShift.end_time}</p>
                </div>
                <div>
                  <h3 className="text-sm font-medium text-gray-500">Grace Period</h3>
                  <p className="mt-1 text-lg font-semibold">{workShift.grace_period_minutes} minutes</p>
                </div>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Working Days</h3>
                <p className="mt-1 text-lg font-semibold">{workShift.working_days_formatted}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Default Shift</h3>
                <p className="mt-1 text-lg font-semibold">{workShift.is_default ? 'Yes' : 'No'}</p>
              </div>
            </CardContent>
            <CardFooter className="flex justify-between">
              <Link href={route('attendance.work-shifts.index')}>
                <Button variant="outline">
                  <ArrowLeft className="mr-2 h-4 w-4" />
                  Back to List
                </Button>
              </Link>
              <Link href={route('attendance.work-shifts.edit', workShift.id)}>
                <Button>
                  <Edit className="mr-2 h-4 w-4" />
                  Edit
                </Button>
              </Link>
            </CardFooter>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
