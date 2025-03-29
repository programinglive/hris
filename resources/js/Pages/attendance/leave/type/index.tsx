import React, { useState, useEffect } from 'react'
import AppLayout from '@/layouts/app/app-layout'
import { Card, CardHeader, CardFooter, CardContent, CardTitle, CardDescription } from '@/components/ui/card'
import { Button } from '@/components/ui/button'
import { Input } from '@/components/ui/input'
import { Label } from '@/components/ui/label'
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select'
import { Textarea } from '@/components/ui/textarea'
import { Switch } from '@/components/ui/switch'
import { Badge } from '@/components/ui/badge'
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs'
import { AlertDialog, AlertDialogAction, AlertDialogCancel, AlertDialogContent, AlertDialogDescription, AlertDialogFooter, AlertDialogHeader, AlertDialogTitle, AlertDialogTrigger } from '@/components/ui/alert-dialog'
import { usePage } from '@inertiajs/react'
import { type BreadcrumbItem } from '@/types'
import { ArrowLeft } from 'lucide-react'
import { Link, useForm, Head, router } from '@inertiajs/react'
import { useToast } from '@/components/ui/use-toast'
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuTrigger } from '@/components/ui/dropdown-menu'
import { type ColumnDef } from '@/components/ui/data-table'
import { DataTable } from '@/components/ui/data-table'
import { Edit, Trash2, Eye, MoreHorizontal } from 'lucide-react'

interface Company {
  id: number;
  name: string;
}

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

interface PaginatedData {
  data: LeaveType[];
  current_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
  last_page: number;
}

interface Props {
  leaveTypes: PaginatedData;
  companies: Company[];
  filters: {
    search?: string;
    status?: string;
  };
}

export default function LeaveTypeLists({ leaveTypes, filters }: Props) {
  const { url } = usePage();
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = React.useState(false);
  const [leaveTypeToDelete, setLeaveTypeToDelete] = React.useState<number | null>(null);
  const [searchQuery, setSearchQuery] = React.useState(filters.search || '');
  
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
      href: url,
    }
  ];
  
  // Define columns
  const columns: ColumnDef<LeaveType>[] = [
    { key: 'name', label: 'Name' },
    { key: 'code', label: 'Code' },
    { 
      key: 'company', 
      label: 'Company',
      render: (_, row: LeaveType) => row.company ? row.company.name : 'N/A'
    },
    { 
      key: 'default_days_per_year', 
      label: 'Default Days',
      render: (value: number) => value.toString()
    },
    { 
      key: 'is_paid', 
      label: 'Paid',
      render: (value: boolean) => (
        <Badge variant={value ? "success" : "destructive"}>
          {value ? "Yes" : "No"}
        </Badge>
      )
    },
    { 
      key: 'requires_approval', 
      label: 'Requires Approval',
      render: (value: boolean) => (
        <Badge variant={value ? "success" : "destructive"}>
          {value ? "Yes" : "No"}
        </Badge>
      )
    },
    { 
      key: 'is_active', 
      label: 'Status',
      render: (value: boolean) => (
        <Badge variant={value ? "success" : "destructive"}>
          {value ? "Active" : "Inactive"}
        </Badge>
      )
    },
    { 
      key: 'actions', 
      label: 'Actions',
      render: (_, row: LeaveType) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" size="icon">
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem onClick={() => router.get(route('attendance.leave.type.edit', { id: row.id }))}>
              <Edit className="mr-2 h-4 w-4" /> Edit
            </DropdownMenuItem>
            <DropdownMenuItem onClick={() => router.get(route('attendance.leave.type.show', { id: row.id }))}>
              <Eye className="mr-2 h-4 w-4" /> View
            </DropdownMenuItem>
            <DropdownMenuItem onClick={() => {
              setLeaveTypeToDelete(row.id);
              setIsDeleteDialogOpen(true);
            }}>
              <Trash2 className="mr-2 h-4 w-4" /> Delete
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      )
    }
  ];

  const handleDelete = () => {
    if (leaveTypeToDelete) {
      router.delete(route('attendance.leave.type.destroy', { id: leaveTypeToDelete }), {
        preserveScroll: true,
        onSuccess: () => {
          setIsDeleteDialogOpen(false);
          setLeaveTypeToDelete(null);
        }
      });
    }
  };

  return (
    <AppLayout breadcrumbs={breadcrumbs}>
      <div className="space-y-4">
        <div className="flex items-center justify-between">
          <h1 className="text-2xl font-bold">Leave Types</h1>
          <Button onClick={() => router.get(route('attendance.leave.type.create'))}>
            Create Leave Type
          </Button>
        </div>

        <div className="flex items-center gap-2">
          <Input
            placeholder="Search leave types..."
            value={searchQuery}
            onChange={(e) => {
              const query = e.target.value;
              setSearchQuery(query);
              router.get(route('attendance.leave.type.index'), { search: query });
            }}
          />
        </div>

        <DataTable<LeaveType>
          columns={columns}
          data={leaveTypes.data}
          title="Leave Types"
          searchPlaceholder="Search leave types..."
          totalItems={leaveTypes.total}
          currentPage={leaveTypes.current_page}
          perPage={leaveTypes.per_page}
          onPageChange={(page: number) => {
            router.get(route('attendance.leave.type.index'), { page });
          }}
          onSearch={(search: string) => {
            router.get(route('attendance.leave.type.index'), { search });
          }}
        />

        <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
          <AlertDialogContent>
            <AlertDialogHeader>
              <AlertDialogTitle>Are you sure?</AlertDialogTitle>
              <AlertDialogDescription>
                This action cannot be undone. This will permanently delete the leave type.
              </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
              <AlertDialogCancel onClick={() => setIsDeleteDialogOpen(false)}>Cancel</AlertDialogCancel>
              <AlertDialogAction onClick={handleDelete} className="bg-destructive text-destructive-foreground hover:bg-destructive/90">
                Delete
              </AlertDialogAction>
            </AlertDialogFooter>
          </AlertDialogContent>
        </AlertDialog>
      </div>
    </AppLayout>
  );
}
