import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Tabs, TabsContent, TabsList, TabsTrigger } from '@/Components/ui/tabs';
import { DataTable } from '@/Components/ui/data-table';
import { Edit, Plus, Eye, Trash2 } from 'lucide-react';
import { Link } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';

interface SubDivision {
  id: number;
  name: string;
  manager: string;
  employees: number;
  status: string;
}

interface Division {
  id: number;
  name: string;
  department: {
    id: number;
    name: string;
  };
  manager: {
    id: number;
    name: string;
  };
  description: string;
  status: string;
  created_at: string;
  updated_at: string;
  subdivisions: SubDivision[];
}

interface Props {
  division: Division;
}

export default function ShowDivision({ division }: Props) {
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
      title: 'Division',
      href: '/organization/division',
    },
    {
      title: division.name,
      href: `/organization/division/${division.id}`,
    }
  ];

  // Define columns for subdivisions table
  const subDivisionColumns = [
    { key: 'name', label: 'Name' },
    { key: 'manager', label: 'Manager' },
    { key: 'employees', label: 'Employees' },
    { 
      key: 'status', 
      label: 'Status',
      render: (value: string) => (
        <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${
          value === 'Active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
        }`}>
          {value}
        </span>
      )
    },
    {
      key: 'actions',
      label: 'Actions',
      render: (_: any, row: SubDivision) => (
        <div className="flex space-x-2">
          <Button variant="outline" size="sm" asChild>
            <Link href={`/organization/subdivision/${row.id}`}>
              <Eye className="h-4 w-4" />
            </Link>
          </Button>
          <Button variant="outline" size="sm" asChild>
            <Link href={`/organization/subdivision/${row.id}/edit`}>
              <Edit className="h-4 w-4" />
            </Link>
          </Button>
          <Button variant="outline" size="sm">
            <Trash2 className="h-4 w-4" />
          </Button>
        </div>
      ),
    },
  ];

  return (
    <AppLayout title={`Division: ${division.name}`} breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <div>
            <h1 className="text-2xl font-bold">{division.name}</h1>
            <p className="text-gray-500">Division Details</p>
          </div>
          <div className="flex space-x-3">
            <Button variant="outline" asChild>
              <Link href="/organization/division">
                Back to List
              </Link>
            </Button>
            <Button asChild>
              <Link href={`/organization/division/${division.id}/edit`}>
                <Edit className="mr-2 h-4 w-4" />
                Edit Division
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
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{division.name}</dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Department</dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
                    <Link href={`/organization/department/${division.department.id}`} className="text-blue-600 hover:underline">
                      {division.department.name}
                    </Link>
                  </dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Manager</dt>
                  <dd className="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{division.manager.name}</dd>
                </div>
                <div className="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
                  <dt className="text-sm font-medium leading-6 text-gray-900">Status</dt>
                  <dd className="mt-1 text-sm leading-6 sm:col-span-2 sm:mt-0">
                    <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${
                      division.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                    }`}>
                      {division.status === 'active' ? 'Active' : 'Inactive'}
                    </span>
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
                {division.description || 'No description available.'}
              </p>
            </CardContent>
          </Card>
        </div>

        <Tabs defaultValue="subdivisions" className="w-full">
          <TabsList>
            <TabsTrigger value="subdivisions">Sub Divisions</TabsTrigger>
            <TabsTrigger value="employees">Employees</TabsTrigger>
          </TabsList>
          <TabsContent value="subdivisions" className="mt-4">
            <div className="bg-white rounded-md shadow-sm p-6">
              <div className="flex justify-between items-center mb-4">
                <h2 className="text-lg font-semibold">Sub Divisions</h2>
                <Button asChild>
                  <Link href={`/organization/subdivision/create?division_id=${division.id}`}>
                    <Plus className="mr-2 h-4 w-4" />
                    Add Sub Division
                  </Link>
                </Button>
              </div>
              
              {division.subdivisions && division.subdivisions.length > 0 ? (
                <DataTable
                  columns={subDivisionColumns}
                  data={division.subdivisions}
                  searchPlaceholder="Search sub divisions..."
                  title="Sub Divisions"
                />
              ) : (
                <div className="text-center py-8">
                  <p className="text-gray-500">No sub divisions found for this division.</p>
                  <Button asChild className="mt-4">
                    <Link href={`/organization/subdivision/create?division_id=${division.id}`}>
                      <Plus className="mr-2 h-4 w-4" />
                      Add Sub Division
                    </Link>
                  </Button>
                </div>
              )}
            </div>
          </TabsContent>
          <TabsContent value="employees" className="mt-4">
            <div className="bg-white rounded-md shadow-sm p-6">
              <div className="flex justify-between items-center mb-4">
                <h2 className="text-lg font-semibold">Employees in this Division</h2>
              </div>
              
              <div className="text-center py-8">
                <p className="text-gray-500">No employees directly assigned to this division.</p>
                <p className="text-gray-500 text-sm mt-2">Employees are typically assigned to sub divisions.</p>
              </div>
            </div>
          </TabsContent>
        </Tabs>
      </div>
    </AppLayout>
  );
}
