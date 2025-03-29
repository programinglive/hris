import React, { useState, useEffect } from 'react';
import { Head, Link, router, usePage } from '@inertiajs/react';
import { DataTable } from '@/components/ui/data-table';
import { Button } from '@/components/ui/button';
import { Plus, Edit, Trash2, Eye, MoreHorizontal } from 'lucide-react';
import AppLayout from '@/layouts/app/app-layout';
import { type BreadcrumbItem } from '@/types';
import { 
  DropdownMenu, 
  DropdownMenuContent, 
  DropdownMenuItem, 
  DropdownMenuTrigger 
} from '@/components/ui/dropdown-menu';
import {
  AlertDialog,
  AlertDialogAction,
  AlertDialogCancel,
  AlertDialogContent,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogHeader,
  AlertDialogTitle,
} from '@/components/ui/alert-dialog';
import { Badge } from '@/components/ui/badge';
import { Card } from '@/components/ui/card';
import { ImportDialog } from '@/components/employee/import-dialog';

interface Employee {
  id: number;
  name: string;
  email: string;
  employee_id: string;
  position: string | null;
  department: string | null;
  join_date: string | null;
  status: string;
}

interface PaginatedData {
  data: Employee[];
  current_page: number;
  per_page: number;
  total: number;
  from: number;
  to: number;
  last_page: number;
}

interface Props {
  employees: PaginatedData;
  filters: Record<string, string | null>;
}

export default function EmployeeLists({ employees, filters }: Props) {
  const { url } = usePage();
  const [searchQuery, setSearchQuery] = useState(filters.search || '');
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [employeeToDelete, setEmployeeToDelete] = useState<number | null>(null);
  const [sort, setSort] = useState<{ field: keyof Employee; direction: 'asc' | 'desc' } | null>(null);
  
  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Employee',
      href: url,
    },
    {
      title: 'Lists',
      href: url,
    }
  ];
  
  // Define columns
  const columns = [
    {
      accessorKey: 'employee_id' as keyof Employee,
      header: 'Employee ID',
      cell: ({ row }: { row: Employee }) => row.employee_id,
    },
    {
      accessorKey: 'name' as keyof Employee,
      header: 'Name',
      cell: ({ row }: { row: Employee }) => row.name,
    },
    {
      accessorKey: 'email' as keyof Employee,
      header: 'Email',
      cell: ({ row }: { row: Employee }) => row.email,
    },
    {
      accessorKey: 'position' as keyof Employee,
      header: 'Position',
      cell: ({ row }: { row: Employee }) => row.position || '-',
    },
    {
      accessorKey: 'department' as keyof Employee,
      header: 'Department',
      cell: ({ row }: { row: Employee }) => row.department || '-',
    },
    {
      accessorKey: 'join_date' as keyof Employee,
      header: 'Join Date',
      cell: ({ row }: { row: Employee }) => row.join_date || '-',
    },
    {
      accessorKey: 'status' as keyof Employee,
      header: 'Status',
      cell: ({ row }: { row: Employee }) => (
        <Badge variant={row.status === 'active' ? 'default' : 'secondary'}>
          {row.status}
        </Badge>
      ),
    },
    {
      accessorKey: 'actions' as keyof Employee,
      header: 'Actions',
      cell: ({ row }: { row: Employee }) => (
        <DropdownMenu>
          <DropdownMenuTrigger asChild>
            <Button variant="ghost" size="icon" className="h-8 w-8 p-0">
              <span className="sr-only">Open menu</span>
              <MoreHorizontal className="h-4 w-4" />
            </Button>
          </DropdownMenuTrigger>
          <DropdownMenuContent align="end">
            <DropdownMenuItem asChild>
              <Link href={route('employee.show', row.id)} className="flex items-center">
                <Eye className="mr-2 h-4 w-4" />
                <span>View</span>
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem asChild>
              <Link href={route('employee.edit', row.id)} className="flex items-center">
                <Edit className="mr-2 h-4 w-4" />
                <span>Edit</span>
              </Link>
            </DropdownMenuItem>
            <DropdownMenuItem 
              onClick={() => handleDelete(row.id)}
              className="flex items-center text-red-600 focus:text-red-600 focus:bg-red-50"
            >
              <Trash2 className="mr-2 h-4 w-4" />
              <span>Delete</span>
            </DropdownMenuItem>
          </DropdownMenuContent>
        </DropdownMenu>
      ),
    },
  ];

  const handleSearch = (query: string) => {
    setSearchQuery(query);
    router.get(route('employee.index'), {
      ...filters,
      search: query,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };

  const handlePageChange = (page: number) => {
    router.get(route('employee.index'), {
      ...filters,
      page
    }, {
      preserveState: true,
      replace: true
    });
  };

  const handleDelete = (id: number) => {
    setEmployeeToDelete(id);
    setIsDeleteDialogOpen(true);
  };

  const confirmDelete = () => {
    if (employeeToDelete) {
      router.delete(route('employee.destroy', employeeToDelete));
    }
    setIsDeleteDialogOpen(false);
  };

  return (
    <AppLayout title="Employees" breadcrumbs={breadcrumbs}>
      <div className="p-6 space-y-6">
        {/* Delete Confirmation Dialog */}
        <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
          <AlertDialogContent>
            <AlertDialogHeader>
              <AlertDialogTitle>Are you sure?</AlertDialogTitle>
              <AlertDialogDescription>
                This action will permanently delete this employee.
                This action cannot be undone.
              </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
              <AlertDialogCancel>Cancel</AlertDialogCancel>
              <AlertDialogAction onClick={confirmDelete} className="bg-destructive text-destructive-foreground hover:bg-destructive/90">
                Delete
              </AlertDialogAction>
            </AlertDialogFooter>
          </AlertDialogContent>
        </AlertDialog>
        
        {/* Import Dialog */}
        <ImportDialog 
          isOpen={isImportDialogOpen} 
          onClose={() => setIsImportDialogOpen(false)} 
          templateUrl="/employee/import/template"
        />

        <div className="flex items-center justify-between">
          <div className="flex items-center gap-4">
            <Link href={route('employee.create')}>
              <Button>Add Employee</Button>
            </Link>
            <Button variant="outline" onClick={() => setIsImportDialogOpen(true)}>
              <Plus className="mr-2 h-4 w-4" />
              Import
            </Button>
          </div>
        </div>

        <Card className="p-6">
          <DataTable<Employee>
            data={employees.data}
            columns={columns}
            title=""
            searchPlaceholder="Search employees..."
            pagination={{
              totalItems: employees.total,
              currentPage: employees.current_page,
              perPage: employees.per_page,
              onPageChange: handlePageChange
            }}
            onSearch={handleSearch}
          />
        </Card>
      </div>
    </AppLayout>
  );
}
