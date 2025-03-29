import React from 'react'
import AppLayout from '@/layouts/app/app-layout'
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Link } from '@inertiajs/react'
import { type BreadcrumbItem } from '@/types'
import { ArrowLeft, Edit } from 'lucide-react'
import { Badge } from '@/components/ui/badge'

interface LeaveType {
  id: number;
  name: string;
  code: string;
  description: string | null;
  requires_approval: boolean;
  is_paid: boolean;
  default_days_per_year: number;
  is_active: boolean;
  company: {
    id: number;
    name: string;
  };
  created_at: string;
  updated_at: string;
}

interface Props {
  leaveType: LeaveType;
}

export default function ShowLeaveType({ leaveType }: Props) {
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
      title: 'Leave Types',
      href: route('attendance.leave.type.index'),
    },
    {
      title: leaveType.name,
      href: route('attendance.leave.type.show', leaveType.id),
    }
  ];

  // Format date for display
  const formatDate = (dateString: string) => {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  };

  return (
    <AppLayout title={`Leave Type: ${leaveType.name}`} breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="flex items-center justify-between mb-6">
          <h1 className="text-2xl font-bold">Leave Type Details</h1>
          <div className="flex space-x-2">
            <Link href={route('attendance.leave.type.index')}>
              <Button variant="outline" className="flex items-center gap-2">
                <ArrowLeft className="h-4 w-4" />
                Back to Leave Types
              </Button>
            </Link>
            <Link href={route('attendance.leave.type.edit', leaveType.id)}>
              <Button className="flex items-center gap-2">
                <Edit className="h-4 w-4" />
                Edit
              </Button>
            </Link>
          </div>
        </div>

        <Card>
          <CardHeader>
            <CardTitle className="flex items-center justify-between">
              <span>{leaveType.name} ({leaveType.code})</span>
              <Badge variant={leaveType.is_active ? 'default' : 'secondary'}>
                {leaveType.is_active ? 'Active' : 'Inactive'}
              </Badge>
            </CardTitle>
          </CardHeader>
          <CardContent className="space-y-6">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h3 className="text-sm font-medium text-gray-500">Company</h3>
                <p className="mt-1">{leaveType.company.name}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-gray-500">Default Days Per Year</h3>
                <p className="mt-1">{leaveType.default_days_per_year}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-gray-500">Requires Approval</h3>
                <p className="mt-1">
                  <Badge variant={leaveType.requires_approval ? 'default' : 'secondary'}>
                    {leaveType.requires_approval ? 'Yes' : 'No'}
                  </Badge>
                </p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-gray-500">Paid Leave</h3>
                <p className="mt-1">
                  <Badge variant={leaveType.is_paid ? 'default' : 'secondary'}>
                    {leaveType.is_paid ? 'Yes' : 'No'}
                  </Badge>
                </p>
              </div>
            </div>
            
            {leaveType.description && (
              <div>
                <h3 className="text-sm font-medium text-gray-500">Description</h3>
                <p className="mt-1 whitespace-pre-line">{leaveType.description}</p>
              </div>
            )}
            
            <div className="border-t pt-4 mt-4">
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <h3 className="text-sm font-medium text-gray-500">Created At</h3>
                  <p className="mt-1">{formatDate(leaveType.created_at)}</p>
                </div>
                
                <div>
                  <h3 className="text-sm font-medium text-gray-500">Last Updated</h3>
                  <p className="mt-1">{formatDate(leaveType.updated_at)}</p>
                </div>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
