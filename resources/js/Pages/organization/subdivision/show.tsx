import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/components/ui/tabs';
import { DataTable } from '@/components/ui/data-table';
import { Edit, Plus, Eye, Trash2, ArrowLeft } from 'lucide-react';
import { Link, router } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Badge } from '@/components/ui/badge';
import { useState } from 'react';
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

interface Position {
  id: number;
  name: string;
  level: {
    id: number;
    name: string;
  } | null;
  status: string;
}

interface Employee {
  id: number;
  employee_id: string;
  user: {
    id: number;
    name: string;
    email: string;
  };
  position: {
    id: number;
    name: string;
  } | null;
}

interface SubDivision {
  id: number;
  name: string;
  division: {
    id: number;
    name: string;
    department: {
      id: number;
      name: string;
    };
  };
  manager: {
    id: number;
    name: string;
  } | null;
  description: string | null;
  status: string;
  created_at: string;
  updated_at: string;
  positions: Position[];
  employees: Employee[];
}

interface Props {
  subdivision: SubDivision;
}

export default function ShowSubDivision({ subdivision }: Props) {
  const [isDeleteDialogOpen, setIsDeleteDialogOpen] = useState(false);
  const [positionToDelete, setPositionToDelete] = useState<Position | null>(null);
  
  // Generate breadcrumbs
  const breadcrumbs: BreadcrumbItem[] = [
    {
      title: 'Dashboard',
      href: '/dashboard',
    },
    {
      title: 'Organization',
      href: '#',
    },
    {
      title: 'Sub Division',
      href: route('organization.subdivision.index'),
    },
    {
      title: subdivision.name,
      href: route('organization.subdivision.show', subdivision.id),
    }
  ];

  const handleDelete = (position: Position) => {
    setPositionToDelete(position);
    setIsDeleteDialogOpen(true);
  };

  const confirmDelete = () => {
    if (positionToDelete) {
      router.delete(route('organization.position.destroy', positionToDelete.id));
    }
    setIsDeleteDialogOpen(false);
  };

  // Define columns for positions table
  const positionColumns = [
    { key: 'name', label: 'Name', render: (value: string) => <div className="font-medium">{value}</div> },
    { 
      key: 'level', 
      label: 'Level',
      render: (value: Position['level']) => (
        value ? (
          <Link href={route('organization.level.show', value.id)} className="text-blue-600 hover:underline">
            {value.name}
          </Link>
        ) : 'N/A'
      )
    },
    { 
      key: 'status', 
      label: 'Status',
      render: (value: string) => (
        <Badge 
          variant={value === 'active' ? 'default' : 'secondary'}
          className="capitalize"
        >
          {value}
        </Badge>
      )
    },
    {
      key: 'actions',
      label: 'Actions',
      render: (_: any, row: Position) => (
        <div className="flex space-x-2">
          <Button variant="outline" size="sm" asChild>
            <Link href={route('organization.position.show', row.id)}>
              <Eye className="h-4 w-4" />
            </Link>
          </Button>
          <Button variant="outline" size="sm" asChild>
            <Link href={route('organization.position.edit', row.id)}>
              <Edit className="h-4 w-4" />
            </Link>
          </Button>
          <Button variant="outline" size="sm" onClick={() => handleDelete(row)}>
            <Trash2 className="h-4 w-4" />
          </Button>
        </div>
      ),
    },
  ];

  // Define columns for employees table
  const employeeColumns = [
    { key: 'employee_id', label: 'Employee ID' },
    { 
      key: 'user.name', 
      label: 'Name',
      render: (value: string, row: Employee) => (
        <Link href={route('employee.show', row.id)} className="text-blue-600 hover:underline">
          {value}
        </Link>
      )
    },
    { 
      key: 'position', 
      label: 'Position',
      render: (value: Employee['position']) => (
        value ? (
          <Link href={route('organization.position.show', value.id)} className="text-blue-600 hover:underline">
            {value.name}
          </Link>
        ) : 'N/A'
      )
    },
    { key: 'user.email', label: 'Email' },
    {
      key: 'actions',
      label: 'Actions',
      render: (_: any, row: Employee) => (
        <div className="flex space-x-2">
          <Button variant="outline" size="sm" asChild>
            <Link href={route('employee.show', row.id)}>
              <Eye className="h-4 w-4" />
            </Link>
          </Button>
        </div>
      ),
    },
  ];

  return (
    <AppLayout title={`Sub Division: ${subdivision.name}`} breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <div>
            <h1 className="text-2xl font-bold">{subdivision.name}</h1>
            <p className="text-gray-500">Sub Division Details</p>
          </div>
          <div className="flex space-x-3">
            <Button variant="outline" asChild>
              <Link href={route('organization.subdivision.index')}>
                <ArrowLeft className="mr-2 h-4 w-4" />
                Back to List
              </Link>
            </Button>
            <Button asChild>
              <Link href={route('organization.subdivision.edit', subdivision.id)}>
                <Edit className="mr-2 h-4 w-4" />
                Edit Sub Division
              </Link>
            </Button>
          </div>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
          <Card>
            <CardHeader>
              <CardTitle>Basic Information</CardTitle>
            </CardHeader>
            <CardContent>
              <dl className="divide-y divide-gray-100">
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Name</dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{subdivision.name}</dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Division</dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <Link href={route('organization.division.show', subdivision.division.id)} className="text-blue-600 hover:underline">
                      {subdivision.division.name}
                    </Link>
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Department</dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <Link href={route('organization.department.show', subdivision.division.department.id)} className="text-blue-600 hover:underline">
                      {subdivision.division.department.name}
                    </Link>
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Manager</dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {subdivision.manager ? subdivision.manager.name : 'Not Assigned'}
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Status</dt>
                  <dd className="mt-1 text-sm leading-6 sm:col-span-2 sm:mt-0">
                    <Badge 
                      variant={subdivision.status === 'active' ? 'default' : 'secondary'}
                      className="capitalize"
                    >
                      {subdivision.status}
                    </Badge>
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Created</dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    {new Date(subdivision.created_at).toLocaleString()}
                  </dd>
                </div>
              </dl>
            </CardContent>
          </Card>

          <Card className="md:col-span-2">
            <CardHeader>
              <CardTitle>Description</CardTitle>
            </CardHeader>
            <CardContent>
              <p className="text-sm text-gray-700">
                {subdivision.description || 'No description available.'}
              </p>
            </CardContent>
          </Card>
        </div>

        <Tabs defaultValue="positions" className="w-full">
          <TabsList>
            <TabsTrigger value="positions">Positions</TabsTrigger>
            <TabsTrigger value="employees">Employees</TabsTrigger>
          </TabsList>
          <TabsContent value="positions" className="mt-4">
            <div className="bg-white rounded-md shadow-sm p-6">
              <div className="flex justify-between items-center mb-4">
                <h2 className="text-lg font-semibold">Positions</h2>
                <Button asChild>
                  <Link href={route('organization.position.create', { subdivision_id: subdivision.id })}>
                    <Plus className="mr-2 h-4 w-4" />
                    Add Position
                  </Link>
                </Button>
              </div>
              
              {subdivision.positions && subdivision.positions.length > 0 ? (
                <DataTable
                  columns={positionColumns}
                  data={subdivision.positions}
                  totalItems={subdivision.positions.length}
                  currentPage={1}
                  perPage={10}
                  onPageChange={() => {}}
                  onSearch={() => {}}
                  searchPlaceholder="Search positions..."
                />
              ) : (
                <div className="text-center py-8">
                  <p className="text-gray-500">No positions found for this sub division.</p>
                  <Button asChild className="mt-4">
                    <Link href={route('organization.position.create', { subdivision_id: subdivision.id })}>
                      <Plus className="mr-2 h-4 w-4" />
                      Add Position
                    </Link>
                  </Button>
                </div>
              )}
            </div>
          </TabsContent>
          <TabsContent value="employees" className="mt-4">
            <div className="bg-white rounded-md shadow-sm p-6">
              <div className="flex justify-between items-center mb-4">
                <h2 className="text-lg font-semibold">Employees</h2>
              </div>
              
              {subdivision.employees && subdivision.employees.length > 0 ? (
                <DataTable
                  columns={employeeColumns}
                  data={subdivision.employees}
                  totalItems={subdivision.employees.length}
                  currentPage={1}
                  perPage={10}
                  onPageChange={() => {}}
                  onSearch={() => {}}
                  searchPlaceholder="Search employees..."
                />
              ) : (
                <div className="text-center py-8">
                  <p className="text-gray-500">No employees found for this sub division.</p>
                </div>
              )}
            </div>
          </TabsContent>
        </Tabs>
      </div>
      
      <AlertDialog open={isDeleteDialogOpen} onOpenChange={setIsDeleteDialogOpen}>
        <AlertDialogContent>
          <AlertDialogHeader>
            <AlertDialogTitle>Are you sure you want to delete this position?</AlertDialogTitle>
            <AlertDialogDescription>
              This action cannot be undone. This will permanently delete the position
              and all associated data.
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
    </AppLayout>
  );
}
