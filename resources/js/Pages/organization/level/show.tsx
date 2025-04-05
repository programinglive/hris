import AppLayout from '@/layouts/app/app-layout';
import { usePage, Link } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';
import { Button } from '@/Components/ui/button';
import { Edit, ArrowLeft } from 'lucide-react';

interface Level {
  id: number;
  name: string;
  description: string | null;
  level_order: number;
  company: {
    id: number;
    name: string;
  };
  status: string;
  created_at: string;
  updated_at: string;
}

interface Props {
  level: Level;
}

export default function LevelShow({ level }: Props) {
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
      title: 'Level Lists',
      href: route('organization.level.index'),
    },
    {
      title: 'View Level',
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

  return (
    <AppLayout title={`Level: ${level.name}`} breadcrumbs={breadcrumbs}>
      <div className="space-y-6">
        <div className="flex justify-between items-center">
          <Button variant="outline" asChild>
            <Link href={route('organization.level.index')} className="flex items-center">
              <ArrowLeft className="mr-2 h-4 w-4" />
              Back to Levels
            </Link>
          </Button>
          <Button asChild>
            <Link href={route('organization.level.edit', level.id)} className="flex items-center">
              <Edit className="mr-2 h-4 w-4" />
              Edit Level
            </Link>
          </Button>
        </div>

        <Card>
          <CardHeader>
            <CardTitle>Level Details</CardTitle>
          </CardHeader>
          <CardContent>
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h3 className="text-sm font-medium text-gray-500">Name</h3>
                <p className="mt-1 text-base">{level.name}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Level Order</h3>
                <p className="mt-1 text-base">{level.level_order}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Company</h3>
                <p className="mt-1 text-base">{level.company.name}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Status</h3>
                <p className="mt-1">
                  <span className={`inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium ${
                    level.status === 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                  }`}>
                    {level.status.charAt(0).toUpperCase() + level.status.slice(1)}
                  </span>
                </p>
              </div>

              <div className="md:col-span-2">
                <h3 className="text-sm font-medium text-gray-500">Description</h3>
                <p className="mt-1 text-base">{level.description || 'No description provided.'}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Created At</h3>
                <p className="mt-1 text-sm text-gray-600">{formatDate(level.created_at)}</p>
              </div>

              <div>
                <h3 className="text-sm font-medium text-gray-500">Updated At</h3>
                <p className="mt-1 text-sm text-gray-600">{formatDate(level.updated_at)}</p>
              </div>
            </div>
          </CardContent>
        </Card>
      </div>
    </AppLayout>
  );
}
