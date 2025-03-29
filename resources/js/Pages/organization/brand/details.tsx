import AppLayout from '@/layouts/app/app-layout';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardHeader, CardTitle } from '@/components/ui/card';
import { Edit, ArrowLeft } from 'lucide-react';
import { usePage, Link } from '@inertiajs/react';
import { type BreadcrumbItem } from '@/types';
import { Badge } from '@/components/ui/badge';
import { Avatar, AvatarFallback, AvatarImage } from '@/components/ui/avatar';

interface Company {
  id: number;
  name: string;
}

interface Brand {
  id: number;
  name: string;
  code: string;
  logo: string | null;
  description: string | null;
  company: Company | null;
  is_active: boolean;
  created_at: string;
}

interface PageProps {
  brand: Brand;
  [key: string]: any;
}

export default function BrandDetails() {
  const { props } = usePage<PageProps>();
  const { brand } = props;
  
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
      title: 'Brands',
      href: '/organization/brand',
    },
    {
      title: brand.name,
      href: `/organization/brand/${brand.id}`,
    }
  ];
  
  return (
    <AppLayout title="Brand Details" breadcrumbs={breadcrumbs}>
      <div className="p-6">
        <div className="mb-6 flex justify-between items-center">
          <div className="flex items-center gap-4">
            <Button variant="outline" size="sm" asChild>
              <Link href="/organization/brand">
                <ArrowLeft className="h-4 w-4 mr-2" />
                Back to Brands
              </Link>
            </Button>
            <h1 className="text-2xl font-bold">{brand.name}</h1>
            <Badge 
              variant={brand.is_active ? 'default' : 'secondary'}
              className="capitalize"
            >
              {brand.is_active ? 'Active' : 'Inactive'}
            </Badge>
          </div>
          <Button asChild>
            <Link href={`/organization/brand/${brand.id}/edit`}>
              <Edit className="h-4 w-4 mr-2" />
              Edit Brand
            </Link>
          </Button>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          {/* Brand Logo */}
          <Card>
            <CardHeader>
              <CardTitle>Brand Logo</CardTitle>
            </CardHeader>
            <CardContent className="flex justify-center">
              {brand.logo ? (
                <div className="w-48 h-48 rounded-md overflow-hidden border">
                  <img src={brand.logo} alt={brand.name} className="w-full h-full object-contain" />
                </div>
              ) : (
                <Avatar className="w-48 h-48 text-4xl">
                  <AvatarFallback>{brand.name.substring(0, 2).toUpperCase()}</AvatarFallback>
                </Avatar>
              )}
            </CardContent>
          </Card>
          
          {/* Brand Information */}
          <Card>
            <CardHeader>
              <CardTitle>Brand Information</CardTitle>
            </CardHeader>
            <CardContent className="space-y-4">
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Brand Code</h3>
                <p className="mt-1">{brand.code}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Company</h3>
                <p className="mt-1">
                  {brand.company ? (
                    <Link 
                      href={`/organization/company/${brand.company.id}`}
                      className="text-primary hover:underline"
                    >
                      {brand.company.name}
                    </Link>
                  ) : (
                    'Not assigned'
                  )}
                </p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Description</h3>
                <p className="mt-1">{brand.description || 'No description provided'}</p>
              </div>
              
              <div>
                <h3 className="text-sm font-medium text-muted-foreground">Created On</h3>
                <p className="mt-1">{brand.created_at}</p>
              </div>
            </CardContent>
          </Card>
          
          {/* Brand Usage */}
          <Card className="md:col-span-2">
            <CardHeader>
              <CardTitle>Brand Usage</CardTitle>
            </CardHeader>
            <CardContent>
              <p className="text-muted-foreground">
                This section will display products, services, or other items associated with this brand.
              </p>
            </CardContent>
          </Card>
        </div>
      </div>
    </AppLayout>
  );
}
