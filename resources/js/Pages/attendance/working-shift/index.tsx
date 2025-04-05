import React from 'react';
import { Head, Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { PageProps } from '@/types';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/Components/ui/card';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/Components/ui/table';
import { PlusCircle, Edit, Trash2, Eye } from 'lucide-react';
import type { WorkShift } from '@/types/models';

interface WorkShiftIndexProps extends PageProps {
  workShifts: WorkShift[];
}

export default function Index({ auth, workShifts }: WorkShiftIndexProps) {
  return (
    <AppLayout
      breadcrumbs={[
        { title: 'Dashboard', href: route('dashboard') },
        { title: 'Work Shifts', href: route('attendance.working-shift.index') }
      ]}
    >
      <Head title="Work Shifts" />

      <div className="py-12">
        <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <Card>
            <CardHeader className="flex flex-row items-center justify-between space-y-0 pb-2">
              <div>
                <CardTitle className="text-2xl font-bold">Work Shifts</CardTitle>
                <CardDescription>
                  Manage your organization's work shifts
                </CardDescription>
              </div>
              <Link href={route('attendance.working-shift.create')}>
                <Button>
                  <PlusCircle className="mr-2 h-4 w-4" />
                  Add New Shift
                </Button>
              </Link>
            </CardHeader>
            <CardContent>
              <Table>
                <TableHeader>
                  <TableRow>
                    <TableHead>Name</TableHead>
                    <TableHead>Shift Time</TableHead>
                    <TableHead>Working Days</TableHead>
                    <TableHead>Company</TableHead>
                    <TableHead>Default</TableHead>
                    <TableHead className="text-right">Actions</TableHead>
                  </TableRow>
                </TableHeader>
                <TableBody>
                  {workShifts.length === 0 ? (
                    <TableRow>
                      <TableCell colSpan={6} className="text-center">No working shifts found</TableCell>
                    </TableRow>
                  ) : (
                    workShifts.map((shift) => (
                      <TableRow key={shift.id}>
                        <TableCell className="font-medium">{shift.name}</TableCell>
                        <TableCell>{`${shift.start_time} - ${shift.end_time}`}</TableCell>
                        <TableCell>{shift.working_days_formatted}</TableCell>
                        <TableCell>{shift.company?.name || 'N/A'}</TableCell>
                        <TableCell>{shift.is_default ? 'Yes' : 'No'}</TableCell>
                        <TableCell className="text-right space-x-2">
                          <Link href={route('attendance.working-shift.edit', shift.id)}>
                            <Button variant="outline" size="icon">
                              <Edit className="h-4 w-4" />
                            </Button>
                          </Link>
                          <Link href={route('attendance.working-shift.show', shift.id)}>
                            <Button variant="outline" size="icon">
                              <Eye className="h-4 w-4" />
                              <span className="sr-only">View</span>
                            </Button>
                          </Link>
                          <Link href={route('attendance.working-shift.destroy', shift.id)} method="delete" as="button">
                            <Button variant="outline" size="icon">
                              <Trash2 className="h-4 w-4" />
                            </Button>
                          </Link>
                        </TableCell>
                      </TableRow>
                    ))
                  )}
                </TableBody>
              </Table>
            </CardContent>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
