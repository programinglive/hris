import React, { useState } from 'react';
import { Link, router, usePage } from '@inertiajs/react';
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
  phone: string;
  company_id: number;
  is_active: boolean;
  roles: Array<{
    name: string;
  }>;
  brands: Array<{
    name: string;
  }>;
  workSchedules: Array<{
    name: string;
  }>;
}

interface FilterState {
  status: string | null;
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
  filters: {
    search?: string;
    status?: string;
  };
}

interface Action {
  label: string;
  href?: string;
  onClick?: () => void;
  variant?: 'default' | 'outline' | 'ghost';
  icon?: React.ComponentType<{ className?: string }>;
}

export default function EmployeeLists({ employees, filters }: Props) {
  const { url } = usePage();
  const [isImportDialogOpen, setIsImportDialogOpen] = useState(false);
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [employeeToDelete, setEmployeeToDelete] = useState<number | null>(null);
  const [isFilterDialogOpen, setIsFilterDialogOpen] = useState(false);
  const [filterState, setFilterState] = useState<FilterState>({
    status: filters.status || null,
  });
  
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
      accessorKey: 'phone' as keyof Employee,
      header: 'Phone',
      cell: ({ row }: { row: Employee }) => row.phone,
    },
    {
      accessorKey: 'roles' as keyof Employee,
      header: 'Role',
      cell: ({ row }: { row: Employee }) => row.roles?.[0]?.name || '-',
    },
    {
      accessorKey: 'brands' as keyof Employee,
      header: 'Brands',
      cell: ({ row }: { row: Employee }) => 
        row.brands?.map(brand => brand.name).join(', ') || '-',
    },
    {
      accessorKey: 'workSchedules' as keyof Employee,
      header: 'Work Schedules',
      cell: ({ row }: { row: Employee }) => 
        row.workSchedules?.map(schedule => schedule.name).join(', ') || '-',
    },
    {
      accessorKey: 'is_active' as keyof Employee,
      header: 'Status',
      cell: ({ row }: { row: Employee }) => (
        <Badge variant={row.is_active ? 'default' : 'secondary'}>
          {row.is_active ? 'Active' : 'Inactive'}
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

  const handleFilter = () => {
    router.get(route('employee.index'), {
      ...filters,
      ...filterState,
      page: 1
    }, {
      preserveState: true,
      replace: true
    });
  };

  const resetFilters = () => {
    setFilterState({
      status: null,
    });
    router.get(route('employee.index'), {
      page: 1,
      filter_dialog: true,
    }, {
      preserveState: true,
      replace: true
    });
  };

  return (
    <AppLayout title="Employees" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <Card className="p-6">
          <DataTable<Employee>
            data={employees.data}
            columns={columns}
            title="Employee Lists"
            searchPlaceholder="Search employees..."
            pagination={{
              totalItems: employees.total,
              currentPage: employees.current_page,
              perPage: employees.per_page,
              onPageChange: handlePageChange
            }}
            onSearch={handleSearch}
            filterDialog={{
              isOpen: isFilterDialogOpen,
              onOpenChange: (open) => {
                setIsFilterDialogOpen(open);
                if (open) {
                  // Reset filters when dialog opens
                  setFilterState({
                    status: null,
                  });
                  // Reset URL query parameters
                  router.get(route('employee.index'), {
                    page: 1,
                    filter_dialog: true,
                  }, {
                    preserveState: true,
                    replace: true
                  });
                }
              },
              title: "Filter Employees",
              description: "Use these filters to narrow down your employee search. You can filter by status.",
              fields: [
                {
                  label: "Status",
                  type: "select",
                  name: "status",
                  options: [
                    { value: "active", label: "Active" },
                    { value: "inactive", label: "Inactive" }
                  ]
                }
              ],
              state: {
                status: filterState.status || ''
              },
              onStateChange: (state) => {
                setFilterState({
                  status: state.status || null
                });
              },
              onApply: handleFilter,
              onReset: resetFilters,
              className: "space-y-4"
            }}
            actions={[
              {
                label: "Import",
                icon: Plus,
                variant: "outline",
                onClick: () => setIsImportDialogOpen(true)
              },
              {
                label: "Create Employee",
                icon: Plus,
                href: route('employee.create')
              }
            ]}
          />
        </Card>

        <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
          <AlertDialogContent>
            <AlertDialogHeader>
              <AlertDialogTitle>Are you sure?</AlertDialogTitle>
              <AlertDialogDescription>
                This action cannot be undone. This will permanently delete the employee.
              </AlertDialogDescription>
            </AlertDialogHeader>
            <AlertDialogFooter>
              <AlertDialogCancel>Cancel</AlertDialogCancel>
              <AlertDialogAction onClick={confirmDelete} className="bg-red-600 hover:bg-red-700">
                Delete
              </AlertDialogAction>
            </AlertDialogFooter>
          </AlertDialogContent>
        </AlertDialog>

        <ImportDialog
          isOpen={isImportDialogOpen}
          onClose={() => setIsImportDialogOpen(false)}
          templateUrl="/employee/import/template"
        />
      </div>
    </AppLayout>
  );
}
