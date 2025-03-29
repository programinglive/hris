import { type PageProps } from '@/types';
import { Card } from '@/components/ui/card';
import { Button } from '@/components/ui/button';
import { DataTable } from '@/components/ui/data-table';
import { type ColumnDef } from '@/components/ui/data-table';
import { Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app/app-layout';
import { type BreadcrumbItem } from '@/types';

interface LeaveRequest {
    id: number;
    user_id: number;
    user: {
        name: string;
    };
    leave_type_id: number;
    leaveType: {
        name: string;
    };
    start_date: string;
    end_date: string;
    status: string;
    reason: string;
}

const columns: ColumnDef<LeaveRequest>[] = [
    {
        accessorKey: 'user.name' as keyof LeaveRequest,
        header: 'Employee',
        cell: ({ row }: { row: LeaveRequest }) => row.user.name,
    },
    {
        accessorKey: 'leaveType.name' as keyof LeaveRequest,
        header: 'Leave Type',
        cell: ({ row }: { row: LeaveRequest }) => row.leaveType.name,
    },
    {
        accessorKey: 'start_date' as keyof LeaveRequest,
        header: 'Start Date',
        cell: ({ row }: { row: LeaveRequest }) => row.start_date,
    },
    {
        accessorKey: 'end_date' as keyof LeaveRequest,
        header: 'End Date',
        cell: ({ row }: { row: LeaveRequest }) => row.end_date,
    },
    {
        accessorKey: 'status' as keyof LeaveRequest,
        header: 'Status',
        cell: ({ row }: { row: LeaveRequest }) => row.status,
    },
    {
        accessorKey: 'reason' as keyof LeaveRequest,
        header: 'Reason',
        cell: ({ row }: { row: LeaveRequest }) => row.reason,
    },
    {
        accessorKey: 'actions' as keyof LeaveRequest,
        header: 'Actions',
        cell: ({ row }: { row: LeaveRequest }) => (
            <div className="flex items-center gap-2">
                <Link href={`/attendance/leave/${row.id}`}>
                    <Button variant="outline" size="sm">View</Button>
                </Link>
                {row.status === 'pending' && (
                    <Link href={`/attendance/leave/${row.id}/edit`}>
                        <Button variant="outline" size="sm">Edit</Button>
                    </Link>
                )}
            </div>
        ),
    },
];

export default function LeaveRequestIndex({ auth, leaveRequests, leaveTypes, filters }: PageProps) {
    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'Attendance',
            href: '/attendance',
        },
        {
            title: 'Leave Requests',
            href: '/attendance/leave',
        }
    ];

    const handlePageChange = (page: number) => {
        const url = new URL(window.location.href);
        url.searchParams.set('page', page.toString());
        window.location.href = url.toString();
    };

    const handleSearch = (search: string) => {
        const url = new URL(window.location.href);
        url.searchParams.set('search', search);
        window.location.href = url.toString();
    };

    return (
        <AppLayout title="Leave Requests" breadcrumbs={breadcrumbs}>
            <div className="p-6">
                <div className="flex items-center justify-between mb-6">
                    <h1 className="text-2xl font-bold">Leave Requests</h1>
                    <Link href="/attendance/leave/create">
                        <Button>Add Leave Request</Button>
                    </Link>
                </div>

                <Card>
                    <DataTable<LeaveRequest>
                        data={leaveRequests.data}
                        columns={columns}
                        title="Leave Requests"
                        searchPlaceholder="Search leave requests..."
                        pagination={{
                            totalItems: leaveRequests.total,
                            currentPage: leaveRequests.current_page,
                            perPage: leaveRequests.per_page,
                            onPageChange: handlePageChange
                        }}
                        onSearch={handleSearch}
                    />
                </Card>
            </div>
        </AppLayout>
    );
}
