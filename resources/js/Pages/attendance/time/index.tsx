import React, { useState } from 'react';
import { Link, router } from '@inertiajs/react';
import { ToastProvider, useToast } from '@/Components/ui/simple-toast';
import { Button } from '@/Components/ui/button';
import { Input } from '@/Components/ui/input';
import {
  Table,
  TableBody,
  TableCell,
  TableHead,
  TableHeader,
  TableRow,
} from '@/Components/ui/table';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { format } from 'date-fns';
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger } from '@/Components/ui/alert-dialog';
import AppLayout from '@/layouts/app-layout'; // Update import path
import { type BreadcrumbItem } from '@/types';

interface UserDetail {
  employee_id?: string;
}

interface User {
  id: number;
  name: string;
  detail?: UserDetail;
}

interface TimeLog {
  id: number;
  user: User;
  user_id: number;
  check_in_time: string | null;
  check_out_time: string | null;
  status: string;
  total_hours: number | null;
  notes: string | null;
  created_at: string;
  updated_at: string;
}

interface PaginationLink {
  url: string | null;
  label: string;
  active: boolean;
}

interface PaginatedData<T> {
  data: T[];
  current_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
  last_page: number;
  links: PaginationLink[];
}

interface AuthObject {
  user: User;
}

interface TimeLogsProps {
  auth: AuthObject;
  timeLogs: PaginatedData<TimeLog>;
  users: User[];
  filters: {
    search?: string;
    date_from?: string;
    date_to?: string;
    status?: string;
  };
}

// Simple Pagination component to avoid dependency on @/components/pagination
const Pagination: React.FC<{ links: PaginationLink[] }> = ({ links }) => {
  if (links.length <= 3) return null;
  
  return (
    <div className="flex justify-center gap-1 mt-4">
      {links.map((link, i) => (
        <Link
          key={i}
          href={link.url || '#'}
          className={`px-4 py-2 text-sm rounded ${
            link.active
              ? 'bg-primary text-white'
              : link.url
              ? 'bg-gray-100 hover:bg-gray-200'
              : 'bg-gray-50 text-gray-400 cursor-not-allowed'
          }`}
          dangerouslySetInnerHTML={{ __html: link.label }}
        />
      ))}
    </div>
  );
};

