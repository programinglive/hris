import AppLayout from '@/layouts/app/app-layout';
import { usePage, Link } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Edit, ArrowLeft } from 'lucide-react';

interface Position {
  id: number;
  name: string;
  description: string | null;
  level: {
    id: number;
    name: string;
  } | null;
  subDivision: {
    id: number;
    name: string;
    division: {
      id: number;
      name: string;
      department: {
        id: number;
        name: string;
      }
    }
  } | null;
  company: {
    id: number;
    name: string;
  };
  min_salary: number | null;
  max_salary: number | null;
  status: string;
  created_at: string;
  updated_at: string;
}

interface Props {
  position: Position;
}

export default function PositionShow({ position }: Props) {
  const { url } = usePage();
  
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
      title: 'Position Lists',
      href: route('organization.position.index'),
    },
    {
      title: 'View Position',
      href: url,
    }
  ];

  // Format date
  const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString('en-US', {
      year: 'numeric',
      month: 'long',
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  };

  // Format salary as currency
  const formatSalary = (amount: number | null) => {
    if (amount === null) return 'N/A';
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
    }).format(amount);
  };

  return (
    <AppLayout title={`Position: ${position.name}`} breadcrumbs={breadcrumbs}>
      <div className="space-y-6">
        <div className="flex justify-between items-center">
          <Button variant="outline" asChild>
            <Link href={route('organization.position.index')} className="flex items-center">
              <ArrowLeft className="mr-2 h-4 w-4" />
              Back to Positions
            </Link>
          </Button>
          <Button asChild>
            <Link href={route('organization.position.edit', position.id)} className="flex items-center">
              <Edit className="mr-2 h-4 w-4" />
              Edit Position
            </Link>
          </Button>
        </div>

        <Card>
          <CardHeader>
            <CardTitle>Position Details</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h3 className="text-sm font-medium text-gray-500">Name</h3>
                <p className="mt-1 text-base">{position.name}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Company</h3>
                <p className="mt-1 text-base">{position.company.name}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Level</h3>
                <p className="mt-1 text-base">{position.level ? position.level.name : 'Not Assigned'}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Sub Division</h3>
                <p className="mt-1 text-base">{position.subDivision ? position.subDivision.name : 'Not Assigned'}</p>
              </div>

              {position.subDivision && (
                <>
                  <div>
                    <h3 className="text-sm font-medium text-gray-500">Division</h3>
                    <p className="mt-1 text-base">{position.subDivision.division.name}</p>
                  </div>

                  <div>
                    <h3 className="text-sm font-medium text-gray-500">Department</h3>
                    <p className="mt-1 text-base">{position.subDivision.division.department.name}</p>
                  </div>
                </>
              )}

              <div>
                <h3 className="text-sm font-medium text-gray-500">Minimum Salary</h3>
                <p className="mt-1 text-base">{formatSalary(position.min_salary)}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Maximum Salary</h3>
                <p className="mt-1 text-base">{formatSalary(position.max_salary)}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Status</h3>
                <p className="mt-1">
                  <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${
                    position.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                  }`}>
                    {position.status.charAt(0).toUpperCase() + position.status.slice(1)}
                  </span>
                </p>
              </div>

              <div className="md:col-span-2">
                <h3 className="text-sm font-medium text-gray-500">Description</h3>
                <p className="mt-1 text-base">{position.description || 'No description provided.'}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Created At</h3>
                <p className="mt-1 text-sm text-gray-600">{formatDate(position.created_at)}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Updated At</h3>
                <p className="mt-1 text-sm text-gray-600">{formatDate(position.updated_at)}</p>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
