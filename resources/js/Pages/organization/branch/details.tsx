import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Edit, ArrowLeft } from 'lucide-react';
import { usePage, Link } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Badge } from '@/components/ui/badge';

interface Company {
  id: number;
  name: string;
}

interface Branch {
  id: number;
  name: string;
  code: string;
  address: string | null;
  city: string | null;
  state: string | null;
  postal_code: string | null;
  country: string | null;
  phone: string | null;
  email: string | null;
  company: Company | null;
  is_main_branch: boolean;
  is_active: boolean;
  description: string | null;
  created_at: string;
}

interface PageProps {
  branch: Branch;
  [key: string]: any;
}

export default function BranchDetails() {
  const { props } = usePage<PageProps>();
  const { branch } = props;
  
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
      title: 'Branches',
      href: '/organization/branch',
    },
    {
      title: branch.name,
      href: `/organization/branch/${branch.id}`,
    }
  ];
  
  return (
    <AppLayout title="Branch Details" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <div className="flex items-center gap-4">
            <Button variant="outline" size="sm" asChild>
              <Link href="/organization/branch">
                <ArrowLeft className="h-4 w-4 mr-2" />
                Back to Branches
              </Link>
            </Button>
            <h1 className="text-2xl font-bold">{branch.name}</h1>
            <div className="flex gap-2">
              <Badge 
                variant={branch.is_active ? 'default' : 'secondary'}
                className="capitalize"
              >
                {branch.is_active ? 'Active' : 'Inactive'}
              </Badge>
              {branch.is_main_branch && (
                <Badge variant="success">
                  Main Branch
                </Badge>
              )}
            </div>
          </div>
          <Button asChild>
            <Link href={`/organization/branch/${branch.id}/edit`}>
              <Edit className="h-4 w-4 mr-2" />
              Edit Branch
            </Link>
          </Button>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {/* Basic Information */}
          <Card>
            <CardHeader>
              <CardTitle>Basic Information</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Branch Code</h3>
                <p className="mt-1">{branch.code}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Company</h3>
                <p className="mt-1">
                  {branch.company ? (
                    <Link 
                      href={`/organization/company/${branch.company.id}`}
                      className="text-primary hover:underline"
                    >
                      {branch.company.name}
                    </Link>
                  ) : (
                    'Not assigned'
                  )}
                </p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Description</h3>
                <p className="mt-1">{branch.description || 'No description provided'}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Created On</h3>
                <p className="mt-1">{branch.created_at}</p>
              </div>
            </CardContent>
          </Card>
          
          {/* Contact Information */}
          <Card>
            <CardHeader>
              <CardTitle>Contact Information</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Email</h3>
                <p className="mt-1">
                  {branch.email ? (
                    <a href={`mailto:${branch.email}`} className="text-primary hover:underline">
                      {branch.email}
                    </a>
                  ) : (
                    'Not provided'
                  )}
                </p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Phone</h3>
                <p className="mt-1">
                  {branch.phone ? (
                    <a href={`tel:${branch.phone}`} className="text-primary hover:underline">
                      {branch.phone}
                    </a>
                  ) : (
                    'Not provided'
                  )}
                </p>
              </div>
            </CardContent>
          </Card>
          
          {/* Address Information */}
          <Card className="md:col-span-2">
            <CardHeader>
              <CardTitle>Address Information</CardTitle>
            </CardHeader>
            <CardContent>
              <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                  <h3 className="text-sm font-medium text-muted-foreground">Full Address</h3>
                  <p className="mt-1">{branch.address || 'Not provided'}</p>
                </div>
                
                <div className="grid grid-cols-2 gap-4">
                  <div>
                    <h3 className="text-sm font-medium text-muted-foreground">City</h3>
                    <p className="mt-1">{branch.city || 'Not provided'}</p>
                  </div>
                  
                  <div>
                    <h3 className="text-sm font-medium text-muted-foreground">State/Province</h3>
                    <p className="mt-1">{branch.state || 'Not provided'}</p>
                  </div>
                  
                  <div>
                    <h3 className="text-sm font-medium text-muted-foreground">Postal Code</h3>
                    <p className="mt-1">{branch.postal_code || 'Not provided'}</p>
                  </div>
                  
                  <div>
                    <h3 className="text-sm font-medium text-muted-foreground">Country</h3>
                    <p className="mt-1">{branch.country || 'Not provided'}</p>
                  </div>
                </div>
              </div>
            </CardContent>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
