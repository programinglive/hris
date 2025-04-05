import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/Components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Edit, ArrowLeft } from 'lucide-react';
import { usePage, Link } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Badge } from '@/Components/ui/badge';

interface Manager {
  id: number;
  name: string;
}

interface Parent {
  id: number;
  name: string;
}

interface ChildDepartment {
  id: number;
  name: string;
}

interface Employee {
  id: number;
  name: string;
  position: string | null;
}

interface Department {
  id: number;
  name: string;
  description: string | null;
  manager: Manager | null;
  parent: Parent | null;
  status: string;
  created_at: string;
  children: ChildDepartment[];
  employees: Employee[];
}

interface PageProps {
  department: Department;
  [key: string]: any;
}

export default function DepartmentDetails() {
  const { props } = usePage<PageProps>();
  const { department } = props;
  
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
      title: 'Departments',
      href: '/organization/department',
    },
    {
      title: department.name,
      href: `/organization/department/${department.id}`,
    }
  ];
  
  return (
    <AppLayout title="Department Details" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <div className="flex items-center gap-4">
            <Button variant="outline" size="sm" asChild>
              <Link href="/organization/department">
                <ArrowLeft className="h-4 w-4 mr-2" />
                Back to Departments
              </Link>
            </Button>
            <h1 className="text-2xl font-bold">{department.name}</h1>
            <Badge 
              variant={department.status === 'active' ? 'default' : 'secondary'}
              className="capitalize"
            >
              {department.status}
            </Badge>
          </div>
          <Button asChild>
            <Link href={`/organization/department/${department.id}/edit`}>
              <Edit className="h-4 w-4 mr-2" />
              Edit Department
            </Link>
          </Button>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {/* Department Information */}
          <Card>
            <CardHeader>
              <CardTitle>Department Information</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Description</h3>
                <p className="mt-1">{department.description || 'No description provided'}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Manager</h3>
                <p className="mt-1">
                  {department.manager ? (
                    <Link 
                      href={`/employee/${department.manager.id}`}
                      className="text-primary hover:underline"
                    >
                      {department.manager.name}
                    </Link>
                  ) : (
                    'Not assigned'
                  )}
                </p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Parent Department</h3>
                <p className="mt-1">
                  {department.parent ? (
                    <Link 
                      href={`/organization/department/${department.parent.id}`}
                      className="text-primary hover:underline"
                    >
                      {department.parent.name}
                    </Link>
                  ) : (
                    'None'
                  )}
                </p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Created On</h3>
                <p className="mt-1">{department.created_at}</p>
              </div>
            </CardContent>
          </Card>
          
          {/* Sub-Departments */}
          <Card>
            <CardHeader>
              <CardTitle>Sub-Departments</CardTitle>
            </CardHeader>
            <CardContent>
              {department.children.length > 0 ? (
                <ul className="space-y-2">
                  {department.children.map((child) => (
                    <li key={child.id} className="flex items-center justify-between p-2 border rounded-md">
                      <span>{child.name}</span>
                      <Button variant="ghost" size="sm" asChild>
                        <Link href={`/organization/department/${child.id}`}>
                          View
                        </Link>
                      </Button>
                    </li>
                  ))}
                </ul>
              ) : (
                <p className="text-muted-foreground">No sub-departments</p>
              )}
            </CardContent>
          </Card>
          
          {/* Department Employees */}
          <Card className="md:col-span-2">
            <CardHeader>
              <CardTitle>Department Employees</CardTitle>
            </CardHeader>
            <CardContent>
              {department.employees.length > 0 ? (
                <div className="border rounded-md overflow-hidden">
                  <table className="w-full">
                    <thead>
                      <tr className="bg-muted/50">
                        <th className="text-left p-3 font-medium">Name</th>
                        <th className="text-left p-3 font-medium">Position</th>
                        <th className="text-right p-3 font-medium">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      {department.employees.map((employee) => (
                        <tr key={employee.id} className="border-t">
                          <td className="p-3">{employee.name}</td>
                          <td className="p-3">{employee.position || 'Not specified'}</td>
                          <td className="p-3 text-right">
                            <Button variant="ghost" size="sm" asChild>
                              <Link href={`/employee/${employee.id}`}>
                                View
                              </Link>
                            </Button>
                          </td>
                        </tr>
                      ))}
                    </tbody>
                  </table>
                </div>
              ) : (
                <p className="text-muted-foreground">No employees in this department</p>
              )}
            </CardContent>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
