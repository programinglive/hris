import React from 'react';
import { Head, Link, usePage } from '@inertiajs/react';
import { Button } from '@/components/ui/button';
import { Card, CardContent, CardDescription, CardHeader, CardTitle } from '@/components/ui/card';
import { Badge } from '@/components/ui/badge';
import { ArrowLeft, Building2, Mail, Phone, MapPin, Globe, FileText, Edit, Calendar, User } from 'lucide-react';
import AppLayout from '@/layouts/app/app-layout';
import { type BreadcrumbItem } from '@/types';

interface Company {
  id: number;
  name: string;
  legal_name: string | null;
  tax_id: string | null;
  registration_number: string | null;
  email: string;
  phone: string | null;
  address: string | null;
  city: string | null;
  state: string | null;
  postal_code: string | null;
  country: string | null;
  website: string | null;
  description: string | null;
  is_active: boolean;
  owner: {
    id: number;
    name: string;
    email: string;
  };
  created_at: string;
}

interface Props {
  company: Company;
}

export default function ShowCompany({ company }: Props) {
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
      title: 'Company',
      href: route('organization.company.index'),
    },
    {
      title: company.name,
      href: url,
    }
  ];
  
  const formatAddress = () => {
    const parts = [
      company.address,
      company.city,
      company.state,
      company.postal_code,
      company.country
    ].filter(Boolean);
    
    return parts.join(', ');
  };

  return (
    <AppLayout title={company.name} breadcrumbs={breadcrumbs}>
      <div className="p-6 overflow-auto thin-scrollbar">
        <div className="flex justify-between items-center mb-6">
          <div className="flex items-center space-x-4">
            <Link href={route('organization.company.index')}>
              <Button variant="outline" size="icon">
                <ArrowLeft className="h-4 w-4" />
              </Button>
            </Link>
            <div>
              <h1 className="text-2xl font-bold">{company.name}</h1>
              <p className="text-gray-500">Company Details</p>
            </div>
          </div>
          
          <Link href={route('organization.company.edit', company.id)}>
            <Button>
              <Edit className="mr-2 h-4 w-4" />
              Edit Company
            </Button>
          </Link>
        </div>
        
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <Card className="md:col-span-2">
            <CardHeader>
              <CardTitle className="flex items-center">
                <Building2 className="h-5 w-5 mr-2" />
                Company Information
              </CardTitle>
              <CardDescription>Basic details about the company</CardDescription>
            </CardHeader>
            <CardContent className="space-y-6">
              <div className="flex items-center justify-between">
                <div className="flex items-center space-x-2">
                  <span className="font-medium">Status:</span>
                </div>
                <Badge variant={company.is_active ? "success" : "destructive"}>
                  {company.is_active ? 'Active' : 'Inactive'}
                </Badge>
              </div>
              
              {company.legal_name && (
                <div>
                  <span className="font-medium">Legal Name:</span>
                  <p className="text-gray-700">{company.legal_name}</p>
                </div>
              )}
              
              <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                {company.tax_id && (
                  <div>
                    <span className="font-medium">Tax ID:</span>
                    <p className="text-gray-700">{company.tax_id}</p>
                  </div>
                )}
                
                {company.registration_number && (
                  <div>
                    <span className="font-medium">Registration Number:</span>
                    <p className="text-gray-700">{company.registration_number}</p>
                  </div>
                )}
              </div>
              
              <div>
                <span className="font-medium">Contact Information:</span>
                <div className="mt-2 space-y-3">
                  <div className="flex items-center space-x-2">
                    <Mail className="h-4 w-4 text-gray-500" />
                    <span>{company.email}</span>
                  </div>
                  
                  {company.phone && (
                    <div className="flex items-center space-x-2">
                      <Phone className="h-4 w-4 text-gray-500" />
                      <span>{company.phone}</span>
                    </div>
                  )}
                  
                  {(company.address || company.city || company.country) && (
                    <div className="flex items-start space-x-2">
                      <MapPin className="h-4 w-4 text-gray-500 mt-1" />
                      <span>{formatAddress()}</span>
                    </div>
                  )}
                  
                  {company.website && (
                    <div className="flex items-center space-x-2">
                      <Globe className="h-4 w-4 text-gray-500" />
                      <a 
                        href={company.website.startsWith('http') ? company.website : `https://${company.website}`} 
                        target="_blank" 
                        rel="noopener noreferrer"
                        className="text-blue-600 hover:underline"
                      >
                        {company.website}
                      </a>
                    </div>
                  )}
                </div>
              </div>
              
              {company.description && (
                <div>
                  <div className="flex items-center space-x-2 mb-2">
                    <FileText className="h-4 w-4 text-gray-500" />
                    <span className="font-medium">Description:</span>
                  </div>
                  <p className="text-gray-700 whitespace-pre-line">{company.description}</p>
                </div>
              )}
            </CardContent>
          </Card>
          
          <div className="space-y-6">
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center">
                  <User className="h-5 w-5 mr-2" />
                  Company Owner
                </CardTitle>
                <CardDescription>The user who manages this company</CardDescription>
              </CardHeader>
              <CardContent>
                <div className="space-y-2">
                  <p className="font-medium">{company.owner?.name || 'N/A'}</p>
                  <p className="text-gray-500">{company.owner?.email || 'N/A'}</p>
                </div>
              </CardContent>
            </Card>
            
            <Card>
              <CardHeader>
                <CardTitle className="flex items-center">
                  <Calendar className="h-5 w-5 mr-2" />
                  Additional Information
                </CardTitle>
              </CardHeader>
              <CardContent>
                <div className="space-y-4">
                  <div>
                    <span className="text-sm text-gray-500">Created At</span>
                    <p>{new Date(company.created_at).toLocaleDateString('en-US', {
                      year: 'numeric',
                      month: 'long',
                      day: 'numeric'
                    })}</p>
                  </div>
                </div>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </AppLayout>
  );
}