// Component for the time logs list content
const TimeLogsListContent: React.FC<TimeLogsProps> = ({timeLogs, filters }) => {
  const [search, setSearch] = useState(filters.search || '');
  const [dateFrom, setDateFrom] = useState(filters.date_from || '');
  const [dateTo, setDateTo] = useState(filters.date_to || '');
  const [status, setStatus] = useState(filters.status || '');
  const { addToast } = useToast();

  const handleSearch = () => {
    router.get(route('attendance.time.index'), {
      search,
      date_from: dateFrom,
      date_to: dateTo,
      status,
    }, {
      preserveState: true,
      replace: true,
    });
  };

  const resetFilters = () => {
    setSearch('');
    setDateFrom('');
    setDateTo('');
    setStatus('');

    router.get(route('attendance.time.index'), {}, {
      preserveState: true,
      replace: true,
    });
  };

  const handleDelete = (id: number) => {
    router.delete(route('attendance.time.destroy', id), {
      onSuccess: () => {
        addToast('Time log deleted successfully', 'success');
      },
    });
  };

  const getStatusBadgeClass = (status: string) => {
    switch (status) {
      case 'present':
        return 'bg-green-100 text-green-800';
      case 'late':
        return 'bg-yellow-100 text-yellow-800';
      case 'absent':
        return 'bg-red-100 text-red-800';
      case 'leave':
        return 'bg-blue-100 text-blue-800';
      default:
        return 'bg-gray-100 text-gray-800';
    }
  };

  return (
    <div className="p-6">
      <h1 className="text-2xl font-bold mb-6">Attendance Time Logs</h1>
      <Card>
        <CardHeader className="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
          <CardTitle className="text-xl font-semibold">Time Logs</CardTitle>
          <Link href={route('attendance.time.create')}>
            <Button>Add New Time Log</Button>
          </Link>
        </CardHeader>

        <CardContent>
          <div className="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
              <Input
                placeholder="Search by name..."
                value={search}
                onChange={(e) => setSearch(e.target.value)}
              />
            </div>
            <div>
              <Input
                type="date"
                placeholder="From Date"
                value={dateFrom}
                onChange={(e) => setDateFrom(e.target.value)}
              />
            </div>
            <div>
              <Input
                type="date"
                placeholder="To Date"
                value={dateTo}
                onChange={(e) => setDateTo(e.target.value)}
              />
            </div>
            <div>
              <select 
                className="w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2"
                value={status} 
                onChange={(e) => setStatus(e.target.value)}
              >
                <option value="">All Statuses</option>
                <option value="present">Present</option>
                <option value="late">Late</option>
                <option value="absent">Absent</option>
                <option value="leave">Leave</option>
              </select>
            </div>
          </div>

          <div className="flex justify-between mb-4">
            <Button variant="outline" onClick={resetFilters}>Reset Filters</Button>
            <Button onClick={handleSearch}>Search</Button>
          </div>

          <div className="rounded-md border overflow-hidden">
            <Table>
              <TableHeader>
                <TableRow>
                  <TableHead>Employee ID</TableHead>
                  <TableHead>Name</TableHead>
                  <TableHead>Check In</TableHead>
                  <TableHead>Check Out</TableHead>
                  <TableHead>Status</TableHead>
                  <TableHead>Hours</TableHead>
                  <TableHead>Actions</TableHead>
                </TableRow>
              </TableHeader>
              <TableBody>
                {timeLogs.data.length > 0 ? (
                  timeLogs.data.map((timeLog) => (
                    <TableRow key={timeLog.id}>
                      <TableCell>{timeLog.user.detail?.employee_id || 'N/A'}</TableCell>
                      <TableCell>{timeLog.user.name}</TableCell>
                      <TableCell>
                        {timeLog.check_in_time ? format(new Date(timeLog.check_in_time), 'dd MMM yyyy HH:mm') : 'N/A'}
                      </TableCell>
                      <TableCell>
                        {timeLog.check_out_time ? format(new Date(timeLog.check_out_time), 'dd MMM yyyy HH:mm') : 'N/A'}
                      </TableCell>
                      <TableCell>
                        <span className={`px-2 py-1 rounded-full text-xs font-medium ${getStatusBadgeClass(timeLog.status)}`}>
                          {timeLog.status.charAt(0).toUpperCase() + timeLog.status.slice(1)}
                        </span>
                      </TableCell>
                      <TableCell>{timeLog.total_hours || 'N/A'}</TableCell>
                      <TableCell>
                        <div className="flex space-x-2">
                          <Link href={route('attendance.time.edit', timeLog.id)}>
                            <Button variant="outline" size="sm">Edit</Button>
                          </Link>
                          <AlertDialog>
                            <AlertDialogTrigger asChild>
                              <Button variant="destructive" size="sm">Delete</Button>
                            </AlertDialogTrigger>
                            <AlertDialogContent>
                              <AlertDialogHeader>
                                <AlertDialogTitle>Are you sure?</AlertDialogTitle>
                                <AlertDialogDescription>
                                  This will permanently delete this time log. This action cannot be undone.
                                </AlertDialogDescription>
                              </AlertDialogHeader>
                              <AlertDialogFooter>
                                <AlertDialogCancel>Cancel</AlertDialogCancel>
                                <AlertDialogAction onClick={() => handleDelete(timeLog.id)}>
                                  Delete
                                </AlertDialogAction>
                              </AlertDialogFooter>
                            </AlertDialogContent>
                          </AlertDialog>
                        </div>
                      </TableCell>
                    </TableRow>
                  ))
                ) : (
                  <TableRow>
                    <TableCell colSpan={7} className="text-center py-4">
                      No time logs found
                    </TableCell>
                  </TableRow>
                )}
              </TableBody>
            </Table>
          </div>

          <div className="mt-4">
            <Pagination links={timeLogs.links} />
          </div>
        </CardContent>
      </Card>
    </div>
  );
};

// Main component that wraps everything with ToastProvider
export default function TimeLogsList(props: TimeLogsProps) {
  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Attendance',
      href: '#',
    },
    {
      title: 'Time Logs',
      href: route('attendance.time.index'),
    }
  ];

  return (
    <ToastProvider>
      <AppLayout title="Attendance Time Logs" breadcrumbs={breadcrumbs}>
        <TimeLogsListContent {...props} />
      </AppLayout>
    </ToastProvider>
  );
}
